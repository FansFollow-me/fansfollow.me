<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class MarkdownNegotiation
{
    public function handle(Request $request, Closure $next)
    {
        $accept = $request->header('Accept', '');
        
        if (str_contains($accept, 'text/markdown')) {
            $response = $next($request);
            
            // Only convert HTML responses
            if (str_contains($response->headers->get('Content-Type', ''), 'text/html')) {
                $html = $response->getContent();
                $markdown = $this->htmlToMarkdown($html);
                
                $response->setContent($markdown);
                $response->headers->set('Content-Type', 'text/markdown; charset=UTF-8');
                $response->headers->set('X-Markdown-Tokens', $this->estimateTokens($markdown));
            }
            
            return $response;
        }
        
        return $next($request);
    }

    private function htmlToMarkdown(string $html): string
    {
        // Extract main content area (skip nav, scripts, styles)
        $html = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $html);
        $html = preg_replace('/<style\b[^>]*>.*?<\/style>/is', '', $html);
        $html = preg_replace('/<nav\b[^>]*>.*?<\/nav>/is', '', $html);
        $html = preg_replace('/<footer\b[^>]*>.*?<\/footer>/is', '', $html);
        
        // Convert common HTML to Markdown
        $html = preg_replace('/<h1[^>]*>(.*?)<\/h1>/is', '# $1' . "\n\n", $html);
        $html = preg_replace('/<h2[^>]*>(.*?)<\/h2>/is', '## $1' . "\n\n", $html);
        $html = preg_replace('/<h3[^>]*>(.*?)<\/h3>/is', '### $1' . "\n\n", $html);
        $html = preg_replace('/<h4[^>]*>(.*?)<\/h4>/is', '#### $1' . "\n\n", $html);
        $html = preg_replace('/<p[^>]*>(.*?)<\/p>/is', '$1' . "\n\n", $html);
        $html = preg_replace('/<br\s*\/?>/i', "\n", $html);
        $html = preg_replace('/<strong>(.*?)<\/strong>/is', '**$1**', $html);
        $html = preg_replace('/<b>(.*?)<\/b>/is', '**$1**', $html);
        $html = preg_replace('/<em>(.*?)<\/em>/is', '*$1*', $html);
        $html = preg_replace('/<i>(.*?)<\/i>/is', '*$1*', $html);
        $html = preg_replace('/<a[^>]*href="([^"]*)"[^>]*>(.*?)<\/a>/is', '[$2]($1)', $html);
        $html = preg_replace('/<li[^>]*>(.*?)<\/li>/is', '- $1' . "\n", $html);
        $html = preg_replace('/<ul[^>]*>(.*?)<\/ul>/is', '$1' . "\n", $html);
        $html = preg_replace('/<ol[^>]*>(.*?)<\/ol>/is', '$1' . "\n", $html);
        $html = preg_replace('/<img[^>]*src="([^"]*)"[^>]*alt="([^"]*)"[^>]*\/?>/is', '![$2]($1)', $html);
        $html = preg_replace('/<img[^>]*src="([^"]*)"[^>]*\/?>/is', '![]($1)', $html);
        $html = preg_replace('/<hr\s*\/?>/i', '---' . "\n\n", $html);
        $html = preg_replace('/<blockquote[^>]*>(.*?)<\/blockquote>/is', '> $1' . "\n\n", $html);
        $html = preg_replace('/<code>(.*?)<\/code>/is', '`$1`', $html);
        $html = preg_replace('/<pre[^>]*>(.*?)<\/pre>/is', "```\n$1\n```" . "\n\n", $html, 1);
        
        // Remove remaining HTML tags
        $html = strip_tags($html);
        
        // Clean up whitespace
        $html = preg_replace('/\n{3,}/', "\n\n", $html);
        $html = preg_replace('/^\s+$/m', '', $html);
        $html = trim($html);
        
        // Add site metadata
        $siteName = config('app.name', 'FansFollow.me');
        $url = url('/');
        
        return "# {$siteName}\n\n" . 
               "**Source:** {$url}\n" .
               "**Format:** Markdown (agent-friendly)\n\n" .
               "---\n\n" .
               $html;
    }

    private function estimateTokens(string $text): int
    {
        // Rough estimate: ~4 chars per token
        return (int) ceil(mb_strlen($text) / 4);
    }
}

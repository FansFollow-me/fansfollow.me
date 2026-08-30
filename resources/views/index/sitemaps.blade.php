<?php $paths = [
  // Main public pages
  '/', '/signup', '/login', '/explore', '/creators', '/contact',
  // Feature pages
  '/fans', '/celebrities', '/business', '/casting', '/live-streams', '/scan',
  '/group-coaching', '/explore-creators', '/shop', '/support',
  // Auth & account
  '/faq', '/blog',
  // Legal & policy
  '/privacy', '/terms', '/cookies',
  // SEO pages
  '/how-it-works', '/token-ecosystem', '/presale-info', '/mobile-app',
  '/partnerships', '/best-creator-platform', '/creator-platform-comparison',
  '/monetize-fitness-content', '/sell-fitness-content', '/sell-martial-arts-content',
  // Comparison pages
  '/vs/onlyfans', '/vs/patreon', '/vs/fansly',
]; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/sitemap.xsd">
@foreach ($paths as $path)
<url>
  <loc>{{ $path === '/' ? url('/') : rtrim(url(ltrim($path, '/')), '/') }}</loc>
  <lastmod>{{ date('Y-m-d') }}</lastmod>
  <changefreq>{{ in_array($path, ['/', '/explore', '/creators']) ? 'daily' : 'weekly' }}</changefreq>
  <priority>{{ in_array($path, ['/']) ? '1.0' : (in_array($path, ['/signup', '/explore', '/creators']) ? '0.9' : '0.7') }}</priority>
</url>
@endforeach
</urlset>

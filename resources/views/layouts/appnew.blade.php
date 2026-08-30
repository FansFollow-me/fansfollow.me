@php
  header('Link: </.well-known/api-catalog>; rel="api-catalog"');
  header('Link: </robots.txt>; rel="robots"', false);
  header('Link: </sitemap.xml>; rel="sitemap"', false);
  header('Link: </auth.md>; rel="service-doc"', false);
  header('Link: </.well-known/agent.json>; rel="agent-card"', false);
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  @php($descriptionCustom = trim($__env->yieldContent('description_custom')))
  <meta name="description" content="{{ $descriptionCustom !== '' ? $descriptionCustom : trans('seo.description') }}">
  @php($keywordsCustom = trim($__env->yieldContent('keywords_custom')))
  <meta name="keywords" content="{{ $keywordsCustom !== '' ? $keywordsCustom : trans('seo.keywords') }}" />
  <meta name="theme-color" content="{{ auth()->check() && auth()->user()->dark_mode == 'on' ? '#303030' : $settings->color_default }}">
  <meta name="msvalidate.01" content="83E04AABA8CC0BC0618D1849666A133A">
  <title>{{ auth()->check() && User::notificationsCount() ? '('.User::notificationsCount().') ' : '' }}@section('title')@show @if(isset($settings->title)){{ $settings->title }}@endif</title>
  <link href="/public/img/{{ $settings->favicon }}" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/all.min.css" rel="stylesheet">
  <link href="/assets/css/fontawesome.css" rel="stylesheet">
  <link href="/assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#f97316">
  <link rel="apple-touch-icon" href="/fans-foloow-me-logo-final-file--png-version-480.png">
  <link href="/assets/css/responsive.css" rel="stylesheet">
  @include('includes.css_general')
  @yield('css')
  <style>
    :root {
      color-scheme: dark;
      --bg: #0b0f1a;
      --panel: #151b2c;
      --text: #e5e7eb;
      --muted: #94a3b8;
      --line: rgba(255, 255, 255, 0.08);
      --accent: #60a5fa;
      --accent-2: #e5e7eb;
      --shadow: 0 18px 54px rgba(0, 0, 0, 0.36);
      --cta-gradient: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #a855f7 100%);
    }

    * { box-sizing: border-box; }
    html { scroll-behavior: smooth; }
    body {
      margin: 0;
      background-color: var(--bg);
      background-image: none;
      color: var(--text);
      font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
      font-weight: 400;
    }
    a { color: inherit; text-decoration: none; }
    img { max-width: 100%; display: block; }

    .public-shell-topbar {
      position: sticky;
      top: 0;
      z-index: 40;
      background: transparent;
      border-bottom: 1px solid transparent;
      box-shadow: none;
      transition: background .3s, border-color .3s, box-shadow .3s;
    }
    .public-shell-topbar.scrolled {
      background: rgba(11,15,26,0.82);
      backdrop-filter: blur(18px);
      border-bottom: 1px solid rgba(255,255,255,.06);
      box-shadow: 0 4px 16px rgba(0,0,0,.15);
    }
    .public-shell-topbar .inner {
      min-height: 72px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
    }
    .public-shell-brand img { height: 30px; width: auto; }
    .public-shell-nav {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      gap: 0.15rem;
    }
    .public-shell-nav a, .public-shell-nav summary {
      padding: 0.5rem 0.7rem;
      border-radius: 10px;
      font-weight: 700;
      font-size: 0.9rem;
      color: #cbd5e1;
      cursor: pointer;
      list-style: none;
      transition: background-color .16s ease, color .16s ease, transform .16s ease;
    }
    .public-shell-nav a:hover,
    .public-shell-nav a.active,
    .public-shell-nav summary:hover,
    .public-shell-nav details[open] > summary {
      color: #fb923c;
      background: none;
      transform: translateY(-1px);
    }
    .public-shell-nav details { position: relative; }
    .public-shell-nav details > summary::-webkit-details-marker { display: none; }
    .public-shell-nav summary::after {
      content: '▾';
      display: inline-block;
      margin-left: .35rem;
      font-size: .82em;
      line-height: 1;
      opacity: .8;
      transform: translateY(-1px);
    }
    .public-shell-nav details[open] > summary::after {
      transform: translateY(-1px) rotate(180deg);
    }
    .public-shell-nav-panel {
      position: absolute;
      top: calc(100% + .55rem);
      left: 0;
      min-width: 220px;
      padding: .45rem;
      background: #151b2c;
      border: 1px solid rgba(255,255,255,.08);
      border-radius: 16px;
      box-shadow: var(--shadow);
      display: grid;
      gap: .15rem;
      z-index: 5;
    }
    .public-shell-nav-panel a {
      padding: .7rem .8rem;
      border-radius: 12px;
      font-weight: 600;
      color: #e5e7eb;
      display: flex;
      align-items: center;
      gap: .6rem;
    }
    .public-shell-nav-panel a i,
    .public-shell-nav-panel a svg.lucide {
      width: 1rem;
      height: 1rem;
      text-align: center;
      color: #fb923c;
      flex: 0 0 auto;
    }
    .public-shell-nav-panel a:hover {
      background: rgba(255,255,255,.08);
      color: #fff;
    }
    .public-shell-actions { display: flex; gap: .6rem; align-items: center; }
    .public-shell-button {
      border-radius: 12px;
      font-weight: 700;
      min-height: 42px;
      padding: 0.65rem 1.1rem;
      letter-spacing: -0.01em;
      border-width: 1px;
      font-size: .9rem;
    }
    .public-shell-button.btn-primary {
      background: var(--cta-gradient);
      background-image: var(--cta-gradient);
      color: #fff;
      border-color: transparent;
      box-shadow: 0 10px 20px rgba(249, 115, 22, .3);
    }
    .public-shell-button.btn-primary:hover,
    .public-shell-button.btn-primary:focus {
      background: linear-gradient(135deg, #f97316 0%, #a855f7 100%);
      background-image: linear-gradient(135deg, #f97316 0%, #a855f7 100%);
      color: #fff;
    }
    .public-shell-button.btn-outline-primary {
      color: #e5e7eb;
      border: none;
      background: rgba(30,41,59,.9);
    }
    .public-shell-button.btn-outline-primary:hover,
    .public-shell-button.btn-outline-primary:focus {
      background: rgba(51,65,85,.9);
      color: #fff;
    }
    .public-shell-content {
      padding: 0;
    }
    .container,
    .container-fluid,
    .container-sm,
    .container-md,
    .container-lg,
    .container-xl {
      max-width: 1280px !important;
    }
    .container {
      padding-left: 1rem;
      padding-right: 1rem;
    }
    @media (min-width: 640px) { .container { padding-left: 1.5rem; padding-right: 1.5rem; } }
    @media (min-width: 1024px) { .container { padding-left: 2rem; padding-right: 2rem; } }

    .public-shell-content .container {
      max-width: 1280px;
    }
    .public-shell-content .card,
    .public-shell-content .panel {
      background: rgba(15,23,42,.84);
      border: 1px solid rgba(148,163,184,.12);
      border-radius: 16px;
      box-shadow: var(--shadow);
      color: #e5e7eb;
    }
    .public-shell-content .btn,
    .public-shell-content .form-control,
    .public-shell-content .custom-select {
      border-radius: 12px;
    }
    .public-shell-content .btn-primary {
      background: #020617;
      border-color: #020617;
      color: #fff;
      box-shadow: 0 10px 24px rgba(2, 6, 23, .22);
    }
    .public-shell-content .btn-primary:hover,
    .public-shell-content .btn-primary:focus {
      background: #111827;
      border-color: #111827;
      color: #fff;
    }
    .public-shell-footer {
      padding: 1.5rem 0 1.2rem;
      color: var(--muted);
      background: linear-gradient(135deg, #111827, #1f2937, #111827);
      border-top: 1px solid #1f293b;
    }
    .public-shell-footer .footer-topline,
    .public-shell-footer .footer-bottomline {
      height: 3px;
      width: 100%;
      border-radius: 999px;
      background: linear-gradient(90deg, rgba(249,115,22,0) 0%, rgba(249,115,22,.85) 18%, rgba(168,85,247,.95) 50%, rgba(236,72,153,.85) 82%, rgba(236,72,153,0) 100%);
      opacity: .95;
    }
    .public-shell-footer .footer-topline { margin-bottom: 1rem; }
    .public-shell-footer .footer-bottomline { margin-top: 1.5rem; margin-bottom: .75rem; }
    .public-shell-footer .footer-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 1.5rem;
      align-items: start;
    }
    .public-shell-footer h3 {
      margin: 0 0 .75rem;
      font-size: .875rem;
      font-weight: 700;
      color: #fff;
      position: relative;
      padding-bottom: .75rem;
    }
    .public-shell-footer h3::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 32px;
      height: 2px;
      border-radius: 999px;
      background: var(--cta-gradient);
    }
    .public-shell-footer .footer-links a { display: block; padding: .15rem 0; color: #9ca3af; font-size: .75rem; line-height: 1.4; }
    .public-shell-footer .footer-links a:hover { color: #fff; }
    .public-shell-footer .footer-bottom {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: .75rem;
      font-size: .75rem;
      line-height: 1.4;
      color: #9ca3af;
    }
    .public-shell-footer .footer-bottom > * {
      min-width: 0;
    }
    .public-shell-footer .footer-bottom .footer-legal,
    .public-shell-footer .footer-bottom .footer-policies,
    .public-shell-footer .footer-bottom .footer-follow {
      display: inline-flex;
      align-items: center;
      flex-wrap: wrap;
      gap: .5rem;
      margin: 0;
      padding: 0;
      border: 0;
      font-size: inherit;
      line-height: inherit;
      justify-content: flex-start;
    }
    .public-shell-footer .footer-bottom .footer-policies {
      white-space: nowrap;
      flex-wrap: nowrap;
    }
    .public-shell-footer .footer-bottom .footer-policies a {
      white-space: nowrap;
    }
    .public-shell-footer .footer-bottom .footer-policies span {
      color: #64748b;
      white-space: nowrap;
    }
    .public-shell-footer .footer-bottom .footer-legal {
      flex-wrap: wrap;
      justify-content: center;
      gap: .5rem .75rem;
    }
    .public-shell-footer .footer-bottom .footer-legal .btc-mark {
      color: #f97316;
      font-weight: 800;
    }
    .public-shell-footer .footer-bottom .footer-legal strong {
      color: #fff;
    }
    .public-shell-footer .footer-bottom .footer-policies {
      margin-top: 0;
    }
    .public-shell-footer .footer-bottom .footer-policies a:hover,
    .public-shell-footer .footer-follow {
      color: var(--text);
    }
    .public-shell-footer .footer-follow-social {
      display: inline-flex;
      align-items: center;
      gap: .5rem;
    }
    .public-shell-footer .footer-follow-text {
      color: #9ca3af;
      font-size: .75rem;
    }
    .public-shell-footer .footer-social {
      display: inline-flex;
      justify-content: center;
      align-items: center;
      gap: .5rem;
    }
    .public-shell-footer .footer-social a {
      width: 28px;
      height: 28px;
      border-radius: 999px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: #1f2937;
      color: #9ca3af;
      border: 1px solid rgba(255,255,255,.08);
    }
    .public-shell-footer .footer-social a:hover {
      background: rgba(249,115,22,.16);
      border-color: rgba(249,115,22,.24);
      color: #fff;
    }

    @media (max-width: 991.98px) {
      .public-shell-topbar .inner {
        min-height: auto;
        flex-wrap: wrap;
        padding: .85rem 0;
      }

      .public-shell-brand {
        flex: 1 1 auto;
      }

      .public-shell-brand img {
        height: 26px;
      }

      .public-shell-actions {
        display: none;
      }

      .public-shell-content .container {
        padding-left: 1rem;
        padding-right: 1rem;
      }

      .public-shell-content {
        padding-bottom: 0 !important;
      }

      .public-shell-footer {
        padding: 2rem 0 1.5rem;
      }

      .public-shell-footer .footer-grid {
        grid-template-columns: 1fr 1fr;
        gap: 1.1rem;
      }

      .public-shell-footer .footer-bottom {
        align-items: center;
        text-align: center;
      }

    }

    /* Hamburger button */
    .public-shell-hamburger {
      display: none;
      background: none;
      border: none;
      color: #e5e7eb;
      padding: .5rem;
      cursor: pointer;
      min-width: 44px;
      min-height: 44px;
      align-items: center;
      justify-content: center;
    }
    @media (max-width: 991.98px) {
      .public-shell-hamburger { display: flex; }
    }

    /* Mobile menu overlay */
    .mobile-menu-overlay {
      display: none;
      position: fixed;
      inset: 0;
      z-index: 100;
      background: rgba(0,0,0,.6);
      backdrop-filter: blur(4px);
    }
    .mobile-menu-overlay.is-open { display: block; }

    .mobile-menu-panel {
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      width: min(85vw, 360px);
      z-index: 101;
      background: linear-gradient(180deg, #151b2c 0%, #0f172a 100%);
      border-left: 1px solid rgba(255,255,255,.08);
      transform: translateX(100%);
      transition: transform .3s ease;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      padding: 1.5rem;
    }
    .mobile-menu-panel.is-open { transform: translateX(0); }

    .mobile-menu-close {
      display: flex;
      justify-content: flex-end;
      margin-bottom: 1rem;
    }
    .mobile-menu-close button {
      background: none;
      border: none;
      color: #e5e7eb;
      padding: .5rem;
      cursor: pointer;
      min-width: 44px;
      min-height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .mobile-menu-section-label {
      font-size: .7rem;
      font-weight: 700;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: #64748b;
      padding: .6rem 0;
    }

    .mobile-menu-panel a,
    .mobile-menu-panel button {
      display: block;
      padding: .75rem 0;
      color: #e5e7eb;
      text-decoration: none;
      font-size: 1.05rem;
      font-weight: 600;
      transition: color .2s;
      background: none;
      border: none;
      text-align: left;
      font-family: inherit;
      cursor: pointer;
      width: 100%;
    }
    .mobile-menu-panel a:hover,
    .mobile-menu-panel button:hover {
      color: #fb923c;
    }
    .mobile-menu-panel a i,
    .mobile-menu-panel a svg.lucide {
      margin-right: .5rem;
      color: #fb923c;
      width: 1.2rem;
      height: 1.2rem;
      text-align: center;
    }

    .mobile-menu-panel .mobile-cta-btn {
      display: block;
      width: 100%;
      padding: 1rem;
      margin-top: 1rem;
      border-radius: 12px;
      font-weight: 800;
      font-size: 1rem;
      text-align: center;
      text-decoration: none;
      color: #fff;
      background: var(--cta-gradient);
      border: none;
      cursor: pointer;
      min-height: 56px;
      box-shadow: 0 14px 28px rgba(249, 115, 22, .24);
    }
  </style>
  @if($settings->google_analytics != '')
    {!! $settings->google_analytics !!}
  @endif
  <!-- Microsoft Clarity -->
  <script>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?ref=bwt";
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "xk78rrb386");
  </script>
  <script>
    // GA4 Event Tracking Helper
    function trackGA4Event(eventName, params) {
      if (typeof gtag === 'function') {
        gtag('event', eventName, params || {});
      }
    }
    // Track page category based on URL
    function getPageCategory() {
      var path = window.location.pathname;
      if (path === '/') return 'homepage';
      if (path.startsWith('/for-creators') || path.startsWith('/fans') || path.startsWith('/celebrities') || path.startsWith('/casting') || path.startsWith('/business') || path.startsWith('/support') || path.startsWith('/live-streams')) return 'marketing';
      if (path.startsWith('/login') || path.startsWith('/signup') || path.startsWith('/password')) return 'auth';
      if (path.startsWith('/explore') || path.startsWith('/creators')) return 'discovery';
      if (path.startsWith('/dashboard') || path.startsWith('/settings') || path.startsWith('/messages') || path.startsWith('/notifications')) return 'dashboard';
      if (path.startsWith('/contact') || path.startsWith('/faq')) return 'support';
      return 'other';
    }
    // Set page_category on every page
    if (typeof gtag === 'function') {
      gtag('set', { page_category: getPageCategory() });
    }
    // Track logged-in user
    @auth
      if (typeof gtag === 'function') {
        gtag('set', 'user_properties', { logged_in: 'true', user_id: '{{ auth()->id() }}' });
        gtag('set', { user_type: '{{ auth()->user()->role ?? "fan" }}' });
      }
    @endauth
  </script>
</head>
<body>
  <header class="public-shell-topbar">
    <div class="container inner">
      <a class="public-shell-brand" href="{{ url('/') }}" aria-label="{{ $settings->title }}">
        <img src="{{ url('public/img', auth()->check() && auth()->user()->dark_mode == 'on' ? $settings->logo : $settings->logo_2) }}" alt="{{ $settings->title }}">
      </a>
      <nav class="public-shell-nav d-none d-lg-flex" aria-label="Primary">
        <a class="@if(request()->is('for-creators')) active @endif" href="{{ url('for-creators') }}">For Creators</a>
        <a class="@if(request()->is('fans') || request()->is('fans/*')) active @endif" href="{{ url('fans') }}">For Fans</a>
        <a class="@if(request()->is('celebrities') || request()->is('celebrities/*')) active @endif" href="{{ url('celebrities') }}">Celebrities</a>
        <a class="@if(request()->is('explore') || request()->is('explore/*')) active @endif" href="{{ url('explore') }}">Explore</a>
        <details class="public-shell-more">
          <summary>More</summary>
          <div class="public-shell-nav-panel">
            <a href="{{ url('casting') }}">🎬 <span>Movie Casting</span></a>
            <a href="{{ url('live-streams') }}">🔴 <span>Live Streams</span></a>
            <a href="{{ url('business') }}">💼 <span>Business</span></a>
            <a href="{{ url('contact') }}">💬 <span>Support</span></a>
          </div>
        </details>
      </nav>
      <div class="public-shell-actions">
        @guest
          @if ($settings->registration_active == '1')
            <a class="btn btn-primary public-shell-button" style="background: var(--cta-gradient); background-image: var(--cta-gradient); border-color: transparent; box-shadow: 0 14px 28px rgba(249, 115, 22, .24);" href="{{ url('signup') }}">Get Started</a>
          @endif
          <a class="btn btn-outline-primary public-shell-button" href="{{ url('login') }}">{{ trans('auth.login') }}</a>
        @else
          <a class="btn btn-primary public-shell-button" href="{{ url('dashboard') }}">{{ trans('admin.dashboard') }}</a>
        @endguest
      </div>
      <button class="public-shell-hamburger" onclick="document.querySelector('.mobile-menu-overlay').classList.add('is-open');document.querySelector('.mobile-menu-panel').classList.add('is-open')" aria-label="Open menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
      </button>
    </div>
  </header>

  <!-- Mobile menu overlay -->
  <div class="mobile-menu-overlay" onclick="this.classList.remove('is-open');document.querySelector('.mobile-menu-panel').classList.remove('is-open')"></div>
  <div class="mobile-menu-panel">
    <div class="mobile-menu-close">
      <button onclick="document.querySelector('.mobile-menu-overlay').classList.remove('is-open');document.querySelector('.mobile-menu-panel').classList.remove('is-open')" aria-label="Close menu">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" x2="6" y1="6" y2="18"/><line x1="6" x2="18" y1="6" y2="18"/></svg>
      </button>
    </div>
    <div class="mobile-menu-section-label">Navigation</div>
    <a href="{{ url('for-creators') }}">For Creators</a>
    <a href="{{ url('fans') }}">For Fans</a>
    <a href="{{ url('celebrities') }}">Celebrities</a>
    <a href="{{ url('explore') }}">Explore</a>
    <div class="mobile-menu-section-label" style="margin-top:.5rem">More</div>
    <a href="{{ url('casting') }}">🎬 Movie Casting</a>
    <a href="{{ url('live-streams') }}">🔴 Live Streams</a>
    <a href="{{ url('business') }}">💼 Business</a>
    <a href="{{ url('contact') }}">💬 Support</a>
    @guest
      <a href="{{ url('login') }}" style="margin-top:1rem;color:#94a3b8;font-weight:600">Login</a>
      @if ($settings->registration_active == '1')
        <a href="{{ url('signup') }}" class="mobile-cta-btn">Get Started</a>
      @endif
    @else
      <a href="{{ url('dashboard') }}" class="mobile-cta-btn">Dashboard</a>
      <a href="{{ url('settings') }}" style="color:#94a3b8;font-weight:600">Settings</a>
      <a href="{{ url('logout') }}" style="color:#f87171;font-weight:600">Log out</a>
    @endguest
  </div>

  <main class="public-shell-content">
    @yield('content')
  </main>

  @php($firstSegment = request()->segment(1))
  @php($secondSegment = request()->segment(2))
  @php($hideFooterByDefault = ($firstSegment === 'login' || ($firstSegment === 'auth' && $secondSegment === 'login')))
  @if (!($hideFooterByDefault || $__env->yieldContent('hideFooter')))
  <footer class="public-shell-footer">
    <div class="container">
      <div class="footer-topline"></div>
      <div class="footer-grid" style="gap: 2rem;">
        <div class="footer-links">
          <h3 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: .75rem;">For Creators</h3>
          <a href="{{ url('signup') }}" style="font-size: .9rem;">Getting Started</a>
          <a href="{{ url('for-creators') }}" style="font-size: .9rem;">Personal Video Messages</a>
        </div>
        <div class="footer-links">
          <h3 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: .75rem;">Revenue Streams</h3>
          <a href="{{ url('for-creators') }}" style="font-size: .9rem;">Content Monetization</a>
          <a href="{{ url('for-creators') }}" style="font-size: .9rem;">Paid Phone Calls</a>
          <a href="{{ url('for-creators') }}" style="font-size: .9rem;">Text Coaching</a>
          <a href="{{ url('for-creators') }}" style="font-size: .9rem;">Video Consultations</a>
        </div>
        <div class="footer-links">
          <h3 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: .75rem;">Support</h3>
          <a href="{{ url('contact') }}" style="font-size: .9rem;">Help Center</a>
          <a href="{{ url('contact') }}" style="font-size: .9rem;">Contact Us</a>
          <a href="{{ url('for-creators') }}" style="font-size: .9rem;">Creator Resources</a>
          <a href="{{ url('contact') }}" style="font-size: .9rem;">Community</a>
        </div>
        <div class="footer-links">
          <h3 style="font-size: 1rem; font-weight: 700; color: #fff; margin-bottom: .75rem;">Advanced</h3>
          <a href="{{ url('business') }}#token" style="font-size: .9rem;">Token Ecosystem</a>
          <a href="{{ url('business') }}#presale" style="font-size: .9rem;">Presale Info</a>
        </div>
      </div>
      <div class="footer-bottomline"></div>
      <div class="footer-bottom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: .75rem; padding: .75rem 0;">
        <div style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">
          <span style="font-size: .85rem; color: #94a3b8;">© 2026 FansFollow.me. All rights reserved.</span>
          <span style="font-size: .85rem; color: #94a3b8;"><span class="btc-mark">₿</span> <strong>BTC/ETH/USDT/SOL Accepted</strong></span>
          <a href="{{ url('privacy') }}" style="font-size: .85rem; color: #94a3b8;">Privacy Policy</a>
          <span style="color: #4b5563;">•</span>
          <a href="{{ url('terms') }}" style="font-size: .85rem; color: #94a3b8;">Terms of Service</a>
          <span style="color: #4b5563;">•</span>
          <a href="{{ url('cookies') }}" style="font-size: .85rem; color: #94a3b8;">Cookie Policy</a>
          <span style="color: #4b5563;">•</span>
          <a href="{{ url('faq') }}" style="font-size: .85rem; color: #94a3b8;">FAQ</a>
        </div>
        <div style="display: flex; align-items: center; gap: .5rem; flex-wrap: wrap;">
          <span style="font-size: .85rem; color: #94a3b8;">Follow us:</span>
          <div class="footer-social" style="display: flex; gap: .5rem;" aria-label="Social links">
          @if($settings->facebook != '')<a href="{{ $settings->facebook }}" target="_blank" rel="noopener" aria-label="Facebook" style="color: #94a3b8;"><i class="fab fa-facebook-f"></i></a>@endif
          @if($settings->instagram != '')<a href="{{ $settings->instagram }}" target="_blank" rel="noopener" aria-label="Instagram" style="color: #94a3b8;"><i class="fab fa-instagram"></i></a>@endif
          @if($settings->youtube != '')<a href="{{ $settings->youtube }}" target="_blank" rel="noopener" aria-label="YouTube" style="color: #94a3b8;"><i class="fab fa-youtube"></i></a>@endif
          @if($settings->tiktok != '')<a href="{{ $settings->tiktok }}" target="_blank" rel="noopener" aria-label="TikTok" style="color: #94a3b8;"><i class="fab fa-tiktok"></i></a>@endif
          </div>
        </div>
      </div>
    </div>
  </footer>
  @endif

  @include('includes.javascript_general')
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  @yield('javascript')
  <script>
    lucide.createIcons();
    (function() {
      var bar = document.querySelector('.public-shell-topbar');
      if (!bar) return;
      function onScroll() {
        if (window.scrollY > 20) {
          bar.classList.add('scrolled');
        } else {
          bar.classList.remove('scrolled');
        }
      }
      window.addEventListener('scroll', onScroll, {passive: true});
      onScroll();
    })();
  </script>


  <!-- Basin Analytics -->
  <script type="text/javascript">
    function configureAhoy() {
      ahoy.configure({
        visitsUrl: "https://usebasin.com/ahoy/visits",
        eventsUrl: "https://usebasin.com/ahoy/events",
        page: "954d0d6e30da"
      });
      ahoy.trackView();
      ahoy.trackSubmits();
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/ahoy.js@0.3.9/dist/ahoy.min.js" async defer onload="configureAhoy()"></script>
  <script>
  if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register('/sw.js').catch(function() {});
  }
  </script>
</body>
</html>

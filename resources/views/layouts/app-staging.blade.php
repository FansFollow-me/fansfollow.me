<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta name="description" content="@yield('description_custom')@if(!Request::route()->named('seo') && !Request::route()->named('profile')){{trans('seo.description')}}@endif">
  <meta name="keywords" content="@yield('keywords_custom'){{ trans('seo.keywords') }}" />
  <meta name="theme-color" content="{{ auth()->check() && auth()->user()->dark_mode == 'on' ? '#303030' : $settings->color_default }}">
  <title>{{ auth()->check() && User::notificationsCount() ? '('.User::notificationsCount().') ' : '' }}@section('title')@show {{ $settings->title.' - '.__('seo.slogan') }}</title>

  <link href="{{ url('public/img', $settings->favicon) }}" rel="icon">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/css/all.min.css" rel="stylesheet">
  <link href="/assets/css/fontawesome.css" rel="stylesheet">
  <link href="/assets/css/owl.carousel.min.css" rel="stylesheet">
  <link href="/assets/css/style.css" rel="stylesheet">
  <link href="/assets/css/responsive.css" rel="stylesheet">
  @include('includes.css_general')
  @yield('css')

  <style>
    body.staging-auth-shell {
      background:
        radial-gradient(circle at top left, rgba(59, 130, 246, 0.24), transparent 36%),
        radial-gradient(circle at top right, rgba(14, 165, 233, 0.16), transparent 28%),
        linear-gradient(180deg, #050816 0%, #0b1220 42%, #0f172a 100%);
      color: #e5eefb;
      font-family: 'Inter', sans-serif;
    }

    .staging-shell-topbar {
      position: sticky;
      top: 0;
      z-index: 1040;
      background: rgba(7, 12, 24, 0.82);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(148, 163, 184, 0.12);
      box-shadow: 0 18px 40px rgba(2, 6, 23, 0.32);
    }

    .staging-shell-topbar .inner {
      min-height: 72px;
    }

    .staging-shell-brand img {
      display: block;
      width: auto;
      height: 30px;
    }

    .staging-shell-nav .nav-link {
      color: rgba(226, 232, 240, 0.82);
      font-weight: 600;
      padding: 0.55rem 0.8rem;
      border-radius: 999px;
    }

    .staging-shell-nav .nav-link:hover,
    .staging-shell-nav .nav-link.active {
      color: #ffffff;
      background: rgba(59, 130, 246, 0.18);
    }

    .staging-shell-button {
      border-radius: 999px;
      font-weight: 700;
      padding: 0.7rem 1rem;
      background: linear-gradient(135deg, #f97316, #9333ea) !important;
      border-color: transparent !important;
      color: #fff !important;
    }
    .staging-shell-button:hover {
      filter: brightness(1.1);
      box-shadow: 0 8px 20px rgba(249, 115, 22, 0.3);
    }

    .staging-shell-content {
      padding: 2rem 0 3rem;
    }

    .staging-shell-content .form-control,
    .staging-shell-content .form-select,
    .staging-shell-content select,
    .staging-shell-content input[type="text"],
    .staging-shell-content input[type="email"],
    .staging-shell-content input[type="password"],
    .staging-shell-content input[type="number"],
    .staging-shell-content input[type="date"],
    .staging-shell-content textarea {
      background: rgba(15, 23, 42, 0.6) !important;
      border: 1px solid rgba(148, 163, 184, 0.18) !important;
      color: #e2e8f0 !important;
      border-radius: 10px !important;
      padding: .65rem .85rem !important;
      transition: border-color .2s !important;
    }
    .staging-shell-content .form-control:focus,
    .staging-shell-content .form-select:focus,
    .staging-shell-content input:focus,
    .staging-shell-content textarea:focus {
      border-color: #f97316 !important;
      box-shadow: 0 0 0 .2rem rgba(249,115,22,.15) !important;
    }
    .staging-shell-content .form-control::placeholder,
    .staging-shell-content input::placeholder,
    .staging-shell-content textarea::placeholder {
      color: #64748b !important;
    }
    .staging-shell-content .form-label,
    .staging-shell-content label {
      color: #e2e8f0 !important;
      font-weight: 600 !important;
    }
    .staging-shell-content .input-group-text {
      background: rgba(15, 23, 42, 0.8) !important;
      border: 1px solid rgba(148, 163, 184, 0.18) !important;
      color: #94a3b8 !important;
    }

    .staging-shell-content .card {
      border: 1px solid rgba(148, 163, 184, 0.12);
      border-radius: 16px;
      box-shadow: 0 18px 46px rgba(2, 6, 23, 0.22);
      transition: all .3s ease;
    }
    .staging-shell-content .card:hover {
      border-color: rgba(249, 115, 22, 0.3);
      transform: translateY(-2px);
      box-shadow: 0 25px 50px rgba(249, 115, 22, 0.1);
    }

    .staging-shell-content .card-settings,
    .staging-shell-content .card,
    .staging-shell-content .list-group-item {
      background: rgba(15, 23, 42, 0.82);
      color: #e2e8f0;
    }

    .staging-shell-content .btn-primary,
    .staging-shell-content .btn-success {
      background: linear-gradient(135deg, #f97316, #9333ea) !important;
      border: none !important;
      color: #fff !important;
      border-radius: 10px !important;
      font-weight: 700 !important;
      transition: all .3s !important;
    }
    .staging-shell-content .btn-primary:hover,
    .staging-shell-content .btn-success:hover {
      filter: brightness(1.1);
      box-shadow: 0 8px 20px rgba(249,115,22,.3);
      transform: translateY(-1px);
    }
    .staging-shell-content .btn-danger {
      border-radius: 10px !important;
      font-weight: 700 !important;
    }

    .staging-shell-content .card-settings {
      border-radius: 16px;
      overflow: hidden;
    }

    .staging-shell-content .list-group-item {
      border-color: rgba(148, 163, 184, 0.12);
      padding-top: 0.9rem;
      padding-bottom: 0.9rem;
    }

    .staging-shell-content .list-group-item.active {
      background: rgba(59, 130, 246, 0.18);
      color: #ffffff;
      border-color: rgba(96, 165, 250, 0.48);
    }

    .staging-shell-content .section,
    .staging-shell-content .section-sm {
      padding-top: 0;
    }

    .staging-shell-content .jumbotron-cover-user {
      border-radius: 20px;
      overflow: hidden;
      padding: 0 !important;
      min-height: 280px;
      margin-bottom: 1.5rem !important;
      box-shadow: 0 18px 56px rgba(2, 6, 23, 0.24);
      background-color: #0f172a !important;
    }

    .staging-shell-content .jumbotron-cover-user:before {
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(2, 6, 23, 0.16), rgba(2, 6, 23, 0.66));
      z-index: 0;
    }

    .staging-shell-content .jumbotron-cover-user > * {
      position: relative;
      z-index: 1;
    }

    .staging-shell-content .img-profile-user {
      margin-top: -92px;
      position: relative;
    }

    .staging-shell-content .avatar-wrap,
    .staging-shell-content .avatar-wrap-live {
      width: 168px;
      height: 168px;
      border-radius: 50%;
      border: 8px solid rgba(15, 23, 42, 0.96);
      background: #0f172a;
      overflow: hidden;
    }

    .staging-shell-content .avatarUser {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .staging-shell-content .about-wrap,
    .staging-shell-content .profile-meta,
    .staging-shell-content .profile-actions {
      background: rgba(15, 23, 42, 0.82);
      border: 1px solid rgba(148, 163, 184, 0.12);
      border-radius: 16px;
      padding: 1.25rem;
      box-shadow: 0 18px 46px rgba(2, 6, 23, 0.2);
      color: #e2e8f0;
    }

    .staging-shell-content .about-wrap > h4 {
      display: none;
    }

    .staging-shell-content .avatar-content > h4 {
      margin-top: 1rem;
      font-size: 1.35rem;
      line-height: 1.15;
    }

    .staging-shell-content .section-msg,
    .staging-shell-content .wrapper-msg-inbox,
    .staging-shell-content .container-msg {
      background: transparent !important;
    }

    .staging-shell-content .wrapper-msg-inbox .card,
    .staging-shell-content .container-msg .card {
      border-radius: 16px;
      overflow: hidden;
    }

    .staging-shell-content .btn,
    .staging-shell-content .form-control,
    .staging-shell-content .custom-select {
      border-radius: 12px;
    }

    .staging-auth-grid {
      align-items: center;
      min-height: calc(100vh - 72px);
    }

    .staging-auth-panel {
      background: rgba(15, 23, 42, 0.84);
      border: 1px solid rgba(148, 163, 184, 0.12);
      border-radius: 20px;
      box-shadow: 0 18px 56px rgba(2, 6, 23, 0.26);
      overflow: hidden;
    }

    .staging-auth-panel .panel-media {
      background: linear-gradient(180deg, rgba(37, 99, 235, 0.94), rgba(15, 23, 42, 0.96));
      color: #ffffff;
      padding: 2rem;
      min-height: 100%;
    }

    .staging-auth-panel .panel-media h1,
    .staging-auth-panel .panel-media h2,
    .staging-auth-panel .panel-media p {
      color: #ffffff;
    }

    .staging-auth-panel .panel-media img {
      width: 100%;
      border-radius: 16px;
      box-shadow: 0 14px 42px rgba(15, 23, 42, 0.28);
    }

    .staging-auth-panel .panel-form {
      padding: 2rem;
    }

    .staging-auth-panel .panel-form .form-control,
    .staging-auth-panel .panel-form .input-group-text {
      border-color: rgba(148, 163, 184, 0.16);
      background: rgba(2, 6, 23, 0.32);
      color: #e2e8f0;
    }

    .staging-auth-panel .panel-form .btn {
      width: 100%;
    }

    .staging-shell-content .jumbotron {
      background: transparent;
      padding: 0;
    }

    .staging-shell-content .container {
      max-width: 1280px;
    }

    .staging-shell-sidebar {
      border: 1px solid rgba(148, 163, 184, 0.12);
      border-radius: 16px;
      background: rgba(15, 23, 42, 0.84);
      box-shadow: 0 18px 46px rgba(2, 6, 23, 0.2);
      padding: 1rem;
      position: sticky;
      top: 92px;
    }

    .staging-shell-sidebar a {
      color: rgba(226, 232, 240, 0.82);
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.6rem;
      padding: 0.7rem 0.8rem;
      border-radius: 10px;
      text-decoration: none;
    }

    .staging-shell-sidebar a:hover,
    .staging-shell-sidebar a.active {
      background: rgba(249, 115, 22, 0.14);
      color: #fb923c;
    }

    @media (max-width: 991.98px) {
      .staging-shell-topbar .inner {
        flex-wrap: wrap;
        gap: .75rem;
        padding: .8rem 0;
      }

      .staging-shell-brand img {
        height: 26px;
      }

      .staging-shell-topbar .d-flex.align-items-center {
        width: 100%;
        justify-content: flex-end;
        flex-wrap: wrap;
      }

      .staging-shell-topbar .d-flex.align-items-center .btn {
        flex: 1 1 0;
        min-width: 140px;
      }

      .staging-shell-content {
        padding: 1.25rem 0 2rem;
      }

      .staging-shell-sidebar {
        margin-bottom: 1rem;
        position: static;
      }
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
</head>

<body class="staging-auth-shell">
  @php($authBase = request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/auth' : '')

  <header class="staging-shell-topbar">
    <div class="container inner d-flex align-items-center justify-content-between gap-3">
      <a class="staging-shell-brand" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/' : url('/') }}">
        <img src="{{ url('public/img', $settings->logo_2) }}" alt="{{ $settings->title }}">
      </a>

      <nav class="staging-shell-nav d-none d-lg-flex align-items-center gap-1">
        <a class="nav-link @if(request()->path() == '/' || request()->is('app')) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/' : url('/') }}">{{ trans('admin.home') }}</a>
        <a class="nav-link @if(request()->is('creators') || request()->is('creators/*') || request()->is('app/creators')) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/creators' : url('creators') }}">{{ trans('general.explore_creators') }}</a>
        <a class="nav-link @if(request()->is('dashboard')) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/dashboard' : url('dashboard') }}">{{ trans('admin.dashboard') }}</a>
        @auth
          <a class="nav-link @if(request()->route()->named('profile') || request()->is(auth()->user()->username)) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/'.auth()->user()->username : url(auth()->user()->username) }}">{{ trans('general.profile') }}</a>
          @if (auth()->user()->role == 'admin')
            <a class="nav-link" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/panel/admin' : url('panel/admin') }}">{{ trans('admin.admin') }}</a>
          @endif
        @endauth
      </nav>

      <div class="d-flex align-items-center gap-2">
        @guest
          <a class="btn btn-outline-primary staging-shell-button" href="{{ $authBase.'/login' }}">{{ trans('auth.login') }}</a>
          @if ($settings->registration_active == '1')
            <a class="btn btn-primary staging-shell-button" href="{{ $authBase.'/signup' }}">{{ trans('auth.sign_up') }}</a>
          @endif
        @else
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle staging-shell-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ auth()->user()->username }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
              <li><a class="dropdown-item" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/dashboard' : url('dashboard') }}">{{ trans('admin.dashboard') }}</a></li>
              <li><a class="dropdown-item" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/creators' : url('creators') }}">{{ trans('general.explore_creators') }}</a></li>
              <li><a class="dropdown-item" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/'.auth()->user()->username : url(auth()->user()->username) }}">{{ trans('general.profile') }}</a></li>
              @if (auth()->user()->role == 'admin')
                <li><a class="dropdown-item" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/panel/admin' : url('panel/admin') }}">{{ trans('admin.admin') }}</a></li>
              @endif
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="{{ $authBase.'/logout' }}">{{ trans('auth.logout') }}</a></li>
            </ul>
          </div>
        @endguest
      </div>
    </div>
  </header>

  <main class="staging-shell-content" role="main">
    <div class="container">
      <div class="row">
        @auth
          <div class="col-lg-3">
            <aside class="staging-shell-sidebar mb-4 mb-lg-0">
              <div class="px-2 pb-2">
                <div class="small text-uppercase text-muted font-weight-bold">{{ trans('admin.account') }}</div>
                <div class="h5 mb-0">{{ auth()->user()->hide_name == 'yes' ? auth()->user()->username : auth()->user()->name }}</div>
              </div>
              <hr class="my-2">
              <a class="@if(request()->is('dashboard')) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/dashboard' : url('dashboard') }}"><i class="bi-speedometer2"></i> {{ trans('admin.dashboard') }}</a>
              <a class="@if(request()->is('creators') || request()->is('creators/*')) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/creators' : url('creators') }}"><i class="bi-compass"></i> {{ trans('general.explore_creators') }}</a>
              <a class="@if(request()->route()->named('profile') || request()->is(auth()->user()->username)) active @endif" href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/'.auth()->user()->username : url(auth()->user()->username) }}"><i class="bi-person"></i> {{ trans('general.profile') }}</a>
              <a href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/app/settings' : url('settings') }}"><i class="bi-sliders"></i> {{ trans('general.settings') }}</a>
              @if (auth()->user()->role == 'admin')
                <a href="{{ request()->server('FANSFOLLOW_STAGE') === 'staging_new' ? '/panel/admin' : url('panel/admin') }}"><i class="bi-shield-lock"></i> {{ trans('admin.admin') }}</a>
              @endif
              <a href="{{ $authBase.'/logout' }}"><i class="bi-box-arrow-right"></i> {{ trans('auth.logout') }}</a>
            </aside>
          </div>
          <div class="col-lg-9">
            @yield('content')
          </div>
        @else
          <div class="col-12">
            @yield('content')
          </div>
        @endauth
      </div>
    </div>
  </main>

  @include('includes.javascript_general')
  @yield('javascript')
  <script>
  (function(){
    document.addEventListener('DOMContentLoaded', function(){
      /* ── Toolbar row: touch/drag scroll + snap to group boundaries ── */
      document.querySelectorAll('trix-toolbar .trix-button-row').forEach(function(row){
        var dragging=false, startX=0, scrollStart=0;
        row.addEventListener('touchstart', function(e){
          dragging=true; startX=e.touches[0].pageX; scrollStart=row.scrollLeft;
        }, {passive:true});
        row.addEventListener('touchmove', function(e){
          if(!dragging) return;
          row.scrollLeft = scrollStart - (e.touches[0].pageX - startX);
        }, {passive:true});
        row.addEventListener('touchend', function(){ dragging=false; snapRow(row); }, {passive:true});
        row.addEventListener('mousedown', function(e){
          dragging=true; startX=e.pageX; scrollStart=row.scrollLeft; e.preventDefault();
        });
        window.addEventListener('mousemove', function(e){
          if(!dragging) return;
          row.scrollLeft = scrollStart - (e.pageX - startX);
        });
        window.addEventListener('mouseup', function(){ if(dragging){ dragging=false; snapRow(row); } });
        // Snap on scroll end
        var scrollTimer;
        row.addEventListener('scroll', function(){
          clearTimeout(scrollTimer);
          scrollTimer = setTimeout(function(){ snapRow(row); }, 80);
        });
        // Initial snap (delayed for Trix render)
        setTimeout(function(){ snapRow(row); }, 500);
        setTimeout(function(){ snapRow(row); }, 1500);
      });
      function snapRow(row){
        var groups = row.querySelectorAll('.trix-button-group');
        if(!groups.length) return;
        var rowW = row.clientWidth;
        var scrollL = row.scrollLeft;
        // Find the group boundary closest to current scroll position
        var best = 0, bestDist = Infinity;
        for(var i=0; i<groups.length; i++){
          var gLeft = groups[i].offsetLeft;
          var dist = Math.abs(gLeft - scrollL);
          if(dist < bestDist){ bestDist = dist; best = gLeft; }
        }
        // Also check if content fits without scroll
        if(row.scrollWidth <= rowW){ row.scrollLeft = 0; return; }
        // Snap to nearest group start
        row.scrollTo({ left: best, behavior: 'instant' });
      }
      /* ── Position Trix link dialog below toolbar ── */
      document.querySelectorAll('trix-toolbar').forEach(function(toolbar){
        var observer = new MutationObserver(function(){
          var dialog = toolbar.querySelector('.trix-dialog[data-trix-active]');
          if(dialog){
            var tbRect = toolbar.getBoundingClientRect();
            var linkBtn = toolbar.querySelector('[data-trix-attribute=href]');
            var btnRect = linkBtn ? linkBtn.getBoundingClientRect() : tbRect;
            if(window.innerWidth < 768){
              dialog.style.top='';dialog.style.left='';dialog.style.right='';dialog.style.bottom='0px';
              dialog.style.width='100%';dialog.style.borderRadius='14px 14px 0 0';
            } else {
              dialog.style.bottom='';dialog.style.width='';
              dialog.style.top=(tbRect.bottom+4)+'px';
              dialog.style.left=btnRect.left+'px';
            }
          }
        });
        observer.observe(toolbar, {attributes:true, subtree:true, attributeFilter:['data-trix-active']});
      });
    });
  })();
  </script>
</body>
</html>

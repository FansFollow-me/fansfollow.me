@if (request()->route() && request()->route()->named('profile'))
  @include('layouts.appnew')
@elseif (auth()->guest())
  @include('layouts.appnew')
@else
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('description_custom')@if(request()->route() && !Request::route()->named('seo') && !Request::route()->named('profile')){{trans('seo.description')}}@endif">
  <meta name="keywords" content="@yield('keywords_custom'){{ trans('seo.keywords') }}" />
  <meta name="theme-color" content="{{ auth()->check() && auth()->user()->dark_mode == 'on' ? '#303030' : $settings->color_default }}">
  <title>{{ auth()->check() && User::notificationsCount() ? '('.User::notificationsCount().') ' : '' }}@section('title')@show {{$settings->title.' - '.__('seo.slogan')}}</title>
  <script>
      /*!@shinsenter/defer.js@3.6.0*/
!(function(o,u,s){function f(t,n,e){k?S(t,n):((e=e===s?f.lazy:e)?N:C).push(t,Math.max(e?350:0,n))}function i(t){j.head.appendChild(t)}function a(t,n){t.forEach(function(t){n(t)})}function r(n,t,e,c){a(t.split(" "),function(t){(c||o)[n+"EventListener"](t,e||p)})}function l(t,n,e,c){return(c=n?j.getElementById(n):s)||(c=j.createElement(t),n&&(c.id=n)),e&&r(g,b,e,c),c}function d(t,n){a(q.call(t.attributes),function(t){n(t.name,t.value)})}function h(t,n){return q.call((n||j).querySelectorAll(t))}function m(c,t){a(h("source,img",c),m),d(c,function(t,n,e){(e=/^data-(.+)/.exec(t))&&c[x](e[1],n)}),t&&(c.className+=" "+t),c[b]&&c[b]()}function t(t,n,e){f(function(n){a(n=h(t||"script[type=deferjs]"),function(t,e){t.src&&(e=l(v),d(t,function(t,n){t!=A&&e[x]("src"==t?"href":t,n)}),e.rel="preload",e.as=y,i(e))}),(function c(t,e){(t=n[E]())&&(e=l(y),d(t,function(t,n){t!=A&&e[x](t,n)}),e.text=t.text,t.parentNode.replaceChild(e,t),e.src&&!e.getAttribute("async")?r(g,b+" error",c,e):c())})()},n,e)}function p(t,n){for(n=k?(r(e,c),N):(r(e,w),k=f,N[0]&&r(g,c),C);n[0];)S(n[E](),n[E]())}var v="link",y="script",b="load",n="pageshow",g="add",e="remove",c="touchstart mousemove mousedown keydown wheel",w="on"+n in o?n:b,x="setAttribute",E="shift",A="type",I=o.IntersectionObserver,j=o.document||o,k=/p/.test(j.readyState),C=[],N=[],S=o.setTimeout,q=C.slice;f.all=t,f.dom=function(t,n,o,i,r){f(function(e){function c(t){i&&!1===i(t)||m(t,o)}e=I?new I(function(t){a(t,function(t,n){t.isIntersecting&&(e.unobserve(n=t.target),c(n))})},r):s,a(h(t||"[data-src]"),function(t){t[u]||(t[u]=f,e?e.observe(t):c(t))})},n,!1)},f.css=function(n,e,t,c,o){f(function(t){(t=l(v,e,c)).rel="stylesheet",t.href=n,i(t)},t,o)},f.js=function(n,e,t,c,o){f(function(t){(t=l(y,e,c)).src=n,i(t)},t,o)},f.reveal=m,o[u]=f,k||r(g,w),t()})(this,"Defer");
  </script>
  
  <!-- Favicon -->
  <link href="{{ url('public/img', $settings->favicon) }}" rel="icon">

  <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/fontawesome.min.css') }}" rel="stylesheet">
  <link href="{{ asset('public/css/core.min.css') }}?v={{$settings->version}}" rel="stylesheet">
  <link href="{{ asset('public/css/styles.css') }}?v={{$settings->version}}" rel="stylesheet">
  <link href="{{ asset('public/videojs/skins/nuevo/videojs.min.css') }}" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

  @include('includes.css_general')

  @if ($settings->status_pwa)
    @laravelPWA
  @endif

  @yield('css')

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

<body>
  @if ($settings->disable_banner_cookies == 'off')
  <div class="btn-block text-center showBanner padding-top-10 pb-3 display-none">
    <i class="fa fa-cookie-bite"></i> {{trans('general.cookies_text')}}
    @if ($settings->link_cookies != '')
      <a href="{{$settings->link_cookies}}" class="mr-2 text-white link-border" target="_blank">{{ trans('general.cookies_policy') }}</a>
    @endif
    <button class="btn btn-sm btn-primary" id="close-banner">{{trans('general.go_it')}}
    </button>
  </div>
@endif

  <div id="mobileMenuOverlay" data-toggle="collapse" data-target="#navbarCollapse"></div>

  @auth
    @if (! request()->is('messages') && ! request()->is('messages/*') && ! request()->is('live/*'))
    @include('includes.menu-mobile')
  @endif
  @endauth

  @if ($settings->alert_adult == 'on')
    <div class="modal fade" tabindex="-1" id="alertAdult">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-body p-4">
          <p>{{ __('general.alert_content_adult') }}</p>
        </div>
        <div class="modal-footer border-0 pt-0">
          <a href="https://google.com" class="btn e-none p-0 mr-3">{{trans('general.leave')}}</a>
          <button type="button" class="btn btn-primary" id="btnAlertAdult">{{trans('general.i_am_age')}}</button>
        </div>
      </div>
    </div>
  </div>
  @endif


  <div class="popout popout-error font-default"></div>

@if (auth()->guest() && request()->path() == '/' && $settings->home_style == 0
    || auth()->guest() && request()->path() != '/' && $settings->home_style == 0
    || auth()->guest() && request()->path() != '/' && $settings->home_style == 1
    || auth()->check()
    )
  @include('includes.navbar')
  @endif

  <main @if (request()->is('messages/*') || request()->is('live/*')) class="h-100" @endif role="main">
    @yield('content')

    @if (auth()->guest() && (!request()->route() || ! request()->route()->named('profile'))
          || auth()->check()
          && request()->path() != '/'
          && ! request()->is('my/bookmarks')
          && ! request()->is('my/likes')
          && ! request()->is('my/purchases')
          && ! request()->is('explore')
          && (!request()->route() || ! request()->route()->named('profile'))
          && ! request()->is('messages')
          && ! request()->is('messages/*')
          && ! request()->is('live/*')
          )

          @if (auth()->guest() && request()->path() == '/' && $settings->home_style == 0
                || auth()->guest() && request()->path() != '/' && $settings->home_style == 0
                || auth()->guest() && request()->path() != '/' && $settings->home_style == 1
                || auth()->check()
                  )

                  @if (auth()->guest() && $settings->who_can_see_content == 'users')
                    <div class="text-center py-3 px-3">
                      @include('includes.footer-tiny')
                    </div>
                  @else
                    @include('includes.footer')
                  @endif

          @endif

  @endif

  @guest

      @include('includes.modal-login')
  @endguest

  @auth

    @if ($settings->disable_tips == 'off')
     @include('includes.modal-tip')
   @endif

    @include('includes.modal-payperview')

    @if ($settings->live_streaming_status == 'on')
      @include('includes.modal-live-stream')
    @endif
    
  @endauth

  @guest
    @include('includes.modal-2fa')
  @endguest
</main>

  <script type="text/javascript">
    var URL_BASE = "{{ url('/') }}";
    var stripeKey = "{{ $settings->stripe_key ?? '' }}";
    var maxSizeInMb = {{ $settings->max_upload_size ?? 10 }};
    var url_file_upload = "{{ route('upload.image', ['_token' => csrf_token()]) }}";
    var delete_confirm = "{{ trans('general.delete_confirm') }}";
    var confirm_delete_update = "{{ trans('general.confirm_delete_update') }}";
    var yes_confirm = "{{ trans('general.yes_confirm') }}";
    var yes = "{{ trans('general.yes') }}";
    var cancel_confirm = "{{ trans('general.cancel_confirm') }}";
    var timezone = "{{ config('app.timezone') }}";
    var add_tag = "{{ trans('general.add_tag') }}";
    var choose_image = "{{ trans('general.choose_image') }}";
    var cancel_payment = "{!! trans('general.confirm_cancel_payment') !!}";
    var yes_cancel_payment = "{{ trans('general.yes_cancel_payment') }}";
    var maximum_files_post = {{ $settings->maximum_files_post ?? 5 }};
    var maximum_files_msg = {{ $settings->maximum_files_msg ?? 5 }};
    var extensionsPostMessage = ['image/*','video/*','audio/*'];
    var color_default = "{{ $settings->color_default ?? '#450ea7' }}";
    var user_count_carousel = {{ $settings->number_creators_home ?? 3 }};
    var session_status = "{{ $settings->session_status ?? 'off' }}";
    var ReadMore = "{{ trans('general.read_more') }}";
    var error_scrollelement = false;
    var alert_adult = {{ $settings->alert_adult == 'on' ? 'true' : 'false' }};
    var no_results_found = "{{ trans('general.no_results_found') }}";
    var show_only_free = "{{ trans('general.show_only_free') }}";
    var error_occurred = "{{ trans('general.error_occurred') }}";
    var error_oops = "{{ trans('general.error_oops') }}";
    var ok = "{{ trans('users.ok') }}";
    var confirm_delete_conversation = "{{ trans('general.confirm_delete_conversation') }}";
    var confirm_delete_message = "{{ trans('general.confirm_delete_message') }}";
    var error_reload_page = "{{ trans('general.error_reload_page') }}";
    var lang = {
      remove: "{{ trans('general.delete') }}",
      download: "{{ trans('general.download') }}",
    };
    var formats_available = "{{ trans('general.formats_available_verification_form_w9', ['formats' => 'JPG, PNG, GIF, SVG']) }}";
    var announcement_cookie = {{ auth()->check() ? auth()->id() : 0 }};
  </script>

  @include('includes.javascript_general')

  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.min.js"></script>
  <script>lucide.createIcons();</script>

  @yield('javascript')

@auth
  <div id="bodyContainer"></div>
@endauth
</body>
</html>
@endif

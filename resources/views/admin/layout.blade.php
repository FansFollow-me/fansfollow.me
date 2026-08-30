<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ url('public/img', $settings->favicon) }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <title>FansFollow.me Admin</title>

    @include('includes.css_admin')

    <script type="text/javascript">
      var URL_BASE = "{{ url('/') }}";
      var url_file_upload = "{{route('upload.image', ['_token' => csrf_token()])}}";
      var delete_confirm = "{{trans('general.delete_confirm')}}";
      var yes_confirm = "{{trans('general.yes_confirm')}}";
      var yes = "{{trans('general.yes')}}";
      var cancel_confirm = "{{trans('general.cancel_confirm')}}";
      var timezone = "{{config('app.timezone')}}";
      var add_tag = "{{ trans("general.add_tag") }}";
      var choose_image = '{{trans('general.choose_image')}}';
      var formats_available = "{{ trans('general.formats_available_verification_form_w9', ['formats' => 'JPG, PNG, GIF, SVG']) }}";
      var cancel_payment = "{!!trans('general.confirm_cancel_payment')!!}";
      var yes_cancel_payment = "{{trans('general.yes_cancel_payment')}}";
      var approve_confirm_verification = "{{trans('admin.approve_confirm_verification')}}";
      var yes_confirm_approve_verification = "{{trans('admin.yes_confirm_approve_verification')}}";
      var yes_confirm_verification = "{{trans('admin.yes_confirm_verification')}}";
      var delete_confirm_verification = "{{trans('admin.delete_confirm_verification')}}";
      var login_as_user_warning = "{{trans('general.login_as_user_warning')}}";
      var yes_confirm_reject_post = "{{trans('general.yes_confirm_reject_post')}}";
      var delete_confirm_post = "{{trans('general.delete_confirm_post')}}";
      var yes_confirm_approve_post = "{{trans('general.yes_confirm_approve_post')}}";
      var approve_confirm_post = "{{trans('general.approve_confirm_post')}}";
      var yes_confirm_refund = "{{trans('general.refund')}}";
     </script>

    <style>
     :root {
       --color-default: #000000;
    }

    body.fansfollow-backoffice-shell {
      min-height: 100vh;
      background:
        radial-gradient(circle at top left, rgba(59, 130, 246, 0.24), transparent 34%),
        radial-gradient(circle at top right, rgba(14, 165, 233, 0.16), transparent 28%),
        linear-gradient(180deg, #050816 0%, #0b1220 42%, #0f172a 100%);
      font-family: 'Inter', sans-serif;
      color: #e5eefb;
    }

    body.fansfollow-backoffice-shell main {
      min-height: 100vh;
    }

    .admin-shell-title {
      display: flex;
      flex-direction: column;
      gap: .15rem;
      line-height: 1.1;
    }

    .admin-shell-title strong {
      font-size: 1rem;
      color: #f8fafc;
    }

    .admin-shell-title span {
      font-size: .82rem;
      color: rgba(226, 232, 240, 0.72);
    }

    .sidebar {
      border-right: 1px solid rgba(148, 163, 184, 0.12);
      background: rgba(15, 23, 42, 0.88) !important;
      box-shadow: 0 18px 46px rgba(2, 6, 23, 0.24);
      color: #e2e8f0;
    }

    .offcanvas-body {
      padding-top: 0.25rem;
    }

    .list-sidebar .nav-link {
      border-radius: 12px;
      font-weight: 600;
      padding: 0.75rem 0.9rem;
      color: rgba(226, 232, 240, 0.84);
    }

    .list-sidebar .nav-link:hover,
    .list-sidebar .nav-link.active {
      background: rgba(59, 130, 246, 0.18);
      color: #ffffff;
    }

    main {
      min-height: 100vh;
    }

    main > .container,
    main > .container-fluid {
      padding-top: 1.5rem;
      padding-bottom: 2.5rem;
    }

    .card {
      border: 1px solid rgba(148, 163, 184, 0.12);
      border-radius: 14px;
      box-shadow: 0 18px 46px rgba(2, 6, 23, 0.18);
      background: rgba(15, 23, 42, 0.84);
      color: #e2e8f0;
    }

    .btn,
    .form-control,
    .custom-select,
    .dropdown-menu {
      border-radius: 12px;
    }

    .table {
      color: #e2e8f0;
    }

    .admin-shell-header {
      position: sticky;
      top: 0;
      z-index: 1050;
    }

    .admin-shell-header .dropdown-menu {
      z-index: 1060;
      position: absolute;
    }

    .admin-shell-header .dropdown {
      position: relative;
      z-index: 1060;
    }

    .admin-mobile-brand {
      display: none;
      align-items: center;
      gap: .75rem;
      width: 100%;
      padding: .85rem 1rem;
      margin-bottom: .75rem;
      border-radius: 18px;
      background: linear-gradient(135deg, rgba(15, 23, 42, .96), rgba(30, 41, 59, .92));
      border: 1px solid rgba(148, 163, 184, .18);
      box-shadow: 0 14px 40px rgba(15, 23, 42, .18);
    }

    .admin-mobile-brand img {
      width: 44px;
      height: 44px;
      object-fit: contain;
      flex-shrink: 0;
    }

    .admin-mobile-brand__text {
      display: flex;
      flex-direction: column;
      gap: .15rem;
      line-height: 1.1;
    }

    .admin-mobile-brand__text strong {
      font-size: .98rem;
      color: #fff;
    }

    .admin-mobile-brand__text span {
      font-size: .78rem;
      color: #cbd5e1;
    }

    @media (max-width: 991.98px) {
      body {
        background: linear-gradient(180deg, #0f172a, #f4f7fb 36%);
      }

      .admin-shell-header {
        background: linear-gradient(180deg, rgba(15, 23, 42, .98), rgba(2, 6, 23, .92));
      }

      .admin-shell-header .container-fluid {
        justify-content: flex-start;
        display: flex !important;
        flex-wrap: wrap;
        gap: 0 !important;
      }

      .admin-shell-header .d-flex {
        width: 100%;
        padding: .5rem 0;
      }

      .admin-mobile-brand {
        display: flex;
        width: 100%;
        margin-bottom: 0;
        padding: .6rem .75rem;
        border-radius: 12px;
      }

      .admin-shell-header .dropdown-menu {
        position: absolute;
        right: 0;
        left: auto;
        transform: translateX(0);
      }

      .admin-container {
        padding: 1rem !important;
      }

      main > .container-fluid {
        padding-top: .5rem;
      }
    }
     </style>

    @yield('css')
  </head>
  <?php $isStagingDesign = false; ?>
<body class="fansfollow-backoffice-shell">
  <div class="overlay" data-bs-toggle="offcanvas" data-bs-target="#sidebar-nav"></div>
  <div class="popout font-default"></div>

    <main>

      @php($adminBase = url('panel/admin'))
  <div class="offcanvas offcanvas-start sidebar bg-transparent text-light" tabindex="-1" id="sidebar-nav" data-bs-keyboard="false" data-bs-backdrop="false">
      <div class="offcanvas-header border-bottom">
          <h5 class="offcanvas-title d-flex align-items-center gap-3"><img src="{{ url('public/img', $settings->logo_2) }}" width="96" alt="{{ $settings->title }}" /><div class="admin-shell-title"><strong>{{ $settings->title }}</strong><span>Admin panel</span></div></h5>
          <button type="button" class="btn-close btn-close-custom text-dark toggle-menu d-lg-none" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="bi bi-x-lg"></i>
          </button>
      </div>
      <div class="offcanvas-body px-0 scrollbar">
          <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start list-sidebar" id="menu">

              @if (auth()->user()->hasPermission('dashboard'))
              <li class="nav-item">
                  <a href="{{ $adminBase }}" class="nav-link text-truncate @if (request()->is('panel/admin')) active @endif">
                      <i class="bi-speedometer2 me-2"></i> {{ __('admin.dashboard') }}
                  </a>
              </li><!-- /end list -->
            @endif

              @if (auth()->user()->hasPermission('general'))
              <li class="nav-item">
                  <a href="#settings" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle @if (request()->is('panel/admin/settings') ||request()->is('panel/admin/settings/limits')) active @endif" @if (request()->is('panel/admin/settings') ||request()->is('panel/admin/settings/limits')) aria-expanded="true" @endif>
                      <i class="bi-gear me-2"></i> {{ __('admin.general_settings') }}
                  </a>
              </li><!-- /end list -->
            @endif

              <div class="collapse w-100 @if (request()->is('panel/admin/settings') || request()->is('panel/admin/settings/limits')) show @endif ps-3" id="settings">
                <li>
                <a class="nav-link text-truncate w-100 @if (request()->is('panel/admin/settings')) text-white @endif" href="{{ $adminBase.'/settings' }}">
                  <i class="bi-chevron-right fs-7 me-1"></i> {{ trans('admin.general') }}
                  </a>
                </li>
                <li>
                <a class="nav-link text-truncate @if (request()->is('panel/admin/settings/limits')) text-white @endif" href="{{ $adminBase.'/settings/limits' }}">
                  <i class="bi-chevron-right fs-7 me-1"></i> {{ trans('admin.limits') }}
                  </a>
                </li>
              </div><!-- /end collapse settings -->

              @if (auth()->user()->hasPermission('announcements'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/announcements' }}" class="nav-link text-truncate @if (request()->is('panel/admin/announcements')) active @endif">
                      <i class="bi-megaphone me-2"></i> {{ __('general.announcements') }}
                  </a>
              </li><!-- /end list -->
            @endif

              @if (auth()->user()->hasPermission('maintenance'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/maintenance/mode' }}" class="nav-link text-truncate @if (request()->is('panel/admin/maintenance/mode')) active @endif">
                      <i class="bi bi-tools me-2"></i> {{ __('admin.maintenance_mode') }}
                  </a>
              </li><!-- /end list -->
            @endif

            @if (auth()->user()->hasPermission('billing'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/billing' }}" class="nav-link text-truncate @if (request()->is('panel/admin/billing')) active @endif">
                      <i class="bi-receipt-cutoff me-2"></i> {{ __('general.billing_information') }}
                  </a>
              </li><!-- /end list -->
            @endif

                @if (auth()->user()->hasPermission('tax'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/tax-rates' }}" class="nav-link text-truncate @if (request()->is('panel/admin/tax-rates')) active @endif">
                      <i class="bi-receipt me-2"></i> {{ __('general.tax_rates') }}
                  </a>
              </li><!-- /end list -->
            @endif

            @if (auth()->user()->hasPermission('countries_states'))
              <li class="nav-item">
                  <a href="#countriesStates" data-bs-toggle="collapse"  class="nav-link text-truncate dropdown-toggle @if (request()->is('panel/admin/countries') || request()->is('panel/admin/states')) active @endif" @if (request()->is('panel/admin/countries') || request()->is('panel/admin/states')) aria-expanded="true" @endif>
                      <i class="bi-globe me-2"></i> {{ __('general.countries_states') }}
                  </a>
              </li><!-- /end list -->
              @endif

              <div class="collapse w-100 @if (request()->is('panel/admin/countries') || request()->is('panel/admin/states')) show @endif ps-3" id="countriesStates">
                <li class="nav-item">
                    <a href="{{ $adminBase.'/countries' }}" class="nav-link text-truncate w-100 @if (request()->is('panel/admin/countries')) text-white @endif">
                        <i class="bi-chevron-right fs-7 me-1"></i> {{ __('general.countries') }}
                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="{{ $adminBase.'/states' }}" class="nav-link text-truncate w-100 @if (request()->is('panel/admin/states')) text-white @endif">
                        <i class="bi-chevron-right fs-7 me-1"></i> {{ __('general.states') }}
                    </a>
                </li><!-- /end list -->
              </div><!-- /end collapse settings -->

              @if (auth()->user()->hasPermission('email'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/settings/email' }}" class="nav-link text-truncate @if (request()->is('panel/admin/settings/email')) active @endif">
                      <i class="bi-at me-2"></i> {{ __('admin.email_settings') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('live_streaming'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/live-streaming' }}" class="nav-link text-truncate @if (request()->is('panel/admin/live-streaming')) active @endif">
                      <i class="bi-camera-video me-2"></i> {{ __('general.live_streaming') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('push_notifications'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/push-notifications' }}" class="nav-link text-truncate @if (request()->is('panel/admin/push-notifications')) active @endif">
                      <i class="bi-app-indicator me-2"></i> {{ __('general.push_notifications') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('stories'))
              <li class="nav-item">
                  <a href="#stories" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle @if (request()->is('panel/admin/stories/settings') || request()->is('panel/admin/stories/posts') || request()->is('panel/admin/stories/backgrounds')) active @endif" @if (request()->is('panel/admin/stories/settings') || request()->is('panel/admin/stories/posts') || request()->is('panel/admin/stories/backgrounds') || request()->is('panel/admin/stories/fonts')) aria-expanded="true" @endif>
                      <i class="bi-clock-history me-2"></i> {{ __('general.stories') }}
                  </a>
              </li><!-- /end list -->
              @endif

              <div class="collapse w-100 @if (request()->is('panel/admin/stories/settings') || request()->is('panel/admin/stories/posts') || request()->is('panel/admin/stories/backgrounds') || request()->is('panel/admin/stories/fonts')) show @endif ps-3" id="stories">
                <li class="nav-item">
                    <a href="{{ $adminBase.'/stories/settings' }}" class="nav-link text-truncate w-100 @if (request()->is('panel/admin/stories/settings')) text-white @endif">
                        <i class="bi-chevron-right fs-7 me-1"></i> {{ __('general.settings') }}
                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="{{ $adminBase.'/stories/posts' }}" class="nav-link text-truncate w-100 @if (request()->is('panel/admin/stories/posts')) text-white @endif">
                        <i class="bi-chevron-right fs-7 me-1"></i> {{ __('general.posts') }}
                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="{{ $adminBase.'/stories/backgrounds' }}" class="nav-link text-truncate w-100 @if (request()->is('panel/admin/stories/backgrounds')) text-white @endif">
                        <i class="bi-chevron-right fs-7 me-1"></i> {{ __('general.backgrounds') }}
                    </a>
                </li><!-- /end list -->
                <li class="nav-item">
                    <a href="{{ $adminBase.'/stories/fonts' }}" class="nav-link text-truncate w-100 @if (request()->is('panel/admin/stories/fonts')) text-white @endif">
                        <i class="bi-chevron-right fs-7 me-1"></i> {{ __('general.google_fonts') }}
                    </a>
                </li><!-- /end list -->
              </div><!-- /end collapse settings -->

              @if (auth()->user()->hasPermission('shop'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/shop' }}" class="nav-link text-truncate @if (request()->is('panel/admin/shop')) active @endif">
                      <i class="bi-shop-window me-2"></i> {{ __('general.shop') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('products'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/products' }}" class="nav-link text-truncate @if (request()->is('panel/admin/products')) active @endif">
                      <i class="bi-tag me-2"></i> {{ __('general.products') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('shop_categories'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/shop-categories' }}" class="nav-link text-truncate @if (request()->is('panel/admin/shop-categories')) active @endif">
                      <i class="bi-list-ul me-2"></i> {{ __('general.shop_categories') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('sales'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/sales' }}" class="nav-link text-truncate @if (request()->is('panel/admin/sales')) active @endif">
                      <i class="bi-cart me-2"></i> {{ __('general.sales') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('storage'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/storage' }}" class="nav-link text-truncate @if (request()->is('panel/admin/storage')) active @endif">
                      <i class="bi-server me-2"></i> {{ __('admin.storage') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('theme'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/theme' }}" class="nav-link text-truncate @if (request()->is('panel/admin/theme')) active @endif">
                      <i class="bi-brush me-2"></i> {{ __('admin.theme') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('custom_css_js'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/custom-css-js' }}" class="nav-link text-truncate @if (request()->is('panel/admin/custom-css-js')) active @endif">
                      <i class="bi-code-slash me-2"></i> {{ __('general.custom_css_js') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('posts'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/posts' }}" class="nav-link text-truncate @if (request()->is('panel/admin/posts')) active @endif">
                      <i class="bi-pencil-square me-2"></i>

                      @if (Updates::whereStatus('pending')->count() <> 0)
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      @endif

                      {{ __('general.posts') }}
                  </a>
              </li><!-- /end list -->
              @endif

            @if (auth()->user()->hasPermission('subscriptions'))
            <li class="nav-item">
                <a href="{{ $adminBase.'/subscriptions' }}" class="nav-link text-truncate @if (request()->is('panel/admin/subscriptions')) active @endif">
                    <i class="bi-arrow-repeat me-2"></i> {{ __('admin.subscriptions') }}
                </a>
            </li><!-- /end list -->
            @endif

              @if (auth()->user()->hasPermission('transactions'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/transactions' }}" class="nav-link text-truncate @if (request()->is('panel/admin/transactions')) active @endif">
                      <i class="bi-receipt me-2"></i> {{ __('admin.transactions') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('deposits'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/deposits' }}" class="nav-link text-truncate @if (request()->is('panel/admin/deposits')) active @endif">
                      <i class="bi-cash-stack me-2"></i>

                      @if (Deposits::whereStatus('pending')->count() <> 0)
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      @endif

                      {{ __('general.deposits') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('members'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/members' }}" class="nav-link text-truncate @if (request()->is('panel/admin/members')) active @endif">
                      <i class="bi-people me-2"></i> {{ __('admin.members') }}
                  </a>
              </li><!-- /end list -->
              @endif
              <!--My Changes-->
              @if (auth()->user()->hasPermission('creator_status'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/creator_status' }}" class="nav-link text-truncate @if (request()->is('panel/admin/members/creator_status')) active @endif">
                      <i class="fa fa-light fa-signal me-2"></i>{{ __('Creator Status') }}
                  </a>
              </li><!-- /end list -->
            @endif
              @if (auth()->user()->hasPermission('referrals'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/referrals' }}" class="nav-link text-truncate @if (request()->is('panel/admin/referrals')) active @endif">
                      <i class="bi-person-plus me-2"></i> {{ __('general.referrals') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('languages'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/languages' }}" class="nav-link text-truncate @if (request()->is('panel/admin/languages')) active @endif">
                      <i class="bi-translate me-2"></i> {{ __('admin.languages') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('categories'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/categories' }}" class="nav-link text-truncate @if (request()->is('panel/admin/categories')) active @endif">
                      <i class="bi-list-stars me-2"></i> {{ __('admin.categories') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('reports'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/reports' }}" class="nav-link text-truncate @if (request()->is('panel/admin/reports')) active @endif">
                      <i class="bi-flag me-2"></i> 

                      @if (Reports::first())
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      @endif
                      
                      {{ __('admin.reports') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('withdrawals'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/withdrawals' }}" class="nav-link text-truncate @if (request()->is('panel/admin/withdrawals')) active @endif">
                      <i class="bi-bank me-2"></i>

                      @if (Withdrawals::whereStatus('pending')->count() <> 0)
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      @endif

                      {{ __('general.withdrawals') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('verification_requests'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/verification/members' }}" class="nav-link text-truncate @if (request()->is('panel/admin/verification/members')) active @endif">
                      <i class="bi-person-badge me-2"></i>

                      @if (VerificationRequests::whereStatus('pending')->count() <> 0)
                        <i class="bi-circle-fill small text-warning alert-admin"></i>
                      @endif

                      {{ __('admin.verification_requests') }}
                  </a>
              </li><!-- /end list -->
            @endif

              @if (auth()->user()->hasPermission('pages'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/pages' }}" class="nav-link text-truncate @if (request()->is('panel/admin/pages')) active @endif">
                      <i class="bi-file-earmark-text me-2"></i> {{ __('admin.pages') }}
                  </a>
              </li><!-- /end list -->
                @endif

                @if (auth()->user()->hasPermission('blog'))
                <li class="nav-item">
                    <a href="{{ $adminBase.'/blog' }}" class="nav-link text-truncate @if (request()->is('panel/admin/blog')) active @endif">
                        <i class="bi-pencil me-2"></i> {{ __('general.blog') }}
                    </a>
                </li><!-- /end list -->
                  @endif

                @if (auth()->user()->hasPermission('payments'))
              <li class="nav-item">
                  <a href="#payments" data-bs-toggle="collapse" class="nav-link text-truncate dropdown-toggle @if (request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')) active @endif" @if (request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')) aria-expanded="true" @endif>
                      <i class="bi-credit-card me-2"></i> {{ __('admin.payment_settings') }}
                  </a>
              </li><!-- /end list -->

              <div class="collapse w-100 ps-3 @if (request()->is('panel/admin/payments') || request()->is('panel/admin/payments/*')) show @endif" id="payments">
                <li>
                <a class="nav-link text-truncate @if (request()->is('panel/admin/payments')) text-white @endif" href="{{ $adminBase.'/payments' }}">
                  <i class="bi-chevron-right fs-7 me-1"></i> {{ trans('admin.general') }}
                  </a>
                </li>

                @foreach (PaymentGateways::all() as $key)
                <li>
                <a class="nav-link text-truncate @if (request()->is('panel/admin/payments/'.$key->id.'')) text-white @endif" href="{{ $adminBase.'/payments/'.$key->id }}">
                  <i class="bi-chevron-right fs-7 me-1"></i> {{ $key->type == 'bank' ? trans('general.bank_transfer') : $key->name }}
                  </a>
                </li>
              @endforeach
              </div><!-- /end collapse settings -->
              @endif

              @if (auth()->user()->hasPermission('profiles_social'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/profiles-social' }}" class="nav-link text-truncate @if (request()->is('panel/admin/profiles-social')) active @endif">
                      <i class="bi-share me-2"></i> {{ __('admin.profiles_social') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('social_login'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/social-login' }}" class="nav-link text-truncate @if (request()->is('panel/admin/social-login')) active @endif">
                      <i class="bi-facebook me-2"></i> {{ __('admin.social_login') }}
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('google'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/google' }}" class="nav-link text-truncate @if (request()->is('panel/admin/google')) active @endif">
                      <i class="bi-google me-2"></i> Google
                  </a>
              </li><!-- /end list -->
              @endif

              @if (auth()->user()->hasPermission('pwa'))
              <li class="nav-item">
                  <a href="{{ $adminBase.'/pwa' }}" class="nav-link text-truncate @if (request()->is('panel/admin/pwa')) active @endif">
                      <i class="bi-phone me-2"></i> PWA
                  </a>
              </li><!-- /end list -->
              @endif

          </ul>
          <div class="mt-auto px-3 pb-3 d-lg-none">
            <hr class="border-secondary">
            <a href="{{ url(auth()->user()->username) }}" class="nav-link text-truncate text-light mb-2">
              <i class="bi-person me-2"></i> {{ __('users.my_profile') }}
            </a>
            <a href="{{ url('settings') }}" class="nav-link text-truncate text-light mb-2">
              <i class="bi-pencil me-2"></i> {{ __('general.edit_my_page') }}
            </a>
            <a href="{{ url('logout') }}" class="nav-link text-truncate text-danger">
              <i class="bi-box-arrow-in-right me-2"></i> {{ __('users.logout') }}
            </a>
          </div>
      </div>
  </div>

  <header class="py-3 mb-3 shadow-custom bg-white admin-shell-header">

    <div class="container-fluid d-grid gap-3 px-4 justify-content-end position-relative">

      <div class="admin-mobile-brand d-lg-none">
        <a class="toggle-menu d-inline-flex align-items-center justify-content-center me-2" data-bs-toggle="offcanvas" data-bs-target="#sidebar-nav" href="#" style="width:40px;height:40px;border-radius:10px;background:rgba(255,255,255,.1);">
          <i class="bi-list text-white fs-4"></i>
        </a>
        <img src="{{ url('public/img', $settings->logo_2) }}" alt="{{ $settings->title }}" />
        <div class="admin-mobile-brand__text">
          <strong>{{ $settings->title }}</strong>
          <span>Admin panel</span>
        </div>
      </div>

      <div class="d-flex align-items-center justify-content-between w-100">

        <a class="text-dark ms-2 animate-up-2 me-4 d-none d-lg-inline" href="{{ url('/') }}">
        {{ trans('admin.view_site') }} <i class="bi-arrow-up-right"></i>
        </a>

        <div class="dropdown">
          <button class="btn d-flex align-items-center gap-2 dropdown-toggle" type="button" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false" style="padding:.35rem .75rem;border-radius:10px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);color:#e2e8f0;">
           <img src="{{ Helper::getFile(config('path.avatar').auth()->user()->avatar) }}" width="28" height="28" class="rounded-circle">
           <span class="d-none d-sm-inline" style="font-size:.85rem;">{{ auth()->user()->username }}</span>
          </button>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser2" style="background:#1e293b;border:1px solid rgba(255,255,255,.1);border-radius:12px;box-shadow:0 10px 40px rgba(0,0,0,.4);">
            <li><a class="dropdown-item" href="{{ url(auth()->user()->username) }}" style="color:#e2e8f0;padding:.6rem 1rem;">
              <i class="bi-person me-2"></i> {{ __('users.my_profile') }}
            </a></li>
            <li><a class="dropdown-item" href="{{ url('settings') }}" style="color:#e2e8f0;padding:.6rem 1rem;">
              <i class="bi-pencil me-2"></i> {{ __('general.edit_my_page') }}
            </a></li>
            <li><hr class="dropdown-divider" style="border-color:rgba(255,255,255,.1);"></li>
            <li><a class="dropdown-item" href="{{ url('logout') }}" style="color:#f87171;padding:.6rem 1rem;">
              <i class="bi-box-arrow-in-right me-2"></i> {{ __('users.logout') }}
            </a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <div class="container-fluid">
      <div class="row">
          <div class="col min-vh-100 admin-container p-4">
              @yield('content')
          </div>
      </div>
  </div>

  <footer class="admin-footer px-4 py-3 bg-white shadow-custom">
    &copy; {{ $settings->title }} v{{$settings->version}} - {{ date('Y') }}
  </footer>

</main>

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="{{ asset('public/js/core.min.js') }}?v={{$settings->version}}"></script>
    <script src="{{ asset('public/admin/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/js/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('public/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('public/admin/admin-functions.js') }}?v={{$settings->version}}"></script>

    @yield('javascript')

    @if (session('success_update'))
      <script type="text/javascript">
          swal({
            title: "{{ session('success_update') }}",
            type: "success",
            confirmButtonText: "{{ trans('users.ok') }}"
            });
        </script>
    	 @endif

		 @if (session('unauthorized'))
       <script type="text/javascript">
    		swal({
    			title: "{{ trans('general.error_oops') }}",
    			text: "{{ session('unauthorized') }}",
    			type: "error",
    			confirmButtonText: "{{ trans('users.ok') }}"
    			});
          </script>
   		 @endif
     </body>
</html>

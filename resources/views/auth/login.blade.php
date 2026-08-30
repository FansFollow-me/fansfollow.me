@extends('layouts.appnew')

@section('title'){{ __('auth.login') }} -@endsection
@section('description_custom')FansFollow.me login for creators, fans, celebrities, and admins. Access the live creator platform with your existing account.@endsection

@section('css')
  <style>
    .auth-hero {
      position: relative;
      font-family: 'Inter', sans-serif;
      overflow: hidden;
      min-height: calc(100svh - 76px);
      display: flex;
      align-items: center;
      background-color: #020617;
      background-image: url('/ffmherobackground-1280.jpg');
      background-position: center top;
      background-size: cover;
      background-repeat: no-repeat;
      color: #e5e7eb;
    }
    .auth-hero::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(2,6,23,.46), rgba(2,6,23,.82));
      z-index: 0;
      pointer-events: none;
    }
    .auth-shell {
      position: relative;
      z-index: 1;
      width: 100%;
      padding: 4.75rem 0 4.5rem;
    }
    .auth-stage {
      width: 100%;
      max-width: 520px;
      margin: 0 auto;
      transform: translateY(60px);
    }
    .auth-hero-copy {
      text-align: center;
      margin-bottom: 1.2rem;
    }
    .auth-home-link {
      display: inline-flex;
      align-items: center;
      gap: .45rem;
      color: #fb923c;
      font-size: .84rem;
      font-weight: 700;
      margin-bottom: .75rem;
    }
    .auth-home-link .auth-home-arrow {
      color: #f97316;
      font-size: 1.05rem;
      line-height: .98;
    }
    .auth-home-link:hover {
      color: #fff;
    }
    .auth-kicker {
      color: #fb923c;
      text-transform: uppercase;
      letter-spacing: .12em;
      font-size: .76rem;
      font-weight: 800;
      margin-bottom: .6rem;
    }
    .auth-heading {
      margin: 0 0 .2rem;
      color: #fff;
      font-size: clamp(1.45rem, 1.95vw, 1.95rem);
      line-height: 1;
      letter-spacing: -.03em;
    }
    .auth-subheading {
      margin: 0 0 1.45rem;
      color: #cbd5e1;
      font-size: .87rem;
      line-height: 1.4;
      max-width: 36rem;
    }
    .auth-card {
      background: rgba(10,15,26,.65);
      backdrop-filter: blur(16px);
      color: #e5e7eb;
      border: 1px solid rgba(148,163,184,.12);
      border-radius: 20px;
      box-shadow: 0 18px 46px rgba(0,0,0,.26);
      overflow: hidden;
      max-width: 500px;
      margin: 0 auto;
      margin-top: .15rem;
    }
    .auth-card__body {
      padding: 1.05rem 1.1rem 1.15rem;
    }
    .auth-card__title {
      margin: 0;
      color: #fff;
      font-size: 1.02rem;
      line-height: 1.2;
    }
    .auth-card__subtitle {
      margin: .35rem 0 1.15rem;
      color: #94a3b8;
      line-height: 1.55;
    }
    .auth-alert {
      border-radius: 11px;
      font-size: .95rem;
    }
    .auth-form .form-label {
      color: #f8fafc;
      font-size: .8rem;
      font-weight: 700;
      margin-bottom: .35rem;
    }
    .auth-form .input-group-text,
    .auth-form .form-control {
      border-radius: 11px;
      min-height: 42px;
    }
    .auth-form .form-control {
      border-color: #334155;
      background: #0f172a;
      color: #e5e7eb;
    }
    .auth-form .form-control::placeholder {
      color: #94a3b8;
    }
    .auth-form .form-control:focus {
      box-shadow: 0 0 0 .2rem rgba(249,115,22,.16);
      border-color: #fb923c;
    }
    .auth-form .btn {
      border-radius: 11px;
      min-height: 44px;
      font-weight: 700;
    }
    .auth-form .btn-primary {
      background: linear-gradient(135deg, #f97316, #a855f7);
      border-color: transparent;
      color: #fff;
      box-shadow: 0 12px 30px rgba(168,85,247,.18);
    }
    .auth-form .btn-primary:hover {
      filter: brightness(1.06);
      box-shadow: 0 16px 34px rgba(249,115,22,.18);
      transform: translateY(-1px);
    }
    .auth-login-meta {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 1rem;
      margin-top: .9rem;
      color: #cbd5e1;
      font-size: .84rem;
      text-align: center;
      flex-wrap: wrap;
    }
    .auth-login-meta a {
      color: #fdba74;
      font-weight: 600;
    }
    .auth-login-meta a:hover {
      color: #fff;
    }
    .auth-forgot-btn {
      background: rgba(255,255,255,.04);
      border: 1px solid rgba(255,255,255,.12);
      color: #f8fafc;
      font-size: .8rem;
      min-height: 34px;
      padding: .35rem .85rem;
      border-radius: 999px;
    }
    .auth-forgot-btn:hover {
      background: rgba(255,255,255,.08);
      border-color: rgba(255,255,255,.2);
      color: #fff;
    }
    .auth-inline-error {
      background: rgba(148,163,184,.12);
      border: 1px solid rgba(148,163,184,.18);
      color: #e2e8f0;
      border-radius: 12px;
      padding: .85rem 1rem;
      margin-bottom: 1rem;
      font-size: .88rem;
      line-height: 1.45;
    }
    .auth-inline-error ul {
      margin: .5rem 0 0;
      padding-left: 1.1rem;
    }
    .auth-inline-error li {
      margin: .15rem 0;
    }
    .auth-or { display: none; }
    @media (max-width: 767.98px) {
      .auth-shell { padding: 1.5rem 0 2rem; }
      .auth-stage { transform: translateY(28px); }
      .auth-card__body { padding: 1.1rem; }
      .auth-login-meta {
        flex-direction: column;
        align-items: flex-start;
      }
    }
  </style>
@endsection

@section('content')
  <section class="auth-hero">
    <div class="auth-shell">
      <div class="container">
        <div class="auth-stage">
          <a class="auth-home-link" href="{{ url('/') }}"><span class="auth-home-arrow">&larr;</span> Back to Home</a>
          <div class="auth-hero-copy">
            <h1 class="auth-heading">Login to continue</h1>
            <p class="auth-subheading">Welcome back to FansFollow</p>
          </div>

          <div class="auth-card">
            <div class="auth-card__body">
              @if (count($errors) > 0)
                <div class="auth-inline-error" id="dangerAlert">
                  {{ trans('auth.error_desc') }}
                  <ul class="list-unstyled">
                    @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif

              @if (! $settings->disable_login_register_email || request()->route()->named('login.admin'))
                <form method="POST" action="{{ url('login') }}" id="authLoginForm" enctype="multipart/form-data" class="auth-form" onsubmit="trackGA4Event('login', {method: 'email'});">
                  @csrf
                  <input type="hidden" name="return" value="{{ count($errors) > 0 ? old('return') : url()->previous() }}">

                  <div class="form-group mb-3">
                    <label for="authLoginEmail" class="form-label">Email</label>
                    <div class="input-group input-group-alternative">
                      <input id="authLoginEmail" class="form-control" required value="{{ old('username_email') }}" placeholder="Your email address" name="username_email" type="text" autocomplete="username">
                    </div>
                  </div>

                  <div class="form-group mb-2">
                    <label for="authLoginPassword" class="form-label">Password</label>
                    <div class="input-group input-group-alternative" id="showHidePassword">
                      <input id="authLoginPassword" name="password" required type="password" class="form-control" placeholder="Your password" autocomplete="current-password">
                    </div>
                  </div>

                  <div class="custom-control custom-control-alternative custom-checkbox mt-3">
                    <input class="custom-control-input" id="customCheckLogin" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="custom-control-label" for="customCheckLogin">
                      <span>{{ __('auth.remember_me') }}</span>
                    </label>
                  </div>

                  <div class="auth-inline-error d-none mb-0 mt-3" id="errorLogin">
                    <ul class="list-unstyled m-0" id="showErrorsLogin"></ul>
                  </div>

                  <div class="text-center">
                    <button id="authLoginButton" type="submit" class="btn btn-primary mt-4 w-100" style="background: var(--cta-gradient); background-image: var(--cta-gradient); border-color: transparent; box-shadow: 0 14px 28px rgba(249,115,22,.24);">
                      {{ __('auth.login') }}
                    </button>
                  </div>
                </form>
              @endif

              <div class="auth-login-meta">
                @if ($settings->registration_active == '1')
                  <span>Don't have an account? <a href="{{ url('signup') }}">Sign up here</a></span>
                @endif
                <a href="{{ url('password/reset') }}" class="btn btn-outline-primary btn-sm auth-forgot-btn">Forgot Password?</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

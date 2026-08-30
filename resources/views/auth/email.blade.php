@extends('layouts.app')

@section('title') {{trans('auth.password_recover')}} -@endsection

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
      background: rgba(10,15,26,.88);
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
      .auth-shell { padding: 2.25rem 0 3rem; }
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
@php($isStaging = request()->server('FANSFOLLOW_STAGE') === 'staging_new')
@php($authAction = $isStaging ? '/auth/password/email' : url('password/email'))
<section class="auth-hero">
  <div class="auth-shell">
    <div class="container">
      <div class="auth-stage">
        <a class="auth-home-link" href="{{ url('/') }}"><span class="auth-home-arrow">&larr;</span> Back to Home</a>
        <div class="auth-hero-copy">
          <div class="auth-kicker">FansFollow.me</div>
          <h1 class="auth-heading">{{ trans('auth.password_recover') }}</h1>
          <p class="auth-subheading">{{ trans('auth.recover_pass_subtitle') }}</p>
        </div>

        <div class="auth-card">
          <div class="auth-card__body">
            @if (session('status'))
              <div class="alert alert-success auth-alert">{{ session('status') }}</div>
            @endif

            @include('errors.errors-forms')

            <form method="POST" action="{{ $authAction }}" class="auth-form">
              @csrf

              @if($settings->captcha == 'on')
                @if (! $isStaging)
                  @captcha
                @endif
              @endif

              <div class="form-group mb-3">
                <label class="form-label">{{ trans('auth.email') }}</label>
                <div class="input-group input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                  </div>
                  <input class="form-control @if (count($errors) > 0) is-invalid @endif" value="{{ old('email') }}" placeholder="{{ trans('auth.email') }}" name="email" required type="email">
                </div>
              </div>

              <button type="submit" class="btn btn-primary w-100">{{ trans('auth.send_pass_reset') }}</button>
            </form>

            <div class="auth-footer-row">
              <a href="{{ $isStaging ? '/auth/login' : url('login') }}"><i class="fas fa-arrow-left mr-1"></i>{{ trans('general.go_back') }}</a>
              <a href="{{ $isStaging ? '/auth/login' : url('login') }}">{{ trans('auth.login') }}</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

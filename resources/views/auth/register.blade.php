@extends('layouts.appnew')

@section('hideFooter', true)

@section('title')Sign Up - {{ $settings->title }}@endsection
@section('description_custom')Create your account on FansFollow.me. Join the #1 global fitness and martial arts creator platform.@endsection

@section('css')
<style>
  .signup-hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background:
      linear-gradient(180deg, rgba(11,15,26,.45), rgba(11,15,26,.75)),
      image-set(url('/ffmherobackground.jpg') 1x, url('/ffmherobackground-1280.jpg') 1.5x);
    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
    padding: 6rem 1rem 3rem;
  }
  .signup-container { max-width: 28rem; width: 100%; }
  .signup-back {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #fb923c;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 1.5rem;
    transition: color .2s;
  }
  .signup-back:hover { color: #fff; }
  .signup-title {
    font-size: 2rem;
    font-weight: 700;
    color: #fff;
    text-align: center;
    margin-bottom: .5rem;
  }
  .signup-subtitle {
    text-align: center;
    color: #94a3b8;
    font-size: .95rem;
    margin-bottom: 2rem;
  }
  .signup-card {
    background: rgba(15,23,42,.55);
    backdrop-filter: blur(16px);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 1.25rem;
    padding: 2rem;
  }
  .signup-role-label {
    color: #e5e7eb;
    font-weight: 600;
    margin-bottom: .75rem;
    font-size: .9rem;
  }
  .signup-role-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .75rem;
    margin-bottom: 1.5rem;
  }
  .signup-role-card {
    border: 2px solid rgba(255,255,255,.1);
    border-radius: .75rem;
    padding: 1rem;
    text-align: center;
    cursor: pointer;
    transition: all .2s;
    background: rgba(15,23,42,.4);
  }
  .signup-role-card:hover {
    border-color: rgba(255,255,255,.2);
    background: rgba(255,255,255,.05);
  }
  .signup-role-card.selected {
    border-color: #9333ea;
    background: rgba(147,51,234,.1);
  }
  .signup-role-icon {
    font-size: 1.5rem;
    margin-bottom: .25rem;
  }
  .signup-role-name {
    font-weight: 700;
    color: #fff;
    font-size: .95rem;
  }
  .signup-role-card.selected .signup-role-name { color: #c084fc; }
  .signup-role-desc {
    color: #64748b;
    font-size: .8rem;
    margin-top: .25rem;
  }
  .signup-field { margin-bottom: 1.25rem; }
  .signup-label {
    display: block;
    color: #e5e7eb;
    font-weight: 600;
    font-size: .85rem;
    margin-bottom: .4rem;
  }
  .signup-input {
    width: 100%;
    padding: .75rem 1rem;
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: .75rem;
    color: #fff;
    font-size: .95rem;
    outline: none;
    transition: border-color .2s;
  }
  .signup-input::placeholder { color: #64748b; }
  .signup-input:focus { border-color: #9333ea; }
  .signup-input-with-prefix {
    display: flex;
    align-items: center;
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: .75rem;
    overflow: hidden;
  }
  .signup-input-prefix {
    padding: .75rem .75rem .75rem 1rem;
    color: #64748b;
    font-weight: 600;
    font-size: .95rem;
    border-right: 1px solid rgba(255,255,255,.08);
  }
  .signup-input-with-prefix .signup-input {
    border: none;
    background: transparent;
  }
  .signup-input-with-prefix:focus-within { border-color: #9333ea; }
  .signup-password-wrap {
    position: relative;
  }
  .signup-password-toggle {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #64748b;
    cursor: pointer;
    padding: .25rem;
  }
  .signup-hint {
    color: #64748b;
    font-size: .78rem;
    margin-top: .35rem;
  }
  .signup-checkbox {
    display: flex;
    align-items: flex-start;
    gap: .75rem;
    margin-bottom: 1.5rem;
  }
  .signup-checkbox input[type="checkbox"] {
    width: 1.1rem;
    height: 1.1rem;
    margin-top: .15rem;
    accent-color: #9333ea;
    flex-shrink: 0;
  }
  .signup-checkbox label {
    color: #94a3b8;
    font-size: .85rem;
    line-height: 1.4;
  }
  .signup-checkbox a {
    color: #fb923c;
    text-decoration: none;
    font-weight: 600;
  }
  .signup-checkbox a:hover { color: #fff; }
  .signup-submit {
    width: 100%;
    padding: .85rem;
    background: linear-gradient(135deg, #f97316, #9333ea);
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    border: none;
    border-radius: .75rem;
    cursor: pointer;
    transition: all .3s;
  }
  .signup-submit:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 20px rgba(249,115,22,.2);
  }
  .signup-footer-text {
    text-align: center;
    margin-top: 1.5rem;
    color: #94a3b8;
    font-size: .9rem;
  }
  .signup-footer-text a {
    color: #fb923c;
    font-weight: 600;
    text-decoration: none;
  }
  .signup-footer-text a:hover { color: #fff; }
  .signup-error {
    background: rgba(239,68,68,.1);
    border: 1px solid rgba(239,68,68,.2);
    color: #fca5a5;
    border-radius: .75rem;
    padding: .75rem 1rem;
    margin-bottom: 1rem;
    font-size: .85rem;
  }
  .signup-error ul { margin: .25rem 0 0; padding-left: 1.25rem; }
  @media (max-width: 767.98px) {
    .signup-hero { padding: 4rem 1rem 2rem; }
  }
</style>
@endsection

@section('content')
<section class="signup-hero">
  <div class="signup-container">
    <a href="{{ url('/') }}" class="signup-back">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
      Back to Home
    </a>

    <h1 class="signup-title">Create your account</h1>
    <p class="signup-subtitle">Join the #1 global fitness &amp; martial arts platform</p>

    <div class="signup-card">
      @if(session('status'))
        <div class="signup-error">{{ session('status') }}</div>
      @endif

      @if($errors->any())
        <div class="signup-error">
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ url('signup') }}" id="signupForm" onsubmit="trackGA4Event('sign_up', {method: 'email'});">
        @csrf

        @if($settings->captcha == 'on')
          @captcha
        @endif

        <div class="signup-role-label">I want to join as:</div>
        <div class="signup-role-grid">
          <div class="signup-role-card selected" onclick="selectRole('fan', this)" data-role="fan">
            <div class="signup-role-icon">👤</div>
            <div class="signup-role-name">Fan</div>
            <div class="signup-role-desc">Connect with creators</div>
          </div>
          <div class="signup-role-card" onclick="selectRole('creator', this)" data-role="creator">
            <div class="signup-role-icon">🎬</div>
            <div class="signup-role-name">Creator</div>
            <div class="signup-role-desc">Start earning money</div>
          </div>
        </div>
        <input type="hidden" name="role_type" id="roleType" value="fan">

        <div class="signup-field">
          <label class="signup-label">Full Name</label>
          <input class="signup-input" type="text" name="name" value="{{ old('name') }}" placeholder="Your full name" required autocomplete="name">
        </div>

        <div class="signup-field">
          <label class="signup-label">Username</label>
          <div class="signup-input-with-prefix">
            <span class="signup-input-prefix">@</span>
            <input class="signup-input" type="text" name="username" value="{{ old('username') }}" placeholder="Choose a username" autocomplete="username">
          </div>
        </div>

        <div class="signup-field">
          <label class="signup-label">Email</label>
          <input class="signup-input" type="email" name="email" value="{{ old('email') }}" placeholder="Your email address" required autocomplete="email">
        </div>

        <div class="signup-field">
          <label class="signup-label">Password</label>
          <div class="signup-password-wrap">
            <input class="signup-input" type="password" name="password" id="password" placeholder="Create a password" required style="padding-right:3rem;" autocomplete="new-password">
            <button type="button" class="signup-password-toggle" onclick="togglePassword()">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="eyeIcon"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
            </button>
          </div>
          <div class="signup-hint">Password must be at least 6 characters long</div>
        </div>

        <div class="signup-checkbox">
          <input type="checkbox" id="agreeTerms" name="agree_gdpr" required>
          <label for="agreeTerms">I agree to the <a href="{{ url('/terms') }}">Terms of Service</a> and <a href="{{ url('/privacy') }}">Privacy Policy</a></label>
        </div>

        <button type="submit" class="signup-submit" id="submitBtn">Create Account</button>
      </form>

      <div class="signup-footer-text">
        Already have an account? <a href="{{ url('login') }}">Sign in here</a>
      </div>
    </div>
  </div>
</section>

<script>
function selectRole(role, el) {
  document.querySelectorAll('.signup-role-card').forEach(c => c.classList.remove('selected'));
  el.classList.add('selected');
  document.getElementById('roleType').value = role;
  var btn = document.getElementById('submitBtn');
  btn.textContent = role === 'creator' ? 'Create Creator Account' : 'Create Fan Account';
}

function togglePassword() {
  var input = document.getElementById('password');
  var icon = document.getElementById('eyeIcon');
  if (input.type === 'password') {
    input.type = 'text';
    icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
  } else {
    input.type = 'password';
    icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
  }
}
</script>
@endsection

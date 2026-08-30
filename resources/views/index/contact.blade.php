@extends('layouts.app')

@section('title') {{trans('general.contact')}} - @endsection

@section('css')
<script type="text/javascript">
  var error_scrollelement = {{ count($errors) > 0 ? 'true' : 'false' }};
</script>
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #a855f7 100%); }

  /* ── Hero ── */
  .contact-hero {
    padding: 6rem 0 3rem;
    text-align: center;
    color: #e5e7eb;
  }
  .contact-badge {
    display: inline-flex; align-items: center; gap: .4rem; padding: .4rem 1rem;
    border-radius: 999px; background: linear-gradient(135deg, rgba(245,158,11,.2), rgba(249,115,22,.2));
    border: 1px solid rgba(245,158,11,.3); color: #fbbf24;
    font-size: .75rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 1.5rem;
  }
  .contact-hero h1 { font-size: clamp(2rem, 3.5vw, 3rem); font-weight: 900; color: #fff; margin-bottom: .25rem; }
  .contact-hero .gradient { background: var(--home-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .contact-hero > p { font-size: 1.05rem; color: #94a3b8; max-width: 600px; margin: 0 auto 2rem; line-height: 1.7; }

  /* ── Sections ── */
  .section-dark { padding: 2.5rem 0; }
  .section-gradient { background: linear-gradient(to bottom, rgba(15,23,42,.4), rgba(17,24,39,.6)); }

  /* ── Contact method cards ── */
  .contact-options { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; max-width: 1100px; margin: 0 auto 2.5rem; }
  .contact-option {
    background: linear-gradient(135deg, rgba(31,41,55,.7), rgba(15,23,42,.8));
    backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,.12); border-radius: 16px;
    padding: 1.5rem; text-align: center;
    transition: all .3s ease; box-shadow: 0 10px 15px -3px rgba(0,0,0,.15), 0 4px 6px -4px rgba(0,0,0,.1), 0 0 20px rgba(249,115,22,.06);
  }
  .contact-option:hover { transform: translateY(-4px) scale(1.02); border-color: rgba(249,115,22,.4); box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 30px rgba(249,115,22,.2); }
  .contact-option-icon { width: 48px; height: 48px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .75rem; color: #fff; font-size: 1.25rem; }
  .contact-option-icon svg.lucide { width: 1.25rem; height: 1.25rem; }
  .contact-option h4 { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: .3rem; }
  .contact-option p { color: #94a3b8; font-size: .85rem; margin-bottom: 1rem; line-height: 1.5; }

  /* ── Form ── */
  .contact-form-section {
    border-top: 3px solid;
    border-image: linear-gradient(135deg, #f97316, #ec4899) 1;
    background: linear-gradient(to right bottom, rgba(31,41,55,.5), rgba(17,24,39,.6));
  }
  .form-section-heading { text-align: center; color: #fff; font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 800; margin-bottom: .5rem; }
  .form-section-sub { text-align: center; color: #94a3b8; max-width: 600px; margin: 0 auto 2rem; font-size: 1rem; line-height: 1.7; }

  .form-card {
    background: rgba(15,23,42,.65); border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px; padding: 2rem; max-width: 700px; margin: 0 auto;
  }
  .form-card .form-group { margin-bottom: 1rem; }
  .form-card label { display: block; color: #e2e8f0; font-size: .85rem; font-weight: 600; margin-bottom: .3rem; }
  .form-card .form-control {
    width: 100%; padding: .6rem .85rem; border-radius: 10px;
    border: 1px solid rgba(148,163,184,.18); background: rgba(15,23,42,.6);
    color: #e2e8f0; font-size: .9rem; transition: border-color .2s;
  }
  .form-card .form-control:focus { border-color: #f97316; outline: none; box-shadow: 0 0 0 2px rgba(249,115,22,.15); background: rgba(15,23,42,.8); }
  .form-card .form-control::placeholder { color: #64748b; }
  .form-card textarea.form-control { min-height: 120px; resize: vertical; }

  .form-card .custom-checkbox { margin-bottom: 1rem; }
  .form-card .custom-checkbox label { display: flex; align-items: center; gap: .5rem; font-size: .85rem; color: #94a3b8; cursor: pointer; }
  .form-card .custom-checkbox input[type="checkbox"] { width: 18px; height: 18px; accent-color: #f97316; cursor: pointer; }
  .form-card .custom-checkbox a { color: #fb923c; text-decoration: underline; }

  .form-card .captcha-note { color: #64748b; font-size: .8rem; text-align: center; margin-top: .75rem; }
  .form-card .captcha-note a { color: #94a3b8; }

  .form-success { background: rgba(16,185,129,.15); border: 1px solid rgba(16,185,129,.3); border-radius: 12px; padding: 1rem; color: #4ade80; text-align: center; margin-bottom: 1rem; font-size: .9rem; }
  .form-error { background: rgba(239,68,68,.15); border: 1px solid rgba(239,68,68,.3); border-radius: 12px; padding: 1rem; color: #f87171; margin-bottom: 1rem; font-size: .85rem; }
  .form-error ul { margin: 0; padding-left: 1.25rem; }

  /* ── Buttons ── */
  .cta-btn {
    display: inline-flex; align-items: center; justify-content: center; gap: .5rem;
    width: 100%; padding: .85rem 2rem; border-radius: 12px;
    background: var(--home-gradient); color: #fff; border: none;
    font-weight: 700; font-size: 1rem; cursor: pointer;
    transition: all .3s; box-shadow: 0 14px 28px rgba(249,115,22,.24);
  }
  .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 20px 30px rgba(249,115,22,.3); }

  @media (max-width: 768px) { .contact-options { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<section class="contact-hero">
  <div class="container">
    <div class="contact-badge">🛟 SUPPORT CENTER</div>
    <h1>We're Here to Help <span class="gradient">Support Center</span></h1>
    <p>Get the support you need to succeed on FansFollow. Our team is available to help you maximize your earnings and grow your community.</p>
  </div>
</section>

<section class="section-dark section-gradient">
  <div class="container">
    <div class="contact-options">
      <div class="contact-option">
        <div class="contact-option-icon" style="background:linear-gradient(135deg,#f97316,#ec4899);"><i data-lucide="message-circle"></i></div>
        <h4>Live Chat Support</h4>
        <p>Connect with our support team</p>
        <a class="cta-btn" href="#" style="width:auto;padding:.6rem 1.25rem;font-size:.9rem;">Start Chat</a>
      </div>
      <div class="contact-option">
        <div class="contact-option-icon" style="background:linear-gradient(135deg,#ec4899,#a855f7);"><i data-lucide="mail"></i></div>
        <h4>Email Support</h4>
        <p>support@fansfollow.me</p>
        <a class="cta-btn" href="mailto:support@fansfollow.me" style="width:auto;padding:.6rem 1.25rem;font-size:.9rem;">Send Email</a>
      </div>
      <div class="contact-option">
        <div class="contact-option-icon" style="background:linear-gradient(135deg,#a855f7,#3b82f6);"><i data-lucide="help-circle"></i></div>
        <h4>Help Center</h4>
        <p>Browse guides and resources</p>
        <a class="cta-btn" href="#" style="width:auto;padding:.6rem 1.25rem;font-size:.9rem;">View Guides</a>
      </div>
      <div class="contact-option">
        <div class="contact-option-icon" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);"><i data-lucide="users"></i></div>
        <h4>Creator Community</h4>
        <p>Join our Discord</p>
        <a class="cta-btn" href="#" style="width:auto;padding:.6rem 1.25rem;font-size:.9rem;">Join Discord</a>
      </div>
    </div>
  </div>
</section>

<section class="section-dark contact-form-section">
  <div class="container">
    <h2 class="form-section-heading">Send Us a Message</h2>
    <p class="form-section-sub">Fill out the form below and we'll get back to you as soon as possible.</p>

    <div class="form-card">
      @if (session('notification'))
        <div class="form-success">{{ session('notification') }}</div>
      @endif

      @if ($errors->any())
        <div class="form-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="https://usebasin.com/f/954d0d6e30da" onsubmit="trackGA4Event('generate_lead', {form_name: 'contact'});">
        <input type="hidden" name="_subject" value="Contact Form Submission">

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
          <div class="form-group">
            <label>{{trans('auth.full_name')}} *</label>
            <input class="form-control" required value="{{Auth::user()->name ?? old('full_name')}}" placeholder="{{trans('auth.full_name')}}" name="full_name" type="text">
          </div>
          <div class="form-group">
            <label>{{trans('auth.email')}} *</label>
            <input name="email" required type="email" value="{{Auth::user()->email ?? old('email')}}" class="form-control" placeholder="{{trans('auth.email')}}">
          </div>
        </div>

        <div class="form-group">
          <label>{{trans('general.subject')}} *</label>
          <input name="subject" required type="text" value="{{old('subject')}}" class="form-control" placeholder="{{trans('general.subject')}}">
        </div>

        <div class="form-group">
          <label>Message *</label>
          <textarea name="message" required rows="5" class="form-control" placeholder="Describe your issue or question...">{{old('message')}}</textarea>
        </div>

        <button type="submit" class="cta-btn">{{trans('auth.send')}} <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></button>
      </form>
    </div>
  </div>
</section>
@endsection

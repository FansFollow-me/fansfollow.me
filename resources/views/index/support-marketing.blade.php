@extends('layouts.appnew')

@section('title') Support - FansFollow.me
@endsection

@section('css')
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #a855f7 100%); }

  /* ── Hero ── */
  .support-hero {
    padding: 6rem 0 3rem;
    text-align: center;
    color: #e5e7eb;
  }
  .support-badge {
    display: inline-flex; align-items: center; gap: .4rem; padding: .4rem 1rem;
    border-radius: 999px; background: linear-gradient(135deg, rgba(245,158,11,.2), rgba(249,115,22,.2));
    border: 1px solid rgba(245,158,11,.3); color: #fbbf24;
    font-size: .75rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 1.5rem;
  }
  .support-hero h1 { font-size: clamp(2rem, 3.5vw, 3rem); font-weight: 900; color: #fff; margin-bottom: .25rem; }
  .support-hero .gradient { background: var(--home-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .support-hero > p { font-size: 1.05rem; color: #94a3b8; max-width: 600px; margin: 0 auto 2rem; line-height: 1.7; }

  /* ── Sections ── */
  .section-dark { padding: 2.5rem 0; }
  .section-dark h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 800; color: #fff; text-align: center; margin-bottom: .5rem; }
  .section-sub { text-align: center; color: #94a3b8; max-width: 600px; margin: 0 auto 2rem; font-size: 1rem; line-height: 1.7; }
  .section-gradient { background: linear-gradient(to bottom, rgba(15,23,42,.4), rgba(17,24,39,.6)); }

  /* ── Support option cards ── */
  .support-options { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.25rem; max-width: 1100px; margin: 0 auto 2.5rem; }
  .support-option {
    background: linear-gradient(135deg, rgba(31,41,55,.7), rgba(15,23,42,.8));
    backdrop-filter: blur(8px); border: 1px solid rgba(255,255,255,.12); border-radius: 16px;
    padding: 1.5rem; text-align: center;
    transition: all .3s ease; box-shadow: 0 10px 15px -3px rgba(0,0,0,.15), 0 4px 6px -4px rgba(0,0,0,.1), 0 0 20px rgba(249,115,22,.06);
  }
  .support-option:hover { transform: translateY(-4px) scale(1.02); border-color: rgba(249,115,22,.4); box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 30px rgba(249,115,22,.2); }
  .support-option-icon { width: 48px; height: 48px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .75rem; color: #fff; font-size: 1.25rem; }
  .support-option-icon svg.lucide { width: 1.25rem; height: 1.25rem; }
  .support-option h4 { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: .3rem; }
  .support-option p { color: #94a3b8; font-size: .85rem; margin-bottom: 1rem; line-height: 1.5; }

  /* ── Buttons ── */
  .cta-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.5rem; border-radius: 10px; background: var(--home-gradient); color: #fff; font-weight: 700; font-size: .9rem; text-decoration: none; transition: all .3s; box-shadow: 0 8px 20px rgba(249,115,22,.2); }
  .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 28px rgba(249,115,22,.3); }

  /* ── Contact form ── */
  .contact-section {
    border-top: 3px solid;
    border-image: linear-gradient(135deg, #f97316, #ec4899) 1;
    background: linear-gradient(to right bottom, rgba(31,41,55,.5), rgba(17,24,39,.6));
  }
  .form-card { background: rgba(15,23,42,.65); border: 1px solid rgba(255,255,255,.08); border-radius: 16px; padding: 2rem; max-width: 700px; margin: 0 auto; }
  .form-card h3 { color: #fff; font-size: 1.2rem; font-weight: 700; margin-bottom: .3rem; }
  .form-card > p { color: #94a3b8; font-size: .9rem; margin-bottom: 1.5rem; }
  .form-group { margin-bottom: 1rem; }
  .form-group label { display: block; color: #e2e8f0; font-size: .85rem; font-weight: 600; margin-bottom: .3rem; }
  .form-group input, .form-group textarea, .form-group select {
    width: 100%; padding: .6rem .85rem; border-radius: 10px;
    border: 1px solid rgba(148,163,184,.18); background: rgba(15,23,42,.6); color: #e2e8f0; font-size: .9rem;
    transition: border-color .2s;
  }
  .form-group input:focus, .form-group textarea:focus, .form-group select:focus { border-color: #f97316; outline: none; box-shadow: 0 0 0 2px rgba(249,115,22,.15); }
  .form-group input::placeholder, .form-group textarea::placeholder { color: #64748b; }
  .form-group select { appearance: auto; }
  .form-group textarea { min-height: 100px; resize: vertical; }
  .char-count { color: #64748b; font-size: .8rem; text-align: right; margin-top: .25rem; }
  .char-count.valid { color: #4ade80; }
  .char-count.invalid { color: #f87171; }

  @media (max-width: 768px) { .support-options { grid-template-columns: 1fr; } }
  @media (max-width: 767.98px) {
    .support-hero { padding: calc(72px + 1.5rem) 0 1.5rem; display: flex; align-items: center; }
    .support-hero .container { display: flex; flex-direction: column; justify-content: center; }
    .section-dark { padding: 1.25rem 0; }
  }
</style>
@endsection

@section('content')
<section class="support-hero">
  <div class="container">
    <div class="support-badge">🛟 SUPPORT CENTER</div>
    <h1>We're Here to Help <span class="gradient">Support Center</span></h1>
    <p>Get the support you need to succeed on FansFollow. Our team is available to help you maximize your earnings and grow your community.</p>
  </div>
</section>

<section class="section-dark section-gradient">
  <div class="container">
    <div class="support-options">
      <div class="support-option">
        <div class="support-option-icon" style="background:linear-gradient(135deg,#f97316,#ec4899);"><i data-lucide="message-circle"></i></div>
        <h4>Live Chat Support</h4>
        <p>Connect with our support team</p>
        <a class="cta-btn" href="#">Start Chat</a>
      </div>
      <div class="support-option">
        <div class="support-option-icon" style="background:linear-gradient(135deg,#ec4899,#a855f7);"><i data-lucide="mail"></i></div>
        <h4>Email Support</h4>
        <p>Send us a detailed message</p>
        <a class="cta-btn" href="mailto:support@fansfollow.me">Send Email</a>
      </div>
      <div class="support-option">
        <div class="support-option-icon" style="background:linear-gradient(135deg,#a855f7,#3b82f6);"><i data-lucide="help-circle"></i></div>
        <h4>Help Center</h4>
        <p>Browse guides and resources</p>
        <a class="cta-btn" href="#">View Guides</a>
      </div>
      <div class="support-option">
        <div class="support-option-icon" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);"><i data-lucide="users"></i></div>
        <h4>Creator Community</h4>
        <p>Join our Discord</p>
        <a class="cta-btn" href="#">Join Discord</a>
      </div>
    </div>

    <div class="form-card" id="contact-form">
      <h3>Send Us a Message</h3>
      <p>Fill out the form below and we'll get back to you as soon as possible.</p>
      <form>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
          <div class="form-group"><label>Name *</label><input type="text" placeholder="Your name" required></div>
          <div class="form-group"><label>Email *</label><input type="email" placeholder="you@email.com" required></div>
        </div>
        <div class="form-group"><label>Phone Number (Optional)</label><input type="tel" placeholder="+1 234 567 890"></div>
        <div class="form-group"><label>Subject *</label><select required><option>Select a subject</option><option>Technical Issue</option><option>Billing</option><option>Account</option><option>Content</option><option>Other</option></select></div>
        <div class="form-group">
          <label>Message *</label>
          <textarea id="msgInput" placeholder="Describe your issue..." required minlength="10" oninput="var c=this.value.length;var el=document.getElementById('charCount');el.textContent=c+' characters (minimum 10)';el.className='char-count '+(c>=10?'valid':'invalid')"></textarea>
          <div class="char-count" id="charCount">0 characters (minimum 10)</div>
        </div>
        <button type="submit" class="cta-btn" style="width:100%;justify-content:center;">Send Message <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg></button>
        <p style="color:#64748b;font-size:.8rem;text-align:center;margin-top:.75rem;">Your message will open in your email client for submission.</p>
      </form>
    </div>

  </div>
</section>
@endsection

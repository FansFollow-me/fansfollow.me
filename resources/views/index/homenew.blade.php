@extends('layouts.appnew')

@section('title') FansFollow.me - Global Fitness & Martial Arts Creator Platform - @endsection
@section('description_custom')FansFollow.me is the global fitness and martial arts creator platform for subscriptions, coaching, direct fan access, and live creator discovery.@endsection

@section('css')
  <style>
    :root {
      color-scheme: dark;
      --home-text: #e5e7eb;
      --home-muted: #94a3b8;
      --home-line: rgba(255, 255, 255, 0.08);
      --home-panel: #151b2c;
      --home-bg: #0b0f1a;
      --home-gradient: linear-gradient(135deg, #f97316 0%, #a855f7 100%);
    }

    /* ===== HERO ===== */
    .home-hero {
      position: relative;
      overflow: hidden;
      background:
        linear-gradient(rgba(0,0,0,.45), rgba(15,23,42,.35)),
        url('/ffmherobackground.jpg') center/cover no-repeat;
      color: var(--home-text);
      min-height: calc(100svh + 76px);
      display: flex;
      align-items: center;
      margin-top: -76px;
      padding-top: 76px;
    }
    .home-hero .hero-grid {
      position: relative;
      z-index: 1;
      display: grid;
      grid-template-columns: minmax(0, 1.08fr) minmax(320px, .92fr);
      gap: 1.5rem;
      align-items: center;
      padding: 5rem 0 4rem;
      max-width: 72rem;
      margin: 0 auto;
      text-align: left;
    }
    .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: .45rem;
      color: #fb923c;
      font-size: 0.8rem;
      font-weight: 600;
      margin-bottom: 0.75rem;
      text-shadow: 0 1px 4px rgba(0,0,0,.6);
    }
    .home-hero h1 {
      font-size: clamp(1.5rem, 3.5vw, 2.25rem);
      line-height: 1.25;
      margin: 0 0 .5rem;
      letter-spacing: -.025em;
      max-width: 32ch;
      color: #fff;
      font-weight: 900;
    }
    .home-hero p {
      color: #f1f5f9;
      max-width: 32rem;
      font-size: 0.875rem;
      font-weight: 500;
      text-shadow: 0 1px 3px rgba(0,0,0,.5);
      line-height: 1.75;
    }

    /* ===== BUTTONS ===== */
    .home-cta {
      display: flex;
      flex-wrap: wrap;
      gap: 0.75rem;
      margin-top: 1rem;
    }
    .home-cta .btn {
      border-radius: 12px;
      font-weight: 700;
      min-height: 44px;
      padding: .75rem 1.5rem;
      letter-spacing: -0.01em;
      border-width: 1px;
      font-size: 0.875rem;
      transition: all .3s ease;
    }
    .home-cta .btn-light {
      background: var(--home-gradient) !important;
      background-image: var(--home-gradient) !important;
      border-color: transparent !important;
      color: #fff !important;
      box-shadow: 0 10px 20px rgba(249, 115, 22, .3);
    }
    .home-cta .btn-light:hover {
      transform: scale(1.05);
      box-shadow: 0 14px 28px rgba(249,115,22,.4);
    }
    .home-cta .btn-outline-light {
      background: rgba(30,41,59,.8) !important;
      background-image: none !important;
      border: 1px solid rgba(255,255,255,.15) !important;
      color: #e2e8f0 !important;
      box-shadow: none !important;
    }
    .home-cta .btn-outline-light:hover {
      background: rgba(51,65,85,.8) !important;
      border-color: rgba(255,255,255,.3) !important;
      transform: scale(1.05);
    }

    /* ===== WATERMARK LOGO ===== */
    .home-hero__image {
      width: 75%;
      max-width: 400px;
      margin: 2rem 0 0;
      align-self: end;
      justify-self: center;
      opacity: .95;
    }
    .home-hero__image img {
      display: block;
      width: 100%;
      height: auto;
      filter: drop-shadow(0 20px 40px rgba(0,0,0,.3));
      animation: heroFloat 6s ease-in-out infinite;
    }
    @keyframes heroFloat {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    /* ===== SECTION 2: FEATURE CARDS ===== */
    .section-dark { padding: 4rem 0; background: transparent; }
    .section-dark h2 { font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 900; color: #fff; text-align: center; margin-bottom: .5rem; line-height: 1.25; }
    .section-sub { text-align: center; color: #d1d5db; max-width: 48rem; margin: 0 auto 2rem; font-size: .95rem; line-height: 1.75; }

    .grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; }
    .card {
      background: rgba(255,255,255,.05);
      backdrop-filter: blur(8px);
      border: 1px solid rgba(255,255,255,.1);
      border-radius: 16px;
      padding: 1.5rem;
      height: 100%;
      transition: all .3s ease;
    }
    .card:hover {
      border-color: rgba(249,115,22,.5);
      transform: scale(1.05) translateY(-3px);
      box-shadow: 0 20px 40px rgba(249,115,22,.15);
    }
    .feature-icon {
      width: 56px;
      height: 56px;
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      background: var(--home-gradient);
      color: #fff;
      font-size: 1.25rem;
      transition: transform .3s ease;
    }
    .feature-icon svg.lucide {
      width: 1.25rem;
      height: 1.25rem;
    }
    .card:hover .feature-icon { transform: scale(1.1); }
    .card h3 { margin: 0 0 .4rem; font-size: 1rem; font-weight: 700; color: #fff; }
    .card p { color: #d1d5db; line-height: 1.65; margin-bottom: 0; font-size: .9rem; }

    /* ===== SECTION 3: FOR FANS ===== */
    .fans-container {
      background: rgba(255,255,255,.05);
      backdrop-filter: blur(8px);
      border-radius: 16px;
      padding: 1.25rem;
      border: 1px solid rgba(255,255,255,.1);
    }
    .fans-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 1rem;
    }
    .fan-card {
      background: linear-gradient(135deg, rgba(249,115,22,.2), rgba(168,85,247,.2));
      border-radius: 12px;
      padding: 1rem;
      text-align: center;
      border: 1px solid rgba(249,115,22,.3);
      transition: all .3s;
    }
    .fan-card:nth-child(even) { border-color: rgba(168,85,247,.3); }
    .fan-card i, .fan-card svg.lucide { width: 1.5rem; height: 1.5rem; margin-bottom: .5rem; display: block; }
    .fan-card:nth-child(odd) i, .fan-card:nth-child(odd) svg.lucide { color: #fb923c; }
    .fan-card:nth-child(even) i, .fan-card:nth-child(even) svg.lucide { color: #a78bfa; }
    .fan-card h4 { font-weight: 700; color: #fff; font-size: .95rem; margin-bottom: .25rem; }
    .fan-card p { color: #d1d5db; font-size: .85rem; margin: 0; }

    /* ===== SECTION 4: CTA ===== */
    .section-photo { position: relative; overflow: hidden; background: linear-gradient(rgba(0,0,0,.5), rgba(15,23,42,.5)), url('/ffmherobackground.jpg') center/cover no-repeat; padding: 5rem 0; text-align: center; }
    .section-photo h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 900; color: #fff; margin-bottom: .5rem; }
    .section-photo p { color: #d1d5db; font-size: 1rem; max-width: 500px; margin: 0 auto 2rem; line-height: 1.7; }
    .cta-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.75rem; border-radius: 12px; background: var(--home-gradient); color: #fff; font-weight: 700; font-size: 1rem; text-decoration: none; transition: all .3s; box-shadow: 0 14px 28px rgba(249,115,22,.3); }
    .cta-btn:hover { transform: scale(1.05); box-shadow: 0 20px 30px rgba(249,115,22,.4); }

    /* ===== NAV SPACING ===== */
    .public-shell-nav { gap: 0.2rem !important; }

    @media (max-width: 991.98px) {
      .home-hero { min-height: calc(100svh + 76px); }
      .home-hero .hero-grid,
      .fans-grid,
      .grid-4 {
        grid-template-columns: 1fr;
      }
      .public-shell-nav { gap: 0.1rem !important; }
    }
    @media (max-width: 767.98px) {
      .home-hero { display: flex; align-items: center; }
      .home-hero .hero-grid { padding: 1rem 0; }
      .section-dark { padding: 1.5rem 0; }
      #fans { padding-top: 0.75rem !important; }
      .section-photo { padding: 1.5rem 0; }
    }
  </style>
@endsection

@section('content')
  <section class="home-hero" id="celebrities">
    <div class="container">
      <div class="hero-grid">
        <div>
          <h1>FansFollow.me — where fans become friends</h1>
          <div class="hero-eyebrow">For Fitness, Bodybuilding and Martial Arts Creators</div>
          <p>Built for fitness coaches, bodybuilders, nutrition experts, martial artists and combat sports creators to earn from fans worldwide through content, coaching and direct fan access.</p>
          <div class="home-cta">
            <a class="btn btn-light" href="{{ url('explore') }}"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;vertical-align:middle;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg> Explore Creators</a>
            <a class="btn btn-outline-light" href="{{ $settings->registration_active == '1' ? url('signup') : url('login') }}"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right:6px;vertical-align:middle;"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><line x1="19" y1="8" x2="19" y2="14"/><line x1="22" y1="11" x2="16" y2="11"/></svg> Get Started</a>
          </div>
          <div id="pwa-install" style="display:none;margin-top:1.25rem;">
            <button id="pwa-btn" onclick="installPWA()" style="display:inline-flex;align-items:center;gap:.5rem;padding:.6rem 1.1rem;border-radius:10px;background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.15);color:#fff;font-size:.8rem;font-weight:600;cursor:pointer;transition:all .3s;">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
              <span id="pwa-label">Add to Home Screen</span>
            </button>
            <div id="pwa-ios-hint" style="display:none;margin-top:.5rem;color:#94a3b8;font-size:.75rem;">
              Tap the Share button <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="vertical-align:middle;"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" y1="2" x2="12" y2="15"/></svg> then "Add to Home Screen"
            </div>
          </div>
          <script>
          var deferredPrompt;
          var isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
          var isAndroid = /Android/.test(navigator.userAgent);
          var isMobile = isIOS || isAndroid;

          window.addEventListener('beforeinstallprompt', function(e) {
            e.preventDefault();
            deferredPrompt = e;
            document.getElementById('pwa-install').style.display = 'block';
          });

          if (isIOS && !window.navigator.standalone) {
            document.getElementById('pwa-install').style.display = 'block';
            document.getElementById('pwa-ios-hint').style.display = 'block';
            document.getElementById('pwa-btn').style.display = 'none';
          }

          if (window.navigator.standalone) {
            document.getElementById('pwa-install').style.display = 'none';
          }

          function installPWA() {
            if (deferredPrompt) {
              deferredPrompt.prompt();
              deferredPrompt.userChoice.then(function(choice) {
                if (choice.outcome === 'accepted') {
                  document.getElementById('pwa-install').style.display = 'none';
                }
                deferredPrompt = null;
              });
            }
          }
          </script>
        </div>
        <div class="home-hero__image">
          <img src="{{ url('fans-foloow-me-logo-final-file--png-version.png') }}" srcset="{{ url('fans-foloow-me-logo-final-file--png-version-480.png') }} 480w, {{ url('fans-foloow-me-logo-final-file--png-version-960.png') }} 960w, {{ url('fans-foloow-me-logo-final-file--png-version-1440.png') }} 1440w" sizes="(max-width: 991px) 92vw, 400px" alt="FansFollow.me logo" loading="eager" decoding="async">
        </div>
      </div>
    </div>
  </section>

  <section class="section-dark">
    <div class="container">
      <div class="section-head" style="text-align:center;margin-bottom:2rem;">
        <h2>One home for fitness creators and their fans</h2>
        <p class="section-sub">FansFollow.me brings fighters, coaches, fitness influencers, sports professionals and actors with fitness-based content together on one platform, so fans can find them in one place and creators can build real relationships, add new revenue streams and unlock bigger opportunities.</p>
      </div>
      <div class="grid-4">
        <div class="card"><div class="feature-icon"><i data-lucide="dollar-sign"></i></div><h3>Keep 80%+ Revenue</h3><p>Keep more of what you earn with a creator-first revenue share.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="zap"></i></div><h3>17+ Revenue Streams</h3><p>Earn through subscriptions, coaching, premium content, calls, tips and more.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="globe"></i></div><h3>Global Payments</h3><p>Accept payments from fans worldwide with flexible payment options.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="message-circle"></i></div><h3>Direct Fan Connection</h3><p>Build stronger fan relationships through private access and paid interactions.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="camera"></i></div><h3>Mobile Content Creation</h3><p>Create and upload content directly from your phone.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="phone"></i></div><h3>Instant Messaging</h3><p>Chat privately with fans in real time.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="video"></i></div><h3>Live Streaming</h3><p>Go live to your audience from any device.</p></div>
        <div class="card"><div class="feature-icon"><i data-lucide="qr-code"></i></div><h3>In-Person QR Sign-Ups</h3><p>Let fans join and pay on the spot by scanning your unique QR code at events and gyms.</p></div>
      </div>
    </div>
  </section>

  <section class="section-dark" id="fans" style="background:linear-gradient(180deg,rgba(11,15,26,.92),rgba(21,27,44,.88)),url('/ffmherobackground-1280.jpg') center/cover no-repeat;padding-bottom:0;">
    <div class="container" style="max-width:64rem;">
      <div style="text-align:center;margin-bottom:1.5rem;">
        <div style="display:inline-flex;align-items:center;gap:.5rem;padding:.5rem 1rem;border-radius:999px;background:rgba(249,115,22,.2);border:1px solid rgba(249,115,22,.3);margin-bottom:1rem;">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fb923c" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          <span style="color:#fdba74;font-weight:600;font-size:.75rem;">For Fans Globally | Pay with BTC/ETH/USDT/SOL</span>
        </div>
        <h2>Get closer access to your favourite athletes &amp; creators</h2>
        <p class="section-sub">FansFollow.me lets you build real connections with UFC fighters, bodybuilders, martial artists, fitness models and other creators through private chats, exclusive content, calls and video sessions.</p>
      </div>
      <div class="fans-container">
        <div class="fans-grid">
          <div class="fan-card"><i data-lucide="message-circle"></i><h4>Personal Chats</h4><p>Direct messaging with your favorite athletes</p></div>
          <div class="fan-card"><i data-lucide="lock"></i><h4>Exclusive Content</h4><p>Premium photos, videos, and training materials</p></div>
          <div class="fan-card"><i data-lucide="phone"></i><h4>Phone Calls</h4><p>Voice conversations and coaching</p></div>
          <div class="fan-card"><i data-lucide="video"></i><h4>Video Sessions</h4><p>Face-to-face time with champions and exclusive content</p></div>
        </div>
      </div>
    </div>
  </section>

  <section class="section-photo" id="business">
    <div id="scan" style="position:relative; top:-90px; height:0;"></div>
    <div class="container">
      <h2>Ready to start as a creator?</h2>
      <p>Keep more of what you earn, connect with fans in one place and unlock new media and casting opportunities as you grow on FansFollow.me.</p>
      <a class="cta-btn" href="{{ url('signup') }}">Get Started Now <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </section>
@endsection
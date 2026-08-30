@extends('layouts.appnew')

@section('title') Celebrities - FansFollow.me
@endsection

@section('css')
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #a855f7 100%); --gold-gradient: linear-gradient(135deg, #f59e0b, #f97316); }

  .celeb-hero {
    position: relative;
    overflow: hidden;
    background: #0b0f1a;
    margin-top: -72px;
    padding: calc(72px + 6rem) 0 5rem;
    color: #e5e7eb;
  }
  .celeb-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('/celebhero.jpg') center 8%/cover no-repeat;
    z-index: 0;
  }
  .celeb-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(rgba(0,0,0,.55), rgba(15,23,42,.45));
    z-index: 1;
  }
  .celeb-hero > .container { position: relative; z-index: 2; }
  .celeb-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .4rem 1rem;
    border-radius: 999px;
    background: linear-gradient(135deg, rgba(245,158,11,.2), rgba(249,115,22,.2));
    border: 1px solid rgba(245,158,11,.3);
    color: #fbbf24;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
  }
  .celeb-hero h1 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    font-weight: 900;
    margin-bottom: .75rem;
    max-width: 550px;
    text-align: left;
  }
  .celeb-hero h1 .white { color: #fff; }
  .celeb-hero h1 .gold { color: #fbbf24; }
  .celeb-hero p {
    font-size: 1rem;
    color: #e2e8f0;
    max-width: 550px;
    margin: 0 0 2rem;
    line-height: 1.75;
    text-align: left;
    font-weight: 500;
    text-shadow: 0 1px 3px rgba(0,0,0,.5);
  }
  .hero-btns { display: flex; gap: .75rem; flex-wrap: wrap; }

  .cta-btn {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .75rem 1.75rem;
    border-radius: 12px;
    background: var(--gold-gradient);
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    transition: all .3s;
    box-shadow: 0 14px 28px rgba(245,158,11,.3);
  }
  .cta-btn:hover { transform: scale(1.05); box-shadow: 0 20px 30px rgba(245,158,11,.4); }
  .cta-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .75rem 1.75rem;
    border-radius: 12px;
    background: rgba(30,41,59,.8);
    border: 1px solid rgba(255,255,255,.15);
    color: #e2e8f0;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    transition: all .3s;
  }
  .cta-btn-outline:hover { background: rgba(51,65,85,.8); border-color: rgba(255,255,255,.25); }
  .cta-btn-home {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .75rem 1.75rem;
    border-radius: 12px;
    background: var(--home-gradient);
    color: #fff;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    transition: all .3s;
    box-shadow: 0 14px 28px rgba(249,115,22,.3);
  }
  .cta-btn-home:hover { transform: scale(1.05); }

  .section-dark { padding: 4rem 0 2rem; background: transparent; }
  .section-dark h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 900; color: #fff; text-align: center; margin-bottom: .5rem; }
  .section-sub { text-align: center; color: #d1d5db; max-width: 650px; margin: 0 auto 2.5rem; font-size: 1rem; line-height: 1.7; }

  /* ── Feature cards ── */
  .card-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; max-width: 1100px; margin: 0 auto; }
  .card-item {
    background: rgba(255,255,255,.05);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all .3s ease;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1);
  }
  .card-item:hover {
    transform: translateY(-4px) scale(1.02);
    border-color: rgba(249,115,22,.4);
    box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 20px rgba(249,115,22,.15);
  }
  /* Featured cards — same size, enhanced glow */
  .card-item.featured {
    background: rgba(255,255,255,.08);
    position: relative;
  }
  .card-item.featured::before {
    content: '';
    position: absolute;
    top: 0;
    left: 1rem;
    right: 1rem;
    height: 3px;
    border-radius: 3px 3px 0 0;
    background: var(--gold-gradient);
  }
  .card-item.featured-gold {
    border-color: rgba(245,158,11,.35);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1), 0 0 25px rgba(245,158,11,.1);
  }
  .card-item.featured-gold:hover {
    box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 30px rgba(245,158,11,.2);
    border-color: rgba(245,158,11,.5);
  }
  .card-item.featured-teal {
    border-color: rgba(20,184,166,.35);
    box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1), 0 0 25px rgba(20,184,166,.1);
  }
  .card-item.featured-teal:hover {
    box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 30px rgba(20,184,166,.2);
    border-color: rgba(20,184,166,.5);
  }

  .card-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: .75rem;
    color: #fff;
    font-size: 1.25rem;
  }
  .card-icon svg.lucide { width: 1.25rem; height: 1.25rem; }
  .card-item h4 { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: .3rem; }
  .card-item p { color: #d1d5db; font-size: .85rem; line-height: 1.6; margin: 0; }

  /* ── Founder cards ── */
  .founder-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; max-width: 1100px; margin: 0 auto; }
  .founder-card {
    background: rgba(255,255,255,.05);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    padding: 1.5rem;
    text-align: center;
    transition: all .3s ease;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1);
  }
  .founder-card:hover {
    transform: translateY(-4px) scale(1.02);
    border-color: rgba(249,115,22,.4);
    box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 20px rgba(249,115,22,.15);
  }
  .founder-card .founder-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: .75rem;
    color: #fff;
    font-size: 1.25rem;
  }
  .founder-icon svg.lucide { width: 1.25rem; height: 1.25rem; }
  .founder-card h4 { color: #fff; font-size: .95rem; font-weight: 700; margin-bottom: .2rem; }
  .founder-card p { color: #d1d5db; font-size: .8rem; margin: 0; }

  /* ── Badge glow ── */
  .badge-glow {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .4rem 1rem;
    border-radius: 999px;
    background: linear-gradient(135deg, rgba(249,115,22,.25), rgba(234,88,12,.25));
    border: 1px solid rgba(249,115,22,.4);
    color: #fb923c;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    box-shadow: 0 0 20px rgba(249,115,22,.2), 0 0 40px rgba(249,115,22,.1);
  }

  /* ── Film section ── */
  .film-tabs { display: flex; gap: .5rem; justify-content: center; margin-bottom: 2rem; flex-wrap: wrap; }
  .film-tab {
    padding: .6rem 1.25rem;
    border-radius: 12px;
    background: rgba(255,255,255,.07);
    border: 1px solid rgba(255,255,255,.1);
    color: #d1d5db;
    font-weight: 600;
    font-size: .9rem;
    cursor: pointer;
    transition: all .2s;
  }
  .film-tab.active, .film-tab:hover {
    background: var(--home-gradient);
    color: #fff;
    border-color: transparent;
  }
  .film-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem; max-width: 1100px; margin: 0 auto; }
  .film-card {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(255,255,255,.1);
    border-radius: 16px;
    overflow: hidden;
    transition: all .3s ease;
  }
  .film-card:hover {
    transform: translateY(-4px);
    border-color: rgba(249,115,22,.4);
    box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 20px rgba(249,115,22,.15);
  }
  .film-poster {
    height: 200px;
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    color: #475569;
    font-size: 3rem;
  }
  .film-poster .coming-soon { font-size: .85rem; font-weight: 600; color: #64748b; letter-spacing: .05em; }
  .film-info { padding: 1rem; }
  .film-info h4 { color: #fff; font-size: .95rem; font-weight: 700; margin-bottom: .2rem; }
  .film-info .film-year { color: #d1d5db; font-size: .8rem; }
  .film-info .film-role { color: #a78bfa; font-size: .8rem; font-weight: 600; margin-top: .3rem; }
  .film-status { display: inline-block; font-size: .75rem; font-weight: 600; margin-top: .3rem; }
  .status-post { color: #fb923c; }
  .status-pre { color: #a78bfa; }

  .cta-center { text-align: center; margin-top: 2rem; }

  @media (max-width: 768px) { .card-grid, .founder-grid, .film-grid { grid-template-columns: 1fr; } }
  @media (max-width: 767.98px) {
    .celeb-hero { padding: calc(72px + 1.5rem) 0 2rem; }
    .section-dark { padding: 2rem 0; }
  }
</style>
@endsection

@section('content')
<section class="celeb-hero">
  <div class="container">
    <div class="celeb-badge">★ CELEBRITY CONNECTIONS</div>
    <h1><span class="white">Chat Personally<br>With<br>Your </span><span class="gold">Favorite Champions</span></h1>
    <p>Connect directly with UFC fighters, Olympic champions, bodybuilding legends, and fitness icons. Build real friendships through personal chats, phone calls, and video hangouts.</p>
    <div class="hero-btns">
      <a class="cta-btn" href="{{ url('explore') }}">Explore Celebrities</a>
      <a class="cta-btn-outline" href="{{ url('signup') }}">Become a Fan</a>
    </div>
  </div>
</section>

<section class="section-dark">
  <div class="container">
    <h2>Why Celebrities Choose FansFollow</h2>
    <p class="section-sub">A platform designed for athletes, entertainers and influencers who work with sponsors and mainstream media.</p>
    <div class="card-grid">
      <div class="card-item"><div class="card-icon" style="background:linear-gradient(135deg,#ec4899,#db2777);"><i data-lucide="handshake"></i></div><h4>Real connections</h4><p>Build genuine, positive relationships with fans through fitness, training and combat-sports content in a fully brand-safe environment.</p></div>
      <div class="card-item featured featured-gold"><div class="card-icon" style="background:linear-gradient(135deg,#f59e0b,#f97316);"><i data-lucide="gem"></i></div><h4>Premium benefits</h4><p>Keep 80%+ of your earnings with clear reporting, VIP rates for high-volume talent, and terms that work for you and your team.</p></div>
      <div class="card-item"><div class="card-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i data-lucide="clock"></i></div><h4>Your schedule, your rules</h4><p>Set your own rates, availability and interaction preferences so every engagement fits your time, boundaries and sponsors.</p></div>
      <div class="card-item featured featured-teal"><div class="card-icon" style="background:linear-gradient(135deg,#14b8a6,#0d9488);"><i data-lucide="shield"></i></div><h4>Brand-safe by design</h4><p>A professional, non-adult platform built for athletes, entertainers and influencers who work with sponsors and mainstream media.</p></div>
      <div class="card-item"><div class="card-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="users"></i></div><h4>High-quality audience</h4><p>Reach verified, paying fans who value your work, not bots or low-intent followers.</p></div>
      <div class="card-item"><div class="card-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="star"></i></div><h4>Built with industry experience</h4><p>Created by a founder with multiple film and media credits who understands how to protect long-term reputation and endorsements.</p></div>
    </div>
    <div class="cta-center"><a class="cta-btn-home" href="{{ url('signup') }}">Apply for Celebrity Status <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a></div>
  </div>
</section>

<section class="section-dark" style="border-top: 1px solid rgba(255,255,255,.06);">
  <div class="container">
    <div style="text-align:center;margin-bottom:1rem;"><div class="badge-glow">★ FFM FOUNDER'S ACCOLADES</div></div>
    <h2>David Kurzhal - The Viking Samurai</h2>
    <p class="section-sub">From martial arts champion to Hollywood action star — the expertise behind FFM.</p>
    <div class="founder-grid">
      <div class="founder-card"><div class="founder-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="film"></i></div><h4>Lead Actor</h4><p>8+ Feature Films</p></div>
      <div class="founder-card"><div class="founder-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="camera"></i></div><h4>Martial Arts Expert</h4><p>5th Dan Black Belt, Viking Samurai</p></div>
      <div class="founder-card"><div class="founder-icon" style="background:linear-gradient(135deg,#f97316,#a855f7);"><i data-lucide="zap"></i></div><h4>Stunt Performer</h4><p>Action Choreographer</p></div>
      <div class="founder-card"><div class="founder-icon" style="background:linear-gradient(135deg,#a855f7,#ec4899);"><i data-lucide="video"></i></div><h4>YouTuber</h4><p>Channel Dedicated to 80s & 90s Martial Arts Cinema</p></div>
      <div class="founder-card"><div class="founder-icon" style="background:linear-gradient(135deg,#ec4899,#f97316);"><i data-lucide="users"></i></div><h4>Celebrity Boxer</h4><p>In talks with various big names</p></div>
      <div class="founder-card"><div class="founder-icon" style="background:linear-gradient(135deg,#f97316,#ec4899);"><i data-lucide="heart"></i></div><h4>Interviewed Legends</h4><p>Steven Seagal, Scott Adkins, Don Wilson, Michael Jai White, Michel Qissi</p></div>
    </div>
  </div>
</section>

<section class="section-dark" style="border-top: 1px solid rgba(255,255,255,.06);">
  <div class="container">
    <div style="text-align:center;margin-bottom:1rem;"><div class="badge-glow">★ NOW SHOWING: FFM FOUNDER'S FEATURED FILMS</div></div>
    <h2>From Martial Arts Champion to Hollywood Action Star</h2>
    <p class="section-sub" style="max-width:700px;">David Kurzhal's complete filmography - from released blockbusters to upcoming projects. Now we're creating opportunities for FFM creators to star in martial arts films.</p>
    <div class="film-tabs">
      <div class="film-tab active" onclick="showTab('released')">Released</div>
      <div class="film-tab" onclick="showTab('post')">In Post-Production</div>
      <div class="film-tab" onclick="showTab('pre')">In Pre-Production / Upcoming</div>
    </div>
    <div id="tab-released" class="film-grid">
      <div class="film-card"><div class="film-poster" style="background-image:url('/lastkumite.jpeg');"></div><div class="film-info"><h4>The Last Kumite</h4><div class="film-year">2024</div><div class="film-role">Role: Marcus Gantz</div></div></div>
      <div class="film-card"><div class="film-poster" style="background-image:url('/bloodstorm.jpeg');"></div><div class="film-info"><h4>Bloodstorm</h4><div class="film-year">2025</div><div class="film-role">Role: Bennet (Lead Role)</div></div></div>
      <div class="film-card"><div class="film-poster" style="background-image:url('/elitetarget.png');"></div><div class="film-info"><h4>Elite Target</h4><div class="film-year">2025</div><div class="film-role">Role: Alpha Commando</div></div></div>
    </div>
    <div id="tab-post" class="film-grid" style="display:none;">
      <div class="film-card"><div class="film-poster" style="background-image:url('/Order_of_the_dragon.png');"></div><div class="film-info"><h4>Order of the Dragon</h4><div class="film-role">Role: Jean Pierre (Co-starring Steven Seagal)</div><div class="film-status status-post">In Post-Production</div></div></div>
      <div class="film-card"><div class="film-poster" style="background-image:url('/Hard_redemption.png');"></div><div class="film-info"><h4>Hard Redemption</h4><div class="film-role">Role: Solomon</div><div class="film-status status-post">In Post-Production</div></div></div>
      <div class="film-card"><div class="film-poster" style="background-image:url('/Warrior_island.png');"></div><div class="film-info"><h4>Warrior Island</h4><div class="film-role">Role: Viking Samurai</div><div class="film-status status-post">In Post-Production</div></div></div>
    </div>
    <div id="tab-pre" class="film-grid" style="display:none;">
      <div class="film-card"><div class="film-poster"><i data-lucide="film"></i><span class="coming-soon">COMING SOON</span></div><div class="film-info"><h4>Guardian Peacemaker</h4><div class="film-role">Main Actor: David Kurzhal, Main Actress: Shaina West</div><div class="film-status status-pre">In Pre-Production</div></div></div>
      <div class="film-card"><div class="film-poster" style="background-image:url('/Warrior_island_darker_days.png');"></div><div class="film-info"><h4>Warrior Island: Darker Days</h4><div class="film-role">Role: Viking Samurai</div><div class="film-status status-pre">In Pre-Production</div></div></div>
      <div class="film-card"><div class="film-poster"><i data-lucide="film"></i><span class="coming-soon">COMING SOON</span></div><div class="film-info"><h4>The Magnetic Fighters</h4><div class="film-year">2026</div><div class="film-role">Role: Samurai Hayate</div><div class="film-status status-pre">Upcoming</div></div></div>
    </div>
  </div>
</section>

<script>
function showTab(tab) {
  document.querySelectorAll('.film-grid').forEach(g => g.style.display = 'none');
  document.querySelectorAll('.film-tab').forEach(t => t.classList.remove('active'));
  document.getElementById('tab-' + tab).style.display = 'grid';
  event.target.classList.add('active');
}
</script>
@endsection

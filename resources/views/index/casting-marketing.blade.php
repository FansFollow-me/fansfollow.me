@extends('layouts.appnew')

@section('title') Movie Casting - FansFollow.me
@endsection

@section('css')
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #a855f7 100%); }

  .casting-hero {
    position: relative;
    overflow: hidden;
    background: #0b0f1a;
    margin-top: -72px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #e5e7eb;
  }
  .casting-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url('/travis-colbert-fz2Am8mQfEw-unsplash.jpg') center 0%/cover no-repeat;
    z-index: 0;
  }
  .casting-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.5);
    z-index: 1;
  }
  .casting-hero > .container { position: relative; z-index: 2; }
  .casting-badge {
    display: inline-flex;
    align-items: center;
    gap: .4rem;
    padding: .4rem 1rem;
    border-radius: 999px;
    background: rgba(249,115,22,.12);
    border: 1px solid rgba(249,115,22,.25);
    color: #fb923c;
    font-size: .75rem;
    font-weight: 700;
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: 1.5rem;
  }
  .casting-hero h1 { font-size: clamp(2.5rem, 4vw, 3.5rem); font-weight: 900; color: #fff; margin-bottom: .75rem; max-width: 900px; margin-left: auto; margin-right: auto; }
  .casting-hero p { font-size: 1.05rem; color: #e2e8f0; max-width: 600px; margin: 0 auto 2rem; line-height: 1.7; font-weight: 500; text-shadow: 0 1px 3px rgba(0,0,0,.5); }
  .hero-btns { display: flex; gap: .75rem; justify-content: center; flex-wrap: wrap; }

  .cta-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .85rem 2rem; border-radius: 12px; background: var(--home-gradient); color: #fff; font-weight: 700; font-size: 1rem; text-decoration: none; transition: all .3s; box-shadow: 0 14px 28px rgba(249,115,22,.24); }
  .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 20px 30px rgba(249,115,22,.3); }
  .cta-btn-outline { display: inline-flex; align-items: center; gap: .5rem; padding: .85rem 2rem; border-radius: 12px; background: rgba(30,41,59,.6); border: 1px solid rgba(255,255,255,.15); color: #e2e8f0; font-weight: 700; font-size: 1rem; text-decoration: none; transition: all .3s; }
  .cta-btn-outline:hover { background: rgba(51,65,85,.6); border-color: rgba(255,255,255,.25); }

  .section-dark { padding: 1.5rem 0; }
  .section-dark.fill-viewport { min-height: 100vh; display: flex; align-items: center; }
  .section-dark h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 800; color: #fff; text-align: center; margin-bottom: .3rem; }
  .section-sub { text-align: center; color: #94a3b8; max-width: 650px; margin: 0 auto 1rem; font-size: .95rem; line-height: 1.6; }

  .founder-section { display: grid; grid-template-columns: 480px 1fr; gap: 2.5rem; max-width: 1300px; margin: 0 auto; align-items: center; }
  .founder-text h3 { font-size: 2.25rem; font-weight: 800; color: #fff; margin-bottom: .75rem; }
  .founder-text .gradient { background: var(--home-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
  .founder-text p { color: #cbd5e1; font-size: 1.125rem; line-height: 1.7; margin-bottom: 1.25rem; }
  .film-tags { display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; margin-bottom: 2rem; max-width: 420px; }
  .film-tag { padding: .7rem 1.25rem; border-radius: 10px; background: rgba(15,23,42,.6); border: 1px solid rgba(255,255,255,.15); color: #e2e8f0; font-size: 1rem; font-weight: 600; text-align: center; white-space: nowrap; }
  .quote-block { border-left: 3px solid #f97316; padding-left: 1.25rem; color: #94a3b8; font-style: italic; font-size: .95rem; line-height: 1.6; margin-bottom: 1.25rem; }
  .founder-img { width: 100%; height: auto; aspect-ratio: 1; border-radius: 16px; object-fit: cover; border: 3px solid rgba(249,115,22,.5); box-shadow: 0 0 40px rgba(249,115,22,.25), 0 0 80px rgba(249,115,22,.1); }
  .founder-follow {
    text-align: center;
    padding: 1.25rem 0;
    margin-top: 2rem;
    background: linear-gradient(to right, rgba(31,41,55,.95), rgba(17,24,39,.95));
    border-top: 3px solid;
    border-image: linear-gradient(135deg, #f97316, #ec4899) 1;
    border-radius: 0;
    margin-left: -2rem;
    margin-right: -2rem;
    padding-left: 2rem;
    padding-right: 2rem;
    box-shadow: 0 -4px 20px rgba(249,115,22,.08);
  }
  .founder-follow p { color: #cbd5e1; font-size: 1rem; margin-bottom: .75rem; font-weight: 500; }
  .founder-follow strong { color: #fb923c; font-weight: 700; }
  .founder-follow-icons { display: flex; justify-content: center; gap: 1rem; }
  .founder-follow-icons a {
    width: 40px; height: 40px; border-radius: 50%;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.1);
    display: flex; align-items: center; justify-content: center;
    color: #9ca3af; font-size: 1rem; transition: all .3s;
  }
  .founder-follow-icons a svg.lucide { width: 1rem; height: 1rem; }
  .founder-follow-icons a:hover {
    color: #fb923c;
    background: rgba(249,115,22,.12);
    border-color: rgba(249,115,22,.3);
    box-shadow: 0 0 12px rgba(249,115,22,.25);
  }

  .status-banner { display: flex; align-items: center; justify-content: space-between; background: rgba(15,23,42,.6); border: 1px solid rgba(255,255,255,.08); border-radius: 16px; padding: .75rem 1.25rem; margin-bottom: .75rem; flex-wrap: wrap; gap: .75rem; }
  .status-badge { display: inline-block; padding: .3rem .8rem; border-radius: 999px; background: rgba(249,115,22,.15); color: #fb923c; font-size: .8rem; font-weight: 700; }

  .talent-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: .5rem; margin-bottom: .25rem; }
  .talent-card { background: rgba(15,23,42,.6); border: 1px solid rgba(255,255,255,.08); border-radius: 12px; padding: .5rem; text-align: center; }
  .talent-card-icon { width: 40px; height: 40px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .3rem; color: #fff; }
  .talent-card-icon i, .talent-card-icon svg.lucide { width: 1rem; height: 1rem; color: #fff; }
  .talent-card h4 { color: #fff; font-size: .85rem; font-weight: 700; margin-bottom: .2rem; }
  .talent-card p { color: #94a3b8; font-size: .75rem; margin: 0; }

  .waitlist-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; max-width: 1100px; margin: 0 auto; align-items: stretch; }
  .waitlist-card { background: rgba(15,23,42,.65); border: 1px solid rgba(255,255,255,.08); border-radius: 16px; padding: 1rem; }
  .waitlist-card h3 { color: #fff; font-size: 1.1rem; font-weight: 700; margin-bottom: .25rem; }
  .waitlist-card p { color: #94a3b8; font-size: .85rem; margin-bottom: .5rem; }
  .waitlist-card .form-group { margin-bottom: .4rem; }
  .waitlist-card label { display: block; color: #e2e8f0; font-size: .85rem; font-weight: 600; margin-bottom: .3rem; }
  .waitlist-card input, .waitlist-card textarea { width: 100%; padding: .5rem .75rem; border-radius: 10px; border: 1px solid rgba(148,163,184,.18); background: rgba(15,23,42,.6); color: #e2e8f0; font-size: .85rem; }
  .waitlist-card input::placeholder, .waitlist-card textarea::placeholder { color: #64748b; }
  .waitlist-card textarea { min-height: 50px; resize: vertical; }
  .waitlist-card .note { color: #64748b; font-size: .8rem; margin-top: .5rem; }

  .social-strip { text-align: center; padding: 2rem 0; border-top: 1px solid rgba(255,255,255,.06); color: #94a3b8; font-size: .9rem; }
  .social-strip a { color: #fb923c; margin-left: .5rem; }

  @media (max-width: 768px) { .founder-section, .waitlist-grid { grid-template-columns: 1fr; } .talent-grid { grid-template-columns: repeat(2, 1fr); } }
  @media (max-width: 767.98px) {
    .casting-hero { min-height: auto; padding: calc(72px + 1.5rem) 0 2rem; }
    .section-dark { padding: 1.5rem 0; }
  }
</style>
@endsection

@section('content')
<section class="casting-hero">
  <div class="container">
    <div class="casting-badge">🎬 FFM STUDIOS</div>
    <h1>Where creators and<br>performers move into film</h1>
    <p>We're developing film projects and creating opportunities for athletes, models, martial artists, actors and performers with real on-screen potential.</p>
    <div class="hero-btns">
      <a class="cta-btn" href="#waitlist">Join Casting Waitlist <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg></a>
      <a class="cta-btn-outline" href="#status">See Current Projects <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</section>

<section class="section-dark fill-viewport">
  <div class="container">
    <div class="founder-section">
      <img class="founder-img" src="{{ url('Viking.png') }}" alt="David Kurzhal - Viking Samurai">
      <div class="founder-text">
        <div class="casting-badge" style="margin-bottom:.75rem;">FOUNDER & CO-DIRECTOR</div>
        <h3>Led by <span class="gradient">Viking Samurai</span></h3>
        <p>FFM founder <strong style="color:#fb923c;">David Kurzhal</strong> (Viking Samurai) brings real film credentials to casting. He's starred in blockbuster action films including:</p>
        <div class="film-tags">
          <span class="film-tag">The Last Kumite</span>
          <span class="film-tag">Bloodstorm</span>
          <span class="film-tag">Elite Target</span>
          <span class="film-tag">Order of the Dragon</span>
        </div>
        <div class="quote-block">"Now co-directing films and creating real casting opportunities. He's not just finding talent—he understands what it takes to succeed on set in high-octane action productions."</div>
        <p>Join FFM, build your audience, and get discovered for film roles.</p>
      </div>
    </div>
    <div class="founder-follow">
      <p>Follow <strong>David Kurzhal (Viking Samurai)</strong> for behind-the-scenes updates and casting announcements.</p>
      <div class="founder-follow-icons">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i data-lucide="mail"></i></a>
        <a href="#"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>
</section>

<section class="section-dark" id="status" style="border-top: 1px solid rgba(255,255,255,.06);">
  <div class="container">
    <h2>Current casting status</h2>
    <p class="section-sub">We're actively developing multiple martial arts film projects.</p>

    <h3 style="color:#fff;font-size:1.3rem;font-weight:700;text-align:center;margin-bottom:.75rem;">Who we want to work with</h3>
    <div class="talent-grid">
      <div class="talent-card"><div class="talent-card-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="hand"></i></div><h4>Martial Arts Skills</h4><p>Years of training</p></div>
      <div class="talent-card"><div class="talent-card-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="drama"></i></div><h4>Acting Ability</h4><p>Convey emotion</p></div>
      <div class="talent-card"><div class="talent-card-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i data-lucide="medal"></i></div><h4>Physically Fit</h4><p>Learn choreography</p></div>
      <div class="talent-card"><div class="talent-card-icon" style="background:linear-gradient(135deg,#ec4899,#db2777);"><i data-lucide="briefcase"></i></div><h4>Professional</h4><p>Reliable on set</p></div>
      <div class="talent-card"><div class="talent-card-icon" style="background:linear-gradient(135deg,#14b8a6,#0d9488);"><i data-lucide="shield"></i></div><h4>Committed to Action</h4><p>Long-term film growth</p></div>
    </div>

    <div class="waitlist-grid" id="waitlist">
      <div class="waitlist-card">
        <h3>Join the casting waitlist</h3>
        <p>Be notified when casting calls open.</p>
        <p style="color:#fb923c;font-size:.8rem;font-style:italic;margin-bottom:.75rem;">Ready to audition? Submit your information and we'll review your profile. The best talent gets contacted directly.</p>
        <form method="POST" action="https://usebasin.com/f/954d0d6e30da" onsubmit="trackGA4Event('generate_lead', {form_name: 'casting_waitlist'});">
          <input type="hidden" name="_subject" value="Casting Waitlist Application">
          <div class="form-group"><label>Full Name</label><input type="text" name="full_name" placeholder="Your full name" required></div>
          <div class="form-group"><label>Email Address</label><input type="email" name="email" placeholder="you@email.com" required></div>
          <div class="form-group"><label>Specialty</label><input type="text" name="specialty" placeholder="e.g., Martial Artist, Stunt Performer"></div>
          <div class="form-group"><label>Tell us about yourself</label><textarea name="message" placeholder="Your experience, training, and what you bring to the screen..." required></textarea></div>
          <button type="submit" class="cta-btn" style="width:100%;justify-content:center;">Join Waitlist</button>
          <p class="note">No spam, just opportunities.</p>
        </form>
      </div>
      <div style="display:flex;flex-direction:column;gap:1rem;">
        <div class="status-banner" style="margin-bottom:0;flex-direction:column;align-items:center;text-align:center;">
          <div class="status-badge">PRE-PRODUCTION PHASE</div>
          <p style="color:#94a3b8;font-size:.85rem;margin:.5rem 0;">Casting calls will open soon.<br>Be the first to know when opportunities become available.</p>
          <a class="cta-btn" href="#waitlist" style="white-space:nowrap;">Join Casting Waitlist</a>
        </div>
        <div class="waitlist-card" style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;flex:1;">
          <i data-lucide="film" style="font-size:2.5rem;color:#fb923c;margin-bottom:.75rem;"></i>
          <h3>Start Your Film Journey</h3>
          <p>FansFollow.me is where fitness creators get discovered for real film roles. Build your audience, showcase your skills, and let casting directors find you.</p>
          <a class="cta-btn" href="{{ url('signup') }}" style="justify-content:center;">Create Your Profile</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
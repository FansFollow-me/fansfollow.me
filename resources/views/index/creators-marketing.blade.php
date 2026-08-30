@extends('layouts.appnew')

@section('title') For Creators - FansFollow.me
@endsection

@section('css')
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #a855f7 100%); }
  body { background: transparent !important; background-image: none !important; }

  /* Hero */
  .creator-hero {
    position: relative;
    overflow: hidden;
    background: #0b0f1a;
    margin-top: -72px;
    min-height: 100vh;
    box-sizing: border-box;
    padding: calc(72px + 6vh) 0 8vh;
    color: #e5e7eb;
    display: flex;
    align-items: center;
  }
  .creator-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(rgba(0,0,0,.4), rgba(11,15,26,.6)), url('/creators-hero-bg.jpg') center 15%/cover no-repeat;
    z-index: 0;
  }
  .creator-hero::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 120px;
    background: linear-gradient(to bottom, transparent, rgba(11,15,26,1));
    pointer-events: none;
    z-index: 1;
  }
  .creator-hero > .container { position: relative; z-index: 2; }
  .creator-badge {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    padding: .5rem 1.25rem;
    border-radius: 999px;
    background: linear-gradient(135deg, rgba(249,115,22,.2), rgba(168,85,247,.2));
    border: 1px solid rgba(249,115,22,.3);
    color: #fdba74;
    font-size: .75rem;
    font-weight: 600;
    letter-spacing: .08em;
    text-transform: uppercase;
    margin-bottom: 1rem;
  }
  .creator-hero h1 { font-size: clamp(2rem, 3.5vw, 3rem); font-weight: 900; color: #fff; margin-bottom: .75rem; max-width: 600px; }
  .creator-hero .hero-sub { font-size: 1.05rem; color: #e2e8f0; max-width: 520px; margin: 0 0 2rem; line-height: 1.7; font-weight: 500; text-shadow: 0 1px 3px rgba(0,0,0,.5); }

  /* Shared section styles (matching For Fans) */
  .section-dark { padding: 4rem 0; background: linear-gradient(to right bottom, #111827, #1f2937, #111827); }
  .section-dark h2 { font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 900; color: #fff; text-align: left; margin-bottom: 2rem; }
  .section-sub { text-align: center; color: #d1d5db; max-width: 600px; margin: 0 auto 2.5rem; font-size: 1rem; line-height: 1.7; }
  .section-badge {
    font-size: .75rem; font-weight: 700; color: #fb923c; text-transform: uppercase; letter-spacing: .1em; margin-bottom: .75rem;
  }

  /* Content grid: cards left + sidebar right (matching For Fans) */
  .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; max-width: 1140px; margin: 0 auto; align-items: start; }
  .creators-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.1rem; align-items: stretch; }
  .creator-card { background: rgba(31,41,55,.5); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(55,65,81,.3); border-radius: 12px; padding: 1.4rem; transition: all .3s; box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1); }
  .creator-card:hover { border-color: rgba(249,115,22,.5); }
  .creator-card-icon { width: 48px; height: 48px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .75rem; color: #fff; }
  .creator-card-icon i, .creator-card-icon svg.lucide { width: 1.25rem; height: 1.25rem; color: #fff; }
  .creator-card h4 { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: .25rem; }
  .creator-card p { color: #d1d5db; font-size: .875rem; line-height: 1.45; margin: 0; }

  /* Sidebar glass panel (matching For Fans' why-fans-card) */
  .why-creators-card { background: rgba(31,41,55,.6); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(55,65,81,.4); border-radius: 16px; padding: 2rem 1.75rem; position: sticky; top: 8rem; }
  .why-creators-card h3 { color: #fff; font-size: 1.4rem; font-weight: 800; margin-bottom: 1.4rem; line-height: 1.3; }
  .why-creators-item { display: flex; gap: .7rem; margin-bottom: .85rem; align-items: flex-start; }
  .why-creators-item::before { content: ''; width: 7px; height: 7px; border-radius: 50%; background: #fb923c; flex-shrink: 0; margin-top: .4rem; }
  .why-creators-item strong { color: #fff; font-size: .9rem; display: block; margin-bottom: .15rem; }
  .why-creators-item p { color: #d1d5db; font-size: .85rem; line-height: 1.45; margin: 0; }

  /* How it works steps (matching For Fans) */
  .steps-flow {
    display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; max-width: 1100px; margin: 0 auto 2rem; position: relative;
  }
  .steps-flow::before {
    content: ''; position: absolute; top: 3rem; left: 16.66%; right: 16.66%; height: 2px;
    background: linear-gradient(90deg, transparent, rgba(249,115,22,.3), rgba(168,85,247,.3), transparent); z-index: 0;
  }
  .step-merged {
    position: relative; z-index: 1; background: rgba(255,255,255,.04); border-radius: 16px; padding: 1.5rem;
    display: flex; flex-direction: column; gap: .75rem;
  }
  .step-header { display: flex; align-items: center; gap: .75rem; }
  .step-badge {
    width: 40px; height: 40px; border-radius: 50%; background: var(--home-gradient); color: #fff;
    font-weight: 800; font-size: .95rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
  }
  .step-header h4 { color: #fff; font-size: 1rem; font-weight: 700; margin: 0; }
  .step-body { padding-left: 3.25rem; }
  .step-body p { color: #d1d5db; font-size: .85rem; line-height: 1.55; margin: 0; }

  /* CTA */
  .cta-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.75rem; border-radius: 12px; background: var(--home-gradient); color: #fff; font-weight: 700; font-size: 1rem; text-decoration: none; transition: all .3s; box-shadow: 0 14px 28px rgba(249,115,22,.3); }
  .cta-btn:hover { transform: scale(1.05); box-shadow: 0 20px 30px rgba(249,115,22,.4); }

  /* Final CTA photo section */
  .section-photo { position: relative; overflow: hidden; background: linear-gradient(rgba(0,0,0,.5), rgba(15,23,42,.5)), url('/ffmherobackground.jpg') center/cover no-repeat; padding: 5rem 0; text-align: center; }
  .section-photo h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 900; color: #fff; margin-bottom: .5rem; }
  .section-photo p { color: #d1d5db; font-size: 1rem; max-width: 500px; margin: 0 auto 2rem; line-height: 1.7; }

  @media (max-width: 768px) { .creators-grid, .steps-flow { grid-template-columns: 1fr; } .content-grid { grid-template-columns: 1fr; } .steps-flow::before { display: none; } }
  @media (max-width: 767.98px) {
    .creator-hero { min-height: auto; padding: calc(72px + 1.5rem) 0 1.5rem; }
    .section-dark { padding: 1.25rem 0; }
    .section-photo { padding: 1.5rem 0; }
  }
</style>
@endsection

@section('content')
<section class="creator-hero">
  <div class="container">
    <div class="creator-badge">FITNESS, NUTRITION, BODYBUILDING, MARTIAL ARTS, MARTIAL ART ACTORS & COMBAT SPORTS</div>
    <h1>Ready to grow your fitness brand?</h1>
    <p class="hero-sub">Join fitness, martial arts and combat sports creators building loyal fan communities and new revenue streams on FansFollow.me.</p>
    <a class="cta-btn" href="{{ url('signup') }}">Create Your Profile Now <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
  </div>
</section>

<section class="section-dark">
  <div class="container">
    <div class="content-grid">
      <div class="content-left">
        <p class="section-badge">For Creators</p>
        <h2>Revenue streams</h2>
        <div class="creators-grid">
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="repeat"></i></div><h4>Subscriptions</h4><p>Recurring monthly income from your fan community.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="message-circle"></i></div><h4>Paid Chats</h4><p>Get paid for private messages and direct conversations.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i data-lucide="phone"></i></div><h4>Phone Calls</h4><p>Paid voice calls for coaching and consultations.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#ec4899,#db2777);"><i data-lucide="video"></i></div><h4>Video Sessions</h4><p>One-on-one or group video training and coaching.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#14b8a6,#0d9488);"><i data-lucide="lock"></i></div><h4>Paid Videos & Streams</h4><p>Sell exclusive videos and pay-per-view live streams.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);"><i data-lucide="gift"></i></div><h4>Tips & Supporters</h4><p>Receive tips and one-off support from fans.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#8b5cf6,#6d28d9);"><i data-lucide="dumbbell"></i></div><h4>Training Programs</h4><p>Sell fitness and nutrition programs directly to fans.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#10b981,#059669);"><i data-lucide="apple"></i></div><h4>Meal Plans</h4><p>Customised meal plans and diet guides as digital products.</p></div>
          <div class="creator-card"><div class="creator-card-icon" style="background:linear-gradient(135deg,#f97316,#a855f7);"><i data-lucide="shopping-bag"></i></div><h4>Product Sales</h4><p>Sell merch, supplements and digital downloads.</p></div>
        </div>
      </div>
      <div class="why-creators-card">
        <h3>Why creators choose us</h3>
        <div class="why-creators-item"><strong>Keep 80%+ of earnings</strong><p>Industry-leading revenue share across all revenue types.</p></div>
        <div class="why-creators-item"><strong>Get paid your way</strong><p>Bank transfer or crypto with low fees and fast processing.</p></div>
        <div class="why-creators-item"><strong>Direct fan connection</strong><p>Paid calls, chats and coaching to build long-term clients.</p></div>
        <div class="why-creators-item"><strong>Secure & professional</strong><p>Encrypted messaging and automated billing for your brand.</p></div>
        <div class="why-creators-item"><strong>Track your success</strong><p>Dashboard for earnings, fans and content performance.</p></div>
        <div class="why-creators-item"><strong>Built for your niche</strong><p>Made for fitness, martial arts and combat sports creators.</p></div>
        <div class="why-creators-item"><strong>Earn FFM reward tokens</strong><p>Earn extra tokens as fans engage on the platform.</p></div>
        <div class="why-creators-item"><strong>Negotiate higher rates</strong><p>Large creators can discuss custom terms above 80%+.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="section-dark" style="border-top: 1px solid rgba(255,255,255,.06);">
  <div class="container">
    <h2>How it works for creators</h2>
    <p class="section-sub">Get started in three simple steps and turn your expertise into paid content and fan relationships.</p>
    <div class="steps-flow">
      <div class="step-merged">
        <div class="step-header"><div class="step-badge">1</div><h4>Create your profile</h4></div>
        <div class="step-body"><p>Sign up in under 5 minutes with your links, photos and the types of offers you want to provide.</p></div>
      </div>
      <div class="step-merged">
        <div class="step-header"><div class="step-badge">2</div><h4>Set up your revenue streams</h4></div>
        <div class="step-body"><p>Add paid chats, video sessions, programs, meal plans or products using simple templates.</p></div>
      </div>
      <div class="step-merged">
        <div class="step-header"><div class="step-badge">3</div><h4>Start earning and connecting</h4></div>
        <div class="step-body"><p>Share your link, use QR codes at events and convert fans into long-term clients on one platform.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="section-photo">
  <div class="container">
    <h2>Ready to start earning?</h2>
    <p>Join thousands of creators already making money on FansFollow</p>
    <a class="cta-btn" href="{{ url('signup') }}">Create Your Profile Now <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
  </div>
</section>
@endsection

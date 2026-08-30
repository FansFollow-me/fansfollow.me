@extends('layouts.appnew')

@section('title') For Fans - FansFollow.me
@endsection

@section('css')
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #a855f7 100%); }
  body { background: transparent !important; background-image: none !important; }

  .fans-hero {
    position: relative;
    overflow: hidden;
    background:
      linear-gradient(90deg, rgba(0,0,0,.75), rgba(15,23,42,.5) 50%, rgba(15,23,42,.3)),
      url('/fans-hero-bg.jpg') center/cover no-repeat;
    padding: 0 0 6rem;
    margin-top: -72px;
    padding-top: 5rem;
    color: #e5e7eb;
    min-height: 100svh;
    display: flex;
    align-items: center;
  }
  .fans-hero .container { width: fit-content; margin: 0 auto; }
  .fans-hero::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 150px;
    background: linear-gradient(to bottom, transparent, rgba(11,15,26,1));
    pointer-events: none;
    z-index: 1;
  }
  .fans-hero .hero-text { max-width: 48rem; padding-top: 5rem; }
  .fans-hero h1 { font-size: clamp(2.25rem, 5vw, 3.75rem); font-weight: 900; color: #fff; margin-bottom: 2rem; line-height: 1; max-width: none; text-align: left; }
  .fans-hero p { font-size: 1.25rem; color: #d1d5db; max-width: 48rem; margin: 0 0 3rem; line-height: 1.625; text-align: left; }

  .section-dark { padding: 4rem 0; background: linear-gradient(to right bottom, #111827, #1f2937, #111827); }
  .section-dark h2 { font-size: clamp(1.5rem, 3vw, 2.25rem); font-weight: 900; color: #fff; text-align: left; margin-bottom: 2rem; }
  .section-sub { text-align: center; color: #d1d5db; max-width: 600px; margin: 0 auto 2.5rem; font-size: 1rem; line-height: 1.7; }
  .section-badge {
    font-size: .75rem; font-weight: 700; color: #fb923c; text-transform: uppercase; letter-spacing: .1em; margin-bottom: .75rem;
  }

  .content-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 3rem; max-width: 1140px; margin: 0 auto; align-items: start; }
  .fans-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; align-items: stretch; }
  .fans-card { background: rgba(31,41,55,.5); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(55,65,81,.3); border-radius: 12px; padding: 2rem; transition: all .3s; box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 4px 6px -4px rgba(0,0,0,.1); }
  .fans-card:hover { border-color: rgba(249,115,22,.5); }
  .fans-card-icon { width: 48px; height: 48px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .75rem; color: #fff; }
  .fans-card-icon i, .fans-card-icon svg.lucide { width: 1.25rem; height: 1.25rem; color: #fff; }
  .fans-card h4 { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: .5rem; }
  .fans-card p { color: #d1d5db; font-size: .875rem; line-height: 1.44; margin: 0; }

  .why-fans-card { background: rgba(31,41,55,.6); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border: 1px solid rgba(55,65,81,.4); border-radius: 16px; padding: 3rem 2rem; position: sticky; top: 8rem; }
  .why-fans-card h3 { color: #fff; font-size: 1.5rem; font-weight: 800; margin-bottom: 2rem; line-height: 1.3; }
  .why-fans-item { display: flex; gap: .75rem; margin-bottom: 1.25rem; align-items: flex-start; }
  .why-fans-item::before { content: ''; width: 8px; height: 8px; border-radius: 50%; background: #fb923c; flex-shrink: 0; margin-top: .4rem; }
  .why-fans-item strong { color: #fff; font-size: .9rem; display: block; margin-bottom: .15rem; }
  .why-fans-item p { color: #d1d5db; font-size: .82rem; line-height: 1.5; margin: 0; }

  /* Merged step cards */
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

  .cta-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .75rem 1.75rem; border-radius: 12px; background: var(--home-gradient); color: #fff; font-weight: 700; font-size: 1rem; text-decoration: none; transition: all .3s; box-shadow: 0 14px 28px rgba(249,115,22,.3); }
  .cta-btn:hover { transform: scale(1.05); box-shadow: 0 20px 30px rgba(249,115,22,.4); }

  .section-photo { position: relative; overflow: hidden; background: linear-gradient(rgba(0,0,0,.5), rgba(15,23,42,.5)), url('/ffmherobackground.jpg') center/cover no-repeat; padding: 5rem 0; text-align: center; }
  .section-photo h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 900; color: #fff; margin-bottom: .5rem; }
  .section-photo p { color: #d1d5db; font-size: 1rem; max-width: 500px; margin: 0 auto 2rem; line-height: 1.7; }

  @media (max-width: 768px) { .fans-grid, .steps-flow { grid-template-columns: 1fr; } .content-grid { grid-template-columns: 1fr; } .steps-flow::before { display: none; } }
  @media (max-width: 767.98px) {
    .fans-hero { padding-top: calc(72px + 1.5rem); min-height: auto; }
    .fans-hero .hero-text { padding-top: 1.5rem; }
    .section-dark { padding: 0.75rem 0; }
    .section-photo { padding: 1.5rem 0; }
  }
</style>
@endsection

@section('content')
<section class="fans-hero">
  <div class="container">
    <div class="hero-text">
      <h1>Discover and connect<br>with your favourite<br>fitness creators</h1>
      <p>Find fighters, coaches, bodybuilders and fitness influencers in one place and get closer access through chats, exclusive content, calls and video sessions.</p>
      <a class="cta-btn" href="{{ url('signup') }}">Sign Up as Fan – It's Free <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
    </div>
  </div>
</section>

<section class="section-dark">
  <div class="container">
    <div class="content-grid">
      <div class="content-left">
        <p class="section-badge">For Fans</p>
        <h2>Ways to connect with creators</h2>
        <div class="fans-grid">
          <div class="fans-card"><div class="fans-card-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="message-circle"></i></div><h4>Private Chats</h4><p>Message creators directly and get personal replies.</p></div>
          <div class="fans-card"><div class="fans-card-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="video"></i></div><h4>Exclusive Videos & Streams</h4><p>Unlock members-only videos and live events.</p></div>
          <div class="fans-card"><div class="fans-card-icon" style="background:linear-gradient(135deg,#ec4899,#db2777);"><i data-lucide="gift"></i></div><h4>Tips & Support</h4><p>Tip your favourite athletes and show extra support.</p></div>
          <div class="fans-card"><div class="fans-card-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i data-lucide="dumbbell"></i></div><h4>Training Programs</h4><p>Access structured plans from trusted coaches.</p></div>
          <div class="fans-card"><div class="fans-card-icon" style="background:linear-gradient(135deg,#10b981,#059669);"><i data-lucide="apple"></i></div><h4>Meal Plans</h4><p>Get nutrition plans tailored by fitness experts.</p></div>
          <div class="fans-card"><div class="fans-card-icon" style="background:linear-gradient(135deg,#f59e0b,#d97706);"><i data-lucide="shopping-bag"></i></div><h4>Merch & Products</h4><p>Buy branded gear, supplements and digital downloads.</p></div>
        </div>
      </div>
      <div class="why-fans-card">
        <h3>Why fans love FansFollow.me</h3>
        <div class="why-fans-item"><strong>Closer access</strong><p>Go beyond social media with real conversations and interactions.</p></div>
        <div class="why-fans-item"><strong>All your favourites in one place</strong><p>Follow multiple fitness and combat sports creators on a single platform.</p></div>
        <div class="why-fans-item"><strong>Safe & secure</strong><p>Protected payments and private communication with creators.</p></div>
        <div class="why-fans-item"><strong>Global access</strong><p>Support creators from any country with card or crypto payments.</p></div>
        <div class="why-fans-item"><strong>Easy to use</strong><p>Simple mobile-friendly experience for chats, content and calls.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="section-dark" style="border-top: 1px solid rgba(255,255,255,.06);">
  <div class="container">
    <h2>How it works for fans</h2>
    <p class="section-sub">Join in minutes and start following your favourite fitness and combat sports creators.</p>
    <div class="steps-flow">
      <div class="step-merged">
        <div class="step-header"><div class="step-badge">1</div><h4>Create your fan account</h4></div>
        <div class="step-body"><p>Sign up for free and choose your interests so we can recommend creators you'll love.</p></div>
      </div>
      <div class="step-merged">
        <div class="step-header"><div class="step-badge">2</div><h4>Follow and unlock content</h4></div>
        <div class="step-body"><p>Subscribe, tip and unlock exclusive content from the creators you follow.</p></div>
      </div>
      <div class="step-merged">
        <div class="step-header"><div class="step-badge">3</div><h4>Get closer access</h4></div>
        <div class="step-body"><p>Join private chats, calls and video sessions to build real connections.</p></div>
      </div>
    </div>
  </div>
</section>

<section class="section-photo">
  <div class="container">
    <h2>Ready to support your favourite creators?</h2>
    <p>Create your free fan account today and start connecting with fighters, coaches and fitness creators worldwide.</p>
    <a class="cta-btn" href="{{ url('signup') }}">Sign Up as Fan – It's Free <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
  </div>
</section>
@endsection
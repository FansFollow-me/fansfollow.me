@extends('layouts.appnew')

@section('title') Business - FansFollow.me
@endsection

@section('css')
<style>
  :root { color-scheme: dark; --home-gradient: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #a855f7 100%); }

  /* ── Hero ── */
  .biz-hero {
    position: relative; overflow: hidden; background: #0b0f1a;
    margin-top: -72px; padding: calc(72px + 5rem) 0 4rem;
    min-height: 100vh; display: flex; align-items: center; justify-content: center;
    text-align: center; color: #e5e7eb;
  }
  .biz-hero::before { content: ''; position: absolute; inset: 0; background: url('/business-hero.jpg') center/cover no-repeat; z-index: 0; }
  .biz-hero::after { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,.5); z-index: 1; }
  .biz-hero > .container { position: relative; z-index: 2; }
  .biz-badge {
    display: inline-flex; align-items: center; gap: .4rem; padding: .4rem 1rem;
    border-radius: 999px; background: linear-gradient(135deg, rgba(245,158,11,.2), rgba(249,115,22,.2));
    border: 1px solid rgba(245,158,11,.3); color: #fbbf24;
    font-size: .85rem; font-weight: 700; letter-spacing: .08em; text-transform: uppercase; margin-bottom: 1.5rem;
  }
  .biz-hero h1 { font-size: clamp(2.25rem, 4vw, 3.5rem); font-weight: 900; color: #fff; margin-bottom: .75rem; max-width: 650px; margin-left: auto; margin-right: auto; }
  .biz-hero p { font-size: 1.125rem; color: #e2e8f0; max-width: 900px; margin: 0 auto 2rem; line-height: 1.7; font-weight: 500; text-shadow: 0 1px 3px rgba(0,0,0,.5); }
  .hero-btns { display: flex; gap: .75rem; justify-content: center; flex-wrap: wrap; }

  /* ── Buttons ── */
  .cta-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .9rem 2.25rem; border-radius: 12px; background: var(--home-gradient); color: #fff; font-weight: 700; font-size: 1.05rem; text-decoration: none; transition: all .3s; box-shadow: 0 14px 28px rgba(249,115,22,.24); }
  .cta-btn:hover { transform: translateY(-2px); box-shadow: 0 20px 30px rgba(249,115,22,.3); }
  .cta-btn-outline { display: inline-flex; align-items: center; gap: .5rem; padding: .9rem 2.25rem; border-radius: 12px; background: rgba(30,41,59,.6); border: 1px solid rgba(255,255,255,.15); color: #e2e8f0; font-weight: 700; font-size: 1.05rem; text-decoration: none; transition: all .3s; }
  .cta-btn-outline:hover { background: rgba(51,65,85,.6); }

  /* ── Sections ── */
  .section-dark { padding: 2.5rem 0; }
  .section-dark h2 { font-size: clamp(1.8rem, 3vw, 2.5rem); font-weight: 800; color: #fff; text-align: center; margin-bottom: .5rem; }
  .section-sub { text-align: center; color: #94a3b8; max-width: 650px; margin: 0 auto 2rem; font-size: 1rem; line-height: 1.7; }
  .section-gradient { background: linear-gradient(to bottom, rgba(15,23,42,.4), rgba(17,24,39,.6)); }

  /* ── Partner cards ── */
  .partner-cards { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; max-width: 1100px; margin: 0 auto 1.5rem; }
  .partner-card {
    background: linear-gradient(135deg, rgba(31,41,55,.7), rgba(15,23,42,.8));
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255,255,255,.12); border-radius: 16px; padding: 1.5rem;
    transition: all .3s ease; box-shadow: 0 10px 15px -3px rgba(0,0,0,.15), 0 4px 6px -4px rgba(0,0,0,.1), 0 0 20px rgba(249,115,22,.06);
  }
  .partner-card:hover { transform: translateY(-4px) scale(1.02); border-color: rgba(249,115,22,.4); box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 30px rgba(249,115,22,.2); }
  .partner-card-icon { width: 48px; height: 48px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .75rem; color: #fff; }
  .partner-card-icon i, .partner-card-icon svg.lucide { width: 1.25rem; height: 1.25rem; color: #fff; }
  .partner-card h4 { color: #fff; font-size: 1rem; font-weight: 700; margin-bottom: .3rem; }
  .partner-card p { color: #94a3b8; font-size: .85rem; line-height: 1.6; margin: 0; }

  /* ── Model cards ── */
  .model-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.25rem; max-width: 1100px; margin: 0 auto; }
  .model-card {
    background: linear-gradient(135deg, rgba(31,41,55,.7), rgba(15,23,42,.8));
    border: 1px solid rgba(255,255,255,.1); border-radius: 16px; padding: 1.5rem;
    display: flex; flex-direction: column;
    transition: all .3s ease; box-shadow: 0 10px 15px -3px rgba(0,0,0,.15), 0 4px 6px -4px rgba(0,0,0,.1), 0 0 20px rgba(249,115,22,.06);
  }
  .model-card:hover { transform: translateY(-4px); box-shadow: 0 20px 40px rgba(0,0,0,.3), 0 0 30px rgba(249,115,22,.2); border-color: rgba(249,115,22,.3); }
  .model-card h4 { color: #fff; font-size: 1.1rem; font-weight: 700; margin-bottom: .5rem; }
  .model-card > p { color: #94a3b8; font-size: .9rem; line-height: 1.6; margin-bottom: 1rem; }
  .model-card ul { list-style: none; padding: 0; margin: 0 0 1.5rem; flex: 1; }
  .model-card li { color: #cbd5e1; font-size: .85rem; padding: .3rem 0; }
  .model-card li::before { content: "✓ "; color: #4ade80; font-weight: 700; }
  .model-btn { display: inline-flex; align-items: center; gap: .5rem; padding: .7rem 1.5rem; border-radius: 10px; font-weight: 700; font-size: .9rem; text-decoration: none; color: #fff; transition: all .3s; }
  .model-btn:hover { transform: translateY(-1px); }
  .model-btn.orange { background: linear-gradient(135deg, #f97316, #fb923c); box-shadow: 0 8px 20px rgba(249,115,22,.25); }
  .model-btn.orange:hover { box-shadow: 0 12px 28px rgba(249,115,22,.35); }
  .model-btn.pink { background: linear-gradient(135deg, #ec4899, #f472b6); box-shadow: 0 8px 20px rgba(236,72,153,.25); }
  .model-btn.pink:hover { box-shadow: 0 12px 28px rgba(236,72,153,.35); }
  .model-btn.blue { background: linear-gradient(135deg, #3b82f6, #60a5fa); box-shadow: 0 8px 20px rgba(59,130,246,.25); }
  .model-btn.blue:hover { box-shadow: 0 12px 28px rgba(59,130,246,.35); }

  /* ── Token section ── */
  .token-section { background: linear-gradient(to right bottom, rgba(31,41,55,.6), rgba(17,24,39,.6)); border-top: 1px solid rgba(255,255,255,.06); border-bottom: 1px solid rgba(255,255,255,.06); padding: 2.5rem 0; }
  .token-panel { max-width: 900px; margin: 0 auto; }
  .token-panel h3 { color: #fff; font-size: 1.3rem; font-weight: 700; margin-bottom: .5rem; }
  .token-panel > p { color: #94a3b8; font-size: .95rem; line-height: 1.7; margin-bottom: 1.5rem; }
  .token-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem; margin-bottom: 1.5rem; }
  .token-item {
    background: rgba(15,23,42,.5); border: 1px solid rgba(255,255,255,.06);
    border-radius: 12px; padding: 1rem; display: flex; align-items: flex-start; gap: .75rem;
    transition: border-color .3s;
  }
  .token-item:hover { border-color: rgba(249,115,22,.3); }
  .token-icon { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; font-size: .85rem; color: #fff; }
  .token-item h5 { color: #fff; font-size: .9rem; font-weight: 700; margin-bottom: .2rem; }
  .token-item p { color: #94a3b8; font-size: .8rem; margin: 0; }
  .token-links { display: flex; gap: 1rem; }
  .token-links a { color: #60a5fa; font-weight: 600; font-size: .9rem; text-decoration: none; }
  .token-links a:hover { color: #93c5fd; }

  /* ── FAQ accordion ── */
  .faq-grid { max-width: 800px; margin: 0 auto; }
  .faq-item { background: rgba(15,23,42,.6); border: 1px solid rgba(255,255,255,.08); border-radius: 12px; margin-bottom: .5rem; overflow: hidden; transition: border-color .3s; }
  .faq-item:hover { border-color: rgba(255,255,255,.15); }
  .faq-item.open { border-color: rgba(249,115,22,.3); }
  .faq-q {
    padding: .85rem 1.25rem; color: #fff; font-weight: 600; font-size: .95rem;
    cursor: pointer; display: flex; justify-content: space-between; align-items: center;
    transition: color .3s;
  }
  .faq-q:hover { color: #fb923c; }
  .faq-chevron { color: #94a3b8; font-size: 1.1rem; transition: transform .3s; flex-shrink: 0; margin-left: 1rem; }
  .faq-item.open .faq-chevron { transform: rotate(180deg); color: #fb923c; }
  .faq-a { padding: 0 1.25rem; color: #94a3b8; font-size: .9rem; line-height: 1.6; max-height: 0; overflow: hidden; transition: max-height .3s ease, padding .3s ease; }
  .faq-item.open .faq-a { max-height: 200px; padding: 0 1.25rem .85rem; }

  /* ── Contact form ── */
  .contact-section {
    border-top: 3px solid;
    border-image: linear-gradient(135deg, #f97316, #ec4899) 1;
    background: linear-gradient(to right bottom, rgba(31,41,55,.6), rgba(17,24,39,.6));
  }
  .contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; max-width: 1000px; margin: 0 auto; align-items: stretch; }
  .form-card { background: rgba(15,23,42,.65); border: 1px solid rgba(255,255,255,.08); border-radius: 16px; padding: 1.5rem; }
  .form-card h3 { color: #fff; font-size: 1.2rem; font-weight: 700; margin-bottom: .3rem; }
  .form-card > p { color: #94a3b8; font-size: .9rem; margin-bottom: 1rem; }
  .form-group { margin-bottom: .75rem; }
  .form-group label { display: block; color: #e2e8f0; font-size: .85rem; font-weight: 600; margin-bottom: .3rem; }
  .form-group input, .form-group textarea, .form-group select {
    width: 100%; padding: .5rem .75rem; border-radius: 10px;
    border: 1px solid rgba(148,163,184,.18); background: rgba(15,23,42,.6); color: #e2e8f0; font-size: .85rem;
  }
  .form-group input::placeholder, .form-group textarea::placeholder { color: #64748b; }
  .form-group select { appearance: auto; }
  .form-group textarea { min-height: 60px; resize: vertical; }

  .contact-aside {
    background: rgba(15,23,42,.65); border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px; padding: 2rem; text-align: center;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    box-shadow: 0 10px 15px -3px rgba(0,0,0,.1), 0 0 20px rgba(249,115,22,.06);
  }
  .contact-aside-icon { width: 64px; height: 64px; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin-bottom: 1.25rem; font-size: 1.75rem; color: #fff; }
  .contact-aside h4 { color: #fff; font-size: 1.2rem; font-weight: 700; margin-bottom: 1rem; }
  .contact-aside ul { list-style: none; padding: 0; margin: 0; text-align: left; }
  .contact-aside li { color: #cbd5e1; font-size: .9rem; padding: .5rem 0; display: flex; align-items: center; gap: .6rem; }
  .contact-aside li::before { content: "✓"; color: #4ade80; font-weight: 700; font-size: .9rem; }

  @media (max-width: 768px) { .partner-cards, .model-grid, .token-grid, .contact-grid { grid-template-columns: 1fr; } }
  @media (max-width: 767.98px) {
    .biz-hero { min-height: auto; padding: calc(72px + 1.5rem) 0 1.5rem; }
    .section-dark { padding: 1.25rem 0; }
    .section-photo { padding: 1.5rem 0; }
  }
</style>
@endsection

@section('content')
<section class="biz-hero">
  <div class="container">
    <div class="biz-badge">💼 BUSINESS PARTNERSHIPS</div>
    <h1>Grow with the fitness creator economy</h1>
    <p>Partner with FansFollow.me to reach high-intent audiences across fitness, combat sports and film through a<br>premium creator platform built for long-term value.</p>
    <div class="hero-btns">
      <a class="cta-btn" href="#contact">Schedule Partnership Call <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72"/></svg></a>
      <a class="cta-btn-outline" href="#models">Explore Models <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></a>
    </div>
  </div>
</section>

<section class="section-dark section-gradient">
  <div class="container">
    <h2>Why partner with FansFollow</h2>
    <p class="section-sub">FansFollow connects fitness, combat-sports and film talent with paying fans through a safe, professional platform built for long-term careers.</p>
    <div class="partner-cards">
      <div class="partner-card"><div class="partner-card-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="users"></i></div><h4>Creator-Centric</h4><p>Creators keep more of what they earn and participate in the value they create.</p></div>
      <div class="partner-card"><div class="partner-card-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="trending-up"></i></div><h4>Long-Term Value</h4><p>Built for sustainable careers, not quick hits. Real opportunities in film and beyond.</p></div>
      <div class="partner-card"><div class="partner-card-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i data-lucide="shield"></i></div><h4>Brand Safety</h4><p>Professional vetting and moderation ensure brand-safe partnerships.</p></div>
    </div>
  </div>
</section>

<section class="section-dark" id="models">
  <div class="container">
    <h2>Partnership models</h2>
    <p class="section-sub">Choose the opportunity that aligns with your business goals.</p>
    <div class="model-grid">
      <div class="model-card">
        <h4>Strategic Partnerships</h4>
        <p>Reach new audiences and build revenue with fitness brands, gyms, studios and media companies.</p>
        <ul><li>Audience expansion</li><li>Revenue sharing models</li><li>Co-marketing support</li></ul>
        <a class="model-btn orange" href="#contact">Discuss Partnership</a>
      </div>
      <div class="model-card">
        <h4>Regional Franchise</h4>
        <p>Gain exclusive regional rights to grow FansFollow in your territory with full platform support.</p>
        <ul><li>Exclusive territory rights</li><li>Full platform technology</li><li>Training & ongoing support</li></ul>
        <a class="model-btn pink" href="#contact">Enquire about Franchise</a>
      </div>
      <div class="model-card">
        <h4>Investment & M&A</h4>
        <p>Strategic acquisitions and partnerships for investors and platform owners.</p>
        <ul><li>Platform acquisitions</li><li>Strategic investments</li><li>Equity opportunities</li></ul>
        <a class="model-btn blue" href="#contact">Talk to Our Team</a>
      </div>
    </div>
  </div>
</section>

<section class="token-section">
  <div class="container">
    <div class="token-panel">
      <div class="biz-badge" style="margin-bottom:1rem;">PAYMENT INFRASTRUCTURE</div>
      <h3>FFM Token – Creator Economics Reimagined</h3>
      <p>FFM Token is the payment infrastructure powering FansFollow, designed to reduce fees and reward creators for their contributions to the ecosystem.</p>
      <div class="token-grid">
        <div class="token-item"><div class="token-icon" style="background:linear-gradient(135deg,#f97316,#ea580c);"><i data-lucide="percent"></i></div><div><h5>Lower Fees</h5><p>Reduced processing costs vs traditional platforms.</p></div></div>
        <div class="token-item"><div class="token-icon" style="background:linear-gradient(135deg,#a855f7,#7c3aed);"><i data-lucide="gift"></i></div><div><h5>Rewards System</h5><p>Earn based on activity and engagement.</p></div></div>
        <div class="token-item"><div class="token-icon" style="background:linear-gradient(135deg,#3b82f6,#2563eb);"><i data-lucide="crown"></i></div><div><h5>Creator Ownership</h5><p>Long-term stake in the ecosystem.</p></div></div>
        <div class="token-item"><div class="token-icon" style="background:linear-gradient(135deg,#10b981,#059669);"><i data-lucide="eye"></i></div><div><h5>Transparent</h5><p>Full documentation and real-time tracking.</p></div></div>
      </div>
      <div class="token-links">
        <a href="#">Visit FFM Token ↗</a>
        <a href="#">View Documentation ↗</a>
      </div>
    </div>
  </div>
</section>

<section class="section-dark">
  <div class="container">
    <h2>Common questions</h2>
    <p class="section-sub">Everything you need to know about partnering with FansFollow.</p>
    <div class="faq-grid">
      <div class="faq-item"><div class="faq-q" onclick="this.parentElement.classList.toggle('open')">What types of partnerships does FansFollow offer?<span class="faq-chevron">▾</span></div><div class="faq-a">We work with fitness brands, gyms, studios, media companies, and regional operators. Each partnership is customized to fit your business goals and market position.</div></div>
      <div class="faq-item"><div class="faq-q" onclick="this.parentElement.classList.toggle('open')">How do franchise rights work?<span class="faq-chevron">▾</span></div><div class="faq-a">Franchise operators gain exclusive regional rights to grow FansFollow in their territory, with full platform technology, marketing support, training, and ongoing technical assistance.</div></div>
      <div class="faq-item"><div class="faq-q" onclick="this.parentElement.classList.toggle('open')">Are you open to acquisitions or investments?<span class="faq-chevron">▾</span></div><div class="faq-a">Yes. We explore strategic acquisitions of complementary fitness, wellness and creator platforms, and welcome inquiries from investors interested in FansFollow's growth.</div></div>
      <div class="faq-item"><div class="faq-q" onclick="this.parentElement.classList.toggle('open')">What is the FFM Token?<span class="faq-chevron">▾</span></div><div class="faq-a">FFM Token is our payment infrastructure designed to reduce transaction fees and reward creators. We can discuss how it integrates with partnership models during your call.</div></div>
    </div>
  </div>
</section>

<section class="section-dark contact-section" id="contact">
  <div class="container">
    <h2>Ready to partner?</h2>
    <p class="section-sub">Tell us about your business and let's explore how we can grow together.</p>
    <div class="contact-grid">
      <div class="form-card">
        <form method="POST" action="https://usebasin.com/f/954d0d6e30da" onsubmit="trackGA4Event('generate_lead', {form_name: 'business_partnership'});">
          <input type="hidden" name="_subject" value="Business Partnership Inquiry">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:.75rem;">
            <div class="form-group"><label>Full Name</label><input type="text" name="full_name" placeholder="Your name" required></div>
            <div class="form-group"><label>Company / Organization</label><input type="text" name="company" placeholder="Company name"></div>
          </div>
          <div class="form-group"><label>Email Address</label><input type="email" name="email" placeholder="you@company.com" required></div>
          <div class="form-group"><label>Type of Opportunity</label><select name="opportunity"><option>Select an option</option><option>Strategic Partnership</option><option>Regional Franchise</option><option>Investment & M&A</option><option>Other</option></select></div>
          <div class="form-group"><label>Message</label><textarea name="message" placeholder="Tell us about your business goals..." required></textarea></div>
          <button type="submit" class="cta-btn" style="width:100%;justify-content:center;">Schedule Partnership Call</button>
        </form>
      </div>
      <div class="contact-aside">
        <div class="contact-aside-icon" style="background:linear-gradient(135deg,#f97316,#a855f7);"><i data-lucide="handshake"></i></div>
        <h4>What happens next?</h4>
        <ul>
          <li>We respond within 24 hours</li>
          <li>No obligation, no pressure</li>
          <li>Custom proposal within a week</li>
        </ul>
      </div>
    </div>
  </div>
</section>
@endsection

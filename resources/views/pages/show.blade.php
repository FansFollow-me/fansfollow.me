@extends('layouts.appnew')

@section('title') {{ $response->title }} -@endsection
@section('description_custom'){{ $response->description ? $response->description : trans('seo.description') }}@endsection
@section('keywords_custom'){{ $response->keywords ? $response->keywords.',' : null }}@endsection

@section('css')
  <style>
    .page-shell--token {
      padding: 4rem 0 5rem;
      background: transparent;
    }
    .token-hero {
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(320px, .9fr);
      gap: 2rem;
      align-items: center;
      margin-bottom: 1.75rem;
    }
    .token-hero__eyebrow {
      color: #60a5fa;
      text-transform: uppercase;
      font-size: 0.82rem;
      font-weight: 800;
      margin-bottom: 0.55rem;
      letter-spacing: 0;
    }
    .token-hero h1 {
      margin: 0 0 0.8rem;
      font-size: clamp(2.4rem, 4vw, 4rem);
      line-height: 0.98;
      color: #e5e7eb;
      max-width: 12ch;
    }
    .token-hero p {
      margin: 0;
      max-width: 48rem;
      color: #cbd5e1;
      line-height: 1.65;
      font-size: 1.05rem;
    }
    .token-visual {
      border: 1px solid rgba(148, 163, 184, 0.14);
      border-radius: 20px;
      box-shadow: 0 22px 60px rgba(0, 0, 0, 0.24);
      overflow: hidden;
      background: rgba(15, 23, 42, 0.88);
    }
    .token-visual img {
      display: block;
      width: 100%;
      height: auto;
    }
    .token-section {
      margin-top: 1.25rem;
    }
    .token-section .section-head h2 {
      margin-bottom: 0.65rem;
      font-size: clamp(1.7rem, 2.6vw, 2.35rem);
    }
    .token-section .section-head p {
      color: #cbd5e1;
      line-height: 1.6;
      max-width: 58rem;
    }
    .token-card,
    .token-panel {
      background: rgba(15, 23, 42, 0.88);
      border: 1px solid rgba(148, 163, 184, 0.14);
      border-radius: 16px;
      box-shadow: 0 22px 60px rgba(0, 0, 0, 0.24);
    }
    .token-card {
      padding: 1.15rem;
      height: 100%;
    }
    .token-card h3 {
      margin-bottom: 0.45rem;
      font-size: 1.05rem;
      color: #e5e7eb;
    }
    .token-card p {
      margin: 0;
      color: #cbd5e1;
      line-height: 1.6;
    }
    .token-list {
      display: grid;
      gap: 0.75rem;
      margin: 0;
      padding: 0;
      list-style: none;
    }
    .token-list li {
      display: flex;
      gap: 0.75rem;
      align-items: flex-start;
      padding: 0.85rem 0.95rem;
      border-radius: 14px;
      background: rgba(2, 6, 23, 0.26);
      color: #e5e7eb;
      line-height: 1.55;
    }
    .token-list strong {
      display: block;
      margin-bottom: 0.1rem;
    }
    .token-badge {
      flex: none;
      width: 36px;
      height: 36px;
      border-radius: 50%;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: rgba(37, 99, 235, 0.1);
      color: #60a5fa;
      font-weight: 800;
    }
    .token-cta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 1rem;
      padding: 1.2rem 1.25rem;
      border-radius: 18px;
      background: linear-gradient(135deg, rgba(37, 99, 235, 0.08), rgba(15, 23, 42, 0.05));
      border: 1px solid rgba(96, 165, 250, 0.18);
    }
    .token-cta p {
      margin: 0.25rem 0 0;
      color: #cbd5e1;
      line-height: 1.6;
    }
    .page-shell {
      padding: 4rem 0 5rem;
      background: transparent;
    }
    .page-hero {
      margin-bottom: 1.5rem;
    }
    .page-hero .eyebrow {
      color: #60a5fa;
      text-transform: uppercase;
      font-size: 0.82rem;
      font-weight: 800;
      margin-bottom: 0.5rem;
    }
    .page-hero h1 {
      margin: 0 0 0.75rem;
      font-size: clamp(2rem, 3vw, 3rem);
      line-height: 1.05;
      letter-spacing: 0;
      color: #e5e7eb;
    }
    .page-hero p {
      margin: 0;
      max-width: 60rem;
      color: #cbd5e1;
      line-height: 1.6;
    }
    .page-card {
      background: rgba(15, 23, 42, 0.88);
      border: 1px solid rgba(148, 163, 184, 0.14);
      border-radius: 16px;
      box-shadow: 0 22px 60px rgba(0, 0, 0, 0.24);
      padding: 1.5rem;
    }
    .page-content {
      color: #e5e7eb;
      line-height: 1.75;
    }
    .page-content h2,
    .page-content h3,
    .page-content h4 {
      margin-top: 1.5rem;
    }
    .page-content p:last-child {
      margin-bottom: 0;
    }
    .page-content a {
      color: #60a5fa;
    }
    .page-content img {
      max-width: 100%;
      height: auto;
      border-radius: 12px;
    }
  </style>
@endsection

@section('content')
  @if($response->slug === 'token-ecosystem')
    <section class="page-shell--token">
      <div class="container">
        <div class="token-hero">
          <div>
            <div class="token-hero__eyebrow">FansFollow.me</div>
            <h1>{{ $response->title }}</h1>
            <p>{{ $response->description ?: 'A creator-first token layer built around rewards, platform utility, and community growth.' }}</p>
          </div>
          <div class="token-visual">
            <img src="/ffmherobackground-1280.jpg" alt="{{ $response->title }}">
          </div>
        </div>

        <div class="token-section">
          <div class="section-head">
            <h2>Why it exists</h2>
            <p>FansFollow.me uses the token ecosystem as a future-facing utility layer for creator rewards, platform engagement, and community participation. The public site stays fast, but the platform remains connected to the live app and creator accounts.</p>
          </div>
          <div class="row">
            <div class="col-md-6 col-lg-3 mb-3">
              <div class="token-card">
                <h3>Creator rewards</h3>
                <p>Support a structure that can connect earning, access, and participation across the platform.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
              <div class="token-card">
                <h3>Community utility</h3>
                <p>Give fans a clearer path into platform actions, access, and future product features.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
              <div class="token-card">
                <h3>Global payments</h3>
                <p>Keep the public messaging aligned with the live platform’s support for BTC, ETH, USDT, and SOL.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 mb-3">
              <div class="token-card">
                <h3>Platform growth</h3>
                <p>Present the ecosystem as part of the broader creator economy rather than a disconnected promo page.</p>
              </div>
            </div>
          </div>
        </div>

        <div class="token-section">
          <div class="row">
            <div class="col-lg-7 mb-3 mb-lg-0">
              <div class="token-panel p-4 h-100">
                <div class="section-head mb-3">
                  <h2>What fans and creators should expect</h2>
                  <p>The page stays informational on the public side. The live account system, creator tools, and admin tools continue to run through the existing backend.</p>
                </div>
                <ul class="token-list">
                  <li><span class="token-badge">1</span><div><strong>Creator-first utility</strong><span>Reward structures should benefit creators and support real platform activity.</span></div></li>
                  <li><span class="token-badge">2</span><div><strong>Public discovery</strong><span>Use the public pages to explain the platform without forcing the old prototype shell into the experience.</span></div></li>
                  <li><span class="token-badge">3</span><div><strong>Live app connection</strong><span>The login, signup, dashboard, and creator profiles continue to resolve against the live app flow.</span></div></li>
                </ul>
              </div>
            </div>
            <div class="col-lg-5">
              <div class="token-panel p-4 h-100">
                <div class="section-head mb-3">
                  <h2>Accepted today</h2>
                  <p>Current payment messaging stays simple and consistent with the main homepage.</p>
                </div>
                <div class="d-flex flex-wrap gap-2 mb-3">
                  <span class="badge badge-primary py-2 px-3">BTC</span>
                  <span class="badge badge-primary py-2 px-3">ETH</span>
                  <span class="badge badge-primary py-2 px-3">USDT</span>
                  <span class="badge badge-primary py-2 px-3">SOL</span>
                </div>
                <div class="token-cta">
                  <div>
                    <strong>Ready to explore creators?</strong>
                    <p>Use the live public shell to browse, sign up, and connect the token page to the rest of the platform.</p>
                  </div>
                  <a href="{{ url('/') }}" class="btn btn-primary">Home</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  @else
    <section class="page-shell">
      <div class="container">
        <div class="page-hero">
          <div class="eyebrow">FansFollow.me</div>
          <h1>{{ $response->title }}</h1>
          @if($response->description)
            <p>{{ $response->description }}</p>
          @endif
        </div>
        <div class="page-card">
          <div class="page-content content-p">
            {!! $response->content !!}
          </div>
        </div>
      </div>
    </section>
  @endif
@endsection

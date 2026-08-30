@extends('layouts.appnew')

@section('title') 404 - Page Not Found | FansFollow @endsection

@section('css')
<style>
  .error-404-wrap {
    text-align: center;
    padding: 6rem 1rem 4rem;
  }
  .error-404-code {
    font-size: 8rem;
    font-weight: 700;
    background: linear-gradient(135deg, #f97316 0%, #9333ea 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
    animation: pulse-slow 3s ease-in-out infinite;
    line-height: 1;
  }
  .error-404-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #fff;
    margin-bottom: 1rem;
  }
  .error-404-desc {
    font-size: 1.25rem;
    color: #94a3b8;
    max-width: 42rem;
    margin: 0 auto 2.5rem;
    line-height: 1.6;
  }

  /* Search */
  .error-404-search { max-width: 42rem; margin: 0 auto 3rem; }
  .error-404-search-wrap { position: relative; }
  .error-404-search-icon {
    position: absolute; left: 1rem; top: 50%; transform: translateY(-50%);
    color: #94a3b8; pointer-events: none;
  }
  .error-404-search input {
    width: 100%; padding: 1rem 7rem 1rem 3.5rem;
    background: rgba(15,23,42,.6); border: 2px solid rgba(148,163,184,.15);
    border-radius: 12px; color: #fff; font-size: 1.05rem; min-height: 56px;
    outline: none; transition: border-color .3s;
  }
  .error-404-search input::placeholder { color: #64748b; }
  .error-404-search input:focus { border-color: #f97316; }
  .error-404-search button {
    position: absolute; right: .5rem; top: 50%; transform: translateY(-50%);
    background: var(--cta-gradient); color: #fff; font-weight: 700;
    border: none; padding: .5rem 1.5rem; border-radius: 8px;
    cursor: pointer; min-height: 44px; font-size: 1rem; transition: opacity .3s;
  }
  .error-404-search button:hover { opacity: .9; }

  /* Cards */
  .error-404-cards {
    display: grid; grid-template-columns: 1fr; gap: 1.25rem; margin-bottom: 3rem;
  }
  @media (min-width: 768px) { .error-404-cards { grid-template-columns: repeat(3, 1fr); } }
  .error-404-card {
    background: var(--panel); border: 1px solid rgba(148,163,184,.12);
    border-radius: 16px; padding: 1.5rem; text-decoration: none; color: inherit;
    transition: all .3s; display: block;
  }
  .error-404-card:hover {
    border-color: rgba(249,115,22,.4);
    transform: translateY(-2px);
    box-shadow: 0 20px 40px rgba(0,0,0,.3);
  }
  .error-404-card-inner { display: flex; align-items: flex-start; gap: 1rem; }
  .error-404-card-icon {
    padding: .75rem; background: var(--cta-gradient); border-radius: 12px;
    flex-shrink: 0; transition: transform .3s;
  }
  .error-404-card:hover .error-404-card-icon { transform: scale(1.1); }
  .error-404-card-icon svg { display: block; }
  .error-404-card-text { flex: 1; }
  .error-404-card-label {
    font-size: 1.15rem; font-weight: 700; color: #fff; margin-bottom: .35rem;
    transition: color .3s;
  }
  .error-404-card:hover .error-404-card-label { color: #fb923c; }
  .error-404-card-desc { font-size: .85rem; color: #64748b; }
  .error-404-card-arrow {
    color: #475569; flex-shrink: 0; margin-top: .25rem; transition: color .3s;
  }
  .error-404-card:hover .error-404-card-arrow { color: #f97316; }

  /* CTA */
  .error-404-cta { text-align: center; margin-top: 2rem; margin-bottom: 2rem; }
  .error-404-cta a {
    display: inline-flex; align-items: center; gap: .5rem;
    background: var(--cta-gradient); color: #fff; font-weight: 700;
    padding: 1rem 2rem; border-radius: 12px; text-decoration: none;
    font-size: 1.1rem; min-height: 56px; transition: all .3s;
    box-shadow: 0 14px 28px rgba(249, 115, 22, .24);
  }
  .error-404-cta a:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 25px -5px rgba(249,115,22,.3);
  }

  @media (max-width: 640px) {
    .error-404-code { font-size: 5rem; }
    .error-404-title { font-size: 1.75rem; }
    .error-404-desc { font-size: 1rem; }
  }

  @keyframes pulse-slow {
    0%, 100% { opacity: 1; }
    50% { opacity: .8; }
  }
</style>
@endsection

@section('content')
<div class="error-404-wrap">
  <div class="error-404-code">404</div>
  <h1 class="error-404-title">Page Not Found</h1>
  <p class="error-404-desc">The page you're looking for doesn't exist or has been moved. Let's get you back on track!</p>

  <form action="{{ url('/search/creators') }}" method="GET" class="error-404-search">
    <div class="error-404-search-wrap">
      <svg class="error-404-search-icon" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input type="text" name="search" placeholder="Search for creators or content..." />
      <button type="submit">Search</button>
    </div>
  </form>

  <div class="error-404-cards">
    <a href="{{ url('/') }}" class="error-404-card">
      <div class="error-404-card-inner">
        <div class="error-404-card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
        </div>
        <div class="error-404-card-text">
          <div class="error-404-card-label">Homepage</div>
          <div class="error-404-card-desc">Return to the main page</div>
        </div>
        <svg class="error-404-card-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </a>

    <a href="{{ url('/explore') }}" class="error-404-card">
      <div class="error-404-card-inner">
        <div class="error-404-card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
        </div>
        <div class="error-404-card-text">
          <div class="error-404-card-label">Explore Creators</div>
          <div class="error-404-card-desc">Browse fitness and martial arts creators</div>
        </div>
        <svg class="error-404-card-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </a>

    <a href="{{ url('/support') }}" class="error-404-card">
      <div class="error-404-card-inner">
        <div class="error-404-card-icon">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
        </div>
        <div class="error-404-card-text">
          <div class="error-404-card-label">Support</div>
          <div class="error-404-card-desc">Get help from our team</div>
        </div>
        <svg class="error-404-card-arrow" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
      </div>
    </a>
  </div>

  <div class="error-404-cta">
    <a href="{{ url('/signup') }}">
      Get Started with FansFollow
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
    </a>
  </div>
</div>
@endsection

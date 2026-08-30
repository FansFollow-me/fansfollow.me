@extends('layouts.appnew')

@section('title') Movie Casting - FansFollow.me
@endsection

@section('css')
<style>
  .page-hero {
    padding: 6rem 0 3rem;
    text-align: center;
    background: transparent;
  }
  .page-hero h1 {
    font-size: clamp(2rem, 3.5vw, 3rem);
    color: #fff;
    font-weight: 800;
    margin-bottom: .75rem;
  }
  .page-hero p {
    color: #94a3b8;
    max-width: 40rem;
    margin: 0 auto;
    line-height: 1.7;
  }
  .page-section { padding: 3rem 0 4rem; }
  .section-head { max-width: 56rem; margin: 0 auto 1.8rem; text-align: center; }
  .section-head h2 { margin: 0 0 .65rem; font-size: clamp(1.7rem, 2.8vw, 2.45rem); line-height: 1.05; letter-spacing: -.02em; color: #f8fafc; }
  .section-head p { margin: 0 auto; color: #94a3b8; line-height: 1.7; font-size: 1rem; max-width: 64rem; }
  .grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 1rem; }
  .card { background: #151b2c; border: 1px solid rgba(255,255,255,.08); border-radius: 16px; box-shadow: 0 16px 50px rgba(0,0,0,.18); padding: 1.5rem; height: 100%; transition: all .3s ease; }
  .card:hover { border-color: rgba(249,115,22,.4); transform: scale(1.03); box-shadow: 0 25px 50px -12px rgba(249,115,22,.15); }
  .feature-icon { width: 48px; height: 48px; border-radius: 12px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .85rem; background: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #8b5cf6 100%); color: #fff; box-shadow: 0 10px 24px rgba(168,85,247,.22); font-size: 1.05rem; transition: transform .3s ease; }
  .feature-icon svg.lucide { width: 1.05rem; height: 1.05rem; }
  .card:hover .feature-icon { transform: scale(1.1); }
  .card h3 { margin: 0 0 .45rem; font-size: 1rem; color: #fff; }
  .card p { color: #94a3b8; line-height: 1.65; margin-bottom: 0; font-size: .95rem; }
  @media (max-width: 991.98px) { .grid-4 { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<section class="page-hero">
  <div class="container">
    <h1>Movie Casting</h1>
    <p>Where creators and performers move into film. Build on-screen opportunities, discover talent, and connect creator profiles with casting-friendly collaborations.</p>
  </div>
</section>
<section class="page-section">
  <div class="container">
    <div class="grid-4">
      <div class="card"><div class="feature-icon"><i data-lucide="film"></i></div><h3>Casting Calls</h3><p>Match talent with opportunities that fit the project and audience.</p></div>
      <div class="card"><div class="feature-icon"><i data-lucide="users"></i></div><h3>Talent Discovery</h3><p>Find creators and performers with the right look, reach, and energy.</p></div>
      <div class="card"><div class="feature-icon"><i data-lucide="video"></i></div><h3>Screen Tests</h3><p>Shortlist and review candidates with lightweight media-first workflows.</p></div>
      <div class="card"><div class="feature-icon"><i data-lucide="briefcase"></i></div><h3>Production Support</h3><p>Keep casting, communication, and selection organized in one place.</p></div>
    </div>
  </div>
</section>
@endsection
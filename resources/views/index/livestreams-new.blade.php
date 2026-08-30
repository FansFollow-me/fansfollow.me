@extends('layouts.appnew')

@section('title') Live Streams - FansFollow.me
@endsection

@section('css')
<style>
  .page-hero {
    padding: 4rem 0 2rem;
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
    max-width: 55rem;
    margin: 0 auto;
    line-height: 1.7;
  }
  .page-section { padding: 1.25rem 0 1.5rem; }
  .grid-4 { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: .75rem; }
  .card { background: #151b2c; border: 1px solid rgba(255,255,255,.08); border-radius: 16px; box-shadow: 0 16px 50px rgba(0,0,0,.18); padding: 1rem; height: 100%; transition: all .3s ease; }
  .card:hover { border-color: rgba(249,115,22,.4); transform: scale(1.03); box-shadow: 0 25px 50px -12px rgba(249,115,22,.15); }
  .feature-icon { width: 40px; height: 40px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; margin-bottom: .5rem; background: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #8b5cf6 100%); color: #fff; box-shadow: 0 10px 24px rgba(168,85,247,.22); font-size: .9rem; transition: transform .3s ease; }
  .feature-icon svg.lucide { width: .9rem; height: .9rem; }
  .card:hover .feature-icon { transform: scale(1.1); }
  .card h3 { margin: 0 0 .45rem; font-size: 1rem; color: #fff; }
  .card p { color: #94a3b8; line-height: 1.65; margin-bottom: 0; font-size: .95rem; }
  @media (max-width: 991.98px) { .grid-4 { grid-template-columns: 1fr; } }
</style>
@endsection

@section('content')
<section class="page-hero">
  <div class="container">
    <h1>Live Streams</h1>
    <p>Go live to your audience from any device in stunning 4K quality on your very own channel.<br>Stream in real time, bring fans into the moment, and turn live sessions into a direct revenue channel.</p>
  </div>
</section>
<section class="page-section">
  <div class="container">
    <div class="grid-4">
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#f97316,#ec4899);"><i data-lucide="radio"></i></div><h3>Stream Anywhere</h3><p>Broadcast from desktop or mobile without adding extra friction.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#ec4899,#8b5cf6);"><i data-lucide="message-circle"></i></div><h3>Live Interaction</h3><p>Keep viewers engaged with chat, reactions, and direct fan connection.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#8b5cf6,#6366f1);"><i data-lucide="lock"></i></div><h3>Private Access</h3><p>Use live sessions as a premium engagement layer for supporters.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#6366f1,#3b82f6);"><i data-lucide="smartphone"></i></div><h3>Mobile Ready</h3><p>Create and manage live moments from the same creator platform.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#3b82f6,#06b6d4);"><i data-lucide="user"></i></div><h3>1-on-1 Training</h3><p>Go live privately with a single fan for personalized coaching sessions.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#06b6d4,#10b981);"><i data-lucide="users"></i></div><h3>Group Training</h3><p>Host live group sessions and build a community around shared workouts.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#10b981,#f59e0b);"><i data-lucide="message-square"></i></div><h3>Live Q&amp;A</h3><p>Answer fan questions in real time and build deeper trust with your audience.</p></div>
      <div class="card"><div class="feature-icon" style="background:linear-gradient(135deg,#f59e0b,#f97316);"><i data-lucide="ticket"></i></div><h3>Pay-Per-View Streams</h3><p>Charge for exclusive live events and turn big moments into direct revenue.</p></div>
    </div>
  </div>
</section>
@endsection
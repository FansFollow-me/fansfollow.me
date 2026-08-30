@extends('layouts.appnew')

@section('title') Scan Creator Code - FansFollow.me
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
  .scan-content {
    max-width: 48rem;
    margin: 0 auto;
    padding: 2rem 0 4rem;
    text-align: center;
  }
  .scan-content h2 { color: #fff; font-size: 1.5rem; margin-bottom: 1rem; }
  .scan-content p { color: #94a3b8; line-height: 1.7; margin-bottom: 1.5rem; }
  .scan-icon {
    width: 80px; height: 80px;
    border-radius: 20px;
    display: inline-flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #f97316 0%, #ec4899 48%, #8b5cf6 100%);
    color: #fff; font-size: 2rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 14px 28px rgba(249,115,22,.24);
  }
  .scan-icon svg.lucide { width: 2rem; height: 2rem; }
</style>
@endsection

@section('content')
<section class="page-hero">
  <div class="container">
    <h1>Scan Creator Code</h1>
    <p>Connect with creators instantly by scanning their unique QR code at events, gyms, and meetups.</p>
  </div>
</section>
<section>
  <div class="container">
    <div class="scan-content">
      <div class="scan-icon"><i data-lucide="qr-code"></i></div>
      <h2>How It Works</h2>
      <p>Each creator on FansFollow.me has a unique QR code. Scan it with your phone camera to instantly visit their profile, subscribe, or follow them — no searching required.</p>
      <p>Perfect for in-person events, gym meetups, and live shows where you want to connect with creators face to face.</p>
    </div>
  </div>
</section>
@endsection
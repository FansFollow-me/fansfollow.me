@extends('layouts.appnew')

@section('hideFooter', true)

@section('title'){{ $user->hide_name == 'yes' ? $user->username : $user->name }} - {{ $settings->title }}@endsection
@section('description_custom'){{ $user->username }} - {{ strip_tags($user->story) }}@endsection

@section('css')
<meta property="og:type" content="website" />
<meta property="og:image" content="{{ Helper::getFile(config('path.avatar').$user->avatar) }}"/>
<meta property="og:title" content="{{ $user->hide_name == 'yes' ? $user->username : $user->name }} - {{ $settings->title }}"/>
<meta property="og:description" content="{{ strip_tags($user->story) }}"/>
<meta property="og:url" content="{{ url($user->username) }}"/>
<link rel="canonical" href="{{ url($user->username.$media) }}"/>
<style>
  :root { color-scheme: dark; }

  /* Back bar */
  .profile-back-bar {
    background: rgba(15,23,42,.88);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,.06);
    padding: .75rem 0;
  }
  .profile-back-bar a {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    color: #fb923c;
    font-weight: 600;
    text-decoration: none;
    transition: color .2s;
  }
  .profile-back-bar a:hover { color: #f97316; }

  /* Profile card */
  .profile-card {
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(12px);
    border-radius: 1.5rem;
    border: 1px solid rgba(255,255,255,.06);
    padding: 2rem;
    margin-bottom: 2rem;
  }
  .profile-header {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
  }
  @media (min-width: 1024px) {
    .profile-header { flex-direction: row; align-items: center; }
  }

  /* Avatar */
  .profile-avatar-wrap { position: relative; flex-shrink: 0; }
  .profile-avatar {
    width: 8rem; height: 8rem;
    border-radius: 50%;
    object-fit: cover;
    border: 4px solid rgba(255,255,255,.08);
    box-shadow: 0 10px 25px rgba(0,0,0,.4);
  }
  .profile-verified {
    position: absolute; bottom: -4px; right: -4px;
    width: 2.5rem; height: 2.5rem;
    background: #3b82f6;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    border: 4px solid #0f172a;
    color: #fff;
  }

  /* Info */
  .profile-info { flex: 1; }
  .profile-name-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .5rem;
    margin-bottom: .25rem;
  }
  .profile-name {
    font-size: 1.75rem;
    font-weight: 700;
    color: #fff;
    margin: 0;
  }
  .profile-creator-badge {
    padding: .25rem .75rem;
    background: rgba(249,115,22,.15);
    color: #fb923c;
    border-radius: 999px;
    font-size: .8rem;
    font-weight: 600;
  }
  .profile-username {
    color: #94a3b8;
    font-size: 1.1rem;
    margin-bottom: 1rem;
  }

  /* Stats */
  .profile-stats {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 1rem;
  }
  .profile-stat { text-align: center; }
  .profile-stat-num {
    font-size: 1.25rem;
    font-weight: 700;
    color: #fff;
  }
  .profile-stat-label {
    font-size: .8rem;
    color: #94a3b8;
  }

  /* Price badge */
  .profile-price-row {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
  }
  .profile-price-badge {
    background: rgba(34,197,94,.12);
    border-radius: .5rem;
    padding: .5rem .75rem;
    text-align: center;
  }
  .profile-price-amount {
    color: #4ade80;
    font-weight: 700;
  }
  .profile-price-interval {
    color: #86efac;
    font-size: .8rem;
  }
  .profile-responds {
    color: #94a3b8;
    font-size: .85rem;
  }

  /* Action buttons */
  .profile-actions {
    display: flex;
    flex-direction: column;
    gap: .5rem;
    flex-shrink: 0;
  }
  @media (min-width: 1024px) {
    .profile-actions { min-width: 14rem; }
  }
  .profile-btn {
    display: block;
    width: 100%;
    padding: .75rem 1.5rem;
    border-radius: .75rem;
    font-weight: 700;
    font-size: .95rem;
    text-align: center;
    text-decoration: none;
    transition: all .3s;
    border: none;
    cursor: pointer;
  }
  .profile-btn-subscribe {
    background: linear-gradient(135deg, #f97316, #9333ea);
    color: #fff;
    box-shadow: 0 10px 20px rgba(249,115,22,.2);
  }
  .profile-btn-subscribe:hover { transform: translateY(-1px); box-shadow: 0 14px 28px rgba(249,115,22,.3); }
  .profile-btn-follow {
    background: #fff;
    color: #0f172a;
  }
  .profile-btn-follow:hover { background: #e5e7eb; }
  .profile-btn-contact {
    background: rgba(255,255,255,.08);
    color: #e5e7eb;
    border: 1px solid rgba(255,255,255,.12);
  }
  .profile-btn-contact:hover { background: rgba(255,255,255,.12); }
  .profile-btn-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2.75rem; height: 2.75rem;
    border-radius: .75rem;
    background: rgba(255,255,255,.08);
    color: #cbd5e1;
    border: none;
    cursor: pointer;
    transition: background .2s;
  }
  .profile-btn-icon:hover { background: rgba(255,255,255,.15); }
  .profile-btn-row {
    display: flex;
    gap: .5rem;
  }

  /* Tabs */
  .profile-tabs {
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(12px);
    border-radius: 1rem;
    border: 1px solid rgba(255,255,255,.06);
    margin-bottom: 2rem;
    padding: .5rem;
    display: flex;
    gap: .25rem;
  }
  .profile-tab {
    flex: 1;
    padding: .75rem 1rem;
    border-radius: .75rem;
    font-weight: 600;
    font-size: .95rem;
    text-align: center;
    text-decoration: none;
    color: #94a3b8;
    transition: all .2s;
    background: none;
    border: none;
    cursor: pointer;
  }
  .profile-tab:hover { color: #fff; background: rgba(255,255,255,.05); }
  .profile-tab.active {
    background: linear-gradient(135deg, #f97316, #9333ea);
    color: #fff;
  }
  .profile-tab-count {
    font-size: .8rem;
    opacity: .7;
    margin-left: .35rem;
  }

  /* Post card */
  .profile-post {
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(12px);
    border-radius: 1rem;
    border: 1px solid rgba(255,255,255,.06);
    padding: 1.5rem;
    margin-bottom: 1rem;
  }
  .profile-post-inner {
    display: flex;
    gap: 1rem;
    align-items: flex-start;
  }
  .profile-post-thumb {
    width: 4rem; height: 4rem;
    background: linear-gradient(135deg, #f97316, #9333ea);
    border-radius: .75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    flex-shrink: 0;
  }
  .profile-post-title-row {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: .5rem;
    margin-bottom: .5rem;
  }
  .profile-post-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: #fff;
    margin: 0;
  }
  .profile-post-badge {
    padding: .15rem .5rem;
    border-radius: 999px;
    font-size: .7rem;
    font-weight: 600;
  }
  .badge-pinned { background: rgba(249,115,22,.15); color: #fb923c; }
  .badge-public { background: rgba(34,197,94,.15); color: #4ade80; }
  .badge-subscribers { background: rgba(59,130,246,.15); color: #60a5fa; }
  .badge-ppv { background: rgba(168,85,247,.15); color: #c084fc; }
  .profile-post-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: .85rem;
    color: #64748b;
  }
  .profile-post-meta span {
    display: inline-flex;
    align-items: center;
    gap: .3rem;
  }
  .profile-post-unlock {
    display: inline-flex;
    align-items: center;
    gap: .5rem;
    margin-top: .75rem;
    padding: .5rem 1rem;
    background: linear-gradient(135deg, #a855f7, #ec4899);
    color: #fff;
    font-weight: 700;
    font-size: .85rem;
    border-radius: .5rem;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: all .2s;
  }
  .profile-post-unlock:hover { transform: translateY(-1px); }
  .profile-post-content {
    color: #cbd5e1;
    margin-bottom: .5rem;
    line-height: 1.5;
  }

  /* Footer */
  .profile-footer {
    text-align: center;
    padding: 3rem 0 1.5rem;
    color: #475569;
    font-size: .8rem;
  }

  /* About tab */
  .profile-about {
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(12px);
    border-radius: 1rem;
    border: 1px solid rgba(255,255,255,.06);
    padding: 1.5rem;
    margin-bottom: 1rem;
    color: #cbd5e1;
    line-height: 1.6;
  }
  .profile-about h3 {
    color: #fff;
    font-size: 1.1rem;
    margin-bottom: .75rem;
  }

  /* Pagination */
  .profile-pagination {
    display: flex;
    justify-content: center;
    gap: .5rem;
    padding: 1.5rem 0;
    list-style: none;
    margin: 0;
  }
  .profile-pagination li a,
  .profile-pagination li span {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 2.5rem;
    height: 2.5rem;
    padding: 0 .75rem;
    border-radius: .75rem;
    font-weight: 600;
    font-size: .9rem;
    text-decoration: none;
    transition: all .2s;
    border: 1px solid rgba(255,255,255,.1);
    background: rgba(15,23,42,.6);
    color: #94a3b8;
  }
  .profile-pagination li a:hover {
    background: rgba(255,255,255,.08);
    color: #fff;
    border-color: rgba(255,255,255,.2);
  }
  .profile-pagination li.active span {
    background: linear-gradient(135deg, #f97316, #9333ea);
    color: #fff;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(249,115,22,.3);
  }
  .profile-pagination li.disabled span {
    opacity: .3;
    cursor: not-allowed;
  }
  .profile-empty {
    text-align: center;
    padding: 3rem 1rem;
    color: #64748b;
  }
</style>
@endsection

@section('content')
<div class="container" style="padding-top:2rem;padding-bottom:3rem;max-width:56rem;">
  <!-- Profile Card -->
  <div class="profile-card">
    <div class="profile-header">
      <div class="profile-avatar-wrap">
        <img src="{{ Helper::getFile(config('path.avatar').$user->avatar) }}" alt="{{ $user->name }}" class="profile-avatar">
        @if ($user->verified_id == 'yes')
          <div class="profile-verified">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
          </div>
        @endif
      </div>

      <div class="profile-info">
        <div class="profile-name-row">
          <h1 class="profile-name">{{ $user->hide_name == 'yes' ? $user->username : $user->name }}</h1>
          <span class="profile-creator-badge">Creator</span>
        </div>
        <div class="profile-username">{{ '@' . $user->username }}</div>

        <div class="profile-stats">
          <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($user->updates()->where('updates.expired','no')->count()) }}</div>
            <div class="profile-stat-label">Posts</div>
          </div>
          <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($subscriptionsActive) }}</div>
            <div class="profile-stat-label">Subscribers</div>
          </div>
          <div class="profile-stat">
            <div class="profile-stat-num">{{ number_format($likeCount) }}</div>
            <div class="profile-stat-label">Likes</div>
          </div>
        </div>

        @php $monthlyPlan = $user->plans()->where('interval','monthly')->where('status','1')->first(); @endphp
        @if($monthlyPlan)
          <div class="profile-price-row">
            <div class="profile-price-badge">
              <div class="profile-price-amount">{{ $settings->currency_symbol }}{{ $monthlyPlan->price }}</div>
              <div class="profile-price-interval">Monthly</div>
            </div>
            @if($user->profession)
              <div class="profile-responds">{{ $user->profession }}</div>
            @endif
          </div>
        @endif
      </div>

      <div class="profile-actions">
        @guest
          @if($monthlyPlan)
            @if($user->free_subscription == 'yes')
              <a href="javascript:void(0)" class="profile-btn profile-btn-subscribe" id="free-subscribe-btn">Subscribe for Free</a>
            @else
              <a href="#" class="profile-btn profile-btn-subscribe" data-toggle="modal" data-target="#subscribeModal">Subscribe {{ $settings->currency_symbol }}{{ $monthlyPlan->price }}</a>
            @endif
          @endif
          <a href="{{ url('login') }}" class="profile-btn profile-btn-follow">Follow</a>
          <a href="{{ url('login') }}" class="profile-btn profile-btn-contact">Contact</a>
        @else
          @if(auth()->id() == $user->id)
            <a href="{{ url('settings') }}" class="profile-btn profile-btn-subscribe" style="background:rgba(255,255,255,.08);color:#e5e7eb;">Edit Profile</a>
          @else
            @if($checkSubscription)
              <span class="profile-btn profile-btn-subscribe" style="opacity:.7;cursor:default;">Subscribed</span>
            @elseif($monthlyPlan)
              @if($user->free_subscription == 'yes')
                <a href="javascript:void(0)" class="profile-btn profile-btn-subscribe" id="free-subscribe-btn">Subscribe for Free</a>
              @else
                <a href="#" class="profile-btn profile-btn-subscribe" data-toggle="modal" data-target="#subscribeModal">Subscribe {{ $settings->currency_symbol }}{{ $monthlyPlan->price }}</a>
              @endif
            @endif
            <a href="{{ url('messages/'.$user->id) }}" class="profile-btn profile-btn-contact">Message</a>
          @endif
        @endguest

        <div class="profile-btn-row">
          <button class="profile-btn-icon" title="Share" onclick="if(navigator.share){navigator.share({title:'{{ $user->name }}',url:window.location.href})}else{navigator.clipboard.writeText(window.location.href);this.title='Copied!'}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><polyline points="16 6 12 2 8 6"/><line x1="12" x2="12" y1="2" y2="15"/></svg>
          </button>
          <button class="profile-btn-icon" title="More">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabs -->
  @php
    $currentTab = request('tab', 'posts');
    $totalPosts = $user->updates()->where('updates.expired','no')->count();
  @endphp
  <div class="profile-tabs">
    <a href="{{ url($user->username.'?tab=posts') }}" class="profile-tab {{ $currentTab == 'posts' ? 'active' : '' }}">
      Posts<span class="profile-tab-count">({{ $totalPosts }})</span>
    </a>
    <a href="{{ url($user->username.'?tab=about') }}" class="profile-tab {{ $currentTab == 'about' ? 'active' : '' }}">About</a>
  </div>

  <!-- Tab Content -->
  @if($currentTab == 'about')
    <div class="profile-about">
      <h3>About {{ $user->hide_name == 'yes' ? $user->username : $user->name }}</h3>
      {!! Helper::checkText($user->story) !!}
      @if($user->website)
        <p style="margin-top:1rem;"><a href="{{ $user->website }}" target="_blank" rel="noopener" style="color:#fb923c;">{{ $user->website }}</a></p>
      @endif
    </div>
  @else
    <!-- Posts -->
    @if($findPostPinned->count() > 0)
      @foreach($findPostPinned as $pin)
        @php
          $isLocked = $pin->locked == 'yes' && !$checkSubscription && auth()->id() != $user->id;
          $mediaItem = $pin->media->first();
          $hasImage = $mediaItem && $mediaItem->image != '';
          $hasVideo = $mediaItem && ($mediaItem->video != '' || $mediaItem->video_embed != '');
        @endphp
        <a href="{{ url($user->username.'/post/'.$pin->id) }}" class="profile-post" style="text-decoration:none;color:inherit;display:block;">
          <div class="profile-post-inner">
            @if(!$isLocked && $hasImage)
              <img src="{{ Helper::getFile(config('path.images').$mediaItem->image) }}" alt="" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;flex-shrink:0;">
            @elseif(!$isLocked && $hasVideo && $mediaItem->thumimge)
              <img src="{{ Helper::getFile(config('path.images').$mediaItem->thumimge) }}" alt="" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;flex-shrink:0;">
            @elseif(!$isLocked && $hasVideo && $mediaItem->video_poster)
              <img src="{{ Helper::getFile(config('path.videos').$mediaItem->video_poster) }}" alt="" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;flex-shrink:0;">
            @else
              <div class="profile-post-thumb">📌</div>
            @endif
            <div style="flex:1;min-width:0;">
              <div class="profile-post-title-row">
                <h3 class="profile-post-title">{{ $pin->title }}</h3>
                <span class="profile-post-badge badge-pinned">📌 Pinned</span>
                @if($pin->price > 0)
                  <span class="profile-post-badge badge-ppv">PPV {{ $settings->currency_symbol }}{{ $pin->price }}</span>
                @elseif($pin->locked == 'yes')
                  <span class="profile-post-badge badge-subscribers">Subscribers</span>
                @else
                  <span class="profile-post-badge badge-public">Public</span>
                @endif
              </div>
              @if($pin->content && !$isLocked)
                <div class="profile-post-content">{{ Str::limit(strip_tags($pin->content), 200) }}</div>
              @endif
              <div class="profile-post-meta">
                <span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                  {{ number_format($pin->views->count()) }}
                </span>
                <span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                  {{ $pin->likes()->count() }}
                </span>
                <span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                  {{ $pin->comments()->count() }}
                </span>
                <span>{{ \Carbon\Carbon::parse($pin->date)->diffForHumans() }}</span>
              </div>
              @if($isLocked && $pin->price > 0)
                <a href="#" class="profile-post-unlock" data-toggle="modal" data-target="#subscribeModal">Unlock for {{ $settings->currency_symbol }}{{ $pin->price }}</a>
              @endif
            </div>
          </div>
        </a>
      @endforeach
    @endif

    @if($updates->count() > 0)
      @foreach($updates as $update)
        @php
          $isLocked = $update->locked == 'yes' && !$checkSubscription && auth()->id() != $user->id;
          $mediaItem = $update->media->first();
          $hasImage = $mediaItem && $mediaItem->image != '';
          $hasVideo = $mediaItem && ($mediaItem->video != '' || $mediaItem->video_embed != '');
          $icon = '📝';
          if($hasVideo) $icon = '🎬';
          elseif($hasImage) $icon = '📸';
        @endphp
        <a href="{{ url($user->username.'/post/'.$update->id) }}" class="profile-post" style="text-decoration:none;color:inherit;display:block;">
          <div class="profile-post-inner">
            @if(!$isLocked && $hasImage)
              <img src="{{ Helper::getFile(config('path.images').$mediaItem->image) }}" alt="" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;flex-shrink:0;">
            @elseif(!$isLocked && $hasVideo && $mediaItem->thumimge)
              <img src="{{ Helper::getFile(config('path.images').$mediaItem->thumimge) }}" alt="" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;flex-shrink:0;">
            @elseif(!$isLocked && $hasVideo && $mediaItem->video_poster)
              <img src="{{ Helper::getFile(config('path.videos').$mediaItem->video_poster) }}" alt="" style="width:4rem;height:4rem;object-fit:cover;border-radius:.75rem;flex-shrink:0;">
            @else
              <div class="profile-post-thumb">{{ $icon }}</div>
            @endif
            <div style="flex:1;min-width:0;">
              <div class="profile-post-title-row">
                <h3 class="profile-post-title">{{ $update->title }}</h3>
                @if($update->price > 0)
                  <span class="profile-post-badge badge-ppv">PPV {{ $settings->currency_symbol }}{{ $update->price }}</span>
                @elseif($update->locked == 'yes')
                  <span class="profile-post-badge badge-subscribers">Subscribers</span>
                @else
                  <span class="profile-post-badge badge-public">Public</span>
                @endif
              </div>
              @if($update->content && !$isLocked)
                <div class="profile-post-content">{{ Str::limit(strip_tags($update->content), 200) }}</div>
              @endif
              <div class="profile-post-meta">
                <span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                  {{ number_format($update->views->count()) }}
                </span>
                <span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                  {{ $update->likes()->count() }}
                </span>
                <span>
                  <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m3 21 1.9-5.7a8.5 8.5 0 1 1 3.8 3.8z"/></svg>
                  {{ $update->comments()->count() }}
                </span>
                <span>{{ \Carbon\Carbon::parse($update->date)->diffForHumans() }}</span>
              </div>
              @if($isLocked && $update->price > 0)
                <a href="#" class="profile-post-unlock" data-toggle="modal" data-target="#subscribeModal">Unlock for {{ $settings->currency_symbol }}{{ $update->price }}</a>
              @endif
            </div>
          </div>
        </a>
      @endforeach

      @if($updates->hasPages())
        <nav>
          <ul class="profile-pagination">
            @if($updates->previousPageUrl())
              <li><a href="{{ $updates->previousPageUrl() . '&tab=posts' }}">&#8592;</a></li>
            @else
              <li class="disabled"><span>&#8592;</span></li>
            @endif
            @foreach($updates->getUrlRange(max(1, $updates->currentPage() - 2), min($updates->lastPage(), $updates->currentPage() + 2)) as $page => $url)
              <li class="{{ $page == $updates->currentPage() ? 'active' : '' }}">
                <a href="{{ $url . '&tab=posts' }}">{{ $page }}</a>
              </li>
            @endforeach
            @if($updates->nextPageUrl())
              <li><a href="{{ $updates->nextPageUrl() . '&tab=posts' }}">&#8594;</a></li>
            @else
              <li class="disabled"><span>&#8594;</span></li>
            @endif
          </ul>
        </nav>
      @endif
    @elseif($findPostPinned->count() == 0)
      <div class="profile-empty">
        <p>No posts yet.</p>
      </div>
    @endif
  @endif

  <div class="profile-footer">&copy; {{ date('Y') }} {{ $settings->title }}</div>
</div>

@section('javascript')
<script>
document.addEventListener('DOMContentLoaded', function() {
  var btn = document.getElementById('free-subscribe-btn');
  if (btn) {
    btn.addEventListener('click', function() {
      var token = document.querySelector('meta[name="csrf-token"]');
      fetch('{{ url("subscription/free") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
          'X-CSRF-TOKEN': token ? token.content : ''
        },
        body: 'id={{ $user->id }}'
      })
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (data.success) {
          location.reload();
        } else {
          alert(data.error || 'Subscription failed');
        }
      })
      .catch(function() { location.reload(); });
    });
  }
});
</script>
@endsection
@endsection

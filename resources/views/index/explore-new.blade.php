@extends('layouts.app')

@section('title') {{ $title }} - @endsection

@section('css')
<style>
  .explore-shell {
    padding: 2rem 0 3rem;
    background: transparent;
  }
  .explore-shell .explore-grid {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 2rem;
    max-width: 1280px;
    margin: 0 auto;
  }
  @media (max-width: 991.98px) {
    .explore-shell .explore-grid {
      grid-template-columns: 1fr;
    }
  }

  /* Search bar */
  .explore-search {
    position: relative;
    margin-bottom: 1.5rem;
  }
  .explore-search i,
  .explore-search svg.lucide {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    width: .9rem;
    height: .9rem;
  }
  .explore-search .form-control {
    width: 100%;
    background: rgba(51,65,85,.6);
    border: 1px solid rgba(148,163,184,.18);
    color: #e2e8f0;
    border-radius: 12px;
    padding: .75rem 1rem .75rem 2.75rem;
    font-size: .95rem;
  }
  .explore-search .form-control::placeholder { color: #9ca3af; }
  .explore-search .form-control:focus {
    border-color: #f97316;
    box-shadow: 0 0 0 .2rem rgba(249,115,22,.15);
    outline: none;
  }

  /* Filter pills — matching .com */
  .filter-section { margin-bottom: 1.5rem; }
  .filter-label {
    font-size: .75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: #9ca3af;
    margin-bottom: .5rem;
  }
  .filter-pills {
    display: flex;
    flex-wrap: nowrap;
    gap: .5rem;
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    scrollbar-width: none;
    padding-bottom: 4px;
    -webkit-mask-image: linear-gradient(to right, #000 90%, transparent 100%);
    mask-image: linear-gradient(to right, #000 90%, transparent 100%);
  }
  .filter-pills::-webkit-scrollbar { display: none; }
  .filter-pill {
    padding: .375rem .75rem;
    border-radius: 999px;
    font-size: .75rem;
    font-weight: 600;
    border: none;
    cursor: pointer;
    transition: all .2s;
    text-decoration: none;
    display: inline-block;
    line-height: 1.4;
  }
  .filter-pill--inactive {
    background: rgba(51,65,85,.6);
    color: #cbd5e1;
  }
  .filter-pill--inactive:hover {
    background: rgba(71,85,105,.8);
    color: #fff;
  }
  .filter-pill--active {
    background: linear-gradient(135deg, #f97316, #9333ea);
    color: #fff;
  }
  .filter-pill { flex-shrink: 0; white-space: nowrap; }

  /* Desktop: wrap pills normally */
  @media (min-width: 768px) {
    .filter-pills {
      flex-wrap: wrap;
      overflow-x: visible;
      -webkit-mask-image: none;
      mask-image: none;
    }
  }

  /* Post cards */
  .explore-post {
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(255,255,255,.06);
    border-radius: 16px;
    padding: 1.25rem;
    margin-bottom: 1rem;
    transition: all .3s ease;
  }
  .explore-post:hover {
    border-color: rgba(249,115,22,.3);
    box-shadow: 0 8px 30px rgba(249,115,22,.08);
  }
  .explore-post-header {
    display: flex;
    align-items: center;
    gap: .75rem;
    margin-bottom: .75rem;
  }
  .explore-post-avatar {
    width: 42px; height: 42px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }
  .explore-post-name {
    font-weight: 700;
    color: #fff;
    font-size: .95rem;
  }
  .explore-post-username {
    color: #94a3b8;
    font-size: .8rem;
  }
  .explore-post-body {
    color: #d1d5db;
    font-size: .95rem;
    line-height: 1.6;
    margin-bottom: .75rem;
    word-break: break-word;
  }
  .explore-post-media {
    border-radius: 12px;
    overflow: hidden;
    margin-bottom: .75rem;
    background: rgba(0,0,0,.2);
  }
  .explore-post-media img {
    width: 100%;
    display: block;
    max-height: 200px;
    object-fit: cover;
  }
  .explore-post-media video {
    width: 100%;
    display: block;
    max-height: 200px;
  }
  .explore-post-footer {
    display: flex;
    align-items: center;
    gap: 1.25rem;
    color: #94a3b8;
    font-size: .85rem;
  }
  .explore-post-footer i, .explore-post-footer svg.lucide { margin-right: .3rem; width: 1rem; height: 1rem; }
  .explore-post-locked {
    background: rgba(15,23,42,.8);
    border: 1px dashed rgba(249,115,22,.3);
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    color: #94a3b8;
    margin-bottom: .75rem;
  }
  .explore-post-locked i {
    font-size: 1.5rem;
    color: #f97316;
    display: block;
    margin-bottom: .5rem;
  }

  /* Right sidebar — creators */
  .explore-sidebar {
    position: sticky;
    top: 90px;
  }
  .explore-sidebar-title {
    font-size: .8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .06em;
    color: #94a3b8;
    margin-bottom: 1rem;
  }
  .explore-creator-card {
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(255,255,255,.06);
    border-radius: 14px;
    padding: 1rem;
    display: flex;
    gap: .75rem;
    align-items: center;
    margin-bottom: .75rem;
    text-decoration: none;
    transition: all .3s ease;
  }
  .explore-creator-card:hover {
    border-color: rgba(249,115,22,.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0,0,0,.2);
  }
  .explore-creator-card img {
    width: 48px; height: 48px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
  }
  .explore-creator-card .creator-info { flex: 1; min-width: 0; }
  .explore-creator-card .creator-name {
    font-weight: 700;
    color: #fff;
    font-size: .9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .explore-creator-card .creator-handle {
    color: #94a3b8;
    font-size: .78rem;
  }
  .explore-creator-card .creator-stats {
    color: #64748b;
    font-size: .75rem;
    display: flex;
    gap: .6rem;
    margin-top: .2rem;
  }

  /* Premium banner in sidebar */
  .explore-premium {
    margin-top: 1.5rem;
    background: linear-gradient(135deg, rgba(249,115,22,.1), rgba(147,51,234,.1));
    border-radius: 12px;
    padding: 1.25rem;
    border: 1px solid rgba(249,115,22,.2);
  }
  .explore-premium i, .explore-premium svg.lucide { color: rgba(249,115,22,.7); width: 1.25rem; height: 1.25rem; margin-bottom: .5rem; display: block; }
  .explore-premium h4 { font-weight: 600; color: #e2e8f0; font-size: .85rem; margin-bottom: .35rem; }
  .explore-premium p { font-size: .75rem; color: #9ca3af; margin-bottom: .75rem; }
  .explore-premium-btn {
    width: 100%;
    background: linear-gradient(135deg, #f97316, #9333ea);
    color: #fff;
    font-weight: 700;
    padding: .5rem;
    border-radius: 8px;
    border: none;
    font-size: .75rem;
    cursor: pointer;
    transition: all .2s;
  }
  .explore-premium-btn:hover { opacity: .9; }

  /* No results */
  .explore-empty {
    text-align: center;
    padding: 4rem 1rem;
    color: #94a3b8;
  }
  .explore-empty i, .explore-empty svg.lucide { width: 2.5rem; height: 2.5rem; color: #475569; margin-bottom: 1rem; display: block; }
  .explore-empty h4 { color: #e2e8f0; font-weight: 600; }
</style>
@endsection

@section('content')
<section class="explore-shell">
  <div class="explore-grid">
    <!-- Main content -->
    <div class="explore-main">
      <!-- Search Bar -->
      <div class="explore-search">
        <i data-lucide="search"></i>
        <form action="{{ url('explore') }}" method="get" class="d-contents">
          <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}" placeholder="Search posts, creators, topics..." minlength="3">
        </form>
      </div>

      <!-- Filter Pills — matching .com layout -->
      <div class="filter-section">
        <div class="filter-label">What to Show</div>
        <div class="filter-pills">
          @php
            $currentSort = request()->get('sort');
            $currentQ = request()->get('q');
            $baseUrl = url('explore');
            function pillUrl($sort, $q) {
              $base = url('explore');
              $params = [];
              if ($q) $params['q'] = $q;
              if ($sort) $params['sort'] = $sort;
              return $base . ($params ? '?' . http_build_query($params) : '');
            }
          @endphp
          <a href="{{ pillUrl('', $currentQ) }}" class="filter-pill {{ !$currentSort ? 'filter-pill--active' : 'filter-pill--inactive' }}">Latest</a>
          <a href="{{ pillUrl('free', $currentQ) }}" class="filter-pill {{ $currentSort == 'free' ? 'filter-pill--active' : 'filter-pill--inactive' }}">Free Posts</a>
          <a href="{{ pillUrl('unlockable', $currentQ) }}" class="filter-pill {{ $currentSort == 'unlockable' ? 'filter-pill--active' : 'filter-pill--inactive' }}">Premium</a>
          <a href="{{ pillUrl('oldest', $currentQ) }}" class="filter-pill {{ $currentSort == 'oldest' ? 'filter-pill--active' : 'filter-pill--inactive' }}">Oldest</a>
        </div>
      </div>

      <div class="filter-section">
        <div class="filter-label">Who They Are</div>
        <div class="filter-pills">
          <span class="filter-pill filter-pill--inactive">Athletes</span>
          <span class="filter-pill filter-pill--inactive">Actor / Actress</span>
          <span class="filter-pill filter-pill--inactive">Celebrities</span>
        </div>
      </div>

      <div class="filter-section">
        <div class="filter-label">What They Do</div>
        <div class="filter-pills">
          <span class="filter-pill filter-pill--inactive">Bodybuilding</span>
          <span class="filter-pill filter-pill--inactive">Fitness / Gym</span>
          <span class="filter-pill filter-pill--inactive">Combat Sports</span>
          <span class="filter-pill filter-pill--inactive">Martial Arts</span>
          <span class="filter-pill filter-pill--inactive">Nutrition</span>
        </div>
      </div>

      <!-- Content Feed -->
      @if ($updates->total() != 0)
        @php
          $counterPosts = ($updates->total() - $settings->number_posts_show);
        @endphp
        <div id="updatesPaginator">
          @include('includes.updates')
        </div>
        @if($updates->hasPages())
          <div class="mt-3 text-center">
            {{ $updates->appends(['q' => request('q'), 'sort' => request('sort')])->links() }}
          </div>
        @endif
      @else
        <div class="explore-empty">
          <i class="fas fa-photo-video"></i>
          <h4>{{ trans('general.no_posts_posted') }}</h4>
        </div>
      @endif
    </div>

    <!-- Sidebar -->
    <aside class="explore-sidebar d-none d-lg-block">
      @auth
        <a href="{{ url(auth()->user()->username) }}" class="explore-creator-card" style="margin-bottom:1.5rem;">
          <img src="{{ Helper::getFile(config('path.avatar').auth()->user()->avatar) }}" alt="">
          <div class="creator-info">
            <div class="creator-name">{{ auth()->user()->hide_name == 'yes' ? auth()->user()->username : auth()->user()->name }}</div>
            <div class="creator-handle">{{ '@'.auth()->user()->username }}</div>
          </div>
        </a>
      @endauth

      @if ($users->total() != 0)
        <div class="explore-sidebar-title">{{ trans('general.explore_creators') }}</div>
        @foreach ($users as $user)
          <a href="{{ url($user->username) }}" class="explore-creator-card">
            <img src="{{ Helper::getFile(config('path.avatar').$user->avatar) }}" alt="">
            <div class="creator-info">
              <div class="creator-name">{{ $user->hide_name == 'yes' ? $user->username : $user->name }}</div>
              <div class="creator-handle">{{ '@'.$user->username }}</div>
              <div class="creator-stats">
                <span><i data-lucide="file" style="width:12px;height:12px;"></i> {{ $user->updates()->count() }}</span>
                <span><i data-lucide="heart" style="width:12px;height:12px;"></i> {{ Helper::formatNumber($user->likesCount()) }}</span>
              </div>
            </div>
          </a>
        @endforeach
      @endif

      <!-- Premium Banner — matching .com sidebar -->
      <div class="explore-premium">
        <i data-lucide="crown"></i>
        <h4>Unlock Premium</h4>
        <p>Get exclusive content from top creators</p>
        <button class="explore-premium-btn" onclick="window.location.href='{{ url('signup') }}'">Upgrade Now</button>
      </div>
    </aside>
  </div>
</section>
@endsection

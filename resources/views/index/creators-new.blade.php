@extends('layouts.app')

@section('title') {{ $title }} - @endsection

@section('css')
<style>
  .creators-shell {
    padding: 2rem 0 3rem;
    background: transparent;
  }
  .creators-shell .container { max-width: 1280px; }

  /* Page header */
  .creators-header {
    text-align: center;
    padding: 2rem 0 2.5rem;
  }
  .creators-header h1 {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
    color: #fff;
    margin-bottom: .5rem;
  }
  .creators-header p {
    color: #94a3b8;
    font-size: 1.05rem;
    max-width: 36rem;
    margin: 0 auto;
  }

  /* Toolbar */
  .creators-toolbar {
    display: flex;
    gap: .75rem;
    align-items: center;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
  }
  .creators-toolbar .form-control,
  .creators-toolbar select {
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(148,163,184,.18);
    color: #e2e8f0;
    border-radius: 10px;
    padding: .65rem 1rem;
    font-size: .95rem;
  }
  .creators-toolbar .form-control::placeholder { color: #64748b; }
  .creators-toolbar .form-control:focus {
    border-color: #f97316;
    box-shadow: 0 0 0 .2rem rgba(249,115,22,.15);
  }
  .creators-toolbar .search-wrap {
    position: relative;
    flex: 1;
    min-width: 200px;
  }
  .creators-toolbar .search-wrap i,
  .creators-toolbar .search-wrap svg.lucide {
    position: absolute;
    left: .85rem;
    top: 50%;
    transform: translateY(-50%);
    color: #64748b;
    width: 1rem;
    height: 1rem;
  }

  /* Category pills */
  .creators-pills {
    display: flex;
    gap: .5rem;
    flex-wrap: wrap;
    margin-bottom: 1.5rem;
  }
  .creators-pills a {
    padding: .45rem 1rem;
    border-radius: 999px;
    font-weight: 600;
    font-size: .85rem;
    color: #94a3b8;
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(148,163,184,.14);
    text-decoration: none;
    transition: all .2s;
  }
  .creators-pills a:hover,
  .creators-pills a.active {
    background: linear-gradient(135deg, #f97316, #a855f7);
    color: #fff;
    border-color: transparent;
  }

  /* Creator cards grid */
  .creators-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1rem;
  }
  .creator-card {
    background: rgba(15,23,42,.6);
    border: 1px solid rgba(255,255,255,.06);
    border-radius: 16px;
    overflow: hidden;
    transition: all .3s ease;
    text-decoration: none;
    display: block;
  }
  .creator-card:hover {
    border-color: rgba(249,115,22,.3);
    transform: translateY(-3px);
    box-shadow: 0 12px 36px rgba(0,0,0,.25);
  }
  .creator-card-cover {
    height: 100px;
    background: linear-gradient(135deg, #1e293b, #0f172a);
    background-size: cover;
    background-position: center;
    position: relative;
  }
  .creator-card-body {
    padding: 1rem;
    display: flex;
    gap: .75rem;
    align-items: flex-start;
  }
  .creator-card-avatar {
    width: 56px; height: 56px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(15,23,42,.9);
    margin-top: -28px;
    flex-shrink: 0;
  }
  .creator-card-info { flex: 1; min-width: 0; }
  .creator-card-name {
    font-weight: 700;
    color: #fff;
    font-size: 1rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }
  .creator-card-handle {
    color: #94a3b8;
    font-size: .8rem;
  }
  .creator-card-stats {
    display: flex;
    gap: .75rem;
    margin-top: .4rem;
    color: #64748b;
    font-size: .8rem;
  }
  .creator-card-stats i, .creator-card-stats svg.lucide { margin-right: .2rem; width: 12px; height: 12px; }
  .creator-card-badge {
    display: inline-block;
    padding: .15rem .5rem;
    border-radius: 999px;
    font-size: .65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .04em;
    position: absolute;
    top: .5rem;
    right: .5rem;
  }
  .badge-free {
    background: rgba(34,197,94,.2);
    color: #4ade80;
  }
  .badge-verified {
    background: rgba(59,130,246,.2);
    color: #60a5fa;
  }

  /* Empty state */
  .creators-empty {
    text-align: center;
    padding: 4rem 1rem;
    color: #94a3b8;
  }
  .creators-empty i, .creators-empty svg.lucide { width: 2.5rem; height: 2.5rem; color: #475569; margin-bottom: 1rem; display: block; }
  .creators-empty h4 { color: #e2e8f0; font-weight: 600; }
</style>
@endsection

@section('content')
<section class="creators-shell">
  <div class="container">
    <div class="creators-header">
      <h1>{{ $title }}</h1>
      <p>{{ trans('users.the_best_creators_is_here') }}</p>
    </div>

    <div class="creators-toolbar">
      <div class="search-wrap">
        <i data-lucide="search"></i>
        <form action="{{ url('creators') }}" method="get" class="d-contents">
          <input type="text" name="q" class="form-control" value="{{ request()->get('q') }}" placeholder="{{ trans('general.search') }}">
        </form>
      </div>
      <select onchange="window.location.href=this.value">
        <option value="{{ url('creators') }}">{{ trans('general.latest') }}</option>
        <option value="{{ url('creators') }}?sort=oldest" @if(request('sort')=='oldest') selected @endif>{{ trans('general.oldest') }}</option>
      </select>
    </div>

    @php
      $genders = ['male', 'female', 'couples', 'trans'];
    @endphp
    <div class="creators-pills">
      <a href="{{ url('creators') }}" class="{{ !request('gender') ? 'active' : '' }}">{{ trans('general.all') }}</a>
      @foreach($genders as $g)
        <a href="{{ url('creators') }}?gender={{ $g }}" class="{{ request('gender') == $g ? 'active' : '' }}">{{ __('general.'.$g) }}</a>
      @endforeach
    </div>

    @if($users->total() != 0)
      <div class="creators-grid">
        @foreach($users as $user)
          <a href="{{ url($user->username) }}" class="creator-card">
            <div class="creator-card-cover" style="background-image: url('{{ $user->cover != '' ? Helper::getFile(config('path.cover').$user->cover) : '' }}')">
              @if($user->free_subscription == 'yes')
                <span class="creator-card-badge badge-free">{{ trans('general.free') }}</span>
              @endif
              @if($user->verified_id == 'yes')
                <span class="creator-card-badge badge-verified"><i data-lucide="check" style="width:12px;height:12px;"></i></span>
              @endif
            </div>
            <div class="creator-card-body">
              <img class="creator-card-avatar" src="{{ Helper::getFile(config('path.avatar').$user->avatar) }}" alt="">
              <div class="creator-card-info">
                <div class="creator-card-name">{{ $user->hide_name == 'yes' ? $user->username : $user->name }}</div>
                <div class="creator-card-handle">{{ '@'.$user->username }}</div>
                <div class="creator-card-stats">
                  <span><i data-lucide="file" style="width:12px;height:12px;"></i> {{ $user->updates()->count() }}</span>
                  <span><i data-lucide="heart" style="width:12px;height:12px;"></i> {{ Helper::formatNumber($user->likesCount()) }}</span>
                </div>
              </div>
            </div>
          </a>
        @endforeach
      </div>

      @if($users->hasPages())
        <div class="mt-4 text-center">
          {{ $users->onEachSide(0)->appends(['q' => request('q'), 'gender' => request('gender')])->links() }}
        </div>
      @endif
    @else
      <div class="creators-empty">
        <i class="fas fa-user-slash"></i>
        <h4>{{ trans('general.no_results_found') }}</h4>
      </div>
    @endif
  </div>
</section>
@endsection
@extends('layouts.app')

@section('title') {{ trans('general.blog') }} -@endsection


@section('css')
  <style>
    .blog-shell {
      padding: 4rem 0 5rem;
      background: transparent;
    }
    .blog-shell h2,
    .blog-shell h3,
    .blog-shell p,
    .blog-shell small,
    .blog-shell a {
      color: #e5e7eb;
    }
    .blog-shell .lead,
    .blog-shell .text-muted {
      color: #cbd5e1 !important;
    }
    .blog-shell .card-row {
      background: rgba(15,23,42,.88);
      border: 1px solid rgba(148,163,184,.14);
      border-radius: 18px;
      overflow: hidden;
      box-shadow: 0 22px 60px rgba(0,0,0,.24);
    }
    .blog-shell .card-row .col {
      color: #e5e7eb;
    }
    .blog-shell .card-row a {
      color: #60a5fa;
    }
    .blog-shell .no-updates {
      color: #e5e7eb;
    }
  </style>
@endsection

@section('content')
  <section class="section section-sm blog-shell">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
          <h2 class="mb-0 text-break">{{ trans('general.latest_blog') }}</h2>
          <p class="lead text-muted mt-0">{{trans('general.subtitle_blog')}}</p>
        </div>
      </div>

      <div class="row">
        @if ($blogs->total() != 0)

          @foreach ($blogs as $response)
            <div class="col-md-4">
              <div class="row no-gutters card-row flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="card-cover w-100" style="height:250px; background: @if ($response->image != '') url({{ Helper::getFile(config('path.admin').$response->image) }})  @endif #505050 center center;"></div>
                <div class="col p-4 d-flex flex-column position-static">
                  <small class="d-inline-block mb-2">{{ trans('general.by') }} {{ $response->user()->name }} </small>
                  <h3 class="mb-0">{{ $response->title }}</h3>
                  <div class="mb-1 text-muted">{{ Helper::formatDate($response->date) }}</div>
                  <p class="card-text mb-auto">{{ Str::limit(strip_tags($response->content), 120, '...') }}</p>
                  <a href="{{ url('blog/post', $response->id).'/'.$response->slug }}" class="stretched-link">{{ trans('general.continue_reading') }} <i class="bi-arrow-right"></i></a>
                </div>
              </div>
            </div>
          @endforeach

          @if ($blogs->hasPages())
            <div class="w-100 d-block">
              {{ $blogs->links() }}
            </div>
          @endif

        @else
          <div class="col-md-12">
            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                <i class="fa fa-exclamation ico-no-result"></i>
              </span>
            <h4 class="font-weight-light">{{trans('general.no_results_found')}}</h4>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection

<?php $isStagingDesign = false; ?>
{{-- Staging design marker for the scheduled-post partial. --}}
@if (auth()->check()
            && auth()->id() == $user->id
            && ! $userPlanMonthlyActive
            && auth()->user()->free_subscription == 'no'
            )
        <div class="alert alert-danger mb-3">
                 <ul class="list-unstyled m-0">
                     <!--My Changes-->
                   <li><i class="fas fa-exclamation-triangle"></i> {{trans('general.alert_not_subscription')}} <a href="{{url('settings/subscription')}}" class="text-white link-border">{{trans('general.activate')}}</a></li>
                 </ul>
               </div>
               @endif

        @if (auth()->check()
            && auth()->id() == $user->id
            && auth()->user()->verified_id != 'reject'
            )
          @include('includes.form-post')
        @endif
        <div class="post-categories-tags">
        @if(count($postCats) != 0)
           @include('includes.post-categories-tag')
        @endif
        </div>
        
        <!--My changes && $findPostPinned->count() == 0-->
        @if ($updates->count() == 0)
            <div class="grid-updates"></div>

            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                  <!--My Changes-->
                <i class="fas fa-photo-video ico-no-result"></i>
              </span>
            <h4 class="font-weight-light">{{trans('general.no_posts_posted')}}</h4>
            </div>
          @else

            @php
              $counterPosts = ($updates->total() - $settings->number_posts_show);
            @endphp

            @if (! request()->get('sort') && $updates->total() > $settings->number_posts_show || request()->get('sort'))
            <div class="w-100 d-flex @if (request()->get('sort') && request()->get('sort') <> 'oldest')justify-content-between @else justify-content-end @endif align-items-center mb-3 px-lg-0 px-3">

              @if (request()->get('sort') && request()->get('sort') <> 'oldest')
                <small>
                  <strong>{{ __('general.results') }} {{ $updates->total() }}</strong>
                </small>
              @endif
                
              @if (auth()->guest() && $user->posts_privacy || auth()->check())
              <div>
                <i class="bi-filter-right mr-1"></i>
                <!--My Chnages data-id="ajax-filter"-->
                <select class="@if ($settings->button_style == 'rounded')rounded-pill @endif custom-select w-auto px-4" data-id="ajax-filter" id="filter">
                    <option @if (! request()->get('sort')) selected @endif value="{{url()->current()}}{{ request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')) : null }}">{{trans('general.latest')}}</option>
                    <option @if (request()->get('sort') == 'oldest') selected @endif value="{{url()->current()}}{{ request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?' }}sort=oldest">{{trans('general.oldest')}}</option>
                    <option @if (request()->get('sort') == 'unlockable') selected @endif value="{{url()->current()}}{{ request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?' }}sort=unlockable">{{trans('general.unlockable')}}</option>
                    <option @if (request()->get('sort') == 'free') selected @endif value="{{url()->current()}}{{ request()->get('q') ? '?q='.str_replace('#', '%23', request()->get('q')).'&' : '?' }}sort=free">{{trans('general.free')}}</option>
                  </select>
              </div>
              @endif

          </div>
        @endif

        @if (auth()->guest() && ! $user->posts_privacy)
        <div class="my-5 text-center no-updates">
          <span class="btn-block mb-3">
              <!--My Changes-->
            <i class="fas fa-lock ico-no-result"></i>
          </span>
        <h4 class="font-weight-light">{{trans('general.alert_posts_privacy', ['user' => '@'.$user->username])}}</h4>
        </div>

        @else

        <div class="grid-updates position-relative" id="updatesPaginator">
          @if ($findPostPinned && ! request('media'))
            @include('includes.updates', ['updates' => $findPostPinned])
          @endif

          @include('includes.updates')
        </div>
        @endif   

          @endif
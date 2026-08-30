<div class="row">
   
            @if($users->total())
              @foreach ($users as $response)
              @if(($online == 'yes' && Cache::has('is-online-' . $response->id)) || $online == 'no')
              <div class="col-md-6 mb-4">
                	<div class="card card-updates h-100 card-user-profile shadow-sm">
                	    <!--My Changes-->
	<div class="card-cover" style="background: @if ($response->cover != '') url({{ Helper::getFile(config('path.cover').$response->cover) }})  @endif #505050 center center; background-size: cover;"></div>
	<div class="card-avatar @if ($response->isLive())liveLink @endif @if ($response->isLive()) data-url="{{ url('live', $response->username) }}" @endif @if (Cache::has('is-online-' . $response->id) && $response->active_status_online == 'yes' || auth()->guest() && Cache::has('is-online-' . $response->id) && $response->active_status_online == 'yes') user-online-profile-creator overflow-visible @elseif (auth()->check() && auth()->id() != $response->id && !Cache::has('is-online-' . $response->id) && $response->active_status_online == 'yes' || auth()->guest() && !Cache::has('is-online-' . $response->id) && $response->active_status_online == 'yes') user-offline-profile-creator overflow-visible @endif">

		@if ($response->isLive())
			<span class="live-span">{{ trans('general.live') }}</span>
			<div class="live-pulse"></div>
		@endif


		<a href="{{url($response->username)}}">
		<img src="{{Helper::getFile(config('path.avatar').$response->avatar)}}" width="95" height="95" alt="{{$response->name}}" class="img-user-small">
		</a>
	</div>
	<div class="card-body text-center">
			<h6 style="margin-top: 1.8rem!important; font-size: 110%; font-weight: 500;" class="card-title @if ($response->isLive()) pt-4 mt-2 mb-1 @else pt-4 mt-2 @endif">
				{{$response->hide_name == 'yes' ? $response->username : $response->name}}

				@if ($response->verified_id == 'yes')
					<small class="verified mr-1" title="{{trans('general.verified_account')}}"data-toggle="tooltip" data-placement="top">
						<i class="bi bi-patch-check-fill"></i>
					</small>
				@endif
                
				@if ($response->featured == 'yes')
				<small class="text-featured" title="{{trans('users.creator_featured')}}" data-toggle="tooltip" data-placement="top">
					<i class="fas fa fa-award"></i>
				</small>
			@endif
			<span class="btn-block">
			@if ($response->likesCount() != 0)
                    <small class="mr-2" style="font-size: 110%; font-weight: 500;"><img src="{{url('public/img/HEART.svg')}}" width="25px" class="mr-1" /> {{ $response->likesCount() }} {{ __('general.likes') }}</small>
                    @endif
    
                    @if ($response->totalSubscriptionsActive() != 0 && $response->hide_count_subscribers == 'no')
                        <small style="font-size: 110%; font-weight: 500;"><img src="{{url('public/img/SUBSCRIBER.svg')}}" width="25px" class="mr-1" /> {{ Helper::formatNumber($response->totalSubscriptionsActive()) }} {{ trans_choice('general.subscribers', $response->totalSubscriptionsActive()) }}</small>
                    @endif
            </span>
			@if (! Cache::has('is-online-' . $response->id) && $response->hide_last_seen == 'no')
              <span class="w-100 d-block timeafodiv" style="font-size: 110%; font-weight: 500;">
                <span>{{ trans('general.active') }}</span>
                <span class="timeAgo"data="{{ date('c', strtotime($response->last_seen ?? $response->date)) }}"></span>
               </span>
               
               @endif
			</h6>

			<ul class="list-inline m-0">
				<li class="list-inline-item" style="font-size: 110%; font-weight: 500;"><i class="feather icon-file-text"></i> {{ Helper::formatNumber($response->updates()->count()) }}</li>
				<li class="list-inline-item" style="font-size: 110%; font-weight: 500;"><i class="feather icon-image"></i> {{ Helper::formatNumber($response->media()->where('media.image', '<>', '')->count()) }}</li>
				<li class="list-inline-item" style="font-size: 110%; font-weight: 500;"><i class="feather icon-video"></i> {{ Helper::formatNumber($response->media()->where('media.video', '<>', '')->orWhere('media.video_embed', '<>', '')->where('media.user_id', $response->id)->count()) }}</li>
				<li class="list-inline-item" style="font-size: 110%; font-weight: 500;"><i class="feather icon-mic"></i> {{ Helper::formatNumber($response->media()->where('media.music', '<>', '')->count()) }}</li>
				<li class="list-inline-item" style="font-size: 110%; font-weight: 500;"><i class="far fa-file-archive"></i> {{ Helper::formatNumber($response->media()->where('media.file', '<>', '')->count()) }}</li>
			</ul>

			<!--<p class="m-0 py-3 text-muted card-text text-truncate" style="font-size: 110%; font-weight: 500;">
				{{ Str::limit($response->story, 100, '...') }}
			</p>-->
			<a href="{{url($response->username)}}" class="btn btn-1 btn-sm btn-outline-primary">{{trans('general.go_to_page')}}</a>

			<a href="{{url($response->username)}}" class="btn btn-1 btn-sm btn-outline-primary px-3 active">
				@if ($response->plans()->whereStatus('1')->first() && $response->free_subscription == 'no')
					{{ __('general.price_per_month', ['price' => Helper::amountFormatDecimal($response->plan('monthly', 'price'))]) }}
				@endif

				@if ($response->free_subscription == 'yes')
					{{ __('general.free') }}
				@endif
			</a>

	</div>
</div><!-- End Card -->

              </div><!-- end col-md-4 -->
             @endif
              @endforeach
              
              @if($users->hasPages())
                <div class="w-100 d-block">
                  {{ $users->onEachSide(0)->appends(['q' => request('q')])->links() }}
                </div>
              @endif 
              @else
              <div class="col-md-6 mb-4">
                No Data Found!
              </div><!-- end col-md-4 -->
             @endif
            </div><!-- row -->
            
<div class="menuMobile w-100 bg-white shadow-lg p-3 border-top">
	<ul class="list-inline d-flex bd-highlight m-0 text-center">
                 <li class="flex-fill bd-highlight">

							<a class="btn-mobile" href="{{url('explore/creators/live')}}"><img width="50px" src="{{Helper::getFile('img/liveIcon.png')}}" />
							@php 
							$Live = \App\Models\User::leftjoin('live_streamings', 'live_streamings.user_id', '=', 'users.id')->where('live_streamings.updated_at', '>', now()->subMinutes(5))
         ->where('live_streamings.status', '0')->count();
							echo '('.$Live.')';
							@endphp
							</a>

						</li>
				<li class="flex-fill bd-highlight">
					<a class="p-3 btn-mobile" href="{{url('/')}}" title="{{trans('admin.home')}}">
						<i class="feather icon-home icon-navbar @if (request()->path() == '/') btn-primary @endif" style=" @if (request()->path() == '/') padding: 5px; border-radius: 50%; @endif"></i>
					</a>
				</li>

				<li class="flex-fill bd-highlight">
					<a class="p-3 btn-mobile" href="{{url('creators')}}" title="{{trans('general.explore')}}">
							<i class="far fa-compass icon-navbar @if (request()->path() == 'creators') btn-primary @endif" style=" @if (request()->path() == 'creators') padding: 5px; border-radius: 50%; @endif"></i>
					</a>
				</li>

			@if ($settings->shop)
				<li class="flex-fill bd-highlight">
					<a class="p-3 btn-mobile" href="{{url('shop')}}" title="{{trans('general.shop')}}">
						<i class="feather icon-shopping-bag icon-navbar @if (request()->path() == 'shop') btn-primary @endif" style=" @if (request()->path() == 'shop') padding: 5px; border-radius: 50%; @endif"></i>
					</a>
				</li>
			@endif

			<li class="flex-fill bd-highlight">
				<a href="{{url('messages')}}" class="p-3 btn-mobile position-relative" title="{{ trans('general.messages') }}">

					<span class="noti_msg notify @if (auth()->user()->messagesInbox() != 0) d-block @endif">
						{{ auth()->user()->messagesInbox() }}
						</span>

					<i class="feather icon-send icon-navbar @if (request()->path() == 'messages') btn-primary @endif" style="@if (request()->path() == 'messages') padding: 5px; border-radius: 50%; @endif"></i>
				</a>
			</li>

			<li class="flex-fill bd-highlight">
				<a href="{{url('notifications')}}" class="p-3 btn-mobile position-relative" title="{{ trans('general.notifications') }}">
					<span class="noti_notifications notify @if (auth()->user()->notifications()->where('status', '0')->count()) d-block @endif">
						{{ auth()->user()->notifications()->where('status', '0')->count() }}
						</span>
					<i class="far fa-bell icon-navbar @if (request()->path() == 'notifications') btn-primary @endif" style="@if (request()->path() == 'notifications') padding: 5px; border-radius: 50%; @endif"></i>
				</a>
			</li>
			</ul>
</div>

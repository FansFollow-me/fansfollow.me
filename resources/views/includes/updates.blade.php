<!--My Changes-->

@foreach ($updates as $response)



	@php

		if (auth()->check()) {

			$checkUserSubscription = auth()->user()->checkSubscription($response->user());

			$checkPayPerView = auth()->user()->payPerView()->where('updates_id', $response->id)->first();

		}



		$totalLikes = number_format($response->likes()->count());

		$totalComments = $response->totalComments();

		$mediaCount = $response->media()->count();

		$allFiles = $response->media()->groupBy('type')->get();

		$getFirstFile = $allFiles->where('type', '<>', 'music')->where('type', '<>', 'file')->where('video_embed', '')->first();



		if ($getFirstFile && $getFirstFile->type == 'image') {

			$urlMedia =  url('media/storage/focus/photo', $getFirstFile->id);

			$backgroundPostLocked = 'background: url('.$urlMedia.') no-repeat center center #b9b9b9; background-size: cover;';

			$textWhite = 'text-white';



		} elseif ($getFirstFile && $getFirstFile->type == 'video' && $getFirstFile->video_poster) {

				$videoPoster = url('media/storage/focus/video', $getFirstFile->video_poster);

				$backgroundPostLocked = 'background: url('.$videoPoster.') no-repeat center center #b9b9b9; background-size: cover;';

				$textWhite = 'text-white';



		} else {

			$backgroundPostLocked = null;

			$textWhite = null;

		}



		$countFilesImage = $response->media()->where('image', '<>', '')->groupBy('type')->count();

		$countFilesVideo = $response->media()->where('video', '<>', '')->orWhere('video_embed', '<>', '')->where('updates_id', $response->id)->groupBy('type')->count();

		/* My changes */

		$allFilesVideo = $response->media()->where('video', '<>', '')->orWhere('video_embed', '<>', '')->where('updates_id', $response->id)->get();

		$countFilesAudio = $response->media()->where('music', '<>', '')->groupBy('type')->count();



		$mediaImageVideo = $response->media()

				->where('image', '<>', '')

				->orWhere('updates_id', $response->id)

				->where('video', '<>', '')

				->get();



		$mediaImageVideoTotal = $mediaImageVideo->count();



		$videoEmbed = $response->media()->where('video_embed', '<>', '')->get();

		$isVideoEmbed = false;



		if ($videoEmbed->count() != 0) {

			foreach ($videoEmbed as $media) {

				$isVideoEmbed = $media->video_embed;

			}

		}

		$nth = 0; // nth foreach nth-child(3n-1)

		//My Changes

	    $isvideoEmbeded = $response->media()->where('is_embed', 'yes')->get();

		$issVideoEmbed = false;



		if ($isvideoEmbeded->count() != 0) {

			foreach ($isvideoEmbeded as $media) {

				$issVideoEmbed = true;

			}

		}

		

		// All Payments My Changes

    $allPayment = PaymentGateways::where('enabled', '1')->whereSubscription('yes')->get();

    // User Plans

      $plans = $response->user()->plans()

        ->where('interval', '<>', 'monthly')

        ->whereStatus('1')

        ->get();

		

	@endphp

	<div class="card mb-3 card-updates views rounded-large shadow-large card-border-0 @if ($response->status == 'pending') post-pending @endif @if ($response->fixed_post == '1' && request()->path() == $response->user()->username || auth()->check() && $response->fixed_post == '1' && $response->user()->id == auth()->user()->id) pinned-post @endif" data="{{$response->id}}">

	<div class="card-body">

		<div class="pinned_post text-muted small w-100 mb-2 {{ $response->fixed_post == '1' && request()->path() == $response->user()->username || auth()->check() && $response->fixed_post == '1' && $response->user()->id == auth()->user()->id ? 'pinned-current' : 'display-none' }}">

			<i class="bi bi-pin mr-2"></i> {{ trans('general.pinned_post') }}

		</div>



		@if ($response->status == 'pending')

			<h6 class="text-muted w-100 mb-4">

				<i class="bi bi-eye-fill mr-1"></i> <em>{{ trans('general.post_pending_review') }}</em>

			</h6>

		@endif



	<div class="media">

		<span class="rounded-circle mr-3 position-relative">

			<a href="{{$response->user()->isLive() ? url('live', $response->user()->username) : url($response->user()->username)}}">



				@if (auth()->check() && $response->user()->isLive())

					<span class="live-span">{{ trans('general.live') }}</span>

				@endif



				<img src="{{ Helper::getFile(config('path.avatar').$response->user()->avatar) }}" alt="{{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}" class="rounded-circle avatarUser" width="60" height="60">

				</a>

		</span>



		<div class="media-body">

				<h5 class="mb-0 font-montserrat">

					<a href="{{url($response->user()->username)}}">

					{{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}

				</a>



				@if($response->user()->verified_id == 'yes')

					<small class="verified" title="{{trans('general.verified_account')}}"data-toggle="tooltip" data-placement="top">

						<i class="bi bi-patch-check-fill"></i>

					</small>

				@endif



				<small class="text-muted font-14">{{'@'.$response->user()->username}}</small>

				<!--My Changes-->

				@guest

				@if ($response->cat_post != '' && $response->cat_post != Null)

                <span data-cat="{{ $response->cat_post}}" class="float-right mr-3 cat-tag-post nav-link">

                    ({{\App\Models\Updates::where('cat_post', $response->cat_post)->where('user_id', $response->user()->id)->count()}})

                    {!! $response->cat_post !!}</span>

                @endif

                @endguest
                
                @if(auth()->check()

					&& auth()->user()->id != $response->user()->id

					&& $response->locked == 'yes'

					&& $checkUserSubscription && $response->price == 0.00



					|| auth()->check()

						&& auth()->user()->id != $response->user()->id

						&& $response->locked == 'yes'

						&& $checkUserSubscription

						&& $response->price != 0.00

						&& $checkPayPerView



					|| auth()->check()

						&& auth()->user()->id != $response->user()->id

						&& $response->price != 0.00

						&& ! $checkUserSubscription

						&& $checkPayPerView

					)

                @if ($response->cat_post != '' && $response->cat_post != Null)

                <span data-cat="{{ $response->cat_post}}" class="float-right mr-3 cat-tag-post nav-link">

                    ({{\App\Models\Updates::where('cat_post', $response->cat_post)->where('user_id', $response->user()->id)->count()}})

                    {!! $response->cat_post !!}</span>

                @endif
                @endif

                <!--My Changes end-->



				@if (auth()->check() && auth()->user()->id == $response->user()->id)

				<a href="javascript:void(0);" class="text-muted float-right" id="dropdown_options_{{$response->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

					<i class="fa fa-ellipsis-h"></i>

				</a>

				 <!--My Changes-->

                @if ($response->is_schedule == 'yes' && $response->schedule_date_time > \Carbon\Carbon::now())

                <small class="text-muted float-right mr-3">{{ date('m-d-Y h:i A', strtotime($response->schedule_date_time))}}</small>

                @endif

                 @if ($response->cat_post != '' && $response->cat_post != Null)

                <span data-cat="{{ $response->cat_post}}" class="float-right mr-3 cat-tag-post nav-link">

                    ({{\App\Models\Updates::where('cat_post', $response->cat_post)->where('user_id', $response->user()->id)->count()}})

                    {!! $response->cat_post !!}</span>

                @endif

                <!--My Changes end-->



				<!-- Target -->

				<button class="d-none copy-url" id="url{{$response->id}}" data-clipboard-text="{{url($response->user()->username.'/post', $response->id)}}">{{trans('general.copy_link')}}</button>



				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_options_{{$response->id}}">

					@if (request()->path() != $response->user()->username.'/post/'.$response->id)

						<a class="dropdown-item mb-1" href="{{url($response->user()->username.'/post', $response->id)}}"><i class="bi bi-box-arrow-in-up-right mr-2"></i> {{trans('general.go_to_post')}}</a>

					@endif



					@if ($response->status == 'active')

						<a class="dropdown-item mb-1 pin-post" href="javascript:void(0);" data-id="{{$response->id}}">

							<i class="bi bi-pin mr-2"></i> {{$response->fixed_post == '0' ? trans('general.pin_to_your_profile') : trans('general.unpin_from_profile') }}

						</a>

					@endif



					<button class="dropdown-item mb-1" onclick="$('#url{{$response->id}}').trigger('click')"><i class="feather icon-link mr-2"></i> {{trans('general.copy_link')}}</button>



					<button type="button" class="dropdown-item mb-1" data-toggle="modal" data-target="#editPost{{$response->id}}">

						<i class="bi bi-pencil mr-2"></i> {{trans('general.edit_post')}}

					</button>



					{!! Form::open([

						'method' => 'POST',

						'url' => "update/delete/$response->id",

						'class' => 'd-inline'

					]) !!}



					@if (isset($inPostDetail))

					{!! Form::hidden('inPostDetail', 'true') !!}

				@endif



					{!! Form::button('<i class="feather icon-trash-2 mr-2"></i> '.trans('general.delete_post'), ['class' => 'dropdown-item mb-1 actionDelete']) !!}

					{!! Form::close() !!}

						<!--My Changes-->

				@if($response->locked == 'yes' && $getFirstFile && $getFirstFile->type == 'video')

				    <button type="button" class="dropdown-item" data-toggle="modal" data-target="#timeLimtPost{{$response->id}}">

						<i class="bi bi-clock mr-2"></i> Set Preview time limit (In Seconds)

					</button>

				@endif

	      </div>



				<div class="modal fade modalEditPost" id="editPost{{$response->id}}" tabindex="-1" role="dialog" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header border-bottom-0">

							<h5 class="modal-title">{{trans('general.edit_post')}}</h5>

							<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">

								<span aria-hidden="true">

									<i class="bi bi-x-lg"></i>

								</span>

							</button>

						</div>

						<div class="modal-body">

							<form method="POST" action="{{url('update/edit')}}" enctype="multipart/form-data" class="formUpdateEdit">

								@csrf

								<input type="hidden" name="id" value="{{$response->id}}" />

							<div class="card mb-4">

								<div class="blocked display-none"></div>

								<div class="card-body pb-0">



									<div class="media">

										<div class="media-body">

										    <!--My Changes-->

										    @if($response->is_schedule == 'yes' && $response->schedule_date_time > \Carbon\Carbon::now())

                                              <div class="d-flex">

                                                  <div class="schedule-time bg-light border rounded px-2 py-1 mb-1 small align-items-center mr-2 col-6">

                                                  <div class="float-left"> {{date('m/d/Y h:i A', strtotime($response->schedule_date_time))}}</div>

                                                  <a href="#" target="_self" class="ml-1 remove-time-schedule float-right"><i class="bi-x-circle-fill"></i></a>

                                                  </div>

                                               </div>

                                               @endif

										<!--My Changes-->
										<textarea class="form-control textareaAutoSize emojiArea border-0 mentions d-none" name="description" id="updateDescription_{{$response->id}}"  rows="4" cols="40" placeholder="{{trans('general.write_something')}}">{{$response->description}}</textarea>
                                    <trix-editor class="textareaAutoSize emojiArea border-0 mentions" placeholder="{{trans('general.write_something')}}" id="updateDescription" data-post-length="{{$settings->update_length}}" input="updateDescription_{{$response->id}}"></trix-editor>

									</div>

								</div><!-- media -->



										<input class="custom-control-input d-none customCheckLocked" type="checkbox" {{$response->locked == 'yes' ? 'checked' : ''}}  name="locked" value="yes">

                                        <!--My Changes-->

										@if($response->is_schedule == 'yes' && $response->schedule_date_time > \Carbon\Carbon::now())

                                        <input class="custom-control-input d-none postSchedule" id="" type="checkbox" {{$response->is_schedule == 'yes' ? 'checked' : ''}} name="is_schedule" value="yes">

                                        <input class="custom-control-input d-none schedule_date" id="" type="hidden"  name="schedule_date" value="{{$response->schedule_date}}">

                                        <input class="custom-control-input d-none schedule_time" id="" type="hidden"  name="schedule_time" value="{{$response->schedule_time}}">

										@endif

										<!-- Alert -->

										<div class="alert alert-danger my-3 display-none errorUdpate">

										 <ul class="list-unstyled m-0 showErrorsUdpate small"></ul>

									 </div><!-- Alert -->



								</div><!-- card-body -->



								<div class="card-footer bg-white border-0 pt-0">

									<div class="justify-content-between align-items-center">



										<div class="form-group @if ($response->price == 0.00) display-none @endif price">

											<div class="input-group mb-2">

											<div class="input-group-prepend">

												<span class="input-group-text">{{$settings->currency_symbol}}</span>

											</div>

													<input class="form-control isNumber" value="{{$response->price != 0.00 ? $response->price : null}}" autocomplete="off" name="price" placeholder="{{trans('general.price')}}" type="text">

											</div>

										</div><!-- End form-group -->



										@if ($mediaCount == 0 && $response->locked == 'yes')

										<div class="form-group @if (! $response->title) display-none @endif titlePost">

											<div class="input-group mb-2">

											<div class="input-group-prepend">

												<span class="input-group-text"><i class="bi-type"></i></span>

											</div>

													<input class="form-control @if ($response->title) active @endif" value="{{$response->title ? $response->title : null}}" maxlength="100" autocomplete="off" name="title" placeholder="{{trans('admin.title')}}" type="text">

											</div>

											<small class="form-text text-muted mb-4 font-13">

				                {{ __('general.title_post_info', ['numbers' => 100]) }}

				              </small>

										</div><!-- End form-group -->

									@endif



										@if ($response->price == 0.00)

										<button type="button" class="btn btn-upload btn-tooltip e-none align-bottom setPrice @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="tooltip" data-placement="top" title="{{trans('general.price_post_ppv')}}">

											<i class="feather icon-tag f-size-25"></i>

										</button>

									@endif



									@if ($response->price == 0.00)

										<button type="button" class="contentLocked btn e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill btn-upload btn-tooltip {{$response->locked == 'yes' ? '' : 'unlock'}}" data-toggle="tooltip" data-placement="top" title="{{trans('users.locked_content')}}">

											<i class="feather icon-{{$response->locked == 'yes' ? '' : 'un'}}lock f-size-25"></i>

										</button>

									@endif



								@if ($mediaCount == 0 && $response->locked == 'yes')

									<button type="button" class="btn btn-upload btn-tooltip e-none align-bottom @if ($response->title) btn-active-hover @endif setTitle @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="tooltip" data-placement="top" title="{{trans('general.title_post_block')}}">

										<i class="bi-type f-size-25"></i>

									</button>

								@endif



										<div class="d-inline-block float-right mt-3">

											<button type="submit" class="btn btn-sm btn-primary rounded-pill float-right btnEditUpdate"><i></i> {{trans('users.save')}}</button>

										</div>

										<!--My Change-->

										@if($response->is_schedule == 'yes' && $response->schedule_date_time > \Carbon\Carbon::now())

                                         <a href="javascript:void(0);" data-toggle="modal" data-target="#scheduleModal" class="btnpickerEdit float-right mr-2 mt-4" style="font-size: 21px;" role="button"><i class="bi-calendar-check"></i></a>

                                        @endif



									</div>

								</div><!-- card footer -->

							</div><!-- card -->

						</form>

					</div><!-- modal-body -->

					</div><!-- modal-content -->

				</div><!-- modal-dialog -->

			</div><!-- modal -->

			<!--My Changes-->

			<div class="modal fade modalTimeLimitPost" id="timeLimtPost{{$response->id}}" tabindex="-1" role="dialog" aria-hidden="true">

				<div class="modal-dialog">

					<div class="modal-content">

						<div class="modal-header border-bottom-0">

							<h5 class="modal-title">Set Preview time limit (In Seconds)</h5>

							<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">

								<span aria-hidden="true">

									<i class="bi bi-x-lg"></i>

								</span>

							</button>

						</div>

						<div class="modal-body">

							<form method="POST" action="{{url('update/limit/time')}}" enctype="multipart/form-data" class="formTimeLimit">

								@csrf

								<input type="hidden" name="id" value="{{$response->id}}" />

								@php

                    		        $t_seconds = 0;

                                    if($getFirstFile && $getFirstFile->type == 'video'){

                                    $result = shell_exec('ffmpeg -i ' . escapeshellcmd(Helper::getFile(config('path.videos').$getFirstFile->video)) . ' 2>&1');

                                    

                                    preg_match('/(?<=Duration: )(\d{2}:\d{2}:\d{2})\.\d{2}/', $result, $match);

                                    if(isset($match[1])){

                                    $seconds = explode(':', $match[1]) + array(00,00,00);

                                    $t_seconds = $seconds[0]*3600 + $seconds[1] * 60 + $seconds[2];
                                }
                                    

                                    }

                                    

                                    

                                    

                            @endphp

								<input type="hidden" name="duration" id="duration{{$response->id}}" value="{{$t_seconds}}" />

							<div class="card mb-4">

								<div class="blocked display-none"></div>

								<div class="card-body pb-0">

                                    <!-- Alert -->

										<div class="alert alert-danger my-3 display-none errorUdpate">

										 <ul class="list-unstyled m-0 showErrorsUdpate small"></ul>

									 </div><!-- Alert -->



								</div><!-- card-body -->



								<div class="card-footer bg-white border-0 pt-0">

									<div class="justify-content-between align-items-center">



										<div class="form-group timielimit">

											<div class="input-group mb-2">

											<div class="input-group-prepend">

												<span class="input-group-text"><i class="bi bi-clock"></i></span>

											</div>

												<input class="form-control isNumber" value="{{$getFirstFile ? $getFirstFile->timielimit != NULL ? $getFirstFile->timielimit : null : null}}" autocomplete="off" name="timielimit" placeholder="Set Time limit" type="number" max="{{$t_seconds}}">

											</div>

										</div><!-- End form-group -->



										<div class="d-inline-block float-right mt-3">

											<button type="submit" class="btn btn-sm btn-primary rounded-pill float-right btnTimeLimit"><i></i> {{trans('users.save')}}</button>

										</div>



									</div>

								</div><!-- card footer -->

							</div><!-- card -->

						</form>

					</div><!-- modal-body -->

					</div><!-- modal-content -->

				</div><!-- modal-dialog -->

			</div><!-- modal -->

			@endif



				@if(auth()->check()

					&& auth()->user()->id != $response->user()->id

					&& $response->locked == 'yes'

					&& $checkUserSubscription && $response->price == 0.00



					|| auth()->check()

						&& auth()->user()->id != $response->user()->id

						&& $response->locked == 'yes'

						&& $checkUserSubscription

						&& $response->price != 0.00

						&& $checkPayPerView



					|| auth()->check()

						&& auth()->user()->id != $response->user()->id

						&& $response->price != 0.00

						&& ! $checkUserSubscription

						&& $checkPayPerView



					|| auth()->check() && auth()->user()->id != $response->user()->id && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'

					|| auth()->check() && auth()->user()->id != $response->user()->id && $response->locked == 'no'

					)

					<a href="javascript:void(0);" class="text-muted float-right" id="dropdown_options_{{$response->id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">

						<i class="fa fa-ellipsis-h"></i>

					</a>



					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown_options_{{$response->id}}">



						<!-- Target -->

						<button class="d-none copy-url" id="url{{$response->id}}" data-clipboard-text="{{url($response->user()->username.'/post', $response->id).Helper::referralLink()}}">

							{{trans('general.copy_link')}}

						</button>



						@if (request()->path() != $response->user()->username.'/post/'.$response->id)

							<a class="dropdown-item" href="{{url($response->user()->username.'/post', $response->id)}}">

								<i class="bi bi-box-arrow-in-up-right mr-2"></i> {{trans('general.go_to_post')}}

							</a>

						@endif



						<button class="dropdown-item" onclick="$('#url{{$response->id}}').trigger('click')">

							<i class="feather icon-link mr-2"></i> {{trans('general.copy_link')}}

						</button>



						<button type="button" class="dropdown-item" data-toggle="modal" data-target="#reportUpdate{{$response->id}}">

							<i class="bi bi-flag mr-2"></i>  {{trans('admin.report')}}

						</button>



					</div>

					<!--My Changes-->

					@if ($response->cat_post != '' && $response->cat_post != Null)

                    <span data-cat="{{ $response->cat_post}}" class="float-right mr-3 cat-tag-post nav-link">

                        ({{\App\Models\Updates::where('cat_post', $response->cat_post)->where('user_id', $response->user()->id)->count()}})

                        {!! $response->cat_post !!}</span>

                    @endif



			<div class="modal fade modalReport" id="reportUpdate{{$response->id}}" tabindex="-1" role="dialog" aria-hidden="true">

     		<div class="modal-dialog modal-danger modal-sm">

     			<div class="modal-content">

						<div class="modal-header">

              <h6 class="modal-title font-weight-light" id="modal-title-default">

								<i class="fas fa-flag mr-1"></i> {{trans('admin.report_update')}}

							</h6>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <i class="fa fa-times"></i>

              </button>

            </div>



					<!-- form start -->

					<form method="POST" action="{{url('report/update', $response->id)}}" enctype="multipart/form-data">

				  <div class="modal-body">

						@csrf

				    <!-- Start Form Group -->

            <div class="form-group">

              <label>{{trans('admin.please_reason')}}</label>

              	<select name="reason" class="form-control custom-select">

                    <option value="copyright">{{trans('admin.copyright')}}</option>

                    <option value="privacy_issue">{{trans('admin.privacy_issue')}}</option>

                    <option value="violent_sexual">{{trans('admin.violent_sexual_content')}}</option>

                  </select>

                  </div><!-- /.form-group-->

				      </div><!-- Modal body -->



							<div class="modal-footer">

								<button type="button" class="btn border text-white" data-dismiss="modal">{{trans('admin.cancel')}}</button>

								<button type="submit" class="btn btn-xs btn-white sendReport ml-auto"><i></i> {{trans('admin.report_update')}}</button>

							</div>

							</form>

     				</div><!-- Modal content -->

     			</div><!-- Modal dialog -->

     		</div><!-- Modal -->

				@endif

			</h5>



				<small class="timeAgo text-muted" data="{{date('c', strtotime($response->date))}}"></small>



				@if ($response->locked == 'no')

				<small class="text-muted type-post" title="{{trans('general.public')}}">

					<i class="iconmoon icon-WorldWide mr-1"></i>

				</small>

				@endif



			@if ($response->locked == 'yes')



				<small class="text-muted type-post" title="{{trans('users.content_locked')}}">



					<i class="feather icon-lock mr-1"></i>



					@if (auth()->check() && $response->price != 0.00

							&& $checkUserSubscription

							&& ! $checkPayPerView

							|| auth()->check() && $response->price != 0.00

							&& ! $checkUserSubscription

							&& ! $checkPayPerView

						)

						{{ Helper::formatPrice($response->price) }}



					@elseif (auth()->check() && $checkPayPerView)

						{{ __('general.paid') }}

					@endif

				</small>

			@endif

				<!--My Changes-->

			@if ($response->is_story == 'yes')



				<small class="text-muted type-post" title="{{ trans('my_lang.promoted') }}">



					<i class="bi bi-fire mr-1"></i>

				</small>

			@endif

		</div><!-- media body -->

	</div><!-- media -->

</div><!-- card body -->



@if (auth()->check() && auth()->user()->id == $response->user()->id

	|| $response->locked == 'yes' && $mediaCount != 0



	|| auth()->check() && $response->locked == 'yes'

	&& $checkUserSubscription

	&& $response->price == 0.00



	|| auth()->check() && $response->locked == 'yes'

	&& $checkUserSubscription

	&& $response->price != 0.00

	&& $checkPayPerView



	|| auth()->check() && $response->locked == 'yes'

	&& $response->price != 0.00

	&& ! $checkUserSubscription

	&& $checkPayPerView



	|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'

	|| $response->locked == 'no'

	)

	<div class="card-body pt-0 pb-3">

		<div class="mb-0 update-text position-relative text-word-break">

			<!--My changes-->

		    @if(!$issVideoEmbed)

			{!! Helper::linkText(Helper::checkText($response->description, $isVideoEmbed ?? null)) !!}

			@else

			@if (!in_array(Helper::videoUrl($isVideoEmbed), array('youtube.com','www.youtube.com','youtu.be','www.youtu.be', 'm.youtube.com')) && !in_array(Helper::videoUrl($isVideoEmbed), array('vimeo.com','player.vimeo.com')))

			{!! Helper::linkText(Helper::checkTextEmbed(htmlspecialchars_decode($response->description, null))) !!}

			@elseif(in_array(Helper::videoUrl($isVideoEmbed), array('youtube.com','www.youtube.com','youtu.be','www.youtu.be', 'm.youtube.com')))

			{!! Helper::linkText(Helper::checkTextEmbedYou(htmlspecialchars_decode($response->description, $isVideoEmbed ?? null))) !!}

			@endif

			@endif

		</div>

	</div>



@else

	@if ($response->title)

	<div class="card-body pt-0 pb-3">

		<p class="mb-0 update-text position-relative text-word-break font-weight-bold">

			{!! Helper::linkText($response->title) !!}

		</p>

	</div>

	@endif

@endif



		@if (auth()->check() && auth()->user()->id == $response->user()->id



		|| auth()->check() && $response->locked == 'yes'

		&& $checkUserSubscription

		&& $response->price == 0.00



		|| auth()->check() && $response->locked == 'yes'

		&& $checkUserSubscription

		&& $response->price != 0.00

		&& $checkPayPerView



		|| auth()->check() && $response->locked == 'yes'

		&& $response->price != 0.00

		&& ! $checkUserSubscription

		&& $checkPayPerView



		|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'

		|| $response->locked == 'no'

		)



	<div class="btn-block img-video-wrap">



		@if ($mediaImageVideoTotal <> 0)

			@include('includes.media-post')

		@endif



		@foreach ($response->media as $media)

			@if ($media->music != '')

			<div class="mx-3 border rounded @if ($mediaCount > 1) mt-3 @endif">

				<audio id="music-{{$media->id}}" class="js-player w-100 @if (!request()->ajax())invisible @endif" controls>

					<source src="{{ Helper::getFile(config('path.music').$media->music) }}" type="audio/mp3">

					Your browser does not support the audio tag.

				</audio>

			</div>

			@endif



			@if ($media->file != '')

			<a href="{{url('download/file', $response->id)}}" class="d-block text-decoration-none @if ($mediaCount > 1) mt-3 @endif">

				<div class="card mb-3 mx-3">

					<div class="row no-gutters">

						<div class="col-md-2 text-center bg-primary">

							<i class="far fa-file-archive m-4 text-white" style="font-size: 48px;"></i>

						</div>

						<div class="col-md-10">

							<div class="card-body">

								<h5 class="card-title text-primary text-truncate mb-0">

									{{ $media->file_name }}.zip

								</h5>

								<p class="card-text">

									<small class="text-muted">{{ $media->file_size }}</small>

								</p>

							</div>

						</div>

					</div>

				</div>

				</a>

			@endif

		@endforeach



		<!--My Changes -->

        @if($mediaImageVideoTotal <= 0)

		@if ($isVideoEmbed)



				@if (in_array(Helper::videoUrl($isVideoEmbed), array('youtube.com','www.youtube.com','youtu.be','www.youtu.be', 'm.youtube.com')))

					<div class="embed-responsive embed-responsive-16by9 mb-2">

						<iframe class="embed-responsive-item" height="360" src="https://www.youtube.com/embed/{{ Helper::getYoutubeId($isVideoEmbed) }}" allowfullscreen></iframe>

					</div>

				@endif



				<!--/*My Changes*/-->

				@if (in_array(Helper::videoUrl($isVideoEmbed), array('vimeo.com','player.vimeo.com')) && !$issVideoEmbed)

					<div class="embed-responsive embed-responsive-16by9">

						<iframe class="embed-responsive-item" src="https://player.vimeo.com/video/{{ Helper::getVimeoId($isVideoEmbed) }}" allowfullscreen></iframe>

					</div>

					@elseif(in_array(Helper::videoUrl($isVideoEmbed), array('vimeo.com','player.vimeo.com')) && $issVideoEmbed)

					<div class="embed-responsive embed-responsive-16by9">

						<iframe class="embed-responsive-item" src="{{$isVideoEmbed}}" allowfullscreen></iframe>

					</div>

				@endif



		@endif

		@endif

		<!--/*My Changes*/-->

		@if($mediaImageVideoTotal <= 0)

		@if ($issVideoEmbed)

                @if (!in_array(Helper::videoUrl($isVideoEmbed), array('youtube.com','www.youtube.com','youtu.be','www.youtu.be', 'm.youtube.com')) && !in_array(Helper::videoUrl($isVideoEmbed), array('vimeo.com','player.vimeo.com')))

				{!! Helper::cleanTextEmbed(htmlspecialchars_decode($response->description)) !!}

				@endif



		@endif

		@endif



	</div><!-- btn-block -->



@else



	<div class="btn-block p-sm text-center content-locked pt-lg pb-lg px-3 {{$textWhite}}" style="{{$backgroundPostLocked}}">

		<span class="btn-block text-center mb-3"><i class="feather icon-lock ico-no-result border-0 {{$textWhite}}"></i></span>

        

		@if ($response->user()->planActive() && $response->price == 0.00

				|| $response->user()->free_subscription == 'yes' && $response->price == 0.00)

			<!--My Changes-->

			<a href="javascript:void(0);" @guest data-toggle="modal" data-target="#loginFormModal" @else @if ($response->user()->free_subscription == 'yes') data-toggle="modal" data-target="#subscriptionFreeForm{{$response->id}}" @else data-toggle="modal" data-target="#subscriptionForm{{$response->id}}" @endif @endguest class="btn btn-primary w-100">

				{{ trans('general.content_locked_user_logged') }}

			</a>

		@elseif ($response->user()->planActive() && $response->price != 0.00

				|| $response->user()->free_subscription == 'yes' && $response->price != 0.00)

				<a href="javascript:void(0);" @guest data-toggle="modal" data-target="#loginFormModal" @else @if ($response->status == 'active') data-toggle="modal" data-target="#payPerViewForm" data-mediaid="{{$response->id}}" data-price="{{Helper::formatPrice($response->price, true)}}" data-subtotalprice="{{Helper::formatPrice($response->price)}}" data-pricegross="{{$response->price}}" @endif @endguest class="btn btn-primary w-100">

					@guest

						{{ trans('general.content_locked_user_logged') }}

					@else



						@if ($response->status == 'active')

								<i class="feather icon-unlock mr-1"></i> {{ trans('general.unlock_post_for') }} {{Helper::formatPrice($response->price)}}



							@else

								{{ trans('general.post_pending_review') }}

						@endif

						@endguest

				</a>

		@else

			<a href="javascript:void(0);" class="btn btn-primary disabled w-100">

				{{ trans('general.subscription_not_available') }}

			</a>

		@endif



		<ul class="list-inline mt-3">



		@if ($mediaCount == 0)

			<li class="list-inline-item"><i class="bi bi-file-font"></i> {{ __('admin.text') }}</li>

		@endif



@if ($mediaCount != 0)

	@foreach ($allFiles as $media)



		@if ($media->type == 'image')

			<li class="list-inline-item"><i class="feather icon-image"></i> {{$countFilesImage}}</li>

		@endif



		@if ($media->type == 'video')

			<!--My Changes -->

			<!--<li class="list-inline-item"><i class="feather icon-video"></i> {{$countFilesVideo}} @if ($media->duration_video && $countFilesVideo == 1 || $media->quality_video && $countFilesVideo == 1) <small>- {{ $media->quality_video }} {{ $media->duration_video }}</small> @endif</li>-->

			<li class="list-inline-item"><i class="feather icon-video"></i> {{$countFilesVideo}}</li><br>

			@foreach($allFilesVideo as $FileVideo)

			

		@php

		        $duration = array();

                if($media->type == 'video'){

                $result = shell_exec('ffmpeg -i ' . escapeshellcmd(Helper::getFile(config('path.videos').$FileVideo->video)) . ' 2>&1');

                

                preg_match('/(?<=Duration: )(\d{2}:\d{2}:\d{2})\.\d{2}/', $result, $match);

                if(isset($match[1]))

                $duration = explode(':', $match[1]) + array(00,00,00);

                }

                

                

                

        @endphp

        @if(!empty($duration))

        

			<span class="visually-hidden"><span style="background-color: rgb(248, 249, 250, 0.7); border:1px #c9c5c1;" class="btn btn-light"><i class="bi bi-camera-reels mr-2"></i>{{$duration[0] != '00' ? (int)$duration[0]." Hours :".(int)$duration[1]." Minutes :".(int)$duration[2] ." Seconds" : (int)$duration[1]." Minutes :".(int)$duration[2] ." Seconds"}}</span></span>

	<br>

		@endif

		@if($media->timielimit != NULL || $media->timielimit != 0)

		@php



        $hours = round($media->timielimit / 3600 % 24);

        $minutes = round($media->timielimit / 60 % 60);

        $seconds = round($media->timielimit % 60);

		@endphp

		<button type="button" class="btn btn-danger mt-2 trailer-btn" src="{{$FileVideo->video}}" data-toggle="modal" data-target="#trailerModal{{$media->id}}">

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-play-fill" viewBox="0 0 16 16">

                  <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM6 5.883a.5.5 0 0 1 .757-.429l3.528 2.117a.5.5 0 0 1 0 .858l-3.528 2.117a.5.5 0 0 1-.757-.43V5.884z"></path>

                </svg> 

                Play Trailer | <i class="bi bi-camera-reels mr-2"></i>{{(int)$minutes." Minutes :".(int)$seconds ." Seconds"}}

        </button>

        @endif

		@endforeach

                <!-- Modal -->

        <div class="modal fade" id="trailerModal{{$media->id}}" tabindex="-1" role="dialog" aria-labelledby="trailerModalLabel{{$media->id}}" aria-hidden="true">

          <div class="modal-dialog modal-lg" role="document">

            <div class="modal-content">

              <div class="modal-header">

                <h5 class="modal-title" id="trailerModalLabel{{$media->id}}" style="color: #000;">Video Trailer</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                  <span aria-hidden="true">&times;</span>

                </button>

              </div>

              <div class="modal-body">

                <video src="{{ Helper::getFile(config('path.videos').$media->video) }}" limit="{{$media->timielimit}}" disableRemotePlayback preload="none" image="@if($media->thumimge != NULL){{Helper::getFile(config('path.images').$media->thumimge)}}@endif" class="w-100 video-js vjs-fluid" id="player_post_{{$media->id}}" @if ($media->video_poster) poster="{{ Helper::getFile(config('path.videos').$media->video_poster) }}" @endif>

            		<source src="{{ Helper::getFile(config('path.videos').$media->video) }}" type="video/mp4" />

            	</video>

              </div>

              <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                

              </div>

            </div>

          </div>

        </div>

		<!--My Changes end-->

		@endif



		@if ($media->type == 'music')

			<li class="list-inline-item"><i class="feather icon-mic"></i> {{$countFilesAudio}}</li>

			@endif



			@if ($media->type == 'file')

			<li class="list-inline-item"><i class="far fa-file-archive"></i> {{$media->file_size}}</li>

		@endif



	@endforeach

	@endif

</ul>



</div><!-- btn-block parent -->



	@endif



@if ($response->status == 'active')

<div class="card-footer bg-white border-top-0 rounded-large">

    <h4 class="mb-2">

			@php

			$likeActive = auth()->check() && auth()->user()->likes()->where('updates_id', $response->id)->where('status','1')->first();

			$bookmarkActive = auth()->check() && auth()->user()->bookmarks()->where('updates_id', $response->id)->first();



			if(auth()->check() && auth()->user()->id == $response->user()->id



			|| auth()->check() && $response->locked == 'yes'

			&& $checkUserSubscription

			&& $response->price == 0.00



			|| auth()->check() && $response->locked == 'yes'

			&& $checkUserSubscription

			&& $response->price != 0.00

			&& $checkPayPerView



			|| auth()->check() && $response->locked == 'yes'

			&& $response->price != 0.00

			&& ! $checkUserSubscription

			&& $checkPayPerView



			|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'

			|| auth()->check() && $response->locked == 'no') {

				$buttonLike = 'likeButton';

				$buttonBookmark = 'btnBookmark';

			} else {

				$buttonLike = null;

				$buttonBookmark = null;

			}

			@endphp



			<a class="pulse-btn btnLike @if ($likeActive)active @endif {{$buttonLike}} text-muted mr-14px" href="javascript:void(0);" @guest data-toggle="modal" data-target="#loginFormModal" @endguest @auth data-id="{{$response->id}}" @endauth>

				<i class="@if($likeActive)fas @else far @endif fa-heart"></i>

			</a>



			<span class="text-muted mr-14px @auth @if (! isset($inPostDetail) && $buttonLike) pulse-btn toggleComments @endif @endauth">

				<i class="far fa-comment"></i>

			</span>



			<a class="pulse-btn text-muted text-decoration-none mr-14px" href="javascript:void(0);" title="{{trans('general.share')}}" data-toggle="modal" data-target="#sharePost{{$response->id}}">

				<i class="feather icon-share"></i>

			</a>



			<!-- Share modal -->

			<div class="modal fade" id="sharePost{{$response->id}}" tabindex="-1" role="dialog" aria-hidden="true">

			<div class="modal-dialog modal-dialog-centered">

				<div class="modal-content">

					<div class="modal-header border-bottom-0">

						<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">

							<span aria-hidden="true"><i class="bi bi-x-lg"></i></span>

						</button>

					</div>

					<div class="modal-body">

						<div class="container-fluid">

							<div class="row">

								<div class="col-md-3 col-6 mb-3">

									<a href="https://www.facebook.com/sharer/sharer.php?u={{url($response->user()->username.'/post', $response->id).Helper::referralLink()}}" title="Facebook" target="_blank" class="social-share text-muted d-block text-center h6">

										<i class="fab fa-facebook-square facebook-btn"></i>

										<span class="btn-block mt-3">Facebook</span>

									</a>

								</div>

								<div class="col-md-3 col-6 mb-3">

									<a href="https://twitter.com/intent/tweet?url={{url($response->user()->username.'/post', $response->id).Helper::referralLink()}}&text={{ e( $response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name ) }}" data-url="{{url($response->user()->username.'/post', $response->id)}}" class="social-share text-muted d-block text-center h6" target="_blank" title="Twitter">

										<i class="fab fa-twitter twitter-btn"></i> <span class="btn-block mt-3">Twitter</span>

									</a>

								</div>

								<div class="col-md-3 col-6 mb-3">

									<a href="whatsapp://send?text={{url($response->user()->username.'/post', $response->id).Helper::referralLink()}}" data-action="share/whatsapp/share" class="social-share text-muted d-block text-center h6" title="WhatsApp">

										<i class="fab fa-whatsapp btn-whatsapp"></i> <span class="btn-block mt-3">WhatsApp</span>

									</a>

								</div>



								<div class="col-md-3 col-6 mb-3">

									<a href="sms://?body={{ trans('general.check_this') }} {{url($response->user()->username.'/post', $response->id).Helper::referralLink()}}" class="social-share text-muted d-block text-center h6" title="{{ trans('general.sms') }}">

										<i class="fa fa-sms"></i> <span class="btn-block mt-3">{{ trans('general.sms') }}</span>

									</a>

								</div>

							</div>



						</div>

					</div>

				</div>

			</div>

			</div>

			<!-- modal share -->



	@auth

		@if (auth()->user()->id != $response->user()->id

					&& $checkUserSubscription && $response->price == 0.00

					&& $settings->disable_tips == 'off'



					|| auth()->user()->id != $response->user()->id

					&& $checkUserSubscription

					&& $response->price != 0.00

					&& $checkPayPerView

					&& $settings->disable_tips == 'off'



					|| auth()->check() && $response->locked == 'yes'

					&& $response->price != 0.00

					&& ! $checkUserSubscription

					&& $checkPayPerView

					&& $settings->disable_tips == 'off'



					|| auth()->user()->id != $response->user()->id

					&& $response->locked == 'no'

					&& $settings->disable_tips == 'off'

					)

<a href="javascript:void(0);" data-toggle="modal" title="{{trans('general.tip')}}" data-target="#tipForm" class="pulse-btn text-muted text-decoration-none" @auth data-id="{{$response->id}}" data-cover="{{Helper::getFile(config('path.cover').$response->user()->cover)}}" data-avatar="{{Helper::getFile(config('path.avatar').$response->user()->avatar)}}" data-name="{{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}" data-userid="{{$response->user()->id}}" @endauth>

<svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">

  <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>

  <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>

  <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>

</svg>



				<h6 class="d-inline font-weight-lighter">@lang('general.tip')</h6>

			</a>

		@endif

	@endauth

            <!--My Changes ml-2-->

			<a href="javascript:void(0);" @guest data-toggle="modal" data-target="#loginFormModal" @endguest class="pulse-btn ml-2 @if ($bookmarkActive) text-primary @else text-muted @endif float-right {{$buttonBookmark}}" @auth data-id="{{$response->id}}" @endauth>

				<i class="@if ($bookmarkActive)fas @else far @endif fa-bookmark"></i>

			</a>

			<!--My Changes -->

			@if ($mediaCount == 1 && $getFirstFile && $getFirstFile->type == 'video')

			<span class="text-sm ml-2" style="font-size: 17px; font-weight: 500;"> {{Helper::formatNumber($getFirstFile->views()->count())}} views</span>

			@endif

            @if($response->is_story == 'yes')
            @if($response->is_schedule == 'yes' && $response->schedule_date_time <= \Carbon\Carbon::now())
            <span class="text-sm ml-2 mt-1 float-right" style="font-size: 19px;">

				<small class="timer" id="countdown{{$response->id}}" item="{{$response->id}}" time="{{date('c', strtotime($response->schedule_date_time . ' +1 day'))}}"></small>

			</span>
			@elseif($response->is_schedule != 'yes')
			<span class="text-sm ml-2 mt-1 float-right" style="font-size: 19px;">

				<small class="timer" id="countdown{{$response->id}}" item="{{$response->id}}" time="{{date('c', strtotime($response->date . ' +1 day'))}}"></small>

			</span>
            @endif
			@endif

			<!--My Changes end-->

		</h4>



		<div class="w-100 mb-3 containerLikeComment">

			<span class="countLikes text-muted dot-item">

				{{ trans_choice('general.like_likes', $totalLikes, ['total' => Helper::formatNumber($totalLikes)]) }} <!--My Changes-->

			</span> 

			<span class="text-muted totalComments dot-item @auth @if (! isset($inPostDetail) && $buttonLike)toggleComments @endif @endauth">

				{{ trans_choice('general.comment_comments', $totalComments, ['total' => Helper::formatNumber($totalComments)]) }} <!--My Changes-->

			</span>



			@if ($response->video_views)

			<span class="text-muted dot-item">

				<i class="bi-eye mr-1"></i> {{ Helper::formatNumber($response->video_views) }}

			</span>

			@endif

		</div>



@auth



@if (! auth()->user()->checkRestriction($response->user()->id))

<div class="container-comments @if ( ! isset($inPostDetail)) display-none @endif">



<div class="container-media">

@if($response->comments()->count() != 0)



	@php

	  $comments = $response->comments()->take($settings->number_comments_show)->orderBy('id', 'DESC')->get();

	  $data = [];



	  if ($comments->count()) {

	      $data['reverse'] = collect($comments->values())->reverse();

	  } else {

	      $data['reverse'] = $comments;

	  }



	  $dataComments = $data['reverse'];

	  $counter = ($response->comments()->count() - $settings->number_comments_show);

	@endphp



	@if (auth()->user()->id == $response->user()->id



		|| $response->locked == 'yes'

		&& $checkUserSubscription

		&& $response->price == 0.00



		|| $response->locked == 'yes'

		&& $checkUserSubscription

		&& $response->price != 0.00

		&& $checkPayPerView



		|| auth()->check() && $response->locked == 'yes'

		&& $response->price != 0.00

		&& ! $checkUserSubscription

		&& $checkPayPerView



		|| auth()->user()->role == 'admin'

		&& auth()->user()->permission == 'all'

		|| $response->locked == 'no')



		@include('includes.comments')



@endif



@endif

	</div><!-- container-media -->



	@if (auth()->user()->id == $response->user()->id



		|| $response->locked == 'yes'

		&& $checkUserSubscription

		&& $response->price == 0.00



		|| $response->locked == 'yes'

		&& $checkUserSubscription

		&& $response->price != 0.00

		&& $checkPayPerView



		|| auth()->check() && $response->locked == 'yes'

		&& $response->price != 0.00

		&& ! $checkUserSubscription

		&& $checkPayPerView



		|| auth()->user()->role == 'admin'

		&& auth()->user()->permission == 'all'

		|| $response->locked == 'no')



		<div class="alert alert-danger alert-small dangerAlertComments display-none">

			<ul class="list-unstyled m-0 showErrorsComments"></ul>

		</div><!-- Alert -->



		<div class="isReplyTo display-none w-100 bg-light py-2 px-3 mb-3 rounded">

			{{ __('general.replying_to') }} <span class="username-reply"></span>



			<span class="float-right c-pointer cancelReply" title="{{ __('admin.cancel') }}">

				<i class="bi-x-lg"></i>

			</span>

		</div>



		<div class="media position-relative pt-3 border-top">

			<div class="blocked display-none"></div>

			<span href="#" class="float-left">

				<img src="{{ Helper::getFile(config('path.avatar').auth()->user()->avatar) }}" class="rounded-circle mr-1 avatarUser" width="40">

			</span>

			<div class="media-body">

				<form action="{{url('comment/store')}}" method="post" class="comments-form">

					@csrf

					<input type="hidden" name="update_id" value="{{$response->id}}" />

					<input class="isReply" type="hidden" name="isReply" value="" />



					<div>

					<span class="triggerEmoji" data-toggle="dropdown">

						<i class="bi-emoji-smile"></i>

					</span>



					<div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownMenuButton">

				    @include('includes.emojis')

				  </div>

				</div>



				<input type="text" name="comment" class="form-control comments inputComment emojiArea border-0" autocomplete="off" placeholder="{{trans('general.write_comment')}}"></div>

				</form>

			</div>

			@endif



			</div><!-- container-comments -->

		@endif



			@endauth

  </div><!-- card-footer -->

	@endif

</div><!-- card -->



@if (request()->is('/') && $loop->first && $users->total() != 0

	|| request()->is('explore') && $loop->first && $users->total() != 0

	|| request()->is('my/bookmarks') && $loop->first && $users->total() != 0

	|| request()->is('my/purchases') && $loop->first && $users->total() != 0

	|| request()->is('my/likes') && $loop->first && $users->total() != 0

	)

	<div class="p-3 d-lg-none">

		@include('includes.explore_creators')

	</div>

@endif

<!--My Changes-->

@if (auth()->check() && auth()->id() != $response->user()->id && ! $checkUserSubscription  && $response->user()->verified_id == 'yes')

     @php

     if (isset($ajaxRequest)) {

            		$totalPosts = $total;

            	} else {

            		$totalPosts = $updates->total();

            	}

    @endphp

    @if ($response->user()->free_subscription == 'no')

    <div class="modal fade" id="subscriptionForm{{$response->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">

      <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">

        <div class="modal-content">

          <div class="modal-body p-0">

            <div class="card bg-white shadow border-0">

              <div class="card-header pb-2 border-0 position-relative" style="height: 100px; background: {{$settings->color_default}} @if ($response->user()->cover != '')  url('{{Helper::getFile(config('path.cover').$response->user()->cover)}}') no-repeat center center @endif; background-size: cover;">



              </div>

              <div class="card-body px-lg-5 py-lg-5 position-relative">



                <div class="text-muted text-center mb-3 position-relative modal-offset">

                  <img src="{{Helper::getFile(config('path.avatar').$response->user()->avatar)}}" width="100" alt="{{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}" class="avatar-modal rounded-circle mb-1">

                  <h6 class="font-weight-light">

                    {!! trans('general.subscribe_month', ['price' => '<span class="font-weight-bold">'.Helper::amountFormatDecimal($response->user()->plan('monthly', 'price'), true).'</span>']) !!} {{trans('general.unlocked_content')}} {{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}

                  </h6>

                </div>

                

                @if ($totalPosts == 0 && $findPostPinned->count() == 0)

                  <div class="alert alert-warning fade show small" role="alert">

                    <i class="fa fa-exclamation-triangle mr-1"></i> {{ $response->user()->first_name }} {{ trans('general.not_posted_any_content') }}

                  </div>

                @endif



                <div class="text-center text-muted mb-2">

                  <h5>{{trans('general.what_will_you_get')}}</h5>

                </div>



                <ul class="list-unstyled">

                  <li><i class="fa fa-check mr-2 @if (auth()->user()->dark_mode == 'on') text-white @else text-primary @endif"></i> {{trans('general.full_access_content')}}</li>

                  <li><i class="fa fa-check mr-2 @if (auth()->user()->dark_mode == 'on') text-white @else text-primary @endif"></i> {{trans('general.direct_message_with_this_user')}}</li>

                  <li><i class="fa fa-check mr-2 @if (auth()->user()->dark_mode == 'on') text-white @else text-primary @endif"></i> {{trans('general.cancel_subscription_any_time')}}</li>

                </ul>



                <div class="text-center text-muted mb-2 @if ($allPayment->count() == 1) d-none @endif">

                  <small><i class="far fa-credit-card mr-1"></i> {{trans('general.choose_payment_gateway')}}</small>

                </div>



                <form method="post" action="{{url('buy/subscription')}}" id="formSubscription">

                  @csrf



                  <input type="hidden" name="id" value="{{$response->user()->id}}"  />

                  <input name="interval" value="monthly" id="plan-monthly" class="d-none" type="radio">



                  @foreach ($plans as $plan)

                    <input name="interval" value="{{ $plan->interval }}" id="plan-{{ $plan->interval }}" class="d-none" type="radio">

                  @endforeach



                  @foreach ($allPayment as $payment)



                    @php



                    if ($payment->recurrent == 'no') {

                      $recurrent = '<br><small>'.trans('general.non_recurring').'</small>';

                    } else if ($payment->id == 1) {

                      $recurrent = '<br><small>'.trans('general.redirected_to_paypal_website').'</small>';

                    } else {

                      $recurrent = '<br><small>'.trans('general.automatically_renewed').' ('.$payment->name.')</small>';

                    }



                    if ($payment->type == 'card' ) {

                      $paymentName = '<i class="far fa-credit-card mr-1"></i> '.trans('general.debit_credit_card').$recurrent;

                    } else if ($payment->id == 1) {

                      $paymentName = '<img src="'.url('public/img/payments', auth()->user()->dark_mode == 'off' ? $payment->logo : 'paypal-white.png').'" width="70"/> <small class="w-100 d-block">'.trans('general.redirected_to_paypal_website').'</small>';

                    } else {

                      $paymentName = '<img src="'.url('public/img/payments', $payment->logo).'" width="70"/>'.$recurrent;

                    }



                    @endphp



                    <div class="custom-control custom-radio mb-3">

                      <input name="payment_gateway" value="{{$payment->id}}" id="radio{{$payment->id}}" @if ($allPayment->count() == 1 && Helper::userWallet('balance') == 0) checked @endif class="custom-control-input" type="radio">

                      <label class="custom-control-label" for="radio{{$payment->id}}">

                        <span><strong>{!!$paymentName!!}</strong></span>

                      </label>

                    </div>



                    @if ($payment->name == 'Stripe' && ! auth()->user()->pm_type != '')

                      <div id="stripeContainer" class="@if ($allPayment->count() == 1 && $payment->name == 'Stripe')d-block @else display-none @endif">

                      <a href="{{ url('settings/payments/card') }}" class="btn btn-secondary btn-sm mb-3 w-100">

                        <i class="far fa-credit-card mr-2"></i>

                        {{ trans('general.add_payment_card') }}

                      </a>

                      </div>

                    @endif



                    @if ($payment->name == 'Paystack' && ! auth()->user()->paystack_authorization_code)

                      <div id="paystackContainer" class="@if ($allPayment->count() == 1 && $payment->name == 'Paystack')d-block @else display-none @endif">

                      <a href="{{ url('my/cards') }}" class="btn btn-secondary btn-sm mb-3 w-100">

                        <i class="far fa-credit-card mr-2"></i>

                        {{ trans('general.add_payment_card') }}

                      </a>

                      </div>

                    @endif



                  @endforeach



                  @if ($settings->disable_wallet == 'on' && Helper::userWallet('balance') != 0 || $settings->disable_wallet == 'off')

                  <div class="custom-control custom-radio mb-3">

                    <input name="payment_gateway" @if (Helper::userWallet('balance') == 0) disabled @endif value="wallet" id="radio0" class="custom-control-input" type="radio">

                    <label class="custom-control-label" for="radio0">

                      <span>

                        <strong>

                        <i class="fas fa-wallet mr-1 icon-sm-radio"></i> {{ __('general.wallet') }}

                        <span class="w-100 d-block font-weight-light">

                          {{ __('general.available_balance') }}: <span class="font-weight-bold mr-1">{{Helper::userWallet()}}</span>



                          @if (Helper::userWallet('balance') != 0 && $settings->wallet_format != 'real_money')

                            <i class="bi bi-info-circle text-muted" data-toggle="tooltip" data-placement="top" title="{{Helper::equivalentMoney($settings->wallet_format)}}"></i>

                          @endif



                          @if (Helper::userWallet('balance') == 0)

                          <a href="{{ url('my/wallet') }}" class="link-border">{{ __('general.recharge') }}</a>

                        @endif

                        </span>

                        <span class="w-100 d-block small">{{ trans('general.automatically_renewed_wallet') }}</span>

                      </strong>

                      </span>

                    </label>

                  </div>

                @endif



                  <div class="alert alert-danger display-none" id="error">

                      <ul class="list-unstyled m-0" id="showErrors"></ul>

                    </div>



                  <div class="custom-control custom-control-alternative custom-checkbox">

                    <input class="custom-control-input" id=" customCheckLogin" name="agree_terms" type="checkbox">

                    <label class="custom-control-label" for=" customCheckLogin">

                      <span>{{trans('general.i_agree_with')}} <a href="{{$settings->link_terms}}" target="_blank">{{trans('admin.terms_conditions')}}</a></span>

                    </label>

                  </div>



                  @if (auth()->user()->isTaxable()->count())

                  <ul class="list-group list-group-flush border-dashed-radius mt-3">

                  	@foreach (auth()->user()->isTaxable() as $tax)

                  		<li class="list-group-item py-1 list-taxes">

                  	    <div class="row">

                  	      <div class="col">

                  	        <small>{{ $tax->name }} {{ $tax->percentage }}% {{ trans('general.applied_price') }}</small>

                  	      </div>

                  	    </div>

                  	  </li>

                  	@endforeach

                  </ul>

                @endif



                  <div class="text-center">

                    <button type="submit" class="btn btn-primary mt-4 w-100 subscriptionBtn" onclick="$('#plan-monthly').trigger('click');">

                      <i></i> {{trans('general.subscribe_month', ['price' => Helper::amountFormatDecimal($response->user()->plan('monthly', 'price'), true)])}}

                    </button>



                    @if ($plans->count())

                      <a class="d-block my-3 btn-arrow-expand-bi" data-toggle="collapse" href="#collapseSubscriptionBundles" role="button" aria-expanded="false" aria-controls="collapseExample">

                        <i class="bi bi-box mr-1"></i> {{ trans('general.subscription_bundles') }} <i class="bi bi-chevron-down transition-icon"></i>

                      </a>



                      <div class="collapse" id="collapseSubscriptionBundles">

                        @foreach ($plans as $plan)

                          <button type="submit" class="btn btn-primary mt-2 w-100 subscriptionBtn" onclick="$('#plan-{{$plan->interval}}').trigger('click');">

                            <i></i> {{trans('general.subscribe_'.$plan->interval, ['price' => Helper::amountFormatDecimal($plan->price, true)])}}

                          </button>



                          @if (Helper::calculateSubscriptionDiscount($plan->interval, $response->user()->plan('monthly', 'price'), $plan->price) > 0)

                            <small class="@if (auth()->user()->dark_mode == 'on') text-white @else text-success @endif subscriptionDiscount">

                              <em>{{ Helper::calculateSubscriptionDiscount($plan->interval, $response->user()->plan('monthly', 'price'), $plan->price) }}% {{ trans('general.discount') }}  </em>

                            </small>

                          @endif



                        @endforeach

                      </div>



                    @endif



                    <div class="w-100 mt-2">

                      <button type="button" class="btn e-none p-0" data-dismiss="modal">{{trans('admin.cancel')}}</button>

                    </div>

                  </div>

                </form>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div><!-- End Modal Subscription -->

    @endif



    <!-- Subscription Free -->

    <div class="modal fade" id="subscriptionFreeForm{{$response->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">

      <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">

        <div class="modal-content">

          <div class="modal-body p-0">

            <div class="card bg-white shadow border-0">

              <div class="card-header pb-2 border-0 position-relative" style="height: 100px; background: {{$settings->color_default}} @if ($response->user()->cover != '')  url('{{Helper::getFile(config('path.cover').$response->user()->cover)}}') no-repeat center center @endif; background-size: cover;">



              </div>

              <div class="card-body px-lg-5 py-lg-5 position-relative">



                <div class="text-muted text-center mb-3 position-relative modal-offset">

                  <img src="{{Helper::getFile(config('path.avatar').$response->user()->avatar)}}" width="100" alt="{{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}" class="avatar-modal rounded-circle mb-1">

                  <h6 class="font-weight-light">

                    {{trans('general.subscribe_free_content') }} {{$response->user()->hide_name == 'yes' ? $response->user()->username : $response->user()->name}}

                  </h6>

                </div>

               



                @if ($totalPosts == 0 && $findPostPinned->count() == 0)

                  <div class="alert alert-warning fade show small" role="alert">

                    <i class="fa fa-exclamation-triangle mr-1"></i> {{ $response->user()->first_name }} {{ trans('general.not_posted_any_content') }}

                  </div>

                @endif



                <div class="text-center text-muted mb-2">

                  <h5>{{trans('general.what_will_you_get')}}</h5>

                </div>



                <ul class="list-unstyled">

                  <li><i class="fa fa-check mr-2 text-primary"></i> {{trans('general.full_access_content')}}</li>

                  <li><i class="fa fa-check mr-2 text-primary"></i> {{trans('general.direct_message_with_this_user')}}</li>

                  <li><i class="fa fa-check mr-2 text-primary"></i> {{trans('general.cancel_subscription_any_time')}}</li>

                </ul>



                <div class="w-100 text-center">

                  <a href="javascript:void(0);" data-id="{{ $response->user()->id }}" id="subscribeFree" class="btn btn-primary btn-profile mr-1">

                    <i class="feather icon-user-plus mr-1"></i> {{trans('general.subscribe_for_free')}}

                  </a>

                  <div class="w-100 mt-2">

                    <button type="button" class="btn e-none p-0" data-dismiss="modal">{{trans('admin.cancel')}}</button>

                  </div>

                </div>



              </div>

            </div>

          </div>

        </div>

      </div>

    </div><!-- End Modal Subscription Free -->

  @endif

  <!--My Changes end-->

@endforeach



@if (! isset($singlePost))

<div class="card mb-3 pb-4 loadMoreSpin d-none rounded-large shadow-large">

	<div class="card-body">

		<div class="media">

		<span class="rounded-circle mr-3">

			<span class="item-loading position-relative loading-avatar"></span>

		</span>

		<div class="media-body">

			<h5 class="mb-0 item-loading position-relative loading-name"></h5>

			<small class="text-muted item-loading position-relative loading-time"></small>

		</div>

	</div>

</div>

	<div class="card-body pt-0 pb-3">

		<p class="mb-1 item-loading position-relative loading-text-1"></p>

		<p class="mb-1 item-loading position-relative loading-text-2"></p>

		<p class="mb-0 item-loading position-relative loading-text-3"></p>

	</div>

</div>

@endif



@php

	if (isset($ajaxRequest)) {

		$totalPosts = $total;

	} else {

		$totalPosts = $updates->total();

	}

@endphp



@if ($totalPosts > $settings->number_posts_show && $counterPosts >= 1)

	<button rel="next" class="btn btn-primary w-100 text-center loadPaginator d-none" id="paginator">

		{{trans('general.loadmore')}}

	</button>

@endif

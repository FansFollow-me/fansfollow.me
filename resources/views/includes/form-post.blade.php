@include('includes.alert-payment-disabled')
<div class="progress-wrapper px-3 px-lg-0 display-none mb-3" id="progress">
    <div class="progress-info">
      <div class="progress-percentage">
        <span class="percent">0%</span>
      </div>
    </div>
    <div class="progress progress-xs">
      <div class="progress-bar bg-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
    </div>
  </div>

      <form method="POST" action="{{url('update/create')}}" enctype="multipart/form-data" id="formUpdateCreate">
        @csrf
      <div class="card mb-4 card-border-0 rounded-large shadow-large">
        <div class="blocked display-none"></div>
        <div class="card-body pb-0">

          <div class="media">
          <span class="rounded-circle mr-3">
      				<img src="{{ Helper::getFile(config('path.avatar').auth()->user()->avatar) }}" class="rounded-circle avatarUser" width="60" height="60">
      		</span>

          <!--My changes-->
          <!--<div class="media-body position-relative">

            <textarea  class="form-control textareaAutoSize border-0 emojiArea mentions" name="description" id="updateDescription" data-post-length="{{$settings->update_length}}" rows="4" cols="40" placeholder="{{trans('general.write_something')}}"></textarea>
          </div>-->
          <div class="media-body position-relative">
              <!--My Changes-->
              <!--<a href="javascript:void(0)" class="add_cat_post">
              <i class="fa fa-pen position-absolute" style="top: 10px; right: 58px"></i>
              </a>-->
              <div class="Category-onder" style="display:inline-block;">
                    <div class="Category">
                        <a class="dropdown-link" href="javascript:void(0)">
                            <i id="dropdown-icon" class="fas fa-pen"></i>
                       </a>
                    </div>
                </div>
                <div class="Category-onder display-none form-group dropdown-cat">
                <select name="cat_post" class="js-example-tags form-control w-100">
                 <option value="">-Select Category-</option>
                 @foreach($postCats as $postCat)
                 <option value="{{$postCat->value}}">
                     {{$postCat->value}}
                     </option>
                 @endforeach
                </select>
                </div>
                <a href="javascript:void(0)" class="tag_cat_post position-absolute d-none d-md-block" style="top: 48px; right: 34px"></a>
                <div>
                <span class="triggerEmoji @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="dropdown">
                  <i class="bi-emoji-smile f-size-25"></i>
                </span>

                <div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownEmoji">
                  @include('includes.emojis')
                </div>
              </div>
              <!--<input type="button" value="bold" onclick="formatText('b');" />-->
              <!--My Changes-->
              <div class="d-flex">
                  <div class="schedule-time display-none bg-light border rounded px-2 py-1 mb-1 small align-items-center mr-2 col-md-4 col-8">
                  <div class="float-left">11/30/2022 12:00 AM</div>
                  <a href="#"  class="ml-1 remove-time-schedule float-right"><i class="bi-x-circle-fill"></i></a>
                  </div>
               </div>
                <textarea class="form-control textareaAutoSize emojiArea border-0 mentions d-none" name="description" id="updateDescription_"  rows="4" cols="40" placeholder="{{trans('general.write_something')}}"></textarea>
                <trix-editor class="textareaAutoSize emojiArea border-0 mentions" placeholder="{{trans('general.write_something')}}" id="updateDescription" data-post-length="{{$settings->update_length}}" input="updateDescription_"></trix-editor>
              </div>
              <!--My changes end-->
        </div><!-- media -->

            <input class="custom-control-input d-none" id="customCheckLocked" type="checkbox" {{auth()->user()->post_locked == 'yes' ? 'checked' : ''}} name="locked" value="yes">
            <!--My Changes -->
            <input class="custom-control-input d-none" id="customStoryPost" type="checkbox"  name="is_story" value="yes">
            <!--<input class="custom-control-input d-none" id="customEmbedPost" type="checkbox"  name="is_embed" value="yes">-->
            <input class="custom-control-input d-none" id="postSchedule" type="checkbox"  name="is_schedule" value="yes">
            <input class="custom-control-input d-none" id="schedule_date" type="hidden"  name="schedule_date" value="">
            <input class="custom-control-input d-none" id="schedule_time" type="hidden"  name="schedule_time" value="">
            <input class="custom-control-input d-none" id="url2" type="hidden"  name="url2" value="{{url(request()->path())}}">

          <!-- Alert -->
          <div class="alert alert-danger my-3 display-none" id="errorUdpate">
           <ul class="list-unstyled m-0" id="showErrorsUdpate"></ul>
         </div><!-- Alert -->

        </div>
        <div class="card-footer bg-white border-0 pt-0 rounded-large">
          <div class="justify-content-between align-items-center">

            <div class="form-group display-none" id="price" >
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text">{{$settings->currency_symbol}}</span>
              </div>
                  <input class="form-control isNumber" autocomplete="off" name="price" placeholder="{{trans('general.price')}}" type="text">
              </div>
            </div><!-- End form-group -->
            <!--My changes-->
            <!--<div class="form-group display-none" id="embedText" >
                <textarea class="form-control textareaAutoSize" name="description_" id="updateDescription_1"  rows="4" cols="40" placeholder="Enter Embed code"></textarea>
            </div>-->
            <div class="form-group display-none" id="titlePost" >
              <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text"><i class="bi-type"></i></span>
              </div>
                  <input class="form-control" autocomplete="off" name="title" maxlength="100" placeholder="{{trans('admin.title')}}" type="text">
              </div>
              <small class="form-text text-muted mb-4">
                {{ __('general.title_post_info', ['numbers' => 100]) }}
              </small>
            </div><!-- End form-group -->

            <div class="w-100">
              <span id="previewImage"></span>
              <a href="javascript:void(0)" id="removePhoto" class="text-danger p-1 px-2 display-none btn-tooltip-form" data-toggle="tooltip" data-placement="top" title="{{trans('general.delete')}}"><i class="fa fa-times-circle"></i></a>
            </div>

            <input type="file" name="photo[]" id="filePhoto" accept="image/*,video/mp4,video/x-m4v,video/quicktime,video/x-quicktime,audio/mp3" multiple class="visibility-hidden filepond">

            <button type="button" class="btn btn-upload btnMultipleUpload btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="tooltip" data-placement="top" title="{{trans('general.upload_media')}} ({{ trans('general.media_type_upload') }})">
              <i class="feather icon-image f-size-25"></i>
            </button>

            @if ($settings->allow_zip_files)
            <input type="file" name="zip" id="fileZip" accept="application/x-zip-compressed" class="visibility-hidden">

            <button type="button" class="btn btn-upload btn-tooltip-form p-bottom-8 e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="tooltip" data-placement="top" title="{{trans('general.upload_file_zip')}}" onclick="$('#fileZip').trigger('click')">
              <i class="bi bi-file-earmark-zip f-size-25"></i>
            </button>
          @endif

            <button type="button" id="setPrice" class="btn btn-upload btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="tooltip" data-placement="top" title="{{trans('general.price_post_ppv')}}">
              <i class="feather icon-tag f-size-25"></i>
            </button>

            <button type="button" id="contentLocked" class="btn btn-upload btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill {{auth()->user()->post_locked == 'yes' ? '' : 'unlock'}}" data-toggle="tooltip" data-placement="top" title="{{trans('users.locked_content')}}">
              <i class="feather icon-{{auth()->user()->post_locked == 'yes' ? '' : 'un'}}lock f-size-25"></i>
            </button>

            @if ($settings->live_streaming_status == 'on')
              <button type="button" data-toggle="tooltip" data-placement="top" title="{{trans('general.stream_live')}}" class="btn btn-upload p-bottom-8 btn-tooltip-form e-none align-bottom btnCreateLive @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill">
                  <i class="bi bi-broadcast f-size-25"></i>
              </button>
            @endif

            <button type="button" id="setTitle" class="btn btn-upload btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill" data-toggle="tooltip" data-placement="top" title="{{trans('general.title_post_block')}}">
              <i class="bi-type f-size-25"></i>
            </button>
            <!--My changes-->
            <!--<button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-upload p-bottom-8 btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill">
                <i class="bi-emoji-smile f-size-25"></i>
            </button>

            <div class="dropdown-menu dropdown-menu-right dropdown-emoji custom-scrollbar" aria-labelledby="dropdownEmoji">
              
            </div>-->
            
            <!--My Changes-->
            <button type="button" id="contentStory" class="btn btn-upload btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill is_story" data-toggle="tooltip" data-placement="top" title="{{ trans('my_lang.promoted_text') }}">
              <i class="bi bi-fire f-size-25"></i>
            </button>
            
             <!--My Changes-->
            <!--<button type="button"  id="contentEmbed" class="btn btn-upload btn-tooltip-form e-none align-bottom @if (auth()->user()->dark_mode == 'off') text-primary @else text-white @endif rounded-pill is_embed" data-toggle="tooltip" data-placement="top" title=" Embed Videos;
Tik Tok, Twitter, Instagram etc;">
              <i class="bi bi-code-slash f-size-25"></i>
            </button>-->

            <div class="d-inline-block mt-3 position-relative w-100-mobile">

              <span class="d-inline-block float-right position-relative rounded-pill w-100-mobile">
                <span class="btn-blocked display-none"></span>
                <!--My Changes     padding: .50rem 1.8rem;-->
                <button type="submit" style="padding: .5rem 1.1rem;" disabled class="btn btn-sm btn-primary rounded-pill float-right e-none" data-empty="{{trans('general.empty_post')}}" data-error="{{trans('general.error')}}" data-msg-error="{{trans('general.error_internet_disconnected')}}" id="btnCreateUpdate">
                  <i></i> {{trans('general.publish')}} <!--My hanges-->
                </button>
                
              </span>
              
              <div id="the-count" class="float-right my-2 mr-2">
                <small id="maximum">{{$settings->update_length}}</small>
              </div>
              <!--My Change-->
              <span data-toggle="modal" data-target="#scheduleModal">
                <a href="javascript:void(0)"  data-toggle="tooltip" data-placement="top" title="{{trans('my_lang.schedule_text')}}" class="mr-2 scheduleModalbtn" style="position: absolute; right: -43px; font-size: 21px;" role="button"><i class="bi-calendar-check"></i></a>
            </span>
            </div>

          </div>
        </div><!-- card footer -->
      </div><!-- card -->
    </form>

    <div class="alert alert-primary display-none card-border-0" role="alert" id="alertPostPending">
      <button type="button" class="close mt-1 btnAlertPostPending" id="btnAlertPostPending"> <!--My Changes added class btnAlertPostPending-->
        <span aria-hidden="true">
          <i class="bi bi-x-lg"></i>
        </span>
      </button>

        <i class="bi bi-info-circle mr-1"></i> {{ trans('general.alert_post_pending_review') }}
        <a href="{{ url('my/posts') }}" class="link-border text-white">{{ trans('general.my_posts') }}</a>
    </div><!-- end announcements -->
    <!--My Changes-->
    <div class="alert alert-primary display-none card-border-0" role="alert" id="alertPostPendingSchedule">
      <button type="button" class="close mt-1 btnAlertPostPending" id="btnAlertPostPending">
        <span aria-hidden="true">
          <i class="bi bi-x-lg"></i>
        </span>
      </button>

        <i class="bi bi-info-circle mr-1"></i> {{ trans('my_lang.alert_post_pending_review_schedule') }}
        <a href="{{ url('my/posts') }}" class="link-border text-white">{{ trans('general.my_posts') }}</a>
        
        
    </div><!-- end announcements -->
    <!-- Start Modal payPerViewForm -->
    <!--My Changes-->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content">
		   		     <div class="modal-header border-bottom-0">
							<h5 class="modal-title">Schedule</h5>
							<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									<i class="bi bi-x-lg"></i>
								</span>
							</button>
						</div>
			<div class="modal-body">
				<div style="overflow:hidden;">
               <div class="form-group">
                  <div class="row">
                     <div class="col-md-12">
                        <div id="datetimepicker12"></div>
                     </div>
                  </div>
               </div>
               </div>
			</div><!-- End modal-body -->
			<footer id="" class="modal-footer"><!----><button type="button" class="btn btn-primary save-schedule">OK</button></footer>
		</div><!-- End modal-content -->
	</div><!-- End Modal-dialog -->
</div><!-- End Modal BuyNow -->
<div class="modal fade" id="EmbedModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal-md modal-dialog-centered" role="document">
		<div class="modal-content">
		   		     <div class="modal-header border-bottom-0">
							<h5 class="modal-title">Enter Embed Code</h5>
							<button type="button" class="close close-inherit" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									<i class="bi bi-x-lg"></i>
								</span>
							</button>
						</div>
			<div class="modal-body">
				
			</div><!-- End modal-body -->
			<footer id="" class="modal-footer"><!----><button type="button" class="btn btn-primary save-embed">OK</button></footer>
		</div><!-- End modal-content -->
	</div><!-- End Modal-dialog -->
</div><!-- End Modal BuyNow -->


@extends('layouts.app')

@section('title') {{auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile')}} -@endsection

@section('css')
  <link rel="stylesheet" href="{{ asset('public/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css">
  <link href="{{ asset('public/plugins/select2/select2.min.css') }}?v={{$settings->version}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<?php $isStagingDesign = false; ?>
@if ($isStagingDesign)
<div class="mb-4">
  <p class="text-uppercase text-muted mb-2 small font-weight-bold">{{ auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile') }}</p>
  <h2 class="mb-1">{{ trans('users.settings_page_desc') }}</h2>
  <p class="text-muted mb-0">Update profile details, cover art, and creator settings from the redesigned account view.</p>
</div>
@endif
<section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-8 py-5">
          <h2 class="mb-0 font-montserrat"><i class="bi bi-pencil mr-2"></i> {{ auth()->user()->verified_id == 'yes' ? trans('general.edit_my_page') : trans('users.edit_profile')}}</h2>
          <p class="lead text-muted mt-0">{{trans('users.settings_page_desc')}}</p>
        </div>
      </div>
      <div class="row">

        @include('includes.cards-settings')

        <div class="col-md-6 col-lg-9 mb-5 mb-lg-0">

          @if (session('status'))
                  <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                			<span aria-hidden="true">×</span>
                			</button>

                    {{ trans('admin.success_update') }}
                  </div>
                @endif

          @include('errors.errors-forms')

          @include('includes.alert-payment-disabled')

          <form method="POST" action="{{ url('settings') }}" id="formEditPage" accept-charset="UTF-8" enctype="multipart/form-data">

            @csrf

            <input type="hidden" id="featured_content" name="featured_content" value="{{auth()->user()->featured_content}}">

          <div class="form-group">
            <label>{{trans('auth.full_name')}} *</label>
            <div class="input-group mb-4">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="far fa-user"></i></span>
            </div>
                <input class="form-control" name="full_name" placeholder="{{trans('auth.full_name')}}" value="{{auth()->user()->name}}"  type="text">
            </div>
          </div><!-- End form-group -->

          <div class="form-group">
            <label>{{trans('auth.username')}} *</label>
            <div class="input-group mb-2">
            <div class="input-group-prepend">
              <span class="input-group-text pr-0">{{Helper::removeHTPP(url('/'))}}/</span>
            </div>
                <input class="form-control" name="username" maxlength="25" placeholder="{{trans('auth.username')}}" value="{{auth()->user()->username}}"  type="text">
            </div>
            <div class="text-muted btn-block">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" name="hide_name" value="yes" @if (auth()->user()->hide_name == 'yes') checked @endif id="customSwitch1">
                <label class="custom-control-label switch" for="customSwitch1">{{ trans('general.hide_name') }}</label>
              </div>
            </div>
          </div><!-- End form-group -->

          <div class="form-group">
                <input class="form-control" placeholder="{{trans('auth.email')}} *" {!! auth()->user()->isSuperAdmin() ? 'name="email"' : 'disabled' !!} value="{{auth()->user()->email}}" type="text">
            </div><!-- End form-group -->

          <div class="row form-group mb-0">
            <div class="col-md-6">
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user-tie"></i></span>
                  </div>
                  <input class="form-control" name="profession" placeholder="{{trans('users.profession_ocupation')}}" value="{{auth()->user()->profession}}" type="text">
                </div>
              </div><!-- ./col-md-6 -->

              <div class="col-md-6">
                <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="fa fa-language"></i></span>
                </div>
                <select name="language" class="form-control custom-select">
                  <option @if (auth()->user()->language == '') selected="selected" @endif value="">({{trans('general.language')}}) {{ __('general.not_specified') }}</option>
                  @foreach (Languages::orderBy('name')->get() as $languages)
                    <option @if (auth()->user()->language == $languages->abbreviation) selected="selected" @endif value="{{$languages->abbreviation}}">{{ $languages->name }}</option>
                  @endforeach
                  </select>
                  </div>
                </div><!-- ./col-md-6 -->
            </div><!-- End Row Form Group -->

              <div class="row form-group mb-0">
                  <div class="col-md-6">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
                        </div>
                        <input class="form-control datepicker" @if (auth()->user()->birthdate_changed == 'yes') disabled  @endif name="birthdate" placeholder="{{trans('general.birthdate')}} *"  value="{{ auth()->user()->birthdate ?? date(Helper::formatDatepicker(), strtotime(auth()->user()->birthdate))}}" autocomplete="off" type="text">
                      </div>
                      <small class="form-text text-muted mb-4">{{ trans('general.valid_formats') }} <strong>{{ now()->subYears(18)->format(Helper::formatDatepicker()) }}</strong> --
                        <strong>({{ trans('general.birthdate_changed_info') }})</strong>
                      </small>
                    </div><!-- ./col-md-6 -->

                    <div class="col-md-6">
                      <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-venus-mars"></i></span>
                      </div>
                      <select name="gender" class="form-control custom-select">
                        <option @if (auth()->user()->gender == '' ) selected="selected" @endif value="">({{trans('general.gender')}}) {{ __('general.not_specified') }}</option>
                        @foreach ($genders as $gender)
                          <option @if (auth()->user()->gender == $gender) selected="selected" @endif value="{{$gender}}">{{ __('general.'.$gender) }}</option>
                        @endforeach
                        </select>
                        </div>
                      </div><!-- ./col-md-6 -->
                    </div><!-- End Row Form Group -->

              <div class="row form-group mb-0">

                @if (auth()->user()->verified_id == 'yes')
                    <div class="col-md-12">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                             <!--My changes style="background: #e9ecef;"><i class="fa fa-link"></i>  &nbsp; http:// -->
                            <span class="input-group-text" style="background: #e9ecef; color: #212121;"><img src="{{url('public/SOCIAL_ICONS/LINKS.svg')}}" class="mr-2"/> www.Website.com</span>
                          </div>
                          <input class="form-control" name="website" placeholder="{{trans('users.website')}}"  value="{{auth()->user()->website}}" type="text">
                        </div>
                      </div><!-- ./col-md-12 -->
                      <!-- My changes -->
                      <div class="col-md-12">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="background: #e9ecef;color: #212121;"><img src="{{url('public/SOCIAL_ICONS/LINKS.svg')}}" class="mr-2"/> www.Website.com</span>
                          </div>
                          <input class="form-control" name="website2" placeholder="{{trans('users.website')}}"  value="{{auth()->user()->website2}}" type="text">
                        </div>
                      </div><!-- ./col-md-12 -->
                      <div class="col-md-12">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text" style="background: #e9ecef; color: #212121;"><img src="{{url('public/SOCIAL_ICONS/WISHLIST.svg')}}" class="mr-2"/> Wishlist Link</span>
                          </div>
                          <input class="form-control" name="website3" placeholder="Wishlist Link"  value="{{auth()->user()->website3}}" type="text">
                        </div>
                      </div><!-- ./col-md-12 -->
                      <!-- My Changes End -->

                      <div class="col-md-12" id="billing">
                        <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="far fa-lightbulb"></i></span>
                        </div>
                        <select name="categories_id[]" multiple class="form-control categoriesMultiple" >
                              @foreach (Categories::where('mode','on')->orderBy('name')->get() as $category)
                                <option @if (in_array($category->id, $categories)) selected="selected" @endif value="{{$category->id}}">{{ Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name }}</option>
                                @endforeach
                              </select>
                              </div>
                        </div><!-- ./col-md-12 -->
                        
                        <!--My Changes-->
                        <div class="col-md-12" id="billing1">
                            <h6 class="text-muted">Post Tags</h6>
                        <div class="flex-grow-1 w-100" style="white-space: nowrap;">
                        <ul class="nav text-uppercase small position-relative edit-delete-tags">
                            
                            @foreach($postCats as $postCat)
                            <li class="nav-item mt-2" style="padding: 0.5rem 1rem;">
                                    {{$postCat->value}}
                                 <span data-id="{{$postCat->id}}" data-val="{{$postCat->value}}" class="remove-post-category ml-2" style="cursor: pointer; font-size: 16px;"><i class="fileuploader-icon-remove"></i></span>
                            </li>
                            @endforeach
                        </ul>
                        </div>
                        </div><!-- ./col-md-12 -->

                    @endif

                <div class="col-lg-12 py-2">
                  <h6 class="text-muted">-- {{trans('general.billing_information')}}</h6>
                </div>

                <div class="col-lg-12">
                    <div class="input-group mb-4">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-building"></i></span>
                      </div>
                      <input class="form-control" name="company" placeholder="{{trans('general.company')}}"  value="{{auth()->user()->company}}" type="text">
                    </div>
                  </div><!-- ./col-md-6 -->

                <div class="col-md-6">
                  <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-globe"></i></span>
                  </div>
                  <select name="countries_id" class="form-control custom-select">
                    <option value="">{{trans('general.select_your_country')}} *</option>
                        @foreach (Countries::orderBy('country_name')->get() as $country)
                          <option @if (auth()->user()->countries_id == $country->id ) selected="selected" @endif value="{{$country->id}}">{{ $country->country_name }}</option>
                          @endforeach
                        </select>
                        </div>
                  </div><!-- ./col-md-6 -->

                  <div class="col-md-6">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fa fa-map-pin"></i></span>
                        </div>
                        <input class="form-control" name="city" placeholder="{{trans('general.city')}}"  value="{{auth()->user()->city}}" type="text">
                      </div>
                    </div><!-- ./col-md-6 -->

                    <div class="col-md-6 @if (auth()->user()->verified_id == 'no') scrollError @endif">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-map-marked-alt"></i></span>
                          </div>
                          <input class="form-control" name="address" placeholder="{{trans('general.address')}}"  value="{{auth()->user()->address}}" type="text">
                        </div>
                      </div><!-- ./col-md-6 -->

                      <div class="col-md-6">
                          <div class="input-group mb-4">
                            <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-map-marker-alt"></i></span>
                            </div>
                            <input class="form-control" name="zip" placeholder="{{trans('general.zip')}}"  value="{{auth()->user()->zip}}" type="text">
                          </div>
                        </div><!-- ./col-md-6 -->

              </div><!-- End Row Form Group -->

              @if (auth()->user()->verified_id == 'yes')
              <div class="row form-group mb-0">
                <div class="col-lg-12 py-2">
                  <h6 class="text-muted">-- {{trans('admin.profiles_social')}}</h6>
                </div>

                  <!--My Changes-->
                  <div class="col-md-6">
                      <div class="input-group mb-4">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/FACEBOOK.svg')}}" /> &nbsp;  https://facebook.com/</span>
                        </div>
                        <input class="form-control" name="facebook" placeholder="username"  value="{{auth()->user()->facebook}}" type="text">
                      </div>
                    </div><!-- ./col-md-6 -->

                    <div class="col-md-6">
                        <div class="input-group mb-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/TWITTER.svg')}}" /> &nbsp; https://twitter.com/</span>
                          </div>
                          <input class="form-control" name="twitter" placeholder="username"  value="{{auth()->user()->twitter}}" type="text">
                        </div>
                      </div><!-- ./col-md-6 -->
                    </div><!-- End Row Form Group -->

                    <div class="row form-group mb-0 my-socials-add">
                        <div class="col-md-6">
                            <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/INSTAGRAM.svg')}}" /> &nbsp; https://instagram.com/</span>
                              </div>
                              <input class="form-control" name="instagram" placeholder="username"  value="{{auth()->user()->instagram}}" type="text">
                            </div>
                          </div><!-- ./col-md-6 -->

                          <div class="col-md-6">
                              <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/YOUTUBE.svg')}}" /> &nbsp; https://youtube.com/</span>
                                </div>
                                <input class="form-control" name="youtube" placeholder="username"  value="{{auth()->user()->youtube}}" type="text">
                              </div>
                            </div><!-- ./col-md-6 -->
                          </div><!-- End Row Form Group -->

                          <div class="row form-group mb-0 my-socials-add">
                              <div class="col-md-6">
                                  <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/PINTEREST.svg')}}" /> &nbsp; https://pinterest.com/</span>
                                    </div>
                                    <input class="form-control" name="pinterest" placeholder="username"  value="{{auth()->user()->pinterest}}" type="text">
                                  </div>
                                </div><!-- ./col-md-6 -->

                                <!--<div class="col-md-6">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/ONLYFANS.svg')}}" /> &nbsp; https://onlyfans.com/</span>
                                      </div>
                                      <input class="form-control" name="github" placeholder="username"  value="{{auth()->user()->github}}" type="text">
                                    </div>
                                  </div>--><!-- ./col-md-6 -->
                            </div><!-- End Row Form Group -->

                            <div class="row form-group mb-0 my-socials-add">
                                <div class="col-md-6">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/SNAPCHAT.svg')}}" /> &nbsp; https://www.snapchat.com/add/</span>
                                      </div>
                                      <input class="form-control" name="snapchat" placeholder="username"  value="{{auth()->user()->snapchat}}" type="text">
                                    </div>
                                  </div><!-- ./col-md-6 -->

                                  <div class="col-md-6">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/TIKTOK.svg')}}" /> &nbsp; https://www.tiktok.com/@</span>
                                        </div>
                                        <input class="form-control" name="tiktok" placeholder="username"  value="{{auth()->user()->tiktok}}" type="text">
                                      </div>
                                    </div><!-- ./col-md-6 -->
                              </div><!-- End Row Form Group -->

                              <div class="row form-group mb-0 my-socials-add">
                                  <div class="col-md-6">
                                      <div class="input-group mb-4">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/TELEGRAM.svg')}}" /> &nbsp; https://t.me/</span>
                                        </div>
                                        <input class="form-control" name="telegram" placeholder="username"  value="{{auth()->user()->telegram}}" type="text">
                                      </div>
                                    </div><!-- ./col-md-6 -->

                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/TWITCH.svg')}}" /> &nbsp; https://www.twitch.tv/</span>
                                          </div>
                                          <input class="form-control" name="twitch" placeholder="username"  value="{{auth()->user()->twitch}}" type="text">
                                        </div>
                                      </div><!-- ./col-md-6 -->
                                </div><!-- End Row Form Group -->

                                <div class="row form-group mb-0 my-socials-add">
                                    <div class="col-md-6">
                                        <div class="input-group mb-4">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/DISCORD.svg')}}" /> &nbsp; https://discord.gg/</span>
                                          </div>
                                          <input class="form-control" name="discord" placeholder="username"  value="{{auth()->user()->discord}}" type="text">
                                        </div>
                                      </div><!-- ./col-md-6 -->

                                      <!--<div class="col-md-6">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/VK.com.svg')}}" /> &nbsp; https://vk.com/</span>
                                            </div>
                                            <input class="form-control" name="vk" placeholder="username"  value="{{auth()->user()->vk}}" type="text">
                                          </div>
                                        </div>--><!-- ./col-md-6 -->
                                  </div><!-- End Row Form Group -->

                                  <div class="row form-group mb-0 my-socials-add">
                                      <div class="col-md-6">
                                          <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/REDDIT.svg')}}" /> &nbsp; https://reddit.com/user/</span>
                                            </div>
                                            <input class="form-control" name="reddit" placeholder="username"  value="{{auth()->user()->reddit}}" type="text">
                                          </div>
                                        </div><!-- ./col-md-6 -->

                                        <div class="col-md-6">
                                            <div class="input-group mb-4">
                                              <div class="input-group-prepend">
                                                <span class="input-group-text"><img src="{{url('public/SOCIAL_ICONS/SPOTIFY.svg')}}" /> &nbsp; https://spotify.com/</span>
                                              </div>
                                              <input class="form-control" name="spotify" placeholder="username"  value="{{auth()->user()->spotify}}" type="text">
                                            </div>
                                          </div><!-- ./col-md-6 -->
                                    </div><!-- End Row Form Group -->
                            <!--My Changes end-->

                          <div class="form-group">
                            <label class="w-100"><i class="fa fa-bullhorn text-muted"></i> {{trans('users.your_story')}} *
                              <span id="the-count" class="float-right d-inline">
                                <span id="current"></span>
                                <span id="maximum">/ {{$settings->story_length}}</span>
                              </span>
                            </label>
                            <textarea name="story" id="story" rows="5" cols="40" class="form-control textareaAutoSize scrollError">{{auth()->user()->story ? auth()->user()->story : old('story') }}</textarea>

                          </div><!-- End Form Group -->
                          <!--My Changes-->
                          <!--My Changes-->
                          <div class="form-group intro-video mb-4">
                            <label for="intro_video">
                              {{ __('general.file') }} <small>(MP4, MOV)</small>
                              
                              <small class="d-block w-100 f-size-20">{{ __('my_lang.add_intro_video') }}</small>
                            </label>
                            @if(auth()->user()->intro_video != Null)
                            <div class="div-intro-video-file">
                                <div class="d-block mb-2 col-md-6 intro-video-file">
                                    <video  data-type="post-" src="{{ Helper::getFile(config('path.introvideo').auth()->user()->intro_video) }}"  disableRemotePlayback  class="video-js @if (request()->ajax()) video-js-ajax @endif  vjs-fluid" id="player_post_{{auth()->user()->id}}">
                                    	<source src="{{ Helper::getFile(config('path.introvideo').auth()->user()->intro_video) }}" type="video/mp4" />
                                    </video>
                                    
                                </div>
                                <span class="col-md-2 text-danger delete-intro-video" data-id="{{auth()->user()->id}}" data-file="{{auth()->user()->intro_video}}" data-toggle="tooltip" title="Delete Intro video"><i class="fa fa-trash"></i></span>
                            </div>
                            @endif
                            <input type="file" name="intro_video" id="intro_video" accept="video/x-mpeg2,video/quicktime,video/mp4,video/x-m4v">
                          </div>
                        @endif

                          <!-- Alert -->
                          <div class="alert alert-danger my-3 display-none" id="errorUdpateEditPage">
                           <ul class="list-unstyled m-0" id="showErrorsUdpatePage"><li></li></ul>
                         </div><!-- Alert -->

                          <button class="btn btn-1 btn-success btn-block" data-msg-success="{{ trans('admin.success_update') }}" id="saveChangesEditPage" type="submit"><i></i> {{trans('general.save_changes')}}</button>
                  </form>
                </div><!-- end col-md-6 -->
              </div>
            </div>
  </section>
@endsection

@section('javascript')
  <script src="{{ asset('public/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
  @if (config('app.locale') != 'en')
    <script src="{{ asset('public/plugins/datepicker/locales/bootstrap-datepicker.'.config('app.locale').'.js') }}"></script>
  @endif
  
  <!--My Changes-->
  <script src="{{ asset('public/js/fileuploader/fileuploader-intro-video.js') }}"></script>
  <script src="{{ asset('public/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/plugins/select2/i18n/'.config('app.locale').'.js') }}" type="text/javascript"></script>

<script type="text/javascript">

@if (auth()->user()->verified_id == 'yes')
$('#current').html($('#story').val().length);
@endif

$('.categoriesMultiple').select2({
  tags: false,
  tokenSeparators: [','],
  maximumSelectionLength: {{$settings->limit_categories}},
  placeholder: '{{trans('admin.categories')}}',
  language: {
    maximumSelected: function() {
      return "{{trans('general.maximum_selected_categories', ['limit' => $settings->limit_categories])}}";
    },
    searching: function() {
      return "{{trans('general.searching')}}";
    },
    noResults: function () {
          return '{{trans('general.no_results')}}';
        }
  }
});

$('.datepicker').datepicker({
    format: '{{ Helper::formatDatepicker(true) }}',
    startDate: '01/01/1920',
    endDate: '{{ now()->subYears(18)->format(Helper::formatDatepicker()) }}',
    language: '{{config('app.locale')}}'
});
</script>
@endsection

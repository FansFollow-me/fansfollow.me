<?php $isStagingDesign = false; ?>
{{-- Staging design marker for the AJAX profile partial. --}}
@if ($user->verified_id == 'yes' && request('media') != 'shop')

  <div class="container py-4 pb-5">
    <div class="row">
      <div class="col-lg-4 mb-3">
        <button type="button" class="btn-arrow-expand btn btn-outline-primary btn-block mb-2 d-lg-none text-word-break font-weight-bold" type="button" data-toggle="collapse" data-target="#navbarUserHome" aria-controls="navbarCollapse" aria-expanded="false">
        My Socials <i class="fas fa-chevron-down ml-2"></i>
      	</button>

        <div class="sticky-top navbar-collapse collapse d-lg-block" id="navbarUserHome">
          <div class="card mb-3 rounded-large shadow-large">
            <div class="card-body">

            <div class="my-socials">
              <h6 class="card-title">My Socials</h6>
              <div class="card-text row">
                @if ($user->facebook != '')
                  <div class="col-6 text-truncate">
                    <a href="https://facebook.com/{{$user->facebook}}" title="https://facebook.com/{{$user->facebook}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/FACEBOOK.svg')}}" class="mr-1"/> {{ $user->facebook }}</a>
                  </div>
                @endif

                @if ($user->twitter != '')
                  <div class="col-6 text-truncate">
                    <a href="https://twitter.com/{{$user->twitter}}" title="https://twitter.com/{{$user->twitter}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/TWITTER.svg')}}" class="mr-1"/> {{ $user->twitter }}</a>
                  </div>
                @endif

                @if ($user->instagram != '')
                  <div class="col-6 text-truncate">
                    <a href="https://instagram.com/{{$user->instagram}}" title="https://instagram.com/{{$user->instagram}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/INSTAGRAM.svg')}}" class="mr-1"/> {{ $user->instagram }}</a>
                  </div>
                @endif

                @if ($user->youtube != '')
                  <div class="col-6 text-truncate">
                    <a href="https://youtube.com/{{$user->youtube}}" title="https://youtube.com/{{$user->youtube}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/YOUTUBE.svg')}}" class="mr-1"/> {{ $user->youtube }}</a>
                  </div>
                @endif

                @if ($user->pinterest != '')
                  <div class="col-6 text-truncate">
                    <a href="https://pinterest.com/{{$user->pinterest}}" title="https://pinterest.com/{{$user->pinterest}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/PINTEREST.svg')}}" class="mr-1"/> {{ $user->pinterest }}</a>
                  </div>
                @endif

                @if ($user->github != '')
                  <div class="col-6 text-truncate">
                    <a href="https://onlyfans.com/{{$user->github}}" title="https://onlyfans.com/{{$user->github}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/ONLYFANS.svg')}}" class="mr-1"/> {{ $user->github }}</a>
                  </div>
                @endif

                @if ($user->snapchat != '')
                  <div class="col-6 text-truncate">
                    <a href="https://www.snapchat.com/add/{{$user->snapchat}}" title="https://www.snapchat.com/add/{{$user->snapchat}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/SNAPCHAT.svg')}}" class="mr-1"/> {{ $user->snapchat }}</a>
                  </div>
                @endif

                @if ($user->tiktok != '')
                  <div class="col-6 text-truncate">
                    <a href="https://www.tiktok.com/{{ '@'.$user->tiktok }}" title="https://www.tiktok.com/{{ '@'.$user->tiktok }}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/TIKTOK.svg')}}" class="mr-1"/> {{ $user->tiktok }}</a>
                  </div>
                @endif
                
                @if ($user->telegram != '')
                  <div class="col-6 text-truncate">
                    <a href="https://t.me/{{$user->telegram}}" title="https://t.me/{{$user->telegram}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/TELEGRAM.svg')}}" class="mr-1"/> {{ $user->telegram }}</a>
                  </div>
                @endif

                @if ($user->twitch != '')
                  <div class="col-6 text-truncate">
                    <a href="https://www.twitch.tv/{{$user->twitch}}" title="https://www.twitch.tv/{{$user->twitch}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/TWITCH.svg')}}" class="mr-1"/> {{ $user->twitch }}</a>
                  </div>
                @endif

                @if ($user->discord != '')
                  <div class="col-6 text-truncate">
                    <a href="https://discord.gg/{{$user->discord}}" title="https://discord.gg/{{$user->discord}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/DISCORD.svg')}}" class="mr-1"/> {{ $user->discord }}</a>
                  </div>
                @endif

                @if ($user->vk != '')
                  <div class="col-6 text-truncate">
                    <a href="https://vk.com/{{$user->vk}}" title="https://vk.com/{{$user->vk}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/VK.com.svg')}}" class="mr-1"/> {{ $user->vk }}</a>
                  </div>
                @endif
                    
                @if ($user->reddit != '')
                  <div class="col-6 text-truncate">
                    <a href="https://reddit.com/user/{{$user->reddit}}" title="https://reddit.com/user/{{$user->reddit}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/REDDIT.svg')}}" class="mr-1"/> {{ $user->reddit }}</a>
                  </div>
                @endif

                @if ($user->spotify != '')
                  <div class="col-6 text-truncate">
                    <a href="https://spotify.com/{{$user->spotify}}" title="https://spotify.com/{{$user->spotify}}" target="_blank" class="text-muted share-btn-user"><img src="{{url('public/SOCIAL_ICONS/SPOTIFY.svg')}}" class="mr-1"/> {{ $user->spotify }}</a>
                  </div>
                @endif
              </div>
            </div>

            <div class="my-links">
              <h6 class="card-title">My links</h6>
              <div class="card-text">
                @if ($user->website != '')
                  <div class="d-block mb-1 text-truncate">
                    <a href="http://{{Helper::removeHTPP($user->website)}}" title="{{$user->website}}" target="_blank" class="text-dark share-btn-user"><img src="{{url('public/SOCIAL_ICONS/LINKS.svg')}}" class="mr-1"/> {{Helper::removeHTPP($user->website)}}</a>
                  </div>
                @endif

                @if ($user->website2 != '')
                  <div class="d-block mb-1 text-truncate">
                    <a href="http://{{Helper::removeHTPP($user->website2)}}" title="{{$user->website2}}" target="_blank" class="text-dark share-btn-user"><img src="{{url('public/SOCIAL_ICONS/LINKS.svg')}}" class="mr-1"/> {{Helper::removeHTPP($user->website2)}}</a>
                  </div>
                @endif

                @if ($user->website3 != '')
                  <div class="d-block mb-1 text-truncate">
                    <a href="http://{{Helper::removeHTPP($user->website3)}}" title="{{$user->website3}}" target="_blank" class="text-dark share-btn-user"><img src="{{url('public/SOCIAL_ICONS/WISHLIST.svg')}}" class="mr-1"/> {{Helper::removeHTPP($user->website3)}}</a>
                  </div>
                @endif
              </div>
            </div>

            <div class="my-catergories">
              <h6 class="card-title">Catergories</h6>
              @if ($user->categories_id != '0' && $user->categories_id != '' && $user->verified_id == 'yes')
                <div class="w-100 mt-2">
                  @foreach (Categories::where('mode','on')->orderBy('name')->get() as $category)
                    @foreach ($categories as $categoryKey)
                      @if ($categoryKey == $category->id)
                        <a href="{{url('category', $category->slug)}}" class="button-white-sm mb-2">
                          #{{ Lang::has('categories.' . $category->slug) ? __('categories.' . $category->slug) : $category->name }}
                        </a>
                      @endif
                    @endforeach
                  @endforeach
                </div>
              @endif
            </div>
          </div>
        </div>

        <div class="d-lg-block d-none">
          @include('includes.footer-tiny')
        </div>
      </div>
    </div>

    <div class="col-lg-8 wrap-post">
    @if ($user->verified_id == 'yes')

<ul class="nav nav-profile nav-profile-tab justify-content-center nav-fill">



    <!-- My Changes Added class class="tab-link" to every link-->

  <li class="nav-link @if (request()->path() == $user->username)active @endif navbar-user-mobile">

    <small class="btn-block sm-btn-size">{{Helper::formatNumber($user->updates()->where('updates.expired', 'no')

        ->where(function ($query) {

            $query->where('updates.schedule_date_time', '<=', \Carbon\Carbon::now());

            $query->orWhereNull('updates.schedule_date_time');

        })->count())}}</small> <!--My Changes ->where('updates.expired', 'no')

        ->where(function ($query) {

            $query->where('updates.schedule_date_time', '<=', Carbon::now());

            $query->orWhereNull('updates.schedule_date_time');

        }) /*My changes*/-->

      <!--My Changes request()->path() == $user->username ? 'javascript:;' : -->

      <a class="tab-link" href="{{url($user->username)}}" title="{{trans('general.posts')}}"><i class="feather icon-file-text"></i> <span class="d-lg-inline-block d-none">{{trans('general.posts')}}</span></a>

    </li>



    

    <li class="nav-link @if (request()->path() == $user->username.'/photos')active @endif navbar-user-mobile">

      <small class="btn-block sm-btn-size">{{Helper::formatNumber($user->media()->where('media.image', '<>', '')->where('updates.expired', 'no')

        ->where(function ($query) {

            $query->where('updates.schedule_date_time', '<=', \Carbon\Carbon::now());

            $query->orWhereNull('updates.schedule_date_time');

        })->count())}} <!--My Changes--></small>

      <!--My Changes request()->path() == $user->username.'/photos' ? 'javascript:;' : -->

      <a class="tab-link" href="{{url($user->username, 'photos')}}" title="{{trans('general.photos')}}"><i class="feather icon-image"></i> <span class="d-lg-inline-block d-none">{{trans('general.photos')}}</span></a>

    </li>



    <li class="nav-link @if (request()->path() == $user->username.'/videos')active @endif navbar-user-mobile">

      <small class="btn-block sm-btn-size">{{Helper::formatNumber($user->media()->where('media.video', '<>', '')->orWhere('media.video_embed', '<>', '')->where('media.user_id', $user->id)->where('updates.expired', 'no')

        ->where(function ($query) {

            $query->where('updates.schedule_date_time', '<=', \Carbon\Carbon::now());

            $query->orWhereNull('updates.schedule_date_time');

        })->count())}} <!--My Changes--></small>

      <!--My Changes request()->path() == $user->username.'/videos' ? 'javascript:;' : -->

      <a class="tab-link" href="{{url($user->username, 'videos')}}" title="{{trans('general.video')}}"><i class="feather icon-video"></i> <span class="d-lg-inline-block d-none">{{trans('general.videos')}}</span></a>

      </li>



    <li class="nav-link @if (request()->path() == $user->username.'/audio')active @endif navbar-user-mobile">

      <small class="btn-block sm-btn-size">{{Helper::formatNumber($user->media()->where('media.music', '<>', '')->where('updates.expired', 'no')

        ->where(function ($query) {

            $query->where('updates.schedule_date_time', '<=', \Carbon\Carbon::now());

            $query->orWhereNull('updates.schedule_date_time');

        })->count())}} <!--My Changes--></small>

      <!--My Changes request()->path() == $user->username.'/audio' ? 'javascript:;' :-->

      <a class="tab-link" href="{{url($user->username, 'audio')}}" title="{{trans('general.audio')}}"><i class="feather icon-mic"></i> <span class="d-lg-inline-block d-none">{{trans('general.audio')}}</span></a>

    </li>



    @if ($settings->shop || ! $settings->shop && $userProducts->count() != 0)

         <li class="nav-link @if (request()->path() == $user->username.'/shop')active @endif navbar-user-mobile">

          <small class="btn-block sm-btn-size">{{Helper::formatNumber($user->products()->whereStatus('1')->count())}} <!--My Changes--></small>

          <!--My Change data-type="shop" , request()->path() == $user->username.'/shop' ? 'javascript:;' :-->

          <a class="tab-link" data-type="shop" href="{{url($user->username, 'shop')}}" title="{{trans('general.shop')}}"><i class="feather icon-shopping-bag"></i> <span class="d-lg-inline-block d-none">{{trans('general.shop')}}</span></a>

        </li>

  @endif



  @if ($user->media()->where('media.file', '<>', '')->count() != 0)

     <li class="nav-link @if (request()->path() == $user->username.'/files')active @endif navbar-user-mobile">

      <small class="btn-block sm-btn-size">{{Helper::formatNumber($user->media()->where('media.file', '<>', '')->where('updates.expired', 'no')

        ->where(function ($query) {

            $query->where('updates.schedule_date_time', '<=', \Carbon\Carbon::now());

            $query->orWhereNull('updates.schedule_date_time');

        })->count())}} <!--My Changes--> </small>

      <!--My changes request()->path() == $user->username.'/files' ? 'javascript:;' : -->

      <a class="tab-link" href="{{url($user->username, 'files')}}" title="{{trans('general.files')}}"><i class="far fa-file-archive"></i> <span class="d-lg-inline-block d-none">{{trans('general.files')}}</span></a>

    </li>

  @endif



</ul>

@endif
        <!--My Changes \Request::route()->getName() == 'profile' && -->

            @if (auth()->check() && auth()->id() == $user->id)

            <div  class="d-block">

                <!-- Tabs navs -->

                <ul class="nav nav-profile justify-content-center nav-fill">

                        <!-- My Changes Added class class="tab-link" to every link-->

                      <li class="nav-link navbar-user-mobile nav-link-schedule">

                        <!--<small class="btn-block sm-btn-size">{{$user->updates()->count()}}</small>-->

                          <!--My Changes request()->path() == $user->username ? 'javascript:;' : -->

                          <a class="tab-link-schedule" href="{{url(request()->path())}}" data-type="schedule" title="Scheduled"><i class="bi-calendar-check"></i> <span class="d-lg-inline-block">Scheduled</span></a>

                        </li>

            

                        <li class="nav-link navbar-user-mobile nav-link-schedule">

                          <!--<small class="btn-block sm-btn-size">{{$user->media()->where('media.image', '<>', '')->count()}}</small>-->

                          <!--My Changes request()->path() == $user->username.'/photos' ? 'javascript:;' : -->

                          <a class="tab-link-schedule" href="{{url(request()->path())}}" data-type="expire" title="Posted"><i class="text-danger bi-calendar-check"></i> <span class="d-lg-inline-block">Posted</span></a>

                        </li>

            

                    </ul>

            <!-- Tabs navs -->

            </div>

            @endif

         <!--My Changes-->

        <div class="schedule-post-div">

        @if (auth()->check()

            && auth()->id() == $user->id

            && ! $userPlanMonthlyActive

            && auth()->user()->free_subscription == 'no'

            )

        <div class="alert alert-danger mb-3">

                 <ul class="list-unstyled m-0">

                     <!--My changes-->

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

        

        <!--My Changes-->

           <div class="post-categories-tags">

            @if(count($postCats) != 0)

               @include('includes.post-categories-tag')

            @endif

        </div>

        <!--My Changes end-->

        

        <!--My changes && $findPostPinned->count() == 0-->

        @if ($updates->count() == 0)

            <div class="grid-updates"></div>



            <div class="my-5 text-center no-updates">

              <span class="btn-block mb-3">

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

        </div>

      </div>

      </div><!-- row -->

    </div><!-- container -->

  @endif



  @if ($user->verified_id == 'yes' && request('media') == 'shop')

    <div class="container py-5">



      @if ($userProducts->count() != 0)

      <div class="@if (auth()->check() && auth()->user()->verified_id == 'yes' && $user->id == auth()->id())d-flex justify-content-between align-items-center @else d-block @endif mb-3 text-right">



        @if (auth()->check() && auth()->user()->verified_id == 'yes' && $user->id == auth()->id())

        <div>

          @if ($settings->digital_product_sale && ! $settings->custom_content)

            <a class="btn btn-primary" href="{{ url('add/product') }}">

              <i class="bi-plus"></i> <span class="d-lg-inline-block d-none">{{ __('general.add_product') }}</span>

            </a>



          @elseif (! $settings->digital_product_sale && $settings->custom_content)

            <a class="btn btn-primary" href="{{ url('add/custom/content') }}">

              <i class="bi-plus"></i> <span class="d-lg-inline-block d-none">{{ __('general.add_custom_content') }}</span>

            </a>



          @else

            <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addItemForm">

              <i class="bi-plus"></i> <span class="d-lg-inline-block d-none">{{ __('general.add_new') }}</span>

            </a>

          @endif

        </div>

      @endif



        <div>

            <!--My Chnages data-id="ajax-filter"-->

          <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto" data-id="ajax-filter" id="filter">

              <option @if (! request()->get('sort')) selected @endif value="{{url($user->username).'/shop'}}">{{trans('general.latest')}}</option>

              <option @if (request()->get('sort') == 'oldest') selected @endif value="{{url($user->username).'/shop?sort=oldest'}}">{{trans('general.oldest')}}</option>

              <option @if (request()->get('sort') == 'priceMin') selected @endif value="{{url($user->username).'/shop?sort=priceMin'}}">{{trans('general.lowest_price')}}</option>

              <option @if (request()->get('sort') == 'priceMax') selected @endif value="{{url($user->username).'/shop?sort=priceMax'}}">{{trans('general.highest_price')}}</option>

              @if ($settings->physical_products)

              <option @if (request()->get('sort') == 'physical') selected @endif value="{{url($user->username).'/shop?sort=physical'}}">{{trans('general.physical_products')}}</option>

              @endif

              <option @if (request()->get('sort') == 'digital') selected @endif value="{{url($user->username).'/shop?sort=digital'}}">{{trans('general.digital_products')}}</option>

              <option @if (request()->get('sort') == 'custom') selected @endif value="{{url($user->username).'/shop?sort=custom'}}">{{trans('general.custom_content')}}</option>

                <!--My Changes -->

                 <option @if (request()->get('sort') == 'video') selected @endif value="{{url($user->username).'/shop?sort=video'}}">{{trans('my_lang.video_calls')}}</option>

                 <option @if (request()->get('sort') == 'snapchat') selected @endif value="{{url($user->username).'/shop?sort=snapchat'}}">{{trans('my_lang.snapchat')}}</option>

            

            </select>



            @if ($shopCategories->count())

              <select class="ml-2 custom-select mb-2 mb-lg-0 w-auto filter">

                  <option @if (! request()->get('cat')) selected @endif value="{{url($user->username, 'shop')}}">{{trans('general.all_categories')}}</option>



                    @foreach ($shopCategories as $category)

                      <option @if (request()->get('cat') == $category->slug) selected @endif value="{{url($user->username, 'shop')}}{{ '?cat='.$category->slug }}">

                        {{ Lang::has('shop-categories.' . $category->slug) ? __('shop-categories.' . $category->slug) : $category->name }}

                      </option>

                    @endforeach



                </select>

            @endif

        </div>

      </div>

    @endif



      <div class="row">



        @if ($userProducts->count() != 0)



          @foreach ($userProducts as $product)

          <div class="col-md-4 mb-4">

            @include('shop.listing-products')

          </div><!-- end col-md-4 -->

          @endforeach



          @if ($userProducts->hasPages())

            <div class="w-100 d-block">

              {{ $userProducts->onEachSide(0)->appends(['sort' => request('sort')])->links() }}

            </div>

          @endif



        @else



          <div class="my-5 text-center no-updates w-100">

            <span class="btn-block mb-3">

              <i class="feather icon-shopping-bag ico-no-result"></i>

            </span>

          <h4 class="font-weight-light">{{trans('general.no_results_found')}}</h4>



        @if (auth()->check() && auth()->user()->verified_id == 'yes' && auth()->id() == $user->id)

          <div class="mt-3">

            @if ($settings->digital_product_sale && ! $settings->custom_content && ! $settings->physical_products)

              <a class="btn btn-primary" href="{{ url('add/product') }}">

                <i class="bi-plus"></i> {{ __('general.add_product') }}

              </a>



            @elseif (! $settings->digital_product_sale && $settings->custom_content && ! $settings->physical_products)

              <a class="btn btn-primary" href="{{ url('add/custom/content') }}">

                <i class="bi-plus"></i> {{ __('general.add_custom_content') }}

              </a>



            @elseif (! $settings->digital_product_sale && $settings->physical_products && ! $settings->custom_content)

              <a class="btn btn-primary" href="{{ url('add/physical/product') }}">

                <i class="bi-plus"></i> {{ __('general.add_physical_product') }}

              </a>



            @else

              <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#addItemForm">

                <i class="bi-plus"></i> {{ __('general.add_new') }}

              </a>

            @endif

          </div>

        @endif



          </div>



        @endif

      </div>

    </div><!-- container -->



    @includeWhen(auth()->check() && auth()->user()->verified_id == 'yes', 'shop.modal-add-item')



  @endif
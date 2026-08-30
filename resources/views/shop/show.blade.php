@extends('layouts.app')

@section('title') {{ $product->name }} -@endsection

  @section('description_custom'){{$product->description ? $product->description : trans('seo.description')}}@endsection
  @section('keywords_custom'){{$product->tags ? $product->tags.',' : null}}@endsection

    @section('css')
    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="800"/>
    <meta property="og:image:height" content="600"/>

    <!-- Current locale and alternate locales -->
    <meta property="og:locale" content="en_US" />
    <meta property="og:locale:alternate" content="es_ES" />

    <!-- Og Meta Tags -->
    <link rel="canonical" href="{{url()->current()}}"/>
    <meta property="og:site_name" content="{{ $product->name }} - {{$settings->title}}"/>
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{Helper::getFile(config('path.shop').$product->previews[0]->name)}}"/>

    <meta property="og:title" content="{{ $product->name }} - {{$settings->title}}"/>
    <meta property="og:description" content="{{strip_tags($product->description)}}"/>
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:image" content="{{Helper::getFile(config('path.shop').$product->previews[0]->name)}}" />
    <meta name="twitter:title" content="{{ $product->name }}" />
    <meta name="twitter:description" content="{{strip_tags($product->description)}}"/>
    @endsection

@section('content')
<!--My Chnages-->
<style>
    .plyr--video {
        height: 100% !important;
    }
    .plyr__poster{
       background-color: var(--plyr-video-background,rgba(120, 126, 150, 35));
    }
</style>
@php
        if($product->extension == 'mp4'){
        $result = shell_exec('ffmpeg -i ' . escapeshellcmd(Helper::getFile(config('path.shop').$product->file)) . ' 2>&1');
        
        preg_match('/(?<=Duration: )(\d{2}:\d{2}:\d{2})\.\d{2}/', $result, $match);
        
        $duration = explode(':', $match[1]) + array(00,00,00);
        }
        
@endphp
<section class="section section-sm">
    <div class="container py-5">
      <div class="row">

        <div class="col-md-7 mb-lg-0 mb-4">

          <div class="text-center mb-4 position-relative bg-light">

             @if ($previews > 1)
            <!--My Chnages-->
            @if($product->previews[0]->type == 'video')
              <a href="@if ($previews > 1) {{ Helper::getFile(config('path.shop').$product->previews[0]->name) }} @else javascript:void(0); @endif" class="@if ($previews > 1) glightbox @endif w-100" data-gallery="gallery{{$product->id}}">
              <span class="count-previews"  style="z-index: 1000; background: #00aff0;">
                @if($previews_video > 0)
                {{ $previews_video }} <i class="feather icon-video"></i>
                @endif
                 @if($previews_image > 0)
                {{ $previews_image }} <i class="ml-1 bi-image"></i>
                @endif
              </span>
              </a>
              @else
              <a href="javascript:void(0);" class="poopup-link glightbox2 w-100" >
              <span class="count-previews" style="z-index: 1000; background: #00aff0;">
                  <!--My Changes-->
                  @if($previews_video > 0)
                {{ $previews_video }} <i class="feather icon-video"></i>
                @endif
                 @if($previews_image > 0)
                {{ $previews_image }} <i class="ml-1 bi-image"></i>
                @endif
              </span>
              </a>
              @endif
            @endif
            <!--My Changes -->
            @if ($product->previews[0]->type == 'image')
            	<a href="{{ Helper::getFile(config('path.shop').$product->previews[0]->name) }}" class="glightbox w-100" data-gallery="gallery{{$product->id}}">
              <img data-id="{{$product->previews[0]->id}}" data-type="shop" class="img-fluid btn-views" src="{{ Helper::getFile(config('path.shop').$product->previews[0]->name) }}" style="max-height:600px; cursor: zoom-in;">
            </a>
             @elseif($product->previews[0]->type == 'video')
             @if ($product->previews[0]->status == 'pending')
    			<h6 class="text-muted w-100 mb-4">
    				<i class="bi bi-eye-fill mr-1"></i> <em>{{ trans('my_lang.video_pending_review') }}</em>
    			</h6>
    		@endif
            	<a href="javascript:void(0);" class=" w-100">
            		<video data-id="{{$product->previews[0]->id}}" data-type="shop" src="{{Helper::getFile(config('path.shop').$product->previews[0]->name)}}" image="@if($product->previews[0]->thumimge != NULL){{Helper::getFile(config('path.shop').$product->previews[0]->thumimge)}}@endif" id="player_alone" class="w-100 video-js vjs-fluid" controls preload="auto"   @if ($product->previews[0]->video_poster) poster="{{ Helper::getFile(config('path.shop').$product->previews[0]->video_poster) }}" @endif playsinline>
            		<source src="{{Helper::getFile(config('path.shop').$product->previews[0]->name)}}" res="HD" label="HD" type="video/mp4" />
            	</video>
            	
            </a>
            
            @endif
            <!--My Changes end-->

            @if ($previews > 1)
              @for ($i=1; $i < $previews; $i++)
                <a href="{{ Helper::getFile(config('path.shop').$product->previews[$i]->name) }}" class="glightbox w-100 display-none" data-gallery="gallery{{$product->id}}">
                  <!--My Changes -->
                @if ($product->previews[$i]->type == 'image')
                  <img class="img-fluid btn-views" src="{{ Helper::getFile(config('path.shop').$product->previews[$i]->name) }}">
                  @elseif($product->previews[$i]->type == 'video')
                  <video data-id="{{$product->previews[$i]->id}}" data-type="shop"  src="{{Helper::getFile(config('path.shop').$product->previews[$i]->name)}}" image="@if($product->previews[$i]->thumimge != NULL){{Helper::getFile(config('path.shop').$product->previews[$i]->thumimge)}}@endif" height="360" id="player_1" class="w-100 video-js vjs-fluid" controls preload="auto" @if ($product->previews[$i]->video_poster) poster="{{ Helper::getFile(config('path.shop').$product->previews[$i]->video_poster) }}" @endif>
            		<source src="{{Helper::getFile(config('path.shop').$product->previews[$i]->name)}}" type="video/mp4" />
            	</video>
            	@endif
            	<!--My Changes end-->
                </a>
              @endfor
            @endif
          </div>

          <h4 class="mb-3">{{ __('general.description') }}</h4>
          <p class="text-break">
            {!! Helper::checkText($product->description)  !!}
          </p>

        </div><!-- end col-md-7 -->


    <div class="col-md-5">
    <!--My Changes card-updates-->
      <div class="card card-updates rounded-large shadow-large card-border-0">

        <div class="card-body">

            <!--My Chnages-->
          <h3 class="mb-2 font-weight-bold text-break title-shop text-uppercase">{{ $product->name }}</h3>

      <div class="card bg-transparent mb-4 border-0">
    	  <div class="card-body p-0">
    	    <div class="d-flex">
    			  <!--My changes -->
    			  <div class="d-flex my-2 align-items-center @if (Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes' || auth()->guest() && Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes') user-online-profile-shop-show overflow-visible @elseif (auth()->check() && auth()->id() != $product->user()->id && !Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes' || auth()->guest() && !Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes') user-offline-profile-shop-show overflow-visible @endif">
              <a href="{{ url($product->user()->username) }}">
    			      <img class="rounded-circle mr-2" src="{{ Helper::getFile(config('path.avatar').$product->user()->avatar) }}" width="60" height="60">
              </a>

    						<div class="d-block">
    						<a href="{{ url($product->user()->username) }}">
                  <strong>{{ $product->user()->username }}</strong>

                  <small class="verified mr-1">
        						<i class="bi bi-patch-check-fill"></i>
        					</small>
        					<!--My changes -->
        					@if(auth()->id() != $product->user()->id)
                          <a href="{{url('messages/'.$product->user()->id, $product->user()->username)}}" title="{{trans('general.message')}}">
                            <i class="feather icon-send mr-1 mr-lg-0"></i>
                          </a>
                          @endif
                          <!--My changes end -->
                </a>

    							<div class="d-block">
    								<small class="media-heading text-muted btn-block margin-zero">{{ Helper::formatDate($product->created_at) }}</small>
    							</div>
    						</div>
    			  </div>
    			</div>
    	  </div>
    	</div><!-- end card -->

      <h3>
        {{ Helper::amountFormatDecimal($product->price) }} <small>{{ $settings->currency_code }}</small>
      </h3>

      @if (auth()->check()
          && auth()->id() != $product->user()->id
          && ! $verifyPurchaseUser
          || auth()->check()
          && auth()->id() != $product->user()->id
          && $verifyPurchaseUser
          && $product->type == 'custom'
          || auth()->check()
          && auth()->id() != $product->user()->id
          && $verifyPurchaseUser
          && $product->type == 'physical'
          || auth()->guest()
          )
      <button class="btn btn-1 btn-primary btn-block mt-4" @if ($product->quantity == 0 && $product->type == 'physical') disabled @endif type="button" data-toggle="modal" @auth data-target="#buyNowForm" @else data-target="#loginFormModal" @endauth>
        {{ $product->quantity == 0 && $product->type == 'physical' ? __('general.sold_out') : __('general.buy_now') }}
      </button>

    @elseif (auth()->check() && auth()->id() != $product->user()->id && $verifyPurchaseUser && $product->type == 'digital')
      <a class="btn btn-1 btn-primary btn-block mt-4" href="{{ url('product/download', $product->id) }}">
        {{ __('general.download') }}
      </a>

    @elseif (auth()->check() && auth()->id() == $product->user()->id)
      <a class="btn btn-1 btn-primary btn-block mt-4" href="#" data-toggle="modal" data-target="#editForm">
        <i class="bi-pencil mr-1"></i> {{ __('admin.edit') }}
      </a>

      <form method="post" action="{{ url('delete/product', $product->id) }}">
        @csrf
        <button class="btn btn-1 btn-outline-danger btn-block mt-2 actionDeleteItem" type="button">
          <i class="bi-trash mr-1"></i> {{ __('admin.delete') }}
        </button>
      </form>

      @include('shop.modal-edit')

    @endif

      <div class="w-100 d-block mt-3">
        <i class="bi-cart2 mr-2"></i> {{ __('general.purchases') }} ({{ $product->purchases()->count() }})
      </div>

      @if ($product->type == 'digital')
        <div class="w-100 d-block mt-3">
          <i class="bi-cloud-download mr-2"></i> {{ __('general.digital_download') }}
        </div>

        <div class="w-100 d-block mt-3">
          <i class="bi-box-seam mr-2"></i> {{ __('general.file') }} <span class="text-uppercase">{{ $product->extension }}</span> - <small>{{ $product->size }}</small>
        </div>
        
        <!--My Changes-->
        @if($product->extension == 'mp4')
        <div class="w-100 d-block mt-3">
          <i class="bi bi-camera-reels mr-2"></i> {{ __('my_lang.duration') }} - {{$duration[0] != '00' ? (int)$duration[0]." Hours :".(int)$duration[1]." Minutes :".(int)$duration[2] ." Seconds" : (int)$duration[1]." Minutes :".(int)$duration[2] ." Seconds"}}
        </div>
        @endif
        <!--My Changes-->
      @elseif ($product->type == 'video')
        <div class="w-100 d-block mt-4">
          <i class="fa fa-fire-alt mr-2"></i> {{ __('my_lang.availability') }} ({{$product->delivery_time}})
        </div>
        @elseif ($product->type == 'snapchat')
        <div class="w-100 d-block mt-4">
          <i class="fa fa-fire-alt mr-2"></i> {{ __('my_lang.snapchat') }} ({{$product->delivery_time}})
        </div>
        <!--@elseif ($product->type == 'garments')
        <div class="w-100 d-block mt-4">
          <i class="fa fa-fire-alt mr-2"></i> {{ __('my_lang.garments') }} ({{$product->delivery_time}})
        </div>-->
        <!--My Changes end-->
      @elseif ($product->type == 'custom')
        <div class="w-100 d-block mt-4">
          <i class="fa fa-fire-alt mr-2"></i> {{ __('general.delivery_time') }} ({{$product->delivery_time}} {{ trans_choice('general.days', $product->delivery_time) }})
        </div>

      @else

        @if ($product->quantity <> 0)
          <div class="w-100 d-block mt-4">
            <i class="bi-boxes mr-2"></i> {{ __('general.quantity') }} <span class="badge badge-pill badge-success">{{ $product->quantity }}</span>
          </div>
        @else
          <div class="w-100 d-block mt-4 text-danger">
            <i class="bi-boxes mr-2"></i> <em>{{ __('general.sold_out') }}</em>
          </div>
        @endif

        @if ($product->shipping_fee <> 0.00)
          <div class="w-100 d-block mt-4">
            <i class="bi-truck mr-2"></i> {{ __('general.shipping_fee') }} - {{ Helper::amountFormatDecimal($product->shipping_fee) }} <small>{{ $settings->currency_code }}</small>

            @if ($product->country_free_shipping)
              <small><em>({{ __('general.free_shipping') }} {{ $product->country()->country_name }})</em></small>
            @endif
          </div>

        @else
          <div class="w-100 d-block mt-4">
            <i class="bi-truck mr-2"></i> {{ __('general.free_shipping') }}
          </div>
        @endif

        <div class="w-100 d-block mt-4">
          <i class="bi-box-seam mr-2"></i> {{ $product->box_contents }}
        </div>

      @endif

      @if ($product->category)
        <div class="w-100 d-block mt-4">
          <i class="bi-tag mr-2"></i>
          <a href="{{url("shop?cat=")}}{{$product->categoryId->slug}}" >
            {{ Lang::has('shop-categories.' . $product->categoryId->slug) ? __('shop-categories.' . $product->categoryId->slug) : $product->categoryId->name }}
          </a>
        </div>
      @endif

      <div class="w-100 d-block mt-4">
        @for ($i = 0; $i < count($tags); ++$i)
          <a href="{{ url('shop?tags=').trim($tags[$i]) }}">#{{ trim($tags[$i]) }}</a>
        @endfor
      </div>
<!--My changes added card-footer, bg-white-->
      <div class="w-100 d-block mt-4 card-footer bg-white">
         <!--My Changes-->
          <h5>
    

        <!--<a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current().Helper::referralLink()}}" title="Facebook" target="_blank" class="d-inline-block mr-2 h5">
          <i class="fab fa-facebook facebook-btn"></i>
        </a>

        <a href="https://twitter.com/intent/tweet?url={{url()->current().Helper::referralLink()}}&text={{ $product->name }}" title="Twitter" target="_blank" class="d-inline-block mr-2 h5">
          <i class="fab fa-twitter twitter-btn"></i>
        </a>

        <a href="whatsapp://send?text={{url()->current().Helper::referralLink()}}" data-action="share/whatsapp/share" class="d-inline-block h5" title="WhatsApp">
          <i class="fab fa-whatsapp btn-whatsapp"></i>
        </a>-->
        
        @php
        if (auth()->check()) {
				$checkUserSubscription = auth()->user()->checkSubscription($product->user());
				//$checkPayPerView = auth()->user()->payPerView()->where('updates_id', $product->id)->first();
			}
            $totalLikes = number_format($product->likes()->count());
		    $totalComments =  number_format($product->comments()->count());
		    
			$likeActive = auth()->check() && auth()->user()->likesShop()->where('updates_id', $product->id)->where('status','1')->where('is_shop', 'yes')->first();
			$bookmarkActive = auth()->check() && auth()->user()->bookmarks()->where('updates_id', $product->id)->first();

			if(auth()->check() && auth()->user()->id == $product->user()->id

			|| auth()->check() 
			&& $checkUserSubscription
			&& $product->price == 0.00

			|| auth()->check() 
			&& $checkUserSubscription
			&& $product->price != 0.00
			

			|| auth()->check() 
			&& $product->price != 0.00
			&& ! $checkUserSubscription
			

			|| auth()->check() && auth()->user()->role == 'admin' && auth()->user()->permission == 'all'
			|| auth()->check() ) {
				$buttonLike = 'likeButton';
				$buttonBookmark = 'btnBookmark';
			} else {
				$buttonLike = null;
				$buttonBookmark = null;
			}
			@endphp

			<a href="javascript:void(0);" @guest data-toggle="modal" data-target="#loginFormModal" @endguest class="pulse-btn btnLike @if ($likeActive)active @endif {{$buttonLike}} text-muted mr-2" @auth data-id="{{$product->id}}"  data-shop="yes" @endauth>
				<i class="@if($likeActive)fas @else far @endif fa-heart"></i>
					<small class="font-weight-bold countLikes">{{ $totalLikes == 0 ? null : Helper::formatNumber($totalLikes) }} <!--My Changes--></small>
			</a>

			<span class="text-muted mr-2 @auth @if (! isset($inPostDetail) && $buttonLike) pulse-btn toggleComments @endif @endauth">
				<i class="far fa-comment"></i>
				<small class="font-weight-bold totalComments">{{ $totalComments == 0 ? null : Helper::formatNumber($totalComments) }}  <!--My Changes--></small>
			</span>
			 <a href="javascript:void(0);" title="{{trans('general.share')}}" data-toggle="modal" data-target="#sharePost{{$product->id}}" class="pulse-btn text-muted text-decoration-none mr-2">
				<i class="feather icon-share"></i>
			</a>
			    <!-- Share modal -->
			<div class="modal fade" id="sharePost{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
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
									<a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current().Helper::referralLink()}}" title="Facebook" target="_blank" class="social-share text-muted d-block text-center h6">
										<i class="fab fa-facebook-square facebook-btn"></i>
										<span class="btn-block mt-3">Facebook</span>
									</a>
								</div>
								<div class="col-md-3 col-6 mb-3">
									<a href="https://twitter.com/intent/tweet?url={{url()->current().Helper::referralLink()}}&text={{ e( $product->user()->hide_name == 'yes' ? $product->user()->username : $product->user()->name ) }}" data-url="{{url()->current()}}" class="social-share text-muted d-block text-center h6" target="_blank" title="Twitter">
										<i class="fab fa-twitter twitter-btn"></i> <span class="btn-block mt-3">Twitter</span>
									</a>
								</div>
								<div class="col-md-3 col-6 mb-3">
									<a href="whatsapp://send?text={{url()->current().Helper::referralLink()}}" data-action="share/whatsapp/share" class="social-share text-muted d-block text-center h6" title="WhatsApp">
										<i class="fab fa-whatsapp btn-whatsapp"></i> <span class="btn-block mt-3">WhatsApp</span>
									</a>
								</div>

								<div class="col-md-3 col-6 mb-3">
									<a href="sms://?body={{ trans('general.check_this') }} {{url()->current().Helper::referralLink()}}" class="social-share text-muted d-block text-center h6" title="{{ trans('general.sms') }}">
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
            		@if (auth()->user()->id != $product->user()->id
            					&& $checkUserSubscription && $product->price == 0.00
            					&& $settings->disable_tips == 'off'
            
            					|| auth()->user()->id != $product->user()->id
            					&& $checkUserSubscription
            					&& $product->price != 0.00
            					&& $settings->disable_tips == 'off'
            
            					|| auth()->user()->id != $product->user()->id
            					&& $product->price != 0.00
            					&& ! $checkUserSubscription
            					&& $settings->disable_tips == 'off'
            
            					|| auth()->user()->id != $product->user()->id
            					&& $settings->disable_tips == 'off'
            					)
            			<a href="javascript:void(0);" data-toggle="modal" title="{{trans('general.tip')}}" data-target="#tipForm" class="pulse-btn text-muted text-decoration-none" @auth data-id="{{$product->id}}" data-cover="{{Helper::getFile(config('path.cover').$product->user()->cover)}}" data-avatar="{{Helper::getFile(config('path.avatar').$product->user()->avatar)}}" data-name="{{$product->user()->hide_name == 'yes' ? $product->user()->username : $product->user()->name}}" data-userid="{{$product->user()->id}}" @endauth>
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
              <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
              <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
              <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
            </svg>
            
            				<h6 class="d-inline font-weight-lighter">@lang('general.tip')</h6>
            			</a>
            		@endif
            	@endauth
          <small class="font-weight-bold"> {{Helper::formatNumber($product->previews[0]->views()->count())}} views</small>
			</h5>
			@auth

@if (! auth()->user()->checkRestriction($product->user()->id))
<div class="container-comments @if ( ! isset($inPostDetail)) display-none @endif">

<div class="container-media {{$product->comments()->count()}}">
@if($product->comments()->count() != 0)

	@php
	  $comments = $product->comments()->take($settings->number_comments_show)->orderBy('id', 'DESC')->get();
	  $data = [];

	  if ($comments->count()) {
	      $data['reverse'] = collect($comments->values())->reverse();
	  } else {
	      $data['reverse'] = $comments;
	  }

	  $dataComments = $data['reverse'];
		$counter = ($product->comments()->count() - $settings->number_comments_show);
	@endphp

	@if ($verifyPurchaseUser

		|| auth()->check() 
		&& $product->price != 0.00
		&& ! $verifyPurchaseUser

		|| auth()->user()->role == 'admin'
		&& auth()->user()->permission == 'all')
		
        @php $response = $product;  @endphp
		@include('includes.comments')

@endif

@endif
	</div><!-- container-media -->

	@if ($verifyPurchaseUser

		|| auth()->check() 
		&& $product->price != 0.00
		&& ! $verifyPurchaseUser

		|| auth()->user()->role == 'admin'
		&& auth()->user()->permission == 'all')
		

		<hr />

		<div class="alert alert-danger alert-small dangerAlertComments display-none">
			<ul class="list-unstyled m-0 showErrorsComments"></ul>
		</div><!-- Alert -->

		<div class="media position-relative">
			<div class="blocked display-none"></div>
			<span href="#" class="float-left">
				<img src="{{ Helper::getFile(config('path.avatar').auth()->user()->avatar) }}" class="rounded-circle mr-1 avatarUser" width="40">
			</span>
			<div class="media-body">
				<form action="{{url('comment/store')}}" method="post" class="comments-form">
					@csrf
					<input type="hidden" name="update_id" value="{{$product->id}}" />
					<input type="hidden" name="is_shop" value="yes" />

					<div>
					<span class="triggerEmoji" data-toggle="dropdown">
						<i class="bi-emoji-smile"></i>
					</span>

					<div class="dropdown-menu dropdown-menu-right dropdown-emoji" aria-labelledby="dropdownMenuButton">
				    @include('includes.emojis')
				  </div>
				</div>

				<input type="text" name="comment" class="form-control comments emojiArea border-0" autocomplete="off" placeholder="{{trans('general.write_comment')}}"></div>
				</form>
			</div>
			@endif

			</div><!-- container-comments -->
		@endif
		@endauth
        <!--end My Changes-->
      </div><!-- Share -->

      @if (auth()->check() && auth()->id() != $product->user()->id)
        <div class="w-100 d-block mt-4">
          <button type="button" class="btn e-none btn-link text-danger p-0" data-toggle="modal" data-target="#reportItem">
                <small><i class="bi-flag mr-1"></i> {{ __('general.report_item') }}</small>
              </button>
        </div>
      @endif

      </div><!-- card-body -->
    </div><!-- card -->


    </div><!-- end col-5 -->

      </div><!-- row -->
    </div><!-- container -->

    @auth
      @include('shop.modal-buy')
    @endauth

    @if (auth()->check() && auth()->id() != $product->user()->id)
    <div class="modal fade modalReport" id="reportItem" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-danger modal-sm">
        <div class="modal-content">
          <div class="modal-header">
            <h6 class="modal-title font-weight-light" id="modal-title-default">
              <i class="fas fa-flag mr-1"></i> {{trans('general.report_item')}}
            </h6>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <i class="fa fa-times"></i>
            </button>
          </div>

        <!-- form start -->
        <form method="POST" action="{{url('report/item', $product->id)}}" enctype="multipart/form-data">
        <div class="modal-body">
          @csrf
          <!-- Start Form Group -->
          <div class="form-group">
            <label>{{trans('admin.please_reason')}}</label>
              <select name="reason" class="form-control custom-select">
                @if ($verifyPurchaseUser && $product->type != 'digital')
                <option value="item_not_received">{{trans('general.item_not_received')}}</option>
              @endif
                <option value="spoofing">{{trans('admin.spoofing')}}</option>
                  <option value="copyright">{{trans('admin.copyright')}}</option>
                  <option value="privacy_issue">{{trans('admin.privacy_issue')}}</option>
                  <option value="violent_sexual">{{trans('admin.violent_sexual_content')}}</option>
                  <option value="fraud">{{trans('general.fraud')}}</option>
                </select>
                </div><!-- /.form-group-->
            </div><!-- Modal body -->

            <div class="modal-footer">
              <button type="button" class="btn border text-white" data-dismiss="modal">{{trans('admin.cancel')}}</button>
              <button type="submit" class="btn btn-xs btn-white sendReport ml-auto"><i></i> {{trans('general.report_item')}}</button>
            </div>
            </form>
          </div><!-- Modal content -->
        </div><!-- Modal dialog -->
      </div><!-- Modal -->
    @endif

@if ($totalProducts > 1)
<div class="container pt-5 border-top">
		 <div class="row">

       <div class="col-md-12 mb-4">

         <div class="d-flex justify-content-between align-items-center">
    		 <h4 class="font-weight-light">{{ __('general.other_items_of') }} {{ '@'.$product->user()->username }}</h4>

         @if ($totalProducts > 4)
         <h5 class="font-weight-light">
           <a href="{{ url($product->user()->username, 'shop') }}">
             {{ __('general.view_all') }}
           </a>
         </h5>
       @endif
      </div>

    	 </div>

       @foreach ($userProducts->where('id', '<>', $product->id)->take(3)->inRandomOrder()->get() as $product)
       <div class="col-md-4 mb-4">
         @include('shop.listing-products')
       </div><!-- end col-md-4 -->
       @endforeach

     </div><!-- row -->
	 </div><!-- container -->
@endif
</section>

@endsection

@section('javascript')
  @auth
    <script src="{{ asset('public/js/shop.js') }}"></script>
  @endauth
@endsection

<!--My changes -->
<style>
.modal-open .modal, .sweet-overlay{
    backdrop-filter: blur(0px) !important;
}

</style>

<style>
    .vjs-480 {
        z-index: 0;
    }
</style>
<!--My changes -->
<a href="@if ($product->previews[0]->type == 'video' || Str::length($product->description) > 33) javascript:void(0); @else {{ url('shop/product', $product->id) }} @endif" class="link-shop">
	<div class="card card-updates h-100 card-user-profile shadow-sm">
	    <!--My changes-->
		<span class="badge type-item p-2 badge-pill">
		    <!--My changes-->
			{!! 
			($product->type == 'digital') ? '<i class="bi-cloud-download mr-2"></i>'. __('general.digital_download') 
			: (($product->type == 'physical') ? '<i class="bi-controller mr-2"></i>'. __('general.physical_products') 
			: (($product->type == 'video') ? '<i class="bi-controller mr-2"></i>'. __('my_lang.video_calls') 
			: (($product->type == 'snapchat') ? '<i class="bi-controller mr-2"></i>'. __('my_lang.snapchat') 
			: (($product->type == 'garments') ? '<i class="bi-controller mr-2"></i>'. __('my_lang.garments') 
			: '<i class="bi-lightning-charge mr-2"></i>'. __('general.custom_content')))))
			!!}
		</span>
		<!--My changes-->
	<div class="@if ($product->previews[0]->type == 'image') card-cover @endif position-relative lazyloaded" style="@if ($product->previews[0]->type == 'image') height:191px; @endif background: #efefef center center; background-size: cover;" data-src="@if ($product->previews[0]->type == 'image') {{ Helper::getFile(config('path.shop').$product->previews[0]->name) }} @endif">
        @if ($product->previews[0]->type == 'video')
        <video data-id="{{$product->previews[0]->id}}" data-type="shop" src="{{Helper::getFile(config('path.shop').$product->previews[0]->name)}}" image="@if($product->previews[0]->thumimge != NULL){{Helper::getFile(config('path.shop').$product->previews[0]->thumimge)}}@endif" id="player_{{$product->id}}" class="w-100 video-js vjs-fluid" controls preload="auto" @if ($product->previews[0]->video_poster) poster="{{ Helper::getFile(config('path.shop').$product->previews[0]->video_poster) }}" @endif>
            		<source src="{{Helper::getFile(config('path.shop').$product->previews[0]->name)}}" type="video/mp4" />
            	</video>
        @endif
        <!--My Changes-->
	   <a href="{{ url('shop/product', $product->id) }}" class="link-shop">
		<span class="price-shop">
			@if ($product->type == 'physical' && $product->quantity == 0)
				{{ __('general.sold_out') }}
			@else
				{{ Helper::amountFormatDecimal($product->price) }}
			@endif
		</span>
		</a>
		<!--My Changes end-->
	</div>

	<div class="card-body">
	    <!--My Changes-->
	        <a href="javascript:void(0);" class="link-shop">
    			<h5 class=" card-title mb-2 text-truncate-2 title-shop text-uppercase"><span onclick="window.location='{{ url('shop/product', $product->id) }}'"><u>{{$product->name }}</u></span></h5>
			</a>
			<!--My Changes-->
			<p role="button" class="my-2 text-dark card-text text-truncate-2 red-tooltip" @if(Str::length($product->description) > 70) data-toggle="modal" href="#decrModal" data-title="{{ $product->description }}" data-placement="right" title="" @endif>{{ Str::limit($product->description, 70, '...') }} @if(Str::length($product->description) > 70) <i class="fa fa-info-circle"></i> @endif</p>
            <!--My changes end-->
			<hr />
			<!--My Changes-->
            <a href="{{ url('shop/product', $product->id) }}" class="link-shop">
			<div class="d-flex justify-content-between align-items-center @if (Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes' || auth()->guest() && Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes') user-online-profile-shop overflow-visible @elseif (auth()->check() && auth()->id() != $product->user()->id && !Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes' || auth()->guest() && !Cache::has('is-online-' . $product->user()->id) && $product->user()->active_status_online == 'yes') user-offline-profile-shop overflow-visible @endif">
        <span class="text-truncate">
            <!-- My changes added style="font-size: 110%" to username and  width and height to img 50-->
            
          <img src="{{ Helper::getFile(config('path.avatar').$product->user()->avatar) }}" width="50" height="50" class="rounded-circle">
            <!--My Changes class="ml-2"-->
            <small style="font-size: 110%" class="ml-2"><strong>{{ '@'.$product->user()->username }}</strong></small>
            <!--My changes -->
                        @if(auth()->id() != $product->user()->id)
                          <a href="{{url('messages/'.$product->user()->id, $product->user()->username)}}" title="{{trans('general.message')}}">
                            <i class="feather icon-send mr-1 mr-lg-0"></i>
                          </a>
                          @endif
                          <!--My changes end -->
          </span>

					<small class="text-truncate">{{ Helper::formatDate($product->created_at) }}</small>
					
				</div>
				<span class="text-truncate float-right"> {{Helper::formatNumber($product->previews[0]->views()->count())}} views</span>
				</a>
				<!--My Changes end-->
	</div><!-- card-body -->

<!--	<div class="card-footer pt-0 bg-transparent border-top-0">
		<div class="d-flex align-items-end justify-content-between">
				<div class="d-flex align-items-center">
						<img class="rounded-circle mr-3" src="{{ Helper::getFile(config('path.avatar').$product->user()->avatar) }}" width="40" height="40" alt="{{$product->user()->username}}">
						<div class="small">
								<div><strong>{{ '@'.$product->user()->username }}</strong></div>
								<div class="text-muted">{{ Helper::formatDate($product->created_at) }}</div>
						</div>
				</div>
		</div>
</div>-->
</div><!-- End Card -->
</a>
<!--  My Changes Start Modal payPerViewForm -->
<div class="modal fade" id="decrModal" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
	<div class="modal-dialog modal- modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-body p-0">
				<div class="card bg-white shadow border-0">

					<div class="card-body px-lg-5 py-lg-5 position-relative">
                        Product Description: 
                        <small data-dismiss="modal" class="btn-cancel-msg"><i class="bi bi-x-lg"></i></small>
						<div class="mb-4 position-relative">
						<div class="descrp"></div>
                        
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</div><!-- End Modal addItemForm -->
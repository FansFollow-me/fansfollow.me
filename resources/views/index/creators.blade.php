@extends('layouts.app')

@section('title') {{$title}} -@endsection

@section('content')
  <section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
             <!--//My changes-->
            <div class="row">
            <div class="col-lg-3"></div>
        <div class="col-lg-9"> 
          <h2 class="mb-0 text-break">{{$title}}</h2>
          <p class="lead text-muted mt-0">{{trans('users.the_best_creators_is_here')}}
            @guest
              @if ($settings->registration_active == '1')
              <!--My changes-->
                <a data-toggle="modal" data-target="#loginFormModal" href="{{ request()->is('app*') ? '/auth/signup' : url('signup') }}" class="toggleRegister link-border">{{ trans('general.join_now') }}</a>
              @endif
          @endguest

          @auth
            <a href="{{ request()->is('app*') ? '/app/explore' : url('explore') }}" class="link-border">{{ trans('general.explore_posts') }}</a>
          @endauth
        </p>
        </div>
    </div>
        </div>
      </div>

<div class="row">

  <div class="col-md-3 mb-4">

    @include('includes.menu-filters-creators')

    @include('includes.listing-categories')
    <!--My Chnages -->
    <!--<button type="button" class="btn-menu-expand btn btn-primary btn-block filter" type="button" data-toggle="collapse" data-target="#navbarFiltersGender" aria-controls="navbarCollapse" aria-expanded="false">
      		<i class="feather  icon-filter mr-2"></i> {{__('Sort Results By')}} 
      	</button>
      	<div class=""><span class="filters"></span></div>
    <input type="hidden" id="filters-val" />
      	<div class="navbar-collapse collapse cont mt-2" id="navbarFiltersGender">
      	    <div class="btn-block mb-3">
  		<span>
      	    @foreach ($genders as $gender)
          <a class="text-dark btn btn-sm bg-white border mb-2 e-none btn-category" data-id="{{$gender}}" data-gender="{{ __('general.'.$gender) }}" href="javascript:void"> <img src="{{url('public/img/creators.png')}}" class="mr-2" width="30" /> {{ __('general.'.$gender) }} <input type="checkbox" value="{{$gender}}" class="filter-gender pull-right" id="{{$gender}}"></a>
          @endforeach
          <a class="text-dark btn btn-sm bg-white border mb-2 e-none btn-category" data-id="online" data-gender="Online Now" href="javascript:void"> <img src="{{url('public/img/green-icon.png')}}" class="mr-2" width="30" /> Online Now <input type="checkbox" class="filter-gender pull-right" id="online"></a>
      	</span>
      	</div>
      	</div>-->
  </div><!-- end col-md-3 -->


@if( $users->total() != 0 )
          <!--My Changes-->
          <div class="col-md-9 mb-4 listing-data">
            <div class="row">

              @foreach ($users as $response)
              <div class="col-md-6 mb-4">
                @include('includes.listing-creators')
              </div><!-- end col-md-4 -->
              @endforeach

              @if($users->hasPages())
                <div class="w-100 d-block">
                  {{ $users->onEachSide(0)->appends([
                    'q' => request('q'), 
                    'gender' => request('gender'),
                    'min_age' => request('min_age'),
                    'max_age' => request('max_age')
                    ])->links() }}
                </div>
              @endif
            </div><!-- row -->
          </div><!-- col-md-9 -->

        @else
          <div class="col-md-9">
            <div class="my-5 text-center no-updates">
              <span class="btn-block mb-3">
                <i class="fa fa-user-slash ico-no-result"></i>
              </span>
            <h4 class="font-weight-light">{{trans('general.no_results_found')}}</h4>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection
@section('javascript')
<script type="text/javascript">

//My changes
var filters = {};
var filters2 = {};
$('.cont').on('click', 'a', function () {
  var $li = $(this);
  
  var chkbx = $li.find('.filter-gender');

  if ($li.hasClass('reset')) {
    $li.parent().find('a.active').each(function () {
      $(this).removeClass('active')
    })
    filters = {};
  } else {
    if ($li.hasClass('active')) {
      $li.removeClass('active')
      $li.removeClass('active-category')
      delete filters[$li.data('id')]
      delete filters2[$li.text().trim()]
    } else {
     if($(chkbx).prop('checked')){
         $li.addClass('active');
         $li.addClass('active-category');
      filters[$li.data('id')] = true
      filters2[$li.text().trim()] = true
     } else {
         $li.removeClass('active')
         $li.removeClass('active-category')
         delete filters2[$li.text().trim()]
         delete filters[$li.data('id')]
     }
    }
  }
  printFilters()
})


$(document).on('click', '.delete-it', function () {
    $(this).closest('.gender-btn').remove();
   // filters = {};
    
    var chkbx = $(this).data('gender');
    var txt = $.trim($(this).closest('.gender-btn').text());
    console.log(chkbx);
    $('#'+chkbx).prop('checked', false); // Unchecks it
    $('#'+chkbx).closest('a').removeClass('active');
    $('#'+chkbx).closest('a').removeClass('active-category')
    delete filters[chkbx];
    delete filters2[txt];
   printFilters();
    
});


var printFilters = function () {
  var filtersList = Object.keys(filters);
  var filtersList2 = Object.keys(filters2);
  var type = '{{$type}}';
  var i;
  var arr = '';
  var arr_1 = '';
    for (i = 0; i < filtersList2.length; ++i) {
        arr_1 = 
      arr = arr + ' <button class="btn btn-outline-primary btn-sm mt-1 gender-btn" style="padding: 2px 9px; font-size: 15px;">'+filtersList2[i]+' <i class="feather icon-x delete-it" data-gender="'+filtersList[i]+'" data-id="'+filtersList2[i]+'"></i></button>';
    }
   if (filtersList.length) {
      $('#filters-val').val(filtersList.join(','));
    $('.filters').html(arr);
    $('.listing-data').html("");
     $('<div class="card mb-3 pb-4 loadMoreSpin rounded-large shadow-large"> <div class="card-body"> <div class="media"> <span class="rounded-circle mr-3"> <span class="item-loading position-relative loading-avatar"></span> </span> <div class="media-body"> <h5 class="mb-0 item-loading position-relative loading-name"></h5> <small class="text-muted item-loading position-relative loading-time"></small> </div> </div> </div> <div class="card-body pt-0 pb-3"> <p class="mb-1 item-loading position-relative loading-text-1"></p> <p class="mb-1 item-loading position-relative loading-text-2"></p> <p class="mb-0 item-loading position-relative loading-text-3"></p> </div> </div>').appendTo( ".listing-data");
    $.ajax({
                type:'GET',
                url:URL_BASE+'/creators-search',
                data:{q: filtersList.join(','), type: type},
                success: function( msg ) {
                    
                    $('.listing-data').html("");
                    if(msg != "")
                    $('.listing-data').html(msg);
                    else
                    $('.listing-data').html("No record Found");
                  $('.loadMoreSpin').remove();
                }
            });
            $(".timeAgo").timeago();
  } else {
    $('.filters').html('');
    console.log(type);
    $('.listing-data').html("");
     $('<div class="card mb-3 pb-4 loadMoreSpin rounded-large shadow-large"> <div class="card-body"> <div class="media"> <span class="rounded-circle mr-3"> <span class="item-loading position-relative loading-avatar"></span> </span> <div class="media-body"> <h5 class="mb-0 item-loading position-relative loading-name"></h5> <small class="text-muted item-loading position-relative loading-time"></small> </div> </div> </div> <div class="card-body pt-0 pb-3"> <p class="mb-1 item-loading position-relative loading-text-1"></p> <p class="mb-1 item-loading position-relative loading-text-2"></p> <p class="mb-0 item-loading position-relative loading-text-3"></p> </div> </div>').appendTo( ".listing-data");
    $.ajax({
                type:'GET',
                url:URL_BASE+'/creators-search',
                data:{q: filtersList.join(','), type: type},
                success: function( msg ) {
                    
                    $('.listing-data').html("");
                    $('.listing-data').html(msg);
                  $('.loadMoreSpin').remove();
                }
            });
            $(".timeAgo").timeago();
  }
  
 
}

//printFilters();
</script>
@endsection

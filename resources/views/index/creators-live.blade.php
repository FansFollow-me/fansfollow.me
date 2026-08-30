@extends('layouts.app')

@section('title') {{ trans('general.creators_live') }} -@endsection

@section('content')
  <section class="section section-sm">
    <div class="container">
      <div class="row justify-content-center text-center mb-sm">
        <div class="col-lg-12 py-5">
          <h2 class="mb-0 text-break">{{ trans('general.creators_live') }}</h2>
          <p class="lead text-muted mt-0">{{trans('users.the_best_creators_is_here')}}
            @guest
              @if ($settings->registration_active == '1')
                <a href="{{ request()->is('app*') ? '/auth/signup' : url('signup') }}" class="link-border">{{ trans('general.join_now') }}</a>
              @endif
          @endguest</p>
        </div>
      </div>

<div class="row">

  <div class="col-md-3 mb-4">

    @include('includes.menu-filters-creators')

    @include('includes.listing-categories')
  </div><!-- end col-md-3 -->


@if( $users->total() != 0 )
          <div class="col-md-9 mb-4">
            <div class="row">

              @foreach ($users as $response)
              <div class="col-md-6 mb-4">
                @include('includes.listing-creators-live')
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
                <i class="bi bi-broadcast ico-no-result"></i>
              </span>
            <h4 class="font-weight-light">{{trans('general.no_live_streams')}}</h4>
            </div>
          </div>
        @endif
      </div>
    </div>
  </section>
@endsection
@section('javascript')
<script type="text/javascript">
const appDispatcher = new Flux.Dispatcher();

const actionTypes = {
  SELECT_FILTER: 'SELECT_FILTER',
  DESELECT_FILTER: 'DESELECT_FILTER'
};

const actions = {
  selectFilter(filter) {
    appDispatcher.dispatch({
      type: 'SELECT_FILTER',
      text: filter.name
    });
  },
  deselectFilter(filter) {}
}

const state = {};

appDispatcher.register( function( payload ) {

    switch (payload.type) {
      case actionTypes.SELECT_FILTER:
        console.log('HEYO');
        return state;

      case actionTypes.DESELECT_FILTER:
        console.log('HEYO');
        return state;
      default:
        console.log('oops');
        return state;
    }

});

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
  var type = '';
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
    $('.listing-data').css({"opacity": "0.2"});
    $.ajax({
                type:'GET',
                url:URL_BASE+'/creators-cat-live-search',
                data:{q: filtersList.join(','), type: type},
                success: function( msg ) {
                    
                    $('.listing-data').html("");
                    if(msg != "")
                    $('.listing-data').html(msg);
                    else
                    $('.listing-data').html("No record Found");
                  $('.listing-data').css({"opacity": "1"});
                }
            });
            $(".timeAgo").timeago();
  } else {
    $('.filters').html('');
    console.log(type);
    $('.listing-data').css({"opacity": "0.2"});
    $.ajax({
                type:'GET',
                url:URL_BASE+'/creators-search',
                data:{q: filtersList.join(','), type: type},
                success: function( msg ) {
                    
                    $('.listing-data').html("");
                    $('.listing-data').html(msg);
                  $('.listing-data').css({"opacity": "1"});
                }
            });
            $(".timeAgo").timeago();
  }
  
 
}

//printFilters();
</script>
@endsection

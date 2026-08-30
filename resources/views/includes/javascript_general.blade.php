<script>
	window.paceOptions = {
	    ajax: false,
	    restartOnRequestAfter: false,
	};
</script>
<script src="{{ asset('public/js/core.min.js') }}?v={{$settings->version}}"></script>
<!--My Changes-->

<script type="text/javascript" src="{{ asset('public/js/moment.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/js/jqueryTimeago_'.Lang::locale().'.js') }}"></script>
<script src="{{ asset('public/js/lazysizes.min.js') }}" async=""></script>
<!--My Changes-->
<!--<script src="{{ asset('public/js/plyr/plyr.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/plyr/plyr.polyfilled.min.js') }}?v={{$settings->version}}"></script>-->
<script type="text/javascript" src="{{ asset('public/videojs/video.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/videojs/nuevo.min.js') }}"></script>
<!--My Changes-->
<script type="text/javascript" src="{{ asset('public/bootstrap/js/bootstrap-datetimepicker.min.js') }}"></script>
<!--My Changes-->
  <script src="{{ asset('public/plugins/select2/select2.full.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('public/plugins/select2/i18n/'.config('app.locale').'.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ asset('public/js/medium-editor.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/trix.umd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/js/bootstrap-tagsinput.min.js') }}" ></script>
<script>
var logo = '{{$settings->logo}}';
var limitimage = '{{url("public/img/logo-1676383084-removebg-preview.png")}}';
var nuevo_plugin_options = {
		singlePlay:true,
		settingButton: true,
		qualityMenu: true,
        buttonForward: true,
        rewindforward: 10,
        logotitle:'',
        logo: '{{url("public/img/logo-1676383084-removebg-preview.png")}}',
		logourl: URL_BASE +'/public/img/logo-1676383084-removebg-preview.png',
		logoposition: 'RT',
        zoonInfo: true,
    	zoomWheel:false,
    	mirrorButton: true,
    	hdicon: true
        };
</script>
<!--/*My Changes end*/-->
<script src="{{ asset('public/js/app-functions.js') }}?v={{$settings->version}}"></script>

@if (! request()->is('live/*'))
<script src="{{ asset('public/js/install-app.js') }}?v={{$settings->version}}"></script>
@endif

@auth
  <script src="{{ asset('public/js/fileuploader/jquery.fileuploader.min.js') }}"></script>
  <script src="{{ asset('public/js/fileuploader/fileuploader-post.js') }}?v={{$settings->version}}"></script>
  <script src="{{ asset('public/js/jquery-ui/jquery-ui.min.js') }}"></script>
  @if (request()->path() == '/' && auth()->user()->verified_id == 'yes' || request()->route()->named('profile') && request()->path() == auth()->user()->username  && auth()->user()->verified_id == 'yes')
  <script src="{{ asset('public/js/jquery-ui/mentions.js') }}"></script>
@endif

@if ($settings->story_status)
<script src="{{ asset('public/js/story/zuck.min.js') }}?v={{$settings->version}}"></script>
@endif

<script src="https://js.stripe.com/v3/"></script>

@if (request()->is('my/wallet'))
<script src="{{ asset('public/js/add-funds.js') }}?v={{$settings->version}}"></script>
@else
<script src="{{ asset('public/js/payment.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/payments-ppv.js') }}?v={{$settings->version}}"></script>
@endif
@endauth

@if ($settings->custom_js)
  <script type="text/javascript">
  {!! $settings->custom_js !!}
  </script>
@endif

<script type="text/javascript">

</script>

<script type="text/javascript">
/*My changes videosWidth: '100vw'*/

$(".js-example-tags").select2({
  placeholder: "Select Or Add Category",
  tags: true
});

$('.poopup-link').click(function(){
    lightbox.open();
})

/*My changes end*/

@if (auth()->check())
/*My changes */
$(document).on('click', '.btnMultipleUpload', function() {
  var $fu = $(this).closest('.card-footer, .card-body, form').find('.fileuploader');
  if ($fu.length) {
    $fu.find('input[type="file"]').first().trigger('click');
  } else {
    $('.fileuploader input[type="file"]').first().trigger('click');
  }
});
@endif
</script>
<!--My Changes-->
<script>
$(document).on('click', '.toggle-cat-items', function() {
    $('.cat-nav-list').toggleClass("justify-content-end");
    $('.toggle-cat-items').toggleClass("text-light");
});
</script>
@if (auth()->guest()
    && ! request()->is('password/reset')
    && ! request()->is('password/reset/*')
    && ! request()->is('contact')
    )
<script type="text/javascript">

	//<---------------- Login Register ----------->>>>

	_submitEvent = function() {
		  sendFormLoginRegister();
		};

	if (typeof captcha === 'undefined' || captcha == false) {

	    $(document).on('click','#btnLoginRegister',function(s) {

 		 s.preventDefault();
		 sendFormLoginRegister();

 		 });//<<<-------- * END FUNCTION CLICK * ---->>>>
	}

	function sendFormLoginRegister()
	{
		var element = $(this);
		$('#btnLoginRegister').attr({'disabled' : 'true'});
		$('#btnLoginRegister').find('i').addClass('spinner-border spinner-border-sm align-middle mr-1');

		(function(){
			 $("#formLoginRegister").ajaxForm({
			 dataType : 'json',
			 success:  function(result) {

         if (result.actionRequired) {
           $('#modal2fa').modal({
    				    backdrop: 'static',
    				    keyboard: false,
    						show: true
    				});

            $('#loginFormModal').modal('hide');
           return false;
         }

				 // Success
				 if (result.success) {

           if (result.isModal && result.isLoginRegister) {
             window.location.reload();
           }

					 if (result.url_return && ! result.isModal) {
					 	window.location.href = result.url_return;
					 }

					 if (result.check_account) {
					 	$('#checkAccount').html(result.check_account).fadeIn(500);

						$('#btnLoginRegister').removeAttr('disabled');
						$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
						$('#errorLogin').fadeOut(100);
						$("#formLoginRegister").reset();
					 }

				 }  else {

					 if (result.errors) {

						 var error = '';
						 var $key = '';

					for ($key in result.errors) {
							 error += '<li><i class="far fa-times-circle"></i> ' + result.errors[$key] + '</li>';
						 }

						 $('#showErrorsLogin').html(error);
						 $('#errorLogin').fadeIn(500);
						 $('#btnLoginRegister').removeAttr('disabled');
						 $('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
					 }
				 }

				},

				statusCode: {
						419: function() {
							window.location.reload();
						}
					},
				error: function(responseText, statusText, xhr, $form) {
						// error
						$('#btnLoginRegister').removeAttr('disabled');
						$('#btnLoginRegister').find('i').removeClass('spinner-border spinner-border-sm align-middle mr-1');
						swal({
								type: 'error',
								title: error_oops,
								text: error_occurred+' ('+xhr+')',
							});
				}
			}).submit();
		})(); //<--- FUNCTION %
	}// End function sendFormLoginRegister
	
</script>

@endif
<!--My Changes-->
<script>
$(window).on('load', function(){
    
     $('.lazyloaded').each(function() {
        
        var lazy = $(this);

        var src = lazy.attr('data-src');

        lazy.css('background-image', 'url("'+src+'")');
    
    });
});
   /* (function($) {

	$(".cata-sub-nav").on('scroll', function() {
    	$val = $(this).scrollLeft();

    	if($(this).scrollLeft() + $(this).innerWidth()>=$(this)[0].scrollWidth){
          $(".nav-next").hide();
        } else {
    		$(".nav-next").show();
    	}

    	if($val == 0){
    		$(".nav-prev").hide();
    	} else {
    		$(".nav-prev").show();
    	}
  	});
	console.log( 'init-scroll: ' + $(".nav-next").scrollLeft() );
	$(".nav-next").on("click", function(){
		$(".cata-sub-nav").animate( { scrollLeft: '+=460' }, 200);
		
	});
	$(".nav-prev").on("click", function(){
		$(".cata-sub-nav").animate( { scrollLeft: '-=460' }, 200);
	});

	

})(jQuery);*/
</script>
<script>
// Safety: clean up stuck overlay/scroll-lock classes on every page load
document.addEventListener('DOMContentLoaded', function() {
  document.body.classList.remove('sidebar-overlay', 'overflow-hidden', 'stop-scrolling', 'compensate-for-scrollbar');
  document.body.style.overflow = '';
  var overlay = document.getElementById('mobileMenuOverlay');
  if (overlay) overlay.classList.remove('show');
});
</script>

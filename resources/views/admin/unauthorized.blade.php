@extends('admin.layout')

@section('content')
<?php $isStagingDesign = false; ?>
@if ($isStagingDesign)
<div class="mb-4">
  <h5 class="mb-1 text-uppercase text-muted fw-semibold">Unauthorized</h5>
  <h2 class="mb-1">Access restricted</h2>
  <p class="text-muted mb-0">Blocked admin access is shown through the redesigned shell.</p>
</div>
@endif
<h4 class="mb-4 fw-light">{{ __('admin.dashboard') }} <small class="fs-6">v{{$settings->version}}</small></h4>

<div class="content">
	<div class="row">
		<div class="col-lg-12">
			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">
					<div class="w-100 d-block display-1 text-center p-5 ">
						<i class="bi-exclamation-triangle-fill mb-2 text-warning"></i>

						<h5 class="text-center text-muted fw-light m-0">{{ trans('general.unauthorized_section') }}</h5>
					</div>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->
	</div><!-- end row -->
</div><!-- end content -->
@endsection

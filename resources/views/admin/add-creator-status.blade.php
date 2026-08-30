@extends('admin.layout')

@section('content')
<?php $isStagingDesign = false; ?>
@if ($isStagingDesign)
<div class="mb-4">
  <h5 class="mb-1 text-uppercase text-muted fw-semibold">{{ __('admin.creator_status') }}</h5>
  <h2 class="mb-1">Add creator status</h2>
  <p class="text-muted mb-0">Create a new creator status label from the redesigned admin shell.</p>
</div>
@endif
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <a class="text-reset" href="{{ url('panel/admin/creator_status') }}">{{ __('Creator Status') }}</a>
      <i class="bi-chevron-right me-1 fs-6"></i>
      <span class="text-muted">{{ __('general.add_new') }}</span>
  </h5>

<div class="content">
	<div class="row">

		<div class="col-lg-12">

      @include('errors.errors-forms')

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-5">

					 <form method="post" action="{{ url('panel/admin/creator_status/add') }}" enctype="multipart/form-data">
             @csrf

		        <div class="row mb-3">
		          <label class="col-sm-2 col-form-label text-lg-end">{{ trans('admin.name') }}</label>
		          <div class="col-sm-10">
		            <input value="{{ old('name') }}" name="name" type="text" class="form-control">
		          </div>
		        </div>

            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0 text-lg-end">{{ trans('admin.status') }}</legend>
              <div class="col-sm-10">
                <div class="form-check form-switch form-switch-md">
                 <input class="form-check-input" type="checkbox" name="status" checked="checked" value="on" role="switch">
               </div>
              </div>
            </fieldset><!-- end row -->

            <div class="row mb-3">
              <label class="col-sm-2 col-form-label text-lg-end">{{ trans('admin.thumbnail') }}</label>
              <div class="col-lg-5 col-sm-10"> 
                <div class="input-group mb-1">
                  <input name="image" type="file" class="form-control custom-file rounded-pill">
                </div> 
                <small class="d-block">{{ trans('admin.thumbnail_desc_gift') }}</small>
              </div>
            </div>

						<div class="row mb-3">
		          <div class="col-sm-10 offset-sm-2">
		            <button type="submit" class="btn btn-dark mt-3 px-5">{{ __('admin.save') }}</button>
		          </div>
		        </div>

		       </form>

				 </div><!-- card-body -->
 			</div><!-- card  -->
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
@endsection

@section('javascript')

<script type="text/javascript"></script>
  @endsection

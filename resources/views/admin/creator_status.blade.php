@extends('admin.layout')

@section('css')
<link href="{{ asset('public/js/plyr/plyr.css')}}?v={{$settings->version}}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<?php $isStagingDesign = false; ?>
@if ($isStagingDesign)
<div class="mb-4">
  <h5 class="mb-1 text-uppercase text-muted fw-semibold">{{ __('admin.creator_status') }}</h5>
  <h2 class="mb-1">Creator status</h2>
  <p class="text-muted mb-0">Manage creator status labels from the redesigned admin shell.</p>
</div>
@endif
	<h5 class="mb-4 fw-light">
    <a class="text-reset" href="{{ url('panel/admin') }}">{{ __('admin.dashboard') }}</a>
      <i class="bi-chevron-right me-1 fs-6"></i>
	  <span class="text-muted">{{ __('Creator Status') }}</span>
	  <i class="bi-chevron-right me-1 fs-6"></i>
      <a href="{{ url('panel/admin/creator_status/add') }}" class="btn btn-sm btn-dark float-lg-end mt-1 mt-lg-0">
				<i class="bi-plus-lg"></i> {{ trans('general.add_new') }}
			</a>
  </h5>

<div class="content">
	<div class="row">
		<div class="col-lg-12">

			@if (session('success_message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="bi bi-check2 me-1"></i>	{{ session('success_message') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                  <i class="bi bi-x-lg"></i>
                </button>
                </div>
              @endif

			<div class="card shadow-custom border-0">
				<div class="card-body p-lg-4">
					<div class="table-responsive p-0">
						<table class="table table-hover">
						 <tbody>

							@if ($data->count() !=  0)
								 <tr>
									  <th class="active">ID</th>
										<th class="active">{{ trans('admin.title') }}</th>
										<th class="active">{{ trans('Icon') }}</th>
										<th class="active">Status</th>
										<th class="active">{{ trans('admin.actions') }}</th>
									</tr>

								@foreach ($data as $Creator_status)

									
									<tr> 
										<td>{{ $Creator_status->id }}</td>
										<td class="text-break">{{ $Creator_status->title ? $Creator_status->title :  __('general.not_applicable') }} ({{$Creator_status->status()->count()}})</td>

										<td><img width="30px" src="{{ Helper::getFile('img-c-status/'.$Creator_status->icon) }}"/></td>
										<td><span class="badge bg-{{ $Creator_status->status == 'on' ? 'success' : 'danger' }}">{{ ucfirst($Creator_status->status) }}</span></td>
										<td>
                                       <a href="{{ url('panel/admin/creator_status/edit/').'/'.$Creator_status->id }}" class="btn btn-success rounded-pill btn-sm me-2">
                                         <i class="bi-pencil"></i>
                                       </a>
                
                                      <form method="POST" action="{{ url('panel/admin/creator_status/delete', $Creator_status->id) }}" accept-charset="UTF-8" class="d-inline-block align-top">
                                        @csrf
                                        <button class="btn btn-danger rounded-pill btn-sm actionDelete" type="button"><i class="bi-trash-fill"></i></button>
                                        </form>

										</td>

									</tr><!-- /.TR -->
									@endforeach

									@else
										<h5 class="text-center p-5 text-muted fw-light m-0">{{ trans('general.no_results_found') }}</h5>
									@endif

								</tbody>
								</table>
							</div><!-- /.box-body -->

				 </div><!-- card-body -->
 			</div><!-- card  -->

		@if ($data->lastPage() > 1)
			{{ $data->onEachSide(0)->links() }}
		@endif
 		</div><!-- col-lg-12 -->

	</div><!-- end row -->
</div><!-- end content -->
@endsection

@section('javascript')
<script src="{{ asset('public/js/plyr/plyr.min.js') }}?v={{$settings->version}}"></script>
<script src="{{ asset('public/js/plyr/plyr.polyfilled.min.js') }}?v={{$settings->version}}"></script>
@endsection
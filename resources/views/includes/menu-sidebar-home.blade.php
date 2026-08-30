@auth
<ul class="list-unstyled d-none d-lg-block menu-left-home sticky-top">
	@php($homeBase = '')
	<li>
		<a href="{{ url('/') }}" @if (request()->is('/') || request()->is('app')) class="active disabled" @endif>
			<i class="bi bi-house-door"></i>
			<span class="ml-2">{{ trans('admin.home') }}</span>
		</a>
	</li>
	<li>
		<a href="{{ url(auth()->user()->username) }}">
			<i class="bi bi-person"></i>
			<span class="ml-2">{{ auth()->user()->verified_id == 'yes' ? trans('general.my_page') : trans('users.my_profile') }}</span>
		</a>
	</li>
	@if (auth()->user()->verified_id == 'yes')
	<li>
		<a href="{{ url('dashboard') }}">
			<i class="bi bi-speedometer2"></i>
			<span class="ml-2">{{ trans('admin.dashboard') }}</span>
		</a>
	</li>
	@endif
		<li>
			<a href="{{ url('my/purchases') }}" @if (request()->is('my/purchases')) class="active disabled" @endif>
				<i class="bi bi-bag-check"></i>
				<span class="ml-2">{{ trans('general.purchased') }}</span>
			</a>
		</li>
	<li>
		<a href="{{ url('messages') }}">
			<i class="feather icon-send"></i>
			<span class="ml-2">{{ trans('general.messages') }}</span>
		</a>
	</li>
	<li>
		<a href="{{ url('explore') }}" @if (request()->is('explore') || request()->is('app/explore')) class="active disabled" @endif>
			<i class="bi bi-compass"></i>
			<span class="ml-2">{{ trans('general.explore') }}</span>
		</a>
	</li>
	<!--My Changes-->
	<li>
		<a href="{{ url('promoted') }}" @if (request()->is('promoted') || request()->is('app/promoted')) class="active disabled" @endif>
			<i class="bi bi-fire"></i>
				<span class="ml-2">{{ trans('my_lang.promoted') }}</span>
		</a>
	</li>
	<li>
		<a href="{{ url('my/subscriptions') }}">
			<i class="bi bi-person-check"></i>
			<span class="ml-2">{{ trans('admin.subscriptions') }}</span>
		</a>
	</li>
	<li>
		<a href="{{ url('my/bookmarks') }}" @if (request()->is('my/bookmarks')) class="active disabled" @endif>
			<i class="bi bi-bookmark"></i>
			<span class="ml-2">{{ trans('general.bookmarks') }}</span>
		</a>
	</li>

</ul>
@endauth

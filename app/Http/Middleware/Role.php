<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Role
{
	/**
	 * The Guard implementation.
	 *
	 * @var Guard
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  Guard  $auth
	 * @return void
	 */
	public function __construct(Guard $auth)
	{
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		if ($this->auth->guest()) {

				return redirect()->guest('login')
					->with(['login_required' => trans('auth.login_required')]);

		} else if ($this->auth->user()->role == 'normal' && ! $this->isAdminUser($this->auth->user())) {
			return redirect('/');

		} else if ($request->route()->getName() != 'dashboard'
					&& ! $this->auth->user()->hasPermission($request->route()->getName())
					&& $request->isMethod('get')
					) {
						abort(403);

				} else if ($this->auth->user()->permissions == 'limited_access'
						&& $request->isMethod('post')
						&& $request->route()->getName() != 'dashboard.earnings'
					) {
						return redirect()->back()->withUnauthorized(trans('general.unauthorized_action'));
				}

		return $next($request);
	}

	protected function isAdminUser($user)
	{
		if (! $user) {
			return false;
		}

		$role = strtolower((string) ($user->role ?? ''));
		$permission = strtolower((string) ($user->permission ?? ''));
		$permissions = strtolower((string) ($user->permissions ?? ''));

		return $role === 'admin' || in_array($permission, ['all', 'full_access'], true) || in_array($permissions, ['all', 'full_access'], true);
	}

}

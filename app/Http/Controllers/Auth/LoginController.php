<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AdminSettings;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Traits\Functions;
use App\Helper;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, Functions;
    
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Guard $auth)
    {
      $this->auth = $auth;
      $this->middleware('guest')->except('logout');
    }

    /**
     * Show login form.
     */
    public function showLoginForm()
    {
      $settings = AdminSettings::forCurrentRequest();

  		if ($settings->home_style == 0)	{
  			return view('auth.login');
  		} else {
  			return redirect('/');
  		}
    }

    public function login(Request $request)
    {
      $settings = AdminSettings::forCurrentRequest();
      $request['_captcha'] = 'off';

      $messages = [
    'g-recaptcha-response.required_if' => trans('admin.captcha_error_required'),
    'g-recaptcha-response.captcha' => trans('admin.captcha_error'),
  ];

      $login = $request->input('username_email');
      $urlReturn = $request->input('return');
      $isModal = $request->input('isModal');
      $isJson = $request->expectsJson();

      $login_type = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      $request->merge([$login_type => $login]);

      if ($login_type == 'email') {

          $validator = Validator::make($request->all(), [
              'username_email'    => 'required|email',
              'password' => 'required',
              'g-recaptcha-response' => 'required_if:_captcha,==,on|captcha'
          ], $messages);

          if ($validator->fails()) {
            $payload = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ];

            return $isJson
                ? response()->json($payload)
                : redirect()->route('login')->withErrors($payload['errors'])->withInput();
        }

          $credentials = $request->only('email', 'password');

      } else {

          $validator = Validator::make($request->all(), [
              'username_email' => 'required',
              'password' => 'required',
              'g-recaptcha-response' => 'required_if:_captcha,==,on|captcha'
          ], $messages);

          if ($validator->fails()) {
            $payload = [
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray(),
            ];

            return $isJson
                ? response()->json($payload)
                : redirect()->route('login')->withErrors($payload['errors'])->withInput();
        }

          $credentials = $request->only('username', 'password');

      }

    if ($this->auth->attempt($credentials, $request->has('remember'))) {

      if ($this->auth->user()->status == 'active') {

          if ($this->auth->user()->two_factor_auth == 'yes') {
            $this->generateTwofaCode($this->auth->user());
            $this->auth->logout();

            if ($isJson) {
                return response()->json([
                    'actionRequired' => true,
                ]);
            }

            return redirect()->route('login')->with('login_required', trans('auth.login_required'));
          }

          $this->loginSession($this->auth->user()->id);

          $redirectUrl = $this->isAdminUser($this->auth->user())
              ? url('panel/admin')
              : $this->resolveLoginRedirect($urlReturn);

          $payload = [
              'success' => true,
              'isLoginRegister' => true,
              'isModal' => $isModal ? true : false,
              'url_return' => $redirectUrl
          ];

          return $isJson
              ? response()->json($payload)
              : redirect()->to($redirectUrl);

          } else if ($this->auth->user()->status == 'suspended') {

      $this->auth->logout();

      $payload = [
          'success' => false,
          'errors' => ['error' => trans('validation.user_suspended')],
      ];

      return $isJson
          ? response()->json($payload)
          : redirect()->route('login')->withErrors($payload['errors'])->withInput();

    } else if ($this->auth->user()->status == 'pending') {

      $this->auth->logout();

      $payload = [
          'success' => false,
          'errors' => ['error' => trans('validation.account_not_confirmed')],
      ];

      return $isJson
          ? response()->json($payload)
          : redirect()->route('login')->withErrors($payload['errors'])->withInput();
    }
  }

  $payload = [
      'success' => false,
      'errors' => ['error' => trans('auth.failed')]
  ];

  return $isJson
      ? response()->json($payload)
      : redirect()->route('login')->withErrors($payload['errors'])->withInput();
}

    /**
     * Resolve the post-login destination for non-admin users.
     */
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

    protected function resolveLoginRedirect($urlReturn)
    {
      $defaultUrl = url('dashboard');

      if (! is_string($urlReturn) || $urlReturn === '') {
        return $defaultUrl;
      }

      $path = parse_url($urlReturn, PHP_URL_PATH);
      $query = parse_url($urlReturn, PHP_URL_QUERY);
      $fragment = parse_url($urlReturn, PHP_URL_FRAGMENT);

      if ($path === null) {
        return $defaultUrl;
      }

      if (preg_match('#^(?:https?:)?//#', $urlReturn)) {
        return $defaultUrl;
      }

      $safePath = '/' . ltrim($path, '/');

      if (preg_match('#/(login|signup|register)(/|$)#', $safePath) || preg_match('#/core/index\.php/login(/|$)#', $safePath) || preg_match('#/password/reset(/|$)#', $safePath)) {
        return $defaultUrl;
      }

      $target = url($safePath);

      if ($query) {
        $target .= '?' . $query;
      }

      if ($fragment) {
        $target .= '#' . $fragment;
      }

      return $target;
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
      $this->auth->logout();

      $request->session()->invalidate();
      $request->session()->regenerateToken();
      $request->session()->forget('fansfollow_design');

      if ($request->expectsJson()) {
          return response()->json([], 204);
      }

      return redirect($this->logoutRedirectPath($request));
    }

    /**
     * Determine where logout should land for the current request.
     */
    protected function logoutRedirectPath(Request $request)
    {
      return '/';
    }

}

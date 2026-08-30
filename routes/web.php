<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\StripeWebHookController;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\AddFundsController;
use App\Http\Controllers\CCBillController;
use App\Http\Controllers\PayPerViewController;
use App\Http\Controllers\SubscriptionsController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\UpdatesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UpgradeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\InstallScriptController;
use App\Http\Controllers\InstallController;
use App\Http\Controllers\StripeController; 
use App\Http\Controllers\UploadMediaMessageController; 
use App\Http\Controllers\UploadMediaController;
use App\Http\Controllers\TwoFactorAuthController;
use App\Http\Controllers\LiveStreamingsController;
use App\Http\Controllers\TaxRatesController;
use App\Http\Controllers\CountriesStatesController;
use App\Http\Controllers\UploadMediaPreviewShopController;
use App\Http\Controllers\UploadMediaFileShopController;
use App\Http\Controllers\StripeConnectController;
use App\Http\Controllers\PushNotificationsController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\StoriesController;
use App\Http\Controllers\UploadMediaStoryController;
use App\Helper;
/*My Changes*/
use App\Http\Controllers\UploadIntroVideoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
 |-----------------------------------
 | Index
 |-----------------------------------
 */
// Staging Authentication Routes.
Route::get('app', [HomeController::class, 'index']);
Route::get('app/explore', function () {
	if (auth()->guest()) {
		return redirect()->to('/login');
	}

	return app(UpdatesController::class)->explore();
});
Route::get('app/explore/creators/live', [HomeController::class, 'creatorsBroadcastingLive']);
Route::get('app/promoted', [UpdatesController::class, 'stories']);
Route::get('app/creators/{type?}/{id?}', [HomeController::class, 'creators']);
Route::get('app/creators-search/{type?}', [HomeController::class, 'creatorsSearch']);
Route::get('app/creators-cat-search/{type?}', [HomeController::class, 'categorySearch']);
Route::get('app/creators-cat-live-search/{type?}', [HomeController::class, 'categorySearchLive']);
Route::get('app/category/{slug}/{type?}', [HomeController::class, 'category']);
Route::get('app/creators/live', [HomeController::class, 'creatorsBroadcastingLive']);
Route::get('app/{slug}', [UserController::class, 'profile'])->where('slug','[A-Za-z0-9\_-]+')->name('profile');
Route::get('app/{slug}/{media}', [UserController::class, 'profile'])->where('media', '(photos|videos|audio|shop|files)$')->name('profile');
Route::get('app/{slug}/post/{id}', [UserController::class, 'postDetail'])->where('slug','[A-Za-z0-9\_-]+')->name('profile');
Route::get('live', [HomeController::class, 'creatorsBroadcastingLive']);
Route::get('api/public-home', function () {
	$users = User::where('status', 'active')
		->whereVerifiedId('yes')
		->whereHideProfile('no')
		->where('id', '<>', 1)
		->inRandomOrder()
		->take(6)
		->get();

	$creators = $users->map(function ($user) {
		return [
			'name' => $user->name,
			'username' => $user->username,
			'avatar' => \App\Helper::getFile(config('path.avatar') . $user->avatar),
			'bio' => 'Featured creator on FansFollow',
			'verified' => $user->verified_id === 'yes',
		];
	});

	return response()->json([
		'stats' => [
			'creators' => User::whereStatus('active')->whereVerifiedId('yes')->whereHideProfile('no')->count(),
			'content' => Updates::where('status', 'active')->count(),
		],
		'creators' => $creators,
	]);
});
Route::get('auth/login', [LoginController::class, 'showLoginForm']);
Route::post('auth/login', [LoginController::class, 'login']);
Route::get('auth/logout', [LoginController::class, 'logout']);
Route::get('auth/signup', [RegisterController::class, 'showRegistrationForm']);
Route::post('auth/signup', [RegisterController::class, 'register']);
Route::get('auth/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm']);
Route::post('auth/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::get('auth/password/reset/{token}', [ResetPasswordController::class, 'showResetForm']);
Route::post('auth/password/reset', [ResetPasswordController::class, 'reset']);


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('home', function() {
	return redirect('/');
});

// Authentication Routes.
Route::get('csrf/login', function () {
	return response()->json(['token' => csrf_token()]);
});
Route::get('csrf/signup', function () {
	return response()->json(['token' => csrf_token()]);
});
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout']);

// Registration Routes.
Route::get('signup', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('signup', [RegisterController::class, 'register']);

// Password Reset Routes.
Route::get('password', function () { return redirect()->to('/password/reset'); });
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);

// Contact
Route::get('contact', [HomeController::class, 'contact']);
Route::post('contact', [HomeController::class, 'contactStore'])->middleware('throttle:5,10');
Route::get('support', function () {
	return response()->view('index.support-marketing');
});

// Prototype public aliases
Route::get('celebrities', function () {
	return response()->view('index.celebrities-marketing');
});
Route::get('casting', function () {
	return response()->view('index.casting-marketing');
});
Route::get('business', function () {
	return response()->view('index.business-marketing');
});
Route::get('group-coaching', function () { return redirect()->to(url('/#fans')); });
Route::get('live-streams', function () { return response()->view('index.livestreams-new'); });
Route::get('scan', function () { return response()->view('index.scan-new'); });
Route::get('explore-creators', function () { return redirect()->to(url('explore')); });

// Blog
Route::get('blog', [BlogController::class, 'blog']);
Route::get('blog/post/{id}/{slug?}', [BlogController::class, 'post'])->name('seo');

// Pretty front-end aliases
Route::get('fans', function () {
	return response()->view('index.fans-marketing');
});
Route::get('for-creators', function () {
	return response()->view('index.creators-marketing');
});
Route::get('creators', [HomeController::class, 'creators']);
Route::get('about-us', function () {
	return redirect('p/about');
});
Route::get('brand', function () {
	return redirect('p/brand');
});
Route::get('cookies-policy', function () {
	return redirect('p/cookies');
});
Route::get('privacy', function () {
	return app(PagesController::class)->show('privacy');
});
Route::get('cookies', function () {
	return app(PagesController::class)->show('cookies');
});
Route::get('faq', function () {
	return app(PagesController::class)->show('faq');
});
Route::get('how-it-works', function () {
	return redirect('p/how-it-works');
});
Route::get('presale-info', function () {
	return redirect('p/presale-info');
});
Route::get('privacy-policy', function () {
	return redirect('p/privacy');
});
Route::get('referrals', function () {
	return redirect('p/referrals');
});
Route::get('shipping', function () {
	return redirect('p/shipping-return-policy');
});
Route::get('terms-of-service', function () {
	return redirect('p/terms-of-service');
});
Route::get('terms', function () {
	return app(PagesController::class)->show('terms-of-service');
});
Route::get('token-ecosystem', function () {
	return redirect('p/token-ecosystem');
});

// Pages Static Custom
Route::get('p/{page}', [PagesController::class, 'show'])->where('page','[^/]*' )->name('seo');

// Offline
Route::view('offline','vendor.laravelpwa.offline');

// Social Login
Route::group(['middleware' => 'guest'], function() {
	Route::get('oauth/{provider}', [SocialAuthController::class, 'redirect'])->where('provider', '(facebook|google|twitter)$');
	Route::get('oauth/{provider}/callback', [SocialAuthController::class, 'callback'])->where('provider', '(facebook|google|twitter)$');
});//<--- End Group guest

// Verify Account
Route::get('verify/account/{confirmation_code}', [HomeController::class, 'getVerifyAccount'])->where('confirmation_code','[A-Za-z0-9]+');

 /*
  |-----------------------------------------------
  | Ajax Request
  |--------- -------------------------------------
  */
 Route::get('ajax/updates', [UpdatesController::class, 'ajaxUpdates']);
 Route::get('ajax/user/updates', [HomeController::class, 'ajaxUserUpdates']);
 Route::get('loadmore/comments', [CommentsController::class, 'loadmore']);

 /*
  |-----------------------------------
  | Subscription
  |--------- -------------------------
  */

 // Paypal IPN
 Route::post('paypal/ipn', [PayPalController::class, 'paypalIpn']);

 Route::get('buy/subscription/success/{user}', function($user) {

	 $notifyPayPal = request()->input('paypal') ? ' <br><br>'.trans('general.alert_paypal_delay') : null;

	 session()->put('subscription_success', trans('general.subscription_success').$notifyPayPal);
	 return redirect($user);
 	});

 Route::get('buy/subscription/cancel/{user}', function($user){
	 session()->put('subscription_cancel', trans('general.subscription_cancel'));
	 return redirect($user);
 	});

	// Stripe Webhook
	Route::post('stripe/webhook', [StripeWebHookController::class, 'handleWebhook']);

	// Paystack Webhook
	Route::post('webhook/paystack', [PaystackController::class, 'webhooks']);

	// Paypal IPN (TIPS)
  Route::post('paypal/tip/ipn', [TipController::class, 'paypalTipIpn']);

  Route::get('paypal/tip/success/{user}', function($user){
 	 session()->put('subscription_success', trans('general.tip_sent_success'));
 	 return redirect($user);
  	});

  Route::get('paypal/tip/cancel/{user}', function($user){
 	 session()->put('subscription_cancel', trans('general.payment_cancelled'));
 	 return redirect($user);
  	});

	// Tip on Messages
   Route::get('paypal/msg/tip/redirect/{id}', function($id){
  	 return redirect('messages/'.$id);
   	});

		// Paypal IPN (Add Funds)
	  Route::post('paypal/add/funds/ipn', [AddFundsController::class, 'paypalIpn']);

		// CCBill Webhook
		Route::post('webhook/ccbill', [CCBillController::class, 'webhooks']);
		Route::any('ccbill/approved', [CCBillController::class, 'approved']);

		// Paypal IPN (PPV)
	  Route::post('paypal/ppv/ipn', [PayPerViewController::class, 'paypalPPVIpn']);

 /*
  |-----------------------------------
  | User Views LOGGED
  |--------- -------------------------
  */
 Route::group(['middleware' => 'auth'], function() {

	 // Dashboard
	 Route::get('dashboard', [UserController::class, 'dashboard']);
	 Route::get('feed', [UserController::class, 'dashboard']);
	 Route::get('creator-dashboard', [UserController::class, 'dashboard']);
	 Route::get('creator-profile', [UserController::class, 'settingsPage']);
	 Route::get('bookmarks', [UserController::class, 'myBookmarks']);
	 Route::get('posts', [UserController::class, 'myPosts']);
	 Route::get('subscribers', [UserController::class, 'mySubscribers']);
	 Route::get('likes', [UserController::class, 'myLikes']);
	 Route::get('subscriptions', [UserController::class, 'mySubscriptions']);

	 // Buy Subscription
	 Route::post('buy/subscription', [SubscriptionsController::class, 'buy']);

	 // Free Subscription
	 Route::post('subscription/free', [SubscriptionsController::class, 'subscriptionFree']);

	 // Cancel Subscription
	 Route::post('subscription/free/cancel/{id}', [SubscriptionsController::class, 'cancelFreeSubscription']);

	 // Ajax Request
	 Route::post('ajax/like', [UserController::class, 'like']);
	 Route::get('ajax/notifications', [UserController::class, 'ajaxNotifications']);

	 // Comments
	 Route::post('comment/store',  [CommentsController::class, 'store']);
	 Route::post('comment/edit',  [CommentsController::class, 'edit']);
	 Route::post('ajax/delete-comment/{id}', [CommentsController::class, 'destroy']);

	 // Replies
	 Route::post('reply/delete/{id}', [RepliesController::class, 'destroy']);
	 Route::get('replies/loadmore',[RepliesController::class, 'loadmore']);

	 // Settings Page
  	Route::get('settings/page', [UserController::class, 'settingsPage']);
  	Route::post('settings/page', [UserController::class, 'updateSettingsPage']);
	Route::get('settings', [UserController::class, 'settingsPage']);
	Route::post('settings', [UserController::class, 'updateSettingsPage']);
	Route::get('settings/profile', [UserController::class, 'settingsPage']);
	Route::get('settings/subscription-pricing', [UserController::class, 'settingsPage']);
	Route::get('settings/privacy', [UserController::class, 'privacySecurity']);
	Route::get('settings/verify', [UserController::class, 'verifyAccount']);
	Route::get('settings/wallet', [AddFundsController::class, 'wallet']);
	Route::get('settings/payout', [UserController::class, 'payoutMethod']);
	Route::get('settings/cards', [UserController::class, 'myCards']);
	Route::get('settings/subscribers', [UserController::class, 'mySubscribers']);
	Route::get('settings/my-subscriptions', [UserController::class, 'mySubscriptions']);
	Route::get('settings/stories', [UserController::class, 'myStories']);
	Route::get('settings/referrals', [UserController::class, 'myReferrals']);
	Route::get('settings/block-countries', [UserController::class, 'blockCountries']);
	Route::get('settings/restricted-users', [UserController::class, 'restrictions']);
	Route::get('settings/products', [ProductsController::class, 'index']);
	Route::get('settings/sales', [UserController::class, 'myPayments']);
	Route::get('settings/payments-received', [UserController::class, 'myPayments']);
	Route::get('settings/purchased-items', [UserController::class, 'myPurchases']);
	Route::post('delete/cover', [UserController::class, 'deleteImageCover']);
	/*My Changes*/
	Route::any('upload/intro/video',[UploadIntroVideoController::class, 'store']); 
	Route::post('delete/intro/video',[UploadIntroVideoController::class, 'delete']);

	// Privacy and Security
   	Route::get('privacy/security', [UserController::class, 'privacySecurity']);
   	Route::post('privacy/security', [UserController::class, 'savePrivacySecurity']);

	Route::post('logout/session/{id}',  [UserController::class, 'logoutSession']);

	// Subscription Page
   	Route::view('settings/subscription','users.subscription');
   	Route::post('settings/subscription', [UserController::class, 'saveSubscription']);

	// Verify Account
   	Route::get('settings/verify/account', [UserController::class, 'verifyAccount']);
   	Route::post('settings/verify/account', [UserController::class, 'verifyAccountSend']);

	// Delete Account
	Route::view('account/delete', 'users.delete_account');
   	Route::post('account/delete', [UserController::class, 'deleteAccount']);

	// Notifications
 	Route::get('notifications', [UserController::class, 'notifications']);
	Route::post('notifications/settings', [UserController::class, 'settingsNotifications']);
	Route::post('notifications/delete', [UserController::class, 'deleteNotifications']);

	// Messages
	Route::get('messages',  [MessagesController::class, 'inbox']);
	// Message Chat
	Route::get('messages/{id}/{username?}',  [MessagesController::class, 'messages'])->where(array('id' => '[0-9]+'));
	Route::get('loadmore/messages',  [MessagesController::class, 'loadmore']);
	Route::post('message/send',  [MessagesController::class, 'send']);
	Route::get('messages/search/creator',  [MessagesController::class, 'searchCreator']);
	Route::post('message/delete',  [MessagesController::class, 'delete']);
	Route::get('messages/ajax/chat',  [MessagesController::class, 'ajaxChat']);
	Route::post('conversation/delete/{id}',  [MessagesController::class, 'deleteChat']);
	Route::get('load/chat/ajax/{id}',  [MessagesController::class, 'loadAjaxChat']);
	
	/*My Changes*/
	
	Route::post('intro_video/delete/{id}/{file}',  [UserController::class, 'deleteIntro']);
	Route::post('chat_image/delete/{id}/{file}',  [UserController::class, 'deleteChatImage']);

	// Upload Avatar
	Route::post('upload/avatar', [UserController::class, 'uploadAvatar']);

	// Upload Cover
	Route::post('upload/cover', [UserController::class, 'uploadCover']);

 	// Password
 	Route::get('settings/password', [UserController::class, 'password']);
 	Route::post('settings/password', [UserController::class, 'updatePassword']);

 	// My subscribers
 	Route::get('my/subscribers', [UserController::class, 'mySubscribers']);

	// My subscriptions
 	Route::get('my/subscriptions',[UserController::class, 'mySubscriptions']);
	Route::post('subscription/cancel/{id}',[UserController::class, 'cancelSubscription']);

	// My payments
	Route::get('my/payments',[UserController::class, 'myPayments']);
	Route::get('my/payments/received',[UserController::class, 'myPayments']);
	Route::get('payments/invoice/{id}',[UserController::class, 'invoice']);

	// Payout Method
 	Route::get('settings/payout/method',[UserController::class, 'payoutMethod']);
	Route::post('settings/payout/method/{type}',[UserController::class, 'payoutMethodConfigure']);

	// Withdrawals
 	Route::get('settings/withdrawals',[UserController::class, 'withdrawals']);
	Route::post('settings/withdrawals',[UserController::class, 'makeWithdrawals']);
	Route::post('delete/withdrawal/{id}',[UserController::class, 'deleteWithdrawal']);

 	// Upload Avatar
 	Route::post('upload/avatar',[UserController::class, 'uploadAvatar']);

	// Updates
	Route::post('update/create',[UpdatesController::class, 'create']);
	Route::get('update/edit/{id}',[UpdatesController::class, 'edit']);
	Route::post('update/edit',[UpdatesController::class, 'postEdit']);
	Route::post('update/delete/{id}',[UpdatesController::class, 'delete']);
	/*My Changes*/
	Route::post('update/limit/time',[UpdatesController::class, 'postLimitTime']);
	Route::post('remove/postCat',[UpdatesController::class, 'deletePostCat']);

	// Report Update
	Route::post('report/update/{id}',[UpdatesController::class, 'report']);

	// Report Creator
	Route::post('report/creator/{id}',[UserController::class, 'reportCreator']);

	//======================================= STRIPE ================================//
	Route::get("settings/payments/card", [UserController::class, 'formAddUpdatePaymentCard']);
	Route::post("settings/payments/card", [UserController::class, 'addUpdatePaymentCard']);
	Route::post("stripe/delete/card", [UserController::class, 'deletePaymentCard']);


	//======================================= Paystack ================================//
	Route::post("paystack/card/authorization", [PaystackController::class, 'cardAuthorization']);
	Route::get("paystack/card/authorization/verify", [PaystackController::class, 'cardAuthorizationVerify']);
	Route::post("paystack/delete/card", [PaystackController::class, 'deletePaymentCard']);

	// Cancel Subscription Paystack
	Route::post('subscription/paystack/cancel/{id}',[PaystackController::class, 'cancelSubscription']);

	// Cancel Subscription Wallet
	Route::post('subscription/wallet/cancel/{id}',[SubscriptionsController::class, 'cancelWalletSubscription']);

	// Cancel Subscription PayPal
	Route::post('subscription/paypal/cancel/{id}',[PayPalController::class, 'cancelSubscription']);

	// Pin Post
	Route::post('pin/post',[UpdatesController::class, 'pinPost'] );

	// Dark Mode
	Route::get('mode/{mode}',[HomeController::class, 'darkMode'] )->where('mode', '(dark|light)$');

	// Bookmarks
	Route::post('ajax/bookmark',[HomeController::class, 'addBookmark'] );
	Route::get('my/bookmarks',[UserController::class, 'myBookmarks'] );
	Route::get('ajax/user/bookmarks', [UpdatesController::class, 'ajaxBookmarksUpdates'] );

	// My Purchases
	Route::get('my/purchases',[UserController::class, 'myPurchases'] );
	Route::get('ajax/user/purchases', [UserController::class, 'ajaxMyPurchases'] );

	// Likes
	Route::get('my/likes',[UserController::class, 'myLikes'] );
	Route::get('ajax/user/likes', [UserController::class, 'ajaxMyLikes'] );

	// Downloads Files
	Route::get('download/file/{id}',[UserController::class, 'downloadFile'] );

	// Downloads Files
	Route::get('download/message/file/{id}',[MessagesController::class, 'downloadFileZip'] );

	// My Wallet
 	Route::get('my/wallet', [AddFundsController::class, 'wallet'] );
	Route::get('deposits/invoice/{id}',[UserController::class, 'invoiceDeposits'] );

	// My Cards
	Route::get('my/cards', [UserController::class, 'myCards'] );

	// Add Funds
	Route::post('add/funds', [AddFundsController::class, 'send'] );

	// Send Tips
	Route::post('send/tip', [TipController::class, 'send'] );

	// Pay Per Views
	Route::post('send/ppv', [PayPerViewController::class, 'send'] );

	// Explore
	Route::get('explore',[UpdatesController::class, 'explore'])->withoutMiddleware('auth');
	Route::get('ajax/explore', [UpdatesController::class, 'ajaxExplore'])->withoutMiddleware('auth');
	
	/*My Changes*/
	//stories
    Route::get('promoted',[UpdatesController::class, 'stories']);
    Route::get('ajax/stories', [UpdatesController::class, 'ajaxStories']);
    Route::get('story/expired',[UpdatesController::class, 'storyExpired']);

	// Add/Remove Restrict User
	Route::post('restrict/user/{id}', [UserController::class, 'restrictUser']);

	// Restrict User
 	Route::get('settings/restrictions',[UserController::class, 'restrictions']);

	// Report Item (Shop)
	Route::post('report/item/{id}', [ProductsController::class, 'report']);

	// Get data Earnings Dashboard Creator
	Route::get('get/earnings/creator/{range}', [UserController::class, 'getDataChart']);

	// Logout other devices
	Route::post('logout/devices', [UserController::class, 'logoutOtherDevices']);

	// Ajax Mentions
	Route::get('ajax/mentions', [UserController::class, 'mentions']);

	// Stripe Connect
	Route::get('stripe/connect', [StripeConnectController::class, 'redirectToStripe'])->name('redirect.stripe');
	Route::get('connect/{token}', [StripeConnectController::class, 'saveStripeAccount'])->name('save.stripe');

	Route::get('add/physical/product', [ProductsController::class, 'createPhysicalProduct']);
	Route::post('add/physical/product', [ProductsController::class, 'storePhysicalProduct']);

	Route::get('add/product',[ProductsController::class, 'create']);
	Route::post('add/product',[ProductsController::class, 'store']);

	Route::get('add/custom/content',[ProductsController::class, 'createCustomContent']);
	Route::post('add/custom/content',[ProductsController::class, 'storeCustomContent']);

	Route::post('edit/product/{id}',[ProductsController::class, 'update']);

	Route::post('delete/product/{id}',[ProductsController::class, 'destroy']);

	Route::any('upload/media/shop/preview',[UploadMediaPreviewShopController::class, 'store']);
	Route::post('delete/media/shop/preview',[UploadMediaPreviewShopController::class, 'delete']);

	Route::any('upload/media/shop/file',[UploadMediaFileShopController::class, 'store']); 
	Route::post('delete/media/shop/file',[UploadMediaFileShopController::class, 'delete']);

	Route::post('buy/now/product',[ProductsController::class, 'buy']);
	Route::get('product/download/{id}',[ProductsController::class, 'download']);
	Route::post('delivered/product/{id}',[ProductsController::class, 'deliveredProduct']);

	Route::get('my/purchased/items',[UserController::class, 'purchasedItems']);
	Route::get('my/sales',[UserController::class, 'mySales']);
	Route::get('my/products',[UserController::class, 'myProducts']);

	// Files Images Messages
	Route::get('files/messages/{id}/{path}', [UpdatesController::class, 'messagesImage'])->where(['id' =>'[0-9]+', 'path' => '.*']);

	Route::any('upload/media',[UploadMediaController::class, 'store']); 
	Route::post('delete/media',[UploadMediaController::class, 'delete']);

	Route::any('upload/media/message',[UploadMediaMessageController::class, 'store']); 
	Route::post('delete/media/message',[UploadMediaMessageController::class, 'delete']);

	Route::post('new/message/massive', [MessagesController::class, 'sendMessageMassive']);

	Route::post('reject/order/{id}',[ProductsController::class, 'rejectOrder']);

	Route::post('create/live', [LiveStreamingsController::class, 'create']);  
	Route::post('finish/live', [LiveStreamingsController::class, 'finish']);

	Route::get('live/{username}',[LiveStreamingsController::class, 'show'])->name('live');
	Route::get('get/data/live', [LiveStreamingsController::class, 'getDataLive'])->name('live.data')->middleware('live');
	Route::post('end/live/stream/{id}', [LiveStreamingsController::class, 'finish']);
	Route::post('send/payment/live', [LiveStreamingsController::class, 'paymentAccess']);
	Route::post('comment/live', [LiveStreamingsController::class, 'comments']);
	Route::post('live/like',[LiveStreamingsController::class, 'like']);

	// Comment Like
	Route::post('comment/like',[CommentsController::class, 'like'])->middleware('auth'); 

	Route::get('my/posts',[UserController::class, 'myPosts']);
	Route::get('block/countries',[UserController::class, 'blockCountries']);
	Route::post('block/countries',[UserController::class, 'blockCountriesStore']);

	Route::get('my/referrals',[UserController::class, 'myReferrals']);

	Route::get('mercadopado/process', [AddFundsController::class, 'mercadoPagoProcess'])->name('mercadopadoProcess');
	Route::get('flutterwave/callback', [AddFundsController::class, 'flutterwaveCallback'])->name('flutterwaveCallback');

	// Stories
	Route::get('create/story', [StoriesController::class, 'createStoryImage']);
	Route::post('create/story', [StoriesController::class, 'store']);
	Route::post('delete/story/{id}', [StoriesController::class, 'destroy']);
	Route::get('story/views/{id}',  [StoriesController::class, 'getViews']);

	Route::any('upload/media/story/file',[UploadMediaStoryController::class, 'store']);
	Route::post('story/delete/media',[UploadMediaStoryController::class, 'delete']);

	Route::get('create/story/text', [StoriesController::class, 'createStoryText']);
   	Route::post('create/story/text', [StoriesController::class, 'storeStoryText']);

	Route::get('my/stories',  [UserController::class, 'myStories']);

	// Insert Video Views
	Route::post('story/views/{id}', [StoriesController::class, 'insertView']);
	

 });//<------ End User Views LOGGED

// Private content
Route::group(['middleware' => 'private.content'], function() {

	// Shop
	Route::get('shop', [ProductsController::class, 'index']);
	Route::get('shop/product/{id}/{slug?}', [ProductsController::class, 'show'])->name('seo');

	// Creators
	Route::get('creators/{type?}/{id?}',[HomeController::class, 'creators']);
	
	//My Changes
	Route::post('conversation/block/{id}', [MessagesController::class, 'blockUser']);
	Route::post('conversation/un_block/{id}', [MessagesController::class, 'unblockUser']);
	Route::get('creators-search/{type?}', [HomeController::class, 'creatorsSearch']);
    Route::get('creators-cat-search/{type?}',[HomeController::class, 'categorySearch']);
    Route::get('creators-cat-live-search/{type?}',[HomeController::class, 'categorySearchLive']);

	// Category
	Route::get('category/{slug}/{type?}',[HomeController::class, 'category'])->name('seo');

});//<------ Private content


 /*
  |-----------------------------------
  | Admin Panel
  |--------- -------------------------
  */
 Route::group(['middleware' => 'role'], function() {

    // Upgrades
 	Route::get('update/{version}',[UpgradeController::class, 'update']);

 	// Dashboard
 	Route::get('panel/admin',[AdminController::class, 'admin'])->name('dashboard');

 	// Settings
 	Route::get('panel/admin/settings',[AdminController::class, 'settings'])->name('general');
 	Route::post('panel/admin/settings',[AdminController::class, 'saveSettings']);

	// Limits
	Route::get('panel/admin/settings/limits',[AdminController::class, 'settingsLimits'])->name('general');
	Route::post('panel/admin/settings/limits',[AdminController::class, 'saveSettingsLimits']);

	// BILLING
	Route::view('panel/admin/billing','admin.billing')->name('billing');
	Route::post('panel/admin/billing',[AdminController::class, 'billingStore']);

	// EMAIL SETTINGS
	Route::view('panel/admin/settings/email','admin.email-settings')->name('email');
	Route::post('panel/admin/settings/email',[AdminController::class, 'emailSettings']);

	// Test SMTP
	Route::post('panel/admin/settings/test-smtp',[AdminController::class, 'testSMTP']);

	// STORAGE
	Route::view('panel/admin/storage','admin.storage')->name('storage');
	Route::post('panel/admin/storage',[AdminController::class, 'storage']);

	// THEME
	Route::get('panel/admin/theme',[AdminController::class, 'theme'])->name('theme');
	Route::post('panel/admin/theme',[AdminController::class, 'themeStore']);

 	//Withdrawals
 	Route::get('panel/admin/withdrawals',[AdminController::class, 'withdrawals'])->name('withdrawals');
 	Route::get('panel/admin/withdrawal/{id}',[AdminController::class, 'withdrawalsView'])->name('withdrawals');
 	Route::post('panel/admin/withdrawals/paid/{id}',[AdminController::class, 'withdrawalsPaid']);

 	// Subscriptions
 	Route::get('panel/admin/subscriptions',[AdminController::class, 'subscriptions'])->name('subscriptions');

	// Transactions
	Route::get('panel/admin/transactions',[AdminController::class, 'transactions'])->name('transactions');
	Route::post('panel/admin/transactions/cancel/{id}',[AdminController::class, 'cancelTransaction']);

 	// Members
	Route::get('panel/admin/members',[AdminController::class, 'index'])->name('members');

	// EDIT MEMBER
	Route::get('panel/admin/members/edit/{id}',[AdminController::class, 'edit'])->name('members');

	// EDIT MEMBER POST
	Route::post('panel/admin/members/edit/{id}', [AdminController::class, 'update']);

	// DELETE MEMBER
	Route::post('panel/admin/members/{id}', [AdminController::class, 'destroy']);
	
	//creator_status
	Route::get('panel/admin/creator_status',[AdminController::class, 'creator_status'])->name('creator_status');
	Route::get('panel/admin/creator_status/add',[AdminController::class, 'add_creator_status'])->name('creator_status');
	Route::post('panel/admin/creator_status/add',[AdminController::class, 'store_creator_status']);
	
	// EDIT creator_status
	Route::get('panel/admin/creator_status/edit/{id}',[AdminController::class, 'edit_creator_status'])->name('creator_status');
	Route::post('panel/admin/creator_status/update',[AdminController::class, 'update_creator_status']);

	// DELETE creator_status
	Route::post('panel/admin/creator_status/delete/{id}', [AdminController::class, 'destroy_creator_status']);

 	// Pages
	Route::get('panel/admin/pages',[PagesController::class, 'index'])->name('pages');

	// ADD NEW PAGES
	Route::get('panel/admin/pages/create',[PagesController::class, 'create'])->name('pages');

	// ADD NEW PAGES POST
	Route::post('panel/admin/pages/create',[PagesController::class, 'store']);

	// EDIT PAGES
	Route::get('panel/admin/pages/edit/{id}',[PagesController::class, 'edit'])->name('pages');

	// EDIT PAGES POST
	Route::post('panel/admin/pages/edit/{id}', [PagesController::class, 'update']);

	// DELETE PAGES
	Route::post('panel/admin/pages/{id}', [PagesController::class, 'destroy']);

	// Verification Requests
 	Route::get('panel/admin/verification/members',[AdminController::class, 'memberVerification'])->name('verification_requests');
 	Route::post('panel/admin/verification/members/{action}/{id}/{user}',[AdminController::class, 'memberVerificationSend']);

 	// Payments Settings
 	Route::get('panel/admin/payments',[AdminController::class, 'payments'])->name('payments');
 	Route::post('panel/admin/payments',[AdminController::class, 'savePayments']);

	Route::get('panel/admin/payments/{id}',[AdminController::class, 'paymentsGateways'])->name('payments');
	Route::post('panel/admin/payments/{id}',[AdminController::class, 'savePaymentsGateways']);

 	// Profiles Social
 	Route::get('panel/admin/profiles-social',[AdminController::class, 'profiles_social'])->name('profiles_social');
 	Route::post('panel/admin/profiles-social',[AdminController::class, 'update_profiles_social']);

 	// Categories
 	Route::get('panel/admin/categories',[AdminController::class, 'categories'])->name('categories');
 	Route::get('panel/admin/categories/add',[AdminController::class, 'addCategories'])->name('categories');
 	Route::post('panel/admin/categories/add',[AdminController::class, 'storeCategories']);
 	Route::get('panel/admin/categories/edit/{id}',[AdminController::class, 'editCategories'])->name('categories');
 	Route::post('panel/admin/categories/update',[AdminController::class, 'updateCategories']);
 	Route::post('panel/admin/categories/delete/{id}',[AdminController::class, 'deleteCategories']);

	// Posts
 	Route::get('panel/admin/posts',[AdminController::class, 'posts'])->name('posts');
	Route::post('panel/admin/posts/delete/{id}',[AdminController::class, 'deletePost']);

	// Approve post
	Route::post('panel/admin/posts/approve/{id}',[AdminController::class, 'approvePost']);

	// Reports
 	Route::get('panel/admin/reports',[AdminController::class, 'reports'])->name('reports');
	Route::post('panel/admin/reports/delete/{id}',[AdminController::class, 'deleteReport']);

	// Social Login
	Route::view('panel/admin/social-login', 'admin.social-login')->name('social_login');
	Route::post('panel/admin/social-login',[AdminController::class, 'updateSocialLogin']);

	// Google
	Route::get('panel/admin/google',[AdminController::class, 'google'])->name('google');
	Route::post('panel/admin/google',[AdminController::class, 'update_google']);

	//***** Languages
	Route::get('panel/admin/languages',[LangController::class, 'index'])->name('languages');

	// ADD NEW
	Route::get('panel/admin/languages/create',[LangController::class, 'create'])->name('languages');

	// ADD NEW POST
	Route::post('panel/admin/languages/create',[LangController::class, 'store']);

	// EDIT LANG
	Route::get('panel/admin/languages/edit/{id}',[LangController::class, 'edit'])->name('languages');

	// EDIT LANG POST
	Route::post('panel/admin/languages/edit/{id}', [LangController::class, 'update']);

	// DELETE LANG
	Route::post('panel/admin/languages/{id}', [LangController::class, 'destroy']);

	// Maintenance mode
	Route::view('panel/admin/maintenance/mode','admin.maintenance_mode')->name('maintenance_mode');
	Route::post('panel/admin/maintenance/mode',[AdminController::class, 'maintenanceMode']);

	// Clear Cache
	Route::get('panel/admin/clear-cache', 'AdminController@clearCache')->name('maintenance_mode');

	Route::post("ajax/upload/image", [AdminController::class, 'uploadImageEditor'])->name("upload.image");

	// Blog
	Route::get('panel/admin/blog',[AdminController::class, 'blog'])->name('blog');
    Route::post('panel/admin/blog/delete/{id}',[AdminController::class, 'deleteBlog']);

	// Add Blog Post
	Route::view('panel/admin/blog/create','admin.create-blog')->name('blog');
	Route::post('panel/admin/blog/create',[AdminController::class, 'createBlogStore']);

	// Edit Blog Post
	Route::get('panel/admin/blog/{id}',[AdminController::class, 'editBlog'])->name('blog');
	Route::post('panel/admin/blog/update',[AdminController::class, 'updateBlog']);

	// Resend confirmation email
	Route::get('panel/admin/resend/email/{id}',[AdminController::class, 'resendConfirmationEmail'])->name('members');

	// Deposits
	Route::get('panel/admin/deposits',[AdminController::class, 'deposits'])->name('deposits');
	Route::get('panel/admin/deposits/{id}',[AdminController::class, 'depositsView'])->name('deposits');
	Route::post('approve/deposits',[AdminController::class, 'approveDeposits']);
	Route::post('delete/deposits',[AdminController::class, 'deleteDeposits']);

	// Login as User
	Route::post('panel/admin/login/user/{id}',[AdminController::class, 'loginAsUser']);

	// Custom CSS/JS
  	Route::view('panel/admin/custom-css-js','admin.css-js')->name('custom_css_js');
	Route::post('panel/admin/custom-css-js',[AdminController::class, 'customCssJs']);

	// PWA
  	Route::view('panel/admin/pwa','admin.pwa')->name('pwa');
	Route::post('panel/admin/pwa',[AdminController::class, 'pwa']);

	// Role and permissions
	Route::get('panel/admin/members/roles-and-permissions/{id}',[AdminController::class, 'roleAndPermissions'])->name('members');
	Route::post('panel/admin/members/roles-and-permissions/{id}',[AdminController::class, 'storeRoleAndPermissions']);

	// Shop Categories
 	Route::get('panel/admin/shop-categories',[AdminController::class, 'shopCategories'])->name('shop_categories');
 	Route::get('panel/admin/shop-categories/add',[AdminController::class, 'addShopCategories'])->name('shop_categories');
 	Route::post('panel/admin/shop-categories/add',[AdminController::class, 'storeShopCategories']);
 	Route::get('panel/admin/shop-categories/edit/{id}',[AdminController::class, 'editShopCategories'])->name('shop_categories');
 	Route::post('panel/admin/shop-categories/update',[AdminController::class, 'updateShopCategories']);
 	Route::post('panel/admin/shop-categories/delete/{id}',[AdminController::class, 'deleteShopCategories']);

	// Push notification
	Route::view('panel/admin/push-notifications', 'admin.push_notifications')->name('push_notifications');
	Route::post('panel/admin/push-notifications', [AdminController::class, 'savePushNotifications']);

	// Get data Earnings Dashboard Admin
	Route::post('get/earnings/admin/{range}', [AdminController::class, 'getDataChart'])->name('dashboard.earnings');

	Route::get('panel/admin/referrals', [AdminController::class, 'referrals'])->name('referrals');

	Route::view('panel/admin/shop','admin.shop')->name('shop');
	Route::post('panel/admin/shop',  [AdminController::class, 'shopStore']);

	Route::get('panel/admin/products', [AdminController::class, 'products'])->name('products');
	Route::post('panel/admin/product/delete/{id}', [AdminController::class, 'productDelete']);

	Route::get('panel/admin/sales',[AdminController::class, 'sales'])->name('sales');
	Route::post('panel/admin/sales/refund/{id}',[AdminController::class, 'salesRefund']);

	Route::get('panel/admin/tax-rates', [TaxRatesController::class, 'show'] )->name('tax'); 
	Route::view('panel/admin/tax-rates/add', 'admin.add-tax')->name('tax');
	Route::post('panel/admin/tax-rates/add', [TaxRatesController::class, 'store'] );
	Route::get('panel/admin/tax-rates/edit/{id}', [TaxRatesController::class, 'edit'] )->name('tax');
	Route::post('panel/admin/tax-rates/update', [TaxRatesController::class, 'update'] );
	Route::post('panel/admin/ajax/states', [TaxRatesController::class, 'getStates'] );

	Route::get('panel/admin/countries', [CountriesStatesController::class, 'countries'])->name('countries_states');
	Route::view('panel/admin/countries/add', 'admin.add-country')->name('countries_states');
	Route::post('panel/admin/countries/add', [CountriesStatesController::class, 'addCountry']);
	Route::get('panel/admin/countries/edit/{id}', [CountriesStatesController::class, 'editCountry'])->name('countries_states');
	Route::post('panel/admin/countries/update', [CountriesStatesController::class, 'updateCountry']);
	Route::post('panel/admin/countries/delete/{id}', [CountriesStatesController::class, 'deleteCountry']);

	Route::get('panel/admin/states', [CountriesStatesController::class, 'states'])->name('countries_states');
	Route::view('panel/admin/states/add', 'admin.add-state')->name('countries_states');
	Route::post('panel/admin/states/add', [CountriesStatesController::class, 'addState']);
	Route::get('panel/admin/states/edit/{id}', [CountriesStatesController::class, 'editState'])->name('countries_states');
	Route::post('panel/admin/states/update', [CountriesStatesController::class, 'updateState']);
	Route::post('panel/admin/states/delete/{id}', [CountriesStatesController::class, 'deleteState']);

	Route::get('file/verification/{filename}', [AdminController::class, 'getFileVerification']);

	Route::view('panel/admin/announcements','admin.announcements')->name('announcements');
	Route::post('panel/admin/announcements', [AdminController::class, 'storeAnnouncements']);

	Route::view('panel/admin/live-streaming','admin.live_streaming')->name('live_streaming');
	Route::post('panel/admin/live-streaming', [AdminController::class, 'saveLiveStreaming']);

	// Stories
	Route::view('panel/admin/stories/settings', 'admin.stories-settings')->name('stories');
	Route::post('panel/admin/stories/settings', [AdminController::class, 'saveStoriesSettings']);

	// Stories Posts
	Route::get('panel/admin/stories/posts', [AdminController::class, 'storiesPosts'])->name('stories');
	Route::post('panel/admin/stories/posts/delete/{id}', [AdminController::class, 'deleteStory']);

	// Stories Backgrounds
	Route::get('panel/admin/stories/backgrounds', [AdminController::class, 'storiesBackgrounds'])->name('stories');
	Route::post('panel/admin/stories/backgrounds/add', [AdminController::class, 'addStoryBackground']);
	Route::post('panel/admin/stories/backgrounds/delete/{id}', [AdminController::class, 'deleteStoryBackground']);

	// Stories Fonts
	Route::get('panel/admin/stories/fonts', [AdminController::class, 'storiesFonts'])->name('stories');
	Route::post('panel/admin/stories/fonts/add', [AdminController::class, 'addStoryFont']);
	Route::post('panel/admin/stories/fonts/delete/{id}', [AdminController::class, 'deleteStoryFont']);

 });
 //==== End Panel Admin

 // Installer Script
 Route::get('install/script',[InstallScriptController::class, 'requirements']);
 Route::get('install/script/database',[InstallScriptController::class, 'database']);
 Route::post('install/script/database',[InstallScriptController::class, 'store']);

// Install Controller (Add-on)
 Route::get('install/{addon}',[InstallController::class, 'install']);

 // Payments Gateways
 Route::get('payment/paypal', [PayPalController::class, 'show'])->name('paypal');

 Route::get('payment/stripe', [StripeController::class, 'show'])->name('stripe');
 Route::post('payment/stripe/charge', [StripeController::class, 'charge']);

// Files Images Post
Route::get('files/storage/{id}/{path}', [UpdatesController::class, 'image'])->where(['id' =>'[0-9]+', 'path' => '.*']); 

Route::get('lang/{id}', function($id) {
	$lang = App\Models\Languages::where('abbreviation', $id)->firstOrFail();

	Session::put('locale', $lang->abbreviation);

	return back();

})->where(['id' => '[a-z]+']);

// Sitemaps
Route::get('sitemaps.xml', function() {
 return response()->view('index.sitemaps')->header('Content-Type', 'application/xml');
});
Route::get('sitemap.xml', function() {
 return response()->view('index.sitemaps')->header('Content-Type', 'application/xml');
});

// Search Creators
Route::get('search/creators', [HomeController::class, 'searchCreator']);

// Explore Creators refresh
Route::post('refresh/creators', [HomeController::class, 'refreshCreators']);

Route::get('payment/paystack', [PaystackController::class, 'show'])->name('paystack'); 
Route::get('payment/ccbill', [CCBillController::class, 'show'])->name('ccbill');

// File Media
Route::get('file/media/{typeMedia}/{fileId}/{filename}', [UpdatesController::class, 'getFileMedia']);

Route::any('coinpayments/ipn', [AddFundsController::class, 'coinPaymentsIPN'])->name('coinpaymentsIPN');
Route::get('wallet/payment/success', [AddFundsController::class, 'paymentProcess'])->name('paymentProcess');

Route::get('media/storage/focus/{type}/{path}', [UpdatesController::class, 'imageFocus'])->where(['type' => '(video|photo|message)$', 'path' => '.*']);

Route::post('verify/2fa', [TwoFactorAuthController::class, 'verify']);
Route::post('2fa/resend',[TwoFactorAuthController::class, 'resend']);

Route::get('explore/creators/live',[HomeController::class, 'creatorsBroadcastingLive']);

Route::post('webhook/mollie', [AddFundsController::class, 'webhookMollie']); 

// PayPal Webhook
Route::post('webhook/paypal', [PayPalController::class, 'webhook']);

// Verify Transactions PayPal
Route::get('paypal/verify', [PayPalController::class, 'verifyTransaction'])->name('paypal.success');

// Insert Video Views
Route::post('video/views/{id}', [UpdatesController::class, 'videoViews']);

// Payku Notify
Route::post('webhook/payku', [AddFundsController::class, 'paykuNotify']);

// Public creator profiles
Route::get('{slug}', [UserController::class, 'profile'])->where('slug','[A-Za-z0-9\_-]+')->name('profile');
Route::get('{slug}/{media}', [UserController::class, 'profile'])->where('media', '(photos|videos|audio|shop|files)$')->name('profile');
Route::get('{slug}/post/{id}', [UserController::class, 'postDetail'])->where('slug','[A-Za-z0-9\_-]+')->name('profile');

//My Changes
Route::get('add/garments/content', [ProductsController::class, 'createGarmentsContent'])->middleware('auth');
Route::post('add/garments/content', [ProductsController::class, 'storeGarmentsContent'])->middleware('auth');
Route::get('add/video_calls/content',[ProductsController::class, 'createVideoContent'])->middleware('auth');
Route::post('add/video_calls/content', [ProductsController::class, 'storeVideoContent'])->middleware('auth');
Route::get('add/snapchat/content', [ProductsController::class, 'createSnapChatContent'])->middleware('auth');
Route::post('add/snapchat/content', [ProductsController::class, 'storeSnapChatContent'])->middleware('auth');
Route::get('check_video/{id}', [ProductsController::class, 'checkVideo'])->middleware('auth');
Route::post('post/views', [UpdatesController::class, 'storePostViews']);
//My changes End

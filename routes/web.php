<?php

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/facebook/login','FacebookController@loginView');
Route::get('/facebook/callback','FacebookController@callBack');
// Generate a login URL
//Route::get('/facebook/login', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
//{
//    // Send an array of permissions to request
//    $login_url = $fb->getLoginUrl(['email']);
//
//    // Obviously you'd do this in blade :)
//    echo '<a href="' . $login_url . '">Login with Facebook</a>';
//});

// Endpoint that is redirected to after an authentication attempt
//Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
//{
//    // Obtain an access token.
//    try {
//        $token = $fb->getAccessTokenFromRedirect();
//        //dump($token);
//    } catch (Facebook\Exceptions\FacebookSDKException $e) {
//        dd($e->getMessage());
//    }
//
//    // Access token will be null if the user denied the request
//    // or if someone just hit this URL outside of the OAuth flow.
//    if (! $token) {
//        // Get the redirect helper
//        $helper = $fb->getRedirectLoginHelper();
//
//        if (! $helper->getError()) {
//            abort(403, 'Unauthorized action.');
//        }
//
//        // User denied the request
//        dd(
//            $helper->getError(),
//            $helper->getErrorCode(),
//            $helper->getErrorReason(),
//            $helper->getErrorDescription()
//        );
//    }
//
//    if (! $token->isLongLived()) {
//        // OAuth 2.0 client handler
//        $oauth_client = $fb->getOAuth2Client();
//
//        // Extend the access token.
//        try {
//            $token = $oauth_client->getLongLivedAccessToken($token);
//            dump($token);
//        } catch (Facebook\Exceptions\FacebookSDKException $e) {
//            dd($e->getMessage());
//        }
//    }
//
//    $fb->setDefaultAccessToken($token);
//
//    // Save for later
//    Session::put('fb_user_access_token', (string) $token);
//
//    // Get basic info on the user from Facebook.
//    try {
//        $response = $fb->get('/me?fields=id,name,email');
//    } catch (Facebook\Exceptions\FacebookSDKException $e) {
//        dd($e->getMessage());
//    }
//
//    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
//    $facebook_user = $response->getGraphUser();
//    
//    
// 
//
//$userNode = $response->getGraphUser();dump($userNode);
//printf('Hello, %s!', $userNode->getName());
//    // Create the user if it does not exist or update the existing entry.
//    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
//   // $user = App\User::createOrUpdateGraphNode($facebook_user);
//
//    // Log the user into Laravel
//    //Auth::login($user);
//   try {
//       
//  $response = $fb->get('/me?fields=id,name,email', $token);
//  dump($response);
//  
//
//$graphNode = $response->getGraphNode();
//
//  //
//} catch(\Facebook\Exceptions\FacebookSDKException $e) {
//  dump($e->getMessage());
//}
//
//  $linkData = [
// 'url' => 'https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb',
// 'message' => 'message'
//];
//$pageAccessToken ='EAAV0FTkDnM4BAG8NEHkHzxIxrCUZCzuoLr3ZCUg78U2kZCkZC1yusD61ZCgP4tQoZBOekYgyjAOed4JmXoxTxHDeiTq1kVpCvYBYbqgFDEtmRpUBBNt92ZAhtvvr20ULQiXzo8OnTZCDzRmZArnD7cHBL9jUozkcjhnOOVrvXCizmPXokx0Gr1rPZAlZCZBO30ZAPLK8JzM4AFbkdLwZDZD';
//
//try {
// $response = $fb->post('/522235181447370/feed', $linkData, $pageAccessToken);
// dd($response);
//} catch(Facebook\Exceptions\FacebookResponseException $e) {
// echo 'Graph returned an error: '.$e->getMessage();
// exit;
//} catch(Facebook\Exceptions\FacebookSDKException $e) {
// echo 'Facebook SDK returned an error: '.$e->getMessage();
// exit;
//}  
//
//return redirect('/')->with('message', 'Successfully logged in with Facebook');
//});


Route::match(['get', 'post'], '/facebook/page-tab', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb) {
    try {
        $token = $fb->getPageTabHelper()->getAccessToken();
        //dump($token);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        // Failed to obtain access token
        dd($e->getMessage());
    }

    // $token will be null if the user hasn't authenticated your app yet
    if (! $token) {
        // . . .
    }
});
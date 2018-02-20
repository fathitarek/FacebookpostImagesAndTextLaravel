<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
//use  SammyK\LaravelFacebookSdk\LaravelFacebookSdk
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
class FacebookController extends Controller
{
public function __construct() {
    }
    public function getPageAccessToken($fb,$userAccessToken,$pageId) {
        $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken($userAccessToken);
      $fb->setDefaultAccessToken($longLivedToken);
      $response = $fb->sendRequest('GET', $pageId, ['fields' => 'access_token'])
          ->getDecodedBody();

      $pageAccessToken = $response['access_token'];
      return $pageAccessToken;
    }
    
    public function loginView(LaravelFacebookSdk $fb) {
       
        // Send an array of permissions to request
    $login_url = $fb->getLoginUrl(['email']);

    // Obviously you'd do this in blade :)
    echo '<a href="' . $login_url . '">Login with Facebook</a>';
    }
    public function callBack(LaravelFacebookSdk $fb) {
       // Obtain an access token.
    try {
        $token = $fb->getAccessTokenFromRedirect();
        //dump($token);
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Access token will be null if the user denied the request
    // or if someone just hit this URL outside of the OAuth flow.
    if (! $token) {
        // Get the redirect helper
        $helper = $fb->getRedirectLoginHelper();

        if (! $helper->getError()) {
            abort(403, 'Unauthorized action.');
        }

        // User denied the request
        dd(
            $helper->getError(),
            $helper->getErrorCode(),
            $helper->getErrorReason(),
            $helper->getErrorDescription()
        );
    }

    if (! $token->isLongLived()) {
        // OAuth 2.0 client handler
        $oauth_client = $fb->getOAuth2Client();

        // Extend the access token.
        try {
            $token = $oauth_client->getLongLivedAccessToken($token);
            dump($token);
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            dd($e->getMessage());
        }
    }

    $fb->setDefaultAccessToken($token);

    // Save for later
    \Session::put('fb_user_access_token', (string) $token);

    // Get basic info on the user from Facebook.
    try {
        $response = $fb->get('/me?fields=id,name,email');
    } catch (Facebook\Exceptions\FacebookSDKException $e) {
        dd($e->getMessage());
    }

    // Convert the response to a `Facebook/GraphNodes/GraphUser` collection
    $facebook_user = $response->getGraphUser();
    
    
 

$userNode = $response->getGraphUser();dump($userNode);
printf('Hello, %s!', $userNode->getName());
    // Create the user if it does not exist or update the existing entry.
    // This will only work if you've added the SyncableGraphNodeTrait to your User model.
   // $user = App\User::createOrUpdateGraphNode($facebook_user);

    // Log the user into Laravel
    //Auth::login($user);
   try {
       
  $response = $fb->get('/me?fields=id,name,email', $token);
  //dump($response);
  

$graphNode = $response->getGraphNode();

  //
} catch(\Facebook\Exceptions\FacebookSDKException $e) {
  dump($e->getMessage());
}
$images=array();

$pageAccessToken=$this->getPageAccessToken($fb,'EAAV0FTkDnM4BAJZAR2lIKFG1pZAQzniBvmtbTuk3TnMLV7MRhZCFXaZAhqk5i8AlqkOAz63RkkLsYh4a97wK0MOphHx4kh3K4fYoqTT5cdGptdBs3CJORkjuHBUNUxLh7EWezqHLhZBVEWFEssqPrEx0U3QfHJ7IZD','522235181447370');

$linkData = [
 'url' => ['https://newrelic.com/assets/pages/apm/php/php-elephant-logo-bd4f9d83be8c8563248fe4793f90bae7.png','https://newrelic.com/assets/pages/apm/php/php-elephant-logo-bd4f9d83be8c8563248fe4793f90bae7.png','https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?w=1260&h=750&auto=compress&cs=tinysrgb'],
 //'published'=>false
];
 
//dd(count($linkData['url']));
for ($i=0;$i<count($linkData['url']);$i++){
    $img=['url' => $linkData['url'][$i],'published'=>false];
    
     $response = $fb->post('/522235181447370/photos',$img, $pageAccessToken);
     
     var_dump($response->getGraphUser()->getId());
array_push($images,$response->getGraphUser()->getId());
    // exit();
}
print_r(count($images));
 $Data = [
 //'attached_media[0]' => "{'media_fbid':'$images[0]'}" ,
//'attached_media[1]' => "{'media_fbid':'$images[1]'}" ,
  'message' => 'TEST poST',
 //'published'=>true
];
for ($i=0;$i<count($images);$i++){
    array_push($Data, $Data["attached_media[".$i."]"] = "{'media_fbid':'$images[$i]'}"); 
}
//dd($Data);
//exit();
// $Data = [
// 'attached_media[0]' => "{'media_fbid':'$images[0]'}" ,
//'attached_media[1]' => "{'media_fbid':'$images[1]'}" ,
//  'message' => 'message44',
// //'published'=>true
//];
//dd($Data);
 
      //$response = $fb->post('/522235181447370/feeds',$img, $pageAccessToken);

//exit();
//$pageAccessToken ='EAAV0FTkDnM4BAG8NEHkHzxIxrCUZCzuoLr3ZCUg78U2kZCkZC1yusD61ZCgP4tQoZBOekYgyjAOed4JmXoxTxHDeiTq1kVpCvYBYbqgFDEtmRpUBBNt92ZAhtvvr20ULQiXzo8OnTZCDzRmZArnD7cHBL9jUozkcjhnOOVrvXCizmPXokx0Gr1rPZAlZCZBO30ZAPLK8JzM4AFbkdLwZDZD';
 //$pageAccessToken = $fb->getOAuth2Client()->getLongLivedAccessToken('EAAV0FTkDnM4BAJZAR2lIKFG1pZAQzniBvmtbTuk3TnMLV7MRhZCFXaZAhqk5i8AlqkOAz63RkkLsYh4a97wK0MOphHx4kh3K4fYoqTT5cdGptdBs3CJORkjuHBUNUxLh7EWezqHLhZBVEWFEssqPrEx0U3QfHJ7IZD'); //TODO  change
//       $longLivedToken = $fb->getOAuth2Client()->getLongLivedAccessToken('EAAV0FTkDnM4BAJZAR2lIKFG1pZAQzniBvmtbTuk3TnMLV7MRhZCFXaZAhqk5i8AlqkOAz63RkkLsYh4a97wK0MOphHx4kh3K4fYoqTT5cdGptdBs3CJORkjuHBUNUxLh7EWezqHLhZBVEWFEssqPrEx0U3QfHJ7IZD'); //TODO  change
//      $fb->setDefaultAccessToken($longLivedToken);
//      $response = $fb->sendRequest('GET', '522235181447370', ['fields' => 'access_token'])
//          ->getDecodedBody();
//
//      $pageAccessToken = $response['access_token'];
//$pageAccessToken=$this->getPageAccessToken($fb,'EAAV0FTkDnM4BAJZAR2lIKFG1pZAQzniBvmtbTuk3TnMLV7MRhZCFXaZAhqk5i8AlqkOAz63RkkLsYh4a97wK0MOphHx4kh3K4fYoqTT5cdGptdBs3CJORkjuHBUNUxLh7EWezqHLhZBVEWFEssqPrEx0U3QfHJ7IZD','522235181447370');
 // dump($pageAccessToken);
try {
 $response = $fb->post('/522235181447370/feed', $Data, $pageAccessToken);
 //dd($response);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 echo 'Graph returned an error: '.$e->getMessage();
 exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 echo 'Facebook SDK returned an error: '.$e->getMessage();
 exit;
}  

return redirect('/')->with('message', 'Successfully logged in with Facebook');  
    } 
    
    
    
//    Route::get('/facebook/callback', function(SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb)
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

}

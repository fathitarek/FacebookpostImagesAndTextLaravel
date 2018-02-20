<?php

return [
    /*
     * In order to integrate the Facebook SDK into your site,
     * you'll need to create an app on Facebook and enter the
     * app's ID and secret here.
     *
     * Add an app: https://developers.facebook.com/apps
     *
     * You can add additional config options here that are
     * available on the main Facebook\Facebook super service.
     *
     * https://developers.facebook.com/docs/php/Facebook/5.0.0#config
     *
     * Using environment variables is the recommended way of
     * storing your app ID and app secret. Make sure to update
     * your /.env file with your app ID and secret.
     */
    'facebook_config' => [
        'app_id' => env('FACEBOOK_APP_ID'),
        'app_secret' => env('FACEBOOK_APP_SECRET'),
        'default_graph_version' => 'v2.10',
        //'enable_beta_mode' => true,
        //'http_client_handler' => 'guzzle',
    ],

    /*
     * The default list of permissions that are
     * requested when authenticating a new user with your app.
     * The fewer, the better! Leaving this empty is the best.
     * You can overwrite this when creating the login link.
     *
     * Example:
     *
     * 'default_scope' => ['email', 'user_birthday'],
     *
     * For a full list of permissions see:
     *
     * https://developers.facebook.com/docs/facebook-login/permissions
     */
     'default_scope' => ['manage_pages','publish_pages','id','about','age_range','birthday','can_review_measurement_request','email','first_name'
         ,'install_type','is_shared_login','is_verified','last_name','link','locale','location','meeting_for','middle_name','name'
         ,'name_format','payment_pricepoints','political','public_key','quotes','relationship_status','religion','security_settings'
         ,'shared_login_upgrade_required_by','short_name','significant_other','sports','test_group','third_party_id','timezone'
         ,'updated_time','verified','video_upload_limits','viewer_can_send_gift','website','work'],


    /*
     * The default endpoint that Facebook will redirect to after
     * an authentication attempt.
     */
    'default_redirect_uri' => '/facebook/callback',
    ];

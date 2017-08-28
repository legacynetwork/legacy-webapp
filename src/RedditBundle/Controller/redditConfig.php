<?php

namespace RedditBundle\Controller;

class redditConfig{
    //standard, oauth token fetch, and api request endpoints
    static $ENDPOINT_STANDARD = 'http://www.reddit.com';
    static $ENDPOINT_OAUTH = 'https://oauth.reddit.com';
    static $ENDPOINT_OAUTH_AUTHORIZE = 'https://www.reddit.com/api/v1/authorize';
    static $ENDPOINT_OAUTH_TOKEN = 'https://www.reddit.com/api/v1/access_token';
    static $ENDPOINT_OAUTH_REDIRECT = 'http://localhost/legacy/web/app_dev.php/reddit/api/redirect';
    
    //access token configuration from https://ssl.reddit.com/prefs/apps
    static $CLIENT_ID = '2YB5ajSBWl-SlA';
    static $CLIENT_SECRET = 'xfyDp7fguGj3pdSD3CTF7po15-k';
    
    //access token request scopes
    //full list at http://www.reddit.com/dev/api/oauth
    static $SCOPES = 'read';
}
?>

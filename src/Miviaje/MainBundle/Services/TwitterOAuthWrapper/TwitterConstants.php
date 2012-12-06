<?php

namespace Miviaje\MainBundle\Services\TwitterOAuthWrapper;

/**
 * Determines constants globally used in the project
 */
class TwitterConstants
{
    //const CONSUMER_KEY = 'JXbe9rynKIFCbkdces2w'; // mine
    //const CONSUMER_SECRET = 'ZveC7qco96ho79YzsJBxtGDwl1vuXObsFohKW9lmCs'; //mine
    
  	const CONSUMER_KEY = 'oQSdOje16zt410BcBy0PQ';
	const CONSUMER_SECRET = 'h7mqLTkBUt0gJhUawB9b5ZMyeBPauMoP7lDC4Plr8PI';

    const REQUEST_TOKEN_URL = 'https://api.twitter.com/oauth/request_token';

    const AUTHORIZE_URL = 'https://api.twitter.com/oauth/authorize';

    const ACCESS_TOKEN_URL = 'https://api.twitter.com/oauth/access_token';
}

// Consumer key    misV9mK5rdJXF8LVlc06A
// Consumer secret AAqohKbOIosO9UIWwwEzD5W8uc9JFn1Y299QG3ctng
// Request token URL   https://api.twitter.com/oauth/request_token
// Authorize URL   https://api.twitter.com/oauth/authorize
// Access token URL    https://api.twitter.com/oauth/access_token
// Callback URL    http://www.miviaje.com/home
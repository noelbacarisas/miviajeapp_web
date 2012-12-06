<?php

namespace MiViaje\MainBundle\Services;

//use Miviaje\MainBundle\Entity\TwitterUser;
use Miviaje\MainBundle\Services\TwitterOAuthWrappe\tmhOAuth;

/**
 * Serves as service class for User
 */
class OAuthService
{
	// private $tmhOAuth = null;

	// /**
	//  * Intantiates the service class
	//  *	 
	//  */
	// public function __construct(tmhOAuth $tmhOAuth)
	// {
	// 	$this->tmhOAuth = $tmhOAuth;
	// }

	/**
	 *
	 */
	public function connectToTwitter()
	{		
        $tmhOAuth = $_SESSION['twitter_oauth'];

        $tmhOAuth->config['user_token']  = $_SESSION['oauth']['oauth_token'];
        $tmhOAuth->config['user_secret'] = $_SESSION['oauth']['oauth_token_secret'];               

        return $tmhOAuth->request(
            'POST',
            $tmhOAuth->url('oauth/access_token', ''),
            array(
              'oauth_verifier' => $_REQUEST['oauth_verifier']
            )
        );      
	}

	/**
	 *
	 */
	public function requestForCredentials()
	{
		$tmhOAuth = $_SESSION['twitter_oauth'];

		$_SESSION['access_token'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);                    
        $tmhOAuth->config['user_token']  = $_SESSION['access_token']['oauth_token'];
        $tmhOAuth->config['user_secret'] = $_SESSION['access_token']['oauth_token_secret'];
                 
        return $tmhOAuth->request(
            'GET',
            $tmhOAuth->url('1/account/verify_credentials')
        );
	}

}
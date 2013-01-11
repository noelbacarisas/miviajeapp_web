<?php

namespace Miviaje\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Miviaje\MainBundle\Services\TwitterOAuthWrapper\TwitterConstants;
use Miviaje\MainBundle\Services\TwitterOAuthWrapper\tmhUtilities;
use Miviaje\MainBundle\Services\TwitterOAuthWrapper\tmhOAuth;


class LoginController extends Controller
{
    public function loginAction()
    {
        return $this->render('MiviajeMainBundle:Login:login.html.twig');
    }
	
	public function authenticateAction()
    {
        $tmhOAuth = new tmhOAuth(array(
          'consumer_key'    => TwitterConstants::CONSUMER_KEY,
          'consumer_secret' => TwitterConstants::CONSUMER_SECRET,
        ));

        $responseStatus = $tmhOAuth->request('POST', $tmhOAuth->url('oauth/request_token', ''), array(
            'oauth_callback' => $this->get('router')->generate('authorize', array(), true)//$this->get('miviaje_service.tmhUtilities')->php_self()
        ));
		
        if ($responseStatus == 200) {            
            $_SESSION['oauth'] = $tmhOAuth->extract_params($tmhOAuth->response['response']);                
            $_SESSION['twitter_oauth'] = $tmhOAuth;

            $authurl = $tmhOAuth->url("oauth/authorize", '') .  "?oauth_token={$_SESSION['oauth']['oauth_token']}";

            return $this->redirect($authurl);
        } 
        else {
            die('Something wrong happened.');;
        }

    }
	
	public function authorizeAction()
    {                

        if(!empty($_SESSION['oauth']['oauth_token']) && !empty($_SESSION['oauth']['oauth_token_secret'])) {
            if (!empty($_GET['oauth_verifier'])) {
                $oAuthService = $this->get('miviaje_service.oAuth');

                $response = $oAuthService->connectToTwitter();

                if ($response == 200) {
                    unset($_SESSION['oauth']);                    
                    $response = $oAuthService->requestForCredentials();                    

                    if ($response == 200) {   
                        $tmhOAuth = $_SESSION['twitter_oauth'];        
                        $response = json_decode($tmhOAuth->response['response']);
                       
                        $params = array(
                            'name'     => $response->name,
                            'scrnName' => $response->screen_name,
                            'id'       => $response->id
                        );
							
                        //$user = $this->get('miviaje_service.user')->verifyUser($params);

                        //if ($user) {
                            //$user->setProfilePhotoUrl($response->profile_image_url);
                           // $this->get('security.context')->setToken(new UsernamePasswordToken($params, '', 'main', array('ROLE_MEMBER')));
                           // $this->get('session')->set('user', $this->get('security.context')->getToken()->getUser());
                            return $this->redirect($this->generateUrl('home'));  
                        //}
                    } 
                   
                    return $this->redirect($this->generateUrl('login'));                                            
                }   
                else {
                    die('an error occured!');
                }      
            }                  
        }

        return $this->redirect($this->generateUrl('home'));
    }
	
	
}

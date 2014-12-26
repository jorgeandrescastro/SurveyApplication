<?php
define('FACEBOOK_SDK_V4_SRC_DIR', '/../../library/facebook-php-sdk-v4-4.0-dev/src/Facebook/');
require __DIR__ . '/../../library/facebook-php-sdk-v4-4.0-dev/autoload.php';

require_once( 'Facebook/FacebookSession.php' );

use Facebook\HttpClients\FacebookHttpable;
use Facebook\HttpClients\FacebookCurl;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\Entities\AccessToken;
use Facebook\Entities\SignedRequest;
use Facebook\FacebookSession;
use Facebook\FacebookSignedRequestFromInputHelper;
use Facebook\FacebookCanvasLoginHelper;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookOtherException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\GraphUser;
use Facebook\GraphSessionInfo;

/**
 * Class to handle the facebook integration with the SDK v4.4.0
 * @author Jorge Andres Castro (jorge.castro@linkstaria.com)
 *
 */
class Application_Model_FB 
{
    
    /**
     * API Id of the FB app
     * @var string
     */
    protected $_apiId;
    
    /**
     * API Secret of the FB app
     * @var unknown
     */
    protected $_apiSecret;
    
    /**
     * API Namespace of the FB app
     * @var unknown
     */
    protected $_apiNamespace;
    
    /**
     * Constructor of the FB class
     * @return Application_Model_FB
     * 
     */
    public function __construct() 
    {
        $config = Zend_Controller_Front::getInstance()->getParam('bootstrap');
        $fbParams = $config->getOption('fb');
        
        $this->_apiId = $fbParams['params']['app_id'];
        $this->_apiSecret = $fbParams['params']['app_secret'];
        $this->_apiNamespace = $fbParams['params']['app_namespace'];
    }
    
    private function authenticate()
    {
        FacebookSession::setDefaultApplication($this->_apiId, $this->_apiSecret);
        
        $helper = new FacebookCanvasLoginHelper();
        try {
            $session = $helper->getSession();
        } catch (FacebookRequestException $ex) {
            echo $ex->getMessage();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
        
        if($session) {
            try {
                $request = new FacebookRequest($session, 'GET', '/me');
                $response = $request->execute();
                $me = $response->getGraphObject();
                
                echo $me->getProperty('name');
            }catch(FacebookRequestException $e) {
        		echo $e->getMessage();
        	}
        } else {
            $helper = new FacebookRedirectLoginHelper("https://apps.facebook.com/$this->_apiNamespace/");
            $auth_url = $helper->getLoginUrl(array('email', 'publish_actions'));
            echo "<script>window.top.location.href='".$auth_url."'</script>";
        }
    }
    
    public function getProfileInformation()
    {
        $this->authenticate();
    }
}
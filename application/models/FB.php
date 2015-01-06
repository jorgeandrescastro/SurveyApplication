<?php
session_start();
define('FACEBOOK_SDK_V4_SRC_DIR', '../library/facebook-php-sdk-v4-4.0-dev/src/Facebook/');
require __DIR__ . '/../../library/facebook-php-sdk-v4-4.0-dev/autoload.php';


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
     * FB permissions to be asked to the user
     * @var array
     */
    protected $_permissions = array('public_profile', 'user_about_me', 
                                    'user_education_history', 'user_hometown',
                                    'user_work_history', 'user_birthday');   
    
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
                $me = $response->getGraphObject()->asArray();
                print_r($me);die();
                
                return $me;
            }catch(FacebookRequestException $e) {
        		echo $e->getMessage();
        	}
        } else {
            $helper = new FacebookRedirectLoginHelper("https://apps.facebook.com/$this->_apiNamespace/");
            $auth_url = $helper->getLoginUrl($this->_permissions);
            echo "<script>window.top.location.href='".$auth_url."'</script>";
        }
    }
    
    public function getProfileInformation()
    {
        $me = $this->authenticate();
        $hometown = $me->getPropertyAsArray('hometown');
        print_r($hometown);
        print_r('/');
        print_r($hometown->getName());
        print_r("-----------");
        print_r($me->getProperty('work'));
        die();
        
        
        $date1=date_create($me->getProperty('birthday'));
        $date2=date_create();
        $diff=date_diff($date2,$date1);        
        
        $userInfo = array('id' => $me->getProperty('id'),
                          'name' => $me->getProperty('name'),
                          'firstName' => $me->getProperty('first_name'),
                          'age' => $diff->y,
                          'gender' => ($me->getProperty('first_name') == 'male') ?
                                        'Masculino' : 'Femenino',
        );
        
        return $userInfo;
    }
}
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
require_once 'include/cryptojs-aes.php'; 
/*
 * Changes:
 * 1. This project contains .htaccess file for windows machine.
 *    Please update as per your requirements.
 *    Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva
 *
 * 2. Change 'encryption_key' in application\config\config.php
 *    Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/
 * 
 * 3. Change 'jwt_key' in application\config\jwt.php
 *
 */

class Seribu extends Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function token_get()
    {
        $tokenData = array();
        $tokenData['data'] = array('user_id'=>'1','date'=>date('Y-m-d H:i:s')); //TODO: Replace with data for token
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $this->set_response($output, REST_Controller::HTTP_OK);
    }
	
	
	public function login_post()
    {
		 $key = pack("H*", "0123456789abcdef0149014900abcdef");
		 $iv =  pack("H*", "abcdef1490149028abcdef9876543210");

		    $encrypted = base64_decode($_POST["password"]);
			$shown = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv);
			 
        $tokenData = array();
		$username = $this->input->post('username');
		$password = $shown;
		$fcm = $this->input->post('fcm');
		$user = AUTHORIZATION::hash_password_db($username, $password);
		if($user){
			 
			
			
			$tokenData['data'] = array('parent_id'=> $user->travel_id,'user_id'=>$user->id,'group'=>$user->group_id,'parent'=>$user->parent_id,'date'=>date('Y-m-d H:i:s')); //TODO: Replace with data for token
			if(!empty($fcm)){
					$this->db->where('id',$user->id);
					$this->db->update('users',array('fcm'=>$fcm));
					$tokenData['data']['fcm'] = $fcm ; 
				}
				
				$output['status'] = 'ok';
				$output['token']  = AUTHORIZATION::generateToken($tokenData);
				 
				
				$output['data'] = $user; 
				
				
				
				
				$this->set_response($output, REST_Controller::HTTP_OK);
		}else{
			$output['status'] = 'error';
			$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		}
       
    }

    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: POST
     * Header Key: Authorization
     * Value: Auth token generated in GET call
     */
    public function token_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	function user_get()
    {
		 
		    // $query = $this->db->get('users')->result();
         //$this->set_response($query);
            //$this->response(array('error' => 'User could not be found'), 404);
         
    }
}
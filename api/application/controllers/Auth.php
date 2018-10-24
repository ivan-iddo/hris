<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require APPPATH . '/libraries/REST_Controller.php';
require_once 'include/cryptojs-aes.php';
require_once 'Monitoring.php'; 
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);
 
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

class Auth extends REST_Controller
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
		 $this->load->model('System_auth_model');
		 
		 $key = pack("H*", "0123456789abcdef0149014900abcdef");
		 $iv =  pack("H*", "abcdef1490149028abcdef9876543210");

		    
			 
        $tokenData = array();  
		
		 
		 
        $_username       = addslashes(trim(htmlspecialchars ($_POST['username'])));	                
	    $_pass           = addslashes(trim($_POST['password']));
		 
	    
        $auth            = $this->System_auth_model->loginCheck($_username,$_pass);
            
	    if($auth){
		 $tokenData['data'] = $auth;
         $output['userid'] = $auth['id'];
         $output['group'] = $auth['_pnc_id_grup'];
         
         
		 $output['token']  = AUTHORIZATION::generateToken($tokenData);
		  $output['status'] = 'success';
		 $this->set_response($output, REST_Controller::HTTP_OK);
	    }else{
		 $output['status'] = 'error';
			$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	    }
		 
        

       
       
    }
	
public function coba_get(){
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

public function getug_get(){
	$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->set_response(array('id_uk'=>$decodedToken->data->id_uk,'group'=>$decodedToken->data->_pnc_id_grup,'user_id'=>$decodedToken->data->id), REST_Controller::HTTP_OK);
				
				
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function menu_get(){
	 $this->load->model('System_auth_model');
	$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
               
				//$json = json_encode($decodedToken); 
				$menu = $this->System_auth_model->tree("modul",$decodedToken->data->_pnc_id_aplikasi,$decodedToken->data->_pnc_id_grup,'');
				 
				  $arrs = array();
				  
				 $nom=0;
				foreach($menu as $rs) {
					$arr=array();
						//parent
						//$arr[]=array('modul'=>$rs->modul);
						
						//echo "<item id=\"modul".$rs->id_modul."\" text=\"".ucwords($rs->modul)."\">"; 
						
						$tree_menu=$this->System_auth_model->tree("menu",$decodedToken->data->_pnc_id_aplikasi,$decodedToken->data->_pnc_id_grup,$rs->id_modul);
						if(!empty($tree_menu)){
							
							$no=0;
							//$arr = array();
						foreach($tree_menu as $rs2) {
							//Child
							$arr[]=array('nama_menu'=>$rs2->menu,'url'=>$rs2->url,'id_modul'=>$rs->id_modul);
							++$no;
							//echo "<item id=\"".$rs2->controller."\" text=\"".ucwords($rs2->menu)."\"/>";
						}
						$arrs[]=array('nama'=>$rs->modul,'data'=>$arr);
						}
						
							++$nom;
						// $arrs['status']='success';
		    }
			$this->set_response($arrs, REST_Controller::HTTP_OK);
			
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
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
		 
		     //$query = $this->db->get('users')->result();
         //$this->set_response($query);
            //$this->response(array('error' => 'User could not be found'), 404);
         
    }
}
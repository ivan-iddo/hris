<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");

//$method = $this->input->request_headers()['REQUEST_METHOD']; if($method == "OPTIONS") { die(); } 
//defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

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

class Appdata extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	public function login_post()
    {  
		$this->load->model('system_auth_model');
		 
		 $key = pack("H*", "0123456789abcdef0149014900abcdef");
		 $iv =  pack("H*", "abcdef1490149028abcdef9876543210"); 
        $tokenData = array();  
		
	    $_username       = addslashes(trim(htmlspecialchars ($this->input->post('username'))));	                
	    $_pass           = addslashes(trim($this->input->post('password')));
		 
	    
        $auth            = $this->system_auth_model->loginCheck($_username,$_pass);
           
	    if($auth){
		$output['status']='sukses';
		 $output['result'] = $tokenData['data'] = $auth;
		 $output['token']  = AUTHORIZATION::generateToken($tokenData);
		 $this->set_response($output, REST_Controller::HTTP_OK);
	    }else{
		 $output['status'] = 'error';
			$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	    }
		 
        

       
       
    }
	
	function listpenumpang_get()
    {
		  
		 
		 
        $token = $_GET['Authorization'];//'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImRlcm1hZ2EiOiJLYWxpIEFkZW0iLCJ1c2VyX2lkIjoiNCIsImdyb3VwIjoiMyIsInBhcmVudCI6IjAiLCJkYXRlIjoiMjAxNy0wOC0yMSAwMzo1OTo0NSJ9fQ .Fur8CY6UT5wYjiTHE_z2ZaaMhq6PlNA-TdqspVBreYM';
		$headers['Authorization'] = $token;
		
		
		
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken(($headers['Authorization']));
			
            if ($decodedToken != false) {
				$datatoken['data'] = array('dermaga'=> $decodedToken->data->dermaga,'user_id'=>$decodedToken->data->user_id,'tgl'=>date('d-m-Y H:i:s') );
				$data['token']  = AUTHORIZATION::generateToken($datatoken);
				$perpage = 10;
				
				
				if(!$this->uri->segment(3)){
						$this->db->limit($perpage);
						$data['next'] = 2;
						$data['prev'] = 0;
				 }else{
					$paging = $this->uri->segment(3)*$perpage;
					$start = $paging - $perpage;
					$this->db->limit($start,$paging);
						$data['next'] = $this->uri->segment(3)+1;
						
						if($data['next'] == 3){
							$data['prev'] = 0;
						}else{
							$data['prev'] = $this->uri->segment(3)-1;
						}
						
				 }
				 
				  //  $data['total'] = $this->db->count_all_results('default_appdata');
			
					$this->db->select(' default_appdata.*,(SUM(default_appdata_detail.mancanegara)+sum(default_appdata_detail.lokal)) Total');
					$this->db->join('default_appdata_detail','default_appdata.id = default_appdata_detail.appdata_id','LEFT');
					$this->db->where('default_appdata.title',str_replace('%20',' ',$decodedToken->data->dermaga));
					$this->db->group_by('default_appdata.id'); 
					$this->db->order_by('default_appdata.id','DESC');
					$data['penumpang'] = $this->db->get('default_appdata')->result();
		
					/*$this->db->order_by('datecreated','DESC');
					$this->db->where('title',str_replace('%20',' ',$decodedToken->data->dermaga));
					$data['penumpang'] = $this->db->get('default_appdata')->result();*/
					
					if(empty($data['penumpang'])){
						$data['next'] = 0;
						$data['prev'] = 0;
					}
					
                $this->set_response($data, REST_Controller::HTTP_OK);
                return;
            }
        }else{
			$data['status'] = 'error';
			$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		}
		
		
	

       
		 
		 
            //$this->response(array('error' => 'User could not be found'), 404);
         
    }
	
	function checkToken($token){
		 if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken(($headers['Authorization']));
			
            if ($decodedToken != false) {
				$datatoken['data'] = array('dermaga'=> $decodedToken->data->dermaga,'user_id'=>$decodedToken->data->user_id,'tgl'=>date('d-m-Y H:i:s') );
				$data['token']  = AUTHORIZATION::generateToken($datatoken);
				$data['dermaga'] =  $decodedToken->data->dermaga;
				$data['user_id'] = $decodedToken->data->user_id;
				return $data ;
					 
            }
        }else{
			return false;
		}
	}
	
	function insertKapal_post()
    {
		  $token = $_POST['Authorization'];//'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImRlcm1hZ2EiOiJLYWxpIEFkZW0iLCJ1c2VyX2lkIjoiNCIsImdyb3VwIjoiMyIsInBhcmVudCI6IjAiLCJkYXRlIjoiMjAxNy0wOC0yMSAwMzo1OTo0NSJ9fQ .Fur8CY6UT5wYjiTHE_z2ZaaMhq6PlNA-TdqspVBreYM';
		  $headers['Authorization'] = $token;
		  
		 
		  if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken(($headers['Authorization']));
			
            if ($decodedToken != false) {
				$datatoken['data'] = array('dermaga'=> $decodedToken->data->dermaga,'user_id'=>$decodedToken->data->user_id,'tgl'=>date('d-m-Y H:i:s') );
				$data['token']  = AUTHORIZATION::generateToken($datatoken);
				$data['dermaga'] =  $decodedToken->data->dermaga;
				$data['user_id'] = $decodedToken->data->user_id;
				 
					 
            }
			
			if(!$this->input->post('tgl-berangkat')){
				$data['sukses'] = false;
				$data['error'] = 'Field tanggal masih kosong';
				$this->set_response($data, REST_Controller::HTTP_OK);
				 return; 
			}
			
			$total = 0;
			foreach($_POST['kapal'] as $datkapal => $valkapal){
				 
					$total = $total + ($valkapal['mancanegara']+$valkapal['nusantara']);
				}
				
				 
			if($_POST['totalm'] <> $total){
				$data['error'] = 'Jumlah Total Manual tidak sama dengan yang anda masukkan';
				$this->set_response($data, REST_Controller::HTTP_OK);
				return;
			}
			
			if(empty($_POST['totalm'])){
				$data['error'] = 'Jumlah Total Manual tidak sama dengan yang anda masukkan';
				$this->set_response($data, REST_Controller::HTTP_OK);
				return;
			}
			
		   $this->db->insert('default_appdata',array(
				'title'				=> $data['dermaga'], 
				'status'			=> 'live',
				'created_on'		=> $this->input->post('tgl-berangkat'),
				'jam'		=> $this->input->post('jam-berangkat'),
				'datecreated' => $this->input->post('tgl-berangkat').' '.$this->input->post('jam-berangkat'),
				'author_id'			=> $data['user_id'],
				'json_data' 		=> serialize($_POST)
			));
		    
			$id = $this->db->insert_id();

			if ($id)
			{
				$query = 'INSERT INTO default_appdata_detail VALUES '; 
				foreach($_POST['kapal'] as $datkapal => $valkapal){
					$valkapal = array_map(function($item) { return $item ?: 0; }, $valkapal); 
					$query .= "(NULL,'".$id."','$datkapal','1','".$this->input->post('tgl-berangkat')."',".$data['user_id'].",'0','".$valkapal['mancanegara']."','".$valkapal['nusantara']."','".$valkapal['laki']."','".$valkapal['perempuan']."'),";
					
				}
				   $execquery =  substr($query,0,-1);
					 $this->db->query($execquery);
					  
				 
			}
			$data['sukses'] = true;
			$this->set_response($data, REST_Controller::HTTP_OK);
		 }
		//$this->set_response($data, REST_Controller::HTTP_OK);
	}
	
	function editKapal_post()
    {
		  $token = $_POST['Authorization'];//'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImRlcm1hZ2EiOiJLYWxpIEFkZW0iLCJ1c2VyX2lkIjoiNCIsImdyb3VwIjoiMyIsInBhcmVudCI6IjAiLCJkYXRlIjoiMjAxNy0wOC0yMSAwMzo1OTo0NSJ9fQ .Fur8CY6UT5wYjiTHE_z2ZaaMhq6PlNA-TdqspVBreYM';
		  $headers['Authorization'] = $token;
		  $pid =  $_POST['pid'];
		 
		  if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken(($headers['Authorization']));
			
            if ($decodedToken != false) {
				$datatoken['data'] = array('dermaga'=> $decodedToken->data->dermaga,'user_id'=>$decodedToken->data->user_id,'tgl'=>date('d-m-Y H:i:s') );
				$data['token']  = AUTHORIZATION::generateToken($datatoken);
				$data['dermaga'] =  $decodedToken->data->dermaga;
				$data['user_id'] = $decodedToken->data->user_id;
				 
					 
            }
			
			if((!$this->input->post('tgl-berangkat')) OR (!$this->input->post('pid'))){
				$data['sukses'] = false;
				$this->set_response($data, REST_Controller::HTTP_OK);
				 return; 
			}
			
			$this->db->where('id',$pid);
		   $this->db->update('default_appdata',array(
				 
				'created_on'		=> $this->input->post('tgl-berangkat'),
				'jam'		=> $this->input->post('jam-berangkat')
				 
			));
		    
		 

			 
				 
				foreach($_POST['kapal'] as $datkapal => $valkapal){
					$valkapal = array_map(function($item) { return $item ?: 0; }, $valkapal);
					
					$update_arr = array('tgl'=>$this->input->post('tgl-berangkat'),'lokal'=>$valkapal['nusantara'],'mancanegara'=>$valkapal['mancanegara'],'laki'=>$valkapal['laki'],'perempuan'=>$valkapal['perempuan']);
					
					$this->db->where('id',$datkapal);
		   $this->db->update('default_appdata_detail',$update_arr);
					
					//$query .= "(NULL,'".$id."','$datkapal','1','".$this->input->post('tgl-berangkat')."',".$data['user_id'].",'0','".$valkapal['mancanegara']."','".$valkapal['nusantara']."','".$valkapal['laki']."','".$valkapal['perempuan']."'),";
					
				}
				   
					  
				 
			 
			$data['sukses'] = true;
			$this->set_response($data, REST_Controller::HTTP_OK);
		 }
		//$this->set_response($data, REST_Controller::HTTP_OK);
	}
	
	function detailkapal_get()
    {
		  
		 
		 
        $token = $_GET['Authorization'];//'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJkYXRhIjp7ImRlcm1hZ2EiOiJLYWxpIEFkZW0iLCJ1c2VyX2lkIjoiNCIsImdyb3VwIjoiMyIsInBhcmVudCI6IjAiLCJkYXRlIjoiMjAxNy0wOC0yMSAwMzo1OTo0NSJ9fQ .Fur8CY6UT5wYjiTHE_z2ZaaMhq6PlNA-TdqspVBreYM';
		$headers['Authorization'] = $token;
		
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken(($headers['Authorization']));
			
            if ($decodedToken != false) {
				$datatoken['data'] = array('dermaga'=> $decodedToken->data->dermaga,'user_id'=>$decodedToken->data->user_id,'tgl'=>date('d-m-Y H:i:s') );
				$data['token']  = AUTHORIZATION::generateToken($datatoken);
				
				 
					$this->db->select('default_appdata_detail.*,default_appdata_object.nama,default_appdata_object.tujuan,default_appdata.created_on,default_appdata.jam');
					$this->db->order_by('default_appdata_object.nama','ASC');
					$this->db->where('appdata_id', $this->data($_GET['id']));
					$this->db->join('default_appdata','default_appdata_detail.appdata_id = default_appdata.id');
					$this->db->join('default_appdata_object','default_appdata_detail.object_id = default_appdata_object.id');
					$data['kapal'] = $this->db->get('default_appdata_detail')->result();
					
                $this->set_response($data, REST_Controller::HTTP_OK);
                return;
            }
        }else{
			$data['status'] = 'error';
			$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		}
		 
            //$this->response(array('error' => 'User could not be found'), 404);
         
    }
	
	function data($data){
	     $data = trim(htmlentities(strip_tags($data)));
	     return  (stripslashes($data));
	}
}
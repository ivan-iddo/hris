<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require APPPATH . '/libraries/REST_Controller.php'; 
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

class Pelatihan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
  function savepelatihan_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array(
				   'id_user'=>($this->input->post('id_user'))?$this->input->post('id_user'):null,
				   'pen_name'=>($this->input->post('txtNamaSekolah'))?$this->input->post('txtNamaSekolah'):null, 
				   'pen_tahn'=>($this->input->post('txtTahunLulus'))?$this->input->post('txtTahunLulus'):null,
				   'pen_nijz'=>($this->input->post('txtNoIjazah'))?$this->input->post('txtNoIjazah'):null,
				   'pen_dijz'=>($this->input->post('txtTglIjazah'))?$this->input->post('txtTglIjazah'):null,
				   'pen_nkep'=>($this->input->post('txtKepalaSekolah'))?$this->input->post('txtKepalaSekolah'):null,
				   'pen_desc'=>($this->input->post('txtStatusLulus'))?$this->input->post('txtStatusLulus'):null,
				   'pen_lijzh'=>($this->input->post('txtHubungan'))?$this->input->post('txtHubungan'):null,
				   'pen_code' => ($this->input->post('txtJPend'))?$this->input->post('txtJPend'):null,
				   );
			  
			  $this->db->insert('his_pelatihan',$arrdata);
			  $saved_id = $this->db->insert_id('his_pelatihanid_seq');
			  
			   if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['id']=$saved_id;
					$arr['message']='Data berhasil ditambah!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
			  
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function listpelatihan_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		$this->db->select('his_pelatihan.*,m_pelatihan.nama as namaPendidikan,m_status_lulus.nama as status'); 
		$this->db->join('m_status_lulus','m_status_lulus.id = his_pelatihan.pen_desc','LEFT');
		$this->db->join('m_pelatihan','m_pelatihan.id = his_pelatihan.pen_code','LEFT'); 
		$this->db->where('his_pelatihan.tampilkan','1');
		if(!empty($id = $this->uri->segment(3))){
					$this->db->where('his_pelatihan.id_user',$id);
				}
		  $res = $this->db->get('his_pelatihan')->result();
		  foreach($res as $d){
			$arr[]=array('id'=>$d->id,
					   'nama_sekolah'=> $d->	pen_name,
					   'jenjang'=> $d->namaPendidikan,
					   'tahun'=> $d->pen_tahn,
					   'no_ijazah'=> $d->pen_nijz,
					   'tgl_ijazah'=> $d->pen_dijz,
					   'pen_nkep' => $d->pen_nkep
					   );
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function editpelatihan_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array( 
				   'pen_name'=>($this->input->post('txtNamaSekolah'))?$this->input->post('txtNamaSekolah'):null, 
				   'pen_tahn'=>($this->input->post('txtTahunLulus'))?$this->input->post('txtTahunLulus'):null,
				   'pen_nijz'=>($this->input->post('txtNoIjazah'))?$this->input->post('txtNoIjazah'):null,
				   'pen_dijz'=>($this->input->post('txtTglIjazah'))?$this->input->post('txtTglIjazah'):null,
				   'pen_nkep'=>($this->input->post('txtKepalaSekolah'))?$this->input->post('txtKepalaSekolah'):null,
				   'pen_desc'=>($this->input->post('txtStatusLulus'))?$this->input->post('txtStatusLulus'):null,
				   'pen_lijzh'=>($this->input->post('txtHubungan'))?$this->input->post('txtHubungan'):null,
				   'pen_code' => ($this->input->post('txtJPend'))?$this->input->post('txtJPend'):null,
				   );
			   
			  
			  $this->db->where('id',$this->uri->segment(3));
			  $this->db->update('his_pelatihan',$arrdata);
			  
			   if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['id']=$this->uri->segment(3);
					$arr['message']='Data berhasil diperbaharui!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
			  
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function getpelatihan_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		 
		if(!empty($id = $this->uri->segment(3))){
					$this->db->where('his_pelatihan.id',$id);
				}
		  $res = $this->db->get('his_pelatihan')->result();
		  foreach($res as $d){
			$arr=array('id'=>$d->id,
					   'pen_name'=>$d->pen_name,
					   'pen_adrs'=>$d->pen_adrs,
					   'pen_tahn'=>$d->pen_tahn,
					   'pen_nijz'=> $d->pen_nijz,
					   'pen_dijz'=> $d->pen_dijz,
					   'pekerjaan'=> $d->pen_dijz,
					   'pen_nkep'=> $d->pen_nkep,
					   'pen_desc'=> $d->pen_desc,
					   'pen_lijzh'=> $d->pen_lijzh,
					   'pen_code'=> $d->pen_code,
					   'emp_nopg'=> $d->emp_nopg, 
					   
					   );
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function deletepelatihan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array( 
				   'tampilkan'=>'0'
				   );
			  
			  $this->db->where('id',$_GET['id']);
			  $this->db->update('his_pelatihan',$arrdata);
			  
			   if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
			  
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	 
}
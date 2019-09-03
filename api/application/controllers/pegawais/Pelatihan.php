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
				   'id_user'=>($this->input->post('id_user')?$this->input->post('id_user'):NULL),
				   'nama'=>($this->input->post('nama')?$this->input->post('nama'):NULL), 
				   'tempat'=>($this->input->post('tempat')?$this->input->post('tempat'):NULL),
				   'penyelenggara'=>($this->input->post('penyelenggara')?$this->input->post('penyelenggara'):NULL),
				   'penanggung'=>($this->input->post('penanggung')?$this->input->post('penanggung'):NULL),
				   'durasi'=>($this->input->post('durasi')?$this->input->post('durasi'):NULL),
				   'mulai'=>($this->input->post('mulai')?$this->input->post('mulai'):NULL),
				   'sampai'=>($this->input->post('sampai')?$this->input->post('sampai'):NULL),
				   'jenis_sertifikat' => ($this->input->post('jenis_sertifikat')?$this->input->post('jenis_sertifikat'):NULL),
				   'no_sertifikat' => ($this->input->post('no_sertifikat')?$this->input->post('no_sertifikat'):NULL)
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
		$this->db->select('his_pelatihan.*,m_penanggung.nama as nama_p'); 
		 $this->db->join('m_penanggung','m_penanggung.id = his_pelatihan.penanggung','LEFT'); 
		$this->db->where('his_pelatihan.tampilkan','1');
		if(!empty($id = $this->uri->segment(4))){
					$this->db->where('his_pelatihan.id_user',$id);
				}
		  $res = $this->db->get('his_pelatihan')->result();
		  foreach($res as $d){
			$arr[]=array('id'=>$d->id,
					   'penanggung'=> $d->nama_p,
					   'nama'=> $d->nama,
					   'tempat'=> $d->tempat,
					   'penyelenggara'=> $d->penyelenggara, 
					   'durasi' => $d->durasi,
					   'mulai' => date_format(date_create($d->mulai), "d-m-Y"),
					   'sampai' => date_format(date_create($d->sampai), "d-m-Y"),
					   'jenis_sertifikat' => $d->jenis_sertifikat,
					   'no_sertifikat' => $d->no_sertifikat 
					   );
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function getPel_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $id = $this->input->get('id');

                $this->db->select('
							   his_pelatihan.id,
							   his_pelatihan.nama as pelatihan');
                if ($id != ''){
                    $this->db->where('his_pelatihan.id_user', $id);
                }
                $this->db->where('his_pelatihan.tampilkan', '1');
                $this->db->order_by('his_pelatihan.id', 'DESC');
      			$res = $this->db->get('his_pelatihan')->result();
                if (!empty($res)) {
                    foreach($res as $d){
						$arr['result'][]=array('label'=>$d->pelatihan,'value'=>$d->id);
					  }

                } else {
                    $arr['hasil'] = 'error';
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
				   'nama'=>($this->input->post('nama')?$this->input->post('nama'):NULL), 
				   'tempat'=>($this->input->post('tempat')?$this->input->post('tempat'):NULL),
				   'penyelenggara'=>($this->input->post('penyelenggara')?$this->input->post('penyelenggara'):NULL),
				   'penanggung'=>($this->input->post('penanggung')?$this->input->post('penanggung'):NULL),
				   'durasi'=>($this->input->post('durasi')?$this->input->post('durasi'):NULL),
				   'mulai'=>($this->input->post('mulai')?$this->input->post('mulai'):NULL),
				   'sampai'=>($this->input->post('sampai')?$this->input->post('sampai'):NULL),
				   'jenis_sertifikat' => ($this->input->post('jenis_sertifikat')?$this->input->post('jenis_sertifikat'):NULL),
				   'no_sertifikat' => ($this->input->post('no_sertifikat')?$this->input->post('no_sertifikat'):NULL)
				   );
			   
			  
			  $this->db->where('id',$this->uri->segment(4));
			  $this->db->update('his_pelatihan',$arrdata);
			  
			   if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['id']=$this->uri->segment(4);
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
		 
		if(!empty($id = $this->uri->segment(4))){
					$this->db->where('his_pelatihan.id',$id);
				}
		  $res = $this->db->get('his_pelatihan')->result();
		  foreach($res as $d){
			$arr=array('id'=>$d->id,
					'id_user'=>$d->id_user,
					'nama'=>$d->nama, 
					'tempat'=>$d->tempat,
					'penyelenggara'=>$d->penyelenggara,
					'penanggung'=>$d->penanggung,
					'durasi'=>$d->durasi,
					'mulai'=>$d->mulai,
					'sampai'=>$d->sampai,
					'jenis_sertifikat' =>$d->jenis_sertifikat,
					'no_sertifikat' =>$d->no_sertifikat,
					'file' => $d->file_url
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
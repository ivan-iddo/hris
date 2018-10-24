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

class Ruas_jembatan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
  
	public function list_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				$this->db->order_by('nama','ASC');
		 
		 $this->db->select("ruas_jembatan.*,m_provinsi.province_name");
		  $this->db->where('tampilkan','1');
		  $this->db->join('m_provinsi','ruas_jembatan.id_propinsi = m_provinsi.province_id');
		  $res = $this->db->get('ruas_jembatan')->result();
		  $no=0;
		  if(!empty($res)){
		  foreach($res as $d){
			++$no;
			$arr[]=array('id'=>$d->id,
						 "nama"=>$d->nama,
						"deskripsi" => $d->deskripsi,
						"link_id" => $d->link_id,
						"id_propinsi" => $d->id_propinsi,
						"nama_propinsi" => $d->province_name,
						"kode_ruas"=> $d->kode_ruas,
						"titikref_awal" => $d->titikref_awal,
						"titikref_akhir" =>$d->titikref_akhir,
						"panjang_ruas" => $d->panjang_ruas,
						"STA_awal"=> $d->STA_awal,
						"STA_akhir" => $d->STA_akhir,
						"kord_awal" =>$d->kord_awal,
						"kord_akhir" => $d->kord_akhir
						 
						 );
		  }
		  }else{
			$arr['result']='empty';
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	 
	
	public function getgroup_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $this->db->order_by('grup','ASC');
		  $res = $this->db->get('sys_grup_user')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->grup,'value'=>$d->id_grup);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	 
public function save_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$nama	= $this->input->post('nama');
				 $f_link_id = $this->input->post('f_link_id');
				  $f_kode_ruas = $this->input->post('f_kode_ruas');
                                  $f_provinsi = $this->input->post('f_provinsi');
                                  $f_keterangan = $this->input->post('f_keterangan');
                                  $f_nama = $this->input->post('f_nama');
                                  $f_panjang = $this->input->post('f_panjang');
                                  $f_sta_awal = $this->input->post('f_sta_awal');
                                  $f_sta_akhir= $this->input->post('f_sta_akhir');
                                  $f_kord_awal = $this->input->post('f_kord_awal');
                                  $f_kord_akhir = $this->input->post('f_kord_akhir');
                                  $f_titik_ref_awal = $this->input->post('f_titik_ref_awal');
                                  $f_titik_ref_akhir = $this->input->post('f_titik_ref_akhir');
								  $id_jalan = $this->input->post('id_jalan');
				
				$this->db->where('nama',$nama);
				$cek = $this->db->get('ruas_jembatan')->row();
				if(empty($cek)){
				$param=array( 
					"nama"=>$nama,
					"deskripsi" => $f_keterangan,
					"link_id" => $id_jalan,
					"id_propinsi" => $f_provinsi,
					"kode_ruas"=> $f_kode_ruas,
					"titikref_awal" => $f_titik_ref_awal,
					"titikref_akhir" =>$f_titik_ref_akhir,
					"panjang_ruas" => $f_panjang,
					"STA_awal"=> $f_sta_awal,
					"STA_akhir" => $f_sta_akhir,
					"kord_awal" =>$f_kord_awal,
					"kord_akhir" => $f_kord_akhir,
					"id_jalan" => $id_jalan
					);
				
				
				 $this->db->insert('ruas_jembatan',$param);
				
				 if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
				$this->set_response($arr, REST_Controller::HTTP_OK);
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah! NAMA TIPE DOKUMEN sudah pernah digunakan';
					$this->set_response($arr, REST_Controller::HTTP_OK);
				}
		 
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	
	 public function edit_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$username	= $this->input->post('nama');
				$username_asli	= $this->input->post('f_user_edit');
				$id	= $this->input->post('f_id_edit');
				  $f_link_id = $this->input->post('f_link_id');
				  $f_kode_ruas = $this->input->post('f_kode_ruas');
                                  $f_provinsi = $this->input->post('f_provinsi');
                                  $f_keterangan = $this->input->post('f_keterangan');
                                  $f_nama = $this->input->post('f_nama');
                                  $f_panjang = $this->input->post('f_panjang');
                                  $f_sta_awal = $this->input->post('f_sta_awal');
                                  $f_sta_akhir= $this->input->post('f_sta_akhir');
                                  $f_kord_awal = $this->input->post('f_kord_awal');
                                  $f_kord_akhir = $this->input->post('f_kord_akhir');
                                  $f_titik_ref_awal = $this->input->post('f_titik_ref_awal');
                                  $f_titik_ref_akhir = $this->input->post('f_titik_ref_akhir');
					$id_jalan = $this->input->post('id_jalan');
				 
				
				if($username != $username_asli){
					
				
				$this->db->where('nama',$username);
				$cek = $this->db->get('ruas_jembatan')->row();
				}else{
					$cek='';
				}
				
				if(empty($cek)){
				$param=array( 
					"nama"=>$username,
					"deskripsi" => $f_keterangan,
					"link_id" => $id_jalan,
					"id_propinsi" => $f_provinsi,
					"kode_ruas"=> $f_kode_ruas,
					"titikref_awal" => $f_titik_ref_awal,
					"titikref_akhir" =>$f_titik_ref_akhir,
					"panjang_ruas" => $f_panjang,
					"STA_awal"=> $f_sta_awal,
					"STA_akhir" => $f_sta_akhir,
					"kord_awal" =>$f_kord_awal,
					"kord_akhir" => $f_kord_akhir,
					"id_jalan" => $id_jalan
					);
				
				 $this->db->where('id',$id);
				 $this->db->update('ruas_jembatan',$param);
				
				 if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
				$this->set_response($arr, REST_Controller::HTTP_OK);
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah! NAMA TIPE DOKUMEN sudah pernah digunakan';
					$this->set_response($arr, REST_Controller::HTTP_OK);
				}
		 
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function delete_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
				 $id    = $this->input->get('id');
				 $this->db->where('id',$id);
				 $this->db->update('ruas_jembatan',array('tampilkan'=>'0'));
				  
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
	
	public function optiondata_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				if(!empty($this->input->get('id'))){
					$this->db->where('link_id',$this->input->get('id'));
				}
				$this->db->order_by('nama','ASC');
		  
		  $this->db->where('tampilkan','1');
		 // $this->db->join('m_provinsi','ruas_jalan.id_propinsi = m_provinsi.province_id');
		  $res = $this->db->get('ruas_jembatan')->result();
		  $no=0;
		  if(!empty($res)){
		  foreach($res as $d){
			++$no;
			$arr['result'][]=array('value'=>$d->kode_jembatan,
						 "label"=>$d->nama  
						 );
		  }
		  }else{
			$arr[]='';
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function getuser_get(){
		 $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
				 $id    = $this->input->get('id');
				  $arr=array();
				$this->db->select("ruas_jembatan.*,m_provinsi.province_name");
				$this->db->where('ruas_jembatan.kode_jembatan',$id);
				$this->db->join('m_provinsi','ruas_jembatan.id_propinsi = m_provinsi.province_id');
				$res = $this->db->get('ruas_jembatan')->result();
				foreach($res as $d){
				  $arr[]=array('id'=>$d->id,
						 "nama"=>$d->nama,
						"deskripsi" => $d->deskripsi,
						"link_id" => $d->link_id,
						"id_propinsi" => $d->id_propinsi,
						"nama_propinsi" => $d->province_name,
						"kode_ruas"=> $d->kode_jembatan,
						"titikref_awal" => $d->titikref_awal,
						"titikref_akhir" =>$d->titikref_akhir,
						"panjang_ruas" => $d->panjang_ruas,
						"STA_awal"=> $d->STA_awal,
						"STA_akhir" => $d->STA_akhir,
						"kord_awal" =>$d->kord_awal,
						"kord_akhir" => $d->kord_akhir,
						"id_jalan" => $d->id_jalan
						 
						 );
				}
				 
				$this->set_response($arr, REST_Controller::HTTP_OK);
		 
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	  
	}
}
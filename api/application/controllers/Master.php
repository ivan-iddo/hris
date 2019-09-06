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

class Master extends REST_Controller
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
	
	
	 
public function kelamin_get(){
	$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $this->db->order_by('id','ASC');
				  $this->db->where('tampilkan','1');
		  $res = $this->db->get('m_kelamin')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function agama_get(){
	$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $this->db->order_by('id_agama','ASC');
				 $this->db->where('aktif','1');
		  $res = $this->db->get('m_agama')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->agama,'value'=>$d->id_agama);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function plh_get(){
	$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $this->db->order_by('name','ASC');
				 $grups=array('2','66','82','92');
				 $this->db->where_in('id_grup',$grups);
				 $this->db->where('kd_keluar','12');
		  $res = $this->db->get('sys_user')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->name,'value'=>$d->id_user);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function alat_angkut_get(){
	$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $this->db->order_by('nama','ASC');
				 $this->db->where('tampilkan','1');
		  $res = $this->db->get('m_alat_angkut')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->nama,'value'=>$d->nama);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

	public function pendidikan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('aktif','1');
			  $res = $this->db->get('m_pendidikan')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function provinsi_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('province_name','ASC'); 
			  $res = $this->db->get('m_provinsi')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->province_name,'value'=>$d->province_id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function kota_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('kota','ASC');
					 if(!empty($idprov = $this->uri->segment(3))){
						$this->db->where('province_id',$idprov);
					 }
			  $res = $this->db->get('m_kota')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->kota,'value'=>$d->id_kota);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function kecamatan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('kecamatan','ASC');
					 if(!empty($idprov = $this->uri->segment(3))){
						$this->db->where('id_kota',$idprov);
					 }
			  $res = $this->db->get('m_kecamatan')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->kecamatan,'value'=>$d->id_kecamatan);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	
	public function kelurahan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('kelurahan','ASC');
					 if(!empty($idprov = $this->uri->segment(3))){
						$this->db->where('id_kecamatan',$idprov);
					 }
			  $res = $this->db->get('m_kelurahan')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->kelurahan,'value'=>$d->id_kelurahan);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function status_pegawai_tetap_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->where('flagpns','0');
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('m_status_pegawai')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function status_pegawai_pns_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->where('flagpns','1');
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('m_status_pegawai')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function status_pegawai_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {

					if(!empty($this->input->get('type'))){
						if($this->input->get('type')=='pns'){
							$this->db->where('flagpns','1');
						}

						if($this->input->get('type')=='nonpns'){
							$this->db->where('flagpns','0');
						}
						
					}
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('m_status_pegawai')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function all_jabatan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('grup','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('sys_grup_user')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->grup,'value'=>$d->grup);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function direktorat_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('grup','ASC');
					 $this->db->where('tampilkan','1');
					  $this->db->where('child','1');
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
	
	public function direktoratSub_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('grup','ASC');
					 $this->db->where('tampilkan','1');
					 if(!empty($id = $this->uri->segment(3))){
					  $this->db->where('child',$id);
					 }
			  $res = $this->db->get('sys_grup_user')->result();

			  if(!empty($res)){
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->grup,'value'=>$d->id_grup);
			  }
			}else{
				$arr['result'][]=array('label'=>'No data','value'=>'');;
			}
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function jabatan_asn_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('m_jabatan_asn')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function jabatan_struktural_fix_label_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 
			  $this->db->order_by('ds_jabatan','ASC');
			  $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('m_index_jabatan_asn_detail')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>'[Kode: '.$d->kd_jabatan.'] '.$d->ds_jabatan,'value'=>$d->migrasi_jabatan_detail_id);
			  }
			  	
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function jabatan_fix_abk_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$this->db->select('persyaratan_jabatan.id_persyaratan,m_index_jabatan_asn_detail.kd_jabatan,m_index_jabatan_asn_detail.ds_jabatan');
				  	$this->db->order_by('persyaratan_jabatan.id_jabatan','ASC');
					$this->db->where('persyaratan_jabatan.tampilkan','1');
					$this->db->join('m_index_jabatan_asn_detail',' m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = persyaratan_jabatan.id_jabatan');
				  	$res = $this->db->get('persyaratan_jabatan')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>'[Kode: '.$d->kd_jabatan.'] '.$d->ds_jabatan,'value'=>$d->id_persyaratan);
			  }
			  	
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function jabatan_struktural_fix_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
			  $this->db->order_by('ds_jabatan','ASC');
			  $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('m_index_jabatan_asn_detail')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->ds_jabatan.' [Kode: '.$d->kd_jabatan.']','value'=>$d->migrasi_jabatan_detail_id);
			  }
			  	
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function jabatan_struktural_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('uk_master')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama.' [Kode: '.$d->id.']','value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	
	public function jabatan_struktural1_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('uk_master')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama.' [Kode: '.$d->id.']','value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function jabatan_struktural2_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('uk_master')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama.' [Kode: '.$d->id.']','value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function golongan_pegawai_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('gol_angka','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('m_golongan_peg')->result();
			  foreach($res as $d){
				$pangkat=$d->gol_romawi." / ".$d->pangkat;
				$arr['result'][]=array('label'=>$pangkat,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	
	public function golongan_peg_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('gol_angka','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('m_golongan_peg')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->gol_romawi,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	
	public function peringkat_jabatan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('no_grade','ASC');
					 $this->db->where('tampilkan','1');
					 
			  $res = $this->db->get('m_grade_jabatan')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->ds_grade,'value'=>$d->no_grade);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function getbobot_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 
			  $res = $this->db->get('bobot')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nilai,'value'=>$d->nilai);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function pekerjaan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('aktif','1');
			  $res = $this->db->get('m_pekerjaan')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function hubkeluarga_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('aktif','1');
			  $res = $this->db->get('m_hubungan_keluarga')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function statuslulus_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('m_status_lulus')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function akreditas_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('akreditasi')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->akreditasi,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function penanggung_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('aktif','1');
			  $res = $this->db->get('m_penanggung')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function tempat_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('nama','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('m_tempat')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function jenis_cuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$tahunskrg = "'".date('Y')."'";
					 $this->db->order_by('id','ASC');
					 $this->db->where('tampilkan','1');
					 $this->db->where('tahun',date('Y'));
			  $res = $this->db->get('m_jenis_cuti')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function jenis_izin_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $this->db->order_by('id','ASC');
					 $this->db->where('tampilkan','1');
			  $res = $this->db->get('m_jenis_izin')->result();
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
			  }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function getmaster_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				if(!empty($id)){
					 $this->db->where('dm_term.child',$this->input->get('id'));
				}
				  
				  $this->db->select('dm_term.*,dm_taxonomy.nama as nama_grup');
				  $this->db->where('dm_term.tampilkan','1');
				  $this->db->join('dm_taxonomy',' dm_taxonomy.id = dm_term.child');
				  $res = $this->db->get('dm_term')->result();
				
			if(!empty($res)){
				 foreach($res as $d){
					$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id,);
				  }
			}else{
			$arr['result'] ='empty';
		  }
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function getpen_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				if(!empty($id)){
					 $this->db->where('dm_term.child',$this->input->get('id'));
				}
				  
				  $this->db->select('dm_term.*,dm_taxonomy.nama as nama_grup');
				  $this->db->order_by('id','ASC');
				  $this->db->where('dm_term.tampilkan','1');
				  $this->db->join('dm_taxonomy',' dm_taxonomy.id = dm_term.child');
				  $res = $this->db->get('dm_term')->result();
				
			if(!empty($res)){
				 foreach($res as $d){
					$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id,);
				  }
			}else{
			$arr['result'] ='empty';
		  }
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function kegiatanpokok_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				
				if ($decodedToken != false) {
					$user_froup = $decodedToken->data->_pnc_id_grup;

					 $this->db->select(' kegiatan_pokok as nama');
					 $this->db->order_by('kegiatan_pokok','ASC');
					 $this->db->where('tampilkan','1');
					 if( ($user_froup =='1') OR  ($user_froup=='6')){
						 if(!empty($this->input->get('uk'))){
							$this->db->where('id_uk',$this->input->get('uk'));
						 }
					 	
					}else{
						$this->db->where('id_uk',$user_froup);
					}

					if(empty($this->input->get('tahun'))){
                        $this->db->where('tahun',date('Y'));
                    }else{
                        $this->db->where('tahun',$this->input->get('tahun'));
                    }
					 $this->db->group_by('kegiatan_pokok');
			  $res = $this->db->get('abk_beban_kerja')->result();
			  if(!empty($res)){
			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->nama,'value'=>$d->nama);
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
 
}
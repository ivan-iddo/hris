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

class Persyaratan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	 var $table='persyaratan_jabatan';
	 var $perpage = 20;
 
	
	public function listdata_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$this->db->select('persyaratan_jabatan.*,baru.kd_jabatan,baru.ds_jabatan as baru,lama.ds_jabatan as lama');
				  
				if(!empty($this->input->get('id'))){
					$this->db->where('id_persyaratan',$this->input->get('id'));
				}
				if(!empty($this->uri->segment(4))){
					// $this->db->like("jabatan_baru",$param); 
					$this->db->where('id_jabatan ilike',$param2);
				}
				  $this->db->where('persyaratan_jabatan.tampilkan','1');
				  $this->db->join('m_index_jabatan_asn_detail as baru', 'baru.migrasi_jabatan_detail_id = persyaratan_jabatan.id_jabatan', 'LEFT');
				  $this->db->join('m_index_jabatan_asn_detail as lama', 'lama.migrasi_jabatan_detail_id = persyaratan_jabatan.jabatan_lama', 'LEFT');
				  $res = $this->db->get($this->table)->result();
			if(!empty($res)){
				 foreach($res as $dat){
					$arr['result'][]= array(
					'id' => $dat->id_persyaratan,
					'id_jabatan'=> $dat->id_jabatan,
					'jabatan_baru'=> $dat->baru,
					'masa_jabatan'=> $dat->masa_jabatan,
					'kompetensi'=> $dat->kompetensi,
					'formal'=> $dat->formal,
					'nonformal'=> $dat->nonformal,
					'jabatan_lama'=> $dat->lama,
					'id_jabatan_lama'=> $dat->jabatan_lama,
					'kd_jabatan'=> $dat->kd_jabatan,
					'tufoksi'=> $dat->tufoksi
				);
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



	public function save_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
            	$id = $this->input->post('id_persyaratan');
				if(!empty($id)){
					//edit
					$arr=array(
					'id_jabatan'=> ($this->input->post('txtjabatan')?$this->input->post('txtjabatan'):NULL),
					'masa_jabatan'=> ($this->input->post('masajbt')?$this->input->post('masajbt'):NULL),
					'kompetensi'=> ($this->input->post('kompetensi')?$this->input->post('kompetensi'):NULL),
					'formal'=> ($this->input->post('formal')?$this->input->post('formal'):NULL),
					'nonformal'=> ($this->input->post('nonformal')?$this->input->post('nonformal'):NULL),
					'jabatan_lama'=> ($this->input->post('txtjabatans')?$this->input->post('txtjabatans'):NULL),
					'tufoksi'=> ($this->input->post('tufoksi')?$this->input->post('tufoksi'):NULL)
					);

					$this->db->where('id_persyaratan',$id);
					$res = $this->db->update($this->table,$arr);
				}else{
					//save
					$arr=array(
					'id_jabatan'=> ($this->input->post('txtjabatan')?$this->input->post('txtjabatan'):NULL),
					'masa_jabatan'=> ($this->input->post('masajbt')?$this->input->post('masajbt'):NULL),
					'kompetensi'=> ($this->input->post('kompetensi')?$this->input->post('kompetensi'):NULL),
					'formal'=> ($this->input->post('formal')?$this->input->post('formal'):NULL),
					'nonformal'=> ($this->input->post('nonformal')?$this->input->post('nonformal'):NULL),
					'jabatan_lama'=> ($this->input->post('txtjabatans')?$this->input->post('txtjabatans'):NULL),
					'tufoksi'=> ($this->input->post('tufoksi')?$this->input->post('tufoksi'):NULL)
				); 
					$res = $this->db->insert($this->table,$arr);
				}
				


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


	public function delete_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

				if(!empty($this->input->get('id'))){
					//edit
					$id= $this->input->get('id'); 
					$this->db->where('id_persyaratan',$id);
					$this->db->update($this->table,array('tampilkan'=>'0'));
				} 
				


				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil dihapus!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal dihapus!';
				 }

			  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	 
}
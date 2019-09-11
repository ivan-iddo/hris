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

class Dok_lok extends REST_Controller
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

			$this->db->where('tampilkan','1');
			$res = $this->db->get('dok_lokasi')->result();
			$no=0;
			if(!empty($res)){
				foreach($res as $d){
					++$no;
					$arr[]=array('lat'=>$d->latitude,'lng'=>$d->longitude,'id'=>$d->id,'kode_arsip'=>$d->kode_arsip,'nama'=>$d->nama,'no'=>$no,'alamat'=>$d->alamat,'lantai'=>$d->lantai,'ruang'=>$d->ruang,'no_rak'=>$d->no_rak,'no_box'=>$d->no_box,'deskripsi'=>$d->deskripsi);
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
			$nama	= ($this->input->post('nama'))?$this->input->post('nama'):null;
			$f_ruang = ($this->input->post('f_ruang'))?$this->input->post('f_ruang'):null; 
			$f_norak = ($this->input->post('f_norak'))?$this->input->post('f_norak'):null;  
			$f_nobox = ($this->input->post('f_nobox'))?$this->input->post('f_nobox'):null;  
			$f_deskripsi = ($this->input->post('f_deskripsi'))?$this->input->post('f_deskripsi'):null; 
			$f_alamat = ($this->input->post('f_alamat'))?$this->input->post('f_alamat'):null;
			$f_kode_arsip = ($this->input->post('f_kode_arsip'))?$this->input->post('f_kode_arsip'):null;
			$f_lantai = ($this->input->post('f_lantai'))?$this->input->post('f_lantai'):null;
			$f_lat = ($this->input->post('f_lat'))?$this->input->post('f_lat'):null;
			$f_lng = ($this->input->post('f_lng'))?$this->input->post('f_lng'):null;

			$this->db->where('nama',$nama);
			$cek = $this->db->get('dok_lokasi')->row();
			if(empty($cek)){
				$param=array( 
					"nama"=>$nama,
					"alamat" => $f_alamat,
					"kode_arsip" => $f_kode_arsip,
					"lantai" => $f_lantai,
					"ruang"=> $f_ruang,
					"no_rak" => $f_norak,
					"no_box" =>$f_nobox,
					"deskripsi" => $f_deskripsi,
					"latitude" => $f_lat,
					"longitude" => $f_lng
				);


				$this->db->insert('dok_lokasi',$param);

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
			$username	= ($this->input->post('nama'))?$this->input->post('nama'):null;
			$username_asli	= ($this->input->post('f_user_edit'))?$this->input->post('f_user_edit'):null;
			$id	= ($this->input->post('f_id_edit'))?$this->input->post('f_id_edit'):null;
			$f_ruang = ($this->input->post('f_ruang'))?$this->input->post('f_ruang'):null; 
			$f_norak = ($this->input->post('f_norak'))?$this->input->post('f_norak'):null;  
			$f_nobox = ($this->input->post('f_nobox'))?$this->input->post('f_nobox'):null;  
			$f_deskripsi = ($this->input->post('f_deskripsi'))?$this->input->post('f_deskripsi'):null; 
			$f_alamat = ($this->input->post('f_alamat'))?$this->input->post('f_alamat'):null;
			$f_kode_arsip = ($this->input->post('f_kode_arsip'))?$this->input->post('f_kode_arsip'):null;
			$f_lantai = ($this->input->post('f_lantai'))?$this->input->post('f_lantai'):null;
			$f_lat = ($this->input->post('f_lat'))?$this->input->post('f_lat'):null;
			$f_lng = ($this->input->post('f_lng'))?$this->input->post('f_lng'):null;


			if($username != $username_asli){


				$this->db->where('nama',$username);
				$cek = $this->db->get('dok_lokasi')->row();
			}else{
				$cek='';
			}

			if(empty($cek)){
				$param=array( 
					"nama"=>$username,
					"alamat" => $f_alamat,
					"kode_arsip" => $f_kode_arsip,
					"lantai" => $f_lantai,
					"ruang"=> $f_ruang,
					"no_rak" => $f_norak,
					"no_box" =>$f_nobox,
					"deskripsi" => $f_deskripsi,
					"latitude" => $f_lat,
					"longitude" => $f_lng
				);

				$this->db->where('id',$id);
				$this->db->update('dok_lokasi',$param);

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
			$this->db->update('dok_lokasi',array('tampilkan'=>'0'));

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

public function getuser_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id    = $this->input->get('id');


			$this->db->where('id',$id);
			$res = $this->db->get('dok_lokasi')->result();
			foreach($res as $d){
				$arr[]=array('lat'=>$d->latitude,'lng'=>$d->longitude,'id'=>$d->id,'kode_arsip'=>$d->kode_arsip,'nama'=>$d->nama,'alamat'=>$d->alamat,'lantai'=>$d->lantai,'ruang'=>$d->ruang,'no_rak'=>$d->no_rak,'no_box'=>$d->no_box,'deskripsi'=>$d->deskripsi);

			}

			$this->set_response($arr, REST_Controller::HTTP_OK);


			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

}
}
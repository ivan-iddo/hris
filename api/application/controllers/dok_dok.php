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

class Dok_dok extends REST_Controller
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
//$this->db->order_by();
			$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
			$this->db->where('status','1');
			$res = $this->db->get('sys_user')->result();
			foreach($res as $d){
				$arr[]=array('id'=>$d->id_user,'nama'=>$d->name,'username'=>$d->username,'email'=>$d->email,'nama_group'=>$d->grup);
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
			$id = $this->input->get('id');
			$this->db->where('id_dok_master',$id);
			$ressearch = $this->db->get('dok_sys')->result();

			if(!empty($ressearch)){
				foreach($ressearch as $da){
					$data[$da->id_dok_tipe]=$da->id_dok_tipe;
				}
			}


			$res = $this->db->get('dok_tipe')->result();

			if(!empty($res)){
				foreach($res as $d){
					$ada=0;
					if(!empty($data[$d->id])){
						$ada='1';
					}
					$arr[]=array('nama'=>$d->nama,'id'=>$d->id,'nama_group'=>$d->nama,'ada'=>$ada);
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

public function getitem_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id = $this->input->get('id');
			if(!empty($id)){
				$this->db->where('id',$this->input->get('id'));
			}

			if(empty($this->input->get('all'))){
				$this->db->where('child','0');
			}

			$this->db->where('tampilkan','1');
			$res = $this->db->get('dok_master')->result();

			if(!empty($res)){
				foreach($res as $d){
					$arr[]=array('id'=>$d->id,'deskripsi'=>$d->deskripsi,'nama'=>$d->nama);
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
			$group_group    = $_POST['group_group'];
			$group_ket      = $_POST['group_ket'];
			$id_group = $_POST['id_parent'];

			$data = array(
				'nama'=>($group_group)?$group_group:null,
				'deskripsi'=>($group_ket)?$group_ket:null
			);
			if(!empty($id_group)){
				$data['child']=$id_group;
			}
//print_r($data);
			$this->db->insert('dok_master',$data);
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


public function edit_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
$group_aplikasi = '1';//$this->input->post('group_aplikasi');
$group_group    = $_POST['group_group'];
$group_ket      = $_POST['group_ket'];

$data = array(
	'nama'=>($group_group)?$group_group:null,
	'deskripsi'=>($group_ket)?$group_ket:null
);
$this->db->where('id', $this->input->post('id_group'));
$this->db->update('dok_master',$data);
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

			$id    = $this->input->get('id_group');
			$this->db->where('id',$id);
			$this->db->update('dok_master',array('tampilkan'=>'0'));

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


			$this->db->where('id_user',$id);
			$res = $this->db->get('sys_user')->result();
			foreach($res as $d){
				$arr[]=array('id'=>$d->id_user,'nama'=>$d->name,'username'=>$d->username,'email'=>$d->email,'id_group'=>$d->id_grup,'status'=> $d->status);
			}

			$this->set_response($arr, REST_Controller::HTTP_OK);


			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

}

public function addmenu_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id_group    = $this->input->post('id_group');
			$id_menu    = $this->input->post('id_menu');


			$this->db->where('id_dok_master',$id_group);
			$this->db->delete('dok_sys');

			$data=explode(',',$id_menu);

			foreach($data as $val){
				$id_aplikasi = 1; 

				$dataarr= array(
					'id_dok_master'=>($id_group)?$id_group:null,
					'id_dok_tipe'=>($val)?$val:null
				);
				$this->db->insert('dok_sys',$dataarr);
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
}
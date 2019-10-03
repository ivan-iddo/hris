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

class Pengajuan extends REST_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/
var $table='pengajuan_jabatan';
var $perpage = 20;


public function listdatadetail_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id_user = $decodedToken->data->id;
			$grup = $decodedToken->data->_pnc_id_grup;

			$this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
			$this->db->where('riwayat_kedinasan.id_user',$id_user);
			$uk = $this->db->get('riwayat_kedinasan')->row();
			$dir = $uk->direktorat;
			$bagian = $uk->bagian;
			$sub_bag = $uk->sub_bagian;

			$id_pengajuan = $this->input->get('id');
			if(!empty($id_pengajuan)){
				$this->db->where('id_pengajuan',$id_pengajuan);
			}

			$total_rows = $this->db->count_all_results($this->table);
			$pagination = create_pagination_endless('/persyaratan//0/', $total_rows,$this->perpage,5);
			$this->db->select('pengajuan_jabatan.*,
				baru.ds_jabatan as jabatan_baru,
				persyaratan_jabatan.masa_jabatan as masa_jabatan_persyaratan,
				persyaratan_jabatan.kompetensi as kompetensi_persyaratan,
				persyaratan_jabatan.formal as formal,
				persyaratan_jabatan.nonformal as nonformal_persyaratan,
				his_pelatihan.nama as nonformal,
				lama.ds_jabatan as jabatan_lama,
				dm_term.nama as pendidikan,
				his_pendidikan.pen_jur as jurusan,
				persyaratan_jabatan.tufoksi as tufoksi_persyaratan,sys_user.name');
			$this->db->join('persyaratan_jabatan','pengajuan_jabatan.id_persyaratan = persyaratan_jabatan.id_persyaratan','LEFT');
			$this->db->join('m_index_jabatan_asn_detail as baru', 'baru.migrasi_jabatan_detail_id = persyaratan_jabatan.id_jabatan', 'LEFT');
			$this->db->join('m_index_jabatan_asn_detail as lama', 'lama.migrasi_jabatan_detail_id = persyaratan_jabatan.jabatan_lama', 'LEFT');
			$this->db->join('his_pendidikan', 'his_pendidikan.id = pengajuan_jabatan.formal', 'LEFT');
			$this->db->join('his_pelatihan', 'his_pelatihan.id = pengajuan_jabatan.nonformal', 'LEFT');
			$this->db->join('dm_term', 'dm_term.id = his_pendidikan.pen_code', 'LEFT');

			$this->db->join('sys_user','sys_user.id_user = pengajuan_jabatan.id_user','LEFT');
			$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = pengajuan_jabatan.id_user','LEFT');
			if(!empty($id_pengajuan)){
				$this->db->where('id_pengajuan',$id_pengajuan);
			}
			if($grup!=1){   
				if($sub_bag==0){
					$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
					if($bagian==0){
						$this->db->where_in('riwayat_kedinasan.direktorat', $dir);
					}
				}else{
					$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
					$this->db->where_in('riwayat_kedinasan.sub_bagian', $sub_bag);
				}
			}

			$this->db->where($this->table.'.tampilkan','1');
			$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
			$res = $this->db->get($this->table)->result();

			if(!empty($res)){
				foreach($res as $dat){
					$arr['result'][]= array(
						'id' => $dat->id_pengajuan,
						'id_persyaratan' => $dat->id_persyaratan,
						'masa_jabatan'=> $dat->masa_jabatan,
						'kompetensi'=> $dat->kompetensi,
						'formal'=> $dat->pendidikan.' '.$dat->jurusan,
						'nonformal'=> $dat->nonformal,
						'jabatan'=> $dat->jabatan,
						'tufoksi'=> $dat->tufoksi,
						'status'=> $dat->status,
						'keterangan'=> $dat->keterangan,
						'nama'=> $dat->name,
						'id_user'=> $dat->id_user,
						'jabatan_baru'=> $dat->jabatan_baru,
						'masa_jabatan_persyaratan'=> $dat->masa_jabatan_persyaratan,
						'kompetensi_persyaratan'=> $dat->kompetensi_persyaratan,
						'formal_persyaratan'=> $dat->formal,
						'nonformal_persyaratan'=> $dat->nonformal_persyaratan,
						'jabatan_lama'=> $dat->jabatan_lama,
						'tufoksi_persyaratan'=> $dat->tufoksi_persyaratan,
					);
				}
				$arr['total']=$total_rows;
				$arr['paging'] = $pagination['limit'][1];
				$arr['perpage']=$this->perpage;
			}else{
				$arr['result'] ='empty';
			}
			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}
	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listdatadetailok_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id_user = $decodedToken->data->id;
			$grup = $decodedToken->data->_pnc_id_grup;

			$this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
			$this->db->where('riwayat_kedinasan.id_user',$id_user);
			$uk = $this->db->get('riwayat_kedinasan')->row();
			$dir = $uk->direktorat;
			$bagian = $uk->bagian;
			$sub_bag = $uk->sub_bagian;

			$id_pengajuan = $this->input->get('id');
			if(!empty($id_pengajuan)){
				$this->db->where('id_pengajuan',$id_pengajuan);
			}
			$this->db->where_in('status',array('Sudah Sesuai','Dengan Syarat'));
			
			$total_rows = $this->db->count_all_results($this->table);
			$pagination = create_pagination_endless('/persyaratan//0/', $total_rows,$this->perpage,5);
			$this->db->select('pengajuan_jabatan.*,
				baru.ds_jabatan as jabatan_baru,
				persyaratan_jabatan.masa_jabatan as masa_jabatan_persyaratan,
				persyaratan_jabatan.kompetensi as kompetensi_persyaratan,
				persyaratan_jabatan.formal as formal,
				persyaratan_jabatan.nonformal as nonformal_persyaratan,
				his_pelatihan.nama as nonformal,
				lama.ds_jabatan as jabatan_lama,
				dm_term.nama as pendidikan,
				his_pendidikan.pen_jur as jurusan,
				persyaratan_jabatan.tufoksi as tufoksi_persyaratan,sys_user.name');
			$this->db->join('persyaratan_jabatan','pengajuan_jabatan.id_persyaratan = persyaratan_jabatan.id_persyaratan','LEFT');
			$this->db->join('m_index_jabatan_asn_detail as baru', 'baru.migrasi_jabatan_detail_id = persyaratan_jabatan.id_jabatan', 'LEFT');
			$this->db->join('m_index_jabatan_asn_detail as lama', 'lama.migrasi_jabatan_detail_id = persyaratan_jabatan.jabatan_lama', 'LEFT');
			$this->db->join('his_pendidikan', 'his_pendidikan.id = pengajuan_jabatan.formal', 'LEFT');
			$this->db->join('his_pelatihan', 'his_pelatihan.id = pengajuan_jabatan.nonformal', 'LEFT');
			$this->db->join('dm_term', 'dm_term.id = his_pendidikan.pen_code', 'LEFT');

			$this->db->join('sys_user','sys_user.id_user = pengajuan_jabatan.id_user','LEFT');
			$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = pengajuan_jabatan.id_user','LEFT');
			if(!empty($id_pengajuan)){
				$this->db->where('id_pengajuan',$id_pengajuan);
			}
			$this->db->where_in('pengajuan_jabatan.status',array('Sudah Sesuai','Dengan Syarat'));

			$this->db->where($this->table.'.tampilkan','1');
			$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
			$res = $this->db->get($this->table)->result();

			if(!empty($res)){
				foreach($res as $dat){
					$arr['result'][]= array(
						'id' => $dat->id_pengajuan,
						'id_persyaratan' => $dat->id_persyaratan,
						'masa_jabatan'=> $dat->masa_jabatan,
						'kompetensi'=> $dat->kompetensi,
						'formal'=> $dat->pendidikan.' '.$dat->jurusan,
						'nonformal'=> $dat->nonformal,
						'jabatan'=> $dat->jabatan,
						'tufoksi'=> $dat->tufoksi,
						'status'=> $dat->status,
						'keterangan'=> $dat->keterangan,
						'nama'=> $dat->name,
						'jabatan_baru'=> $dat->jabatan_baru,
						'masa_jabatan_persyaratan'=> $dat->masa_jabatan_persyaratan,
						'kompetensi_persyaratan'=> $dat->kompetensi_persyaratan,
						'formal_persyaratan'=> $dat->formal,
						'nonformal_persyaratan'=> $dat->nonformal_persyaratan,
						'jabatan_lama'=> $dat->jabatan_lama,
						'tufoksi_persyaratan'=> $dat->tufoksi_persyaratan,
					);
				}
				$arr['total']=$total_rows;
				$arr['paging'] = $pagination['limit'][1];
				$arr['perpage']=$this->perpage;
			}else{
				$arr['result'] ='empty';
			}
			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}
	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listdata_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id_persyaratan = $this->input->get('id');
			$this->db->join('sys_user','sys_user.id_user = pengajuan_jabatan.id_user','LEFT');
			if(!empty($id_persyaratan)){
				$this->db->where('id_persyaratan',$id_persyaratan);
			}
			$param = "%".urldecode($this->uri->segment(4))."%";
			if(!empty($this->uri->segment(4))){
// $this->db->where("name ilike",$param); 
				$this->db->where("CONCAT(sys_user.name,' ', pengajuan_jabatan.status) ilike",$param);
			}
			$total_rows = $this->db->count_all_results($this->table);
			$pagination = create_pagination_endless('/persyaratan//0/', $total_rows,$this->perpage,5);
			$this->db->select('pengajuan_jabatan.*,sys_user.name');
			$this->db->join('sys_user','sys_user.id_user = pengajuan_jabatan.id_user','LEFT');
			if(!empty($id_persyaratan)){
				$this->db->where('id_persyaratan',$id_persyaratan);
			}
			if(!empty($this->uri->segment(4))){
// $this->db->where("name ilike",$param); 
				$this->db->where("CONCAT(sys_user.name,' ', pengajuan_jabatan.status) ilike",$param);
			}

			$this->db->where('tampilkan','1');
			$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
			$res = $this->db->get($this->table)->result();



			if(!empty($res)){
				foreach($res as $dat){
					$arr['result'][]= array(
						'id' => $dat->id_pengajuan,
						'id_persyaratan' => $dat->id_persyaratan,
						'masa_jabatan'=> $dat->masa_jabatan,
						'kompetensi'=> $dat->kompetensi,
						'formal'=> $dat->formal,
						'nonformal'=> $dat->nonformal,
						'jabatan'=> $dat->jabatan,
						'tufoksi'=> $dat->tufoksi,
						'status'=> $dat->status,
						'nama'=> $dat->name,
					);
				}
				$arr['total']=$total_rows;
				$arr['paging'] = $pagination['limit'][1];
				$arr['perpage']=$this->perpage;
			}else{
				$arr['result'] ='empty';
			}
			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function save_post()
{
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

		if ($decodedToken != false) {
			$arr=array(
				'id_user'=> $this->input->post('txtIdUser'),
				'id_persyaratan'=> $this->input->post('id_persyaratan'),
				'masa_jabatan'=> ($this->input->post('masajbtpengaju')?$this->input->post('masajbtpengaju'):NULL),
				'kompetensi'=> ($this->input->post('kompetensipengaju')?$this->input->post('kompetensipengaju'):NULL),
				'formal'=> ($this->input->post('f_formalpengaju')?$this->input->post('f_formalpengaju'):NULL),
				'nonformal'=> ($this->input->post('f_nonformalpengaju')?$this->input->post('f_nonformalpengaju'):NULL),
				'jabatan'=> ($this->input->post('f_txtjabatanspengaju')?$this->input->post('f_txtjabatanspengaju'):NULL),
				'tufoksi'=> ($this->input->post('tufoksipengaju')?$this->input->post('tufoksipengaju'):NULL),
			);
//print_r($arr);die();
			$this->db->insert($this->table,$arr);


			if ($this->db->affected_rows() == '1') {
				$arr['hasil'] = 'success';
				$arr['message'] = 'Data berhasil ditambah!';
			} else {
				$arr['hasil'] = 'error';
				$arr['message'] = 'Data Gagal Ditambahhhh!';
			}

		}




		$this->set_response($arr, REST_Controller::HTTP_OK);

		return;

	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


public function sav_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id_persyaratan = $this->input->post('id_persyaratan');
			$id = $this->input->post('id_pengajuan');
// print_r($id_persyaratan);die();
			if(!empty($id)){
//edit
				$arr=array(
					'status'=> $this->input->post('status'),
					'keterangan'=> $this->input->post('keterangan'),
				);
				$this->db->where('id_pengajuan',$id);
				$this->db->update($this->table,$arr);

				if($this->db->affected_rows() == '1'){
					$arr['id_persyaratan']=$id_persyaratan;
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				}
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}
			else {
//save
				$user_id = $decodedToken->data->id;
//masa jabatan
				$this->db->where('id_user', $user_id);
				$this->db->order_by('tmtawal', 'ACS');
				$this->db->limit('1');
				$kontrak = $this->db->get('his_kontrak')->row();
				$masa_jabatan = "";
				if ($kontrak) {
					$tanggal = new DateTime($kontrak->tmtawal);
					$today = new DateTime('today');
					$y = $today->diff($tanggal)->y;
					$m = $today->diff($tanggal)->m;
					$d = $today->diff($tanggal)->d;

					if ($m != 0 && $y != 0) {
						$masa_jabatan = $y." Tahun ".$m." Bulan";
					} else if ($y == 0 && $m != 0) {
						$masa_jabatan = $m." Bulan";
					} else if ($m == 0 && $y != 0) {
						$masa_jabatan = $y." Tahun";
					} else {
						$masa_jabatan = $d." Hari";
					}
				}

//pendidikan
				$this->db->select('his_pendidikan.*,dm_term.nama as jenjangPendidikan');
				$this->db->join('sys_user_profile','sys_user_profile.pendidikan_akhir = his_pendidikan.pen_code');
				$this->db->join('dm_term', 'dm_term.id = his_pendidikan.pen_code', 'LEFT');
				$this->db->where('sys_user_profile.id_user', $user_id);
				$pendidikan = $this->db->get('his_pendidikan')->row();
				$pendidikan_akhir = "";
				if ($pendidikan) {
					$pendidikan_akhir = $pendidikan->jenjangPendidikan." ".$pendidikan->pen_jur;
				}

//jabatan skrg
				$this->db->select('his_mutasi_jabatan.*,j1.kd_jabatan as kd_jabatan1, j1.ds_jabatan as ds_jabatan1, j2.kd_jabatan as kd_jabatan2, j2.ds_jabatan as ds_jabatan2, j3.kd_jabatan as kd_jabatan3, j3.ds_jabatan as ds_jabatan3');
				$this->db->join('m_index_jabatan_asn_detail as j1','his_mutasi_jabatan.jabatan = j1.migrasi_jabatan_detail_id', 'LEFT');
				$this->db->join('m_index_jabatan_asn_detail as j2','his_mutasi_jabatan.jabatan2 = j2.migrasi_jabatan_detail_id', 'LEFT');
				$this->db->join('m_index_jabatan_asn_detail as j3','his_mutasi_jabatan.jabatan3= j3.migrasi_jabatan_detail_id', 'LEFT');
				$this->db->where('his_mutasi_jabatan.user_id', $user_id);
				$jabatan = $this->db->get('his_mutasi_jabatan')->result();

				$riwayat_jabatan = "";
				$riwayat_jabatan2 = "";
				$riwayat_jabatan3 = "";
				if ($jabatan) {
					foreach($jabatan as $d){
						$jabatans[]=array(
							'jabatan'=> '['. $d->kd_jabatan1. '] '.$d->ds_jabatan1,
							'jabatan2'=> '['. $d->kd_jabatan2. '] '.$d->ds_jabatan2,
							'jabatan3'=> '['. $d->kd_jabatan3. '] '.$d->ds_jabatan3,
						);
					}
					$riwayat_jabatan = implode(', ', array_column($jabatans, 'jabatan'));
					$riwayat_jabatan2 = implode(', ', array_column($jabatans, 'jabatan2'));
					$riwayat_jabatan3 = implode(', ', array_column($jabatans, 'jabatan3'));
				}
				$string_replace = array('\'', ';', '[', ']', '{', '}', '|', '^', '~' , ',' , ' ');
				$pesan2= str_replace($string_replace, '',$riwayat_jabatan2);
				$pesan3= str_replace($string_replace, '',$riwayat_jabatan3);

				$riwayat_jabatan_all = $riwayat_jabatan;
				if ($pesan2 != "") {
					$riwayat_jabatan_all .= ", " . $riwayat_jabatan2;
				}
				if ($pesan3 != "") {
					$riwayat_jabatan_all .= ", " . $riwayat_jabatan3;
				}

// pelatihan
				$this->db->where('his_pelatihan.tampilkan','1');
				$this->db->where('his_pelatihan.id_user', $user_id);
				$pelatihan = $this->db->get('his_pelatihan')->result();
				$pendidikan_nonformal = "";
				if ($pelatihan) {
					foreach($pelatihan as $d){
						$nonformal[]=array(
							'nama'=> $d->nama,
						);
					}
					$pendidikan_nonformal = implode(', ', array_column($nonformal, 'nama'));
				}

				$arr=array(
					'id_user'=> $user_id,
					'id_persyaratan'=> $this->input->post('id_persyaratan'),
					'masa_jabatan'=> ($masa_jabatan?$masa_jabatan:NULL),
					'kompetensi'=> ($this->input->post('kompetensiAnda')?$this->input->post('kompetensiAnda'):NULL),
					'formal'=> ($pendidikan_akhir?$pendidikan_akhir:NULL),
					'nonformal'=> ($pendidikan_nonformal?$pendidikan_nonformal:NULL),
					'jabatan'=> ($riwayat_jabatan_all?$riwayat_jabatan_all:NULL),
					'tufoksi'=> ($this->input->post('tufoksipengaju')?$this->input->post('tufoksipengaju'):NULL),
				);

				$this->db->insert($this->table,$arr);
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


public function update_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id= $this->input->get('id'); 
			$this->db->where('id_pengajuan',$id);
			$query=$this->db->update($this->table,array('status'=>Null));
			if($query){
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

public function delete_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			if(!empty($this->input->get('id'))){
//edit
				$id= $this->input->get('id'); 
				$this->db->where('id_pengajuan',$id);
				$this->db->update($this->table,array('tampilkan'=>'0'));

				$this->db->where('id_pengajuan',$id);
				$res = $this->db->get($this->table)->row();
			} 



			if($this->db->affected_rows() == '1'){
				$arr['id_persyaratan']=$res->id_persyaratan;
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
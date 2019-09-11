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

class Dokumen_entry extends REST_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/

public function save_atribut_utama_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id	= $this->input->post('id');

			$nama_kegiatan = ($this->input->post('nama_kegiatan'))?$this->input->post('nama_kegiatan'):null; 
			$lama_kegiatan = ($this->input->post('lama_kegiatan'))?$this->input->post('lama_kegiatan'):null;  
			$nilai_kegiatan = ($this->input->post('nilai_kegiatan'))?$this->input->post('nilai_kegiatan'):null;  
			$f_provinsi = ($this->input->post('f_provinsi'))?$this->input->post('f_provinsi'):null;  


			$cek = '';
			if(empty($cek)){
				$param=array( 
					"nama"=>$nama_kegiatan,
					"entry_id" => $id,
					"id_prov" => $f_provinsi,
					"nilai" => $nilai_kegiatan,
					"lama_kegiatan"=> $lama_kegiatan 
				);


				$this->db->insert('dokumen_entry_atribut_khusus',$param);
				$insert_id = $this->db->insert_id('dokumen_entry_atribut_khususnid_seq');

				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
					$arr['id']=$insert_id;
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				}
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah! ';
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}


			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function save_atribut_jalan_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id	= ($this->input->post('id'))?$this->input->post('id'):null;
			$txt_nomor = ($this->input->post('txt_nomor'))?$this->input->post('txt_nomor'):null; 
			$txt_nama = ($this->input->post('txt_nama'))?$this->input->post('txt_nama'):null; 
			$jenis_penanganan = ($this->input->post('jenis_penanganan'))?$this->input->post('jenis_penanganan'):null; 
			$panjang_penanganan = ($this->input->post('panjang_penanganan'))?$this->input->post('panjang_penanganan'):null; 
			$f_provinsi = ($this->input->post('f_provinsi'))?$this->input->post('f_provinsi'):null;
			$id_ruas =  ($this->input->post('id_ruas'))?$this->input->post('id_ruas'):null;
			$id_jembatan =  ($this->input->post('id_jembatan'))?$this->input->post('id_jembatan'):null;


			$cek = '';
			if(empty($cek)){
				$param=array( 
					"nama"=>$txt_nama,
					"entry_id" => $id,
					"id_prov" => $f_provinsi,
					"jenis_penanganan" => $jenis_penanganan,
					"panjang_penanganan"=> $panjang_penanganan,
					"nomor_jalan" => $txt_nomor,
					"id_ruas" => $id_ruas,
					"id_jembatan"=> $id_jembatan
				);


				$this->db->insert('dokumen_entry_atribut_jalan',$param);
				$insert_id = $this->db->insert_id('dokumen_entry_atribut_jalanid_seq');

				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
					$arr['id']=$insert_id;
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				}
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah! ';
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}


			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function edit_atribut_jalan_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id	= ($this->input->post('id'))?$this->input->post('id'):null;
			$id_atribut	= ($this->input->post('id_atribut'))?$this->input->post('id_atribut'):null;
			$txt_nomor = ($this->input->post('txt_nomor'))?$this->input->post('txt_nomor'):null; 
			$txt_nama = ($this->input->post('txt_nama'))?$this->input->post('txt_nama'):null; 
			$jenis_penanganan = ($this->input->post('jenis_penanganan'))?$this->input->post('jenis_penanganan'):null; 
			$panjang_penanganan = ($this->input->post('panjang_penanganan'))?$this->input->post('panjang_penanganan'):null; 
			$f_provinsi = ($this->input->post('f_provinsi'))?$this->input->post('f_provinsi'):null;
			$id_ruas =  ($this->input->post('id_ruas'))?$this->input->post('id_ruas'):null;
			$id_jembatan =  ($this->input->post('id_jembatan'))?$this->input->post('id_jembatan'):null;


			$cek = '';
			if(empty($cek)){
				$param=array( 
					"nama"=>$txt_nama,
					"entry_id" => $id,
					"id_prov" => $f_provinsi,
					"jenis_penanganan" => $jenis_penanganan,
					"panjang_penanganan"=> $panjang_penanganan,
					"nomor_jalan" => $txt_nomor,
					"id_ruas" => $id_ruas,
					"id_jembatan" => $id_jembatan
				);

				$this->db->where('id',$id_atribut);
				$this->db->update('dokumen_entry_atribut_jalan',$param);
				$insert_id = $this->db->insert_id();

				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil Dirubah!'; 
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Dirubah!';
				}
				$arr['id']=$id_atribut; 
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal Dirubah! ';
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}


			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function edit_atribut_utama_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$id	= ($this->input->post('id'))?$this->input->post('id'):null;
			$id_atribut	= ($this->input->post('id_atribut'))?$this->input->post('id_atribut'):null;
			$nama_kegiatan = ($this->input->post('nama_kegiatan'))?$this->input->post('nama_kegiatan'):null; 
			$lama_kegiatan = ($this->input->post('lama_kegiatan'))?$this->input->post('lama_kegiatan'):null;  
			$nilai_kegiatan = ($this->input->post('nilai_kegiatan'))?$this->input->post('nilai_kegiatan'):null;  
			$f_provinsi = ($this->input->post('f_provinsi'))?$this->input->post('f_provinsi'):null;  


			$cek = '';
			if(empty($cek)){
				$param=array( 
					"nama"=>$nama_kegiatan,
					"entry_id" => $id,
					"id_prov" => $f_provinsi,
					"nilai" => $nilai_kegiatan,
					"lama_kegiatan"=> $lama_kegiatan 
				);

				$this->db->where('id',$id_atribut);
				$this->db->update('dokumen_entry_atribut_khusus',$param);
				$insert_id = $this->db->insert_id();

				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil Dirubah!'; 
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Dirubah!';
				}
				$arr['id']=$id_atribut; 
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal Dirubah! ';
				$this->set_response($arr, REST_Controller::HTTP_OK);
			}


			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listatribututama_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');
			$id = $this->input->get('id');

			$this->db->select('dokumen_entry_atribut_khusus.*,m_provinsi.province_name');
			$this->db->join('m_provinsi','m_provinsi.province_id = dokumen_entry_atribut_khusus.id_prov','LEFT');
			if (!empty($id)) {
				$this->db->where('entry_id',$id);
			}
			$this->db->where('dokumen_entry_atribut_khusus.tampilkan','1');
			$res = $this->db->get('dokumen_entry_atribut_khusus')->result();
			$no=0;
			if(!empty($res)){
				foreach($res as $d){
					++$no;
					$arr[]=array('no'=>$no,
						'provinsi'=>$d->province_name,
						'id'=>$d->id,
						'nama'=>$d->nama,
						'nilai'=>number_format($d->nilai),
						'lama_kegiatan'=>$d->lama_kegiatan);
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

public function listatribututama2_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		$arr['result']='empty';
		if ($decodedToken != false) {

			$id = $this->input->get('id'); 

			if(!empty($id)){ 

				$this->db->join('m_provinsi','m_provinsi.province_id = dokumen_entry_atribut_khusus.id_prov');
				$this->db->where('entry_id',$id); 
				$this->db->where('dokumen_entry_atribut_khusus.tampilkan','1');
				$res = $this->db->get('dokumen_entry_atribut_khusus')->result();
				if(!empty($res)){
					$no=0;
					foreach($res as $dres){
						++$no;
						array('no'=>$no,
							'provinsi'=>$dres->province_name,
							'id'=>$dres->id,
							'nama'=>$dres->nama,
							'nilai'=>$dres->nilai,
							'lama_kegiatan'=>$dres->lama_kegiatan);
					}
				}else{
					$arr['result']='empty';
				}
			} 
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}
}

public function getatribututama_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		$arr['empty']='';
		if ($decodedToken != false) {

			$id = $this->input->get('id'); 

			if(!empty($id)){ 
				$this->db->select('dokumen_entry_atribut_khusus.*,m_provinsi.province_name,m_provinsi.province_id');
				$this->db->join('m_provinsi','m_provinsi.province_id = dokumen_entry_atribut_khusus.id_prov','LEFT');
				$this->db->where('dokumen_entry_atribut_khusus.id',$id); 
				$this->db->where('dokumen_entry_atribut_khusus.tampilkan','1');
				$res = $this->db->get('dokumen_entry_atribut_khusus')->result();
				foreach($res as $dres){
					$arr['list']=array('id_prov'=>$dres->province_id,'provinsi'=>$dres->province_name,'id'=>$dres->id,'nama'=>$dres->nama,'nilai'=>$dres->nilai,'lama_kegiatan'=>$dres->lama_kegiatan);
				}



			} 
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}
}

public function hapus_atribut_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id = $this->input->get('id'); 

			if(!empty($id)){

				$this->db->where('id',$id); 
				$this->db->update('dokumen_entry_atribut_khusus',array('tampilkan'=>'0'));


				$arr['hasil']='success';
				$arr['message']='Data berhasil Dihapus!';

			} 
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function hapus_file_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id = $this->input->get('id');
			$id_data = $this->input->get('id_data');

			if(!empty($id)){

				$this->db->where('id',$id); 
				$this->db->update('dokumen_entry_file',array('tampilkan'=>'0'));

				$this->db->join('sys_user','sys_user.id_user = dokumen_entry_file.author');
				$this->db->where('entry_id',$id_data);
//$this->db->where('dokumen_entry_file.author',$decodedToken->data->id);
				$this->db->where('dokumen_entry_file.tampilkan','1');
				$res = $this->db->get('dokumen_entry_file')->result();
				foreach($res as $dres){
					$arr['list'][]=array('author'=>$dres->name,'id'=>$dres->id,'nama'=>$dres->nama,'tanggal'=>$dres->tanggal);
				}

				$arr['hasil']='success';
				$arr['message']='Data berhasil Dihapus!';

			} 
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function list_entry_detail_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
			$this->db->select('dokumen_entry.*,DATE(tanggal_pembuatan) as tgl,DATE(JRA)as tgl_jra,
				dok_lokasi.alamat,dok_lokasi.nama,
				dok_lokasi.lantai,
				dok_lokasi.ruang,
				dok_lokasi.no_rak,
				dok_lokasi.no_rak,
				dok_lokasi.longitude,
				dok_lokasi.latitude');
			$this->db->join('dok_lokasi','dok_lokasi.id = dokumen_entry.id_lokasi','LEFT');
			$this->db->where('dokumen_entry.id',$_GET['id']); 
			$this->db->where('dokumen_entry.tampilkan','1');

			if($decodedToken->data->_pnc_id_grup <> '1'){
				$this->db->where('dokumen_entry.id_uk',$decodedToken->data->id_uk);
			} 


			$res = $this->db->get('dokumen_entry')->result();
			if(!empty($res)){
				foreach($res as $d){
					$arr['list_item']=array('id'=>$d->id,
						'judul'=>$d->judul,
						'no_dok'=>$d->no_dok,
						'tanggal_pembuatan'=>$d->tgl,
						'JRA'=>$d->tgl_jra,
						'cover_photo'=>$d->cover_photo,
						'id_uk'=>$d->id_uk,
						'tipe_media'=>$d->tipe_media,
						'kategori_dokumen'=>$d->kategori_dokumen,
						'format'=>$d->format,
						'status'=>$d->status,
						'id_lokasi'=>$d->id_lokasi,
						'deskripsi'=>$d->deskripsi,
						'keyword'=>$d->keyword,
						'id_area_akses'=>$d->id_area_akses,
						'gedung'=>$d->nama,
						'alamat'=>$d->alamat,
						'lantai'=>$d->lantai,
						'ruang'=>$d->ruang,
						'no_rak'=>$d->no_rak,
						'no_box'=>$d->lantai,
						'lat'=>$d->latitude,
						'lng'=>$d->longitude,
						'lati'=>$d->lat,
						'longi'=>$d->lng
					); 
					$this->db->join('sys_user','sys_user.id_user = dokumen_entry_file.author');
					$this->db->where('entry_id',$d->id);
					$this->db->where('dokumen_entry_file.tampilkan','1');
					$res = $this->db->get('dokumen_entry_file')->result();
					if(!empty($res)){


						foreach($res as $dres){
							$link_file='../sikumis_api/'.$dres->url;
							$arr['list'][]=array('author'=>$dres->name,'id'=>$dres->id,'nama'=>$link_file,'tanggal'=>$dres->tanggal);
						}
					}

				}



			}else{
				$arr['result'] ='empty';
			}
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function getatribut_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
			$this->db->select('dokumen_entry.*,DATE(tanggal_pembuatan) as tgl,DATE(JRA)as tgl_jra,
				dok_lokasi.alamat,dok_lokasi.nama,
				dok_lokasi.lantai,dok_lokasi.ruang,dok_lokasi.no_rak,dok_lokasi.no_rak,
				dok_lokasi.longitude,dok_lokasi.latitude,
				dok_master.nama as jenis_dok,dok_tipe.nama as nama_tipe

				');
			$this->db->join('dok_lokasi','dok_lokasi.id = dokumen_entry.id_lokasi','LEFT');
			$this->db->join('dok_master','dok_master.id = dokumen_entry.id_dok_master','LEFT');
			$this->db->join('dok_tipe','dok_tipe.id = dokumen_entry.id_dok_tipe','LEFT');
			$this->db->where('dokumen_entry.id',$_GET['id']); 
			$this->db->where('dokumen_entry.tampilkan','1');
//$this->db->where('dokumen_entry.user_group',$decodedToken->data->_pnc_id_grup);
			$res = $this->db->get('dokumen_entry')->result();
			if(!empty($res)){
				foreach($res as $d){
					$arr['list_item']=array('id'=>$d->id,
						'judul'=>$d->judul,
						'no_dok'=>$d->no_dok,
						'tanggal_pembuatan'=>date_format(date_create($d->tgl),"d-m-Y"),
						'JRA'=>$d->tgl_jra,
						'cover_photo'=>$d->cover_photo,
						'id_uk'=>$d->id_uk,
						'tipe_media'=>$d->tipe_media,
						'kategori_dokumen'=>$d->kategori_dokumen,
						'format'=>$d->format,
						'status'=>$d->status,
						'id_lokasi'=>$d->id_lokasi,
						'deskripsi'=>$d->deskripsi,
						'keyword'=>$d->keyword,
						'id_area_akses'=>$d->id_area_akses,
						'gedung'=>$d->nama,
						'alamat'=>$d->alamat,
						'lantai'=>$d->lantai,
						'ruang'=>$d->ruang,
						'no_rak'=>$d->no_rak,
						'no_box'=>$d->lantai,
						'lat'=>$d->latitude,
						'lng'=>$d->longitude,
						'jenis_dok' => $d->jenis_dok,
						'nama_tipe'=>$d->nama_tipe
					);

					$this->db->join('sys_user','sys_user.id_user = dokumen_entry_file.author');
					$this->db->where('entry_id',$d->id);
					$this->db->where('dokumen_entry_file.tampilkan','1');
					$res = $this->db->get('dokumen_entry_file')->result();
					if(!empty($res)){


						foreach($res as $dres){
							$arr['list'][]=array('author'=>$dres->name,'id'=>$dres->id,'nama'=>$dres->nama,'tanggal'=>$dres->tanggal);
						}
					}

				}



			}else{
				$arr['result'] ='empty';
			}
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function list_jalan_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');

			$this->db->select('dokumen_entry_atribut_jalan.*,m_provinsi.province_name,ruas_jalan.nama as nama_ruas');
			$this->db->order_by('dokumen_entry_atribut_jalan.id','ASC');

			$this->db->where('dokumen_entry_atribut_jalan.tampilkan','1');
			$this->db->join('m_provinsi','dokumen_entry_atribut_jalan.id_prov = m_provinsi.province_id');
			$this->db->join('ruas_jalan','ruas_jalan.link_id = dokumen_entry_atribut_jalan.id_ruas');
			$this->db->where('dokumen_entry_atribut_jalan.entry_id',$this->input->get('id'));
			$res = $this->db->get('dokumen_entry_atribut_jalan')->result();
			$no=0;
			if(!empty($res)){
				foreach($res as $d){
					++$no;
					$arr[]=array(
						'no'=>$no,
						'id'=>$d->id,
						"nama"=>$d->nama,
						"nama_ruas" => $d->nama_ruas,  
						"nama_propinsi" => $d->province_name,
						"jenis_penanganan"=> $d->jenis_penanganan,
						"panjang_penanganan" => $d->panjang_penanganan,
						"nomor_jalan" =>$d->nomor_jalan 

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

public function jalan_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');

			$this->db->select('dokumen_entry_atribut_jalan.*,m_provinsi.province_name,ruas_jalan.nama as nama_ruas');
			$this->db->order_by('dokumen_entry_atribut_jalan.id','ASC');

			$this->db->where('dokumen_entry_atribut_jalan.tampilkan','1');
			$this->db->join('m_provinsi','dokumen_entry_atribut_jalan.id_prov = m_provinsi.province_id');
			$this->db->join('ruas_jalan','ruas_jalan.link_id = dokumen_entry_atribut_jalan.id_ruas');
			$this->db->where('dokumen_entry_atribut_jalan.id',$this->input->get('id'));
			$res = $this->db->get('dokumen_entry_atribut_jalan')->result();
			$no=0;
			if(!empty($res)){
				foreach($res as $d){
					++$no;
					$arr[]=array(
						'no'=>$no,
						'id'=>$d->id,
						"nama"=>$d->nama,
						"id_ruas" => $d->id_ruas,  
						"id_prov" => $d->id_prov,
						"jenis_penanganan"=> $d->jenis_penanganan,
						"panjang_penanganan" => $d->panjang_penanganan,
						"nomor_jalan" =>$d->nomor_jalan ,
						"id_jembatan" =>$d->id_jembatan 

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

public function hapus_jalan_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id = $this->input->get('id'); 

			if(!empty($id)){

				$this->db->where('id',$id); 
				$this->db->update('dokumen_entry_atribut_jalan',array('tampilkan'=>'0'));


				$arr['hasil']='success';
				$arr['message']='Data berhasil Dihapus!';

			} 
		}
		$this->set_response($arr, REST_Controller::HTTP_OK);
		return ;
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

}
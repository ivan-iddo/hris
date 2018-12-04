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

class Pegawai extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */

	 function changepass_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		 
		if(!empty($id = $this->input->post('id_user'))){
					 if(!empty($this->input->post('passwordchn'))){
						$salt = round(rand()*1000);
				
						$password	= md5($this->input->post('passwordchn'));
						$this->db->where('id_user',$id);
						$this->db->update('sys_user',array('salt'=>$salt,'password'=>$password));
						if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Password Berhasil Dirubah!';
						 }else{
							$arr['hasil']='error';
							$arr['message']='Data Gagal Dirubah!';
						 }
					  

					 }
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	 }
  
	 function save_post(){
		 $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
			
							$f_id_edit	= $this->input->post('f_id_edit');
							$f_user_edit	= $this->input->post('f_user_edit');
							$f_user_name	= $this->input->post('f_user_name');
							$f_user_email = $this->input->post('f_user_email');
							$f_user_password	= $this->input->post('f_user_password');
							$f_user_status_aktif	= $this->input->post('f_user_status_aktif');
							$f_user_username	= $this->input->post('f_user_username');
							$inputphone	= $this->input->post('inputphone');
							$inputrt	= $this->input->post('inputrt');
							$inputrtktp	= $this->input->post('inputrtktp');
							$inputrw	= $this->input->post('inputrw');
							$inputrwktp	= $this->input->post('inputrwktp');
							$inputstatus	= $this->input->post('inputstatus');
							$instasi	= $this->input->post('instasi');
							$txtagama	= $this->input->post('txtagama');
							$txtAlamat	= $this->input->post('txtAlamat');
							$txtAlamatKtp	= $this->input->post('txtAlamatKtp');
							$txtbagian	= $this->input->post('txtbagian');
							$txtdirektorat	= $this->input->post('txtdirektorat');
							$txtgelarbelakang	= $this->input->post('txtgelarbelakang');
							$txtgelardepan	= $this->input->post('txtgelardepan');
							$txtgolongan	= $this->input->post('txtgolongan');
							$txtindex	= $this->input->post('txtindex');
							$txtjabatan	= $this->input->post('txtjabatan');
							$txtjabfung	= $this->input->post('txtjabfung');
							$unitkerja = $this->input->post('unitkerja');
							$txtkecamatan	= $this->input->post('txtkecamatan');
							$txtkecamatanktp	= $this->input->post('txtkecamatanktp');
							$txtkelamin	= $this->input->post('txtkelamin');
							$txtkelurahan	= $this->input->post('txtkelurahan');
							$txtkelurahanktp	= $this->input->post('txtkelurahanktp');
							$txtkota	= $this->input->post('txtkota');
							$txtkotaktp	= $this->input->post('txtkotaktp');
							$txtnik	= $this->input->post('txtnik');
							$txtnip	= $this->input->post('txtnip');
							$txtpendidikan	= $this->input->post('txtpendidikan');
							$txtperingkat	= $this->input->post('txtperingkat');
							$txtprov	= $this->input->post('txtprov');
							$txtprovktp	= $this->input->post('txtprovktp');
							$txttgllahir	= $this->input->post('txttgllahir');
							$txttlahir	= $this->input->post('txttlahir');
							$txttmtbergabung	= $this->input->post('txttmtbergabung');
							$txttmtcpns	= $this->input->post('txttmtcpns');
							$txttmtgolongan	= $this->input->post('txttmtgolongan');
							$txttmtjabatan	= $this->input->post('txttmtjabatan');
							$txttmtjabfung	= $this->input->post('txttmtjabfung');
							$txttmtpns= $this->input->post('txttmtpns');
							$id_bank	= $this->input->post('id_bank');
							$bpjs_kes	= $this->input->post('bpjs_kes');
							$bpjs_tk= $this->input->post('bpjs_tk');
						
							
							
							 
							if(!empty($unitkerja)){
								$group = $unitkerja;
							}elseif(!empty($txtbagian)){
								$group = $txtbagian;
							}elseif(!empty($txtdirektorat)){
								$group = $txtdirektorat;
							}
							
							 
							
							
				$id_aplikasi	= 1; 
				$user_id_klinik	= $decodedToken->data->_pnc_kode_klinik;
				$author		= $decodedToken->data->_pnc_username;
					
				$salt = round(rand()*1000);
				
				$password	= md5($f_user_password);
				
				$this->db->where('username',$f_user_username);
				$cek = $this->db->get('sys_user')->row();
				if(empty($cek)){
					$param=array( 
							"username"=>$f_user_username
							,"name"=>$f_user_name
							,"email"=>$f_user_email
							,"id_aplikasi"=>'1'
							,"id_grup"=>$group
							,"author"=>$author
							,"salt"=>$salt
							,"status"=>$f_user_status_aktif
							,"created"=>date('Y-m-d H:i:s')
							,"password"=>$password
							,"kode_klinik"=>$user_id_klinik
							,'id_uk' => $txtjabatan 
							,'id_shift' =>$this->input->post('id_shift') 
						);
					
					  
					 $this->db->insert('sys_user',$param);
					 $saved_id = $this->db->insert_id();
					 
					 if(!empty($saved_id)){
						$param_profile =array( 
							 'id_user'=> $saved_id,
							 'NIP' => $txtnip,
							 'NIK' => $txtnik,
							 'gelar_depan' => $txtgelardepan,
							 'gelar_belakang' => $txtgelarbelakang,
							 'tgl_lahir' => $txttgllahir,
							 'tempat_lahir' => $txttlahir,
							 'kelamin' => $txtkelamin,
							 'agama' => $txtagama,
							 'pendidikan_akhir' =>$txtpendidikan ,
							 'phone' => $inputphone,
							 'alamat_tinggal' => $txtAlamat,
							 'rt_tinggal' => $inputrt,
							 'rw_tinggal' => $inputrw,
							 'prov_tinggal' => $txtprov,
							 'kota_tinggal' => $txtkota,
							 'kec_tinggal' => $txtkecamatan,
							 'kel_tinggal' => $txtkelurahan,
							 'alamat_ktp' => $txtAlamatKtp,
							 'rt_ktp' => $inputrtktp,
							 'rw_ktp' => $inputrwktp,
							 'prov_ktp' => $txtprovktp,
							 'kota_ktp' => $txtkotaktp,
							 'kec_ktp' => $txtkecamatanktp,
							 'kel_ktp' => $txtkelurahanktp,
							 'id_bank' => $id_bank,
							 'bpjs_kes' => $bpjs_kes,
							 'bpjs_tk' => $bpjs_tk,
							 'no_rek' =>$this->input->post('no_rek'),
							 'kategori_profesi' =>$this->input->post('kategori_profesi'),
							 'NPWP' => $this->input->post('npwp'),
							 'id_profesi' =>$this->input->post('id_profesi'),
							 
						);
						$this->db->insert('sys_user_profile',$param_profile);
						
						$param_rd =array( 
							 'id_user'=> $saved_id,
							 'status_pegawai' =>$inputstatus,
							 'tmt_cpns' => $txttmtcpns,
							 'tmt_pns' => $txttmtpns,
							 'direktorat' => $txtdirektorat,
							 'bagian' => $txtbagian,
							 'sub_bagian' => $unitkerja,
							 'jabatan_asn' => $txtjabfung,
							 'subjabasn' => $this->input->post('subjabasn'),
							 'ketahli' => $this->input->post('ketahli'), 
							 'tmt_jabatan_asn' => $txttmtjabfung,
							 'jabatan_struktural' => $txtjabatan,
							 'tmt_jabatan' =>$txttmtjabatan,
							 'tgl_bergabung' => $txttmtbergabung,
							 'inst_asal' => $instasi,
							 'peringkat' => $txtperingkat,
							 'no_index_dok' => $txtindex,
							 'golongan' => $txtgolongan,
							 'tmt_golongan' => $txttmtgolongan,
							 'aktif' => '1' 
						);
						$this->db->insert('riwayat_kedinasan',$param_rd);
						
						
						
					 }
					
					 if(!empty($saved_id)){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
						$arr['id'] = $saved_id;
					 }else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
					 }
					$this->set_response($arr, REST_Controller::HTTP_OK);
					return;
				}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah! username sudah pernah digunakan';
					$this->set_response($arr, REST_Controller::HTTP_OK);
				}
		 
			
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
				  
				$this->db->select('sys_user.id_uk, 
							   sys_user.name,
							   sys_user.username,
							   sys_user.email,
							   sys_user.id_grup,
							   sys_user.status,
								sys_user.foto,
								sys_user.id_shift,
								sys_user.kd_keluar,
							   sys_user_profile.*,
							   riwayat_kedinasan.status_pegawai,
							   riwayat_kedinasan.direktorat,
							   riwayat_kedinasan.jabatan_asn,
							   riwayat_kedinasan.subjabasn,
							   riwayat_kedinasan.ketahli,
							   riwayat_kedinasan.jabatan_struktural,
							   riwayat_kedinasan.golongan,
							   riwayat_kedinasan.bagian,
							   riwayat_kedinasan.sub_bagian,
							   riwayat_kedinasan.tmt_cpns,
							   riwayat_kedinasan.tmt_pns,
							    riwayat_kedinasan.tmt_jabatan,
							    riwayat_kedinasan.tmt_jabatan_asn,
							    riwayat_kedinasan.tmt_golongan,
							    riwayat_kedinasan.tgl_bergabung,
							    riwayat_kedinasan.peringkat,
							    riwayat_kedinasan.no_index_dok,
							    uk_master.nama as nama_jabatan
							   ');
				$this->db->where('sys_user.id_user',$id);
				$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
				$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
				$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
				
				$this->db->where('riwayat_kedinasan.aktif','1');
				$res = $this->db->get('sys_user')->result();
				if(!empty($res)){
					foreach($res as $d){
						$arr[]=array('id_uk'=>$d->id_uk,
								  'id'=>$d->id_user,
								  'nama'=>$d->name,
								  'username'=>$d->username,
								  'email'=>$d->email,
								  'id_group'=>$d->id_grup,
								  'status'=> $d->status,
								  'kelamin'=> $d->kelamin,
								  'agama' => $d->agama,
								  'pendidikan' => $d->pendidikan_akhir,
								  'prov' => $d->prov_tinggal,
								  'kota' => $d->kota_tinggal,
								  'kecamatan' => $d->kec_tinggal,
								  'kelurahan' => $d->kel_tinggal,
								  'alamat_tinggal' => $d->alamat_tinggal,
								  'prov_ktp' => $d->prov_ktp,
								  'status_pegawai' => $d->status_pegawai,
								  'direktorat' => $d->direktorat,
								  'jabatan_asn' => $d->jabatan_asn,
								  'jabatan_struktural'=> $d->jabatan_struktural,
								  'golongan' => $d->golongan,
								  'bagian' => $d->bagian,
								  'sub_bagian'=>$d->sub_bagian,
								  'tmt_cpns'=> $d->tmt_cpns,
								  'tmt_pns' => $d->tmt_pns,
								  'tmt_jabatan' => $d->tmt_jabatan,
								  'tmt_jabatan_asn'=>$d->tmt_jabatan_asn,
								  'tmt_golongan'=> $d->tmt_golongan,
								  'tgl_bergabung'=> $d->tgl_bergabung,
								  'peringkat' => $d->peringkat,
								  'no_index_dok'=>$d->no_index_dok,
								  'rt_tinggal'=> $d->rt_tinggal,
								  'rw_tinggal' => $d->rw_tinggal,
								  'rt_ktp'=> $d->rt_ktp,
								  'rw_ktp' => $d->rw_ktp,
								  'alamat_ktp' => $d->alamat_ktp,
								  'NIP' => $d->NIP,
								  'NIK' => $d->NIK,
								  'gelar_depan'=> $d->gelar_depan,
								  'kategori_profesi'=> $d->kategori_profesi,
								  'gelar_belakang' => $d->gelar_belakang,
								  'tgl_lahir'=> $d->tgl_lahir,
								  'tempat_lahir'=> $d->tempat_lahir,
								  'phone'=>$d->phone,
								  'kota_ktp' => $d->kota_ktp,
								  'kecamatan_ktp' => $d->kec_ktp,
								  'kelurahan_ktp' => $d->kel_ktp,
								  'foto' => 'api/upload/data/'.$d->foto,
								  'jabatan' => $d->nama_jabatan,
								  'id_bank' => $d->id_bank,
								  'bpjs_kes' => $d->bpjs_kes,
								  'bpjs_tk' => $d->bpjs_tk,
								  'no_rek' => $d->no_rek,
								  'kd_keluar' => $d->kd_keluar,
								  'id_shift' => $d->id_shift,
								  'npwp' => $d->NPWP,
								  'id_profesi' => $d->id_profesi,
								  'subjabasn' => $d->subjabasn,
								  'ketahli' => $d->ketahli,
								  'id_user'  => $d->id_user,
								  
								  
								  );
					  }
					   
				}else{
					$arr['hasil']='error';
				}
				
				$this->set_response($arr, REST_Controller::HTTP_OK);
		 
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	  
	}
	
	
	function edit_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
			$user_id_klinik	= $decodedToken->data->_pnc_kode_klinik;
				$author		= $decodedToken->data->_pnc_username;
				
			$id = $f_id_edit	= $this->input->post('f_id_edit');
							$f_user_edit	= $this->input->post('f_user_edit');
							$f_user_name	= $this->input->post('f_user_name');
							$f_user_email = $this->input->post('f_user_email');
							$f_user_password	= $this->input->post('f_user_password');
							$f_user_status_aktif	= $this->input->post('f_user_status_aktif');
							$f_user_username	= $this->input->post('f_user_username');
							$inputphone	= $this->input->post('inputphone');
							$inputrt	= $this->input->post('inputrt');
							$inputrtktp	= $this->input->post('inputrtktp');
							$inputrw	= $this->input->post('inputrw');
							$inputrwktp	= $this->input->post('inputrwktp');
							$inputstatus	= $this->input->post('inputstatus');
							$instasi	= $this->input->post('instasi');
							$txtagama	= $this->input->post('txtagama');
							$txtAlamat	= $this->input->post('txtAlamat');
							$txtAlamatKtp	= $this->input->post('txtAlamatKtp');
							$txtbagian	= $this->input->post('txtbagian');
							$txtdirektorat	= $this->input->post('txtdirektorat');
							$txtgelarbelakang	= $this->input->post('txtgelarbelakang');
							$txtgelardepan	= $this->input->post('txtgelardepan');
							$txtgolongan	= $this->input->post('txtgolongan');
							$txtindex	= $this->input->post('txtindex');
							$txtjabatan	= $this->input->post('txtjabatan');
							$txtjabfung	= $this->input->post('txtjabfung');
							$unitkerja = $this->input->post('unitkerja');
							$txtkecamatan	= $this->input->post('txtkecamatan');
							$txtkecamatanktp	= $this->input->post('txtkecamatanktp');
							$txtkelamin	= $this->input->post('txtkelamin');
							$txtkelurahan	= $this->input->post('txtkelurahan');
							$txtkelurahanktp	= $this->input->post('txtkelurahanktp');
							$txtkota	= $this->input->post('txtkota');
							$txtkotaktp	= $this->input->post('txtkotaktp');
							$txtnik	= $this->input->post('txtnik');
							$txtnip	= $this->input->post('txtnip');
							$txtpendidikan	= $this->input->post('txtpendidikan');
							$txtperingkat	= $this->input->post('txtperingkat');
							$txtprov	= $this->input->post('txtprov');
							$txtprovktp	= $this->input->post('txtprovktp');
							$txttgllahir	= $this->input->post('txttgllahir');
							$txttlahir	= $this->input->post('txttlahir');
							$txttmtbergabung	= $this->input->post('txttmtbergabung');
							$txttmtcpns	= $this->input->post('txttmtcpns');
							$txttmtgolongan	= $this->input->post('txttmtgolongan');
							$txttmtjabatan	= $this->input->post('txttmtjabatan');
							$txttmtjabfung	= $this->input->post('txttmtjabfung');
							$txttmtpns= $this->input->post('txttmtpns');
							$id_bank	= $this->input->post('id_bank');
							$bpjs_kes	= $this->input->post('bpjs_kes');
							$bpjs_tk= $this->input->post('bpjs_tk');
							
							
							
							 
							if(!empty($unitkerja)){
								$group = $unitkerja;
							}elseif(!empty($txtbagian)){
								$group = $txtbagian;
							}elseif(!empty($txtdirektorat)){
								$group = $txtdirektorat;
							}
			
					$salt = round(rand()*1000);
						if(!empty($f_user_password)){
							$password	= md5($f_user_password);
							$paramss['password'] = $password;
							$paramss['salt'] = $salt;
						}
				
				if($f_user_username != $f_user_edit){ 
				$this->db->where('username',$f_user_username);
				$cek = $this->db->get('sys_user')->row();
				}else{
					$cek='';
				}
				
				$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
				
				if(empty($cek)){
				
					$dataedit = $param=array( 
							"username"=>$f_user_username
							,"name"=>$f_user_name
							,"email"=>$f_user_email
							,"id_aplikasi"=>'1'
							,"id_grup"=>$group
							,"author"=>$author 
							,"status"=>$f_user_status_aktif 
							,"kode_klinik"=>$user_id_klinik
							,'id_uk' => $txtjabatan
							,'id_shift' =>$this->input->post('id_shift') 
						);	 
				 $this->db->where('id_user',$id);
				 if(!empty($paramss)){
					 $dataedit= $param+$paramss;
				 }
				 $this->db->update('sys_user',$dataedit);
				 
				 //simpan profile:
				 
				 $param_profile =array(  
							 'NIP' => $txtnip,
							 'NIK' => $txtnik,
							 'gelar_depan' => $txtgelardepan,
							 'gelar_belakang' => $txtgelarbelakang,
							 'tgl_lahir' => $txttgllahir,
							 'tempat_lahir' => $txttlahir,
							 'kelamin' => $txtkelamin,
							 'agama' => $txtagama,
							 'pendidikan_akhir' =>$txtpendidikan ,
							 'phone' => $inputphone,
							 'alamat_tinggal' => $txtAlamat,
							 'rt_tinggal' => $inputrt,
							 'rw_tinggal' => $inputrw,
							 'prov_tinggal' => $txtprov,
							 'kota_tinggal' => $txtkota,
							 'kec_tinggal' => $txtkecamatan,
							 'kel_tinggal' => $txtkelurahan,
							 'alamat_ktp' => $txtAlamatKtp,
							 'rt_ktp' => $inputrtktp,
							 'rw_ktp' => $inputrwktp,
							 'prov_ktp' => $txtprovktp,
							 'kota_ktp' => $txtkotaktp,
							 'kec_ktp' => $txtkecamatanktp,
							 'kel_ktp' => $txtkelurahanktp ,
							 'id_bank' => $id_bank,
							 'bpjs_kes' => $bpjs_kes,
							 'bpjs_tk' => $bpjs_tk,
							 'no_rek' =>$this->input->post('no_rek'),
							 'kategori_profesi' =>$this->input->post('kategori_profesi'), 
							 'NPWP' => $this->input->post('npwp'),
							 'id_profesi' =>$this->input->post('id_profesi'),
						);
				 
				 $this->db->where('id_user',$id);
				 $this->db->update('sys_user_profile',$param_profile);
				 
				 //simpan detail riwayat pegawai
				 
				 
				 $param_rd =array(  
							 'status_pegawai' =>$inputstatus,
							 'tmt_cpns' => $txttmtcpns,
							 'tmt_pns' => $txttmtpns,
							 'direktorat' => $txtdirektorat,
							 'bagian' => $txtbagian,
							 'sub_bagian' => $unitkerja,
							 'jabatan_asn' => $txtjabfung, 
							 'subjabasn' => $this->input->post('subjabasn'),
							 'ketahli' => $this->input->post('ketahli'), 
							 'tmt_jabatan_asn' => $txttmtjabfung,
							 'jabatan_struktural' => $txtjabatan,
							 'tmt_jabatan' =>$txttmtjabatan,
							 'tgl_bergabung' => $txttmtbergabung,
							 'inst_asal' => $instasi,
							 'peringkat' => $txtperingkat,
							 'no_index_dok' => $txtindex,
							 'golongan' => $txtgolongan,
							 'tmt_golongan' => $txttmtgolongan,
							 'aktif' => '1' 
						); 
						 $this->db->where('id_user',$id);
						 $this->db->where('aktif','1');
						 $this->db->update('riwayat_kedinasan',$param_rd);
				 
						    $arr['hasil']='success';
						    $arr['id'] = $id;
						    $arr['message']='Penyimpanan Berhasil!';
						 
				 
				 
				}
		  
				$this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function getkeluarga_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		 
		if(!empty($id = $this->uri->segment(3))){
					$this->db->where('his_keluarga.id',$id);
				}
		  $res = $this->db->get('his_keluarga')->result();
		  foreach($res as $d){
			$arr=array('id'=>$d->id,
					   'nama'=>$d->nama,
					   'kelamin'=>$d->kelamin,
					   'NIK'=>$d->NIK,
					   'pendidikan'=> $d->id_pendidikan,
					   'hubkel'=> $d->id_hubkel,
					   'pekerjaan'=> $d->id_pekerjaan,
					   'tpt_lahir'=> $d->tempat_lahir,
					   'tgl_lahir'=> $d->tgl_lahir,
					   );
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function savekeluarga_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array(
				   'id_user'=>$this->input->post('id_user'),
				   'NIK'=>$this->input->post('txtNik'),
				   'nama'=>$this->input->post('txtNama'),
				   'tempat_lahir'=>$this->input->post('txtTptLahir'),
				   'tgl_lahir'=>$this->input->post('txtTglLahir'),
				   'kelamin'=>$this->input->post('txtKelamin'),
				   'id_pendidikan'=>$this->input->post('txtPendidikan'),
				   'id_pekerjaan'=>$this->input->post('txtPekerjaan'),
				   'id_hubkel'=>$this->input->post('txtHubungan'), 
				   );
			  $this->db->insert('his_keluarga',$arrdata);
			  
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
	
	public function listkeluarga_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		$this->db->select('his_keluarga.*,m_kelamin.nama as gender,m_pendidikan.nama as nama_pendidikan,
					   m_hubungan_keluarga.nama as hubkel,
					   m_pekerjaan.nama as pekerjaan'); 
		$this->db->join('m_kelamin','m_kelamin.id = his_keluarga.kelamin','LEFT');
		$this->db->join('m_pendidikan','m_pendidikan.id = his_keluarga.id_pendidikan','LEFT');
		$this->db->join('m_hubungan_keluarga','m_hubungan_keluarga.id = his_keluarga.id_hubkel','LEFT');
		$this->db->join('m_pekerjaan',' m_pekerjaan.id = his_keluarga.id_pekerjaan','LEFT');
		$this->db->where('his_keluarga.tampilkan','1');
		if(!empty($id = $this->uri->segment(3))){
					$this->db->where('his_keluarga.id_user',$id);
				}
		  $res = $this->db->get('his_keluarga')->result();
		  foreach($res as $d){
			$arr[]=array('id'=>$d->id,'nama'=>$d->nama,'kelamin'=>$d->gender,'NIK'=>$d->NIK,
					   'pendidikan'=> $d->nama_pendidikan,
					   'hubkel'=> $d->hubkel,
					   'pekerjaan'=> $d->pekerjaan,
					   'tpt_lahir'=> $d->tempat_lahir,
					   'tgl_lahir'=> $d->tgl_lahir,
					   );
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	
	function editkeluarga_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array( 
				   'NIK'=>$this->input->post('txtNik'),
				   'nama'=>$this->input->post('txtNama'),
				   'tempat_lahir'=>$this->input->post('txtTptLahir'),
				   'tgl_lahir'=>$this->input->post('txtTglLahir'),
				   'kelamin'=>$this->input->post('txtKelamin'),
				   'id_pendidikan'=>$this->input->post('txtPendidikan'),
				   'id_pekerjaan'=>$this->input->post('txtPekerjaan'),
				   'id_hubkel'=>$this->input->post('txtHubungan'), 
				   );
			  
			  $this->db->where('id',$this->uri->segment(3));
			  $this->db->update('his_keluarga',$arrdata);
			  
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
	
	function deletekeluarga_get(){
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
			  $this->db->update('his_keluarga',$arrdata);
			  
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
	
	///////////////////////////////////////PENDIDIKAN
	function savependidikan_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array(
				   'id_user'=>$this->input->post('id_user'),
				   'pen_name'=>$this->input->post('txtNamaSekolah'), 
				   'pen_tahn'=>$this->input->post('txtTahunLulus'),
				   'pen_nijz'=>$this->input->post('txtNoIjazah'),
				   'pen_dijz'=>$this->input->post('txtTglIjazah'),
				   'pen_nkep'=>$this->input->post('txtKepalaSekolah'),
				   'pen_desc'=>$this->input->post('txtStatusLulus'),
				   'pen_lijzh'=>$this->input->post('txtHubungan'),
				   'pen_code' => $this->input->post('txtJPend'),
				   );
			  
			  $this->db->insert('his_pendidikan',$arrdata);
			  $saved_id = $this->db->insert_id();
			  
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
	
	public function listpendidikan_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		$this->db->select('his_pendidikan.*,dm_term.nama as namaPendidikan,m_status_lulus.nama as status'); 
		$this->db->join('m_status_lulus','m_status_lulus.id = his_pendidikan.pen_desc','LEFT');
		$this->db->join('dm_term','dm_term.id = his_pendidikan.pen_code','LEFT'); 
		$this->db->where('his_pendidikan.tampilkan','1');
		if(!empty($id = $this->uri->segment(3))){
					$this->db->where('his_pendidikan.id_user',$id);
				}
		  $res = $this->db->get('his_pendidikan')->result();
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
	
	function editpendidikan_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  $arrdata=array( 
				   'pen_name'=>$this->input->post('txtNamaSekolah'), 
				   'pen_tahn'=>$this->input->post('txtTahunLulus'),
				   'pen_nijz'=>$this->input->post('txtNoIjazah'),
				   'pen_dijz'=>$this->input->post('txtTglIjazah'),
				   'pen_nkep'=>$this->input->post('txtKepalaSekolah'),
				   'pen_desc'=>$this->input->post('txtStatusLulus'),
				   'pen_lijzh'=>$this->input->post('txtHubungan'),
				   'pen_code' => $this->input->post('txtJPend'),
				   );
			   
			  
			  $this->db->where('id',$this->uri->segment(3));
			  $this->db->update('his_pendidikan',$arrdata);
			  
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
	
	function getpendidikan_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 $arr=array();
		 
		if(!empty($id = $this->uri->segment(3))){
					$this->db->where('his_pendidikan.id',$id);
				}
		  $res = $this->db->get('his_pendidikan')->result();
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
					   'file' => $d->file_url 
					   
					   );
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function deletependidikan_get(){
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
			  $this->db->update('his_pendidikan',$arrdata);
			  
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

	function setpendidikan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				if ($decodedToken != false) {
				 
			  
			  
			  $this->db->where('id',$_GET['id']);
			  $res = $this->db->get('his_pendidikan')->row();
			  
			  $this->db->where('id_user',$this->input->get('user_id'));
			  $this->db->update('sys_user_profile',array('pendidikan_akhir'=>$res->pen_code));

			  
			   if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil diupdate!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Dirubah!';
				 }
			  
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	function savemutasi_post(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			 
			if ($decodedToken != false) {
			 
		  $arrdata=array( 
			   'tampilkan'=>'0'
			   );
		   
			   //cari dulu diriwayat kedinasan
			   if(!empty($id=$this->input->post('txtIdUser'))){
				$this->db->where('id_user',$this->input->post('txtIdUser'));
				$res = $this->db->get('riwayat_kedinasan')->row();

				$direktorat_asal = '';
				$bagian_asal = '';
				$sub_bagian_asal = '';
				
				if(!empty($res)){
					$direktorat_asal = $res->direktorat;
					$bagian_asal = $res->bagian;
					$sub_bagian_asal = $res->sub_bagian;
				}
 
				$this->db->where('user_id',$id); 
				$this->db->where('status <>','91'); 
				$cekmutasi = $this->db->get('abk_req_mutasi_jabatan')->row();

				 if(!empty($cekmutasi)){
					$arr['hasil']='error';
					$arr['message']='Data gagal disimpan,pegawai sedang dalam proses mutasi juga!';
				 }else{
					 
				 
					$arrdata = array(
						'user_id' => $id,
						'direktorat_asal' => $direktorat_asal,
						'bagian_asal' => $bagian_asal,
						'sub_bagian_asal' => $sub_bagian_asal,
						'direktorat_tujuan' => $this->input->post('txtdirektorat'),
						'bagian_tujuan' => $this->input->post('txtbagian'),
						'sub_bagian_tujuan' => $this->input->post('unitkerja'),
						'tgl_mutasi' => $this->input->post('tgl_mutasi'),
						'keterangan' => $this->input->post('keterangan'),
						'tgl_sk'=>$this->input->post('tgl_sk'),
						'no_sk'=>$this->input->post('no_sk'),
						'id_satker'=>$this->input->post('satuan_kerja'),
						'id_kelas'=> $this->input->post('kelas_jabatan'),
						'jabatan_struktural' => $this->input->post('txtjabatan'),
						'jenis_mutasi' => $this->input->post('jenis_mutasi'),
						'status'=>'88',
						'grup' => $decodedToken->data->_pnc_id_grup,
						'author' => $decodedToken->data->id
					);
	 
			 	$this->db->insert('abk_req_mutasi_jabatan',$arrdata);
					 
	
						if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Data berhasil ditambah!';
						}else{
							$arr['hasil']='error';
							$arr['message']='Data Gagal Ditambahhhh!';
						}

				 }

			   }
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	function editmutasi_post(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			if ($decodedToken != false) {
			 
		    
			   //cari dulu diriwayat kedinasan
			   if(!empty($id=$this->input->post('txtIdUser'))){
				$this->db->where('id_user',$this->input->post('txtIdUser'));
				$res = $this->db->get('riwayat_kedinasan')->row();

				$direktorat_asal = '';
				$bagian_asal = '';
				$sub_bagian_asal = '';
				
				if(!empty($res)){
					$direktorat_asal = $res->direktorat;
					$bagian_asal = $res->bagian;
					$sub_bagian_asal = $res->sub_bagian;
				}

				//cek dulu kalau ada yg aktif non aktifkan dulu
				 

					$arrdata = array(
						'user_id' => $id,
						'direktorat_asal' => $direktorat_asal,
						'bagian_asal' => $bagian_asal,
						'sub_bagian_asal' => $sub_bagian_asal,
						'direktorat_tujuan' => $this->input->post('txtdirektorat'),
						'bagian_tujuan' => $this->input->post('txtbagian'),
						'sub_bagian_tujuan' => $this->input->post('unitkerja'),
						'tgl_mutasi' => $this->input->post('tgl_mutasi'),
						'keterangan' => $this->input->post('keterangan'),
						'tgl_sk'=>$this->input->post('tgl_sk'),
						'no_sk'=>$this->input->post('no_sk'),
						'id_satker'=>$this->input->post('satuan_kerja'),
						'id_kelas'=> $this->input->post('kelas_jabatan'),
						'jabatan_struktural' => $this->input->post('txtjabatan'),
						'status'=>$this->input->post('statusproses'),
						'jenis_mutasi'=>$this->input->post('jenis_mutasi')
					);
 
					
					$this->db->where('id',$this->input->post('idtk'));
					$this->db->where_in('status',array('88','89','101'));
					$this->db->update('abk_req_mutasi_jabatan',$arrdata);
					 
	
						if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Data berhasil dikirim!';
						}else{
							$arr['hasil']='error';
							$arr['message']='Hanya status baru / ditolak HRD saja yg bisa melakukan kirim ulang!';
						}

				 
				 
				

			   }
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function updatestatusmutasi_get(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			if ($decodedToken != false) {
			 
		    
			   

				//cek dulu kalau ada yg aktif non aktifkan dulu
				 

					$arrdata = array( 
						'status'=>$this->input->get('status')
					);
 
					
					$this->db->where('id',$this->input->get('id'));
					$this->db->update('abk_req_mutasi_jabatan',$arrdata);
					 
	
						if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Data berhasil dikirim!';
						}else{
							$arr['hasil']='error';
							$arr['message']='Data Gagal dikirim!';
						}

				 
				 
				
 
			   
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	function savemutasifinal_post(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			if ($decodedToken != false) {
			 
		  $arrdata=array( 
			   'tampilkan'=>'0'
			   );
		   
			   //cari dulu diriwayat kedinasan
			   if(!empty($id=$this->input->post('txtIdUser'))){
				$this->db->where('id_user',$this->input->post('txtIdUser'));
				$res = $this->db->get('riwayat_kedinasan')->row();

				$direktorat_asal = '';
				$bagian_asal = '';
				$sub_bagian_asal = '';
				
				if(!empty($res)){
					$direktorat_asal = $res->direktorat;
					$bagian_asal = $res->bagian;
					$sub_bagian_asal = $res->sub_bagian;
				}

				//cek dulu kalau ada yg aktif non aktifkan dulu
				$this->db->where('user_id',$id);
				$this->db->where('aktif','1');
				$cekmutasi = $this->db->update('his_mutasi_jabatan',array('aktif'=>'0'));

				 
				 
				$arrdata = array(
					'user_id' => $id,
					'direktorat_asal' => $direktorat_asal,
					'bagian_asal' => $bagian_asal,
					'sub_bagian_asal' => $sub_bagian_asal,
					'direktorat_tujuan' => $this->input->post('txtdirektorat'),
					'bagian_tujuan' => $this->input->post('txtbagian'),
					'sub_bagian_tujuan' => $this->input->post('unitkerja'),
					'tgl_mutasi' => $this->input->post('tgl_mutasi'),
					'keterangan' => $this->input->post('keterangan'),
					'tgl_sk'=>$this->input->post('tgl_sk'),
					'no_sk'=>$this->input->post('no_sk'),
					'id_satker'=>$this->input->post('satuan_kerja'),
					'id_kelas'=> $this->input->post('kelas_jabatan'),
					'jabatan_struktural' => $this->input->post('txtjabatan')
				);

				$this->db->insert('his_mutasi_jabatan',$arrdata);
				$unitkerja = $this->input->post('unitkerja');
				$txtbagian = $this->input->post('txtbagian');
				$txtdirektorat = $this->input->post('txtdirektorat');

				if(!empty($res->id)){
					//update riwayat_kedinasan yg lama kasih flag 0 dan masukkan yg baru
					$param_rd =array( 
						'id_user'=> $id,
						'status_pegawai' =>$res->status_pegawai,
						'tmt_cpns' => $res->tmt_cpns,
						'tmt_pns' => $res->tmt_pns,
						'direktorat' => $txtdirektorat,
						'bagian' => $txtbagian,
						'sub_bagian' => $unitkerja,
						'jabatan_asn' => $res->jabatan_asn,
						'tmt_jabatan_asn' => $res->tmt_jabatan_asn, 
						'tmt_jabatan' =>$res->tmt_jabatan,
						'tgl_bergabung' => $this->input->post('tgl_mutasi'),
						'inst_asal' => $res->inst_asal,
						'peringkat' => $res->peringkat,
						'no_index_dok' => $res->no_index_dok,
						'golongan' => $res->golongan,
						'tmt_golongan' => $res->tmt_golongan,
						'jabatan_struktural' => $this->input->post('txtjabatan'),
						'aktif' => '1' 
				   );
				   $this->db->insert('riwayat_kedinasan',$param_rd);

				   $this->db->where('id',$res->id); 
				   $this->db->update('riwayat_kedinasan',array('aktif'=>'0'));

				}

				//update user
				

				if(!empty($unitkerja)){
					$group = $unitkerja;
				}elseif(!empty($txtbagian)){
					$group = $txtbagian;
				}elseif(!empty($txtdirektorat)){
					$group = $txtdirektorat;
				}

				$this->db->where('id_user',$id);
				$this->db->update('sys_user',array('id_grup'=>$group));



					if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
					}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
					}

			   }
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function listmutasi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
				$group = $decodedToken->data->_pnc_id_grup;
		
		$this->db->join('sys_user','sys_user.id_user = his_mutasi_jabatan.user_id','LEFT');
		$this->db->where('sys_user.status','1');
		 if(!empty($this->uri->segment(3))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(3)); 
		 }
		$total_rows = $this->db->count_all_results('his_mutasi_jabatan');
		$pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
		abk_req_mutasi_jabatan.id as idmutasi,
		b.grup as bag_asal,
		c.grup as subbag_asal,
		d.grup as dir_tujuan,
		e.grup as bag_tujuan,
		f.grup as subbag_tujuan,
		dt.nama as namastatus,
		jm.nama as namamutasi');
		$this->db->join('sys_grup_user as f','f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as e','e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as d','d.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan','LEFT');
		$this->db->join('sys_grup_user as c','c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal','LEFT');
		$this->db->join('sys_grup_user as b','b.id_grup = abk_req_mutasi_jabatan.bagian_asal','LEFT');
		$this->db->join('sys_grup_user as a','a.id_grup = abk_req_mutasi_jabatan.direktorat_asal','LEFT');
		$this->db->join('dm_term as dt','dt.id = abk_req_mutasi_jabatan.status','LEFT');
		$this->db->join('dm_term as jm','abk_req_mutasi_jabatan.jenis_mutasi = jm.id','LEFT');
		if(!empty($this->uri->segment(3))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(3)); 
		 }

		 $this->db->join('sys_user','sys_user.id_user = abk_req_mutasi_jabatan.user_id','LEFT');
		$this->db->where('sys_user.status','1');
		$this->db->where('YEAR(abk_req_mutasi_jabatan.tgl_mutasi)',date('Y'));
		
		if(($group <> '1') AND ($group<>'6')){
			$this->db->where('abk_req_mutasi_jabatan.grup',$group);
			
		} 

		if(!empty($this->input->get('status'))){
			$this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
		}
		

		$this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi','DESC');
		
		  $res = $this->db->get('abk_req_mutasi_jabatan')->result();
		  foreach($res as $d){
			$arr['result'][]=array(
				'id'=>$d->idmutasi,
								   'nama'=>$d->name, 
								   'dir_asal' => $d->dir_asal,
								   'tgl' => $d->tgl_mutasi,
								   'bag_asal' => $d->bag_asal,
								   'subbag_asal' => $d->subbag_asal,
								   'dir_tujuan' => $d->dir_tujuan,
								   'bag_tujuan' => $d->bag_tujuan,
								   'subbag_tujuan' => $d->subbag_tujuan,
								   'keterangan' => $d->keterangan,
								   'status'=>$d->namastatus,
								   'jm' => $d->namamutasi
								   );
		  }
		 
		  $arr['total']=$total_rows;
		  $arr['paging'] = $pagination['limit'][1];
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function listmutasidireksi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
				$group = $decodedToken->data->_pnc_id_grup;
		
		$this->db->join('sys_user','sys_user.id_user = his_mutasi_jabatan.user_id','LEFT');
		$this->db->where('sys_user.status','1');
		 if(!empty($this->uri->segment(3))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(3)); 
		 }
		$total_rows = $this->db->count_all_results('his_mutasi_jabatan');
		$pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
		abk_req_mutasi_jabatan.id as idmutasi,
		abk_req_mutasi_jabatan.direktorat_tujuan,
		abk_req_mutasi_jabatan.direktorat_asal,
		abk_req_mutasi_jabatan.status as stat,
		b.grup as bag_asal,
		c.grup as subbag_asal,
		d.grup as dir_tujuan,
		e.grup as bag_tujuan,
		f.grup as subbag_tujuan,
		dt.nama as namastatus,
		jm.nama as namamutasi');
		$this->db->join('sys_grup_user as f','f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as e','e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as d','d.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan','LEFT');
		$this->db->join('sys_grup_user as c','c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal','LEFT');
		$this->db->join('sys_grup_user as b','b.id_grup = abk_req_mutasi_jabatan.bagian_asal','LEFT');
		$this->db->join('sys_grup_user as a','a.id_grup = abk_req_mutasi_jabatan.direktorat_asal','LEFT');
		$this->db->join('dm_term as dt','dt.id = abk_req_mutasi_jabatan.status','LEFT');
		$this->db->join('dm_term as jm','abk_req_mutasi_jabatan.jenis_mutasi = jm.id','LEFT');
		if(!empty($this->uri->segment(3))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(3)); 
		 }

		 $this->db->join('sys_user','sys_user.id_user = abk_req_mutasi_jabatan.user_id','LEFT');
		$this->db->where('sys_user.status','1');
		$this->db->where('YEAR(abk_req_mutasi_jabatan.tgl_mutasi)',date('Y'));
	 
		if(($group <> '1') AND ($group<>'6')){

			 $this->db->where('abk_req_mutasi_jabatan.direktorat_asal',$group);
			 $this->db->or_where('abk_req_mutasi_jabatan.direktorat_tujuan',$group);
			

			
		} 

		if(!empty($this->input->get('status'))){
			//$this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
		}
		

		$this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi','DESC');
		
		  $res = $this->db->get('abk_req_mutasi_jabatan')->result();

		  
		  foreach($res as $d){
			// echo $group.' =='. $d->direktorat_tujuan;
		 
			$tampil ='false';
			  if(($group == $d->direktorat_tujuan) AND ($d->stat =='88')) {
				$tampil ='true';
			  }

			  if(($group == $d->direktorat_tujuan) AND ($d->stat =='105')) {
				  
				$tampil ='true';

				}
			  
			  if(($group == $d->direktorat_asal) AND ($d->stat =='88')){
				$tampil ='true';
			  }

			  if($tampil=='true'){
				$arr['result'][]=array(
					'id'=>$d->idmutasi,
									   'nama'=>$d->name, 
									   'dir_asal' => $d->dir_asal,
									   'tgl' => $d->tgl_mutasi,
									   'bag_asal' => $d->bag_asal,
									   'subbag_asal' => $d->subbag_asal,
									   'dir_tujuan' => $d->dir_tujuan,
									   'bag_tujuan' => $d->bag_tujuan,
									   'subbag_tujuan' => $d->subbag_tujuan,
									   'keterangan' => $d->keterangan,
									   'status'=>$d->namastatus,
									   'jm' => $d->namamutasi
									   );
			  }
			
		  }
		 
		  $arr['total']=$total_rows;
		  $arr['paging'] = $pagination['limit'][1];
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function cekcuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$id_cuti = $this->input->get('id');
					$id_user = $this->input->get('id_user');
					$tahun = date('Y');

					if($id_cuti !=='1'){
						$arr['message'] ='<div class="alert alert-success">Anda memiliki sisa cuti <strong> 12  Hari</strong></div>';
						$arr['jumlah'] = 12;
					   
			  
						return  $this->set_response($arr, REST_Controller::HTTP_OK);	
			  
					}
					
					 $this->db->where('id',$id_cuti);
					 $this->db->where('tampilkan','1');

				   $res = $this->db->get('m_jenis_cuti')->row();
				   
				   
				   $this->db->select('sum(total) as total_cuti');
					  $this->db->where('jenis_cuti',$id_cuti);
					  $this->db->where('id_user',$id_user);
					  $this->db->where('YEAR(tgl_cuti)',$tahun);
					  $this->db->where('tampilkan','1');

				   $resCek = $this->db->get('his_cuti')->row();
					
				    $cuti_sudahDiambil = $resCek->total_cuti;
					   $total = $res->jumlah;
					   
					   if($total <= $cuti_sudahDiambil){
						   $arr['message'] ='<div class="alert alert-danger">Maaf cuti anda tahun ini <strong>sudah melampaui batas!</strong></div>';
					   }else{
						if($id_cuti=='1'){
							$cc = $total-$cuti_sudahDiambil;
							$this->db->select('sum(total) as total_cuti');
							  $this->db->where('jenis_cuti','1');
							  $this->db->where('id_user',$id_user);
							  $this->db->where('YEAR(tgl_cuti)',($tahun-1));
							  $this->db->where('tampilkan','1');
							  $resCeklalu = $this->db->get('his_cuti')->row();
							  $cutithnlalu= 12-$resCeklalu->total_cuti;
							  $jumlahcuti = $cc + $cutithnlalu;
							  
							  if(!empty($resCeklalu->total_cuti)){
								
							 
							  if($jumlahcuti > 18){
								$cc=18;
							  }else{
								$cc = $jumlahcuti;
							  }
							  }
							  
						   }
						   
						   
						$arr['message'] ='<div class="alert alert-success">Anda memiliki sisa cuti <strong>'.$cc.' Hari</strong></div>';
						$arr['jumlah'] = $cc;
					   }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function savecuti_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$tgl = $this->input->post('tgl_cuti'); 
					$jml = $this->input->post('jumlahCuti');

					$date=date_create($tgl);
					date_add($date,date_interval_create_from_date_string($jml." days"));
					$sampai = date_format($date,"Y-m-d");

					//cek lagi
					$id_cuti = $this->input->post('jenis_cuti');
					$id_user = $this->input->post('id_user');
					$tahun = date('Y');
					$this->db->where('id',$id_cuti);
					$this->db->where('tampilkan','1');

				  $res = $this->db->get('m_jenis_cuti')->row();
				  
				  $this->db->select('sum(total) as total_cuti');
					 $this->db->where('jenis_cuti',$id_cuti);
					 $this->db->where('id_user',$id_user);
					 $this->db->where('YEAR(tgl_cuti)',$tahun);
					 $this->db->where('tampilkan','1');

				    $resCek = $this->db->get('his_cuti')->row();
				   
				      $cuti_sudahDiambil = $resCek->total_cuti;
					  $total = $res->jumlah;

					  $totalcuti = $cuti_sudahDiambil+$jml;
					  if($totalcuti <= $total){
					 
						$datacuti=array(
							'id_user'=> $id_user,
							'total' => $jml,
							'tgl_cuti'=> $tgl,
							'tgl_akhir_cuti' => $sampai,
							'jenis_cuti' => $id_cuti,
							'status' => '1',
							'keterangan' =>  $this->input->post('keterangan')

						);

						$this->db->insert('his_cuti',$datacuti);
						if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Data berhasil ditambah!';
						}else{
							$arr['hasil']='error';
							$arr['message']='Data Gagal Ditambah!';
						}

					  }

			   
			 
 
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	

	function listcuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
				 
					$id_user = $this->input->get('id_user'); 
					$this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,m_status_proses.nama as statuspros');
					$this->db->join('m_jenis_cuti','m_jenis_cuti.id = his_cuti.jenis_cuti');
					$this->db->join('m_status_proses','m_status_proses.id = his_cuti.status');
					$this->db->where('id_user',$id_user); 
					$this->db->where('his_cuti.tampilkan','1');
					$this->db->order_by('tgl_cuti','DESC');
					$resCek = $this->db->get('his_cuti')->result();

					$da ='';
					foreach($resCek as $val){
						$text='text-success';
						if($val->status =='1'){
							$text='text-danger';
						}
					   $da .='<tr>';
					   $da .='<td>';
					   $da .= $val->namcut;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_akhir_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->total;
					   $da .='</td>';
					   $da .='<td class="'.$text.'">';
					   $da .= $val->statuspros;
					   $da .='</td>';
					   $da .='<td><a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\''.$val->id.'\')">';
					   $da .='Hapus';
					   $da .='</a></td>';
					   $da .='</tr>';
					}
				    
				   $arr['hasil']='success';
				   $arr['isi']=$da;
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

		
	}

	public function beristratuscuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $id=$this->input->get('id');
					 $status = $this->input->get('status');
					 $this->db->where('id',$id);
					 $arraycuti['status']=$status;
					if($status=='0'){
						$arraycuti['tampilkan']='0';
						$this->db->where('status','1');
					}
					 $this->db->update('his_cuti',$arraycuti);
			  $arr['hasil']='success';
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function listcutiall_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
				 
					$id_user = $this->input->get('id_user'); 
					$this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,m_status_proses.nama as statuspros,sys_user.name as namapegawai');
					$this->db->join('m_jenis_cuti','m_jenis_cuti.id = his_cuti.jenis_cuti');
					$this->db->join('m_status_proses','m_status_proses.id = his_cuti.status'); 
					$this->db->join('sys_user','sys_user.id_user = his_cuti.id_user'); 
					$this->db->where('his_cuti.tampilkan','1');
					$this->db->where('his_cuti.status','1');
					$this->db->order_by('tgl_cuti','DESC');
					$resCek = $this->db->get('his_cuti')->result();

					$da ='';
					foreach($resCek as $val){
						$text='text-success';
						if($val->status =='1'){
							$text='text-danger';
						}
					   $da .='<tr>';
					   $da .='<td>';
					   $da .= $val->namapegawai;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->namcut;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->keterangan;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_akhir_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->total;
					   $da .='</td>';
					   $da .='<td class="'.$text.'">';
					   $da .= $val->statuspros;
					   $da .='</td>';
					   $da .='<td>';
					   $da .='<a class="label label-success" href="javascript:void(0);" onClick="prosesCuti(\''.$val->id.'\',\'2\')">';
					   $da .='Setujui';
					   $da .='</a>';
					   $da .='<a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\''.$val->id.'\',\'0\')">';
					   $da .='Tolak';
					   $da .='</a>';
					   $da .='</td>';
					   $da .='</tr>';
					}
				    
				   $arr['hasil']='success';
				   $arr['isi']=$da;
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

		
	}

	public function listpensiun_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 
		
		$this->db->join('sys_user','sys_user.id_user = his_mutasi_jabatan.user_id','LEFT');
		$this->db->where('sys_user.status','1');
		 if(!empty($this->uri->segment(3))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(3)); 
		 }
		$total_rows = $this->db->count_all_results('his_mutasi_jabatan');
		$pagination = create_pagination_endless('/pegawai/listpensiun/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,a.grup as dir_asal,his_mutasi_jabatan.tgl_mutasi,
		b.grup as bag_asal,
		c.grup as subbag_asal,
		d.grup as dir_tujuan,
		e.grup as bag_tujuan,
		f.grup as subbag_tujuan');
		$this->db->join('sys_grup_user as f','f.id_grup = his_mutasi_jabatan.sub_bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as e','e.id_grup = his_mutasi_jabatan.bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as d','d.id_grup = his_mutasi_jabatan.direktorat_tujuan','LEFT');
		$this->db->join('sys_grup_user as c','c.id_grup = his_mutasi_jabatan.sub_bagian_asal','LEFT');
		$this->db->join('sys_grup_user as b','b.id_grup = his_mutasi_jabatan.bagian_asal','LEFT');
		$this->db->join('sys_grup_user as a','a.id_grup = his_mutasi_jabatan.direktorat_asal','LEFT');
		if(!empty($this->uri->segment(3))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(3)); 
		 }
		 $this->db->join('sys_user','sys_user.id_user = his_mutasi_jabatan.user_id','LEFT');
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		
		  $res = $this->db->get('his_mutasi_jabatan')->result();
		  foreach($res as $d){
			$arr['result'][]=array(
								   'nama'=>$d->name, 
								   'dir_asal' => $d->dir_asal,
								   'tgl' => $d->tgl_mutasi,
								   'bag_asal' => $d->bag_asal,
								   'subbag_asal' => $d->subbag_asal,
								   'dir_tujuan' => $d->dir_tujuan,
								   'bag_tujuan' => $d->bag_tujuan,
								   'subbag_tujuan' => $d->subbag_tujuan
								   );
		  }
		 
		  $arr['total']=$total_rows;
		  $arr['paging'] = $pagination['limit'][1];
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function savepensiun_post(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			if ($decodedToken != false) {
			 
		  
		   
			   //cari dulu diriwayat kedinasan
			   if(!empty($id=$this->input->post('txtIdUser'))){
			$id_alasan =	$this->input->post('id_alasan');
			$keterangan =	$this->input->post('keterangan');
			$no_sk =	$this->input->post('no_sk');
			$pejabat =	$this->input->post('pejabat');
			$tgl = 	$this->input->post('tgl_keluar');
				 
				 	$arratdata = array(
						'id_user'=>$id,
						'tgl_keluar'=>$tgl,
						'no_sk'=>$no_sk,
						'alasan'=>$keterangan ,
						'id_alasan'=>$id_alasan,
						'id_pejabat'=>$pejabat 
					 );

					 $this->db->insert('his_pegawai_resign',$arratdata);
					 $this->db->where('id_user',$id);
					 $this->db->update('sys_user',array('status'=>'0','kd_keluar'=>$id_alasan));

					if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
					}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
					}

			   }
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function savejabatan_post(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			if ($decodedToken != false) {
			 
		  
		   
			   //cari dulu diriwayat kedinasan
			   if(!empty($id=$this->input->post('txtIdUser'))){
			  
				 
				$arrdata = array(
					'user_id' => $id, 
					'direktorat_tujuan' => $this->input->post('txtdirektorat'),
					'bagian_tujuan' => $this->input->post('txtbagian'),
					'sub_bagian_tujuan' => $this->input->post('unitkerja'),
					'tgl_mutasi' => $this->input->post('tgl_mutasi'),
					'keterangan' => $this->input->post('keterangan'),
					'tgl_sk'=>$this->input->post('tgl_sk'),
					'no_sk'=>$this->input->post('no_sk'),
					'id_satker'=>$this->input->post('satuan_kerja'),
					'id_kelas'=> $this->input->post('kelas_jabatan'),
					'aktif'=>'0'
				);

				$this->db->insert('his_mutasi_jabatan',$arrdata);
				  

				}

				//update user
				
 

					if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
					}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
					}

			   }
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
		 
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function editjabatan_post(){
		$headers = $this->input->request_headers();
	
		if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
			$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			if ($decodedToken != false) {
			 
		  
		   
			   //cari dulu diriwayat kedinasan
			   if(!empty($id=$this->input->post('idjabatan'))){
			  
				 
				$arrdata = array( 
					'direktorat_tujuan' => $this->input->post('txtdirektorat'),
					'bagian_tujuan' => $this->input->post('txtbagian'),
					'sub_bagian_tujuan' => $this->input->post('unitkerja'),
					'tgl_mutasi' => $this->input->post('tgl_mutasi'),
					'keterangan' => $this->input->post('keterangan'),
					'tgl_sk'=>$this->input->post('tgl_sk'),
					'no_sk'=>$this->input->post('no_sk'),
					'id_satker'=>$this->input->post('satuan_kerja'),
					'id_kelas'=> $this->input->post('kelas_jabatan'),
					 
				);
				$this->db->where('id',$id);
				$this->db->where('aktif','0');
				$this->db->update('his_mutasi_jabatan',$arrdata);
				  

				}

				//update user
				
 

					if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
					}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal update! jabatan aktif tidak dapat dirubah';
					}

			   }
			  
		   
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
		 
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	function listfile_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
				 
					$id_user = $this->input->get('id');  
					$this->db->where('id_user',$id_user); 
					$this->db->where('kategori_id',$this->input->get('kategori')); 
					$this->db->where('tampilkan','1');
					$this->db->order_by('tgl','DESC');
					$resCek = $this->db->get('his_files')->result();

					$da ='';
					$no = 0;
					foreach($resCek as $val){
						++$no;
						$text='text-success';
						
					   $da .='<tr>';
					   $da .='<td>';
					   $da .= $no;
					   $da .='</td>'; 
					   $da .='<td class="'.$text.'">';
					   $da .=  $val->nama_file;
					   $da .='</td>';
					   $da .='<td>';
					   $da .='<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/'.$val->url.'\')"><i class="fa fa-eye"></i></a>';
					   $da .='</td>';
					   $da .='<td><a class="label label-danger" href="javascript:void(0);" onClick="hapusfile(\''.$val->id.'\')">';
					   $da .='Hapus';
					   $da .='</a>';
					   $da .='</td>';
					  
					   $da .='</tr>';
					}
				    
				   $arr['hasil']='success';
				   $arr['isi']=$da;
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

		
	}

	function deletelistfile_get(){
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
			  $this->db->update('his_files',$arrdata);
			  
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
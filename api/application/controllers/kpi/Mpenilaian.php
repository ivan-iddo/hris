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

class Mpenilaian extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */

	public function savedetail_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				if(!empty($_POST[0]['pid'])){
					$this->db->where('id_kpi',$_POST[0]['pid']);
					$res = $this->db->get('his_kpi_detail')->row();

					if(!empty($res)){
						$this->db->where('id_kpi',$_POST[0]['id_kpi_d']);
						$this->db->delete('his_kpi_detail'); 
					} 

				}else{
					$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah! anda harus memilih Pegawai terlebih dahulu';
						$this->set_response($arr, REST_Controller::HTTP_OK);
			
						return;
					}
			 
				foreach($_POST as $dat){
						$id_kpi=0;
						$id_kegiatan=0;
						$target_kinerja=0;
						$capaian=0;
						$capaian_persen=0;
						$nilai=0;
						$nilai_bobot=0;
						$keterangan=''; 

						if(!empty($dat['pid'])){
							$id_kpi=$dat['pid'];
						}
						if(!empty($dat['id'])){
							$id_kegiatan=$dat['id'];
						}
						if(!empty($dat['no'])){
							$bobot=$dat['no'];
						}
						if(!empty($dat['target_kinerja'])){
							$target_kinerja=$dat['target_kinerja'];
						}
						if(!empty($dat['nilai'])){
							$nilai=$dat['nilai'];
						}
						if(!empty($dat['capaian_persen'])){
							$capaian_persen=$dat['capaian_persen'];
						}
						if(!empty($dat['capaian'])){
							$capaian=$dat['capaian'];
						}
						if(!empty($dat['nilai_bobot'])){
							$nilai=$dat['nilai'];
							$bobot=$dat['no'];
							$nilai_bobot=$bobot/100*$nilai;
						}
						if(!empty($dat['keterangan'])){
							$keterangan=$dat['keterangan'];
						}
					$array = array(
						'id_kpi'=>$id_kpi,
						'id_kegiatan'=>$id_kegiatan,
						'target_kinerja'=>$target_kinerja,
						'capaian'=>$capaian,
						'capaian_persen'=>$capaian_persen,
						'nilai'=>$nilai,
						'nilai_bobot'=>$nilai_bobot,
						'keterangan'=>$keterangan, 
					);
					if(!empty($dat['id_kpi_d'])){
					$this->db->where('id',$dat['id_kpi_d']);
					$this->db->update('his_kpi_detail',$array);
					}
					
					if(!empty($id_kpi)){
					$nilai=$dat['nilai'];
					$bobot=$dat['no'];
					$nilai_bobot=$bobot/100*$nilai;
					$total += $nilai_bobot;
					$rata=$total/$dat['jum'];
				    $this->db->where('id', $id_kpi);
				    $this->db->update('his_kpi',array('nilai' => round($rata, 2), 'status' => '1'));
					}
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

	public function listpi_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 
		
			 	
		$this->db->join('sys_grup_user','his_kpi.id_unitkerja = sys_grup_user.id_grup','LEFT');  
		$this->db->join('sys_user_profile','his_kpi.no_pegawai = sys_user_profile.NIP','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->where('his_kpi.tampilkan','1');
		$this->db->where('his_kpi.id_jenis',$this->uri->segment(4));
		 if(!empty($this->uri->segment(5))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(6)); 
		 }

		 if(!empty($this->uri->segment(7))){
			
			$this->db->like("riwayat_kedinasan.bagian",$this->uri->segment(7)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		}
		$total_rows = $this->db->count_all_results('his_kpi');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,6);
		 
				
		$this->db->select('his_kpi.*,sys_grup_user.grup,sys_grup_user.grup as nama_uk,
		sys_user_profile.NIP,
		sys_user_profile.NIK,
		sys_user.name,sys_user_profile.kategori_profesi as profesi');
		
		$this->db->join('sys_grup_user','his_kpi.id_unitkerja = sys_grup_user.id_grup','LEFT');  
		$this->db->join('sys_user_profile','his_kpi.no_pegawai = sys_user_profile.NIP','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->where('his_kpi.tampilkan','1');
		$this->db->where('his_kpi.id_jenis',$this->uri->segment(4));

		if(!empty($this->uri->segment(5))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(5)); 
		 } 
		 
		  if(!empty($this->uri->segment(7))){
			
			$this->db->like("riwayat_kedinasan.bagian",$this->uri->segment(7)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		}

		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		
		
		  $res = $this->db->get('his_kpi')->result();
		  foreach($res as $d){
			$arr['result'][]=array('nama_uk'=>$d->nama_uk,
								   'id_uk'=>$d->id_unitkerja, 
								   'id'=>$d->id,
								   'nama'=>$d->name, 
								   'nama_group'=>$d->grup,
								   'nip'=>$d->NIP,
								   'nik'=>$d->NIK,
								   'awal' => $d->awal,
								   'akhir'=> $d->akhir,
								   'profesi' => $d->profesi
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
	
	public function listpismf_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 
		
			 	
		$this->db->join('sys_grup_user','his_kpi_smf.id_unitkerja = sys_grup_user.id_grup','LEFT');  
		$this->db->join('sys_user_profile','his_kpi_smf.no_pegawai = sys_user_profile.NIP','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->where('his_kpi_smf.tampilkan','1');
		$this->db->where('his_kpi_smf.id_jenis',$this->uri->segment(4));
		 if(!empty($this->uri->segment(5))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(6)); 
		 }
		$total_rows = $this->db->count_all_results('his_kpi_smf');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,6);
		 
				
		$this->db->select('his_kpi_smf.*,sys_grup_user.grup,sys_grup_user.grup as nama_uk,
		sys_user_profile.NIP,
		sys_user_profile.NIK,
		sys_user.name,sys_user_profile.kategori_profesi as profesi');
		
		$this->db->join('sys_grup_user','his_kpi_smf.id_unitkerja = sys_grup_user.id_grup','LEFT');  
		$this->db->join('sys_user_profile','his_kpi_smf.no_pegawai = sys_user_profile.NIP','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->where('his_kpi_smf.tampilkan','1');
		$this->db->where('his_kpi_smf.id_jenis',$this->uri->segment(4));
		if(!empty($this->uri->segment(5))){
			$this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)",$this->uri->segment(5)); 
		 } 

		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		
		
		  $res = $this->db->get('his_kpi_smf')->result();
		  foreach($res as $d){
			$arr['result'][]=array('nama_uk'=>$d->nama_uk,
								   'id_uk'=>$d->id_unitkerja, 
								   'id'=>$d->id,
								   'nama'=>$d->name, 
								   'nama_group'=>$d->grup,
								   'nip'=>$d->NIP,
								   'nik'=>$d->NIK,
								   'awal' => $d->awal,
								   'akhir'=> $d->akhir,
								   'profesi' => $d->profesi
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



	function savepi_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
				$id_grup = $this->input->post('id_grup');
				$id_jenis = $this->input->post('id_jenis'); 
				$nip = $this->input->post('nip');
				$awal = $this->input->post('awal');
				$akhir = $this->input->post('akhir');

				//cek dulu kalau sama dia gak boleh save
				$this->db->where('awal',$awal);
				$this->db->where('akhir',$akhir);
				$this->db->where('no_pegawai',$nip);
				$res = $this->db->get('his_kpi')->row();

				if(empty($res)){
				$data=array(
					'id_jenis'=> $id_jenis,
					'no_pegawai' => $nip,
					'awal'=> $awal,
					'akhir'=> $akhir,
					'id_unitkerja' => $id_grup
				);
				$this->db->insert('his_kpi',$data);
				$this->db->select('his_kpi.*,m_penilaian_kpi.*');
				$this->db->where('his_kpi.awal',$awal);
				$this->db->where('his_kpi.akhir',$akhir);
				$this->db->where('his_kpi.no_pegawai',$nip);
				$this->db->where('his_kpi.id_jenis',$id_jenis);
				$this->db->where('m_penilaian_kpi.tampilkan','1');
				$this->db->join('his_kpi','m_penilaian_kpi.child = his_kpi.id_jenis','LEFT');
				$res = $this->db->get('m_penilaian_kpi')->result();
				foreach($res as $d){
					$data=array(
					'id_kpi'=> $d->id,
					'id_kegiatan'=> $d->id_grup,
				);
				$this->db->insert('his_kpi_detail',$data);
				}
				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
				}else{
					$arr['hasil']='error';
					$arr['message']='Maaf data gagal disimpan karena data <strong>'.$this->input->post('nama_pegawai').'</strong> dengan periode yg sama sudah ada!<br>Silahkan pilih periode lainnya';
				}
		
		 
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function editpi_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
				$id_pi = $this->input->post('id_pi');
				$id_grup = $this->input->post('id_grup');
				$id_jenis = $this->input->post('id_jenis'); 
				$nip = $this->input->post('nip');
				$awal = $this->input->post('awal');
				$akhir = $this->input->post('akhir');

				//cek dulu kalau sama dia gak boleh save
				$this->db->where('awal',$awal);
				$this->db->where('akhir',$akhir);
				$this->db->where('no_pegawai',$nip);
				$res = $this->db->get('his_kpi')->row();

				if(empty($res)){

				
				$data=array(
					'id_jenis'=> $id_jenis,
					'no_pegawai' => $nip,
					'awal'=> $awal,
					'akhir'=> $akhir,
					'id_unitkerja' => $id_grup
				);
				 
				if(!empty($id_pi)){
					$this->db->where('id',$id_pi);
				
				$this->db->update('his_kpi',$data);
				}

				if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
				}else{
					$arr['hasil']='error';
					$arr['message']='Maaf data gagal disimpan karena data <strong>'.$this->input->post('nama_pegawai').'</strong> dengan periode yg sama sudah ada!<br>Silahkan pilih periode lainnya';
				}
		 
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
  
	public function list_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		$this->db->join('m_penilaian_kpi','sys_user.id_grup = m_penilaian_kpi.id_grup');
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

				  $this->db->where('tampilkan','1'); 
				  $res = $this->db->get('m_penilaian_kpi')->result();

			if(!empty($res)){
				 foreach($res as $d){
					$arr[]=array('nama'=>$d->grup,'id'=>$d->id_grup,'deskripsi'=>$d->kode,);
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
				$child = $this->input->get('child');
				if(!empty($id)){
					 $this->db->where('id_grup',$this->input->get('id'));
				}

				if(!empty($child)){
					$this->db->where('child',$child);
			   }
				
				 
				  
				  $this->db->where('tampilkan','1');

				  
				  $res = $this->db->get('m_penilaian_kpi')->result();
				  
			if(!empty($res)){
				 foreach($res as $d){
					$arr[]=array('id'=>$d->id_grup,'deskripsi'=>$d->kode,'nama'=>$d->grup);
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

	function getlistkpi_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {

                $id = $this->input->get('id');
				if(!empty($id)){
					 $this->db->where('his_kpi_detail.id_kpi',$this->input->get('pid'));
				}
				  $this->db->select('m_penilaian_kpi.*, his_kpi_detail.*,his_kpi.id as id_kpi');
				  $this->db->where('m_penilaian_kpi.tampilkan','1');
				  $this->db->join('his_kpi_detail','m_penilaian_kpi.id_grup = his_kpi_detail.id_kegiatan','LEFT');
				  $this->db->join('his_kpi','his_kpi_detail.id_kpi = his_kpi.id','LEFT');
				  $res = $this->db->get('m_penilaian_kpi')->result_array();

                if (!empty($res)) {
                    $arr['result'] = $res;
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Pesan berhasil Terkirim!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Pesan Gagal kirim!';
                }


                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	

	public function getitemkpi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				$idp = $this->input->get('idp');
				$child = $this->input->get('child');
				if(!empty($id)){
					 $this->db->where('his_kpi_detail.id_kpi',$this->input->get('pid'));
				}
				if(!empty($idp)){
					 $this->db->where('m_penilaian_kpi.id_grup',$this->input->get('idp'));
				}
				if(!empty($child)){
					$this->db->where('m_penilaian_kpi.child',$child);
				}
				  $this->db->select('m_penilaian_kpi.*, his_kpi_detail.*,his_kpi.id as id_kpi,his_kpi_detail.id as id_kpi_d');
				  $this->db->where('m_penilaian_kpi.tampilkan','1');
				  $this->db->join('his_kpi_detail','m_penilaian_kpi.id_grup = his_kpi_detail.id_kegiatan','LEFT');
				  $this->db->join('his_kpi','his_kpi_detail.id_kpi = his_kpi.id','LEFT');
				  $res = $this->db->get('m_penilaian_kpi')->result();

			 $jumlah=count($res);
			if(!empty($res)){
				$i=0;
				 foreach($res as $d){
					$nilai=$d->nilai;
					$bobot=$d->bobot;
					$nilai_bobot=$bobot/100*$nilai;
					$total += $nilai_bobot;
					$rata=$total/$jumlah;
					$arr[]=array('jum'=> $jumlah, 'n' => ++$i,'id'=>$d->id_grup,'nama'=>$d->grup, 'id_kpi'=>$d->id_kpi, 'total'=>$rata, 'id_kpi_d'=>$d->id_kpi_d, 'pid'=>$d->id_kpi, 'idpeg'=>$d->no_pegawai, 'no'=>$d->bobot, 'target_kinerja'=>$d->target_kinerja, 'capaian'=>$d->capaian, 'capaian_persen'=>$d->capaian_persen, 'nilai'=>$d->nilai, 'nilai_bobot'=>$nilai_bobot, 'keterangan'=>$d->keterangan);
				  }
			}else{
			$arr['result'] ='empty';
		  }
		  $jmldata = count($arr);
				$arr[$jmldata]=array('id_kpi'=>'',
						'id_kegiatan'=>'',
						'no'=>'',
						'target_kinerja'=>'TOTAL',
						'capaian'=>'',
						'capaian_persen'=>'',
						'nilai'=>'',
						'nilai_bobot'=>round($rata, 2),
						'keterangan'=>'');
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function getikpi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				$idp = $this->input->get('idp');
				$child = $this->input->get('child');
				if(!empty($id)){
					 $this->db->where('his_kpi_detail.id_kpi',$this->input->get('pid'));
				}
				if(!empty($idp)){
					 $this->db->where('m_penilaian_kpi.id_grup',$this->input->get('idp'));
				}
				if(!empty($child)){
					$this->db->where('m_penilaian_kpi.child',$child);
				}
				  $this->db->select('m_penilaian_kpi.*, his_kpi_detail.*,his_kpi.id as id_kpi');
				  $this->db->where('m_penilaian_kpi.tampilkan','1');
				  $this->db->join('his_kpi_detail','m_penilaian_kpi.id_grup = his_kpi_detail.id_kegiatan','LEFT');
				  $this->db->join('his_kpi','his_kpi_detail.id_kpi = his_kpi.id','LEFT');
				  $res = $this->db->get('m_penilaian_kpi')->result();

			if(!empty($res)){
				$i=0;
				 foreach($res as $d){
					$arr[]=array('n' => ++$i,'id'=>$d->id_grup,'nama'=>$d->grup, 'id_kpi'=>$d->id_kpi, 'pid'=>$d->id_kpi, 'idpeg'=>$d->no_pegawai, 'no'=>$d->bobot, 'target_kinerja'=>$d->target_kinerja, 'capaian'=>$d->capaian, 'capaian_persen'=>$d->capaian_persen, 'nilai'=>$d->nilai, 'nilai_bobot'=>$nilai_bobot, 'keterangan'=>$d->keterangan);
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
	
	
	public function getitemdetail_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				if(!empty($id)){
					 $this->db->where('id_grup',$this->input->get('id'));
				}
				
				 
				  
				  $this->db->where('tampilkan','1'); 
				  $res = $this->db->get('m_penilaian_kpi')->result();
				  
			if(!empty($res)){
				 foreach($res as $d){
					$arr[]=array('id'=>$d->id_grup,'deskripsi'=>$d->kode,'nama'=>$d->grup);
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
				 $id_parent = $_POST['id_parent'];
				 $max = $_POST['max'];
				 $bobot= $_POST['pilih'];
				$this->db->select('count(id_grup) as jum');
                $this->db->where('child', $id_parent);
                $this->db->where('tampilkan', '1');

                $resCek = $this->db->get('m_penilaian_kpi')->row();

                $jum = $resCek->jum;

                if ($max < $jum) {
					$arr['hasil']='Maaf';
                    $arr['message'] = 'Parameter anda sudah melampaui batas! Parameter max ' . $max ;
                }else{
				$this->db->select('sum(bobot) as bobot');
                $this->db->where('child', $id_parent);
                $this->db->where('tampilkan', '1');

                $resCek = $this->db->get('m_penilaian_kpi')->row();

                $bob = $resCek->bobot;
				$total_bobot=$bobot+$bob;
                $max = 100;

                if ($max < $total_bobot) {
					$arr['hasil']='Maaf';
                    $arr['message'] = 'Bobot anda sudah melampaui batas! Bobot max 100';
                }else{
				 $data = array(
							   'grup'=>$group_group,'bobot'=>$bobot);
				 
				  if(!empty($id_parent)){
					$data['child']=$id_parent;
				  }
				  
				$this->db->insert('m_penilaian_kpi',$data);
				$this->db->where('grup',$group_group);
				$res = $this->db->get('m_penilaian_kpi')->result();
				foreach($res as $d){
				$id_grup = $d->id_grup;
				$data1 = array('id_kegiatan'=>$id_grup);
				$this->db->insert('his_kpi_detail',$data1);
				}
				if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Data berhasil ditambah!';
						 }else{
							$arr['hasil']='error';
							$arr['message']='Data Gagal Ditambah!';
						 }
				}}}
		  
				$this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
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
				 $pilih   = $_POST['pilih'];
				 $awal   = $_POST['awal'];
				 $id_parent = $_POST['id_parent'];
				 $id_group   = $_POST['id_group'];
				 if ($pilih > $awal) {
					$selisih=$pilih-$awal;
					$this->db->select('sum(bobot) as bobot');
					$this->db->where('child', $id_parent);
					$this->db->where('tampilkan', '1');

					$resCek = $this->db->get('m_penilaian_kpi')->row();

					$bob = $resCek->bobot;
					$total_bobot=$selisih+$bob;
				 }else{
					$selisih=$awal-$pilih;
					$this->db->select('sum(bobot) as bobot');
					$this->db->where('child', $id_parent);
					$this->db->where('tampilkan', '1');

					$resCek = $this->db->get('m_penilaian_kpi')->row();

					$bob = $resCek->bobot;
					$total_bobot=$bob-$selisih;
				 }
				$max = 100;
                if ($max < $total_bobot) {
					$arr['hasil']='Maaf';
                    $arr['message'] = 'Bobot anda sudah melampaui batas! Bobot max 100';
                }else{
				 $data = array('grup'=>$group_group,'bobot'=>$pilih,);
				 $this->db->where('id_grup', $this->input->post('id_group'));
				 $this->db->update('m_penilaian_kpi',$data);				
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
	
	
	public function edit_detail_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $group_aplikasi = '1';//$this->input->post('group_aplikasi');
				 $group_group    = $_POST['group_group'];
				 $group_ket      = $_POST['group_ket'];
				 
				 $data = array('grup'=>$group_group,'kode'=>$group_ket);
				 $this->db->where('id_grup', $this->input->post('id_group'));
				 $this->db->update('m_penilaian_kpi',$data);
				 
				 
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
				 $this->db->where('id_grup',$id);
				 $this->db->update('m_penilaian_kpi',array('tampilkan'=>'0'));
				  
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
	
	public function delete_detail_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
				 $id    = $this->input->get('id_group');
				 $this->db->where('id_grup',$id);
				 $this->db->update('m_penilaian_kpi',array('tampilkan'=>'0'));
				  
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

	function listpenilaian_get(){
		$headers = $this->input->request_headers();
		$total=0;
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
			  $id    = $this->input->get('id');
			  $pid = $this->input->get('pid');

				 if(!empty($pid)){
					 $this->db->where('id_kpi',$pid);
					 $respi = $this->db->get('his_kpi_detail')->result();
					foreach($respi as $valpi){
						$datapi[$valpi->id_kegiatan]['bobot']= $valpi->bobot; 
						$datapi[$valpi->id_kegiatan]['target_kinerja']= $valpi->target_kinerja; 
						$datapi[$valpi->id_kegiatan]['capaian']= $valpi->capaian; 
						$datapi[$valpi->id_kegiatan]['capaian_persen']= $valpi->capaian_persen; 
						$datapi[$valpi->id_kegiatan]['nilai_bobot']= $valpi->nilai_bobot;  
						$datapi[$valpi->id_kegiatan]['keterangan']= $valpi->keterangan; 
						$datapi[$valpi->id_kegiatan]['nilai']= $valpi->nilai; 
					}
				 }
				  $bobot=0;
				  $target_kinerja = 0;
				  $capaian = 0;
				  $capaian_persen = 0;
				  $nilai_bobot = 0;
				  $nilai = 0;
				  $keterangan = '';
				   
				$this->db->where('child',$id);
				$kode_smf= $this->input->get('kod');
				$this->db->where('kode',$kode_smf);
				
				$res = $this->db->get('m_penilaian_kpi')->result();

				foreach($res as $d){
					$parent_id = $d->id_grup;
					$parent_name = $d->grup;
					
					$this->db->where('child',$parent_id);
					$reschild = $this->db->get('m_penilaian_kpi')->result();

					if(!empty($reschild)){
						foreach($reschild as $dchild){
							$id_child = $dchild->id_grup;
							$child_name = $dchild->grup;

							$this->db->where('child',$id_child);
							$node = $this->db->get('m_penilaian_kpi')->result();

							if(!empty($node)){
								
								foreach($node as $nodes){
									$id_node = $nodes->id_grup;
									$node_name = $nodes->grup;
									$bobot=0;
									$target_kinerja = 0;
									$capaian = 0;
									$capaian_persen = 0;
									$nilai_bobot = 0;
									$nilai = 0;
									$keterangan = '';

									if(!empty($datapi[$nodes->id_grup]['bobot'])){
										$bobot=$datapi[$nodes->id_grup]['bobot'];
									}
									if(!empty($datapi[$nodes->id_grup]['target_kinerja'])){
										$target_kinerja=$datapi[$nodes->id_grup]['target_kinerja'];
									}
									if(!empty($datapi[$nodes->id_grup]['capaian'])){
										$capaian=$datapi[$nodes->id_grup]['capaian'];
									}
									if(!empty($datapi[$nodes->id_grup]['capaian_persen'])){
										$capaian_persen=$datapi[$nodes->id_grup]['capaian_persen'];
									}
									if(!empty($datapi[$nodes->id_grup]['nilai_bobot'])){
										$nilai_bobot=$datapi[$nodes->id_grup]['nilai_bobot'];
									}
									if(!empty($datapi[$nodes->id_grup]['nilai'])){
										$nilai=$datapi[$nodes->id_grup]['nilai'];
									}
									if(!empty($datapi[$nodes->id_grup]['keterangan'])){
										$keterangan=$datapi[$nodes->id_grup]['keterangan'];
									}
									$jml = ($dchild->kode/100)*$nilai;
									$total += $jml;
									$arr[]=array('keterangan'=>$keterangan,
									'bobotnilai'=>$nilai_bobot,
									'nilai'=>$nilai,
									'persen'=>$capaian_persen,
									'capaian'=>$capaian,
									'target'=>$target_kinerja,
									'parent'=>$parent_name,
									'bobot'=>$dchild->kode,
									'child'=>$child_name,
									'node'=>$node_name,
									'id'=>$nodes->id_grup,
									'pid'=>$pid,
								'total'=>$jml); 
									
								}
							}



						}
					}


				//  $arr[]=array('id'=>$d->id_user,'nama'=>$d->name,'username'=>$d->username,'email'=>$d->email,'id_group'=>$d->id_grup,'status'=> $d->status);
				}

				$jmldata = count($arr);
				$arr[$jmldata]=array('keterangan'=>'',
									'bobotnilai'=>'',
									'nilai'=>'',
									'persen'=>'',
									'capaian'=>'',
									'target'=>'TOTAL',
									'parent'=>'',
									'bobot'=>'',
									'child'=>'',
									'node'=>'',
									'id'=>'totalsjumlah',
									'pid'=>'','total'=>$total);
		
				 
				$this->set_response($arr, REST_Controller::HTTP_OK);
		 
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function listkpi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

				if(!empty($this->input->get('id_grup'))){
					$this->db->where('id_grup',$this->input->get('id_grup'));
				 }
				 if(!empty($kode)){
					$this->db->where('kode',$kode);
				 }
				 if(!empty($id)){
					$this->db->where('child',$id);
				 }
				 $this->db->where('tampilkan','1'); 
				$res = $this->db->get('m_penilaian_kpi')->result();
			
			if(!empty($res)){
				 foreach($res as $dat){
					$arr['result'][]= array('id_grup'=> $dat->id_grup,'grup'=> $dat->grup,);
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
	
		public function deletekpi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
				 $id    = $this->input->get('id_grup');
				 $this->db->where('id_grup',$id);
				 $this->db->update('m_penilaian_kpi',array('tampilkan'=>'0'));
				  
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
	
	public function savekpi_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

				if(!empty($this->input->post('id_grup'))){
					//edit
					
					$id_grup= $this->input->post('id_grup');
					$arr=array('grup'=> $this->input->post('grup'),);;//array('nama'=>$this->input->post('nama'));
					$this->db->where('id_grup',$id_grup);
					$this->db->update(('m_penilaian_kpi'),$arr);
				}else{
				
					$kode=95;

					$this->db->select('count(id_grup) as total');
					$this->db->where('kode)',$kode);
					$this->db->where('tampilkan','1');

				   $resCek = $this->db->get('m_penilaian_kpi')->row();
					
				   $izin_sudahDiambil = $resCek->total;
			
					$arr=array('grup'=> $this->input->post('grup'),'kode'=> $kode,);;//array('nama'=>$this->input->post('nama'));
					$this->db->insert(('m_penilaian_kpi'),$arr);
					
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
	
	public function listiki_get()
    {
        $headers = $this->input->request_headers();
        $arr['hasil'] = 'error';
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {

				$id_jenis=$this->input->get('status');
                $user_froup = $decodedToken->data->_pnc_id_grup;

                if (($user_froup == '1') OR ($user_froup == '6')) {
                    if ((!empty($this->input->get('id_uk'))) AND ($this->input->get('id_uk') <> 'null')) {
                        $this->db->where('id_unitkerja', $this->input->get('id_uk'));
                    }

                }
				
				 if (empty($this->input->get('tahun'))) {
                    $thn = date('Y');
                } else {
                    $thn = $this->input->get('tahun');
                }
				
                $this->db->select('his_kpi.*,his_kpi.id_unitkerja as iki,m_status_proses.nama as status_name, sys_grup_user.grup as nama_uk,sys_user.name, MONTH(his_kpi.akhir) AS bulan, YEAR(his_kpi.akhir) AS tahun');
				$this->db->join('sys_grup_user','his_kpi.id_unitkerja = sys_grup_user.id_grup','LEFT');  
				$this->db->join('sys_user_profile','his_kpi.no_pegawai = sys_user_profile.NIP','LEFT');
				$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
				$this->db->join('m_status_proses','m_status_proses.id = his_kpi.status','LEFT');
				$this->db->where('his_kpi.id_jenis',$id_jenis);
				$this->db->where('YEAR(his_kpi.akhir)',$thn);
				$this->db->where('his_kpi.tampilkan','1');
                $res = $this->db->get('his_kpi')->result();
				
                if (!empty($res)) {
                    $i = 0;
                    foreach ($res as $d) {
					$unit=$d->iki;
					$this->db->select('his_kpi.*,his_kpi.nilai as iku');
					$this->db->where('his_kpi.id_unitkerja',$unit);
					$this->db->where('his_kpi.id_jenis',16);
					$n_unit = $this->db->get('his_kpi')->result();
					foreach($n_unit as $n){
						$iku=$n->iku;
					}

                        $arr['result'][] = array(
                            'no' => ++$i,
                            'nopeg' => $d->no_pegawai,
                            'id' => $d->id,
							'nama'=>$d->name,
							'unit'=>$d->nama_uk,
							'status'=>$d->status_name,
							'nilai'=>$d->nilai,
							'iku'=>$iku,
							'bulan'=>$d->bulan,
							'id_uk'=>$d->id_unitkerja,
							'tahun'=>$d->tahun
                        );
                    }

                    $arr['hasil'] = 'success';


                } else {

                    $arr['hasil'] = 'error';
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	 public function updateiki_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {

                $dd = array('status' => $this->input->get('type'));


                $this->db->where('id', $this->input->get('id'));

                $res = $this->db->update('his_kpi', $dd);
                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil dihapus!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal dihapus!';
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}
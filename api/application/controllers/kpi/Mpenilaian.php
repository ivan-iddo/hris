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
				$bobot_awal=0;
				$target_kinerja= NULL;
				$capaian= NULL;
				$capaian_persen= NULL;
				$nilai= NULL;
				$keterangan= NULL;
                foreach ($_POST as $dat) {
				$bobot = $dat['no'];
				$target_kinerja = $dat['target_kinerja'];
				$bobot_awal += $dat['no']/2;
				$bbt = $dat['no']/2;
				$tot_bob=$bobot_awal+$bbt;
				$b = count($_POST)-1;
				$jumlah = $dat['nilai_bobot'];
				$nama1=strtolower($dat['nama']);
				$nama=ucwords($nama1);
				$this->db->select('m_penilaian_kpi.id_grup,m_penilaian_kpi.bobot');
				$this->db->where('grup',$nama);
                $res = $this->db->get('m_penilaian_kpi')->row();
				if(!empty($res)){
					$kpi_id = $res->id_grup;
					$bobot_a = $res->bobot;
                    if (empty($dat['id_kpi_d'])) {
						$max1=$dat['max'];
						if($max1 < $b){
							$arr['hasil']='Maaf';
							$arr['message'] = 'Parameter anda sudah melampaui batas! Parameter max '. $max1;
						}else{
						$max = 100;
						if ($max < $tot_bob) {
							$arr['hasil']='Maaf';
							$arr['message'] = 'Bobot anda '. $tot_bob .' sudah melampaui batas! Bobot max 100';
						}else{							
                        $array = array(
						'id_kpi'=>($dat['pid']?$dat['pid']:NULL),
						'id_kegiatan'=>($kpi_id?$kpi_id:NULL),
						'target_kinerja'=>$dat['target_kinerja'],
						'capaian'=>$dat['capaian'],
						'capaian_persen'=>$dat['capaian_persen'],
						'nilai'=>$dat['nilai'],
						'nilai_bobot'=>$dat['nilai_bobot'],
						'keterangan'=>$dat['keterangan'],
                        );
                        $result =$this->db->insert('his_kpi_detail', $array);
						if ($result) {
							$arr['hasil'] = 'success';
							$arr['message'] = 'Data berhasil diupdate!';
						} else {
							$arr['hasil'] = 'error';
							$arr['message'] = 'Data Gagal diupdate!';
						}
						}
						}
				}else{
						$max = 100;
						if ($max < $bobot) {
							$arr['hasil']='Maaf';
							$arr['message'] = 'Bobot anda '. $bobot .' sudah melampaui batas! Bobot max 100';
						}else{
                        $array = array(
                        'id_kpi'=>($dat['pid']?$dat['pid']:NULL),
						'id_kegiatan'=>($kpi_id?$kpi_id:NULL),
						'target_kinerja'=>$target_kinerja,
						'capaian'=>$dat['capaian'],
						'capaian_persen'=>$dat['capaian_persen'],
						'nilai'=>$dat['nilai'],
						'nilai_bobot'=>$dat['nilai_bobot'],
						'keterangan'=>$dat['keterangan'],
                        );
                        $this->db->where('id',$dat['id_kpi_d']);
						$result = $this->db->update('his_kpi_detail',$array);
						if ($result) {
							$arr['hasil'] = 'success';
							$arr['message'] = 'Data berhasil diupdate!';
						} else {
							$arr['hasil'] = 'error';
							$arr['message'] = 'Data Gagal diupdate!';
						}
						}
				}
						
                }else{
					$max = 100;
					if ($max < $tot_bob) {
						$arr['hasil']='Maaf';
						$arr['message'] = 'Bobot anda  '. $tot_bob .' sudah melampaui batas! Bobot max 100';
					}else{
					$nama1=strtolower($dat['nama']);
					$nama=ucwords($nama1);
					$data = array(
							   'grup'=>$nama,'bobot'=>$dat['no'],'child'=>$dat['child'],);
					$this->db->insert('m_penilaian_kpi',$data);
					$this->db->select('m_penilaian_kpi.id_grup');
					$this->db->where('grup',$nama);
					$res = $this->db->get('m_penilaian_kpi')->row();
					$kpi = $res->id_grup;
					if (empty($dat['id_kpi_d'])) {
						$max1=$dat['max'];
						if($max1 < $b){
							$arr['hasil']='Maaf';
							$arr['message'] = 'Parameter anda sudah melampaui batas! Parameter max '. $max1;
						}else{		
                        $array = array(
						'id_kpi'=>($dat['pid']?$dat['pid']:NULL),
						'id_kegiatan'=>($kpi?$kpi:NULL),
						'target_kinerja'=>$dat['target_kinerja'],
						'capaian'=>$dat['capaian'],
						'capaian_persen'=>$dat['capaian_persen'],
						'nilai'=>$dat['nilai'],
						'nilai_bobot'=>$dat['nilai_bobot'],
						'keterangan'=>$dat['keterangan'],
                        );
                        $result = $this->db->insert('his_kpi_detail', $array);
						if ($result) {
							$arr['hasil'] = 'success';
							$arr['message'] = 'Data berhasil diupdate!';
						} else {
							$arr['hasil'] = 'error';
							$arr['message'] = 'Data Gagal diupdate!';
						}
						}
                    } else {
						$max = 100;
						if ($max < $bobot_awal) {
							$arr['hasil']='Maaf';
							$arr['message'] = 'Bobot anda '. $bobot_awal .' sudah melampaui batas! Bobot max 100';
						}else{
                        $array = array(
                        'id_kpi'=>($dat['pid']?$dat['pid']:NULL),
						'id_kegiatan'=>($kpi?$kpi:NULL),
						'target_kinerja'=>$dat['target_kinerja'],
						'capaian'=>$dat['capaian'],
						'capaian_persen'=>$dat['capaian_persen'],
						'nilai'=>$dat['nilai'],
						'nilai_bobot'=>$dat['nilai_bobot'],
						'keterangan'=>$dat['keterangan'],
                        );
                        $this->db->where('id',$dat['id_kpi_d']);
						$result = $this->db->update('his_kpi_detail',$array);
						if ($result) {
							$arr['hasil'] = 'success';
							$arr['message'] = 'Data berhasil diupdate!';
						} else {
							$arr['hasil'] = 'error';
							$arr['message'] = 'Data Gagal diupdate!';
						}
						}
                    }
				
				}
				}
				}
		  
				$this->set_response($arr, REST_Controller::HTTP_OK);
			
				return;
			}

			
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		
	}
	
	public function hapus_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {

                $this->db->where('id', $this->input->get('id'));

                $res = $this->db->update('his_kpi_detail', array('tampilkan' => '0'));
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
	
	
	public function saveiku_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {
				foreach ($_POST as $dat) {
				$jumlah = $dat['nilai_bobot'];
				$id_kpi = $dat['pid'];
				$bobot = $dat['no'];
				}
				$max = 100;
				if ($max < $bobot) {
					$arr['hasil']='Maaf';
					$arr['message'] = 'Bobot anda  '. $bobot .' sudah atau belum mencapai 100! Bobot 100';
				}elseif($bobot!=100){
					$arr['hasil']='Maaf';
					$arr['message'] = 'Bobot anda  '. $bobot .' sudah atau belum mencapai 100! Bobot 100';
				}else{
				$this->db->where('id', $id_kpi);
				$result = $this->db->update('his_kpi',array('nilai' => round($jumlah, 2), 'status' => '1'));
				if ($result) {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil dihapus!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal dihapus!';
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
		$this->db->join('sys_user_profile','his_kpi.no_pegawai = sys_user_profile.nip','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->where('his_kpi.tampilkan','1');
		$this->db->where('his_kpi.id_jenis',$this->uri->segment(4));
		 
		 $param = urldecode($this->uri->segment(5));
		 $param2 = "%".$param."%";
		 if(!empty($this->uri->segment(5))){
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2); 
		 }

		 if(!empty($this->uri->segment(7))){
			
			$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(7)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		$total_rows = $this->db->count_all_results('his_kpi');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,6);
		 
				
		$this->db->select('his_kpi.*,sys_grup_user.grup,sys_grup_user.grup as nama_uk,
		sys_user.id_user,
		sys_user_profile.nip,
		sys_user_profile.nik,
		sys_user.name,sys_user_profile.kategori_profesi as profesi');
		
		$this->db->join('sys_grup_user','his_kpi.id_unitkerja = sys_grup_user.id_grup','LEFT');  
		$this->db->join('sys_user_profile','his_kpi.id_user = sys_user_profile.id_user','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->where('his_kpi.tampilkan','1');
		$this->db->where('his_kpi.id_jenis',$this->uri->segment(4));

		 $param = urldecode($this->uri->segment(5));
		 $param2 = "%".$param."%";
		 if(!empty($this->uri->segment(5))){
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2); 
		 }
		 
		if(!empty($this->uri->segment(7))){
			
			$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(7)); 
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
								   'nip'=>$d->nip,
								   'nik'=>$d->nik,
								   'id_user'=>$d->id_user,
								   'awal' => date_format(date_create($d->awal), "d-m-Y"),
								   'akhir'=> date_format(date_create($d->akhir), "d-m-Y"),
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
	
	public function list_us_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
			$id_user = $decodedToken->data->id;
			$user_froup = $decodedToken->data->_pnc_id_grup;
				
				//$this->db->limit('100');
				//$this->db->order_by();
		$this->db->select('riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
		$this->db->where('id_user',$id_user);
		$uk = $this->db->get('riwayat_kedinasan')->row();
		$bagian = $uk->bagian;
		$sub_bag = $uk->sub_bagian;
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		$this->db->where('sys_user.status','1');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }

		$param = urldecode($this->uri->segment(4));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(4))){

			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		if (($user_froup == '1') OR ($user_froup == '6')) {
			$grups=array('1','2','66','82','92');
            $this->db->where_in('riwayat_kedinasan.direktorat', $grups);
				
		}else{
		if($sub_bag==0){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		}else{
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}
		}
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }
		if(!empty($this->uri->segment(4))){
			
			 $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		if (($user_froup == '1') OR ($user_froup == '6')) {
			$grups=array('1','2','66','82','92');
            $this->db->where_in('riwayat_kedinasan.direktorat', $grups);
				
		}else{
		if($sub_bag==0){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		}else{
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}}
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');
		// $this->db->order_by('his_kontrak.tglktr','DESC');
  //       $this->db->limit('1');
        // $this->db->order_by('his_str.date_end_str','DESC');
        // $this->db->limit('1');
        // $this->db->order_by('his_sip.date_end','DESC');
        // $this->db->limit('1');
		  $res = $this->db->get('sys_user')->result();
		  foreach($res as $d){

			$arr['result'][]=array('nama_uk'=>$d->nama,
								   'id_uk'=>$d->id_uk,
								   'id_grup'=>$d->id_grup,
								   'id'=>$d->id_user,
								   'nama'=>$d->name,
								   'username'=>$d->username,
								   'profesi'=>$d->profesi,
								   'email'=>$d->email,
								   'nama_group'=>$d->grup,
								   'nip'=>$d->nip,
								   'nik'=>$d->nik,
								   'pendidikan'=>$d->pendidikan,
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
	
	public function listuser_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
			$user_froup = $decodedToken->data->_pnc_id_grup;
			$id_user = $decodedToken->data->id;
				//$this->db->limit('100');
				//$this->db->order_by();
		$this->db->select('riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
		$this->db->where('id_user',$id_user);
		$uk = $this->db->get('riwayat_kedinasan')->row();
		$bagian = $uk->bagian;
		$sub_bag = $uk->sub_bagian;
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		$this->db->where('sys_user.status','1');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }

		$param = urldecode($this->uri->segment(4));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(4))){

			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		if (($user_froup == '1') OR ($user_froup == '6')) {
			$kepala=array('3','38','70','148','231','293','398','509','654','732','881','948','1086','1125','1164','1203','1242','1281','1320','1359','1398','1437','1476','1527','1581','1646','1733','1863','1957','2005','2066','2182','2195','2250','2427','2522','2555','2642','2749','2782');        
			$this->db->where_in('riwayat_kedinasan.jabatan_struktural', $kepala);
					
		}else{
		$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala');
		if($sub_bag==0){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		}else{
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}}
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }
		if(!empty($this->uri->segment(4))){
			
			 $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		if (($user_froup == '1') OR ($user_froup == '6')) {
			$kepala=array('3','38','70','148','231','293','398','509','654','732','881','948','1086','1125','1164','1203','1242','1281','1320','1359','1398','1437','1476','1527','1581','1646','1733','1863','1957','2005','2066','2182','2195','2250','2427','2522','2555','2642','2749','2782');        
			$this->db->where_in('riwayat_kedinasan.jabatan_struktural', $kepala);
					
		}else{
		$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala');
		
		if($sub_bag==0){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		}else{
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}}
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');
		// $this->db->order_by('his_kontrak.tglktr','DESC');
  //       $this->db->limit('1');
        // $this->db->order_by('his_str.date_end_str','DESC');
        // $this->db->limit('1');
        // $this->db->order_by('his_sip.date_end','DESC');
        // $this->db->limit('1');
		  $res = $this->db->get('sys_user')->result();
		  foreach($res as $d){

			$arr['result'][]=array('nama_uk'=>$d->nama,
								   'id_uk'=>$d->id_uk,
								   'id_grup'=>$d->id_grup,
								   'id'=>$d->id_user,
								   'nama'=>$d->name,
								   'username'=>$d->username,
								   'profesi'=>$d->profesi,
								   'email'=>$d->email,
								   'nama_group'=>$d->grup,
								   'nip'=>$d->nip,
								   'nik'=>$d->nik,
								   'pendidikan'=>$d->pendidikan,
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
	
	public function listuser_uk_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
			$id_user = $decodedToken->data->id;
			$user_froup = $decodedToken->data->_pnc_id_grup;
			
				//$this->db->limit('100');
				//$this->db->order_by();
		$this->db->select('riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
		$this->db->where('id_user',$id_user);
		$uk = $this->db->get('riwayat_kedinasan')->row();
		$bagian = $uk->bagian;
		$sub_bag = $uk->sub_bagian;
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		$this->db->where('sys_user.status','1');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }

		$param = urldecode($this->uri->segment(4));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(4))){

			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		if (($user_froup == '1') OR ($user_froup == '6')) {
			$kepala=array('3','38','70','148','231','293','398','509','654','732','881','948','1086','1125','1164','1203','1242','1281','1320','1359','1398','1437','1476','1527','1581','1646','1733','1863','1957','2005','2066','2182','2195','2250','2427','2522','2555','2642','2749','2782');        
			$this->db->where_in('riwayat_kedinasan.jabatan_struktural', $kepala);
					
		}else{
		$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala');
		
		if($sub_bag==0){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		}else{
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}}
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('uk_master','uk_master.id = sys_user.id_uk','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala Sub Bagian');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }
		if(!empty($this->uri->segment(4))){
			
			 $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		if (($user_froup == '1') OR ($user_froup == '6')) {
			$kepala=array('3','38','70','148','231','293','398','509','654','732','881','948','1086','1125','1164','1203','1242','1281','1320','1359','1398','1437','1476','1527','1581','1646','1733','1863','1957','2005','2066','2182','2195','2250','2427','2522','2555','2642','2749','2782');        
			$this->db->where_in('riwayat_kedinasan.jabatan_struktural', $kepala);
					
		}else{
		$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala');
		
		if($sub_bag==0){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		}else{
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}}
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');
		// $this->db->order_by('his_kontrak.tglktr','DESC');
  //       $this->db->limit('1');
        // $this->db->order_by('his_str.date_end_str','DESC');
        // $this->db->limit('1');
        // $this->db->order_by('his_sip.date_end','DESC');
        // $this->db->limit('1');
		  $res = $this->db->get('sys_user')->result();
		  foreach($res as $d){

			$arr['result'][]=array('nama_uk'=>$d->nama,
								   'id_uk'=>$d->id_uk,
								   'id_grup'=>$d->id_grup,
								   'id'=>$d->id_user,
								   'nama'=>$d->name,
								   'username'=>$d->username,
								   'profesi'=>$d->profesi,
								   'email'=>$d->email,
								   'nama_group'=>$d->grup,
								   'nip'=>$d->nip,
								   'nik'=>$d->nik,
								   'pendidikan'=>$d->pendidikan,
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
		$this->db->join('sys_user_profile','his_kpi_smf.no_pegawai = sys_user_profile.nip','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->where('his_kpi_smf.tampilkan','1');
		$this->db->where('his_kpi_smf.id_jenis',$this->uri->segment(4));
		$param = urldecode($this->uri->segment(5));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(5))){
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike",$param2); 
		 }
		$total_rows = $this->db->count_all_results('his_kpi_smf');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,6);
		 
				
		$this->db->select('his_kpi_smf.*,sys_grup_user.grup,sys_grup_user.grup as nama_uk,
		sys_user_profile.nip,
		sys_user_profile.nik,
		sys_user.name,sys_user_profile.kategori_profesi as profesi');
		
		$this->db->join('sys_grup_user','his_kpi_smf.id_unitkerja = sys_grup_user.id_grup','LEFT');  
		$this->db->join('sys_user_profile','his_kpi_smf.no_pegawai = sys_user_profile.nip','LEFT');
		$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
		$this->db->where('his_kpi_smf.tampilkan','1');
		$this->db->where('his_kpi_smf.id_jenis',$this->uri->segment(4));
		if(!empty($this->uri->segment(5))){
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike",$param2); 
		 } 

		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		
		
		  $res = $this->db->get('his_kpi_smf')->result();
		  foreach($res as $d){
			$arr['result'][]=array('nama_uk'=>$d->nama_uk,
								   'id_uk'=>$d->id_unitkerja, 
								   'id'=>$d->id,
								   'nama'=>$d->name, 
								   'nama_group'=>$d->grup,
								   'nip'=>$d->nip,
								   'nik'=>$d->nik,
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
				$id_user = $this->input->post('id_user');
				$id_jenis = $this->input->post('id_jenis'); 
				$nip = $this->input->post('nip');
				$awal = date_format(date_create($this->input->post('awal')), "Y-m-d");
				$akhir = date_format(date_create($this->input->post('akhir')), "Y-m-d");
			
				//cek dulu kalau sama dia gak boleh save
				$this->db->where('id_jenis',$id_jenis);
				$this->db->where('awal <=',$awal);
				$this->db->where('akhir >=',$akhir);
				$this->db->where('id_user',$id_user);
				$res = $this->db->get('his_kpi')->row();
				
				$this->db->where('id_user',$id_user);
				$profil = $this->db->get('sys_user_profile')->result();
				if(empty($res)){
				$this->db->order_by('id','DESC');
				$this->db->limit('1');
				$this->db->where('id_user',$id_user);
				$pegid = $this->db->get('his_kpi')->result();
				if(!empty($pegid)){
				foreach($pegid as $peg1){
				$peg= $peg1->id;
				$data=array(
					'id_jenis'=> $id_jenis,
					'no_pegawai' => $nip,
					'awal'=> $awal,
					'akhir'=> $akhir,
					'id_user'=> $id_user,
					'id_unitkerja' => $id_grup
				);
				$this->db->insert('his_kpi',$data);
				$id_kpi = $this->db->insert_id('his_kpiid_seq');
				if(!empty($id_kpi)){
				$this->db->where('id_kpi',$peg);
				$this->db->where('tampilkan',1);
				$res = $this->db->get('his_kpi_detail')->result();
				foreach($res as $d){
					$data=array(
					'id_kpi'=> $id_kpi,
					'id_kegiatan'=> $d->id_kegiatan,
					//'target_kinerja'=> $d->target_kinerja,
				);
				$this->db->insert('his_kpi_detail',$data);
				}
				if($profil[0]->kategori_profesi!=2){
				if($id_jenis=="5"){
				$this->db->where('tampilkan',1);
				$this->db->where('child','20');
				$mkpi = $this->db->get('m_penilaian_kpi')->result();
				foreach($mkpi as $kpi){
					$data=array(
					'id_kpi'=> $id_kpi,
					'id_kegiatan'=> $kpi->id_grup,
				);
				$this->db->insert('his_kpi_detail',$data);
				}
				}else if($id_jenis=="17"){
				$this->db->where('tampilkan',1);
				$this->db->where('child','25');
				$mkpi = $this->db->get('m_penilaian_kpi')->result();
				foreach($mkpi as $kpi){
					$data=array(
					'id_kpi'=> $id_kpi,
					'id_kegiatan'=> $kpi->id_grup,
				);
				$this->db->insert('his_kpi_detail',$data);
				}
				}
				}
				}
				}
				}else{
				$data=array(
					'id_jenis'=> $id_jenis,
					'no_pegawai' => $nip,
					'awal'=> $awal,
					'akhir'=> $akhir,
					'id_user'=> $id_user,
					'id_unitkerja' => $id_grup
				);
				$this->db->insert('his_kpi',$data);
				$id = $this->db->insert_id('his_kpiid_seq');
				if($profil[0]->kategori_profesi!=2){
				if($id_jenis=="5"){
				$this->db->where('tampilkan',1);
				$this->db->where('child','20');
				$mkpi = $this->db->get('m_penilaian_kpi')->result();
				foreach($mkpi as $kpi){
					$data=array(
					'id_kpi'=> $id,
					'id_kegiatan'=> $kpi->id_grup,
				);
				$this->db->insert('his_kpi_detail',$data);
				}
				}else if($id_jenis=="17"){
				$this->db->where('tampilkan',1);
				$this->db->where('child','25');
				$mkpi = $this->db->get('m_penilaian_kpi')->result();
				foreach($mkpi as $kpi){
					$data=array(
					'id_kpi'=> $id,
					'id_kegiatan'=> $kpi->id_grup,
				);
				$this->db->insert('his_kpi_detail',$data);
				}
				}
				}
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
				$id_user = $this->input->post('id_user');
				$awal = date_format(date_create($this->input->post('awal')), "Y-m-d");
				$akhir = date_format(date_create($this->input->post('akhir')), "Y-m-d");
			
				//cek dulu kalau sama dia gak boleh save
				$this->db->where('id_jenis',$id_jenis);
				$this->db->where('awal <=',$awal);
				$this->db->where('akhir >=',$akhir);
				$this->db->where('id_user',$id_user);
				$res = $this->db->get('his_kpi')->row();

				if(empty($res)){

				
				$data=array(
					'id_jenis'=> $id_jenis,
					'no_pegawai' => $nip,
					'awal'=> $awal,
					'akhir'=> $akhir,
					'id_user'=> $id_user,
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
				  $this->db->where('his_kpi_detail.tampilkan','1');
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
				if(($child==16)){
				$ik='IKU ';
				$max=6;
				}else if(($child==17)){
				$ik='IKP ';
				$max=20;
				}else{
				$ik='IKI ';
				$max=20;
				}
				if(!empty($id)){
					 $this->db->where('his_kpi_detail.id_kpi',$this->input->get('pid'));
				}
				if(!empty($idp)){
					 $this->db->where('m_penilaian_kpi.id_grup',$this->input->get('idp'));
				}
				if(!empty($child)){
					$childs=array('20',$child);
					$this->db->where_in('m_penilaian_kpi.child',$childs);
				}

				  $this->db->select('m_penilaian_kpi.*,his_kpi_detail.*,his_kpi.no_pegawai,his_kpi.id as id_kpi,his_kpi_detail.id as id_kpi_d');
				  $this->db->where('m_penilaian_kpi.tampilkan','1');
				  $this->db->where('his_kpi_detail.tampilkan','1');
				  $this->db->join('his_kpi_detail','m_penilaian_kpi.id_grup = his_kpi_detail.id_kegiatan','LEFT');
				  $this->db->join('his_kpi','his_kpi_detail.id_kpi = his_kpi.id','LEFT');
				  $res = $this->db->get('m_penilaian_kpi')->result();
				  
			if(!empty($res)){
				$jmlh=count($res); 
				$i=0;
				$total_bbt=0;
				$nil_bob=0;
				 foreach($res as $d){
					$id_kpi=$d->id_kpi;
					$bobot=$d->bobot;
					$nilai=$d->nilai;
					$total_bbt += $bobot;
					$nilai_bobot=$bobot/100*$nilai;
					$nil_bob += $nilai_bobot/$jmlh;
					$arr[]=array('child'=> $d->child, 'n' => $ik.++$i,'id'=>$d->id_grup,'nama'=>$d->grup, 'id_kpi'=>$d->id_kpi, 'id_kpi_d'=>$d->id_kpi_d, 'pid'=>$id_kpi, 'idpeg'=>$d->no_pegawai, 'no'=>$d->bobot, 'target_kinerja'=>$d->target_kinerja, 'capaian'=>$d->capaian, 'capaian_persen'=>$d->capaian_persen, 'nilai_bobot'=>$nilai_bobot, 'nilai'=>$d->nilai, 'keterangan'=>$d->keterangan);
				  }
				$arr[] = array(
				'id_kpi_d' => 1,
				'pid' => $id_kpi,
				'nama' => 'TOTAL',
				'no' => $total_bbt,
				'nilai_bobot' => $nil_bob,
				'max'=> $max,
				'target_kinerja'=> NULL,
				'capaian'=> NULL,
				'capaian_persen'=> NULL,
				'nilai'=> NULL,
				'keterangan'=> NULL,
				);
			}else{
			$arr['result'] ='empty';
			}
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
				if(!empty($idp)){
					 $this->db->where('m_penilaian_kpi.id_grup',$this->input->get('idp'));
				}
				if(!empty($child)){
					$this->db->where('m_penilaian_kpi.child',$child);
				}
				
				  $this->db->select('m_penilaian_kpi.*');
				  $this->db->where('m_penilaian_kpi.tampilkan','1');
				  $res = $this->db->get('m_penilaian_kpi')->result();
				
			if(!empty($res)){
				$i=0;
				 foreach($res as $d){
					$arr[]=array('n' => ++$i,'id'=>$d->id_grup,'nama'=>$d->grup,'no'=>$d->bobot);
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
				 $id_parent = $_POST['id_parent'];
				 $max = $_POST['max'];
				 $bobot= $_POST['pilih'];
				 $nama1=strtolower($_POST['group_group']);
				 $group_group=ucwords($nama1);
				 $data = array(
							   'grup'=>$group_group,'bobot'=>$bobot);
				 
				  if(!empty($id_parent)){
					$data['child']=$id_parent;
				  }
				  
				$this->db->insert('m_penilaian_kpi',$data);
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
	
	
	 public function edit_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $group_aplikasi = '1';//$this->input->post('group_aplikasi');
				 $pilih   = $_POST['pilih'];
				 $awal   = $_POST['awal'];
				 $id_parent = $_POST['id_parent'];
				 $id_group   = $_POST['id_group'];
				 $nama1=strtolower($_POST['group_group']);
				 $group_group=ucwords($nama1);
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
				//print_r($user_froup);die();
                if (($user_froup == '1') OR ($user_froup == '6') OR ($user_froup == '3') OR ($user_froup == '92') OR ($user_froup == '97') OR ($user_froup == '99')) {
                    if ((!empty($this->input->get('id_uk'))) AND ($this->input->get('id_uk') <> 'null')) {
                        $this->db->where('id_unitkerja', $this->input->get('id_uk'));
                    }

                }else{
                    $this->db->where('id_unitkerja', $user_froup);
                }
			
				
				if (empty($this->input->get('tahun'))) {
                    $thn = date('Y');
                } else {
                    $thn = $this->input->get('tahun');
                }
				
                $this->db->select('his_kpi.*,sys_user_profile.kategori_profesi,his_kpi.id_unitkerja as iki,m_status_proses.nama as status_name, sys_grup_user.grup as nama_uk,sys_user.name, EXTRACT(MONTH FROM his_kpi.akhir) AS bulan, EXTRACT(YEAR FROM his_kpi.akhir) AS tahun');
				$this->db->join('sys_grup_user','his_kpi.id_unitkerja = sys_grup_user.id_grup','LEFT');  
				$this->db->join('sys_user_profile','his_kpi.no_pegawai = sys_user_profile.nip','LEFT');
				$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
				$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
				$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
				$this->db->join('m_status_proses','m_status_proses.id = his_kpi.status','LEFT');
				$this->db->where('his_kpi.id_jenis',$id_jenis);
				$this->db->where('EXTRACT(YEAR FROM his_kpi.akhir) =',$thn);
				$this->db->where('his_kpi.tampilkan','1');
				$this->db->where('his_kpi.status !=', 4);
				if(!empty($this->input->get('nopeg'))){
					$this->db->where('sys_user.id_user',$this->input->get('nopeg'));
					$this->db->where('his_kpi.status',2);
				}
				if(!empty($this->input->get('bulan'))){
					$this->db->where('EXTRACT(MONTH FROM his_kpi.akhir) =',$this->input->get('bulan'));
				}
				if($id_jenis=='5'){
				if($user_froup == '99'){
					$this->db->where("sys_user_profile.kategori_profesi !=",'2');
					$this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Staf');
				}else if($user_froup == '97'){
					$this->db->not_like("m_index_jabatan_asn_detail.ds_jabatan",'Staf');
					$this->db->where("sys_user_profile.kategori_profesi !=",'2');
				}else if($user_froup == '3'){
					$this->db->where("sys_user_profile.kategori_profesi =",'2');
				}
				}
				$this->db->order_by('sys_user.name', 'ASC');
                $res = $this->db->get('his_kpi')->result();
				
                if (!empty($res)) {
                    $i = 0;
					$iku=0;
                    foreach ($res as $d) {
					$unit=$d->iki;
					$bulan=$d->bulan;
					$this->db->select('his_kpi.*,kategori_profesi,his_kpi.nilai as iku');
					$this->db->join('sys_grup_user','his_kpi.id_unitkerja = sys_grup_user.id_grup','LEFT');  
					$this->db->join('sys_user_profile','his_kpi.no_pegawai = sys_user_profile.nip','LEFT');
					$this->db->join('sys_user','sys_user.id_user = sys_user_profile.id_user','LEFT');
					$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
					$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
					$this->db->join('m_status_proses','m_status_proses.id = his_kpi.status','LEFT');
					$this->db->where('his_kpi.id_unitkerja',$unit);
					$this->db->where('EXTRACT(MONTH FROM his_kpi.akhir) =',$bulan);
					$this->db->where('EXTRACT(YEAR FROM his_kpi.akhir) =',$thn);
					$this->db->where('his_kpi.id_jenis',16);
					$this->db->where('his_kpi.status !=',4);
					if(!empty($this->input->get('nopeg'))){
					$this->db->where('sys_user.id_user',$this->input->get('nopeg'));
					$this->db->where('his_kpi.status',2);
					}
										
					$this->db->order_by('sys_user.name', 'ASC');
					$n_unit = $this->db->get('his_kpi')->result();
					
					foreach($n_unit as $n){
						$iku=$n->iku;
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
	function chat_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {

                $array = array(
                    'id_comment' => ($this->input->post('idtk')?$this->input->post('idtk'):NULL),
                    'tgl' => date('Y-m-d H:i:s'),
                    'isi' => ($this->input->post('isi')?$this->input->post('isi'):NULL),
                    'id_user' => $decodedToken->data->id,
                    'kategori' => ($this->input->post('kategori_chat')?$this->input->post('kategori_chat'):NULL)
                );


                $this->db->insert('comment_kpi', $array);

                if ($this->db->affected_rows() == '1') {
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
	
	function getchatall_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {


                $this->db->select('comment_kpi.*,sys_user.username');
                if (!empty($this->input->get('kategori'))) {
                    $this->db->where('comment_kpi.kategori', $this->input->get('kategori'));
                }
                $this->db->where('comment_kpi.id_comment', $this->input->get('id'));
                $this->db->order_by('tgl', 'ASC');
                $this->db->join('sys_user', 'comment_kpi.id_user = sys_user.id_user', 'LEFT');
                $res = $this->db->get('comment_kpi')->result();

                if (!empty($res)) {
                    foreach ($res as $dat) {
                        $arr['result'][] = array('id' => $dat->id,
                            'id_comment' => $dat->id_comment,
                            'tgl' => $dat->tgl,
                            'isi' => $dat->isi,
                            'id_user' => $dat->id_user,
                            'username' => $dat->username
                        );
                    }

                }

                if ($this->db->affected_rows() == '1') {

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
	
	 public function updateiki_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

            if ($decodedToken != false) {

                $dd = array('status' => $this->input->get('type'));
				$id=array($this->input->get('id'));
                $this->db->where_in('id', $id,FALSE);
                $res = $this->db->update('his_kpi', $dd);
                if ($res) {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal!';
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}
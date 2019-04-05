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

class Jabatan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
  
	public function listjabatan_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 
		
		 
				
		$this->db->select('sys_user.*,a.grup as dir_asal,his_mutasi_jabatan.tgl_mutasi,his_mutasi_jabatan.keterangan,
		b.grup as bag_asal,
		c.grup as subbag_asal,
		d.grup as dir_tujuan,
		e.grup as bag_tujuan,
		f.grup as subbag_tujuan,
		g.grup as kaunit_tujuan,
		h.grup as staff_tujuan,
		his_mutasi_jabatan.no_sk,
		his_mutasi_jabatan.tgl_sk,
		dm_term.nama as kelas,his_mutasi_jabatan.id as idhis,
		j.kd_jabatan,
		j.ds_jabatan
		');

		$this->db->join('sys_grup_user as h','h.id_grup = his_mutasi_jabatan.staff_tujuan','LEFT');
		$this->db->join('sys_grup_user as g','g.id_grup = his_mutasi_jabatan.kaunit_tujuan','LEFT');
		$this->db->join('sys_grup_user as f','f.id_grup = his_mutasi_jabatan.sub_bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as e','e.id_grup = his_mutasi_jabatan.bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as d','d.id_grup = his_mutasi_jabatan.direktorat_tujuan','LEFT');
		$this->db->join('sys_grup_user as c','c.id_grup = his_mutasi_jabatan.sub_bagian_asal','LEFT');
		$this->db->join('sys_grup_user as b','b.id_grup = his_mutasi_jabatan.bagian_asal','LEFT');
		$this->db->join('sys_grup_user as a','a.id_grup = his_mutasi_jabatan.direktorat_asal','LEFT');
		
		 $this->db->join('sys_user','sys_user.id_user = his_mutasi_jabatan.user_id','LEFT');
		 $this->db->join('m_index_jabatan_asn_detail as j','j.migrasi_jabatan_detail_id = his_mutasi_jabatan.jabatan','LEFT');
		 $this->db->join('dm_term','dm_term.id=his_mutasi_jabatan.id_kelas','LEFT');
		$this->db->where('sys_user.status','1'); 
		$this->db->where('his_mutasi_jabatan.tampilkan','1'); 
		$this->db->where('his_mutasi_jabatan.user_id',$this->uri->segment('4')); 
		$this->db->order_by('his_mutasi_jabatan.tgl_sk','DESC');
		  $res = $this->db->get('his_mutasi_jabatan')->result();
		  if(!empty($res)){
			
		  
		  foreach($res as $d){
			$arr[]=array('id'=>$d->idhis,
								   'nama'=>$d->name, 
								   'dir_asal' => $d->dir_asal,
								   'tgl' => $d->tgl_mutasi,
								   'no_sk' => $d->no_sk,
								   'tgl_sk' => $d->tgl_sk,
								   'jabatan' => '[Kode: '.$d->kd_jabatan.'] '.$d->ds_jabatan,
								   'dir_tujuan' => $d->dir_tujuan,
								   'bag_tujuan' => $d->bag_tujuan,
								   'subbag_tujuan' => $d->subbag_tujuan,
								   'kaunit_tujuan' => $d->kaunit_tujuan,
								   'staff_tujuan' => $d->staff_tujuan,
								   'keterangan' => $d->keterangan,
								   'kelas' => $d->kelas,
								   );
		  }
		  }else{
			$arr=array();
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	public function getjabatan_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 
		
		 
				
		$this->db->select('his_mutasi_jabatan.*,
		a.grup as dir_asal,his_mutasi_jabatan.tgl_mutasi,his_mutasi_jabatan.keterangan,
		b.grup as bag_asal,
		c.grup as subbag_asal,
		d.grup as dir_tujuan,
		e.grup as bag_tujuan,
		f.grup as subbag_tujuan,
		g.grup as unit_tujuan,
		h.grup as staf_tujuan,
		dm_term.nama as kelas, 
		');
		$this->db->join('sys_grup_user as h','h.id_grup = his_mutasi_jabatan.staff_tujuan','LEFT');
		$this->db->join('sys_grup_user as g','g.id_grup = his_mutasi_jabatan.kaunit_tujuan','LEFT');
		$this->db->join('sys_grup_user as f','f.id_grup = his_mutasi_jabatan.sub_bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as e','e.id_grup = his_mutasi_jabatan.bagian_tujuan','LEFT');
		$this->db->join('sys_grup_user as d','d.id_grup = his_mutasi_jabatan.direktorat_tujuan','LEFT');
		$this->db->join('sys_grup_user as c','c.id_grup = his_mutasi_jabatan.sub_bagian_asal','LEFT');
		$this->db->join('sys_grup_user as b','b.id_grup = his_mutasi_jabatan.bagian_asal','LEFT');
		$this->db->join('sys_grup_user as a','a.id_grup = his_mutasi_jabatan.direktorat_asal','LEFT');
		$this->db->join('m_index_jabatan_asn_detail as j','j.migrasi_jabatan_detail_id = his_mutasi_jabatan.jabatan','LEFT');
		 $this->db->join('sys_user','sys_user.id_user = his_mutasi_jabatan.user_id','LEFT');
		 $this->db->join('dm_term','dm_term.id=his_mutasi_jabatan.id_kelas','LEFT');
		$this->db->where('sys_user.status','1'); 
		$this->db->where('his_mutasi_jabatan.id',$this->uri->segment('4')); 
		$this->db->order_by('his_mutasi_jabatan.tgl_sk','DESC');
		  $d = $this->db->get('his_mutasi_jabatan')->row();
		   
			$arr=array('id'=> $d->id,
								   'dir_asal' => $d->dir_asal,
								   'tgl' => $d->tgl_mutasi,
								   'no_sk' => $d->no_sk,
								   'tgl_sk' => $d->tgl_sk,
								   'jabatan' => $d->jabatan,
								   'jabatan2' => $d->jabatan2,
								   'jabatan3' => $d->jabatan3,
								   'dir_tujuan' => $d->dir_tujuan,
								   'bag_tujuan' => $d->bag_tujuan,
								   'subbag_tujuan' => $d->subbag_tujuan,
								   'unit_tujuan' => $d->unit_tujuan,
								   'staf_tujuan' => $d->staf_tujuan,
								   'keterangan' => $d->keterangan,
								   'kelas' => $d->kelas,
								   'direktorat_asal' => $d->direktorat_asal,
								   'bagian_tujuan'=> $d->bagian_tujuan,
								   'sub_bagian_tujuan' => $d->sub_bagian_tujuan,
								   'bagian_tujuan'=> $d->bagian_tujuan,
								   'sub_bagian_tujuan' => $d->sub_bagian_tujuan,
								   'kaunit_tujuan' => $d->kaunit_tujuan,
								   'staff_tujuan' => $d->staff_tujuan,
								   'id_satker'=> $d->id_satker,
								   'id_kelas'=> $d->id_kelas,
								   'direktorat_tujuan' => $d->direktorat_tujuan


								   );
		  
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	function deletejabatan_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 
					 $this->db->where('id',$this->input->get('id'));
					 $this->db->where('aktif','0');
					 $this->db->update('his_mutasi_jabatan',array('tampilkan'=>'0'));
			  //$res = $this->db->get('m_jenis_cuti')->result();
			  if($this->db->affected_rows() == '1'){
				$arr['hasil']='success';
				$arr['message']='Data berhasil ditambah!';
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal update! jabatan aktif tidak dapat dirubah';
			}
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	 
}
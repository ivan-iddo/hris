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
            	$id_pengajuan = $this->input->get('id');
            	if(!empty($id_pengajuan)){
					$this->db->where('id_pengajuan',$id_pengajuan);
				}
				
				$total_rows = $this->db->count_all_results($this->table);
				$pagination = create_pagination_endless('/persyaratan//0/', $total_rows,$this->perpage,5);
				$this->db->select('pengajuan_jabatan.*,
				persyaratan_jabatan.jabatan_baru,
				persyaratan_jabatan.masa_jabatan as masa_jabatan_persyaratan,
				persyaratan_jabatan.kompetensi as kompetensi_persyaratan,
				persyaratan_jabatan.formal as formal_persyaratan,
				persyaratan_jabatan.nonformal as nonformal_persyaratan,
				persyaratan_jabatan.jabatan_lama,
				persyaratan_jabatan.tufoksi as tufoksi_persyaratan,sys_user.name');
				$this->db->join('persyaratan_jabatan','pengajuan_jabatan.id_persyaratan = persyaratan_jabatan.id_persyaratan','LEFT');
				$this->db->join('sys_user','sys_user.id_user = pengajuan_jabatan.id_user','LEFT');
				if(!empty($id_pengajuan)){
					$this->db->where('id_pengajuan',$id_pengajuan);
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
					'formal'=> $dat->formal,
					'nonformal'=> $dat->nonformal,
					'jabatan'=> $dat->jabatan,
					'tufoksi'=> $dat->tufoksi,
					'status'=> $dat->status,
					'keterangan'=> $dat->keterangan,
					'nama'=> $dat->name,
					'jabatan_baru'=> $dat->jabatan_baru,
					'masa_jabatan_persyaratan'=> $dat->masa_jabatan_persyaratan,
					'kompetensi_persyaratan'=> $dat->kompetensi_persyaratan,
					'formal_persyaratan'=> $dat->formal_persyaratan,
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
					$this->db->where("name ilike",$param); 
				 }
				$total_rows = $this->db->count_all_results($this->table);
				$pagination = create_pagination_endless('/persyaratan//0/', $total_rows,$this->perpage,5);
				$this->db->select('pengajuan_jabatan.*,sys_user.name');
				$this->db->join('sys_user','sys_user.id_user = pengajuan_jabatan.id_user','LEFT');
				if(!empty($id_persyaratan)){
					$this->db->where('id_persyaratan',$id_persyaratan);
				}
				if(!empty($this->uri->segment(4))){
					$this->db->where("name ilike",$param); 
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


	public function save_post(){
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

					//pendidikan
					$this->db->select('his_pendidikan.*,dm_term.nama as jenjangPendidikan');
        			$this->db->join('sys_user_profile','sys_user_profile.pendidikan_akhir = his_pendidikan.pen_code');
        			$this->db->join('dm_term', 'dm_term.id = his_pendidikan.pen_code', 'LEFT');
        			$this->db->where('sys_user_profile.id_user', $user_id);
        			$pendidikan = $this->db->get('his_pendidikan')->row();
        			$pendidikan_akhir = $pendidikan->jenjangPendidikan." ".$pendidikan->pen_jur;

        			//jabatan skrg
        			$this->db->select('sys_user.*,sys_grup_user.grup');
					$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
					$this->db->where('sys_user.id_user', $user_id);
					$jabatan = $this->db->get('sys_user')->row();
					$jabatan_sekarang =$jabatan->grup;

					$this->db->where('his_pelatihan.tampilkan','1');
					$this->db->where('his_pelatihan.id_user', $user_id);
					$pelatihan = $this->db->get('his_pelatihan')->result();
					$nonformal = array();
					foreach($pelatihan as $d){
					$nonformal[]=array(
							   'nama'=> $d->nama,
							   );
				 	}
				 	$pendidikan_nonformal = implode(', ', array_column($nonformal, 'nama'));

					$arr=array(
					'id_user'=> $user_id,
					'id_persyaratan'=> $this->input->post('id_persyaratan'),
					'masa_jabatan'=> ($masa_jabatan?$masa_jabatan:NULL),
					'kompetensi'=> ($this->input->post('kompetensiAnda')?$this->input->post('kompetensiAnda'):NULL),
					'formal'=> ($pendidikan_akhir?$pendidikan_akhir:NULL),
					'nonformal'=> ($pendidikan_nonformal?$pendidikan_nonformal:NULL),
					'jabatan'=> ($jabatan_sekarang?$jabatan_sekarang:NULL),
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

	public function getoption_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					
				 if(!empty($this->uri->segment('4'))){
					$this->db->where('id',$this->uri->segment('4'));
				 }
					 $this->db->order_by('pengembangan_pelatihan_kegiatan','ASC');
					 
			  $res = $this->db->get($this->table)->result();

			  if(!empty($res)){

			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->pengembangan_pelatihan_kegiatan,'value'=>$d->id);
			  }
			}else{
				$arr['result'][]=array('label'=>'No Data','value'=>'');
			}
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	  
}
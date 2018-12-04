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

class Index_direksi extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	 var $table='riwayat_kedinasan';
	 var $perpage = 20;
 
	
	public function listdata_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

				if(!empty($this->input->get('id'))){
					$this->db->where('id',$this->input->get('id'));
				}

				if(!empty($this->uri->segment(4))){
					$this->db->like("id_user",$this->uri->segment(4)); 
				 }
				$total_rows = $this->db->count_all_results($this->table);
				$pagination = create_pagination_endless('/mutasi/Index_direksi/0/', $total_rows,$this->perpage,5);
				  
				if(!empty($this->input->get('id'))){
					$this->db->where('id',$this->input->get('id'));
				}
				if(!empty($this->uri->segment(4))){
					$this->db->like("id_user",$this->uri->segment(4)); 
				 }
				  $this->db->where('tampilkan','1');
				  $this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
				  $res = $this->db->get($this->table)->result();
				  
			if(!empty($res)){
				 foreach($res as $dat){
					$arr['result'][]= array('id'=> $dat->id,'id_user'=> $dat->id_user,'status_pegawai'=> $dat->status_pegawai,'tmt_cpns'=> $dat->tmt_cpns,'tmt_pns'=> $dat->tmt_pns,'direktorat'=> $dat->direktorat,'bagian'=> $dat->bagian,'sub_bagian'=> $dat->sub_bagian,'jabatan_asn'=> $dat->jabatan_asn,'subjabasn'=> $dat->subjabasn,'ketahli'=> $dat->ketahli,'tmt_jabatan_asn'=> $dat->tmt_jabatan_asn,'jabatan_struktural'=> $dat->jabatan_struktural,'tmt_jabatan'=> $dat->tmt_jabatan,'tgl_bergabung'=> $dat->tgl_bergabung,'inst_asal'=> $dat->inst_asal,'peringkat'=> $dat->peringkat,'no_index_dok'=> $dat->no_index_dok,'golongan'=> $dat->golongan,'tmt_golongan'=> $dat->tmt_golongan,'aktif'=> $dat->aktif,);
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

				if(!empty($this->input->post('id_mutasi'))){
					//edit
					$id= $this->input->post('id_mutasi');
					$arr=array('id_user'=> $this->input->post('id_user'),'status_pegawai'=> $this->input->post('status_pegawai'),'tmt_cpns'=> $this->input->post('tmt_cpns'),'tmt_pns'=> $this->input->post('tmt_pns'),'direktorat'=> $this->input->post('direktorat'),'bagian'=> $this->input->post('bagian'),'sub_bagian'=> $this->input->post('sub_bagian'),'jabatan_asn'=> $this->input->post('jabatan_asn'),'subjabasn'=> $this->input->post('subjabasn'),'ketahli'=> $this->input->post('ketahli'),'tmt_jabatan_asn'=> $this->input->post('tmt_jabatan_asn'),'jabatan_struktural'=> $this->input->post('jabatan_struktural'),'tmt_jabatan'=> $this->input->post('tmt_jabatan'),'tgl_bergabung'=> $this->input->post('tgl_bergabung'),'inst_asal'=> $this->input->post('inst_asal'),'peringkat'=> $this->input->post('peringkat'),'no_index_dok'=> $this->input->post('no_index_dok'),'golongan'=> $this->input->post('golongan'),'tmt_golongan'=> $this->input->post('tmt_golongan'),'aktif'=> $this->input->post('aktif'),);;//array('nama'=>$this->input->post('nama'));
					$this->db->where('id',$id);
					$this->db->update($this->table,$arr);
				}else{
					//save
					$arr=array('id_user'=> $this->input->post('id_user'),'status_pegawai'=> $this->input->post('status_pegawai'),'tmt_cpns'=> $this->input->post('tmt_cpns'),'tmt_pns'=> $this->input->post('tmt_pns'),'direktorat'=> $this->input->post('direktorat'),'bagian'=> $this->input->post('bagian'),'sub_bagian'=> $this->input->post('sub_bagian'),'jabatan_asn'=> $this->input->post('jabatan_asn'),'subjabasn'=> $this->input->post('subjabasn'),'ketahli'=> $this->input->post('ketahli'),'tmt_jabatan_asn'=> $this->input->post('tmt_jabatan_asn'),'jabatan_struktural'=> $this->input->post('jabatan_struktural'),'tmt_jabatan'=> $this->input->post('tmt_jabatan'),'tgl_bergabung'=> $this->input->post('tgl_bergabung'),'inst_asal'=> $this->input->post('inst_asal'),'peringkat'=> $this->input->post('peringkat'),'no_index_dok'=> $this->input->post('no_index_dok'),'golongan'=> $this->input->post('golongan'),'tmt_golongan'=> $this->input->post('tmt_golongan'),'aktif'=> $this->input->post('aktif'),);;//array('id_user'=>$this->input->post('nama'));
					 
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
					$this->db->where('id',$id);
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

	public function getoption_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					
				 if(!empty($this->uri->segment('4'))){
					$this->db->where('id',$this->uri->segment('4'));
				 }
					 $this->db->order_by('id_user','ASC');
					 
			  $res = $this->db->get($this->table)->result();

			  if(!empty($res)){

			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->id_user,'value'=>$d->id);
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
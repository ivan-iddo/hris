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

class Users extends REST_Controller
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

		$param = urldecode($this->uri->segment(3));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(3))){

			// $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param); 
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		 if(!empty($this->uri->segment(5))){
			
			$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		}
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
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
		if(!empty($this->uri->segment(3))){
			
			 // $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		 if(!empty($this->uri->segment(5))){
			
			$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5));  
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		}
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');

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

	public function list_user_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		$id_user = $decodedToken->data->id;
		
		$this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
		$this->db->where('id_user',$id_user);
		$uk = $this->db->get('riwayat_kedinasan')->row();
		$dir = $uk->direktorat;
		$bagian = $uk->bagian;
		$sub_bag = $uk->sub_bagian;
		
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
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

		$param = urldecode($this->uri->segment(3));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(3))){

			// $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param); 
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		 //if(!empty($this->uri->segment(5))){
			
			//$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		//}
		
		if($sub_bag==0){
		$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
		if($bagian==0){
		$this->db->where_in('riwayat_kedinasan.direktorat', $dir);
		}
		}else{
		$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
		$this->db->where_in('riwayat_kedinasan.sub_bagian', $sub_bag);
		}
		
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
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
		if(!empty($this->uri->segment(3))){
			
			 // $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		// if(!empty($this->uri->segment(5))){
			
		//	$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5));  
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		//}
		
		if($sub_bag==0){
		$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
		if($bagian==0){
		$this->db->where_in('riwayat_kedinasan.direktorat', $dir);
		}
		}else{
		$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
		$this->db->where_in('riwayat_kedinasan.sub_bagian', $sub_bag);
		}
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');

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
	
	public function list_userlat_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		$id_user = $decodedToken->data->id;
		$user_froup = $decodedToken->data->_pnc_id_grup;
				   
		$this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
		$this->db->where('id_user',$id_user);
		$uk = $this->db->get('riwayat_kedinasan')->row();
		$dir = $uk->direktorat;
		$bagian = $uk->bagian;
		$sub_bag = $uk->sub_bagian;
		
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
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

		$param = urldecode($this->uri->segment(3));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(3))){

			// $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param); 
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		 //if(!empty($this->uri->segment(5))){
			
			//$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		//}
		if($user_froup!=1){
                 
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
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list_userlat/0/', $total_rows,$total_rows);
				
		$this->db->select('sys_user.*,riwayat_kedinasan.*,m_golongan_peg.pangkat as pangkat,m_golongan_peg.gol_romawi as gol_romawi,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_golongan_peg','m_golongan_peg.id = riwayat_kedinasan.golongan','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }
		if(!empty($this->uri->segment(3))){
			
			 // $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		// if(!empty($this->uri->segment(5))){
			
		//	$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5));  
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		//}
		if($user_froup!=1){   
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
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');

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
								   'pangkat'=>$d->pangkat,
								   'golongan'=>$d->gol_romawi,
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
	
	public function list_usernew_get(){
		$headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		$id_user = $decodedToken->data->id;
		$user_froup = $decodedToken->data->_pnc_id_grup;
				   
		
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
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

		$param = urldecode($this->uri->segment(3));
		$param2 = "%".$param."%";
		 if(!empty($this->uri->segment(3))){

			// $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param); 
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2); 
			// $this->db->like("sys_user.name",$param); 
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
		 }
		 //if(!empty($this->uri->segment(5))){
			
			//$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5)); 
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		//}
		
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list_userlat/0/', $total_rows,$total_rows);
				
		$this->db->select('sys_user.*,riwayat_kedinasan.*,m_golongan_peg.pangkat as pangkat,m_golongan_peg.gol_romawi as gol_romawi,sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,dm_term.nama as pendidikan,m_kode_profesi_group.ds_group_jabatan as profesi');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_golongan_peg','m_golongan_peg.id = riwayat_kedinasan.golongan','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->join('dm_term','sys_user_profile.pendidikan_akhir = dm_term.id','LEFT');
		$this->db->join('m_kode_profesi_group','sys_user_profile.kategori_profesi = m_kode_profesi_group.id','LEFT');
		// if(!empty($this->uri->segment(3))){
		// 	$this->db->like("sys_user.name",$this->uri->segment(3)); 
		// 	$this->db->or_like('sys_user_profile.nip',$this->uri->segment(3));
		//  }
		if(!empty($this->uri->segment(3))){
			
			 // $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip, ' ', sys_grup_user.grup) ilike",$param2);
			 // $this->db->like("sys_user.name",$param);  
			//$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			 
		 }
		// if(!empty($this->uri->segment(5))){
			
		//	$this->db->where("riwayat_kedinasan.bagian",$this->uri->segment(5));  
		   //$this->db->or_like('sys_grup_user.grup',$this->uri->segment(3));
			
		//}
		$this->db->where('sys_user.status','1');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		$this->db->order_by('sys_user.name','ACS');

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
								   'pangkat'=>$d->pangkat,
								   'golongan'=>$d->gol_romawi,
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
	
	
	public function listpensiun_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		 
		
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('m_kode_keluar','m_kode_keluar.kd_keluar = sys_user.kd_keluar','LEFT');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		
		$this->db->where('sys_user.status','0');
		$param = urldecode($this->uri->segment(3));
		$param2 = "%".$param."%";
		if(!empty($this->uri->segment(3))){
			// $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik)",$this->uri->segment(3)); 
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike",$param2); 
		}
		$total_rows = $this->db->count_all_results('sys_user');
		$pagination = create_pagination_endless('/user/list/0/', $total_rows,20,4);
				
		$this->db->select('sys_user.*,
		sys_grup_user.grup,m_index_jabatan_asn_detail.ds_jabatan as nama,sys_user_profile.nip,sys_user_profile.nik,
		his_pegawai_resign.tgl_keluar,his_pegawai_resign.no_sk,his_pegawai_resign.alasan,
		m_kode_keluar.ds_keluar as karena,his_pegawai_resign.no_sk
		');
		$this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
		$this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
		$this->db->join('his_pegawai_resign','his_pegawai_resign.id_user = sys_user.id_user');
		//$this->db->join('dm_term','his_pegawai_resign.id_alasan = dm_term.id');
		$this->db->join('m_kode_keluar','m_kode_keluar.kd_keluar = sys_user.kd_keluar','LEFT');
	
		
		
		if(!empty($this->uri->segment(3))){
			// $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik)",$this->uri->segment(3)); 
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike",$param2); 
		 }
		$this->db->where('sys_user.status','0');
		$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
		
		  $res = $this->db->get('sys_user')->result();
		  foreach($res as $d){
			$arr['result'][]=array('nama'=>$d->name,
								   'tgl_keluar'=>$d->tgl_keluar,
								   'alasan'=>$d->karena,
								   'keterangan'=>$d->alasan,
								   'no_sk'=>$d->no_sk,
								   'email'=>$d->email,
								   'nama_group'=>$d->grup,
								   'nip'=>$d->nip,
								   'nik'=>$d->nik,
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
				$username	= ($this->input->post('username'))?$this->input->post('username'):null;
				$name		= ($this->input->post('name'))?$this->input->post('name'):null;
				$email		= ($this->input->post('email'))?$this->input->post('email'):null;
				$id_aplikasi	= 1;
				$id_group	= ($this->input->post('id_group'))?$this->input->post('id_group'):null;
				$status		= ($this->input->post('status'))?$this->input->post('status'):null;
				$user_id_klinik	= ($decodedToken->data->_pnc_kode_klinik)?$decodedToken->data->_pnc_kode_klinik:null;
				$author		= ($decodedToken->data->_pnc_username)?$decodedToken->data->_pnc_username:null;
					
				$salt = round(rand()*1000);
				
				$password	= md5($this->input->post('pass'));
				
				$this->db->where('username',$username);
				$cek = $this->db->get('sys_user')->row();
				if(empty($cek)){
				$param=array( 
					"username"=>$username
					,"name"=>$name
					,"email"=>$email
					,"id_aplikasi"=>$id_aplikasi
					,"id_grup"=>$id_group
					,"author"=>$author
					,"salt"=>$salt
					,"status"=>$status
					,"created"=>date('Y-m-d H:i:s')
					,"password"=>$password
					,"kode_klinik"=>$user_id_klinik
					,'id_uk' => $this->input->post('f_uk')
					);
				
				
				 $this->db->insert('sys_user',$param);
				
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
					$arr['message']='Data Gagal Ditambah! username sudah pernah digunakan';
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
				$username	= ($this->input->post('username'))?$this->input->post('username'):null;
				$username_asli	= ($this->input->post('f_user_edit'))?$this->input->post('f_user_edit'):null;
				$id	= ($this->input->post('f_id_edit'))?$this->input->post('f_id_edit'):null;
				$name		= ($this->input->post('name'))?$this->input->post('name'):null;
				$email		= ($this->input->post('email'))?$this->input->post('email'):null;
				$id_aplikasi	= 1;
				$id_group	= ($this->input->post('id_group'))?$this->input->post('id_group'):null;
				$status		= ($this->input->post('status'))?$this->input->post('status'):null;
				$user_id_klinik	= ($decodedToken->data->_pnc_kode_klinik)?$decodedToken->data->_pnc_kode_klinik:null;
				$author		= ($decodedToken->data->_pnc_username)?$decodedToken->data->_pnc_username:null;
					
				$salt = round(rand()*1000);
				if(!empty($this->input->post('pass'))){
					$password	= md5($this->input->post('pass'));
					$param['password'] = $password;
				}
				
				if($username != $username_asli){
					
				
				$this->db->where('username',$username);
				$cek = $this->db->get('sys_user')->row();
				}else{
					$cek='';
				}
				if(empty($cek)){
				$param=array( 
					"username"=>$username
					,"name"=>$name
					,"email"=>$email
					,"id_aplikasi"=>$id_aplikasi
					,"id_grup"=>$id_group
					,"author"=>$author
					,"salt"=>$salt
					,"status"=>$status
					,"created"=>date('Y-m-d H:i:s') 
					,"kode_klinik"=>$user_id_klinik,
					'id_uk' => ($this->input->post('f_uk'))?$this->input->post('f_uk'):null
					);
				
				 $this->db->where('id_user',$id);
				 $this->db->update('sys_user',$param);
				
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
					$arr['message']='Data Gagal Ditambah! username sudah pernah digunakan';
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
				 $this->db->where('id_user',$id);
				 $this->db->update('sys_user',array('status'=>'0'));
				  
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
				  $arr[]=array('id_uk'=>$d->id_uk,'id'=>$d->id_user,'nama'=>$d->name,'username'=>$d->username,'email'=>$d->email,'id_group'=>$d->id_grup,'status'=> $d->status);
				}
				 
				$this->set_response($arr, REST_Controller::HTTP_OK);
		 
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	  
	}
}
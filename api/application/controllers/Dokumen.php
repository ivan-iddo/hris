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

class Dokumen extends REST_Controller
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
	
	
	public function list_entry_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		  $this->db->select('dokumen_entry.*,uk_master.nama as nama_uk');
		  $this->db->join('uk_master','uk_master.id = dokumen_entry.id_uk','LEFT');
		  $this->db->where('dokumen_entry.id_dok_tipe',$_GET['id_tipe']);
		  $this->db->where('dokumen_entry.id_dok_master',$_GET['id_master']);
		  $this->db->where('dokumen_entry.tampilkan','1');
		  
		  
		 // print_r($decodedToken->data);
		  
		  if($decodedToken->data->_pnc_id_grup <> '1'){
			//$this->db->where('dokumen_entry.id_uk',$decodedToken->data->id_uk);
			$this->db->join('sys_user','sys_user.id_user = dokumen_entry.author');
			$this->db->where('sys_user.id_grup',$decodedToken->data->_pnc_id_grup);
		  }
		 //  $this->db->order_by('dokumen_entry.tanggal_pembuatan','ASC');
		 // $this->db->where('dokumen_entry.user_group',$decodedToken->data->_pnc_id_grup);
		  $res = $this->db->get('dokumen_entry')->result();
		  if(!empty($res)){
		  foreach($res as $d){
			$arr[]=array('id'=>$d->id,
						 'nama'=>$d->judul,
						 'no_dok'=>$d->no_dok,
						 'tgl'=>date_format(date_create($d->tanggal_pembuatan),'d-m-Y'),
						 'uk' => $d->nama_uk
						 );
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
	
	
	public function list_entry_dok_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				//$this->db->limit('100');
				//$this->db->order_by();
		  $this->db->select('dokumen_entry.*,uk_master.nama as nama_uk');
		  $this->db->join('uk_master','uk_master.id = dokumen_entry.id_uk','LEFT');
		 // $this->db->or_where('dokumen_entry.no_dok',$_POST['keyword']);
		  $this->db->or_like('dokumen_entry.no_dok',$_POST['keyword']);
		  $this->db->or_like('dokumen_entry.judul',$_POST['keyword']);
		  $this->db->or_like('uk_master.nama',$_POST['keyword']);
		  $this->db->order_by('dokumen_entry.tanggal_pembuatan','DESC');
		  $this->db->where('dokumen_entry.tampilkan','1');
		  
		  
		 // print_r($decodedToken->data);
		  
		  if($decodedToken->data->_pnc_id_grup <> '1'){
			//$this->db->where('dokumen_entry.id_uk',$decodedToken->data->id_uk);
			$this->db->join('sys_user','sys_user.id_user = dokumen_entry.author');
			$this->db->where('sys_user.id_grup',$decodedToken->data->_pnc_id_grup);
		  }
		   
		 // $this->db->where('dokumen_entry.user_group',$decodedToken->data->_pnc_id_grup);
		  $res = $this->db->get('dokumen_entry')->result();
		  if(!empty($res)){
		  foreach($res as $d){
			$arr[]=array('id'=>$d->id,
						 'nama'=>$d->judul,
						 'no_dok'=>$d->no_dok,
						 'tgl'=>date_format(date_create($d->tanggal_pembuatan),'d-m-Y'),
						 'uk' => $d->nama_uk
						 );
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
	
	
	
	
	
	 
	
	public function getgroup_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				if(!empty($id)){
					 $this->db->where('a.id',$this->input->get('id'));
				}
				  $this->db->select('b.nama as namaitem,a.nama as name,b.deskripsi as desk,b.id as ID');
				 // $this->db->order_by('a.nama','ASC');
				 // $this->db->where('child','0');
				  $this->db->where('a.tampilkan','1');
				  $this->db->join('dok_master b','a.id = b.child','LEFT');
				  $this->db->where('b.tampilkan','1');
				  $res = $this->db->get('dok_master a')->result();
				  
			if(!empty($res)){
				 foreach($res as $d){
					$arr[]=array('nama'=>$d->namaitem,'id'=>$d->ID,'deskripsi'=>$d->desk,'nama_group'=>$d->name);
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
							   'nama'=>$group_group,'deskripsi'=>$group_ket);
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
				 
				 $data = array('nama'=>$group_group,'deskripsi'=>$group_ket);
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
	
	public function menu_get(){
	 $this->load->model('system_auth_model');
	 $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
               
				//$json = json_encode($decodedToken);
				$this->db->where('tampilkan','1');
				$menu = $this->db->get('dok_master')->result();
				
				  $arrs = array();
				  
				 $nom=0;
				foreach($menu as $rs) {
					$arr=array();
						//parent
						//$arr[]=array('modul'=>$rs->modul);
						
						//echo "<item id=\"modul".$rs->id_modul."\" text=\"".ucwords($rs->modul)."\">";
						 
						$this->db->where('dok_sys.tampilkan','1');
						$this->db->join('dok_tipe','dok_tipe.id=dok_sys.id_dok_tipe');
						$this->db->where('dok_sys.id_dok_master',$rs->id);
						$tree_menu = $this->db->get('dok_sys')->result();
						
						//$tree_menu=$this->system_auth_model->tree("menu",$decodedToken->data->_pnc_id_aplikasi,$decodedToken->data->_pnc_id_grup,$rs->id_modul);
						if(!empty($tree_menu)){
							
							$no=0;
							//$arr = array();
						foreach($tree_menu as $rs2) {
							//Child
							$arr[]=array('nama_menu'=>$rs2->nama,'id_dok_master'=>$rs2->id_dok_master,'id_tipe'=>$rs2->id_dok_tipe,'id_modul'=>$rs->id);
							++$no;
							//echo "<item id=\"".$rs2->controller."\" text=\"".ucwords($rs2->menu)."\"/>";
						}
						$arrs[]=array('nama'=>$rs->nama,'data'=>$arr);
						}
						
							++$nom;
						// $arrs['status']='success';
		    }
			$this->set_response($arrs, REST_Controller::HTTP_OK);
			
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		}

		public function getuk_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
			$arr=array();
            if ($decodedToken != false) {
				$this->db->select('uk_master.nama,uk_master.id as id_uk');
				 $this->db->order_by('uk_master.nama','ASC');
				 $this->db->join('uk_master','uk_master.id = uk_sys.id_uk_master');
				 $this->db->where('uk_sys.id_dok_tipe',$this->input->get('id'));
				 $res = $this->db->get('uk_sys')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id_uk);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function gettaksonomi_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) { 
				 $this->db->where('child',$this->input->get('id'));
				 $this->db->where('tampilkan','1');
				 $this->db->order_by('id_urut','ASC');
				 $res = $this->db->get('dm_term')->result();
		  foreach($res as $d){
			$arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function getlokasi_arsip_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				if(!empty($this->input->get('id')))
{				 $this->db->where('id',$this->input->get('id'));
					$this->db->where('tampilkan','1');
					$this->db->order_by('nama','ASC');
					$res = $this->db->get('dok_lokasi')->row();
					$arr['result']=array('nama'=>$res->nama,
										 'alamat'=>$res->alamat,
										 'lantai'=>$res->lantai,
										 'ruang'=>$res->ruang,
										 'no_rak'=>$res->no_rak,
										 'no_box'=>$res->no_box,
										 'id'=>$res->id);
				}else{
					$this->db->where('tampilkan','1');
					$this->db->order_by('nama','ASC');
					$res = $this->db->get('dok_lokasi')->result();
					foreach($res as $d){
					  $arr['result'][]=array('label'=>$d->nama,'value'=>$d->id);
					}
				}
				 
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	public function save_entry_post(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$nodoc = $this->input->post('nodoc');
				$titledoc = $this->input->post('titledoc');
				$created_date = $this->input->post('created_date').' '.date('H:i:s');
				$jra_date = $this->input->post('jra_date').' '.date('H:i:s');
				$cover = $this->input->post('cover-fl');
				$media_type = $this->input->post('media_type');
				$kategori_dokumen = $this->input->post('kategori_dokumen');
				$format_dok = $this->input->post('format_dok');
				$status_dok = $this->input->post('status_dok');
				$select_uk = $this->input->post('select_uk');
				$area_akses = $this->input->post('area_akses');
				$deskripsi = $this->input->post('deskripsi');
				$kunci = $this->input->post('kunci');
				$lokasiarsip = $this->input->post('lokasiarsip');
				$id_dok_master = $this->input->post('id_master');
				$id_dok_tipe = $this->input->post('id_tipe');
				//$this->response($_FILES);
				$config['upload_path'] = 'upload/';
				$config['allowed_types'] = 'gif|jpg|png|jpeg';
				$config['max_size'] = '50000000';
				$this->load->library('upload', $config);
				
		if (!$this->upload->do_upload('file'))
                {
                          $error = array('error' => $this->upload->display_errors());
						  
						
                }
                else
                {
                          $data = array('upload_data' => $this->upload->data());
						  $filename = $data['upload_data']['file_name'];
                }
				
				
				$datas = array('no_dok' =>$nodoc,
                        'judul' =>$titledoc ,
                        'tanggal_pembuatan' =>$created_date,
                        'JRA' =>$jra_date,
                        'cover_photo' =>$cover ,
                        'tipe_media' =>$media_type ,
                        'kategori_dokumen' =>$kategori_dokumen ,
                        'format' =>$format_dok ,
                        'status' =>$status_dok,
                        'id_uk' =>$select_uk ,
                        'id_area_akses' =>$area_akses ,
                        'deskripsi' =>$deskripsi,
                        'keyword' =>$kunci,
						'id_lokasi' => $lokasiarsip,
						'id_dok_master' => $id_dok_master,
						'id_dok_tipe' => $id_dok_tipe
					  );
		 $this->db->insert('dokumen_entry', $datas);
         $insert_id = $this->db->insert_id();
				
				
				 if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
					$arr['id_data']=$insert_id;
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
	
	
	public function getdok_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
				  $this->db->select("count(*) as jml,id_dok_master");
				  $this->db->group_by('id_dok_master');
				  $this->db->where('tampilkan','1');
				  $res = $this->db->get('dokumen_entry')->result();
				  
			if(!empty($res)){
				 foreach($res as $d){
					$arr[]=array('id'=>$d->id_dok_master,'jumlah'=>$d->jml);
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
	
	public function getfile_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 
				  $this->db->select("count(*) as jml"); 
				  $this->db->where('tampilkan','1');
				  $res = $this->db->get('dokumen_entry_file')->result();
				  
			if(!empty($res)){
				 foreach($res as $d){
					$arr['jumlah']=$d->jml;
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
	
}
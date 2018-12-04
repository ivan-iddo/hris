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

class Developer extends REST_Controller
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
	
	 
	
	public function getgroup_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id = $this->input->get('id');
				if(!empty($id)){
					 $this->db->where('id_modul',$this->input->get('id'));
				}
				   
				  $res = $this->db->get('sys_mst_menu')->result();
				  
			if(!empty($res)){
				 foreach($res as $dat){
					$arr[]=array('id'=> $dat->id_menu,
                    'menu'=> $dat->menu,
                    'url'=> $dat->url,
                    'id_aplikasi'=> $dat->id_aplikasi,
                    'id_modul'=> $dat->id_modul,
                    'urutan'=> $dat->urutan,
                    'front'=> $dat->front,
                    );
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
					 $this->db->where('id_modul',$this->input->get('id'));
				}
				
				 
				  
				  $this->db->where('aktif','1');
				  $res = $this->db->get('sys_mst_modul')->result();
				  
			if(!empty($res)){
				 foreach($res as $dat){
					$arr[]=array('id'=> $dat->id_modul,
                                'id_aplikasi'=> $dat->id_aplikasi,
                                'modul'=> $dat->modul,
                                'controller'=> $dat->controller,
                                'urutan'=> $dat->urutan,
                                'aktif'=> $dat->aktif,
                                'icon'=> $dat->icon,
                            );
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
					 $this->db->where('id_menu',$this->input->get('id'));
				}
				
				 
				   
				  $res = $this->db->get('sys_mst_menu')->result();
				  
			if(!empty($res)){
				 foreach($res as $dat){
					$arr[]=array('id'=> $dat->id_menu,
					'nama'=> $dat->menu,
					'deskripsi'=> $dat->url,
					'id_aplikasi'=> $dat->id_aplikasi,
					'id_modul'=> $dat->id_modul,
					'urutan'=> $dat->urutan,
					'front'=> $dat->front,
				 );
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
		$this->load->model('System_auth_model','m');

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $group_group    = $_POST['group_group'];
				 $group_ket      = $_POST['group_ket'];
                 $id_group = $_POST['id_parent'];
                 $urutan    = $_POST['urutan'];
				 $aktif      = $_POST['aktif'];
				 
				$dir = str_replace('api\application\\','',APPPATH);// $source = str_replace('codeigniter','cms',BASEPATH).'modules/formgenerator/source/mastermodule';
				
				$viewdata = explode('/',$this->input->post('group_ket'));
				$targetview_folder = $viewdata[0];
				$targetview_file = $viewdata[1].'.php';
				
				$targetview = $dir.'view/'.$targetview_folder;

				$viewdataapi = explode('/',$this->input->post('api'));
				$targetview_folderapi = $viewdataapi[0];
				$targetview_fileapi = ucfirst($viewdataapi[1]).'.php';
				$targetapi = $dir.'api/application/controllers/'.$targetview_folderapi;

				$source_view = $dir.'master/view';
				$source_api = $dir.'master/controller';

				$fields = $this->db->field_data($this->input->post('db'));
				//view
				$this->m->full_copy( $source_view, $targetview ); 
				$namabaruindex = $targetview_file;
				$namabaruform = 'form_'.$this->input->post('db').'.php';
				rename($targetview.'/contoh1.php',$targetview.'/'.$namabaruindex);
				rename($targetview.'/form_contoh1.php',$targetview.'/'.$namabaruform);


				$resheader =' [';
				foreach ($fields as $field)
				{
				   $resheader .=  '{headerName: "'.str_replace('_',' ',$field->name).'", field: "'.$field->name.'", width: 190, filterParams:{newRowsAction: "keep"}},'; 
				}
		
				$resheader .='];';
 
				$this->m->replace_string_in_file($targetview.'/'.$namabaruindex, 
				array('GANTIVIEW','GANTIAPI','contoh1','GANTI_HEADER','GANTI_ID'), 
				array('view/'.$targetview_folderapi.'/',
				$this->input->post('api').'/',
				$this->input->post('db'),
				$resheader,
				$fields[0]->name
			));

			$forinput ='';
			$hit=0;
					foreach ($fields as $field)
					{
						if($hit=='0'){
							$forinput .= '<input type="text" style="display:none" name="'.$field->name.'" id="'.$field->name.'" class="form-control"/>';
						}else{

					 
					$forinput .=  '<div class="row mar-all"> 
					<div class="form-group">
					<label class="col-sm-2 control-label" for="inputstatus">'.str_replace('_',' ',$field->name).'</label>
							<div class="col-sm-7">
							<input type="text" name="'.$field->name.'" id="'.$field->name.'" class="form-control"/>
							</div>
							
					</div> 
					</div>'; 
						}
						++$hit;
					}

					$isidata ='';
					foreach ($fields as $field)
					{
					$isidata .=  "$('#".$field->name."').val(result.result[0].".$field->name.");"; 
					}

					
				$this->m->replace_string_in_file($targetview.'/'.$namabaruform, 
				array('GANTI_FORM','GANTI_ID','GANTI_NAMA','contoh1','ISI_DATA'), 
				array($forinput,
				$fields[0]->name,
				$fields[1]->name,
				$this->input->post('db'),
				$isidata
				));
							

				//controller
				$this->m->full_copy( $source_api, $targetapi ); 
				$namabaruindexcontroller = $targetview_fileapi; 
				rename($targetapi.'/Contoh1.php',$targetapi.'/'.$namabaruindexcontroller); 

				
						$arrlist = 'array(';
						foreach ($fields as $field)
						{
							$arrlist .="'".$field->name."'=> \$dat->".$field->name.","; 
						}
						
						$arrlist .= ');';

						$arrsave = 'array(';
						$n=0;
						foreach ($fields as $field)
						{
							if($n<>'0'){
							$arrsave .="'".$field->name."'=> \$this->input->post('".$field->name."'),";
							}
							++$n; 
						}
						
						$arrsave .= ');';

 
				$this->m->replace_string_in_file($targetapi.'/'.$namabaruindexcontroller, 
				array('contoh1','Contoh1','GANTIDB','GANTIARRAYLIST','GANTI_ID','GANTI_NAMA','GANTI_ARRAY_SAVE'), 
				array($targetview_folderapi,
				str_replace('.php','',$targetview_fileapi),
				$this->input->post('db'),
				$arrlist,
				$fields[0]->name,
				$fields[1]->name,$arrsave
			));
 
				 if(!empty($id_group)){
						 $data=array( 
						 'menu'=> $this->input->post('group_group'),
						 'url'=>$group_ket,
						 'id_aplikasi'=> '1',
						 'id_modul'=> $this->input->post('id_parent'),
						 'urutan'=> $this->input->post('urutan'),
						 'front'=> '1',
				 		);
						 $this->db->insert('sys_mst_menu',$data);
					}else{
                        $data = array('modul'=>$group_group,'controller'=>$group_ket,'urutan'=>$urutan,'aktif'=>$aktif);
				
						 $this->db->insert('sys_mst_modul',$data);
					}
					//print_r($data);
				
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
                 $urutan    = $_POST['urutan'];
				 $aktif      = $_POST['aktif'];
				 
				 $data = array('modul'=>$group_group,'controller'=>$group_ket,'urutan'=>$urutan,'aktif'=>$aktif);
				 $this->db->where('id_modul', $this->input->post('id_group'));
				 $this->db->update('sys_mst_modul',$data);
				 
				 
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
				 
				 $data=array( 
					'menu'=> $this->input->post('group_group'),
					'url'=>$group_ket,
					'id_aplikasi'=> '1',
					'id_modul'=> $this->input->post('id_parent'),
					'urutan'=> $this->input->post('urutan'),
					'front'=> '1',
			);
				 $this->db->where('id_menu', $this->input->post('id_group'));
				 $this->db->update('sys_mst_menu',$data);
				 
				 
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
				 $this->db->where('id_modul',$id);
				 $this->db->update('sys_mst_modul',array('aktif'=>'0'));
				  
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
				 $this->db->where('id_menu',$id);
				 $this->db->delete('sys_mst_menu');
				  
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
}
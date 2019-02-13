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

class Warning extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	 var $table='sys_user';
	 var $perpage = 20;
 
	public function list_warning_get(){
        $headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                
        $this->db->select('sys_user.*,sys_grup_user.grup,sys_user_profile.nip,his_kontrak.tglktr');
        $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
        $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
        $this->db->join('his_kontrak', 'sys_user.id_user = his_kontrak.id_user', 'LEFT');

        $param = urldecode($this->uri->segment(4));
        if(!empty($this->uri->segment(4))){
            
             $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
             
         }

        $this->db->where('sys_user.status','1');
        $this->db->where('his_kontrak.statue','1');
        $this->db->order_by('his_kontrak.tglktr','ACS');
        // $this->db->limit('1');
          $res = $this->db->get('sys_user')->result();
          foreach($res as $d){
            $tanggalKontrak = $d->tglktr;
            if ($tanggalKontrak != '') {
                $tanggal = strtotime($d->tglktr);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                if ($sisa <= 180) {
                    $dayKontrak = 'Sisa Kontrak '. $sisa . ' hari';
                    $arr['result'][]=array(
                                   'id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                   'tgl_kontrak' => $dayKontrak,
                                   );
                }

            } else {
                $dayKontrak = $tanggalKontrak;
            }

          }
         	$arr['total']=$total_rows;
            $this->set_response($arr, REST_Controller::HTTP_OK);
            
                return;
            }
        }
        
         $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function list_warning_str_get(){
        $headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                
        $this->db->select('sys_user.*,sys_grup_user.grup,sys_user_profile.nip,his_str.date_end as date_end_str');
        $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
        $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
        $this->db->join('his_str', 'sys_user.id_user = his_str.id_user', 'LEFT');

        $param = urldecode($this->uri->segment(4));
        if(!empty($this->uri->segment(4))){
            
             $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
             
         }
         
        $this->db->where('sys_user.status','1');
        $this->db->where('his_str.statue','1');
        $this->db->order_by('his_str.date_end','ACS');
        // $this->db->limit('1');
          $res = $this->db->get('sys_user')->result();
          foreach($res as $d){
            
            $tanggalSTR = $d->date_end_str;
            if ($tanggalSTR != '') {
                $tanggal = strtotime($d->date_end_str);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                if ($sisa <= 180) {
                    $daySTR = 'Sisa STR '. $sisa . ' hari';
                    $arr['result'][]=array('id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                   'tgl_str' => $daySTR,
                                   );
                }
            } else {
                $daySTR = $tanggalSTR;
            }

            
          }
         	$arr['total']=$total_rows;
          $this->set_response($arr, REST_Controller::HTTP_OK);
            
                return;
            }
        }
        
         $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function list_warning_sip_get(){
        $headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                
        $this->db->select('sys_user.*,sys_grup_user.grup,sys_user_profile.nip,his_sip.date_end');
        $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
        $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
        $this->db->join('his_sip', 'sys_user.id_user = his_sip.id_user', 'LEFT');

        $param = urldecode($this->uri->segment(4));
        if(!empty($this->uri->segment(4))){
            
             $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.nip)",$param);
             
         }
         
        $this->db->where('sys_user.status','1');
        $this->db->where('his_sip.statue','1');
        $this->db->order_by('his_sip.date_end','ASC');
  //       $this->db->limit('1');
          $res = $this->db->get('sys_user')->result();
          foreach($res as $d){

            $tanggalSIP = $d->date_end;
            if ($tanggalSIP != '') {
                $tanggal = strtotime($d->date_end);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                if ($sisa <= 180) {
                    $daySIP = 'Sisa SIP '. $sisa . ' hari';
                    $arr['result'][]=array('id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                    'tgl_sip' => $daySIP,
                                   );
                }
            } else {
                $daySIP = $tanggalSIP;
            }

          }
         
          $arr['paging'] = $pagination['limit'][1];
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

				if(!empty($this->input->get('id'))){
					$this->db->where('id_user',$this->input->get('id'));
				}

				if(!empty($this->uri->segment(4))){
					$this->db->like("username",$this->uri->segment(4)); 
				 }
				$total_rows = $this->db->count_all_results($this->table);
				$pagination = create_pagination_endless('/warning_pegawai//0/', $total_rows,$this->perpage,5);
				  
				if(!empty($this->input->get('id'))){
					$this->db->where('id_user',$this->input->get('id'));
				}
				if(!empty($this->uri->segment(4))){
					$this->db->like("username",$this->uri->segment(4)); 
				 }
				  $this->db->where('tampilkan','1');
				  $this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
				  $res = $this->db->get($this->table)->result();
				  
			if(!empty($res)){
				 foreach($res as $dat){
					$arr['result'][]= array('id_user'=> $dat->id_user,'username'=> $dat->username,'password'=> $dat->password,'salt'=> $dat->salt,'name'=> $dat->name,'email'=> $dat->email,'id_aplikasi'=> $dat->id_aplikasi,'kode_klinik'=> $dat->kode_klinik,'id_grup'=> $dat->id_grup,'last_login'=> $dat->last_login,'status'=> $dat->status,'created'=> $dat->created,'modified'=> $dat->modified,'author'=> $dat->author,'id_uk'=> $dat->id_uk,'foto'=> $dat->foto,'id_uk_group'=> $dat->id_uk_group,'kd_keluar'=> $dat->kd_keluar,'id_shift'=> $dat->id_shift,);
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

				if(!empty($this->input->post('id_warning_pegawai'))){
					//edit
					$id= $this->input->post('id_warning_pegawai');
					$arr=array('username'=> $this->input->post('username'),'password'=> $this->input->post('password'),'salt'=> $this->input->post('salt'),'name'=> $this->input->post('name'),'email'=> $this->input->post('email'),'id_aplikasi'=> $this->input->post('id_aplikasi'),'kode_klinik'=> $this->input->post('kode_klinik'),'id_grup'=> $this->input->post('id_grup'),'last_login'=> $this->input->post('last_login'),'status'=> $this->input->post('status'),'created'=> $this->input->post('created'),'modified'=> $this->input->post('modified'),'author'=> $this->input->post('author'),'id_uk'=> $this->input->post('id_uk'),'foto'=> $this->input->post('foto'),'id_uk_group'=> $this->input->post('id_uk_group'),'kd_keluar'=> $this->input->post('kd_keluar'),'id_shift'=> $this->input->post('id_shift'),);;//array('nama'=>$this->input->post('nama'));
					$this->db->where('id_user',$id);
					$this->db->update($this->table,$arr);
				}else{
					//save
					$arr=array('username'=> $this->input->post('username'),'password'=> $this->input->post('password'),'salt'=> $this->input->post('salt'),'name'=> $this->input->post('name'),'email'=> $this->input->post('email'),'id_aplikasi'=> $this->input->post('id_aplikasi'),'kode_klinik'=> $this->input->post('kode_klinik'),'id_grup'=> $this->input->post('id_grup'),'last_login'=> $this->input->post('last_login'),'status'=> $this->input->post('status'),'created'=> $this->input->post('created'),'modified'=> $this->input->post('modified'),'author'=> $this->input->post('author'),'id_uk'=> $this->input->post('id_uk'),'foto'=> $this->input->post('foto'),'id_uk_group'=> $this->input->post('id_uk_group'),'kd_keluar'=> $this->input->post('kd_keluar'),'id_shift'=> $this->input->post('id_shift'),);;//array('username'=>$this->input->post('nama'));
					 
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
					$this->db->where('id_user',$id);
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
					$this->db->where('id_user',$this->uri->segment('4'));
				 }
					 $this->db->order_by('username','ASC');
					 
			  $res = $this->db->get($this->table)->result();

			  if(!empty($res)){

			  foreach($res as $d){
				$arr['result'][]=array('label'=>$d->username,'value'=>$d->id_user);
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
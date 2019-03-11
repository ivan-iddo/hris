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
 
	public function list_warning_kontrak_get(){
        $headers = $this->input->request_headers(); 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
        $sampai = $this->input->get('sampai');
        $dari = $this->input->get('dari');
        $direktorat = $this->uri->segment(4);
        $this->db->select('sys_user.*,sys_grup_user.id_grup,sys_grup_user.grup,sys_user_profile.nip,sub_kontrak.tglakhir');
        $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
        $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
        $this->db->join('(SELECT id_user, max(tglakhir) as tglakhir FROM his_kontrak WHERE statue = 1 GROUP BY id_user) AS sub_kontrak', 'sys_user.id_user = sub_kontrak.id_user', 'INNER');

        if(!empty($dari)){
            $this->db->where('sub_kontrak.tglakhir >=', $dari);
         }
         if(!empty($sampai)){
            $this->db->where('sub_kontrak.tglakhir <=', $sampai);
         }
         if(!empty($direktorat) && $direktorat != "null"){
            $this->db->where("sys_grup_user.id_grup",$direktorat);
         }

        // $param = "%".urldecode($this->uri->segment(4))."%";
        // if(!empty($this->uri->segment(4))){
        //      $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param);
        //  }

        $this->db->where('sys_user.status','1');
          $res = $this->db->get('sys_user')->result();
          $arr['result']=array();
          foreach($res as $d){
            $tanggalKontrak = $d->tglakhir;
            if ($tanggalKontrak != '') {
                $tanggalN = date('d M Y',strtotime($tanggalKontrak));
                $tanggal = strtotime($tanggalKontrak);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                if ($sisa <= 180 && $sisa > 0) {
                    $dayKontrak = 'Sisa Kontrak tinggal '. $sisa . ' hari lagi';
                    $arr['result'][]=array(
                                   'id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                   'tgl_kontrak' => $dayKontrak,
                                   );
                
                }
                if ($sisa <= 0 && $sisa >= -14) {
                    $dayKontrak = 'Kontrak Telah Berakhir Tanggal '. $tanggalN;
                    $dayKontrak = 'Sisa Kontrak tinggal '. $sisa . ' hari lagi';
                    $arr['result'][]=array(
                                   'id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                   'tgl_kontrak' => $dayKontrak,
                                   );
               
                }
                
            } 

          }
         	
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
        $sampai = $this->input->get('sampai');
        $dari = $this->input->get('dari');
        $direktorat = $this->uri->segment(4);
        $this->db->select('sys_user.*,sys_grup_user.id_grup,sys_grup_user.grup,sys_user_profile.nip, sub_str.date_end as date_end_str');
        $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
        $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
        $this->db->join('(SELECT id_user, max(date_end) as date_end FROM his_str WHERE statue = 1 GROUP BY id_user) AS sub_str', 'sys_user.id_user = sub_str.id_user', 'INNER');

        if(!empty($dari)){
            $this->db->where('sub_str.date_end >=', $dari);
         }
         if(!empty($sampai)){
            $this->db->where('sub_str.date_end <=', $sampai);
         }
         if(!empty($direktorat) && $direktorat != "null"){
            $this->db->where("sys_grup_user.id_grup",$direktorat);
         }

        // $param = "%".urldecode($this->uri->segment(4))."%";
        // if(!empty($this->uri->segment(4))){
        //      $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param);
        //  }
         
        $this->db->where('sys_user.status','1');
          $res = $this->db->get('sys_user')->result();
          // print_r($res);die();
          $arr['result']=array();
          foreach($res as $d){
            
            $tanggalSTR = $d->date_end_str;
            if ($tanggalSTR != '') {
                $tanggalN = date('d M Y',strtotime($tanggalSTR));
                $tanggal = strtotime($tanggalSTR);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                if ($sisa <= 180 && $sisa > 0) {
                    $daySTR = 'Sisa STR tinggal '. $sisa . ' hari lagi';
                    $arr['result'][]=array('id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                   'tgl_str' => $daySTR,
                                   );
                
                }
                if ($sisa <= 0 && $sisa >= -14) {
                    $daySTR = 'STR Telah Berakhir Tanggal '. $tanggalN;
                    $arr['result'][]=array('id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                   'tgl_str' => $daySTR,
                                   );
                }
                
            } 
            
          }
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
        $sampai = $this->input->get('sampai');
        $dari = $this->input->get('dari');
        $direktorat = $this->uri->segment(4);      
        $this->db->select('sys_user.*,sys_grup_user.id_grup,sys_grup_user.grup,sys_user_profile.nip, sub_sip.date_end');
        $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
        $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
        $this->db->join('his_sip', 'sys_user.id_user = his_sip.id_user', 'LEFT');
        $this->db->join('(SELECT id_user, max(date_end) as date_end FROM his_sip WHERE statue = 1 GROUP BY id_user) AS sub_sip', 'sys_user.id_user = sub_sip.id_user', 'INNER');

        if(!empty($dari)){
            $this->db->where('sub_sip.date_end >=', $dari);
         }
         if(!empty($sampai)){
            $this->db->where('sub_sip.date_end <=', $sampai);
         }
         if(!empty($direktorat) && $direktorat != "null"){
            $this->db->where("sys_grup_user.id_grup",$direktorat);
         }

        // $param = "%".urldecode($this->uri->segment(4))."%";
        // if(!empty($this->uri->segment(4))){
        //      $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param);
        //  }
         
        $this->db->where('sys_user.status','1');
          $res = $this->db->get('sys_user')->result();
          $arr['result']=array();
          foreach($res as $d){

            $tanggalSIP = $d->date_end;
            if ($tanggalSIP != '') {
                $tanggalN = date('d M Y',strtotime($tanggalSIP)); 
                $tanggal = strtotime($tanggalSIP);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                if ($sisa <= 180 && $sisa > 0) {
                    $daySIP = 'Sisa SIP tinggal '. $sisa . ' hari lagi';
                    $arr['result'][]=array('id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                    'tgl_sip' => $daySIP,
                                   );
                
                }
                if ($sisa <= 0 && $sisa >= -14) {
                    $daySIP = 'SIP Telah Berakhir Tanggal '. $tanggalN;
                    $arr['result'][]=array('id'=>$d->id_user,
                                   'nama'=>$d->name,
                                   'nama_group'=>$d->grup,
                                   'nip'=>$d->nip,
                                    'tgl_sip' => $daySIP,
                                   );
                
                }
                
            } 

          } 

          $this->set_response($arr, REST_Controller::HTTP_OK);
            
                return;

            }
        }
        
         $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	  
}
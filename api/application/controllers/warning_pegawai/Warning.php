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
      $id_user = $decodedToken->data->id;
      $user_froup = $decodedToken->data->_pnc_id_grup;
      $sampai = $this->input->get('sampai');
      $dari = $this->input->get('dari');
      $direktorat = $this->uri->segment(4);
      $this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
      $this->db->where('id_user',$id_user);
      $uk = $this->db->get('riwayat_kedinasan')->row();
      $dir = $uk->direktorat;
      $bagian = $uk->bagian;
      $sub_bag = $uk->sub_bagian;
      $this->db->select('sys_user.*,sys_grup_user.id_grup,sys_grup_user.grup,sys_user_profile.nip,sub_kontrak.tglakhir');
      $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
      $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
      $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
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

// $param = "%".urldecode($this->uri->segment(4))."%";
// if(!empty($this->uri->segment(4))){
//      $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param);
//  }
	  if(empty($sampai)){
	  $this->db->where('sub_kontrak.tglakhir <=', date('d-m-Y', strtotime("+183 day", strtotime(date('d-m-Y')))));
	  }
      $this->db->where('sys_user.status','1');
      $res = $this->db->get('sys_user')->result();
      $arr['result']=array();
      foreach($res as $d){
        $tanggalKontrak = $d->tglakhir;
		$tanggal = date('d-m-Y');
		$tiga = date('d-m-Y', strtotime("+92 day", strtotime($tanggal)));
		$enam = date('d-m-Y', strtotime("+183 day", strtotime($tanggal)));
		if ($tanggalKontrak != '') {
		   if (strtotime($tanggalKontrak)<=strtotime($enam) && strtotime($tanggalKontrak)>=strtotime($tiga)){
		   $daykontrak = '6 bulan';
		   }else{
		   if (strtotime($tanggalKontrak)<=strtotime($tiga) && strtotime($tanggalKontrak)<=strtotime($tanggal)){
		   $daykontrak = 'habis';
		   }else{
		   $daykontrak = '3 bulan';
		   }
		   }
            $arr['result'][]=array(
              'id'=>$d->id_user,
              'nama'=>$tanggalKontrak,
              'nama_group'=>$d->grup,
              'nip'=>$d->nip,
              'tgl_kontrak' => $daykontrak,
            );

        }else{
		$arr['result'][]=array();
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
      $id_user = $decodedToken->data->id;
      $user_froup = $decodedToken->data->_pnc_id_grup;
      $sampai = $this->input->get('sampai');
      $dari = $this->input->get('dari');
      $direktorat = $this->uri->segment(4);
      $this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
      $this->db->where('id_user',$id_user);
      $uk = $this->db->get('riwayat_kedinasan')->row();
      $dir = $uk->direktorat;
      $bagian = $uk->bagian;
      $sub_bag = $uk->sub_bagian;
      $this->db->select('sys_user.*,sys_grup_user.id_grup,sys_grup_user.grup,sys_user_profile.nip, sub_str.date_end as date_end_str');
      $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
      $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
      $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
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
	  if(empty($sampai)){
	  $this->db->where('sub_str.date_end <=', date('d-m-Y', strtotime("+360 day", strtotime(date('d-m-Y')))));
	  }
      $this->db->where('sys_user.status','1');
      $res = $this->db->get('sys_user')->result();
	  //print_r($res);die();
      $arr['result']=array();
      foreach($res as $d){
		$tanggalSTR = $d->date_end_str;
		$tanggal = date('d-m-Y');
		$tiga = date('d-m-Y', strtotime("+92 day", strtotime($tanggal)));
		$enam = date('d-m-Y', strtotime("+183 day", strtotime($tanggal)));
		$satu = date('d-m-Y', strtotime("+360 day", strtotime($tanggal)));
        if ($tanggalSTR != '') {
		   if (strtotime($tanggalSTR)<=strtotime($satu) && strtotime($tanggalSTR)>=strtotime($enam)){
		   $daySTR = '1 tahun';
		   }else{
		   if (strtotime($tanggalSTR)<=strtotime($enam) && strtotime($tanggalSTR)>=strtotime($tiga)){
		   $daySTR = '6 bulan';
		   }else{
		   if (strtotime($tanggalSTR)<=strtotime($tiga) && strtotime($tanggalSTR)<=strtotime($tanggal)){
		   $daySTR = 'habis';
		   }else{
		   $daySTR = '3 bulan';
		   }
		   }
		   }
            $arr['result'][]=array(
              'id'=>$d->id_user,
              'nama'=>$d->name,
              'nama_group'=>$d->grup,
              'nip'=>$d->nip,
              'tgl_str' => $daySTR,
            );

        }else{
		$arr['result'][]=array();
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
      $id_user = $decodedToken->data->id;
      $user_froup = $decodedToken->data->_pnc_id_grup;
      $sampai = $this->input->get('sampai');
      $dari = $this->input->get('dari');
      $direktorat = $this->uri->segment(4);
      $this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
      $this->db->where('id_user',$id_user);
      $uk = $this->db->get('riwayat_kedinasan')->row();
      $dir = $uk->direktorat;
      $bagian = $uk->bagian;
      $sub_bag = $uk->sub_bagian;
      $this->db->select('sys_user.*,sys_grup_user.id_grup,sys_grup_user.grup,sys_user_profile.nip, sub_sip.date_end');
      $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
      $this->db->join('sys_user_profile','sys_user_profile.id_user = sys_user.id_user','LEFT');
      $this->db->join('his_sip', 'sys_user.id_user = his_sip.id_user', 'LEFT');
      $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
      $this->db->join('(SELECT id_user, max(date_end) as date_end FROM his_sip WHERE statue = 1 GROUP BY id_user) AS sub_sip', 'sys_user.id_user = sub_sip.id_user', 'INNER');

      if($user_froup!=1){
        if(!empty($dari)){
          $this->db->where('sub_sip.date_end >=', $dari);
        }
        if(!empty($sampai)){
          $this->db->where('sub_sip.date_end <=', $sampai);
        }
        if(!empty($direktorat) && $direktorat != "null"){
          $this->db->where("sys_grup_user.id_grup",$direktorat);
        }
      }

// $param = "%".urldecode($this->uri->segment(4))."%";
// if(!empty($this->uri->segment(4))){
//      $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip) ilike",$param);
//  }
      if($sub_bag==0){
        $this->db->where_in('riwayat_kedinasan.bagian', $bagian);
        if($bagian==0){
          $this->db->where_in('riwayat_kedinasan.direktorat', $dir);
        }
      }else{
        $this->db->where_in('riwayat_kedinasan.bagian', $bagian);
        $this->db->where_in('riwayat_kedinasan.sub_bagian', $sub_bag);
      }
	  if(empty($sampai)){
	  $this->db->where('sub_sip.date_end <=', date('d-m-Y', strtotime("+360 day", strtotime(date('d-m-Y')))));
	  }
      $this->db->where('sys_user.status','1');
      $res = $this->db->get('sys_user')->result();
      $arr['result']=array();
      foreach($res as $d){

        $tanggalSIP = $d->date_end;
        $tanggal = date('d-m-Y');
		$tiga = date('d-m-Y', strtotime("+92 day", strtotime($tanggal)));
		$enam = date('d-m-Y', strtotime("+183 day", strtotime($tanggal)));
		$satu = date('d-m-Y', strtotime("+360 day", strtotime($tanggal)));
        if ($tanggalSIP != '') {
		   if (strtotime($tanggalSIP)<=strtotime($satu) && strtotime($tanggalSIP)>=strtotime($enam)){
		   $daySip = '1 tahun';
		   }else{
		   if (strtotime($tanggalSIP)<=strtotime($enam) && strtotime($tanggalSIP)>=strtotime($tiga)){
		   $daySip = '6 bulan';
		   }else{
		   if (strtotime($tanggalSIP)<=strtotime($tiga) && strtotime($tanggalSIP)<=strtotime($tanggal)){
		   $daySip = 'habis';
		   }else{
		   $daySip = '3 bulan';
		   }
		   }
		   }
            $arr['result'][]=array(
              'id'=>$d->id_user,
              'nama'=>$d->name,
              'nama_group'=>$d->grup,
              'nip'=>$d->nip,
              'tgl_sip' => $daySip,
            );

        }else{
		$arr['result'][]=array();
		}
      } 

      $this->set_response($arr, REST_Controller::HTTP_OK);

      return;

    }
  }

  $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


}
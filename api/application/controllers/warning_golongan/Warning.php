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
                
        $this->db->select('his_golongan.*,m_golongan_peg.gol_romawi as nama_p,m_golongan_peg.pangkat,his_golongan.no_sk,sys_user.name');
        $this->db->join('m_golongan_pegawai', 'm_golongan_pegawai.id = his_golongan.golongan_id', 'LEFT');
        $this->db->join('sys_user','sys_user.id_user = his_golongan.id_user');
        $this->db->join('m_golongan_peg', 'm_golongan_peg.id = his_golongan.golongan_id', 'LEFT');
        $this->db->where('his_golongan.tampilkan', '1');

        $param = "%".urldecode($this->uri->segment(4))."%";
        if(!empty($this->uri->segment(4))){
            
             $this->db->where("sys_user.name ilike",$param);
             
         }

        // $this->db->where('sys_user.status','1');
        $this->db->where('his_golongan.tampilkan','1');
        $this->db->order_by('his_golongan.tmt_golongan_akhir','ACS');
        // $this->db->limit('1');
          $res = $this->db->get('his_golongan')->result();
          
          foreach($res as $d){
            $tanggalGolonganAkhir = $d->tmt_golongan_akhir;
            if ($tanggalGolonganAkhir != '') {
                $tanggalN = date('d M Y',strtotime($tanggalGolonganAkhir));
                $tanggal = strtotime($tanggalGolonganAkhir);
                $today = time();
                $diff = $tanggal - $today ;
                $sisa = floor($diff / (60 * 60 * 24));
                $tanggal1 = new DateTime($tanggalGolonganAkhir);
                $today1 = new DateTime('today');
                $y = $today1->diff($tanggal1)->y;
                $m = $today1->diff($tanggal1)->m;
                $day = $today1->diff($tanggal1)->d;
                if ($sisa <= 30) {
                    $dayGolongan = 'Sisa Masa Berlaku Pangkat tinggal '. $sisa . ' hari lagi';
                    $arr['result'][]=array(
                                       'id'=>$d->id_user,
                                       'id_user' => $d->id_user,
                                        'pangkat_id' => $d->nama_p.' / '.$d->pangkat,
                                        'tmt_golongan' => $d->tmt_golongan,
                                        'tmt_golongan_akhir' => $dayGolongan,
                                        'no_sk' => $d->no_sk,
                                        'tgl_sk' => $d->tgl_sk,
                                       'nama'=>$d->name,
                                       );
                    $this->set_response($arr, REST_Controller::HTTP_OK);
                  
                    return;
                }
                if ($sisa <= 180) {
                    $dayGolongan = 'Sisa Masa Berlaku Pangkat tinggal '. $m . ' bulan '. $day . ' hari lagi';
                    $arr['result'][]=array(
                                       'id'=>$d->id_user,
                                       'id_user' => $d->id_user,
                                        'pangkat_id' => $d->nama_p.' / '.$d->pangkat,
                                        'tmt_golongan' => $d->tmt_golongan,
                                        'tmt_golongan_akhir' => $dayGolongan,
                                        'no_sk' => $d->no_sk,
                                        'tgl_sk' => $d->tgl_sk,
                                       'nama'=>$d->name,
                                       );
                    $this->set_response($arr, REST_Controller::HTTP_OK);
                  
                    return;
                }
                if ($sisa <= 0 && $sisa >= -14) {
                    $dayGolongan = 'Masa Berlaku Pangkat Telah Berakhir Tanggal '. $tanggalN;
                    $arr['result'][]=array(
                                       'id'=>$d->id_user,
                                       'id_user' => $d->id_user,
                                        'pangkat_id' => $d->golongan_id,
                                        'tmt_golongan' => $d->tmt_golongan,
                                        'tmt_golongan_akhir' => $dayGolongan,
                                        'no_sk' => $d->no_sk,
                                        'tgl_sk' => $d->tgl_sk,
                                       'nama'=>$d->name,
                                       );
                    $this->set_response($arr, REST_Controller::HTTP_OK);
                  
                    return;
                }
                $arr['result']=array();
                $this->set_response($arr, REST_Controller::HTTP_OK);
            
                return;
            } else {
                $arr['result']=array();
                $this->set_response($arr, REST_Controller::HTTP_OK);
            
                return;
            }

          }
         	$arr['result']=array();
            $this->set_response($arr, REST_Controller::HTTP_OK);
            
                return;
            }
        }
        
         $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	  
}
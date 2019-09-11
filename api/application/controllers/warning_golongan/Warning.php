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
            $this->db->select('his_golongan.id_user, his_golongan.tmt_golongan, his_golongan.no_sk,  his_golongan.tgl_sk, sys_user.name, golongan_id,gol_angka,gol_romawi,pangkat, no_sk, 
                sys_grup_user.id_grup, sys_grup_user.grup,
                max(tmt_golongan_akhir) as max_akhir');
// $this->db->join('m_golongan_pegawai', 'm_golongan_pegawai.id = his_golongan.golongan_id', 'LEFT');
            $this->db->join('sys_user','sys_user.id_user = his_golongan.id_user');
            $this->db->join('sys_grup_user','sys_user.id_grup = sys_grup_user.id_grup');
            $this->db->join('m_golongan_peg', 'm_golongan_peg.id = his_golongan.golongan_id', 'LEFT');
            $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
            $this->db->where('his_golongan.tampilkan', '1');

            if(!empty($dari)){
                $this->db->where('tmt_golongan_akhir >=', $dari);
            }
            if(!empty($sampai)){
                $this->db->where('tmt_golongan_akhir <=', $sampai);
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
// $this->db->where('sys_user.status','1');
            $this->db->where('his_golongan.tampilkan','1');
            $this->db->where('tmt_golongan_akhir is not null');
// $this->db->group_by('his_golongan.id_user');
            $this->db->group_by('his_golongan.id_user, sys_user.name, golongan_id, gol_angka, gol_romawi,
                pangkat, his_golongan.no_sk, sys_grup_user.id_grup, sys_grup_user.grup, his_golongan.tmt_golongan, his_golongan.tgl_sk');
// $this->db->limit('1');
            $res = $this->db->get('his_golongan')->result();
            $arr['result']=array();
            foreach($res as $d){
                $tanggalGolonganAkhir = $d->max_akhir;
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
                    if ($sisa <= 30 && $sisa > 0) {
                        $dayGolongan = 'Sisa Masa Berlaku Pangkat tinggal '. $sisa . ' hari lagi';
                        $arr['result'][]=array(
                            'id'=>$d->id_user,
                            'id_user' => $d->id_user,
                            'pangkat_id' => $d->golongan_id,
                            'tmt_golongan' => $d->tmt_golongan,
                            'tmt_golongan_akhir' => $dayGolongan,
                            'no_sk' => $d->no_sk,
                            'tgl_sk' => $d->tgl_sk,
                            'nama'=>$d->name,
                            'nama_group'=>$d->grup,
                        );

                    }
                    if ($sisa <= 180 && $sisa > 30) {
                        $dayGolongan = 'Sisa Masa Berlaku Pangkat tinggal '. $m . ' bulan '. $day . ' hari lagi';
                        $arr['result'][]=array(
                            'id'=>$d->id_user,
                            'id_user' => $d->id_user,
                            'pangkat_id' => $d->golongan_id,
                            'tmt_golongan' => $d->tmt_golongan,
                            'tmt_golongan_akhir' => $dayGolongan,
                            'no_sk' => $d->no_sk,
                            'tgl_sk' => $d->tgl_sk,
                            'nama'=>$d->name,
                            'nama_group'=>$d->grup,
                        );

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
                            'nama_group'=>$d->grup,
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
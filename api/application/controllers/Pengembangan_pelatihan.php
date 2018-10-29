<?php
error_reporting(0);
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

class Pengembangan_pelatihan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Pengembangan_pelatihan_model');
    }

    public function list_get($offset = 2)
    {
        $limit = 2;
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $results['result'] = $this->Pengembangan_pelatihan_model->get_all(null, null, $offset, $limit);
                $results['total'] = count($this->Pengembangan_pelatihan_model->get_all());
                $results['limit'] = $limit;
                $this->set_response($results, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function save_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $save["no_disposisi"] = $this->input->post("no_disposisi");
                $save["tanggal"] = $this->input->post("tanggal");
                $save["jenis_perjalanan"] = $this->input->post("jenis_perjalanan");
                $save["dalam_negeri"] = $this->input->post("dalam_negeri");
                $save["surat_tugas_dalam_negeri"] = $this->input->post("surat_tugas_dalam_negeri");
                $save["surat_tugas_luar_negeri"] = $this->input->post("surat_tugas_luar_negeri");
                $save["jenis"] = $this->input->post("jenis");
                $save["nopeg"] = $this->input->post("nopeg");
                $save["nama_pegawai"] = $this->input->post("nama_pegawai");
                $save["jabatan"] = $this->input->post("jabatan");


                $biaya_uraian = $this->input->post("biaya_uraian");
                $biaya_nominal = $this->input->post("biaya_nominal");
                if (!empty($biaya_uraian)) {
                    foreach ($biaya_uraian as $key => $value) {
                        $biaya[$key]["biaya_uraian"] = @$value["value"];
                        $biaya[$key]["biaya_nominal"] = @$biaya_nominal[$key]["value"];
                    }
                    $save["biaya"] = json_encode($biaya);
                }

                $result = $this->Pengembangan_pelatihan_model->create($save);
                if ($result){
                    $response['hasil'] = 'success';
                    $response['message'] = 'Data berhasil ditambah!';
                }
                else{
                    $response['hasil'] = 'failed';
                    $response['message'] = 'Data gagal ditambah!';
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }


    public function edit_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $username = $this->input->post('username');
                $username_asli = $this->input->post('f_user_edit');
                $id = $this->input->post('f_id_edit');
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $id_aplikasi = 1;
                $id_group = $this->input->post('id_group');
                $status = $this->input->post('status');
                $user_id_klinik = $decodedToken->data->_pnc_kode_klinik;
                $author = $decodedToken->data->_pnc_username;

                $salt = round(rand() * 1000);
                if (!empty($this->input->post('pass'))) {
                    $password = md5($this->input->post('pass'));
                    $param['password'] = $password;
                }

                if ($username != $username_asli) {


                    $this->db->where('username', $username);
                    $cek = $this->db->get('sys_user')->row();
                } else {
                    $cek = '';
                }
                if (empty($cek)) {
                    $param = array(
                        "username" => $username
                    , "name" => $name
                    , "email" => $email
                    , "id_aplikasi" => $id_aplikasi
                    , "id_grup" => $id_group
                    , "author" => $author
                    , "salt" => $salt
                    , "status" => $status
                    , "created" => date('Y-m-d H:i:s')
                    , "kode_klinik" => $user_id_klinik,
                        'id_uk' => $this->input->post('f_uk')
                    );

                    $this->db->where('id_user', $id);
                    $this->db->update('sys_user', $param);

                    if ($this->db->affected_rows() == '1') {
                        $arr['hasil'] = 'success';
                        $arr['message'] = 'Data berhasil ditambah!';
                    } else {
                        $arr['hasil'] = 'error';
                        $arr['message'] = 'Data Gagal Ditambah!';
                    }
                    $this->set_response($arr, REST_Controller::HTTP_OK);
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah! username sudah pernah digunakan';
                    $this->set_response($arr, REST_Controller::HTTP_OK);
                }


                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public
    function delete_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $id = $this->input->get('id');
                $this->db->where('id_user', $id);
                $this->db->update('sys_user', array('status' => '0'));

                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);


                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public
    function getuser_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $id = $this->input->get('id');


                $this->db->where('id_user', $id);
                $res = $this->db->get('sys_user')->result();
                foreach ($res as $d) {
                    $arr[] = array('id_uk' => $d->id_uk, 'id' => $d->id_user, 'nama' => $d->name, 'username' => $d->username, 'email' => $d->email, 'id_group' => $d->id_grup, 'status' => $d->status);
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);


                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

    }
}
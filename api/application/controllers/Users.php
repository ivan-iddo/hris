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

    public function list_get()
    {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                //$this->db->limit('100');
                //$this->db->order_by();


                $this->db->join('sys_grup_user', 'sys_user.id_grup = sys_grup_user.id_grup', 'LEFT');
                $this->db->join('uk_master', 'uk_master.id = sys_user.id_uk', 'LEFT');
                $this->db->join('sys_user_profile', 'sys_user_profile.id_user = sys_user.id_user', 'LEFT');

                $this->db->where('sys_user.status', '1');
                if (!empty($this->uri->segment(3))) {
                    $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)", $this->uri->segment(3));
                }
                $total_rows = $this->db->count_all_results('sys_user');
                $pagination = create_pagination_endless('/user/list/0/', $total_rows, 20, 4);

                $this->db->select('sys_user.*,sys_grup_user.grup,uk_master.nama,sys_user_profile.NIP,sys_user_profile.NIK');
                $this->db->join('sys_grup_user', 'sys_user.id_grup = sys_grup_user.id_grup', 'LEFT');
                $this->db->join('uk_master', 'uk_master.id = sys_user.id_uk', 'LEFT');
                $this->db->join('sys_user_profile', 'sys_user_profile.id_user = sys_user.id_user', 'LEFT');
                if (!empty($this->uri->segment(3))) {
                    $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)", $this->uri->segment(3));
                }
                $this->db->where('sys_user.status', '1');
                $this->db->limit($pagination['limit'][0], $pagination['limit'][1]);

                $res = $this->db->get('sys_user')->result();
                foreach ($res as $d) {
                    $arr['result'][] = array('nama_uk' => $d->nama,
                        'id_uk' => $d->id_uk,
                        'id_grup' => $d->id_grup,
                        'id' => $d->id_user,
                        'nama' => $d->name,
                        'username' => $d->username,
                        'email' => $d->email,
                        'nama_group' => $d->grup,
                        'nip' => $d->NIP,
                        'nik' => $d->NIK,
                    );
                }

                $arr['total'] = $total_rows;
                $arr['paging'] = $pagination['limit'][1];
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function listpensiun_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                //$this->db->limit('100');
                //$this->db->order_by();


                $this->db->join('sys_grup_user', 'sys_user.id_grup = sys_grup_user.id_grup');
                $this->db->join('uk_master', 'uk_master.id = sys_user.id_uk', 'LEFT');
                $this->db->join('sys_user_profile', 'sys_user_profile.id_user = sys_user.id_user', 'LEFT');

                $this->db->where('sys_user.status', '0');
                if (!empty($this->uri->segment(3))) {
                    $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)", $this->uri->segment(3));
                }
                $total_rows = $this->db->count_all_results('sys_user');
                $pagination = create_pagination_endless('/user/list/0/', $total_rows, 20, 4);

                $this->db->select('sys_user.*,
		sys_grup_user.grup,uk_master.nama,sys_user_profile.NIP,sys_user_profile.NIK,
		his_pegawai_resign.tgl_keluar,his_pegawai_resign.no_sk,his_pegawai_resign.alasan,
		dm_term.nama as karena,his_pegawai_resign.no_sk
		');
                $this->db->join('sys_grup_user', 'sys_user.id_grup = sys_grup_user.id_grup');
                $this->db->join('uk_master', 'uk_master.id = sys_user.id_uk', 'LEFT');
                $this->db->join('sys_user_profile', 'sys_user_profile.id_user = sys_user.id_user', 'LEFT');
                $this->db->join('his_pegawai_resign', 'his_pegawai_resign.id_user = sys_user.id_user');
                $this->db->join('dm_term', 'his_pegawai_resign.id_alasan = dm_term.id');


                if (!empty($this->uri->segment(3))) {
                    $this->db->like("CONCAT(sys_user.name,' ', sys_user_profile.NIP,' ',sys_user_profile.NIK)", $this->uri->segment(3));
                }
                $this->db->where('sys_user.status', '0');
                $this->db->limit($pagination['limit'][0], $pagination['limit'][1]);

                $res = $this->db->get('sys_user')->result();
                foreach ($res as $d) {
                    $arr['result'][] = array('nama' => $d->name,
                        'tgl_keluar' => $d->tgl_keluar,
                        'alasan' => $d->karena,
                        'keterangan' => $d->alasan,
                        'no_sk' => $d->no_sk,
                        'email' => $d->email,
                        'nama_group' => $d->grup,
                        'nip' => $d->NIP,
                        'nik' => $d->NIK,
                    );
                }

                $arr['total'] = $total_rows;
                $arr['paging'] = $pagination['limit'][1];
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }


    public function getgroup_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->db->order_by('grup', 'ASC');
                $res = $this->db->get('sys_grup_user')->result();
                foreach ($res as $d) {
                    $arr['result'][] = array('label' => $d->grup, 'value' => $d->id_grup);
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

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
                $username = $this->input->post('username');
                $name = $this->input->post('name');
                $email = $this->input->post('email');
                $id_aplikasi = 1;
                $id_group = $this->input->post('id_group');
                $status = $this->input->post('status');
                $user_id_klinik = $decodedToken->data->_pnc_kode_klinik;
                $author = $decodedToken->data->_pnc_username;

                $salt = round(rand() * 1000);

                $password = md5($this->input->post('pass'));

                $this->db->where('username', $username);
                $cek = $this->db->get('sys_user')->row();
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
                    , "password" => $password
                    , "kode_klinik" => $user_id_klinik
                    , 'id_uk' => $this->input->post('f_uk')
                    );


                    $this->db->insert('sys_user', $param);

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

    public function delete_get()
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

    public function getuser_get()
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
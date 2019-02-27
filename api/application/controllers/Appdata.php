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

class Appdata extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function login_post()
    {
        $this->load->model('system_auth_model');

        $key = pack("H*", "d0n1M4uL4n4");
        $iv = pack("H*", "H3sT1");


        $tokenData = array();

        $_username = addslashes(trim(htmlspecialchars($this->input->post('username'))));
        $_pass = addslashes(trim($this->input->post('password')));


        $auth = $this->system_auth_model->loginCheck($_username, $_pass);

        if ($auth) {
            $tokenData['data'] = $auth;
            $output['token'] = AUTHORIZATION::generateToken($tokenData);
            $this->set_response($output, REST_Controller::HTTP_OK);
        } else {
            $output['status'] = 'error';
            $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
        }


    }

    public function listPasien_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->db->limit('100');
                //$this->db->order_by();
                $res = $this->db->get('m_pasien')->result();
                foreach ($res as $d) {
                    $arr[] = array('nama' => $d->nama_pasien);
                }

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
                $this->db->where('id_grup', $this->input->get('id'));
                $res = $this->db->get('sys_grup_user')->result();
                foreach ($res as $d) {
                    $arr[] = array('nama' => $d->grup, 'ket' => $d->ket, 'id' => $d->id_grup);
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function loaddataGroup_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $this->db->where('id_group', $decodedToken->data->_pnc_id_grup);
                $this->db->where('id_modul', $this->input->get('id_modul'));

                $cek = $this->db->get('sys_user_access')->row();
                if (empty($cek)) {
                    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
                    return;
                }
                $this->db->order_by('grup', 'ASC');
                $this->db->where('tampilkan', '1');

                $param = urldecode($this->uri->segment(3));
                $param2 = "%".$param."%"; 
                
                if(!empty($this->uri->segment(3))){
                    $this->db->where('grup ilike',$param2); 
                 }
                $res = $this->db->get('sys_grup_user')->result();
                if (!empty($res)) {
                    foreach ($res as $d) {
                        $arr['result'][] = array('id' => $d->id_grup, 'nama' => $d->grup, 'jumlah' => $d->ket);
                    }
                } else {
                    $arr['result'] =array();
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }


    public function loaddataMenu_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id_group = $this->input->get('id_group');
                $menusql = "SELECT 									
														b.modul
														,a.id_menu
														,a.menu
														,a.url
														,a.id_aplikasi
														,a.id_modul
														,a.urutan
														,a.front
														,c.lihat as check_status
														,c.ubah
														,c.simpan,c.hapus,c.setujui,c.tdksetuju
														 
											FROM
														sys_mst_menu a
											LEFT JOIN
														sys_mst_modul b
											ON
														a.id_modul=b.id_modul 
											LEFT JOIN
														sys_user_access c
											ON
														a.id_modul=c.id_modul
														and a.id_menu = c.id_menu
														and c.id_group = '" . $id_group . "'
														where a.id_aplikasi = '1'
										 ORDER BY 
														a.id_aplikasi,b.id_modul,a.urutan";

                $res = $this->db->query($menusql)->result();
                // echo $this->db->last_query();die;
                foreach ($res as $d) {
                    $arr[] = array('id' => $d->id_menu, 'nama' => $d->menu, 'nama_group' => $d->modul, 'front' => $d->check_status, 'id_modul' => $d->id_modul, 'save' => $d->simpan, 'edit' => $d->ubah, 'delete' => $d->hapus,
                        'approved' => $d->setujui, 'unapproved' => $d->tdksetuju);
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function loaddatamainmenu_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $menusql = "SELECT 									
														b.modul
														,a.id_menu
														,a.menu
														,a.url
														,a.id_aplikasi
														,a.id_modul
														,a.urutan
														,a.front
														 
											FROM
														sys_mst_menu a
											LEFT JOIN
														sys_mst_modul b
											ON
														a.id_modul=b.id_modul 
											
														a.id_modul=c.id_modul
														and a.id_menu = c.id_menu
														where a.id_aplikasi = '1'
										 ORDER BY 
														a.id_aplikasi,b.id_modul,a.urutan";

                $res = $this->db->query($menusql)->result();

                foreach ($res as $d) {
                    $arr[] = array('id' => $d->id_menu, 'nama' => $d->menu, 'nama_group' => $d->modul, 'front' => $d->check_status, 'id_modul' => $d->id_modul, 'save' => $d->simpan, 'edit' => $d->ubah, 'delete' => $d->hapus);
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function saveGroup_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $group_aplikasi = '1';//$this->input->post('group_aplikasi');
                $group_group = $_POST['group_group'];
                $group_ket = $_POST['group_ket'];

                $data = array(
                    'id_aplikasi' => ($group_aplikasi)?$group_aplikasi:null, 
                    'grup' => ($group_group)?$group_group:null, 
                    'ket' => ($group_ket)?$group_ket:null
                );
                $this->db->insert('sys_grup_user', $data);
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


    public function editGroup_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $group_aplikasi = '1';//$this->input->post('group_aplikasi');
                $group_group = $_POST['group_group'];
                $group_ket = $_POST['group_ket'];

                $data = array(
                    'id_aplikasi' => ($group_aplikasi)?$group_aplikasi:null, 
                    'grup' => ($group_group)?$group_group:null, 
                    'ket' => ($group_ket)?$group_ket:null
                );
                $this->db->where('id_grup', $this->input->post('id_group'));
                $this->db->update('sys_grup_user', $data);
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

    public function deleteGroup_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $id_group = $this->input->get('id_group');
                $this->db->where('id_grup', $id_group);
                $this->db->delete('sys_grup_user');

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

    public function addmenu_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $id_group = $this->input->post('id_group');
                $id_menu = $this->input->post('id_menu');


                $this->db->where('id_group', $id_group);
                $this->db->delete('sys_user_access');

                $data = explode(',', $id_menu);

                foreach ($data as $val) {
                    $id_aplikasi = 1;
                    $IDS = explode('|', $val);
                    $id_modul = $IDS[0];
                    $id_menu = $IDS[1];

                    $dataarr = array(
                        'id_aplikasi' => '1', 
                        'id_group' => ($id_group)?$id_group:null, 
                        'id_modul' => ($id_modul)?$id_modul:null, 
                        'id_menu' => ($id_menu)?$id_menu:null
                    );
                    $this->db->insert('sys_user_access', $dataarr);
                }
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

    public function getprov_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->db->order_by('province_name', 'ASC');
                $res = $this->db->get('m_provinsi')->result();
                foreach ($res as $d) {
                    $arr['result'][] = array(
                        'label' => $d->province_name, 
                        'value' => $d->province_id
                    );
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function getstatus_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $this->db->order_by('id', 'DESC');
                $res = $this->db->get('sys_mst_status_aktif')->result();
                foreach ($res as $d) {
                    $arr['result'][] = array('label' => $d->status_aktif, 'value' => $d->id);
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}
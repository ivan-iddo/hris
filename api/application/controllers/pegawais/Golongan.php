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

class Golongan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */


    function savegolongan_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
            if ($decodedToken != false) {

                $arrdata = array(
                    'id_user' => ($this->input->post('id_user'))?$this->input->post('id_user'):null,
                    'golongan_id' => ($this->input->post('pangkat_id'))?$this->input->post('pangkat_id'):null,
                    'tmt_golongan' => ($this->input->post('tmt_golongan'))?$this->input->post('tmt_golongan'):null,
                    'tmt_golongan_akhir' => ($this->input->post('tmt_golongan_akhir'))?$this->input->post('tmt_golongan_akhir'):null,
                    'no_sk' => ($this->input->post('no_sk'))?$this->input->post('no_sk'):null,
                    'tgl_sk' => ($this->input->post('tgl_sk'))?$this->input->post('tgl_sk'):null,
                    'penanda_tanganan' => ($this->input->post('penanda_tanganan'))?$this->input->post('penanda_tanganan'):null,
                    'status' => ($this->input->post('status'))?$this->input->post('status'):null,
                );

                $this->db->insert('his_golongan', $arrdata);
                $saved_id = $this->db->insert_id('his_golonganid_seq');

                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['id'] = $saved_id;
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

    public function listgolongan_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                //$this->db->limit('100');
                //$this->db->order_by();
                $arr = array();
                $this->db->select('his_golongan.*,m_golongan_peg.gol_romawi as nama_p,m_golongan_peg.pangkat,his_golongan.no_sk');
                $this->db->join('m_golongan_pegawai', 'm_golongan_pegawai.id = his_golongan.golongan_id', 'LEFT');
                $this->db->join('m_golongan_peg', 'm_golongan_peg.id = his_golongan.golongan_id', 'LEFT');
                $this->db->where('his_golongan.tampilkan', '1');
                if (!empty($id = $this->uri->segment(4))) {
                    $this->db->where('his_golongan.id_user', $id);
                }
                $res = $this->db->get('his_golongan')->result();
                foreach ($res as $d) {
                    $arr[] = array('id' => $d->id,
                        'id_user' => $d->id_user,
                        'pangkat_id' => $d->nama_p.' / '.$d->pangkat,
                        'tmt_golongan' => $d->tmt_golongan,
                        'tmt_golongan_akhir' => $d->tmt_golongan_akhir,
                        'no_sk' => $d->no_sk,
                        'tgl_sk' => $d->tgl_sk,
                        'penanda_tanganan' => $d->penanda_tanganan,
                        'status' => $d->status,
                        'namaGolongan' => $d->nama_p
                    );
                }

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    function editgolongan_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
            if ($decodedToken != false) {

                $arrdata = array(
                    'golongan_id' => ($this->input->post('pangkat_id'))?$this->input->post('pangkat_id'):null,
                    'tmt_golongan' => ($this->input->post('tmt_golongan'))?$this->input->post('tmt_golongan'):null,
                    'tmt_golongan_akhir' => ($this->input->post('tmt_golongan_akhir'))?$this->input->post('tmt_golongan_akhir'):null,
                    'no_sk' => ($this->input->post('no_sk'))?$this->input->post('no_sk'):null,
                    'tgl_sk' => ($this->input->post('tgl_sk'))?$this->input->post('tgl_sk'):null,
                    'penanda_tanganan' => ($this->input->post('penanda_tanganan'))?$this->input->post('penanda_tanganan'):null,
                    'status' => ($this->input->post('status'))?$this->input->post('status'):null,
                );


                $this->db->where('id', $this->uri->segment(4));
                $test = $this->db->update('his_golongan', $arrdata);
                if ($test == '1') {
                    $arr['hasil'] = 'success';
                    $arr['id'] = $this->uri->segment(4);
                    $arr['message'] = 'Data berhasil diperbaharui!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal diperbaharui!';
                }


                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    function getgolongan_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                //$this->db->limit('100');
                //$this->db->order_by();
                $arr = array();

                if (!empty($id = $this->uri->segment(4))) {
                    $this->db->where('his_golongan.id', $id);
                }
                $res = $this->db->get('his_golongan')->result();
                foreach ($res as $d) {
                    $arr = array('id' => $d->id,
                        'id_user' => $d->id_user,
                        'pangkat_id' => $d->golongan_id,
                        'tmt_golongan' => $d->tmt_golongan,
                        'tmt_golongan_akhir' => $d->tmt_golongan_akhir,
                        'no_sk' => $d->no_sk,
                        'tgl_sk' => $d->tgl_sk,
                        'penanda_tanganan' => $d->penanda_tanganan,
                        'status' => $d->status,
                        'file' => $d->file_url
                    );
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    function deletegolongan_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
            if ($decodedToken != false) {

                $arrdata = array(
                    'tampilkan' => '0'
                );

                $this->db->where('id', $_GET['id']);
                $test = $this->db->update('his_golongan', $arrdata);

                if ($test == '1') {
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
}
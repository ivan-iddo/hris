<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");/* Changes: 1. This project contains .htaccess file for windows machine. Please update as per your requirements. Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva 2. Change 'encryption_key' in application\config\config.php Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/ 3. Change 'jwt_key' in application\config\jwt.php */

// require APPPATH . '/libraries/REST_Controller.php';
// $rest_json = file_get_contents("php://input");
// $_POST = json_decode($rest_json, true);
class keluarga extends CI_Controller
{   

    public function savekeluarga()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);

        /* ini untuk dump hasil post dari ajax */
        // var_dump($this->input->post());
        // if (!$this->upload->do_upload('inputfileupload')) {
        //     print_r($this->upload->display_errors());
        // }
        // die;
        
        $arrdata = array(
            'id_user' => ($this->input->post('id_user_baru')?$this->input->post('id_user_baru'):NULL),
            'nik' => ($this->input->post('txtNik')?$this->input->post('txtNik'):NULL),
            'nama' => ($this->input->post('txtNama')?$this->input->post('txtNama'):NULL),
            'tempat_lahir' => ($this->input->post('txtTptLahir')?$this->input->post('txtTptLahir'):NULL),
            'tgl_lahir' => ($this->input->post('txtTglLahir')?$this->input->post('txtTglLahir'):NULL),
            'kelamin' => ($this->input->post('txtKelamin')?$this->input->post('txtKelamin'):NULL),
            'id_pendidikan' => ($this->input->post('txtPendidikan')?$this->input->post('txtPendidikan'):NULL),
            'id_pekerjaan' => ($this->input->post('txtPekerjaan')?$this->input->post('txtPekerjaan'):NULL),
            'id_hubkel' => ($this->input->post('txtHubungan')?$this->input->post('txtHubungan'):NULL),
			'karn' => ($this->input->post('txtkarn')?$this->input->post('txtkarn'):NULL),
        );

        if (!$this->upload->do_upload('inputfileupload')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["url"] = $upload['file_name'];
        }
        // print_r($arrdata);die();
        if (!empty($this->input->post('id_keluarga'))) {
            $this->db->where('id', $this->input->post('id_keluarga'));
            $result = $this->db->update('his_keluarga', $arrdata);
        } else {
            $this->db->insert('his_keluarga', $arrdata);
        }
        

        if ($this->db->affected_rows() == '1') {
            $arr['hasil'] = 'success';
            $arr['message'] = 'Data berhasil ditambah!';
        } else {
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
        }
        echo json_encode($arr);
    }

    public function upload_file()
    {   
        // print_r($_POST);die();

        $config['upload_path'] = 'upload/data/latbang';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $arrdata = array(
                        "statue" => 2,
                    );
        if (!$this->upload->do_upload('inputfileupload')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file"] = $upload['file_name'];
        }
        // print_r($arrdata);die();

        $id = $this->input->post("id_latbang");

        $this->db->where("id", $id);
        $result = $this->db->update('pengembangan_pelatihan', $arrdata);


        if ($result) {
            $response['hasil'] = 'success';
            $response['message'] = 'File berhasil diuload!';
        } else {
            $response['hasil'] = 'error';
            $response['message'] = 'File gagal diuload!';
        }

        echo json_encode($response);
    }

    public function editkeluarga()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);

        $arrdata = array(
			'nik' => ($this->input->post('txtNik')?$this->input->post('txtNik'):NULL),
            'nama' => ($this->input->post('txtNama')?$this->input->post('txtNama'):NULL),
            'tempat_lahir' => ($this->input->post('txtTptLahir')?$this->input->post('txtTptLahir'):NULL),
            'tgl_lahir' => ($this->input->post('txtTglLahir')?$this->input->post('txtTglLahir'):NULL),
            'kelamin' => ($this->input->post('txtKelamin')?$this->input->post('txtKelamin'):NULL),
            'id_pendidikan' => ($this->input->post('txtPendidikan')?$this->input->post('txtPendidikan'):NULL),
            'id_pekerjaan' => ($this->input->post('txtPekerjaan')?$this->input->post('txtPekerjaan'):NULL),
            'id_hubkel' => ($this->input->post('txtHubungan')?$this->input->post('txtHubungan'):NULL),
			'karn' => ($this->input->post('txtkarn')?$this->input->post('txtkarn'):NULL),
        );
        if (!$this->upload->do_upload('inputfileupload')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["url"] = $upload['file_name'];
        }

        $this->db->where('id', $this->input->post('id_keluarga'));
        $result = $this->db->update('his_keluarga', $arrdata);

        if ($result) {
            $arr['hasil'] = 'success';
            $arr['message'] = 'Data berhasil ditambah!';
        } else {
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
        }
        $arr["query"] = $this->db->last_query();
        echo json_encode($arr);
    }
}
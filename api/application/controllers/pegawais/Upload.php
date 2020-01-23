<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/controllers/Monitoring.php';
$rest_json = file_get_contents("php://input");

$_POST = json_decode($rest_json, true);

class Upload extends REST_Controller
{
	
	/**
	* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
	* Method: GET
	*/
	public function upload_file_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$created=$decodedToken->data->_pnc_username;
			
			$config['upload_path'] = 'upload/data';
			$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
			$config['max_size'] = '50000000'; 
			$this->load->library('upload', $config);
			$filename='logo.png';
			$id = $this->input->post('id_userfile');
			//print_r($id);die();
			if (!$this->upload->do_upload('inputfileupload', $id))
			{
				$error = array('error' => $this->upload->display_errors());
			}
			else
			{
				$data = array('inputfileupload' => $this->upload->data());
				$filename = $data['inputfileupload']['file_name'];
			}

			$id_kategori = $this->input->post('kategorifile'); 

			$datas = array(
				'id_user' => $id,
				'kategori_id' => $id_kategori,
				'nama_file' =>$this->input->post('namafile'),
				'url' => $filename,
				'createdby' => $created,
				'tgl' => date("Y-m-d H:i:s"));

			$this->db->insert('his_files', $datas);

			if($this->db->affected_rows() == '1'){
				$arr['file'] = $filename;
				$arr['nama'] = $this->input->post('namafile');
				$arr['hasil']='success';
				$arr['message']='Data berhasil ditambah!'; 
			}
			else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			}
			
			$this->set_response($arr, REST_Controller::HTTP_OK);
			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
    /** URL: http://localhost/CodeIgniter-JWT-Sample/auth/token Method: GET */
    public function upload_ijazah()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
		$id = $this->input->post('id_pendidikan');
        
        if (!$this->upload->do_upload('doc_file', $id)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $datas = array('file_url' => $filename);
        $this->db->where('id', $id);
        $this->db->update('his_pendidikan', $datas);
        if ($this->db->affected_rows() == '1') {
            $arr['file'] = $filename;
            $arr['hasil'] = 'success';
            $arr['message'] = 'Data berhasil ditambah!';
        } else {
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
        }
        echo json_encode($arr);
    }

    public function upload_pendidikan_post()
    {
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$created=$decodedToken->data->_pnc_username;
			
        $config['upload_path'] = 'upload/pendidikan';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
		$user = $this->input->post('id_userfile');;
        
        if (!$this->upload->do_upload('doc_file', $user)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $user = $this->input->post('id_userfile');;
        $id = $this->input->post('id_pendidikan');
        $datas = array(
		'id_user' => $user,
        'kategori_id' => 13,
        'nama_file' =>$this->input->post('namafile'),
        'id_pendidikan' =>$id,
        'url' => $filename,
		'createdby' => $created,
		'tgl' => date("Y-m-d H:i:s"));
		$result=$this->db->insert('his_files_pen', $datas);
		
        if ($result) {
            $arr['file'] = $filename;
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

    public function upload_latbang_file()
    {   
// print_r($_POST);die();

        $config['upload_path'] = 'upload/data/latbang';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('inputfileuploadtgs')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file"] = $upload['file_name'];
        }
        if (!$this->upload->do_upload('inputfileuploadizn')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file_izn"] = $upload['file_name'];
        }
        if (!$this->upload->do_upload('inputfileuploadspd')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file_spd"] = $upload['file_name'];
        }
        if (!$this->upload->do_upload('inputfileuploadrak')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file_rak"] = $upload['file_name'];
        }
        if (!$this->upload->do_upload('inputfileuploadrkm')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file_rkm"] = $upload['file_name'];
        }
        if (!$this->upload->do_upload('inputfileuploadlap')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["file_lap"] = $upload['file_name'];
        }
//print_r($arrdata);die();

        $id = $this->input->post("id_latbang");

        $this->db->where("id", $id);
        $result = $this->db->update('pengembangan_pelatihan_detail', $arrdata);


        if ($result) {
            $response['hasil'] = 'success';
            $response['message'] = 'File berhasil diuload!';
        } else {
            $response['hasil'] = 'error';
            $response['message'] = 'File gagal diuload!';
        }

        echo json_encode($response);
    }

    public function upload_pelatihan_post()
    {
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$created=$decodedToken->data->_pnc_username;
		
        $config['upload_path'] = 'upload/pelatihan';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
		$user = $this->input->post('id_userfile');;
        
        if (!$this->upload->do_upload('doc_file', $user)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $id = $this->input->post('id_pelatihan');
        $datas = array(
		'id_user' => $user,
        'kategori_id' => 13,
        'nama_file' =>$this->input->post('namafile'),
        'id_pelatihan' =>$id,
        'url' => $filename,
		'createdby' => $created,
		'tgl' => date("Y-m-d H:i:s"));
		$this->db->insert('his_files_pel', $datas); if ($this->db->affected_rows() == '1') {
            $arr['file'] = $filename;
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

    public function upload_golongan_post()
    {
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$created=$decodedToken->data->_pnc_username;
		
        $config['upload_path'] = 'upload/golongan';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
		$user = $this->input->post('id_userfile');;
        
        if (!$this->upload->do_upload('doc_file', $user)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $id = $this->input->post('id_golongan');
        $datas = array(
		'id_user' => $user,
        'kategori_id' => 12,
        'nama_file' =>$this->input->post('namafile'),
        'id_golongan' =>$id,
        'url' => $filename,
		'createdby' => $created,
		'tgl' => date("Y-m-d H:i:s"));
		$this->db->insert('his_files_gol', $datas);
		if ($this->db->affected_rows() == '1') {
            $arr['file'] = $filename;
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

    public function upload_jabasn_post()
    {
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
			$created=$decodedToken->data->_pnc_username;
		
        $config['upload_path'] = 'upload/asn';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
		$user = $this->input->post('id_userfile');;
        
        if (!$this->upload->do_upload('doc_file', $user)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $datas = array('file_url' => $filename);
        $id = $this->input->post('idasn');
        $datas = array(
		'id_user' => $user,
        'kategori_id' => 13,
        'nama_file' =>$this->input->post('namafile'),
        'id_asn' =>$id,
        'url' => $filename,
		'createdby' => $created,
		'tgl' => date("Y-m-d H:i:s"));
		$this->db->insert('his_files_asn', $datas); 
        if ($this->db->affected_rows() == '1') {
            $arr['file'] = $filename;
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

    public function uploadidentitas()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000'; 
        $this->load->library('upload', $config);
        $filename='logo.png';
		$id = $this->input->post('f_id_edit');

        if (!$this->upload->do_upload('fileidentitas', $id))
        {
            $error = array('error' => $this->upload->display_errors());
        }
        else
        {
            $data = array('fileidentitas' => $this->upload->data());
            $filename = $data['fileidentitas']['file_name'];
        }

        $datas = array(
            'id_user' => $id,
            'kategori_id' => '10',
            'nama_file' =>$this->input->post('namafileidentitas'),
            'url' => $filename);

        $this->db->insert('his_files', $datas);

        if($this->db->affected_rows() == '1'){
            $arr['file'] = $filename;
            $arr['nama'] = $this->input->post('namafile');
            $arr['hasil']='success';
            $arr['message']='Data berhasil ditambah!'; 
        }
        else{
            $arr['hasil']='error';
            $arr['message']='Data Gagal Ditambah!';
        }

        echo json_encode($arr);                                           
    }
}
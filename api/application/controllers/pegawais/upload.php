<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");/* Changes: 1. This project contains .htaccess file for windows machine. Please update as per your requirements. Samples (Win/Linux): http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva 2. Change 'encryption_key' in application\config\config.php Link for encryption_key: http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/ 3. Change 'jwt_key' in application\config\jwt.php */

class Upload extends MY_Controller
{

    public function savekeluarga()
    {

        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);

        $arrdata = array(
            'id_user' => $this->user->data->id,
            'NIK' => $this->input->post('txtNik'),
            'nama' => $this->input->post('txtNama'),
            'tempat_lahir' => $this->input->post('txtTptLahir'),
            'tgl_lahir' => $this->input->post('txtTglLahir'),
            'kelamin' => $this->input->post('txtKelamin'),
            'id_pendidikan' => $this->input->post('txtPendidikan'),
            'id_pekerjaan' => $this->input->post('txtPekerjaan'),
            'id_hubkel' => $this->input->post('txtHubungan'),
        );
        if (!$this->upload->do_upload('inputfileupload')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["url"] = $upload['file_name'];
        }

        $this->db->insert('his_keluarga', $arrdata);

        if ($this->db->affected_rows() == '1') {
            $arr['hasil'] = 'success';
            $arr['message'] = 'Data berhasil ditambah!';
        } else {
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
        }
        echo json_encode($arr);
    }

    public function editkeluarga()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);

        $arrdata = array(
            'NIK' => $this->input->post('txtNik'),
            'nama' => $this->input->post('txtNama'),
            'tempat_lahir' => $this->input->post('txtTptLahir'),
            'tgl_lahir' => $this->input->post('txtTglLahir'),
            'kelamin' => $this->input->post('txtKelamin'),
            'id_pendidikan' => $this->input->post('txtPendidikan'),
            'id_pekerjaan' => $this->input->post('txtPekerjaan'),
            'id_hubkel' => $this->input->post('txtHubungan')
        );
        if (!$this->upload->do_upload('inputfileupload')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $upload = $this->upload->data();
            $arrdata["url"] = $upload['file_name'];
        }

        $this->db->where('id', $this->uri->segment(3));
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

    /** URL: http://localhost/CodeIgniter-JWT-Sample/auth/token Method: GET */
    public function upload_ijazah()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
        if (!$this->upload->do_upload('doc_file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $datas = array('file_url' => $filename);
        $id = $this->input->post('id_pendidikan');
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

    public function upload_pelatihan()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
        if (!$this->upload->do_upload('doc_file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $datas = array('file_url' => $filename);
        $id = $this->input->post('id_pelatihan');
        $this->db->where('id', $id);
        $this->db->update('his_pelatihan', $datas);
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

    public function upload_golongan()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
        if (!$this->upload->do_upload('doc_file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
            $filename = $data['upload_data']['file_name'];
        }
        $datas = array('file_url' => $filename);
        $id = $this->input->post('id_golongan');
        $this->db->where('id', $id);
        $this->db->update('his_golongan', $datas);
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

    public function upload_file()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000'; 
        $this->load->library('upload', $config);
        $filename='logo.png';

        if (!$this->upload->do_upload('inputfileupload'))
        {
            $error = array('error' => $this->upload->display_errors());
        }
        else
        {
            $data = array('inputfileupload' => $this->upload->data());
            $filename = $data['inputfileupload']['file_name'];
        }

        $id = $this->input->post('id_userfile');
        $id_kategori = $this->input->post('kategorifile'); 

        $datas = array(
                'id_user' => $id,
                'kategori_id' => $id_kategori,
                'nama_file' =>$this->input->post('namafile'),
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
<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


class Punishment extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Punishment_model");
	}

	public function index($id)
	{
        $response['success'] = true;
        $response['data'] = $this->view($id);

	    $this->set_response($response);
	}

    private function view($id)
    {
        $datas["result"] = $this->Punishment_model->get_all(array("id_user" => $id));
        $view = $this->load->view('pegawai/view_punishment', $datas, true);
        return $view;
    }

	public function add()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
        if (!$this->upload->do_upload('inputfileupload')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('inputfileupload' => $this->upload->data());
            $filename = $data['inputfileupload']['file_name'];
        }
        $datas["id_user"] = ($this->input->post('id_userfile')?$this->input->post('id_userfile'):NULL);
        $datas["keterangan"] = ($this->input->post('keterangan')?$this->input->post('keterangan'):NULL);
        $datas["kasus"] = ($this->input->post('kasus')?$this->input->post('kasus'):NULL);
        $datas["tindakan"] = ($this->input->post('tindakan')?$this->input->post('tindakan'):NULL);
        $datas["date_start"] = ($this->input->post('date_start')?$this->input->post('date_start'):NULL);
        $datas["date_end"] = ($this->input->post('date_end')?$this->input->post('date_end'):NULL);
        $datas["url"] = ($filename?$filename:NULL);
        
        $create = $this->Punishment_model->create($datas);

        if ($create) {
            $response['success'] = true;
            $response['message'] = 'Data berhasil ditambah!';
            $response['data'] = $this->view($datas["id_user"]);
        } 
        else {
            $response['success'] = false;
            $response['message'] = 'Data Gagal Ditambah!';
        }

        $this->set_response($response);
    }

    public function delete($id)
    {
        $check = $this->Punishment_model->delete($id);
        $id_user = $this->input->get("id_userfile");
        if ($check) {
            $response['success'] = true;
            $response['message'] = 'Berhasil!';
        } 
        else {
            $response['success'] = false;
            $response['message'] = 'Gagal!';
        }
        $response['data'] = $this->view($id_user);

        $this->set_response($response);
    }

    public function _remap(){
        $this->indexfixer->remap();
    }
}
?>
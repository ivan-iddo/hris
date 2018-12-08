<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


class Penghargaan extends MY_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("His_penghargaan_model");
	}

	public function index()
	{
        $response['success'] = true;
        $response['data'] = $this->view();

	    $this->set_response($response);
	}
	private function view()
	{
		$datas["result"] = $this->His_penghargaan_model->get_all(array("createdby" => 1));
		$view = $this->load->view('pegawai/view_penghargaan', $datas, true);
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
        $datas["penghargaan"] = $this->input->post('penghargaan');
        $datas["instansi"] = $this->input->post('instansi');
        $datas["tanggal"] = $this->input->post('tanggal');
        $datas["url"] = $filename;

        $create = $this->His_penghargaan_model->create($datas);
        $datas = $this->His_penghargaan_model->get_all(array("createdby" => $this->user->data->id));

        if ($create) {
            $response['success'] = true;
            $response['message'] = 'Data berhasil ditambah!';
            $response['data'] = $this->view();
        } 
        else {
            $response['success'] = false;
            $response['message'] = 'Data Gagal Ditambah!';
        }

        $this->set_response($response);
    }

    public function delete($id)
    {
        $check = $this->His_penghargaan_model->delete($id);

        if ($check) {
            $response['success'] = true;
            $response['message'] = 'Berhasil!';
        } 
        else {
            $response['success'] = false;
            $response['message'] = 'Gagal!';
        }
        $response['data'] = $this->view();

        $this->set_response($response);
    }
}
?>
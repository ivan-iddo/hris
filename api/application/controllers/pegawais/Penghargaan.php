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

    public function index($id = null)
    {
        $response['success'] = true; 
        if($id <> null){
            $response['data'] = $this->view($id);
        }
        $this->set_response($response);
    }
    private function view($id)
    {
        $datas["result"] = $this->His_penghargaan_model->get_all(array("id_user" => $id));
        $view = $this->load->view('pegawai/view_penghargaan', $datas, true);
        return $view;
    } 
	public function user($id = null)
    {
        $response['success'] = true; 
        if($id <> null){
            $response['data'] = $this->user_view($id);
        }
        $this->set_response($response);
    }
    private function user_view($id)
    {
        $datas["result"] = $this->His_penghargaan_model->get_all(array("id_user" => $id));
        $view = $this->load->view('pegawai/view_penghargaanview', $datas, true);
        return $view;
    }

    public function add()
    {
        $config['upload_path'] = 'upload/data';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
        $config['max_size'] = '50000000';
        $this->load->library('upload', $config);
        $filename = 'logo.png';
		$datas["id_user"] = ($this->input->post('id_userfile')?$this->input->post('id_userfile'):NULL);
        if (!$this->upload->do_upload('inputfileupload', $datas["id_user"])) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('inputfileupload' => $this->upload->data());
            $filename = $data['inputfileupload']['file_name'];
        }
        
        $datas["nosk"] = ($this->input->post('nosk')?$this->input->post('nosk'):NULL);
        $datas["penghargaan"] = ($this->input->post('penghargaan')?$this->input->post('penghargaan'):NULL);
        $datas["instansi"] = ($this->input->post('instansi')?$this->input->post('instansi'):NULL);
		if(!empty($this->input->post('tanggal'))){
		$datas["tanggal"]=date_format(date_create($this->input->post('tanggal')), "Y-m-d");}else{$datas["tanggal"]=NULL;}
        $datas["url"] = ($filename?$filename:NULL);

        $create = $this->His_penghargaan_model->create($datas);

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
        $check = $this->His_penghargaan_model->delete($id);
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
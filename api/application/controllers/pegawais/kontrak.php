<?php 
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");


class Kontrak extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("His_kontrak_model");
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
        $datas["result"] = $this->His_kontrak_model->get_all(array("id_user" => $id));
        $view = $this->load->view('pegawai/view_kontrak', $datas, true);
        return $view;
    } 
	
	 public function user()
    {
		$id = $this->input->get("id");
        $response['success'] = true; 
        if($id <> null){
            $response['data'] = $this->user_view($id);
        }
        $this->set_response($response);

    }
	private function user_view($id)
    {
		 $response['success'] = true; 
        $datas["result"] = $this->His_kontrak_model->get_all(array("id_user" => $id));
        $userview = $this->load->view('pegawai/view_kontrakview', $datas, true);
        return $userview;
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

        $awall=date_format(date_create($this->input->post('tmtawal')), "Y-m-d");
        $kontraks=date_format(date_create($this->input->post('tglktr')), "Y-m-d");
        $akhirs=date_format(date_create($this->input->post('tglakhir')), "Y-m-d");
        $datas["id_user"] = ($this->input->post('id_userfile')?$this->input->post('id_userfile'):NULL);
        $datas["noktr"] = ($this->input->post('noktr')?$this->input->post('noktr'):NULL);
        $datas["tmtawal"] = ($awall?$awall:NULL);
        $datas["tglktr"] = ($kontraks?$kontraks:NULL);
        $datas["jnsktr"] = ($this->input->post('jnsktr')?$this->input->post('jnsktr'):NULL);
        $datas["tetap"] = ($this->input->post('statustetap')?$this->input->post('statustetap'):NULL);
		$datas["pns"] = ($this->input->post('status')?$this->input->post('status'):NULL);
        $datas["tglakhir"] = ($akhirs?$akhirs:NULL);
        $datas["url"] = $filename;

        $create = $this->His_kontrak_model->create($datas);

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
        $check = $this->His_kontrak_model->delete($id);
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
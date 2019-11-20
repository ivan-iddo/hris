<?php
// echo "<pre>";
// print_r($result);
// echo "<pre>";
// die;
error_reporting(0);
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/controllers/Monitoring.php';
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

class Laporan_cuti extends REST_Controller
{
function cetak_get()
{
	$this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,dm_term.nama as statuspros,sys_user.name as namapegawai');
	$this->db->join('m_jenis_cuti', 'm_jenis_cuti.abid = his_cuti.jenis_cuti','left');
	$this->db->join('dm_term', 'dm_term.id = his_cuti.status','left');
	$this->db->join('sys_user', 'sys_user.id_user = his_cuti.id_user','left');
	$this->db->where('his_cuti.tampilkan', '1');
	   
	if ((!empty($this->input->get('id_uk'))) AND ($this->input->get('id_uk') <> 'null')) {
		$this->db->where('sys_user.id_grup', $this->input->get('id_uk'));
	}

	if (empty($this->input->get('awal'))) {
		$awal = date('Y-m-d');
	} else {
		$awal = date_format(date_create($this->input->get('awal')), "Y-m-d");
	}
	
	if ($this->input->get('user')!='null') {
		$this->db->where('sys_user.id_user',$this->input->get('user'));
	}else{
		$this->db->where('his_cuti.tgl_cuti >=',$awal);
	}
	
	$this->db->where('m_jenis_cuti.tahun=',date('Y'));
	
	//$this->db->where('his_cuti.tgl_akhir_cuti >=',$awal);
	
	if (!empty($this->input->get('akhir'))) {
		$ahir = date_format(date_create($this->input->get('akhir')), "Y-m-d");
		$this->db->where('his_cuti.tgl_cuti <=',$ahir);
		//$this->db->where('his_cuti.tgl_akhir_cuti <=',$ahir);
	}
	
	
	$this->db->order_by('tgl_cuti', 'DESC');
	$result['result'] = $this->db->get('his_cuti')->result_array();
	$data = "test";
	$this->load->library("pdf");
	$html = $this->load->view("laporan/cuti", array("result" => $result['result']), true);

	//echo $html;
	//die;
	$customPaper = array(0,0,210,330);
	$this->pdf->loadHtml($html);
	// $this->pdf->setPaper($customPaper);
	$this->pdf->setPaper("A4");
	$this->pdf->set_option("isPhpEnabled", true);
	$this->pdf->set_option("isHtml5ParserEnabled", true);
	$this->pdf->set_option("isRemoteEnabled", true);
	$this->pdf->render();
	$name = "List Cuti";
	$this->pdf->stream($name, array("Attachment" => 1));

    }
}
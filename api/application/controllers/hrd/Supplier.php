<?php 
// header('Content-Type: application/json');
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

class Supplier extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
//Do your magic here
        $this->load->model('Abk_mutasi');
        $this->load->model('System_auth_model');
    }
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/
public function cetak_get()
{
    $tgl_mutasi = $this->input->get("tgl_mutasi");
    $results['result'] = $this->Abk_mutasi->get_all(array("abk_req_mutasi_jabatan.tgl_mutasi" => $tgl_mutasi), null, $offset, $limit);
    if (!empty($results['result'])) {
        foreach ($results["result"] as $key => $value) {
            $results[0]["tanggal"] = date("d",strtotime($results[0]["tgl_mutasi"]))." ".bulan(date("m",strtotime($results[0]["tgl_mutasi"]))) ." ".date("Y",strtotime($results[0]["tgl_mutasi"]));
            $results['result'][$key]['mutasi']=$results['result'];
            $results['result'][$key]['jum']=count($results['result']);
//print_r($results['result'][$key]);die;

            $this->load->library("pdf");
            $data = "test";
            $html = $this->load->view("mutasi", array("result" => $results['result'][$key]), true);

//echo $html;
//die;

            $this->pdf->loadHtml($html);
            $this->pdf->setPaper("legal", ($orientation = "P" ));
            $this->pdf->set_option("isPhpEnabled", true);
            $this->pdf->set_option("isHtml5ParserEnabled", true);
            $this->pdf->set_option("isRemoteEnabled", true);
            $this->pdf->render();
            $name = "download surat dinas";
            $this->pdf->stream($name, array("Attachment" => 1));
// return true;
        }
    }
}

}
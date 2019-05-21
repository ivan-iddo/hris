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

class Pengembangan_pelatihan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Pengembangan_pelatihan_model');
        $this->load->model('Pengembangan_pelatihan_kegiatan_model');
        $this->load->model('Pengembangan_pelatihan_kegiatan_status_model');
        $this->load->model('System_auth_model');
    }

    public function preview_get()
    {
        $jenis_surat = $this->input->get("surat");
		$id = $this->input->get("id");
		$kode = $this->input->get("kode");
        $results = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);
        // print_r($jenis_surat);die;
        if (!empty($results)) {
            $result = $results[0];
            $createdby = $this->db->select("username")->where(array("id_user" => $result["createdby"]))->get("sys_user")->result_array();
            $updatedby = $this->db->select("username")->where(array("id_user" => $result["updatedby"]))->get("sys_user")->result_array();
            if (count($createdby) == 1) {
                $result["createdby"] = $createdby[0]["username"];
            }
            if (count($updatedby) == 1) {
                $result["updatedby"] = $updatedby[0]["username"];
            }
            $tanggal = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $result["id"]));
            $result["tanggal"] = $tanggal;
            $result["tanggal"]["tanggal_now"] = bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["tanggal"]["tanggal_from"] = date("d",strtotime($result["tanggal"][0]["tanggal_from"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_from"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_from"]));
            $result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            $result["tanggal"]["day_to"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_to"])));
            $result["tanggal"]["day_from"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_from"])));
            $result["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($result["phl"]);
            
			// print_r($result);die;
			$result["footer"]=true;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            if(!empty($kode)){
			$result["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
			}
			//print_r($kode);die;
			foreach ($results as $key => $value) {
                $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                $result["count"] = count($result["detail"]);
				$result["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value["id"]));	
				$result["golongan"] = $this->Pengembangan_pelatihan_model->get_akomodasi("pengembangan_pelatihan_detail", array("golongan" => $result["detail"][$key]["golongan"], "pengembangan_pelatihan_id" => $value["id"]));	
				$result["count_golongan"] = count($result["golongan"]);
				$result["count_detail"] = count($result["detail_uraian"]);
				//if (!empty($result["golongan"])) {
				//foreach ($result["golongan"] as $key => $value){
				//$count=count($result["golongan"]);
				//$result["jumlah"] += $value["akomodasi"];
				
				//}
				//}
			//if (!empty($result["detail_uraian"])) {
				//foreach ($result["detail_uraian"] as $keya => $valuea){
				//$jum=count($result["detail_uraian"]);
				//if($jum==1){
				//$result["tota"] = $value["total"];
                //}else{
				//$result["tota_1"] += $valuea["total"];
                //}
				//}
				//}
				
            }
				
        }
       //print_r($result);die;
        //$this->load->library("pdf");
        $data = "test";
        if ($result['jenis_perjalanan'] == "Dalam Negeri") {
        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
				}else if ($jenis_surat == "Surat_verbal") {
					$html = $this->load->view("view_pdf_15", array("result" => $result), true);
				}else if ($jenis_surat == "dft") {
					$html = $this->load->view("dftar", array("result" => $result), true);
				}else{
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
				}
			} else if ($result["jenis"] == "Individu"){
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
				}else if ($jenis_surat == "Surat_verbal") {
					$html = $this->load->view("view_pdf_15", array("result" => $result), true);
				}else{
                $html = $this->load->view("view_pdf_1", array("result" => $result), true);
				}
			}
        } else if ($result['jenis_surat'] == "Surat Izin") {
			if ($result["jenis_biaya"] == "Sponsor") {
            $html = $this->load->view("view_pdf_2", array("result" => $result), true);
			}else if ($jenis_surat == "Surat_verbal") {
			$html = $this->load->view("view_pdf_15", array("result" => $result), true);
			}else{
			$html = $this->load->view("view_pdf_5", array("result" => $result), true);
			}
		}
		}else{
		if ($result['jenis_surat'] == "Surat Tugas") {
			if ($jenis_surat == "RAK") {
				$html = $this->load->view("surat", array("result" => $result), true);
			}else if ($jenis_surat == "Surat_verbal") {
			  $html = $this->load->view("view_pdf_15", array("result" => $result), true);
			}else if ($jenis_surat == "dft") {
				$html = $this->load->view("dftar", array("result" => $result), true);
			}else if ($jenis_surat == "Surat_pengantar") {
				$html = $this->load->view("view_pdf_11", array("result" => $result), true);
			}else if ($jenis_surat == "nota") {
				$html = $this->load->view("view_pdf_12", array("result" => $result), true);
			}else if ($jenis_surat == "ikatan") {
				$html = $this->load->view("view_pdf_13", array("result" => $result), true);
			}else{
                $html = $this->load->view("view_pdf_9", array("result" => $result), true);
			}
        } else if ($result['jenis_surat'] == "Surat Izin") {
			if ($jenis_surat == "Surat_pengantar") {
				$html = $this->load->view("view_pdf_11", array("result" => $result), true);
			}else if ($jenis_surat == "nota") {
				$html = $this->load->view("view_pdf_12", array("result" => $result), true);
			}else if ($jenis_surat == "ikatan") {
				$html = $this->load->view("view_pdf_13", array("result" => $result), true);
			}else if ($jenis_surat == "Surat_verbal") {
				$html = $this->load->view("view_pdf_15", array("result" => $result), true);
			}else{
				$html = $this->load->view("view_pdf_10", array("result" => $result), true);
			}
			}
		}
        
        echo $html;
        die;
    }

    public function cetak_get()
    {
        $id = $this->input->get("id");
        $jenis_surat = $this->input->get("surat");
		$kode = $this->input->get("kode");
        $results = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);
        // print_r($results);die;
        if (!empty($results)) {
            $result = $results[0];
            $createdby = $this->db->select("username")->where(array("id_user" => $result["createdby"]))->get("sys_user")->result_array();
            $updatedby = $this->db->select("username")->where(array("id_user" => $result["updatedby"]))->get("sys_user")->result_array();
            if (count($createdby) == 1) {
                $result["createdby"] = $createdby[0]["username"];
            }
            if (count($updatedby) == 1) {
                $result["updatedby"] = $updatedby[0]["username"];
            }
            $tanggal = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $result["id"]));
            $result["tanggal"] = $tanggal;
            $result["tanggal"]["tanggal_now"] = bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["tanggal"]["tanggal_from"] = date("d",strtotime($result["tanggal"][0]["tanggal_from"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_from"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_from"]));
			$result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            $result["tanggal"]["day_to"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_to"])));
            $result["tanggal"]["day_from"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_from"])));
            // print_r($result);die;
			$result["footer"]=false;
            $result["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($result["phl"]);
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            if(!empty($kode)){
			$result["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
			}
			foreach ($results as $key => $value) {
                $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                $result["count"] = count($result["detail"]);
				$result["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value["id"]));	
				$result["golongan"] = $this->Pengembangan_pelatihan_model->get_akomodasi("pengembangan_pelatihan_detail", array("golongan" => $result["detail"][$key]["golongan"], "pengembangan_pelatihan_id" => $value["id"]));	
				$result["count_golongan"] = count($result["golongan"]);
				$result["count_detail"] = count($result["detail_uraian"]);
				if (!empty($result["golongan"])) {
				foreach ($result["golongan"] as $key => $value){
				$count=count($result["golongan"]);
				$result["jumlah"] += $value["akomodasi"];
				}
				}
				
				//if (!empty($result["detail"])) {
                    //foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        //$result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
						//$result["count_detail"] = count($result["detail"][$key_detail_biaya]["detail_uraian"]);
                    //}
                //}
            }
        }
        print_r($result);die;
        $this->load->library("pdf");
        $data = "test";
		$kertas="A4";
		if ($result['jenis_perjalanan'] == "Dalam Negeri") {
        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
				}else if ($jenis_surat == "Surat_verbal") {
				  $html = $this->load->view("view_pdf_15", array("result" => $result), true);
				}else if ($jenis_surat == "dft") {
					$html = $this->load->view("dftar", array("result" => $result), true);
				}else{
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
				}
			} else if ($result["jenis"] == "Individu"){
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
				} else if ($jenis_surat == "Surat_verbal") {
				  $html = $this->load->view("view_pdf_15", array("result" => $result), true);
				}else{
                $html = $this->load->view("view_pdf_1", array("result" => $result), true);
				}
			}
        } else if ($result['jenis_surat'] == "Surat Izin") {
			if ($result["jenis_biaya"] == "Sponsor") {
            $html = $this->load->view("view_pdf_2", array("result" => $result), true);
			}else{
			$html = $this->load->view("view_pdf_5", array("result" => $result), true);
			}
			}
		}else{
		if ($result['jenis_surat'] == "Surat Tugas") {
			if ($jenis_surat == "RAK") {
				$html = $this->load->view("surat", array("result" => $result), true);
			}else if ($jenis_surat == "Surat_verbal") {
			  $html = $this->load->view("view_pdf_15", array("result" => $result), true);
			}else if ($jenis_surat == "dft") {
				$html = $this->load->view("dftar", array("result" => $result), true);
			}else if ($jenis_surat == "Surat_pengantar") {
				$html = $this->load->view("view_pdf_11", array("result" => $result), true);
			}else if ($jenis_surat == "nota") {
				$html = $this->load->view("view_pdf_12", array("result" => $result), true);
			}else if ($jenis_surat == "ikatan") {
				$html = $this->load->view("view_pdf_13", array("result" => $result), true);
			}else{
                $html = $this->load->view("view_pdf_9", array("result" => $result), true);
				$kertas="Legal";
			}
        } else if ($result['jenis_surat'] == "Surat Izin") {
            if ($jenis_surat == "Surat_pengantar") {
				$html = $this->load->view("view_pdf_11", array("result" => $result), true);
			}else if ($jenis_surat == "nota") {
				$html = $this->load->view("view_pdf_12", array("result" => $result), true);
			}else if ($jenis_surat == "ikatan") {
				$html = $this->load->view("view_pdf_13", array("result" => $result), true);
			}else{
				$html = $this->load->view("view_pdf_10", array("result" => $result), true);
				$kertas="Legal";
			}
		}
		}
        
        //echo $kertas;
        //die;

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper($kertas, ($orientation = "P" ));
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download ".$jenis_surat;
        $this->pdf->stream($name, array("Attachment" => 1));
        // return true;
    }

    public function preview_rekomendasi_get()
    {
        // echo date("d") ." ". bulan(date("m")) ." ". date("Y"); die();
        $id = $this->input->get("id");
		$kode = $this->input->get("kode");
		$results['result'] = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);
                // echo $this->db->last_query();die;
               // print_r($results);die;
                if (!empty($results['result'])) {
                    foreach ($results["result"] as $key => $value) {
						//print_r($results["result"][$key]["jenis_biaya"]);die;
						if ($results["result"][$key]["jenis_perjalanan"] != "Luar Negeri") {
						if ($results["result"][$key]["jenis_biaya"] == "Sponsor") {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						$results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["tanggal"]["now"] = bulan(date("m")) ." ". date("Y");
						$results["result"][$key]["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($results["result"][$key]["phl"]);
						$results["result"][$key]["tanggal"]["to"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]));
                        $results["result"][$key]["tanggal"]["from"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]));
						$results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        if (!empty($results["result"][$key]["detail"])) {
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
						//print_r($results["result"][$key]);die;
						$this->load->library("pdf");
                        $html = $this->load->view("view_pdf_3", array("result" => $results["result"][$key]), true);
                        echo $html;
                        die;
                     }
					}else{
						$createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						$results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["tanggal"]["now"] = bulan(date("m")) ." ". date("Y");
						$results["result"][$key]["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($results["result"][$key]["phl"]);
						$results["result"][$key]["tanggal"]["to"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]));
                        $results["result"][$key]["tanggal"]["from"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]));
						$results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        if (!empty($results["result"][$key]["detail"])) {
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
						//print_r($results["result"][$key]);die;
						$this->load->library("pdf");
                        $html = $this->load->view("view_pdf_3", array("result" => $results["result"][$key]), true);
                        echo $html;
                        die;
					}
                    }
                }


        
    }
	
	public function cetak_rekomendasi_get()
    {
        // echo date("d") ." ". bulan(date("m")) ." ". date("Y"); die();
        $id = $this->input->get("id");
		$kode = $this->input->get("kode");
		$results['result'] = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);
                // echo $this->db->last_query();die;
               // print_r($results);die;
                if (!empty($results['result'])) {
                    foreach ($results["result"] as $key => $value) {
						//print_r($results["result"][$key]["jenis_biaya"]);die;
						if ($results["result"][$key]["jenis_perjalanan"] != "Luar Negeri") {
						if ($results["result"][$key]["jenis_biaya"] == "Sponsor") {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						$results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["tanggal"]["now"] = bulan(date("m")) ." ". date("Y");
						$results["result"][$key]["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($results["result"][$key]["phl"]);
						$results["result"][$key]["tanggal"]["to"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]));
                        $results["result"][$key]["tanggal"]["from"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]));
						$results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        if (!empty($results["result"][$key]["detail"])) {
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
						//print_r($results["result"][$key]);die;
						$this->load->library("pdf");
                        $html = $this->load->view("view_pdf_3", array("result" => $results["result"][$key]), true);
                        //echo $html;
                        //die;
						$customPaper = array(0,0,210,330);
                        $this->pdf->loadHtml($html);
                        // $this->pdf->setPaper($customPaper);
                        $this->pdf->setPaper("legal", ($orientation = "P" ));
                        $this->pdf->set_option("isPhpEnabled", true);
                        $this->pdf->set_option("isHtml5ParserEnabled", true);
                        $this->pdf->set_option("isRemoteEnabled", true);
                        $this->pdf->render();
                        $name = "download rekomendasi";
                        $this->pdf->stream($name, array("Attachment" => 1));
                    
                     }
					}else{
						$createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						$results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["tanggal"]["now"] = bulan(date("m")) ." ". date("Y");
						$results["result"][$key]["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($results["result"][$key]["phl"]);
						$results["result"][$key]["tanggal"]["to"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]));
                        $results["result"][$key]["tanggal"]["from"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]));
						$results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        if (!empty($results["result"][$key]["detail"])) {
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
						//print_r($results["result"][$key]);die;
						$this->load->library("pdf");
                        $html = $this->load->view("view_pdf_3", array("result" => $results["result"][$key]), true);
                        //echo $html;
                        //die;
						$customPaper = array(0,0,210,330);
                        $this->pdf->loadHtml($html);
                        // $this->pdf->setPaper($customPaper);
                        $this->pdf->setPaper("legal", ($orientation = "P" ));
                        $this->pdf->set_option("isPhpEnabled", true);
                        $this->pdf->set_option("isHtml5ParserEnabled", true);
                        $this->pdf->set_option("isRemoteEnabled", true);
                        $this->pdf->render();
                        $name = "download rekomendasi";
                        $this->pdf->stream($name, array("Attachment" => 1));
                    
					}
                     }
                    }


        
    }

	public function preview_spd_get()
    {
        // echo date("d") ." ". bulan(date("m")) ." ". date("Y"); die();
        $id = $this->input->get("id");
		$kode = $this->input->get("kode");
		$results['result'] = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);

        // $html = $this->load->view("view_pdf_4");
        //                 echo $html;
        //                 die;
                // echo $this->db->last_query();die;
               // print_r($results);die;
                if (!empty($results['result'])) {
					$results["result"][0]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail_spd("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $id));	
						$results["result"][0]["count_detail"] = count($results["result"][0]["detail_uraian"]);
						if (!empty($results["result"][0]["detail_uraian"])) {
						foreach ($results["result"][0]["detail_uraian"] as $key => $value){
						$jum=count($results["result"][0]["detail_uraian"]);
						if($jum==1){
						$result["tota"] = $value["total"];
						}else{
						$result["tota_1"] += $value["total"];
						}
						}
						}
						//echo $result["jumlah"];die();
						if($jum==1){
						$results["result"][0]["total"] = $result["tota"]+($results["result"][0]["jumlah"]);
						$results["result"][0]["total_biaya"] = terbilang($results["result"][0]["total"]);
						}else{
						$results["result"][0]["total"] = ($result["tota_1"])+$results["result"][0]["jumlah"];
						$results["result"][0]["total_biaya"] = terbilang($results["result"][0]["total"]);
						}
                    foreach ($results["result"] as $key => $value) {
						//print_r($results["result"][$key]["jenis_biaya"]);die;
						//if ($results["result"][$key]["jenis_biaya"] == "BLU") {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						$results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["tanggal"]["now"] = bulan(date("m")) ." ". date("Y");
						$results["result"][$key]["tanggal"]["from"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]));
						$results["result"][$key]["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($results["result"][$key]["phl"]);
						$results["result"][$key]["tanggal"]["to"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]));
                        $results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
						$results["result"][$key]["count"] = count($results["result"][$key]["detail"]);
						//if (!empty($result["detail"])) {
						//if (!empty($results["result"][$key]["detail"])) {
                            
                        //    foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        //        $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                        //    }
                        //}
						//print_r($results["result"][$key]['total_biaya']);die;
						$this->load->library("pdf");
                        if ($results["result"][$key]['jenis_perjalanan'] == "Dalam Negeri") {
						$html = $this->load->view("view_pdf_4", array("result" => $results["result"][$key]), true);
                        }else{
						$html = $this->load->view("view_pdf_14", array("result" => $results["result"][$key]), true);
						}
						echo $html;
                        die;
					//}
                    }
                }


        
    }
	
	public function cetak_spd_get()
    {
        // echo date("d") ." ". bulan(date("m")) ." ". date("Y"); die();
        $id = $this->input->get("id");
		$kode = $this->input->get("kode");
		$results['result'] = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);

        // $html = $this->load->view("view_pdf_4");
        //                 echo $html;
        //                 die;
                // echo $this->db->last_query();die;
               // print_r($results);die;
                if (!empty($results['result'])) {
						$results["result"][0]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail_spd("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $id));	
						$results["result"][0]["count_detail"] = count($results["result"][0]["detail_uraian"]);
						if (!empty($results["result"][0]["detail_uraian"])) {
						foreach ($results["result"][0]["detail_uraian"] as $key => $value){
						$jum=count($results["result"][0]["detail_uraian"]);
						if($jum==1){
						$result["tota"] = $value["total"];
						}else{
						$result["tota_1"] += $value["total"];
						}
						}
						}
						//echo $result["jumlah"];die();
						if($jum==1){
						$results["result"][0]["total"] = $result["tota"]+($results["result"][0]["jumlah"]);
						$results["result"][0]["total_biaya"] = terbilang($results["result"][0]["total"]);
						}else{
						$results["result"][0]["total"] = ($result["tota_1"])+$results["result"][0]["jumlah"];
						$results["result"][0]["total_biaya"] = terbilang($results["result"][0]["total"]);
						}
                    foreach ($results["result"] as $key => $value) {
						//print_r($results["result"][$key]["jenis_biaya"]);die;
						if ($results["result"][$key]["jenis_biaya"] == "BLU") {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						$results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["tanggal"]["now"] = bulan(date("m")) ." ". date("Y");
						$results["result"][$key]["tanggal"]["from"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_from"]));
						$results["result"][$key]["tanggal"]["to"] = date("d",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))." ".bulan(date("m",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]))) ." ".date("Y",strtotime($results["result"][$key]["tanggal"][$key]["tanggal_to"]));
                        $results["result"][$key]["aprove_phl"] = $this->Pengembangan_pelatihan_model->get_phl($results["result"][$key]["phl"]);
						$results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
						$results["result"][$key]["count"] = count($results["result"][$key]["detail"]);
						
						//print_r($results["result"][$key]);die;
						$this->load->library("pdf");
                        if ($results["result"][$key]['jenis_perjalanan'] == "Dalam Negeri") {
						$html = $this->load->view("view_pdf_4", array("result" => $results["result"][$key]), true);
                        $kertas="Legal";
						}else{
						$html = $this->load->view("view_pdf_14", array("result" => $results["result"][$key]), true);
						$kertas="Legal";
						}// echo $html;
                        // die;
                        $customPaper = array(0,0,210,330);
                        $this->pdf->loadHtml($html);
                        // $this->pdf->setPaper($customPaper);
                        $this->pdf->setPaper($kertas, ($orientation = "P" ));
                        $this->pdf->set_option("isPhpEnabled", true);
                        $this->pdf->set_option("isHtml5ParserEnabled", true);
                        $this->pdf->set_option("isRemoteEnabled", true);
                        $this->pdf->render();
                        $name = "download SPD";
                        $this->pdf->stream($name, array("Attachment" => 1));
                    }
                    }
                }


        
    }

	public function preview_laporan_get()
    {
		$offset = 0;
		$filt="pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan_detail.id ,pengembangan_pelatihan.id, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nama_pegawai";
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$jenis_perjalanan = $this->input->get("jenis_perjalanan");
		$kegiatan = $this->input->get("kegiatan");
        $jenis_surat = $this->input->get("surat");
        $result['result'] = $this->Pengembangan_pelatihan_model->get_new(null, $nopeg, $offset, null, $from, $to, null, null, $filt, $unit, $kegiatan, $jenis, $jenis_perjalanan);
        if (!empty($result['result'])) {
           foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		}
		}
		//print_r($jenis_perjalanan);die();
		$data = "test";
		if($jenis_surat=="laporan1"){
		$html = $this->load->view("laporan/laporan_1", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan3"){
		$html = $this->load->view("laporan/laporan_3", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan5"){
		$html = $this->load->view("laporan/laporan_5", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan18"){
		$html = $this->load->view("laporan/laporan_18", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan19"){
		$html = $this->load->view("laporan/laporan_19", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan7"){
		$html = $this->load->view("laporan/laporan_7", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan8"){
		$html = $this->load->view("laporan/laporan_8", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan16"){
		$html = $this->load->view("laporan/laporan_16", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan017"){
		$html = $this->load->view("laporan/laporan_017", array("result" => $result['result']), true);
        }
        echo $html;
        die;
    }
	
	public function cetak_laporan_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
        $nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		if (!empty($this->input->get("jenis"))) {
		$jenis = $this->input->get("jenis");
		}else{
		$jenis =null;
		}
		$jenis_perjalanan = $this->input->get("jenis_perjalanan");
		$kegiatan = $this->input->get("kegiatan");
		$filt="pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan_detail.id ,pengembangan_pelatihan.id, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nama_pegawai";
        $jenis_surat = $this->input->get("surat");
		//print_r($result['result']);die();
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get_new(null, $nopeg, $offset, null, $from, $to, null, null, $filt, $unit, $kegiatan, $jenis, $jenis_perjalanan);
        if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		$result["result"][0]["awal"]=$from;
		$result["result"][0]["akhir"]=$to;
		}
		//print_r($result['result']);die();
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		if($jenis_surat=="laporan1"){
		$html = $this->load->view("laporan/laporan_1", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan3"){
		$html = $this->load->view("laporan/laporan_3", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan5"){
		$html = $this->load->view("laporan/laporan_5", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan18"){
		$html = $this->load->view("laporan/laporan_18", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan19"){
		$html = $this->load->view("laporan/laporan_19", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan7"){
		$html = $this->load->view("laporan/laporan_7", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan8"){
		$html = $this->load->view("laporan/laporan_8", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan16"){
		$html = $this->load->view("laporan/laporan_16", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan017"){
		$html = $this->load->view("laporan/laporan_017", array("result" => $result['result']), true);
        }
        //echo $html;
        //die;
		//$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("A4",'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        }            
    }
	
	public function preview_laporan_jpl_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$kegiatan = $this->input->get("kegiatan");
        $jenis_surat = $this->input->get("surat");
        $filtr = "pengembangan_pelatihan.total_hari_kerja,sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup, pengembangan_pelatihan_detail.nama_pegawai, pengembangan_pelatihan_detail.nopeg";
        $result['result'] = $this->Pengembangan_pelatihan_model->get_jpl(null, $nopeg, $offset, null, $from, $to, null, null, $filtr, $unit, $kegiatan, $jenis);
        if (!empty($result['result'])) {
           foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		}
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		if($jenis_surat=="laporan18"){
		$html = $this->load->view("laporan/laporan_18", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan19"){
		$html = $this->load->view("laporan/laporan_19", array("result" => $result['result']), true);
        }
        echo $html;
        die;
    }
	
	public function cetak_laporan_jpl_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
        $nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$kegiatan = $this->input->get("kegiatan");
		$jenis_surat = $this->input->get("surat");
		$filtr = "pengembangan_pelatihan.total_hari_kerja,sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup, pengembangan_pelatihan_detail.nama_pegawai, pengembangan_pelatihan_detail.nopeg";
        
		//print_r($jenis_surat);die();
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get_jpl(null, $nopeg, $offset, null, $from, $to, null, null, $filtr, $unit, $kegiatan, $jenis);
        if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		$result["result"][0]["awal"]=$from;
		$result["result"][0]["akhir"]=$to;
		}
		
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		if($jenis_surat=="laporan18"){
		$html = $this->load->view("laporan/laporan_18", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan19"){
		$html = $this->load->view("laporan/laporan_19", array("result" => $result['result']), true);
        }
        //echo $html;
        //die;
		//$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("A4",'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        }            
    }
	
	public function preview_laporan_del_get()
    {
		$offset = 0;
		$filt="pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan_detail.id ,pengembangan_pelatihan.id, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nama_pegawai";
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$kegiatan = $this->input->get("kegiatan");
        $jenis_surat = $this->input->get("surat");
        $result['result'] = $this->Pengembangan_pelatihan_model->get_new_del(null, $nopeg, $offset, null, $from, $to, null, null, $filt, $unit, $kegiatan, $jenis);
        if (!empty($result['result'])) {
           foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		}
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		if($jenis_surat=="laporan14"){
		$html = $this->load->view("laporan/laporan_14", array("result" => $result['result']), true);
        }
        echo $html;
        die;
    }
	
	public function cetak_laporan_del_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
        $nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$kegiatan = $this->input->get("kegiatan");
		$filt="pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan_detail.id ,pengembangan_pelatihan.id, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nama_pegawai";
        $jenis_surat = $this->input->get("surat");
		//print_r($jenis_surat);die();
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get_new(null, $nopeg, $offset, null, $from, $to, null, null, $filt, $unit, $kegiatan, $jenis);
        if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		$result["result"][0]["awal"]=$from;
		$result["result"][0]["akhir"]=$to;
		}
		
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		if($jenis_surat=="laporan14"){
		$html = $this->load->view("laporan/laporan_14", array("result" => $result['result']), true);
        }
        //echo $html;
        //die;
		//$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("A4",'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        }            
    }
	
	public function preview_laporan2_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$unit = $this->input->get("unit_ker");
		$jenis1 = $this->input->get("jenis1");
		$kegiatan1 = $this->input->get("kegiatan1");
		$jenis_surat = $this->input->get("surat");
		if($jenis_surat=="laporan9"){
		$group="m_kode_profesi_group.ds_group_jabatan";
		$filt="m_kode_profesi_group.ds_group_jabatan";
		$as="m_kode_profesi_group.ds_group_jabatan as profesi";
		$pegawai="m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_kegiatan.nama";
		$pegawai_filter="m_kode_profesi_group.ds_group_jabatan as profesi, pengembangan_pelatihan_kegiatan.nama as kegiatan, sum(pengembangan_pelatihan_detail.uraian_total) as nominal, sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum";
		$id="profesi";
		}else if ($jenis_surat=="laporan10"){
		$group="pengembangan_pelatihan_kegiatan.nama";
		$as="pengembangan_pelatihan_kegiatan.nama as nama_kegiatan";
		$filt="pengembangan_pelatihan_kegiatan.nama";
		$pegawai="pengembangan_pelatihan_kegiatan.nama, m_kode_profesi_group.ds_group_jabatan, m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_kegiatan.nama";
		$pegawai_filter="pengembangan_pelatihan_kegiatan.nama as nama_kegiatan, m_kode_profesi_group.ds_group_jabatan as profesi,m_kode_profesi_group.ds_group_jabatan as profesi, pengembangan_pelatihan_kegiatan.nama as kegiatan, sum(pengembangan_pelatihan_detail.uraian_total) as nominal, sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum";
		$id="nama_kegiatan";
		}else if ($jenis_surat=="laporan6"){
		$group="pengembangan_pelatihan_kegiatan.nama";
		$filt="pengembangan_pelatihan_kegiatan.nama";
		$as="pengembangan_pelatihan_kegiatan.nama as nama_kegiatan";
		$pegawai="pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan_kegiatan_status.nama,pengembangan_pelatihan.id,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$pegawai_filter="pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan_kegiatan_status.nama as status,pengembangan_pelatihan.id,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total as nominal,pengembangan_pelatihan.total_hari_kerja";
		$id="nama_kegiatan";
		}
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get2(null, $unit, $offset, null, $from, $to, null, null, $group, $as, $kegiatan1, $jenis1);
        //print_r($result['result']);die();
		if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $val) {
		$params_array=array($filt => $val[$id]);
		//print_r($result['result']);die();
		$filter="$group,pengembangan_pelatihan.total_hari_kerja";
		$result["result"][$key]["kegiatan"] = $this->Pengembangan_pelatihan_model->get_kegiatan($params_array, $unit, $offset, null, $from, $to, null, null, $filter, $as, $kegiatan1, $jenis1);
		$result["result"][$key]["pegawai"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $pegawai,$pegawai_filter, $unit, $kegiatan1, $jenis1);
		//print_r($result["result"][$key]["status"]);die();
		$result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["id"]);
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        }
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		if($jenis_surat=="laporan9"){
		$html = $this->load->view("laporan/laporan_9", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan6"){
		$html = $this->load->view("laporan/laporan_6", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan10"){
		$html = $this->load->view("laporan/laporan_10", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan14"){
		$html = $this->load->view("laporan/laporan_14", array("result" => $result['result']), true);
        }
        echo $html;
        die;
    }
	
	
	public function cetak_laporan2_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$unit = $this->input->get("unit_ker");
		$jenis_surat = $this->input->get("surat");
		$jenis1 = $this->input->get("jenis1");
		$kegiatan1 = $this->input->get("kegiatan1");
		if($jenis_surat=="laporan9"){
		$group="m_kode_profesi_group.ds_group_jabatan";
		$filt="m_kode_profesi_group.ds_group_jabatan";
		$as="m_kode_profesi_group.ds_group_jabatan as profesi";
		$pegawai="m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_kegiatan.nama";
		$pegawai_filter="m_kode_profesi_group.ds_group_jabatan as profesi, pengembangan_pelatihan_kegiatan.nama as kegiatan, sum(pengembangan_pelatihan_detail.uraian_total) as nominal, sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum";
		$id="profesi";
		}else if ($jenis_surat=="laporan10"){
		$group="pengembangan_pelatihan_kegiatan.nama";
		$as="pengembangan_pelatihan_kegiatan.nama as nama_kegiatan";
		$filt="pengembangan_pelatihan_kegiatan.nama";
		$pegawai="pengembangan_pelatihan_kegiatan.nama, m_kode_profesi_group.ds_group_jabatan, m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_kegiatan.nama";
		$pegawai_filter="pengembangan_pelatihan_kegiatan.nama as nama_kegiatan, m_kode_profesi_group.ds_group_jabatan as profesi,m_kode_profesi_group.ds_group_jabatan as profesi, pengembangan_pelatihan_kegiatan.nama as kegiatan, sum(pengembangan_pelatihan_detail.uraian_total) as nominal, sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum";
		$id="nama_kegiatan";
		}else if ($jenis_surat=="laporan6"){
		$group="pengembangan_pelatihan_kegiatan.nama";
		$filt="pengembangan_pelatihan_kegiatan.nama";
		$as="pengembangan_pelatihan_kegiatan.nama as nama_kegiatan";
		$pegawai="pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan_kegiatan_status.nama,pengembangan_pelatihan.id,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$pegawai_filter="pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan_kegiatan_status.nama as status,pengembangan_pelatihan.id,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total as nominal,pengembangan_pelatihan.total_hari_kerja";
		$id="nama_kegiatan";
		}
		
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get2(null, $unit, $offset, null, $from, $to, null, null, $group, $as, $kegiatan1, $jenis1);
        //print_r($result['result']);die();
		if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $val) {
		$params_array=array($filt => $val[$id]);
		
		$filter="$group,pengembangan_pelatihan.id,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,m_kode_profesi_group.ds_group_jabatan";
		$result["result"][$key]["kegiatan"] = $this->Pengembangan_pelatihan_model->get_kegiatan($params_array, $unit, $offset, null, $from, $to, null, null, $filter, $as, $kegiatan1, $jenis1);
		$result["result"][$key]["pegawai"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $pegawai,$pegawai_filter, $unit, $kegiatan1, $jenis1);
		//print_r($result["result"][$key]["status"]);die();
		$result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["id"]);                
		$result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		$result["result"][0]["awal"]=$from;
		$result["result"][0]["akhir"]=$to;
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		if($jenis_surat=="laporan9"){
		$html = $this->load->view("laporan/laporan_9", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan6"){
		$html = $this->load->view("laporan/laporan_6", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan10"){
		$html = $this->load->view("laporan/laporan_10", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan14"){
		$html = $this->load->view("laporan/laporan_14", array("result" => $result['result']), true);
        }
         //echo $html;
        //die;
		$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("A4", 'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        
		}
    }
	
	
	public function preview_laporan3_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$jenis_surat = $this->input->get("surat");
		$filt="sys_grup_user.grup";
		$pegawai="pengembangan_pelatihan.nama_pelatihan, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup,pengembangan_pelatihan_detail_biaya.nominal,pengembangan_pelatihan.total_hari_kerja";
		$pelatihan="pengembangan_pelatihan.nama_pelatihan, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup,pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$as_4="pengembangan_pelatihan.nama_pelatihan,m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup,sum(pengembangan_pelatihan_detail.uraian_total) as uraian_total,sum(pengembangan_pelatihan.total_hari_kerja) as total_hari_kerja";
		$detail_4="pengembangan_pelatihan.nama_pelatihan,m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup";
		$detail="pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup";
		$jenis="m_kode_profesi_group.ds_group_jabatan, sys_grup_user.grup";
		$as="sys_grup_user.grup, pengembangan_pelatihan_detail.nama_pegawai,m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan.nama_pelatihan";
		$id="grup";
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get3(null, null, $offset, null, $from, $to, null, null, $filt, $filt);
        //print_r($result['result']);die();
		if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $val) {
		$params_array=array($filt => $val[$id]);
		$result["result"][$key]["pelatihan"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $pelatihan, $pelatihan);
		$result["result"][$key]["detail_pegawai"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $detail, $detail);
		$result["result"][$key]["total_pegawai"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $detail_4, $as_4);
		$result["result"][$key]["jenis"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $jenis, $jenis);
		$result["result"][$key]["pegawai"] = $this->Pengembangan_pelatihan_model->get6($params_array, null, $offset, null, $from, $to, null, null, $pegawai, $pegawai);
		
		//print_r($result["result"][$key]["pelatihan"]);die();
		$result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["id"]);                
		$result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		}
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		if($jenis_surat=="lapor12"){
		$html = $this->load->view("laporan/laporan_11", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan12"){
		$html = $this->load->view("laporan/laporan_12", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan13"){
		$html = $this->load->view("laporan/laporan_13", array("result" => $result['result']), true);
        }
        echo $html;
        die;
    }
	
	public function cetak_laporan3_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$jenis_surat = $this->input->get("surat");
		$filt="sys_grup_user.grup";
		$pegawai="pengembangan_pelatihan.nama_pelatihan, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup,pengembangan_pelatihan_detail_biaya.nominal,pengembangan_pelatihan.total_hari_kerja";
		$pelatihan="pengembangan_pelatihan.nama_pelatihan, m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup,pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$as_4="pengembangan_pelatihan.nama_pelatihan,m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup,sum(pengembangan_pelatihan_detail.uraian_total) as uraian_total,sum(pengembangan_pelatihan.total_hari_kerja) as total_hari_kerja";
		$detail_4="pengembangan_pelatihan.nama_pelatihan,m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup";
		$detail="pengembangan_pelatihan_detail.nama_pegawai, sys_grup_user.grup";
		$jenis="m_kode_profesi_group.ds_group_jabatan, sys_grup_user.grup";
		$as="sys_grup_user.grup, pengembangan_pelatihan_detail.nama_pegawai,m_kode_profesi_group.ds_group_jabatan,pengembangan_pelatihan.nama_pelatihan";
		$id="grup";
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get3(null, null, $offset, null, $from, $to, null, null, $filt, $filt);
        //print_r($result['result']);die();
		if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $val) {
		$params_array=array($filt => $val[$id]);
		$result["result"][$key]["pelatihan"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $pelatihan, $pelatihan);
		$result["result"][$key]["detail_pegawai"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $detail, $detail);
		$result["result"][$key]["total_pegawai"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $detail_4, $as_4);
		$result["result"][$key]["jenis"] = $this->Pengembangan_pelatihan_model->get5($params_array, null, $offset, null, $from, $to, null, null, $jenis, $jenis);
		$result["result"][$key]["pegawai"] = $this->Pengembangan_pelatihan_model->get6($params_array, null, $offset, null, $from, $to, null, null, $pegawai, $pegawai);
		
		//print_r($result["result"][$key]["pelatihan"]);die();
		$result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["id"]);                
		$result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		$result["result"][0]["awal"]=$from;
		$result["result"][0]["akhir"]=$to;
		}
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		if($jenis_surat=="lapor12"){
		$html = $this->load->view("laporan/laporan_11", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan12"){
		$html = $this->load->view("laporan/laporan_12", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan13"){
		$html = $this->load->view("laporan/laporan_13", array("result" => $result['result']), true);
        }
         //echo $html;
        //die;
		$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("A4", 'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        
    }
	
	public function preview_laporan4_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$no_peg = $this->input->get("no_peg");
		$jenis_surat = $this->input->get("surat");
		$filt="m_kode_profesi_group.ds_group_jabatan";
		$jenis="m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_kegiatan.nama";
		$kegiatan="pengembangan_pelatihan_kegiatan.nama";
		$pelatihan="pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan_kegiatan_status.nama,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan_detail.nama_pegawai, m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$pelatihan_as="pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan_kegiatan_status.nama as status,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan_detail.nama_pegawai, m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$id="ds_group_jabatan";
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get3(null, $no_peg, $offset, null, $from, $to, null, null, $filt, $filt);
        //print_r($result['result']);die();
		if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $val) {
		$params_array=array($filt => $val[$id]);
		$result["result"][$key]["kegiatan"] = $this->Pengembangan_pelatihan_model->get3($params_array, $no_peg, $offset, null, $from, $to, null, null, $pelatihan, $pelatihan_as);
		if (!empty($result["result"][$key]["kegiatan"])) {
            foreach ($result["result"][$key]["kegiatan"] as $keya => $value) {
		$params=array('pengembangan_pelatihan_kegiatan.nama' => $value["nama"]);
		$array=$val[$id];
		$result["result"][$key]["pelatihan"] = $this->Pengembangan_pelatihan_model->get7($params, $no_peg, $offset, null, $from, $to, null, null, $pelatihan, $pelatihan_as, $array);
		$result["result"][$key]["baru"] = $this->Pengembangan_pelatihan_model->get5($params, $no_peg, $offset, null, $from, $to, null, null, $kegiatan, $kegiatan);
		}
		}
		//print_r($result["result"][$key]["pelatihan"]);die();
		$result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["id"]);                
		$result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		}
		}
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		if($jenis_surat=="laporan2"){
		$html = $this->load->view("laporan/laporan_2", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan4"){
		$html = $this->load->view("laporan/laporan_4", array("result" => $result['result']), true);
        }
		
        echo $html;
        die;
    }
	
	public function cetak_laporan4_get()
    {
		$offset = 0;
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$no_peg = $this->input->get("no_peg");
		$jenis_surat = $this->input->get("surat");
		$filt="m_kode_profesi_group.ds_group_jabatan";
		$jenis="m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_kegiatan.nama";
		$kegiatan="pengembangan_pelatihan_kegiatan.nama";
		$pelatihan="pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan_kegiatan_status.nama,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan_detail.nama_pegawai, m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$pelatihan_as="pengembangan_pelatihan_kegiatan.nama,pengembangan_pelatihan_kegiatan_status.nama as status,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan_detail.nama_pegawai, m_kode_profesi_group.ds_group_jabatan, pengembangan_pelatihan_detail.uraian_total,pengembangan_pelatihan.total_hari_kerja";
		$id="ds_group_jabatan";
		
        $result['result'] = $this->Pengembangan_pelatihan_model->get3(null, $no_peg, $offset, null, $from, $to, null, null, $filt, $filt);
        //print_r($result['result']);die();
		if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $val) {
		$params_array=array($filt => $val[$id]);
		$result["result"][$key]["kegiatan"] = $this->Pengembangan_pelatihan_model->get3($params_array, $no_peg, $offset, null, $from, $to, null, null, $jenis, $jenis);
		if (!empty($result["result"][$key]["kegiatan"])) {
            foreach ($result["result"][$key]["kegiatan"] as $keya => $value) {
		$params=array('pengembangan_pelatihan_kegiatan.nama' => $value["nama"]);
		$array=$val[$id];
		$result["result"][$key]["pelatihan"] = $this->Pengembangan_pelatihan_model->get7($params, $no_peg, $offset, null, $from, $to, null, null, $pelatihan, $pelatihan_as, $array);
		$result["result"][$key]["baru"] = $this->Pengembangan_pelatihan_model->get5($params, $no_peg, $offset, null, $from, $to, null, null, $kegiatan, $kegiatan);
		}
		}
		$result["result"][0]["awal"]=$from;
		$result["result"][0]["akhir"]=$to;
		$result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["id"]);                
		$result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
		}
		
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		if($jenis_surat=="laporan2"){
		$html = $this->load->view("laporan/laporan_2", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan4"){
		$html = $this->load->view("laporan/laporan_4", array("result" => $result['result']), true);
        }
		
         //echo $html;
        //die;
		$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("A4",'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        
		}
    }
	
	public function preview_laporan5_get()
    {
		$offset = 0;
		$bulan="pengembangan_pelatihan_pelaksanaan.tanggal_too";
		$bulan_as="DISTINCT EXTRACT(month from pengembangan_pelatihan_pelaksanaan.tanggal_too) as tanggal";
		$filt="pengembangan_pelatihan.jenis_perjalanan, pengembangan_pelatihan_pelaksanaan.tanggal_too, pengembangan_pelatihan_kegiatan.nama";
		$as="sum(pengembangan_pelatihan_detail.uraian_total) as nominal, count(pengembangan_pelatihan_kegiatan.nama) as jum, pengembangan_pelatihan.jenis_perjalanan, pengembangan_pelatihan_pelaksanaan.tanggal_too, pengembangan_pelatihan_kegiatan.nama, EXTRACT(month from pengembangan_pelatihan_pelaksanaan.tanggal_too) as tanggal";
		$fil_as="sum(pengembangan_pelatihan_detail.uraian_total) as nominal, count(pengembangan_pelatihan_kegiatan.nama) as jum";
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$workshop = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'1', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$jenis_perjalanan = array("pengembangan_pelatihan.jenis_perjalanan" => 'Luar Negeri');
		$dalam = array("pengembangan_pelatihan.dalam_negeri"=>'Luar Kota');
		$kegiatan = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'7', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$managerial = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'2', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$tamu = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'9', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$inhouse = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'4', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$pendidikan = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'3', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$luar = array("pengembangan_pelatihan.jenis_perjalanan"=>'Luar Negeri');
        $jenis_surat = $this->input->get("surat");
        $result['result'] = $this->Pengembangan_pelatihan_model->get_5(null, $nopeg, $offset, null, $from, $to, null, null, $bulan, $bulan_as, $unit, null, null);
        if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $value) {
		$unit=$value['tanggal'];
		$result['result'][$key]['dik'] = $this->Pengembangan_pelatihan_model->get_5($kegiatan, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['dik'])) {
            foreach ($result['result'][$key]['dik'] as $key_dik => $value_dik) {
		$result['result'][$key]['diklat']['jum'] = $value_dik['jum'];
		$result['result'][$key]['diklat']['nominal'] = $value_dik['nominal'];
		}
		}
		$result['result'][$key]['manag'] = $this->Pengembangan_pelatihan_model->get_5($managerial, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['manag'])) {
            foreach ($result['result'][$key]['manag'] as $key_manag => $value_manag) {
		$result['result'][$key]['managerial']['jum'] = $value_manag['jum'];
		$result['result'][$key]['managerial']['nominal'] = $value_manag['nominal'];
		}
		}
		$result['result'][$key]['work'] = $this->Pengembangan_pelatihan_model->get_5($workshop, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['work'])) {
            foreach ($result['result'][$key]['work'] as $key_work => $value_work) {
		$result['result'][$key]['workshop']['jum'] = $value_work['jum'];
		$result['result'][$key]['workshop']['nominal'] = $value_work['nominal'];
		}
		}
		$result['result'][$key]['in'] = $this->Pengembangan_pelatihan_model->get_5($inhouse, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['in'])) {
            foreach ($result['result'][$key]['in'] as $key_in => $value_in) {
		$result['result'][$key]['inhouse']['jum'] = $value_in['jum'];
		$result['result'][$key]['inhouse']['nominal'] = $value_in['nominal'];
		}
		}
		$result['result'][$key]['pen'] = $this->Pengembangan_pelatihan_model->get_5($pendidikan, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['pen'])) {
            foreach ($result['result'][$key]['pen'] as $key_pen => $value_pen) {
		$result['result'][$key]['pendidikan']['jum'] = $value_pen['jum'];
		$result['result'][$key]['pendidikan']['nominal'] = $value_pen['nominal'];
		}
		}
		$result['result'][$key]['lu'] = $this->Pengembangan_pelatihan_model->get_5($luar, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['lu'])) {
            foreach ($result['result'][$key]['lu'] as $key_lu => $value_lu) {
		$result['result'][$key]['luar']['jum'] = $value_lu['jum'];
		$result['result'][$key]['luar']['nominal'] = $value_lu['nominal'];
		}
		}
		$result['result'][$key]['tam'] = $this->Pengembangan_pelatihan_model->get_5($tamu, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['tam'])) {
            foreach ($result['result'][$key]['tam'] as $key_tam => $value_tam) {
		$result['result'][$key]['tamu']['jum'] = $value_tam['jum'];
		$result['result'][$key]['tamu']['nominal'] = $value_tam['nominal'];
		}
		}
		$result['result'][$key]['tot'] = $this->Pengembangan_pelatihan_model->get_5(null, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['tot'])) {
            foreach ($result['result'][$key]['tot'] as $key_tot => $value_tot) {
		$result['result'][$key]['total']['jum'] = $value_tot['jum'];
		$result['result'][$key]['total']['nominal'] = $value_tot['nominal'];
		}
		}
		$result['result'][$key]['jum_tot'] = $this->Pengembangan_pelatihan_model->get_5($jenis_perjalanan, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['jum_tot'])) {
            foreach ($result['result'][$key]['jum_tot'] as $key_jum_tot => $value_jum_tot) {
		$result['result'][$key]['jum_total']['jum'] = $value_jum_tot['jum'];
		$result['result'][$key]['jum_total']['nominal'] = $value_jum_tot['nominal'];
		}
		}
		$result['result'][$key]['dal'] = $this->Pengembangan_pelatihan_model->get_5($dalam, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['dal'])) {
            foreach ($result['result'][$key]['dal'] as $key_dal => $value_dal) {
		$result['result'][$key]['dalam']['jum'] = $value_dal['jum'];
		$result['result'][$key]['dalam']['nominal'] = $value_dal['nominal'];
		}
		}
		}
		}//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$html = $this->load->view("laporan/laporan_17", array("result" => $result['result']), true);
        
        echo $html;
        die;
    }
	
	public function cetak_laporan5_get()
    {
		$offset = 0;
		$bulan="pengembangan_pelatihan_pelaksanaan.tanggal_too";
		$bulan_as="DISTINCT EXTRACT(month from pengembangan_pelatihan_pelaksanaan.tanggal_too) as tanggal";
		$filt="pengembangan_pelatihan.jenis_perjalanan, pengembangan_pelatihan_pelaksanaan.tanggal_too, pengembangan_pelatihan_kegiatan.nama";
		$as="sum(pengembangan_pelatihan_detail.uraian_total) as nominal, count(pengembangan_pelatihan_kegiatan.nama) as jum, pengembangan_pelatihan.jenis_perjalanan, pengembangan_pelatihan_pelaksanaan.tanggal_too, pengembangan_pelatihan_kegiatan.nama, EXTRACT(month from pengembangan_pelatihan_pelaksanaan.tanggal_too) as tanggal";
		$fil_as="sum(pengembangan_pelatihan_detail.uraian_total) as nominal, count(pengembangan_pelatihan_kegiatan.nama) as jum";
		$from = $this->input->get("awal");
        $to = $this->input->get("akhir");
		$nopeg = $this->input->get("nopeg");
		$unit = $this->input->get("unit");
		$jenis = $this->input->get("jenis");
		$workshop = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'1', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$jenis_perjalanan = array("pengembangan_pelatihan.jenis_perjalanan" => 'Luar Negeri');
		$dalam = array("pengembangan_pelatihan.dalam_negeri"=>'Luar Kota');
		$kegiatan = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'7', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$managerial = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'2', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$tamu = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'9', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$inhouse = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'4', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$pendidikan = array("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan"=>'3', "pengembangan_pelatihan.jenis_perjalanan"=>'Dalam Negeri');
		$luar = array("pengembangan_pelatihan.jenis_perjalanan"=>'Luar Negeri');
        $jenis_surat = $this->input->get("surat");
        $result['result'] = $this->Pengembangan_pelatihan_model->get_5(null, $nopeg, $offset, null, $from, $to, null, null, $bulan, $bulan_as, $unit, null, null);
        if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $value) {
		$unit=$value['tanggal'];
		$result['result'][$key]['dik'] = $this->Pengembangan_pelatihan_model->get_5($kegiatan, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['dik'])) {
            foreach ($result['result'][$key]['dik'] as $key_dik => $value_dik) {
		$result['result'][$key]['diklat']['jum'] = $value_dik['jum'];
		$result['result'][$key]['diklat']['nominal'] = $value_dik['nominal'];
		}
		}
		$result['result'][$key]['manag'] = $this->Pengembangan_pelatihan_model->get_5($managerial, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['manag'])) {
            foreach ($result['result'][$key]['manag'] as $key_manag => $value_manag) {
		$result['result'][$key]['managerial']['jum'] = $value_manag['jum'];
		$result['result'][$key]['managerial']['nominal'] = $value_manag['nominal'];
		}
		}
		$result['result'][$key]['work'] = $this->Pengembangan_pelatihan_model->get_5($workshop, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['work'])) {
            foreach ($result['result'][$key]['work'] as $key_work => $value_work) {
		$result['result'][$key]['workshop']['jum'] = $value_work['jum'];
		$result['result'][$key]['workshop']['nominal'] = $value_work['nominal'];
		}
		}
		$result['result'][$key]['in'] = $this->Pengembangan_pelatihan_model->get_5($inhouse, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['in'])) {
            foreach ($result['result'][$key]['in'] as $key_in => $value_in) {
		$result['result'][$key]['inhouse']['jum'] = $value_in['jum'];
		$result['result'][$key]['inhouse']['nominal'] = $value_in['nominal'];
		}
		}
		$result['result'][$key]['pen'] = $this->Pengembangan_pelatihan_model->get_5($pendidikan, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['pen'])) {
            foreach ($result['result'][$key]['pen'] as $key_pen => $value_pen) {
		$result['result'][$key]['pendidikan']['jum'] = $value_pen['jum'];
		$result['result'][$key]['pendidikan']['nominal'] = $value_pen['nominal'];
		}
		}
		$result['result'][$key]['lu'] = $this->Pengembangan_pelatihan_model->get_5($luar, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['lu'])) {
            foreach ($result['result'][$key]['lu'] as $key_lu => $value_lu) {
		$result['result'][$key]['luar']['jum'] = $value_lu['jum'];
		$result['result'][$key]['luar']['nominal'] = $value_lu['nominal'];
		}
		}
		$result['result'][$key]['tam'] = $this->Pengembangan_pelatihan_model->get_5($tamu, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['tam'])) {
            foreach ($result['result'][$key]['tam'] as $key_tam => $value_tam) {
		$result['result'][$key]['tamu']['jum'] = $value_tam['jum'];
		$result['result'][$key]['tamu']['nominal'] = $value_tam['nominal'];
		}
		}
		$result['result'][$key]['tot'] = $this->Pengembangan_pelatihan_model->get_5(null, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['tot'])) {
            foreach ($result['result'][$key]['tot'] as $key_tot => $value_tot) {
		$result['result'][$key]['total']['jum'] = $value_tot['jum'];
		$result['result'][$key]['total']['nominal'] = $value_tot['nominal'];
		}
		}
		$result['result'][$key]['jum_tot'] = $this->Pengembangan_pelatihan_model->get_5($jenis_perjalanan, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['jum_tot'])) {
            foreach ($result['result'][$key]['jum_tot'] as $key_jum_tot => $value_jum_tot) {
		$result['result'][$key]['jum_total']['jum'] = $value_jum_tot['jum'];
		$result['result'][$key]['jum_total']['nominal'] = $value_jum_tot['nominal'];
		}
		}
		$result['result'][$key]['dal'] = $this->Pengembangan_pelatihan_model->get_5($dalam, $nopeg, $offset, null, $from, $to, null, null, null, $fil_as, $unit, null, $jenis);
		if (!empty($result['result'][$key]['dal'])) {
            foreach ($result['result'][$key]['dal'] as $key_dal => $value_dal) {
		$result['result'][$key]['dalam']['jum'] = $value_dal['jum'];
		$result['result'][$key]['dalam']['nominal'] = $value_dal['nominal'];
		}
		}
		}
		
		//print_r($result["result"][0]["profesi"]);die;
		$data = "test";
		$this->load->library("pdf");
		$html = $this->load->view("laporan/laporan_17", array("result" => $result['result']), true);
        
        //echo $html;
        //die;
		//$customPaper = array(0,0,210,330);
        $this->pdf->loadHtml($html);
        // $this->pdf->setPaper($customPaper);
        $this->pdf->setPaper("Legal",'landscape');
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->set_option("isRemoteEnabled", true);
        $this->pdf->render();
        $name = "download Laporan";
        $this->pdf->stream($name, array("Attachment" => 1));
        }            
    }
	
    public function list_get($offset = 0, $param_search = "")
    {
        $search = null;
        $limit = 25;
        $headers = $this->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                if (!empty($param_search)) {
                    $search["field"] = array("jenis_perjalanan", "nama_pegawai", "jabatan");
                    $search["search"] = $param_search;
                }
                $results['result'] = $this->Pengembangan_pelatihan_model->get_all(null, $search, $offset, $limit);
                // echo $this->db->last_query();die;
                // print_r($results);die;
                if (!empty($results['result'])) {
                    foreach ($results["result"] as $key => $value) {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
                        $results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value["id"]));
                        $results["result"][$key]["no_berkas"] = date("y",strtotime($value["created"])) ."".date("m",strtotime($value["created"])).".".$value["kode"];
						
						if (!empty($results["result"][$key]["tanggal"])) {
						    foreach ($results["result"][$key]["tanggal"] as $key_detail_tanggal => $value_detail_tanggal) {
                                if ($value_detail_tanggal["tanggal_to"]!=$value_detail_tanggal["tanggal_from"]) {
								$results["result"][$key]["tanggal_from"] = $value_detail_tanggal["tanggal_from"].' s/d '.$value_detail_tanggal["tanggal_to"];
								}else{
								$results["result"][$key]["tanggal_from"] = $value_detail_tanggal["tanggal_from"];
								}
							}
                        }
                    }
                }

                $results['total'] = count($this->Pengembangan_pelatihan_model->get_all());
                $results["query"] = $this->db->last_query();
                $results['limit'] = $limit;
                $results["is_blocked"] = $this->Pengembangan_pelatihan_model->is_blocked($decodedToken->data->NIP);
                $results["is_monev"] = $this->Pengembangan_pelatihan_model->is_monev($decodedToken->data->NIP);
                // echo "<pre>";
              // print_r($results["result"][$key]);die();
                // echo "</pre>";
                // die;
                $this->set_response($results, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }    
	
	public function listlap_get($offset = 0, $param_search = "", $awal = "", $akhir = "")
    {
        $search = null;
        $limit = 25;
        $headers = $this->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                if (!empty($param_search)) {
                    $search["field"] = array("jenis_perjalanan", "nama_pegawai", "jabatan");
                    $search["search"] = $param_search;
                }
				if(!empty($awal)){
					$from= $awal;
				}
				if(!empty($akhir)){
					$to= $akhir;
				}
                $results['result'] = $this->Pengembangan_pelatihan_model->get_all(null, $search, $offset, $limit, $from, $to);
                // echo $this->db->last_query();die;
                // print_r($results);die;
                if (!empty($results['result'])) {
                    foreach ($results["result"] as $key => $value) {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
						
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
                        $results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        if (!empty($results["result"][$key]["detail"])) {
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
                    }
                }

                $results['total'] = count($this->Pengembangan_pelatihan_model->get_all());
                $results["query"] = $this->db->last_query();
                $results['limit'] = $limit;
                $results["is_blocked"] = $this->Pengembangan_pelatihan_model->is_blocked($decodedToken->data->NIP);
                $results["is_monev"] = $this->Pengembangan_pelatihan_model->is_monev($decodedToken->data->NIP);
                // echo "<pre>";
                //print_r($results);
                // echo "</pre>";
                // die;
                $this->set_response($results, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	public function listlapdel_get($offset = 0, $param_search = "", $awal = "", $akhir = "")
    {
        $search = null;
        $limit = 25;
        $headers = $this->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                if (!empty($param_search)) {
                    $search["field"] = array("jenis_perjalanan", "nama_pegawai", "jabatan");
					$search["search"] = $param_search;
                }
				if(!empty($awal)){
					$from= $awal;
				}
				if(!empty($akhir)){
					$to= $akhir;
				}
                $results['result'] = $this->Pengembangan_pelatihan_model->getdel_all(null, $search, $offset, $limit, $from, $to);
                // echo $this->db->last_query();die;
                // print_r($results);die;
                if (!empty($results['result'])) {
                    foreach ($results["result"] as $key => $value) {
                        $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
                        $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
                        if (count($createdby) == 1) {
                            $results["result"][$key]["createdby"] = $createdby[0]["username"];
                        }
                        if (count($updatedby) == 1) {
                            $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
                        }
						
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
                        $results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);
                        $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
                        $results["result"][$key]["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                        if (!empty($results["result"][$key]["detail"])) {
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
                    }
                }

                $results['total'] = count($this->Pengembangan_pelatihan_model->getdel_all());
                $results["query"] = $this->db->last_query();
                $results['limit'] = $limit;
                $results["is_blocked"] = $this->Pengembangan_pelatihan_model->is_blocked($decodedToken->data->NIP);
                $results["is_monev"] = $this->Pengembangan_pelatihan_model->is_monev($decodedToken->data->NIP);
                // echo "<pre>";
				//print_r($results);
                // echo "</pre>";
                // die;
                $this->set_response($results, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function save_post()
    {
        $headers = $this->input->request_headers();
        // echo "<pre>";
        // print_r($headers);
        // echo "</pre>";
        // die;
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $nama_pelatihan = $this->input->post("nama_pelatihan");
                $tujuan = $this->input->post("tujuan");
                $membaca = $this->input->post("membaca");
                $yth = $this->input->post("yth");
                $institusi = $this->input->post("institusi");
                $alamat = $this->input->post("alamat");
                $no_disposisi = $this->input->post("no_disposisi");
                $laporan = $this->input->post("laporan");
                $monev = $this->input->post("monev");
                $jenis = $this->input->post("jenis");
                $jenis_biaya = $this->input->post("jenis_biaya");
                $jenis_perjalanan = $this->input->post("jenis_perjalanan");
                $dalam_negeri = $this->input->post("dalam_negeri");
                $jenis_surat = $this->input->post("jenis_surat");
                $jam_mulai = $this->input->post("jam_mulai");
                $jam_sampai = $this->input->post("jam_sampai");
                // $surat_tugas_dalam_negeri_dalamkota = $this->input->post("surat_tugas_dalam_negeri_dalamkota");
                // $surat_tugas_dalam_negeri_luarkota = $this->input->post("surat_tugas_dalam_negeri_luarkota");
                // $surat_tugas_luar_negeri = $this->input->post("surat_tugas_luar_negeri");
                $total_hari_kerja = $this->input->post("total_hari_kerja");
                $pengembangan_pelatihan_kegiatan = $this->input->post("pengembangan_pelatihan_kegiatan");
                $pengembangan_pelatihan_kegiatan_status = $this->input->post("pengembangan_pelatihan_kegiatan_status");
                $phl = $this->input->post("phl");
                $jenis_plh = $this->input->post("jenis_plh");
                $target_kinerja = $this->input->post("target_kinerja");
                $surat_tugas_dalam_negeri_luarkota = $this->input->post("surat_tugas_dalam_negeri_luarkota");
                
                $save["nama_pelatihan"] = ($nama_pelatihan)?$nama_pelatihan:null;
                $save["tujuan"] = ($tujuan)?$tujuan:null;
                $save["membaca"] = ($membaca)?$membaca:null;
                $save["yth"] = ($yth)?$yth:null;
                $save["institusi"] = ($institusi)?$institusi:null;
                $save["alamat"] = ($alamat)?$alamat:null;
                $save["no_disposisi"] = ($no_disposisi)?$no_disposisi:null;
                $save["laporan"] = ($laporan)?$laporan:null;
                $save["monev"] = ($monev)?$monev:null;
                $save["jenis"] = ($jenis)?$jenis:null;
                $save["jenis_biaya"] = ($jenis_biaya)?$jenis_biaya:null;
                $save["jenis_perjalanan"] = ($jenis_perjalanan)?$jenis_perjalanan:null;
                $save["dalam_negeri"] = ($dalam_negeri)?$dalam_negeri:null;
                $save["jenis_surat"] = ($jenis_surat)?$jenis_surat:null;
                $save["jam_mulai"] = ($jam_mulai)?$jam_mulai:null;
                $save["jam_sampai"] = ($jam_sampai)?$jam_sampai:null;
                // $save["surat_tugas_dalam_negeri_dalamkota"] = ($surat_tugas_dalam_negeri_dalamkota)?$surat_tugas_dalam_negeri_dalamkota:null;
                // $save["surat_tugas_dalam_negeri_luarkota"] = ($surat_tugas_dalam_negeri_luarkota)?$surat_tugas_dalam_negeri_luarkota:null;
                // $save["surat_tugas_luar_negeri"] = ($surat_tugas_luar_negeri)?$surat_tugas_luar_negeri:null;
                $save["total_hari_kerja"] = ($total_hari_kerja)?$total_hari_kerja:null;
                $save["pengembangan_pelatihan_kegiatan"] = ($pengembangan_pelatihan_kegiatan)?$pengembangan_pelatihan_kegiatan:null;
                $save["pengembangan_pelatihan_kegiatan_status"] = ($pengembangan_pelatihan_kegiatan_status)?$pengembangan_pelatihan_kegiatan_status:null;
                $save["phl"] = ($phl)?$phl:null;
                $save["jenis_plh"] = ($jenis_plh)?$jenis_plh:null;
                $save["target_kinerja"] = ($target_kinerja)?$target_kinerja:null;
                $save["alat_angkut"] = ($surat_tugas_dalam_negeri_luarkota)?$surat_tugas_dalam_negeri_luarkota:null;
                
                // 195 = direktur SDM
                $id_parent = $this->System_auth_model->getparent($decodedToken->data->_pnc_id_grup, '195');
                // echo "<pre>";
                // print_r($id_parent);
                // echo "</pre>";
                // die;
                $save["id_atasan"] = $id_parent;
                $save["id_uk"] = $decodedToken->data->_pnc_id_grup;
                $save["status"] = 102;
				//print_r($save);die();
				
				$detail = ($this->input->post("detail"))?$this->input->post("detail"):null;
                //print_r($detail["no_berkas"]);die();
				$tanggal = ($this->input->post("tanggal"))?$this->input->post("tanggal"):null;
                $tanggal_go = ($this->input->post("tanggal_go"))?$this->input->post("tanggal_go"):null;
                $hari_go = ($this->input->post("hari_go"))?$this->input->post("hari_go"):null;
                $tanggal_back = ($this->input->post("tanggal_back"))?$this->input->post("tanggal_back"):null;
                $hari_back = ($this->input->post("hari_back"))?$this->input->post("hari_back"):null;
				
				$biaya["biaya_uraian"] = ($this->input->post("biaya_uraian"))?$this->input->post("biaya_uraian"):null;
                $biaya["uraian_nominal"] = ($this->input->post("uraian_nominal"))?$this->input->post("uraian_nominal"):null;
                $biaya["biaya_nominal"] = ($this->input->post("biaya_nominal"))?$this->input->post("biaya_nominal"):null;
                $biaya["total_nominal"] = ($this->input->post("total_nominal"))?$this->input->post("total_nominal"):null;
                $biaya["biaya_pernominal"] = ($this->input->post("biaya_pernominal"))?$this->input->post("biaya_pernominal"):null;
                $biaya["qty_nominal"] = ($this->input->post("qty_nominal"))?$this->input->post("qty_nominal"):null;
                $biaya["orang"] = ($this->input->post("orang"))?$this->input->post("orang"):null;
                $biaya["total"] = ($this->input->post("total"))?$this->input->post("total"):null;
                $biaya["muncul"] = ($this->input->post("muncul"))?$this->input->post("muncul"):null;
                $jumlah=count($biaya["biaya_uraian"]);
				     
				//print_r($biaya);die();       
                $result = $this->Pengembangan_pelatihan_model->create($save);
                // echo "<pre>";
                // print_r($save);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                // die;
				if ($result->id) {
					for ($i = 0; $i < $jumlah ; $i++) {
		                $pengembangan_pelatihan_detail_biaya["pengembangan_pelatihan_detail_id"] = $result->id;
                        $pengembangan_pelatihan_detail_biaya["uraian"] = $biaya["biaya_uraian"][$i]["value"]?$biaya["biaya_uraian"][$i]["value"]:null;
                        $pengembangan_pelatihan_detail_biaya["uraian_nominal"] = $biaya["uraian_nominal"][$i]["value"]?$biaya["uraian_nominal"][$i]["value"]:null;
                        $pengembangan_pelatihan_detail_biaya["nominal"] = preg_replace("/[^0-9]/", "", $biaya["total_nominal"][$i]["value"]);
                        $pengembangan_pelatihan_detail_biaya["pernominal"] = preg_replace("/[^0-9]/", "", $biaya["biaya_pernominal"][$i]["value"]?$biaya["biaya_pernominal"][$i]["value"]:0);
                        $pengembangan_pelatihan_detail_biaya["qty"] = $biaya["qty_nominal"][$i]["value"];
                        $pengembangan_pelatihan_detail_biaya["orang"] = $biaya["orang"][$i]["value"]?$biaya["orang"][$i]["value"]:null;
                        $pengembangan_pelatihan_detail_biaya["total"] = preg_replace("/[^0-9]/", "", $biaya["total"][$i]["value"]?$biaya["total"][$i]["value"]:0);
                        $pengembangan_pelatihan_detail_biaya["muncul"] = $biaya["muncul"][$i]["value"]?$biaya["muncul"][$i]["value"]:0;
                        $nominal += $pengembangan_pelatihan_detail_biaya["nominal"];
                        $total += $pengembangan_pelatihan_detail_biaya["total"];
						// insert detail biaya
						//print_r($pengembangan_pelatihan_detail_biaya);die();
						$pengembangan_pelatihan_detail_biaya_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail_biaya", $pengembangan_pelatihan_detail_biaya);
					}
				}
						
				$pengembangan_pelatihan_update = $this->Pengembangan_pelatihan_model->update($result->id, array("total" => $total));
				
				$date= date("y-m-d");
				// NOMOR URUT ORDER
				$re = $this->Pengembangan_pelatihan_model->get_no_berks();
				$noberks = $re[0]["no_berkas"];
				//print_r($result);die();
				$noUrut = (int) substr($noberks, 5, 5);
				$noUrut++;
				$tahun=substr($date, 0, 2);
				$bulan=substr($date, 3, 2);
                $no_berkas = $tahun .$bulan .'.'. sprintf("%05s", $noUrut);
                
				//print_r($nominal);die();
                if ($result){
					//print_r($no_berkas);die();
                    $this->insert_detail($result->id, $detail, $nominal, $no_berkas);

                    if (!empty($tanggal)) {
                        foreach ($tanggal as $key => $value) {
                        foreach ($tanggal_go as $key_go => $value_go) {
							$tanggal_explode_go = explode(" - ", $tanggal_go_1);
						}
                        foreach ($tanggal_back as $key_back => $value_back) {
							$tanggal_explode_back = explode(" - ", $tanggal_back_1);
						}
                            $tanggal_1 = @$value["value"];
                            $tanggal_go_1 = @$value_go["value"];
                            $tanggal_back_1 = @$value_back["value"];
                            $tanggal_explode = explode(" - ", $tanggal_1);
                            $tanggal_go = explode(" - ", $tanggal_go_1);
                            $tanggal_back = explode(" - ", $tanggal_back_1);
							
                            // dibagi 24jam x 8 jam
                            $tanggal_diff = $total_hari_kerja * 8;
                            $pengembangan_pelatihan_pelaksanaan[$key]["pengembangan_pelatihan_id"] = $result->id;
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_from"] = @$tanggal_explode[0];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_too"] = date('Y-m-d', strtotime(@$tanggal_explode[1]));
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_to"] = @$tanggal_explode[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_go"] = @$tanggal_go[0];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_go1"] = @$tanggal_go[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["hari_go"] = $hari_go;
							$pengembangan_pelatihan_pelaksanaan[$key]["tanggal_back"] = @$tanggal_back[0];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_back1"] = @$tanggal_back[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["hari_back"] = $hari_back;
							$pengembangan_pelatihan_pelaksanaan[$key]["total_jam"] = $tanggal_diff;
								//print_r($pengembangan_pelatihan_pelaksanaan[$key]);die();
                        }
                        $this->Pengembangan_pelatihan_model->create_detail("pengembangan_pelatihan_pelaksanaan", $pengembangan_pelatihan_pelaksanaan);
                    }


                    $response['hasil'] = 'success';
                    $response['message'] = 'Data berhasil ditambah!';
                }
                else{
                    $response['hasil'] = 'failed';
                    $response['message'] = 'Data gagal ditambah!';
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function update_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id = ($this->input->post("id"))?$this->input->post("id"):null;
                $status = ($this->input->post("status"))?$this->input->post("status"):null;
                $result = $this->Pengembangan_pelatihan_model->update($id, array("status" => $status));
                if ($result) {
                    $response['hasil'] = 'success';
                    $response['message'] = 'Data berhasil diperbahurui!';
                }
                else{
                    $response['hasil'] = 'failed';
                    $response['message'] = 'Data gagal diperbahurui!';
                }
                $response["query"] = $this->db->last_query();
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response($response, REST_Controller::HTTP_OK);
        return;
    }


    public function edit_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $id = $this->input->post("id");
                $nama_pelatihan = $this->input->post("nama_pelatihan");
                $tujuan = $this->input->post("tujuan");
                $membaca = $this->input->post("membaca");
                $yth = $this->input->post("yth");
                $institusi = $this->input->post("institusi");
                $alamat = $this->input->post("alamat");
                $no_disposisi = $this->input->post("no_disposisi");
                $laporan = $this->input->post("laporan");
                $monev = $this->input->post("monev");
                $jenis = $this->input->post("jenis");
                $jenis_biaya = $this->input->post("jenis_biaya");
                $jenis_perjalanan = $this->input->post("jenis_perjalanan");
                $dalam_negeri = $this->input->post("dalam_negeri");
                $jenis_surat = $this->input->post("jenis_surat");
                $jam_mulai = $this->input->post("jam_mulai");
                $jam_sampai = $this->input->post("jam_sampai");
                // $surat_tugas_dalam_negeri_dalamkota = $this->input->post("surat_tugas_dalam_negeri_dalamkota");
                // $surat_tugas_dalam_negeri_luarkota = $this->input->post("surat_tugas_dalam_negeri_luarkota");
                // $surat_tugas_luar_negeri = $this->input->post("surat_tugas_luar_negeri");
                $total_hari_kerja = $this->input->post("total_hari_kerja");
                $pengembangan_pelatihan_kegiatan = $this->input->post("pengembangan_pelatihan_kegiatan");
                $pengembangan_pelatihan_kegiatan_status = $this->input->post("pengembangan_pelatihan_kegiatan_status");
				$phl = $this->input->post("phl");
				$jenis_plh = $this->input->post("jenis_plh");
				$target_kinerja = $this->input->post("target_kinerja");
                $surat_tugas_dalam_negeri_luarkota = $this->input->post("surat_tugas_dalam_negeri_luarkota");
                
				
                $save["id"] = ($id)?$id:null;
                $save["nama_pelatihan"] = ($nama_pelatihan)?$nama_pelatihan:null;
                $save["tujuan"] = ($tujuan)?$tujuan:null;
                $save["membaca"] = ($membaca)?$membaca:null;
                $save["yth"] = ($yth)?$yth:null;
				$save["institusi"] = ($institusi)?$institusi:null;
                $save["alamat"] = ($alamat)?$alamat:null;
                $save["no_disposisi"] = ($no_disposisi)?$no_disposisi:null;
                $save["laporan"] = ($laporan)?$laporan:null;
                $save["monev"] = ($monev)?$monev:null;
                $save["jenis"] = ($jenis)?$jenis:null;
                $save["jenis_biaya"] = ($jenis_biaya)?$jenis_biaya:null;
                $save["jenis_perjalanan"] = ($jenis_perjalanan)?$jenis_perjalanan:null;
                $save["dalam_negeri"] = ($dalam_negeri)?$dalam_negeri:null;
                $save["jenis_surat"] = ($jenis_surat)?$jenis_surat:null;
                $save["jam_mulai"] = ($jam_mulai)?$jam_mulai:null;
                $save["jam_sampai"] = ($jam_sampai)?$jam_sampai:null;
                // $save["surat_tugas_dalam_negeri_dalamkota"] = ($surat_tugas_dalam_negeri_dalamkota)?$surat_tugas_dalam_negeri_dalamkota:null;
                // $save["surat_tugas_dalam_negeri_luarkota"] = ($surat_tugas_dalam_negeri_luarkota)?$surat_tugas_dalam_negeri_luarkota:null;
                // $save["surat_tugas_luar_negeri"] = ($surat_tugas_luar_negeri)?$surat_tugas_luar_negeri:null;
                $save["total_hari_kerja"] = ($total_hari_kerja)?$total_hari_kerja:null;
                $save["pengembangan_pelatihan_kegiatan"] = ($pengembangan_pelatihan_kegiatan)?$pengembangan_pelatihan_kegiatan:null;
                $save["pengembangan_pelatihan_kegiatan_status"] = ($pengembangan_pelatihan_kegiatan_status)?$pengembangan_pelatihan_kegiatan_status:null;
                $save["phl"] = ($phl)?$phl:null;
                $save["jenis_plh"] = ($jenis_plh)?$jenis_plh:null;
                $save["target_kinerja"] = ($target_kinerja)?$target_kinerja:null;
                $save["alat_angkut"] = ($surat_tugas_dalam_negeri_luarkota)?$surat_tugas_dalam_negeri_luarkota:null;
                
				//print_r($save);die();
                $detail = ($this->input->post("detail"))?$this->input->post("detail"):null;
                $tanggal = ($this->input->post("tanggal"))?$this->input->post("tanggal"):null;
                $biaya_uraian = ($this->input->post("biaya_uraian"))?$this->input->post("biaya_uraian"):null;
                $tanggal_go = ($this->input->post("tanggal_go"))?$this->input->post("tanggal_go"):null;
                $hari_go = ($this->input->post("hari_go"))?$this->input->post("hari_go"):null;
                $tanggal_back = ($this->input->post("tanggal_back"))?$this->input->post("tanggal_back"):null;
                $hari_back = ($this->input->post("hari_back"))?$this->input->post("hari_back"):null;
				//print_r($detail);die();
                $result = $this->Pengembangan_pelatihan_model->update_de($save["id"], $save);
                //print_r($result);die();
				$biaya["biaya_uraian"] = ($this->input->post("biaya_uraian"))?$this->input->post("biaya_uraian"):null;
                $biaya["uraian_nominal"] = ($this->input->post("uraian_nominal"))?$this->input->post("uraian_nominal"):null;
                $biaya["biaya_nominal"] = ($this->input->post("biaya_nominal"))?$this->input->post("biaya_nominal"):null;
                $biaya["total_nominal"] = ($this->input->post("total_nominal"))?$this->input->post("total_nominal"):null;
                $biaya["biaya_pernominal"] = ($this->input->post("biaya_pernominal"))?$this->input->post("biaya_pernominal"):null;
                $biaya["qty_nominal"] = ($this->input->post("qty_nominal"))?$this->input->post("qty_nominal"):null;
				$biaya["orang"] = ($this->input->post("orang"))?$this->input->post("orang"):null;
                $biaya["total"] = ($this->input->post("total"))?$this->input->post("total"):null;
                $biaya["muncul"] = ($this->input->post("muncul"))?$this->input->post("muncul"):null;
				$jumlah=count($biaya["biaya_uraian"]);
				// echo "<pre>";
                // print_r($save);
                // echo "</pre>";
                // echo "<pre>";
                //print_r($biaya["muncul"]);die();
                // echo "</pre>";
                // die;
				$this->Pengembangan_pelatihan_model->delete_detail_row("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $result->id));
                  
				if ($result->id) {
					for ($i = 0; $i < $jumlah ; $i++) {
		                $pengembangan_pelatihan_detail_biaya["pengembangan_pelatihan_detail_id"] = $result->id;
                        $pengembangan_pelatihan_detail_biaya["uraian"] = $biaya["biaya_uraian"][$i]["value"]?$biaya["biaya_uraian"][$i]["value"]:null;
                        $pengembangan_pelatihan_detail_biaya["uraian_nominal"] = $biaya["uraian_nominal"][$i]["value"]?$biaya["uraian_nominal"][$i]["value"]:null;
                        $pengembangan_pelatihan_detail_biaya["nominal"] = preg_replace("/[^0-9]/", "", $biaya["total_nominal"][$i]["value"]);
                        $pengembangan_pelatihan_detail_biaya["pernominal"] = preg_replace("/[^0-9]/", "", $biaya["biaya_pernominal"][$i]["value"]?$biaya["biaya_pernominal"][$i]["value"]:0);
                        $pengembangan_pelatihan_detail_biaya["qty"] = $biaya["qty_nominal"][$i]["value"];
                        $pengembangan_pelatihan_detail_biaya["orang"] = $biaya["orang"][$i]["value"]?$biaya["orang"][$i]["value"]:null;
                        $pengembangan_pelatihan_detail_biaya["total"] = preg_replace("/[^0-9]/", "", $biaya["total"][$i]["value"]?$biaya["total"][$i]["value"]:0);
                        $pengembangan_pelatihan_detail_biaya["muncul"] = $biaya["muncul"][$i]["value"]?$biaya["muncul"][$i]["value"]:0;
                        $nominal += $pengembangan_pelatihan_detail_biaya["nominal"];
                        $total += $pengembangan_pelatihan_detail_biaya["total"];
						//// insert detail biaya
						//print_r($pengembangan_pelatihan_detail_biaya);die();
						$pengembangan_pelatihan_detail_biaya_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail_biaya", $pengembangan_pelatihan_detail_biaya);
					}
				}
				$date= date("y-m-d");
				// NOMOR URUT ORDER
				$re = $this->Pengembangan_pelatihan_model->get_no_berks();
				$noberks = $re[0]["no_berkas"];
				//print_r($result);die();
				$noUrut = (int) substr($noberks, 5, 5);
				$noUrut++;
				$tahun=substr($date, 0, 2);
				$bulan=substr($date, 3, 2);
                $no_berkas = $tahun .$bulan .'.'. sprintf("%05s", $noUrut);
                
				
				$pengembangan_pelatihan_update = $this->Pengembangan_pelatihan_model->update($result->id, array("total" => $total));
				//print_r($result->id);die();
						
				if ($result){
                    // delete all pelatihan_detail
                    $this->Pengembangan_pelatihan_model->delete_detail_row("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $result->id));
                    $this->Pengembangan_pelatihan_model->delete_detail_row("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $result->id));

                    $this->insert_detail($result->id, $detail, $nominal, $no_berkas);

                    if (!empty($tanggal)) {
                        foreach ($tanggal as $key => $value) {
                        foreach ($tanggal_go as $key_go => $value_go) {
							$tanggal_explode_go = explode(" - ", $tanggal_go_1);
						}
                        foreach ($tanggal_back as $key_back => $value_back) {
							$tanggal_explode_back = explode(" - ", $tanggal_back_1);
						}
                            $tanggal_1 = @$value["value"];
                            $tanggal_go_1 = @$value_go["value"];
                            $tanggal_back_1 = @$value_back["value"];
                            $tanggal_explode = explode(" - ", $tanggal_1);
                            $tanggal_go = explode(" - ", $tanggal_go_1);
                            $tanggal_back = explode(" - ", $tanggal_back_1);
							
                            // dibagi 24jam x 8 jam
                            $tanggal_diff = $total_hari_kerja * 8;
                            $pengembangan_pelatihan_pelaksanaan[$key]["pengembangan_pelatihan_id"] = $result->id;
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_from"] = @($tanggal_explode[0]?$tanggal_explode[0]:Null);
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_to"] = @$tanggal_explode[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_too"] = @($tanggal_explode[1]?$tanggal_explode[1]:Null);
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_go"] = @($tanggal_go[0]?$tanggal_go[0]:Null);
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_go1"] = @$tanggal_go[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["hari_go"] = $hari_go;
							$pengembangan_pelatihan_pelaksanaan[$key]["tanggal_back"] = @($tanggal_back[0]?$tanggal_back[0]:Null);
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_back1"] = @$tanggal_back[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["hari_back"] = $hari_back;
							$pengembangan_pelatihan_pelaksanaan[$key]["total_jam"] = $tanggal_diff;
								//print_r($pengembangan_pelatihan_pelaksanaan[$key]);die();
                        }
                        $this->Pengembangan_pelatihan_model->create_detail("pengembangan_pelatihan_pelaksanaan", $pengembangan_pelatihan_pelaksanaan);
                    }

                    $response['hasil'] = 'success';
                    $response['message'] = 'Data berhasil diperbahurui!';
                }
                else{
                    $response['hasil'] = 'failed';
                    $response['message'] = 'Data gagal diperbahurui!';
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function delete_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id = $this->input->get("id");
                $this->Pengembangan_pelatihan_model->delete($id);

                $response['hasil'] = 'success';
                $response['message'] = 'Data berhasil dihapus!';
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function upload_file_post()
    {   print_r($_POST);die();
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

                $config['upload_path'] = 'upload/data';
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
                //print_r($arrdata);die();

                $id = $this->input->get("id");

                $this->Pengembangan_pelatihan_model->update($id, $arrdata);

                $response['hasil'] = 'success';
                $response['message'] = 'Data berhasil diupdate!';
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
    
    public function laporan_selesai_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id = $this->input->get("id");
                $this->Pengembangan_pelatihan_model->update_detail($id, array("laporan" => 1));

                $response['hasil'] = 'success';
                $response['message'] = 'Data berhasil diupdate!';
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
	
	public function del_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id = $this->input->get("id");
                $this->Pengembangan_pelatihan_model->update_pegawai($id, array("statue" => 0));

                $response['hasil'] = 'success';
                $response['message'] = 'Data berhasil diupdate!';
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function get_get()
    {
        $results["success"] = false;
        $id = $this->input->get('id');
        $result = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);

        if (!empty($result)) {
            $results["success"] = true;
            $result = $result[0];
            $tanggal = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $result["id"]));
            $result["tanggal"] = $tanggal;
            // print_r($result);die;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $result["id"]));
            $result["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $result["id"]));

			//if (!empty($result["detail"])) {
            //    foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
            //        $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
            //    }
            //}
            //print_r($result);die;
            $results["data"] = $result;



            // if (!empty($results['result'])) {
            //     foreach ($results["result"] as $key => $value) {
            //         $createdby = $this->db->select("username")->where(array("id_user" => $value["createdby"]))->get("sys_user")->result_array();
            //         $updatedby = $this->db->select("username")->where(array("id_user" => $value["updatedby"]))->get("sys_user")->result_array();
            //         if (count($createdby) == 1) {
            //             $results["result"][$key]["createdby"] = $createdby[0]["username"];
            //         }
            //         if (count($updatedby) == 1) {
            //             $results["result"][$key]["updatedby"] = $updatedby[0]["username"];
            //         }
            //         $results["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $value["id"]));
            //     }
            // }




        }

        $this->set_response($results, REST_Controller::HTTP_OK);
    }

    public function insert_detail($pengembangan_pelatihan_id, $detail, $nominal, $no_berkas)
    {   
        // echo "<pre>";
        // print_r($pengembangan_pelatihan_id);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($detail);
        // echo "</pre>";
        // die();
		
        if (!empty($detail) && is_array($detail)) {
			//echo $no_berkas;die();
			    
			    $pengembangan_pelatihan_detail["uraian_total"] = $nominal;
            foreach ($detail as $key => $value) {
                $pengembangan_pelatihan_detail["pengembangan_pelatihan_id"] = $pengembangan_pelatihan_id;
                if(!empty($value["berkas"])){
				$pengembangan_pelatihan_detail["berkas"] = $value["berkas"];
                }else{
				$pengembangan_pelatihan_detail["berkas"] = $no_berkas;
				}
				$pengembangan_pelatihan_detail["nopeg"] = $value["nopeg"];
                $pengembangan_pelatihan_detail["nip"] = $value["nip"];
				$pengembangan_pelatihan_detail["nik"] = $value["nik"];
				$pengembangan_pelatihan_detail["laporan_kegiatan"] = $value["laporan_kegiatan"];
                $pengembangan_pelatihan_detail["nama_pegawai"] = $value["nama_pegawai"];
                $pengembangan_pelatihan_detail["pangkat"] = $value["pangkat"];
                $pengembangan_pelatihan_detail["golongan"] = $value["golongan"];
                $pengembangan_pelatihan_detail["akomodasi"] = $value["akomodasi"]?$value["akomodasi"]:null;
                $pengembangan_pelatihan_detail["jabatan"] = $value["jabatan"];
                //print_r($pengembangan_pelatihan_detail);
                //print_r($pengembangan_pelatihan_detail);die();
				$detail_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail", $pengembangan_pelatihan_detail);
                // echo "<pre>";
                // echo "</pre>";
                // die();
            }
        }
    }
	
	function cek_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				
				$tanggal = $this->input->post("tanggal");
				
				if (!empty($tanggal)) {
                        foreach ($tanggal as $key => $value) {
                            $tanggal_1 = @$value["value"];
                            $tanggal_explode = explode(" - ", $tanggal_1);
                           
				}}			
				$nopeg = $this->input->post("nopeg");
				$from = @($tanggal_explode[0]?$tanggal_explode[0]:Null);
                $to = @$tanggal_explode[1];
                $this->db->where('pengembangan_pelatihan_detail.nopeg', $nopeg);
				$this->db->where("pengembangan_pelatihan_pelaksanaan.tanggal_from <=", $from);
				$this->db->where("pengembangan_pelatihan_pelaksanaan.tanggal_to >=", $to);
				$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_detail.pengembangan_pelatihan_id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
				$this->db->join("pengembangan_pelatihan", "pengembangan_pelatihan_detail.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
				$cek=$this->db->get('pengembangan_pelatihan_detail')->row();
                //print_r($from);die();
                    if (empty($cek)) {
                        $arr['hasil'] = 'success';
                    } else {
                        $arr['hasil'] = 'error';
                        $arr['message'] = 'Yang bersangkutan sedang menghadiri '.$cek->nama_pelatihan.' pada tanggal '.$cek->tanggal_from.' s/d '.$cek->tanggal_to.' yang diselenggarakan oleh '.$cek->institusi.' di '.$cek->tujuan;
                    }
                    $this->set_response($arr, REST_Controller::HTTP_OK);
                    return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}
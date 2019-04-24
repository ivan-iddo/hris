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
                $result["total_biaya"] = terbilang($result["detail"][$key]["uraian_total"]);
				$result["total"] += $result["detail"][$key]["uraian_total"];
                $result["total_biaya_k"] = terbilang($result["total"]);
				$result["count"] = count($result["detail"]);
				if (!empty($result["detail"])) {
                    foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
						$result["count_detail"] = count($result["detail"][$key_detail_biaya]["detail_uraian"]);
					}
                }
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
				}else if ($jenis_surat == "dft") {
					$html = $this->load->view("dftar", array("result" => $result), true);
				}else{
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
				}
			} else if ($result["jenis"] == "Individu"){
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
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
                $result["total_biaya"] = terbilang($result["detail"][0]["uraian_total"]);
                $result["total"] += $result["detail"][$key]["uraian_total"];
                $result["total_biaya_k"] = terbilang($result["total"]);
				$result["count"] = count($result["detail"]);
				if (!empty($result["detail"])) {
                    foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
						$result["count_detail"] = count($result["detail"][$key_detail_biaya]["detail_uraian"]);
                    }
                }
            }
        }
        //print_r($result);die;
        $this->load->library("pdf");
        $data = "test";
		$kertas="A4";
		if ($result['jenis_perjalanan'] == "Dalam Negeri") {
        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
				}else if ($jenis_surat == "dft") {
					$html = $this->load->view("dftar", array("result" => $result), true);
				}else{
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
				}
			} else if ($result["jenis"] == "Individu"){
				if ($jenis_surat == "RAK") {
					$html = $this->load->view("surat", array("result" => $result), true);
				} else{
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
                        $results["result"][$key]["total_hari_kerja_baru"] = terbilang($results["result"][$key]["total_hari_kerja"]);
                        $results["result"][$key]["total_biaya"] = terbilang($results["result"][$key]["detail"][$key]["uraian_total"]);
						if (!empty($results["result"][$key]["detail"])) {
                            
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
						//print_r($results["result"][$key]['jenis_perjalanan']);die;
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
                        $results["result"][$key]["total_hari_kerja_baru"] = terbilang($results["result"][$key]["total_hari_kerja"]);
                        $results["result"][$key]["total_biaya"] = terbilang($results["result"][$key]["detail"][$key]["uraian_total"]);
						if (!empty($results["result"][$key]["detail"])) {
                            
                            foreach ($results["result"][$key]["detail"] as $key_detail_biaya => $value_detail_biaya) {
                                $results["result"][$key]["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                            }
                        }
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
        $jenis_surat = $this->input->get("surat");
        $result['result'] = $this->Pengembangan_pelatihan_model->get_all(null, null, $offset, null);
        if (!empty($result['result'])) {
            foreach ($result["result"] as $key => $value) {
		$result["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["pengembangan_pelatihan_kegiatan"]);
        $result["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);                
		$result["result"][$key]["tanggal"] = $this->Pengembangan_pelatihan_kegiatan_model->by_id($value["id"]);
        $result["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
						             
		}
		}
		//print_r($result["result"][$key]["tanggal"][0]["id"]);die;
		$data = "test";
		if($jenis_surat=="laporan1"){
		$html = $this->load->view("laporan/laporan_1", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan2"){
		$html = $this->load->view("laporan/laporan_2", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan3"){
		$html = $this->load->view("laporan/laporan_3", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan4"){
		$html = $this->load->view("laporan/laporan_4", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan5"){
		$html = $this->load->view("laporan/laporan_5", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan6"){
		$html = $this->load->view("laporan/laporan_6", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan7"){
		$html = $this->load->view("laporan/laporan_7", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan8"){
		$html = $this->load->view("laporan/laporan_8", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan9"){
		$html = $this->load->view("laporan/laporan_9", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan10"){
		$html = $this->load->view("laporan/laporan_10", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan11"){
		$html = $this->load->view("laporan/laporan_11", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan12"){
		$html = $this->load->view("laporan/laporan_12", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan13"){
		$html = $this->load->view("laporan/laporan_13", array("result" => $result['result']), true);
        }else if($jenis_surat=="laporan14"){
		$html = $this->load->view("laporan/laporan_14", array("result" => $result['result']), true);
        }
        echo $html;
        die;
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
                // print_r($results);
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
                $tanggal = ($this->input->post("tanggal"))?$this->input->post("tanggal"):null;
                $tanggal_go = ($this->input->post("tanggal_go"))?$this->input->post("tanggal_go"):null;
                $hari_go = ($this->input->post("hari_go"))?$this->input->post("hari_go"):null;
                $tanggal_back = ($this->input->post("tanggal_back"))?$this->input->post("tanggal_back"):null;
                $hari_back = ($this->input->post("hari_back"))?$this->input->post("hari_back"):null;
				//print_r($hari_back);die();
                        
                $result = $this->Pengembangan_pelatihan_model->create($save);
                // echo "<pre>";
                // print_r($save);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                // die;
                if ($result){
                    $this->insert_detail($result->id, $detail);

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
                
				
                $detail = ($this->input->post("detail"))?$this->input->post("detail"):null;
                $tanggal = ($this->input->post("tanggal"))?$this->input->post("tanggal"):null;
                $tanggal_go = ($this->input->post("tanggal_go"))?$this->input->post("tanggal_go"):null;
                $hari_go = ($this->input->post("hari_go"))?$this->input->post("hari_go"):null;
                $tanggal_back = ($this->input->post("tanggal_back"))?$this->input->post("tanggal_back"):null;
                $hari_back = ($this->input->post("hari_back"))?$this->input->post("hari_back"):null;
				
                $result = $this->Pengembangan_pelatihan_model->update($save["id"], $save);
                if ($result){
                    // delete all pelatihan_detail
                    $this->Pengembangan_pelatihan_model->delete_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $result->id));
                    $this->Pengembangan_pelatihan_model->delete_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $result->id));

                    $this->insert_detail($result->id, $detail);

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
                print_r($arrdata);die();

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
                $this->Pengembangan_pelatihan_model->update($id, array("statue" => 2));

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
            if (!empty($result["detail"])) {
                foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                    $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                }
            }
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

    public function insert_detail($pengembangan_pelatihan_id, $detail)
    {   
        // echo "<pre>";
        // print_r($pengembangan_pelatihan_id);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($detail);
        // echo "</pre>";
        // die();
        if (!empty($detail) && is_array($detail)) {
            foreach ($detail as $key => $value) {
                $pengembangan_pelatihan_detail["pengembangan_pelatihan_id"] = $pengembangan_pelatihan_id;
                $pengembangan_pelatihan_detail["nopeg"] = $value["nopeg"];
                $pengembangan_pelatihan_detail["nip"] = $value["nip"];
				$pengembangan_pelatihan_detail["nik"] = $value["nik"];
				$pengembangan_pelatihan_detail["laporan_kegiatan"] = $value["laporan_kegiatan"];
                $pengembangan_pelatihan_detail["nama_pegawai"] = $value["nama_pegawai"];
                $pengembangan_pelatihan_detail["pangkat"] = $value["pangkat"];
                $pengembangan_pelatihan_detail["golongan"] = $value["golongan"];
                $pengembangan_pelatihan_detail["jabatan"] = $value["jabatan"];
                $pengembangan_pelatihan_detail["uraian_total"] = $value["uraian_total"];
				//print_r($pengembangan_pelatihan_detail);
                
				$detail_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail", $pengembangan_pelatihan_detail);
                // echo "<pre>";
                //print_r($detail_id);
                // echo "</pre>";
                // die();
                if ($detail_id) {
                    foreach ($value["detail_uraian"] as $key_detail_uraian => $value_detail_uraian) {
                        $pengembangan_pelatihan_detail_biaya["pengembangan_pelatihan_detail_id"] = $detail_id->id;
                        $pengembangan_pelatihan_detail_biaya["uraian"] = $value_detail_uraian["uraian"];
                        $pengembangan_pelatihan_detail_biaya["uraian_nominal"] = $value_detail_uraian["uraian_nominal"];
                        $pengembangan_pelatihan_detail_biaya["nominal"] = $value_detail_uraian["nominal"];
                        $pengembangan_pelatihan_detail_biaya["pernominal"] = $value_detail_uraian["pernominal"];
                        $pengembangan_pelatihan_detail_biaya["qty"] = $value_detail_uraian["qty"];
                        // insert detail biaya
                        $pengembangan_pelatihan_detail_biaya_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail_biaya", $pengembangan_pelatihan_detail_biaya);
                    }
                }
            }
        }
    }
}
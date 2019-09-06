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

class Surat extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('Surat_model');
        $this->load->model('Pengembangan_pelatihan_kegiatan_model');
        $this->load->model('Pengembangan_pelatihan_kegiatan_status_model');
        $this->load->model('System_auth_model');
    }

    public function preview_get()
    {
        $jenis_surat = $this->input->get("surat");
		$id = $this->input->get("id");
		$kode = $this->input->get("kode");
        $results = $this->Surat_model->get_all(array("surat.id" => $id), null, $offset, $limit);
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
            $tanggal = $this->Surat_model->get_detail("surat_pelaksanaan", array("surat_id" => $result["id"]));
            $result["tanggal"] = $tanggal;
            $result["tanggal"]["tanggal_now"] = bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["tanggal"]["tanggal_from"] = date("d",strtotime($result["tanggal"][0]["tanggal_from"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_from"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_from"]));
            $result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            $result["tanggal"]["day_to"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_to"])));
            $result["tanggal"]["day_from"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_from"])));
            $result["aprove_phl"] = $this->Surat_model->get_phl($result["phl"]);
            
			// print_r($result);die;
			$result["footer"]=true;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            if(!empty($kode)){
			$result["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($kode);
			}
			
        }
       //print_r($result);die;
        //$this->load->library("pdf");
        $data = "test";
        if ($result['jenis_perjalanan'] == "Dalam Negeri") {
        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
				$html = $this->load->view("view_pdf_0", array("result" => $result), true);
				
			} else if ($result["jenis"] == "Individu"){
				$html = $this->load->view("view_pdf_1", array("result" => $result), true);
				
			}
        } else if ($result['jenis_surat'] == "Surat Izin") {
			$html = $this->load->view("view_pdf_5", array("result" => $result), true);
			
		}
		}else{
		if ($result['jenis_surat'] == "Surat Tugas") {
			$html = $this->load->view("view_pdf_9", array("result" => $result), true);
			
        } else if ($result['jenis_surat'] == "Surat Izin") {
			$html = $this->load->view("view_pdf_10", array("result" => $result), true);
			
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
        $results = $this->Surat_model->get_all(array("surat.id" => $id), null, $offset, $limit);
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
            $tanggal = $this->Surat_model->get_detail("surat_pelaksanaan", array("surat_id" => $result["id"]));
            $result["tanggal"] = $tanggal;
            $result["tanggal"]["tanggal_now"] = bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["tanggal"]["tanggal_from"] = date("d",strtotime($result["tanggal"][0]["tanggal_from"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_from"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_from"]));
            $result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            $result["tanggal"]["day_to"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_to"])));
            $result["tanggal"]["day_from"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_from"])));
            $result["aprove_phl"] = $this->Surat_model->get_phl($result["phl"]);
            
				
				//if (!empty($result["detail"])) {
                    //foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        //$result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
						//$result["count_detail"] = count($result["detail"][$key_detail_biaya]["detail_uraian"]);
                    //}
                //}
            
        }
        //print_r($result);die;
        $this->load->library("pdf");
        $data = "test";
		$kertas="A4";
		if ($result['jenis_perjalanan'] == "Dalam Negeri") {
        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
			} else if ($result["jenis"] == "Individu"){
                $html = $this->load->view("view_pdf_1", array("result" => $result), true);
			}
        } else if ($result['jenis_surat'] == "Surat Izin") {
			$html = $this->load->view("view_pdf_5", array("result" => $result), true);
			}
		}else{
		if ($result['jenis_surat'] == "Surat Tugas") {			
                $html = $this->load->view("view_pdf_9", array("result" => $result), true);
				$kertas="Legal";
        } else if ($result['jenis_surat'] == "Surat Izin") {
            	$html = $this->load->view("view_pdf_10", array("result" => $result), true);
				$kertas="Legal";
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

    public function list_get($offset = 0, $param_search = "", $dari="", $sampai="")
    {
        $search = null;
        $limit = 200;
        $order_by = "surat.id";
        $headers = $this->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                if (!empty($param_search)) {
                    $cari = urldecode($param_search);
                }if (!empty($dari)) {
                    $mulai = date("Y-m-d", strtotime($dari));
                }if (!empty($sampai)) {
                    $hingga = date("Y-m-d", strtotime($sampai));
                }
				
                $results['result'] = $this->Surat_model->get_list(null, $search, $offset, $limit, $mulai, $hingga, null, $order_by, $cari);
                //print_r($results['result']);die();
				// echo $this->db->last_query();die;
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
					
						$results["result"][$key]["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($value["kegiatan"]);
                        $results["result"][$key]["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($value["pengembangan_pelatihan_kegiatan_status"]);
                        $results["result"][$key]["pengembangan_pelatihan_detail"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by($value["kode"]);
                        $results["result"][$key]["tanggal"] = $this->Surat_model->get_detail("surat_pelaksanaan", array("surat_id" => $value["id"]));
                        $results["result"][$key]["detail"] = $this->Surat_model->get_detail("surat_detail", array("surat_id" => $value["id"]));
                        $results["result"][$key]["detail_uraian"] = $this->Surat_model->get_detail("surat_detail_biaya", array("surat_detail_id" => $value["id"]));
						if (!empty($results["result"][$key]["detail_uraian"])) {
						    foreach ($results["result"][$key]["detail_uraian"] as $key_detail_biaya => $value_detail_biaya) {
						
						if(substr($value_detail_biaya["uraian"],0,13)!="Akomodasi Gol"){
						if("Akomodasi Gol ".substr($results["result"][$key]["pengembangan_pelatihan_detail"]->golongan,0,-2)!=$value_detail_biaya["uraian"]){
						$results["result"][$key]["nominal"] += $value_detail_biaya["pernominal"];
						}//else if("Registrasi + Akomodasi"!=$value_detail_biaya["uraian"]){
						//$results["result"][$key]["nominal"] += $value_detail_biaya["pernominal"];
						//}
						}
						if("Akomodasi Gol ".substr($results["result"][$key]["pengembangan_pelatihan_detail"]->golongan,0,-2)==$value_detail_biaya["uraian"]){
						$results["result"][$key]["nominal_gol"] = $value_detail_biaya["pernominal"];
						}//else if("Registrasi + Akomodasi"==$value_detail_biaya["uraian"]){
						//$results["result"][$key]["nominal_gol"] = $value_detail_biaya["pernominal"];
						//}
						$results["result"][$key]["pernominal"]=$results["result"][$key]["nominal_gol"]+$results["result"][$key]["nominal"];
						}
						}

						
						if (!empty($results["result"][$key]["tanggal"])) {
						    foreach ($results["result"][$key]["tanggal"] as $key_detail_tanggal => $value_detail_tanggal) {
                                if ($value_detail_tanggal["tanggal_to"]!=$value_detail_tanggal["tanggal_from"]) {
								$results["result"][$key]["tanggal_from"] = $value_detail_tanggal["tanggal_from"].' s/d '.$value_detail_tanggal["tanggal_to"];
								}else{
								$results["result"][$key]["tanggal_from"] = $value_detail_tanggal["tanggal_from"];
								}
								$tanggal = date('d-m-Y');
								$besok = date('d-m-Y', strtotime("+5 day", strtotime($value_detail_tanggal["tanggal_to"])));
								$from = date('d-m-Y', strtotime("-1 day", strtotime($value_detail_tanggal["tanggal_from"])));
								$to = date('d-m-Y', strtotime("+1 day", strtotime($value_detail_tanggal["tanggal_to"])));
								if(strtotime($tanggal)>strtotime($value_detail_tanggal["tanggal_from"])){
								if (strtotime($tanggal)>strtotime($value_detail_tanggal["tanggal_to"])){
								if(strtotime($tanggal)<strtotime($besok)){
								if($value["laporan_kegiatan"]==1){
								$results["result"][$key]["laporan"] = "Menunggu Laporkan";
								}else{
								$results["result"][$key]["laporan"] = "Sudah Melaporkan";
								}
								}else if (strtotime($tanggal)>strtotime($besok)){
								if($value["laporan_kegiatan"]==1){
								$results["result"][$key]["laporan"] = "Belum Melaporkan";
								}else{
								$results["result"][$key]["laporan"] = "Sudah Melaporkan";
								}
								}
								}
								if($value["laporan_kegiatan"]==1){
								$results["result"][$key]["laporan"] = "Belum Melaporkan";
								}else{
								$results["result"][$key]["laporan"] = "Sudah Melaporkan";
								}
								}if(strtotime($from) <= strtotime($tanggal) && strtotime($to) >= strtotime($tanggal)){
								$results["result"][$key]["laporan"] = "Melakukan Kegiatan";							
								}else if(strtotime($value_detail_tanggal["tanggal_from"]) >= strtotime($tanggal) && strtotime($value_detail_tanggal["tanggal_to"]) >= strtotime($tanggal)){
								$results["result"][$key]["laporan"] = "Pengajuang Baru";
								}
								
								
							}
                        }
                    }
                }
				$results['cari'] = $this->Surat_model->get_total($mulai, $hingga, null, $cari);
				//print_r($results['cari']);die();
				$results['total'] = $results['cari'][0]['count'];
				$results["query"] = $this->db->last_query();
                $results['limit'] = $limit;
                $results["is_blocked"] = $this->Surat_model->is_blocked($decodedToken->data->NIP);
                $results["is_monev"] = $this->Surat_model->is_monev($decodedToken->data->NIP);
                // echo "<pre>";
              //
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
                $id_parent = $this->System_auth_model->getparent($decodedToken->data->_pnc_id_grup, '1');
                // echo "<pre>";
				// echo "</pre>";
                // die;
                $save["id_atasan"] = $id_parent;
                $save["id_uk"] = $decodedToken->data->_pnc_id_grup;
                $save["status"] = 102;
				
				
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
                $result = $this->Surat_model->create($save);
                // echo "<pre>";
                // print_r($save);
                // echo "</pre>";
                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                // die;
				if ($result->id) {
					for ($i = 0; $i < $jumlah ; $i++) {
		                $surat_detail_biaya["surat_detail_id"] = $result->id;
                        $surat_detail_biaya["uraian"] = $biaya["biaya_uraian"][$i]["value"]?$biaya["biaya_uraian"][$i]["value"]:null;
                        $surat_detail_biaya["uraian_nominal"] = $biaya["uraian_nominal"][$i]["value"]?$biaya["uraian_nominal"][$i]["value"]:null;
                        $surat_detail_biaya["nominal"] = preg_replace("/[^0-9]/", "", $biaya["total_nominal"][$i]["value"]);
                        $surat_detail_biaya["pernominal"] = preg_replace("/[^0-9]/", "", $biaya["biaya_pernominal"][$i]["value"]?$biaya["biaya_pernominal"][$i]["value"]:0);
                        $surat_detail_biaya["qty"] = $biaya["qty_nominal"][$i]["value"];
                        $surat_detail_biaya["orang"] = $biaya["orang"][$i]["value"]?$biaya["orang"][$i]["value"]:null;
                        $surat_detail_biaya["total"] = preg_replace("/[^0-9]/", "", $biaya["total"][$i]["value"]?$biaya["total"][$i]["value"]:0);
                        $surat_detail_biaya["muncul"] = $biaya["muncul"][$i]["value"]?$biaya["muncul"][$i]["value"]:0;
                        $nominal += $surat_detail_biaya["nominal"];
                        $total += $surat_detail_biaya["total"];
						// insert detail biaya
						//print_r($pengembangan_pelatihan_detail_biaya);die();
						$surat_detail_biaya_id = $this->Surat_model->create_detail_row("surat_detail_biaya", $surat_detail_biaya);
					}
				}
						
				$pengembangan_pelatihan_update = $this->Surat_model->update($result->id, array("total" => $total));
				
				$date= date("y-m-d");
				// NOMOR URUT ORDER
				$re = $this->Surat_model->get_no_berks();
				$noberks = $re[0]["no_berkas"];
				//print_r($result);die();
				$noUrut = (int) substr($noberks, 5, 2);
				$noUrut++;
				$tahun=substr($date, 0, 2);
				$bulan=substr($date, 3, 2);
                $no_berkas = $tahun .$bulan .'.'. sprintf("%02s", $noUrut);
                
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
							
							if(empty($jam_sampai)){
							$tanggal_diff = $total_hari_kerja * 8;
							}else{
							$date_awal  = new DateTime($jam_mulai);
							$date_akhir = new DateTime($jam_sampai);
							$selisih = $date_akhir->diff($date_awal);

							$jam = $selisih->format('%h');
							$menit = $selisih->format('%i');
							 
							if($menit >= 0 && $menit <= 9){
							   $menit = "0".$menit;
							}
							 
							$hasil = $jam.".".$menit;
							$hasil = number_format($hasil,2);
							if($hasil>=8){
							$tanggal_diff = $total_hari_kerja * 8;
							}else{
							$tanggal_diff = $total_hari_kerja * $jam;
							}
							}
							$surat_pelaksanaan[$key]["surat_id"] = $result->id;
                            $surat_pelaksanaan[$key]["tanggal_from"] = @$tanggal_explode[0];
                            $surat_pelaksanaan[$key]["tanggal_too"] = date('Y-m-d', strtotime(@$tanggal_explode[1]));
                            $surat_pelaksanaan[$key]["tanggal_to"] = @$tanggal_explode[1];
                            $surat_pelaksanaan[$key]["tanggal_go"] = @$tanggal_go[0];
                            $surat_pelaksanaan[$key]["tanggal_go1"] = @$tanggal_go[1];
                            $surat_pelaksanaan[$key]["hari_go"] = $hari_go;
							$surat_pelaksanaan[$key]["tanggal_back"] = @$tanggal_back[0];
                            $surat_pelaksanaan[$key]["tanggal_back1"] = @$tanggal_back[1];
                            $surat_pelaksanaan[$key]["hari_back"] = $hari_back;
							$surat_pelaksanaan[$key]["total_jam"] = $tanggal_diff;
								//print_r($pengembangan_pelatihan_pelaksanaan[$key]);die();
                        }
                        $this->Surat_model->create_detail("surat_pelaksanaan", $surat_pelaksanaan);
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
                $result = $this->Surat_model->update_de($save["id"], $save);
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
				$this->Surat_model->delete_detail_row("surat_detail_biaya", array("surat_detail_id" => $result->id));
                 
				if ($result->id) {
					for ($i = 0; $i < $jumlah ; $i++) {
		                $pengembangan_pelatihan_detail_biaya["surat_detail_id"] = $result->id;
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
						$pengembangan_pelatihan_detail_biaya_id = $this->Surat_model->create_detail_row("surat_detail_biaya", $pengembangan_pelatihan_detail_biaya);
					}
				}
				$date= date("y-m-d");
				// NOMOR URUT ORDER
				$re = $this->Surat_model->get_no_berks();
				$noberks = $re[0]["no_berkas"];
				//print_r($result);die();
				$noUrut = (int) substr($noberks, 5, 2);
				$noUrut++;
				$tahun=substr($date, 0, 2);
				$bulan=substr($date, 3, 2);
                $no_berkas = $tahun .$bulan .'.'. sprintf("%02s", $noUrut);
                
				
				$pengembangan_pelatihan_update = $this->Surat_model->update($result->id, array("total" => $total));
				//print_r($result->id);die();
						
				if ($result){
                    // delete all pelatihan_detail
                    $this->Surat_model->delete_detail_row("surat_detail", array("surat_id" => $result->id));
                    $this->Surat_model->delete_detail_row("surat_pelaksanaan", array("surat_id" => $result->id));

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
                            if(empty($jam_sampai)){
							$tanggal_diff = $total_hari_kerja * 8;
							}else{
							$date_awal  = new DateTime($jam_mulai);
							$date_akhir = new DateTime($jam_sampai);
							$selisih = $date_akhir->diff($date_awal);

							$jam = $selisih->format('%h');
							$menit = $selisih->format('%i');
							 
							if($menit >= 0 && $menit <= 9){
							   $menit = "0".$menit;
							}
							 
							$hasil = $jam.".".$menit;
							$hasil = number_format($hasil,2);
							if($hasil>=8){
							$tanggal_diff = $total_hari_kerja * 8;
							}else{
							$tanggal_diff = $total_hari_kerja * $jam;
							}
							}
                            $pengembangan_pelatihan_pelaksanaan[$key]["surat_id"] = $result->id;
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
                        $this->Surat_model->create_detail("surat_pelaksanaan", $pengembangan_pelatihan_pelaksanaan);
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
                $this->Surat_model->delete($id);

                $response['hasil'] = 'success';
                $response['message'] = 'Data berhasil dihapus!';
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
                $this->Surat_model->update_pegawai($id, array("statue" => 0));

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
        $result = $this->Surat_model->get_all(array("surat.id" => $id), null, $offset, $limit);

        if (!empty($result)) {
            $results["success"] = true;
            $result = $result[0];
            $tanggal = $this->Surat_model->get_detail("surat_pelaksanaan", array("surat_id" => $result["id"]));
            $result["tanggal"] = $tanggal;
            // print_r($result);die;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            $result["detail"] = $this->Surat_model->get_detail("surat_detail", array("surat_id" => $result["id"]));
            $result["detail_uraian"] = $this->Surat_model->get_detail("surat_detail_biaya", array("surat_detail_id" => $result["id"]));

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
                $surat_detail["surat_id"] = $pengembangan_pelatihan_id;
                if(!empty($value["berkas"])){
				$surat_detail["berkas"] = $value["berkas"];
                }else{
				$surat_detail["berkas"] = $no_berkas;
				}
				$surat_detail["nopeg"] = $value["nopeg"];
                $surat_detail["nip"] = $value["nip"];
				$surat_detail["nik"] = $value["nik"];
				$surat_detail["laporan_kegiatan"] = $value["laporan_kegiatan"];
                $surat_detail["nama_pegawai"] = $value["nama_pegawai"];
                $surat_detail["pangkat"] = $value["pangkat"];
                $surat_detail["golongan"] = $value["golongan"];
                //$pengembangan_pelatihan_detail["akomodasi"] = $value["akomodasi"]?$value["akomodasi"]:null;
                $surat_detail["jabatan"] = $value["jabatan"];
                //print_r($pengembangan_pelatihan_detail);
                //print_r($pengembangan_pelatihan_detail);die();
				$detail_id = $this->Surat_model->create_detail_row("surat_detail", $surat_detail);
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
                $this->db->where('his_cuti.id_user', $nopeg);
                $this->db->where('his_cuti.status', '103');
				$this->db->where("his_cuti.tgl_cuti <=", $from);
				$this->db->where("his_cuti.tgl_akhir_cuti >=", $to);
				$cek_cuti=$this->db->get('his_cuti')->row();
                
				$this->db->where('pengembangan_pelatihan_detail.nopeg', $nopeg);
				$this->db->where("pengembangan_pelatihan_pelaksanaan.tanggal_from <=", $from);
				$this->db->where("pengembangan_pelatihan_pelaksanaan.tanggal_to >=", $to);
				$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_detail.pengembangan_pelatihan_id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
				$this->db->join("pengembangan_pelatihan", "pengembangan_pelatihan_detail.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
				$cek=$this->db->get('pengembangan_pelatihan_detail')->row();
              
				$this->db->where('surat_detail.nopeg', $nopeg);
				$this->db->where("surat_pelaksanaan.tanggal_from <=", $from);
				$this->db->where("surat_pelaksanaan.tanggal_to >=", $to);
				$this->db->join("surat_pelaksanaan", "surat_detail.surat_id = surat_pelaksanaan.surat_id");
				$this->db->join("surat", "surat_detail.surat_id = surat.id");
				$cek_surat=$this->db->get('surat_detail')->row();
                //print_r($from);die();
				   if (empty($cek)) {
                    if (empty($cek_cuti)) {
					if (empty($cek_surat)) {
                        $arr['hasil'] = 'success';
                    } else {
                        $arr['hasil'] = 'error';
                        $arr['message'] = 'Yang bersangkutan telah dibuatkan surat tugas / surat izin pada tanggal '.$cek->nama_pelatihan.' pada tanggal '.$cek->tanggal_from.' s/d '.$cek->tanggal_to.' yang diselenggarakan oleh '.$cek->institusi.' di '.$cek->tujuan;
                    }
					}else {
                        $arr['hasil'] = 'eror';
                        $arr['message'] = 'Yang bersangkutan sedang cuti pada tanggal '.date_format(date_create($cek_cuti->tgl_cuti), "d-m-Y").' s/d '.date_format(date_create($cek_cuti->tgl_akhir_cuti), "d-m-Y");
                    }
				   }else {
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
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
        $id = $this->input->get("id");
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
            $result["tanggal"]["tanggal_now"] = date("d") ." ". bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            $result["tanggal"]["day_to"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_to"])));
            $result["tanggal"]["day_from"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_from"])));
            // print_r($result);die;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            foreach ($results as $key => $value) {
                $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                if (!empty($result["detail"])) {
                    foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                    }
                }
            }
        }
        // print_r($result);die;
        //$this->load->library("pdf");
        $data = "test";
        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
            } else if ($result["jenis"] == "Individu"){
                $html = $this->load->view("view_pdf_1", array("result" => $result), true);
            }
        } else if ($result['jenis_surat'] == "Surat Izin") {
            $html = $this->load->view("view_pdf_2", array("result" => $result), true);
        } else if ($result['jenis_surat'] == "SPD") {
            $html = $this->load->view("suratspd", array("result" => $result), true);
        } else if ($result['jenis_surat'] == "RAK") {
            $html = $this->load->view("surat", array("result" => $result), true);
        }
        
        echo $html;
        die;
    }

    public function cetak_get()
    {
        $id = $this->input->get("id");
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
            $result["tanggal"]["tanggal_now"] = date("d") ." ". bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            $result["tanggal"]["day_to"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_to"])));
            $result["tanggal"]["day_from"] = hari_indo(date("D",strtotime($result["tanggal"][0]["tanggal_from"])));
            // print_r($result);die;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            foreach ($results as $key => $value) {
                $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                if (!empty($result["detail"])) {
                    foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                        $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                    }
                }
            }
        }
        // print_r($result);die;
        $this->load->library("pdf");
        $data = "test";

        if ($result['jenis_surat'] == "Surat Tugas") {
            if ($result["jenis"] == "Kelompok") {
                $html = $this->load->view("view_pdf_0", array("result" => $result), true);
            } else if ($result["jenis"] == "Individu"){
                $html = $this->load->view("view_pdf_1", array("result" => $result), true);
            }
        } else if ($result['jenis_surat'] == "Surat Izin") {
            $html = $this->load->view("view_pdf_2", array("result" => $result), true);
        } else if ($result['jenis_surat'] == "SPD") {
            $html = $this->load->view("suratspd", array("result" => $result), true);
        }else if ($result['jenis_surat'] == "RAK") {
            $html = $this->load->view("surat", array("result" => $result), true);
        }
        
        // echo $html;
        // die;

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper("legal", ($orientation = "P" ));
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->render();
        $name = "download jenis surat";
        $this->pdf->stream($name, array("Attachment" => 1));
        // return true;
    }

    public function cetak_rekomendasi_get()
    {
        // echo date("d") ." ". bulan(date("m")) ." ". date("Y"); die();
        $id = $this->input->get("id");
        $results = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);
        // print_r($results);die;
        if (!empty($results)) {
            $result = $results[0];
            if ($result["jenis_biaya"] == "Sponsor") {
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
            $result["tanggal"]["tanggal_now"] = date("d") ." ". bulan(date("m")) ." ". date("Y");
            $result["tanggal"]["tanggal_to"] = date("d",strtotime($result["tanggal"][0]["tanggal_to"]))." ".bulan(date("m",strtotime($result["tanggal"][0]["tanggal_to"]))) ." ".date("Y",strtotime($result["tanggal"][0]["tanggal_to"]));
            $result["created"]["date"] = date("d",strtotime($result["created"]))." ".bulan(date("m",strtotime($result["created"]))) ." ".date("Y",strtotime($result["created"]));
            // print_r($result["tanggal"]["tanggal_to"]);die;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            foreach ($results as $key => $value) {
                $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $value["id"]));
                // if (!empty($result["detail"])) {
                //     // foreach ($result["detail"] as $key_detail => $value_detail) {
                //         // $result["detail"][0] = $value_detail;
                //         // print_r($result["detail"][0]);die;
                        $this->load->library("pdf");
                        $html = $this->load->view("view_pdf_3", array("result" => $result), true);
                        // echo $html;
                        // die;
                        $customPaper = array(0,0,210,330);
                        $this->pdf->loadHtml($html);
                        // $this->pdf->setPaper($customPaper);
                        $this->pdf->setPaper("legal", ($orientation = "P" ));
                        $this->pdf->set_option("isPhpEnabled", true);
                        $this->pdf->set_option("isHtml5ParserEnabled", true);
                        $this->pdf->render();
                        $name = "download rekomendasi";
                        $this->pdf->stream($name, array("Attachment" => 1));
                //     // }
                // }
            }
            
        }

            // for ($i=0; $i < count($result["detail"]); $i++) { 
            //     # code...
            // }
            // echo count($result["detail"]);
            // print_r($result);
            // die;
            // echo $html;
            // die;
    }


        
    }

    public function list_get($offset = 0, $param_search = "")
    {
        $search = null;
        $limit = 10;
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

                $save["nama_pelatihan"] = ($nama_pelatihan)?$nama_pelatihan:null;
                $save["tujuan"] = ($tujuan)?$tujuan:null;
                $save["institusi"] = ($institusi)?$institusi:null;
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
                
                // 195 = direktur SDM
                $id_parent = $this->System_auth_model->getparent($decodedToken->data->_pnc_id_grup, '195');
                // echo "<pre>";
                // print_r($id_parent);
                // echo "</pre>";
                // die;
                $save["id_atasan"] = $id_parent;
                $save["id_uk"] = $decodedToken->data->_pnc_id_grup;
                $save["status"] = 102;

                $detail = ($this->input->post("detail"))?$this->input->post("detail"):null;
                $tanggal = ($this->input->post("tanggal"))?$this->input->post("tanggal"):null;

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
                            $tanggal_1 = @$value["value"];
                            $tanggal_explode = explode(" - ", $tanggal_1);
                            // dibagi 24jam x 8 jam
                            $tanggal_diff = (strtotime($tanggal_explode[1]) - strtotime($tanggal_explode[0])) / 86400 * 8;
                            $pengembangan_pelatihan_pelaksanaan[$key]["pengembangan_pelatihan_id"] = $result->id;
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_from"] = @$tanggal_explode[0];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_to"] = @$tanggal_explode[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["total_jam"] = $tanggal_diff;                            
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

                $save["id"] = ($id)?$id:null;
                $save["nama_pelatihan"] = ($nama_pelatihan)?$nama_pelatihan:null;
                $save["tujuan"] = ($tujuan)?$tujuan:null;
                $save["institusi"] = ($institusi)?$institusi:null;
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
                
                $detail = ($this->input->post("detail"))?$this->input->post("detail"):null;
                $tanggal = ($this->input->post("tanggal"))?$this->input->post("tanggal"):null;                

                $result = $this->Pengembangan_pelatihan_model->update($save["id"], $save);
                if ($result){
                    // delete all pelatihan_detail
                    $this->Pengembangan_pelatihan_model->delete_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $result->id));
                    $this->Pengembangan_pelatihan_model->delete_detail("pengembangan_pelatihan_pelaksanaan", array("pengembangan_pelatihan_id" => $result->id));

                    $this->insert_detail($result->id, $detail);

                    if (!empty($tanggal)) {
                        foreach ($tanggal as $key => $value) {
                            $tanggal_1 = @$value["value"];
                            $tanggal_explode = explode(" - ", $tanggal_1);
                            // dibagi 24jam x 8 jam
                            $tanggal_diff = (strtotime($tanggal_explode[1]) - strtotime($tanggal_explode[0])) / 86400 * 8;
                            $pengembangan_pelatihan_pelaksanaan[$key]["pengembangan_pelatihan_id"] = $result->id;
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_from"] = @$tanggal_explode[0];
                            $pengembangan_pelatihan_pelaksanaan[$key]["tanggal_to"] = @$tanggal_explode[1];
                            $pengembangan_pelatihan_pelaksanaan[$key]["total_jam"] = $tanggal_diff;                            
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
                $pengembangan_pelatihan_detail["nama_pegawai"] = $value["nama_pegawai"];
                $pengembangan_pelatihan_detail["pangkat"] = $value["pangkat"];
                $pengembangan_pelatihan_detail["golongan"] = $value["golongan"];
                $pengembangan_pelatihan_detail["jabatan"] = $value["jabatan"];
                $pengembangan_pelatihan_detail["uraian_total"] = $value["uraian_total"];

                $detail_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail", $pengembangan_pelatihan_detail);
                // echo "<pre>";
                // print_r($detail_id);
                // echo "</pre>";
                // die();
                if ($detail_id) {
                    foreach ($value["detail_uraian"] as $key_detail_uraian => $value_detail_uraian) {
                        $pengembangan_pelatihan_detail_biaya["pengembangan_pelatihan_detail_id"] = $detail_id->id;
                        $pengembangan_pelatihan_detail_biaya["uraian"] = $value_detail_uraian["uraian"];
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
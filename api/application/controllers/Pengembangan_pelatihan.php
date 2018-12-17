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

    public function cetak_get()
    {
        $id = $this->input->get("id");
        $result = $this->Pengembangan_pelatihan_model->get_all(array("pengembangan_pelatihan.id" => $id), null, $offset, $limit);

        if (count($result) == 1) {
            $result = $result[0];
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
            // print_r($result);die;
            $result["pengembangan_pelatihan_kegiatan"] = $this->Pengembangan_pelatihan_kegiatan_model->get_by_id($result["pengembangan_pelatihan_kegiatan"]);
            $result["pengembangan_pelatihan_kegiatan_status"] = $this->Pengembangan_pelatihan_kegiatan_status_model->get_by_id($result["pengembangan_pelatihan_kegiatan_status"]);
            $result["detail"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail", array("pengembangan_pelatihan_id" => $result["id"]));
            if (!empty($result["detail"])) {
                foreach ($result["detail"] as $key_detail_biaya => $value_detail_biaya) {
                    $result["detail"][$key_detail_biaya]["detail_uraian"] = $this->Pengembangan_pelatihan_model->get_detail("pengembangan_pelatihan_detail_biaya", array("pengembangan_pelatihan_detail_id" => $value_detail_biaya["id"]));
                }
            }
        }

        $this->load->library("pdf");
        $data = "test";
        $html = $this->load->view("view_pdf", array("result" => $result), true);


        // echo $html;
        // die;

        $this->pdf->loadHtml($html);
        $this->pdf->setPaper("A4", ($orientation = "P" ));
        $this->pdf->set_option("isPhpEnabled", true);
        $this->pdf->set_option("isHtml5ParserEnabled", true);
        $this->pdf->render();
        $name = "download";
        $this->pdf->stream($name, array("Attachment" => 1));
        // return true;
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
                $save["nama_pelatihan"] = $this->input->post("nama_pelatihan");
                $save["tujuan"] = $this->input->post("tujuan");
                $save["institusi"] = $this->input->post("institusi");
                $save["no_disposisi"] = $this->input->post("no_disposisi");
                $save["laporan"] = $this->input->post("laporan");
                $save["monev"] = $this->input->post("monev");
                $save["jenis"] = $this->input->post("jenis");
                $save["jenis_biaya"] = $this->input->post("jenis_biaya");
                $save["jenis_perjalanan"] = $this->input->post("jenis_perjalanan");
                $save["dalam_negeri"] = $this->input->post("dalam_negeri");
                $save["surat_tugas_dalam_negeri_dalamkota"] = $this->input->post("surat_tugas_dalam_negeri_dalamkota");
                $save["surat_tugas_dalam_negeri_luarkota"] = $this->input->post("surat_tugas_dalam_negeri_luarkota");
                $save["surat_tugas_luar_negeri"] = $this->input->post("surat_tugas_luar_negeri");
                $save["total_hari_kerja"] = $this->input->post("total_hari_kerja");
                $save["pengembangan_pelatihan_kegiatan"] = $this->input->post("pengembangan_pelatihan_kegiatan");
                $save["pengembangan_pelatihan_kegiatan_status"] = $this->input->post("pengembangan_pelatihan_kegiatan_status");
                // 18 = direktur SDM
                $id_parent = $this->System_auth_model->getparent($decodedToken->data->_pnc_id_grup, '18');
                $save["id_atasan"] = $id_parent;
                $save["id_uk"] = $decodedToken->data->_pnc_id_grup;
                $save["status"] = 102;

                $detail = $this->input->post("detail");
                $tanggal = $this->input->post("tanggal");
                
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
                $id = $this->input->post("id");
                $status = $this->input->post("status");
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
                $save["id"] = $this->input->post("id");
                $save["nama_pelatihan"] = $this->input->post("nama_pelatihan");
                $save["tujuan"] = $this->input->post("tujuan");
                $save["institusi"] = $this->input->post("institusi");
                $save["no_disposisi"] = $this->input->post("no_disposisi");
                $save["laporan"] = $this->input->post("laporan");
                $save["monev"] = $this->input->post("monev");
                $save["jenis"] = $this->input->post("jenis");
                $save["jenis_biaya"] = $this->input->post("jenis_biaya");
                $save["jenis_perjalanan"] = $this->input->post("jenis_perjalanan");
                $save["dalam_negeri"] = $this->input->post("dalam_negeri");
                $save["surat_tugas_dalam_negeri_dalamkota"] = $this->input->post("surat_tugas_dalam_negeri_dalamkota");
                $save["surat_tugas_dalam_negeri_luarkota"] = $this->input->post("surat_tugas_dalam_negeri_luarkota");
                $save["surat_tugas_luar_negeri"] = $this->input->post("surat_tugas_luar_negeri");
                $save["total_hari_kerja"] = $this->input->post("total_hari_kerja");
                $save["pengembangan_pelatihan_kegiatan"] = $this->input->post("pengembangan_pelatihan_kegiatan");
                $save["pengembangan_pelatihan_kegiatan_status"] = $this->input->post("pengembangan_pelatihan_kegiatan_status");
                
                $detail = $this->input->post("detail");
                $tanggal = $this->input->post("tanggal");                

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

        if (count($result) == 1) {
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

                if ($detail_id) {
                    foreach ($value["detail_uraian"] as $key_detail_uraian => $value_detail_uraian) {
                        $pengembangan_pelatihan_detail_biaya["pengembangan_pelatihan_detail_id"] = $detail_id->id;
                        $pengembangan_pelatihan_detail_biaya["uraian"] = $value_detail_uraian["uraian"];
                        $pengembangan_pelatihan_detail_biaya["nominal"] = $value_detail_uraian["nominal"];
                        // insert detail biaya
                        $pengembangan_pelatihan_detail_biaya_id = $this->Pengembangan_pelatihan_model->create_detail_row("pengembangan_pelatihan_detail_biaya", $pengembangan_pelatihan_detail_biaya);
                    }
                }
            }
        }
    }
}
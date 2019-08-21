<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require APPPATH . '/libraries/REST_Controller.php';
$rest_json = file_get_contents("php://input");

$_POST = json_decode($rest_json, true);

class Cuti extends REST_Controller
{ 
    function __construct(){
            parent::__construct();
            //load our second db and put in $db2
            $this->db2 = $this->load->database('second', TRUE);
        }

	function listcuti_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {

				$thn = date('Y');
				
                $id_user = $this->input->get('id_user');
                $this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,dm_term.nama as statuspros');
                $this->db->join('m_jenis_cuti', 'm_jenis_cuti.id = his_cuti.jenis_cuti');
                $this->db->join('dm_term', 'dm_term.id = his_cuti.status');
                $this->db->where('id_user', $id_user);
				$this->db->where('EXTRACT(YEAR FROM his_cuti.tgl_cuti) =',$thn);
                $this->db->where('his_cuti.tampilkan', '1');
                $this->db->order_by('tgl_cuti', 'DESC');
                $resCek = $this->db->get('his_cuti')->result();
                // print_r($resCek);die();
                $da = '';
                foreach ($resCek as $val) {
                    $text = 'text-success';
                    if ($val->status == '108') {
                        $text = 'text-danger';
                    }
                    $da .= '<tr>';
                    $da .= '<td>';
                    $da .= $val->namcut;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_akhir_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->total;
                    $da .= '</td>';
                    $da .= '<td class="' . $text . '">';
                    $da .= $val->statuspros;
                    $da .= '</td>';
                    $da .= '<td><a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\')">';
                    $da .= 'Hapus';
                    $da .= '</a></td>';
                    $da .= '</tr>';
                }

                $arr['hasil'] = 'success';
                $arr['isi'] = $da;
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);


    }


    function cekcuti_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id_cuti = $this->input->get('id');
                $id_user = $this->input->get('id_user');
                $tahun = date('Y');
                $tahunskrg = $tahun;
                $tahunlalu = ($tahun - 1);

                $this->db->where('id', $id_cuti);
                $this->db->where('tampilkan', '1');
                $res = $this->db->get('m_jenis_cuti')->row();
                $kd_jenis_cuti = $res->abid;

                $this->db->where('abid', $kd_jenis_cuti);
                $this->db->where('tampilkan', '1');
                $this->db->where('tahun', $tahunskrg);
                $resMaxSkrg = $this->db->get('m_jenis_cuti')->row();
                $max_cuti_skrg = $resMaxSkrg->jumlah;

                $this->db->select('sum(total) as total_cuti');
                $this->db->where('jenis_cuti', $id_cuti);
                $this->db->where('id_user', $id_user);
                $this->db->where('status != 108');
                $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', $tahun);
                $this->db->where('tampilkan', '1');
                $resCekSkrg = $this->db->get('his_cuti')->row();
				$cuti_skrg = $resCekSkrg->total_cuti;

                if ($kd_jenis_cuti == 'AB_CTNS' || $kd_jenis_cuti == 'AB_CTS') {
                	$this->db->where('id_user', $id_user);
	                $resShift = $this->db->get('sys_user')->row();
	                $status_shift = $resShift->id_shift;

	                if (empty($status_shift)) {
	                    $arr['warning'] = 'Anda Belum Mengisi Status Shift!';
	                    return $this->set_response($arr, REST_Controller::HTTP_OK);
	                }

	                if ($kd_jenis_cuti == 'AB_CTNS' && $status_shift == '50') {
	                    $arr['warning'] = 'Anda Tidak Dapat Mengajukan Cuti Untuk Nonshift!';
	                    return $this->set_response($arr, REST_Controller::HTTP_OK);
	                }

	                if ($kd_jenis_cuti == 'AB_CTS' && $status_shift == '51') {
	                    $arr['warning'] = 'Anda Tidak Dapat Mengajukan Cuti Untuk Shift!';
	                    return $this->set_response($arr, REST_Controller::HTTP_OK);
	                }

	                $this->db->select('sum(total) as total_cuti');
	                $this->db->where('jenis_cuti', $id_cuti);
	                $this->db->where('id_user', $id_user);
	                $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', ($tahun - 1));
	                $this->db->where('status != 108');
	                $this->db->where('tampilkan', '1');
	                $resCekLalu = $this->db->get('his_cuti')->row();
					//print_r($resCekLalu);die();
	                $this->db->where('abid', $kd_jenis_cuti);
	                $this->db->where('tampilkan', '1');
	                $this->db->where('tahun', $tahunlalu);
	                $resMaxLalu = $this->db->get('m_jenis_cuti')->row();

	                $cuti_kmrn = $resCekLalu->total_cuti;
	                $max_cuti_kmrn = $resMaxLalu->jumlah;

	                if ($cuti_kmrn > 12) {
	                        $jumcuti = 12;
	                } else {
	                        $jumcuti = $cuti_kmrn;
	                }

	                $cutithnlalu = $max_cuti_kmrn - $jumcuti;
	                $jumlahtot = $max_cuti_skrg + $cutithnlalu;

	                if ($jumlahtot > 18) {
	                        $jumlah = 18;
	                } else {
	                        $jumlah = $jumlahtot;
	                }

	                $jumlahcuti = $jumlah - $cuti_skrg;

	                if (!empty($cuti_kmrn)) {
	                    if ($jumlahcuti > 18) {
	                        $cc = 18;
	                    } else {
	                        $cc = $jumlahcuti;
	                    }
	                }else{
	                    if(!empty($cuti_skrg)){
	                        $cc = $max_cuti_skrg - $cuti_skrg;
	                    }else{
	                        $cc = $max_cuti_skrg;
	                    }
	                }
	                $arr['cuti'] = $cc;
	                $arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti tahunan <strong>' . $cc . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_CB') {

                	$arr['cuti_besar'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti besar <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_CM') {
                	$arr['cuti_melahirkan'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti melahirkan <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_CKS') {
                	// if ($cuti_skrg == $max_cuti_skrg) {
                	// 	$sisa_cuti = 0;
                	// } else {
                		$sisa_cuti = $max_cuti_skrg;
                	// }
                	$arr['cuti_khusus'] = $sisa_cuti;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti khusus <strong>' . $sisa_cuti . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_CU') {
                	$arr['cuti_umroh'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti umroh <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_CH') {
                	$arr['cuti_haji'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti haji <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_INP') {
                	$arr['izin_nikah_pribadi'] = 12;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin nikah pribadi <strong>' . 12 . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_INA') {
                	$arr['izin_nikah_anak'] = 12;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin nikah anak <strong>' . 12 . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_IRIK') {
                	// if ($cuti_skrg == $max_cuti_skrg) {
                	// 	$sisa_cuti = 0;
                	// } else {
                		$sisa_cuti = $max_cuti_skrg - $cuti_skrg;
                	// }
                	$arr['izin_sakit_keluarga'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin sakit rawat inap keluarga <strong>' . $sisa_cuti . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_IIM') {
                	$arr['izin_istri_melahirkan'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin istri melahirkan <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_IKA') {
                	$arr['izin_khitan'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin khitan <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_IPK') {
                	$arr['izin_pemakaman'] = 12;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin pemakaman <strong>' . 12 . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_IKR') {
                	$arr['izin_kerusakan'] = 12;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin kerusakan tempat tinggal <strong>' . 12 . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_LL') {
                	// if ($cuti_skrg == $max_cuti_skrg) {
                	// 	$sisa_cuti = 0;
                	// } else {
                		$sisa_cuti = $max_cuti_skrg;
                	// }
                	$arr['izin_lainnya'] = $sisa_cuti;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin lainnya <strong>' . $sisa_cuti . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_IKP') {
                	$arr['izin_kegiatan_profesi'] = 12;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin kegiatan profesi <strong>' . 12 . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_I2T') {
                	if ($cuti_skrg == $max_cuti_skrg) {
                		$sisa_cuti = 0;
                	} else {
                		$sisa_cuti = $max_cuti_skrg;
                	}
                	$arr['izin_dua_hari'] = $sisa_cuti;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa izin 2 hari/tahun<strong>' . $sisa_cuti . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_SRI') {
                	$arr['sakit_rawat_inap'] = 12;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa sakit rawat inap <strong>' . 12 . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_SRJ') {
                	// if ($cuti_skrg == $max_cuti_skrg) {
                	// 	$sisa_cuti = 0;
                	// } else {
                		$sisa_cuti = $max_cuti_skrg;
                	// }
                	$arr['sakit_rawat_jalan'] = $sisa_cuti;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa sakit rawat jalan <strong>' . $sisa_cuti . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DPR') {
                	$arr['dinas_prajabatan'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas prajabatan <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DPB') {
                	$arr['dinas_post_basic'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas post basic <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DKD') {
                	$arr['dinas_kardiologi'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas kardiologi <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DPD') {
                	$arr['dinas_pendidikan'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas pendidikan <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DPLT') {
                	$arr['dinas_pelatihan'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas pelatihan <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DTKHI') {
                	$arr['dinas_tkhi'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas TKHI <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                } else if ($kd_jenis_cuti == 'AB_DL') {
                	$arr['dinas_luar'] = $max_cuti_skrg;
                	$arr['message'] = '<div class="alert alert-success">Anda memiliki sisa dinas luar <strong>' . $max_cuti_skrg . ' Hari</strong></div>';
                }
                
                $arr['warning'] = "";

                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    function tglcuti_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				
                $lama_cuti1 = $this->uri->segment(3); 
                $lama_cuti2 = $lama_cuti1 - 1;
                if(!empty($this->uri->segment(4))){
                    $id_user = $this->input->get('id_user');
                    $id_jenis_cuti = $this->input->get('id_jenis_cuti');
    				$tglawal = date('Y-m-d', strtotime($this->uri->segment(4)));
    				$thn = date('Y');
    				$tglakhir = date('Y-m-d', strtotime('+'.$lama_cuti2.' days', strtotime($tglawal))); 

    				$this->db->where('id', $id_jenis_cuti);
	                $this->db->where('tampilkan', '1');
	                $res = $this->db->get('m_jenis_cuti')->row();
	                $kd_jenis_cuti = $res->abid;

    				$this->db->select('libur.tanggal as tgl');
    				$this->db->where('tahun', $thn);
    				$tgl_libur = $this->db->get('libur')->result();
    				foreach ( $tgl_libur as $harilibur ) {
                        $liburnasional[] = strtotime($harilibur->tgl);
    				    $liburnasional2[] = $harilibur->tgl;
    				}

                    $this->db->where('id_user', $id_user);
                    $resShift = $this->db->get('sys_user')->row();
                    $status_shift = $resShift->id_shift;

                    $jmldetik = 24*60*60;
                    $a = strtotime($tglawal);
                    $b = strtotime($tglakhir);

                    if (in_array(date('Y-m-d', $a), $liburnasional2)) {
                        $arr['pesan_eror'] = 'Anda tidak tidak bisa mengajukan cuti di hari libur nasional';
                        $this->set_response($arr, REST_Controller::HTTP_OK);
                        return;
                    }

                    if ($kd_jenis_cuti == 'AB_CTS' || $kd_jenis_cuti == 'AB_CTNS' || $kd_jenis_cuti == 'AB_I2T' || $kd_jenis_cuti == 'AB_IRIK' || $kd_jenis_cuti == 'AB_IIM' || $kd_jenis_cuti == 'AB_IKA' || $kd_jenis_cuti == 'AB_LL' || $kd_jenis_cuti == 'AB_CKS' ) {

                    	if ($status_shift == '51') {

	                        if (date('w', $a) == "0" || date("w", $a) == "6") {
	                            $arr['pesan_eror'] = 'Anda tidak tidak bisa mengajukan cuti di hari libur sabtu/minggu!';
	                            $this->set_response($arr, REST_Controller::HTTP_OK);
	                            return;
	                        }

	                        $haricuti = array();
	                        $sabtuminggu = array();
	                        $tgllibur = array();

	                        for ($i=$a; $i <= $b; $i += $jmldetik) {
	                            if (date('w', $i) !== '0' && date('w', $i) !== '6') {
	                                if (!in_array(date('Y-m-d', $i), $liburnasional2)) {
	                                    $haricuti[] = $i;
	                                } else {
	                                    $tgllibur[] = $i;
	                                    $b += $jmldetik;
	                                }
	                            } else {
	                                $sabtuminggu[] = $i;
	                                $b += $jmldetik;
	                            }
	                         
	                        }
	                        $jumlah_cuti = count($haricuti);
	                        $jumlah_sabtuminggu = count($sabtuminggu);
	                        $jumlah_tgllibur = count($tgllibur);
	                        $abtotal = $jumlah_cuti + $jumlah_sabtuminggu + $jumlah_tgllibur - 1;

	        				$tgl_selesai_tanpa_libur = date('Y-m-d', strtotime('+'.$abtotal.' days', strtotime($tglawal))); // Hasil akhir 

	                    } else if($status_shift == '50') {
	                        $haricuti = array();
	                        $tgllibur = array();

	                        for ($i=$a; $i <= $b; $i += $jmldetik) {
	                            if (!in_array(date('Y-m-d', $i), $liburnasional2)) {
	                                $haricuti[] = $i;
	                            } else {
	                                $tgllibur[] = $i;
	                                $b += $jmldetik;
	                            }
	                         
	                        }
	                        $jumlah_cuti = count($haricuti);
	                        $jumlah_tgllibur = count($tgllibur);
	                        $abtotal = $jumlah_cuti + $jumlah_tgllibur - 1;

	                        $tgl_selesai_tanpa_libur = date('Y-m-d', strtotime('+'.$abtotal.' days', strtotime($tglawal)));
	                    }
                    } else {
                    	$tgl_selesai_tanpa_libur = date('Y-m-d', strtotime('+'.$lama_cuti2.' days', strtotime($tglawal)));
                    }

				}else{
					$tgl_selesai_tanpa_libur='';
				}
				if (!empty($tgl_selesai_tanpa_libur)) {
                    $arr['pesan_eror'] = '';
                    $arr[] = array('tgl_selesai' => $tgl_selesai_tanpa_libur,
                        );
                } else {
                    $arr['hasil'] = 'error';
                    $arr['pesan_eror'] = '';
                    $arr[] = array('tgl_selesai' => "",
                        );
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    function savecuti_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';
           
			if ($decodedToken != false) {
                $tgl = ($this->input->post('tgl_cuti'))?$this->input->get('tgl_cuti'):null;
                $jml = ($this->input->post('jumlahCuti'))?$this->input->post('jumlahCuti'):null;
                $sampai = ($this->input->post('sampai'))?$this->input->get('sampai'):null;
                // $datesampai = DateTime::createFromFormat('d/m/Y', $sampai);
                $tglnew = date("Y-m-d", strtotime($tgl));
                $sampainew = date("Y-m-d", strtotime($sampai));
                // print_r($tglnew);
                // echo " ";
                // print_r($sampainew);die();
                //cek lagi
                $jenis_cuti = ($this->input->post('jenis_cuti'))?$this->input->post('jenis_cuti'):null;
                $id_user = ($this->input->post('id_user'))?$this->input->post('id_user'):null;
                $id_group = ($this->input->post('id_group'))?$this->input->post('id_group'):null;
                $keterangan = ($this->input->post('keterangan'))?$this->input->post('keterangan'):null;
                $alamat = ($this->input->post('alamat'))?$this->input->post('alamat'):null;
                $no_telp = ($this->input->post('no_telp'))?$this->input->post('no_telp'):null;
                $tanggung_jawab = ($this->input->post('tanggung_jawab'))?$this->input->post('tanggung_jawab'):null;
                $tahun = date('Y');
                $tahunskrg = $tahun;
                $tahunlalu = ($tahun - 1);

                $this->db->where('id', $jenis_cuti);
                $this->db->where('tampilkan', '1');
                $res = $this->db->get('m_jenis_cuti')->row();
                $kd_jenis_cuti = $res->abid;

                $this->db->where('id_grup', $id_group);
                $this->db->where('tampilkan', '1');
                $resGroup = $this->db->get('sys_grup_user')->row();
                $kode_group = $resGroup->kode;

                $this->db->where('id_user', $id_user);
                $resShift = $this->db->get('sys_user')->row();
                $status_shift = $resShift->id_shift;

                $datacuti = array(
                    'id_user' => $id_user,
                    'total' => $jml,
                    'tgl_cuti' => $tglnew,
                    'tgl_akhir_cuti' => $sampainew,
                    'jenis_cuti' => $jenis_cuti,
                    'status' => '102',
                    'keterangan' => $keterangan,
                    'alamat' => $alamat,
                    'no_telp' => $no_telp,
                    'tanggung_jawab' => $tanggung_jawab,
                    'id_group' => $id_group

                );
                $query = $this->db->insert('his_cuti', $datacuti);
                $id_cuti = $this->db->insert_id('his_cutiid_seq');

                
                if ($query) {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }
				$this->set_response($arr, REST_Controller::HTTP_OK);
                return;

                $this->db->select('libur.tanggal as tgl');
                $this->db->where('tahun', $tahun);
                $tgl_libur = $this->db->get('libur')->result();
                foreach ( $tgl_libur as $harilibur ) {
                    $liburnasional[] = $harilibur->tgl;
                }

                $jmldetik = 24*60*60;
                $a = strtotime($tglnew);
                $b = strtotime($sampainew);

                $haricuti = array();

                if ($kd_jenis_cuti == 'AB_CTS' || $kd_jenis_cuti == 'AB_CTNS' || $kd_jenis_cuti == 'AB_I2T' || $kd_jenis_cuti == 'AB_IRIK' || $kd_jenis_cuti == 'AB_IIM' || $kd_jenis_cuti == 'AB_IKA' || $kd_jenis_cuti == 'AB_LL' || $kd_jenis_cuti == 'AB_CKS') {

                    if ($status_shift == "51") {
                        for ($i=$a; $i <= $b; $i += $jmldetik) {
                            if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                                if (!in_array(date('Y-m-d', $i), $liburnasional)) {
                                    $haricuti[] = $i;
                                } 
                            } 
                        }

                        foreach ( $haricuti as $tgl_cuti ) {
                            // $datadetail = array(
                            //     'id_cuti' => $id_cuti,
                            //     'id_user' => $id_user,
                            //     'tgl_cuti' => date('Y-m-d', $tgl_cuti),
                            //     'jenis_cuti' => $kd_jenis_cuti,
                            //     'group' => $kode_group,
                            //     'status' => '102',
                            //     'keterangan' => $keterangan,
                            //     );
                            // $this->db->insert('his_cuti_detail', $datadetail);

                            // db woowtime
                            $datadetail = array(
                                'id_cuti' => $id_cuti,
                                'userid' => $id_user,
                                'date' => date('Y-m-d', $tgl_cuti),
                                'absence' => $kd_jenis_cuti,
                                'deptid' => $kode_group,
                                'status' => '1',
                                'editby' => $id_user,
                                'notes' => $keterangan,
                                );

                            $this->db2->insert('approval', $datadetail);
                        }

                    } else if ($status_shift == '50'){
                        for ($i=$a; $i <= $b; $i += $jmldetik) {
                            if (!in_array(date('Y-m-d', $i), $liburnasional)) {
                                $haricuti[] = $i;
                            } 
                         
                        }

                        foreach ( $haricuti as $tgl_cuti ) {
                            // $datadetail = array(
                            //     'id_cuti' => $id_cuti,
                            //     'id_user' => $id_user,
                            //     'tgl_cuti' => date('Y-m-d', $tgl_cuti),
                            //     'jenis_cuti' => $kd_jenis_cuti,
                            //     'group' => $kode_group,
                            //     'status' => '102',
                            //     'keterangan' => $keterangan,
                            //     );
                            // $this->db->insert('his_cuti_detail', $datadetail);

                            // db woowtime
                            $datadetail = array(
                                'id_cuti' => $id_cuti,
                                'userid' => $id_user,
                                'date' => date('Y-m-d', $tgl_cuti),
                                'absence' => $kd_jenis_cuti,
                                'deptid' => $kode_group,
                                'status' => '1',
                                'editby' => $id_user,
                                'notes' => $keterangan,
                                );

                            $this->db2->insert('approval', $datadetail);
                        }
                    }

                } else {
                    for ($i=$a; $i <= $b; $i += $jmldetik) {
                            $haricuti[] = $i;
                    }

                    foreach ( $haricuti as $tgl_cuti ) {
                        // $datadetail = array(
                        //     'id_cuti' => $id_cuti,
                        //     'id_user' => $id_user,
                        //     'tgl_cuti' => date('Y-m-d', $tgl_cuti),
                        //     'jenis_cuti' => $kd_jenis_cuti,
                        //     'group' => $kode_group,
                        //     'status' => '102',
                        //     'keterangan' => $keterangan,
                        //     );
                        // $this->db->insert('his_cuti_detail', $datadetail);

                        // db woowtime
                        $datadetail = array(
                            'id_cuti' => $id_cuti,
                            'userid' => $id_user,
                            'date' => date('Y-m-d', $tgl_cuti),
                            'absence' => $kd_jenis_cuti,
                            'deptid' => $kode_group,
                            'status' => '1',
                            'editby' => $id_user,
                            'notes' => $keterangan,
                            );

                        $this->db2->insert('approval', $datadetail);
                    }
                }


                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function beristratuscuti_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id = $this->input->get('id');
                $status = $this->input->get('status');
                $id_user = $this->input->get('id_user');
                $this->db->where('id', $id);
                $arraycuti['status'] = $status;
                if ($status == '0') {
                    $arraycuti['tampilkan'] = '0';
                    $this->db->where('status', '102');
                } else {
                	$arraycuti['approve'] = $id_user;
                }
                $this->db->update('his_cuti', $arraycuti);

                if ($status == "107") {
                    $arraycutidetail['status'] = "2";
                } else if ($status == "103") {
                    $arraycutidetail['status'] = "3";
                } else if ($status == "108") {
                    $arraycutidetail['status'] = "9";
                }
                $this->db2->where('id_cuti', $id);
                if ($status == '0') {
                    //$arraycutidetail['tampilkan'] = $status;
                    $arraycutidetail['status'] = $status;
                    $this->db2->where('status', '1');
					//$this->db2->delete('approval');
                } else {
                	$arraycutidetail['approved_by'] = $id_user;
                    $arraycutidetail['editby'] = $id_user;
					//$this->db2->update('approval', $arraycutidetail);
                }
                $this->db2->update('approval', $arraycutidetail);
                $arr['hasil'] = 'success';
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    function listcutiall_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$user_froup = $decodedToken->data->_pnc_id_grup;
				
				$id_user = $decodedToken->data->id;
				$this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
				$this->db->where('id_user',$id_user);
				$uk = $this->db->get('riwayat_kedinasan')->row();
				$dir = $uk->direktorat;
				$bagian = $uk->bagian;
				$sub_bag = $uk->sub_bagian;
				
                //$id_user = $this->input->get('id_user');
                $this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,dm_term.nama as statuspros,sys_user.name as namapegawai');
                $this->db->join('m_jenis_cuti', 'm_jenis_cuti.id = his_cuti.jenis_cuti');
                $this->db->join('dm_term', 'dm_term.id = his_cuti.status');
                $this->db->join('sys_user', 'sys_user.id_user = his_cuti.id_user');
                $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
				$this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
				$this->db->where('his_cuti.tampilkan', '1');
                $this->db->where('his_cuti.status', '102');
                //if ($user_froup!=1) {
				//$this->db->where("riwayat_kedinasan.bagian",$user_froup);  
				//}
				$this->db->where('sys_user.id_user !=', $id_user);
				$user=0;
				if ($user_froup!=1) {
				if($sub_bag==0){
				$user=$bagian;
				$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
				if($bagian==0){
				$user=$dir;
				$this->db->where_in('riwayat_kedinasan.direktorat', $dir);
				$kepala=array('3','38','70','148','231','293','398','509','654','732','881','948','1086','1125','1164','1203','1242','1281','1320','1359','1398','1437','1476','1527','1581','1646','1733','1863','1957','2005','2066','2182','2195','2250','2427','2522','2555','2642','2749','2782');        
				$this->db->where_in('riwayat_kedinasan.jabatan_struktural', $kepala);
				
				}else if($sub_bag==0){
				$user=$bagian;
				$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
				}
				}else{
				$user=$sub_bag;
				$this->db->where_in('riwayat_kedinasan.bagian', $bagian);
				$this->db->where_in('riwayat_kedinasan.sub_bagian', $sub_bag);
				}
				}
				
				if (empty($this->input->get('tahun'))) {
                    $thn = date('Y');
                } else {
                    $thn = $this->input->get('tahun');
                }
				$this->db->where('EXTRACT(YEAR FROM his_cuti.tgl_akhir_cuti) =',$thn);
				if(!empty($this->input->get('bulan'))){
					$this->db->where('EXTRACT(MONTH FROM his_cuti.tgl_akhir_cuti) =',$this->input->get('bulan'));
				}
				$this->db->order_by('tgl_cuti', 'DESC');
                $resCek = $this->db->get('his_cuti')->result();
				$count=count($resCek);
                          
                $da = '';
				   
				if($user==$dir){
				  foreach ($resCek as $val) {
                    $text = 'text-success';
                    if ($val->status == '108') {
                        $text = 'text-danger';
                    }
					$da .= '<tr>';
                    $da .= '<td>';
                    $da .= $val->namapegawai;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->namcut;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->keterangan;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_akhir_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->total;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->no_telp;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->alamat;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->tanggung_jawab;
                    $da .= '</td>';
                    $da .= '<td class="' . $text . '">';
                    $da .= $val->statuspros;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= '<a class="label label-success" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\',\'103\')">';
                    $da .= 'Setujui';
                    $da .= '</a>';
                    $da .= '<a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\',\'108\')">';
                    $da .= 'Tolak';
                    $da .= '</a>';
                    $da .= '</td>';
                    $da .= '</tr>';
                }
				}else{
                foreach ($resCek as $val) {
                    $text = 'text-success';
                    if ($val->status == '108') {
                        $text = 'text-danger';
                    }
                    $da .= '<tr>';
                    $da .= '<td>';
                    $da .= $val->namapegawai;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->namcut;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->keterangan;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_akhir_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->total;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->no_telp;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->alamat;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->tanggung_jawab;
                    $da .= '</td>';
                    $da .= '<td class="' . $text . '">';
                    $da .= $val->statuspros;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= '<a class="label label-success" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\',\'107\')">';
                    $da .= 'Setujui';
                    $da .= '</a>';
                    $da .= '<a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\',\'108\')">';
                    $da .= 'Tolak';
                    $da .= '</a>';
                    $da .= '</td>';
                    $da .= '</tr>';
                }
				}

                $arr['hasil'] = 'success';
                $arr['isi'] = $da;
                $arr['jum'] = $count;
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

    }

    function listcutisdm_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$user_froup = $decodedToken->data->_pnc_id_grup;
                $id_user = $this->input->get('id_user');
                $this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,dm_term.nama as statuspros,sys_user.name as namapegawai');
                $this->db->join('m_jenis_cuti', 'm_jenis_cuti.id = his_cuti.jenis_cuti');
                $this->db->join('dm_term', 'dm_term.id = his_cuti.status');
                $this->db->join('sys_user', 'sys_user.id_user = his_cuti.id_user');
                $this->db->where('his_cuti.tampilkan', '1');
                $this->db->where('his_cuti.status', '107');
				
                if (($user_froup == '1') OR ($user_froup == '6')) {
                    if ((!empty($this->input->get('id_uk'))) AND ($this->input->get('id_uk') <> 'null')) {
                        $this->db->where('sys_user.id_grup', $this->input->get('id_uk'));
                    }
                }
				
				if (empty($this->input->get('tahun'))) {
                    $thn = date('Y');
                } else {
                    $thn = $this->input->get('tahun');
                }
				$this->db->where('EXTRACT(YEAR FROM his_cuti.tgl_akhir_cuti) =',$thn);
				if(!empty($this->input->get('bulan'))){
					$this->db->where('EXTRACT(MONTH FROM his_cuti.tgl_akhir_cuti) =',$this->input->get('bulan'));
				}
				$this->db->order_by('tgl_cuti', 'DESC');
                $resCek = $this->db->get('his_cuti')->result();
				$count=count($resCek);
				
                $da = '';
                foreach ($resCek as $val) {
                    $text = 'text-success';
                    if ($val->status == '108') {
                        $text = 'text-danger';
                    }
                    $da .= '<tr>';
                    $da .= '<td>';
                    $da .= $val->namapegawai;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->namcut;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->keterangan;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= date_format(date_create($val->tgl_akhir_cuti), "d-m-Y");
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= $val->total;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->no_telp;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->alamat;
                    $da .= '</td>';
					$da .= '<td>';
                    $da .= $val->tanggung_jawab;
                    $da .= '</td>';
                    $da .= '<td class="' . $text . '">';
                    $da .= $val->statuspros;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= '<a class="label label-success" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\',\'103\')">';
                    $da .= 'Setujui';
                    $da .= '</a>';
                    $da .= '<a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\'' . $val->id . '\',\'108\')">';
                    $da .= 'Tolak';
                    $da .= '</a>';
                    $da .= '</td>';
                    $da .= '</tr>';
                }

                $arr['hasil'] = 'success';
                $arr['isi'] = $da;
				$arr['jum'] = $count;
                $this->set_response($arr, REST_Controller::HTTP_OK);

                return;
            }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

    }

}
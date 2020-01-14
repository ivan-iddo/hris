<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/controllers/Monitoring.php';
$rest_json = file_get_contents("php://input");

$_POST = json_decode($rest_json, true);

class Pegawai extends REST_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/


function changepass_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $arr = array();

            if (!empty($id = $this->input->post('id_user'))) {
                if (!empty($this->input->post('passwordchn'))) {
                    $salt = round(rand() * 1000);

                    $password = md5($this->input->post('passwordchn'));
                    $this->db->where('id_user', $id);
                    $this->db->update('sys_user', array('salt' => $salt, 'password' => $password));
                    if ($this->db->affected_rows() == '1') {
                        $arr['hasil'] = 'success';
                        $arr['message'] = 'Password Berhasil Dirubah!';
                    } else {
                        $arr['hasil'] = 'error';
                        $arr['message'] = 'Data Gagal Dirubah!';
                    }


                }
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function newupdate_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $arr = array();
			$id_user = $decodedToken->data->id;
				
				$this->db->where('id_user', $id_user);
				$this->db->update('sys_user', array('email2' => $this->input->post('email2')));
				$data=array(
				'phone' => $this->input->post('no_hp')
				,
				'phone2' => $this->input->post('no_hp1')
				,
				'kode_pos' => $this->input->post('kd_pos')
				,'alamat_tinggal' => $this->input->post('alamat')
				,'rt_tinggal' => $this->input->post('rt')
				,'rw_tinggal' => $this->input->post('rw')
				,'prov_tinggal' => $this->input->post('txtprov')
				,'kota_tinggal' => $this->input->post('txtkota')
				,'kec_tinggal' => $this->input->post('txtkecamatan')
				,'kel_tinggal' => $this->input->post('txtkelurahan')
				,);
				$this->db->where('id_user', $id_user);
				$this->db->update('sys_user_profile', $data);
				if ($this->db->affected_rows() == '1') {
					$arr['hasil'] = 'success';
					$arr['message'] = 'Password Berhasil Dirubah!';
				} else {
					$arr['hasil'] = 'error';
					$arr['message'] = 'Data Gagal Dirubah!';
				}
            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function save_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $f_id_edit = ($this->input->post('f_id_edit'))?$this->input->post('f_id_edit'):null;
            $f_user_edit = ($this->input->post('f_user_edit'))?$this->input->post('f_user_edit'):null;
            $f_user_name = ($this->input->post('f_user_name'))?$this->input->post('f_user_name'):null;
            $f_user_email = ($this->input->post('f_user_email'))?$this->input->post('f_user_email'):null;
            $f_user_password = ($this->input->post('f_user_password'))?$this->input->post('f_user_password'):null;
            $acces = ($this->input->post('acces'))?$this->input->post('acces'):null;
            $f_user_status_aktif = ($this->input->post('f_user_status_aktif'))?$this->input->post('f_user_status_aktif'):1;
            $f_user_username = ($this->input->post('f_user_username'))?$this->input->post('f_user_username'):null;
            $inputphone = ($this->input->post('inputphone'))?$this->input->post('inputphone'):null;
            $inputphone2 = ($this->input->post('inputphone2'))?$this->input->post('inputphone2'):null;
            $inputrt = ($this->input->post('inputrt'))?$this->input->post('inputrt'):null;
            $inputrtktp = ($this->input->post('inputrtktp'))?$this->input->post('inputrtktp'):null;
            $inputrw = ($this->input->post('inputrw'))?$this->input->post('inputrw'):null;
            $inputrwktp = ($this->input->post('inputrwktp'))?$this->input->post('inputrwktp'):null;
            $inputstatus = ($this->input->post('inputstatus'))?$this->input->post('inputstatus'):null;
            $inputstatustetap = ($this->input->post('inputstatustetap'))?$this->input->post('inputstatustetap'):null;
            $instasi = ($this->input->post('instasi'))?$this->input->post('instasi'):null;
            $txtagama = ($this->input->post('txtagama'))?$this->input->post('txtagama'):null;
            $txtAlamat = ($this->input->post('txtAlamat'))?$this->input->post('txtAlamat'):null;
            $txtAlamatKtp = ($this->input->post('txtAlamatKtp'))?$this->input->post('txtAlamatKtp'):null;
            $txtbagian = ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null;
            $txtdirektorat = ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null;
            $txtgelarbelakang = ($this->input->post('txtgelarbelakang'))?$this->input->post('txtgelarbelakang'):null;
            $txtgelardepan = ($this->input->post('txtgelardepan'))?$this->input->post('txtgelardepan'):null;
            $txtgolongan = ($this->input->post('txtgolongan'))?$this->input->post('txtgolongan'):null;
            $txtindex = ($this->input->post('txtindex'))?$this->input->post('txtindex'):null;
            $txtjabatan = ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null;
            $txtjabatan1 = ($this->input->post('txtjabatan1'))?$this->input->post('txtjabatan1'):null;
            $txtjabatan2 = ($this->input->post('txtjabatan2'))?$this->input->post('txtjabatan2'):null;
            $txtjabfung = ($this->input->post('txtjabfung'))?$this->input->post('txtjabfung'):null;
            $unitkerja = ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null;
            $kaunit = ($this->input->post('kaunit'))?$this->input->post('kaunit'):null;
            $staff = ($this->input->post('staff'))?$this->input->post('staff'):null;
            $txtkecamatan = ($this->input->post('txtkecamatan'))?$this->input->post('txtkecamatan'):null;
            $txtkecamatanktp = ($this->input->post('txtkecamatanktp'))?$this->input->post('txtkecamatanktp'):null;
            $txtkelamin = ($this->input->post('txtkelamin'))?$this->input->post('txtkelamin'):null;
            $txtkelurahan = ($this->input->post('txtkelurahan'))?$this->input->post('txtkelurahan'):null;
            $txtkelurahanktp = ($this->input->post('txtkelurahanktp'))?$this->input->post('txtkelurahanktp'):null;
            $txtkota = ($this->input->post('txtkota'))?$this->input->post('txtkota'):null;
            $txtkotaktp = ($this->input->post('txtkotaktp'))?$this->input->post('txtkotaktp'):null;
            $txtnik = ($this->input->post('txtnik'))?$this->input->post('txtnik'):null;
            $txtnopeg = ($this->input->post('txtnopeg'))?$this->input->post('txtnopeg'):null;
            $txtkarpeg = ($this->input->post('txtkarpeg'))?$this->input->post('txtkarpeg'):null;
            $txtstp = ($this->input->post('txtstp'))?$this->input->post('txtstp'):null;
            $txttglnikah = ($this->input->post('txttglnikah'))?$this->input->post('txttglnikah'):null;
            $txtnip = ($this->input->post('txtnip'))?$this->input->post('txtnip'):null;
            $txtpendidikan = ($this->input->post('txtpendidikan'))?$this->input->post('txtpendidikan'):null;
            $txtperingkat = ($this->input->post('txtperingkat'))?$this->input->post('txtperingkat'):null;
            $txtprov = ($this->input->post('txtprov'))?$this->input->post('txtprov'):null;
            $txtprovktp = ($this->input->post('txtprovktp'))?$this->input->post('txtprovktp'):null;
            $txttgllahir = ($this->input->post('txttgllahir'))?$this->input->post('txttgllahir'):null;
            $txttlahir = ($this->input->post('txttlahir'))?$this->input->post('txttlahir'):null;
            $txttmtbergabung = ($this->input->post('txttmtbergabung'))?$this->input->post('txttmtbergabung'):null;
            $txttmtcpns = ($this->input->post('txttmtcpns'))?$this->input->post('txttmtcpns'):null;
            $txttmtgolongan = ($this->input->post('txttmtgolongan'))?$this->input->post('txttmtgolongan'):null;
            $txttmtjabatan = ($this->input->post('txttmtjabatan'))?$this->input->post('txttmtjabatan'):null;
            $txttmtjabfung = ($this->input->post('txttmtjabfung'))?$this->input->post('txttmtjabfung'):null;
            $txttmtpns = ($this->input->post('txttmtpns'))?$this->input->post('txttmtpns'):null;
            $id_bank = ($this->input->post('id_bank'))?$this->input->post('id_bank'):null;
            $bpjs_kes = ($this->input->post('bpjs_kes'))?$this->input->post('bpjs_kes'):null;
            $bpjs_tk = ($this->input->post('bpjs_tk'))?$this->input->post('bpjs_tk'):null;
            $inputkpos = ($this->input->post('inputkpos'))?$this->input->post('inputkpos'):null;
            $inputkposktp = ($this->input->post('inputkposktp'))?$this->input->post('inputkposktp'):null;


            if (!empty($staff)) {
                $group = $staff;
            } elseif (!empty($kaunit)) {
                $group = $kaunit;
            }elseif(!empty($unitkerja)) {
                $group = $unitkerja;
            } elseif (!empty($txtbagian)) {
                $group = $txtbagian;
            } elseif (!empty($txtdirektorat)) {
                $group = $txtdirektorat;
            }
            $group = 0;


            $id_aplikasi = 1;
            $user_id_klinik = $decodedToken->data->_pnc_kode_klinik;
            $author = $decodedToken->data->_pnc_username;

            $salt = round(rand() * 1000);

            $password = md5($f_user_password);

            $this->db->where('id_user', $txtnopeg);
            $cek=$this->db->get('sys_user')->row();
            if (empty($cek)) {
                $param = array(
                    "username" => $f_user_username
                    , "name" => $f_user_name
                    , "email" => $f_user_email
                    , "acces" => $acces
                    , "id_aplikasi" => '1'
                    , "id_grup" => $group
                    ,"id_user" => $txtnopeg
                    , "author" => $author
                    , "salt" => $salt
                    , "status" => $f_user_status_aktif
                    , "created" => date('Y-m-d H:i:s')
                    , "password" => $password
                    , "kode_klinik" => $user_id_klinik
                    , 'id_uk' => $txtjabatan
                    , 'id_shift' => ($this->input->post('id_shift'))?$this->input->post('id_shift'):null
                );


                $saved_id = $this->db->insert('sys_user', $param);

                if (!empty($saved_id)) {
                    $param_profile = array(
                        'id_user' => $txtnopeg,
                        'nip' => $txtnip,
                        'nik' => $txtnik,
                        'karpeg' => $txtkarpeg,
                        'sts_p' => $txtstp,
                        'tgl_nikah' => $txttglnikah,
                        'gelar_depan' => $txtgelardepan,
                        'gelar_belakang' => $txtgelarbelakang,
                        'tgl_lahir' => $txttgllahir,
                        'tempat_lahir' => $txttlahir,
                        'kelamin' => $txtkelamin,
                        'agama' => $txtagama,
                        'pendidikan_akhir' => $txtpendidikan,
                        'phone' => $inputphone,
                        'phone2' => $inputphone2,
                        'alamat_tinggal' => $txtAlamat,
                        'rt_tinggal' => $inputrt,
                        'rw_tinggal' => $inputrw,
                        'prov_tinggal' => $txtprov,
                        'kota_tinggal' => $txtkota,
                        'kec_tinggal' => $txtkecamatan,
                        'kel_tinggal' => $txtkelurahan,
                        'alamat_ktp' => $txtAlamatKtp,
                        'rt_ktp' => $inputrtktp,
                        'rw_ktp' => $inputrwktp,
                        'prov_ktp' => $txtprovktp,
                        'kota_ktp' => $txtkotaktp,
                        'kec_ktp' => $txtkecamatanktp,
                        'kel_ktp' => $txtkelurahanktp,
                        'kode_pos' => $inputkpos,
                        'kode_posktp' => $inputkposktp,
                        'id_bank' => $id_bank,
                        'bpjs_kes' => $bpjs_kes,
                        'bpjs_tk' => $bpjs_tk,
                        'no_rek' => ($this->input->post('no_rek'))?$this->input->post('no_rek'):null,
                        'kategori_profesi' => ($this->input->post('kategori_profesi'))?$this->input->post('kategori_profesi'):null,
                        'NPWP' => ($this->input->post('npwp'))?$this->input->post('npwp'):null,
                        'id_profesi' => ($this->input->post('id_profesi'))?$this->input->post('id_profesi'):null

                    );
                    $this->db->insert('sys_user_profile', $param_profile);

                    $param_rd = array(
                        'id_user' => $txtnopeg,
                        'status_pegawai' => $inputstatus,
                        'status_pegawai_tetap' => $inputstatustetap,
                        'tmt_cpns' => $txttmtcpns,
                        'tmt_pns' => $txttmtpns,
                        'direktorat' => $txtdirektorat,
                        'bagian' => $txtbagian,
                        'sub_bagian' => $unitkerja,
                        'kaunit' => $kaunit,
                        'staff' => $staff,
                        'jabatan_asn' => $txtjabfung,
                        'subjabasn' => ($this->input->post('subjabasn'))?$this->input->post('subjabasn'):null,
                        'ketahli' => ($this->input->post('ketahli'))?$this->input->post('ketahli'):null,
                        'tmt_jabatan_asn' => $txttmtjabfung,
                        'jabatan_struktural' => $txtjabatan,
                        'jabatan2' => $txtjabatan1,
                        'jabatan3' => $txtjabatan2,
                        'tmt_jabatan' => $txttmtjabatan,
                        'tgl_bergabung' => $txttmtbergabung,
                        'inst_asal' => $instasi,
                        'peringkat' => $txtperingkat,
                        'no_index_dok' => $txtindex,
                        'golongan' => $txtgolongan,
                        'tmt_golongan' => $txttmtgolongan,
                        'aktif' => '1'
                    );
                    $this->db->insert('riwayat_kedinasan', $param_rd);


                }

                if (!empty($saved_id)) {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                    $arr['id'] = $saved_id;
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }
                $this->set_response($arr, REST_Controller::HTTP_OK);
                return;
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah! No Pegawai sudah digunakan';
                $this->set_response($arr, REST_Controller::HTTP_OK);
            }
            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function cek_tugas($nopeg)
{		
				$besok = date('Y-m-d', strtotime("+7 day"));
				//print_r($besok);die();
                $this->db->where('pengembangan_pelatihan_detail.nopeg', $nopeg);
				$this->db->where('pengembangan_pelatihan_pelaksanaan.tanggal_from <=', $besok);
				$this->db->order_by('pengembangan_pelatihan_detail.id','DESC');
                $this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_detail.pengembangan_pelatihan_id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
                $this->db->join("pengembangan_pelatihan", "pengembangan_pelatihan_detail.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
                $cek=$this->db->get('pengembangan_pelatihan_detail')->row();
				return $cek;
}

function cuti($id_cuti,$id_user)
{
            $tahun = date('Y');
            $tahunskrg = $tahun;
            $tahunlalu = ($tahun - 1);

            $this->db->where('id', $id_cuti);
            $this->db->where('tampilkan', '1');
            $res = $this->db->get('m_jenis_cuti')->row();
            $kd_jenis_cuti = $res->abid;

            $this->db->where('id_user', $id_user);
            $resShift = $this->db->get('sys_user')->row();
            $status_shift = $resShift->id_shift;
            $this->db->select('sum(total) as total_cuti');
            $this->db->where('jenis_cuti', $kd_jenis_cuti);
            $this->db->where('id_user', $id_user);
            $this->db->where('status != 108');
            $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', $tahun);
            $this->db->where('tampilkan', '1');
            $resCekSkrg = $this->db->get('his_cuti')->row();

            $this->db->where('abid', $kd_jenis_cuti);
            $this->db->where('tampilkan', '1');
            $this->db->where('tahun', $tahunskrg);
            $resMaxSkrg = $this->db->get('m_jenis_cuti')->row();
			
			$cuti_skrg = $resCekSkrg->total_cuti;
			
            $max_cuti_skrg = $resMaxSkrg->jumlah;

            $this->db->select('sum(total) as total_cuti');
            $this->db->where('jenis_cuti', $kd_jenis_cuti);
            $this->db->where('id_user', $id_user);
            $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', ($tahun - 1));
            $this->db->where('status != 108');
            $this->db->where('tampilkan', '1');
            $resCekLalu = $this->db->get('his_cuti')->row();
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
	return $cc;
}

public function getuser_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id = $this->input->get('id');
            $str = $this->cek_tugas($id);
			if(!empty($str)){
			if($str->tanggal_from>=date('Y-m-d')){
			$surat_tugas='Pada tanggal '.date_format(date_create($str->tanggal_from), "d-m-Y").' - ' .date_format(date_create($str->tanggal_too), "d-m-Y"). ' Mengikuti kegiatan '.$str->nama_pelatihan;
			}else{
			$surat_tugas='';
			}
			}else{
			$surat_tugas='';
			}
			//print_r($str);die();
            $this->db->select('sys_user.id_uk, 
                sys_user.name,
                sys_user.username,
                sys_user.password,
                sys_user.email,
				sys_user.email2,
                sys_user.id_grup,
                sys_user.status,
                sys_user.foto,
                sys_user.zip,
                sys_user.id_shift,
                sys_user.kd_keluar,
                sys_user.acces,
                sys_user_profile.*,
                riwayat_kedinasan.status_pegawai,
                riwayat_kedinasan.status_pegawai_tetap,
                riwayat_kedinasan.direktorat,
                riwayat_kedinasan.jabatan_asn,
                riwayat_kedinasan.subjabasn,
                riwayat_kedinasan.ketahli,
                riwayat_kedinasan.jabatan_struktural,
                riwayat_kedinasan.jabatan2,
                riwayat_kedinasan.jabatan3,
                riwayat_kedinasan.golongan,
                riwayat_kedinasan.bagian,
                riwayat_kedinasan.sub_bagian,
                riwayat_kedinasan.kaunit,
                riwayat_kedinasan.staff,
                riwayat_kedinasan.tmt_cpns,
                riwayat_kedinasan.tmt_pns,
                riwayat_kedinasan.tmt_jabatan,
                riwayat_kedinasan.tmt_jabatan_asn,
                riwayat_kedinasan.tmt_golongan,
                riwayat_kedinasan.tgl_bergabung,
                riwayat_kedinasan.peringkat,
                riwayat_kedinasan.no_index_dok,
                m_index_jabatan_asn_detail.ds_jabatan as nama_jabatan,
                m_index_jabatan_asn_detail.kd_grp_job_profesi as grp_profesi,
                m_index_jabatan_asn_detail.profesi as prf,
                sub_kontrak.tglakhir,
                sub_str.date_end as date_end_str,
                sub_sip.date_end
                ');
            if ($id != ''){
                $this->db->where('sys_user.id_user', $id);
            }
            $this->db->join('sys_user_profile', 'sys_user_profile.id_user = sys_user.id_user', 'LEFT');
            $this->db->join('riwayat_kedinasan', 'riwayat_kedinasan.id_user = sys_user.id_user', 'LEFT');
            $this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
            $this->db->join('(SELECT id_user, max(tglakhir) as tglakhir FROM his_kontrak WHERE statue = 1 GROUP BY id_user) AS sub_kontrak', 'sys_user.id_user = sub_kontrak.id_user', 'LEFT');
            $this->db->join('(SELECT id_user, max(date_end) as date_end FROM his_str WHERE statue = 1 GROUP BY id_user) AS sub_str', 'sys_user.id_user = sub_str.id_user', 'LEFT');
            $this->db->join('(SELECT id_user, max(date_end) as date_end FROM his_sip WHERE statue = 1 GROUP BY id_user) AS sub_sip', 'sys_user.id_user = sub_sip.id_user', 'LEFT');

            $this->db->where('riwayat_kedinasan.aktif', '1');
            $res = $this->db->get('sys_user')->result();
            if (!empty($res)) {
                foreach ($res as $d) {
					//print_r($d->id_shift);die();
					if($d->id_shift=51){
					$shift=27;
					}else{
					$shift=28;
					}
					$sisa=$this->cuti($shift,$id);
					if($sisa!=0){
					$cuti ='Sisa cuti tinggal '.$sisa.' Hari';
					}else{
					$cuti='';
					}
					if(!empty($d->tgl_lahir)){
					$tgl_lahir=date_format(date_create($d->tgl_lahir), "d-m-Y");
					}else{
					$tgl_lahir='';
					}
					if(!empty($d->tgl_nikah)){
					$tgl_nikah=date_format(date_create($d->tgl_nikah), "d-m-Y");
					}else{
					$tgl_nikah='';
					}
					if(!empty($d->tmt_cpns)){
					$tmt_cpns=date_format(date_create($d->tmt_cpns), "d-m-Y");
					}else{
					$tmt_cpns='';
					}if(!empty($d->tmt_pns)){
					$tmt_pns=date_format(date_create($d->tmt_pns), "d-m-Y");
					}else{
					$tmt_pns='';
					}if(!empty($d->tmt_jabatan_asn)){
					$tmt_jabatan_asn=date_format(date_create($d->tmt_jabatan_asn), "d-m-Y");
					}else{
					$tmt_jabatan_asn='';
					}if(!empty($d->tmt_jabatan)){
					$tmt_jabatan=date_format(date_create($d->tmt_jabatan), "d-m-Y");
					}else{
					$tmt_jabatan='';
					}if(!empty($d->tmt_golongan)){
					$tmt_golongan=date_format(date_create($d->tmt_golongan), "d-m-Y");
					}else{
					$tmt_golongan='';
					}if(!empty($d->tgl_bergabung)){
					$tgl_bergabung=date_format(date_create($d->tgl_bergabung), "d-m-Y");
					}else{
					$tgl_bergabung='';
					}
                        
                    $arr[] = array('id_uk' => $d->id_uk,
                        'id' => $d->id_user,
                        'nama' => $d->name,
                        'username' => $d->username,
                        'pass' => $d->password,
                        'email' => $d->email,
                        'email2' => $d->email2,
                        'acces' => $d->acces,
                        'id_group' => $d->id_grup,
                        'status' => $d->status,
                        'kelamin' => $d->kelamin,
                        'agama' => $d->agama,
                        'pendidikan' => $d->pendidikan_akhir,
                        'prov' => $d->prov_tinggal,
                        'kota' => $d->kota_tinggal,
                        'kecamatan' => $d->kec_tinggal,
                        'kelurahan' => $d->kel_tinggal,
                        'alamat_tinggal' => $d->alamat_tinggal,
                        'prov_ktp' => $d->prov_ktp,
                        'status_pegawai' => $d->status_pegawai,
                        'status_pegawai_tetap' => $d->status_pegawai_tetap,
                        'direktorat' => $d->direktorat,
                        'jabatan_asn' => $d->jabatan_asn,
                        'jabatan_struktural' => $d->jabatan_struktural,
                        'jabatan2' => $d->jabatan2,
                        'jabatan3' => $d->jabatan3,
                        'golongan' => $d->golongan,
                        'bagian' => $d->bagian,
                        'sub_bagian' => $d->sub_bagian,
                        'kaunit' => $d->kaunit,
                        'staff' => $d->staff,
                        'tmt_cpns' => $tmt_cpns,
                        'tmt_pns' => $tmt_pns,
                        'tmt_jabatan' => $tmt_jabatan,
                        'tmt_jabatan_asn' => $tmt_jabatan_asn,
                        'tmt_golongan' => $tmt_golongan,
                        'tgl_bergabung' => $tgl_bergabung,
                        'peringkat' => $d->peringkat,
                        'no_index_dok' => $d->no_index_dok,
                        'rt_tinggal' => $d->rt_tinggal,
                        'rw_tinggal' => $d->rw_tinggal,
                        'rt_ktp' => $d->rt_ktp,
                        'rw_ktp' => $d->rw_ktp,
                        'alamat_ktp' => $d->alamat_ktp,
                        'nip' => $d->nip,
                        'nik' => $d->nik,
                        'nopeg' => $d->nopeg,
                        'karpeg' => $d->karpeg,
                        'sts_p' => $d->sts_p,
                        'tgl_nikah' => $tgl_nikah,
                        'kode_pos' => $d->kode_pos,
                        'kode_posktp' => $d->kode_posktp,
                        'gelar_depan' => $d->gelar_depan,
                        'kategori_profesi' => $d->kategori_profesi,
                        'gelar_belakang' => $d->gelar_belakang,
                        'tgl_lahir' => $tgl_lahir,
                        'tempat_lahir' => $d->tempat_lahir,
                        'phone' => $d->phone,
                        'phone2' => $d->phone2,
                        'kota_ktp' => $d->kota_ktp,
                        'kecamatan_ktp' => $d->kec_ktp,
                        'kelurahan_ktp' => $d->kel_ktp,
                        'foto' => 'api/upload/foto/' . $d->foto,
                        'zip' => 'api/upload/zip' . $d->zip,
                        'jabatan' => $d->nama_jabatan,
                        'id_bank' => $d->id_bank,
                        'bpjs_kes' => $d->bpjs_kes,
                        'bpjs_tk' => $d->bpjs_tk,
                        'no_rek' => $d->no_rek,
                        'kd_keluar' => $d->kd_keluar,
                        'id_shift' => $d->id_shift,
                        'npwp' => $d->NPWP,
                        'id_profesi' => $d->id_profesi,
                        'subjabasn' => $d->subjabasn,
                        'ketahli' => $d->ketahli,
                        'id_user' => $d->id_user,
                        'tgl_kontrak' => $d->tglakhir,
                        'tgl_str' => $d->date_end_str,
                        'tgl_sip' => $d->date_end,
                        'sisa_cuti' => $cuti,
                        'surat' => $surat_tugas,
                        'profesi' => $d->prf,
                        'grp_profesi' => $d->grp_profesi,

                    );
}

} else {
    $arr['hasil'] = 'error';
}

$this->set_response($arr, REST_Controller::HTTP_OK);


return;
}
}

$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

}

public function kualifikasi_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id = $this->input->get('id');

            $this->db->select('
                sys_user.id_user,
                his_mutasi_jabatan.tgl_mutasi,
                m_index_jabatan_asn_detail.ds_jabatan as nama_jabatan,
                ');
            if ($id != ''){
                $this->db->where('sys_user.id_user', $id);
            }
            $this->db->join('riwayat_kedinasan', 'riwayat_kedinasan.id_user = sys_user.id_user', 'LEFT');
            $this->db->join('his_mutasi_jabatan', 'his_mutasi_jabatan.user_id = sys_user.id_user', 'LEFT');
            $this->db->join('m_index_jabatan_asn_detail','m_index_jabatan_asn_detail.migrasi_jabatan_detail_id = riwayat_kedinasan.jabatan_struktural','LEFT');
            $this->db->where('riwayat_kedinasan.aktif', '1');
            $res = $this->db->get('sys_user')->result();
            if (!empty($res)) {
                foreach ($res as $d) {
					function hitung_umur($tanggal_lahir) {
						list($year,$month,$day) = explode("-",$tanggal_lahir);
						$year_diff  = date("Y") - $year;
						$month_diff = date("m") - $month;
						$day_diff   = date("d") - $day;
						if ($month_diff < 0) $year_diff--;
							elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
						return $year_diff;
					}
					$arr = array(
                        'id' => $d->id_user,
                        'tgl_mutasi' => hitung_umur($d->tgl_mutasi) .' Tahun',
                        'jabatan' => $d->nama_jabatan,
                    );
                }

            } else {
                $arr['hasil'] = 'error';
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);


            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

}
public function getPend_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id = $this->input->get('id');

            $this->db->select('
                dm_term.nama as pendidikan,
                his_pendidikan.id,
                his_pendidikan.pen_jur as jurusan');
            if ($id != ''){
                $this->db->where('his_pendidikan.id_user', $id);
            }
            $this->db->join('dm_term', 'dm_term.id = his_pendidikan.pen_code', 'LEFT');
            $this->db->where('his_pendidikan.tampilkan', '1');
            $this->db->order_by('his_pendidikan.id', 'DESC');
            $res = $this->db->get('his_pendidikan')->result();
            if (!empty($res)) {
                foreach($res as $d){
                    $arr['result'][]=array('label'=>$d->pendidikan.' '.$d->jurusan,'value'=>$d->id);
                }

            } else {
                $arr['hasil'] = 'error';
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);


            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

}
public function getjab_peg_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id = $this->input->get('id');

            $this->db->select('
                m_index_jabatan_asn_detail.ds_jabatan');
            if ($id != ''){
                $this->db->where('his_mutasi_jabatan.user_id', $id);
            }
            $this->db->join('m_index_jabatan_asn_detail', 'm_index_jabatan_asn_detail.migrasi_jabatan_detail_id = his_mutasi_jabatan.jabatan', 'LEFT');
            $this->db->order_by('m_index_jabatan_asn_detail.ds_jabatan', 'DESC');
            $res = $this->db->get('his_mutasi_jabatan')->result();
            if (!empty($res)) {
                foreach($res as $d){
                    $arr['result'][]=array('label'=>$d->ds_jabatan,'value'=>$d->ds_jabatan);
                }

            } else {
                $arr['hasil'] = 'error';
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);


            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

}


function edit_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $user_id_klinik = $decodedToken->data->_pnc_kode_klinik;
            $author = $decodedToken->data->_pnc_username;

            $id = $f_id_edit = ($this->input->post('f_id_edit'))?$this->input->post('f_id_edit'):null;
            $f_user_edit = ($this->input->post('f_user_edit'))?$this->input->post('f_user_edit'):null;
            $f_user_name = ($this->input->post('f_user_name'))?$this->input->post('f_user_name'):null;
            $f_user_email = ($this->input->post('f_user_email'))?$this->input->post('f_user_email'):null;
            $f_user_password = ($this->input->post('f_user_password'))?$this->input->post('f_user_password'):null;
            $acces = ($this->input->post('acces'))?$this->input->post('acces'):null;
            $f_user_status_aktif = ($this->input->post('f_user_status_aktif'))?$this->input->post('f_user_status_aktif'):1;
            $f_user_username = ($this->input->post('f_user_username'))?$this->input->post('f_user_username'):null;
            $inputphone = ($this->input->post('inputphone'))?$this->input->post('inputphone'):null;
            $inputphone2 = ($this->input->post('inputphone2'))?$this->input->post('inputphone2'):null;
            $inputrt = ($this->input->post('inputrt'))?$this->input->post('inputrt'):null;
            $inputrtktp = ($this->input->post('inputrtktp'))?$this->input->post('inputrtktp'):null;
            $inputrw = ($this->input->post('inputrw'))?$this->input->post('inputrw'):null;
            $inputrwktp = ($this->input->post('inputrwktp'))?$this->input->post('inputrwktp'):null;
            $inputstatus = ($this->input->post('inputstatus'))?$this->input->post('inputstatus'):null;
            $inputstatustetap = ($this->input->post('inputstatustetap'))?$this->input->post('inputstatustetap'):null;
            $instasi = ($this->input->post('instasi'))?$this->input->post('instasi'):null;
            $txtagama = ($this->input->post('txtagama'))?$this->input->post('txtagama'):null;
            $txtAlamat = ($this->input->post('txtAlamat'))?$this->input->post('txtAlamat'):null;
            $txtAlamatKtp = ($this->input->post('txtAlamatKtp'))?$this->input->post('txtAlamatKtp'):null;
            $kaunit = ($this->input->post('kaunit'))?$this->input->post('kaunit'):null;
            $staff = ($this->input->post('staff'))?$this->input->post('staff'):null;
            $txtbagian = ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null;
            $txtdirektorat = ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null;
            $txtgelarbelakang = ($this->input->post('txtgelarbelakang'))?$this->input->post('txtgelarbelakang'):null;
            $txtgelardepan = ($this->input->post('txtgelardepan'))?$this->input->post('txtgelardepan'):null;
            $txtgolongan = ($this->input->post('txtgolongan'))?$this->input->post('txtgolongan'):null;
            $txtindex = ($this->input->post('txtindex'))?$this->input->post('txtindex'):null;
            $txtjabatan = ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null;
            $txtjabatan1 = ($this->input->post('txtjabatan1'))?$this->input->post('txtjabatan1'):null;
            $txtjabatan2 = ($this->input->post('txtjabatan2'))?$this->input->post('txtjabatan2'):null;
            $txtjabfung = ($this->input->post('txtjabfung'))?$this->input->post('txtjabfung'):null;
            $unitkerja = ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null;
            $txtkecamatan = ($this->input->post('txtkecamatan'))?$this->input->post('txtkecamatan'):null;
            $txtkecamatanktp = ($this->input->post('txtkecamatanktp'))?$this->input->post('txtkecamatanktp'):null;
            $txtkelamin = ($this->input->post('txtkelamin'))?$this->input->post('txtkelamin'):null;
            $txtkelurahan = ($this->input->post('txtkelurahan'))?$this->input->post('txtkelurahan'):null;
            $txtkelurahanktp = ($this->input->post('txtkelurahanktp'))?$this->input->post('txtkelurahanktp'):null;
            $txtkota = ($this->input->post('txtkota'))?$this->input->post('txtkota'):null;
            $txtkotaktp = ($this->input->post('txtkotaktp'))?$this->input->post('txtkotaktp'):null;
            $txtnik = ($this->input->post('txtnik'))?$this->input->post('txtnik'):null;
            $txtnopeg = ($this->input->post('txtnopeg'))?$this->input->post('txtnopeg'):null;
            $txtkarpeg = ($this->input->post('txtkarpeg'))?$this->input->post('txtkarpeg'):null;
            $txtstp = ($this->input->post('txtstp'))?$this->input->post('txtstp'):null;
            $txttglnikah = ($this->input->post('txttglnikah'))?$this->input->post('txttglnikah'):null;
            $txtnip = ($this->input->post('txtnip'))?$this->input->post('txtnip'):null;
            $txtpendidikan = ($this->input->post('txtpendidikan'))?$this->input->post('txtpendidikan'):null;
            $txtperingkat = ($this->input->post('txtperingkat'))?$this->input->post('txtperingkat'):null;
            $txtprov = ($this->input->post('txtprov'))?$this->input->post('txtprov'):null;
            $txtprovktp = ($this->input->post('txtprovktp'))?$this->input->post('txtprovktp'):null;
            $txttgllahir = ($this->input->post('txttgllahir'))?$this->input->post('txttgllahir'):null;
            $txttlahir = ($this->input->post('txttlahir'))?$this->input->post('txttlahir'):null;
            $txttmtbergabung = ($this->input->post('txttmtbergabung'))?$this->input->post('txttmtbergabung'):null;
            $txttmtcpns = ($this->input->post('txttmtcpns'))?$this->input->post('txttmtcpns'):null;
            $txttmtgolongan = ($this->input->post('txttmtgolongan'))?$this->input->post('txttmtgolongan'):null;
            $txttmtjabatan = ($this->input->post('txttmtjabatan'))?$this->input->post('txttmtjabatan'):null;
            $txttmtjabfung = ($this->input->post('txttmtjabfung'))?$this->input->post('txttmtjabfung'):null;
            $txttmtpns = ($this->input->post('txttmtpns'))?$this->input->post('txttmtpns'):null;
            $id_bank = ($this->input->post('id_bank'))?$this->input->post('id_bank'):null;
            $bpjs_kes = ($this->input->post('bpjs_kes'))?$this->input->post('bpjs_kes'):null;
            $bpjs_tk = ($this->input->post('bpjs_tk'))?$this->input->post('bpjs_tk'):null;
            $inputkpos = ($this->input->post('inputkpos'))?$this->input->post('inputkpos'):null;
            $inputkposktp = ($this->input->post('inputkposktp'))?$this->input->post('inputkposktp'):null;


            if (!empty($staff)) {
                $group = $staff;
            } elseif (!empty($kaunit)) {
                $group = $kaunit;
            } elseif(!empty($unitkerja)) {
                $group = $unitkerja;
            } elseif (!empty($txtbagian)) {
                $group = $txtbagian;
            } elseif (!empty($txtdirektorat)) {
                $group = $txtdirektorat;
            }else{
                $group = 0;
            }
//print_r($group);die();
            $salt = round(rand() * 1000);
            if (!empty($f_user_password)) {
                $password = md5($f_user_password);
                $paramss['password'] = $password;
                $paramss['salt'] = $salt;
            }

            if ($f_user_username != $f_user_edit) {
                $this->db->where('username', $f_user_username);
                $cek = $this->db->get('sys_user')->row();
            } else {
                $cek = '';
            }

            $arr['hasil'] = 'error';
            $arr['message'] = 'Data Gagal Ditambah!';

            if (empty($cek)) {

                $dataedit = $param = array(
                    "username" => $f_user_username
                    , "name" => $f_user_name
                    , "email" => $f_user_email
                    , "acces" => $acces
                    , "id_aplikasi" => '1'
                    , "id_grup" => $group
                    , "author" => $author
                    , "status" => $f_user_status_aktif
                    , "kode_klinik" => $user_id_klinik
                    , 'id_uk' => $txtjabatan
                    , 'id_shift' => ($this->input->post('id_shift'))?$this->input->post('id_shift'):null
                );
                $this->db->where('id_user', $id);
                if (!empty($paramss)) {
                    $dataedit = $param + $paramss;
                }
                $this->db->update('sys_user', $dataedit);

//simpan profile:

                $param_profile = array(
                    'nip' => $txtnip,
                    'nik' => $txtnik,
                    'nopeg' => $txtnopeg,
                    'karpeg' => $txtkarpeg,
                    'sts_p' => $txtstp,
                    'tgl_nikah' => $txttglnikah,
                    'gelar_depan' => $txtgelardepan,
                    'gelar_belakang' => $txtgelarbelakang,
                    'tgl_lahir' => $txttgllahir,
                    'tempat_lahir' => $txttlahir,
                    'kelamin' => $txtkelamin,
                    'agama' => $txtagama,
                    'pendidikan_akhir' => $txtpendidikan,
                    'phone' => $inputphone,
                    'phone2' => $inputphone2,
                    'alamat_tinggal' => $txtAlamat,
                    'rt_tinggal' => $inputrt,
                    'rw_tinggal' => $inputrw,
                    'prov_tinggal' => $txtprov,
                    'kota_tinggal' => $txtkota,
                    'kec_tinggal' => $txtkecamatan,
                    'kel_tinggal' => $txtkelurahan,
                    'alamat_ktp' => $txtAlamatKtp,
                    'rt_ktp' => $inputrtktp,
                    'rw_ktp' => $inputrwktp,
                    'prov_ktp' => $txtprovktp,
                    'kota_ktp' => $txtkotaktp,
                    'kec_ktp' => $txtkecamatanktp,
                    'kel_ktp' => $txtkelurahanktp,
                    'id_bank' => $id_bank,
                    'bpjs_kes' => $bpjs_kes,
                    'bpjs_tk' => $bpjs_tk,
                    'kode_pos' => $inputkpos,
                    'kode_posktp' => $inputkposktp,
                    'no_rek' => ($this->input->post('no_rek'))?$this->input->post('no_rek'):null,
                    'kategori_profesi' => ($this->input->post('kategori_profesi'))?$this->input->post('kategori_profesi'):null,
                    'NPWP' => ($this->input->post('npwp'))?$this->input->post('npwp'):null,
                    'id_profesi' => ($this->input->post('id_profesi'))?$this->input->post('id_profesi'):null

                );

                $this->db->where('id_user', $id);
                $this->db->update('sys_user_profile', $param_profile);

//simpan detail riwayat pegawai


                $param_rd = array(
                    'status_pegawai' => $inputstatus,
                    'status_pegawai_tetap' => $inputstatustetap,
                    'tmt_cpns' => $txttmtcpns,
                    'tmt_pns' => $txttmtpns,
                    'direktorat' => $txtdirektorat,
                    'bagian' => $txtbagian,
                    'sub_bagian' => $unitkerja,
                    'kaunit' => $kaunit,
                    'staff' => $staff,
                    'jabatan_asn' => $txtjabfung,
                    'subjabasn' => ($this->input->post('subjabasn'))?$this->input->post('subjabasn'):null,
                    'ketahli' => ($this->input->post('ketahli'))?$this->input->post('ketahli'):null,
                    'tmt_jabatan_asn' => $txttmtjabfung,
                    'jabatan_struktural' => $txtjabatan,
                    'jabatan2' => $txtjabatan1,
                    'jabatan3' => $txtjabatan2,
                    'tmt_jabatan' => $txttmtjabatan,
                    'tgl_bergabung' => $txttmtbergabung,
                    'inst_asal' => $instasi,
                    'peringkat' => $txtperingkat,
                    'no_index_dok' => $txtindex,
                    'golongan' => $txtgolongan,
                    'tmt_golongan' => $txttmtgolongan,
                    'aktif' => '1'
                );
                $this->db->where('id_user', $id);
                $this->db->where('aktif', '1');
                $this->db->update('riwayat_kedinasan', $param_rd);

                $arr['hasil'] = 'success';
                $arr['id'] = $id;
                $arr['message'] = 'Penyimpanan Berhasil!';


            }

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function getkeluarga_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization']) || true) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false || true) {
//$this->db->limit('100');
//$this->db->order_by();
            $arr = array();
            $this->db->select('his_keluarga.*');
            $this->db->where('his_keluarga.tampilkan', '1');
            if (!empty($id = $this->uri->segment(3))) {
                $this->db->where('his_keluarga.id', $id);
            }
            $res = $this->db->get('his_keluarga')->result();
            foreach ($res as $d) {
                $arr = array('id' => $d->id, 
                    'id_hubkel' => $d->id_hubkel, 
                    'id_pekerjaan' => $d->id_pekerjaan, 
                    'id_pendidikan' => $d->id_pendidikan,
                    'id_user' => $d->id_user,
                    'kelamin' => $d->kelamin,
                    'nama' => $d->nama,
                    'nik' => $d->nik,
                    'tempat_lahir' => $d->tempat_lahir,
                    'tgl_lahir' => date_format(date_create($d->tgl_lahir), "d-m-Y"),
                    'karn' => $d->karn,
                    'url' => $d->url
                );
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

// function savekeluarga_post()
// {
//     $headers = $this->input->request_headers();
//     // echo "<pre>";
//     // print_r($_POST);
//     // echo "</pre>";
//     // echo "<pre>";
//     // print_r($this->input->post());
//     // echo "</pre>";
//     // die;
//     if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
//         $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
//         if ($decodedToken != false) {

//             $config['upload_path'] = 'upload/data';
//             $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
//             $config['max_size'] = '50000000';
//             $this->load->library('upload', $config);

//             $arrdata = array(
//                 'id_user' => $decodedToken->data->id,
//                 'nik' => $this->input->post('txtNik'),
//                 'nama' => $this->input->post('txtNama'),
//                 'tempat_lahir' => $this->input->post('txtTptLahir'),
//                 'tgl_lahir' => $this->input->post('txtTglLahir'),
//                 'kelamin' => $this->input->post('txtKelamin'),
//                 'id_pendidikan' => $this->input->post('txtPendidikan'),
//                 'id_pekerjaan' => $this->input->post('txtPekerjaan'),
//                 'id_hubkel' => $this->input->post('txtHubungan'),
//             );
//             if (!$this->upload->do_upload('inputfileupload')) {
//                 $error = array('error' => $this->upload->display_errors());
//             } else {
//                 $upload = $this->upload->data();
//                 $arrdata["url"] = $upload['file_name'];
//             }

//             $this->db->insert('his_keluarga', $arrdata);

//             if ($this->db->affected_rows() == '1') {
//                 $arr['hasil'] = 'success';
//                 $arr['message'] = 'Data berhasil ditambah!';
//             } else {
//                 $arr['hasil'] = 'error';
//                 $arr['message'] = 'Data Gagal Ditambah!';
//             }


//             $this->set_response($arr, REST_Controller::HTTP_OK);

//             return;
//         }
//     }

//     $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
// }

public function listkeluarga_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $arr = array();
            $this->db->select('his_keluarga.*,m_kelamin.nama as gender,m_pendidikan.nama as nama_pendidikan,
                m_hubungan_keluarga.nama as hubkel,
                m_pekerjaan.nama as pekerjaan');
            $this->db->join('m_kelamin', 'm_kelamin.id = his_keluarga.kelamin', 'LEFT');
            $this->db->join('m_pendidikan', 'm_pendidikan.id = his_keluarga.id_pendidikan', 'LEFT');
            $this->db->join('m_hubungan_keluarga', 'm_hubungan_keluarga.id = his_keluarga.id_hubkel', 'LEFT');
            $this->db->join('m_pekerjaan', ' m_pekerjaan.id = his_keluarga.id_pekerjaan', 'LEFT');
            $this->db->where('his_keluarga.tampilkan', '1');
            if (!empty($id = $this->uri->segment(3))) {
                $this->db->where('his_keluarga.id_user', $id);
            }
            $res = $this->db->get('his_keluarga')->result();
            foreach ($res as $d) {
                $arr[] = array('id' => $d->id, 'nama' => $d->nama, 'kelamin' => $d->gender, 'nik' => $d->nik,
                    'pendidikan' => $d->nama_pendidikan,
                    'hubkel' => $d->hubkel,
                    'pekerjaan' => $d->pekerjaan,
                    'tpt_lahir' => $d->tempat_lahir,
                    'tgl_lahir' => date_format(date_create($d->tgl_lahir), "d-m-Y"),
                    'karn' => $d->karn,
                    'url' => $d->url
                );
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


// function editkeluarga_post()
// {
//     $headers = $this->input->request_headers();

//     if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
//         $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
//         if ($decodedToken != false) {

//             $config['upload_path'] = 'upload/data';
//             $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
//             $config['max_size'] = '50000000';
//             $this->load->library('upload', $config);

//             $arrdata = array(
//                 'nik' => $this->input->post('txtNik'),
//                 'nama' => $this->input->post('txtNama'),
//                 'tempat_lahir' => $this->input->post('txtTptLahir'),
//                 'tgl_lahir' => $this->input->post('txtTglLahir'),
//                 'kelamin' => $this->input->post('txtKelamin'),
//                 'id_pendidikan' => $this->input->post('txtPendidikan'),
//                 'id_pekerjaan' => $this->input->post('txtPekerjaan'),
//                 'id_hubkel' => $this->input->post('txtHubungan')
//             );
//             if (!$this->upload->do_upload('inputfileupload')) {
//                 $error = array('error' => $this->upload->display_errors());
//             } else {
//                 $upload = $this->upload->data();
//                 $arrdata["url"] = $upload['file_name'];
//             }

//             $this->db->where('id', $this->uri->segment(3));
//             $result = $this->db->update('his_keluarga', $arrdata);

//             if ($result) {
//                 $arr['hasil'] = 'success';
//                 $arr['message'] = 'Data berhasil ditambah!';
//             } else {
//                 $arr['hasil'] = 'error';
//                 $arr['message'] = 'Data Gagal Ditambah!';
//             }
//             $arr["query"] = $this->db->last_query();


//             $this->set_response($arr, REST_Controller::HTTP_OK);

//             return;
//         }
//     }

//     $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
// }

function deletekeluarga_get()
{
    $headers = $this->input->request_headers();
    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $arrdata = array(
                'tampilkan' => '0'
            );

            $this->db->where('id', $_GET['id']);
            $result=$this->db->update('his_keluarga', $arrdata);
            if ($result) {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function savependidikan_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {
            $pen_dijz=date_format(date_create($this->input->post('txtTglIjazah')), "Y-m-d");

            $arrdata = array(
                'id_user' => ($this->input->post('id_user'))?$this->input->post('id_user'):null,
                'pen_name' => ($this->input->post('txtNamaSekolah'))?$this->input->post('txtNamaSekolah'):null,
                'pen_tahn' => ($this->input->post('txtTahunLulus'))?$this->input->post('txtTahunLulus'):null,
                'pen_nijz' => ($this->input->post('txtNoIjazah'))?$this->input->post('txtNoIjazah'):null,
                'pen_dijz' => ($pen_dijz)?$pen_dijz:null,
                'pen_nkep' => ($this->input->post('txtKepalaSekolah'))?$this->input->post('txtKepalaSekolah'):null,
                'pen_desc' => ($this->input->post('txtStatusLulus'))?$this->input->post('txtStatusLulus'):null,
                'pen_lijzh' => ($this->input->post('txtHubungan'))?$this->input->post('txtHubungan'):null,
                'pen_code' => ($this->input->post('txtJPend'))?$this->input->post('txtJPend'):null,
                'pen_jur' => ($this->input->post('txtJjurusan'))?$this->input->post('txtJjurusan'):null,
                'pen_spe' => ($this->input->post('txtJspesialis'))?$this->input->post('txtJspesialis'):null,
                'pen_akr' => ($this->input->post('txtJakreditasi'))?$this->input->post('txtJakreditasi'):null,
            );

            $this->db->insert('his_pendidikan', $arrdata);
            $saved_id = $this->db->insert_id('his_pendidikanid_seq');

            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['id'] = $saved_id;
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listpendidikan_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $arr = array();
            $this->db->select('his_pendidikan.*,dm_term.nama as namaPendidikan,m_status_lulus.nama as status');
            $this->db->join('m_status_lulus', 'm_status_lulus.id = his_pendidikan.pen_desc', 'LEFT');
            $this->db->join('dm_term', 'dm_term.id = his_pendidikan.pen_code', 'LEFT');
            $this->db->where('his_pendidikan.tampilkan', '1');
			$this->db->order_by('his_pendidikan.pen_tahn','ASC');
            if (!empty($id = $this->uri->segment(3))) {
                $this->db->where('his_pendidikan.id_user', $id);
            }
			$res = $this->db->get('his_pendidikan')->result();
            foreach ($res as $d) {
				if(!empty($d->pen_dijz)){
				$pen_dijz=date_format(date_create($d->pen_dijz), "d-m-Y");
				}else{
				$pen_dijz='';
				}
                $arr[] = array('id' => $d->id,
                    'nama_sekolah' => $d->pen_name,
                    'jurusan' => $d->pen_jur,
                    'spesialis' => $d->pen_spe,
                    'akreditasi' => $d->pen_akr,
                    'jenjang' => $d->namaPendidikan,
                    'tahun' => $d->pen_tahn,
                    'no_ijazah' => $d->pen_nijz,
                    'tgl_ijazah' => $pen_dijz,
                    'pen_nkep' => $d->pen_nkep
                );
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function editpendidikan_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {
            $pen_dijz=date_format(date_create($this->input->post('txtTglIjazah')), "Y-m-d");

            $arrdata = array(
                'pen_name' => ($this->input->post('txtNamaSekolah'))?$this->input->post('txtNamaSekolah'):null,
                'pen_tahn' => ($this->input->post('txtTahunLulus'))?$this->input->post('txtTahunLulus'):null,
                'pen_nijz' => ($this->input->post('txtNoIjazah'))?$this->input->post('txtNoIjazah'):null,
                'pen_dijz' => ($pen_dijz)?$pen_dijz:null,
                'pen_nkep' => ($this->input->post('txtKepalaSekolah'))?$this->input->post('txtKepalaSekolah'):null,
                'pen_desc' => ($this->input->post('txtStatusLulus'))?$this->input->post('txtStatusLulus'):null,
                'pen_lijzh' => ($this->input->post('txtHubungan'))?$this->input->post('txtHubungan'):null,
                'pen_code' => ($this->input->post('txtJPend'))?$this->input->post('txtJPend'):null,
                'pen_jur' => ($this->input->post('txtJjurusan'))?$this->input->post('txtJjurusan'):null,
                'pen_spe' => ($this->input->post('txtJspesialis'))?$this->input->post('txtJspesialis'):null,
                'pen_akr' => ($this->input->post('txtJakreditasi'))?$this->input->post('txtJakreditasi'):null,
            );


            $this->db->where('id', $this->uri->segment(3));
            $result = $this->db->update('his_pendidikan', $arrdata);

            if ($result) {
                $arr['hasil'] = 'success';
                $arr['id'] = $this->uri->segment(3);
                $arr['message'] = 'Data berhasil diperbaharui!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function getpendidikan_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $arr = array();

            if (!empty($id = $this->uri->segment(3))) {
                $this->db->where('his_pendidikan.id', $id);
            }
            $res = $this->db->get('his_pendidikan')->result();
            foreach ($res as $d) {
				if(!empty($d->pen_dijz)){
				$pen_dijz=date_format(date_create($d->pen_dijz), "d-m-Y");
				}else{
				$pen_dijz='';
				}
                $arr = array('id' => $d->id,
                    'pen_name' => $d->pen_name,
                    'pen_adrs' => $d->pen_adrs,
                    'pen_tahn' => $d->pen_tahn,
                    'pen_nijz' => $d->pen_nijz,
                    'pen_dijz' => $pen_dijz,
                    'pekerjaan' => $d->pen_dijz,
                    'pen_nkep' => $d->pen_nkep,
                    'pen_desc' => $d->pen_desc,
                    'pen_lijzh' => $d->pen_lijzh,
                    'pen_code' => $d->pen_code,
                    'emp_nopg' => $d->emp_nopg,
                    'pen_jur' => $d->pen_jur,
                    'pen_spe' => $d->pen_spe,
                    'pen_akr' => $d->pen_akr,
                    'file' => $d->file_url

                );
            }

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function deletependidikan_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {

            $arrdata = array(
                'tampilkan' => '0'
            );

            $this->db->where('id', $_GET['id']);
            $this->db->update('his_pendidikan', $arrdata);

            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}
function file_pendi_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
			$group = $decodedToken->data->_pnc_id_grup;
            $id_user = $this->input->get('id');
            if ($id_user != "") {
                $this->db->where('id_user', $id_user);
            } else {
                $this->db->where('id_user', 0);
            }
            if(!empty($this->input->get('id_pen'))){
                $this->db->where('id_pendidikan', $this->input->get('id_pen'));
            }
            $this->db->where('tampilkan', '1');
            $resCek = $this->db->get('his_files_pen')->result();

            $da = '';
            $no = 0;
            if(!empty($this->input->get('id_pen'))){
                foreach ($resCek as $val) {
                    ++$no;
                    $text = 'text-success';

                    $da .= '<tr>';
                    $da .= '<td>';
                    $da .= $no;
                    $da .= '</td>';
                    $da .= '<td class="' . $text . '">';
                    $da .= $val->nama_file;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= '<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/pendidikan/' . $val->url . '\')"><i class="fa fa-eye"></i></a>';
                    $da .= '</td>';
					if($group ==1 OR $group ==6){
                    $da .= '<td><a class="label label-danger" href="javascript:void(0);" onClick="hapusfile(\'' . $val->id . '\')">';
                    $da .= 'Hapus';
                    $da .= '</a>';
                    $da .= '</td>';
					}
                    $da .= '</tr>';
                }
            }else{
                $text = 'text-success';

                $da .= '<tr>';
                $da .= '<td>';
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= '</td>';
                $da .= '<td>';
                $da .= '</td>';
                $da .= '<td>';
                $da .= '</td>';
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


function setpendidikan_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


            $this->db->where('id', $_GET['id']);
            $res = $this->db->get('his_pendidikan')->row();

            $this->db->where('id_user', $this->input->get('user_id'));
            $this->db->update('sys_user_profile', array('pendidikan_akhir' => $res->pen_code));


            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil diupdate!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Dirubah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function savemutasi_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);

        if ($decodedToken != false) {
			$group = $decodedToken->data->_pnc_id_grup;
			if($group!=6 OR $group!=1){
			$status="113";
			}
			if($group==6 OR $group==1){
			$status="88";
			}
			//print_r($status);die();
            $arrdata = array(
                'tampilkan' => '0'
            );

//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('txtIdUser'))) {
                $this->db->where('id_user', $this->input->post('txtIdUser'));
                $res = $this->db->get('riwayat_kedinasan')->row();

                $direktorat_asal = '';
                $bagian_asal = '';
                $sub_bagian_asal = '';

                if (!empty($res)) {
                    $direktorat_asal = $res->direktorat;
                    $bagian_asal = $res->bagian;
                    $sub_bagian_asal = $res->sub_bagian;
                }

                $this->db->where('user_id', $id);
                $this->db->where('status <>', '115');
                $cekmutasi = $this->db->get('abk_req_mutasi_jabatan')->row();

                if (!empty($cekmutasi)) {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data gagal disimpan,pegawai sedang dalam proses mutasi juga!';
                } else {
					$tgl=date_format(date_create($this->input->post('tgl_sk')), "Y-m-d");
					$tgl_mut=date_format(date_create($this->input->post('tgl_mutasi')), "Y-m-d");

                    $arrdata = array(
                        'user_id' => $id,
                        'direktorat_asal' => $direktorat_asal,
                        'bagian_asal' => $bagian_asal,
                        'sub_bagian_asal' => $sub_bagian_asal,
                        'direktorat_tujuan' => $this->input->post('txtdirektorat'),
                        'bagian_tujuan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                        'sub_bagian_tujuan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                        'tgl_mutasi' => $tgl_mut?$tgl_mut:null,
                        'keterangan' => $this->input->post('keterangan'),
                        'tgl_sk' => ($tgl)?$tgl:null,
                        'no_sk' => $this->input->post('no_sk'),
                        'id_satker' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                        'id_kelas' => ($this->input->post('kelas_jabatan'))?$this->input->post('kelas_jabatan'):null,
                        'jabatan_struktural' => $this->input->post('txtjabatan'),
                        'jenis_mutasi' => $this->input->post('jenis_mutasi'),
                        'status' => $status,
                        'grup' => $decodedToken->data->_pnc_id_grup,
                        'author' => $decodedToken->data->id
                    );

                    $this->db->insert('abk_req_mutasi_jabatan', $arrdata);


                    if ($this->db->affected_rows() == '1') {
                        $arr['hasil'] = 'success';
                        $arr['message'] = 'Data berhasil ditambah!';
                    } else {
                        $arr['hasil'] = 'error';
                        $arr['message'] = 'Data Gagal Ditambahhhh!';
                    }

                }

            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function editmutasi_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('txtIdUser'))) {
                $this->db->where('id_user', $this->input->post('txtIdUser'));
                $res = $this->db->get('riwayat_kedinasan')->row();

                $direktorat_asal = '';
                $bagian_asal = '';
                $sub_bagian_asal = '';

                if (!empty($res)) {
                    $direktorat_asal = $res->direktorat;
                    $bagian_asal = $res->bagian;
                    $sub_bagian_asal = $res->sub_bagian;
                }

//cek dulu kalau ada yg aktif non aktifkan dulu


                $arrdata = array(
                    'user_id' => $id,
                    'direktorat_asal' => $direktorat_asal,
                    'bagian_asal' => $bagian_asal,
                    'sub_bagian_asal' => $sub_bagian_asal,
                    'direktorat_tujuan' => ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null,
                    'bagian_tujuan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                    'sub_bagian_tujuan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                    'tgl_mutasi' => ($this->input->post('tgl_mutasi'))?$this->input->post('tgl_mutasi'):null,
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null,
                    'tgl_sk' => ($this->input->post('tgl_sk'))?$this->input->post('tgl_sk'):null,
                    'no_sk' => ($this->input->post('no_sk'))?$this->input->post('no_sk'):null,
                    'id_satker' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                    'id_kelas' => ($this->input->post('kelas_jabatan'))?$this->input->post('kelas_jabatan'):null,
                    'jabatan_struktural' => ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null,
                    'status' => ($this->input->post('statusproses'))?$this->input->post('statusproses'):null,
                    'jenis_mutasi' => ($this->input->post('jenis_mutasi'))?$this->input->post('jenis_mutasi'):null
                );

                if ($this->input->post('idtk')) {
                    $this->db->where('id', $this->input->post('idtk'));
                }
                $this->db->where_in('status', array('88', '89', '101'));
                $this->db->update('abk_req_mutasi_jabatan', $arrdata);


                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil dikirim!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Hanya status baru / ditolak HRD saja yg bisa melakukan kirim ulang!';
                }


            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function updatestatusmutasi_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


//cek dulu kalau ada yg aktif non aktifkan dulu

			if(!empty($this->input->get('grade'))){
			$arrdata['grade']=$this->input->get('grade');
			}
			if(!empty($this->input->get('tmt'))){
			$arrdata['tmt']=date_format(date_create($this->input->get('tmt')), "Y-m-d");
			}
			
            $arrdata['status'] = $this->input->get('status');


            $this->db->where('id', $this->input->get('id'));
			//print_r($arrdata);die();
            $sql=$this->db->update('abk_req_mutasi_jabatan', $arrdata);

            if ($sql) {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil dikirim!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal dikirim!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function savemutasifinal_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {

            $arrdata = array(
                'tampilkan' => '0'
            );

//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('txtIdUser'))) {
                $this->db->where('id_user', $this->input->post('txtIdUser'));
                $res = $this->db->get('riwayat_kedinasan')->row();

                $direktorat_asal = '';
                $bagian_asal = '';
                $sub_bagian_asal = '';

                if (!empty($res)) {
                    $direktorat_asal = $res->direktorat;
                    $bagian_asal = $res->bagian;
                    $sub_bagian_asal = $res->sub_bagian;
                }

//cek dulu kalau ada yg aktif non aktifkan dulu
                $this->db->where('user_id', $id);
                $this->db->where('aktif', '1');
                $cekmutasi = $this->db->update('his_mutasi_jabatan', array('aktif' => '0'));


                $arrdata = array(
                    'user_id' => $id,
                    'direktorat_asal' => $direktorat_asal,
                    'bagian_asal' => $bagian_asal,
                    'sub_bagian_asal' => $sub_bagian_asal,
                    'direktorat_tujuan' => ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null,
                    'bagian_tujuan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                    'sub_bagian_tujuan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                    'tgl_mutasi' => ($this->input->post('tgl_mutasi'))?$this->input->post('tgl_mutasi'):null,
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null,
                    'tgl_sk' => ($this->input->post('tgl_sk'))?$this->input->post('tgl_sk'):null,
                    'no_sk' => ($this->input->post('no_sk'))?$this->input->post('no_sk'):null,
                    'id_satker' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                    'id_kelas' => ($this->input->post('kelas_jabatan'))?$this->input->post('kelas_jabatan'):null,
                    'jabatan_struktural' => ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null
                );

                $this->db->insert('his_mutasi_jabatan', $arrdata);
                $unitkerja = ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null;
                $txtbagian = ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null;
                $txtdirektorat = ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null;

                if (!empty($res->id)) {
//update riwayat_kedinasan yg lama kasih flag 0 dan masukkan yg baru
                    $param_rd = array(
                        'id_user' => $id,
                        'status_pegawai' => $res->status_pegawai,
                        'tmt_cpns' => $res->tmt_cpns,
                        'tmt_pns' => $res->tmt_pns,
                        'direktorat' => $txtdirektorat,
                        'bagian' => $txtbagian,
                        'sub_bagian' => $unitkerja,
                        'jabatan_asn' => $res->jabatan_asn,
                        'tmt_jabatan_asn' => $res->tmt_jabatan_asn,
                        'tmt_jabatan' => $res->tmt_jabatan,
                        'tgl_bergabung' => ($this->input->post('tgl_mutasi'))?$this->input->post('tgl_mutasi'):null,
                        'inst_asal' => $res->inst_asal,
                        'peringkat' => $res->peringkat,
                        'no_index_dok' => $res->no_index_dok,
                        'golongan' => $res->golongan,
                        'tmt_golongan' => $res->tmt_golongan,
                        'jabatan_struktural' => ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null,
                        'aktif' => '1'
                    );
                    $this->db->insert('riwayat_kedinasan', $param_rd);

                    $this->db->where('id', $res->id);
                    $this->db->update('riwayat_kedinasan', array('aktif' => '0'));

                }

//update user


                if (!empty($unitkerja)) {
                    $group = $unitkerja;
                } elseif (!empty($txtbagian)) {
                    $group = $txtbagian;
                } elseif (!empty($txtdirektorat)) {
                    $group = $txtdirektorat;
                }

                $this->db->where('id_user', $id);
                $this->db->update('sys_user', array('id_grup' => $group));


                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }

            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listmutasi_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;

            $this->db->join('sys_user', 'sys_user.id_user = his_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $param = urldecode($this->uri->segment(3));
            $param2 = "%".$param."%";
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }
            $total_rows = $this->db->count_all_results('his_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (($group <> '1') AND ($group <> '6')) {
                $this->db->where('abk_req_mutasi_jabatan.grup', $group);

            }

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status', $this->input->get('status'));
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();
            foreach ($res as $d) {
                $arr['result'][] = array(
                    'id' => $d->idmutasi,
                    'nama' => $d->name,
                    'dir_asal' => $d->dir_asal,
                    'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                    'bag_asal' => $d->bag_asal,
                    'subbag_asal' => $d->subbag_asal,
                    'dir_tujuan' => $d->dir_tujuan,
                    'bag_tujuan' => $d->bag_tujuan,
                    'subbag_tujuan' => $d->subbag_tujuan,
                    'keterangan' => $d->keterangan,
                    'status' => $d->namastatus,
                    'jm' => $d->namamutasi
                );
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}
public function listmutasiuk_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;
            $id_user = $decodedToken->data->id;

            $this->db->select('riwayat_kedinasan.direktorat,riwayat_kedinasan.bagian,riwayat_kedinasan.sub_bagian');
            $this->db->where('id_user',$id_user);
            $uk = $this->db->get('riwayat_kedinasan')->row();
            $dir = $uk->direktorat;
            $bagian = $uk->bagian;
            $sub_bag = $uk->sub_bagian;


            $this->db->join('sys_user', 'sys_user.id_user = his_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $param = urldecode($this->uri->segment(3));
            $param2 = "%".$param."%";
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }
            $total_rows = $this->db->count_all_results('his_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');

            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');

            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));


            if($group!=1){

                if($sub_bag==0){
                    $this->db->where_in('abk_req_mutasi_jabatan.bagian_asal', $bagian);
                    if($bagian==0){
                        $this->db->where_in('abk_req_mutasi_jabatan.direktorat_asal', $dir);
                    }
                }else{
                    $this->db->where_in('abk_req_mutasi_jabatan.bagian_asal', $bagian);
                    $this->db->where_in('abk_req_mutasi_jabatan.sub_bagian_asal', $sub_bag);
                }
            }

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status', $this->input->get('status'));
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();
            foreach ($res as $d) {
                $arr['result'][] = array(
                    'id' => $d->idmutasi,
                    'nama' => $d->name,
                    'dir_asal' => $d->dir_asal,
                    'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                    'bag_asal' => $d->bag_asal,
                    'subbag_asal' => $d->subbag_asal,
                    'dir_tujuan' => $d->dir_tujuan,
                    'bag_tujuan' => $d->bag_tujuan,
                    'subbag_tujuan' => $d->subbag_tujuan,
                    'keterangan' => $d->keterangan,
                    'status' => $d->namastatus,
                    'jm' => $d->namamutasi
                );
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listmutasi_uk_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;

            
            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (($group <> '1') AND ($group <> '6')) {
                $this->db->where('abk_req_mutasi_jabatan.bagian_asal', $group);
            }
            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $total_rows = $this->db->count_all_results('abk_req_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (($group <> '1') AND ($group <> '6')) {
                $this->db->where('abk_req_mutasi_jabatan.bagian_asal', $group);
            }
            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();


            foreach ($res as $d) {
// echo $group.' =='. $d->direktorat_tujuan;

                $tampil = 'true';
                if ($tampil == 'true') {
                    $arr['result'][] = array(
                        'id' => $d->idmutasi,
                        'nama' => $d->name,
                        'dir_asal' => $d->dir_asal,
                        'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'bag_asal' => $d->bag_asal,
                        'subbag_asal' => $d->subbag_asal,
                        'dir_tujuan' => $d->dir_tujuan,
                        'bag_tujuan' => $d->bag_tujuan,
                        'subbag_tujuan' => $d->subbag_tujuan,
                        'keterangan' => $d->keterangan,
                        'stat' => $d->stat,
                        'status' => $d->namastatus,
                        'tgl_mutasi' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'jm' => $d->namamutasi
                    );
                }
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);
            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listmutasidireksi_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',array('113','116'));
            }
			if (($group <> '1') AND ($group <> '6')) {
                $this->db->where('abk_req_mutasi_jabatan.direktorat_asal', $group);
            }
            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $total_rows = $this->db->count_all_results('abk_req_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',array('113','116'));
            }
			if (($group <> '1') AND ($group <> '6')) {
                $this->db->where('abk_req_mutasi_jabatan.direktorat_asal', $group);
            }
            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();

			//print_r(count($res);die();
            foreach ($res as $d) {
// echo $group.' =='. $d->direktorat_tujuan;

                $tampil = 'true';
                if ($tampil == 'true') {
                    $arr['result'][] = array(
                        'id' => $d->idmutasi,
                        'nama' => $d->name,
                        'dir_asal' => $d->dir_asal,
                        'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'bag_asal' => $d->bag_asal,
                        'subbag_asal' => $d->subbag_asal,
                        'dir_tujuan' => $d->dir_tujuan,
                        'bag_tujuan' => $d->bag_tujuan,
                        'subbag_tujuan' => $d->subbag_tujuan,
                        'keterangan' => $d->keterangan,
                        'stat' => $d->stat,
                        'status' => $d->namastatus,
                        'tgl_mutasi' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'jm' => $d->namamutasi
                    );
                }
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);
            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function listmutasihrd_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;
			
            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (!empty($this->input->get('sts'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',array(118,84));
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');
            $total_rows = $this->db->count_all_results('abk_req_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (!empty($this->input->get('sts'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',array(118,84));
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();


            foreach ($res as $d) {
// echo $group.' =='. $d->direktorat_tujuan;

                $tampil = 'true';
                if ($tampil == 'true') {
                    $arr['result'][] = array(
                        'id' => $d->idmutasi,
                        'nama' => $d->name,
                        'dir_asal' => $d->dir_asal,
                        'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'bag_asal' => $d->bag_asal,
                        'subbag_asal' => $d->subbag_asal,
                        'dir_tujuan' => $d->dir_tujuan,
                        'bag_tujuan' => $d->bag_tujuan,
                        'subbag_tujuan' => $d->subbag_tujuan,
                        'keterangan' => $d->keterangan,
                        'stat' => $d->stat,
                        'status' => $d->namastatus,
                        'tgl_mutasi' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'jm' => $d->namamutasi
                    );
                }
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);
            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}
public function listmutasipeng_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;
			
            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (!empty($this->input->get('sts'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status','115');
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');
            $total_rows = $this->db->count_all_results('abk_req_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (!empty($this->input->get('sts'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',115);
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();


            foreach ($res as $d) {
// echo $group.' =='. $d->direktorat_tujuan;

                $tampil = 'true';
                if ($tampil == 'true') {
                    $arr['result'][] = array(
                        'id' => $d->idmutasi,
                        'nama' => $d->name,
                        'dir_asal' => $d->dir_asal,
                        'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'bag_asal' => $d->bag_asal,
                        'subbag_asal' => $d->subbag_asal,
                        'dir_tujuan' => $d->dir_tujuan,
                        'bag_tujuan' => $d->bag_tujuan,
                        'subbag_tujuan' => $d->subbag_tujuan,
                        'keterangan' => $d->keterangan,
                        'stat' => $d->stat,
                        'status' => $d->namastatus,
                        'tgl_mutasi' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'jm' => $d->namamutasi
                    );
                }
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);
            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}public function listmutasihi_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();
            $group = $decodedToken->data->_pnc_id_grup;
			
            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.tmt,
                abk_req_mutasi_jabatan.grade,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (!empty($this->input->get('sts'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',array(121));
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');
            $total_rows = $this->db->count_all_results('abk_req_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listmutasi/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,abk_req_mutasi_jabatan.tgl_mutasi,abk_req_mutasi_jabatan.keterangan,
                abk_req_mutasi_jabatan.id as idmutasi,
                abk_req_mutasi_jabatan.tmt,
                abk_req_mutasi_jabatan.grade,
                abk_req_mutasi_jabatan.direktorat_tujuan,
                abk_req_mutasi_jabatan.direktorat_asal,
                abk_req_mutasi_jabatan.status as stat,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan,
                dt.nama as namastatus,
                jm.nama as namamutasi');
            $this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
            $this->db->join('dm_term as dt', 'dt.id = abk_req_mutasi_jabatan.status', 'LEFT');
            $this->db->join('dm_term as jm', 'abk_req_mutasi_jabatan.jenis_mutasi = jm.id', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }

            $this->db->join('sys_user', 'sys_user.id_user = abk_req_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->where('EXTRACT(YEAR FROM abk_req_mutasi_jabatan.tgl_mutasi) =', date('Y'));

            if (!empty($this->input->get('status'))) {
                $this->db->where('abk_req_mutasi_jabatan.status',$this->input->get('status'));
            }
			if (!empty($this->input->get('sts'))) {
                $this->db->where_in('abk_req_mutasi_jabatan.status',array(121));
            }


            $this->db->order_by('abk_req_mutasi_jabatan.tgl_mutasi', 'DESC');

            $res = $this->db->get('abk_req_mutasi_jabatan')->result();


            foreach ($res as $d) {
// echo $group.' =='. $d->direktorat_tujuan;

                $tampil = 'true';
                if ($tampil == 'true') {
                    $arr['result'][] = array(
                        'id' => $d->idmutasi,
                        'nama' => $d->name,
                        'dir_asal' => $d->dir_asal,
                        'tgl' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'bag_asal' => $d->bag_asal,
                        'subbag_asal' => $d->subbag_asal,
                        'dir_tujuan' => $d->dir_tujuan,
                        'bag_tujuan' => $d->bag_tujuan,
                        'subbag_tujuan' => $d->subbag_tujuan,
                        'keterangan' => $d->keterangan,
                        'stat' => $d->stat,
                        'status' => $d->namastatus,
                        'tgl_mutasi' => date_format(date_create($d->tgl_mutasi), "d-m-Y"),
                        'tmt' => date_format(date_create($d->tmt), "d-m-Y"),
                        'grade' => $d->grade,
                        'jm' => $d->namamutasi
                    );
                }
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
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
                $tglawal = date('Y-m-d', strtotime($this->uri->segment(4)));
                $thn = date('Y');
$tglakhir = date('Y-m-d', strtotime('+'.$lama_cuti2.' days', strtotime($tglawal))); // Tgl Selesai termasuk minggu & libur nasional
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

function tglizin_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $lama_cuti1 = $this->uri->segment(3);
            if(!empty($this->uri->segment(4))){
                $tglawal = date('d-m-Y', strtotime($this->uri->segment(4)));
                if(8<$lama_cuti1){
                    $lama_cuti=1;
                }else{
                    $lama_cuti=0;
                }
$tgl_selesai_tanpa_libur = date('d-m-Y', strtotime('+'.$lama_cuti.' days', strtotime($tglawal))); // Hasil akhir 
}else{
    $tgl_selesai_tanpa_libur='';
}
if (!empty($tgl_selesai_tanpa_libur)) {
    $arr[] = array('tgl_selesai' => $tgl_selesai_tanpa_libur,
);
} else {
    $arr['hasil'] = 'error';
}
$this->set_response($arr, REST_Controller::HTTP_OK);

return;
}
}

$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function cekcutiold_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $id_cuti = $this->input->get('id');
            $id_user = $this->input->get('id_user');
            $tahun = date('Y');

            if ($id_cuti !== '1') {
                $arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti <strong> 12  Hari</strong></div>';
                $arr['jumlah'] = 12;

                return $this->set_response($arr, REST_Controller::HTTP_OK);
            }

            $this->db->where('id', $id_cuti);
            $this->db->where('tampilkan', '1');
            $res = $this->db->get('m_jenis_cuti')->row();

            $this->db->select('sum(total) as total_cuti');
            $this->db->where('jenis_cuti', $id_cuti);
            $this->db->where('id_user', $id_user);
            $this->db->where('status != 108');
            $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', $tahun);
            $this->db->where('tampilkan', '1');

            $resCek = $this->db->get('his_cuti')->row();

            $cuti_sudahDiambil = $resCek->total_cuti;
            $total = $res->jumlah;

            if ($total <= $cuti_sudahDiambil) {
                $arr['message'] = '<div class="alert alert-danger">Maaf cuti anda tahun ini <strong>sudah melampaui batas!</strong></div>';
            } else {
                if ($id_cuti == '1') {
                    $c = $total - $cuti_sudahDiambil;
                    $this->db->select('sum(total) as total_cuti');
                    $this->db->where('jenis_cuti', '1');
                    $this->db->where('id_user', $id_user);
                    $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', ($tahun - 1));
                    $this->db->where('status != 108');
                    $this->db->where('tampilkan', '1');
                    $resCeklalu = $this->db->get('his_cuti')->row();
                    $cutikmrn=$resCeklalu->total_cuti;
                    if ($cutikmrn > 18) {
                        $jumcuti = 18;
                    } else {
                        $jumcuti = $cutikmrn;
                    }
                    $cutithnlalu = 18 - $jumcuti;
                    $jumlahtot = 12 + $cutithnlalu;
                    if ($jumlahtot > 18) {
                        $jumlah = 18;
                    } else {
                        $jumlah = $jumlahtot;
                    }
                    $jumlahcuti = $jumlah - $cuti_sudahDiambil;
                    if (!empty($resCeklalu->total_cuti)) {
                        if ($jumlahcuti > 18) {
                            $cc = 18;
                        } else {
                            $cc = $jumlahcuti;
                        }
                    }else{
                        if(!empty($cuti_sudahDiambil)){
                            $cc = 18-$cuti_sudahDiambil;
                        }else{
                            $cc = 18;
                        }
                    }
                }

                $arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti <strong>' . $cc . ' Hari</strong></div>';
                $arr['jumlah'] = $cc;
            }

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
            $this->db->where('status != 108');
            $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', $tahun);
            $this->db->where('tampilkan', '1');
            $resCekSkrg = $this->db->get('his_cuti')->row();

            $this->db->where('abid', $kd_jenis_cuti);
            $this->db->where('tampilkan', '1');
            $this->db->where('tahun', $tahunskrg);
            $resMaxSkrg = $this->db->get('m_jenis_cuti')->row();

            $cuti_skrg = $resCekSkrg->total_cuti;
            $max_cuti_skrg = $resMaxSkrg->jumlah;

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

            $arr['message'] = '<div class="alert alert-success">Anda memiliki sisa cuti <strong>' . $cc . ' Hari</strong></div>';
            $arr['jumlah'] = $cc;
            $arr['warning'] = "";

            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function cekizin_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $id_izin = $this->input->get('id');
            $id_user = $this->input->get('id_user');
            $tgl_izin = $this->input->get('tgl_izin');
            $tahun = date('Y');
            $this->db->select('sum(total) as total_izin');
            $this->db->where('id_user', $id_user);
            $this->db->where('status != 108');
            $this->db->where('EXTRACT(YEAR FROM tgl_izin) =', $tahun);
            $this->db->where('tampilkan', '1');
            $resCek = $this->db->get('his_izin')->row();
            $izin_sudahDiambil = $resCek->total_izin;
            $total = 224;
            if ($total <= $izin_sudahDiambil) {
                $arr['message'] = '<div class="alert alert-danger">Maaf Izin anda tahun ini <strong>sudah melampaui batas!</strong></div>';
            } else {
                $jum= $total - $izin_sudahDiambil;
                if($jum > 12){
                    $arr['message'] = '<div class="alert alert-success">Anda memiliki sisa Izin <strong> ' . $jum . ' Jam</strong></div>';
                    $arr['jumlah'] = 12;
                }else{
                    $arr['message'] = '<div class="alert alert-success">Anda memiliki sisa Izin <strong>' . $jum . ' Jam</strong></div>';
                    $arr['jumlah'] = $jum;
                }
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
        if ($decodedToken != false) {
            $tgl = ($this->input->post('tgl_cuti'))?$this->input->post('tgl_cuti'):null;
            $jml = ($this->input->post('jumlahCuti'))?$this->input->post('jumlahCuti'):null;
            $sampai = ($this->input->post('sampai'))?$this->input->post('sampai'):null;

//cek lagi
            $jenis_cuti = ($this->input->post('jenis_cuti'))?$this->input->post('jenis_cuti'):null;
            $id_user = ($this->input->post('id_user'))?$this->input->post('id_user'):null;
            $id_group = ($this->input->post('id_group'))?$this->input->post('id_group'):null;
            $keterangan = ($this->input->post('keterangan'))?$this->input->post('keterangan'):null;
            $tahun = date('Y');
            $tahunskrg = $tahun;
            $tahunlalu = ($tahun - 1);

            $this->db->where('id', $jenis_cuti);
            $this->db->where('tampilkan', '1');
            $res = $this->db->get('m_jenis_cuti')->row();
            $kd_jenis_cuti = $res->abid;

            $this->db->where('id_user', $id_user);
            $resShift = $this->db->get('sys_user')->row();
            $status_shift = $resShift->id_shift;

            $this->db->select('sum(total) as total_cuti');
            $this->db->where('jenis_cuti', $jenis_cuti);
            $this->db->where('id_user', $id_user);
            $this->db->where('status != 108');
            $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', $tahun);
            $this->db->where('tampilkan', '1');
            $resCekSkrg = $this->db->get('his_cuti')->row();

            $this->db->where('abid', $kd_jenis_cuti);
            $this->db->where('tampilkan', '1');
            $this->db->where('tahun', $tahunskrg);
            $resMaxSkrg = $this->db->get('m_jenis_cuti')->row();

            $cuti_skrg = $resCekSkrg->total_cuti;
            $max_cuti_skrg = $resMaxSkrg->jumlah;

            $this->db->select('sum(total) as total_cuti');
            $this->db->where('jenis_cuti', $jenis_cuti);
            $this->db->where('id_user', $id_user);
            $this->db->where('EXTRACT(YEAR FROM tgl_cuti) =', ($tahun - 1));
            $this->db->where('status != 108');
            $this->db->where('tampilkan', '1');
            $resCekLalu = $this->db->get('his_cuti')->row();

            $this->db->where('abid', $kd_jenis_cuti);
            $this->db->where('tampilkan', '1');
            $this->db->where('tahun', $tahunlalu);
            $resMaxLalu = $this->db->get('m_jenis_cuti')->row();

            $cuti_kmrn = $resCekLalu->total_cuti;
            $max_cuti_kmrn = $resMaxLalu->jumlah;

            if ($cuti_kmrn > 18) {
                $jumcuti = 18;
            } else {
                $jumcuti = $cuti_kmrn;
            }

            $cutithnlalu = 18 - $jumcuti;
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
                    $cc = 18 - $cuti_skrg;
                }else{
                    $cc = 18;
                }
            }

            if ($jml <= $cc) {

                $datacuti = array(
                    'id_user' => $id_user,
                    'total' => $jml,
                    'tgl_cuti' => $tgl,
                    'tgl_akhir_cuti' => $sampai,
                    'jenis_cuti' => $jenis_cuti,
                    'status' => '102',
                    'keterangan' => $keterangan,
                    'id_group' => $id_group

                );
                $this->db->insert('his_cuti', $datacuti);
                $id_cuti = $this->db->insert_id('his_cutiid_seq');


                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }

                $this->db->select('libur.tanggal as tgl');
                $this->db->where('tahun', $tahun);
                $tgl_libur = $this->db->get('libur')->result();
                foreach ( $tgl_libur as $harilibur ) {
                    $liburnasional[] = $harilibur->tgl;
                }

                $jmldetik = 24*60*60;
                $a = strtotime($tgl);
                $b = strtotime($sampai);

                $haricuti = array();
                if ($status_shift == "51") {
                    for ($i=$a; $i <= $b; $i += $jmldetik) {
                        if (date('w', $i) !== '0' && date('w', $i) !== '6') {
                            if (!in_array(date('Y-m-d', $i), $liburnasional)) {
                                $haricuti[] = $i;
                            } 
                        } 

                    }

                    foreach ( $haricuti as $tgl_cuti ) {
                        $datadetail = array(
                            'id_cuti' => $id_cuti,
                            'id_user' => $id_user,
                            'tgl_cuti' => date('Y-m-d', $tgl_cuti),
                            'jenis_cuti' => $jenis_cuti,
                            'status' => '102',
                            'keterangan' => $keterangan,
                            'id_group' => $id_group
                        );

                        $this->db->insert('his_cuti_detail', $datadetail);
                    }
                } else if ($status_shift == '50'){
                    for ($i=$a; $i <= $b; $i += $jmldetik) {
                        if (!in_array(date('Y-m-d', $i), $liburnasional)) {
                            $haricuti[] = $i;
                        } 

                    }

                    foreach ( $haricuti as $tgl_cuti ) {
                        $datadetail = array(
                            'id_cuti' => $id_cuti,
                            'id_user' => $id_user,
                            'tgl_cuti' => date('Y-m-d', $tgl_cuti),
                            'jenis_cuti' => $jenis_cuti,
                            'status' => '102',
                            'keterangan' => $keterangan,
                            'id_group' => $id_group
                        );

                        $this->db->insert('his_cuti_detail', $datadetail);
                    }
                }

            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Sisa Cuti Anda Kurang!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function saveizin_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $tgl = ($this->input->post('tgl_izin'))?$this->input->post('tgl_izin'):null;
            $jml = ($this->input->post('jumlahizin'))?$this->input->post('jumlahizin'):null;

            $date = date_create($tgl);
            date_add($date, date_interval_create_from_date_string($jml . " days"));
            $sampai = date_format($date, "Y-m-d");

//cek lagi
            $id_izin = ($this->input->post('jenis_izin'))?$this->input->post('jenis_izin'):null;
            $id_user = ($this->input->post('id_user'))?$this->input->post('id_user'):null;
            $tahun = date('Y');
            $this->db->where('id', $id_izin);
            $this->db->where('tampilkan', '1');

            $res = $this->db->get('m_jenis_izin')->row();

            $this->db->select('sum(total) as total_izin');
            $this->db->where('jenis_izin', $id_izin);
            $this->db->where('id_user', $id_user);
            $this->db->where('EXTRACT(YEAR FROM tgl_izin) =', $tahun);
            $this->db->where('tampilkan', '1');

            $resCek = $this->db->get('his_izin')->row();

            $izin_sudahDiambil = $resCek->total_izin;
            $total = $res->jumlah;

            $totalizin = $izin_sudahDiambil + $jml;
            if ($totalizin <= $total) {

                $dataizin = array(
                    'id_user' => $id_user,
                    'total' => $jml,
                    'tgl_izin' => $tgl,
                    'tgl_akhir_izin' => $sampai,
                    'jenis_izin' => $id_izin,
                    'status' => '102',
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null

                );

                $this->db->insert('his_izin', $dataizin);
                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }

            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
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

function listizin_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id_user = $this->input->get('id_user');
            $thn = date('Y');
            $this->db->select('m_jenis_izin.nama as namcut,his_izin.*,dm_term.nama as statuspros');
            $this->db->join('m_jenis_izin', 'm_jenis_izin.id = his_izin.jenis_izin');
            $this->db->join('dm_term', 'dm_term.id = his_izin.status');
            $this->db->where('EXTRACT(YEAR FROM his_izin.tgl_izin) =',$thn);
            $this->db->where('id_user', $id_user);
            $this->db->where('his_izin.tampilkan', '1');
            $this->db->order_by('tgl_izin', 'DESC');
            $resCek = $this->db->get('his_izin')->result();

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
                $da .= date_format(date_create($val->tgl_izin), "d-m-Y");
                $da .= '</td>';
                $da .= '<td>';
                $da .= date_format(date_create($val->tgl_akhir_izin), "d-m-Y");
                $da .= '</td>';
                $da .= '<td>';
                $da .= $val->total;
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= $val->statuspros;
                $da .= '</td>';
                $da .= '<td><a class="label label-danger" href="javascript:void(0);" onClick="prosesizin(\'' . $val->id . '\')">';
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

public function beristratuscuti_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $id = $this->input->get('id');
            $status = $this->input->get('status');
            $this->db->where('id', $id);
            $arraycuti['status'] = $status;
            if ($status == '0') {
                $arraycuti['tampilkan'] = '0';
                $this->db->where('status', '102');
            }
            $this->db->update('his_cuti', $arraycuti);

            if ($status == '0') {
                $this->db->where('id_cuti', $id);
                $arraycutidetail['tampilkan'] = '0';
                $this->db->update('his_cuti_detail', $arraycutidetail);
            }

            if ($status != '0') {
                $this->db->where('id_cuti', $id);
                $arraycutidetail['status'] = $status;
                $this->db->update('his_cuti_detail', $arraycutidetail);
            }
            $arr['hasil'] = 'success';
            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function beristratusizin_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $id = $this->input->get('id');
            $status = $this->input->get('status');
            $this->db->where('id', $id);
            $arrayizin['status'] = $status;
            if ($status == '0') {
                $arrayizin['tampilkan'] = '0';
                $this->db->where('status', '102');
            }
            $this->db->update('his_izin', $arrayizin);
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
            if($sub_bag==0){
                $this->db->where_in('riwayat_kedinasan.bagian', $bagian);
                if($bagian==0){
                    $this->db->where_in('riwayat_kedinasan.direktorat', $dir);
                    $this->db->like("m_index_jabatan_asn_detail.ds_jabatan",'Kepala Bagian');
                }
            }else{
                $this->db->where_in('riwayat_kedinasan.bagian', $bagian);
                $this->db->where_in('riwayat_kedinasan.sub_bagian', $sub_bag);
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

            $arr['hasil'] = 'success';
            $arr['isi'] = $da;
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
            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);


}

function listizinall_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
            $user_froup = $decodedToken->data->_pnc_id_grup;
            $id_user = $this->input->get('id_user');
            $this->db->select('m_jenis_izin.nama as namcut,his_izin.*,dm_term.nama as statuspros,sys_user.name as namapegawai');
            $this->db->join('m_jenis_izin', 'm_jenis_izin.id = his_izin.jenis_izin');
            $this->db->join('dm_term', 'dm_term.id = his_izin.status');
            $this->db->join('sys_user', 'sys_user.id_user = his_izin.id_user');
            $this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
            $this->db->where('his_izin.tampilkan', '1');
            $this->db->where('his_izin.status', '102');
            if ($user_froup!=1) {
                $this->db->where("riwayat_kedinasan.bagian",$user_froup);  
            }

            if (empty($this->input->get('tahun'))) {
                $thn = date('Y');
            } else {
                $thn = $this->input->get('tahun');
            }
            $this->db->where('EXTRACT(YEAR FROM his_izin.tgl_akhir_izin) =',$thn);
            if(!empty($this->input->get('bulan'))){
                $this->db->where('EXTRACT(MONTH FROM his_izin.tgl_akhir_izin) =',$this->input->get('bulan'));
            }
            $this->db->order_by('tgl_izin', 'DESC');
            $resCek = $this->db->get('his_izin')->result();
            $da = '';
            foreach ($resCek as $val) {
                $text = 'text-success';
                if ($val->status == '1') {
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
                $da .= date_format(date_create($val->tgl_izin), "d-m-Y");
                $da .= '</td>';
                $da .= '<td>';
                $da .= date_format(date_create($val->tgl_akhir_izin), "d-m-Y");
                $da .= '</td>';
                $da .= '<td>';
                $da .= $val->total;
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= $val->statuspros;
                $da .= '</td>';
                $da .= '<td>';
                $da .= '<a class="label label-success" href="javascript:void(0);" onClick="prosesizin(\'' . $val->id . '\',\'107\')">';
                $da .= 'Setujui';
                $da .= '</a>';
                $da .= '<a class="label label-danger" href="javascript:void(0);" onClick="prosesizin(\'' . $val->id . '\',\'108\')">';
                $da .= 'Tolak';
                $da .= '</a>';
                $da .= '</td>';
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

function listizisdm_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id_user = $this->input->get('id_user');
            $this->db->select('m_jenis_izin.nama as namcut,his_izin.*,dm_term.nama as statuspros,sys_user.name as namapegawai');
            $this->db->join('m_jenis_izin', 'm_jenis_izin.id = his_izin.jenis_izin');
            $this->db->join('dm_term', 'dm_term.id = his_izin.status');
            $this->db->join('sys_user', 'sys_user.id_user = his_izin.id_user');
            $this->db->where('his_izin.tampilkan', '1');
            $this->db->where('his_izin.status', '107');
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
            $this->db->where('EXTRACT(YEAR FROM his_izin.tgl_akhir_izin) =',$thn);
            if(!empty($this->input->get('bulan'))){
                $this->db->where('EXTRACT(MONTH FROM his_izin.tgl_akhir_izin) =',$this->input->get('bulan'));
            }
            $this->db->order_by('tgl_izin', 'DESC');
            $resCek = $this->db->get('his_izin')->result();
            $da = '';
            foreach ($resCek as $val) {
                $text = 'text-success';
                if ($val->status == '1') {
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
                $da .= date_format(date_create($val->tgl_izin), "d-m-Y");
                $da .= '</td>';
                $da .= '<td>';
                $da .= date_format(date_create($val->tgl_akhir_izin), "d-m-Y");
                $da .= '</td>';
                $da .= '<td>';
                $da .= $val->total;
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= $val->statuspros;
                $da .= '</td>';
                $da .= '<td>';
                $da .= '<a class="label label-success" href="javascript:void(0);" onClick="prosesizin(\'' . $val->id . '\',\'103\')">';
                $da .= 'Setujui';
                $da .= '</a>';
                $da .= '<a class="label label-danger" href="javascript:void(0);" onClick="prosesizin(\'' . $val->id . '\',\'108\')">';
                $da .= 'Tolak';
                $da .= '</a>';
                $da .= '</td>';
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

public function listpensiun_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();


            $this->db->join('sys_user', 'sys_user.id_user = his_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $param = urldecode($this->uri->segment(3));
            $param2 = "%".$param."%";
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }
            $total_rows = $this->db->count_all_results('his_mutasi_jabatan');
            $pagination = create_pagination_endless('/pegawai/listpensiun/0/', $total_rows, 20, 4);

            $this->db->select('sys_user.*,a.grup as dir_asal,his_mutasi_jabatan.tgl_mutasi,
                b.grup as bag_asal,
                c.grup as subbag_asal,
                d.grup as dir_tujuan,
                e.grup as bag_tujuan,
                f.grup as subbag_tujuan');
            $this->db->join('sys_grup_user as f', 'f.id_grup = his_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as e', 'e.id_grup = his_mutasi_jabatan.bagian_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as d', 'd.id_grup = his_mutasi_jabatan.direktorat_tujuan', 'LEFT');
            $this->db->join('sys_grup_user as c', 'c.id_grup = his_mutasi_jabatan.sub_bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as b', 'b.id_grup = his_mutasi_jabatan.bagian_asal', 'LEFT');
            $this->db->join('sys_grup_user as a', 'a.id_grup = his_mutasi_jabatan.direktorat_asal', 'LEFT');
            if (!empty($this->uri->segment(3))) {
                $this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
            }
            $this->db->join('sys_user', 'sys_user.id_user = his_mutasi_jabatan.user_id', 'LEFT');
            $this->db->where('sys_user.status', '1');
            $this->db->limit($pagination['limit'][0], $pagination['limit'][1]);

            $res = $this->db->get('his_mutasi_jabatan')->result();
            foreach ($res as $d) {
                $arr['result'][] = array(
                    'nama' => $d->name,
                    'dir_asal' => $d->dir_asal,
                    'tgl' => $d->tgl_mutasi,
                    'bag_asal' => $d->bag_asal,
                    'subbag_asal' => $d->subbag_asal,
                    'dir_tujuan' => $d->dir_tujuan,
                    'bag_tujuan' => $d->bag_tujuan,
                    'subbag_tujuan' => $d->subbag_tujuan
                );
            }

            $arr['total'] = $total_rows;
            $arr['paging'] = $pagination['limit'][1];
            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function savepensiun_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('txtIdUser'))) {
                $id_alasan = ($this->input->post('id_alasan'))?$this->input->post('id_alasan'):null;
                $keterangan = ($this->input->post('keterangan'))?$this->input->post('keterangan'):null;
                $no_sk = ($this->input->post('no_sk'))?$this->input->post('no_sk'):null;
                $pejabat = ($this->input->post('pejabat'))?$this->input->post('pejabat'):null;
                $tgl = ($this->input->post('tgl_keluar'))?$this->input->post('tgl_keluar'):null;

                $arratdata = array(
                    'id_user' => $id,
                    'tgl_keluar' => $tgl,
                    'no_sk' => $no_sk,
                    'alasan' => $keterangan,
                    'id_alasan' => $id_alasan,
                    'id_pejabat' => $pejabat
                );

                $this->db->insert('his_pegawai_resign', $arratdata);
                $this->db->where('id_user', $id);
                $this->db->update('sys_user', array('status' => '0', 'kd_keluar' => $id_alasan));

                if ($this->db->affected_rows() == '1') {
                    $arr['hasil'] = 'success';
                    $arr['message'] = 'Data berhasil ditambah!';
                } else {
                    $arr['hasil'] = 'error';
                    $arr['message'] = 'Data Gagal Ditambah!';
                }

            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function savejabatan_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('txtIdUser'))) {

                
				if(!empty($this->input->post('tgl_mutasi'))){
				$tgl_mutasi=date_format(date_create($this->input->post('tgl_mutasi')), "Y-m-d");
				}else{$tgl_mutasi="";}
				if(!empty($this->input->post('tgl_sk'))){
                $tgl_sk=date_format(date_create($this->input->post('tgl_sk')), "Y-m-d");
				}else{$tgl_sk="";}
                $arrdata = array(
                    'user_id' => $id,
                    'direktorat_tujuan' => ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null,
                    'bagian_tujuan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                    'sub_bagian_tujuan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                    'kaunit_tujuan' => ($this->input->post('kaunit'))?$this->input->post('kaunit'):null,
                    'staff_tujuan' => ($this->input->post('staff'))?$this->input->post('staff'):null,
                    'tgl_mutasi' => ($tgl_mutasi)?$tgl_mutasi:null,
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null,
                    'tgl_sk' => ($tgl_sk)?$tgl_sk:null,
                    'no_sk' => ($this->input->post('no_sk'))?$this->input->post('no_sk'):null,
                    'jabatan' => ($this->input->post('jabatan'))?$this->input->post('jabatan'):null,
                    'jabatan2' => ($this->input->post('jabatan2'))?$this->input->post('jabatan2'):null,
                    'jabatan3' => ($this->input->post('jabatan3'))?$this->input->post('jabatan3'):null,
                    'id_satker' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                    'id_kelas' => ($this->input->post('kelas_jabatan'))?$this->input->post('kelas_jabatan'):null,
                    'aktif' => '0'
                );

                $this->db->insert('his_mutasi_jabatan', $arrdata);


            }

//update user


            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }

        }


        $this->set_response($arr, REST_Controller::HTTP_OK);

        return;

    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function editjabatan_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('idjabatan'))) {

                if(!empty($this->input->post('tgl_mutasi'))){
				$tgl_mutasi=date_format(date_create($this->input->post('tgl_mutasi')), "Y-m-d");
				}else{$tgl_mutasi="";}
				if(!empty($this->input->post('tgl_sk'))){
                $tgl_sk=date_format(date_create($this->input->post('tgl_sk')), "Y-m-d");
				}else{$tgl_sk="";}
                $arrdata = array(
                    'direktorat_tujuan' => ($this->input->post('txtdirektorat'))?$this->input->post('txtdirektorat'):null,
                    'bagian_tujuan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                    'sub_bagian_tujuan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                    'kaunit_tujuan' => ($this->input->post('kaunit'))?$this->input->post('kaunit'):null,
                    'staff_tujuan' => ($this->input->post('staff'))?$this->input->post('staff'):null,
                    'tgl_mutasi' => ($tgl_mutasi)?$tgl_mutasi:null,
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null,
                    'tgl_sk' => ($tgl_sk)?$tgl_sk:null,
                    'no_sk' => ($this->input->post('no_sk'))?$this->input->post('no_sk'):null,
                    'jabatan' => ($this->input->post('jabatan'))?$this->input->post('jabatan'):null,
                    'jabatan2' => ($this->input->post('jabatan2'))?$this->input->post('jabatan2'):null,
                    'jabatan3' => ($this->input->post('jabatan3'))?$this->input->post('jabatan3'):null,
                    'id_satker' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                    'id_kelas' => ($this->input->post('kelas_jabatan'))?$this->input->post('kelas_jabatan'):null,

                );
                $this->db->where('id', $id);
                //$this->db->where('aktif', '0');
                $sql=$this->db->update('his_mutasi_jabatan', $arrdata);


            }

//update user


            if ($sql) {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal update! jabatan aktif tidak dapat dirubah';
            }

        }


        $this->set_response($arr, REST_Controller::HTTP_OK);

        return;

    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function setjabatan_get()
{
    $headers = $this->input->request_headers();
    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {
            $this->db->where('id', $_GET['id']);
            $res = $this->db->get('his_mutasi_jabatan')->row();
            $this->db->where('id_user', $this->input->get('user_id'));
            $updatekedinasan = array(
                'jabatan_struktural' => $res->jabatan,
                'jabatan2' => $res->jabatan2,
                'jabatan3' => $res->jabatan3,
                'direktorat' => $res->direktorat_tujuan,
                'bagian' => $res->bagian_tujuan,
                'sub_bagian' => $res->sub_bagian_tujuan,
                'kaunit' => $res->kaunit_tujuan,
                'staff' => $res->staff_tujuan
            );
            $this->db->update('riwayat_kedinasan', $updatekedinasan);
            if (!empty($res->staff_tujuan)) {
                $group = $res->staff_tujuan;
            } elseif (!empty($res->kaunit_tujuan)) {
                $group = $res->kaunit_tujuan;
            }elseif (!empty($res->sub_bagian_tujuan)) {
                $group = $res->sub_bagian_tujuan;
            } elseif (!empty($res->bagian_tujuan)) {
                $group = $res->bagian_tujuan;
            } elseif (!empty($res->direktorat_tujuan)) {
                $group = $res->direktorat_tujuan;
            }else{
                $group = 0;
            }
            $this->db->where('id_user', $this->input->get('user_id'));
            $updatekedinasan = array(
                'id_grup' => $group,
            );
            $this->db->update('sys_user', $updatekedinasan);
            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil diupdate!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Dirubah!';
            }
            $this->set_response($arr, REST_Controller::HTTP_OK);
            return;
        }
    }
    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function setgolongan_get()
{
    $headers = $this->input->request_headers();
    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {
            $this->db->where('id', $_GET['id']);
            $res = $this->db->get('his_golongan')->row();
            $this->db->where('id_user', $this->input->get('user_id'));
            $this->db->update('riwayat_kedinasan', array(
                'golongan' => $res->golongan_id,
                'tmt_golongan' => $res->tmt_golongan
            ));
            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil diupdate!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Dirubah!';
            }
            $this->set_response($arr, REST_Controller::HTTP_OK);
            return;
        }
    }
    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function listfile_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id_user = $this->input->get('id');
            if ($id_user != "") {
                $this->db->where('id_user', $id_user);
            } else {
                $this->db->where('id_user', 0);
            }
			if(!empty($this->input->get('kategori'))){
            $this->db->where('kategori_id', $this->input->get('kategori'));
            }
			$this->db->where('tampilkan', '1');
            $this->db->order_by('tgl', 'DESC');
            $resCek = $this->db->get('his_files')->result();

            $da = '';
            $no = 0;
            foreach ($resCek as $val) {
                ++$no;
                $text = 'text-success';

                $da .= '<tr>';
                $da .= '<td>';
                $da .= $no;
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= $val->nama_file;
                $da .= '</td>';
                $da .= '<td>';
                $da .= '<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/' . $val->url . '\')"><i class="fa fa-eye"></i></a>';
                $da .= '</td>';
                $da .= '<td><a class="label label-danger" href="javascript:void(0);" onClick="hapusfile(\'' . $val->id . '\')">';
                $da .= 'Hapus';
                $da .= '</a>';
                $da .= '</td>';

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

function listfiletg_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {

            $id_user = $this->input->get('id');
            if ($id_user != "") {
                $this->db->where('id_user', $id_user);
            } else {
                $this->db->where('id_user', 0);
            }
			if(!empty($this->input->get('kategori'))){
            $this->db->where('kategori_id', $this->input->get('kategori'));
            }
			$this->db->where('tampilkan', '1');
            $this->db->order_by('tgl', 'DESC');
            $resCek = $this->db->get('his_files')->result();

            $da = '';
            $no = 0;
            foreach ($resCek as $val) {
                ++$no;
                $text = 'text-success';

                $da .= '<tr>';
                $da .= '<td>';
                $da .= $no;
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= $val->nama_file;
                $da .= '</td>';
                $da .= '<td>';
                $da .= '<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/' . $val->url . '\')"><i class="fa fa-eye"></i></a>';
                $da .= '</td>';

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

function file_klg_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        if ($decodedToken != false) {
		$group = $decodedToken->data->_pnc_id_grup;
            $id_user = $this->input->get('id');
            if ($id_user != "") {
                $this->db->where('id_user', $id_user);
            } else {
                $this->db->where('id_user', 0);
            }
            if(!empty($this->input->get('id_kel'))){
                $this->db->where('id_keluarga', $this->input->get('id_kel'));
            }
            $this->db->where('tampilkan', '1');
            $this->db->order_by('tgl', 'DESC');
            $resCek = $this->db->get('his_files_kel')->result();

            $da = '';
            $no = 0;
            if(!empty($this->input->get('id_kel'))){
                foreach ($resCek as $val) {
                    ++$no;
                    $text = 'text-success';

                    $da .= '<tr>';
                    $da .= '<td>';
                    $da .= $no;
                    $da .= '</td>';
                    $da .= '<td class="' . $text . '">';
                    $da .= $val->nama_file;
                    $da .= '</td>';
                    $da .= '<td>';
                    $da .= '<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/data/' . $val->url . '\')"><i class="fa fa-eye"></i></a>';
                    $da .= '</td>';
					if($group==1 OR $group==6){
                    $da .= '<td><a class="label label-danger" href="javascript:void(0);" onClick="hapusfile(\'' . $val->id . '\')">';
                    $da .= 'Hapus';
                    $da .= '</a>';
                    $da .= '</td>';
					}

                    $da .= '</tr>';
                }
            }else{
                $text = 'text-success';

                $da .= '<tr>';
                $da .= '<td>';
                $da .= '</td>';
                $da .= '<td class="' . $text . '">';
                $da .= '</td>';
                $da .= '<td>';
                $da .= '</td>';
                $da .= '<td>';
                $da .= '</td>';
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

function deletelist_pen_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {

            $arrdata = array(
                'tampilkan' => '0'
            );

            $this->db->where('id', $_GET['id']);
            $this->db->update('his_files_pen', $arrdata);

            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function deletelist_klg_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {

            $arrdata = array(
                'tampilkan' => '0'
            );

            $this->db->where('id', $_GET['id']);
            $this->db->update('his_files_kel', $arrdata);

            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function deletelistfile_get()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {

            $arrdata = array(
                'tampilkan' => '0'
            );

            $this->db->where('id', $_GET['id']);
            $this->db->update('his_files', $arrdata);

            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }


            $this->set_response($arr, REST_Controller::HTTP_OK);

            return;
        }
    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function savejfung_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {


//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('txtIdUser'))) {
				if(!empty($this->input->post('tmt_jabfung'))){
                $tmt_jfung=date_format(date_create($this->input->post('tmt_jabfung')), "Y-m-d");
				}else{$tmt_jfung=null;}
				if(!empty($this->input->post('tgl_skjafung'))){
                $tgl_skjafung=date_format(date_create($this->input->post('tgl_skjafung')), "Y-m-d");}else{$tgl_skjafung=null;}
				if(!empty($this->input->post('tmt_pak'))){
                $tmt_pak=date_format(date_create($this->input->post('tmt_pak')), "Y-m-d");}else{$tmt_pak=null;}
				if(!empty($this->input->post('tgl_pak'))){
                $tgl_pak=date_format(date_create($this->input->post('tgl_pak')), "Y-m-d");}else{$tgl_pak=null;}
                $arrdata = array(
                    'user_id' => $id,
                    'jabatan' => ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null,
                    'bagian_jabatan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                    'sub_bagian_jabatan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                    'tmt_jfung' => ($tmt_jfung)?$tmt_jfung:null,
                    'no_skjfung' => ($this->input->post('no_skjfung'))?$this->input->post('no_skjfung'):null,
                    'tgl_skjafung' => ($tgl_skjafung)?$tgl_skjafung:null,
                    'no_pak' => ($this->input->post('no_pak'))?$this->input->post('no_pak'):null,
                    'tmt_pak' => ($tmt_pak)?$tmt_pak:null,
                    'tgl_pak' => ($tgl_pak)?$tgl_pak:null,
                    'nilai_pak' => ($this->input->post('nilai_pak'))?$this->input->post('nilai_pak'):null,
                    'jabfungasn' => ($this->input->post('jabfungasn'))?$this->input->post('jabfungasn'):null,
                    'ahlifungasn' => ($this->input->post('ahlifungasn'))?$this->input->post('ahlifungasn'):null,
                    'ketahlijabfungasn' => ($this->input->post('ketahlijabfungasn'))?$this->input->post('ketahlijabfungasn'):null,
                    'satuan_kerja' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null,
                );

                $this->db->insert('his_jabatan_asn', $arrdata);
				$saved_id = $this->db->insert_id('his_jabatan_asnid_seq');
			}

            if ($this->db->affected_rows() == '1') {
                $arr['hasil'] = 'success';
                $arr['id'] = $saved_id;
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal Ditambah!';
            }

        }


        $this->set_response($arr, REST_Controller::HTTP_OK);

        return;

    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

function editjasn_post()
{
    $headers = $this->input->request_headers();

    if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
        $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
        $arr['hasil'] = 'error';
        $arr['message'] = 'Data Gagal Ditambah!';
        if ($decodedToken != false) {
            if(!empty($this->input->post('tmt_jabfung'))){
			$tmt_jfung=date_format(date_create($this->input->post('tmt_jabfung')), "Y-m-d");
			}else{$tmt_jfung=null;}
			if(!empty($this->input->post('tgl_skjafung'))){
			$tgl_skjafung=date_format(date_create($this->input->post('tgl_skjafung')), "Y-m-d");}else{$tgl_skjafung=null;}
			if(!empty($this->input->post('tmt_pak'))){
			$tmt_pak=date_format(date_create($this->input->post('tmt_pak')), "Y-m-d");}else{$tmt_pak=null;}
			if(!empty($this->input->post('tgl_pak'))){
			$tgl_pak=date_format(date_create($this->input->post('tgl_pak')), "Y-m-d");}else{$tgl_pak=null;}

//cari dulu diriwayat kedinasan
            if (!empty($id = $this->input->post('idasn'))) {


                $arrdata = array(
                    'jabatan' => ($this->input->post('txtjabatan'))?$this->input->post('txtjabatan'):null,
                    'bagian_jabatan' => ($this->input->post('txtbagian'))?$this->input->post('txtbagian'):null,
                    'sub_bagian_jabatan' => ($this->input->post('unitkerja'))?$this->input->post('unitkerja'):null,
                    'tmt_jfung' => ($tmt_jfung)?$tmt_jfung:null,
                    'no_skjfung' => ($this->input->post('no_skjfung'))?$this->input->post('no_skjfung'):null,
                    'tgl_skjafung' => ($tgl_skjafung)?$tgl_skjafung:null,
                    'no_pak' => ($this->input->post('no_pak'))?$this->input->post('no_pak'):null,
                    'tmt_pak' => ($tmt_pak)?$tmt_pak:null,
                    'tgl_pak' => ($tgl_pak)?$tgl_pak:null,
                    'nilai_pak' => ($this->input->post('nilai_pak'))?$this->input->post('nilai_pak'):null,
                    'satuan_kerja' => ($this->input->post('satuan_kerja'))?$this->input->post('satuan_kerja'):null,
                    'jabfungasn' => ($this->input->post('jabfungasn'))?$this->input->post('jabfungasn'):null,
                    'ahlifungasn' => ($this->input->post('ahlifungasn'))?$this->input->post('ahlifungasn'):null,
                    'ketahlijabfungasn' => ($this->input->post('ketahlijabfungasn'))?$this->input->post('ketahlijabfungasn'):null,
                    'keterangan' => ($this->input->post('keterangan'))?$this->input->post('keterangan'):null
                );
                $this->db->where('id', $id);
                $query=$this->db->update('his_jabatan_asn', $arrdata);


            }

//update user


            if ($query) {
                $arr['hasil'] = 'success';
                $arr['message'] = 'Data berhasil ditambah!';
            } else {
                $arr['hasil'] = 'error';
                $arr['message'] = 'Data Gagal update! jabatan aktif tidak dapat dirubah';
            }

        }


        $this->set_response($arr, REST_Controller::HTTP_OK);

        return;

    }

    $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


}
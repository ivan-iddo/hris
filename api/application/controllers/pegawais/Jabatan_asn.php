<?php
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

class jabatan_asn extends REST_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/

public function listjasn_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();	
			$this->db->select('his_jabatan_asn.*,dm_term.nama as s_kerja,d.grup as jabatan,e.grup as bagian_jabatan,f.grup as sub_bagian_jabatan,');
			$this->db->join('sys_grup_user as d','d.id_grup = his_jabatan_asn.jabatan','LEFT');
			$this->db->join('sys_grup_user as e','e.id_grup = his_jabatan_asn.bagian_jabatan','LEFT');
			$this->db->join('sys_grup_user as f','f.id_grup = his_jabatan_asn.sub_bagian_jabatan','LEFT');
			$this->db->join('sys_user','sys_user.id_user = his_jabatan_asn.user_id','LEFT');
			$this->db->join('dm_term','dm_term.id = his_jabatan_asn.satuan_kerja');
			$this->db->where('sys_user.status','1'); 
			$this->db->where('his_jabatan_asn.tampilkan','1'); 
			$this->db->where('his_jabatan_asn.user_id',$this->uri->segment('4')); 
			$res = $this->db->get('his_jabatan_asn')->result();
			if(!empty($res)){
				foreach($res as $d){
				if(!empty($d->tmt_jfung)){
				$tmt_jfung=date_format(date_create($d->tmt_jfung), "d-m-Y");
				}else{$tmt_jfung=$d->tmt_jfung;}
				if(!empty($d->tmt_jfung)){
				$tgl_skjafung=date_format(date_create($d->tgl_skjafung), "d-m-Y");
				}else{$tgl_skjafung=$d->tgl_skjafung;}
				if(!empty($d->tmt_jfung)){
				$tmt_pak=date_format(date_create($d->tmt_pak), "d-m-Y");
				}else{$tmt_pak=$d->tmt_pak;}
				if(!empty($d->tgl_pak)){
				$tgl_pak=date_format(date_create($d->tgl_pak), "d-m-Y");
				}else{$tgl_pak=$d->tgl_pak;}
					$arr[]=array('id'=>$d->id,
						'jabatan' => $d->jabatan,
						'bagian_jabatan' => $d->bagian_jabatan,
						'sub_bagian_jabatan' => $d->sub_bagian_jabatan,
						'tmt_jfung' => $tmt_jfung,
						'no_skjfung' => $d->no_skjfung,
						'tgl_skjafung' => $tgl_skjafung,
						'no_pak' => $d->no_pak,
						'tmt_pak' => $tmt_pak,
						'tgl_pak' => $tgl_pak,
						'nilai_pak' => $d->nilai_pak,
						'keterangan' => $d->keterangan,
						'jabfungasn' => $d->jabfungasn,
						'ahlifungasn' => $d->ahlifungasn,
						'ketahlijabfungasn' => $d->ketahlijabfungasn,
						'satuan_kerja' => $d->s_kerja,
					);
				}
			}else{
				$arr=array();
			}

			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function getjasn_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {
//$this->db->limit('100');
//$this->db->order_by();

			$this->db->select('his_jabatan_asn.*');
			$this->db->where('his_jabatan_asn.tampilkan','1');
			$this->db->where('his_jabatan_asn.id',$this->uri->segment('4')); 
			$d = $this->db->get('his_jabatan_asn')->row();
			if($d->tmt_jfung!=null){
			$tmt_jfung=date_format(date_create($d->tmt_jfung), "d-m-Y");
			}else{$tmt_jfung='';}
			if($d->tmt_jfung!=null){
			$tgl_skjafung=date_format(date_create($d->tgl_skjafung), "d-m-Y");
			}else{$tgl_skjafung='';}
			if($d->tmt_jfung!=null){
			$tmt_pak=date_format(date_create($d->tmt_pak), "d-m-Y");
			}else{$tmt_pak='';}
			if($d->tgl_pak!=null){
			$tgl_pak=date_format(date_create($d->tgl_pak), "d-m-Y");
			}else{$tgl_pak='';}
			$arr=array('id'=>$d->id,
				'jabatan' => $d->jabatan,
				'bagian_jabatan' => $d->bagian_jabatan,
				'sub_bagian_jabatan' => $d->sub_bagian_jabatan,
				'tmt_jfung' => $tmt_jfung,
				'no_skjfung' => $d->no_skjfung,
				'tgl_skjafung' => $tgl_skjafung,
				'no_pak' => $d->no_pak,
				'tmt_pak' => $tmt_pak,
				'tgl_pak' => $tgl_pak,
				'nilai_pak' => $d->nilai_pak,
				'keterangan' => $d->keterangan,
				'satuan_kerja' => $d->satuan_kerja,
				'id_satker' => $d->satuan_kerja,
				'jabfungasn' => $d->jabfungasn,
				'ahlifungasn' => $d->ahlifungasn,
				'ketahlijabfungasn' => $d->ketahlijabfungasn,
				'file' => $d->file_url
			);


			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


function deletejasn_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$this->db->where('id',$this->input->get('id'));
			//$this->db->where('aktif','0');
			$query=$this->db->update('his_jabatan_asn',array('tampilkan'=>'0'));
//$res = $this->db->get('m_jenis_cuti')->result();
			if($query){
				$arr['hasil']='success';
				$arr['message']='Data berhasil ditambah!';
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal update! jabatan aktif tidak dapat dirubah';
			}

			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}
function file_asn_get()
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
            if(!empty($this->input->get('id_asn'))){
                $this->db->where('id_asn', $this->input->get('id_asn'));
            }
            $this->db->where('tampilkan', '1');
            $resCek = $this->db->get('his_files_asn')->result();

            $da = '';
            $no = 0;
            if(!empty($this->input->get('id_asn'))){
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
                    $da .= '<a title="Lihat File" id="book1-trigger" class="btn btn-default" href="javascript:void(0)" onclick="buildBook(\'api/upload/asn/' . $val->url . '\')"><i class="fa fa-eye"></i></a>';
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
function deletelist_get()
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
            $this->db->update('his_files_asn', $arrdata);

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

}
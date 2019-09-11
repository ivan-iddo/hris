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
date_default_timezone_set('Asia/Jakarta');
class Asn extends REST_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/
var $table='m_index_jabatan_asn_detail';
var $perpage = 20;


public function listdata_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			if(!empty($this->input->get('id'))){
				$this->db->where('migrasi_jabatan_detail_id',$this->input->get('id'));
			}

			if(!empty($this->uri->segment(4))){
				$this->db->like("kd_jabatan",$this->uri->segment(4)); 
			}
			$total_rows = $this->db->count_all_results($this->table);
			$pagination = create_pagination_endless('/sub_jabatan_asn/Asn/0/', $total_rows,$this->perpage,5);

			if(!empty($this->input->get('id'))){
				$this->db->where('migrasi_jabatan_detail_id',$this->input->get('id'));
			}
			if(!empty($this->uri->segment(4))){
				$this->db->like("kd_jabatan",$this->uri->segment(4)); 
			}
			$this->db->where('tampilkan','1');
			$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
			$res = $this->db->get($this->table)->result();

			if(!empty($res)){
				foreach($res as $dat){
					$arr['result'][]= array('migrasi_jabatan_detail_id'=> $dat->migrasi_jabatan_detail_id,'kd_jabatan'=> $dat->kd_jabatan,'ds_jabatan'=> $dat->ds_jabatan,'level_job'=> $dat->level_job,'detil'=> $dat->detil,'kd_jab_induk'=> $dat->kd_jab_induk,'kd_grp_job_profesi'=> $dat->kd_grp_job_profesi,'kd_group_grade'=> $dat->kd_group_grade,'ringkasan_jabatan'=> $dat->ringkasan_jabatan,'wewenang_jabatan'=> $dat->wewenang_jabatan,'kd_pendidikan'=> $dat->kd_pendidikan,'kd_jbt_pengalaman'=> $dat->kd_jbt_pengalaman,'lama_kd_jbt_pengalaman'=> $dat->lama_kd_jbt_pengalaman,'real_value'=> $dat->real_value,'kd_profesi'=> $dat->kd_profesi,'jab_aktif'=> $dat->jab_aktif,'periode_jab'=> $dat->periode_jab,'fung_struk'=> $dat->fung_struk,'kd_lokasi'=> $dat->kd_lokasi,'tgl_update'=> $dat->tgl_update,'no_peg_update'=> $dat->no_peg_update,'staf_kpl'=> $dat->staf_kpl,'sdn_lvl'=> $dat->sdn_lvl,'kd_group_grade_n'=> $dat->kd_group_grade_n,'corp_grade'=> $dat->corp_grade,'job_value'=> $dat->job_value,'kd_job_index_1'=> $dat->kd_job_index_1,'kd_job_index_2'=> $dat->kd_job_index_2,'kd_job_index_3'=> $dat->kd_job_index_3,'kd_job_index_4'=> $dat->kd_job_index_4,'nilai_ij_1'=> $dat->nilai_ij_1,'nilai_ij_2'=> $dat->nilai_ij_2,'nilai_ij_3'=> $dat->nilai_ij_3,'nilai_ij_4'=> $dat->nilai_ij_4,);
				}
				$arr['total']=$total_rows;
				$arr['paging'] = $pagination['limit'][1];
				$arr['perpage']=$this->perpage;
			}else{
				$arr['result'] ='empty';
			}
			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


public function save_post(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			$id_user=$decodedToken->data->id;

			if(!empty($this->input->post('id_sub_jabatan_asn'))){
//edit
				$id= $this->input->post('id_sub_jabatan_asn');
				$arr=array(
					'kd_jabatan'=> ($this->input->post('kd_jabatan')?$this->input->post('kd_jabatan'):NULL),
					'ds_jabatan'=> ($this->input->post('ds_jabatan')?$this->input->post('ds_jabatan'):NULL),
					'level_job'=> ($this->input->post('level_job')?$this->input->post('level_job'):NULL),
					'detil'=> ($this->input->post('detil')?$this->input->post('detil'):NULL),
					'kd_jab_induk'=> ($this->input->post('kd_jab_induk')?$this->input->post('kd_jab_induk'):NULL),
					'kd_grp_job_profesi'=> ($this->input->post('kd_grp_job_profesi')?$this->input->post('kd_grp_job_profesi'):NULL),
					'kd_group_grade'=> ($this->input->post('kd_group_grade')?$this->input->post('kd_group_grade'):NULL),
					'ringkasan_jabatan'=> ($this->input->post('ringkasan_jabatan')?$this->input->post('ringkasan_jabatan'):NULL),
					'wewenang_jabatan'=> ($this->input->post('wewenang_jabatan')?$this->input->post('wewenang_jabatan'):NULL),
					'kd_pendidikan'=> ($this->input->post('kd_pendidikan')?$this->input->post('kd_pendidikan'):NULL),
					'kd_jbt_pengalaman'=> ($this->input->post('kd_jbt_pengalaman')?$this->input->post('kd_jbt_pengalaman'):NULL),
					'lama_kd_jbt_pengalaman'=> ($this->input->post('lama_kd_jbt_pengalaman')?$this->input->post('lama_kd_jbt_pengalaman'):NULL),
					'real_value'=> ($this->input->post('real_value')?$this->input->post('real_value'):NULL),
					'kd_profesi'=> ($this->input->post('kd_profesi')?$this->input->post('kd_profesi'):NULL),
					'jab_aktif'=> ($this->input->post('jab_aktif')?$this->input->post('jab_aktif'):NULL),
					'periode_jab'=> ($this->input->post('periode_jab')?$this->input->post('periode_jab'):NULL),
					'fung_struk'=> ($this->input->post('fung_struk')?$this->input->post('fung_struk'):NULL),
					'kd_lokasi'=> ($this->input->post('kd_lokasi')?$this->input->post('kd_lokasi'):NULL),
					'tgl_update'=> date('Y-m-d H:i:s'),
					'no_peg_update'=> $id_user,
					'staf_kpl'=> ($this->input->post('staf_kpl')?$this->input->post('staf_kpl'):NULL),
					'sdn_lvl'=> ($this->input->post('sdn_lvl')?$this->input->post('sdn_lvl'):NULL),
					'kd_group_grade_n'=> ($this->input->post('kd_group_grade_n')?$this->input->post('kd_group_grade_n'):NULL),
					'corp_grade'=> ($this->input->post('corp_grade')?$this->input->post('corp_grade'):NULL),
					'job_value'=> ($this->input->post('job_value')?$this->input->post('job_value'):NULL),
					'kd_job_index_1'=> ($this->input->post('kd_job_index_1')?$this->input->post('kd_job_index_1'):NULL),
					'kd_job_index_2'=> ($this->input->post('kd_job_index_2')?$this->input->post('kd_job_index_2'):NULL),
					'kd_job_index_3'=> ($this->input->post('kd_job_index_3')?$this->input->post('kd_job_index_3'):NULL),
					'kd_job_index_4'=> ($this->input->post('kd_job_index_4')?$this->input->post('kd_job_index_4'):NULL),
					'nilai_ij_1'=> ($this->input->post('nilai_ij_1')?$this->input->post('nilai_ij_1'):NULL),
					'nilai_ij_2'=> ($this->input->post('nilai_ij_2')?$this->input->post('nilai_ij_2'):NULL),
					'nilai_ij_3'=> ($this->input->post('nilai_ij_3')?$this->input->post('nilai_ij_3'):NULL),
'nilai_ij_4'=> ($this->input->post('nilai_ij_4')?$this->input->post('nilai_ij_4'):NULL),);;//array('nama'=>$this->input->post('nama'));
				$this->db->where('migrasi_jabatan_detail_id',$id);
				$this->db->update($this->table,$arr);
			}else{
//save
				$arr=array(
					'kd_jabatan'=> ($this->input->post('kd_jabatan')?$this->input->post('kd_jabatan'):NULL),
					'ds_jabatan'=> ($this->input->post('ds_jabatan')?$this->input->post('ds_jabatan'):NULL),
					'level_job'=> ($this->input->post('level_job')?$this->input->post('level_job'):NULL),
					'detil'=> ($this->input->post('detil')?$this->input->post('detil'):NULL),
					'kd_jab_induk'=> ($this->input->post('kd_jab_induk')?$this->input->post('kd_jab_induk'):NULL),
					'kd_grp_job_profesi'=> ($this->input->post('kd_grp_job_profesi')?$this->input->post('kd_grp_job_profesi'):NULL),
					'kd_group_grade'=> ($this->input->post('kd_group_grade')?$this->input->post('kd_group_grade'):NULL),
					'ringkasan_jabatan'=> ($this->input->post('ringkasan_jabatan')?$this->input->post('ringkasan_jabatan'):NULL),
					'wewenang_jabatan'=> ($this->input->post('wewenang_jabatan')?$this->input->post('wewenang_jabatan'):NULL),
					'kd_pendidikan'=> ($this->input->post('kd_pendidikan')?$this->input->post('kd_pendidikan'):NULL),
					'kd_jbt_pengalaman'=> ($this->input->post('kd_jbt_pengalaman')?$this->input->post('kd_jbt_pengalaman'):NULL),
					'lama_kd_jbt_pengalaman'=> ($this->input->post('lama_kd_jbt_pengalaman')?$this->input->post('lama_kd_jbt_pengalaman'):NULL),
					'real_value'=> ($this->input->post('real_value')?$this->input->post('real_value'):NULL),
					'kd_profesi'=> ($this->input->post('kd_profesi')?$this->input->post('kd_profesi'):NULL),
					'jab_aktif'=> ($this->input->post('jab_aktif')?$this->input->post('jab_aktif'):NULL),
					'periode_jab'=> ($this->input->post('periode_jab')?$this->input->post('periode_jab'):NULL),
					'fung_struk'=> ($this->input->post('fung_struk')?$this->input->post('fung_struk'):NULL),
					'kd_lokasi'=> ($this->input->post('kd_lokasi')?$this->input->post('kd_lokasi'):NULL),
					'tgl_update'=> date('Y-m-d H:i:s'),
					'no_peg_update'=> $id_user,
					'staf_kpl'=> ($this->input->post('staf_kpl')?$this->input->post('staf_kpl'):NULL),
					'sdn_lvl'=> ($this->input->post('sdn_lvl')?$this->input->post('sdn_lvl'):NULL),
					'kd_group_grade_n'=> ($this->input->post('kd_group_grade_n')?$this->input->post('kd_group_grade_n'):NULL),
					'corp_grade'=> ($this->input->post('corp_grade')?$this->input->post('corp_grade'):NULL),
					'job_value'=> ($this->input->post('job_value')?$this->input->post('job_value'):NULL),
					'kd_job_index_1'=> ($this->input->post('kd_job_index_1')?$this->input->post('kd_job_index_1'):NULL),
					'kd_job_index_2'=> ($this->input->post('kd_job_index_2')?$this->input->post('kd_job_index_2'):NULL),
					'kd_job_index_3'=> ($this->input->post('kd_job_index_3')?$this->input->post('kd_job_index_3'):NULL),
					'kd_job_index_4'=> ($this->input->post('kd_job_index_4')?$this->input->post('kd_job_index_4'):NULL),
					'nilai_ij_1'=> ($this->input->post('nilai_ij_1')?$this->input->post('nilai_ij_1'):NULL),
					'nilai_ij_2'=> ($this->input->post('nilai_ij_2')?$this->input->post('nilai_ij_2'):NULL),
					'nilai_ij_3'=> ($this->input->post('nilai_ij_3')?$this->input->post('nilai_ij_3'):NULL),
					'nilai_ij_4'=> ($this->input->post('nilai_ij_4')?$this->input->post('nilai_ij_4'):NULL),);;

				$this->db->insert($this->table,$arr);
			}



			if($this->db->affected_rows() == '1'){
				$arr['hasil']='success';
				$arr['message']='Data berhasil ditambah!';
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal Ditambah!';
			}


			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


public function delete_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			if(!empty($this->input->get('id'))){
//edit
				$id= $this->input->get('id'); 
				$this->db->where('migrasi_jabatan_detail_id',$id);
				$this->db->update($this->table,array('tampilkan'=>'0'));
			} 



			if($this->db->affected_rows() == '1'){
				$arr['hasil']='success';
				$arr['message']='Data berhasil dihapus!';
			}else{
				$arr['hasil']='error';
				$arr['message']='Data Gagal dihapus!';
			}


			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}

public function getoption_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			if(!empty($this->uri->segment('4'))){
				$this->db->where('parent',$this->uri->segment('4'));
			}
			$this->db->order_by('kd_jabatan','ASC');

			$res = $this->db->get($this->table)->result();

			if(!empty($res)){


				foreach($res as $d){
					$arr['result'][]=array('label'=>$d->ds_jabatan,'value'=>$d->migrasi_jabatan_detail_id);
				}
			}else{
				$arr['result'][]=array('label'=>'No Data','value'=>'');
			}

			$this->set_response($arr, REST_Controller::HTTP_OK);

			return;
		}
	}

	$this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
}


}
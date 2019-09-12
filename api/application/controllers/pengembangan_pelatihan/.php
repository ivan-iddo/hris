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

class  extends REST_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/
var $table='pengembangan_pelatihan';
var $perpage = 20;


public function listdata_get(){
	$headers = $this->input->request_headers();

	if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
		$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
		if ($decodedToken != false) {

			if(!empty($this->input->get('id'))){
				$this->db->where('id',$this->input->get('id'));
			}

			if(!empty($this->uri->segment(4))){
				$this->db->like("pengembangan_pelatihan_kegiatan",$this->uri->segment(4)); 
			}
			$total_rows = $this->db->count_all_results($this->table);
			$pagination = create_pagination_endless('/pengembangan_pelatihan//0/', $total_rows,$this->perpage,5);

			if(!empty($this->input->get('id'))){
				$this->db->where('id',$this->input->get('id'));
			}
			if(!empty($this->uri->segment(4))){
				$this->db->like("pengembangan_pelatihan_kegiatan",$this->uri->segment(4)); 
			}
			$this->db->where('tampilkan','1');
			$this->db->limit($pagination['limit'][0], $pagination['limit'][1]);
			$res = $this->db->get($this->table)->result();

			if(!empty($res)){
				foreach($res as $dat){
					$arr['result'][]= array('id'=> $dat->id,'pengembangan_pelatihan_kegiatan'=> $dat->pengembangan_pelatihan_kegiatan,'pengembangan_pelatihan_kegiatan_status'=> $dat->pengembangan_pelatihan_kegiatan_status,'nama_pelatihan'=> $dat->nama_pelatihan,'tujuan'=> $dat->tujuan,'institusi'=> $dat->institusi,'no_disposisi'=> $dat->no_disposisi,'jenis_perjalanan'=> $dat->jenis_perjalanan,'dalam_negeri'=> $dat->dalam_negeri,'surat_tugas_dalam_negeri'=> $dat->surat_tugas_dalam_negeri,'surat_tugas_luar_negeri'=> $dat->surat_tugas_luar_negeri,'surat_tugas_dalam_negeri_dalamkota'=> $dat->surat_tugas_dalam_negeri_dalamkota,'surat_tugas_dalam_negeri_luarkota'=> $dat->surat_tugas_dalam_negeri_luarkota,'jenis'=> $dat->jenis,'jenis_biaya'=> $dat->jenis_biaya,'laporan'=> $dat->laporan,'monev'=> $dat->monev,'total_hari_kerja'=> $dat->total_hari_kerja,'id_atasan'=> $dat->id_atasan,'id_uk'=> $dat->id_uk,'status'=> $dat->status,'statue'=> $dat->statue,'created'=> $dat->created,'createdby'=> $dat->createdby,'updated'=> $dat->updated,'updatedby'=> $dat->updatedby,);
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

			if(!empty($this->input->post('id_pengembangan_pelatihan'))){
//edit
				$id= $this->input->post('id_pengembangan_pelatihan');
				$arr=array(
					'pengembangan_pelatihan_kegiatan'=> ($this->input->post('pengembangan_pelatihan_kegiatan')?$this->input->post('pengembangan_pelatihan_kegiatan'):NULL),
					'pengembangan_pelatihan_kegiatan_status'=> ($this->input->post('pengembangan_pelatihan_kegiatan_status')?$this->input->post('pengembangan_pelatihan_kegiatan_status'):NULL),
					'nama_pelatihan'=> ($this->input->post('nama_pelatihan')?$this->input->post('nama_pelatihan'):NULL),
					'tujuan'=> ($this->input->post('tujuan')?$this->input->post('tujuan'):NULL),
					'institusi'=> ($this->input->post('institusi')?$this->input->post('institusi'):NULL),
					'no_disposisi'=> ($this->input->post('no_disposisi')?$this->input->post('no_disposisi'):NULL),
					'jenis_perjalanan'=> ($this->input->post('jenis_perjalanan')?$this->input->post('jenis_perjalanan'):NULL),
					'dalam_negeri'=> ($this->input->post('dalam_negeri')?$this->input->post('dalam_negeri'):NULL),
					'surat_tugas_dalam_negeri'=> ($this->input->post('surat_tugas_dalam_negeri')?$this->input->post('surat_tugas_dalam_negeri'):NULL),
					'surat_tugas_luar_negeri'=> ($this->input->post('surat_tugas_luar_negeri')?$this->input->post('surat_tugas_luar_negeri'):NULL),
					'surat_tugas_dalam_negeri_dalamkota'=> ($this->input->post('surat_tugas_dalam_negeri_dalamkota')?$this->input->post('surat_tugas_dalam_negeri_dalamkota'):NULL),
					'surat_tugas_dalam_negeri_luarkota'=> ($this->input->post('surat_tugas_dalam_negeri_luarkota')?$this->input->post('surat_tugas_dalam_negeri_luarkota'):NULL),
					'jenis'=> ($this->input->post('jenis')?$this->input->post('jenis'):NULL),
					'jenis_biaya'=> ($this->input->post('jenis_biaya')?$this->input->post('jenis_biaya'):NULL),
					'laporan'=> ($this->input->post('laporan')?$this->input->post('laporan'):NULL),
					'monev'=> ($this->input->post('monev')?$this->input->post('monev'):NULL),
					'total_hari_kerja'=> ($this->input->post('total_hari_kerja')?$this->input->post('total_hari_kerja'):NULL),
					'id_atasan'=> ($this->input->post('id_atasan')?$this->input->post('id_atasan'):NULL),
					'id_uk'=> ($this->input->post('id_uk')?$this->input->post('id_uk'):NULL),
					'status'=> ($this->input->post('status')?$this->input->post('status'):NULL),
					'statue'=> ($this->input->post('statue')?$this->input->post('statue'):NULL),
					'created'=> ($this->input->post('created')?$this->input->post('created'):NULL),
					'createdby'=> ($this->input->post('createdby')?$this->input->post('createdby'):NULL),
					'updated'=> ($this->input->post('updated')?$this->input->post('updated'):NULL),
'updatedby'=> ($this->input->post('updatedby')?$this->input->post('updatedby'):NULL),);;//array('nama'=>$this->input->post('nama'));
				$this->db->where('id',$id);
				$this->db->update($this->table,$arr);
			}else{
//save
				$arr=array(
					'pengembangan_pelatihan_kegiatan'=> ($this->input->post('pengembangan_pelatihan_kegiatan')?$this->input->post('pengembangan_pelatihan_kegiatan'):NULL),
					'pengembangan_pelatihan_kegiatan_status'=> ($this->input->post('pengembangan_pelatihan_kegiatan_status')?$this->input->post('pengembangan_pelatihan_kegiatan_status'):NULL),
					'nama_pelatihan'=> ($this->input->post('nama_pelatihan')?$this->input->post('nama_pelatihan'):NULL),
					'tujuan'=> ($this->input->post('tujuan')?$this->input->post('tujuan'):NULL),
					'institusi'=> ($this->input->post('institusi')?$this->input->post('institusi'):NULL),
					'no_disposisi'=> ($this->input->post('no_disposisi')?$this->input->post('no_disposisi'):NULL),
					'jenis_perjalanan'=> ($this->input->post('jenis_perjalanan')?$this->input->post('jenis_perjalanan'):NULL),
					'dalam_negeri'=> ($this->input->post('dalam_negeri')?$this->input->post('dalam_negeri'):NULL),
					'surat_tugas_dalam_negeri'=> ($this->input->post('surat_tugas_dalam_negeri')?$this->input->post('surat_tugas_dalam_negeri'):NULL),
					'surat_tugas_luar_negeri'=> ($this->input->post('surat_tugas_luar_negeri')?$this->input->post('surat_tugas_luar_negeri'):NULL),
					'surat_tugas_dalam_negeri_dalamkota'=> ($this->input->post('surat_tugas_dalam_negeri_dalamkota')?$this->input->post('surat_tugas_dalam_negeri_dalamkota'):NULL),
					'surat_tugas_dalam_negeri_luarkota'=> ($this->input->post('surat_tugas_dalam_negeri_luarkota')?$this->input->post('surat_tugas_dalam_negeri_luarkota'):NULL),
					'jenis'=> ($this->input->post('jenis')?$this->input->post('jenis'):NULL),
					'jenis_biaya'=> ($this->input->post('jenis_biaya')?$this->input->post('jenis_biaya'):NULL),
					'laporan'=> ($this->input->post('laporan')?$this->input->post('laporan'):NULL),
					'monev'=> ($this->input->post('monev')?$this->input->post('monev'):NULL),
					'total_hari_kerja'=> ($this->input->post('total_hari_kerja')?$this->input->post('total_hari_kerja'):NULL),
					'id_atasan'=> ($this->input->post('id_atasan')?$this->input->post('id_atasan'):NULL),
					'id_uk'=> ($this->input->post('id_uk')?$this->input->post('id_uk'):NULL),
					'status'=> ($this->input->post('status')?$this->input->post('status'):NULL),
					'statue'=> ($this->input->post('statue')?$this->input->post('statue'):NULL),
					'created'=> ($this->input->post('created')?$this->input->post('created'):NULL),
					'createdby'=> ($this->input->post('createdby')?$this->input->post('createdby'):NULL),
					'updated'=> ($this->input->post('updated')?$this->input->post('updated'):NULL),
					'updatedby'=> ($this->input->post('updatedby')?$this->input->post('updatedby'):NULL),);; 
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
				$this->db->where('id',$id);
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
				$this->db->where('id',$this->uri->segment('4'));
			}
			$this->db->order_by('pengembangan_pelatihan_kegiatan','ASC');

			$res = $this->db->get($this->table)->result();

			if(!empty($res)){

				foreach($res as $d){
					$arr['result'][]=array('label'=>$d->pengembangan_pelatihan_kegiatan,'value'=>$d->id);
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
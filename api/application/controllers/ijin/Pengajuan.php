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

class Pengajuan extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	 var $table='his_ijin';
	 var $perpage = 20;
 
	
	 function cekcuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$id_cuti = $this->input->get('id');
					$id_user = $this->input->get('id_user');
					$tahun = date('Y');

					if($id_cuti !=='1'){
						$arr['message'] ='<div class="alert alert-success">Anda memiliki sisa cuti <strong> 12  Hari</strong></div>';
						$arr['jumlah'] = 12;
					   
			  
						return  $this->set_response($arr, REST_Controller::HTTP_OK);	
			  
					}
					
					 $this->db->where('id',$id_cuti);
					 $this->db->where('tampilkan','1');

				   $res = $this->db->get('m_jenis_cuti')->row();
				   
				   
				   $this->db->select('sum(total) as total_cuti');
					  $this->db->where('jenis_cuti',$id_cuti);
					  $this->db->where('id_user',$id_user);
					  $this->db->where('YEAR(tgl_cuti)',$tahun);
					  $this->db->where('tampilkan','1');

				   $resCek = $this->db->get('his_cuti')->row();
					
				    $cuti_sudahDiambil = $resCek->total_cuti;
					   $total = $res->jumlah;
					   
					   if($total <= $cuti_sudahDiambil){
						   $arr['message'] ='<div class="alert alert-danger">Maaf cuti anda tahun ini <strong>sudah melampaui batas!</strong></div>';
					   }else{
						if($id_cuti=='1'){
							$cc = $total-$cuti_sudahDiambil;
							$this->db->select('sum(total) as total_cuti');
							  $this->db->where('jenis_cuti','1');
							  $this->db->where('id_user',$id_user);
							  $this->db->where('YEAR(tgl_cuti)',($tahun-1));
							  $this->db->where('tampilkan','1');
							  $resCeklalu = $this->db->get('his_cuti')->row();
							  $cutithnlalu= 12-$resCeklalu->total_cuti;
							  $jumlahcuti = $cc + $cutithnlalu;
							  
							  if(!empty($resCeklalu->total_cuti)){
								
							 
							  if($jumlahcuti > 18){
								$cc=18;
							  }else{
								$cc = $jumlahcuti;
							  }
							  }
							  
						   }
						   
						   
						$arr['message'] ='<div class="alert alert-success">Anda memiliki sisa cuti <strong>'.$cc.' Hari</strong></div>';
						$arr['jumlah'] = $cc;
					   }
			  
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function savecuti_post(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					$tgl = $this->input->post('tgl_cuti'); 
					$jml = $this->input->post('jumlahCuti');

					$date=date_create($tgl);
					date_add($date,date_interval_create_from_date_string($jml." days"));
					$sampai = date_format($date,"Y-m-d");

					//cek lagi
					$id_cuti = $this->input->post('jenis_cuti');
					$id_user = $this->input->post('id_user');
					$tahun = date('Y');
					$this->db->where('id',$id_cuti);
					$this->db->where('tampilkan','1');

				  $res = $this->db->get('m_jenis_cuti')->row();
				  
				  $this->db->select('sum(total) as total_cuti');
					 $this->db->where('jenis_cuti',$id_cuti);
					 $this->db->where('id_user',$id_user);
					 $this->db->where('YEAR(tgl_cuti)',$tahun);
					 $this->db->where('tampilkan','1');

				    $resCek = $this->db->get('his_cuti')->row();
				   
				      $cuti_sudahDiambil = $resCek->total_cuti;
					  $total = $res->jumlah;

					  $totalcuti = $cuti_sudahDiambil+$jml;
					  if($totalcuti <= $total){
					 
						$datacuti=array(
							'id_user'=> $id_user,
							'total' => $jml,
							'tgl_cuti'=> $tgl,
							'tgl_akhir_cuti' => $sampai,
							'jenis_cuti' => $id_cuti,
							'status' => '1',
							'keterangan' =>  $this->input->post('keterangan')

						);

						$this->db->insert('his_cuti',$datacuti);
						if($this->db->affected_rows() == '1'){
							$arr['hasil']='success';
							$arr['message']='Data berhasil ditambah!';
						}else{
							$arr['hasil']='error';
							$arr['message']='Data Gagal Ditambah!';
						}

					  }

			   
			 
 
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}


	

	function listcuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
				 
					$id_user = $this->input->get('id_user'); 
					$this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,m_status_proses.nama as statuspros');
					$this->db->join('m_jenis_cuti','m_jenis_cuti.id = his_cuti.jenis_cuti');
					$this->db->join('m_status_proses','m_status_proses.id = his_cuti.status');
					$this->db->where('id_user',$id_user); 
					$this->db->where('his_cuti.tampilkan','1');
					$this->db->order_by('tgl_cuti','DESC');
					$resCek = $this->db->get('his_cuti')->result();

					$da ='';
					foreach($resCek as $val){
						$text='text-success';
						if($val->status =='1'){
							$text='text-danger';
						}
					   $da .='<tr>';
					   $da .='<td>';
					   $da .= $val->namcut;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_akhir_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->total;
					   $da .='</td>';
					   $da .='<td class="'.$text.'">';
					   $da .= $val->statuspros;
					   $da .='</td>';
					   $da .='<td><a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\''.$val->id.'\')">';
					   $da .='Hapus';
					   $da .='</a></td>';
					   $da .='</tr>';
					}
				    
				   $arr['hasil']='success';
				   $arr['isi']=$da;
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

		
	}

	public function beristratuscuti_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
					 $id=$this->input->get('id');
					 $status = $this->input->get('status');
					 $this->db->where('id',$id);
					 $arraycuti['status']=$status;
					if($status=='0'){
						$arraycuti['tampilkan']='0';
						$this->db->where('status','1');
					}
					 $this->db->update('his_cuti',$arraycuti);
			  $arr['hasil']='success';
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}

	function listcutiall_get(){
		$headers = $this->input->request_headers();
	
			if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
				$decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
				if ($decodedToken != false) {
				 
					$id_user = $this->input->get('id_user'); 
					$this->db->select('m_jenis_cuti.nama as namcut,his_cuti.*,m_status_proses.nama as statuspros,sys_user.name as namapegawai');
					$this->db->join('m_jenis_cuti','m_jenis_cuti.id = his_cuti.jenis_cuti');
					$this->db->join('m_status_proses','m_status_proses.id = his_cuti.status'); 
					$this->db->join('sys_user','sys_user.id_user = his_cuti.id_user'); 
					$this->db->where('his_cuti.tampilkan','1');
					$this->db->where('his_cuti.status','1');
					$this->db->order_by('tgl_cuti','DESC');
					$resCek = $this->db->get('his_cuti')->result();

					$da ='';
					foreach($resCek as $val){
						$text='text-success';
						if($val->status =='1'){
							$text='text-danger';
						}
					   $da .='<tr>';
					   $da .='<td>';
					   $da .= $val->namapegawai;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->namcut;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->keterangan;
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= date_format(date_create($val->tgl_akhir_cuti),"d-m-Y");
					   $da .='</td>';
					   $da .='<td>';
					   $da .= $val->total;
					   $da .='</td>';
					   $da .='<td class="'.$text.'">';
					   $da .= $val->statuspros;
					   $da .='</td>';
					   $da .='<td>';
					   $da .='<a class="label label-success" href="javascript:void(0);" onClick="prosesCuti(\''.$val->id.'\',\'2\')">';
					   $da .='Setujui';
					   $da .='</a>';
					   $da .='<a class="label label-danger" href="javascript:void(0);" onClick="prosesCuti(\''.$val->id.'\',\'0\')">';
					   $da .='Tolak';
					   $da .='</a>';
					   $da .='</td>';
					   $da .='</tr>';
					}
				    
				   $arr['hasil']='success';
				   $arr['isi']=$da;
			  $this->set_response($arr, REST_Controller::HTTP_OK);
				
					return;
				}
			}
			
			 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);

		
	}
	  
}
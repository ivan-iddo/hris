<?php 
 header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
  



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

class Upload extends CI_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
	public function upload_ijazah(){
		  
		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$filename='logo.png';
		 
				if (!$this->upload->do_upload('doc_file'))
																	{
																											$error = array('error' => $this->upload->display_errors());
									
							
																	}
																	else
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename = $data['upload_data']['file_name'];
																											
																	}
					
							$datas = array(
									'file_url' => $filename
							);
							
							$id = $this->input->post('id_pendidikan');

							$this->db->where('id',$id);
							$this->db->update('his_pendidikan', $datas);
										 
					
					
						if($this->db->affected_rows() == '1'){
						$arr['file'] = $filename;
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!'; 
						 
						}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
						}
		 
		
		
					echo json_encode($arr);	
		 								
	}
	
	public function upload_pelatihan(){
		  
		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$filename='logo.png';
		 
				if (!$this->upload->do_upload('doc_file'))
																	{
																											$error = array('error' => $this->upload->display_errors());
									
							
																	}
																	else
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename = $data['upload_data']['file_name'];
																											
																	}
					
							$datas = array(
									'file_url' => $filename
							);
							
							$id = $this->input->post('id_pelatihan');

							$this->db->where('id',$id);
							$this->db->update('his_pelatihan', $datas);
										 
					
					
						if($this->db->affected_rows() == '1'){
						$arr['file'] = $filename;
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!'; 
						 
						}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
						}
		 
		
		
					echo json_encode($arr);	
		 								
	}

	public function upload_golongan(){
		  
		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$filename='logo.png';
		 
				if (!$this->upload->do_upload('doc_file'))
																	{
																											$error = array('error' => $this->upload->display_errors());
									
							
																	}
																	else
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename = $data['upload_data']['file_name'];
																											
																	}
					
							$datas = array(
									'file_url' => $filename
							);
							
							$id = $this->input->post('id_golongan');

							$this->db->where('id',$id);
							$this->db->update('his_golongan', $datas);
										 
					
					
						if($this->db->affected_rows() == '1'){
						$arr['file'] = $filename;
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!'; 
						 
						}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
						}
		 
		
		
					echo json_encode($arr);	
		 								
	}
	
}
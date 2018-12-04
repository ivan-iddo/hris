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

class Supplier extends CI_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
  public function upload_logo(){
			
			$config['upload_path'] = 'upload/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '50000000'; 
			$this->load->library('upload', $config);
			$filename='';
			$filename1 = '';
			$filename2 = '';
			
										if ($this->upload->do_upload('cover_file'))
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename = $data['upload_data']['file_name'];
																											   //$error = array('error' => $this->upload->display_errors());
																													 //$arr['hasil']='error';
																														//$arr['message']='Data Gagal Ditambah!';
							
																	}
																	
			
															if ($this->upload->do_upload('cover_file1'))
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename1 = $data['upload_data']['file_name'];
																											   //$error = array('error' => $this->upload->display_errors());
																													 //$arr['hasil']='error';
																														//$arr['message']='Data Gagal Ditambah!';
							
																	}
																	
																	if ($this->upload->do_upload('cover_file2'))
																	{
																		
																											$data = array('upload_data' => $this->upload->data());
																											$filename2 = $data['upload_data']['file_name'];
																											// $error = array('error' => $this->upload->display_errors());
																													//$arr['hasil']='error';
																													//	$arr['message']='Data Gagal Ditambah!';
							
																	}
																	
																	
			$hasiltheme = $this->db->get('themes')->row();
			$title = $_POST['judul'];
				$desc = $_POST['deskripsi'];
				if(!empty($filename)){
					$datas['logo']=$filename;
				}
				
				if(!empty($filename1)){
					$datas['slider1']=$filename1;
				}
				
				if(!empty($filename2)){
					$datas['slider2']=$filename2;
				}
			
			if(empty($hasiltheme)){
				
				
			
																											$datas['title'] =  $title;
							$datas['description'] =  $desc;
																											
																											$this->db->insert('themes', $datas);
																																		$insert_id = $this->db->insert_id();
																													
																													
																														if($this->db->affected_rows() == '1'){
																														$arr['hasil']='success';
																														$arr['message']='Data berhasil ditambah!';
																														$arr['id']=$insert_id;
																														}else{
																														$arr['hasil']='error';
																														$arr['message']='Data Gagal Ditambah!';
																														}
			}else{
				
				  $id=$hasiltheme->id;
						
							$datas['title'] =  $title;
							$datas['description'] =  $desc;
																																										 
							 
							$this->db->where('id',$id);
																											
																											$this->db->update('themes', $datas);
																																	//	$insert_id = $this->db->insert_id();
																													
																													
																														if($this->db->affected_rows() == '1'){
																														$arr['hasil']='success';
																														$arr['message']='Data berhasil ditambah!';
																														//$arr['id']=$insert_id;
																														}else{
																														$arr['hasil']='error';
																														$arr['message']='Data Gagal Ditambah!';
																														}
						
						
			}
																											
																														
			echo json_encode($arr);	
		}
		
	public function save_entry(){
		//$headers = $this->input->request_headers();
		 
		
		        $nodoc = $this->input->post('nodoc');
				$titledoc = $this->input->post('titledoc');
				$created_date = $this->input->post('created_date');
				$jra_date = $this->input->post('jra_date');
				$cover = $this->input->post('cover-fl');
				$media_type = $this->input->post('f_media_type');
				$kategori_dokumen = $this->input->post('f_kategori_dokumen');
				$format_dok = $this->input->post('f_format_dok');
				$status_dok = $this->input->post('f_status_dok');
				$select_uk = $this->input->post('select_uk');
				$area_akses = $this->input->post('f_area_akses');
				$deskripsi = $this->input->post('deskripsi');
				$kunci = $this->input->post('kunci');
				$lokasiarsip = $this->input->post('lokasiarsip');
				$id_dok_master = $this->input->post('id_master');
				$id_dok_tipe = $this->input->post('id_tipe');
				$user_group = $this->input->post('user_group');
				$lat = $this->input->post('lati');
				$lng = $this->input->post('longi');
				
				if(empty(trim($created_date))){
					$created_date = date('Y-m-d');
				}
				if(empty(trim($jra_date))){
					$jra_date = date('Y-m-d');
				}
				 
				 
				
		$config['upload_path'] = 'upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$filename='logo.png';
		 
				if (!$this->upload->do_upload('cover_file'))
																	{
																											$error = array('error' => $this->upload->display_errors());
									
							
																	}
																	else
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename = $data['upload_data']['file_name'];
																											
																	}
					
							$datas = array('no_dok' =>$nodoc,
																									'judul' =>$titledoc ,
																									'tanggal_pembuatan' =>$created_date.' '.date('H:i:s'),
																									'JRA' =>$jra_date.' '.date('H:i:s'),
																									'cover_photo' =>$filename ,
																									'tipe_media' =>$media_type ,
																									'kategori_dokumen' =>$kategori_dokumen ,
																									'format' =>$format_dok ,
																									'status' =>$status_dok,
																									'id_uk' =>$select_uk ,
																									'id_area_akses' =>$area_akses ,
																									'deskripsi' =>$deskripsi,
																									'keyword' =>$kunci,
																									'id_lokasi' => $lokasiarsip,
																									'id_dok_master' => $id_dok_master,
																									'id_dok_tipe' => $id_dok_tipe,
																									'user_group' => $user_group,
																									'author' =>$this->input->post('user_id'),
																									'lat'=>$lat,
																									'lng'=>$lng
								);
								
							$this->db->insert('dokumen_entry', $datas);
										$insert_id = $this->db->insert_id();
					
					
						if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
						$arr['id']=$insert_id;
						}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
						}
		 
		
		
					echo json_encode($arr);	
		 								
	}
	
	
	public function upload_data(){
		 
				 
				 
				
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
					
							$datas = array('entry_id' =>$this->input->post('id_data'), 
																									'tanggal' =>date('Y-m-d H:i:s'),
																									'tampilkan' =>'1',
																									'nama' =>$filename,
																									'author' =>$this->input->post('user_id') ,
																									'url'=> 	$config['upload_path'].'/'.$filename
								);
								
							$this->db->insert('dokumen_entry_file', $datas);
										$insert_id = $this->db->insert_id();
					
					
						if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!';
						
						$this->db->join('sys_user','sys_user.id_user = dokumen_entry_file.author');
						$this->db->where('entry_id',$this->input->post('id_data'));
						$this->db->where('dokumen_entry_file.tampilkan','1');
						$res = $this->db->get('dokumen_entry_file')->result();
						foreach($res as $dres){
							$arr['list'][]=array('author'=>$dres->name,'id'=>$dres->id,'nama'=>$dres->nama,'tanggal'=>$dres->tanggal);
						}
						
						}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
						}
		 
		
		
					echo json_encode($arr);	
		 								
	}
	
	public function edit_entry(){
		//$headers = $this->input->request_headers();
		 
		
		  $nodoc = $this->input->post('nodoc');
				$titledoc = $this->input->post('titledoc');
				$created_date = $this->input->post('created_date');
				$jra_date = $this->input->post('jra_date');
				$cover = $this->input->post('cover-fl');
				$media_type = $this->input->post('f_media_type');
				$kategori_dokumen = $this->input->post('f_kategori_dokumen');
				$format_dok = $this->input->post('f_format_dok');
				$status_dok = $this->input->post('f_status_dok');
				$select_uk = $this->input->post('select_uk');
				$area_akses = $this->input->post('f_area_akses');
				$deskripsi = $this->input->post('deskripsi');
				$kunci = $this->input->post('kunci');
				$lokasiarsip = $this->input->post('lokasiarsip');
				$id_dok_master = $this->input->post('id_master');
				$id_dok_tipe = $this->input->post('id_tipe');
				$user_group = $this->input->post('user_group');
					$lat = $this->input->post('lati');
				$lng = $this->input->post('longi');
				
				if(empty(trim($created_date))){
					$created_date = date('Y-m-d');
				}
				if(empty(trim($jra_date))){
					$jra_date = date('Y-m-d');
				}
				 
				 
				
		$config['upload_path'] = 'upload/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['file_name'] = $_FILES['cover_file']['name'];
		
		$this->load->library('upload', $config);
		
		
		  $this->db->where('id',$this->input->post('id_data'));
				$datanya = $this->db->get('dokumen_entry')->row(); 
		 $filename=$datanya->cover_photo;
		
		
						if (!$this->upload->do_upload('cover_file'))
                {
                          $error = array('error' => $this->upload->display_errors());
						  
						
                }
                else
                {
                          $data = array('upload_data' => $this->upload->data());
																										$filename = $data['upload_data']['file_name'];
                }
		 
				
						$datas = array('no_dok' =>$nodoc,
                        'judul' =>$titledoc ,
                        'tanggal_pembuatan' =>$created_date.' '.date('H:i:s'),
                        'JRA' =>$jra_date.' '.date('H:i:s'),
                        'cover_photo' =>$filename ,
                        'tipe_media' =>$media_type ,
                        'kategori_dokumen' =>$kategori_dokumen ,
                        'format' =>$format_dok ,
                        'status' =>$status_dok,
                        'id_uk' =>$select_uk ,
                        'id_area_akses' =>$area_akses ,
                        'deskripsi' =>$deskripsi,
                        'keyword' =>$kunci,
																								'id_lokasi' => $lokasiarsip,
																								'id_dok_master' => $id_dok_master,
																								'id_dok_tipe' => $id_dok_tipe,
																								'user_group' => $user_group,
																								'author' =>$this->input->post('user_id'),
																								'lat'=>$lat,
																									'lng'=>$lng
					  );
						 
							$this->db->where('id',$this->input->post('id_data'));
						 $this->db->update('dokumen_entry', $datas);
       //  $insert_id = $this->db->insert_id();
				
				
				 if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!';
					$arr['id']=$this->input->post('id_data');
				 }else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
				 }
					echo json_encode($arr);	
		 								
	}
	
	public function get_theme(){
		
		$res = $this->db->get('themes')->row();
		$arr['title']=$res->title;
		$arr['description']=$res->description;
		$arr['logo']=$res->logo;
		$arr['slider1']=$res->slider1;
		$arr['slider2']=$res->slider2; 
			echo json_encode($arr);	
	}
	
	 public function uploadcover_data(){
		 
				 
				 
				
		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$filename='logo.png';
		 
				if (!$this->upload->do_upload('cover_file'))
																	{
																											$error = array('error' => $this->upload->display_errors());
									
							
																	}
																	else
																	{
																											$data = array('upload_data' => $this->upload->data());
																											$filename = $data['upload_data']['file_name'];
																											
																	}
					
							$datas = array(
																									'foto' =>$filename 
								);
								
							$this->db->where('id_user',$this->input->post('f_id_edit'));
							$this->db->update('sys_user', $datas);
										$insert_id = $this->db->insert_id();
					
					
						if($this->db->affected_rows() == '1'){
						$arr['hasil']='success';
						$arr['message']='Data berhasil ditambah!'; 
						}else{
						$arr['hasil']='error';
						$arr['message']='Data Gagal Ditambah!';
						}
		 
		
		
					echo json_encode($arr);	
		 								
	}

	function uploadform1(){
	 
		$this->load->library('Excel');
		
 

		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$name = $_FILES['fileform1']['tmp_name'];
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	
 
		if (!$this->upload->do_upload('fileform1')){
			$error = array('error' => $this->upload->display_errors());
			$arr['hasil']='error';
			$arr['message']='Data Gagal Ditambah!';
		}else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];

			$objReader->setReadDataOnly(true); 		  
			//Load excel file
			 $objPHPExcel=$objReader->load(FCPATH.'upload/data/'.$filename);		 
			 $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			 $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			  //loop from first data untill last data
 


			  for($i=2;$i<=$totalrows;$i++)
			  {
				  $uk= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				  $kategori= $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				  $slta = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
				  $d3 = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
				  $s1 = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
				  $s2 = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue();

				  $data = array(
					'id_uk' => $uk,
					'kategori_sdm'=>$kategori,
					'slta'=> $slta,
					'd3'=>$d3,
					's1'=>$s1,
					's2'=>$s2,
					'tahun'=>$this->input->post('thn'),
					'author'=> $this->input->post('author'),
					'date_created' => date('Y-m-d H:i:s')

				  );
				  $this->db->insert('abk_kebutuhan_sdm',$data);
				  
				  if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!'; 
					}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
					}

			  }
			  echo json_encode($arr);	
			  unlink(FCPATH.'upload/data/'.$filename);

		}
		  
	}

	function uploadform3(){
	 
		$this->load->library('Excel');
		
 

		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$name = $_FILES['fileform3']['tmp_name'];
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	
 
		if (!$this->upload->do_upload('fileform3')){
			$error = array('error' => $this->upload->display_errors());
			$arr['hasil']='error';
			$arr['message']='Data Gagal Ditambah!';
		}else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];

			$objReader->setReadDataOnly(true); 		  
			//Load excel file
			 $objPHPExcel=$objReader->load(FCPATH.'upload/data/'.$filename);		 
			 $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			 $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			  //loop from first data untill last data
 


			  for($i=2;$i<=$totalrows;$i++)
			  {
				  $uk= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				  $kegiatan_pokok= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				  $uraian_tugas = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				  $produk_dihasilkan = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
				  $jumlah = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
				  $s2 = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue();

				  $data = array(
					'id_uk' => $uk,
					'kegiatan_pokok'=>$kegiatan_pokok,
					'uraian_tugas'=> $uraian_tugas,
					'produk_dihasilkan'=>$produk_dihasilkan,
					'jumlah'=>$jumlah, 
					'tahun'=>$this->input->post('thnfrm3add'),
					'author'=> $this->input->post('author') 

				  );
				  $this->db->insert('abk_beban_kerja',$data);
				  
				  if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!'; 
					}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
					}

			  }
			  echo json_encode($arr);	
			  unlink(FCPATH.'upload/data/'.$filename);

		}
		  
	}

	function uploadform5(){
	 
		$this->load->library('Excel');
		
 

		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$name = $_FILES['fileform3']['tmp_name'];
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	
 
		if (!$this->upload->do_upload('fileform3')){
			$error = array('error' => $this->upload->display_errors());
			$arr['hasil']='error';
			$arr['message']='Data Gagal Ditambah!';
		}else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];

			$objReader->setReadDataOnly(true); 		  
			//Load excel file
			 $objPHPExcel=$objReader->load(FCPATH.'upload/data/'.$filename);		 
			 $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			 $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			  //loop from first data untill last data
 


			  for($i=2;$i<=$totalrows;$i++)
			  {
				  $id_faktor= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				  $id_shift= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				  $id_uk = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				  $tahun = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
				  $kegiatan = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
				  $frekuensi = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
				  $waktu = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue();

				  $data = array(
					'id_faktor' => $id_faktor,
					'id_shift'=>$id_shift,
					'id_uk'=> $id_uk,
					'tahun'=>$tahun,
					'kegiatan'=>$kegiatan, 
					'frekuensi'=>$kegiatan,
					'waktu' => $waktu,
					'author'=> $this->input->post('author') 

				  );
				  $this->db->insert('abk_faktor_kelonggaran',$data);
				  
				  if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!'; 
					}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
					}

			  }
			  echo json_encode($arr);	
			  unlink(FCPATH.'upload/data/'.$filename);

		}
		  
	}


	function uploadform4(){
	 
		$this->load->library('Excel');
		
 

		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$name = $_FILES['fileform3']['tmp_name'];
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	
 
		if (!$this->upload->do_upload('fileform3')){
			$error = array('error' => $this->upload->display_errors());
			$arr['hasil']='error';
			$arr['message']='Data Gagal Ditambah!';
		}else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];

			$objReader->setReadDataOnly(true); 		  
			//Load excel file
			 $objPHPExcel=$objReader->load(FCPATH.'upload/data/'.$filename);		 
			 $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			 $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			  //loop from first data untill last data
 


			  for($i=2;$i<=$totalrows;$i++)
			  {
				  $id_beban_kerja= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				  $langkah= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				  $frekuensi = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				  $waktu = $objWorksheet->getCellByColumnAndRow(3,$i)->getValue();
				  $kaur = $objWorksheet->getCellByColumnAndRow(4,$i)->getValue();
				  $staff_admin = $objWorksheet->getCellByColumnAndRow(5,$i)->getValue();
				  $pekarya = $objWorksheet->getCellByColumnAndRow(6,$i)->getValue();

				  $data = array( 
					'id_beban_kerja'=>$id_beban_kerja,
					'langkah'=> $langkah,
					'frekuensi'=>$frekuensi,
					'waktu'=>$waktu, 
					'kaur'=>$kaur,
					'staff_admin'=> $staff_admin, 
					'pekarya' =>  $pekarya

				  );
				  $this->db->insert('abk_langkah_kerja',$data);
				  
				  if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!'; 
					}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
					}

			  }
			  echo json_encode($arr);	
			  unlink(FCPATH.'upload/data/'.$filename);

		}
		  
	}

	function uploadform2(){
	 
		$this->load->library('Excel');
		
 

		$config['upload_path'] = 'upload/data';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|xls|doc|xlsx';
		$config['max_size'] = '50000000'; 
		$this->load->library('upload', $config);
		$name = $_FILES['fileform2']['tmp_name'];
		$objReader= PHPExcel_IOFactory::createReader('Excel2007');	
 
		if (!$this->upload->do_upload('fileform2')){
			$error = array('error' => $this->upload->display_errors());
			$arr['hasil']='error';
			$arr['message']='Data Gagal Ditambah!';
		}else{
			$data = array('upload_data' => $this->upload->data());
			$filename = $data['upload_data']['file_name'];

			$objReader->setReadDataOnly(true); 		  
			//Load excel file
			 $objPHPExcel=$objReader->load(FCPATH.'upload/data/'.$filename);		 
			 $totalrows=$objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel      	 
			 $objWorksheet=$objPHPExcel->setActiveSheetIndex(0);                
			  //loop from first data untill last data
			$this->db->where('tahun',$this->input->post('thnfrm2add'));
			$this->db->where('id_shift',$this->input->post('shiftpeg2'));
			$this->db->delete('abk_shift_pegawai');


			  for($i=2;$i<=$totalrows;$i++)
			  {
				  $faktor= $objWorksheet->getCellByColumnAndRow(0,$i)->getValue();
				  $waktukerja= $objWorksheet->getCellByColumnAndRow(1,$i)->getValue();
				  $keterangan = $objWorksheet->getCellByColumnAndRow(2,$i)->getValue();
				   

				  $data =array(  
				'faktor'=>$faktor,
				'waktu_kerja' =>$waktukerja,
				'keterangan' => $keterangan,
				'tahun' =>$this->input->post('thnfrm2add'),
				'id_shift' =>$this->input->post('shiftpeg2'),

			);
			
			 
				  $this->db->insert('abk_shift_pegawai',$data);
				  
				  if($this->db->affected_rows() == '1'){
					$arr['hasil']='success';
					$arr['message']='Data berhasil ditambah!'; 
					}else{
					$arr['hasil']='error';
					$arr['message']='Data Gagal Ditambah!';
					}

			  }
			  echo json_encode($arr);	
			  unlink(FCPATH.'upload/data/'.$filename);

		}
		  
	}
	
	
	function table($id){
		$fields = $this->db->field_data($id);
		echo 'array(';
		foreach ($fields as $field)
		{
		   echo "'".$field->name."'=> ,"; 
		}
		
		echo ')';
	}

	
	 
	 
}
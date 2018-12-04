<?php  
  



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

class migrasi extends CI_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
  
 function data(){
		//	$this->db->where('id_grup >','40');
		// $res = $this->db->get('sys_grup_user')->result();
			foreach($res as $s){ 
				//$this->db->where('bag_code',$s->kode);
			//	$this->db->update('tblunitkerja_migrasi',array('kode'=>$s->id_grup));
			}
			
		}
		 
	
	
	function detail_atribut(){
		$this->db->where('tampilkan','1');
		$res = $this->db->get('dokumen_entry')->result();
		foreach($res as $val=>$dat){
			
			$this->db->where('dm_area_identity_id',$dat->id);
			$res2 = $this->db->get('dm_area_identity_tambahan_data')->result();
			if(!empty($res2)){
				
				foreach($res2 as $val2 => $dat2){
			 
					$DATA['nama'] = $dat2->nama;
						 
					if($dat2->type == 'jembatan'){
					//	$DATA['nama']
					}
				
					
				}
				//simpan
				$DATA['entry_id'] = $dat->id;
				$this->db->insert('dokumen_entry_atribut_jalan',$DATA);
				
			}
			
		}
		
	}

	function group(){
		  exit;
			$this->db->select('kd_dep_induk');
			$this->db->where('kd_dep_induk <>','null');
			//$this->db->where('	aktif','Y');
			$this->db->group_by('kd_dep_induk');
			$res2 = $this->db->get('migrasi_a')->result();
			foreach($res2 as $val2 => $dat2){
			  echo '<br>'.$dat2->kd_dep_induk;
			 $this->db->where('kd_dep',$dat2->kd_dep_induk);
			 $res2e = $this->db->get('migrasi_a')->row();
			 if(!empty($res2e->migrasi_a_id)){
				echo '<br>'.$dat2->kd_dep_induk.'=>'.$res2e->migrasi_a_id;

				$this->db->where('kd_dep_induk',$dat2->kd_dep_induk);
				$this->db->update('migrasi_a',array('child'=>$res2e->migrasi_a_id));
			 }
			
			}
			 
	}

	function insertgroup(){
		exit;
			// $this->db->where('kd_dep_induk <>','null');
			 $res2 = $this->db->get('migrasi_a')->result();

			 foreach($res2 as $val2 => $dat2){
				$aktif=$dat2->aktif;
				$id=$dat2->migrasi_a_id;
				$grup = $dat2->ds_dep;
				$tampilkan = '0';
				if($aktif=='Y'){$tampilkan='1';}
				$array=array('id_grup'=>$id,
				'id_aplikasi'=>'1',
				'grup'=>$grup,
				'tampilkan'=>$tampilkan,
				'kode'=>$dat2->kd_dep,
				'child'=> $dat2->child

			);
 
			$this->db->insert('sys_grup_user',$array);
				
			 }

			
	}

	function migrasi_master_pegawai(){
	//	exit;
	 	$this->db->where('no_peg <','100');
		$res2 = $this->db->get('migrasi_master_pegawai')->result();
		foreach($res2 as $val2 => $dat2){
			 $id =  $dat2->kd_dep_sto;
			$id_user =  $dat2->no_peg;
			//$this->db->where('kode',$id);
			//$res2e = $this->db->get('sys_grup_user')->row();
			//echo '<br>'.$id_user.'=>'.$id.'=>'.$res2e->id_grup;
			if(!empty($res2e->id_grup)){
			 	
			   //echo '<br>'.$dat2->kd_dep_induk.'=>'.$res2e->migrasi_a_id;

			  // $this->db->where('no_peg',$id_user);
			  // $this->db->update('migrasi_master_pegawai',array('id_uk'=>$res2e->id_grup));
			}

		}

	}

	function insert_peg(){

			$this->load->model('System_auth_model','m');


			/*	$this->db->where('id_user >','1');
		  $this->db->delete('sys_user');
		  
		  $this->db->where('id_user >','1');
		  $this->db->delete('sys_user_profile');
		  
		  $this->db->where('id_user >','1');
	  	$this->db->delete('riwayat_kedinasan');
	 
				exit;
	*/

	exit;
			 $this->db->where('no_peg >=','2300');
			 $this->db->where('no_peg <=','2599');

			$res2 = $this->db->get('migrasi_master_pegawai')->result();
			foreach($res2 as $val2 => $dat2){ 
				 $id_user =  $dat2->no_peg;
				 $shift = '50';
				 if($dat2->shift=='N'){
					$shift = '51';
				 }
				 
				if(!empty($dat2->no_peg)){
					$postarr = array('id_user'=> $id_user,
								'username'=> $dat2->nama_peg,
								'password'=> '0', 
								'name'=> $dat2->nama_peg,
								'email'=> $this->input->post('email'),
								'id_aplikasi'=> '1',
								'kode_klinik'=> 'JKT01',
								'id_grup'=> $dat2->id_grup ,
								'kd_keluar'=> $dat2->kd_keluar,
								'id_shift' => $shift 
				);
				
					 $this->db->insert('sys_user',$postarr);
				  
				//masukin ke profile
				$kelamin=2;
					if( $dat2->kd_sex =='L'){
						$kelamin=1;
					}

					
					$postarr2= array( 
						'id_user'=> $id_user,
						'NIP'=> $dat2->nip,
						'NIK'=> $this->input->post('NIK'),
						'gelar_depan'=>$dat2->glrdpn,
						'gelar_belakang'=> $dat2->glrblk, 
						'tempat_lahir'=> $dat2->tmplhr,
						'kelamin'=>$kelamin ,
						'agama'=>$dat2->kd_agama,
						'pendidikan_akhir'=> $dat2->kd_pendidikan,
						'NPWP'=> $dat2->npwp,
						'alamat_tinggal' => $dat2->alamat,
						'alamat_ktp' => $dat2->alamat,
					
				  );
				  $this->db->insert('sys_user_profile',$postarr2);

				  //riwayat kedinasan
				  echo '<br>'.$id_user;
				  $direktorat=$this->m->getparent($id_user,'27'); 
				  $postarr3= array( 
						'id_user'=>  $id_user,
						'direktorat' => $direktorat
				);
				$this->db->insert('riwayat_kedinasan',$postarr3);

				// golongan PNS
				/*UPDATE employees
        LEFT JOIN
    merits ON employees.performance = merits.performance 
SET 
    salary = salary + salary * 0.015*/
				
				$postarr3= array( 
					'id_user'=>  $id_user,
					'golongan_id' => $dat2->golongan
			);
			$this->db->insert('his_golongan',$postarr3);

				}
	
			}
	
		}

	function migrasi_jabatan(){
	 
		$this->db->select('kd_job_index_1');  
		$this->db->group_by('kd_job_index_1');
		$res2 = $this->db->get('m_index_jabatan_asn_detail')->result();
		foreach($res2 as $val2 => $dat2){ 
			 
		 $this->db->where('kd_job_index',$dat2->kd_job_index_1);
		 $res2e = $this->db->get('m_index_jabatan_asn')->row();
	 
		 if(!empty($res2e->migrasi_index_jabatan_id)){
			echo '<br>'.$dat2->kd_job_index_1.'=>'.$res2e->migrasi_index_jabatan_id;

			$this->db->where('kd_job_index_1',$dat2->kd_job_index_1);
			$this->db->update('m_index_jabatan_asn_detail',array('parent'=>$res2e->migrasi_index_jabatan_id));
		 }
		
		}
	}

	
	
	 
	 
}
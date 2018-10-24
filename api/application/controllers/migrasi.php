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
	
	
	 
	 
}
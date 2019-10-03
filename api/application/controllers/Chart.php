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

class Chart extends CI_Controller
{
/**
* URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
* Method: GET
*/

function contoh1(){
	$arr[0]['category'] = array(2010,2011,2012,2013,2014);
	$arr[1]['color'] = '#FF0000';
	$arr[1]['data'] = array(70,75,65,90,85);
	$arr[1]['name'] ="Pass % of Boys";
	$arr[2]['color'] = '#008000';
	$arr[2]['data'] = array(80,80,90,85,90);
	$arr[2]['name'] ="Pass % of Girl";

	$r = json_encode($arr);
	print_r(json_decode($r, true)) ;
//echo json_encode($arr);


}


function chart_gender(){
	$this->db->select('count(*) as jml,b.grup,m_kelamin.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('sys_grup_user as b','b.id_grup = a.direktorat','LEFT');
	$this->db->where('b.child','1');
	$this->db->where('b.tampilkan','1');
	$this->db->join('m_kelamin','m_kelamin.id = sys_user_profile.kelamin','LEFT');
	$this->db->group_by('b.grup,m_kelamin.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}


		$warna='#2ecc71';
		if($numero=='1'){
			$warna='#2980b9';
		}


		$arr[$numero]['color']= $warna; 
		$arr[$numero]['name'] ="Pegawai ".$dat3;
		$arr[$numero]['data'] = $arrz[$dat3];



		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_pns(){
	$this->db->select('count(*) as jml,b.grup,m_status_pegawai.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('sys_grup_user as b','b.id_grup = a.direktorat','LEFT');
	$this->db->where('b.child','1');
	$this->db->where('b.tampilkan','1');
	$this->db->join('m_status_pegawai','m_status_pegawai.id = a.status_pegawai','LEFT');
	$this->db->where('m_status_pegawai.flagpns','1');
	$this->db->group_by('b.grup,m_status_pegawai.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}


		


		//$arr[$numero]['color']= $warna; 
		$arr[$numero]['name'] ="Pegawai ".$dat3;
		$arr[$numero]['data'] = $arrz[$dat3];



		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}
function chart_status(){
	$this->db->select('count(*) as jml,b.nama as grup,m_status_pegawai.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('m_status_pegawai as b','b.id = a.status_pegawai_tetap','LEFT');
	$this->db->join('m_status_pegawai','m_status_pegawai.id = a.status_pegawai','LEFT');
	$this->db->group_by('b.nama,m_status_pegawai.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}


		


		//$arr[$numero]['color']= $warna; 
		$arr[$numero]['name'] ="Pegawai ".$dat3;
		$arr[$numero]['data'] = $arrz[$dat3];



		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_profesi(){
	$this->db->select('count(*) as jml,b.ds_group_jabatan as grup,m_status_pegawai.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('m_kode_profesi_group as b','b.id = sys_user_profile.kategori_profesi','LEFT');
	$this->db->join('m_status_pegawai','m_status_pegawai.id = a.status_pegawai','LEFT');
	$this->db->group_by('b.ds_group_jabatan,m_status_pegawai.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}




		//$arr[$numero]['color']= $warna; 
		$arr[$numero]['name'] ="Pegawai ".$dat3;
		$arr[$numero]['data'] = $arrz[$dat3];



		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_tetap(){
	$this->db->select('count(*) as jml,b.grup,m_status_pegawai.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('sys_grup_user as b','b.id_grup = a.direktorat','LEFT');
	$this->db->where('b.child','1');
	$this->db->where('b.tampilkan','1');
	$this->db->join('m_status_pegawai','m_status_pegawai.id = a.status_pegawai_tetap','LEFT');
	$this->db->where('m_status_pegawai.flagpns','0');
	$this->db->group_by('b.grup,m_status_pegawai.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}



		//$arr[$numero]['color']= $warna; 
		$arr[$numero]['name'] ="Pegawai ".$dat3;
		$arr[$numero]['data'] = $arrz[$dat3];



		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_tetapall(){
	$this->db->select('count(*) as jml,m_status_pegawai.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('m_status_pegawai','m_status_pegawai.id = a.status_pegawai_tetap','LEFT');
	$this->db->where('m_status_pegawai.flagpns','0');
	$this->db->group_by('m_status_pegawai.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data2[$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 
	
	$numero =1; 
	foreach($datanama as $dat3){
		if(!empty($data2[$dat3])){
				$arrz[$dat3][0] = (int)$data2[$dat3];
			}else{
				$arrz[$dat3][0] = 0;
			}

		$arr[(int)$numero]['data'] = $arrz[$dat3]; 
		$arr[(int)$numero]['name'] = "Pegawai ".$dat3;
		++$numero;
	}
	$arr[0]['category'][0] = 'Seluruh Pegawai';
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_pnsall(){
	$this->db->select('count(*) as jml,m_status_pegawai.nama');

	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('m_status_pegawai','m_status_pegawai.id = a.status_pegawai','LEFT');
	$this->db->where('m_status_pegawai.flagpns','1');
	$this->db->group_by('m_status_pegawai.nama');
	$res = $this->db->get('sys_user_profile')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data2[$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 
	
	$numero =1; 
	foreach($datanama as $dat3){
		if(!empty($data2[$dat3])){
				$arrz[$dat3][0] = (int)$data2[$dat3];
			}else{
				$arrz[$dat3][0] = 0;
			}

		$arr[(int)$numero]['data'] = $arrz[$dat3]; 
		$arr[(int)$numero]['name'] = "Pegawai ".$dat3;
		++$numero;
	}
	$arr[0]['category'][0] = 'Seluruh Pegawai';
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_shift(){
	$this->db->select('count(*) as jml,b.grup,dm_term.nama');
	$this->db->join('sys_user_profile','sys_user.id_user = sys_user_profile.id_user','LEFT');
	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('sys_grup_user as b','b.id_grup = a.direktorat','LEFT');
	$this->db->where('b.child','1');
	$this->db->where('b.tampilkan','1');


	$this->db->join('dm_term','dm_term.id = sys_user.id_shift','LEFT');
	$this->db->where('sys_user.id_shift is not null', NULL, FALSE);
	$this->db->group_by('b.grup,dm_term.nama');

	$res = $this->db->get('sys_user')->result();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1;
	$warna[1] = '#FF0000';
	$warna[2] = '#2980b9';
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}

//$arr[$numero]['color'] = $warna[$numero];  
		$arr[$numero]['name'] ="Pegawai ".$dat3;
		$arr[$numero]['data'] = $arrz[$dat3];



		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr);


	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_keluar(){
	$this->db->select('count(*) as jml,b.grup,m_kode_keluar.ds_keluar as nama');
	$this->db->join('sys_user_profile','sys_user.id_user = sys_user_profile.id_user','LEFT');
	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('sys_grup_user as b','b.id_grup = a.direktorat','LEFT');
	$this->db->where('b.child','1');
	$this->db->where('b.tampilkan','1');


	$this->db->join('m_kode_keluar','m_kode_keluar.kd_keluar = sys_user.kd_keluar','LEFT');
	$this->db->where('sys_user.kd_keluar is not null', NULL, FALSE);
	$this->db->group_by('b.grup,m_kode_keluar.ds_keluar');

	$res = $this->db->get('sys_user')->result();
//$arr=array();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 

	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}


		$arr[(int)$numero]['data'] = $arrz[$dat3]; 
		$arr[(int)$numero]['name'] = "Pegawai ".$dat3;
		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr); 
//$array = json_decode(json_encode($arr), true);
//print_r($array);
	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_pendidikan(){
	$this->db->select('count(*) as jml,b.grup,dm_term.nama as nama');
	$this->db->join('sys_user_profile','sys_user.id_user = sys_user_profile.id_user','LEFT');
	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('sys_grup_user as b','b.id_grup = a.direktorat','LEFT');
	$this->db->where('b.child','1');
	$this->db->where('b.tampilkan','1');


	$this->db->join('dm_term','dm_term.id = sys_user_profile.pendidikan_akhir','LEFT');
	$this->db->where('sys_user.kd_keluar is not null', NULL, FALSE);
	$this->db->where('sys_user_profile.pendidikan_akhir is not null', NULL, FALSE);
	$this->db->group_by('b.grup,dm_term.nama');

	$res = $this->db->get('sys_user')->result();
//$arr=array();

	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data[$val->nama][$val->grup] = $val->jml;
		$data2[$val->grup][$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 
	
	$numero =1; 
	foreach($datanama as $dat3){

		foreach($data2 as $g=>$val3){
			$dath[]= $g;
			if(!empty($data2[$g][$dat3])){
				$arrz[$dat3][] = (int)$data2[$g][$dat3];
			}else{
				$arrz[$dat3][] = 0;
			}

		}


		$arr[(int)$numero]['data'] = $arrz[$dat3]; 
		$arr[(int)$numero]['name'] = "Pegawai ".$dat3;
		++$numero;
	}
	$arr[0]['category'] = array_unique($dath);
	asort($arr); 
//$array = json_decode(json_encode($arr), true);
//print_r($array);
	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

function chart_pendidikan_all(){
	$this->db->select('count(*) as jml,dm_term.nama as nama');
	$this->db->join('sys_user_profile','sys_user.id_user = sys_user_profile.id_user','LEFT');
	$this->db->join('riwayat_kedinasan as a','a.id_user = sys_user_profile.id_user','LEFT');
	$this->db->where('a.aktif','1');
	$this->db->join('dm_term','dm_term.id = sys_user_profile.pendidikan_akhir','LEFT');
	$this->db->where('sys_user.kd_keluar is not null', NULL, FALSE);
	$this->db->where('sys_user_profile.pendidikan_akhir is not null', NULL, FALSE);
	$this->db->group_by('dm_term.nama');
	
	$res = $this->db->get('sys_user')->result();
//$arr=array();
	
	foreach($res as $val){
//$data[0]['category']=($val->grup);
		$data2[$val->nama] = $val->jml;
		$datanama[$val->nama]=$val->nama;
	} 
	
	$numero =1; 
	foreach($datanama as $dat3){
		if(!empty($data2[$dat3])){
				$arrz[$dat3][0] = (int)$data2[$dat3];
			}else{
				$arrz[$dat3][0] = 0;
			}

		$arr[(int)$numero]['data'] = $arrz[$dat3]; 
		$arr[(int)$numero]['name'] = "Pegawai ".$dat3;
		++$numero;
	}
	$arr[0]['category'][0] = 'Seluruh Pegawai';
	asort($arr); 
//$array = json_decode(json_encode($arr), true);
//print_r($array);
	$h=array();

	foreach($arr as $dat){
//	$h = array($dat);
		array_push($h,$dat);
	}
	echo  json_encode($h); 
}

}
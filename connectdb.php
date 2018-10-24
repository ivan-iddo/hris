<?php
 session_start();  
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "gtpayid_hris";

 

////mysql_connect($servername,$username,$password);
//@mysql_select_db($dbname) or die( "Unable to select database");

$con = mysqli_connect($servername,$username,$password,$dbname);

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit;
  }


function tree($jenis="",$idaplikasi="",$idgroup="",$idmodul=""){
		
		
		if($jenis=='modul'){
            
            $sql="SELECT a.id_modul, b.modul, b.controller
FROM sys_user_access as a
JOIN sys_mst_modul as b ON b.id_modul=a.id_modul
WHERE


";
			 
		
		if(!empty($idaplikasi)){
				 
                $sql.="a.id_aplikasi = '".$idaplikasi."' AND ";
			}
			if(!empty($idgroup)){
				 
                $sql.="a.id_group = '".$idgroup."' AND ";
			}
			
		$sql.=" b.id_aplikasi = a.id_aplikasi
        GROUP BY a.id_modul, b.modul, b.controller
        ORDER BY urutan ASC"; 
        $result = mysql_query($sql);
		$hasil = mysql_fetch_array($result);
		return $hasil;
		//sampai disini
			 
		}
		
		if($jenis=='menu'){
			
			$sql="SELECT a.id_modul, b.modul, c.url, c.menu
FROM sys_user_accesss a
LEFT JOIN sys_mst_modul b ON b.id_aplikasi=a.id_aplikasi	AND a.id_modul=b.id_modul	AND b.aktif='1'
LEFT JOIN sys_mst_menu c ON c.id_aplikasi=a.id_aplikasi	AND c.id_modul=a.id_modul	AND c.id_menu=a.id_menu
WHERE
 

";
			 
		
			if(!empty($idaplikasi)){
				$sql."a.id_aplikasi = '".$idaplikasi."' AND";
				 
			}
			
			if(!empty($idgroup)){ 
				$sql."a.id_group = '".$idgroup."' AND";
			}
			
			if(!empty($idmodul)){ 
				$sql."a.id_modul = '".$idmodul."' AND";
			}
			
			
			$sql." c.front = '1'"; 
		 $sql."GROUP BY a.id_modul, b.modul, c.url, c.menu
			ORDER BY c.urutan ASC";
			$result = mysql_query($sql);
			$hasil = mysql_fetch_array($result);
			 
		 return $hasil;
	
		}
}

function dateDiff($d1,$d2){
	return round(abs(strtotime($d1) - strtotime($d2))/86400);
}

?>

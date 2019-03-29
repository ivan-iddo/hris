<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
* Code Igniter
*
* An open source application development framework for PHP 4.3.2 or newer
*
* @package		CodeIgniter
* @author		Rick Ellis
* @copyright	Copyright (c) 2006, pMachine, Inc.
* @license		http://www.codeignitor.com/user_guide/license.html
* @link			http://www.codeigniter.com
* @since        Version 1.0
* @filesource
*/

// ------------------------------------------------------------------------

/**
* Code Igniter Asset Helpers
*
* @package		CodeIgniter
* @subpackage	Helpers
* @category		Helpers
* @author       Philip Sturgeon < email@philsturgeon.co.uk >
*/

// ------------------------------------------------------------------------


function css($asset_name, $module_name = NULL, $attributes = array())
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css($asset_name, $module_name, $attributes);
}

function penyebut($nilai) {
	$nilai = abs($nilai);
	$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
	$temp = "";
	if ($nilai < 12) {
		$temp = " ". $huruf[$nilai];
	} else if ($nilai <20) {
		$temp = penyebut($nilai - 10). " belas";
	} else if ($nilai < 100) {
		$temp = penyebut($nilai/10)." puluh". penyebut($nilai % 10);
	} else if ($nilai < 200) {
		$temp = " seratus" . penyebut($nilai - 100);
	} else if ($nilai < 1000) {
		$temp = penyebut($nilai/100) . " ratus" . penyebut($nilai % 100);
	} else if ($nilai < 2000) {
		$temp = " seribu" . penyebut($nilai - 1000);
	} else if ($nilai < 1000000) {
		$temp = penyebut($nilai/1000) . "ribu" . penyebut($nilai % 1000);
	} else if ($nilai < 1000000000) {
		$temp = penyebut($nilai/1000000) . " juta" . penyebut($nilai % 1000000);
	} else if ($nilai < 1000000000000) {
		$temp = penyebut($nilai/1000000000) . " milyar" . penyebut(fmod($nilai,1000000000));
	} else if ($nilai < 1000000000000000) {
		$temp = penyebut($nilai/1000000000000) . " trilyun" . penyebut(fmod($nilai,1000000000000));
	}     
	return $temp;
}

function terbilang($nilai) {
	if($nilai<0) {
		$hasil = "minus ". trim(penyebut($nilai));
	} else {
		$hasil = trim(penyebut($nilai));
	}     		
	return $hasil;
}

function splitWords($text, $cnt = 2) 
{
	$words = explode(' ', $text);

	$result = array();

	$icnt = count($words) - ($cnt-1);

	for ($i = 0; $i < $icnt; $i++)
	{
	$str = '';

	for ($o = 0; $o < $cnt; $o++)
	{
		$str .= $words[$i + $o] . ' ';
	}

	array_push($result, trim($str));
	}

	return $result;
}

function linkify($string, $twitter=false) {
	
				// reg exp pattern
				$pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
				
				// convert string URLs to active links
				$new_string = preg_replace($pattern, "\\0\"", $string);
				
				 
				
				return $new_string;
				}
				
				function unlinkify($string, $twitter=false) {
	
				// reg exp pattern
				$pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
				
				// convert string URLs to active links
				$new_string = preg_replace($pattern, "", $string);
				
				if ($twitter) {
					$pattern = '/@([a-zA-Z0-9_]+)/';
					$replace = '';
					$new_string = preg_replace($pattern, $replace, $new_string);
				}
				
				return $new_string;
				}

				function del_sign($string, $twitter=false) {
					
								// reg exp pattern
								$pattern = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
								
								// convert string URLs to active links
								$new_string = preg_replace($pattern, "", $string);
								
								 
									$pattern = '/@([a-zA-Z0-9_]+)/';
									$replace = '';
									$new_string = preg_replace($pattern, $replace, $new_string);
								
								$new_string = str_replace(array(":","+"),array('',''),$new_string);
								return $new_string;
								}

function theme_css($asset, $attributes = array())
{
	return css($asset, '_theme_', $attributes);
}

function css_url($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css_url($asset_name, $module_name);
}

function css_path($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->css_path($asset_name, $module_name);
}

// ------------------------------------------------------------------------


function image($asset_name, $module_name = NULL, $attributes = array())
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->image($asset_name, $module_name, $attributes);
}

function theme_image($asset, $attributes = array())
{
	return image($asset, '_theme_', $attributes);
}

function image_url($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->image_url($asset_name, $module_name);
}

function image_path($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->image_path($asset_name, $module_name);
}

function trim_image($str=""){
	 preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
	 
	return empty($image["src"])?base_url().'images/no-image-box.png':$image["src"];
	 
	
}

function trim_rss($str=""){
	 preg_match('/<font.+size=[\'"](?P<src>.+?)[\'"].*>/i', $str, $image);
	 print_r($image);
	//return empty($image["src"])?base_url().'images/no-image-box.png':$image["src"];
	 
	
}

function hack_log(){
	$CI =& get_instance();
	$CI->db->insert('hack',array('user_id'=>$CI->user->id,'url'=>uri_string(),'tgl'=>now()));
}

function treedata($table="",$id="",$params=array()){
	$CI =& get_instance();
	 $tablenya = $table;
		$CI->db->select('t1.title AS lev_1,t1.id AS idlev_1,t1.kode AS kode_1,t1.status AS status_1,
						t2.title as lev_2,t2.id AS idlev_2,t2.kode AS kode_2,t2.status AS status_2,
						t3.title as lev_3,t3.id AS idlev_3,t3.kode AS kode_3,t3.status AS status_3,
						t4.title as lev_4,t4.id AS idlev_4,t4.kode AS kode_4,t4.status AS status_4');
		
		$CI->db->join($tablenya.' as default_t2',' t2.parent_id = t1.id','LEFT');
		$CI->db->join($tablenya.' as default_t3',' t3.parent_id = t2.id','LEFT');
		$CI->db->join($tablenya.' as default_t4',' t4.parent_id = t3.id','LEFT');
		$CI->db->where('t1.parent_id',$id);
		
		if (isset($params['limit']) && is_array($params['limit']))
			$CI->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$CI->db->limit($params['limit']);
		 
	$res =  $CI->db->get($tablenya.' as default_t1')->result();
	 
	foreach($res as $dat => $val){
		
		//$exp = explode()
		 // $data[$val->idlev_1]=$val->lev_1;
				$data[$val->idlev_2]['nama']='<b>'.strtoupper($val->lev_2).'</b>';
				$data[$val->idlev_3]['nama']='&raquo; <b><em>'.$val->lev_3.'</em></b>';
			    $data[$val->idlev_4]['nama']='&raquo;&raquo; '.$val->lev_4;
				
				$data[$val->idlev_2]['kode']=$val->kode_2;
				$data[$val->idlev_3]['kode']=$val->kode_3;
			    $data[$val->idlev_4]['kode']=$val->kode_4;
				
				$data[$val->idlev_2]['status']=$val->status_2;
				$data[$val->idlev_3]['status']=$val->status_3;
			    $data[$val->idlev_4]['status']=$val->status_4;
				
				$data[$val->idlev_2]['id']=$val->idlev_2;
				$data[$val->idlev_3]['id']=$val->idlev_3;
			    $data[$val->idlev_4]['id']=$val->idlev_4;
				 
	}
	
	return $data;
}

function text_only($str=""){
	$content = preg_replace("/<img[^>]+\>/i", " ", $str); 
return  $content;
}

// ------------------------------------------------------------------------


function js($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js($asset_name, $module_name);
}

function theme_js($asset)
{
	return js($asset, '_theme_');
}

function js_url($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js_url($asset_name, $module_name);
}

function js_path($asset_name, $module_name = NULL)
{
	$CI =& get_instance();
	$CI->load->library('asset');
	return $CI->asset->js_path($asset_name, $module_name);
}


function bulan($bln=""){
		 
		switch ($bln) {
		case 1:
		    return 'Januari';
		    break;
		case 2:
		    return 'Februari';
		    break;
		case 3:
		    return 'Maret';
		    break;
		case 4:
		    return 'April';
		    break;
		case 5:
		    return 'Mei';
		    break;
		case 6:
		    return 'Juni';
		    break;
		case 7:
		    return 'Juli';
		    break;
		case 8:
		    return 'Agustus';
		    break;
		case 9:
		    return 'September';
		    break;
		case 10:
		    return 'Oktober';
		    break;
		case 11:
		    return 'November';
		    break;
		case 12:
		    return 'Desember';
		    break;
	    }
	}

function hari_indo($hari = ""){
	switch($hari){
		case 'Sun':
			$hari_ini = "Minggu";
		break;
 
		case 'Mon':			
			$hari_ini = "Senin";
		break;
 
		case 'Tue':
			$hari_ini = "Selasa";
		break;
 
		case 'Wed':
			$hari_ini = "Rabu";
		break;
 
		case 'Thu':
			$hari_ini = "Kamis";
		break;
 
		case 'Fri':
			$hari_ini = "Jumat";
		break;
 
		case 'Sat':
			$hari_ini = "Sabtu";
		break;
		
		default:
			$hari_ini = "Tidak di ketahui";		
		break;
	}
 
	return $hari_ini;
}
	
function bln(){
	$bulan=array(
		     '01' => 'January',
		     '02' => 'Februari',
		     '03' => 'Maret',
		     '04' => 'April',
		     '05' => 'Mei',
		     '06' => 'Juni',
		     '07' => 'July',
		     '08' => 'Agustus',
		     '09' => 'September',
		     '10' => 'Oktober',
		     '11' => 'November',
		     '12' => 'Desember' 

		     
		     );
	return $bulan;
}

function tgl(){
	
	for($i=1;$i<=31;$i++){
		$frm=str_pad($i,2,'0',STR_PAD_LEFT);
		$tgl[$frm]=$frm;
	}
	return $tgl;
}

function thn($awal="",$akhir=""){
	if($awal==''){
		$awal='2000';
	}
	
	if($akhir==''){
		$akhir=date('Y');
	}
	
	for($i=$awal;$i<=$akhir;$i++){
		$year[$i]=$i;
	}
	
	return $year;
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
 
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'tahun',
        'm' => 'bulan',
        'w' => 'minggu',
        'd' => 'hari',
        'h' => 'jam',
        'i' => 'menit',
        's' => 'detik',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' yang lalu' : 'Baru saja';
}

function hitunghari($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
 
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

   return $diff->days;
}

function timeAgo($time=""){
  $periods = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "yang lalu";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "";
   }

   return $difference.' '.$periods[$j].' '.$tense;
}

function days_in_month($bln="",$thn=""){
	return cal_days_in_month(CAL_GREGORIAN, $bln, $thn);
}

function dmy($originalDate){ 
			return  $newDate = date("d-m-Y", strtotime($originalDate));
}

function cekAvatar($gravatar=""){
	if($gravatar){
	$FPATH=$this->input->request_headers()['DOCUMENT_ROOT'].'/web/uploads/komunitas_avatar/';
	$avatar=$FPATH.$gravatar;
			if (file_exists($avatar)) {
				 $avatar=base_url().'uploads/komunitas_avatar/'.$gravatar;
			    } else {
				$avatar=base_url().'uploads/komunitas_avatar/no_image.jpg';
			    }
	}else{
		$avatar=base_url().'uploads/komunitas_avatar/no_image.jpg';
	}
	 
	return $avatar;
}


function generate_form($forminput="",$dbdata=array(),$data=array()){
	 foreach($forminput as $frm_key => $frm_val){?> 
	<div class="form-group">
		<label class="col-lg-2 control-label"><?php echo $frm_val['label']?></label>
		<div class="col-lg-10">
			<?php if($frm_val['type'] == 'text' ){?>
		<?php echo form_input($frm_val['field'], @$dbdata->$frm_val['field'], 'maxlength="10" id="'.$frm_val['id'].'" class="text width-20 form-control"'); ?>
		<?php }?>
		<?php if($frm_val['type'] == 'texteditor' ){?>
		<?php echo form_textarea(array('id' => $frm_val['field'], 'name' => $frm_val['field'], 'value' => @$dbdata->$frm_val['field'], 'rows' => 5, 'class' => 'wysiwyg-advanced form-control')); ?>	
		<?php }?>
		<?php if($frm_val['type'] == 'datepicker' ){?>
		<?php echo form_input($frm_val['field'], date('Y-m-d'), 'maxlength="10" id="'.$frm_val['id'].'" class="text width-20 form-control"'); ?>	
		<?php }?>
		<?php if($frm_val['type'] == 'dropdown' ){
			
			 
			
			?>
		<?php echo form_dropdown('tdup_sumber', $data[$frm_val['field']], @$dbdata->$frm_val['field'],' class="form-control" id="'.$frm_val['id'].'"') ?>	
		<?php }?>
		</div> 
	</div>
	<?php } 
}

	function repairSerializeString($value)
{

    $regex = '/s:([0-9]+):"(.*?)"/';

    return preg_replace_callback(
        $regex, function($match) {
            return "s:".mb_strlen($match[2]).":\"".$match[2]."\""; 
        },
        $value
    );
				}

function data_enum($table , $field){
	$obj =& get_instance();
	$query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
	 $row = $obj->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;  
	 $regex = "/'(.*?)'/";
			preg_match_all( $regex , $row, $enum_array );
			$enum_fields = $enum_array[1];
			foreach ($enum_fields as $key=>$value)
			{
				$enums[$value] = $value; 
			}
			return $enums;
}

function move_folder( $source, $target ) {
		if ( is_dir( $source ) ) {
			@mkdir( $target );
			$d = dir( $source );
			while ( FALSE !== ( $entry = $d->read() ) ) {
				if ( $entry == '.' || $entry == '..' ) {
					continue;
				}
				$Entry = $source . '/' . $entry; 
				if ( is_dir( $Entry ) ) {
					move_folder( $Entry, $target . '/' . $entry );
					continue;
				}
				copy( $Entry, $target . '/' . $entry );
			}
	
			$d->close();
		}else {
			copy( $source, $target );
		}
	}
	
	function createDateRange($startDate, $endDate, $format = "Y-m-d")
		{
			$begin = new DateTime($startDate);
			$end = new DateTime($endDate);
		
			$interval = new DateInterval('P1D'); // 1 Day
			$dateRange = new DatePeriod($begin, $interval, $end);
		
			$range = [];
			foreach ($dateRange as $date) {
				$range[] = $date->format($format);
			}
		
			return $range;
		}
		
		function cekarray($startDate)
		{
			echo '<pre>';
			print_r($startDate);
		}
		
		function tglini(){
			return strtotime(date('Y-m-d 23:i:s'));
		}
	
	function full_copy( $source, $target ) {
		if ( is_dir( $source ) ) {
			@mkdir( $target );
			$d = dir( $source );
			while ( FALSE !== ( $entry = $d->read() ) ) {
				if ( $entry == '.' || $entry == '..' ) {
					continue;
				}
				$Entry = $source . '/' . $entry; 
				if ( is_dir( $Entry ) ) {
					full_copy( $Entry, $target . '/' . $entry );
					continue;
				}
				copy( $Entry, $target . '/' . $entry );
			}
	
			$d->close();
		}else {
			copy( $source, $target );
		}
	}
	
	function data($data){
		$data = trim(htmlentities(strip_tags($data)));
		return mysql_real_escape_string(stripslashes($data));
   }
   
   function salt()
   {
	   return substr(md5(uniqid(rand(), true)), 0, 6);
   }
   
   function keygen($length=10)
	   {
		   $key = '';
		   list($usec, $sec) = explode(' ', microtime());
		   mt_srand((float) $sec + ((float) $usec * 100000));
		   
		   $inputs = array_merge(range('z','a'),range(0,9),range('A','Z'));
	   
		   for($i=0; $i<$length; $i++)
		   {
			   $key .= $inputs{mt_rand(0,61)};
		   }
		   return $key;
	   }

   function hash_password_db($identity, $password)
   {
	  if (empty($identity) || empty($password))
	  {
	   return FALSE;
	  } 
	 
			$query = "SELECT * FROM default_users WHERE email = '".data(trim($identity))."'  
	  and active = '1'";
		   
	  $result = mysql_query($query);
		   if (mysql_affected_rows() <> 0) {
			   while ( $row = mysql_fetch_assoc($result) )
				   { 
							$salt = $row['salt'];
				   }
				   return sha1($password . $salt);
		   }else{
			  return FALSE;
		   }
		   


		

		
   }
   
   function cektoken($token="",$username="")
	   {
		   $query = "SELECT  *  FROM default_users where username='".$username."' OR id ='".$username."' and keycode='".$token."'";
		   $result = mysql_query($query);
		   
		   if (mysql_affected_rows()<> 0) {
			   $tokenbaru = base64_encode(keygen().$username);
			   $queryToken = "UPDATE default_users set token='".$tokenbaru."' username='".$username."' and keycode='".$token."'";
			   $result_token = mysql_query($queryToken);
			   return $tokenbaru;
		   }else{
				
			   return false;
			   exit;
		   } 
	   }
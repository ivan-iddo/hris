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

class Inventory extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */
  
	public function list_get(){
		$headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$status = $this->input->get('status');
		$this->db->select("
						   
								a.no_ro
								,a.tgl_ro
								,a.kode_klinik
								,b.nama_klinik
								,'' as id_buku
								,'' as tahun_buku
								,a.deadline
								,a.keterangan								
								,a.status_cancel
								,a.created
								,a.modified
								,a.author													
								,a.sts_approve
								,c.nama_suplier
								,case when a.status_close='0' then 'Belum Proses'  when a.status_close='1' then 'Sedang Proses'
								 when a.status_close='2' then  'Close' end as status_po
						  ");
		 
		$this->db->join('m_klinik b','b.kode_klinik=a.kode_klinik','LEFT');
		$this->db->join('m_suplier c','c.id_suplier=a.id_suplier','LEFT');
		$this->db->order_by('no_ro','ASC');
		
		if($status=='approved'){
			$this->db->where('a.sts_approve','1');
		}else{
			$this->db->where('a.sts_approve','0');
		}
		  $res = $this->db->get('trx_request_order as a')->result();
		  foreach($res as $d){
			$status_approve = (($d->sts_approve == "1") ? "Approved" : "");
			$arr[]=array('id'=>$d->no_ro,'tgl'=>date_format(date_create($d->tgl_ro),'d-m-Y'),'deadline'=>date_format(date_create($d->deadline),'d-m-Y'),'keterangan'=>$d->keterangan,'nama_suplier'=>$d->nama_suplier,'status_proses'=>$d->status_po,'status_approve'=>$status_approve);
		  }
		  
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
	}
	
	function loadData_detail_ro_get($id=""){
       $headers = $this->input->request_headers();
 
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				 $query	=$this->db->query("select 
										a.id
										,a.no_ro
										,a.kode_produk
										,b.nama_produk
										,a.qty
										,d.id_satuan
										,c.nama_satuan																																		
									FROM trx_request_order_detail a
									LEFT JOIN m_produk b ON b.kode_produk=a.kode_produk
									LEFT JOIN m_barang d ON d.kode_produk=a.kode_produk
									LEFT JOIN m_satuan c ON c.id_satuan=d.id_satuan
									
									where a.no_ro='".$id."'
						")->result();
		$no=0;
        foreach($query as $r){
			++$no;
			 $arr['data'][] = array('no'=>$no
							,'id'=>$r->id
						   ,'kode'=>$r->kode_produk
						   ,'nama'=>$r->nama_produk
						   ,'qty'=>$r->qty
						   ,'satuan'=>$r->nama_satuan
						   ,'id_satuan'=>$r->id_satuan
						   ,'no_ro'=>$r->no_ro
						   
						   );
			
			 
		  }
		  
		   if(empty($arr)){
				$arr['status']='no';
				//$arr['message']='No data';
			 }else{
				$arr['status']='ok';
			 }
		 
		  $this->set_response($arr, REST_Controller::HTTP_OK);
			
                return;
			}
		}
		
		 $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
		
    }
	
	 
	 
}
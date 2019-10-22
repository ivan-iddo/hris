<?php
error_reporting(0);
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
date_default_timezone_set('Asia/Jakarta');
class Jpl extends REST_Controller
{
    /**
     * URL: http://localhost/CodeIgniter-JWT-Sample/auth/token
     * Method: GET
     */

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
    }

    public function list_get($offset = 0, $param_search = "")
    {
        $search = null;
        $limit = 100;
        $headers = $this->input->request_headers();
        
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization']) || true) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false || true) {
                $this->db->select('jpl.*,sys_grup_user.grup');
                $this->db->join('sys_grup_user','sys_grup_user.id_grup=jpl.id_grup');
                $this->db->where('jpl.tampilkan','1');
				$res = $this->db->get('jpl')->result();
				//print_r($res);die(); 
			if(!empty($res)){
				 foreach($res as $dat){
					$arr['result'][]= array('id'=> $dat->id_grup,'nama'=> $dat->grup,'created'=> $dat->created,'createdby'=> $dat->createdby);
				  }
				$arr['total']=$total_rows;
				$arr['limit'] = $limit;
                $this->set_response($arr, REST_Controller::HTTP_OK);
                return;
            }
        }
        }

        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function save_post()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
                $id_user=$decodedToken->data->id;

				$this->db->where('jpl.id_grup',$this->input->post('unit'));
				$cek = $this->db->get('jpl')->result();
				//print_r($cek);die();
				if(empty($cek)){
				$arr=array(
					'id_grup'=> ($this->input->post('unit')?$this->input->post('unit'):NULL),
					'created'=> date('Y-m-d H:i:s'),
					'createdby'=> $id_user,);//array('kd_profesi'=>$this->input->post('nama'));
					 
					$this->db->insert('jpl',$arr);
				}
				if ($arr){
                    $response['hasil'] = 'success';
                    $response['message'] = 'Data berhasil ditambah!';
                }
                else{
                    $response['hasil'] = 'failed';
                    $response['message'] = 'Data suda ada!';
                    $this->set_response($response, REST_Controller::HTTP_OK);
                }
                $this->set_response($response, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function delete_get()
    {
        $headers = $this->input->request_headers();

        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
            if ($decodedToken != false) {
				$id= $this->input->get('id');
                 	$this->db->where('jpl.id_grup',$id);
					$this->db->delete('jpl');
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

	
	public function get_get()
    {
        $results["success"] = false;
        $id = $this->input->get('id');
        $this->db->select('m_alat_angkut.*');
        $this->db->where('m_alat_angkut.id',$id);
        $this->db->where('m_alat_angkut.tampilkan','1');
		$result = $this->db->get('m_alat_angkut')->result(); 
       if (count($result) == 1) {
            $result = $result[0];
            $results["success"] = true;
            $results["data"] = $result;
       }
	   //print_r($results["data"]);die();

       $this->set_response($results, REST_Controller::HTTP_OK);
    }
}
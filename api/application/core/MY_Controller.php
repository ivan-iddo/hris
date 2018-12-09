<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            $this->user = AUTHORIZATION::validateToken($headers['Authorization']);
        }
        else if ($this->input->get("error")) {

        }
        else{
            die;
        }
    }

    public function debug($value = "")
    {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($_FILES);
        // echo "</pre>";
        echo $this->db->last_query();
        die;
    }

    public function set_response($response)
    {
        if (DEBUG_QUERY) {
            $response["query"] = $this->db->last_query();
        }
        echo json_encode($response);
    }
}
?>
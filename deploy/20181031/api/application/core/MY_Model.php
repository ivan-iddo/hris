<?php
/**
 * @property Document_model $Document_model
 * @property Email_model $Email_model
 * @property Error_model $Error_model
 */
class MY_Model extends CI_Model
{
	protected $data = array();
	public function __construct()
	{
		parent::__construct();
		$headers = $this->input->request_headers();
		AUTHORIZATION::validateToken($headers['Authorization']);
		$this->user = AUTHORIZATION::validateToken($headers['Authorization']);
		//Do your magic here
	}

	public function _create()
	{
		$this->data = array('createdby' => $this->user->data->id,
								'created' => date("Y-m-d H:i:s"));
	}

	public function _update()
	{
		$this->data = array('updatedby' => $this->user->data->id,
								'updated' => date("Y-m-d H:i:s"));
	}
}
?>
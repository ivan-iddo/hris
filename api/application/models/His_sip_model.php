<?php
class His_sip_model extends MY_Model
{
	private $table = "his_sip";

	function __construct()
	{
		parent::__construct();
	}

	function create($item)
	{
		$this->_create();
		$data = array_merge(
								$item,
								$this->data
							);
		$this->db->insert($this->table, $data);
		$id = $this->db->insert_id('his_sipid_seq');
		return $this->db->where("id", $id)->get($this->table)->row();
	}

	function get_all($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "")
	{	
		$this->db->select("*");
		$this->db->from($this->table);
		$this->db->where("statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
//            debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($from)) {
			$this->db->where("created >=", $from);
		}

		if (!empty($to)) {
			$this->db->where("created <=", $to);
		}

		if (is_array($like) && !empty($like)) {
			foreach ($like["field"] as $key => $value) {
				if ($key == 0) {
					$this->db->like($value, $like["search"]);
				}
				else{
					$this->db->or_like($value, $like["search"]);
				}
			}
		}

		if (is_array($order_by) && !empty($order_by)) {
			foreach ($order_by as $key => $value) {
				$this->db->order_by($key, $value);
			}
		}
		if (!empty($offset)) {
			$this->db->offset($offset);
		}

		if (!empty($limit)) {
			$this->db->limit($limit);
		}

		$query = $this->db->get();
		// echo $this->db->last_query();die;
		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->result_array();
		}
	}

	function update($id, $item)
	{
        $this->_update();
        $item["statue"] = $item["statue"] ? $item["statue"] : 1;
        
        $data = array_merge(
            $item, $this->data
        );

		$this->db->where("id", $id);
		$result = $this->db->update($this->table, $data);

		if ($result) {
			$get = $this->get_all(array("id" => $id, "statue" => $item["statue"]));
			if (count($get) == 1) {
				return (Object)$get[0];
			}
			return $get;
		}
		return false;
	}

	function delete($id)
	{
		$this->_update();
		$item["statue"] = 0;
		
		$data = array_merge(
		    $item, $this->data
		);
		$result = $this->db->update($this->table, $data, array("id" => $id));
		return $result;
	}
}
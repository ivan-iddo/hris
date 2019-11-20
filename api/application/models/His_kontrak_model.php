<?php
class His_kontrak_model extends MY_Model
{
	private $table = "his_kontrak";

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
		$id = $this->db->insert_id('his_kontrakid_seq');
		return $this->db->where("id", $id)->get($this->table)->row();
	}

	function get_all($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "")
	{	
		$this->db->select("his_kontrak.*, pns_name.nama as status_pns, tetap_name.nama as status_tetap");
		$this->db->from($this->table);
		$this->db->where("statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			// debug($params_array);die;
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
//           debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}
		$this->db->join('m_status_pegawai as tetap_name', 'tetap_name.id = his_kontrak.tetap', 'LEFT');
		$this->db->join('m_status_pegawai as pns_name', 'pns_name.id = his_kontrak.pns', 'LEFT');
		if (!empty($from)) {
			$this->db->where("his_kontrak.created >=", $from);
		}

		if (!empty($to)) {
			$this->db->where("his_kontrak.created <=", $to);
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
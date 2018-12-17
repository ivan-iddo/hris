<?php
class Pengembangan_pelatihan_model extends MY_Model
{
	private $table = "pengembangan_pelatihan";

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
		$id = $this->db->insert_id();
		return $this->db->where("id", $id)->get($this->table)->row();
	}

	function create_detail($table, $data)
	{
		$this->db->insert_batch($table, $data);
		$id = $this->db->insert_id();
		return $this->db->where("id", $id)->get($table)->row();
	}

	function create_detail_row($table, $data)
	{
		$data = array_merge(
								$data,
								$this->data
							);
		$this->db->insert($table, $data);
		$id = $this->db->insert_id();
		return $this->db->where("id", $id)->get($table)->row();
	}

	function delete_detail($table, $conditions)
	{
		$result = $this->db->update($table, array("statue" => 0), $conditions);
		return $result;
	}

	function get_detail($table, $conditions)
	{
		$this->db->select("*");
		$this->db->from($table);
		if (!empty($conditions) && is_array($conditions)) {
			$this->db->where($conditions);
		}
		$this->db->where("statue", 1);
		$result = $this->db->get()->result_array();
		return $result;
	}

	function is_blocked($nopeg)
	{
		$data = $this->get_all(array("statue" => 1,
										"laporan" => 1,
										"created <=" => date("Y-m-d", strtotime("-5 days", strtotime(date("Y-m-d"))))
										)
								);
		
		if (!empty($data)){
			foreach ($data as $key => $value) {
				$check_detail = $this->get_detail("pengembangan_pelatihan_detail", array("nopeg" => $nopeg));
				// echo $this->db->last_query();die;
				// jika ada isLaporan == true && now <= (created-5)
				if ($check_detail) {
					return true;
				}
			}
		}
		return false;
	}

	function is_monev($nopeg)
	{
		$data = $this->get_all(array("statue" => 1,
												"laporan" => 1,
												"created <=" => date("Y-m-d", strtotime("-30 days", strtotime(date("Y-m-d"))))
												)
										);
				
		if (!empty($data)){
			foreach ($data as $key => $value) {
				$check_detail = $this->get_detail("pengembangan_pelatihan_detail", array("nopeg" => $nopeg));
				if ($check_detail) {
					return true;
				}
			}
		}
		return false;
	}

	function get_by_id($id, $statue = 1)
	{
		$this->db->select("*");
		$this->db->from($this->table);
		$this->db->where("id", $id);
		$this->db->where("statue", $statue);
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->row();
		}
	}

	function get_by_uniq_value($uniq_value, $statue = 1)
	{
		$this->db->select("*");
		$this->db->from($this->table);
		$this->db->where("id_no", $uniq_value);
		$this->db->where("statue", $statue);
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->row();
		}
	}

	function get_all($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "")
	{	
		$this->db->select("$this->table.*, dm_term.nama AS nama_status");
		$this->db->from($this->table);
		$this->db->join("dm_term", "$this->table.status = dm_term.id", "left");
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
		// default active = 1, 2 = done
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
		$result = $this->db->update($this->table, array("statue" => 0), array("id" => $id));
		return $result;
	}

}
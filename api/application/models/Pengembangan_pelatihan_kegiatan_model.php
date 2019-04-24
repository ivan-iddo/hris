<?php
class Pengembangan_pelatihan_kegiatan_model extends MY_Model
{
	private $table = "pengembangan_pelatihan_kegiatan";
	private $table1 = "pengembangan_pelatihan_detail";
	private $table2 = "pengembangan_pelatihan_pelaksanaan";

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
		$id = $this->db->insert_id('pengembangan_pelatihan_kegiatanid_seq');
		return $this->db->where("id", $id)->get($this->table)->row();
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
	
	
	function by_id($id, $statue = 1)
	{
		$this->db->select("*");
		$this->db->from($this->table2);
		$this->db->where("pengembangan_pelatihan_id", $id);
		$this->db->where("statue", $statue);
		$query = $this->db->get();

		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->row();
		}
	}
	
	function get_by($id, $statue = 1)
	{
		$this->db->select("$this->table1.*,sys_grup_user.grup");
		$this->db->from($this->table1);
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
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
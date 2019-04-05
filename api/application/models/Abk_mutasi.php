<?php
class Abk_mutasi extends MY_Model
{
	private $table = "abk_req_mutasi_jabatan";

	function __construct()
	{
		parent::__construct();
	}
	
	function get_all($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "")
	{	
		$this->db->select("abk_req_mutasi_jabatan.*,dm_term.nama as jenis,m_index_jabatan_asn_detail.ds_jabatan,sys_user.name,
		a.grup as dir_asal,
		b.grup as bag_asal,
        c.grup as subbag_asal,
        d.grup as dir_tujuan,
        e.grup as bag_tujuan,
        f.grup as subbag_tujuan");
		$this->db->from($this->table);
		$this->db->join("sys_user", "abk_req_mutasi_jabatan.user_id = sys_user.id_user", "left");
		$this->db->join("m_index_jabatan_asn_detail", "abk_req_mutasi_jabatan.jabatan_struktural = m_index_jabatan_asn_detail.migrasi_jabatan_detail_id", "left");
		$this->db->join("dm_term", "abk_req_mutasi_jabatan.jenis_mutasi = dm_term.id", "left");
		$this->db->join('sys_grup_user as f', 'f.id_grup = abk_req_mutasi_jabatan.sub_bagian_tujuan', 'LEFT');
        $this->db->join('sys_grup_user as e', 'e.id_grup = abk_req_mutasi_jabatan.bagian_tujuan', 'LEFT');
        $this->db->join('sys_grup_user as d', 'd.id_grup = abk_req_mutasi_jabatan.direktorat_tujuan', 'LEFT');
        $this->db->join('sys_grup_user as c', 'c.id_grup = abk_req_mutasi_jabatan.sub_bagian_asal', 'LEFT');
        $this->db->join('sys_grup_user as b', 'b.id_grup = abk_req_mutasi_jabatan.bagian_asal', 'LEFT');
        $this->db->join('sys_grup_user as a', 'a.id_grup = abk_req_mutasi_jabatan.direktorat_asal', 'LEFT');
		$this->db->where("abk_req_mutasi_jabatan.status", 91);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
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
}
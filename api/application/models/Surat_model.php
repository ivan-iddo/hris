<?php
class Surat_model extends MY_Model
{
	private $table = "surat";

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
		$id = $this->db->insert_id('suratid_seq');
		return $this->db->where("id", $id)->get($this->table)->row();
	}
	
	public function get_no($id) {
        $this->db->select("surat.id as id,surat_detail.golongan");
		$this->db->join('surat_detail', 'surat.surat_id=pengembangan_pelatihan.id');
		$result = $this->db->get_where('surat', array('surat.id' => $id), 1);
		if ($result->num_rows() > 0) {
            return $result->row();
        }
        return FALSE;
    }
	

	function create_detail($table, $data)
	{
		$this->db->insert_batch($table, $data);
		$id = $this->db->insert_id($table.'id_seq');
		return $this->db->where("id", $id)->get($table)->row();
	}

	function create_detail_row($table, $data)
	{
		$data = array_merge(
								$data,
								$this->data
							);
		$this->db->insert($table, $data);
		$id = $this->db->insert_id($table.'id_seq');
		return $this->db->where("id", $id)->get($table)->row();
	}

	function delete_detail($table, $conditions)
	{
		$result = $this->db->update($table, array("statue" => 0), $conditions);
		return $result;
	}
	
	function delete_detail_row($table, $conditions)
	{
		$result = $this->db->delete($table, $conditions);
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
	
	function get_total($from = "", $to = "", $where_in = "", $cari="")
	{	
		$this->db->select("count(surat.id) as countdel");
		$this->db->from($this->table);
		$this->db->join("surat_detail", "$this->table.id = surat_detail.surat_id AND surat_detail.statue = 0");
		$this->db->join("surat_pelaksanaan", "surat.id = surat_pelaksanaan.surat_id");
		$this->db->join("sys_user_profile", "surat_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "surat_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "surat_detail.id = dm_term.id", "left");
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}
		
		
		if (!empty($cari)) {
			$param = urldecode($cari);
            $param2 = "%".$param."%";
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
        }


		if (!empty($from)) {
			$this->db->where("surat.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("surat.created <=", $to);
		}

		$result = $this->db->get()->result_array();
		return $result;
	}
	
	function get_totaldel($from = "", $to = "", $where_in = "", $cari="")
	{	
		$this->db->select("count(pengembangan_pelatihan.id) as countdel");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 0");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}
		
		
		if (!empty($cari)) {
			$param = urldecode($cari);
            $param2 = "%".$param."%";
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
        }


		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		$result = $this->db->get()->result_array();
		return $result;
	}
	
	function get_detail_spd($table, $conditions)
	{
		$this->db->select("*");
		$this->db->from($table);
		if (!empty($conditions) && is_array($conditions)) {
			$this->db->where($conditions);
		}
		$this->db->where("statue", 1);
		$this->db->where("muncul", 1);
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	function get_akomodasi($table, $golongan)
	{
		$this->db->select("*");
		$this->db->from($table);
		if (!empty($golongan) && is_array($golongan)) {
			$this->db->where($golongan);
		}
		$this->db->where("statue", 1);
		$result = $this->db->get()->result_array();
		return $result;
	}
	
	function is_blocked($nopeg)
	{
		$data = $this->get_all(array("$this->table.statue" => 1,
										"laporan" => 1,
										"$this->table.created <=" => date("Y-m-d", strtotime("-5 days", strtotime(date("Y-m-d"))))
										)
								);
		
		if (!empty($data)){
			foreach ($data as $key => $value) {
				$check_detail = $this->get_detail("pengembangan_pelatihan_detail", array("nopeg" => $nopeg));
				// echo $this->db->last_query();die;
				// jika ada isLaporan == true && now <= ($this->table.created-5)
				if ($check_detail) {
					return true;
				}
			}
		}
		return false;
	}

	function is_monev($nopeg)
	{
		$data = $this->get_all(array("$this->table.statue" => 1,
												"laporan" => 1,
												"$this->table.created <=" => date("Y-m-d", strtotime("-30 days", strtotime(date("Y-m-d"))))
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
	
	function get_phl($phl)
	{
		$this->db->select("surat.phl,sys_user_profile.nip,sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang,sys_user.name");
		$this->db->from($this->table);
		$this->db->join("sys_user_profile", "surat.phl = sys_user_profile.id_user", "left");
		$this->db->join("sys_user", "surat.phl = sys_user.id_user", "left");
		$this->db->where("phl", $phl);
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
	function get_all($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $cari="")

	{	
		$this->db->select("$this->table.*,sys_user.email,surat_detail.id as kode,surat_detail.uraian_total,m_kode_profesi_group.ds_group_jabatan as profesi, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_user_profile.phone, sys_grup_user.grup,surat_detail.laporan_kegiatan");
		$this->db->from($this->table);
		$this->db->join("surat_detail", "$this->table.id = surat_id AND surat_detail.statue = 1");
		//$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "surat_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "surat_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "surat_detail.id = dm_term.id", "left");
		$this->db->where("$this->table.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}
		
		
		if (!empty($cari)) {
			$param = urldecode($cari);
            $param2 = "%".$param."%";
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
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

		if (!empty($order_by)) {
			$this->db->order_by($order_by);
		}
		
		if (!empty($offset)) {
			$this->db->offset($offset);
		}

		if (!empty($from)) {
			$this->db->where("surat.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("surat.created <=", $to);
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
	
	function get_list($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $cari="")
	{	
		$this->db->select("surat.jenis_biaya,surat.dalam_negeri,surat.jenis_perjalanan,surat.nama_pelatihan,surat.created,surat.createdby,pengembangan_pelatihan_kegiatan as kegiatan,surat.tujuan,surat.institusi,surat.pengembangan_pelatihan_kegiatan_status,surat.id as id,sys_user.email,surat_detail.id as kode,surat_detail.uraian_total,m_kode_profesi_group.ds_group_jabatan as profesi, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_user_profile.phone, sys_grup_user.grup,surat_detail.laporan_kegiatan");
		$this->db->from($this->table);
		$this->db->join("surat_detail", "$this->table.id = surat_detail.surat_id AND surat_detail.statue = 1");
		$this->db->join("surat_pelaksanaan", "surat.id = surat_pelaksanaan.surat_id");
		$this->db->join("sys_user_profile", "surat_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "surat_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "surat_detail.id = dm_term.id", "left");
		$this->db->where("$this->table.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}
		
		
		if (!empty($cari)) {
			$param = urldecode($cari);
            $param2 = "%".$param."%";
			$this->db->where("CONCAT(sys_user.name,' ', sys_user_profile.nip,' ',sys_user_profile.nik) ilike", $param2);
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

		if (!empty($order_by)) {
			$this->db->order_by($order_by,'DESC');
		}
		
		if (!empty($from)) {
			$this->db->where("surat.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("surat.created <=", $to);
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
	
	function get_no_berks()

	{	
		$this->db->select("max(berkas) as no_berkas");
		$this->db->from("surat_detail");
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
		//print_r($data);die();
		$this->db->where("id", $id);
		$result = $this->db->update($this->table, $data);

		if ($result) {
			$get = $this->get_all(array("$this->table.id" => $id, "surat_detail.statue" => $item["statue"]));
			if (count($get) == 1) {
				return (Object)$get[0];
			}
			return $get;
		}
		return false;
	}
	
	function update_de($id, $item)
	{
		// default active = 1, 2 = done
        $this->_update();
        $item["statue"] = $item["statue"] ? $item["statue"] : 1;
        
        $data = array_merge(
            $item, $this->data
        );
		//print_r($data);die();
		$this->db->where("id", $id);
		$result = $this->db->update($this->table, $data);

		if ($result) {
			$get = $this->get_all(array("$this->table.id" => $id, "surat_detail.statue" => $item["statue"]));
			if (count($get) >= 1) {
				return (Object)$get[0];
			}
			return $get;
		}
		return false;
	}
	

	function update_detail($id, $item)
	{
		// default active = 1, 2 = done
        $this->_update();
        
        $data = array_merge(
            $item, $this->data
        );
		//print_r($data);die();
		$this->db->where("id", $id);
		$result = $this->db->update("pengembangan_pelatihan_detail", $item);

			$get = $this->get_all(array("$this->table.id" => $id, "pengembangan_pelatihan_detail.laporan_kegiatan" => $item["laporan_kegiatan"]));
		if ($result) {
			if (count($get) == 1) {
				return (Object)$get[0];
			}
			return $get;
		}
		return false;
	}

	function update_pegawai($id, $item)
	{
		// default active = 1, 2 = done
        $this->_update();
        $item["statue"] = $item["statue"] ? $item["statue"] : 0;
        
        $data = array_merge(
            $item, $this->data
        );
		//print_r($data);die();
		$this->db->where("id", $id);
		$result = $this->db->update("surat_detail", array("statue" => 0));

			$get = $this->get_all(array("$this->table.id" => $id, "surat_detail.statue" => $item["statue"]));
		if ($result) {
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
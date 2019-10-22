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
		$id = $this->db->insert_id('pengembangan_pelatihanid_seq');
		return $this->db->where("id", $id)->get($this->table)->row();
	}
	
	public function get_no($id) {
        $this->db->select("pengembangan_pelatihan.id as id,pengembangan_pelatihan_detail.golongan");
		$this->db->join('pengembangan_pelatihan_detail', 'pengembangan_pelatihan.pengembangan_pelatihan_id=pengembangan_pelatihan.id');
		$result = $this->db->get_where('pengembangan_pelatihan', array('pengembangan_pelatihan.id' => $id), 1);
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
	
	function get_total($from = "", $to = "", $where_in = "", $cari="", $grup="")
	{	
		$this->db->select("count(pengembangan_pelatihan.id)");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("$this->table.statue !=", 0);
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

		if (!empty($grup)) {
			$this->db->where("sys_user.id_grup", $grup);
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
		$this->db->select("pengembangan_pelatihan.phl,sys_user_profile.nip,sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang,sys_user.name");
		$this->db->from($this->table);
		$this->db->join("sys_user_profile", "pengembangan_pelatihan.phl = sys_user_profile.id_user", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan.phl = sys_user.id_user", "left");
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
		$this->db->select("$this->table.*,sys_user.email,pengembangan_pelatihan_detail.id as kode,pengembangan_pelatihan_detail.uraian_total,m_kode_profesi_group.ds_group_jabatan as profesi, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_user_profile.phone, sys_grup_user.grup,pengembangan_pelatihan_detail.laporan_kegiatan");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		//$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
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
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
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
	
	function get_list($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $cari="", $grup="")
	{	
		$this->db->select("pengembangan_pelatihan.jenis_biaya,pengembangan_pelatihan.dalam_negeri,pengembangan_pelatihan.jenis_perjalanan,pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.created,pengembangan_pelatihan.createdby,pengembangan_pelatihan_kegiatan as kegiatan,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.id as id,sys_user.email,pengembangan_pelatihan_detail.id as kode,pengembangan_pelatihan_detail.uraian_total,m_kode_profesi_group.ds_group_jabatan as profesi, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_user_profile.phone, sys_grup_user.grup,pengembangan_pelatihan_detail.laporan_kegiatan");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
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
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}
		
		if (!empty($grup)) {
			$this->db->where("sys_user.id_grup", $grup);
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
	
	function get($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt)

	{	
		$this->db->select("$this->table.*,pengembangan_pelatihan_detail_biaya.*,pengembangan_pelatihan_detail.id as kode,pengembangan_pelatihan.id as id, m_kode_profesi_group.ds_group_jabatan as profesi,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nama_pegawai");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("pengembangan_pelatihan_detail_biaya", "pengembangan_pelatihan_detail_biaya.pengembangan_pelatihan_detail_id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
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

		if (!empty($filt)) {
			$this->db->order_by($filt);
		}
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan_pelaksanaan.tanggal_to <=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan_pelaksanaan.tanggal_to >=", $to);
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
	
	
	
	function get_new($params_array = array(), $nopeg = "", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $unit="", $kegiatan="", $jenis="", $perjalanan="", $dir="", $bagian="", $sub_bag="")

	{	
		$this->db->select("pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan_detail.uraian_total as nominal,pengembangan_pelatihan_detail.id as kode,pengembangan_pelatihan.id as id, m_kode_profesi_group.ds_group_jabatan as profesi,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nama_pegawai");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		if (!empty($nopeg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$nopeg);
		}
		
		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
		}
		
		if (!empty($kegiatan)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan);
		}
		
		if (!empty($jenis)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis);
		}
		//
		if (!empty($perjalanan)) {
		if ($perjalanan=="Dalam") {
			$this->db->where("pengembangan_pelatihan.jenis_perjalanan","Dalam Negeri");
		}else if($perjalanan=="Luar") {
			$this->db->where("pengembangan_pelatihan.jenis_perjalanan","Luar Negeri");
		}
		}
		
		if(!empty($dir)){
		$this->db->where('riwayat_kedinasan.direktorat', $dir);
		if(!empty($bagian)){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		if(!empty($sub_bag)){
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
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
	
	function get_unit($offset = "", $limit = "", $dir="", $bagian="", $sub_bag="")

	{	
		$this->db->select("sys_grup_user.grup,sys_user.name");
		$this->db->from("sys_user");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join('riwayat_kedinasan','riwayat_kedinasan.id_user = sys_user.id_user','LEFT');
		$this->db->where('riwayat_kedinasan.aktif','1');
		$this->db->where('sys_user.kd_keluar','12');
		
		
		if(!empty($dir)){
		$this->db->where('riwayat_kedinasan.direktorat', $dir);
		if(!empty($bagian)){
		$this->db->where('riwayat_kedinasan.bagian', $bagian);
		if(!empty($sub_bag)){
		$this->db->where('riwayat_kedinasan.sub_bagian', $sub_bag);
		}
		}
		}
		$this->db->order_by("sys_grup_user.grup");
		
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
	
	function get_jpl($params_array = array(), $nopeg = "", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $unit="", $kegiatan="", $jenis="", $jpl="", $id_grup="", $id_grup1="")

	{	
		$this->db->select("sum(pengembangan_pelatihan.total_hari_kerja) as jum, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup, pengembangan_pelatihan_detail.nama_pegawai, pengembangan_pelatihan_detail.nopeg, pengembangan_pelatihan.id as id");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}
		
		if (!empty($jpl)) {
			$this->db->where("pengembangan_pelatihan_pelaksanaan.total_jam >=", $jpl);
		}
		
		if (!empty($id_grup)) {
			$this->db->where_in('sys_user.id_grup',$id_grup);
		}
		

		if (!empty($nopeg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$nopeg);
		}
		
		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
		}
		
		if (!empty($kegiatan)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan);
		}
		
		if (!empty($jenis)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis);
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
	
	function get_new_del($params_array = array(), $nopeg = "", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $unit="", $kegiatan="", $jenis="")

	{	
		$this->db->select("pengembangan_pelatihan.nama_pelatihan,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status,pengembangan_pelatihan.pengembangan_pelatihan_kegiatan,pengembangan_pelatihan.total_hari_kerja,pengembangan_pelatihan.tujuan,pengembangan_pelatihan.institusi,pengembangan_pelatihan_detail.uraian_total as nominal,pengembangan_pelatihan_detail.id as kode,pengembangan_pelatihan.id as id, m_kode_profesi_group.ds_group_jabatan as profesi,pengembangan_pelatihan_pelaksanaan.tanggal_to,pengembangan_pelatihan_pelaksanaan.tanggal_from, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup,pengembangan_pelatihan_detail.nopeg,pengembangan_pelatihan_detail.berkas,pengembangan_pelatihan_detail.nama_pegawai");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 0");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("pengembangan_pelatihan_detail_biaya", "pengembangan_pelatihan_detail_biaya.pengembangan_pelatihan_detail_id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		if (!empty($nopeg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$nopeg);
		}
		
		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
		}
		
		if (!empty($kegiatan)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan);
		}
		
		if (!empty($jenis)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis);
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
	
	function get2($params_array = array(), $unit="", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $group="", $as="", $kegiatan1="", $jenis1="")

	{	
		$this->db->select("$as,sum(pengembangan_pelatihan_detail.uraian_total) as nominal,sum(pengembangan_pelatihan_pelaksanaan.total_jam) as total_jam,sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($group)) {
			$this->db->group_by($group);
		}
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
		}

		if (!empty($kegiatan1)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan1);
		}
		
		if (!empty($jenis1)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis1);
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
	
	function get_no_berks()

	{	
		$this->db->select("max(berkas) as no_berkas");
		$this->db->from("pengembangan_pelatihan_detail");
		$query = $this->db->get();
		// echo $this->db->last_query();die;
		if($query->num_rows()<1){
			return null;
		}
		else{
			return $query->result_array();
		}
	}
	
	function get3($params_array = array(), $no_peg="", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $as="")

	{	
		$this->db->select("$as,sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("pengembangan_pelatihan_kegiatan_status", "pengembangan_pelatihan_kegiatan_status.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		if (!empty($no_peg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$no_peg);
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
	
	function get5($params_array = array(), $no_peg="", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $as="",$unit="",$kegiatan1="", $jenis1="")

	{	
		$this->db->select("$as");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("pengembangan_pelatihan_kegiatan_status", "pengembangan_pelatihan_kegiatan_status.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}
		
		if (!empty($kegiatan1)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan1);
		}
		
		if (!empty($jenis1)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis1);
		}
		
	

		if (!empty($no_peg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$no_peg);
		}
		
		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
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
	
	function get7($params_array = array(), $no_peg="", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $as="",$array="")

	{	
		$this->db->select("$as");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("pengembangan_pelatihan_kegiatan_status", "pengembangan_pelatihan_kegiatan_status.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}

		if (!empty($array)) {
			$this->db->where("m_kode_profesi_group.ds_group_jabatan",$array);
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
	
	function get6($params_array = array(), $no_peg="", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $as="",$unit="",$kegiatan1="", $jenis1="")

	{	
		$this->db->select("$as");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("pengembangan_pelatihan_detail_biaya", "pengembangan_pelatihan_detail_biaya.pengembangan_pelatihan_detail_id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id");
		$this->db->join("pengembangan_pelatihan_kegiatan_status", "pengembangan_pelatihan_kegiatan_status.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan_status");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id = pengembangan_pelatihan.id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		
		if (!empty($kegiatan1)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan1);
		}
		
		if (!empty($jenis1)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis1);
		}
		
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		if (!empty($no_peg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$no_peg);
		}
		
		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
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
	
	function get_5($params_array = array(), $nopeg = "", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $filt="", $as="", $unit="", $kegiatan="", $jenis="", $year="")

	{	
		$this->db->select("$as");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($filt)) {
			$this->db->group_by($filt);
		}
		
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}

		if (!empty($nopeg)) {
			$this->db->where("pengembangan_pelatihan_detail.nopeg",$nopeg);
		}
		
		if (!empty($unit)) {
			$this->db->where('EXTRACT(MONTH FROM pengembangan_pelatihan_pelaksanaan.tanggal_too) =',$unit);
		}
		
		if (!empty($year)) {
			$this->db->where('EXTRACT(Year FROM pengembangan_pelatihan_pelaksanaan.tanggal_too) =',$year);
		}else{
			$year=date('Y');
			$this->db->where('EXTRACT(Year FROM pengembangan_pelatihan_pelaksanaan.tanggal_too) =',$year);
		}
		
		
		if (!empty($kegiatan)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan);
		}
		
		if (!empty($jenis)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis);
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
	function get_thn($params_array = array(), $as="", $unit="", $kegiatan="", $year="")

	{	
		$this->db->select("pengembangan_pelatihan.total as nominal,$as");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		$this->db->group_by("pengembangan_pelatihan.total");
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		
		if (!empty($unit)) {
			$this->db->where('EXTRACT(MONTH FROM pengembangan_pelatihan_pelaksanaan.tanggal_too) =',$unit);
		}
		
		if (!empty($year)) {
			$this->db->where('EXTRACT(Year FROM pengembangan_pelatihan_pelaksanaan.tanggal_too) =',$year);
		}else{
			$year=date('Y');
			$this->db->where('EXTRACT(Year FROM pengembangan_pelatihan_pelaksanaan.tanggal_too) =',$year);
		}
		
		
		if (!empty($kegiatan)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan);
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
	
	function get_kegiatan($params_array = array(), $unit="", $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "", $group="",$as="", $kegiatan1="", $jenis1="")

	{	
		$this->db->select("$as,sum(pengembangan_pelatihan_detail.uraian_total) as nominal,sum(pengembangan_pelatihan.total_hari_kerja) as hari,count(m_kode_profesi_group.ds_group_jabatan) as jum");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 1");
		$this->db->join("pengembangan_pelatihan_kegiatan", "pengembangan_pelatihan_kegiatan.id = pengembangan_pelatihan.pengembangan_pelatihan_kegiatan");
		$this->db->join("pengembangan_pelatihan_pelaksanaan", "pengembangan_pelatihan.id = pengembangan_pelatihan_pelaksanaan.pengembangan_pelatihan_id");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		$this->db->where("pengembangan_pelatihan.statue !=", 0);
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($group)) {
			$this->db->group_by($group);
		}
		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}
		
		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
		}
		if (!empty($unit)) {
			$this->db->where("sys_user.id_grup",$unit);
		}

		if (!empty($kegiatan1)) {
			$this->db->where("pengembangan_pelatihan.pengembangan_pelatihan_kegiatan",$kegiatan1);
		}
		
		if (!empty($jenis1)) {
			$this->db->where("sys_user_profile.kategori_profesi",$jenis1);
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
	
	function getdel_all($params_array = array(), $like = array(), $offset = "", $limit = "", $from = "", $to = "", $where_in = "", $order_by = "")
	{	
		$this->db->select("$this->table.*,pengembangan_pelatihan_detail.id as kode,pengembangan_pelatihan_detail.uraian_total,m_kode_profesi_group.ds_group_jabatan as profesi, dm_term.nama AS nama_status, sys_user_profile.gelar_depan, sys_user_profile.gelar_belakang, sys_grup_user.grup");
		$this->db->from($this->table);
		$this->db->join("pengembangan_pelatihan_detail", "$this->table.id = pengembangan_pelatihan_detail.pengembangan_pelatihan_id AND pengembangan_pelatihan_detail.statue = 0");
		$this->db->join("sys_user_profile", "pengembangan_pelatihan_detail.nopeg = sys_user_profile.id_user", "left");
		$this->db->join("m_kode_profesi_group", "sys_user_profile.kategori_profesi = m_kode_profesi_group.id", "left");
		$this->db->join("sys_user", "pengembangan_pelatihan_detail.nopeg = sys_user.id_user", "left");
		$this->db->join("sys_grup_user", "sys_user.id_grup = sys_grup_user.id_grup", "left");
		$this->db->join("dm_term", "pengembangan_pelatihan_detail.id = dm_term.id", "left");
		if (!empty($params_array) && is_array($params_array)) {
			$this->db->where($params_array);
		}
		if (!empty($where_in) && is_array($where_in)) {
           // debug($where_in);die;
            foreach ($where_in as $key => $value){
                $this->db->where_in($value["key"], $value["value_array"]);
            }
		}

		if (!empty($from)) {
			$this->db->where("pengembangan_pelatihan.created >=", $from);
		}

		if (!empty($to)) {
			$this->db->where("pengembangan_pelatihan.created <=", $to);
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
		//print_r($data);die();
		$this->db->where("id", $id);
		$result = $this->db->update($this->table, $data);

		if ($result) {
			$get = $this->get_all(array("$this->table.id" => $id, "pengembangan_pelatihan_detail.statue" => $item["statue"]));
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
			$get = $this->get_all(array("$this->table.id" => $id, "pengembangan_pelatihan_detail.statue" => $item["statue"]));
			if (count($get) >= 1) {
				return (Object)$get[0];
			}
			return $get;
		}
		return false;
	}
	
	function update_nopeg($table, $item, $id)
	{
		// default active = 1, 2 = done
        $this->_update();
        $item["statue"] = $item["statue"] ? $item["statue"] : 1;
        
        $data = array_merge(
            $item, $this->data
        );
		//print_r($data);die();
		$this->db->where("id", $id);
		$result = $this->db->update($table, $data);

		if ($result) {
			$get = $this->get_all(array("$table.id" => $id, "pengembangan_pelatihan_detail.statue" => $item["statue"]));
			if (count($get) == 1) {
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

	public function getjpl(){
		$this->db->select('id_grup');
		$this->db->where('tampilkan','1');
		$res = $this->db->get('jpl')->result();

		foreach ($res as $row){
            $data[] = $row->id_grup;
        }
		return $data;
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
		$result = $this->db->update("pengembangan_pelatihan_detail", array("statue" => 0));

			$get = $this->get_all(array("$this->table.id" => $id, "pengembangan_pelatihan_detail.statue" => $item["statue"]));
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
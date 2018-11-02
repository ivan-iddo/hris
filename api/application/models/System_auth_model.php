<?php

class System_auth_model extends CI_Model
{
    function loginCheck($username, $pass)
    {
        $sql = "select
		    a.username, a.id_user, a.`name`, a.email, a.id_aplikasi, a.kode_klinik, a.id_grup, a.id_uk
				,b.grup
				,c.aplikasi,
				sys_user_profile.NIP				
		from
		    sys_user a
		INNER JOIN 
				sys_grup_user b 
		ON
				a.id_grup=b.id_grup
				AND a.id_aplikasi=b.id_aplikasi
		INNER JOIN 
				sys_user_profile
		ON
				a.id_user=sys_user_profile.id_user
		INNER JOIN
				sys_mst_aplikasi c
		ON 
				c.id_aplikasi=a.id_aplikasi
		where
		    username='" . $username . "'
		    and password=MD5('" . $pass . "')
		and status='1'";
        $result = $this->db->query($sql);

        if ($result->num_rows() == 1) {
            $r = $result->row();

            $sessiondata = array(
                'id' => $r->id_user,
                'NIP' => $r->NIP,
                '_pnc_username' => $r->username,
                '_pnc_email' => $r->email,
                '_pnc_name' => $r->name,
                '_pnc_id_aplikasi' => $r->id_aplikasi,
                '_pnc_id_grup' => $r->id_grup,
                '_pnc_grup' => $r->grup,
                '_pnc_aplikasi' => $r->aplikasi,
                '_pnc_kode_klinik' => $r->kode_klinik,
                'id_uk' => $r->id_uk

            );
            //print_r($sessiondata); exit;
            //$_SESSION['userdata']= $sessiondata;

            return $sessiondata;
        } else {

            return false;
        }

    }

    function tree($jenis = "", $idaplikasi = "", $idgroup = "", $idmodul = "")
    {


        if ($jenis == 'modul') {
            $this->db->select('a.id_modul
						,b.modul
						,b.controller ');

            $this->db->join('sys_mst_modul as b', 'b.id_modul=a.id_modul');

            if (!empty($idaplikasi)) {
                $this->db->where('a.id_aplikasi', $idaplikasi);
            }
            if (!empty($idgroup)) {
                $this->db->where('a.id_group', $idgroup);
            }

            $this->db->where('b.id_aplikasi = a.id_aplikasi');

            $this->db->order_by('urutan', 'ASC');
            $this->db->group_by(' a.id_modul
						,b.modul
						,b.controller');
            return $this->db->get('sys_user_access as a')->result();


        }

        if ($jenis == 'menu') {
            $this->db->select('a.id_modul
						,b.modul
						,c.url,c.menu ');


            $this->db->join('sys_mst_modul b', "b.id_aplikasi=a.id_aplikasi 
										AND a.id_modul=b.id_modul 
										AND b.aktif='1'", "LEFT");
            $this->db->join('sys_mst_menu c', "c.id_aplikasi=a.id_aplikasi 
										AND c.id_modul=a.id_modul 
										AND c.id_menu=a.id_menu", "LEFT");

            if (!empty($idaplikasi)) {
                $this->db->where('a.id_aplikasi', $idaplikasi);
            }
            if (!empty($idgroup)) {
                $this->db->where('a.id_group', $idgroup);
            }

            if (!empty($idmodul)) {
                $this->db->where('a.id_modul', $idmodul);
            }


            $this->db->where('c.front', '1');
            $this->db->order_by('c.urutan', 'ASC');
            $this->db->group_by(' a.id_modul
						,b.modul
						,c.url,c.menu');
            return $this->db->get('sys_user_accesss a')->result();
        }


    }


    function getparent($id, $stop = 0)
    {

        $this->db->where('id_grup', $id);
        $dat = $this->db->get('sys_grup_user')->row();
        if ($dat->child == $stop) {
            return $dat->id_grup;
        } else {
            return $this->getparent($dat->child, $stop);
        }
    }


}


?>

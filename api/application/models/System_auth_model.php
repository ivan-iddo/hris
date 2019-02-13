<?php

require APPPATH . 'ParentChild.php';

class System_auth_model extends CI_Model
{
    function loginCheck($username, $pass)
    {
        $sql = "select
		    a.username
,a.id_user
				,a.name
		    ,a.email
		    ,a.id_aplikasi
				,a.kode_klinik
		    ,a.id_grup
				,b.grup
				,c.aplikasi,
				a.id_uk
				
		from
		    sys_user a
		INNER JOIN 
				sys_grup_user b 
		ON
				a.id_grup=b.id_grup
				AND a.id_aplikasi=b.id_aplikasi
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

        if (!empty($dat->child)) {
            if ($dat->child == $stop) {
                return $dat->id_grup;
            } 
            elseif (empty($dat->child)) {
                return $id;
            } 
            else {
                return $this->getparent($dat->child, $stop);
            }
        } 
        else {
            return $id;
        }
    }

    function full_copy($source, $target)
    {
        if (is_dir($source)) {
            @mkdir($target);
            $d = dir($source);
            while (FALSE !== ($entry = $d->read())) {
                if ($entry == '.' || $entry == '..') {
                    continue;
                }
                $Entry = $source . '/' . $entry;
                if (is_dir($Entry)) {
                    $this->full_copy($Entry, $target . '/' . $entry);
                    continue;
                }
                copy($Entry, $target . '/' . $entry);
            }

            $d->close();
        } else {
            copy($source, $target);
        }
    }

    function replace_string_in_file($filename, $string_to_replace, $replace_with)
    {
        $content = file_get_contents($filename);
        $str = str_replace($string_to_replace, $replace_with, $content);

        file_put_contents($filename, $str);
    }

    function getdatachild($id = 0)
    {   
        $this->load->database();
        $obj_parentchild = new ParentChild();

        $obj_parentchild->db_host = "localhost";
        $obj_parentchild->db_user = $this->db->username;
        $obj_parentchild->db_pass = $this->db->password;
        $obj_parentchild->db_database = $this->db->database;
        $obj_parentchild->db_port=$this->db->port;

        if (!$obj_parentchild->db_connect()) {
            echo "<h1>Sorry! Could not connect to the database server.</h1>";
            exit();
        }

        $obj_parentchild->db_table = "sys_grup_user";
        $obj_parentchild->item_identifier_field_name = "id_grup";
        $obj_parentchild->parent_identifier_field_name = "child";
        $obj_parentchild->item_list_field_name = "id_grup";

        $obj_parentchild->extra_condition = ""; //if required
        $obj_parentchild->order_by_phrase = " ORDER BY id_grup ";

        $obj_parentchild->level_identifier = "";
        $obj_parentchild->item_pointer = "";


        $root_item_id = $id;
        $all_childs = $obj_parentchild->getAllChilds($root_item_id);
        // print_r($all_childs);die();

        foreach ($all_childs as $chld) {
            $dataarr[] = trim($chld[$obj_parentchild->item_list_field_name]);

        }

        return $dataarr;
        // print_r($dataarr);die();
        //Getting the path of an item from the root : added on 18 january, 2011 : start
        //	echo "<p><b>Example : the full path for element q : </b></p>";
        $item_id = $id;
        $item_path_array = $obj_parentchild->getItemPath($item_id);
        //foreach ($item_path_array as $val) { echo $val['Name']."->"; }

        $obj_parentchild->db_disconnect();
    }


}


?>

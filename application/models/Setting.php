<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Model {

    public $table = 'settings';

    function __construct() {
        parent::__construct();
    }

    function get_all_record(){
        $query = $this->db->get($this->table);
        return $query;
    }

    function get_record($id){        
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query;
    }

    function deleted($id) {
        $this->db->query("DELETE FROM settings WHERE id = '".$id."'");
    }

    function get_val($key) {        
        $query = $this->db->get_where($this->table, array('key' => $key));
        if($query->num_rows()){
            $row = $query->row();
            return $row->val;
        }else{
            return false;
        }
    }

    function insert(){
        $data = array('key'=>$_POST['key'], 'val'=>$_POST['val'], 'ket' => $_POST['ket']);
        $this->db->trans_begin();
        $this->db->insert($this->table, $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return true;        
    }

    function update($id) {
        $data = array('key'=>$_POST['key'], 'val'=>$_POST['val'], 'ket' => $_POST['ket']);        
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return true;
    }

    function _exist_record($key, $val) {
        $rs = $this->where('key', $key)->where('val', $val)->cout();
        return $rs;
    }

    function get_exist_record_by_key(){
        $this->db->where('key', $_POST['key']);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0){
            $result = TRUE;
        }else{
            $result = FALSE;
        }
        return $result;
    }
}

?>

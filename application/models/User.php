<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Model {

    public $table = 'users';

    function __construct() {
        parent::__construct();
    }

    function get_all_record() {
        $query = $this->db->get($this->table);
        return $query;
    }

    function get_record($id) {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query;
    }

    function auth() {
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        $result = $this->db->get_where('users', array('username' => $username, 'password' => md5($password)));

        if ($result->num_rows() > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_records() {
        $query = $this->db->get_where($this->table, array('username' => $this->input->post('username'), 'password' => md5($this->input->post('password'))));
        return $query;
    }

    function insert($user_id) {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'fullname' => ucwords($this->input->post('fullname')),
            'status' => $this->input->post('status'),
            'user_id' => $user_id
        );

        $this->db->trans_begin();
        $this->db->insert($this->table, $data);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return true;
    }

    function update($id, $user_id) {
        $data = array(
            'username' => $_POST['username'],
            'password' => md5($_POST['password']),
            'fullname' => ucwords($_POST['fullname']),
            'status' => $_POST['status'],
            'user_id' => $user_id,
            'updated_at' => date('Y-m-d %h:%m:%s')
        );

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

    function get_count_all_usres() {
        $query = $this->db->count_all_results($this->table);
        return $query;
    }

    function get_exist_record_by_username(){
        $query = $this->db->get_where($this->table, array('username' => $this->input->post('username')));
        if($query->num_rows() > 0){
            $result = TRUE;
        }else{
            $result = FALSE;
        }
        return $result;
    }

    function del($id) {
        $this->db->trans_begin();
        $this->db->where('id', $id);
        $this->db->delete($this->table);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        return true;
    }

}

?>

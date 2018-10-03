<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Model {

  public $table = 'kelompok';

  function __construct() {
    parent::__construct();
  }

  function get_all_record(){
    $query = $this->db->get($this->table);
    return $query;
  }

  function get_record_by_id($id){
    $query = $this->db->get_where($this->table, array('id' => $id));
    return $query;
  }

  function get_all_record_drop() {
    $query = $this->db->get($this->table);
    foreach ($query->result() as $row) {
      $data[''] = '- BLANK -';
      $data[$row->id] = $row->ket;
    }
    return $data;
  }

  function insert(){
    $data = array(
      'ket' => $this->input->post('ket'),
      'user_id' => get_session_name('user_id')
    );

    $this->db->insert($this->table, $data);
  }

  function update($id){
    $data = array(
      'ket' => $this->input->post('ket'),
      'user_id' => get_session_name('user_id')
    );

    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
  }
}

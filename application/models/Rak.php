<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rak extends CI_Model {

  public $table = 'lemari';

  function __construct() {
    parent::__construct();
  }

  function get_all_record(){
    $query = $this->db->get($this->table);
    return $query;
  }

  function get_record_by_id($kode){
    $query = $this->db->get_where($this->table, array('kode' => $kode));
    return $query;
  }

  function get_all_record_drop() {
    $query = $this->db->get($this->table);
    foreach ($query->result() as $row) {
      $data[''] = '- BLANK -';
      $data[$row->kode] = $row->kode.' - '.$row->nama;
    }
    return $data;
  }

  function insert(){
    $data = array(
      'kode' => $this->input->post('kode'),
      'nama' => $this->input->post('nama'),
      'lokasi' => $this->input->post('lokasi'),
      'ruangan' => $this->input->post('ruangan'),
      'user_id' => get_session_name('user_id')
    );

    $this->db->insert($this->table, $data);
  }

  function update($id){
    $data = array(
      'kode' => $this->input->post('kode'),
      'nama' => $this->input->post('nama'),
      'lokasi' => $this->input->post('lokasi'),
      'ruangan' => $this->input->post('ruangan'),
      'user_id' => get_session_name('user_id')
    );

    $this->db->where('kode', $id);
    $this->db->update($this->table, $data);
  }

  function auto_number($var) {
    $Digit_Count = 3;
    $Parse = $var;
    $NOL = "0";
    $sql = $this->db->query("SELECT kode FROM lemari WHERE kode LIKE '$Parse%' ORDER BY kode DESC");
    $counter = 2;
    if ($sql->num_rows() == 0) {
      while ($counter < $Digit_Count) {
        $NOL = "0" . $NOL;
        $counter++;
      }
      return $Parse . $NOL . "1";
    } else {
      $R = $sql->row();
      $K = sprintf("%d", substr($R->kode, -$Digit_Count));
      $K = $K + 1;
      $L = $K;
      while (strlen($L) != $Digit_Count) {
        $L = $NOL . $L;
      }
      return $Parse . $L;
    }
  }

  function del($kode){
    $this->db->delete($this->table, array('kode' => $kode));
  }

}

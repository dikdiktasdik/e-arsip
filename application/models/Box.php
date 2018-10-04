<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Box extends CI_Model {

  public $table = 'kotak';

  function __construct() {
    parent::__construct();
  }

  function get_all_record(){
    //$query = $this->db->get($this->table);
    $query = $this->db->query("SELECT kotak.*, lemari.nama as nama_lemari FROM kotak, lemari WHERE lemari.kode = kotak.kode_lemari");
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
      'kode_lemari' => $this->input->post('kode_lemari'),
      'nama' => $this->input->post('nama')
    );

    $this->db->insert($this->table, $data);
  }

  function update($kode){
    $data = array(
      'kode' => $this->input->post('kode'),
      'kode_lemari' => $this->input->post('kode_lemari'),
      'nama' => $this->input->post('nama')
    );

    $this->db->where('kode', $kode);
    $this->db->update($this->table, $data);
  }

  function auto_number($var) {
    $Digit_Count = 4;
    $Parse = $var;
    $NOL = "0";
    $sql = $this->db->query("SELECT kode FROM kotak WHERE kode LIKE '$Parse%' ORDER BY kode DESC");
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
  function del($id){
    $this->db->delete($this->table, array('id' => $id));
  }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dokument extends CI_Model {

  public $table = 'dokuments';

  function __construct() {
    parent::__construct();
    date_default_timezone_set('Asia/Jakarta');
  }

  function get_all_record(){
    $query = $this->db->query("SELECT dokuments.*, kelompok.ket FROM dokuments, kelompok WHERE kelompok.id = dokuments.kelompok_id ORDER BY dokuments.tgl_surat DESC");
    return $query;
  }

  function search($q){
    $query = $this->db->like('title', $q)->get($this->table);
    return $query;
  }

  function get_count_all(){
    $query = $this->db->count_all_results($this->table);
    return $query;
  }

  function get_record_by_id($id){
    $query = $this->db->get_where($this->table, array('id' => $id));
    return $query;
  }

  function get_record($id){
    $query = $this->db->query("SELECT dokuments.*, kelompok.ket, lemari.nama as nama_lemari FROM dokuments, kelompok, lemari WHERE kelompok.id = dokuments.kelompok_id and lemari.kode = dokuments.kode_lemari and dokuments.id = '".$id."'");
    return $query;
  }

  function do_upload_and_insert() {
    $name_file = rand(0123456798, 987654321)."_".date('Ymd');
    //$file_type = $name_file . $_FILES['userfile']['type'];
    $file_ext = pathinfo($_FILES["userfile"]["name"], PATHINFO_EXTENSION);

    if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
      $config['file_name'] = $name_file;
      $config['upload_path'] = './assets/uploads/dokuments/';
      $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf|ppt|pptx|xls';
      $config['max_size'] = '5000000';
      $config['max_width'] = '50480';
      $config['max_height'] = '45360';
      $config['overwrite'] = TRUE;
      $this->load->library('upload', $config);
      $file_type = $name_file .".". $file_ext;

      if (!$this->upload->do_upload()) {
        $result = "Isi File Arsip yang sudah discan";
      } else {
        $data = array(
            'nomor' => $this->input->post('nomor'),
            'title' => $this->input->post('title'),
            'name_file' => $file_type,
            'jenis' => $this->input->post('jenis'),
            'kelompok_id' => $this->input->post('kelompok_id'),
            'kode_lemari' => $this->input->post('kode_lemari'),
            'kode_kotak' => $this->input->post('kode_kotak'),
            'deskripsi' => $this->input->post('deskripsi'),
            'tgl_surat' => $this->input->post('tgl_surat'),
            'user_id' => get_session_name('user_id')
          );
        $this->db->insert($this->table, $data);
        $result = "Arsip Berhasil disimpan";
      }
    } else {
      $result = "Isi File Arsip yang sudah discan";
    }
    return $result;
  }

  function update($id){
    $data = array(
      'nomor' => $this->input->post('nomor'),
      'title' => $this->input->post('title'),
      'user_id' => get_session_name('user_id')
    );

    $this->db->where('id', $id);
    $this->db->update($this->table, $data);
  }

  function deleted($id) {
      $query = $this->get_record_by_id($id);
      $row = $query->row();
      unlink('./assets/uploads/dokuments/' . $row->name_file);
      $this->db->delete($this->table, array('id' => $id));
      return true;
  }
}

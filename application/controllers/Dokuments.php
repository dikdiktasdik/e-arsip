<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokuments extends CI_Controller {

  function __construct(){
    parent::__construct();

    set_time_limit(0);
    ini_set('post_max_size', '512M');
    ini_set('upload_max_filesize', '512M');
    ini_set('memory_limit', '512M');
    date_default_timezone_set('Asia/Jakarta');

    redirect_logged_in();

    $this->load->model('Dokument');
    $this->load->model('Kelompok');
    $this->load->model('Lemari');
    $this->load->model('Box');
    $this->load->helper('download');
  }

  function index(){
    if($this->input->get('q')){
      $data['dokuments'] = $this->Dokument->search($this->input->get('q'));
    }else{
      $data['dokuments'] = $this->Dokument->get_all_record();
    }

    $this->load->view('dokuments/index', $data);
  }

  function add(){
    $options1 = $this->Kelompok->get_all_record_drop();
    $options2 = $this->Rak->get_all_record_drop();
    $options3 = $this->Box->get_all_record_drop();

    $jenis = array('MASUK' => 'MASUK', 'KELUAR' => 'KELUAR');

    $data['form_action'] = site_url('dokuments/save/');
    $data['nomor'] = array('name' => 'nomor', 'class' => 'form-control', 'required' => 'required');
    $data['title'] = array('name' => 'title', 'class' => 'form-control', 'required' => 'required');
    $data['deskripsi'] = array('name' => 'deskripsi', 'class' => 'form-control');
    $data['jenis'] = form_dropdown('jenis', $jenis, '', array('class' => 'form-control select2', 'required' => 'required'));
    $data['kelompok_id'] = form_dropdown('kelompok_id', $options1, '', array('class' => 'form-control select2', 'required' => 'required'));
    $data['kode_lemari'] = form_dropdown('kode_lemari', $options2, '', array('class' => 'form-control select2', 'required' => 'required'));
    $data['kode_kotak'] = form_dropdown('kode_kotak', $options3, '', array('class' => 'form-control select2', 'required' => 'required'));
    $data['tgl_surat'] = array('name' => 'tgl_surat', 'class' => 'form-control','value' => date('Y-m-d'), 'required' => 'required', 'id' => 'tgl_surat');

    $this->load->view('dokuments/form', $data);
  }

  function save(){
    $result = $this->Dokument->do_upload_and_insert();
    message_dialog('success', 'Sukses!', $result);
    redirect('dokuments/add');
  }

  function edit($id){
    $query = $this->Dokument->get_record_by_id($id);
    $row = $query->row();

    $data['form_action'] = site_url('categories/update/'.$id);
    $data['title'] = array('name' => 'title', 'class' => 'form-control', 'required' => 'required', 'value' => $row->title);

    $this->load->view('categories/form', $data);
  }

  function download($id){
    $query = $this->Dokument->get_record_by_id($id);
    $row = $query->row();

    force_download('./assets/uploads/dokuments/'.$row->name_file, NULL);
  }

  function hapus($id){
    $this->Dokument->deleted($id);
    message_dialog('success', 'Sukses!', 'Data Berhasil dihapus.');
    redirect('dokuments');
  }

  function chart(){
    $this->load->view('dokuments/chart');
  }

  function get_load_data() {
    $reminder = array();
    $query = $this->db->query("SELECT id, COUNT( tgl_surat ) AS jml FROM  `dokuments` GROUP BY tgl_surat");
    foreach ($query->result() as $row) {
      $reminder[] = array("x" => $row->id, "y" => $row->jml);
      //array_push($dataPoints, array("x"=> $row->id, "y"=> $row->jml));
    }
    echo json_encode($reminder, JSON_NUMERIC_CHECK);
  }
}

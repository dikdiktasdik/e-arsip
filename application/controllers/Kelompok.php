<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompok extends CI_Controller {

  function __construct(){
    parent::__construct();
    redirect_logged_in();
    redirect_logged_without_admin();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Group');
  }

  function index(){
    $data['boxs'] = $this->Group->get_all_record();
    $this->load->view('kelompok/index', $data);
  }

  function tambah(){
    $data['form_action'] = site_url('kelompok/simpan/');
    $data['ket'] = array('name' => 'ket', 'class' => 'form-control', 'required' => 'required');

    $this->load->view('kelompok/form', $data);
  }

  function simpan(){
    $this->Group->insert();
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_INSERT_DATA'));
    redirect('kelompok');
  }

  function edit($id){
    $query = $this->Group->get_record_by_id($id);
    $row = $query->row();

    $options = $this->Group->get_all_record_drop();
    $data['form_action'] = site_url('kelompok/update/'.$id);
    $data['ket'] = array('name' => 'ket', 'value' => $row->ket, 'class' => 'form-control', 'required' => 'required');
    
    $this->load->view('kelompok/form', $data);
  }

  function update($id){
    $this->Group->update($id);
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_UPDATE_DATA'));
    redirect('kelompok');
  }

  function hapus($id){
    $this->Group->del($id);
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_DELETE_DATA'));
    redirect('kelompok');
  }


}

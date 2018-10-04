<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kotak extends CI_Controller {

  function __construct(){
    parent::__construct();
    redirect_logged_in();
    redirect_logged_without_admin();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Box');
    $this->load->model('Rak');
  }

  function index(){
    $data['boxs'] = $this->Box->get_all_record();
    $this->load->view('kotak/index', $data);
  }

  function tambah(){
    $data['form_action'] = site_url('kotak/simpan/');
    $options = $this->Rak->get_all_record_drop();
    $data['kode'] = array('name' => 'kode', 'value' => $this->Box->auto_number('BX'),  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['kode_lemari'] = form_dropdown('kode_lemari', $options, '', array('class' => 'form-control select2', 'required' => 'required'));
    $data['nama'] = array('name' => 'nama', 'class' => 'form-control', 'required' => 'required');

    $this->load->view('kotak/form', $data);
  }

  function simpan(){
    $this->Box->insert();
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_INSERT_DATA'));
    redirect('kotak');
  }

  function edit($kode){
    $query = $this->Box->get_record_by_id($kode);
    $row = $query->row();

    $options = $this->Rak->get_all_record_drop();
    $data['form_action'] = site_url('kotak/update/'.$kode);
    $data['kode'] = array('name' => 'kode', 'value' => $row->kode,  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['kode_lemari'] = form_dropdown('kode_lemari', $options, $row->kode_lemari, array('class' => 'form-control select2', 'required' => 'required'));
    $data['nama'] = array('name' => 'nama', 'value' => $row->nama, 'class' => 'form-control', 'required' => 'required');

    $this->load->view('kotak/form', $data);
  }

  function update($id){
    $this->Box->update($id);
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_UPDATE_DATA'));
    redirect('kotak');
  }
  
  function hapus($id){
    $this->Box->update($id);
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_DELETE_DATA'));
    redirect('kotak');
  }


}

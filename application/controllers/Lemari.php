<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lemari extends CI_Controller {

  function __construct(){
    parent::__construct();
    redirect_logged_in();
    redirect_logged_without_admin();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('Rak');
  }

  function index(){
    $data['lemaris'] = $this->Rak->get_all_record();
    $this->load->view('lemari/index', $data);
  }

  function tambah(){
    $data['form_action'] = site_url('lemari/simpan/');
    $data['kode'] = array('name' => 'kode', 'value' => $this->Rak->auto_number('LR'),  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['nama'] = array('name' => 'nama', 'class' => 'form-control', 'required' => 'required');
    $data['lokasi'] = array('name' => 'lokasi', 'class' => 'form-control', 'required' => 'required');
    $data['ruangan'] = array('name' => 'ruangan', 'class' => 'form-control', 'required' => 'required');

    $this->load->view('lemari/form', $data);
  }

  function simpan(){
    $this->Rak->insert();
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_INSERT_DATA'));
    redirect('lemari');
  }

  function edit($kode){
    $query = $this->Rak->get_record_by_id($kode);
    $row = $query->row();

    $data['form_action'] = site_url('lemari/update/'.$kode);
    $data['kode'] = array('name' => 'kode', 'value' => $row->kode,  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['nama'] = array('name' => 'nama', 'value' => $row->nama, 'class' => 'form-control', 'required' => 'required');
    $data['lokasi'] = array('name' => 'lokasi', 'value' => $row->lokasi, 'class' => 'form-control', 'required' => 'required');
    $data['ruangan'] = array('name' => 'ruangan', 'value' => $row->ruangan, 'class' => 'form-control', 'required' => 'required');

    $this->load->view('lemari/form', $data);
  }

  function update($kode){
    $this->Rak->update($kode);
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_UPDATE_DATA'));
    redirect('lemari');
  }

  function hapus($kode){
    $this->Rak->del($kode);
    message_dialog('success', 'Sukses!', get_val_setting('PESAN_DELETE_DATA'));
    redirect('lemari');
  }


}

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

  function add(){
    $data['form_action'] = site_url('lemari/save/');
    $data['kode'] = array('name' => 'kode', 'value' => $this->lemari->auto_number('LR'),  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['nama'] = array('name' => 'nama', 'class' => 'form-control', 'required' => 'required');
    $data['lokasi'] = array('name' => 'lokasi', 'class' => 'form-control', 'required' => 'required');
    $data['ruangan'] = array('name' => 'ruangan', 'class' => 'form-control', 'required' => 'required');

    $this->load->view('lemari/form', $data);
  }

  function save(){
    $this->Rak->insert();
    redirect('lemari');
  }

  function edit($kode){
    $query = $this->Rak->get_record_by_id($kode);
    $row = $query->row();

    $data['form_action'] = site_url('lemari/update/'.$id);
    $data['kode'] = array('name' => 'kode', 'value' => $row->kode,  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['nama'] = array('name' => 'nama', 'value' => $row->nama, 'class' => 'form-control', 'required' => 'required');
    $data['lokasi'] = array('name' => 'lokasi', 'value' => $row->lokasi, 'class' => 'form-control', 'required' => 'required');
    $data['ruangan'] = array('name' => 'ruangan', 'value' => $row->ruangan, 'class' => 'form-control', 'required' => 'required');

    $this->load->view('lemari/form', $data);
  }

  function update($id){
    $this->Rak->update($id);
    redirect('lemari');
  }


}

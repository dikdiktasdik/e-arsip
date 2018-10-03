<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kotak extends CI_Controller {

  function __construct(){
    parent::__construct();
    redirect_logged_in();
    redirect_logged_without_admin();
    date_default_timezone_set('Asia/Jakarta');
    $this->load->model('box');
    $this->load->model('cupboard');
  }

  function index(){
    $data['boxs'] = $this->box->get_all_record();
    $this->load->view('kotak/index', $data);
  }

  function add(){
    $data['form_action'] = site_url('kotak/save/');
    $options = $this->cupboard->get_all_record_drop();
    $data['kode'] = array('name' => 'kode', 'value' => $this->box->auto_number('BX'),  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['kode_lemari'] = form_dropdown('kode_lemari', $options, '', array('class' => 'form-control select2', 'required' => 'required'));
    $data['nama'] = array('name' => 'nama', 'class' => 'form-control', 'required' => 'required');

    $this->load->view('kotak/form', $data);
  }

  function save(){
    $this->box->insert();
    redirect('kotak');
  }

  function edit($kode){
    $query = $this->box->get_record_by_id($kode);
    $row = $query->row();

    $options = $this->cupboard->get_all_record_drop();
    $data['form_action'] = site_url('kotak/update/'.$kode);
    $data['kode'] = array('name' => 'kode', 'value' => $row->kode,  'class' => 'form-control', 'required' => 'required', 'readonly' => 'readonly');
    $data['kode_lemari'] = form_dropdown('kode_lemari', $options, $row->kode_lemari, array('class' => 'form-control select2', 'required' => 'required'));
    $data['nama'] = array('name' => 'nama', 'value' => $row->nama, 'class' => 'form-control', 'required' => 'required');

    $this->load->view('kotak/form', $data);
  }

  function update($id){
    $this->box->update($id);
    redirect('kotak');
  }


}

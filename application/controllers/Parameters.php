<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parameters extends CI_Controller {

    function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        redirect_logged_in();
        redirect_logged_without_admin();
        $this->load->model('Setting');
    }

    function index() {
        $data['title'] = '';
        $data['query'] = $this->Setting->get_all_record();
        $this->load->view('parameters/index', $data);
    }

    function tambah() {
        $data['form_action'] = site_url('parameters/simpan/');
        $data['key'] = array('name' => 'key', 'class' => 'form-control', 'type' => 'text', 'required' => 'required');
        $data['val'] = array('name' => 'val', 'class' => 'form-control', 'type' => 'text', 'required' => 'required', 'rows' => '5');
        $data['ket'] = array('name' => 'ket', 'class' => 'form-control', 'type' => 'text', 'required' => 'required', 'rows' => '5');
        $this->load->view('parameters/form', $data);
    }

    function edit($id) {
        $query = $this->Setting->get_record($id);
        $row = $query->row();
        $data['form_action'] = site_url('parameters/update/' . $id);
        $data['key'] = array('name' => 'key', 'class' => 'form-control', 'type' => 'text', 'rows' => '5', 'value' => $row->key);
        $data['val'] = array('name' => 'val', 'class' => 'form-control', 'type' => 'text', 'rows' => '5', 'value' => $row->val);
        $data['ket'] = array('name' => 'ket', 'class' => 'form-control', 'type' => 'text', 'rows' => '5', 'value' => $row->ket);
        $this->load->view('parameters/form', $data);
    }

    function update($id) {
        $this->Setting->update($id);        
        message_dialog('success', 'Sukses!', get_val_setting('PESAN_UPDATE_DATA'));
        redirect('parameters');
    }

    function simpan() {
        if(!$this->Setting->get_exist_record_by_key()){
            $this->Setting->insert();
            message_dialog('success', 'Sukses!', get_val_setting('PESAN_INSERT_DATA'));
            redirect('parameters');
        }else{
            message_dialog('danger', 'Error!', get_val_setting('PESAN_DOUBLE_DATA'));
            redirect('parameters/tambah');
        }
    }

    function delete($id) {
        $this->Setting->deleted($id);
        message_dialog('success', 'Sukses!', 'Data Berhasil dihapus.');
        redirect('parameters');
    }
}

?>

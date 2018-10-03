<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    var $user_id;

    function __construct() {
        parent::__construct();
        $this->load->model('User');
        $this->load->helper('captcha');
        $this->user_id = get_session_name('user_id');
    }

    function index() {
      redirect_logged_in();
      redirect_logged_without_admin();

        $data['title'] = '';
        $data['query'] = $this->user->get_all_record();
        $this->load->view('users/index', $data);
    }

    function tambah() {
      redirect_logged_in();
      redirect_logged_without_admin();

        $options = $data = array(
            '3' => 'Adm Karyawan',
            '2' => 'Adm Gaji',
            '1' => 'Administrator'
            );

        $data['form_action'] = site_url('users/save/');
        $data['username'] = array('name' => 'username', 'class' => 'form-control', 'required' => 'required');
        $data['password'] = array('name' => 'password', 'class' => 'form-control', 'id' => 'password1', 'required' => 'required');
        $data['re_password'] = array('name' => 're_password', 'class' => 'form-control', 'id' => 'password2', 'required' => 'required');
        $data['fullname'] = array('name' => 'fullname', 'class' => 'form-control', 'required' => 'required');
        $data['status'] = form_dropdown('status', $options, '', array('class' => 'form-control', 'required' => 'required'));

        $data['create'] = array('name' => 'create', 'checked' => false, 'value' => '1');
        $data['read'] = array('name' => 'read', 'checked' => false, 'value' => '1');
        $data['update'] = array('name' => 'update', 'checked' => false, 'value' => '1');
        $data['delete'] = array('name' => 'delete', 'checked' => false, 'value' => '1');

        $this->load->view('users/frm_tambah', $data);
    }

    function edit($id) {
      redirect_logged_in();
      redirect_logged_without_admin();

        $options = $data = array('2' => 'USER', '1' => 'ADMINISTRATOR');

        $query = $this->user->get_record($id);
        $row = $query->row();
        $data['form_action'] = site_url('users/update/'.$id);
        $data['username'] = array('name' => 'username', 'class' => 'form-control', 'required' => 'required', 'value' => $row->username);
        $data['password'] = array('name' => 'password', 'class' => 'form-control', 'id' => 'password1', 'required' => 'required');
        $data['re_password'] = array('name' => 're_password', 'class' => 'form-control', 'id' => 'password2', 'required' => 'required');
        $data['fullname'] = array('name' => 'fullname', 'class' => 'form-control', 'required' => 'required', 'value' => $row->fullname);
        $data['status'] = form_dropdown('status', $options, $row->status, array('class' => 'form-control', 'required' => 'required'));

        $data['create'] = array('name' => 'create', 'checked' => $row->create=='1' ? true : false, 'value' => '1');
        $data['read'] = array('name' => 'read', 'checked' => $row->read=='1' ? true : false, 'value' => '1');
        $data['update'] = array('name' => 'update', 'checked' => $row->update=='1' ? true : false, 'value' => '1');
        $data['delete'] = array('name' => 'delete', 'checked' => $row->delete=='1' ? true : false, 'value' => '1');
        $this->load->view('users/frm_tambah', $data);
    }

    function update($id) {
        $this->user->update($id, $this->user_id);
        redirect('users');
    }

    function save() {
        if(!$this->user->get_exist_record_by_username()){
            $this->user->insert($this->user_id);
            message_dialog('success', 'Sukses!', 'Data Berhasil disimpan.');
            redirect('users');
        }else{
            $this->libs->message_dialog('danger', 'Error!', 'Data Sudah terdaftar.');
            redirect('users/tambah');
        }
    }

    function hapus($id) {
        $this->user->del($id);
        message_dialog('success', 'Sukses!', 'Data Berhasil dihapus.');
        redirect('users');
    }

    function login() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_authentication');

        if ($this->form_validation->run() == false){
              // numeric random number for captcha
              $random_number = substr(number_format(time() * rand(),0,'',''),0,6);
              // setting up captcha config
              $vals = array(
                     'word' => $random_number,
                     'img_path' => './assets/captcha/',
                     'img_url' => base_url().'assets/captcha/',
                     'img_width' => 140,
                     'img_height' => 32,
                     'expiration' => 7200
                    );
              $data['captcha'] = create_captcha($vals);
              $this->session->set_userdata('captchaWord',$data['captcha']['word']);
              //$this->load->view('captcha', $data);
              $this->load->view('login', $data);
            }
            else {
              // do your stuff here.
              echo 'I m here clered all validations';
        }
    }

    function authentication() {
        $result = $this->user->auth();
        if($this->check_captcha($_POST['userCaptcha'])){
            if ($result) {
                $sess_array = array();
                foreach ($result as $row) {
                    $sess_array = array(
                        'user_id' => $row->id,
                        'username' => $row->username,
                        'fullname' => $row->fullname,
                        'member_since' => $row->created_at,
                        'status' => $row->status,
                        'login_date' => date('Y-m-d')
                    );
                    $this->session->set_userdata('logged_in', $sess_array);
                }
                //jika admin redirect ke halama  welcome jika user langsung ke arsip
                $row->status == 1 ? redirect('welcome') : redirect('arsips');
            } else {
                message_dialog('danger', 'Error!', 'username atau password yang diasukan salah.');
                redirect('login');
            }
        }else{

        }
    }

    function logout() {
        $this->session->unset_userdata('logged_in');
        session_destroy();
        redirect('login', 'refresh');
    }

    function check_captcha($str){
        $word = $this->session->userdata('captchaWord');
        if(strcmp(strtoupper($str),strtoupper($word)) == 0){
          return true;
        }
        else{
            message_dialog('danger', 'Error!', 'Kode varifikasi yang dimasukin tidak sama.');
            redirect('login');
        }
    }
}

?>

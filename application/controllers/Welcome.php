<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    function __construct() {
        parent::__construct();
        set_time_limit(0);
        date_default_timezone_set('Asia/Jakarta');
        //redirect_logged_in();
    }

    function index() {
        $this->load->view('welcome_message');
    }

    function cpu_traffic() {
        echo implode(' ', get_server_load()) . ' <small>%</small>';
    }
}

<?php

function get_header() {
    $ci = &get_instance();
    return $ci->load->view("header");
}

function left_menu() {
    $ci = &get_instance();
    $html = $ci->load->view("left_menu");
    return $html;
}

function get_session_name($field) {
    $ci = &get_instance();
    $sess_data = $ci->session->userdata('logged_in');
    return $sess_data[$field];
}

function redirect_logged_in() {
    $ci = &get_instance();
    $ci->session->userdata('logged_in') == true ? '' : redirect('login');
}

function redirect_logged_without_admin() {
    $ci = &get_instance();
    get_session_name('status') <> 1 ? redirect('welcome') : false;
}

function show_messaga_dialog() {
    $ci = &get_instance();
    return $ci->session->flashdata('message_dialog');
}

function message_dialog($class_css, $title_msg, $msg_text) {
    $ci = &get_instance();
    $html = '<div class="callout callout-' . $class_css . ' lead message_dialog">
                <h4>' . $title_msg . '!</h4>
                <p>' . $msg_text . '.</p>
              </div>';
    $data = $ci->session->set_flashdata('message_dialog', $html);
    return $data;
}

function replace($search, $subject) {
    $str = str_replace($search, '', $subject);
    return $str;
}

function get_val_setting($key) {
    $ci = &get_instance();
    $ci->load->model('setting');
    $query = $ci->setting->get_val($key);
    return $query;
}

function member_since() {
    $tgl = date(get_session_name('member_since'), 'Y-m-d');
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return 'Member since ' . $bulan . '. ' . $tahun;
}

function cari_nama_hari($hari) {
    // cari_nama_hari(date('W', strtotime(tanggal($trow->Masuk))));
    $data = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu");
    return $data[$hari];
}

function get_name_controller() {
    $ci = &get_instance();
    return $ci->router->fetch_method();
}

function time_elapsed_string($datetime, $full = false) {
    $today = time();
    $createdday = strtotime($datetime);
    $datediff = abs($today - $createdday);
    $difftext = "";
    $years = floor($datediff / (365 * 60 * 60 * 24));
    $months = floor(($datediff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
    $days = floor(($datediff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
    $hours = floor($datediff / 3600);
    $minutes = floor($datediff / 60);
    $seconds = floor($datediff);
    //year checker
    if ($difftext == "") {
        if ($years > 1)
            $difftext = $years . " years ago";
        elseif ($years == 1)
            $difftext = $years . " year ago";
    }
    //month checker
    if ($difftext == "") {
        if ($months > 1)
            $difftext = $months . " months ago";
        elseif ($months == 1)
            $difftext = $months . " month ago";
    }
    //month checker
    if ($difftext == "") {
        if ($days > 1)
            $difftext = $days . " days ago";
        elseif ($days == 1)
            $difftext = $days . " day ago";
    }
    //hour checker
    if ($difftext == "") {
        if ($hours > 1)
            $difftext = $hours . " hours ago";
        elseif ($hours == 1)
            $difftext = $hours . " hour ago";
    }
    //minutes checker
    if ($difftext == "") {
        if ($minutes > 1)
            $difftext = $minutes . " minutes ago";
        elseif ($minutes == 1)
            $difftext = $minutes . " minute ago";
    }
    //seconds checker
    if ($difftext == "") {
        if ($seconds > 1)
            $difftext = $seconds . " seconds ago";
        elseif ($seconds == 1)
            $difftext = $seconds . " second ago";
    }
    return $difftext;
}

function get_name_category($id) {
    $CI = &get_instance();

    $CI->load->model('category');
    $query = $CI->category->get_record_by_id($id);
    $row = $query->row();

    return $row->title;
}

function get_name_type($id) {
    $CI = &get_instance();

    $CI->load->model('type');
    $query = $CI->type->get_record_by_id($id);
    $row = $query->row();

    return $row->title;
}

function count_tasks_due_date() {
    $CI = &get_instance();
    $CI->load->model('task');
    $result = $CI->task->due_date();
    return $result;
}

function count_devices() {
    $CI = &get_instance();
    $CI->load->model('device');
    $result = $CI->device->count_devices();
    return $result;
}

function count_arsip() {
    $CI = &get_instance();
    $CI->load->model('arsip');
    $result = $CI->arsip->get_count_all();
    return $result;
}

function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
    // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
    $BulanIndo = array("Januari", "Februari", "Maret",
        "April", "Mei", "Juni",
        "Juli", "Agustus", "September",
        "Oktober", "November", "Desember");

    $tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
    $bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
    $tgl = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring

    $result = $BulanIndo[(int) $bulan - 1] . ", " . $tgl . " " . $tahun;
    return($result);
}

function get_server_load() {
    $load = array();
    if (stristr(PHP_OS, 'win')) {
        $wmi = new COM("Winmgmts://");
        $server = $wmi->execquery("SELECT LoadPercentage FROM Win32_Processor");
        $cpu_num = 0;
        $load_total = 0;
        foreach ($server as $cpu) {
            $cpu_num++;
            $load_total += $cpu->loadpercentage;
        }

        $load[] = round($load_total / $cpu_num);
    } else {
        $load = sys_getloadavg();
    }
    return $load;
}

function GenerateQRCode($data, $size) {
    $CI = &get_instance();
    $CI->load->library('ciqrcode');

    $params['data'] = $data;
    $params['level'] = 'H';
    $params['size'] = $size;
    $params['savename'] = 'assets/devices/' . $data . '.png';
    $CI->ciqrcode->generate($params);

    return '<img src="' . base_url('assets/devices/' . $data . '.png') . '" />';
}

function rupiah($var = '') {
    $x = number_format($var, 0, ",", ".");
    return $x;
}

/* HELPER SLIK */
function count_debitur(){
    $CI = &get_instance();
    $CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db2->query('SELECT COUNT(*) AS TOTAL FROM nasabah, kredit where nasabah.nasabah_id = kredit.nasabah_id and nasabah.tgl_register >= 20170601 and kredit.pokok_saldo_akhir <> 0');
    $row = $query->row();
    return $row->TOTAL;
}

function Realisasi_Kredit(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query('SELECT COUNT(*) AS JML_DEBITUR, SUM(pokok) AS  TOTAL_POKOK FROM kretrans '
            . 'WHERE tgl_trans between 20170601 AND 20170630 AND FLOOR(my_kode_trans/100)=1 AND pokok > 0');
    $row = $query->row();
    return array($row->JML_DEBITUR, $row->TOTAL_POKOK);
}

function Kredit_Aktif(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query('SELECT COUNT(*) AS JML_DEBITUR, SUM(baki_debet) AS TOTAL_POKOK FROM kredit_170630');
    $row = $query->row();
    return array($row->JML_DEBITUR, $row->TOTAL_POKOK);
}

function Debius(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query('SELECT COUNT(NO_REKENING) AS JML_DEBITUR, SUM(jml_debius) AS TOTAL_DEBIUS FROM debius_170630');
    $row = $query->row();
    return array($row->JML_DEBITUR, $row->TOTAL_DEBIUS);
}

function Pelunasan_Kredit(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query("select COUNT(no_rekening) as JML_DEBITUR, SUM(pokok) as TOTAL_POKOK
                                from kretrans
                                where tgl_trans>=20170601
                                and tgl_trans<=20170630
                                and floor(my_kode_trans/100)=3
                                and pelunasan='Y'");
    $row = $query->row();
    return array($row->JML_DEBITUR, $row->TOTAL_POKOK);
}

function Agunan_Baru(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query("select count(no_rekening_agunan) as TOTAL from
                            kre_agunan, kredit_170630, kredit where kredit_170630.no_rekening = kre_agunan.no_rekening_agunan
                            and kredit.no_rekening = kredit_170630.no_rekening and kredit.jenis_agunan <> 8
                            and kredit.tgl_realisasi between 20170601 and 20170630");
    $row = $query->row();
    return $row->TOTAL;
}

function Agunan_F01_Lunas(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query("select COUNT(kre_agunan.no_rekening_agunan) as TOTAL from kretrans, kre_agunan where kretrans.tgl_trans>=20170601 and kretrans.tgl_trans<=20170630 and floor(kretrans.my_kode_trans/100)=3 and kretrans.pelunasan='Y' and kre_agunan.no_rekening_agunan = kretrans.no_rekening");
    $row = $query->row();
    return $row->TOTAL;
}

function Agunan_Status_Update(){
    $CI = &get_instance();
    //$CI->db2 = $CI->load->database('db_ussi', TRUE);

    $query = $CI->db->query("SELECT COUNT(kredit_170630.no_rekening) AS TOTAL FROM kredit_170630, kre_agunan where kredit_170630.no_rekening = kre_agunan.no_rekening_agunan and kredit_170630.baki_debet = kredit_170630.jml_pinjaman_eff");
    $row = $query->row();
    return $row->TOTAL;
}


?>

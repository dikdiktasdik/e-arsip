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

function count_arsip() {
  $CI = &get_instance();
  $CI->load->model('Dokument');
  $result = $CI->Dokument->get_count_all();
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
?>

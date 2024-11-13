<?php
    session_cache_expire(0);
    session_cache_limiter(0);
    session_start();
    set_time_limit(0);
    date_default_timezone_set('Asia/Jakarta');
    (isset($_SESSION['id_user'])) ? $id_user = $_SESSION['id_user'] : $id_user = 0;

    $uri = $_SERVER['REQUEST_URI'];
    $pageurl = explode("/", $uri);
    if ($uri == '/') {
        $homeurl = "http://" . $_SERVER['HTTP_HOST'];
        (isset($pageurl[1])) ? $pg = $pageurl[1] : $pg = '';
        (isset($pageurl[2])) ? $ac = $pageurl[2] : $ac = '';
        (isset($pageurl[3])) ? $id = $pageurl[3] : $id = 0;
    } else {
        $homeurl = "http://" . $_SERVER['HTTP_HOST'] . "/" . $pageurl[1];
        (isset($pageurl[2])) ? $pg = $pageurl[2] : $pg = '';
        (isset($pageurl[3])) ? $ac = $pageurl[3] : $ac = '';
        (isset($pageurl[4])) ? $id = $pageurl[4] : $id = 0;
    }

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $debe = 'ilearning';

    // Membuat koneksi ke database menggunakan mysqli_connect
    $conn = mysqli_connect($host, $user, $pass, $debe) or die(mysqli_error());


    $no = $jam = $mnt = $dtk = 0;
    $info = '';
    $waktu = date('H:i:s');
    $tanggal = date('Y-m-d');
    $datetime = date('Y-m-d H:i:s');

    // Menggunakan koneksi baru $conn di fungsi mysqli_query dan mysqli_fetch_array
    $setting = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM setting WHERE id_setting='1'"));
    $sess = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM session WHERE id='1'"));
?>

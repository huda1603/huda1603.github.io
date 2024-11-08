<?php
    require "koneksi.php";
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $webinar_id = $_POST['webinar_id'];
        header("Location: lihat_lengkap.php?id_webinar=$webinar_id");
        exit;
    }
?>
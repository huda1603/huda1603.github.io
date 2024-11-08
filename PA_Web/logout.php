<?php
    $file = 'simpan_url.txt';
    file_put_contents($file, '');
    $handle = fopen($file, 'w');
    fclose($handle);
    session_start();
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
?>
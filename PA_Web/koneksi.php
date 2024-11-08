<?php
    $conn = mysqli_connect('localhost', 'root', '', 'db_info_webinar');
    if (!$conn) {
        die("Gagal Terhubung Database" . mysqli_connect_error());
    }
?>
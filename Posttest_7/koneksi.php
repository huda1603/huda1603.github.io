<?php
    $conn = mysqli_connect('localhost', 'root', '', 'dbformkursus');
    if (!$conn) {
        die("Gagal Terhubung Database" . mysqli_connect_error());
    }
?>
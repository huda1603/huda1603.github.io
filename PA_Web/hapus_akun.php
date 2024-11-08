<?php
    require "koneksi.php";

    if(isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];
    }

    $result = mysqli_query($conn, "DELETE FROM user WHERE id_user=$id_user");
    echo "
        <script>
            alert('Berhasil Menghapus Akun');
        </script>";
    $file = 'simpan_url.txt';
    file_put_contents($file, '');
    $handle = fopen($file, 'w');
    fclose($handle);
    header('Location: login.php');
    exit;

?>
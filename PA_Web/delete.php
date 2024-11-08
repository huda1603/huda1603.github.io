<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!==true || $_SESSION['role']!=='user') {
        header('Location: login.php');
        exit;
    }

    if (isset($_GET['id_webinar']) ? $_GET['id_webinar'] : '') {
        if (file_exists('simpan_url.txt')) {
            $lines = file('simpan_url.txt');
            $first = trim($lines[0]);
            $url_components = parse_url($first);
            parse_str($url_components['query'], $params);
        }
        $id_webinar = $_GET['id_webinar'];
        $result = mysqli_query($conn, "SELECT*FROM webinar WHERE id_webinar='$id_webinar'");

        $webinar = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $webinar[] = $row;
        }
        
        unlink('gambar/' . $webinar[0]['foto_webinar']);
        $sql = mysqli_query($conn, "DELETE FROM webinar WHERE id_webinar='$id_webinar'");

        if ($result) {
            echo "
                <script>
                    alert('Berhasil Menghapus Data!');
                    document.location.href = 'index.php?id_user=" . htmlspecialchars($params['id_user']) . "';
                </script>";
        } else {
            echo "
                <script>
                    alert('Gagal Menghapus Data!');
                </script>";
        }
    } else {
        header("Location: index.php?id_user=" . htmlspecialchars($params['id_user']));
    }
?>
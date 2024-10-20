<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!==true || $_SESSION['posisi']!=='admin') {
        header('Location: index.php');
        exit;
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = mysqli_query($conn, "SELECT * FROM pengguna WHERE id_pengguna=$id");
        $hasil_pendaftaran = [];
        while ($row = mysqli_fetch_assoc($query)) {
            $hasil_pendaftaran[] = $row;
        }
        
        unlink('gambar/' . $hasil_pendaftaran[0]['foto_pengguna']);

        $sql = "DELETE FROM pengguna WHERE id_pengguna=$id";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "
                <script>
                    alert('Berhasil Menghapus Data!');
                    document.location.href = 'lihatdata.php';
                </script>";
        } else {
            echo "
                <script>
                    alert('Gagal Menghapus Data!');
                </script>";
        }
    } else {
    // Redirect jika tidak ada ID
        header("Location: lihatdata.php");
    }
?>

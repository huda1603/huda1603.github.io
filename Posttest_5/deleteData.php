<?php
    require "koneksi.php";

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
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

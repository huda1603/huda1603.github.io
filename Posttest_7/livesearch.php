<?php
    require "koneksi.php";
    session_start();

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true || $_SESSION['posisi'] !== 'admin') {
        header('Location: index.php');
        exit;
    }

    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $sql = "SELECT * FROM pengguna WHERE nama LIKE '%$search%'";
        $sql_query = mysqli_query($conn, $sql);

        $hasil_pendaftaran = [];
        while ($row = mysqli_fetch_assoc($sql_query)) {
            $hasil_pendaftaran[] = $row;
        }

        foreach ($hasil_pendaftaran as $data_pendaftar) {
            echo '<tr class="table-pendaftar-row">';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['id_pengguna'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['nama'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['tanggal_lahir'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['alamat'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['nomor_telepon'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['email'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['tingkat_kursus'] . '</td>';
            echo '<td class="table-pendaftar-data">' . $data_pendaftar['metode_pembayaran'] . '</td>';
            echo '<td class="table-pendaftar-data">';
            echo '<div class="button-UD">';
            echo '<a href="editData.php?id=' . $data_pendaftar['id_pengguna'] . '"><button class="edit-data"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button></a>';
            echo '<a href="deleteData.php?id=' . $data_pendaftar['id_pengguna'] . '" onclick="return confirm(\'Yakin ingin menghapus data ini?\');"><button class="hapus-data"><i class="fa-solid fa-trash-can" style="color: #ffffff;"></i></button></a>';
            echo '</div></td>';
            echo '<td class="table-pendaftar-data"><img src="gambar/' . $data_pendaftar['foto_pengguna'] . '" alt="' . $data_pendaftar['foto_pengguna'] . '" width="80px" height="100px" style="display: block; margin: 0 auto;"></td>';
            echo '</tr>';
        }
    }

?>
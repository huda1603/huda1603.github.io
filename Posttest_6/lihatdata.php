<?php
  require "koneksi.php";

  $hasil_pendaftaran = [];
  $sql = "SELECT * FROM pengguna";
  $sql_query = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($sql_query)) {
    $hasil_pendaftaran[] = $row;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="styles/data_pendaftar.css">
</head>
<body>
    <center>
        <h1>
        Pendaftar Terbaru
        </h1>
    </center>
    <table class="table-pendaftar">
        <thead>
            <tr class="table-pendaftar-row">
                <th class="table-pendaftar-header">ID</th>
                <th class="table-pendaftar-header">Nama</th>
                <th class="table-pendaftar-header">Tanggal Lahir</th>
                <th class="table-pendaftar-header">Alamat</th>
                <th class="table-pendaftar-header">Nomor Telepon</th>
                <th class="table-pendaftar-header">Email</th>
                <th class="table-pendaftar-header">Tingkat Kursus</th>
                <th class="table-pendaftar-header">Metode Pembayaran</th>
                <th class="table-pendaftar-header">Aksi</th>
                <th class="table-pendaftar-header">Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($hasil_pendaftaran as $data_pendaftar) : ?>
                <tr class="table-pendaftar-row">
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['id_pengguna'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['nama'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['tanggal_lahir'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['alamat'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['nomor_telepon'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['email'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['tingkat_kursus'] ?></td>
                    <td class="table-pendaftar-data"><?php echo $data_pendaftar['metode_pembayaran'] ?></td>
                    <td class="table-pendaftar-data">
                        <div class="button-UD">
                            <a href="editData.php?id=<?php echo $data_pendaftar['id_pengguna']?>">
                                <button class="edit-data">
                                    <i class="fa-solid fa-pen" style="color: #ffffff;"></i>
                                </button>
                            </a>
                            <a href="deleteData.php?id=<?php echo $data_pendaftar['id_pengguna']?>" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                <button class="hapus-data">
                                    <i class="fa-solid fa-trash-can" style="color: #ffffff;"></i>
                                </button>
                            </a>
                        </div>
                    </td>
                    <td class="table-pendaftar-data">
                        <img src="gambar/<?= $data_pendaftar['foto_pengguna'] ?>" alt="<?= $data_pendaftar['foto_pengguna'] ?>" width="80px" height="100px" style="display: block; margin: 0 auto;">
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <button class="kembali_beranda" onclick="location.href='index.php'" type="button"><--Kembali Ke Beranda</button>
</body>
</html>
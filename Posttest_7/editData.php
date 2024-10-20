<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!==true || $_SESSION['posisi']!=='admin') {
        header('Location: index.php');
        exit;
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql = "SELECT * FROM pengguna WHERE id_pengguna = $id";
        $result = mysqli_query($conn, $sql);

        $user = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $nomor = $_POST['nomor_telepon'];
        $email = $_POST['email'];
        $tingkat_kursus = $_POST['tingkat_kursus'];
        $metode_pembayaran = $_POST['metode_pembayaran'];

        $oldImg = $_POST['oldimg'];

        function updateFormKursus($conn, $id, $nama, $tanggal_lahir, $alamat, $nomor, $email, $tingkat_kursus, $metode_pembayaran, $file_name) {
            $sql = "UPDATE pengguna SET 
                        nama = '$nama', 
                        tanggal_lahir = '$tanggal_lahir', 
                        alamat = '$alamat', 
                        nomor_telepon = '$nomor', 
                        email = '$email', 
                        tingkat_kursus = '$tingkat_kursus', 
                        metode_pembayaran = '$metode_pembayaran',
                        foto_pengguna = '$file_name'
                    WHERE id_pengguna = $id";

            if (mysqli_query($conn, $sql)) {
                echo "
                    <script>
                        alert('Data berhasil diperbarui!');
                        document.location.href = 'lihatdata.php';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Gagal memperbarui data!');
                    </script>";
            }
        }

        if ($_FILES['foto_pengguna']['error'] === 4) { // cek apakah ada file yg diupload
            $file_name = $oldImg; // kalo tidak, akan mengambil gambar lama
            updateFormKursus($conn, $id, $nama, $tanggal_lahir, $alamat, $nomor, $email, $tingkat_kursus, $metode_pembayaran, $file_name);
        } else {
            $tmp_name = $_FILES['foto_pengguna']['tmp_name']; // mengambil path temporary file
            $file_name = $_FILES['foto_pengguna']['name']; // mengambil nama file
    
            // cek apakah yang diupload adalah file gambar
            $validExtensions = ['png', 'jpg', 'jpeg'];
            $fileExtension = explode('.', $file_name);
            $fileExtension = strtolower(end($fileExtension));
            if (!in_array($fileExtension, $validExtensions)) {
            echo "
                <script>
                    alert('Tolong upload file gambar!');
                </script>";
            } else {
            $newFileName = date('d-m-Y') . '-' . $file_name;
            move_uploaded_file($tmp_name, 'gambar/' . $newFileName);
            unlink('gambar/'.$oldImg); // menghapus gambar lama dari folder images
            updateFormKursus($conn, $id, $nama, $tanggal_lahir, $alamat, $nomor, $email, $tingkat_kursus, $metode_pembayaran, $newFileName);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Pengguna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/base.css" />
    <link rel="stylesheet" href="styles/home.css" />
</head>
<body>
    <nav class="navbar-section">
        <a href="index.html">
            <img src="assets/kursusfotografi.png" alt="Logo Kursus Fotografi" width="50" height="50" />
        </a>
        <div class="navbar-toggle" onclick="toggleMenu()">
            <i class="fa-solid fa-bars"></i>
        </div>
        <menu class="navbar-list" id="navbar-list">
            <li class="navbar-item"><a href="index.php">Beranda</a></li>
            <li class="navbar-item"><a href="aboutme.php">Tentang Saya</a></li>
        </menu>
        <button id="toggle-mode" onclick="toggleDarkMode()">🌙</button>
    </nav>

    <main class="form-section">
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <center>
                    <legend><h2>Update Data Pengguna</h2></legend>
                    <table cellspacing="5">
                        <input type="hidden" name="oldimg" value="<?= $user['foto_pengguna'] ?>">
                        <tr>
                            <th>Nama</th>
                            <td>
                                <input type="text" name="nama" value="<?php echo $user['nama']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>
                                <input type="date" name="tanggal_lahir" value="<?php echo $user['tanggal_lahir']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>
                                <input type="text" name="alamat" value="<?php echo $user['alamat']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>
                                <input type="text" name="nomor_telepon" value="<?php echo $user['nomor_telepon']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Tingkat Kursus</th>
                            <td>
                                <select name="tingkat_kursus" required>
                                    <option value="pemula" <?php echo $user['tingkat_kursus'] == 'pemula' ? 'selected' : ''; ?>>Pemula</option>
                                    <option value="menengah" <?php echo $user['tingkat_kursus'] == 'menengah' ? 'selected' : ''; ?>>Menengah</option>
                                    <option value="lanjutan" <?php echo $user['tingkat_kursus'] == 'lanjutan' ? 'selected' : ''; ?>>Lanjutan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>
                                <select name="metode_pembayaran" required>
                                    <option value="BCA" <?php echo $user['metode_pembayaran'] == 'BCA' ? 'selected' : ''; ?>>Bank BCA</option>
                                    <option value="BNI" <?php echo $user['metode_pembayaran'] == 'BNI' ? 'selected' : ''; ?>>Bank BNI</option>
                                    <option value="BRI" <?php echo $user['metode_pembayaran'] == 'BRI' ? 'selected' : ''; ?>>Bank BRI</option>
                                    <option value="Gopay" <?php echo $user['metode_pembayaran'] == 'Gopay' ? 'selected' : ''; ?>>Gopay</option>
                                    <option value="Dana" <?php echo $user['metode_pembayaran'] == 'Dana' ? 'selected' : ''; ?>>Dana</option>
                                    <option value="OVO" <?php echo $user['metode_pembayaran'] == 'OVO' ? 'selected' : ''; ?>>OVO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                <input type="file" name="foto_pengguna"> <br>
                                <img src="gambar/<?= $user['foto_pengguna'] ?>" alt="<?= $user['foto_pengguna'] ?>" width="80px" height="100px">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center><button type="submit" name="update">Perbarui</button></center>
                            </td>
                        </tr>
                    </table>
                </center>
            </fieldset>
        </form>
    </main>

    <footer class="footbar-section">
        <div class="footbar-container">
            <figure class="footbar-brand">
                <img src="assets/kursusfotografi.png" alt="Logo Kursus Fotografi" width="75px" height="75px" />
                <figcaption>KURSUS <br /> FOTOGRAFI</figcaption>
            </figure>
            <address>
                <menu class="footbar-list">
                    <li class="footbar-item">
                        <i class="fa-solid fa-phone" style="margin-right: 5px"></i>
                        <a href="tel:+6285751991314">+(62) 857 5199 1314</a>
                    </li>
                    <li class="footbar-item">
                        <i class="fa-solid fa-envelope" style="margin-right: 5px"></i>
                        <a href="mailto:info@kursusfotografi.com">info@kursusfotografi.com</a>
                    </li>
                </menu>
            </address>
        </div>
    </footer>

    <script src="scripts/main.js"></script>
</body>
</html>

<?php
    require "koneksi.php";

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $tanggal_lahir = $_POST['tanggal_lahir'];
        $alamat = $_POST['alamat'];
        $nomor = $_POST['nomor_telepon'];
        $email = $_POST['email'];
        $tingkat_kursus = $_POST['tingkat_kursus'];
        $metode_pembayaran = $_POST['metode_pembayaran'];
        
        $tmp_name = $_FILES['foto_pengguna']['tmp_name'];
        $file_name = $_FILES['foto_pengguna']['name'];

        $validExtension = ['jpg', 'jpeg', 'png'];
        $fileExtension = explode('.', $file_name);
        $fileExtension = strtolower(end($fileExtension));
        if(!in_array($fileExtension, $validExtension)) {
            echo "
                <script>
                    alert('File yang diupload bukan gambar!');
                    document.location.href = 'lihatdata.php';
                </script>";
                exit;
        } else{
            $newFileName =  date('d-m-y'). '-' . $file_name;
            if(move_uploaded_file($tmp_name,'gambar/' .$newFileName)) {
                $sql = "INSERT INTO pengguna VALUES (null, '$nama', '$tanggal_lahir', '$alamat', '$nomor', '$email', '$tingkat_kursus', '$metode_pembayaran', '$newFileName')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "
                        <script>
                            alert('Berhasil Daftar!');
                            document.location.href = 'lihatdata.php';
                        </script>";
                } else {
                    echo "
                        <script>
                            alert('Gagal Mendaftar!');
                        </script>";
                }
            } else {
                echo "
                    <script>
                        alert('Gagal upload gambar!');
                        document.location.href = 'lihatdata.php';
                    </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Form Input | Kursus Fotografi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/base.css" />
    <link rel="stylesheet" href="styles/home.css" />
</head>
<body>
    <!-- Navbar -->
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

    <!-- Form Section -->
    <main class="form-section">
        <form action="" method="post" enctype="multipart/form-data">
            <fieldset>
                <center>
                    <legend><h2>Form Input Kursus</h3></legend>
                    <table cellspacing="5">
                        <tr>
                            <th>Nama</th>
                            <td>
                                <input type="text" name="nama" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>
                                <input type="date" name="tanggal_lahir" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>
                                <input type="text" name="alamat" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Nomor Telepon</th>
                            <td>
                                <input type="text" name="nomor_telepon" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>
                                <input type="email" name="email" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Tingkat Kursus</th>
                            <td>
                                <select name="tingkat_kursus" required>
                                    <option value="pemula">Pemula</option>
                                    <option value="menengah">Menengah</option>
                                    <option value="lanjutan">Lanjutan</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td>
                                <select name="metode_pembayaran" required>
                                    <option value="BCA">Bank BCA</option>
                                    <option value="BNI">Bank BNI</option>
                                    <option value="BRI">Bank BRI</option>
                                    <option value="Gopay">Gopay</option>
                                    <option value="Dana">Dana</option>
                                    <option value="OVO">OVO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>Foto</th>
                            <td>
                                <input type="file" name="foto_pengguna" accept="gambar/*" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Persetujuan</th>
                            <td>
                                <input type="checkbox" name="persetujuan" required> Saya setuju untuk mengikuti kursus
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center><button type="submit" name="submit" >Daftar</button></center>
                            </td>
                        </tr>
                    </table>
                </center>
            </fieldset>
        </form>
    </main>

    <!-- Footbar -->
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

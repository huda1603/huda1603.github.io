<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!== true || $_SESSION['role']!=='user') {
        header('Location: login.php');
        exit;
    }

    if (isset($_GET['id_user']) && isset($_SESSION['id_user'])) {
        $id_user = $_GET['id_user'];
        $id_user_sesi = $_SESSION['id_user'];
    }

    if (isset($_POST["tambah"])) {
        $nama_webinar = $_POST["nama_webinar"];
        $deskripsi = $_POST["deskripsi"];
        $tautan = $_POST["tautan"];
        $tanggal_mulai = $_POST["tanggal_mulai"];
        $deadline = $_POST["deadline"];
        $nomor = $_POST["nomor"];

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        $tmp_name = $_FILES['img_webinar']['tmp_name'];
        $file_name = $_FILES['img_webinar']['name'];

        $validExtension = ['jpg', 'jpeg', 'png'];
        $fileExtension = explode('.', $file_name);
        $fileExtension = strtolower(end($fileExtension));
        if(!in_array($fileExtension, $validExtension)) {
            echo "
                <script>
                    alert('File yang diupload bukan gambar!');
                    document.location.href = 'tambah.php?id_user=" . $id_user . "';
                </script>";
                exit;
        } else {
            $newFileName = date('d-m-y'). '-' . $file_name;
            if(move_uploaded_file($tmp_name, 'gambar/' .$newFileName)) {
                $sql = "INSERT INTO webinar VALUES ('$randomString', '$nama_webinar', '$deskripsi', '$tautan', '$tanggal_mulai', '$deadline', '$newFileName', '$nomor', '$id_user')";
                $result = mysqli_query($conn, $sql);

                if($result) {
                    echo "
                        <script>
                            alert('Berhasil Menambah Webinar!');
                            document.location.href = 'index.php?id_user=" . $id_user . "';
                        </script>";
                } else {
                    echo "
                        <script>
                            alert('Gagal Menambah Webinar');
                            document.location.href = 'tambah.php?id_user=" . $id_user . "';
                        </script>";
                }
            } else {
                echo "
                    <script>
                        alert('Gagal Upload Gambar!');
                        document.location.href = 'index.php?id_user=" . $id_user . "';
                    </script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Webinar</title>
    <link rel="stylesheet" href="styling/tambah.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="input-form">
        <h2>Tambah Webinar</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="img_webinar">Masukkan Gambar Webinar</label>
                <input type="file" id="img_webinar" name="img_webinar" accept="gambar/*" required>
            </div>
            <div class="gambar-webinar">
                <!-- Kosong Menunggu Sampai File Gambar Terinput -->
            </div>
            <div>
                <label for="nama_webinar">Masukkan Nama Judul Webinar</label>
                <input type="text" id="nama_webinar" name="nama_webinar" placeholder="Judul Webinar">
            </div>
            <div>
                <label for="deskripsi">Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi Webinarmu">
            </div>
            <div>
                <label for="tautan">Tautan Pendaftaran</label>
                <input type="text" id="tautan" name="tautan" placeholder="Masukkan Tautan Pendaftaranmu Disini">
            </div>
            <div>
                <div>
                    <label for="tanggal_mulai">Tanggal Pelaksanaan</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai">
                </div>
                <div>
                    <label for="deadline">Deadline Pendaftaran</label>
                    <input type="date" id="deadline" name="deadline">
                </div>
                <div>
                    <label for="nomor">Nomor Kontak</label>
                    <input type="text" id="nomor" name="nomor" placeholder="Masukkan Nomor Kontak">
                </div>
            </div>
            <div>
                <button name="tambah">
                    <i class="fas fa-plus"></i> Tambah
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('img_webinar').addEventListener('change', function(event) {
            const gambar_webinar = event.target.files[0];
            if (gambar_webinar) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const gambarBaru = document.createElement('img');
                    gambarBaru.src = e.target.result;
                    gambarBaru.alt = 'Gambar Webinar';
                    const gambarBaruWebinar = document.querySelector('.gambar-webinar');
                    gambarBaruWebinar.appendChild(gambarBaru);
                    gambarBaruWebinar.classList.add('ubah-style');
                };
                reader.readAsDataURL(gambar_webinar);
            }
        });
    </script>
</body>
</html>

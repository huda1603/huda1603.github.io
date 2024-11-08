<?php
    require "koneksi.php";

    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!==true || $_SESSION['role']!=='user') {
        header('Location: login.php');
        exit;
    }

    if (isset($_GET['id_webinar']) ? $_GET['id_webinar'] : '') {
        $id_webinar = $_GET['id_webinar'];
        $result = mysqli_query($conn, "SELECT*FROM webinar WHERE id_webinar='$id_webinar'");

        $webinar = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['update'])) {
        $nama_webinar = $_POST['nama_webinar'];
        $deskripsi = $_POST['deskripsi'];
        $tautan = $_POST['tautan'];
        $tanggal_mulai = $_POST['tanggal_mulai'];
        $deadline = $_POST['deadline'];

        $oldImg = $_POST['oldimg'];

        function updateWebinar($conn, $id_webinar, $nama_webinar, $deskripsi, $tautan, $tanggal_mulai, $deadline, $file_name) {
            $sql = "UPDATE webinar SET
                        nama_webinar = '$nama_webinar',
                        deskripsi = '$deskripsi',
                        tautan = '$tautan',
                        tanggal_mulai = '$tanggal_mulai',
                        deadline = '$deadline',
                        foto_webinar = '$file_name'
                    WHERE id_webinar = '$id_webinar'";
            
            if (mysqli_query($conn, $sql)) {
                if (file_exists('simpan_url.txt')) {
                    $lines = file('simpan_url.txt');
                    $first = trim($lines[0]);
                    $url_components = parse_url($first);
                    parse_str($url_components['query'], $params);
                }
                echo "
                    <script>
                        alert('Webinar Berhasil diperbarui!');
                        document.location.href = 'index.php?id_user=" . htmlspecialchars($params['id_user']) . "';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Gagal memperbarui data!');
                    </script>";
            }
        }

        if ($_FILES['img_webinar']['error'] === 4) {
            $file_name = $oldImg;
            updateWebinar($conn, $id_webinar, $nama_webinar, $deskripsi, $tautan, $tanggal_mulai, $deadline, $file_name);
        } else {
            $tmp_name = $_FILES['img_webinar']['tmp_name'];
            $file_name = $_FILES['img_webinar']['name'];

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
                unlink('gambar/'.$oldImg);
                updateWebinar($conn, $id_webinar, $nama_webinar, $deskripsi, $tautan, $tanggal_mulai, $deadline, $newFileName);
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
        <h2>Update Webinar</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div>
                <label for="img_webinar">Masukkan Gambar Webinar</label>
                <input type="file" id="img_webinar" name="img_webinar" required>
            </div>
            <div class="gambar-webinar-edit">
                <!-- -->
                <!-- Kosong Menunggu Sampai File Gambar Terinput -->
            </div>
            <div>
                <label for="nama_webinar">Masukkan Nama Judul Webinar</label>
                <input type="text" id="nama_webinar" name="nama_webinar" value="<?php echo $webinar['nama_webinar']; ?>" placeholder="Judul Webinar">
            </div>
            <div>
                <label for="deskripsi">Deskripsi</label>
                <input type="text" id="deskripsi" name="deskripsi" value="<?php echo $webinar['deskripsi']; ?>" placeholder="Deskripsi Webinarmu">
            </div>
            <div>
                <label for="tautan">Tautan Pendaftaran</label>
                <input type="text" id="tautan" name="tautan" value="<?php echo $webinar['tautan']; ?>" placeholder="Masukkan Tautan Pendaftaranmu Disini">
            </div>
            <div>
                <div>
                    <label for="tanggal_mulai">Tanggal Pelaksanaan</label>
                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" value="<?php echo $webinar['tanggal_mulai']; ?>">
                </div>
                <div>
                    <label for="deadline">Deadline Pendaftaran</label>
                    <input type="date" id="deadline" name="deadline" value="<?php echo $webinar['deadline']; ?>">
                </div>
            </div>
            <div>
                <button name="update">
                    <i class="fas fa-plus"></i> Update
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('img_webinar').addEventListener('change', function(event) {
            const gambar_webinar = event.target.files[0];
            const gambarBaruWebinar = document.querySelector('.gambar-webinar-edit');

            // Clear existing images
            gambarBaruWebinar.innerHTML = '';

            if (gambar_webinar) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const gambarBaru = document.createElement('img');
                    gambarBaru.src = e.target.result;
                    gambarBaru.alt = 'Gambar Webinar';
                    gambarBaruWebinar.appendChild(gambarBaru);
                    gambarBaruWebinar.classList.add('ubah-style');
                };
                reader.readAsDataURL(gambar_webinar);
            } else {
                // Jika tidak ada gambar baru, tampilkan gambar default
                const defaultImage = document.createElement('img');
                defaultImage.src = "gambar/<?= $webinar['foto_webinar'] ?>";
                defaultImage.alt = "<?= $webinar['foto_webinar'] ?>";
                gambarBaruWebinar.appendChild(defaultImage);
                gambarBaruWebinar.classList.add('ubah-style');
            }
        });

    </script>
</body>
</html>
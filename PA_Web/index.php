<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!== true || $_SESSION['role']!=='user') {
        header('Location: login.php');
        exit;
    }

    $current_url = $_SERVER['REQUEST_URI'];
    file_put_contents('simpan_url.txt', $current_url . PHP_EOL, FILE_APPEND);
    $result = mysqli_query($conn, "SELECT*FROM webinar");

    if (file_exists('simpan_url.txt')) {
        $lines = file('simpan_url.txt');
        $first = trim($lines[0]);
        $url_components = parse_url($first);
        parse_str($url_components['query'], $params);
    }
    
    if(isset($_GET['id_user']) && isset($_SESSION['id_user'])) {
        $id_user = $_GET['id_user'];
        $id_user_sesi = $_SESSION['id_user'];
    }

    if (isset($_GET['action'])) {
        $result = mysqli_query($conn, "SELECT * FROM webinar WHERE id_user = $id_user");
    }    

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = mysqli_query($conn, "SELECT * FROM webinar WHERE nama_webinar LIKE '%$search%'");
    }

    if (isset($_GET['refresh'])) {
        echo "
            <script>
                document.location.href='index.php?id_user=" . htmlspecialchars($params['id_user']) . "'
            </script>";
    }

    if (isset($_GET['sorting_asc'])) {
        $result = mysqli_query($conn, "SELECT * FROM webinar ORDER BY nama_webinar ASC");
    } else if (isset($_GET['sorting_desc'])) {
        $result = mysqli_query($conn, "SELECT * FROM webinar ORDER BY nama_webinar DESC");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="styling/halaman_utama.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Navbar -->
    <nav>
        <div class="logo">
            <img src="assets/Logo.jpeg" alt="Webinar">
            <h3 class="nowrap">Webinar Gratis</h3>
        </div>
        <ul>
            <li><a class="nowrap" href="#beranda">Beranda</a></li>
            <li><a class="nowrap" href="tentang.php">Tentang Kami</a></li>
            <li><a class="nowrap" href="#kontak">Kontak</a></li>
        </ul>
    </nav>

    <!-- Sidebar -->
    <aside>
        <div class="crud">
            <a href="tambah.php?id_user=<?php echo $id_user?>">
                <img src="assets/create.png" alt="create">
            </a>
            <h4>BUAT</h4>
        </div>
        <div class="crud">
            <a href="?action=update&id_user=<?php echo $id_user; ?>">
                <img src="assets/update.png" alt="update">
            </a>
            <h4>UPDATE</h4>
        </div>
        <div class="crud">
            <a href="?action=delete&id_user=<?php echo $id_user; ?>">
                <img src="assets/delete.png" alt="delete">
            </a>
            <h4>HAPUS</h4>
        </div>
        <div class="crud">
            <a href="?action=lainnya&id_user=<?php echo $id_user; ?>">
                <img src="assets/read.png" alt="read">
            </a>
            <h4>LIHAT<br>Webinarku</h4>
        </div>
    </aside>

    <!-- Konten Utama -->
    <main>
        <div class="search-head">
            <form action="" method="GET">
                <div class="search-box">
                    <div class="search">
                        <img class="group-img" src="assets/search.png" alt="search">
                        <input type="text" id="search" name="search" placeholder="Cari Webinar Berdasarkan Nama Disini">
                    </div>
                    <div class="search-fitur">
                        <a href="index.php?sorting_asc=true">
                            <img class="group-img" src="assets/sorting_asc.png" alt="sort_ascending">
                        </a>
                        <a href="index.php?sorting_desc=true">
                            <img class="group-img" src="assets/sorting_desc.png" alt="sort_descending">
                        </a>
                        <a href="index.php?refresh=true">
                            <img class="group-img" src="assets/refresh.png" alt="refresh">
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="wrapper" id="beranda">
            <!-- Untuk Menampilkan Semua Webinar Yang Dibuat Oleh Banyak User -->
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '<div style="position: relative;top: 1.5%;left: 1.5%;width: 15%;height: 95%;border: 1px solid black;background-color: white; display: flex; flex-direction: column;align-items: center; justify-content: space-between;">';
                        echo '  <img src="gambar/' . $row['foto_webinar'] . '" alt="Gambar Webinar" style="width: 100%;height: 57%;">';
                        echo '  <h3 style="font-size: 98%;width: 90%;height: auto;margin-top: 1%;">' . $row['nama_webinar'] . '</h3>';
                        echo '  <div style="display: flex;flex-direction: column;width: 90%;height: auto; align-items: center;margin-bottom: 3%;">';
                        echo '      <p style="font-size: 80%; width: 90%;height: auto;margin: 0 auto;">Mulai Acara: ' . $row['tanggal_mulai'] . '</p>';
                        echo '      <p style="font-size: 80%; width: 90%;height: auto;margin: 0 auto;">Deadline: ' . $row['deadline'] . '</p>';
                        echo '  </div>';
                        echo '  <div style="width: 100%; height: 12%;display: flex;align-items: center;justify-content: center;">';
                        
                        
                        if (isset($_GET['action'])) {
                            if ($_GET['action'] == 'delete') {
                                $formAction = 'delete_process.php';
                                $buttonText = 'Hapus';
                            } else if ($_GET['action'] == 'update') {
                                $formAction = 'edit_process.php';
                                $buttonText = 'Update';
                            } else {
                                $formAction = "lihat_lengkap_process.php";
                                $buttonText = 'Lihat Lebih Lengkap';
                            }
                        } else {
                            $formAction = "lihat_lengkap_process.php";
                            $buttonText = 'Lihat Lebih Lengkap';
                        }
                    
                        echo '  <form action="' . $formAction . '" method="POST" style="width: 100%;height: 100%;display: flex;align-items: center;justify-content: center;">';
                        echo '      <input type="hidden" name="webinar_id" value="' . $row['id_webinar'] . '">';
                        echo '      <button type="submit" style="width: 100%;height: 100%;font-size: 85%;text-align: center; background-color: #28a745;color: white;border: none;cursor: pointer;">';
                        echo '          <i class="fa-regular fa-circle-right" style="width: 100%;height: 100%;display: flex;align-items: center;justify-content: center;gap: 2%;"> ' . $buttonText . '</i>';
                        echo '      </button>';
                        echo '  </form>';
                        echo '  </div>';
                        echo '</div>';
                    }                    

                } else {
                    echo "Tidak Ada Webinar";
                }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-kontak" id="kontak">
            <h5>Kontak</h5>
            <div class="contact-us">
                <img src="assets/email.png" alt="email">
                <h6>infowebinar@gmail.com</h6>
            </div>
            <div class="contact-us">
                <img src="assets/telepon.png" alt="telepon">
                <h6>+62 888-8888-8888</h6>
            </div>
        </div>
        <div class="footer-tengah">
            <a href="hapus_akun.php?id_user=<?php echo $id_user ?>"><h5>Hapus Akun</h5></a>
            <h6>Website Kelompok PA</h6>
        </div>
        <div class="logout">
            <a href="logout.php"><button><b>Logout</b></button></a>
        </div>
    </footer>
</body>
</html>
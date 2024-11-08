<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!==true || $_SESSION['role']!=='admin') {
        header('Location: login.php');
        exit;
    }

    $webinar = [];
    $result = mysqli_query($conn, "SELECT*FROM webinar");
    while ($row = mysqli_fetch_assoc($result)) {
        $webinar[] = $row;
    }

    if (isset($_GET['refresh'])) {
        echo "
            <script>
                document.location.href='admin.php';
            </script>";
    }

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $result = mysqli_query($conn, "SELECT * FROM webinar WHERE nama_webinar LIKE '%$search%'");
        $webinar = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $webinar[] = $row;
        }
    }

    if (isset($_GET['action'])) {
        echo "
            <script>
                if (confirm('Apakah Anda ingin logout?')) {
                    window.location.href = 'login.php';
                } else {
                    console.log('Logout Dibatalkan');
                }
            </script>";
    }

    /* if (isset($_POST['lihat'])) {
        $formAction = 'lihat_lengkap_process.php';
    } else if (isset($_POST['hapus'])) {
        $formAction = 'delete_process.php';
    } else {
        $formAction = 'lihat_lengkap_process.php';
    } */

    if (isset($_GET['sorting_asc'])) {
        $result = mysqli_query($conn, "SELECT * FROM webinar ORDER BY nama_webinar ASC");
        $webinar = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $webinar[] = $row;
        }
    } else if (isset($_GET['sorting_desc'])) {
        $result = mysqli_query($conn, "SELECT * FROM webinar ORDER BY nama_webinar DESC");
        $webinar = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $webinar[] = $row;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="styling/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="wrapper-top">
            <div class="wrapper-top-left">
                <img src="assets/Logo.jpeg" alt="logo">
                <h3>Webinar Gratis</h3>
            </div>
            <div class="wrapper-top-right">
                <div class="profile">
                    <div class="profile-access">
                        <i class="fa-solid fa-square-check"></i>
                        <small>Admin</small>
                        <a href="?action=logout"><i class="fa-solid fa-circle-user fa-xl"></i></a>
                        <a href="?action=logout"><i class="fa-solid fa-caret-down"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper-bottom">
            <div class="wrapper-bottom-left">
                <div class="wrapper-bottom-left-1">
                    <div class="bottom-left-1-circle">
                        <i class="fa-solid fa-circle-info fa-2xl"></i>
                    </div>
                    <div class="bottom-left-1-deskripsi">
                        <div class="bottom-left-1-deskripsi-border">
                            <b style="font-size: 0.9rem;">Halaman Admin Webinar Gratis</b>
                            <small>Halaman Admin Untuk Mengawasi Webinar Agar Website Bersih Dan Terjaga Dari Aktivitas Kriminal Diluar Sana</small>
                        </div>
                    </div>
                </div>
                <div class="wrapper-bottom-left-2">
                    <a href="admin.php">
                        <button>
                            <i class="fa-solid fa-file-powerpoint fa-xl"></i>Webinar User
                        </button>
                    </a>
                </div>
            </div>
            <div class="wrapper-bottom-right">
                <div class="wrapper-bottom-right-1">
                    <div class="wrapper-bottom-right-1-heading">
                        <i class="fa-solid fa-user fa-xl"></i>
                        <b>Semua Webinar User</b>
                    </div>
                </div>
                <div class="wrapper-bottom-right-2">
                    <div class="search">
                        <div class="search-box">
                            <div class="search-input">
                                <div class="search-input-wrapper">
                                    <i class="fa-solid fa-magnifying-glass fa-2xl"></i>
                                    <form action="" method="get">
                                        <input type="text" name="search" placeholder="Cari Webinar User Berdasar Nama">
                                    </form>
                                </div>
                            </div>
                            <div class="search-fitur">
                                <div class="search-fitur-wrapper">
                                    <form action="" method="get">
                                        <a href="admin.php?sorting_asc=true"><i class="fa-solid fa-arrow-up-z-a fa-2xl"></i></a>
                                        <a href="admin.php?sorting_desc=true"><i class="fa-solid fa-arrow-down-z-a fa-2xl"></i></a>
                                        <a href="admin.php?refresh=true"><i class="fa-solid fa-arrows-rotate fa-2xl"></i></a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-webinar">
                        <div class="card-webinar-box">
                            <div class="card">
                                <?php foreach ($webinar as $data_webinar) : ?>
                                    <div class="card-wrapper">
                                        <div class="card-wrapper-img">
                                            <img src="gambar/<?php echo $data_webinar['foto_webinar'] ?>" alt="gambar_webinar">
                                        </div>
                                        <div class="card-wrapper-desc">
                                            <div class="card-wrapper-desc-judul">
                                                <small><b><?php echo $data_webinar['nama_webinar'] ?></b></small>
                                            </div>
                                            <div class="card-wrapper-desc-date">
                                                <small><b>Tanggal Mulai: <?php echo $data_webinar['tanggal_mulai'] ?></b></small>
                                                <small><b>Deadline: <?php echo $data_webinar['deadline'] ?></b></small>
                                            </div>
                                            <div class="card-wrapper-desc-btn">
                                                <a href="lihat_lengkap.php?id_webinar=<?php echo $data_webinar['id_webinar'] ?>"><button name="lihat"><i class="fa-solid fa-eye fa-lg"></i></button></a>
                                                <a href="delete.php?id_webinar=<?php echo $data_webinar['id_webinar'] ?>"><button name="hapus"><i class="fa-solid fa-trash-can fa-xl"></i></button></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrapper-bottom-right-3">
                    <div class="wrapper-bottom-right-3-footer">
                        <small>@2024 Info Webinar Gratis</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
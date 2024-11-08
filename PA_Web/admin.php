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
                <div class="hamburger">
                    <i class="fa-solid fa-bars fa-lg"></i>
                </div>
                <div class="profile">
                    <div class="profile-access">
                        <i class="fa-solid fa-square-check"></i>
                        <small>Admin</small>
                        <i class="fa-solid fa-circle-user fa-xl"></i>
                        <i class="fa-solid fa-caret-down"></i>
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
                    <button>
                        <i class="fa-solid fa-flag fa-xl"></i>Beranda
                    </button>
                    <button>
                        <i class="fa-solid fa-file-powerpoint fa-xl"></i>Webinar User
                    </button>
                    <button>
                        <i class="fa-regular fa-circle-user fa-xl"></i>Akun User
                    </button>
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
                                    <i class="fa-solid fa-arrow-up-z-a fa-2xl"></i>
                                    <i class="fa-solid fa-arrow-down-z-a fa-2xl"></i>
                                    <i class="fa-solid fa-arrows-rotate fa-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-webinar">
                        <div class="card-webinar-box">
                            <div class="card">
                                <?php foreach($webinar as $data_webinar) : ?>
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
                                                <button name="lihat"><i class="fa-solid fa-eye fa-lg"></i>Lihat Lengkap</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                            <div class="previous-next">
                                <div class="previous">
                                    <i class="fa-solid fa-arrow-left fa-lg"></i>
                                    <div class="btn-previous">
                                        <button>Previous</button>
                                    </div>
                                </div>
                                <div class="next">
                                    <div class="btn-next">
                                        <button>Next</button>
                                    </div>
                                    <i class="fa-solid fa-arrow-right fa-lg"></i>
                                </div>
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
<?php
    require "koneksi.php";
    session_start();
    if (!isset($_SESSION['login']) || $_SESSION['login']!==true) {
        header('Location: login.php');
        exit;
    }

    if (file_exists('simpan_url.txt')) {
        $lines = file('simpan_url.txt');
        $first = trim($lines[0]);
        $url_components = parse_url($first);
        parse_str($url_components['query'], $params);
    }

    if (isset($_GET['id_webinar'])) {
        if (file_exists('simpan_url.txt')) {
            $lines = file('simpan_url.txt');
            $first = trim($lines[0]);
            $url_components = parse_url($first);
            parse_str($url_components['query'], $params);
        }
        $id_webinar = $_GET['id_webinar'];
        $result = mysqli_query($conn, "SELECT*FROM webinar WHERE id_webinar='$id_webinar'");
        $result_komentar = mysqli_query($conn, "SELECT*FROM komentar WHERE id_webinar='$id_webinar'");

        $webinar = mysqli_fetch_assoc($result);
        $webinar_komentar = mysqli_fetch_assoc($result_komentar);

        $sql_owner = mysqli_query($conn, "SELECT username FROM user WHERE id_user=" . $webinar['id_user']);
        $owner = mysqli_fetch_assoc($sql_owner);

        $sql_user = mysqli_query($conn, "SELECT username FROM user WHERE id_user=" . htmlspecialchars($params['id_user']));
        $user = mysqli_fetch_assoc($sql_user);
    }

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@$%&()';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    if (isset($_POST['kirim'])) {
        $komen = mysqli_real_escape_string($conn, trim($_POST['comment']));
        $id_user = isset($params['id_user']) ? htmlspecialchars($params['id_user']) : '';
        $result = mysqli_query($conn, "INSERT INTO komentar VALUES ('$randomString', '$komen', '$id_user', '$id_webinar')");
        echo "
            <script>
                alert('berhasil komen!');
                document.location.href = 'lihat_lengkap.php?id_webinar=" . $id_webinar . "';
            </script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Webinar</title>
    <link rel="stylesheet" href="styling/lihat_lengkap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="wrapper-left">
            <div class="wrapper-left-top">
                <h2>Detail Webinar</h2>
            </div>
            <div class="wrapper-left-bottom">
                <div class="wrapper-left-bottom-detail">
                    <!-- <img src="gambar/01-11-24-WhatsApp Image 2024-10-31 at 20.21.04.jpeg" alt="style"> -->
                     <div class="wrapper-left-bottom-detail-top">
                        <div class="wrapper-left-bottom-detail-top-img">
                            <img src="gambar/<?php echo $webinar['foto_webinar'] ?>" alt="web">
                        </div>
                        <div class="wrapper-left-bottom-detail-top-desc">
                            <div class="teks">
                                <h2><?php echo $webinar['nama_webinar'] ?></h2>
                                <small><?php echo $webinar['deskripsi'] ?></small>
                            </div>
                            <div class="author">
                                <small><b>Author:</b> <?php echo $owner['username'] ?></small>
                            </div>
                            <div class="tautan">
                                <a href="<?php echo $webinar['tautan'] ?>"><small><?php echo $webinar['tautan'] ?></small></a>
                            </div>
                            <div class="date">
                                <div class="date1">
                                    <i class="fa-solid fa-calendar-days"></i>
                                    <small><b>Tanggal</b></small>
                                    <small><b><?php echo $webinar['tanggal_mulai'] ?></b></small>
                                </div>
                                <div class="date2">
                                    <i class="fa-solid fa-clock"></i>
                                    <small><b>Deadline</b></small>
                                    <small><b><?php echo $webinar['deadline'] ?></b></small>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="wrapper-left-bottom-detail-bottom">
                        <div class="wrapper-left-bottom-detail-bottom-back">
                            <form action="" method="post" class="form-detail">
                                <a href="index.php?id_user=<?php echo htmlspecialchars($params['id_user']); ?>">
                                    <input type="button" value="Kembali" name="kembali">
                                </a>
                            </form>
                        </div>
                        <div class="wrapper-left-bottom-detail-bottom-hubungi">
                            <form action="" method="post" class="form-detail">
                                <a href="https://wa.me/<?php echo $webinar['nomor_kontak'] ?>/">
                                    <input type="button" value="Hubungi" name="hubungi">
                                </a>
                            </form>
                        </div>
                     </div>
                </div>
            </div>
        </div>
        <div class="wrapper-right">
            <div class="wrapper-right-top">
                <h2>Komentar</h2>
            </div>
            <!-- <div class="wrapper-right-bottom"> -->
                <?php
                    // Misalnya Anda sudah melakukan query ke database dan mengambil data komentar
                    $sql_komen = "SELECT * FROM komentar WHERE id_webinar='$id_webinar'";
                    $result_komen = mysqli_query($conn, $sql_komen);

                    if (mysqli_num_rows($result_komen) > 0) {
                        // Loop melalui semua komentar
                        while($row_komen = $result_komen->fetch_assoc()) {
                            
                            // Pengecekan jika komentar adalah dari pemilik webinar (misalnya berdasarkan id_webinar)
                            $isOwner = ($row_komen['id_user'] == $webinar['id_user']);  // Cek apakah komentar berasal dari pemilik webinar
                            $username_komen = mysqli_query($conn,"SELECT username FROM user WHERE id_user=" .$row_komen['id_user']);
                            $username_komen_fetch = $username_komen->fetch_assoc();

                            // Menampilkan komentar
                            echo '<div style="border: 1px solid orange; width: 100%; height: 17%; display: flex; flex-direction: column; justify-content: center; gap: 2%; background-color: #4b9eec; color: white;">';

                            // Jika bukan pemilik webinar, tampilkan komentar di kiri
                            if (!$isOwner) {
                                // Komentar Pengguna (Kiri)
                                echo '<div style="width: 100%; height: 50%; display: flex; flex-direction: row; align-items: center;">';
                                echo '    <div style="width: 22.5%; height: 100%; display: flex; justify-content: center; align-items: center;">';
                                echo '        <img src="assets/email.png" alt="foto pengguna" style="width: 75%; height: 75%; mix-blend-mode: multiply;">';
                                echo '    </div>';
                                echo '    <div style="width: 77.5%; height: 100%; display: flex; flex-direction: column;">';
                                echo '        <div style="width: 100%; height: 30%;">';
                                echo '            <small><b>' . htmlspecialchars($username_komen_fetch['username']) . '</b></small>';
                                echo '        </div>';
                                echo '        <div style="width: 100%; height: 70%;">';
                                echo '            <div style="width: 95%; height: 100%; display: flex; justify-content: center; align-items: center; font-size: 0.8rem; background-color: white; color: black; border: 1px solid white; border-radius: 10px;">';
                                echo '                <small>' . htmlspecialchars($row_komen['komentar']) . '</small>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }

                            // Jika komentar adalah dari pemilik webinar, tampilkan di kanan
                            if ($isOwner) {
                                // Komentar Pemilik Webinar (Kanan)
                                echo '<div style="width: 100%; height: 50%; display: flex; flex-direction: row-reverse;">';
                                echo '    <div style="width: 22.5%; height: 100%; display: flex; justify-content: center; align-items: center;">';
                                echo '        <img src="assets/email.png" alt="foto webinar" style="width: 75%; height: 75%; mix-blend-mode: multiply;">';
                                echo '    </div>';
                                echo '    <div style="width: 77.5%; height: 100%; display: flex; flex-direction: column;">';
                                echo '        <div style="width: 100%; height: 30%; display: flex; flex-direction: row-reverse;">';
                                echo '            <small><b>' . htmlspecialchars($username_komen_fetch['username']) . '</b></small>';
                                echo '        </div>';
                                echo '        <div style="width: 100%; height: 70%; display: flex; justify-content: flex-end;">';
                                echo '            <div style="width: 95%; height: 100%; display: flex; justify-content: center; align-items: center; font-size: 0.8rem; background-color: white; border: 1px solid white; color: black; border-radius: 10px;">';
                                echo '                <small>' . htmlspecialchars($row_komen['komentar']) . '</small>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';
                            }

                            echo '</div>'; // Menutup wrapper-right-bottom
                        }
                    } else {
                        echo "Tidak ada komentar.";
                    }
                ?>

            <!-- </div> -->
            <div class="wrapper-right-very-bottom">
                <form action="" method="post" class="form-comment">
                    <div class="comment-border">
                        <input type="text" name="comment" placeholder="Tambahkan Komentar Anda">
                    </div>
                    <div class="comment-send">
                        <div class="send-border">
                            <button type="submit" name="kirim"><i class="fa-solid fa-paper-plane fa-2xl" style="color: #fafcff;"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
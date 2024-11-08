<?php
    require "koneksi.php";

    if (isset($_POST["submit"])) {
        $namaFull = $_POST["namalengkap"];
        $namaPgl = $_POST["namapanggilan"];
        $tempatlahir = $_POST["tempatlahir"];
        $tanggallahir = $_POST["tanggallahir"];
        $jeniskelamin = $_POST["jenkel"];
        $username = $_POST["username"];
        $passwor = password_hash($_POST["kata_sandi"], PASSWORD_DEFAULT);
        $role = "User";

        $checkUsername = mysqli_query($conn, "SELECT*FROM user WHERE username='$username'");

        if (mysqli_num_rows($checkUsername) > 0) {
            echo "
                <script>
                    alert('Username sudah digunakan! silahkan gunakan username lain');
                    document.location.href = 'register.php';
                </script>";
        } else {
            $query = "INSERT INTO user VALUES (null, '$namaFull', '$namaPgl', '$tempatlahir', '$tanggallahir', '$jeniskelamin', '$username', '$passwor', '$role')";
            if (mysqli_query($conn, $query)) {
                echo "
                    <script>
                        alert('Registrasi berhasil!');
                        document.location.href = 'login.php';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Registrasi gagal!');
                        document.location.href = 'login.php';
                    </script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Webinar</title>
    <link rel="stylesheet" href="styling/login_register.css">
</head>
<body>
    <div class="form-container">
        <h2>Register</h2>
        <form action="" method="post">
            <div class="logo-container">
                <img src="assets/Logo.jpeg" alt="Webinar Gratis" class="logo">
            </div>
            <div class="textbox">
                <label for="namalengkap">Nama Lengkap</label>
                <div>
                    <img src="assets/fullname.png" alt="nama lengkap">
                    <input type="text" id="namalengkap" name="namalengkap" placeholder="Masukkan Nama Lengkap" required><br>
                </div> <br>

                <label for="namapanggilan">Nama Panggilan</label>
                <div>
                    <img src="assets/namapanggilan.png" alt="nama panggilan">
                    <input type="text" id="namapanggilan" name="namapanggilan" placeholder="Masukkan Nama Panggilan" required><br>
                </div> <br>

                <label for="tempatlahir">Tempat dan Tanggal Lahir</label>
                <div>
                    <img src="assets/tempatlahir.png" alt="tanggallahir">
                    <input type="text" id="tempatlahir" name="tempatlahir" placeholder="Masukkan Tempat Lahir" required><br>
                    <img src="assets/tanggallahir.png" alt="tanggallahir">
                    <input type="date" id="tanggallahir" name="tanggallahir" required><br>
                </div> <br>

                <label for="jenkel">Jenis Kelamin</label>
                <div>
                    <input type="radio" id="jenkel_laki" name="jenkel" value="laki_laki" required>
                    Laki-Laki
                    <input type="radio" id="jenkel_perempuan" name="jenkel" value="perempuan" required>
                    Perempuan
                </div> <br>

                <label for="username">Username</label>
                <div>
                    <img src="assets/username.png" alt="username">
                    <input type="text" id="username" name="username" placeholder="Buat Username" required><br>
                </div> <br>

                <label for="password">Password</label>
                <div>
                    <img src="assets/pass.png" alt="password">
                    <input type="password" id="password" name="kata_sandi" placeholder="Buat Password" required><br>
                </div>

                <button type="submit" name="submit">Register</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember">Ingat Saya
                </label> <br>

                <div class="switch">
                    Sudah Punya Akun?
                    <a href="login.php">Login</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
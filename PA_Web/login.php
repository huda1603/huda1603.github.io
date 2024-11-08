<?php
    session_start();
    require "koneksi.php";

    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $passwor = $_POST["kata_sandi"];

        $query = "SELECT*FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) === 1) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($passwor, $user['kata_sandi'])) {
                $_SESSION['login'] = true;
                if ($user['role'] === 'User') {
                    $_SESSION['role'] = 'user';
                    $_SESSION['id_user'] = $user['id_user'];
                    echo "
                        <script>
                            alert('Login Berhasil Sebagai User');
                            document.location.href = 'index.php?id_user=" . $user['id_user'] . "';
                        </script>";
                }
            } else {
                echo "
                    <script>
                        alert('Password salah');
                    </script>";
            }
        } else {
            if ($username === 'Admin' && $passwor === 'Admin') {
                $_SESSION['login'] = true;
                $_SESSION['role'] = 'admin';
                echo "
                    <script>
                        alert('Login Berhasil Sebagai Admin');
                        document.location.href = 'admin.php';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Username tidak ditemukan');
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
        <h2>Login</h2>
        <form action="" method="post">
            <div class="logo-container">
                <img src="assets/Logo.jpeg" alt="Webinar Gratis" class="logo">
            </div>
            <div class="textbox">
                <label for="username">Username</label>
                <div>
                    <img src="assets/username.png" alt="username">
                    <input type="text" id="username" name="username" placeholder="Masukkan Username" required></span><br>
                </div> <br>

                <label for="password">Password</label>
                <div>
                    <img src="assets/pass.png" alt="password">
                    <input type="password" id="password" name="kata_sandi" placeholder="Masukkan Password" required><br>
                </div>

                <button type="submit" name="submit">Login</button>
                <label>
                    <input type="checkbox" checked="checked" name="remember">Ingat Saya
                </label> <br>
                <div class="switch">
                    Belum Punya Akun?
                    <a href="register.php">Register</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
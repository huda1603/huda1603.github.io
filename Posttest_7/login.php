<?php
    session_start();
    require "koneksi.php";

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT*FROM user_terdaftar WHERE username = '$username'");

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['kata_sandi'])) {
                $_SESSION['login'] = true;
                if ($user['posisi'] === 'Admin') {
                    $_SESSION['posisi'] = 'admin';
                    echo "
                        <script>
                            alert('Login Berhasil sebagai Admin');
                            document.location.href = 'lihatdata.php';
                        </script>";
                } else {
                    $_SESSION['posisi'] = 'user';
                    echo "
                        <script>
                            alert('Login Berhasil sebagai sebagai User');
                            document.location.href = 'index.php';
                        </script>";
                }
            } else {
                echo "
                    <script>
                        alert('Password salah');
                    </script>";
            }
        } else {
            echo "
                <script>
                    alert('Username tidak ditemukan');
                </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login | Kursus Fotografi</title>
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
            <li class="navbar-item"><a href="index.html">Beranda</a></li>
            <li class="navbar-item"><a href="aboutme.html">Tentang Saya</a></li>
            <li class="navbar-item"><a href="register.php">Daftar</a></li>
            <li class="navbar-item"><a href="login.php">Login</a></li>
        </menu>
        <button id="toggle-mode" onclick="toggleDarkMode()">🌙</button>
    </nav>

    <!-- Login Form -->
    <main class="form-section">
        <h1>Form Login</h1>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit" name="login">Login</button>
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

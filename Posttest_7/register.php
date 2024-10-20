<?php
    require "koneksi.php";

    if (isset($_POST["register"])) {
        $username = $_POST["name"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $role = $_POST["role"];

        $checkResult = mysqli_query($conn, "SELECT*FROM user_terdaftar WHERE username='$username'");

        if (mysqli_num_rows($checkResult) > 0) {
            echo "
                <script>
                    alert('Username sudah digunakan, silahkan gunakan yang lain');
                    document.location.href='register.php';
                </script>";
        } else {
            $query = "INSERT INTO user_terdaftar (username, kata_sandi, posisi) VALUES ('$username', '$password', '$role')";

            if (mysqli_query($conn, $query)) {
                echo "
                    <script>
                        alert('Registrasi Berhasil!');
                        document.location.href='login.php';
                    </script>";
            } else {
                echo "
                    <script>
                        alert('Registrasi Gagal!');
                        document.location.href='index.php';
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
    <title>Pendaftaran | Kursus Fotografi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link rel="stylesheet" href="styles/base.css" />
    <link rel="stylesheet" href="styles/home.css" />
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-section">
        <a href="index.php">
            <img src="assets/kursusfotografi.png" alt="Logo Kursus Fotografi" width="50" height="50" />
        </a>
        <div class="navbar-toggle" onclick="toggleMenu()">
            <i class="fa-solid fa-bars"></i>
        </div>
        <menu class="navbar-list" id="navbar-list">
            <li class="navbar-item"><a href="index.php">Beranda</a></li>
            <li class="navbar-item"><a href="aboutme.html">Tentang Saya</a></li>
            <li class="navbar-item"><a href="register.php">Daftar</a></li>
            <li class="navbar-item"><a href="login.php">Login</a></li>
        </menu>
        <button id="toggle-mode" onclick="toggleDarkMode()">🌙</button>
    </nav>

    <!-- Registration Form -->
    <main class="form-section">
        <h1>Form Pendaftaran</h1>
        <form action="" method="post">
            <label for="name">Username:</label>
            <input type="text" name="name" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option name="role" value="Admin">Admin</option>
                <option name="role" value="User">User</option>
            </select>

            <button type="submit" name="register">Daftar</button>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tentang Kami | Kursus Fotografi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
            <li class="navbar-item">
                <a href="index.php">Beranda</a>
            </li>
            <li class="navbar-item">
                <a href="lihat_data.php">Lihat Kursus</a>
            </li>
            <li class="navbar-item">
                <a href="aboutme.php">Tentang Kami</a>
            </li>
            <li class="navbar-item"></li>
                <a href="register.php">Daftar</a>
            </li>
            <li class="navbar-item">
                <a href="login.php">Login</a>
            </li>
        </menu>
    </nav>

    <!-- Tentang Kami -->
    <main class="about-us-section">
        <article class="about-us-container">
            <h1 class="about-us-title">Biodata Saya</h1>
            <p><strong>Nama:</strong> Ahmad Nur Huda</p>
            <p><strong>Nama Panggilan:</strong> Huda</p>
            <p><strong>Jenis Kelamin:</strong> Pria</p>
            <p><strong>Tempat, Tanggal Lahir:</strong> 16 Juli 2005</p>
            <p><strong>Alamat:</strong> Jalan Pangeran Suryanata</p>
        </article>
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
                        <a href="tel:+628115551962">+(62) 811 555 1962</a>
                    </li>
                    <li class="footbar-item">
                        <i class="fa-solid fa-envelope" style="margin-right: 5px"></i>
                        <a href="mailto:info@kursusfotografi.com">info@kursusfotografi.com</a>
                    </li>
                </menu>
            </address>
        </div>
    </footer>

    <script>
        function toggleMenu() {
            const navbarList = document.getElementById("navbar-list");
            navbarList.classList.toggle("active");
        }
    </script>
</body>
</html>
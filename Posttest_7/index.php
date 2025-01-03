<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Beranda | Kursus Fotografi</title>
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
            <li class="navbar-item">
                <a href="index.php">Beranda</a>
            </li>
            <li class="navbar-item">
                <a href="aboutme.php">Tentang Kami</a>
            </li>
            <li class="navbar-item">
                <a href="form.php">Daftar</a>
            </li>
            <li class="navbar-item">
                <a href="login.php">Login</a>
            </li>
            <li class="navbar-item">
                <a href="register.php">Register</a>
            </li>

        </menu>
        <button id="toggle-mode" onclick="toggleDarkMode()">🌙</button>
    </nav>

    <!-- Hero -->
    <main class="hero-section">
        <img src="assets/fotografi.jpeg" alt="Kursus Fotografi" class="hero-image" />
        <div class="hero-container">
            <hgroup>
                <h1 class="hero-title">Kursus Fotografi <br /> Meningkatkan Keterampilan Anda</h1>
                <p class="hero-description">
                    Pelajari seni fotografi dengan mudah dan cepat. <br /> Daftar sekarang untuk kelas kami!
                </p>
            </hgroup>
            <form action="" class="search-bar">
                <input type="text" placeholder="Cari kursus di sini" class="search-input" />
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-magnifying-glass fa-xl"></i>
                </button>
            </form>
        </div>
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
                        <a href="tel:+628115551962">+(62) 857-5199-1314</a>
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

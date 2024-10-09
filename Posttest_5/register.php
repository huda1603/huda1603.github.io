<?php
// Initialize variables for form input
$name = $age = $password = "";
$nameErr = $ageErr = $passwordErr = "";
$submittedData = "";

// Process form data when submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['register'])) {
        if (empty(trim($_POST["name"]))) {
            $nameErr = "Nama diperlukan.";
        } else {
            $name = trim($_POST["name"]);
        }

        if (empty(trim($_POST["age"])) || !is_numeric(trim($_POST["age"]))) {
            $ageErr = "Usia harus berupa angka.";
        } else {
            $age = trim($_POST["age"]);
        }

        if (empty(trim($_POST["password"]))) {
            $passwordErr = "Password diperlukan.";
        } else {
            $password = trim($_POST["password"]);
        }

        // If no errors, display the submitted data
        if (empty($nameErr) && empty($ageErr) && empty($passwordErr)) {
            $submittedData = "Nama: $name <br> Usia: $age <br> Password: $password";
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="name">Nama:</label>
            <input type="text" name="name" value="<?php echo $name; ?>" required>
            <span><?php echo $nameErr; ?></span>

            <label for="age">Usia:</label>
            <input type="number" name="age" value="<?php echo $age; ?>" required>
            <span><?php echo $ageErr; ?></span>

            <label for="password">Password:</label>
            <input type="password" name="password" required>
            <span><?php echo $passwordErr; ?></span>

            <button type="submit" name="register">Daftar</button>
        </form>

        <!-- Display Submitted Data -->
        <?php if ($submittedData): ?>
            <h2>Data yang Diterima:</h2>
            <div><?php echo $submittedData; ?></div>
        <?php endif; ?>
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

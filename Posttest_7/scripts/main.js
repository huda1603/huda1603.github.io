function toggleMenu() {
    const navbarList = document.getElementById("navbar-list");
    navbarList.classList.toggle("active");
}

function toggleDarkMode() {
    const body = document.body;
    body.classList.toggle("dark-mode");

    const modeButton = document.getElementById("toggle-mode");
    if (body.classList.contains("dark-mode")) {
        modeButton.innerHTML = "☀️"; // Change to sun icon
    } else {
        modeButton.innerHTML = "🌙"; // Change to moon icon
    }
}

// Popup function
function showPopup() {
    alert("Selamat datang di Kursus Fotografi!"); // Simple pop-up
}

document.addEventListener('DOMContentLoaded', (event) => {
    showPopup(); // Show popup when the page loads
});

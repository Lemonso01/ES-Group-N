function checkPassword() {
    var password = document.getElementById("password").value;
    
    // Example password, replace this with your actual password
    var correctPassword = "es-n-2024";

    if (password === correctPassword) {
        // Redirect to the protected page
        window.location.href = "protected_page.html";
    } else {
        // Display an error message or take other actions as needed
        alert("Incorrect password. Please try again.");
    }
}

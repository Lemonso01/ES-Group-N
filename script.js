document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    const errorMessage = document.getElementById("error-message");

    loginForm.addEventListener("submit", (event) => {
        event.preventDefault();

        const username = loginForm.username.value;
        const password = loginForm.password.value;

        // Replace these credentials with your own logic
        const validUsername = "boiafeup01";
        const validPassword = "es-n-2024";

        if (username === validUsername && password === validPassword) {
            window.location.href = "restricted.html"; // Redirect to restricted page
        } else {
            errorMessage.style.display = "block";
        }
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('registrationForm');
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('confirm_password');
    const username = document.getElementById('username');

    const passwordError = document.getElementById('password-error');
    const usernameError = document.getElementById('username-error');

    if (!form) return;

    function checkPasswordMatch() {
        if (password.value !== confirmPassword.value) {
            passwordError.textContent = "Passwords do not match!";
            confirmPassword.style.borderColor = "#dc3545";
            return false;
        } else {
            passwordError.textContent = "";
            confirmPassword.style.borderColor = "#28a745";
            return true;
        }
    }

    function validateUsername() {
        const value = username.value.trim();

        if (value.length < 3) {
            usernameError.textContent = "Username must be at least 3 characters.";
            username.style.borderColor = "#dc3545";
            return false;
        }

        if (!/^[a-zA-Z0-9_]+$/.test(value)) {
            usernameError.textContent = "Only letters, numbers and underscore allowed.";
            username.style.borderColor = "#dc3545";
            return false;
        }

        usernameError.textContent = "";
        username.style.borderColor = "#28a745";
        return true;
    }

    confirmPassword.addEventListener('input', checkPasswordMatch);
    username.addEventListener('input', validateUsername);

    form.addEventListener('submit', function (e) {
        let valid = true;

        if (!checkPasswordMatch()) valid = false;
        if (!validateUsername()) valid = false;

        const requiredFields = form.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = "#dc3545";
                valid = false;
            }
        });

        if (!valid) e.preventDefault();
    });
});
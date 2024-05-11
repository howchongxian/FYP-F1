function validatePasswordLength(password) {
    return password.length >= 8;
}

function updatePasswordStrengthIndicator(password) {
    var strengthIndicator = document.getElementById("passwordStrengthIndicator");
    if (validatePasswordLength(password)) {
        strengthIndicator.textContent = "Strong";
        strengthIndicator.style.color = "green";
    } else if (password.length >= 6) { // Add medium strength condition
        strengthIndicator.textContent = "Medium"; // Update the text for medium strength
        strengthIndicator.style.color = "orange"; // Set color to yellow for medium strength
    } else {
        strengthIndicator.textContent = "Weak";
        strengthIndicator.style.color = "red";
    }
}

$(document).ready(function() {
    $("#password").keyup(function() {
        var password = $(this).val();
        updatePasswordStrengthIndicator(password);
    });
});

// Password visibility toggler function
function togglePasswordVisibility(fieldId) {
    var passwordInput = document.getElementById(fieldId);
    var toggleIcon = passwordInput.nextElementSibling.querySelector("i");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        toggleIcon.classList.remove("uil-eye");
        toggleIcon.classList.add("uil-eye-slash");
    } else {
        passwordInput.type = "password";
        toggleIcon.classList.remove("uil-eye-slash");
        toggleIcon.classList.add("uil-eye");
    }
}

$(document).ready(function() {
    $("#password").keyup(function() {
        var password = $("#password").val();
        updatePasswordStrengthIndicator(password);
    });

    // Create account button click event
    var createBtn = document.querySelector('.input-field.button input[type="button"]');
    createBtn.addEventListener('click', function() {
        // Get form values
        var username = document.querySelector('.input-field input[type="text"][placeholder="Username"]').value;
        var email = document.querySelector('.input-field input[type="text"][placeholder="Email"]').value;
        var password = document.getElementById('createPw').value;
        var confirmPassword = document.getElementById('confirmPw').value;
        var rememberMe = document.getElementById('sigCheck').checked;

        // Validate form data
        if (username.trim() === '') {
            alert('Please enter a username.');
            return;
        }

        if (email.trim() === '') {
            alert('Please enter an email.');
            return;
        }

        if (password.trim() === '') {
            alert('Please enter a password.');
            return;
        }

        if (password !== confirmPassword) {
            alert('Password and confirm password must match.');
            return;
        }
    });

    // Redirect to login page
    var loginLink = document.querySelector('.login-signup .signin-text');
    loginLink.addEventListener('click', function(event) {
        event.preventDefault();
        window.location.href = "login.php";
    });
});
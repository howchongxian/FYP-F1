// Function to validate password length
function validatePasswordLength(password) {
    return password.length >= 8;
}

// Update password strength indicator
function updatePasswordStrengthIndicator(password) {
    var strengthIndicator = document.getElementById("passwordStrengthIndicator");
    if (validatePasswordLength(password)) {
        strengthIndicator.textContent = "Strong";
        strengthIndicator.style.color = "green";
    } else if (password.length >= 6) {
        strengthIndicator.textContent = "Medium";
        strengthIndicator.style.color = "orange";
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

    // Password visibility toggle
    $(".toggle-password").click(function() {
        var fieldId = $(this).prev("input").attr("id");
        togglePasswordVisibility(fieldId);
    });
});
//** This is a Captcha.js page **//
let captchaCode = "";

// Function to generate a random CAPTCHA
function generateCaptcha() {
    let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    captchaCode = "";
    
    for (let i = 0; i < 6; i++) {
        captchaCode += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    
    let captchaElement = document.getElementById("image");
    captchaElement.innerText = captchaCode;
    captchaElement.style.color = "white"; // Set CAPTCHA text color to white
}

// Function to validate CAPTCHA input
function validateCaptcha() {
    let userInput = document.getElementById("user-captcha").value.trim();

    if (userInput === captchaCode) {
        document.getElementById("success-message").style.display = "block"; // Show success message
        document.getElementById("captcha-error").innerText = ""; // Clear any previous error
        setTimeout(() => {
            document.getElementById("carWashForm").submit(); // Submit form after 2 seconds
        }, 2000);
        return false; // Prevent immediate submission to show the message
    } else {
        document.getElementById("captcha-error").innerText = "Incorrect CAPTCHA. Please try again.";
        generateCaptcha(); // Refresh CAPTCHA
        return false; // Prevent form submission
    }
}

// Generate CAPTCHA when the page loads
document.addEventListener("DOMContentLoaded", generateCaptcha);

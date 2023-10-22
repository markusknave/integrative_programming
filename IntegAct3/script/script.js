function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var confirm_password = document.getElementById("confirm_password").value;

    if (username === '' || email === '' || password === '' || confirm_password === '') {
        alert("All fields must be filled.");
        return false;
    }
}


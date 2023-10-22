<?php
include("db_connection.php");

$error_message = "";  // Variable to store error messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Check if any field is empty
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields must be filled.";
    } else {
        // Check if passwords match
        if ($password !== $confirm_password) {
            $error_message = "Passwords do not match.";
        } else {
            // Check if the username is already taken
            $check_username_query = "SELECT * FROM users WHERE username='$username'";
            $result_username = $conn->query($check_username_query);

            // Check if the email is already taken
            $check_email_query = "SELECT * FROM users WHERE email='$email'";
            $result_email = $conn->query($check_email_query);

            if ($result_username->num_rows > 0) {
                $error_message = "Username already taken. Please choose a different username.";
            } elseif ($result_email->num_rows > 0) {
                $error_message = "Email already taken. Please choose a different email.";
            } else {
                // Hash the password
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // SQL query to insert data into the database
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

                if ($conn->query($sql) === TRUE) {
                    // Registration successful, redirect to welcome.php
                    header("Location: login.php");
                    exit();
                } else {
                    $error_message = "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./css/styles.css">
    <script src = "./script/script.js"></script>
</head>
<body class = "registerBody">
<div class = "registerContainer">
    <h2>Register</h2>
    <?php
    if (!empty($error_message)) {
        echo '<p style = "color: #9f1212">' . $error_message . '</p>';
    }
    ?>
    <form method = "post" onsubmit = "return validateForm()">
        <input type = "text" id = "username" name = "username" placeholder = "Username">
        <input type = "email" id = "email" name = "email" placeholder = "Email">
        <input type = "password" id = "password" name = "password" placeholder = "Password">
        <input type = "password" id = "confirm_password" name = "confirm_password" placeholder = "Confirm Password">
        <button type = "submit">Register</button>
    </form>
    <p>Already Registered? <a href = "login.php">Login</a></p>
</div>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "css/styles.css">
    <title>Registration Page</title>
</head>
<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rpassword = $_POST['rpassword'];
            $email = $_POST['email'];
            $num = 0;

        function function_alert($msg) {
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
            if (trim($password) == trim($rpassword)) {
                $num += 1;
            }
            if(!empty($username)) {
                $num += 1;
            }
    
            if(!empty($password) && !empty($rpassword)) {
                $num += 1;
            }
    
            if(!empty($email)) {
                $num += 1;
            }
    
            switch($num){
                case 4:
                    function_alert("Total valid inputs: ".$num." & successfully Stored Cookies");
                    setcookie("username", $username, time() + (86400 * 30), "/"); 
                    setcookie("password", $password, time() + (86400 * 30), "/"); 
                    setcookie("rpassword", $rpassword, time() + (86400 * 30), "/"); 
                    setcookie("email", $email, time() + (86400 * 30), "/"); 
                    break;
                    default:
                    function_alert("Total valid inputs: ".$num." & unsuccessful storing cookies");
                    setcookie("username", "", time() - 3600, "/");
                    setcookie("password", "", time() - 3600, "/");
                    setcookie("rpassword", "", time() - 3600, "/");
                    setcookie("email", "", time() - 3600, "/");
                    break;
            }
        }
    ?>
    <script>
            function formReg(){
                let Username = document.getElementById("username").value;
                let Password = document.getElementById("password").value;
                let Password2 = document.getElementById("rpassword").value;
                let Email = document.getElementById("email").value;

                if(Password == Password2){
                    localStorage.setItem("password", Password);
                    localStorage.setItem("username", Username);
                    localStorage.setItem("email", Email);
                    alert("Successfully Stored to Local Storage");
                } else {
                    localStorage.clear();
                    alert("Password does not match!");
                }     
            }
    </script>
    <div class="register">
        <h1>Register</h1>
        <form onsubmit = "formReg()" method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label for="username">
                <img src="images/user.png" alt="Username" width="32" height="32">
            </label>
                <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <img src="images/password.png" alt="Password" width="32" height="32">
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <label for="password">
                <img src="images/password.png" alt="Password" width="32" height="32">
            </label>
            <input type="password" name="rpassword" placeholder="Retype Password" id="rpassword" required>
            <label for="email">
                <img src="images/email.png" alt="Email" width="32" height="32">
            </label>
            <input type="email" name="email" placeholder="Email" id="email" required>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
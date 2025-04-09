
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("auth/db_con.php");
include("auth/helper.php");
include("auth/dialog.php");

$username_email = $password = "";
if ($_SERVER["REQUEST_METHOD"] =="POST") {
    $username_email = test_input($_POST["uname-email"]);
    $password = test_input($_POST["password"]);

    $stmt = $mydatabase->prepare("SELECT user_id, username, role_user, password_hash FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            openDialog(['Your username or email does not exist!', 'Register now']);
        });
        </script>";
    }
    else {
        $result = $result->fetch_assoc();
        $hashed_password = $result["password_hash"];
        if (password_verify($password, $hashed_password)) {
            echo "<script>console.log('Login successfully!');</script>";
            $_SESSION['user_id'] = $result["user_id"];
            $_SESSION['username'] = $result["username"]; // Store the username in session
            $_SESSION['role'] = $result["role_user"]; // Set the role to 'user' after login
            if ($_SESSION['role'] === 'user') {
                // echo "<script>window.location.href = 'index.php?page=user';</script>";
                echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";
            } else if ($_SESSION['role'] === 'admin') {
                echo "<script>window.location.href = 'index.php?page=admin';</script>";
                echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";
            } else {
                echo "<script>window.location.href = 'index.php?page=login';</script>";
            }

   
        }
        else {
            echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                openDialog(['Your username or email or password is incorrect!']);
            });
            </script>";
        }
    }
}

include_once("helper.php");
include_once("dialog.php");

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Exam Website</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
    </head>

    <body>
    <div class="signin-container">
    <div class="form-container">
        <div class="form-header">
            <p class="p1">Sign In</p>
            <p class="p2">Welcome back!</p>
        </div>

        <form action="<?=$_SERVER['PHP_SELF'].'?page=login'?>" method="POST">                    
            <input class="username" type="text" placeholder="Email or username" name="uname-email" value="<?=htmlspecialchars($username_email)?>"required>
            
            <div class="password-container">
                <input class="password" type="password" placeholder="Password" name="password" value="<?=htmlspecialchars($password)?>" required>
                <!-- Show/Hide password + change the icon -->
                <img src="images/visible.png" class="toggle-password" width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
            </div>

            <button type="submit">
                Sign In
            </button>
        </form>

        <a class="forgot-password" href="index.php?page=forgotpssw">Forgot password?</a>

        <p>Don't have an account? &nbsp;
            <span> <a href="index.php?page=signup">Register Now</a></span>
        </p>
    </div>
</div>

    <script src="auth/auth.js"></script>
    <script src="auth/dialog.js"></script>
    </body>

</html>
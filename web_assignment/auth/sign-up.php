<script src="auth/auth.js"></script>
<script src="auth/dialog.js"></script>


<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include(__DIR__ . "/db_con.php");
include("auth/helper.php");
include("auth/dialog.php");
$email = $username = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['email']);
    $username = test_input($_POST['uname']);
    $password = test_input($_POST['password']);

    // check duplicate username, email
    $dialog_content = [];

    if (isEmailExist($email, $mydatabase)) {
        $dialog_content[] = "Email already exists!";
    }
    
    $stmt = $mydatabase->prepare("SELECT username FROM users WHERE username = ?");
    if (!$stmt) {
        printf("Prepare failed: (%d) %s\n", $mydatabase->errno, $mydatabase->error);
        die("Prepare failed: " . $mydatabase->error . "<br>SQL: " . $sql);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $dialog_content[] = "Username already exists!";
    }

    if (count($dialog_content) > 0) {
        // convert the list to string
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            openDialog(" . json_encode($dialog_content) . ");
        });
        </script>";
    }
    else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (email, username, password_hash, role_user) VALUES (?, ?, ?, 'user')";
        $stmt = $mydatabase->prepare($sql);
        if (!$stmt) {
            printf("Prepare failed: (%d) %s\n", $mydatabase->errno, $mydatabase->error);
            die("Prepare failed: " . $mydatabase->error . "<br>SQL: " . $sql);
        }
        $stmt->bind_param("sss", $email, $username, $hashed_password);
        if ($stmt->execute()) { 
            sendEmail(
                $email,
                "EXAMEASE: Account created successfully",
                "welcome",
                $username
            );      
            echo "<script>
                alert('Account created successfully! 🎉 🎉 🎉\\nPlease login to continue');
                window.location.href = 'index.php?page=login';
                console.log('Account created successfully!');
            </script>";                    
        } else {
            echo "<script>
                alert('Error: ".$mydatabase->error."\nPlease try again! 🥲');
            </script>";
        }
    }
}
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
        <div class="signup-container">
            <div class="form-container">
                <div class="form-header">
                    <p class="p1">Register Account</p>
                    <p class="p2">Hello new user! </p>
                    <p class="p3">Register to be able to attend the tests</p>
                </div>

                <form class="signup-form" action="<?=htmlspecialchars($_SERVER['PHP_SELF']).'?page=signup'?>" method="POST">
                    <p class="form-note">
                        *Note: You must fill in all the fields
                    </p>
                    <input type="email" placeholder="Email" name="email" value="<?=htmlspecialchars($email)?>" maxlength="255" required>
                    <input class="username" type="text" placeholder="Username" name="uname" value="<?=htmlspecialchars($username)?>" maxlength="255" required>
                    <div class="acc-requirement">
                        <p>Username must:</p>
                        <!-- Check username requirement -->
                        <ul>
                            <li class="name-pattern invalid">begin with 1 letter and followed by letter(s) or digit(s) or underscore(s)</li>
                        </ul>
                    </div>
                    
                    <div class="password-container">
                        <input class="password" type="password" placeholder="Password" name="password" required>
                        <!-- Show/Hide password + change the icon -->
                        <img src="images/visible.png" class="toggle-password" 
                        width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                    </div>

                    <div class="acc-requirement">
                        <p>Password must include:</p>
                        <ul>
                        <!-- Check password requirement  -->
                            <li class="pssw-len invalid">at least 8 characters</li>
                            <li class="pssw-char invalid">both letter(s) and digit(s) and (or) special characters:<br>
                                ., !, @, #, $, %, ^, &, * </li>
                        </ul>
                    </div>
                    <div class="password-container">
                        <input class="password-cf invalid-border" type="password" placeholder="Confirm password" name="password-cf" required>
                        <!-- Show/Hide password + change the icon -->
                        <img src="images/visible.png" class="toggle-password-cf"
                        width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                    </div>

                    <button type="submit">
                        Create account
                    </button>
                </form>

                <p>Already has an account? &nbsp;
                    <span> <a href="index.php?page=login">Login</a></span>
                </p>
            </div>
        </div>

        <script src="auth/auth.js"></script>
        <script src="auth/dialog.js"></script>
    </body>
</html>

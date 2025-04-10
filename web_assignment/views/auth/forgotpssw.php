<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if  ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = test_input($_POST['email']);
    if (isEmailExist($email, $mydatabase)) {
        if (sendEmail($email, "EXAMEASE: Reset Password", "reset")) {
            $_SESSION['email'] = $email;
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    openDialog(['Please check your email (including the spam folder) for a link to reset your password!']);
                });
            </script>";
        } else {
            echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    openDialog(['Failed to send email!', 'Please try again.']);
                });
            </script>";
        }
    }
    else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                openDialog(['Email is not registered!', 'Please register an account.']);
            });
        </script>";
    }
}
?>

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
                    <p class="p1">Forgot passwords?</p>
                    <p class="p2">Please enter your email to reset your password.</p>
                </div>

                <form action="<?=$_SERVER['PHP_SELF'].'?page=forgotpssw'?>" method="POST">                    
                    <input type="email" placeholder="Email" name="email" required>
                    <button type="submit">
                        Continue 
                        &nbsp; &nbsp; <img src="images/right-arrow-white.png" alt="right-arrow" width="25" height="25">
                    </button>
                </form>

                <p>Don't have an account? &nbsp;
                    <span> <a href="index.php?page=signup">Register Now</a></span>
                </p>
            </div>
        </div>

        <script src="auth/auth.js"></script>
        <script src="auth/dialog.js"></script>
    </body>
</html>




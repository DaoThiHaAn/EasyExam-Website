<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("helper.php");

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
include __DIR__.'/../views/auth/forgotpssw.php';

?>
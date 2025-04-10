<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("helper.php");
include("./views/dialog.php");

$password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $password = test_input($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $mydatabase->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        session_unset();
        session_destroy();
        echo "<script>
                alert('Password reset successfully! \\nPlease login to continue');
                window.location.href = 'index.php?page=login';
                console.log('Password reset successfully!');
              </script>";
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    openDialog(['Failed to reset password! Please try again.']);
                });
              </script>";
    }
}
?>
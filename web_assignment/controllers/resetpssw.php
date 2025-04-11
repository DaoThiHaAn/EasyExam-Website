<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . "/helper.php";

$password = "";
if (isset($_GET['email'])) {
    $_SESSION['email'] = test_input($_GET['email']);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_SESSION['email'];
    $password = test_input($_POST["password"]);
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $mydatabase->prepare("UPDATE users SET password_hash = ? WHERE email = ?");
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        session_unset();
        session_destroy();
        echo "<script>
                alert('Password reset successfully! \\nPlease login to continue');
                window.location.href = 'index.php?page=sign-in';
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
include __DIR__ . "/../views/auth/resetpssw.php";
?>
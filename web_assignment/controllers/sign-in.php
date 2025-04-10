
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$mydatabase = new mysqli("localhost", "root", "", "web");
if ($mydatabase->connect_error) {
    die("Connection failed: " . $mydatabase->connect_error);
}

include __DIR__."/helper.php";

$username_email = $password = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username_email = test_input($_POST["uname-email"]);
    $password = test_input($_POST["password"]);

    $stmt = $mydatabase->prepare("SELECT user_id, username, role_user, password_hash FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username_email, $username_email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
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
            echo "<script>console.log('User role: " . $_SESSION['role'] . "');</script>";
            if ($_SESSION['role'] === 'user') {
                echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";
                echo "<script>window.location.href = 'index.php?page=home';</script>";
            } else if ($_SESSION['role'] === 'admin') {
                echo "<script>window.location.href = 'index.php?page=adminDashboard';</script>";
                echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";
            } else {
                echo "<script>window.location.href = 'index.php?page=sign-in';</script>";
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

include __DIR__."/../views/auth/sign-in.php";

?>

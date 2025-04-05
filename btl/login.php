<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

// Kết nối MySQL bằng MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        
        $stmt = $conn->prepare("SELECT id, password,role FROM account WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        $stmt->bind_result($id, $hashed_password,$role);
        $stmt->fetch();
        if($role == 'admin'){
            $hashed_password =  password_hash($hashed_password, PASSWORD_BCRYPT);
        }
            
            
        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            if ($role == 'admin') {
                header("Location: index.php?page=admin_dashboard");
            } else {
                header("Location: index.php?page=user_dashboard");
            }
        } else {
            $message = "<p style='color: red; font-weight: bold;'>❌ Sai mật khẩu!</p>";
        }
        
        $stmt->close();
    } else {
        $message = "<p style='color: red; font-weight: bold;'>❌ Vui lòng nhập đủ thông tin!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Login</title>
 <link rel="stylesheet" href="css/style.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <main>
        <div class="login">
            <div class="left">
                <h2>Login to Your Account</h2>
            </div>
            <section class="right">
                <form method="POST">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
        
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>

                    <button type="submit">Login</button>

                    <!-- ✅ Hiển thị thông báo ngay dưới nút Login -->
                    <div class="message">
                        <?php echo $message; ?>
                    </div>
                </form>
                <p>Don't have an account? <a href="index.php?page=signup">Sign up here</a>.</p>
            </section>
        </div>
    </main>
</body>
</html>

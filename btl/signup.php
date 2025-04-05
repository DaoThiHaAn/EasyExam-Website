
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shop";

// Kết nối MySQL bằng MySQLi
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $gmail = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO account (username,email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        $message = "<p style='color: green; font-weight: bold;'>Đăng ký thành công!</p>"; 
    } else {
        $message = "<p style='color: red; font-weight: bold;'>Lỗi: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>My New Website</title>
 <link rel="stylesheet" href="css/style.css">
 
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://apis.google.com/js/platform.js" async defer></script>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.4/katex.min.css">
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.4/katex.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/KaTeX/0.16.4/contrib/auto-render.min.js"
  onload="renderMathInElement(document.body, {delimiters: [{left: '$', right: '$', display: false}, {left: '$$', right: '$$', display: true}]});"></script>

</head>

<body>
    <main>
        <div class="login">
            <div >
                <h2>Sign up Your Account

                </h2>
            </div>
            <section >
                    <form method = "POST">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" required>
            
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" required>

                        <button type="submit">Sign Up</button>
                        <div class="message">
                        <?php 
                        echo $message; ?>
                        </div>
                    </form>
            </section>
        </div>
    </main>
</body>

</html>

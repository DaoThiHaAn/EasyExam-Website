<?php
    include("../auth/db_con.php");
    $query = "SELECT * FROM users WHERE username = '" .$_SESSION['username'] ."';";
    $result = $mydatabase->query($query)->fetch_assoc();
?>

<html lang="en">
    <head>
        <title>Exam Website</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
        <link rel="stylesheet" href="profile.css">
    </head>

    <body>
        <div class="profile-container">
            <div class="profile-header">
                <h2>Profile Information</h2>
                <p>Role: <?= htmlspecialchars($_SESSION['role']); ?></p>
            </div>

            <div class="profile-info">
                <label>Username:</label>
                <p><?php echo htmlspecialchars($_SESSION['username']); ?></p>
            </div>

            <div class="profile-info">
                <label>Email:</label>
                <p><?php echo htmlspecialchars($result['email']); ?></p>
            </div>

            <div class="actions">
                <a href="#">Edit Email</a>
                <a href="index.php?page=resetpssw">Change Password</a>
                <a href="#">Test History</a>
                <a class="logout" onclick="openLogoutDialog()">Logout</a>
            </div>

            <button class="del-btn" onclick="openDeleteDialog()">Delete account</button>
        </div>

        <script src="auth/auth.js"></script>
        <script src="auth/dialog.js"></script>
    </body>
</html>



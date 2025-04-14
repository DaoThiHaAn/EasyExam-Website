<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<html lang="en">
    <head>
        <?php include __DIR__.'/../../include/head.php'; ?>
        <link rel="stylesheet" href="./css/dialog.css">
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/account.css">
        <title>Admin panel</title>
    </head>

    <body>
        <?php include __DIR__.'/../../include/navbar.php'; ?>
        <main class="admin-content-area">
            <h2 class="mt-4">Profile Information</h2>
            <p class="text-muted">Role: <?= htmlspecialchars($_SESSION['role']); ?></p>

            <section class="mb-3 admin account-info">
                <label class="form-label fw-bold">Username:</label>
                <div class="cell form-control bg-light"><?= htmlspecialchars($_SESSION['username']); ?></div>
                <label class="form-label fw-bold">Email:</label>
                <div class="cell form-control bg-light"><?= htmlspecialchars($_SESSION['email']); ?></div>
            </section>

            <button class="pssw-btn btn" onclick="window.location.href='index.php?page=resetpssw'">Change Password</button>

            <button class="delete-btn btn btn-outline-danger" onclick="openDeleteDialog()">Delete Account</button>

        </main>
        <?php include __DIR__.'/../../views/dialog.php'; ?>
            
        <?php include __DIR__.'/../../include/footer.php'; ?>
        <script src="./js/auth.js"></script>
        <script src="./js/dialog.js"></script>

    </body>
</html>
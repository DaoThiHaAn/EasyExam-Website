<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$page = isset($_GET['page']) ? $_GET['page'] : 'admin';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userDashboard.css">
    <script src="https://kit.fontawesome.com/10749a358e.js" crossorigin="anonymous"></script>
    <title>Admin panel</title>
</head>
<body>

<div class="sidebar" id="sidebar">
    <ul>
        <li>
            <a href="#" class="nav-item" id="toggleSidebar">
                <i class="fas fa-clinic-medical"></i>
                <div class="title">Logo</div>
            </a>
        </li>
        <li>
            <a href="index.php?page=admin" class="nav-item <?= ($page === 'admin') ? 'active' : '' ?>">
                <i class="fas fa-th-large"></i>
                <div class="title">Dashboard</div>
            </a>
        </li>
        <li>
            <a href="index.php?page=admin_edit" class="nav-item <?= ($page === 'admin_edit') ? 'active' : '' ?>">
                <i class="fa-solid fa-pen-to-square"></i>
                <div class="title">Edit</div>
            </a>
        </li>
        <li>
            <a href="index.php?page=admin_create_test" class="nav-item <?= ($page === 'admin_create_test') ? 'active' : '' ?>">
                <i class="fa-solid fa-plus"></i>
                <div class="title">Creat Tests</div>
            </a>
        </li>
        <li>
            <a href="index.php?page=profile" class="nav-item <?= ($page === 'profile') ? 'active' : '' ?>">
                <i class="fa-regular fa-user"></i>
                <div class="title">Profiles</div>
            </a>
        </li>
        <li>
            <a href="index.php?page=admin_history" class="nav-item <?= ($page === 'reports') ? 'active' : '' ?>">
                <i class="fa-solid fa-square-poll-vertical"></i>
                <div class="title">Reports</div>
            </a>
        </li>
        <li>
            <a href="models/logout.php" class="nav-item">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                <div class="title">Log Out</div>
            </a>
        </li>
    </ul>
</div>


<!-- <script>
document.getElementById('toggleSidebar').addEventListener('click', function (e) {
    e.preventDefault();
    document.getElementById('sidebar').classList.toggle('collapsed');
    document.getElementById('mainContent').classList.toggle('shifted');
});
</script> -->

</body>
</html>

<!DOCTYPE html>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role'])) {
    $_SESSION['role'] = 'guest';
}

echo "<script>console.log('Session: " . $_SESSION['role'] . "');</script>";

$mydatabase = new mysqli("localhost", "root", "", "web");
if ($mydatabase->connect_error) {
    die("Connection failed: " . $mydatabase->connect_error);
}

if (!isset($_GET['page']) || empty($_GET['page'])) {
    header('Location: index.php?page=home');
    exit();
}

// Kiểm tra nếu người dùng chưa đăng nhập và trang yêu cầu đăng nhập
$protectedPages = ['resetpssw']; // Các trang yêu cầu đăng nhập

$page = isset($_GET['page']) ? $_GET['page'] : 'home';  
$controllerFile = 'controllers/' . $page . '.php';
echo "<script>console.log('Controller file: $controllerFile ');</script>";

// Kiểm tra nếu trang yêu cầu đăng nhập nhưng chưa đăng nhập
if (in_array($page, $protectedPages) && !isset($_SESSION['user_id'])) {
    die("Access Denied. Please <a href='index.php?page=sign-in'>Sign In</a>.");
}

// Kiểm tra quyền truy cập (Ví dụ: chỉ admin mới có thể vào trang quản trị)
$adminPages = ['admin', 'admin_create_test','admin_history','admin_manage_questions','admin_statistic','admin_view_question','adminProfile']; // Các trang chỉ dành cho admin
if (in_array($page, $adminPages) && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
    die("Access Denied. You do not have permission to access this page.");
}

$userPages = ['user', 'result','profile','doTest','user_history']; // Các trang chỉ dành cho user
if (in_array($page, $userPages) && (!isset($_SESSION['role']) || $_SESSION['role'] == 'guest')) {
    die("Access Denied. You do not have permission to access this page.");
}

// Nếu file controller tồn tại, tải file đó
if (file_exists($controllerFile)) {
    include $controllerFile;
    
} else {
    echo "404 - Page not found";
}
?>

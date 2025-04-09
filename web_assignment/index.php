<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Kiểm tra nếu người dùng chưa đăng nhập và trang yêu cầu đăng nhập
$protectedPages = ['admin_dashboard','user_dashboard', 'profile', 'settings']; // Các trang yêu cầu đăng nhập

$page = isset($_GET['page']) ? $_GET['page'] : 'home';  
$controllerFile = 'controllers/' . $page . '.php';

// Kiểm tra nếu trang yêu cầu đăng nhập nhưng chưa đăng nhập
if (in_array($page, $protectedPages) && !isset($_SESSION['user_id'])) {
    die("Access Denied. Please <a href='index.php?page=login'>log in</a>.");
}

// Kiểm tra quyền truy cập (Ví dụ: chỉ admin mới có thể vào trang quản trị)
$adminPages = ['admin', 'manage_users']; // Các trang chỉ dành cho admin
if (in_array($page, $adminPages) && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
    die("Access Denied. You do not have permission to access this page.");
}

$userPages = ['user_dashboard', 'manage_users']; // Các trang chỉ dành cho user
if (in_array($page, $userPages) && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user')) {
    die("Access Denied. You do not have permission to access this page.");
}

// Nếu file controller tồn tại, tải file đó
if (file_exists($controllerFile)) {
    include $controllerFile;
    
} else {
    echo "404 - Page not found";
}
?>

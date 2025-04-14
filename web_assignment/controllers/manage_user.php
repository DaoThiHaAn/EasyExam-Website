<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get any role filter from request
$roleFilter = isset($_GET['role_filter']) ? $_GET['role_filter'] : '';

// Determine current page and limit per page
$currentPage = isset($_GET['p']) ? intval($_GET['p']) : 1;
$limit = 15;
$offset = ($currentPage - 1) * $limit;
$where = "";
if(!empty($roleFilter)) {
    $roleSafe = $mydatabase->real_escape_string($roleFilter);
    $where = "WHERE role_user = '$roleSafe'";
}

// Get total user count for pagination and display
$countQuery = "SELECT COUNT(*) AS total FROM users $where";
$countResult = $mydatabase->query($countQuery);
$totalUsers = ($countResult) ? $countResult->fetch_assoc()['total'] : 0;

// Retrieve users data with limit and offset
$query = "SELECT username, email, role_user FROM users $where LIMIT $limit OFFSET $offset";
$result = $mydatabase->query($query);
$users = array();
if($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
        $users[] = $row;
    }
} 

// Calculate total pages for pagination
$totalPages = ceil($totalUsers / $limit);

// Pass variables to the view
include __DIR__.'/../views/admin/viewManageUser.php';
?>
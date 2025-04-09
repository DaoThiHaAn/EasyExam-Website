<script src="auth/auth.js"></script>
<script src="auth/dialog.js"></script>
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'views/home.php';
?>
<?php
$mydatabase->query("DELETE FROM users WHERE username = '" .$_SESSION['username'] ."';");
if ($mydatabase->affected_rows > 0) {
    echo "<script>
    alert('Account deleted successfully!');
    window.location.href = 'index.php?page=logout-complete';
    </script>";
} else {
    echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        openDialog(['Failed to delete your account!', 'Please try again.']);
    });
    </script>";
}
?>
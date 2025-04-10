<?php
session_start();
session_unset();     
session_destroy();    
header("Location: index.php?page=home"); // Redirect to home page after logout
exit();
?>
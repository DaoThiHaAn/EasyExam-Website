<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include("./include/head.php"); ?>
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
    </head>
    <body>
        <?php include __DIR__."/../dialog.php"; ?>
        <div class="signin-container">
            <div class="form-container">
                <div class="form-header">
                    <p class="p1">Reset Password</p>
                    <p class="p2">Please enter your new password below:</p>
                </div>
                <form class="reset-form" action="<?=$_SERVER['PHP_SELF'].'?page=resetpssw'?>" method="POST">
                    <div class="password-container">
                        <input class="password" type="password" placeholder="Password" name="password" required>
                        <!-- Show/Hide password + change the icon -->
                        <img src="images/visible.png" class="toggle-password" width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                    </div>
                    <div class="acc-requirement">
                        <p>Password must include:</p>
                        <ul>
                            <!-- Check password requirement  -->
                            <li class="pssw-len invalid">at least 8 characters</li>
                            <li class="pssw-char invalid">both letter(s) and digit(s) and (or) special characters:<br>
                                ., !, @, #, $, %, ^, &, *</li>
                        </ul>
                    </div>
                    <div class="password-container">
                        <input class="password-cf invalid-border" type="password" placeholder="Confirm password" name="password-cf" required>
                        <!-- Show/Hide password + change the icon -->
                        <img src="images/visible.png" class="toggle-password-cf" width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                    </div>
                    <button type="submit">
                        Continue 
                        &nbsp; &nbsp; <img src="images/right-arrow-white.png" alt="right-arrow" width="25" height="25">
                    </button>
                </form>
            </div>
        </div>
        <script src="./js/auth.js"></script>
        <script src="./js/dialog.js"></script>
    </body>
</html>




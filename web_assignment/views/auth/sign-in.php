<html lang="en">
    <head>
        <?php include './include/head.php'; ?>
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
    </head>

    <body>
    <?php 
    include("./views/dialog.php");
    include './include/navbar.php'; ?>
    <section class="signin-container">
        <div class="form-container">
            <div class="form-header">
                <p class="p1">Sign In</p>
                <p class="p2">Welcome back!</p>
            </div>

            <form action="<?=$_SERVER['PHP_SELF'].'?page=sign-in'?>" method="POST">                    
                <input class="username" type="text" placeholder="Email or username" name="uname-email" value="<?=htmlspecialchars($username_email)?>"required>
                
                <div class="password-container">
                    <input class="password" type="password" placeholder="Password" name="password" value="<?=htmlspecialchars($password)?>" required>
                    <!-- Show/Hide password + change the icon -->
                    <img src="././images/visible.png" class="toggle-password" width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                </div>

                <button type="submit">
                    Sign In
                </button>
            </form>

            <a class="forgot-password" href="index.php?page=forgotpssw">Forgot password?</a>

            <p>Don't have an account? &nbsp;
                <span> <a href="index.php?page=sign-up">Register Now</a></span>
            </p>
        </div>
    </section>

    
    <script src="./js/auth.js"></script>
    <script src="./js/dialog.js"></script>
    </body>
</html>
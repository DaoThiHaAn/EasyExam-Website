<html lang="en">
    <head>
        <?php include __DIR__.'/../../include/head.php'; ?>
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
    </head>

    <body>
        <?php 
        include("./views/dialog.php");
        include './include/navbar.php'; ?>
        <div class="signin-container">
            <div class="form-container">
                <div class="form-header">
                    <p class="p1">Forgot passwords?</p>
                    <p class="p2">Please enter your email to reset your password.</p>
                </div>

                <form action="<?=$_SERVER['PHP_SELF'].'?page=forgotpssw'?>" method="POST">                    
                    <input type="email" placeholder="Email" name="email" required>
                    <button type="submit">
                        Continue 
                        &nbsp; &nbsp; <img src="./images/right-arrow-white.png" alt="right-arrow" width="25" height="25">
                    </button>
                </form>

                <p>Don't have an account? &nbsp;
                    <span> <a href="index.php?page=sign-up">Register Now</a></span>
                </p>
            </div>
        </div>

        <script src="./js/auth.js"></script>
        <script src="./js/dialog.js"></script>
    </body>
</html>




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

        <section class="signup-container">
            <div class="form-container">
                <div class="form-header">
                    <p class="p1">Register Account</p>
                    <p class="p2">Hello new user! </p>
                    <p class="p3">Register to be able to attend the tests</p>
                </div>

                <form class="signup-form" action="<?=htmlspecialchars($_SERVER['PHP_SELF']).'?page=sign-up'?>" method="POST">
                    <p class="form-note">
                        *Note: You must fill in all the fields
                    </p>
                    <input type="email" placeholder="Email" name="email" value="<?=htmlspecialchars($email)?>" maxlength="255" required>
                    <input class="username" type="text" placeholder="Username" name="uname" value="<?=htmlspecialchars($username)?>" maxlength="255" required>
                    <div class="acc-requirement">
                        <p>Username must:</p>
                        <!-- Check username requirement -->
                        <ul>
                            <li class="name-pattern invalid">begin with 1 letter and followed by letter(s) or digit(s) or underscore(s)</li>
                        </ul>
                    </div>
                    
                    <div class="password-container">
                        <input class="password" type="password" placeholder="Password" name="password" required>
                        <!-- Show/Hide password + change the icon -->
                        <img src="././images/visible.png" class="toggle-password" 
                        width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                    </div>

                    <div class="acc-requirement">
                        <p>Password must include:</p>
                        <ul>
                        <!-- Check password requirement  -->
                            <li class="pssw-len invalid">at least 8 characters</li>
                            <li class="pssw-char invalid">both letter(s) and digit(s) and (or) special characters:<br>
                                ., !, @, #, $, %, ^, &, * </li>
                        </ul>
                    </div>
                    <div class="password-container">
                        <input class="password-cf invalid-border" type="password" placeholder="Confirm password" name="password-cf" required>
                        <!-- Show/Hide password + change the icon -->
                        <img src="././images/visible.png" class="toggle-password-cf"
                        width="20" height="20" alt="visible icon" onclick="togglePassword(this)">
                    </div>

                    <button type="submit">
                        Create account
                    </button>
                </form>

                <p>Already has an account? &nbsp;
                    <span> <a href="index.php?page=sign-in">Sign In</a></span>
                </p>
            </div>
        </section>
        <script src="./js/auth.js"></script>
        <script src="./js/dialog.js"></script>
    </body>
</html>

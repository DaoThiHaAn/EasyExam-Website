<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__.'/../include/head.php'; ?>
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
    </head>

    <body>
        <dialog class="dialog-container" style="display: flex;">
            <div class="dialog" style="width: 25%">
                <h3 class="dialog-header">WARNING!</h3>

                <div class="dialog-body">
                    <div class="content">
                        <p>Are you sure to logout? 😟</p>
                    </div>
                    <div class="dialog-btn">
                        <button class="cancel-btn" style="display: block;" onclick="closeLogoutDialog()">Cancel</button>
                        <button class="ok-btn" onclick="confirmLogout()">OK</button>
                    </div>
                </div>
            </div>
        </dialog>

        <script src="./js/auth.js"></script>
        <script src="./js/dialog.js"></script>
    </body>
</html>
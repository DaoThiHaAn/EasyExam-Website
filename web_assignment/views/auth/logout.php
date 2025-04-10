<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__.'/../../include/head.php'; ?>
        <link rel="stylesheet" href="./css/auth.css">
        <link rel="stylesheet" href="./css/dialog.css">
    </head>

    <body>
        <?php 
        include './include/navbar.php'; ?>
        <dialog class="dialog-container">
            <div class="dialog">
                <h3 class="dialog-header">WARNING!</h3>

                <div class="dialog-body">
                    <div class="content"></div>
                    <div class="dialog-btn">
                        <button class="cancel-btn" onclick="closeDialog()">Cancel</button>
                        <button class="ok-btn" onclick="confirmLogout()">OK</button>
                    </div>
                </div>
            </div>
        </dialog>

        <?php include './include/footer.php'; ?>  
        <script src="./js/auth.js"></script>
        <script src="./js/dialog.js"></script>
    </body>
</html>




<?php
if (!isset($_GET['tab'])) {
    header("Location: index.php?page=profile&tab=account");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include __DIR__.'/../../include/head.php'; ?>
    <link rel="stylesheet" href="./css/auth.css">
    <link rel="stylesheet" href="./css/dialog.css">
    <link rel="stylesheet" href="./css/profile.css">
</head>
<body>
    <?php 
    include __DIR__.'/../../views/dialog.php';
    include __DIR__.'/../../include/navbar.php'; ?>
            <!-- Offcanvas Sidebar for small screens -->
    <div class="d-md-none">
        <button class="offcanvas-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar" aria-controls="offcanvasSidebar">
            <i class="bi bi-grid"></i>
        </button>
        <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasSidebarLabel">Student Panel</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav flex-column">
                    <li class="nav-item<?php echo ($_GET['tab']==='account') ? ' active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=profile&tab=account">Account</a>
                    </li>
                    <li class="nav-item <?php echo ($_GET['tab']==='test_history') ? 'active' : ''; ?>">
                        <a class="nav-link" href="index.php?page=profile&tab=test_history">Test History</a>
                    </li>
                    <li class="nav-item <?php echo ($_GET['tab']==='resetpssw') ? 'active' : '';?>">
                        <a class="nav-link" href="index.php?page=profile&tab=resetpssw">Change Password</a>
                    </li>
                    <li class="nav-item">
                        <button class="delete-btn btn btn-outline-danger w-100" onclick="openDeleteDialog()">Delete Account</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="main-row container-fluid d-flex flex-column flex-md-row">
        <!-- Sidebar for medium and up -->
        <section class="sidebar d-none d-md-block col-md-3 col-lg-2">
            <h4 class="text-center">Student Dashboard</h4>
            <ul class="nav flex-column">
                <li class="nav-item <?php echo ($_GET['tab']==='account') ? 'active' : ''; ?>">
                    <!-- Link with tab query parameter -->
                    <a class="nav-link" href="index.php?page=profile&tab=account">Account</a>
                </li>
                <li class="nav-item <?php echo ($_GET['tab']==='test_history') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=profile&tab=test_history">Test History</a>
                </li>
                <li class="nav-item <?php echo ($_GET['tab']==='resetpssw') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php?page=resetpssw">Change Password</a>
                </li>
                <li class="nav-item">
                    <button class="btn btn-outline-danger mt-3" onclick="openDeleteDialog()">Delete Account</button>
                </li>
            </ul>
        </section>


        <!-- Main content area (takes remaining space) -->
        <main class="content-area px-4 flex-fill">
            <?php
                // Load main content based on active tab
                switch($_GET['tab']) {
                    case 'account':
                        include __DIR__.'/account.php';
                        break;
                    case 'test_history':
                        include __DIR__.'/test_history.php';
                        break;
                    case 'resetpssw':
                        include __DIR__.'/resetpssw.php';
                        break;
                    default:
                        echo "<p>Invalid tab selected.</p>";
                }
            ?>
        </main>
    </section>


    
    <?php include __DIR__.'/../../include/footer.php'; ?>
    
    <!-- Include Bootstrap JS (make sure it’s loaded after your HTML) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Your additional JS -->
    <script src="./js/auth.js"></script>
    <script src="./js/dialog.js"></script>
</body>
</html>
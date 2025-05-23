<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home') ? '#carousel' : 'index.php?page=home'; ?>">
            <img src="./images/logo.jpg" class="rounded-circle" alt="logo" height="50px">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- TOÀN BỘ phần có thể thu gọn được -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'admin') { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ($_GET['page'] == 'home') ? '#carousel' : 'index.php?page=home'; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ($_GET['page'] == 'home') ? '#about' : 'index.php?page=about'; ?>">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= ($_GET['page'] == 'home') ? '#category' : 'index.php?page=preview_test'; ?>">Test</a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=admin">Dashboard</a>
                    </li>
                <?php } ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home') ? '#contact' : 'index.php?page=contact'; ?>">Contact</a>
                </li>

                <?php if (!isset($_SESSION['role']) || $_SESSION['role'] === 'guest') { ?>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="index.php?page=sign-in">Get Started!</a>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <!-- ✅ usermode được đưa ra ngoài phần collapse -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] !== 'guest') {
            if ($_SESSION['role'] == 'admin')
                $img_src = './images/admin-icon.png';
            else
                $img_src = './images/profile.png';
            ?>
            <div class="d-flex align-items-center ms-3">
                <a class="nav-link account d-flex align-items-center" href="<?= ($_SESSION['role'] == 'user') ? 'index.php?page=profile' : 'index.php?page=adminProfile'; ?>">
                    <img src="<?= $img_src ?>" alt="User icon" width="25" height="25" class="me-2">
                    <?= $_SESSION['username'] ?>
                </a>
                <a class="btn btn-primary ms-2 logout" href="index.php?page=logout">Log Out</a>
            </div>
        <?php } ?>
    </div>
</nav>

<script>
    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 10) {
            $('.navbar').addClass('navbar-shadow');
        } else {
            $('.navbar').removeClass('navbar-shadow');
        }
    });
</script>

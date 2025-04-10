<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home')?'#carousel':'index.php?page=home'; ?>">
            <img src="./images/logo.jpg" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expand="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home')?'#carousel':'index.php?page=home'; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home')?'#about':'index.php?page=about'; ?>">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home')?'#category':'index.php?page=category'; ?>">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= (isset($_GET['page']) && $_GET['page'] == 'home')?'#contact':'index.php?page=contact'; ?>">Contact</a>
                </li>
                <li>
                    <a class="btn btn-primary" href="index.php?page=sign-in">Get Started!</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

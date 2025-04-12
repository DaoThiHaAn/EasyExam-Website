<nav class="navbar bg-light sidebar d-flex flex-column">
  <a class="navbar-brand mb-4" href="index.php?page=admin">
    <img src="./images/logo.jpg" alt="Logo" class="rounded-circle logo">
  </a>
  <ul class="navbar-nav flex-column w-100 text-center">

    <div class="admin-account">
        <img src="./images/admin-icon.png" alt="User icon" width="25" height="25">
        <?= $_SESSION['username'] ?>
    </div>

    <li class="nav-item">
      <a class="nav-link <?= ($page === 'admin') ? 'active' : '' ?>" href="index.php?page=user">
        <i class="fas fa-th-large"></i>
        <span class="ms-2">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= ($page === 'admin_create_test') ? 'active' : '' ?>" href="index.php?page=view_question_test">
        <i class="fa-solid fa-plus"></i>
        <span class="ms-2">Take Tests</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= ($page === 'profile') ? 'active' : '' ?>" href="index.php?page=profile">
        <i class="fa-solid fa-user"></i>
        <span class="ms-2">Profiles</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= ($page === 'reports') ? 'active' : '' ?>" href="index.php?page=user_history">
        <i class="fa-solid fa-square-poll-vertical"></i>
        <span class="ms-2">Statistics</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link <?= ($page === 'contact') ? 'active' : '' ?>" href="index.php?page=contact">
      <i class="fa-solid fa-envelope"></i>
      <span class="ms-2">Contact</span>
      </a>
    </li>
    <!-- This logout item will stick to the bottom using mt-auto -->
    <li class="nav-item mt-auto">
      <button class="logout btn" onclick="window.location.href='index.php?page=logout'">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <span class="ms-2">Log Out</span>
      </button>
    </li>
  </ul>
</nav>


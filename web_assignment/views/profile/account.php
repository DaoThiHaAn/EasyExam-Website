<main class="content-area px-4 flex-fill">
    <h2 class="mt-4">Profile Information</h2>
    <p class="text-muted">Role: <?= htmlspecialchars($_SESSION['role']); ?></p>

    <section class="mb-3 account-info">
        <label class="form-label fw-bold">Username:</label>
        <div class="cell form-control bg-light"><?= htmlspecialchars($_SESSION['username']); ?></div>
        <label class="form-label fw-bold">Email:</label>
        <div class="cell form-control bg-light"><?= htmlspecialchars($_SESSION['email']); ?></div>
    </section>
</main>
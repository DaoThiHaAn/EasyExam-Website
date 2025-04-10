<main class="content-area px-4 flex-fill">
    <h2 class="mt-4">Profile Information</h2>
    <p class="text-muted">Role: <?= htmlspecialchars($_SESSION['role']); ?></p>

    <div class="mb-3">
        <label class="form-label fw-bold">Username:</label>
        <div class="form-control bg-light"><?= htmlspecialchars($_SESSION['username']); ?></div>
    </div>
</main>
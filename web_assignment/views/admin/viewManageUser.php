<html lang="en">
    <head>
        <?php include __DIR__."/../../include/head.php"; ?>
        <link rel="stylesheet" href="./css/manageUser.css">
    </head>

    <body>
        <?php include __DIR__."/../../include/navbar.php"; ?>

        <main class="container my-4">
            <h2 class="mb-4 text-center header-text">Manage Users</h2>
            
            <!-- Filter by role -->
            <form method="GET" action="index.php?page=manage_user" class="mb-4">
                <!-- Use the same page name for consistency -->
                <input type="hidden" name="page" value="manage_user">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <select name="role_filter" class="form-select">
                            <option value="">All Roles</option>
                            <option value="admin" <?php if($roleFilter === 'admin') echo 'selected'; ?>>Admin</option>
                            <option value="user" <?php if($roleFilter === 'user') echo 'selected'; ?>>User</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <p class="fw-bold mt-5">Total Results: <?= $totalUsers; ?></p>
            
            <!-- Users table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="bg-primary text-white text-center align-middle">
                        <tr>
                            <th>#</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(!empty($users)){
                        $count = $offset + 1;
                        foreach($users as $row){
                            echo "<tr>";
                            echo "<td class='text-center align-middle'>" . $count++ . "</td>";
                            echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['role_user']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>No users found.</td></tr>";
                    }
                    ?>
                    </tbody>
                </table>
            </div>
                        
            <!-- Pagination -->
            <?php if($totalPages >= 1){ ?>
            <nav aria-label="User Pagination">
                <ul class="pagination justify-content-center">
                    <?php
                    // Append role_filter to the query string if needed.
                    $roleParam = !empty($roleFilter) ? "&role_filter=" . urlencode($roleFilter) : "";
                    for($i = 1; $i <= $totalPages; $i++){
                        $active = ($i === $currentPage) ? "active" : "";
                        echo "<li class='page-item $active d-flex justify-content-center align-items-center'>
                                <a class='page-link' href='index.php?page=manage_user&p=$i$roleParam'>$i</a>
                              </li>";
                    }
                    ?>
                </ul>
            </nav>
            <?php } ?>            
        </main>


        <?php include __DIR__."/../../include/footer.php"; ?>
    </body>
</html>
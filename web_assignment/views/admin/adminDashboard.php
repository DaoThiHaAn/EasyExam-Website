<html lang="en">
<head>
	<?php include __DIR__.'/../../include/head.php'; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="css/adminDashboard.css">
    <title>Admin panel</title>
</head>
<body>	
    <main class="container">
		<?php include __DIR__.'/../../include/adminSidebar.php'; ?>

		
        <section class="main" id="mainContent">
			<div class="title">
				<h1>Welcome back,</h1>
				<h2><i><?= $_SESSION['username'] ?></i></h2>
			</div>
            
			<div class="tables">
				<div class="last-test">
                	<div class="heading">
                    	<h2>Available Tests</h2>
                    	<a href="index.php?page=admin_history" class="btn">View All</a>
                	</div>
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover test-tables">
							<thead>
								<tr>
									<td>Test</td>
									<td>Category</td>
									<td>Created By</td>
									<td>Time Created</td>
									<td>View</td>
									<td>Delete</td>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($tests as $test): ?>
								<tr>
									<td><?= htmlspecialchars($test['test_name']) ?></td>
									<td><?= htmlspecialchars($test['test_category']) ?></td>
									<td><?= htmlspecialchars($test['username']) ?></td>
									<td><?= htmlspecialchars($test['time_create']) ?></td>
									<td>
										<a href="index.php?page=admin_statistic&test_id=<?= $test['test_id'] ?>" title="View">
											<i class="far fa-eye eye-class"></i>
										</a>
									</td>
									<td>
										<a href="index.php?page=admin_delete_test&test_id=<?= $test['test_id'] ?>" 
											title="Delete" onclick="return confirm('Are you sure you want to delete this test?');">
											<i class="fa-solid fa-trash trash-class"></i>
										</a>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
            </div>
		</section>
    </main>

	<script src="./js/adminDashboard.js"></script>
	
</body>
</html>
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

		
        <div class="main" id="mainContent">
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
					<table class="test-tables">
						<thead>
							<td>Test</td>
							<td>Category</td>
							<td>Created By</td>
							<td>View</td>
						</thead>
						<tbody>
						<?php foreach ($tests as $test): ?>
							<tr>
								<td><?= htmlspecialchars($test['test_name']) ?></td>
								<td><?= htmlspecialchars($test['test_category']) ?></td>
								<td><?= htmlspecialchars($test['created_by']) ?></td>
								<td>
									<a href="index.php?page=admin_statistic&test_id=<?= $test['test_id'] ?>" title="View">
										<i class="far fa-eye"></i>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </main>

	<script src="./js/adminDashboard.js"></script>
	
</body>
</html>
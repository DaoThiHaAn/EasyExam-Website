<script>
	console.log(<?= json_encode($_SESSION) ?>);
</script>

<!DOCTYPE html>
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
				<h1>Admin Dashboard</h1>
				<p>Welcome back, <b><?= $_SESSION['username'] ?></b></p>
			</div>
            <div class="cards">
    			<a href="math-test.html" class="card" type="btn">
        			<div class="card-content">
            			<div class="card-name">Math test</div>
        			</div>
        			<div class="icon-box">
            			<i class="fa-solid fa-calculator"></i>
        			</div>
    			</a>
    			<a href="english-test.html" class="card" type="btn">
					<div class="card-content">
						<div class="card-name">English Test</div>
					</div>
					<div class="icon-box">
						<i class="fa-solid fa-arrow-down-a-z"></i>
					</div>
				</a>
				<a href="physics-test.html" class="card" type="btn">
					<div class="card-content">
						<div class="card-name">Physics Test</div>
					</div>
					<div class="icon-box">
						<i class="fa-solid fa-atom"></i>
					</div>
				</a>
			</div>
			<div class="tables">
				<div class="last-test">
                	<div class="heading">
                    	<h2>Last Tests</h2>
                    	<a href="./results.png" class="btn">View All</a>
                	</div>
					<table class="test-tables">
						<thead>
							<td>Test</td>
							<td>Time</td>
							<td>Point</td>
							<td>Actions</td>
						</thead>
						<tbody>
							<tr>
								<td>Math</td>
								<td>10:05/10-03-2025</td>
								<td>10</td>
								<td>
									<i class="far fa-eye"></i>
								</td>
							</tr>
							<tr>
								<td>English</td>
								<td>09:00/11-03-2025</td>
								<td>3</td>
								<td>
									<i class="far fa-eye"></i>
								</td>
							</tr>
							<tr>
								<td>Physics</td>
								<td>15:20/11-03-2025</td>
								<td>8</td>
								<td>
									<i class="far fa-eye"></i>
								</td>
							</tr>
							<tr>
								<td>Physics</td>
								<td>17:30/14-03-2025</td>
								<td>6</td>
								<td>
									<i class="far fa-eye"></i>
								</td>
							</tr>
							<tr>
								<td>English</td>
								<td>15:20/18-03-2025</td>
								<td>10</td>
								<td>
									<i class="far fa-eye"></i>
								</td>
							</tr>
							<tr>
								<td>Math</td>
								<td>20:40/20-03-2025</td>
								<td>9</td>
								<td>
									<i class="far fa-eye"></i>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
            </div>
        </div>
    </main>

	<script src="./js/adminDashboard.js"></script>
	
</body>
</html>
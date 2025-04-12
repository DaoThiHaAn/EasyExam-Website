<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$tests = [];
$sql = "SELECT test_id, test_name, test_category, created_by FROM tests ORDER BY test_id DESC LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $tests[] = $row;
}
?>

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
    			<a href="index.php?page=admin_edit" class="card" type="btn">
        			<div class="card-content">
            			<div class="card-name">Edit</div>
        			</div>
        			<div class="icon-box">
            			<i class="fa-solid fa-calculator"></i>
        			</div>
    			</a>
    			<a href="index.php?page=admin_create_test" class="card" type="btn">
					<div class="card-content">
						<div class="card-name">Create Tests</div>
					</div>
					<div class="icon-box">
						<i class="fa-solid fa-arrow-down-a-z"></i>
					</div>
				</a>
				<a href="index.php?page=profile" class="card" type="btn">
					<div class="card-content">
						<div class="card-name">Profile</div>
					</div>
					<div class="icon-box">
						<i class="fa-solid fa-atom"></i>
					</div>
				</a>
			</div>
			<div class="tables">
				<div class="last-test">
                	<div class="heading">
                    	<h2>Result of Tests</h2>
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
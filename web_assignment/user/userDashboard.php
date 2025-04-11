<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'models/getHistoryUser.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/userDashboard.css">
    <title>Admin panel</title>
</head>
<body>
    <div class="container">
	<?php include('include/userSidebar.php'); ?>

		
        <div class="main">
			<div class="top-bar">
                <i class="fas fa-bell"></i>
                <div class="user">
                    <img src="images/pokemonUser.png" alt="User">
                </div>
        	</div>
			<div class="title">
				<h1>Dashboard</h1>
				<p>Welcome back, User</p>
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
                    	<a href="index.php?page=user_history" class="btn">View All</a>
                	</div>
					<?php if (empty($history)): ?>
						<div class="alert alert-info text-center">
							Bạn chưa làm bài kiểm tra nào.
						</div>
					<?php else: ?>
						<div class="tables">
								<div class="last-test">
									<table class="test-tables">
										<thead>
											<td>Test</td>
											<td>Time</td>
											<td>Total Questions</td>
											<td>Point</td>
											<td>Actions</td>
										</thead>
										<tbody>
											<?php foreach ($history as $entry): ?>
											<tr>
												<td><?= htmlspecialchars($entry['test_name']) ?></td>
												<td><?= date("d/m/Y H:i", strtotime($entry['start_time'])) ?></td>
												<td><?= $entry['total_questions'] ?></td>
												<td>
													<?php if (is_null($entry['score'])): ?>
														<span class="badge bg-warning text-dark">Chưa chấm</span>
													<?php else: ?>
														<span class="badge bg-success"><?= $entry['score'] ?>/<?= $entry['total_questions'] ?></span>
													<?php endif; ?>
												</td>
												<td>
													<a href="index.php?page=result&result_id=<?= $entry['result_id'] ?>">
														<i class="far fa-eye"></i>
													</a>
												</td>
											</tr>
										<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>

					<?php endif; ?>
			<div class="affiliate-ad">
    			<p>Affiliates</p>
			</div>

        </div>
    </div>
	<script src="https://kit.fontawesome.com/10749a358e.js" crossorigin="anonymous"></script>
</body>
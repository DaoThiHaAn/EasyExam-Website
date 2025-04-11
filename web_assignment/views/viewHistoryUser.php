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
 <meta name="viewport" content="width=device-width,
initial-scale=1.0">
 <title>My New Website</title>
 <!-- <link rel="stylesheet" href="css/style.css"> -->
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://kit.fontawesome.com/10749a358e.js" crossorigin="anonymous"></script>
 <link rel="stylesheet" href="css/userDashboard.css">
 <script type="text/javascript">
  MathJax = {
    tex: {
      inlineMath: [['$', '$']], // Kích hoạt công thức nội dòng với $
      displayMath: [['$$', '$$']] // Công thức độc lập với $$
    }
  };
</script>
<script type="text/javascript" async
  src="https://polyfill.io/v3/polyfill.min.js?features=es6">
</script>
<script type="text/javascript" async
  id="MathJax-script" src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">📚 Lịch sử làm bài</h2>

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
</div>
</body>
</html>



            
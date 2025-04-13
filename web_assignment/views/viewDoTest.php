<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time(); // timestamp hiện tại
}
?>
<script>
	console.log(<?= json_encode($_SESSION) ?>);
</script>
<html lang="en">
<head>
    <?php include __DIR__."/../include/head.php"; ?>
    <link rel="stylesheet" href="css/doTest.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    <main>
        <div class="container my-4" id="quiz-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class ="header-box align-items-center">
                <h4 class="fw-bold">🧠 Test </h4>
                <h5><?= htmlspecialchars($test['test_name']) ?></h5>
                <h5><?= htmlspecialchars($test['test_category']) ?></h5>
                </div>
                <h5 class="time-box text-muted">⏳ Time: <span id="quiz-timer"></span></h5>
            </div>


            <div class="card shadow rounded-4 p-4" id="question-box">
                <!-- Nội dung câu hỏi sẽ render ở đây -->
            </div>
            <div class="mt-5 text-note">
                <p >*Note: You cannot turn back to previous question! Be careful! 🍀🍀🍀</p>
                <p>Time will not stop when you leave the test!</p>
                <p>In case the questions are not loaded, wait for a few seconds then press <b>F5</b></p>
            </div>

        </div>
        <script src="js/doTest.js"></script>
    </main>
</body>
</html>





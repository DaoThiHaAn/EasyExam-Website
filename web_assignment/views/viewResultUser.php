<?php include "models/getResultUser.php"; ?>
<html>
<head>
<?php include __DIR__."/../include/head.php"; ?>
<link rel="stylesheet" href="./css/testReview.css">
<script type="text/javascript">
  MathJax = {
    tex: {
      inlineMath: [['$', '$']],
      displayMath: [['$$', '$$']]
    }
  };
</script>
</head>

<body class="bg-light">
<?php include __DIR__.'/../include/navbar.php'; ?>
<section class="container mt-3">
    <div class="text-center">
        <h2 class="mb-4" style="color: #5D5A88">🎉 Result of your Test 🎉</h2>
        <h3 class="mb-4">Test Name: <?= htmlspecialchars($test_name) ?></h3>
        <p class="score-div"><strong>Score:</strong> <?= $score ?> / <?= $total_questions ?></p>
        <p><strong>Start time:</strong> <?= $start_time ?> </p>
        <p><strong>Finished time:</strong> <?= $end_time ?> </p>
        <p><strong>Duration:</strong> <?= $duration_formatted ?> </p>
    </div>

    <div class="mt-4">
        <h4 class="mb-4">Answer details:</h4>
        <div id="question-table-container"></div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <button id="prevPage" class="btn btn-secondary">⬅️ Previous</button>
            <span id="pageInfo"></span>
            <button id="nextPage" class="btn btn-secondary">Next ➡️</button>
        </div>
    </div>

    <button class="btn back-btn mt-4 mb-5" onclick="window.location.href='index.php?page=profile&tab=test_history'">🔙 Back to Test History</button>
</section>

<?php include __DIR__.'/../include/footer.php'; ?>

<script>
    const questions = <?= json_encode($questions) ?>;
    const perPage = 5;
    let currentPage = 1;

    function renderReview() {
        let html = '';
        const totalPages = Math.ceil(questions.length / perPage);
        const startIndex = (currentPage - 1) * perPage;
        const endIndex = startIndex + perPage;
        const pageQuestions = questions.slice(startIndex, endIndex);

        pageQuestions.forEach((q, index) => {
            const userAnswer = q.answer;
            const correctAnswer = q.correct_answer;

            function getOptionHtml(letter, optionText, userAnswer, correctAnswer) {
                const isUserChoice = (userAnswer && userAnswer.trim() === optionText.trim());
                const isCorrect = (correctAnswer && correctAnswer.trim() === optionText.trim());
                let optionClass = '';
                let extraText = '';

                // Mark accordingly:
                if (isUserChoice && isCorrect) {
                    // User selected the correct answer
                    optionClass = 'list-group-item-success user-selected';
                    extraText = `<br><small class="text-success font-weight-bold">
                    <i class="fa-solid fa-check"></i>
                    <span>Correct</span></small>`;
                } else if (isUserChoice && !isCorrect) {
                    // User selected an incorrect answer
                    optionClass = 'list-group-item-danger user-selected';
                    extraText = `<br><small class="text-danger font-weight-bold">
                    <i class="fa-solid fa-xmark"></i> <span>Incorrect</span></small>`;
                }
        
                return `<li class="list-group-item ${optionClass}">${letter}. ${optionText}${extraText}</li>`;
            }

            // Determine which option letter is the correct answer
            let correctLetter = '';
            if (q.correct_answer && q.correct_answer.trim() === q.option_a.trim()) {
                correctLetter = 'A';
            } else if (q.correct_answer && q.correct_answer.trim() === q.option_b.trim()) {
                correctLetter = 'B';
            } else if (q.correct_answer && q.correct_answer.trim() === q.option_c.trim()) {
                correctLetter = 'C';
            } else if (q.correct_answer && q.correct_answer.trim() === q.option_d.trim()) {
                correctLetter = 'D';
            }
            
            html += `
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Question ${startIndex + index + 1}</h5>
                        <p class="card-text">${q.question_text}</p>
                        ${q.picture_link ? `<img src="${q.picture_link}" class="card-img-top img-fluid w-25 my-2" alt="Question Image">` : ''}
                        <ul class="list-group">
                            ${getOptionHtml('A', q.option_a, userAnswer, correctAnswer)}
                            ${getOptionHtml('B', q.option_b, userAnswer, correctAnswer)}
                            ${getOptionHtml('C', q.option_c, userAnswer, correctAnswer)}
                            ${getOptionHtml('D', q.option_d, userAnswer, correctAnswer)}
                        </ul>
                        <div class="alert alert-info mt-2">
                            <strong>Correct Answer:</strong> ${correctLetter}. ${q.correct_answer}
                        </div>
                        ${!userAnswer || userAnswer.trim() === '' ? `
                            <div class="alert alert-warning mt-2 mb-0">
                                ⚠️ This question was unanswered.
                            </div>
                        ` : ''}
                    </div>
                </div>
            `;
        });

        document.getElementById('question-table-container').innerHTML = html;
        document.getElementById('pageInfo').textContent = `Page ${currentPage} of ${totalPages}`;
        document.getElementById('prevPage').style.display = (currentPage > 1) ? 'inline-block' : 'none';
        document.getElementById('nextPage').style.display = (currentPage < totalPages) ? 'inline-block' : 'none';

        if (window.MathJax) {
            MathJax.typesetPromise();
        }
    }

    document.getElementById('prevPage').addEventListener('click', function(){
        if (currentPage > 1) {
            currentPage--;
            renderReview();
        }
    });

    document.getElementById('nextPage').addEventListener('click', function(){
        const totalPages = Math.ceil(questions.length / perPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderReview();
        }
    });

    renderReview();
</script>
</body>
</html>

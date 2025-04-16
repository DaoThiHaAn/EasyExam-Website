<html lang="en">
    <head>
        <?php include __DIR__."/../../include/head.php"; ?>
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
    <body>
        <?php include __DIR__."/../../include/navbar.php"; ?>
        
        <main class="bg-light p-5">
            <!-- Test Information Card -->
            <div class="card mb-4 shadow-sm meta-card">
                <div class="card-header header-text text-center">
                    <h4 class="mb-0">Test Detail - Admin View</h4>
                </div>
                <div class="card-body">
                    <p class="mb-1"><strong>Test Name:</strong> <?= htmlspecialchars($test['test_name']) ?></p>
                    <p class="mb-1"><strong>Test ID:</strong> <?= htmlspecialchars($test['test_id']) ?></p>
                    <p class="mb-1"><strong>Category:</strong> <?= htmlspecialchars($test['test_category']) ?></p>
                    <p class="mb-1"><strong>Created by:</strong> <?= htmlspecialchars($creator) ?></p>
                    <p class="mb-1"><strong>Created on:</strong> <?= htmlspecialchars($test['time_create']) ?></p>
                    <p class="mb-1"><strong>Number of questions:</strong> <?= htmlspecialchars($test['count']) ?></p>
                    <p class="mb-0"><strong>Time limit:</strong> <?= htmlspecialchars($test['test_time']) ?></p>
                </div>
            </div>
            
            <!-- Questions display area -->
            <div id="question-table-container"></div>
            
            <!-- Pagination Controls -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <button id="prevPage" class="btn page-btn">⬅️ Previous</button>
                <span id="pageInfo"></span>
                <button id="nextPage" class="btn page-btn">Next ➡️</button>
            </div>
            
            <button class="btn back-btn mt-4" onclick="window.location.href='index.php?page=admin_history'">🔙 Back to Test List</button>
        </main>
        
        <?php include __DIR__."/../../include/footer.php"; ?>
        
        <script>
            // The questions array is passed from the controller.
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
                    const correctAnswer = q.correct_answer;

                    function getOptionHtml(letter, optionText, correctAnswer) {
                        const isCorrect = (correctAnswer && correctAnswer.trim() === optionText.trim());
                        let optionClass = isCorrect ? 'list-group-item-success' : '';
                        let extraText = isCorrect ? `<br><small class="text-success font-weight-bold">
                            <i class="fa-solid fa-check"></i> Correct</small>` : '';
                        
                        return `<li class="list-group-item ${optionClass}">${letter}. ${optionText}${extraText}</li>`;
                    }
        
                    html += `
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">
                                Question ${startIndex + index + 1}
                                <span style='color: grey; margin-left: 30px; font-size: 15px;'> Difficulty: ${q.difficulty} </span>
                                </h5>
                                <p class="card-text">${q.question_text}</p>
                                    ${q.picture_link && q.picture_link !== "none" ? `<img src="${q.picture_link}" class="card-img-top img-fluid w-25 my-2" alt="Question Image">` : ''}                                <ul class="list-group">
                                    ${getOptionHtml('A', q.option_a, correctAnswer)}
                                    ${getOptionHtml('B', q.option_b, correctAnswer)}
                                    ${getOptionHtml('C', q.option_c, correctAnswer)}
                                    ${getOptionHtml('D', q.option_d, correctAnswer)}
                                </ul>
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
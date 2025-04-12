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
        <!-- <h2>Welcome to My Website $ u = U_0 \cos(\omega t) \frac{1}{\sqrt{3}} $</h2> -->
        <div class="container my-4" id="quiz-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold">🧠 Bài kiểm tra</h4>
                <h5 class="text-muted">⏳ Thời gian: <span id="quiz-timer"></span></h5>
            </div>

            <div class="card shadow rounded-4 p-4" id="question-box">
                <!-- Nội dung câu hỏi sẽ render ở đây -->
            </div>
        </div>>


    </main>


<script>
    let currentQuestionIndex = 0;
    let answeredCount = 0;
    let questionsData = [];
    let selectedAnswers = {}; // Lưu lựa chọn
    let resultId = 0; 
    // Lấy test_id từ URL
    const urlParams = new URLSearchParams(window.location.search);
    const testId = urlParams.get('test_id');

    // Gọi AJAX để khởi tạo result
    if (testId) {
        $.ajax({
            url: "models/startTest.php",
            type: "GET",
            data: { test_id: testId },
            dataType: "json",
            success: function (res) {
                if (res.success) {
                    resultId = res.result_id;
                    console.log("Đã khởi tạo result_id =", res.result_id);
                     // Tiếp tục gọi lấy danh sách câu hỏi
                    $.ajax({
                        url: "models/getTestQuestions_do.php",
                        type: "GET",
                        data: { test_id: testId },
                        dataType: "json",
                        success: function (data) {
                            if (data.questions.length === 0) {
                                window.location.href = `index.php?page=result&result_id=${resultId}`;
                                return;
                            }
                            console.log(data.questions)
                            questionsData = data.questions;
                            answeredCount = data.answered_count;
                            MathJax.typeset();
                            renderQuestion(currentQuestionIndex);
                            
                            startTimer(data.time_left);
                        }
                    });   


                } else {
                    alert("Lỗi khởi tạo bài làm.");
                    window.location.href = "index.php?page=userDashboard";
                }
            }
        });

        
    }

    function renderQuestion(index) {
        const q = questionsData[index];
        if (!q) return;

        const selected = selectedAnswers[q.question_id] || '';

        // Lấy tổng số câu = câu chưa làm + đã làm
        const totalQuestions = questionsData.length + answeredCount; // dùng biến answeredCount từ ajax

        let html = `
            <div class="row align-items-center">
                <div class="col-md-4 text-center">
                    ${q.picture_link !== 'none' ? `<img src="${q.picture_link}" class="img-fluid rounded" style="max-height: 220px;">` : ''}
                </div>
                <div class="col-md-8">
                    <h5 class="mb-2">Câu ${index + 1 + answeredCount}/${totalQuestions}</h5>
                    <p class="mb-4">${q.question_text}</p>
                    
                    <form id="answer-form">
                        ${renderOption('A', q.option_a, selected)}
                        ${renderOption('B', q.option_b, selected)}
                        ${renderOption('C', q.option_c, selected)}
                        ${renderOption('D', q.option_d, selected)}

                        <button type="button" class="btn btn-primary mt-4 px-4" id="next-btn">
                            ${index === questionsData.length - 1 ? 'Nộp bài' : 'Câu tiếp'}
                        </button>
                    </form>
                </div>
            </div>
        `;

        $('#question-box').html(html);
            if (typeof MathJax !== 'undefined') {
            MathJax.typeset();
        }
    }


    function renderOption(key, value, selected) {
        return `
        <div class="form-check mb-2">
            <input class="form-check-input" type="radio" name="answer" id="option${key}" value="${value}" ${selected === value ? 'checked' : ''}>
            <label class="form-check-label" for="option${key}">${key}. ${value}</label>
        </div>`;
    }

    // Sự kiện next
    $(document).on("click", "#next-btn", function () {
    const currentQ = questionsData[currentQuestionIndex];
    const selectedVal = $("input[name='answer']:checked").val() || ''; // Nếu không chọn thì là chuỗi rỗng

    selectedAnswers[currentQ.question_id] = selectedVal;

    console.log("Gửi về:", {
        question_id: currentQ.question_id,
        answer: selectedVal,
        correct_answer: currentQ.correct_answer
    });

    // Gửi kết quả về server (dù có chọn hay không)
    $.ajax({
        url: "models/saveAnswer.php",
        type: "POST",
        data: {
            question_id: currentQ.question_id,
            answer: selectedVal,
            correct_answer: currentQ.correct_answer
        },
        success: function (res) {
            console.log("Đã lưu kết quả:", res);
        }
    });

    if (currentQuestionIndex < questionsData.length - 1) {
        currentQuestionIndex++;
        renderQuestion(currentQuestionIndex);
    } else {
        alert("Bạn đã hoàn thành bài kiểm tra!");
        $.ajax({
            url: "models/endTest.php",
            type: "GET",
            data: { result_id: resultId },
            complete: function () {
                window.location.href = `index.php?page=result&result_id=${resultId}`;
            }
        });
        console.log("Kết quả:", selectedAnswers);
    }
});


    // Đếm ngược thời gian
    function startTimer(duration) {
        let timeLeft = duration;
        const timerElement = document.getElementById('quiz-timer');
        const countdown = setInterval(() => {
            timeLeft--;
            const m = Math.floor(timeLeft / 60).toString().padStart(2, '0');
            const s = (timeLeft % 60).toString().padStart(2, '0');
            timerElement.textContent = `${m}:${s}`;
            if (timeLeft <= 0) {
                clearInterval(countdown);
                alert("Hết giờ làm bài!");
                
                // Duyệt qua toàn bộ câu hỏi chưa có câu trả lời
                questionsData.forEach(q => {
                    if (!selectedAnswers[q.question_id]) {
                        // Gửi về với answer rỗng
                        $.ajax({
                            url: "models/saveAnswer.php",
                            type: "POST",
                            data: {
                                question_id: q.question_id,
                                answer: '',
                                correct_answer: q.correct_answer
                            },
                            async: false // đảm bảo gửi xong mới chuyển trang
                        });
                    }
                });

                $.ajax({
                    url: "models/endTest.php",
                    type: "GET",
                    data: { result_id: resultId },
                    complete: function () {
                        window.location.href = `index.php?page=result&result_id=${resultId}`;
                    }
                });
            }
            }, 1000); 

    }
</script>






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
                    window.location.href = "index.php?page=test";
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
                    <h5 class="mb-2">Question ${index + 1 + answeredCount}/${totalQuestions}</h5>
                    <p class="mb-4">${q.question_text}</p>
                    
                    <form id="answer-form">
                        ${renderOption('A', q.option_a, selected)}
                        ${renderOption('B', q.option_b, selected)}
                        ${renderOption('C', q.option_c, selected)}
                        ${renderOption('D', q.option_d, selected)}

                        <button type="button" class="btn btn-primary mt-4 px-4" id="next-btn">
                            ${index === questionsData.length - 1 ? 'Submit' : 'Next Question'}
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
        alert("You have completed the test!");
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
                alert("Time UpUp!");
                
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

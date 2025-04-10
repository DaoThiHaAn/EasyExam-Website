<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function isEmailExist($email, $database): bool {
    $stmt = $database->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        return true;
    }
    return false;
}

function sendEmail($to, $subject, $type, $uname = '') :bool {
    $headers = "MIME-Version: 1.0\r\n"
                ."Content-type:text/html;charset=UTF-8\r\n"
                ."From: daothihaan@gmail.com\r\n"
                ."X-Priority: 1 (Highest)\n"
                ."X-MSMail-Priority: High\n"
                ."Importance: High\n";

    if ($type=='welcom')
        $message = "<h2>Welcome to ExamEase!</h2>
            <p>Hi <b>$uname</b>,</p>
            <p>Congratulations on joining <b>ExamEase</b> – your ultimate platform for exam preparation and management! You're now part of a learning community that values excellence and efficiency in academics.</p>

            <p>Here’s what you can do next:</p>
            <ul>
                <li>Access a wide range of practice exams, quizzes, and study materials.</li>
                <li>Register for upcoming exams and view your schedule easily.</li>
                <li>Track your performance and get detailed feedback to help you improve.</li>
            </ul>

            <p>If you have any questions or need help, feel free to reach out to our support team anytime. We’re here to ensure your exam journey is smooth and successful!</p>

            <br>
            <p>Wishing you success in all your exams!<br><br>
                <i>The ExamEase Team</i>
            </p>";
    
    else if ($type=='reset') {
        $message = " <html>
            <head>
                <title>Reset Password</title>
            </head>
            <body>
                <h1>Reset Password</h1><br>
                <p>Click the link below to reset your password:</p>
                <a href=''>
                    <h3>Reset Password</h3>
                </a>
            </body>
        </html>";
    }

    return mail($to, $subject, $message, $headers);
}


function fetchUsername($loginname):string {
    global $mydatabase;
    if (strpos($loginname, '@') !== false) {
        return $mydatabase->query("SELECT username, user_role FROM users WHERE email = '$loginname'")->fetch_assoc()['username'];
    }
    return $loginname;
}
?>
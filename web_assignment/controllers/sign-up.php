<?php
$mydatabase = new mysqli("localhost", "root", "", "web");
if ($mydatabase->connect_error) {
    die("Connection failed: " . $mydatabase->connect_error);
}

include("helper.php");
include("./views/auth/dialog.php");

$email = $username = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = test_input($_POST['email']);
    $username = test_input($_POST['uname']);
    $password = test_input($_POST['password']);

    // check duplicate username, email
    $dialog_content = [];

    if (isEmailExist($email, $mydatabase)) {
        $dialog_content[] = "Email already exists!";
    }
    
    $stmt = $mydatabase->prepare("SELECT username FROM users WHERE username = ?");
    if (!$stmt) {
        printf("Prepare failed: (%d) %s\n", $mydatabase->errno, $mydatabase->error);
        die("Prepare failed: " . $mydatabase->error . "<br>SQL: " . $sql);
    }
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $dialog_content[] = "Username already exists!";
    }

    if (count($dialog_content) > 0) {
        // convert the list to string
        echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            openDialog(" . json_encode($dialog_content) . ");
        });
        </script>";
    }
    else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        $sql = "INSERT INTO users (email, username, password_hash, role_user) VALUES (?, ?, ?, 'user')";
        $stmt = $mydatabase->prepare($sql);
        if (!$stmt) {
            printf("Prepare failed: (%d) %s\n", $mydatabase->errno, $mydatabase->error);
            die("Prepare failed: " . $mydatabase->error . "<br>SQL: " . $sql);
        }
        $stmt->bind_param("sss", $email, $username, $hashed_password);
        if ($stmt->execute()) { 
            sendEmail(
                $email,
                "EXAMEASE: Account created successfully",
                "welcome",
                $username
            );      
            echo "<script>
                alert('Account created successfully! 🎉 🎉 🎉\\nPlease login to continue');
                window.location.href = 'index.php?page=sign-in';
                console.log('Account created successfully!');
            </script>";                    
        } else {
            echo "<script>
                alert('Error: ".$mydatabase->error."\nPlease try again! 🥲');
            </script>";
        }
    }
}

include("./views/auth/sign-up.php");
?>

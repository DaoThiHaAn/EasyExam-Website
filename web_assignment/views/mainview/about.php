<?php
if (!defined('PARTIAL')) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './include/head.php'; ?>
    <meta name="description" content="Contact form">
    <meta name="keywords" content="contact, support, inquiries, help, assistance">
</head>
<body>
<?php
    include './include/navbar.php';
}
?>

<section id="about" class="about section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
                <div class="about-img">
                    <img src="./images/about.png" alt="" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-12 ps-lg-5 mt-md-5">
                <div class="about-text">
                    <h2> At <i>EasyExam</i> We Provide the Best Quality <br/>Online Exam</h2>
                    <p>Our platform offers a wide range of mock tests, practice questions, and detailed explanations to help you prepare confidently and efficiently for your upcoming exams. Whether you're studying for school, university entrance tests, government exams, or certifications, we’ve got you covered.</p>
                    <p>We believe that access to effective and affordable learning tools should be available to everyone. That’s why our content is regularly updated, thoroughly reviewed, and designed by subject matter experts to reflect the latest exam patterns and syllabi.</p>
                    <p>Our mission is simple: to make learning engaging, effective, and accessible. Start your journey with us and take one step closer to achieving your goals.</p>
                </div>
        </div>
    </div>
</section>

    <!-- portfolio section -->
<section class="portfolio mb-5" id="portfolio">
        <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Our Team</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="./images/team-1.png" height=10px alt="profile image" class="img-fluid rounded-circle">
                    <h3 class="card-title py-2">Hà Thế Bình</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="./images/team-2.png" alt="profile image" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Đào Thị Hà An</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="./images/team-3.png" alt="profile image" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Đào Nam Anh</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <div class="card text-center">
                    <div class="card-body">
                        <img src="./images/team-4.png" alt="profile image" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Lưu Chí Cường</h3>
                    </div>
                </div>
            </div>
        </div>
        </div>
</section>

<?php
if (!defined('PARTIAL')) {
?>
    <?php include './include/footer.php'; ?>
</body>
</html>
<?php
}
?>

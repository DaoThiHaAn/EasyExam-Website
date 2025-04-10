<?php
// Check if this file is included as a partial. If not, output the full HTML.
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

<section id="category" class="category section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>3 Test Categories</h2>
                    <p>Provide better preparation for National Exam for A1 group <br>Let's register account to take all available tests</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card text-light text-center bg-white pb-2">
                    <div class="card-body text-dark">
                        <div class="img-area mb-4">
                            <img src="./images/math.png" class="img-fluid" alt="">
                        </div>
                        <h3 class="card-title">Mathematicals</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card text-light text-center bg-white pb-2">
                    <div class="card-body text-dark">
                        <div class="img-area mb-4">
                            <img src="./images/english.png" class="img-fluid" alt="">
                        </div>
                        <h3 class="card-title">English</h3>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-4">
                <div class="card text-light text-center bg-white pb-2">
                    <div class="card-body text-dark">
                        <div class="img-area mb-4">
                            <img src="./images/physic.png" class="img-fluid" alt="">
                        </div>
                        <h3 class="card-title">Physics</h3>
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

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include './include/head.php'; ?>
    <!-- SEO -->
    <meta name="description" content="Mock Test Platform - Your gateway to success! Prepare, practice, and excel with our expertly designed mock tests. Join thousands of learners today!">
    <meta name="keywords" content="mock test, online exam, test preparation, study platform, learning, education">
</head>

<body data-bs-spy="scroll" data-bs-target="#navbarResponsive" data-bs-offset="50">
    <!-- navbar -->
     <?php  
     define('PARTIAL', true); 
     include './include/navbar.php'; ?>

    <!-- carousel -->
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/home1.png" class="d-block w-100" alt="slider image">
      <div class="carousel-caption">
            <h5>Prepare. Practice. Excel.</h5>
            <p>Unlock your full potential with expertly designed mock tests and real-time feedback.</p><br>
            <a class="btn btn-primary" href="index.php?page=sign-in.php">Get Started!</a>
       </div>
    </div>
    <div class="carousel-item">
      <img src="./images/home2.png" class="d-block w-100" alt="slider image">
      <div class="carousel-caption">
            <h5>Anytime, Anywhere Testing</h5>
            <p>Study smart and take your exams from the comfort of your home—on any device.</p><br>
            <a class="btn btn-primary" href="index.php?page=sign-in.php">Get Started!</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./images/home3.png" class="d-block w-100" alt="slider image">
      <div class="carousel-caption">
        <h5>Your Journey to Success Starts Here</h5>
        <p>Join thousands of learners acing their exams with our trusted platform.</p><br>
        <a class="btn btn-primary" href="index.php?page=sign-in.php">Get Started!</a>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

    <?php 
        include './views/mainview/about.php';
        include './views/mainview/category.php'; 
        include './views/mainview/contact.php';
        include './include/footer.php'; 
    ?>
</body>



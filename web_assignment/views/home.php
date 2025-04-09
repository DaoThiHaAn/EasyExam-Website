<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Landing Space</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--adding bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <!-- adding bootstrap icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- add font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Gamja+Flower&display=swap">
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#carousel">
                <img src="./images/logo.png" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expand="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="#carousel">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#category">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#portfolio">Portfolio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">Contact</a>
                    </li>
                    <li>
                        <a class="btn btn-primary" href="index.php?page=login">Get Started!</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- carousel -->
    <div id="carousel" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="./images/home1.png" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5>First slide label</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad, quae? Esse unde aspernatur distinctio est.</p>
            <a class="btn btn-primary" href="./auth/sign-in.php">Get Started!</a>
       </div>
    </div>
    <div class="carousel-item">
      <img src="./images/home2.png" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5>Second slide label</h5>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, et aut fugit repudiandae blanditiis nostrum.</p>
            <a class="btn btn-primary" href="./auth/sign-in.php">Get Started!</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="./images/home3.png" class="d-block w-100" alt="...">
      <div class="carousel-caption">
        <h5>Third slide label</h5>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id dicta asperiores repudiandae eius quaerat voluptate!</p>
        <a class="btn btn-primary" href="./auth/sign-in.php">Get Started!</a>
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

    <!-- about section -->
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
                        <h2>We Provide the Best Quality <br/>Online Exam</h2>
                            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Totam, labore reiciendis. Assumenda eos quod animi! Soluta nesciunt inventore dolores excepturi provident, culpa beatae tempora, explicabo corporis quibusdam corrupti. Autem, quaerat. Assumenda quo aliquam vel, nostrum explicabo ipsum dolor, ipsa perferendis porro doloribus obcaecati placeat natus iste odio est non earum?</p>
                            <a class="btn btn-primary" href="./auth/sign-in.php">Get Started!</a>
                  </div>
            </div>
        </div>
    </section>

    <!-- category section -->
    <section id="category" class="category section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Our Projects</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur <br>adipisicing elit. Non, quo.</p>
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
                            <h3 class="card-title">Math</h3>
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eligendi modi temporibus alias iste. Accusantium?</p>
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
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eligendi modi temporibus alias iste. Accusantium?</p>
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
                            <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci eligendi modi temporibus alias iste. Accusantium?</p>
                            </div>
                    </div>
                </div>
            </div>
        </div>
      </section>
    
    <!-- portfolio section -->
    <section class="portfolio section-padding" id="portfolio">
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Our Team</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur <br>adipisicing elit. Non, quo.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="./images/team-1.png" height=10px alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Jack Wilson</h3>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi ipsam nostrum illo tempora esse quibusdam.</p>
                       
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="./images/team-2.png" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Jack Wilson</h3>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi ipsam nostrum illo tempora esse quibusdam.</p>
                        
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="./images/team-3.png" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Jack Wilson</h3>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi ipsam nostrum illo tempora esse quibusdam.</p>
                        
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <img src="./images/team-4.png" alt="" class="img-fluid rounded-circle">
                        <h3 class="card-title py-2">Jack Wilson</h3>
                        <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sequi ipsam nostrum illo tempora esse quibusdam.</p>
                        
                        </div>
                    </div>
                </div>
            </div>
          </div>
      </section>

      <!-- team starts -->
      

    <!-- contact section -->
    <section id="contact" class="contact section-padding">
        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-header text-center pb-5">
                        <h2>Contact Us</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur <br>adipisicing elit. Non, quo.</p>
                    </div>
                </div>
            </div>
			<div class="row m-0">
				<div class="col-md-12 p-0 pt-4 pb-4">
					<form action="#" class="bg-light p-4 m-auto">
						<div class="row">
							<div class="col-md-12">
								<div class="mb-3">
									<input class="form-control" placeholder="Full Name" required="" type="text">
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<input class="form-control" placeholder="Email" required="" type="email">
								</div>
							</div>
							<div class="col-md-12">
								<div class="mb-3">
									<textarea class="form-control" placeholder="Message" required="" rows="3"></textarea>
								</div>
							</div><button class="btn btn-warning btn-lg btn-block mt-3" type="button">Send Now</button>
						</div>
					</form>
				</div>
			</div>
		</div>
      </section>

    <!-- footer -->
    <section class="footer">
        <div class="container-fluid padding">
            <div class="row text-center">
                <div class="col-md-4" id="footerImg">
                    <img src="./images/logo.png" height="50">
                    <hr class="dark">
                    <p>Multi-Question Web</p>                    
                </div>
                <div class="col-md-4">
                    <hr class="dark">
                    <h5>Working Hours</h5>
                    <hr class="dark">
                    <p>Mondays-Friday: 8am - 5pm</p>
                    <p>Weekend: 8am - 12pm</p>
                </div>
                <div class="col-md-4">
                    <hr class="dark">
                    <h5>Contact</h5>
                    <hr class="dark">
                    <p>+0123456789</p>
                    <p>contact@gmail.com</p>
                    <p>Đại Học Bách Khoa TP HCM</p>
                </div>
                <div class="col-12">
                    <hr class="light-100">
                    <h5>&copy;Multi-Question Web, 2025.</h5>
                </div>
            </div>
        </div>
    </section>
   

   
</body>



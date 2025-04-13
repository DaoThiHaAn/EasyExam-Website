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

<section id="contact" class="contact">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center pb-5">
                    <h2>Contact Us</h2><br>
                    <p>We'd love to hear from you!</p>
                    <p>Whether you have a question, feedback, report issues, or need support, feel free to reach out using the form below or via our contact details.</p>
                </div>
            </div>
        </div>
        <div class="row m-0">
            <div class="col-md-12 p-0 pt-4 pb-4">
                <form action="#" class="bg-light p-4 m-auto">
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
                            <textarea class="form-control" placeholder="Message" required="" rows="5"></textarea>
                        </div>
                    </div>
                    <button class="btn btn-warning btn-lg btn-block mt-3" type="button">Send Now</button>
                </form>
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

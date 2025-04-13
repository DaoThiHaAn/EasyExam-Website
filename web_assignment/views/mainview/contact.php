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

<h2 class="text-center" style="position: relative;">Contact Us</h2>
<section id="contact" class="contact">
    <div class="mt-5 mb-5">
        <div class="section-header text-center">
            <p>We'd love to hear from you! 😊</p>
            <p>Whether you have a question, feedback, report issues, or need support, feel free to reach out using the form below or via our contact details.</p>
        </div>
        <div class="p-0 pt-4 pb-4">
            <form action="#" class=".contact-form bg-light p-4">
                <div class="mb-3">
                    <input class="form-control" placeholder="Full Name" required="" type="text">
                </div>
                <div class="mb-3">
                    <input class="form-control" placeholder="Email" required="" type="email">
                </div>
                <div class="mb-3">
                    <textarea class="form-control" placeholder="Message" required="" rows="5" cols="3"></textarea>
                </div>
                <button class="btn btn-warning btn-lg btn-block mt-3" type="button">Send Now</button>
            </form>
        </div>
    </div>

    <div class="map-container">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3745.9915357079535!2d106.65532151038475!3d10.772074989332104!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ec3c161a3fb%3A0xef77cd47a1cc691e!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBCw6FjaCBraG9hIC0gxJDhuqFpIGjhu41jIFF14buRYyBnaWEgVFAuSENN!5e1!3m2!1svi!2s!4v1744526439722!5m2!1svi!2s"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

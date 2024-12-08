<?php
$messageCategories = getAll("message_category");
if(isLogged()){
    $user = currentUser()->user_id;
}
?>


<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Contact Us</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Contact</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Contact For Any Queries</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col-lg-7 mb-5">
            <div class="contact-form">
                <div id="success"></div>
                <form action="models/userMessage.php" method="POST">
                    <div class="control-group">
                        <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" />
                        <p class="help-block text-danger">
                            <?= getFlash("error", "subject") ?>
                        </p>
                    </div>
                    <div class="control-group mb-3">
                        <select name="category" id="category" class="form-control">
                            <option value="0">Support Category</option>
                            <?php foreach ($messageCategories as $m): ?>
                                <option value="<?= $m->category_id ?>"><?= $m->category_name ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p class="help-block text-danger">
                            <?= getFlash("error", "category") ?>
                        </p>
                    </div>
                    <div class="control-group">
                        <textarea class="form-control" rows="6" id="message" placeholder="Message"
                            name="message"></textarea>
                        <p class="help-block text-danger">
                            <?= getFlash("error", "message") ?>
                        </p>
                    </div>
                    <div>
                        <input type="submit" value="Send Message" class="btn btn-primary py-2 px-4" name="submit">

                        <p class="help-block text-danger">
                            <?= getFlash("error", "login") ?>
                        </p>

                        <p class="help-block text-danger">
                            <?= getFlash("error", "form") ?>
                        </p>

                        <p class="help-block text-success">
                            <?= getFlash("success", "form") ?>
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-5 mb-5">
            <h5 class="font-weight-semi-bold mb-5">Get In Touch</h5>
            <div class="d-flex flex-column mb-3">
                <h5 class="font-weight-semi-bold mb-3">Store 1</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
            <div class="d-flex flex-column">
                <h5 class="font-weight-semi-bold mb-3">Store 2</h5>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->


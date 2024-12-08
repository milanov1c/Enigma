<?php
if (isset($_POST['submit'])) {
    $firstName = post("first-name");
    $lastName = post("last-name");
    $email = post("email");
    $password = post("password");
    $username = post("username");
    $rePassword = post("re-password");

    $success = false;

    $regExName = "/^[A-ZŠĐŽČĆ][a-zšđčćž]{2,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{2,14})?$/";
    $regExLastName = "/^[A-ZŠĐŽČĆ][a-zšđčćž]{3,14}(\s[A-ZŠĐŽČĆ][a-zšđčćž]{3,14})?$/";
    $regExUsername = "/^[a-z0-9]{3,20}$/";
    $regExEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    $regExPassword = "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()_+])[A-Za-z\d!@#$%^&*()_+]{8,}$/";




    validateInput($firstName, $regExName, "Your name must contain only letters.", "name");
    validateInput($lastName, $regExLastName, "Your name must contain only letters.", "surname");
    validateInput($email, $regExEmail, "Your email is not in valid format.", "email");
    validateInput($username, $regExUsername, "Your username is not in valid format.", "username");
    validateInput($password, $regExPassword, "Your password must contain both lowercase and uppercase letters, at least one number and one special character", "password");


    if ($rePassword != $password) {
        setFlash("error", "rePassword", "Your passwords do not match.");
    }

    if (getUserBy("email", $email)->n > 0) {
        setFlash("error", "email", "Your email already exists in our base.");
    }

    if (getUserBy("username", $username)->n > 0) {
        setFlash("error", "username", "Your username already exists in our base");
    }

    if (empty($_SESSION['error'])) {
        $password = md5($password);
        $success = registerUser($firstName, $lastName, $email, $password, $username);
    }
    if ($success) {
        setFlash("success", "registration", "Your registration was successfull. Please check your email to activate your account in order to log in.");
    }
}


?>

<?php if (!isLogged()): ?>

    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Make Your Account Here</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5">
                <div class="contact-form">
                    <form id="contactForm" method="POST" action="index.php?page=register" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="first-name" placeholder="First Name"
                                        name="first-name" />
                                    <p class="help-block text-danger">
                                        <?= getFlash("error", "name") ?>
                                    </p>
                                </div>
                                <div class="control-group">
                                    <input type="email" class="form-control" id="email" placeholder="Your Email"
                                        name="email" />
                                    <p class="help-block text-danger">
                                        <?= getFlash("error", "email") ?>
                                    </p>
                                </div>
                                <div class="control-group">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Password" />
                                    <p class="help-block text-danger">
                                        <?= getFlash("error", "password") ?>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                <div class="control-group">
                                    <input type="text" class="form-control" id="last-name" placeholder="Last Name"
                                        name="last-name" />
                                    <p class="help-block text-danger">
                                        <?= getFlash("error", "surname") ?>
                                    </p>
                                </div>
                                <div class="control-group">
                                    <input type="text" class="form-control" id="username" placeholder="Username"
                                        name="username" />
                                    <p class="help-block text-danger">
                                        <?= getFlash("error", "username") ?>
                                    </p>
                                </div>
                                <div class="control-group">
                                    <input type="password" class="form-control" id="re-password" name="re-password"
                                        placeholder="Confirm password" />
                                    <p class="help-block text-danger">
                                        <?= getFlash("error", "rePassword") ?>
                                    </p>
                                </div>
                                <div>

                                    <input type="submit" value="Register" name="submit" class="btn btn-primary py-2 px-4">

                                    <p class="help-block text-success">
                                        <?= getFlash("success", "registration") ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 mb-5">
                <h5 class="font-weight-semi-bold mb-3">Get In Touch</h5>
                <p>Join our exclusive community today and enjoy personalized offers, early access to sales, and a seamless
                    shopping experience! Sign up now and receive 10% off your first purchase—discover the latest trends and
                    enjoy unbeatable deals only available to our members. Create your account today and unlock a world of
                    benefits, including free shipping, member-only discounts, and first dibs on new arrivals!</p>
                <div class="row ml-1">
                    <div class="d-flex flex-column mr-3">
                        <h5 class="font-weight-semi-bold mb-3">Enigma NYC</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                        <p class="mb-2"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="font-weight-semi-bold mb-3">Enigma LA</h5>
                        <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i>123 Street, Los Angeles, USA
                        </p>
                        <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>info@example.com</p>
                        <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>+012 345 67890</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else:
    header("Location: index.php?page=404");
    ?>

<?php endif; ?>
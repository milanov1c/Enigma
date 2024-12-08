<?php
if (isset($_POST['submit'])) {
    $username = post("username");
    $password = post("password");

    $password = md5($password);

    loginUser($username, $password);

}
?>

<?php if(!isLogged()):?>

<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Log In</span></h2>
    </div>
    <div class="row justify-content-center px-xl-5">
        <div class="col-lg-4 col-6 mb-5 d-flex align-items-center ">
            <div class="contact-form">
                <form method="POST" action="index.php?page=login">
                    <div class="form-group row align-items-center">
                        <div class="col-lg-5">
                            <div class="control-group">
                                <input type="text" class="form-control" id="username" placeholder="Username"
                                    name="username" />
                                <p class="help-block text-danger">
                                    <?= getFlash("error", "username") ?>
                                </p>
                                <p class="help-block text-success">
                                    <?= getFlash("success", "enable") ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="control-group">
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    name="password" />
                                <p class="help-block text-danger">
                                    <?= getFlash("error", "password") ?>
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="text-center">
                                <input type="submit" value="Login" name="submit" class="btn btn-primary py-2 px-4">
                                <p class="help-block text-danger">
                                    <?= getFlash("error", "login") ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-4 col-6 mb-5 ">
            <h5 class="font-weight-semi-bold mb-4">Get In Touch</h5>
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
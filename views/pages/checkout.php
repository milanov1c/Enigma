<?php
$user = currentUser()->user_id;
$cart = getCartProducts($user);
$shipping = 10;
$sum = 0;
$placedOrder = false;


if (isset($_POST['submit'])) {
    $address = post("address");
    $country = post("country");
    $city = post("city");
    $zip = post("zip");

    $query = "INSERT INTO address (address, country_id, city, zip, user_id) VALUES(:ad, :cid, :city, :zip, :usr)";

    $stmt = $conn->prepare($query);
    $result = $stmt->execute([":ad" => $address, ":cid" => $country, ":city" => $city, ":zip" => $zip, ":usr" => $user]);

    if ($result) {
        setFlash("success", "address", "Your addres has been added.");
    } else {
        setFlash("error", "address", "Your addres has not been added, please try again.");
    }
}

if (isset($_POST['order'])) {
    if (hasAddress($user) && !empty($cart)) {
        $order = addOrder($user, $sum);

        if (!empty($order)) {
            foreach ($cart as $c) {
                $price = $c->sale ?? $c->price;

                addOrderItem($c->product_id, $order, $c->quantity, $price);
                deleteCartOrder($c->product_id, $user);

            }
            $placedOrder = true;
        }
        if ($placedOrder) {
            setFlash("success", "order", "Your order had been placed.");
        }
    }
}


?>



<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Checkout</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Checkout</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 justify-content-center">
        <?php if (!hasAddress($user)): ?>
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">Billing Address</h4>
                    <div class="row">
                        <form action="index.php?page=checkout" method="POST" class="row justify-content-end">
                            <div class="col-md-6 form-group">
                                <label>Address</label>
                                <input class="form-control" type="text" placeholder="Zdravka Čelara, 16" name="address">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select" name="country">
                                    <?php $countries = getAll("country");
                                    foreach ($countries as $c):
                                        ?>
                                        <option value="<?= $c->country_id ?>" <?= $c->country == 'Serbia' ? "selected" : "" ?>>
                                            <?= $c->country ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="Belgrade" name="city">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="11000" name="zip">
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="submit" value="Add Address" class="btn btn-primary btn-block" name="submit">
                                <p class="text-success">
                                    <?= getFlash("success", "address") ?>
                                </p>
                                <p class="text-error">
                                    <?= getFlash("error", "address") ?>
                                </p>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif ?>
        <div class="col-lg-4">
            <?php if (!$placedOrder): ?>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Order Total</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Products</h5>
                        <?php foreach ($cart as $c):
                            $price = $c->sale ?? $c->price;
                            $sum += $price;
                            ?>
                            <div class="d-flex justify-content-between">
                                <p>
                                    <?= $c->product_name ?>
                                </p>
                                <p>$
                                    <?= $price ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$
                                <?= $sum ?>
                            </h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <?php $total = $sum + $shipping; ?>
                            <h5 class="font-weight-bold">$
                                <?= $total ?>
                            </h5>
                        </div>
                    </div>
                </div>

                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Payment</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal">
                                <label class="custom-control-label" for="paypal">Paypal</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="directcheck" checked>
                                <label class="custom-control-label" for="directcheck">Direct Check</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                            </div>
                        </div>
                    </div>
                    <form action="index.php?page=checkout" method="POST">
                        <div class="card-footer border-secondary bg-transparent">
                            <input type="submit" value="Place Order"
                                class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3" name="order">
                            <p class="text-success">
                                <?= getFlash("success", "order") ?>
                            </p>
                        </div>
                    </form>

                </div>
            </div>

        <?php endif; ?>
    </div>
</div>
<!-- Checkout End -->
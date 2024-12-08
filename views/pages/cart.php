<?php
$user=currentUser()->user_id;
$cart=getCartProducts($user);
$sum=0;
?>
    <!-- Page Header Start -->
    <div class="container-fluid bg-secondary mb-5">
        <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
            <h1 class="font-weight-semi-bold text-uppercase mb-3">Shopping Cart</h1>
            <div class="d-inline-flex">
                <p class="m-0"><a href="">Home</a></p>
                <p class="m-0 px-2">-</p>
                <p class="m-0">Shopping Cart</p>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5" id="cart-block">
            <?php if($cart):?>
                <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle" id="cart-items">
                        <?php foreach($cart as $c):
                            $price=$c->sale?$c->sale:$c->price;
                            $sum+=$price*$c->quantity;
                            ?>
                        <tr>
                            <td class="align-middle"><img src="assets/img/shop/<?=$c->path?>" alt="<?=$c->product_name?>" style="width: 50px;"><?=$c->product_name?></td>
                            <td class="align-middle">$<?=$price?></td>
                            <td class="align-middle">
                                <div class="input-group quantity mx-auto" style="width: 100px;">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-minus" >
                                        <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" class="form-control form-control-sm bg-secondary text-center" value="<?=$c->quantity?>">
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm btn-primary btn-plus">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle">$<?=$price*$c->quantity?></td>
                            <td class="align-middle"><a class="btn btn-sm btn-primary remove-cart" data-id="<?=$c->product_id?>" href="#"><i class="fa fa-times"></i></a></td>
                        </tr>
                        
                        <?php endforeach;?>
                        </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">$<?=$sum?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10.00</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">$<?=$sum+10?></h5>
                        </div>
                        <button class="btn btn-block btn-primary my-3 py-3"><a href="index.php?page=checkout" class="btn-primary">Proceed To Checkout</a></button>
                    </div>
                </div>
            </div>
            <?php else:?>
            <h2 class="mx-auto">Your cart is empty.</h2>
            <?php endif;?>
        </div>
            <div class="row" id="no-cart"></div>
    </div>
    <!-- Cart End -->


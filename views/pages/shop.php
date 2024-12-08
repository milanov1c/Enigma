<?php
include "models/products.php";

$products = getProducts();

$brands = getBrands();

$categories = getCategories();



?>

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Shop</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="index.php?page=home">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Shop</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Brand Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by brand</h5>
                <form>
                    <?php foreach ($brands as $b): ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input brand" id="<?= $b->brand_name ?>"
                                data-id="<?= $b->brand_id ?>">
                            <label class="custom-control-label text-capitalize" for="<?= $b->brand_name ?>"><?= $b->brand_name ?></label>
                            <span class="badge border font-weight-normal">
                                <?= $b->num ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <!-- Brand End -->
            <!-- Category Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by category</h5>
                <form>
                    <?php foreach ($categories as $c): ?>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input category" id="<?= $c->category_name ?>"
                                data-id="<?= $c->category_id ?>">
                            <label class="custom-control-label text-capitalize" for="<?= $c->category_name ?>"><?= $c->category_name ?></label>
                            <span class="badge border font-weight-normal">
                                <?= $c->num ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </form>
            </div>
            <!-- Category End -->


        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search by name" id="search"
                                    name="search">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="dropdown ml-4">
                            <select class="form-control" id="sort" name="sort">

                                <option value="0">Sort by</option>
                                <?php
                                $sort = [
                                    "price ASC" => "PRICE FROM LOWER",
                                    "price DESC" => "PRICE FROM UPPER",
                                    "product_name ASC" => "NAME A-Z",
                                    "product_name DESC" => "NAME Z-A"
                                ]; foreach ($sort as $key => $s):
                                    ?>
                                    <option value="<?= $key ?>"><?= $s ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="products" class="row">
                    <?php foreach ($products as $p):
                        $id = $p->product_id;
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                            <div class="card product-item border-0 mb-4">
                                <div
                                    class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                    <img class="img-fluid" src="assets/img/shop/<?= $p->path ?>"
                                        alt="<?= $p->product_name ?>">
                                </div>
                                <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                    <h6 class="text-truncate mb-3">
                                        <?= $p->product_name ?>
                                    </h6>
                                    <div class="d-flex justify-content-center">
                                        <?php if (getSale($id)): ?>
                                            <h6>$
                                                <?= getSale($id) ?>
                                            </h6>
                                            <h6 class="text-muted ml-2"><del>$
                                                    <?= $p->price ?>
                                                </del></h6>
                                        <?php else: ?>

                                            <h6>$
                                                <?= $p->price ?>
                                            </h6>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between bg-light border">
                                    <a href="index.php?page=product&id=<?= $p->product_id ?>"
                                        class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View
                                        Detail</a>
                                    <?php if (isLogged()): ?>
                                        <a href="" class="btn btn-sm text-dark p-0 add-cart" data-id="<?=$p->product_id?>"><i
                                                class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            <?php
                            $pagination = ceil(productsNum() / 9);
                            for ($i = 1; $i <= $pagination; $i++):
                                ?>
                                <li class="page-item"><a class="page-link" href="#" data-id="<?=$i?>"><?=$i?></a></li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
<?php
include "models/products.php";
$admin = currentUser();

$products = getAllProducts();

$messageCat = getAll("message_category");

$categories = getCategories();

$brands = getBrands();

$users = getAll("user");

$visits = getStatistics();

$logins = getLoginStatistics();

$messages = getAll("message");

if (isLogged() && currentUser()->role_id == 1): ?>

    <!-- Page Wrapper -->
    <div id="wrapper">



        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Products</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                            <h6 class="m-0 font-weight-bold text-primary">Edit products</h6>

                            <h6 class="m-0 font-weight-bold text-primary" id="messageBox">
                                <?= getFlash("success", "delete") ?>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <button class="m-0 font-weight-bold text-grey-800 btn btn-facebook"><a
                                        href="index.php?page=insert-product" class="text-black">Insert Product</a></button>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            <th>Is deleted</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($products as $p): ?>
                                            <tr>
                                                <td>
                                                    <?= $p->product_name ?>
                                                </td>
                                                <td><img src="assets/img/shop/<?= $p->path ?>" style="width: 150px"></td>
                                                <td>
                                                    <?= $p->description ?>
                                                </td>
                                                <td>
                                                    <?= $p->price ?>
                                                </td>
                                                <td>
                                                    <?= $p->category_name ?>
                                                </td>
                                                <td>
                                                    <?= $p->brand_name ?>
                                                </td>
                                                <td>
                                                    <?= $p->is_deleted == 1 ? "Yes" : "No" ?>
                                                </td>
                                                <td><a href="models/adminDelete.php?table=product&id=<?= $p->product_id ?>"
                                                        class="deleteProduct" data-id="<?= $p->product_id ?>">Delete</a>

                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>


        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Messages</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Message</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th>User</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($messages as $m): ?>
                                            <tr>
                                                <td>
                                                    <?= $m->message ?>
                                                </td>
                                                <td>
                                                    <?= $m->subject ?>
                                                </td>
                                                <td>
                                                    <?php foreach ($messageCat as $c): ?>
                                                        <?= $c->category_id == $m->category_id ? $c->category_name : "" ?>
                                                    <?php endforeach; ?>
                                                </td>

                                                <td>
                                                    <?php foreach ($users as $u): ?>
                                                        <?= $u->user_id == $m->user_id ? $u->first_name . " " . $u->last_name : "" ?>
                                                    <?php endforeach; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Categories</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Number of products</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($categories as $c): ?>
                                            <tr>
                                                <td>
                                                    <?= $c->category_name ?>
                                                </td>
                                                <td>
                                                    <?= $c->num ?>
                                                </td>
                                                <td>
                                                    <a
                                                        href="models/adminDelete.php?table=category&id=<?= $c->category_id ?>">Delete</a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Brands</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Brand</th>
                                            <th>Number of products</th>
                                            <th>Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($brands as $b): ?>
                                            <tr>
                                                <td>
                                                    <?= $b->brand_name ?>
                                                </td>
                                                <td>
                                                    <?= $b->num ?>
                                                </td>
                                                <td>
                                                    <a
                                                        href="models/adminDelete.php?table=brand&id=<?= $b->brand_id ?>">Delete</a>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Is Disabled</th>
                                            <th>Is Active</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($users as $u): ?>
                                            <tr>
                                                <td>
                                                    <?= $u->first_name ?>
                                                    <?= $u->last_name ?>
                                                </td>
                                                <td>
                                                    <?= $u->username ?>
                                                </td>
                                                <td>
                                                    <?= $u->email ?>
                                                </td>
                                                <td>
                                                    <?= $u->is_disabled ? "Yes" : "No" ?>
                                                </td>
                                                <td>
                                                    <?= $u->is_active ? "Yes" : "No" ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>

        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Visits</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Page</th>
                                            <th>Link</th>
                                            <th>Number</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($visits['page_views'] as $key => $v): ?>
                                            <tr>
                                                <td>
                                                    <?=
                                                        isset(explode("=", $key)[1]) ? explode("=", $key)[1] : $key
                                                        ?>
                                                </td>
                                                <td>
                                                    <?= $key ?>
                                                </td>
                                                <td>
                                                    <?= $v ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Logins</h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-start">
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>User</th>
                                            <th>Logins</th>
                                        </tr>
                                    </thead>
                                    <tbody id="productsTable">
                                        <?php foreach ($logins['user_attempts'] as $key => $l): ?>
                                            <tr>
                                                <td>
                                                    <?= date("d-m-Y") ?>
                                                </td>
                                                <td>
                                                    <?= $key ?>
                                                </td>
                                                <td>
                                                    <?= $v ?>
                                                </td>

                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>

    <?php else:
    header("Location: index.php?page=404");
    ?>
    <?php endif ?>
<?php
$page=get("page");
$nav=getAll("navigation");
$user=currentUser();
?>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>nigma</h1>
                </a>
            </div>
            <?php if(isLogged()):?>
                <div class="col-lg-9 col-6 text-right">
               
                <a href="index.php?page=cart" class="btn border">
                    <i class="fas fa-shopping-cart text-primary"></i>
                    <span class="badge"><?=count(getCartProducts($_SESSION['user']->user_id))?></span>
                </a>
            </div>
            <?php endif;?>
        </div>
    </div>
    <!-- Topbar End -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
          
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span
                                class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <?php foreach($nav as $n):?>
                            <a href="index.php?page=<?=$n->path?>" class="nav-item nav-link <?=$page==$n->path?"active":""?>"><?=$n->name?></a>
                            <?php endforeach;?>
                        </div>
                        <div class="navbar-nav ml-auto py-0 mt-3">
                            <?php if(isLogged()):?>
                            <a href="models/logout.php" class="nav-item nav-link">Logout</a>
                            <p class="nav-item nav-link">Welcome, <?=$user->first_name?></p>
                            <?php else:?>
                            <a href="index.php?page=login" class="nav-item nav-link">Login</a>
                            <a href="index.php?page=register" class="nav-item nav-link">Register</a>
                            <?php endif;?>
                        </div>
                    </div>
                </nav>
                
            </div>
        </div>
    </div>
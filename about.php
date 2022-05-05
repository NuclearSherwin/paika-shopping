<?php 
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/responsiveAbout.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/about.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <!-- nav starts -->
        <nav class="nav">
            <!-- This will appear when screen smaller than pc screen -->
            <div class="nav__menu-dropdown active" onclick="switchMenu();">
            <ul class="nav__items">
                <!-- This will disappear when screen smaller than pc screen -->
                <li class="nav__item">
                    <a href="index.php" class="nav__item-link"><span>Home</span></a>
                </li>
                <li class="nav__item">
                    <a href="about.php" class="nav__item-link"> <span>About</span></a>
                </li>
                <li class="nav__item">
                    <a href="" class="nav__item-link"> <span>Contact</span></a>
                </li>
                <li class="nav__item">
                    <a href="cart.php" class="nav__item-link"> <span>Your cart</span></a>
                </li>
                <li class="nav__item">
                    <a href="user.php" class="nav__item-link"> <span>Your profile</span></a>
                </li>
                <li class="nav__item">
                    <a href="#man-products" class="nav__item-link"> <span>Men's</span></a>
                </li>
                <li class="nav__item">
                    <a href="#women-products" class="nav__item-link"> <span>Women's</span></a>
                </li>
            </ul>
            </div>
            <div class="logo" header>
                <a href="index.php" id="logo__paika">
                    <h1>PAIKA</h1>
                </a>
            </div>
            <div class="nav__products">
                <a href="index.php"id="nav__products-kind">Home</a>
                <a href="about.php"id="nav__products-kind">About</a>
                <a href="#man-products" id="nav__products-kind">Men's</a>
                <a href="#women-products" id="nav__products-kind">Women's</a>
            </div>

            <ul class="profile__items">
                <li class="profile__item-search">
                    <span class="item-search-bar--icon"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" placeholder="Search" class="item-search-bar" onkeyup="search()">
                </li>
                <li class="profile__item">
                    <a href="register.php" class="profile__item-link"> <span>Register</span> </a>
                </li>
                <li class="profile__item">
                    <a href="cart.php" class="profile__item-link">
                        <span>
                            <i class="fa-brands fa-opencart"></i>
                            <?php
                                $select_data = "SELECT * FROM cart";
                                $select_data_query = mysqli_query($conn, $select_data);
                                if($product_count = mysqli_num_rows($select_data_query)){
                                    echo "<span id=\"cart_count\">$product_count</span>";
                                }else {
                                    echo "<span id=\"cart_count\">0</span>";
                                }   
                            ?>
                        </span>
                    </a>
                </li>
                <li class="profile__item">
                    <a href="user.php" class="profile__item-link">
                        <span><i class="fa-solid fa-user"></i></span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- Nav ends -->
        <div class="container">
            <div class="row about__story">
                <div class="about__story-tittle col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h1>Our Story</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti commodi pariatur temporibus perspiciatis ipsum, dolorum nesciunt illum impedit perferendis placeat voluptas modi nihil facere esse cumque possimus aliquid optio necessitatibus.</p>
                </div>
                <div class="about__story-img col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <img src="./assets/img/aboutImgs/Slide50.png" alt="">
                </div>
            </div>
            <div class="row about__story">
                <div class="about__story-tittle col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h1>Journey start from</h1>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Corrupti commodi pariatur temporibus perspiciatis ipsum, dolorum nesciunt illum impedit perferendis placeat voluptas modi nihil facere esse cumque possimus aliquid optio necessitatibus.</p>
                </div>
                <div class="about__story-img col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <img src="./assets/img/aboutImgs/newarrival.png" alt="">
                </div>
            </div>
            
            <div class="big--tittle">
                    <h1>Combo 3D On This Summer.</h1>
            </div>

            <div class="row">   
                <div id="image">
                    <img src="./assets/img/homeImgs/man-products/u-3d-knit-crew-neck.webp" alt="" class="image__img">
                    <div class="image__overlay">
                        <div class="image__tittle">U3D</div>
                        <p class="image__description">
                        The newest style in 2022
                        </p>
                    </div>
                </div>

                <div id="image">
                    <img src="./assets/img/homeImgs/women-products/3D Knit Long-Sleeve Cardigan.webp" alt="" class="image__img">
                    <div class="image__overlay">
                        <div class="image__tittle">U3D</div>
                        <p class="image__description">
                        The newest style in 2022
                        </p>
                    </div>
                </div>

                <div id="image">
                    <img src="./assets/img/homeImgs/women-products/3D Knit Ribeed Boat Neck.webp" alt="" class="image__img">
                    <div class="image__overlay">
                        <div class="image__tittle">U3D</div>
                        <p class="image__description">
                        The newest style in 2022
                        </p>
                    </div>
                </div>
            </div>

            <div class="big--tittle">
                    <h1>THANK YOU.</h1>
            </div>

        </div>
            <!-- begin footer -->
        <footer class="footer">
            <div class="row">
                <div class="footer-col col-xl-3">
                    <div class="footer_col-wrapper">
                        <h4>company</h4>
                        <ul>
                            <li><a href="#">about us</a></li>
                            <li><a href="#">our services</a></li>
                            <li><a href="#">privacy policy</a></li>
                            <li><a href="#">affiliate program</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-col col-xl-3">
                    <div class="footer_col-wrapper">
                        <h4>get help</h4>
                        <ul>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="#">shipping</a></li>
                            <li><a href="#">returns</a></li>
                            <li><a href="#">order status</a></li>
                            <li><a href="#">payment options</a></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-col col-xl-3">
                    <div class="footer_col-wrapper">
                    <h4>online shop</h4>
                    <ul>
                        <li><a href="#">watch</a></li>
                        <li><a href="#">bag</a></li>
                        <li><a href="#">shoes</a></li>
                        <li><a href="#">dress</a></li>
                    </ul>
                    </div>
                </div>
                <div class="footer-col col-xl-3">
                    <div class="footer_col-wrapper">
                        <h4>follow us</h4>
                        <div class="social-links">
                            <a href="https://www.facebook.com/profile.php?id=100040740782500"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end footer -->     
    </div>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>
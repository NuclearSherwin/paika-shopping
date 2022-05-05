<?php
    // for user register and login part
    include 'connect.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id))
        header('location:login.php');
    // for products

    if(isset($_POST['addToCart'])){

        $pName = $_POST['pName'];
        $pPrice = $_POST['pPrice'];
        $pImage = $_POST['pImage'];
        $pQuantity = $_POST['pQuantity'];
    
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_cart) > 0){
            $message[] = 'product already added to cart!';
        }else{
            mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$pName', '$pPrice', '$pImage', '$pQuantity')") or die('query failed');
            $message[] = 'product added to cart!';
        }
        
    }; 

    
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paika Home</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/responsiveHome.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
    <?php
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
                }
            }
        ?>
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

        <!-- Main begins -->
        <div class="container">
            <!-- <div class="row">
                <div class="slider tittle col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="slider__images">
                        <div class="slider__img-container">
                            <div class="slider__img-number">1/4</div>
                            <img src="./assets/img/homeImgs/fancy-01y.png" alt="">
                            <div class="slider__img-text"></div>
                        </div>
                        <div class="slider__img-container">
                            <div class="slider__img-number">2/4</div>
                            <img src="./assets/img/homeImgs/plaza.jpg" alt="">
                            <div class="slider__img-text"></div>
                        </div>
                        <div class="slider__img-container">
                            <div class="slider__img-number">3/4</div>
                            <img src="./assets/img/homeImgs/ls-slider-181-slide-1.jpg" alt="">
                            <div class="slider__img-text"></div>
                        </div>
                        <div class="slider__img-container">
                            <div class="slider__img-number">4/4</div>
                            <img src="./assets/img/homeImgs/40%sale.png" alt="40%sale">
                            <div class="slider__img-text"></div>
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="slider col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="slide">
                        <a href="#" class="slide-img"><img src="./assets/img/aboutImgs/newarrival.png" alt=""></a>
                    </div>
                    <div class="slide">
                        <a href="#" class="slide-img"><img src="./assets/img/homeImgs/Slide01.png" alt=""></a>
                    </div>
                    <div class="slide">
                        <a href="#" class="slide-img"><img src="./assets/img/homeImgs/menfashion.jpg" alt=""></a>
                    </div>
                    <div class="slide">
                        <a href="#" class="slide-img"><img src="./assets/img/homeImgs/ls-slider-181-slide-1.jpg" alt=""></a>
                    </div>

                    <div class="prev-button" onclick="plusSlide(-1)">&#10094;</div>
                    <div class="next-button" onclick="plusSlide(1)">&#10095;</div>

                    <div class="lines">
                        <div class="line" onclick="currentSlide(1)"></div>
                        <div class="line" onclick="currentSlide(2)"></div>
                        <div class="line" onclick="currentSlide(3)"></div>  
                        <div class="line" onclick="currentSlide(4)"></div>  
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="tittle col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <h2>WELCOME to Paika Fashion Shop!</h2>
                    <i class="fa-light fa-clothes-hanger">
                    <p></i>What do you want to order today?</p>
                </div>
            </div>
            <!-- begin products -->
            <div class="products" id="products">
            <h2 id="man-products">Man clothes</h2>
                <div class="row">
                    <!-- <div class="product col-xl-3 col-lg-4 col-md-6 col-sm-12">
                        <div class="product--wrapper">
                            <form action="cart.php" method="post">
                            <div class="product__img">
                                <a href="" class="product__img-link"><img src="./assets/img/homeImgs/products/Dry-pique.webp" alt=""></a>
                            </div>
                            <div class="product__detail">
                                <div class="product__detail-name">
                                    <input type="hidden" name="pName" value = 'Dry Pique Short-Sleeve Polo Shirt'>
                                    <p>Dry Pique Short-Sleeve Polo Shirt</p>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <p>$39.90</p>
                                    <input type="hidden" name="pPrice" value = '$row[pPrice]'>
                                    <input type='number' name="pQuantity" value = 'min='1' max='10'' placeholder="Quantity" >
                                </div>
                                <div class="product__detail-order">
                                    <button type="submit" name="addCart">Order Now</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div> -->
                    <?php 
                        $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed!');
                        if(mysqli_num_rows($select_product) > 0) {
                            while($fetch_product = mysqli_fetch_assoc($select_product)){
                    ?>
                        <div class="product col-xl-3 col-lg-4 col-md-6 col-sm-12\">
                            <div class="product--wrapper">
                                <form action="index.php" method="post">
                                    <div class="product__img">
                                    <input type="hidden" name="pImage" value="<?php echo $fetch_product['product_img']; ?>">
                                    <a href="" class="product__img-link"><img src="<?php echo $fetch_product['product_img']; ?>" alt=""></a>
                                    </div>
                                    <div class="product__detail">
                                    <div class="product__detail-name">
                                        <input type="hidden" name="pName" value = "<?php echo $fetch_product['product_name']; ?>">
                                        <p id="product__detail-name" > <?php echo $fetch_product['product_name']; ?> </p>
                                            <div class="product__detail-rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <p>$ <?php echo $fetch_product['product_price']; ?></p>
                                            </div>
                                                <div class="product__detail-quantity">
                                                    <input type="hidden" name="pPrice" value = "<?php echo $fetch_product['product_price']; ?> ">
                                                    <input type="number" min="1" name="pQuantity" value = "1">
                                                    <p>Available    : <?php echo $fetch_product['product_quantity']; ?></p>
                                                </div>
                                    </div>
                                    <div class="product__detail-order">
                                        <button type="submit" name="addToCart">Order Now</button>
                                        <input type='hidden' name='product_id' value='$productId'>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                        };
                        };
                    ?>
                </div>

                <h2 id="women-products" >Women</h2>
                <div class="row">
                    <?php 
                        $select_product = mysqli_query($conn, "SELECT * FROM `woman_products`") or die('query failed!');
                        if(mysqli_num_rows($select_product) > 0) {
                            while($fetch_product = mysqli_fetch_assoc($select_product)){
                    ?>
                        <div class="product col-xl-3 col-lg-4 col-md-6 col-sm-12\">
                            <div class="product--wrapper">
                                <form action="index.php" method="post">
                                    <div class="product__img">
                                    <input type="hidden" name="pImage" value="<?php echo $fetch_product['product_img']; ?>">
                                    <a href="" class="product__img-link"><img src="<?php echo $fetch_product['product_img']; ?>" alt=""></a>
                                    </div>
                                    <div class="product__detail">
                                    <div class="product__detail-name">
                                        <input type="hidden" name="pName" value = "<?php echo $fetch_product['product_name']; ?>">
                                        <p id="product__detail-name" > <?php echo $fetch_product['product_name']; ?> </p>
                                            <div class="product__detail-rating">
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <i class="fa-solid fa-star"></i>
                                                <p>$ <?php echo $fetch_product['product_price']; ?></p>
                                            </div>
                                            <div class="product__detail-quantity">
                                                    <input type="hidden" name="pPrice" value = "<?php echo $fetch_product['product_price']; ?> ">
                                                    <input type="number" min="1" name="pQuantity" value = "1">
                                                    <p>Available    : <?php echo $fetch_product['product_quantity']; ?></p>
                                                </div>
                                    </div>
                                    <div class="product__detail-order">
                                        <button type="submit" name="addToCart">Order Now</button>
                                        <input type='hidden' name='product_id' value='$productId'>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php
                        };
                        };
                    ?>
                </div>
            </div> 
                <!-- end products -->  
                <!-- Main ends -->
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
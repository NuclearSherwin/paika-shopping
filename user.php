<?php
    // for user register and login part
    include 'connect.php';
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id))
        header('location:login.php');

    // for log out 
    if(isset($_GET['logout'])){
        unset($user_id);
        session_destroy();
        header('location:login.php');
    }
    
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your profile</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/userResponsive.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/user.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
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
    
            <ul class="profile__items">
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
            <div class="user__wrapper">
            <div class="user__profile">
                <?php 
                    $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'")
                    or die('query failed!');
                    if(mysqli_num_rows($select_user) > 0){
                        $fetch_user = mysqli_fetch_assoc($select_user);
                    };
                ?>
                <div class="user__profile-head">
                    <div class="user__profile-logo">
                        <img src="./assets/img/userImgs/Phong.jpg" alt="user-picture">
                    </div>
                    <div class="user__profile-name">
                        <h4><?php echo $fetch_user['name'];?></h4>
                        <p><?php echo $fetch_user['email'];?></p>
                    </div>
                </div>
                <div class="user_profile-socials">
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="https://www.facebook.com/profile.php?id=100040740782500">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                    <a href="https://github.com/NuclearSherwin">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCSoPdj8kTA8FHtRzRVoQ3Sg">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
                <div class="user__profile-information">
                    <p> 
                        <span><i class="fa-solid fa-phone"></i></span>
                        <?php echo $fetch_user['phone_num'];?> 
                    </p>
                    <p> 
                        <span><i class="fa-solid fa-location-dot"></i></span>
                        <?php echo $fetch_user['address'];?> 
                    </p>
                </div>
                <div class="user__profile-options">
                    <a class="logout-btn" href="user.php?logout=<?php echo $user_id; ?>" 
                    onclick="return confirm('Are you sure you want to logout?');">Logout</a>
                </div>
            </div>
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
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                        </div> 
                    </div>
                </div>
            </footer>
        <!-- end footer -->
        <script src="./assets/js/script.js"></script>
    </div>
</body>
</html>
<?php
    // include file connect with database 'shopping_db'
    include 'connect.php';  
    session_start();
    $user_id = $_SESSION['user_id'];

    if(!isset($user_id))
        header('location:login.php');

    // Remove or delete the products in cart
    if(isset($_GET['remove'])){
        $remove_id = $_GET['remove'];
        mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
        header('location:cart.php');
    } 

    // Delete all products in cart
    if(isset($_GET['delete_all'])){
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        header('location:cart.php');
    }

    // update products in cart
    if(isset($_POST['update_cart'])){
        $update_quantity = $_POST['cart_quantity'];
        $update_id = $_POST['cart_id'];
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed!');
        $message[] = 'Update product successfully!';
    }
    


    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/cart.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src='./assets/js/script.js'></script>
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <title>cart</title>
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
                                    echo "<span id=\"cart_count\">$product_count</span>"; }else { echo "<span id=\"cart_count\">0</span>"; } 
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


        <!-- Start container -->
        <div class="container">
            <div class="cart-container cart-page">
                <div class="row">
                    
                <form action="cart.php?action=removeProduct&id=$productId" method="post">
                        <table class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                            <tr>
                                <th class="col-xl-7">Product</th>
                                <th class="col-xl-2">Quantity</th>
                                <th class="col-xl-3">Option</th>
                            </tr>
                            <?php 
                            $total = 0;
                            $grand_total = 0;
                            $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed!');
                            if(mysqli_num_rows($cart_query) > 0) {
                            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
                    ?>
                                <tr class="wrapper-cart__info">
                                    <td>
                                        <div class="cart__info">
                                        <img src="<?php echo $fetch_cart['image']?>" alt="your ordered product">
                                            <div class="cart__info-wrapper">
                                                <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
                                                <p style="font-size: 14px; font-weight: 500; margin: 1px 0;"><?php echo $fetch_cart['name']; ?></p>
                                                <p style="font-size: 13px; margin: 10px 0;">Price: $<?php echo $fetch_cart['price']; ?></p>
                                                <p style="font-size: 12px;">change quantity: </p><input type="number" min="1" name="cart_quantity"
                                                value="<?php echo $fetch_cart['quantity']; ?>" class="product-info-quantity">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__info-quantity">
                                        <!-- <?php 
                                        $total = $fetch_cart['price'] * $fetch_cart['quantity'];
                                        $grand_total += $total;
                                        ?> -->  
                                    <small style="font-size: 13px"><?php echo $fetch_cart['quantity']; ?></small>
                                    </td>
                                    <td class="cart__info-options">
                                        <!-- <a class="cart__info-options-update"href="">Update</a> -->
                                        <input type="submit" name="update_cart" value="update" class="cart__info-options-update">   
                                        <a href="cart1.php?remove=<?php echo $fetch_cart['id']; ?>" class="cart__info-options-delete" onclick="return confirm('remove item from cart?');"><i class="fa-solid fa-trash-can"></i></a>
                                    </td>
                                </tr>
                            <?php 
                            $total = $fetch_cart['price'] * $fetch_cart['quantity'] + 23;
                            $grand_total += $total;
                        ?>
                </form>
                    <?php
                            };
                        };
                    ?>
                        </table>
                </div>
                <div class="total__price">
                    <table class="total__price-payment">
                        <tr>
                            <td>Quantity</td>
                            <td>
                            <?php
                                $select_data = "SELECT * FROM cart";
                                $select_data_query = mysqli_query($conn, $select_data);
                                if($product_count = mysqli_num_rows($select_data_query)){
                                    echo "<small>$product_count</small>";
                                }else {
                                    echo "<h5>Price (0 item)</h5>";
                                }
                        ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <td>$23.00</td>
                        </tr>
                        <tr>
                            <td>Total <span><i class="fa-solid fa-credit-card"></i></span></td>
                            <td>
                                <?php
                                    echo $grand_total; 
                                ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="wrapper__deleteAll">
                    <a href="cart.php?delete_all" onclick="return confirm('Delete all products from your cart?');" class="deleteAll-btn">Delete all products</a>
                </div>
            </div>
        </div>
        <!-- End container -->
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
    </div>
</body>
</html>
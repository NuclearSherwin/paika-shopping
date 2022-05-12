<?php 
    include 'connect.php';
if(isset($_POST['submit'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phoneNum = mysqli_real_escape_string($conn, $_POST['phoneNum']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cPass = mysqli_real_escape_string($conn, md5($_POST['cPassword']));
        $findUser = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND phone_num = '$phoneNum'") or die('query failed');
        if(mysqli_num_rows($findUser) > 0) {
            $message[] = 'User already exits!';
        }else { 
            if($pass != $cPass) {
                $message[] = 'Password not match!';
            } else {
                mysqli_query($conn, "INSERT INTO `user_form`(name, email, phone_num, address, password) VALUES('$name', '$email', '$phoneNum', '$address', '$pass')") or die('query failed');
                echo "<script>alert('Register successfully! Welcome to Paika!');</script>";
                header('location:login.php');
                $message[] = 'Register successfully! Welcome to Paika!';
            }
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/responsiveRegister.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="wrapper">
        <div class="container">
        <?php 
            if(isset($message)) {
                foreach($message as $message) {
                    echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
                }
            } 
        ?>
            <div class="form-container">
                <form action="" method="post">
                    <h3 class="form__tittle">Register now</h3>
                        <input type="text" name="name" required placeholder="Username" class="form__box">
                        <input type="email" name="email" required placeholder="Email" class="form__box">
                        <input type="tel" name="phoneNum" required placeholder="Phone number" class="form__box">
                        <input type="text" name="address" required placeholder="address" class="form__box">
                        <input type="password" name="password" required placeholder="Password" class="form__box"> 
                        <input type="password" name="cPassword" required placeholder="Confirm password" class="form__box">
                        <input type="submit" name="submit" class="form__btn" value="register now">
                    <p>Already have an account? <a href="login.php">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>
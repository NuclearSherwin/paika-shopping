<?php 
    include 'connect.php';
    session_start();
if(isset($_POST['submit'])) {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

        $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

        if(mysqli_num_rows($select) > 0) {
            $row = mysqli_fetch_assoc($select);
            echo $_SESSION['user_id'] = $row['id'];
            header('location:index.php');
            $message[] = 'Welcome back!';
        } else {
            $message[] = 'Incorrect password or email, please try again!';
        }
    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/responsiveLogin.css">
    <link rel="stylesheet" href="./assets/css/grid.css">
    <link rel="stylesheet" href="./assets/css/register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/823e15a3c8.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700;800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">
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
                <h4 class="form__tittle">Login now</h4>
                        <input type="email" name="email" required placeholder="Enter your email" class="form__box">
                        <input type="password" name="password" required placeholder="Enter your password" class="form__box"> 
                        <input type="submit" name="submit" class="form__btn" value="login now">
                    <p>Don't have an account? <a href="register.php">Register</a></p>
                </form>
            </div>
        </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./assets/js/script.js"></script>
</body>

</html>
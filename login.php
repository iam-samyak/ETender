<?php
@include 'config.php';

session_start();


if(isset($_POST['submit'])){
    // $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    // $cpass = md5($_POST['cpassword']);
    // $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    if($_POST['email'] == 'admin@eprocurement.com' && $_POST['password'] == 'admin'){
        header('location:admin.php');
    }


    else{
    $select = " SELECT * FROM registration_form WHERE email = '$email' AND password = '$pass' ";
    $active = " SELECT * FROM registration_form WHERE email = '$email' AND password = '$pass' AND status = 'active' ";

    $result = mysqli_query($conn, $select);
    $activeresult = mysqli_query($conn, $active);

    if(mysqli_num_rows($result) > 0){
        $row =mysqli_fetch_array($result);
        if(mysqli_num_rows($activeresult) > 0){
            header('location:user.php');
        }
        else
        {
        $error[] = 'account not activated!';
        }
    }
    else{
        $error[] = 'incorrect email or password!';
    }
  }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <link rel="icon" href="Images/396-3961185_document-png-circle-document-icon-removebg.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <title>Login Here</title>
</head>
<body>
    <!-- header  -->
    <header class="header">
            <a href="#home" class="logo"><i class="fa fa-hand-holding-dollar"></i> e-Procurement.</a>

            <nav class="navbar">
                <a href="http://localhost/Minor/ETender/registration.php" class="appoinmentbtn">Login/Register</a>
            </nav>
        </header>
        <!-- header ends -->
    <div class="form-container">
        <form action="" method="post">
            <h3>Login Here</h3>
            <?php 
                if(isset($_SESSION['msg'])){
                    echo $_SESSION['msg'];
                }
                else{
                    echo $_SESSION['msg'] = "You are logged out. Please login again.";
                }
            ?>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
            ?><br>
            <input type="email" name="email" required placeholder="Enter you Email">
            <input type="password" name="password" required placeholder="Enter you Password"><br>
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have account? <a href="registration.php">Register Here</a></p>
            <p>Forget password? Don't Worry. <a href="recover.php">Click Here</a></p>
        </form>
    </div>
    <!-- contact section start -->
    <section class="contact" id="contact">
            <h3 class="heading">Contact<span>Us</span></h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum dolorum odio temporibus fuga impedit commodi maxime laudantium modi adipisci non.</p>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.9726496277117!2d75.89278031443688!3d22.729257932931414!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962fd0b7d3aab15%3A0x1215c842d731998f!2sMXPERTZ!5e0!3m2!1sen!2sus!4v1658489600316!5m2!1sen!2sus"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            <div class="box-container">
                <div class="box">
                    <i class="fas fa-location-dot"></i>
                    <h3>Address</h3>
                    <p>565,Lorem, ipsum.<br>Lorem, ipsum.</p>
                </div>
                <div class="box">
                    <i class="fas fa-envelope"></i>
                    <h3>Email Us</h3>
                    <p>abcd@xyz.com<br>abcdk@xyz.com</p>
                </div>
                <div class="box">
                    <i class="fas fa-phone"></i>
                    <h3>Contact Us</h3>
                    <p>+91-5455525257<br>+91-5556552232</p>
                </div>
            </div>
        </section>

        <!-- contact us section ends -->
        <!-- footer section start -->
        <section class="footer" id="footer">
            <div class="box-container">

                <div class="box">
                    <h3>Contact Info</h3>
                    <a href="#"><i class="fas fa-phone"></i>+91-5455525257</a>
                    <a href="#"><i class="fas fa-phone"></i>+91-5455525257</a>
                    <a href="#"><i class="fas fa-envelope"></i>abcd@xyz.com</a>
                    <a href="#"><i class="fas fa-envelope"></i>abcd@xyz.com</a>
                    <a href="#"><i class="fas fa-location-dot"></i>5156,Lorem, ipsum dolor.</a>
                </div>
                <div class="box">
                    <h3>Follow Us</h3>
                    <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a>
                    <a href="#"><i class="fab fa-twitter"></i>Twitter</a>
                    <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
                    <a href="#"><i class="fab fa-linkedin"></i>Linkedin</a>
                </div>
            </div>
            <div class="credit">© Created By <span>Samyak Jain</span> | All Rights Reserved</div>
        </section>
</body>
</html>
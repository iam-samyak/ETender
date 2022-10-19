<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
@include 'config.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['cpassword']);
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $token = bin2hex(random_bytes(15));
    $mail = new PHPMailer(true);

    $select = " SELECT * FROM registration_form WHERE email = '$email' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result) > 0){
        $error[] = 'user already exist!';
        header('location:login.php');
    }
    else{
        if($pass != $cpass){
            $error[] = 'password not match! Try again.';
        }
        else{
            $insert = " INSERT INTO registration_form(name, email, password, state, token, pincode, status) VALUES('$name','$email','$pass','$state','$token','$pincode','inactive')";
            $iquery = mysqli_query($conn, $insert);

            if($iquery){
                 $mail->isSMTP();                                           
                 $mail->Host       = 'smtp.gmail.com';                     
                 $mail->SMTPAuth   = true;                                   
                 $mail->Username   = 'samyakjain2109@gmail.com';                    
                 $mail->Password   = 'nbihmlrfmusezzuh';                             
                 $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                 $mail->Port       = 465;                                    
                 $mail->setFrom('samyakjain2109@gmail.com', 'eProcurement');
             
                 $mail->addAddress($email);             
             
             
                 $mail->isHTML(true);                                 
                 $mail->Subject = 'Verify Account - Email Activation';
                 $mail->Body    = 'Click here to verfiy account. http://localhost/Minor/ETender/activate.php?token='.$token.'.' ;
             
                 if($mail->send()){
                    session_start();
                    $_SESSION['msg'] = "Check your mail to activate your account $email .";
                    header('location:login.php');}
                    else{
                       $error[] = "Email sending failed.";
                    }
            }
            else{
                echo 'unsuccessfull';
            }
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
    
    <title>Register Here</title>
</head>
<body>
    <!-- header  -->
    <header class="header">
    <a href="#home" class="logo"><i class="fa fa-hand-holding-dollar"></i> e-Procurement.</a>

            <nav class="navbar">
                <a href="http://localhost/Minor/ETender/login.php" class="appoinmentbtn">Login/Register</a>
            </nav>
        </header>
        <!-- header ends -->
    <div class="form-container" id="form-container">
        <form action="" method="post">
            <h3>Register Here</h3>
            <?php
                if(isset($error)){
                    foreach($error as $error){
                        echo '<span class="error-msg">'.$error.'</span>';
                    };
                };
                ?><br>
            <input type="text" name="name" required placeholder="Enter your Name">
            <input type="email" name="email" required placeholder="Enter your Email">
            <input type="password" name="password" required placeholder="Enter your Password">
            <input type="password" name="cpassword" required placeholder="Confirm your Password">
            <br> Select State : <select name="state" required>
                <option value="" selected disabled hidden>Choose here</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                <option value="Daman and Diu">Daman and Diu</option>
                <option value="Delhi">Delhi</option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Puducherry">Puducherry</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
            </select><br>
            <input type="pincode" name="pincode" required placeholder="Enter Pincode"><br><br>
            <input type="submit" name="submit" value="Register now" class="form-btn">
            <p>Alreay have account? <a href="login.php">Login Here</a></p>
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
            <div class="credit">© Created By <span>Samyak Jain</span> with ❤️ | All Rights Reserved</div>
        </section>
</body>
</html>
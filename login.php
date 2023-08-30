<?php
session_start();
if (isset($_SESSION["auth_id"])){
    header('location:./');
    return 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!--TITLE-->
<title>Login || Vote share</title>

<!--SHORTCUT ICON-->
<link rel="shortcut icon" href="assets/images/favicon.ico" />

<!--META TAGS-->
<meta charset="UTF-8" />
<meta name="language" content="ES" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

<!--FONT AWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<!--ICONIFY-->
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<!--PLUGIN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&display=swap" rel="stylesheet" />

<!--STYLE SHEET-->
<link rel="stylesheet" href="assets/css/main.css" />
<link rel="stylesheet" href="assets/css/animate.css" />
<link rel="stylesheet" href="assets/css/admin.css" />

</head>
<body>
<div class="welcome">
    <!--LOGIN FORM-->
    <section class="login flex">
        <article class="flex_content padding_2x">
            <figure class="logo"><figcaption>LOGO.</figcaption></figure>
            <h1 class="title medium">Hello, there!</h1>
            <p><mark>Password reset option is not available at this time.</mark></p>
            <a href="registration.php">Don't have an account? Register</a>
        </article>
        <form class="flex_content padding_2x">
            <ul class="padding_2x">
                <li><fieldset class="flex_content center"><h2 class="title medium">Welcome back!</h2></fieldset></li>
            </ul>
            <ul class="fields">
                <li class="personal_details">
                    <fieldset class="flex_content">
                        <label for="uname">Email address</label>
                        <input type="text" inputmode="text" name="uname" maxlength="150" />
                    </fieldset>
                    <fieldset class="flex_content">
                        <label for="lname">Password</label>
                        <input type="password" inputmode="password" name="pssd" maxlength="30" />
                    </fieldset>
                </li>
                <li class="flex">
                    <fieldset class="flex_content fixed_flex">
                        <button class="btn btn_1" onclick="ajax('login')">LogIn</button>
                    </fieldset>
                </li> 
            </ul>     
        </form>
    </section>
</div>

<!--JAVASCRIPT-->
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/custom.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>
</body>
</html>

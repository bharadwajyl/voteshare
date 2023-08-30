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
<title>Registration || Vote share</title>

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
    <!--REGISTRATION FORM-->
    <section class="registration flex">
        <article class="flex_content padding_2x">
            <figure class="logo"><figcaption>LOGO.</figcaption></figure>
            <h1 class="title medium">Hello, there!</h1>
            <p><mark>Note: First name, Last name, Address should match the one you upload as a Photo Identity in the end.</mark></p>
            <a href="./">Have an account? LogIn</a>
        </article>
        <form class="flex_content padding_2x">
            <ul class="multi_step fixed_flex padding_2x">
                <li class="personal_details"><iconify-icon icon="clarity:times-circle-line"></iconify-icon></li>
                <li class="contact_details"><iconify-icon icon="clarity:times-circle-line"></iconify-icon></li>
                <li class="navigation_details"><iconify-icon icon="clarity:times-circle-line"></iconify-icon></li>
            </ul>
            <ul class="fields">
                <li class="personal_details">
                    <fieldset class="flex_content">
                        <label for="honorofic">Honorific</label>
                        <select name="honorific">
                            <option value="mr">Mr</option>
                            <option value="mrs">Mrs</option>
                            <option value="miss">Miss</option>
                        </select>
                    </fieldset>
                    <fieldset class="flex_content">
                        <label for="fname">First name</label>
                        <input type="text" inputmode="text" name="fname" maxlength="100" />
                    </fieldset>
                    <fieldset class="flex_content">
                        <label for="lname">Last name</label>
                        <input type="text" inputmode="text" name="lname" maxlength="100" />
                    </fieldset>
                </li>
                <li class="contact_details">
                    <fieldset class="flex_content">
                        <label for="email">Email</label>
                        <input type="email" inputmode="email" name="email" maxlength="150" />
                    </fieldset>
                    <fieldset class="flex_content">
                        <label for="tel">Mobile no</label>
                        <input type="tel" inputmode="tel" name="tel" maxlength="15" />
                    </fieldset>
                </li>
                <li class="navigation_details">
                    <fieldset class="flex_content">
                        <label for="address">Address</label>
                        <input type="text" inputmode="text" name="address" />
                    </fieldset>
                    <fieldset class="flex_content">
                        <label for="password">Set Password</label>
                        <input type="text" inputmode="text" name="password" />
                    </fieldset>
                    <fieldset class="flex_content">
                        <label>
                            <aside class="fixed_flex">
                                <img src="assets/images/aadhar.png" alt="Aadhar" title="Aadhar" loading="lazy" />
                                <img src="assets/images/driver.png" alt="DL" title="Driving License" loading="lazy" />
                                <img src="assets/images/pan.png" alt="Pan" title="Pan" loading="lazy" />
                            </aside>
                            <input type="file" inputmode="file" name="identity" accept=".png,.PNG,.jpg,.JPG,.pdf,.PDF,.jpeg,.JPEG" />
                        </label>
                    </fieldset>
                </li>
                <li class="flex">
                    <fieldset class="flex_content fixed_flex">
                        <button class="btn btn_1">Proceed</button>
                        <button class="btn btn_4">Clear</button>
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

<?php
session_start();
date_default_timezone_set("Asia/Kolkata");
if ((isset($_SESSION["auth_id"])) && ($_SESSION["auth_id"] == "AUTH_SU_".date("dmy"))){
    
    //DB
    @require("root/db.php");
    
    //Fetch new registrations
    $new_reg = $conn->query("SELECT * FROM registration WHERE status = '0' AND mode = '0' ORDER BY id DESC");
    
} else{
    header('location:./../login.php');
    return 1;    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!--TITLE-->
<title>Admin panel || Vote share</title>

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
<link rel="stylesheet" href="./../assets/css/main.css" />
<link rel="stylesheet" href="./../assets/css/home.css" />
<link rel="stylesheet" href="./../assets/css/animate.css" />
<link rel="stylesheet" href="assets/css/admin.css" />

</head>
<body>

<!--NAV-->
<nav class="flex">
    <figure><figcaption>Vote share</figcaption></figure>
    <a href="javascript:void(0)" onclick="ajax('logout')">LogOut</a>
</nav>

<!--MAIN-->
<main class="padding_2x">
    <section class="tables padding_2x">
        <h2 class="title small">New user requests</h2>
        <table>
            <thead>
                <tr>
                    <th>sl.no</th>
                    <th>Full name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($new_reg->num_rows > 0) {
                    $count = 0;
                    while($row = $new_reg->fetch_assoc()) {
                        $first_name = ucfirst("".$row["firstname"]."");
                        $last_name = ucfirst("".$row["lastname"]."");
                        $fname = "$first_name $last_name";
                        $id = "".$row["id"]."";
                        $count++;
                        echo'<tr>
                            <td>'.$count.'</td>
                            <td>'.$fname.'</td>
                            <td class="fixed_flex">
                                <button class="btn btn_2" onclick="ajax(\'verify\',\''.$id.'\')">Verify</button>
                                <button class="btn btn_5" onclick="ajax(\'terminate\',\''.$id.'\')">Terminate</button>
                            </td>
                        </tr>';
                    }
                } else {
                    echo'
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    ';
                }
                ?>
            </tbody>
        </table>
    </section>
</main>


<!--JAVASCRIPT-->
<script type="text/javascript" src="./../assets/js/custom.js"></script>
<script type="text/javascript" src="./../assets/js/home.js"></script>
<script type="text/javascript" src="assets/js/admin.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>
</body>
</html>

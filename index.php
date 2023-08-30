<?php
session_start();
if (isset($_SESSION["auth_id"])){
    date_default_timezone_set("Asia/Kolkata");
    if ($_SESSION["auth_id"] == "AUTH_SU_".date("dmy")) {
        $nav_link = '<a href="admin/">Admin panel</a>';
    } else {
        $nav_link = '';
    }
    
    //DB
    require("./admin/root/db.php");
    
    //Fetch details
    if (isset($_GET["q"])){
        $_GET["q"] != 1 ? $start_no = ($_GET["q"] - 1)*50 : $start_no = $_GET["q"];
        $end_no = $_GET["q"] * 50;
        $result = $conn->query("SELECT * FROM voters_list LIMIT $start_no, $end_no");
    } else {
        $result = $conn->query("SELECT * FROM voters_list");
    }
    $total_rows = $conn->query("SELECT * FROM voters_list")->num_rows;
    
} else {
    header('location:./login.php');
    return 1;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

<!--TITLE-->
<title>Vote share</title>

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
<link rel="stylesheet" href="assets/css/home.css" />
<link rel="stylesheet" href="assets/css/animate.css" />

</head>
<body>

<!--NAV-->
<nav class="flex">
    <figure><figcaption>Vote share</figcaption></figure>
    <aside>
    <?php print($nav_link); ?>
    <a href="javascript:void(0)" onclick="ajax('logout')">LogOut</a>
    </aside>
</nav>

<!--MAIN-->
<main class="padding_2x">
    <aside class="fixed_flex">
    </aside>
    <table>
        <thead>
            <tr>
                <th>Pooling Booth number</th>
                <th>Pooling Booth name</th>
                <th>Parent Constituency</th>
                <th>Winner- 2014</th>
                <th>1st Runner up other than INC and BJP</th>
                <th>Margin (%)</th>
                <th>Margin</th>
                <th>Total Voters</th>
                <th>BJP - Votes</th>
                <th>BJP- % vote</th>
                <th>INC- Votes</th>
                <th>INC- % votes</th>
                <th>Winner- 2019</th>
                <th>Margin %</th>
                <th>Margin</th>
                <th>Total Voters</th>
                <th>BJP- Votes</th>
                <th>BJP- % votes</th>
                <th>INC- Votes</th>
                <th>INC- % Votes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $count = 0;
                while($row = $result->fetch_assoc()) {
                     strtolower("".$row["col_14"]."") == "bjp" ?
                     $win_19 = '<img src="assets/images/bjp.png" alt="BJP" title="BJP" width="20px" />' :
                     $win_19 = '<img src="assets/images/inc.png" alt="INC" title="INC" width="20px" />';
                     strtolower("".$row["col_4"]."") == "bjp" ?
                     $win_14 = '<img src="assets/images/bjp.png" alt="BJP" title="BJP" width="20px" />' :
                     $win_14 = '<img src="assets/images/inc.png" alt="INC" title="INC" width="20px" />';
                    if ($count != 0 && $count < 51){
                        echo'
                            <tr>
                                <td>'.$row["col_1"].'</td>
                                <td>'.$row["col_2"].'</td>
                                <td>'.$row["col_3"].'</td>
                                <td>'.$win_14.'</td>
                                <td>'.$row["col_5"].'</td>
                                <td>'.$row["col_6"].'</td>
                                <td>'.$row["col_7"].'</td>
                                <td>'.$row["col_8"].'</td>
                                <td>'.$row["col_9"].'</td>
                                <td>'.$row["col_10"].'</td>
                                <td>'.$row["col_11"].'</td>
                                <td>'.$row["col_12"].'</td>
                                <td>'.$win_19.'</td>
                                <td>'.$row["col_15"].'</td>
                                <td>'.$row["col_16"].'</td>
                                <td>'.$row["col_17"].'</td>
                                <td>'.$row["col_18"].'</td>
                                <td>'.$row["col_19"].'</td>
                                <td>'.$row["col_20"].'</td>
                                <td>'.$row["col_21"].'</td>
                            </tr>
                        ';
                    }
                    $count++;
                }
            } else {
                echo '
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                ';
            }
            ?>
        </tbody>
    </table>
    <form class="paggination fixed_flex" method="GET">
        <?php
        for ($i=1; $i<round($total_rows/50)+2; $i++){
            if (isset($_GET["q"])) { 
                if ($_GET["q"] == $i) {
                    echo '<button type="submit" name="q" class="active" value="'.$i.'">'.$i.'</button>';
                } else {
                    echo '<button type="submit" name="q" value="'.$i.'">'.$i.'</button>';
                }
            } else {
                if ($i == "1") {
                    echo '<button type="submit" name="q" class="active" value="'.$i.'">'.$i.'</button>';
                } else {
                    echo '<button type="submit" name="q" value="'.$i.'">'.$i.'</button>';
                }
            }
        }
        ?>
    </form>
</main>

<!--JAVASCRIPT-->
<script type="text/javascript" src="assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/home.js"></script>
<script type="text/javascript" src="assets/js/ajax.js"></script>
</body>
</html>

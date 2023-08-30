<?php
$conn = new mysqli("localhost", "phpmyadmin", "LOOSERS@2016", "voters");
if ($conn->connect_error) {
    print_r("error: Database failure");
}
?>

<?php
$conn = new mysqli("localhost", "user", "password", "db");
if ($conn->connect_error) {
    print_r("error: Database failure");
}
?>

<?php
//Check the type of the form posted
switch ($_POST["FormType"]) {
    case "verify": case "terminate": case "verified":
        Operations::Crud(''.$_POST['FormType'].'');
        break;
    case "logout":
        session_start();
        unset($_SESSION['auth_id']);
        print_r("success:");
        break;
    default:
        die("error: Not allowed");
        break;
}

class Operations{
    public function Crud($formtype){
        try {
            if (! @include_once( 'db.php' )) {
                throw new Exception ('error: Database connection error');
            }
            if (!file_exists('db.php' ) || !file_exists('crud.php' )){
                throw new Exception ('error: Either of the files doesnt exists');
            } else {
                require("db.php");
                include("crud.php");
            }
        }
        catch(Exception $e) {
            print_r('error: ' .$e->getMessage());
        }
    }
}
?>

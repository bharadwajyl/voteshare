<?php
//Check the type of the form posted
switch ($_POST["FormType"]) {
    case "registration": case "login": case "logout":
        Operations::Authentication(''.$_POST['FormType'].'');
        break;
    default:
        die("error:" .$_POST["FormType"]);
        break;
}

class Operations{
    public function Authentication($formtype){
        try {
            if (! @include_once( 'db.php' )) {
                throw new Exception ('error: Database connection error');
            }
            if (!file_exists('db.php' ) || !file_exists('authentication.php' )){
                throw new Exception ('error: Either of the files doesnt exists');
            } else {
                require("db.php");
                include("authentication.php");
            }
        }
        catch(Exception $e) {
            print_r('error: ' .$e->getMessage());
        }
    }
}
?>

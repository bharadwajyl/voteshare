<?php
switch ($formtype){
    case "registration":
        
        //Assign user input values to variables
        $honorific = $_POST["honorific"];
        $first_name = strtolower($_POST["fname"]);
        $last_name = strtolower($_POST["lname"]);
        $email = strtolower($_POST["email"]);
        $mobile = $_POST["tel"];
        $address = $_POST["address"];
        $password = $_POST["password"];
        
        //Check all fields
        $error = 0;
    
        //Replace all Alphanumerical values except space from First & Last name
        $first_name = preg_replace('/[^\da-z ]/i', '', $first_name);
        $last_name = preg_replace('/[^\da-z ]/i', '', $last_name);
        
        //Validate Email
        $domains = array('gmail.com', 'outlook.com', 'yahoo.in', 'yahoo.com', 'hotmail.com');
        $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]*(" . implode('|', $domains) . ")$/i";
        if ($email == ""){
            print_r("error: Please provide your email");
            $error = 1;
            return 1;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            print("erro: Invalid email address");
            $error = 1;
            return 1;
        }
        if (!preg_match($pattern, $email)) {
            print("error: We allow providers from gmail, yahoo, outlook, hotmail");
            $error = 1;
            return 1;
        }
        
        //Validate Mobile no
        if (!preg_match('/^[0-9]{10}+$/', $mobile)){
            print_r("error: Invalid mobile number");
            $error = 1;
            return 1;
        }
        
        //Validate address
        if ($address == ""){
            print_r("error: Full address required");
            $error = 1;
            return 1;
        }
        
        //Validate password
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        print_r('error: Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.');
        $error = 1;
        return 1;
}
        
        //Upload Identity
        $target_dir = "./../admin/assets/images/Identities/";
        $target_file = $target_dir . basename($_FILES["identity"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        $check = getimagesize($_FILES["identity"]["tmp_name"]);
        $newfilename = rand().strrchr(basename($_FILES["identity"]["name"]), '.');
        $allowed_file_types = array("png", "jpg", "jpeg", "pdf");
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 20500) {
            print_r("error: File size should be less than 200kb");
            $uploadOk = 0;
        }
        
        //Check file type
        if(!in_array($imageFileType, $allowed_file_types)) {
            print_r("error: Sorry, only JPG, JPEG, PNG & PDF file types are allowed");
            $uploadOk = 0;
        }
        
        //If uploadOk is 0
        if ($uploadOk == 0) {
            print_r("error: Error cannot be identified, please raise a ticket");
            $error = 1;
        } else {
            move_uploaded_file($_FILES["identity"]["tmp_name"], $target_dir.$newfilename) ?
            $file_url = $newfilename :
            print_r("error: Identity uploading fails");
        }
        
        //Generate Reference no
        date_default_timezone_set("Asia/Kolkata");
        $refno = "REF".date("dmyhms");
        
        
        //Push to DB if there is no error
        if ($error == 0){
            $conn->query("INSERT INTO registration (honorific, firstname, lastname, email, mobile, address, identity, password, status, refno, mode) VALUES ('$honorific', '$first_name', '$last_name', '$email', '$mobile', '$address', '$file_url', '$password', '0', '$refno', '0')") === TRUE ?
            print_r('success: <section class="message padding_2x"> <aside class="checkmark_wrapper padding_2x"> <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 98.5 98.5" enable-background="new 0 0 98.5 98.5" xml:space="preserve"> <path class="checkmark" fill="none" stroke-width="8" stroke-miterlimit="10" d="M81.7,17.8C73.5,9.3,62,4,49.2,4 C24.3,4,4,24.3,4,49.2s20.3,45.2,45.2,45.2s45.2-20.3,45.2-45.2c0-8.6-2.4-16.6-6.5-23.4l0,0L45.6,68.2L24.7,47.3"/> </svg> <h2 class="title medium">Account submission successfull!</h2> <p>Thank you for registering with us. We have received your account details. you will be notified through the registered email address, on successfull account verification.<br> <b>Reference no:</b> '.$refno.' </p> </aside> </section>') :
            print_r('failure: <section class="message padding_2x"> <aside class="checkmark_wrapper padding_2x"> <i class="fa fa-times-circle-o danger" style="font-size:5em;"></i> <h2 class="title medium">Account creation failed!</h2> <p>We are unable to proceed with your account registration at this time. Please try again.</p> </aside> </section>');
        } else {
             print_r("error: unable to process your request");           
        }
        
    break;
    
    case "login":
        
        //Assign user input values to variables
        $uname = $_POST["uname"];
        $pssd = $_POST["pssd"];
        
        //Fetch from DB
        $uname != "admin" ? $result = $conn->query("SELECT * FROM registration WHERE email = '$uname' AND password = '$pssd'") : $result = $conn->query("SELECT * FROM registration WHERE firstname = '$uname' AND password = '$pssd'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                date_default_timezone_set("Asia/Kolkata");
                session_start();
                if ("".$row["status"]."" == "active"){
                    "".$row["mode"]."" == "superuser" ? $_SESSION["auth_id"] = "AUTH_SU_".date("dmy") : $_SESSION["auth_id"] = "AUTH".rand();
                    print("success:");
                } else {
                    print("failure: Unverified account");
                    return 1;
                }
            }
        } else {
            print_r("failure: Credentials not found");
        }
    break; 
    case "logout":
        session_start();
        unset($_SESSION['auth_id']);
        print_r("success:");
    break;
    default:
        print_r("error: Direct access not allowed");
    break;   
}
?>

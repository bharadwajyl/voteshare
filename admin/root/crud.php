<?php
switch ($formtype){
    case "verify":
        
        //Assign user input values to variables
        $code = $_POST["code"];
        
        //Fetch details
        $result = $conn->query("SELECT * FROM registration WHERE id = '$code'");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $first_name = ucfirst("".$row["firstname"]."");
                $last_name = ucfirst("".$row["lastname"]."");
                $fname = "$first_name $last_name";
                $cno = "".$row["mobile"]."";
                $email = "".$row["email"]."";
                $addr = "".$row["address"]."";
                $url = "".$row["identity"]."";
                substr($url, strpos($url, ".") + 1) == "pdf" ? $display = '<iframe src='.$url.'></iframe>' : $display = '<figure> <img src=assets/images/Identities/'.$url.' alt="preview" /> </figure>';
                print('modal: <div class="modal padding_2x"> <a href="javascript:void(0)" class="closer" onclick="closer(\'modal\',\'\')"><i class="fa fa-times"></i></a><section class="flex padding_1x"> <table> <tbody> <tr> <td>Full name</td> <td>'.$fname.'</td> </tr> <tr> <td>Contact no</td> <td>'.$cno.'</td> </tr> <tr> <td>Email</td> <td>'.$email.'</td> </tr> <tr> <td>Address</td> <td>'.$addr.'</td> </tr> </tbody> </table> '.$display.' </section><button class="btn btn_1" onclick="ajax(\'verified\', \''.$code.'\')">Verified</button></div>');
            }
        } else {
          print("failure: Cannot fetch the details");
        }
        $conn->close();
        
    break;
    
    case "verified":
        //Assign user input values to variables
        $code = $_POST["code"];
        
        //Update database
        if ($conn->query("UPDATE registration set status = 'active' WHERE id=$code") === TRUE) {
            print("success:");
            
            //Fetch details
            $result = $conn->query("SELECT email FROM registration WHERE id=$code");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $u_email = "".$row["email"]."";
                }
            }
            
            //PHP mail
            $to = "$u_email";
            $subject = "Account verification";
            $txt = '
                mail content goes here ';
            $headers = "From: support@levioosa.000webhostapp.com" . "\r\n" . "CC: support@levioosa.000webhostapp.com";
            mail($to,$subject,$txt,$headers);         
        } else {
            print("failure: Code error");
        }
    break;
    case "terminate":
        //Assign user input values to variables
        $code = $_POST["code"];
        
        //Delete from database
        $conn->query("DELETE FROM registration WHERE id=$code") === TRUE ? print("success:") : print("failure: Code error");
    break; 
    default:
        print_r("error: Direct access not allowed");
    break;   
}
?>

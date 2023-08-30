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
                <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> <html xmlns="http://www.w3.org/1999/xhtml"> <head> <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> <title>Account verified</title> <style type="text/css"> body {margin: 0; padding: 0; min-width: 100%!important;} img {height: auto;} .content {width: 100%; max-width: 600px;} .header {padding: 40px 30px 20px 30px;} .cellinner {padding: 30px 30px 30px 30px;} .borderbottom {border-bottom: 1px solid #f2eeed;} .subhead {font-size: 15px; color: #ffffff; font-family: sans-serif; letter-spacing: 10px;} .h1, .h2, .dualbody {color: #153643; font-family: sans-serif;} .h1 {color: #ffffff; font-size: 33px; line-height: 38px; font-weight: bold;} .h2 {padding: 0 0 15px 0; font-size: 24px; line-height: 28px; font-weight: bold;} .dualbody {font-size: 16px; line-height: 22px;} .button {text-align: center; font-size: 18px; font-family: sans-serif; font-weight: bold; padding: 0 30px 0 30px;} .button a {color: #ffffff; text-decoration: none;} </style> </head> <body bgcolor="#f2f2f2"> <table width="100%" bgcolor="#f2f2f2" border="0" cellpadding="0" cellspacing="0"> <tr> <td> <table bgcolor="#ffffff" class="content" align="center" cellpadding="0" cellspacing="0" border="0"> <tr> <td bgcolor="#1e1e1e" class="header"> <table class="col425" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 425px;"> <tr> <td height="70"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="h1" style="padding: 5px 0 0 0;"> Levioosa </td> </tr> </table> </td> </tr> </table> </td> </tr> <tr> <td class="cellinner borderbottom"> <table width="100%" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="h2"> Account verified successfully. </td> </tr> <tr> <td class="dualbody"> Greetings from <b>Levioosa</b>,<br> We have verified your account details successfully. You can now login to your account using the email and password registred with us. Thankyou registering with us. </td> </tr> </table> </td> </tr> <tr> <td class="cellinner borderbottom"> <table width="200" align="left" border="0" cellpadding="0" cellspacing="0"> </table> <table class="col380" align="left" border="0" cellpadding="0" cellspacing="0" style="width: 100%; max-width: 380px;"> <tr> <td> <table width="100%" border="0" cellspacing="0" cellpadding="0"><tr> <td style="padding: 20px 0 0 0;"> <table class="buttonwrapper" bgcolor="#f8ac40" border="0" cellspacing="0" cellpadding="0"> <tr> <td class="button" height="45"> <a href="https://levioosa.000webhostapp.com/VoteShare">LogIn</a> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> <tr> <td align="center" class="cellinner dualbody"> © Registered Protected Monitered </td> </tr> <tr> <td class="footer" bgcolor="#1e1e1e"> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </body> </html>
            ';
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

<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $interest = $_POST['interest'];
    $other = $_POST['other'];
    
    function IsInjected($str)
    {
        $injections = array('(\n+)',
               '(\r+)',
               '(\t+)',
               '(%0A+)',
               '(%0D+)',
               '(%08+)',
               '(%09+)'
               );
                   
        $inject = join('|', $injections);
        $inject = "/$inject/i";
        
        if(preg_match($inject,$str))
        {
          return true;
        }
        else
        {
          return false;
        }
    }
    
    if(IsInjected($email))
    {
        echo "Bad email value!";
        exit;
    }
    
    $email_subject = "Inquiry from CankTech Website";

	$email_body = "You have received an inquiry to contact $name.\n
                            Phone: $phone \n 
                            Interest: $interest \n 
                            Other: $other";
                            
    $to = "caleb@canktech.com";

    $headers = "From: $email \r\n";

    $headers .= "Reply-To: $email \r\n";
                            
    mail($to,$email_subject,$email_body,$headers);
    header("Location: success.html", true, 301);
    exit();
?>
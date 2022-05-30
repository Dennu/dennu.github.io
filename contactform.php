<?php
if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}
$name = $_POST['name'];
//$lname = $_POST['lastname'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$phone = $_POST['tel'];

//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "<script> alert('Name and email are mandatory!');
    </script>";
    exit;
}  //  window.history.go(-1);

if(IsInjected($visitor_email))
{
    echo "Bad email value!";
    exit;
}

$email_from = 'info@DynamikkCargo.com';//<== update the email address
$email_subject = "Dynamikk Transcargo Solution";
$email_body = "New message from the user $name.\n".
    "Contact no.:$phone.\n".
    "Here is the message:\n $message";
    
$to = "dennis.george4066@gmail.com";//<== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
//header('Location: thank-you.html');
echo "<script>alert('You message has been sent sucessfully!!');
      window.location.reload();
        </script>";
        //window.history.go(-1);

// Function to validate against any email injection attempts
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
   
?> 
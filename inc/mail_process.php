<?php
//Enter database details
$new = new PDO("mysql:host=localhost;dbname=sentword","root","");

if(isset($_POST['username']))
{
    $username   = $_POST["username"];
    $userEmail  = $_POST["sendEmail"];
    $msgSubject = $_POST["subSubject"];
    $msgBody    = $_POST["subMessa"];

    if ($username == "" || $userEmail == "" || $msgSubject == "" || $msgBody == "") {
        echo "incomplete";
    }else {

        $message = "
            <h4> Contact Form Details</h4>
            <p><label>Name:</label> <br>$username</p>
            <p><label>Email:</label> <br>$userEmail</p>
            <p><label>Message Subject:</label> <br>$msgSubject</p>
            <p><label>Message Body:</label> <br>$msgBody</p>
        ";
        $to = "psthenry.oyim@gmail.com";
        $headers = "From: $userEmail\n";
        $headers .= "MIME-Version: 1.0\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\n";
        if(mail($to, $msgSubject, $message, $headers)) {
	////////////////////
	    	echo "sent_success";
			exit();
		} else {
			echo "Sorry Your Message Was Not Sent";
			exit();
		}
    }
}
//for the newletter email
if(isset($_POST['email']))
{
    $email   = $_POST["email"];

    if ($email == "") {
        echo "incomplete";
    }else {
/* FOR THIS YOU HAVE TO CREATE A TABLE IN YOUR DATABASE WITH THIS FIELDS, THEN CONNECT YOUR DATABASE ON LINE 3 */
        $anoda = $new->prepare("INSERT INTO newsletter (email, date)VALUES(:email, NOW())");
		
        $anoda->bindParam(':email',$email);

          if (!$anoda->execute()) {

             $atry = $anoda->errorInfo();

             echo $atry[2];

         }else{

             echo "success";

         }
    }
}
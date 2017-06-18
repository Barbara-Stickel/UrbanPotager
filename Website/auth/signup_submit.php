<?php
  $link = mysqli_connect("localhost", "root", "root", 'dataPotager');

    $emailup = $_POST['emailup'];
    $passwordup = $_POST['passwordup'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $activation_key=md5(microtime(TRUE)*100000);

    $queryv = "SELECT * FROM user WHERE username='$username'";
    $res= $link->query($queryv);
    $data = mysqli_fetch_array($res);
    if($data['username']==''){

      $query="INSERT INTO user (f_name, l_name, username, email, password,activation_key) VALUES ('$first_name', '$last_name', '$username', '$emailup', '$passwordup','$activation_key')" ;
      $data = $link->query($query);



      //$activation=md5($email.time());
      //$base_url='http://www.localhost:8888/email_activation.php/';
      //require 'class.phpmailer.php';
      //$from       = "no-reply@bandoproject.com";
      //$mail       = new PHPMailer();
      //$mail->IsSMTP(true);            // use SMTP
      //$mail->IsHTML(true);
      //$mail->SMTPAuth   = true;                  // enable SMTP authentication
      //$mail->Host       = "smtp.gmail.com"; // SMTP host
      //$mail->Port       =  587;                    // set the SMTP port
      //$mail->Username   = "omar.benfeddoul7@gmail.com";  // SMTP  username
      //$mail->Password   = "S0ouwifii7!";  // SMTP password
      //$mail->SetFrom($from, 'From Name');
      //$mail->AddReplyTo($from,'From Name');
      //$mail->Subject    = $subject;
      //$mail->MsgHTML($body);
      //$address = $to;
      //$mail->AddAddress($address, $to);
      //$mail->Send();

    //  $to=$emailup;
    //  $subject="Email verification";
    //  $heading="From: inscription@bandoproject.com"
    //  $body='Welcome on B&O Project,

//To activate your account, please click on the link below or copy/paste it on your browser.

//http://localhot:8888/auth/activation.php?log='.urlencode($username).'&activation_key='.urlencode($activation_key).'


//---------------
//This is an automatic email please do not answear !';
//      mail($to, $subject, $body, $heading) ;

      echo "YOUR REGISTRATION IS COMPLETED...";
      sleep(3);
      echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="login.php"</SCRIPT>';

    }else{
      echo "This username already exists ... Please try again";
      sleep(3);
      echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="signup.php"</SCRIPT>';
    }


    /*** encrypt the password ***/
    /*** $phpro_password = sha1( $phpro_password ); ***/
?>

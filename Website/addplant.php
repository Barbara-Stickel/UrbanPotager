<?php
$link = mysqli_connect("localhost", "root", "root", 'dataPotager');

$email_setting = $_POST['email_setting'];
$password_setting = $_POST['password_setting'];
$new_plant = $_POST['new_plant'];
$light=$_POST['light'];
$description =$_POST['description'];
$urls = $_POST['url'];

$verif = "SELECT password FROM user WHERE email='$email_setting'";
$res_verif = $link->query($verif);
$data_verif = mysqli_fetch_array($res_verif);
$pass=$data_verif['password'];
if(strcmp($password_setting==$pass)==0){
//echo $pass;
//echo $password_setting;
  $modif = "INSERT INTO plantes (nom, description, eclairage, url) VALUES ('$new_plant', '$description', '$light', '$urls') ";
  $res_modif = $link->query($modif);
  echo 'Votre modifcation a bien été enregistrée !';
  sleep(3);
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="settings.php"</SCRIPT>';
}else{
  echo 'Combinaison email/password erronée , veuillez réessayer ! ';
  sleep(3);
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="settings.php"</SCRIPT>';
}
?>

<?php
session_start();
$id=$_SESSION['id'];
$link = mysqli_connect("localhost", "root", "root", 'dataPotager');

$email_setting = $_POST['email_setting'];
$password_setting = $_POST['password_setting'];
$plant = $_POST['plant'];
$new_plant = $_POST['n_plant'];

$recup_plante="SELECT id FROM plantes WHERE nom='".$plant."'";
$res_plante = $link->query($recup_plante);
$data_plante = mysqli_fetch_array($res_plante);
$id_plant=$data1['id'];

$recup_id="SELECT * FROM lien_plante, plantes WHERE lien_plante.id_plante=plantes.id AND lien_plante.id_plante='".$id_plante."' AND lien_plante.id_user='".$id."'" ;
$res_id=$link->query($recup_id);
$data_id=mysqli_fetch_array($res_id);
$id_modif=$data_id['id'];


$recup2="SELECT * FROM plantes WHERE nom='".$new_plant."'";
$res2=$link->query($recup2);
$data2=mysqli_fetch_array($res2);
$id_new=$data2['id'];


$verif = "SELECT password FROM user WHERE email='$email_setting'";
$res_verif = $link->query($verif);
$data_verif = mysqli_fetch_array($res_verif);
$pass=$data_verif['password'];
if(strcmp($password_setting==$pass)==0){
  $modif = "UPDATE lien_plante SET id_plante='$id_new' WHERE id='$id_modif'";
  $res_modif = $link->query($modif);
  echo 'Votre modifcation a bien été enregistrée !';
  sleep(3);
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="plantstest.php"</SCRIPT>';
}else{
  echo 'Combinaison email/password erronée , veuillez réessayer ! ';
  sleep(3);
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="settings.php"</SCRIPT>';
}
?>

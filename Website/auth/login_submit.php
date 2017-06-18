<?php
//require("login.php");
session_start();
$_SESSION['connect']=0;
// connexion bdd
$link = mysqli_connect("localhost", "root", "root", 'dataPotager');
// variables avec les identifiants entrés
$email=$_POST['emailin'];
$password=$_POST['passwordin'];
//verification
if(empty($email) || empty($password)){
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="login.php"
</SCRIPT>';
}else{
  $query="SELECT id, email, password, username FROM user WHERE email='".$email."'";
  $res= $link->query($query);
  $data = mysqli_fetch_array($res);
  $pass = $data['password'];
  $id = $data['id'];
  $user = $data['username'];
  if($pass==$password){
  $_SESSION['id']=$id;
  $_SESSION['connect']=1;
  $_SESSION['user']=$user;
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../home.php"
</SCRIPT>';
  }else{
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="login.php"
</SCRIPT>';
  }
}
 ?>

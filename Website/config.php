<?php
include_once("inc/facebook.php"); //include facebook SDK
######### Facebook API Configuration ##########
$appId = '527807730722609'; //Facebook App ID
$appSecret = 'd5ddf80af9003ec831cdb2e4e2ec4e38'; // Facebook App Secret
$homeurl = 'http://localhost:8888/plants.php';  //return to home
$fbPermissions = 'email';  //Required facebook permissions

//Call Facebook API
$facebook = new Facebook(array(
  'appId'  => $appId,
  'secret' => $appSecret

));
$fbuser = $facebook->getUser();
?>

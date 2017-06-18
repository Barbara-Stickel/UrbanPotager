
<?php

$link = mysqli_connect("localhost", "root", "root", 'dataPotager');
if(isset($_GET['id'])){
  $id = mysql_real_escape_string($_GET['id']);
  $query = "SELECT * FROM images WHERE id='".$id."'";
  $res = $link->query($query);
  while($row = mysql_fetch_assoc($res)){
  $imageData=$row['image'];
  }
  header('Content-type: image/JPG');
  echo $imageData;
}else{
  echo "Error!";
}

?>

<?php
$link = mysqli_connect("localhost", "root", "root", 'dataPotager');
$query = "SELECT oauth_uid FROM users";
$res= $link->query($query);
$data = mysqli_fetch_array($res);

session_start();
//Keep session data for 1 hour
//ini_set('session.gc_maxlifetime', 3600);
//Remember session id for 1 hour
//session_set_cookie_params(3600);
if (isset($_SESSION['connect']))//On vérifie que le variable existe.
{
  $connect=$_SESSION['connect'];//On récupère la valeur de la variable de session.
}else{
  $connect=0;//Si $_SESSION['connect'] n'existe pas, on donne la valeur "0".
}
if ($connect == "1") // Si le visiteur s'est identifié.
{
?>
<!DOCTYPE html>
<html>

  <head>
    <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">

    <link rel="stylesheet" href="docs/css/bootstrap.css">
    <link rel="stylesheet" href="css/plants.css">

  </head>

  <body>


    <div class="nav">
      <div class="container">
        <ul class="pull-left">
          <li><a href="home.php">Home</a></li>
          <li><a href="plants.php">Plants</a></li>
          <li><a href="settings.php">Settings</a></li>
          <li><a href="live.php">Live</a></li>
        </ul>
        <ul class="pull-right">
          <li>Welcome
            <?php
          echo $_SESSION['user'];
          ?></li>
          <li><a href="auth/logout.php">Log Out</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>

    <div class="jumbotron">
      <div class="container">
        <h1>Your Plants</h1>
        <p>"Every flower is a soul blossoming in nature." Gerard De Nerval </p>
      </div>
    </div>

    <div class="neighborhood-guides">
        <div class="container">
            <h2>Plants</h2>
            <p>Here are your four plants that are in your kitchen garden. You can see the description of each one.</p>
            <div class="row">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-lg-2">
                          <?php
                          $link = mysqli_connect("localhost", "root", "root", 'dataPotager');
                          $query111 = "SELECT url FROM plantes WHERE id=1";
                          $res= $link->query($query111);
                          $data = mysqli_fetch_array($res);
                          $url1=$data['url'];
                          $query222 = "SELECT url FROM plantes WHERE id=2";
                          $res= $link->query($query222);
                          $data = mysqli_fetch_array($res);
                          $url2=$data['url'];
                          $query333 = "SELECT url FROM plantes WHERE id=3";
                          $res= $link->query($query333);
                          $data = mysqli_fetch_array($res);
                          $url3=$data['url'];
                          $query444 = "SELECT url FROM plantes WHERE id=4";
                          $res= $link->query($query444);
                          $data = mysqli_fetch_array($res);
                          $url4=$data['url'];
                          ?>
                        <img src="<?php echo $url1; ?>" width=190>
                        <p style="color:#FF0040; text-decoration: underline">
                          <?php
                          $query1 = "SELECT nom FROM plantes WHERE id=1";
                          $res= $link->query($query1);
                          $data = mysqli_fetch_array($res);
                            echo $data['nom'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-4">
                        <p>
                          <?php
                          $query11 = "SELECT description FROM plantes WHERE id=1";
                          $res= $link->query($query11);
                          $data = mysqli_fetch_array($res);
                            echo $data['description'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-offset-2"></div>
                        <div class="col-lg-2">

                        <img src="<?php echo $url2; ?>" width=190 >
                        <p style="color:#FF0040; text-decoration: underline">
                          <?php
                          $query2 = "SELECT nom FROM plantes WHERE id=2";
                          $res= $link->query($query2);
                          $data = mysqli_fetch_array($res);
                            echo $data['nom'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-4">
                        <p>
                          <?php
                          $query22 = "SELECT description FROM plantes WHERE id=2";
                          $res= $link->query($query22);
                          $data = mysqli_fetch_array($res);
                            echo $data['description'];
                          ?>
                        </p>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-2">
                        <img src="<?php echo $url3; ?>" width=190 >
                        <p style="color:#FF0040; text-decoration: underline">
                          <?php
                          $query3 = "SELECT nom FROM plantes WHERE id=3";
                          $res= $link->query($query3);
                          $data = mysqli_fetch_array($res);
                            echo $data['nom'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-4">
                        <p>
                          <?php
                          $query33 = "SELECT description FROM plantes WHERE id=3";
                          $res= $link->query($query33);
                          $data = mysqli_fetch_array($res);
                            echo $data['description'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-offset-2">
                        </div>
                        <div class="col-lg-2">
                        <img src="<?php echo $url4; ?>" width=190 >
                        <p style="color:#FF0040; text-decoration: underline">
                          <?php
                          $query4 = "SELECT nom FROM plantes WHERE id=4";
                          $res= $link->query($query4);
                          $data = mysqli_fetch_array($res);
                            echo $data['nom'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-4">
                        <p>
                          <?php
                          $query44 = "SELECT description FROM plantes WHERE id=4";
                          $res= $link->query($query44);
                          $data = mysqli_fetch_array($res);
                            echo $data['description'];
                          ?>
                        </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="learn-more" >
	  <div class="container">
		<div class="row">
	      <div class="col-md-4">
			<h3>University</h3>
			<img src="images/cs.png">
			<p><a href="http://www.centralesupelec.fr/wordpress/">CentraleSupelec</a></p>
	      </div>
		  <div class="col-md-4">
			<h3>Project 2K15</h3>
			<p>This web app is a part of a long project wich goal is to allow people have a connected kitchen garden in their house </p>

		  </div>
		  <div class="col-md-offset-2 col-md-2">
		    <h3>Designed by :</h3>
			<p>Barbara Stickel</p>
			<p>Clément Cabot</p>
			<p>Omar Benfeddoul</p>

		  </div>
	    </div>
	  </div>
	</div>
  </body>
</html>
<?php
}else{
  echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="auth/login.php"
  </SCRIPT>';
}
?>

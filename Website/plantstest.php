<?php
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
          <li><a href="plantstest.php">Plants</a></li>
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
                      <?php
                      $id=$_SESSION['id'];
                      $link = mysqli_connect("localhost", "root", "root", 'dataPotager');
                      $query = "SELECT * FROM lien_plante, plantes WHERE lien_plante.id_plante=plantes.id AND lien_plante.id_user='".$id."'";
                      $res=$link->query($query);
                      while($data=mysqli_fetch_array($res)){

                      ?>
                      <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-4">
                        <img src="<?php echo $data['url']; ?>" width=350>
                        <p style="color:#FF0040; text-decoration: underline">
                          <?php
                           echo $data['nom'];
                          ?>
                        </p>
                        </div>
                        <div class="col-lg-4">
                        <p>
                          <?php
                            echo $data['description'];

                          ?>
                        </p>
                        </div>

                    </div>
                    <?php } ?>
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

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
    <link rel="stylesheet" href="css/contact.css">

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
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>

    <div class="jumbotron">
      <div class="container">
        <h1>Contact</h1>
        <p>Have a question ?</p>
      </div>
    </div>

    <div class="neighborhood-guides">
        <div class="container">
            <div class="row">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                        <form class="form-horizontal">
    <fieldset>
      <div class="form-group">
        <label for="inputName" class="col-lg-2 control-label">Name</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="inputName" placeholder="Name">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail" class="col-lg-2 control-label">Email</label>
        <div class="col-lg-10">
          <input type="text" class="form-control" id="inputEmail" placeholder="Email">
        </div>
      </div>

      <div class="form-group">
        <label for="message" class="col-lg-2 control-label">Message</label>
        <div class="col-lg-10">
          <textarea class="form-control" rows="3" id="message"></textarea>
        </div>
      </div>

      <div class="form-group">
        <div class="col-lg-10 col-lg-offset-2">
          <button type="reset" class="btn btn-default">Cancel</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </fieldset>
  </form>
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

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
<html xmlns:fb="http://www.facebook.com/2008/fbml">

  <head>
    <link href="http://s3.amazonaws.com/codecademy-content/courses/ltp/css/shift.css" rel="stylesheet">

    <link rel="stylesheet" href="docs/css/bootstrap.css">
    <link rel="stylesheet" href="css/settings.css">

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
          <li>Welcome <?php
          echo $_SESSION['user'];
          ?></li>
          <li><a href="auth/logout.php">Log Out</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
    </div>

    <div class="jumbotron">
      <div class="container">
        <h1>Settings</h1>
        <p>Want to change ? </p>
      </div>
    </div>

    <div class="neighborhood-guides">
        <div class="container">
            <h2>Kitchen garden customization</h2>
            <p>To change one of you plants, please fiel this setting form.</p>
            <div class="row">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                        <form action="setting_submit.php" method="post">
                          <fieldset class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email_setting" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            <small class="text-muted">We'll never share your email with anyone else.</small>
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password_setting" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleSelect1">Plant to modify</label>
                            <select name="plant" class="form-control" id="exampleSelect1">
                              <?php
                              $id=$_SESSION['id'];
                              $link = mysqli_connect("localhost", "root", "root", 'dataPotager');
                              $query = "SELECT * FROM lien_plante, plantes WHERE lien_plante.id_plante=plantes.id AND lien_plante.id_user='".$id."'";
                              $res= $link->query($query);
                              while($data=mysqli_fetch_array($res)){
                              ?>
                              <option><?php echo $data['nom']; ?></option>
                              <?php } ?>
                            </select>
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleSelect1">Your new plant</label>
                            <select name="n_plant" class="form-control" id="exampleSelect1">
                              <?php
                              $query2 = "SELECT * FROM plantes ";
                              $res2= $link->query($query2);
                              while($data2=mysqli_fetch_array($res2)){
                              ?>
                              <option><?php echo $data2['nom']; ?></option>
                              <?php } ?>
                            </select>
                          </fieldset>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Confirm my require
                            </label>
                          </div>
                          <div class="form-group"></div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                    </div>

                </div>
            </div>


            <p>To add a new plant on the data base, please fiel this setting form.</p>
            <div class="row">
                <div class="form-horizontal">
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-6">
                        <form action="addplant.php" method="post">
                          <fieldset class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input name="email_setting" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            <small class="text-muted">We'll never share your email with anyone else.</small>
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input name="password_setting" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleInputPassword1">New Plant</label>
                            <input name="new_plant" type="text" class="form-control" id="exampleInputPassword1" placeholder="New Plant">
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleSelect2">Lighting</label>
                            <select name="light" multiple class="form-control" id="exampleSelect2">
                              <option>1</option>
                              <option>2</option>
                              <option>3</option>
                              <option>4</option>
                              <option>5</option>
                              <option>6</option>
                              <option>7</option>
                              <option>8</option>
                              <option>9</option>
                              <option>10</option>
                              <option>11</option>
                              <option>12</option>
                              <option>13</option>
                              <option>14</option>
                              <option>15</option>
                              <option>16</option>
                              <option>17</option>
                              <option>18</option>
                              <option>19</option>
                              <option>20</option>
                              <option>21</option>
                              <option>22</option>
                              <option>23</option>
                              <option>24</option>
                            </select>
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleTextarea">Description of the new plant</label>
                            <textarea name="description" class="form-control" id="exampleTextarea" rows="3"></textarea>
                          </fieldset>
                          <fieldset class="form-group">
                            <label for="exampleTextarea">Picture ( URL )</label>
                            <textarea name="url" class="form-control" id="exampleTextarea" rows="1"></textarea>
                          </fieldset>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox"> Confirm my require
                            </label>
                          </div>
                          <div class="form-group"></div>
                          <button type="submit" class="btn btn-primary">Submit</button>
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

<?php

function upload(){
/*** check if a file was uploaded ***/

    /***  get the image info. ***/
    $size = getimagesize($_FILES['userfile']['tmp_name']);
    /*** assign our variables ***/

    $imgfp = fopen($_FILES['userfile']['tmp_name'], 'rb');

    $name = $_FILES['userfile']['name'];
    /***  check the file is less than the maximum file size ***/

        /*** connect to db ***/
        $dbh = new PDO("mysql:host=localhost;dbname=dataPotager", 'root', 'root');

                /*** set the error mode ***/
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            /*** our sql query ***/
        $stmt = $dbh->prepare("INSERT INTO images (image, name) VALUES ( ?, ?)");

        /*** bind the params ***/

        $stmt->bindParam(1, $imgfp, PDO::PARAM_LOB);

        $stmt->bindParam(2, $name);

        /*** execute the query ***/
        $stmt->execute();
}
?>


<!DOCTYPE html >

  <html>
  <head><title>File Upload To Database</title></head>
  <body>
  <h2>Please Choose a File and click Submit</h2>
  <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
  <div><input name="userfile" type="file" /></div>
  <div><input type="submit" value="Submit" /></div>
  </form>

</body></html>
<?php
/*** check if a file was submitted ***/
if(!isset($_FILES['userfile']))
    {
    echo '<p>Please select a file</p>';
    }
else
    {
    try    {
        upload();
        /*** give praise and thanks to the php gods ***/
        echo '<p>Thank you for submitting</p>';
        }
    catch(Exception $e)
        {
        echo 'erreur';
        }
    }
?>

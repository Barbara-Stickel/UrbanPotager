<?php
// Begin the session
session_start();

// Unset all of the session variables.
$_SESSION = array();

// Destroy the session.
session_destroy();

echo '<SCRIPT LANGUAGE="JavaScript">document.location.href="../index.php"
</SCRIPT>';
?>

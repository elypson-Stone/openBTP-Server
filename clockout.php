


<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php


include ('./incs/db_credentials.inc.php');
$con = new mysqli($db_host, $db_user, $db_password, $db_name); 

$ID = $_GET["selectedID"];


$sql = "UPDATE patienten SET ausgang = now() WHERE id = ?";
$statement = $con->prepare($sql);
$statement->bind_param('s', $ID );
 
$statement->execute();

mysqli_close($con);

echo '<script type="text/javascript">',
     'window.history.back();',
     '</script>'


?>


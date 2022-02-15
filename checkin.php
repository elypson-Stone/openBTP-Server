<?php

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<?php

require("./incs/rights.php");
if ($usrpower >=3 ) {
include ('./incs/db_credentials.inc.php');
$con = new mysqli($db_host, $db_user, $db_password, $db_name); 

$ID = $_GET["selectedID"];


$sql = "INSERT INTO patlog (Event,PatID) values ('Patient eingestempelt','$ID')";

$con->query($sql);

$sql = "UPDATE patienten SET anwesend = TRUE WHERE ID = ? ";
$statement = $con->prepare($sql);
$statement->bind_param('i',$ID);
$statement->execute();

mysqli_close($con);

echo '<script type="text/javascript">',
     'window.history.back();',
     '</script>';

    } else {
        echo "<script>alert('Du hast nicht genügend Rechte!');</script>";

        
    }
    
?>
<html><script>window.history.back();</script></html>

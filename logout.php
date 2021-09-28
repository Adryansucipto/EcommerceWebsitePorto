<?php 

session_start();
$_SESSION=[];
session_unset();
session_destroy();

setcookie('id','',time()-31536000);
setcookie('key','',time()-31536000);

header("Location: login.php");
exit();
?>
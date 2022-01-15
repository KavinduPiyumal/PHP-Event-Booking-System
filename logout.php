<?php 
//All sessions set destroy.
session_start();
session_destroy();
//PHP redirect to index.php page
header("location: index.php"); 
?>
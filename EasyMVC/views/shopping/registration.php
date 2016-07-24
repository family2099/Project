<?php

session_start();



if(!isset($_SESSION['userName'])){
    
    $_SESSION['PrevPage'] = 'registration.php';
    
  	header("Location: index.php");
  	exit();
    
    
    
}
?>
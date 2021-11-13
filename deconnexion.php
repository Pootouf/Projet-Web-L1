<?php 
  session_start(); 
  $_SESSION['admin'] = NULL;
  $_SESSION['nom'] = NULL;
  header('Location: accueil.php');
  exit;
?>

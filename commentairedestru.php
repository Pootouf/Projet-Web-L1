<?php 
  session_start();
  $id = $_POST['id'];
  
  $connexion = mysqli_connect("","Bingieti","27112002","blog");
  $requete = "DELETE from commentaire WHERE idcm = '$id'";
  mysqli_query($connexion,$requete);
  
  header('Location: article.php');
  exit;
?>

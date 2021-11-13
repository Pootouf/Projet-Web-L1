<?php 
  session_start();
  $nom = $_SESSION['nom'];
  $contenu = $_POST['contenu'];
  $date = date('y-m-d');
  $id = $_POST['id'];
  $idcm = rand(0, 1000000);
  
  $connexion = mysqli_connect("","Bingieti","27112002","blog");
  $requete = "INSERT INTO commentaire VALUES('$contenu','$nom', '$date', '$id', '$idcm')";
  mysqli_query($connexion,$requete);
  
  header('Location: article.php');
  exit;
?>

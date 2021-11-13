<?php session_start(); ?>

<!DOCTYPE html>

<html lang="fr">
	
	<head>
		<meta charset="utf-8" />
		<title>Blog</title>
    <link rel="stylesheet" href="blog.css"/>
	</head>
	
	<body>
    
    <div id="haut">
      <h1>Blog</h1>
      <p class="bouton">
        <button onClick="window.location.href = 'accueil.php';"/>Accueil</button>
        <button onClick="window.location.href = 'article.php';"/>Article</button>
        <?php 
          if($_SESSION['admin'] == 2){
            echo "<button onClick=\"window.location.href = 'blog.php';\"/>Editeur</button> ";
          }
          if($_SESSION['admin'] != 0){
            echo "<button onClick=\"window.location.href = 'deconnexion.php';\"/>Deconnexion</button>";
          }else{
            echo "<button onClick=\"window.location.href = 'connexion.php';\"/>Inscription/Connection</button>";
          }
        ?>
      </p>
      <hr/>
    </div>
    
    <div id="vide"></div>
      
    <?php 
      
      $titre = $_POST['titre'];
      $contenu = $_POST['contenu'];
      $date = $_POST['date'];
      $id = $_POST['id'];
      
      echo " <div id = 'articleListe'>";
      
      echo "<h2>";
      echo $titre;
      echo "</h2>";
      echo "<p>";
      echo $contenu;
      echo "</p>";
      echo "<h3>";
      echo $date;
      echo "</h3>";
      echo "</div>";
      
      $nom = $_SESSION['nom'];
      
      echo "<div id = 'articleListe'>";
      echo "<h2>Commentaire</h2>";
      if($nom != NULL){
        echo "<form action='commentaire.php' method='post'>";
        echo "<textarea name='contenu' cols='100' rows='10' maxlength='1000' required placeholder='Ecrivez votre commentaire ici'></textarea>";
        echo "<input type='submit' value='Envoyer'/>";
        echo "<input name=\"id\" type=\"hidden\" value= \"$id\"/>";
        echo "</form>";
      }else{
        echo "Veuillez vous connecter pour laisser un commentaire";
      }
      
      echo "<br /><br /><br /><br />";
      echo "<h2>Liste des Commentaires</h2>";
      
      $connexion = mysqli_connect("","Bingieti","27112002","blog");
      $requete = "SELECT contenu FROM commentaire WHERE id='$id'";
      $res = mysqli_query($connexion,$requete);
      $requete2 = "SELECT auteur FROM commentaire WHERE id='$id'";
      $res2 = mysqli_query($connexion,$requete2);
      $requete3 = "SELECT date FROM commentaire WHERE id='$id'";
      $res3 = mysqli_query($connexion,$requete3);
      $requete4 = "SELECT idcm FROM commentaire WHERE id='$id'";
      $res4 = mysqli_query($connexion,$requete4);
      
      for($i = 0; $i < mysqli_num_rows($res); $i++){
        
        $contenu = mysqli_fetch_array($res, MYSQLI_NUM)[0];
        $auteur = mysqli_fetch_array($res2, MYSQLI_NUM)[0];
        $date = mysqli_fetch_array($res3, MYSQLI_NUM)[0];
        $idcm = mysqli_fetch_array($res4, MYSQLI_NUM)[0];
      
        echo "<br />";
        echo "<h3>";
        echo $auteur;
        echo " le ";
        echo $date;
        echo "</h3>";
        echo $contenu;
        
        echo "<br />";
        
        if($_SESSION['admin'] == 2){
          echo "<form action='commentairedestru.php' method='post'>";
          echo "<input type='submit' value='Supprimer Commentaire'/>";
          echo "<input name=\"id\" type=\"hidden\" value= \"$idcm\"/>";;
          echo "</form>";
        }
        
      }
      
      echo "</div>";

      
    ?>
    
      
  
  </body>
	
</html>


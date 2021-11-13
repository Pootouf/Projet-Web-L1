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
    
    <div id="articleListe">
      
      <h2>Article Récent</h2>
    
    <?php 
    
    $connexion = mysqli_connect("","Bingieti","27112002","blog");
    $requete = "SELECT titre FROM article ORDER BY date DESC LIMIT 3";
    $res = mysqli_query($connexion,$requete);
    $requete2 = "SELECT date FROM article ORDER BY date DESC LIMIT 3";
    $res2 = mysqli_query($connexion,$requete2);
    $requete3 = "SELECT contenu FROM article ORDER BY date DESC LIMIT 3";
    $res3 = mysqli_query($connexion,$requete3);
    $requete4 = "SELECT id FROM article ORDER BY date DESC LIMIT 3";
    $res4 = mysqli_query($connexion,$requete4);
    
    for($i = 0; $i < mysqli_num_rows($res); $i++){
      
      echo "<div class='articleListe2'>";
        
      $titre = mysqli_fetch_array($res, MYSQLI_NUM)[0];
      $date = mysqli_fetch_array($res2, MYSQLI_NUM)[0];
      $contenu = mysqli_fetch_array($res3, MYSQLI_NUM)[0];
      $id = mysqli_fetch_array($res4, MYSQLI_NUM)[0];
    
      printf("%s", $titre);
      echo "<br />";
      echo "<form action = 'afficheArticle.php' method='post'>";
      echo '<input class = "boutonArticle" type="submit" value="Lire l\'article"/>';
      echo "<input name=\"titre\" type=\"hidden\" value= \"$titre\"/>";
      echo "<input name=\"contenu\" type=\"hidden\" value= \"$contenu\"/>";
      echo "<input name=\"date\" type=\"hidden\" value= \"$date\"/>";
      echo "<input name=\"id\" type=\"hidden\" value= \"$id\"/>";
      echo "</form>";
      printf("%s", $date);
      
        
        
      echo "<br />";
        
      echo "</div>";
        
      echo "<br />";
      echo "<br />";
        
    }
    ?>
    </div>
  
  </body>
	
</html>

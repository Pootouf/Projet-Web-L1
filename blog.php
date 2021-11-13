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
    
    
    <fieldset id="article">
      <legend>Nouvel Article</legend>
      <form action = "blog.php" method="post">
        <p>
          Titre:<input type="text" name="titre" required/>
          Catégorie:<select name="categorie">
            <option value="test1">test1</option>
            <option value="test2">test2</option>
            <option value="test3">test3</option>
          </select>
          <br/>
        
          <textarea name="contenu"cols="200"rows="20" required placeholder="Ecrivez votre article ici"></textarea>
        
          <br/>
          <input type="submit" value="Valider"/>
          <input type="reset" value="Effacer"/>
        </p>
        
    
      </form>
    </fieldset>
    
    
    <?php 
    
      $connexion = mysqli_connect("","Bingieti","27112002","blog");
      
      $titre = $_POST['titre'];
      $contenu = $_POST['contenu'];
      $date = date('y-m-d');
      $categorie = $_POST['categorie'];
      $rand = rand(0, 100000);
      
      $requete = "SELECT id FROM article WHERE id = '$rand'";
      $res = mysqli_query($connexion,$requete);
      $testid =mysqli_num_rows($res);
      
      if($titre != "" && $contenu != "" && $testid == 0){
      
        $requete="INSERT INTO article VALUES('$titre','$contenu', '$date', '$categorie', '$rand')";
        mysqli_query($connexion,$requete);
      
        header('Location: accueil.php');
        exit;
      }
    
    ?>
  
  </body>
	
</html>

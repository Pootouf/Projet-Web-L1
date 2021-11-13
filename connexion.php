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
    
    <div id="connexion">
      <form action = "connexion.php" method="post">
        <p>
          Inscription:
          <br/>
          Identifiant:<input type="text" name="id" required/>
          Mot de passe:<input type="password" name="mdp" required/>
          <input type="hidden" name="ins" value = 0 />
          <br/>
          <input type="submit" value="Valider"/>
          <input type="reset" value="Effacer"/>
        </p>
    
      </form>
    
    
      <?php
        
        if($_POST['id'] != NULL && $_POST['mdp'] != NULL){
          
          $_SESSION['admin'] = 0;
          $_SESSION['nom'] = "";
          
          $id = $_POST['id'];
          $mdp = $_POST['mdp'];
          $ins = $_POST['ins'];
          
          $connexion = mysqli_connect("","Bingieti","27112002","blog");
          
          if($ins == 0){
            
            $requete = "SELECT id FROM membre WHERE id = '$id'";
  
            $res = mysqli_query($connexion,$requete);
            $testid =mysqli_num_rows($res);
    
            if( $testid == 0){
              $requete="INSERT INTO membre VALUES('$id','$mdp', 1)";
              mysqli_query($connexion,$requete);
          
              $_SESSION["admin"] = 1;
              $_SESSION['nom'] = $id;
          
              header('Location: accueil.php');
              exit;
            }else{
              echo "<p>Erreur, identifiant deja utilisé.</p>";
            }

          }else{
              
            $requete = "SELECT mdp FROM membre WHERE id = '$id'";

            $res = mysqli_query($connexion,$requete);
            $row = mysqli_fetch_array($res);
    
            if( $row != NULL && $row[0] == $mdp ){
              $requete="SELECT admin FROM membre WHERE id = '$id'";
              $res = mysqli_query($connexion,$requete);
              $row = mysqli_fetch_array($res);
          
              $_SESSION["admin"] = $row[0];
              $_SESSION['nom'] = $id;
          
              header('Location: article.php');
              exit;
            }else{
              echo "<p>Erreur, mauvais identifiant ou mauvais mot de passe</p>";
            }
          }
          
          // Fermeture de la connexion
          mysqli_close($connexion);
        }
      ?>
    
    </div>
    
    <div id="vide"></div>
    
    <div id="connexion">
      <form action = "connexion.php" method="post">
        <p>
          Connexion:
          <br/>
          Identifiant:<input type="text" name="id" required/>
          Mot de passe:<input type="password" name="mdp" required />
          <input type="hidden" name="ins" value = 1 />
          <br/>
          <input type="submit" value="Valider"/>
          <input type="reset" value="Effacer"/>
        </p>
    
      </form>
    
    </div>
  
  </body>
	
</html>




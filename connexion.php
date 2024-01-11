<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('include/connexion_bdd.php');




if (!empty($_POST['email']) && !empty($_POST['pswd'])) {
    $sql = "SELECT * FROM `user` WHERE `email` = :email";
    $query = $db->prepare($sql);
    $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);
    $query->execute();
    $requete = $query->fetch();
    // var_dump($requete);
    $verify=password_verify($_POST["pswd"], $requete["mdp"]);

    if($requete['email'] === $_POST['email'] && $verify === true && $requete['derogation'] === 1) {

        echo("Connexion réussie");
        header('Location: index.php');
        echo $requete["id"];
          session_start();
          $_SESSION["id"] = $requete["id"];
          $_SESSION["nom"] = $requete["nom"];
          $_SESSION['prenom'] = $requete['prenom'];
          $_SESSION['age'] = $requete['age'];
          $_SESSION['email'] = $requete['email'];
          $_SESSION['role'] = $requete['role'];
          $_SESSION['derogation'] = $requete['derogation'];


    } else if ($requete['email'] === $_POST['email'] && $verify === true && $requete['derogation'] === 0){

      header('Location: derogation.php');
      echo $requete["id"];
        session_start();
        $_SESSION["id"] = $requete["id"];
        $_SESSION["nom"] = $requete["nom"];
        $_SESSION['prenom'] = $requete['prenom'];
        $_SESSION['age'] = $requete['age'];
        $_SESSION['email'] = $requete['email'];
        $_SESSION['role'] = $requete['role'];
        $_SESSION['derogation'] = $requete['derogation'];

    } else {

        echo("Connexion échouée");

    }
   } 
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <title>Connexion</title>
</head>
<body>
<nav>
  <?php 
  include("include/navbar.php");
  ?>
</nav>
<main> 
  <div class="container" id="cardconec">
    <div class="row d-flex align-items-center h-75 " >

        <div class="text-white" >
          <div  class=" rounded-5 card-body align-items-center p-5 text-center" style="background: linear-gradient(0deg, rgba(255,254,254,1) 36%, rgba(255,0,0,1) 100%)">
            <form action="" method="post">
              <h2 class="">Entrez vos identifiants</h2><br>
                <div>
                  <label for="email">
                  <input type="text" id="typeEmailX" class=" form-control form-control-lg" name="email" placeholder="Email"/>
                  </label>    
                </div>
                <div>
                  <label for="pswd">
                  <input type="text" id="typePasswordX" class=" form-control form-control-lg" name="pswd" placeholder="Mot de passe"/>
                  </label>  
                </div>
                <br>
                <div>
                  <button type="submit" class="btn btn-outline-dark btn-lg px-5">Se connecter</button>
                </div>
                <br>             
                <div>
                  <p class="text-black">Pas encore de compte?<br><a href="inscription.php" class="text-black bold">S'inscrire</a></p>
                </div>
            </form>           
          </div>
        </div>                    
      </div>      
    </div>         
</main>
<footer>
<?php include('include/footer.php');?>
</footer>
</body>
</html>
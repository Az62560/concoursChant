<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('include/connexion_bdd.php');

class User{
    //propriétés
    public $name;
    public $surname;
    public $age;
    public $email;
    public $password;
    public $password2;
    }

    $emailFalse = "<script>alert(\"L'adresse mail est déjà utilisée chez nous.\")</script>";
    $pswdFalse = "<script>alert(\"Les mots de passe sont différents.\")</script>";

if(!empty($_POST['name']) && !empty ($_POST['surname']) && !empty($_POST['age']) && !empty($_POST['email']) && !empty($_POST['pswd']) && !empty($_POST['pswd2'])) {
        $user = new User();
        $user->name = $_POST['name'];
        $user->surname = $_POST['surname'];
        $user->age = $_POST['age'];
        $user->email = $_POST['email'];
        $user->password = $_POST['pswd'];
        $user->password2 = $_POST['pswd2'];
        // var_dump($user);
        // var_dump affiche les valeurs de $user
        
        $sql = "SELECT * FROM `user` WHERE `email` = :email";
            $query = $db->prepare($sql);
            $query->bindValue(":email", $user->email, PDO::PARAM_STR);
            $query->execute();
            $verifEmail = $query->fetch();
            
            // verification pour savoir si l'adresse mail est déjà utilisée
            // var_dump($verifEmail);
        if ($_POST['pswd'] !== $_POST['pswd2']) {

            echo $pswdFalse;

        } else if ($verifEmail === true) {

            echo $emailFalse;
            
            } else if ($_POST['age'] >=16 && ($_POST['age'] < 18)) {
                
                $sql = 'INSERT INTO `user` (`nom`, `prenom`, `age`, `email`, `mdp`, `role`, `derogation`)
            VALUES (:nom, :prenom, :age, :email, :mdp, :role, :derogation)';
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $user->name, PDO::PARAM_STR);
            $query->bindValue(":prenom", $user->surname, PDO::PARAM_STR);
            $query->bindValue(":age", $user->age, PDO::PARAM_STR);
            $query->bindValue(":email", $user->email, PDO::PARAM_STR);
            $query->bindValue(':role', '["ROLE_USER"]', PDO::PARAM_STR);
            $hash = password_hash($user->password, PASSWORD_DEFAULT);
            $query->bindValue(":mdp", $hash, PDO::PARAM_STR);
            $query->bindValue(":derogation", 0, PDO::PARAM_STR);
          
            $query->execute();

            header('Location: connexion.php');

            } else if ($_POST['age'] >= 18) {

              $sql = 'INSERT INTO `user` (`nom`, `prenom`, `age`, `email`, `mdp`, `role`, `derogation`)
            VALUES (:nom, :prenom, :age, :email, :mdp, :role, :derogation)';
            $query = $db->prepare($sql);
            $query->bindValue(":nom", $user->name, PDO::PARAM_STR);
            $query->bindValue(":prenom", $user->surname, PDO::PARAM_STR);
            $query->bindValue(":age", $user->age, PDO::PARAM_STR);
            $query->bindValue(":email", $user->email, PDO::PARAM_STR);
            $query->bindValue(':role', '["ROLE_USER"]', PDO::PARAM_STR);
            $hash = password_hash($user->password, PASSWORD_DEFAULT);
            $query->bindValue(":mdp", $hash, PDO::PARAM_STR);
            $query->bindValue(":derogation", 1, PDO::PARAM_STR);
          
            $query->execute();

            header('Location: connexion.php');
            } else {

              echo "<script>alert(\"Vous êtes trop jeune pour vous inscrire.\")</script>";

            }
        
    };

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
    <title>Enregistrement</title>
</head>
<body>
<nav>
  <?php 
  include("include/navbar.php");
  ?>
</nav>
<main>
<div class="container"> 
      <div class="text-white">
        <div id="cardconec" class="rounded-5 card-body p-1 text-center" style="background: linear-gradient(0deg, rgba(255,254,254,1) 36%, rgba(255,0,0,1) 100%)">
          <form action="" method="post">
            <br><h2 class="fw-bold">Inscrivez vous pour participer</h2>             
              <label for="name">
              <input type="text" id="typeTextX" class=" form-control form-control-lg" name="name" placeholder="Nom"/>
              </label>    
                            
              <label for="surname">
              <input type="text" id="typeTextX" class=" form-control form-control-lg" name="surname" placeholder="Prénom"/>
              </label>  
                                           
              <label for="age">
              <input class="form-control form-control-lg" type="text" name="age" placeholder="Entrez votre age"/>
              </label>
                           
              <label for="email">
              <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email" placeholder="Email"/>
              </label>                
              
              <label for="pswd">
              <input type="password" id="TypePasswordX" class="form-control form-control-lg" name="pswd" placeholder="Mot de passe"/>
              </label>    
              
              <label for="pswd2">
              <input type="password" id="TypePasswordX" class="form-control form-control-lg" name="pswd2" placeholder="Confirmer mot de passe"/>
              </label><br>
              <div class="form-check-input-border-black justify-content-center">
                <div class="text-primary justify-content-center" id="charte">
                  <br><label class="form-check-label" for="flexCheckDefault">
                  <input class="form-check-input " type="checkbox" id="flexCheckDefault" required></label>
                  <a href="charte.php" class="text-primary"> Charte d'utilisation de LonguenesSound</a>
                </div>
              </div>
              <div>
                <br><button type="submit" class="btn btn-outline-dark btn-lg px-5">Envoyer</button>
              </div>
              
                
                        
                <div>
                  <br><p class="text-black">Vous avez déjà un compte?<br><a href="connexion.php" class="text-black bold">Se connecter</a></p>
                <?php
                $pswdFalse;
                $userFalse;
              ?></form>           
            </div>
          </div>
        </div>              
      </div>
    </div>
  </div>
</div>  
</main>
<footer><?php
  include('include/footer.php');
?></footer>
</body>
</html>
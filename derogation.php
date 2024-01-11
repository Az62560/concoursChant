<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('include/connexion_bdd.php');

if($_SESSION['derogation'] === 1) {

  header('location: candidature.php');
  
}

if(!empty($_POST['name']) && !empty ($_POST['surname']) && !empty($_POST['age']) && !empty($_POST['email']) && ($_POST['age']) >= 18) {
    $sql = 'INSERT INTO `derogation` (`id_user`, `nom`, `prenom`, `age`, `email`)
            VALUES (:id_user, :nom, :prenom, :age, :email)';
    $query = $db->prepare($sql);
    $query->bindValue(":id_user", $_SESSION['id'], PDO::PARAM_STR);
    $query->bindValue(":nom" , $_POST['name'], PDO::PARAM_STR);
    $query->bindValue(":prenom", $_POST['surname'], PDO::PARAM_STR);
    $query->bindValue(":age", $_POST['age'], PDO::PARAM_STR);
    $query->bindValue(":email", $_POST['email'], PDO::PARAM_STR);  
    $query->execute();

    $sql1 = "UPDATE `user` SET `derogation` = '1' WHERE id = :id_user" ;
    $query1 = $db->prepare($sql1);
    $query1->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_STR);
    $query1->execute();

    header('Location: candidature.php');

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <title>Dérogation</title>
</head>
<body>
<nav>
<?php 
    include("include/navbar.php");
    ?> 
</nav>
<main>
  
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center h-75" >
        <div class="col-12 col-md-8 col-lg-6 col-l-5">
          <div class="text-white">
            <div id="card" class="card-body p-5 text-center" style="background: linear-gradient(0deg, rgba(255,254,254,1) 36%, rgba(255,0,0,1) 100%)">
              <form action="" method="post">
                <h2 class="fw-bold">Dérogation à faire remplir par le responsable légal</h2><br>             
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

              <div class="text-primary justify-content-center" id="charte">
  <div class="form-check-input-border-black justify-content-center">
        <label class="form-check-label" for="flexCheckDefault">
          <input class="form-check-input " type="checkbox" id="flexCheckDefault" required> Je certifie l'exactitude des informations données et m'engage à être présent(e) le jour du concours.</label>

              <div>
                <button type="submit" class="btn btn-outline-dark btn-lg px-5">Envoyer</button>
              </div>
</main>
<footer>
<?php include('include/footer.php');?>
</footer>   
</body>
</html>
<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('include/connexion_bdd.php');

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
    <title>Accueil</title>
</head>
<body>
  <nav>
    <?php 
    include("include/navbar.php");
    ?>
</nav>
<main>
  <div class="container" id="okokok">
    <div class="carousel_text ">
      <div class="container-lg bg-primary-subtle rounded p-3" id="ui">
        <p id="ok" >Bienvenue sur LonguenesSound<br><br> Là où la voix s'élève!<br> Découvrez et partagez votre talent vocal exceptionnel. Prêt à faire résonner votre mélodie unique? Rejoignez-nous et célébrez la magie de la musique! 🎤🎶</p>
      </div>    
      <div class="container" id="carousel">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <figure>
                <img src="Images/img-concert.jpg" class="d-block" alt="...">
                <figcaption> 
                Bienvenue au LonguenesSound! Êtes-vous prêt(e)s à faire résonner vos voix et à captiver les cœurs ?
                </figcaption>
              </figure>
            </div>

            <div class="carousel-item">
              <figure>
                <img src="Images/image.jpg" class="d-block" >  
                <figcaption> 
                Nous sommes ravis d'annoncer le LonguenesSound, une plateforme dédiée aux talents vocaux extraordinaires. Que vous soyez un chanteur chevronné ou que vous rêviez simplement de partager votre passion pour la musique, ce concours est votre chance de briller sur scène et d'inspirer des émotions à travers votre voix.
                </figcaption>
              </figure>
            </div>

            <div class="carousel-item">
              <figure>
                <img src="Images/66568.jpg" class="d-block" alt="...">
                <figcaption> 
                <a href="https://ville-longuenesse.fr/fr/nw/598795/actualites-478"> Cliquez ici pour retrouver toute l'actualité ainsi que tout les autres evenements de Longuenesse!"</a>
                </figcaption>
              </figure>
            </div>
          </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
        </div>
      </div>
    </div>   
</main>

<footer>
<?php include('include/footer.php');?>
</footer>
</body>
</html>
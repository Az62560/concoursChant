<?php
session_start();

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include('include/connexion_bdd.php');

// s'il n'y a pas d'id de session, redirige vers index.php
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

class Candidature{
    //propriétés
    public $id_user;
    public $chant;
    public $cheque;
    public $date;
    public $status;
    public $chemin;
    }


// récupération de données dans la table user
$sql = "SELECT * FROM user WHERE id = :id_user"; 
$query= $db->prepare($sql);
$query->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_STR);
$query->execute();
$userData = $query->fetchAll(PDO::FETCH_ASSOC);
// echo($userData);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Work+Sans&display=swap" rel="stylesheet">
    <title>Candidature</title>
</head>
<body>
<nav>
    <?php 
    include("include/navbar.php");
    ?>
</nav>
<main>
<div class="container">
  <div class="row d-flex align-items-center " >
      <div class="text-white">
        <div id="cardconec" class="rounded-5 card-body p-3 text-center" style="background: linear-gradient(0deg, rgba(255,254,254,1) 36%, rgba(255,0,0,1) 100%)">
            <form action="" method="POST" enctype="multipart/form-data">
            <h2 class="fw-bold">Formulaire de candidature</h2><br>
            <!-- <a href="gen.php">helllo</a> -->
                
                    <label for="nom">
                    <input type="text" id="typeTextX" class=" form-control form-control-lg" name="nom" value="<?=$_SESSION['nom']?>" readonly/></label>

                    <label for="prenom">
                    <input type="text" id="typeTextX" class=" form-control form-control-lg" name="prenom" value="<?=$_SESSION['prenom']?>"readonly/></label>
                
                    <label for="email">
                    <input type="email" id="typeTextX" class=" form-control form-control-lg" name="email" value="<?=$_SESSION['email']?>"readonly/></label>

                
                    <label for="chant">
                    <input type="text" id="typeTextX" class=" form-control form-control-lg" name="chant" placeholder="Entrez votre chanson"/>
                    </label>
                   <br><br> 
                <button type="submit" id="typeTextX" class="btn btn-outline-dark btn-lg px-3">Chercher</button>
                <?php

$idCandidature = $_SESSION['id']; 

$sqlc = "SELECT `status` FROM `candidature` WHERE `id_user` = :id_user";
$stmt=$db->prepare($sqlc);
$stmt->bindValue(':id_user', $idCandidature, PDO::PARAM_INT);
$stmt->execute();

// Récupérez la valeur du statut
$statusValue = $stmt->fetch();

echo'<br> <br> <div class="progress" role="progressbar" aria-label="Warning example" aria-valuemin="0" aria-valuemax="100">
<div class="progress-bar-striped bg-info progress-bar-animated" style="width:'. 50 * $statusValue["status"] .'%"></div>
</div>';

if($statusValue["status"] === 2) {
    echo'<p class="text-black">Votre candidature est complète et nous avons reçu votre chèque. <br> <br> Téléchargez votre facture PDF <a class="pdf" href="gen.php"> ici. </p></a>';
}
?>

        <?php
            
            
        if (!empty($_POST['chant'])) {
            // utilisation de l'api shazam
            $search = urlencode($_POST['chant']);
            $curl = curl_init();
            
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://shazam.p.rapidapi.com/search?term='. $search .'&locale=en-US&offset=0&limit=3',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => [
                    "X-RapidAPI-Host: shazam.p.rapidapi.com",
                    "X-RapidAPI-Key: c6650e7099msh9070330fa04ff3fp1d11a6jsn2cad5ae2aa40"
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            // echo $response;
            $data = json_decode($response,true);
            $research = $data['tracks']['hits'];
            // var_dump($research);
                
            for ($i=0; $i < count($research) ; $i++) {
            }?>


            <label for="singg">
                <select name="sing" id="sing-select" type="select">
                    <option value="">Choisissez votre chanson</option>
                    
                    <option value="Artiste : <?=$research[0]['track']['subtitle']?>  Titre : <?=$research[0]['track']['title'];?>">Artiste : <?=$research[0]['track']['subtitle']?>  Titre : <?=$research[0]['track']['title'];?></option>
                    <option value="Artiste : <?=$research[1]['track']['subtitle']?>  Titre : <?=$research[1]['track']['title'];?>">Artiste : <?=$research[1]['track']['subtitle']?>  Titre : <?=$research[1]['track']['title'];?></option>
                    <option value="Artiste : <?=$research[2]['track']['subtitle']?>  Titre : <?=$research[2]['track']['title'];?>">Artiste : <?=$research[2]['track']['subtitle']?>  Titre : <?=$research[2]['track']['title'];?></option>
                </select>          
            <button type="submit" id="typeTextX" class="btn btn-outline-dark btn-lg px-5">Envoyer la candidature</button>
            </label>    
            

        <?php           
        }
        
        
    if (isset($_POST['sing'])) {
        // Vérifier si une candidature existe déjà pour cet utilisateur
        $sql = "SELECT * FROM candidature WHERE id_user = :id_user";
        $query = $db->prepare($sql);
        $query->bindValue(":id_user", $_SESSION['id'], PDO::PARAM_INT);
        $query->execute();
        $existingCandidatures = $query->fetchAll(PDO::FETCH_ASSOC);
        
        if (count($existingCandidatures) > 0) {
            // Une candidature existe déjà pour cet utilisateur
            echo '<br><br><div id="deja">' . 'Vous avez déjà fait votre candidature, merci de contacter la mairie de Longuenesse si vous souhaitez recommencer.' . '</div>';
        
        } else {

            // Récupérer la chanson sélectionnée dans le formulaire
            $selectedSong = $_POST['sing'];
    
            // Vérifier si la chanson sélectionnée est déjà présente parmi les candidatures existantes
            $sqlCheck = "SELECT COUNT(*) AS count FROM candidature WHERE chant = :selectedSong";
            $queryCheck = $db->prepare($sqlCheck);
            $queryCheck->bindValue(":selectedSong", $selectedSong, PDO::PARAM_STR);
            $queryCheck->execute();
            $result = $queryCheck->fetch(PDO::FETCH_ASSOC);
    
            if ($result['count'] > 0) {

                // La chanson sélectionnée est déjà présente en candidature, afficher un message à l'utilisateur
                echo '<br><br><div id="deja">' . 'La chanson que vous voulez chanter est déjà prise, désolé...' . '</div>';


                
            } else {

                // La chanson sélectionnée n'est pas déjà en candidature, procéder à l'insertion
                
                $sqlInsert = "INSERT INTO `candidature` (`id_user`, `chant`, `cheque`,  `date`, `status`)
                              VALUES (:id_user, :chant, :cheque, :date, :status)";
                $queryInsert = $db->prepare($sqlInsert);
                $queryInsert->bindValue(":id_user", $_SESSION['id'], PDO::PARAM_INT);
                $queryInsert->bindValue(":chant", $_POST['sing'], PDO::PARAM_STR);               
                $queryInsert->bindValue(":cheque", 0, PDO::PARAM_STR);
                $queryInsert->bindValue(":date", date('Y-m-d'), PDO::PARAM_STR);
                $queryInsert->bindValue(":status", 1, PDO::PARAM_STR);
                $queryInsert->execute();
    
                echo '<br><br><div id="deja">' . 'Candidature envoyée avec succès.' . '</div>';
            
            }
        }
    }
    
 
       ?>

        </div>
</form>
 
<?php

$idCandidature = $_SESSION['id']; 

$sqlc = "SELECT `status` FROM `candidature` WHERE `id_user` = :id_user";
$stmt=$db->prepare($sqlc);
$stmt->bindValue(':id_user', $idCandidature, PDO::PARAM_INT);
$stmt->execute();

// Récupérez la valeur du statut
$statusValue = $stmt->fetch();


?>

</main>
<footer>
<?php include('include/footer.php');?>
</footer>
</body>
</html>
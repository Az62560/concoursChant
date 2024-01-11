<?php
include('include/connexion_bdd.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

if($_SESSION['role'] !== '["ROLE_ADMIN"]') {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> 
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
<nav>
    <?php
    include('include/navbar.php');
    ?>
</nav>
<main>
    <br><h2>Candidature(s)  à approuver ou supprimer</h2>
        <?php                   
            $sql="SELECT * FROM candidature INNER JOIN user ON candidature.id_user = user.id WHERE candidature.status = 1";
            $query=$db->prepare($sql);
            $query->execute();
            $requete=$query->fetchAll(PDO::FETCH_ASSOC);
        
            for($i = 0; $i < count($requete); $i++){
                // Traitement de la suppression
if (isset($_POST['delete'.$i])) {

    $sql = "DELETE FROM candidature WHERE id_user = :id";
    $query = $db->prepare($sql);
    $query->bindValue(':id', $requete[$i]['id'], PDO::PARAM_STR);
    $query->execute();

    echo "La candidature a bien été supprimée à la base de donnée.";

    }
    
if (isset($_POST['cheque'.$i])) {

    $sql = "UPDATE candidature SET status = '2', cheque = '1' WHERE id_user = :id" ;
    $query = $db->prepare($sql);
    $query->bindValue(':id', $requete[$i]['id'], PDO::PARAM_STR);
    $query->execute();

    echo "Le chèque est arrivé";

    }

?>

<div class="container" id="okok">
    <form action="" method="post">                  
        <!-- Utilisez les données récupérées pour pré-remplir les champs du formulaire -->
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="<?php echo $requete[$i]['nom']; ?>" readonly>
            
        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="<?php echo $requete[$i]['email'];?>" readonly>
            
        <!-- Autres champs du formulaire pour la candidature -->
        <label for="champ1">Musique :</label>
        <p id="cand"><?php echo $requete[$i]['chant'];?></p>
<?php
    echo "<button class='btn btn-outline-dark btn-lg px-5' name='delete$i' type='submit'>Supprimer la candidature</button>";
    echo "<button class='btn btn-outline-dark btn-lg px-5' name='cheque$i' type='submit'>Chèque reçu</button>";                        
?>
    </form>       
</div>
<?php 
    }
?>    
</main>        
</body>

</html>
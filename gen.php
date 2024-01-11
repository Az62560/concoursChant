<?php
session_start();

include('include/connexion_bdd.php');
 
error_reporting(E_ALL);
ini_set('display_errors', 1);

use Dompdf\Options;
use Dompdf\Dompdf;
require_once 'include/dompdf/autoload.inc.php';

// Récupération des données de l'utilisateur depuis la base de données (utilisation de la requête préparée)
$sql = "SELECT nom, prenom, email, age FROM user WHERE id = :id_user";
$query = $db->prepare($sql);
$query->bindValue(':id_user', $_SESSION['id'], PDO::PARAM_INT);
$query->execute();
$user_data = $query->fetch(PDO::FETCH_ASSOC);

if ($user_data) {
    // Génération de la facture
    $image_path ='Images/music-plate-svgrepo-com4.svg';
    $imageData = file_get_contents($image_path);
    $base64 = base64_encode($imageData);
    $html = "
    <html>
    <head>
    <titre>Facture<titre>
    </head>
    <body>
        <h1>Facture</h1>
        <p>Date: " . date("Y-m-d") . " </p>

        <p>Destinataire:</p>
        <p>Nom: {$user_data['nom']} </p>
        <p>Prénom: {$user_data['prenom']} </p>
        <p>Email: {$user_data['email']} </p>
        <p>Age: {$user_data['age']} </p>


        <p>Détails de la facture:</p>
        
        <table>
        <tr>
        <div class='container' id='okok'>
        <table>
                <tr>
                    <th>Description</th>
                    <th>Montant</th>
                </tr>
                <tr>
                    <td>Montant HT</td>
                    <td id='montantHT'>40$</td>
                </tr>
                <tr>
                    <td>Montant TTC</td>
                    <td id='montantTTC'>40$</td>
                </tr>
            </table></div>
        <!-- Ajoutez ici les détails spécifiques de la facture -->

        <p>Merci de votre achat!</p><br>

        <p>Cordialement, la JJ Corp.<br>
    </body>
    </html>
    ";

    // Création du fichier PDF

    $options= new Options();

    $options->set('defaultFont', 'Courier');
    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream();
    // Enregistrement du fichier PDF (vous pouvez également le streamer directement au navigateur)
    $filename = 'facture_' . $_SESSION['id'] . '_' . date("Y-m-d") . '.pdf';
    file_put_contents($filename, $dompdf->output());

    echo "Facture générée avec succès.";

} else {
    echo "Aucun utilisateur trouvé avec cet ID.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTUREV2</title>
</head>
<body>
    
</body>
</body>
</html>

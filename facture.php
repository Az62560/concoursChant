<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<html>
    <body>
    <img src='data:music-plate-svgrepo-com4.svg/svg;base64,' . {$base64} . ' '>
        <h1>Facture</h1>
        <p>Date: date("Y-m-d") </p>

        <p>Destinataire:</p>
        <p>Nom: ' . {$user_data['nom']} . '</p>
        <p>Prénom: ' . {$user_data['prenom']} . '</p>
        <p>Email: ' . {$user_data['email']} . '</p>
        <p>Age: ' . {$user_data['age']} . '</p>
        <p>Data: ' . {$user_data['date']} . '</p>

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
    
</body>
</html>
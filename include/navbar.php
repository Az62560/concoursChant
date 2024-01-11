
        <div id="logo" class="container-fluid">
            <div class="img">
            <img src="Images/Component.svg" class="img">
            </div>
        <div class="li">
            <a id="nav" href="index.php">Accueil</a>
            
            <?php
           
                

            if (!isset($_SESSION['id'])) {

                           
            echo '<a id="nav" href="inscription.php">Inscrivez vous</a>
            <a id="nav" href="connexion.php">Connectez vous</a>';
            
            } else if (isset($_SESSION['id']) && ($_SESSION['role'] === '["ROLE_ADMIN"]'))  {
 
                echo '<a id="nav">Bienvenue ' . $_SESSION['prenom'] . 
                '</a><a id="nav" href="admin.php">Admin</a>
                <a id="nav" href="deconnexion.php">Déconnexion</a>';
                
            } else {

                echo '<a id="nav">Bienvenue ' . $_SESSION['prenom'] . 
                '</a><a id="nav" href="derogation.php">Candidature</a>
                <a id="nav" href="deconnexion.php">Déconnexion</a>';

            } 
            
            ?>

            
        </div>
        </div>



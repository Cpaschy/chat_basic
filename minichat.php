<?php
//sauvegarde cookie pseudo
if (isset($_POST['pseudoInput'])) // Si le formulaire a été envoyé...
{
    setcookie('pseudo', $_POST['pseudoInput'], time() + 365 * 24 * 3600, null, null, false, true); // On créé le cookie, c'est IMPORTANT !
    header("Location: minichat.php");
}
?>
    <!DOCTYPE html>
    <head>
        <title>mini-chat </title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
    </head>
    <body>
    <div class="card text-center">
        <div class="card-header">
            chat_BeAlpha
        </div>
        <div class="card-body">
            <h5 class="card-title">MiniChat_BecomeAlpha</h5>
            <p class="card-text">Le chat test</p>
            <form action="minichat_post.php" method="post">
                <div align="center">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="formGroup">PSEUDO</label>
                        <input type="text" class="form-control" name="pseudoInput" placeholder="Pseudo">
                    </div>
                </div>
                </div>
                <div class="form-group">
                    <label for="FormControlTextarea">Message</label>
                    <textarea class="form-control" name="messageInput" rows="3"></textarea>
                </div>
                <input class="btn btn-outline-primary" type="submit" value="Envoyer">
            </form>
            <?php

            //connection bd
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8', 'root', '');
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }


            //recuperation des 10 derniers messages
            $reponse = $bdd->query('SELECT pseudo, message FROM chat ORDER BY ID DESC LIMIT 0, 15');


            // Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
            while ($donnees = $reponse->fetch()) {
                echo '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : ' . htmlspecialchars($donnees['message']) . '</p>';
            }

            $reponse->closeCursor();


            ?>
            <div class="card-footer text-muted">
                <img src="img/be_alpha.png">
            </div>
        </div>
    </div>
    </body>
    </html>

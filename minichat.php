<!DOCTYPE html>
<html>

<head>
    <title>Minichat amélioré</title>
    <meta charset="UTF-8">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <!-- FORMULAIRE -->
        <div>
            <h1>Mini chat amélioré</h1>
            <form action="minichat_post.php" method="post">

                <p><label for="pseudo">Pseudo</label> : <input type=text name="pseudo" id="pseudo" value="<?php

                  if(isset($_COOKIE['pseudo']))
                  {
                    echo htmlspecialchars($_COOKIE['pseudo']);
                  }
                    
                  ?>" /></p>

                <p><label for="message">Message</label> : <input type="text" name="message" id="message"></p>



                <p><input type="submit" value="Envoyer" /><br/></p>
            </form>
        </div>
    </header>


<div class="messages">


    <?php
         
 
             
 
            // connexion à la base dedonnées
            try
            {
                $bdd = new PDO ('mysql:host=localhost;dbname=test;charset=utf8','root','');
            }
 
            catch (Exception $e)
            {
                die('Erreur : ' .$e ->getmessage());
            }
     
             
 
            //on récupère les messages dans la bdd
            $reponse = $bdd->query('SELECT pseudo, message, date_format(date_message,\'le %d/%m/%Y à %Hh:%imin:%ss\')AS date_message_fr FROM minichat ORDER BY ID DESC LIMIT 0, 10');
    
    

            //on affiche les messages
            while ($donnees = $reponse->fetch())
            {
                echo '<p><strong>' .htmlspecialchars($donnees['pseudo']). ' </strong><em>' . $donnees['date_message_fr'].' : </em>'.htmlspecialchars($donnees['message']).'</p>';
            }
 
        
         
    $reponse->closeCursor();
     
     
?>
 </div>

</body>

</html>

<?php
/**
 * Created by PhpStorm.
 * User: versa
 * Date: 24/03/2019
 * Time: 14:51
 */
//connexion à la base de données
try{
    $bdd = new PDO('mysql:host=localhost;dbname=minichat;charset=utf8','root','');
}

catch (Exception $e){
    die('Erreur : '.$e->getMessage());
}

//insertion du message à l'aide d'une requete
$req = $bdd->prepare('INSERT INTO chat (pseudo,message) VALUES(? , ?)');
$req ->execute(array($_POST['pseudoInput'],$_POST['messageInput']));

//redirection du visiteur vers la page de tchat
header('location:minichat.php');

?>

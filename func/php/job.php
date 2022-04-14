<?php
include '../config/dbconnect.php';
require_once '../func/php/tweetHandler.php';

//Leggo il contenuto della tabella SCHEDULED TWEETS
$timestamp = time(); //Calcolo il timestamp attuale
$query_check = mysqli_query($mysqliConnection, "SELECT * FROM `scheduled_tweets` WHERE `timestamp` <= $timestamp AND `inviato` = 0");
//Faccio un controllo sul DB comparando i timestamp salvati con quello attuale
while ($dati = mysqli_fetch_array($query_check)) {
    $id = $dati['id'];
    $tweet = $dati['text'];
    tweet($tweet); //Se uno dei timestamp salvati nei tweet schedulati combacia, invio 
    mysqli_query($mysqliConnection, "UPDATE `scheduled_tweets` SET `inviato`= !`inviato` WHERE id = $id"); //Aggiorno la riga impostando il tweet che ho appena inviato come "inviato"
}

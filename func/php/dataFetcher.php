<?php

include '../../config/dbconnect.php';
header('Content-Type: application/json; charset=utf-8');

if (isset($_GET['getSched'])) {
    print(getScheduledTweets());
}

function getScheduledTweets()
{
    global $mysqliConnection;

    $queryScheduled =  mysqli_query($mysqliConnection, 'SELECT * FROM `scheduled_tweets` ORDER BY `inviato` DESC ');
    $arrayDati = array();
    while ($dati = mysqli_fetch_array($queryScheduled)) {
        $arrayDati[] = $dati;
    }
    return json_encode($arrayDati);
}

<?php
header('Content-Type: application/json; charset=utf-8');

include '../../config/API_CFG.php';
include '../../config/dbconnect.php';
require "../../vendor/autoload.php";

use Noweh\TwitterApi\Client;


if (isset($_POST['sceltaSchedule'])) {
    $scelta = $_POST['sceltaSchedule'];
    switch ($scelta) {
        case 'tweetNow':
            $tweetNowMsg = $_POST['tweetMsg'];
            return json_encode(tweet($tweetNowMsg));
            break;
        case 'scheduleTweet':
            $tweetMsg = $_POST['tweetMsg'];
            $timestamp = $_POST['timestamp'];
            return json_encode(schedulaTweet($timestamp, $tweetMsg));
            break;
    }
}

function tweet($msg)
{
    try {
        $client = new Client($GLOBALS['settings']);
        $return = $client->tweet()->performRequest('POST', ['text' => $msg]);
        echo json_encode(["status" => "okay"]);
    } catch (Exception $ex) {

        echo json_encode([["status" => "errore"], ["dettagli" => $ex->getMessage()]]);
    }
}

function schedulaTweet($timestamp, $msg)
{
    global $mysqliConnection;
    try {
        mysqli_query($mysqliConnection, "INSERT INTO `scheduled_tweets`(`text`, `timestamp`) VALUES ('$msg', '$timestamp')"); //Aggiungo il tweet schedulato al database con stato di inviato = 0 per default
        echo json_encode(["status" => "okay"]);
    } catch (Exception $ex) {

        echo json_encode([["status" => "errore"], ["dettagli" => $ex->getMessage()]]);
    }
}

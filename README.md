# PHP-TwitterSheduler

La soluzione sviluppata in PHP e JS permette attraverso le API di Twitter di poter pubblicare o 
programmare l’invio dei tweet.
Nella pagina dell’app è presente una card contenente una textArea che rende possibile 
l’inserimento del messaggio, è presente anche un contatore del testo inserito (da 280 caratteri) 
per ovviare al problema dei caratteri massimi consentiti da twitter.
Sono presenti due radioButton che permettono di scegliere se inviare subito il tweet o 
programmarlo utilizzando il datePicker di seguito.
Nella card di seguito è presente una tabella che tramite dei record inseriti in un database Mysql, 
ritorna la cronologia dei tweet programmati (inviati e non) distinguibili con delle icone che ne 
rappresentano lo stato.
Le librerie/framework utilizzati sono i seguenti : 
noweh/twitter-api-v2 per gestire l’autenticazione oAuth di Twitter
SweetAlert.js per gestire i popup e i modal 
Bootstrap/popper.js/jquery.js per gestire l’interfaccia grafica
L’app lavora seguendo il seguente schema : 
Il file index.php è la home page generale del programma, fa utilizzo del file 
/func/js/twitterSchedule.js che si occupa di : 
1. Caricare la cronologia dei tweet programmati al caricamento della pagina
2. Contare i caratteri rimanenti alla textArea
3. Gestire le chiamate ai file php che si occupano di gestire i tweet e il database.
I file php che vengono utilizzati sono i seguenti : 
/func/php/dataFetcher.php che si occupa di leggere e ritornare in formato JSON le voci righe
all’interno della tabella `scheduled_tweets` - ovvero i tweet programmati (inviati e non)
/func/php/job.php che si occupa, tramite apposita chiamata wget gestita dal daemon di crontab 
di ciclare e leggere il contenuto della tabella `scheduled_tweets`, utilizzando la colonna 
contenente il timestamp relativo alla pubblicazione del tweet e filtrando in base ai tweet non 
inviati, quando comparando il timestamp attuale con quello inserito in database, lo script riscontra 
che la data programmata è attuale o passata effettua una chiamata allo script tweetHandle.php
che svolgerà il resto del lavoro.
/func/php/tweetHandler.php si occupa di gestire le chiamate fetch provenienti dal frontend, 
resta in attesa di una chiamata POST[‘sceltaSchedule’] che appunto contiene il record proveniente 
dai radioButton che permettono di scegliere se effettuare il tweet immediatamente oppure 
programmarlo.
Efettuando uno switch delle scelte possibili, vengono chiamate due funzioni
Tweet o schedulaTweet che accettano per parametro $msg e $timestamp rispettivamente.
La funzione tweet permette di inviare il tweet immediatamente tramite le API e la libreria che 
gestisce l’autenticazione, ritornando in formato JSON uno status positivo se privo di problemi, 
altrimenti uno status di errore con i relativi dettagli provenienti dalle API stesse, che verranno 
analizzate e mostrate nel frontend.
La funziona schedulaTweet invece accetta per parametro $msg e $timestamp ed è quella che si 
occupa di creare la riga in DB contenente il tweet da programmare e il relativo timestamp. Anche 
questa funzione ritorna stato di successo o errore che vengono analizzati e mostrati nel frontend.
I file API_CFG.php e dbConnect.php, si occupano invece di contenere le chiavi API e gestire la 
connessione al database rispettivamente.
Per quanto riguarda l’installazione dello script sarà necessario effettuare le seguenti operazioni : 
Aggiornare il file /config/API_CFG.php con le proprie chiavi API. 
Aggiornare il file /config/dbConnect.php con i propri marametri per connettersi al DB mysql. 
Creare un db “twitter_scheduler” e una tabella “scheduled_tweets” con la seguente 
configurazione:
Creare un cronjob utilizzando il seguente comando per effettuare la chiamata allo script che si 
occupa della programmazione.
“$ crontab -e”
“* * * * * wget https://$url/func/php/job.php"

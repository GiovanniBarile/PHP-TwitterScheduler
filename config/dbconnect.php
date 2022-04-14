<?php
$hostName = "localhost";
$userName = "twitter";
$password = "xx";
$database = "twitter_scheduler";


$mysqliConnection = mysqli_connect($hostName, $userName, $password, $database) or die('Non riesco a connettermi al DB');

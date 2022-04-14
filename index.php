<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TwitterScheduler - Ardeek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<nav class="navbar navbar-light bg-light">
    <a class="navbar-brand" href="#">
        <img src="assets/img/schedule.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Twitter Scheduler
    </a>
</nav>

<style>
    body {
        background-image: url("assets/img/jcyw0jsr.bmp");
        background-repeat: no-repeat;
        background-size: 100%;
        opacity: 0.9;
    }

    .card {
        border-radius: 25px;
    }
</style>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Twitter Scheduler
            </div>
            <form action="" method="post">
                <div class="card-body">
                    <div class="form-group">
                        <label for="textAreaTweet">Testo da twittare</label>
                        <textarea class="form-control" id="textAreaTweet" name="tweetMsg" maxlength="280" required rows="3" onkeyup="contaCaratteri(this)"></textarea>
                        <small>Caratteri rimanenti : <span id='caratteriRimanenti'>280</span>/280 </small>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                            <input type="radio" id="twittaSubito" name="sceltaSchedule" value='tweetNow' class="custom-control-input" checked>
                            <label class="custom-control-label" for="twittaSubito">Invia subito</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="programmaTweet" name="sceltaSchedule" value='scheduleTweet' class="custom-control-input" id="radioProgrammaTweet">
                            <label class="custom-control-label" for="programmaTweet">Programma il tweet</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="scegliData">
                            <label for="dataTweet">Data</label>
                            <input type="datetime-local" name="dataTweet" id="dataTweet">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="inviaTweet();">Invia</button>
                </div>
            </form>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                Tweet programmati
            </div>

            <div class="card-body">
                <table class="table table-striped" id='scheduledTable'>
                    <thead>
                        <th>Tweet</th>
                        <th>Data</th>
                        <th>Pubblicato</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


</body>
<script type="text/javascript" src="./func/js/twitterScheduler.js"> </script>

</html>
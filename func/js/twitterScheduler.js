window.onload = function () {
  loadScheduledTweets();
};

document.getElementById("textAreaTweet").onkeyup = function () {
  //Conto i caratteri riguardanti la textArea
  let count = 280 - this.value.length; //Il limite massimo per un tweet è di 280 caratteri
  document.getElementById("caratteriRimanenti").innerText = count;
};

async function inviaTweet() {
  if (document.getElementById("textAreaTweet").value.length <= 0) {
    Swal.fire({
      icon: "error",
      title: "Errore",
      text: "Devi inserire qualcosa!",
    });
  } else {
    if (document.getElementById("twittaSubito").checked) {
      //Faccio un check se è stato attivato il tweet istantaneo
      //Serializzo il form che contiene la textArea
      let form = document.querySelector("form");
      let datiForm = new FormData(form);
      await fetch("/Ardeek/func/php/tweetHandler.php", {
        method: "post",
        body: datiForm,
      })
        .then((response) => response.json())
        .then((data) => {
          if (data.status == "okay") {
            Swal.fire({
              icon: "info",
              title: "Tweet inviato",
              text: "Hai inviato con successo un tweet!",
            }).then((result) => {
              if (result.isConfirmed) {
                document.getElementById("textAreaTweet").value = "";
                loadScheduledTweets();
              }
            });
          } else {
            let dettagliErrore = JSON.parse(data[1].dettagli);
            Swal.fire({
              icon: "error",
              title: "C'è stato un errore",
              text: dettagliErrore,
            });
          }
        });
    } else {
      let datePicker = document.getElementById("dataTweet").value;
      //Converto la data in timestamp
      let timeStamp = new Date(datePicker).getTime() / 1000;
      let actualTimeStamp = Math.floor(Date.now() / 1000);
      if (timeStamp < actualTimeStamp || isNaN(timeStamp)) {
        alert("Devi selezionare una data valida.");
      } else {
        //Serializzo il form che contiene la textArea
        let form = document.querySelector("form");
        let datiForm = new FormData(form);
        datiForm.append("timestamp", timeStamp);
        await fetch("https://xxx/func/php/tweetHandler.php", {
          method: "post",
          body: datiForm,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.status == "okay") {
              Swal.fire({
                icon: "info",
                title: "Tweet programmato",
                text: "Hai programmato con successo un tweet!",
              }).then((result) => {
                if (result.isConfirmed) {
                  document.getElementById("textAreaTweet").value = "";
                  loadScheduledTweets();
                }
              });
            }
          });
      }
    }
  }
}

async function loadScheduledTweets() {
  $("#scheduledTable > tbody").empty(); //Svuoto il body della tabella per ripopolarlo con le nuove voci
  await fetch("https://xxx/func/php/dataFetcher.php?getSched", {
    //Carico le voci tramite lo script php che legge il database
    method: "get",
  })
    .then((response) => response.json())
    .then((data) => {
      data.forEach((element) => {
        if (element.inviato == 1) {
          //In base allo stato del tweet 0/1 assegno le icone
          element.inviato = '<i class="bi-check"></i>';
        } else {
          element.inviato = '<i class="bi-x"></i>';
        }

        let date = new Date(element.timestamp * 1000); //Converto il timestamp in data
        let day = date.getDate();
        let month = date.getMonth() + 1;
        let year = date.getFullYear();
        let hours = date.getHours();
        let minutes = "0" + date.getMinutes();
        let seconds = "0" + date.getSeconds();

        let formattedTime =
          day +
          "/" +
          month +
          "/" +
          year +
          " - " +
          hours +
          ":" +
          minutes.substr(-2) +
          ":" +
          seconds.substr(-2);

        $("#scheduledTable").append(
          //Inserisco i dati nella tabella
          "<tr><td>" +
            element.text +
            "</td>" +
            "<td>" +
            formattedTime +
            "</td>" +
            "<td>" +
            element.inviato +
            "</td></tr>"
        );
      });
    });
}

<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Successo</title>
  </head> 
    <body>
    <h3>  <a href="Home.php"><img src="casa.png" alt="Mia Immagine" width="2%" ></a> 
    <hr align="left" size="1" width="2%" noshade>

      <?php
      session_start();
            if($_SESSION["Insuccesso"]=='1'){
              echo "<h3>ATTENZIONE! PRENOTAZIONE NON AVVENUTA</h3>
              <p>&emsp; &emsp;&emsp; &emsp;&emsp; &emsp; <strong> Posti esauriti </strong> </p>
              <hr align='left' size='1' width='30%' noshade>
              <p>TORNA AL CALENDARIO
              <a href='CalendarioPrenotazioni.php'> PRENOTAZIONI</a></p> ";
                  if($_SESSION["IsDirettore"]=='t'){
                echo "<p>TORNA ALL' 
                <a href='Direttore.php'> AREA RISERVATA</a></p> ";
              }else{
                echo "<p>TORNA ALL' 
                <a href='Tiratore.php'> AREA RISERVATA</a></p> ";
              }
            }
            if($_SESSION["Insuccesso"]=='2'){
              echo "<h3>ATTENZIONE! PRENOTAZIONE NON AVVENUTA</h3>
              <p>&emsp; &emsp;&emsp; &emsp;&emsp; &emsp;<strong> Non sei autorizzato </strong> a sparare senza la presenza di un direttore di tiro </p>
              <hr align='left' size='1' width='30%' noshade>
              <p>TORNA AL CALENDARIO
              <a href='CalendarioPrenotazioni.php'> PRENOTAZIONI</a></p> ";
                  if($_SESSION["IsDirettore"]=='t'){
                echo "<p>TORNA ALL' 
                <a href='Direttore.php'> AREA RISERVATA</a></p> ";
              }else{
                echo "<p>TORNA ALL' 
                <a href='Tiratore.php'> AREA RISERVATA</a></p> ";
              }
            }
            if($_SESSION["Insuccesso"]=='3'){
              echo "<h3>ATTENZIONE! PRENOTAZIONE NON AVVENUTA</h3>
              <p> &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;Non puoi prenotare più di una volta una <strong>fascia oraia </strong>nella stessa data</p>
              <hr align='left' size='1' width='30%' noshade>
              <p>TORNA AL CALENDARIO
              <a href='CalendarioPrenotazioni.php'> PRENOTAZIONI</a></p> ";
                  if($_SESSION["IsDirettore"]=='t'){
                echo "<p>TORNA ALL' 
                <a href='Direttore.php'> AREA RISERVATA</a></p> ";
              }else{
                echo "<p>TORNA ALL' 
                <a href='Tiratore.php'> AREA RISERVATA</a></p> ";
              }
            }
            if($_SESSION["Insuccesso"]=='4'){
              echo "<h3>ATTENZIONE! RIMOZIONE NON AVVENUTA</h3>
              <p> &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;Sono <strong>prenotati dei tiratori </strong>che non possono sparare da soli. Per rimuovere la tua prenotazione contatta i tiratori prenotati per modificare le loro prenotazioni</p>
              <hr align='left' size='1' width='30%' noshade>
              <p>TORNA AL CALENDARIO
              <a href='CalendarioPrenotazioni.php'> PRENOTAZIONI</a></p> ";
                  if($_SESSION["IsDirettore"]=='t'){
                echo "<p>TORNA ALL' 
                <a href='Direttore.php'> AREA RISERVATA</a></p> ";
              }else{
                echo "<p>TORNA ALL' 
                <a href='Tiratore.php'> AREA RISERVATA</a></p> ";
              }
            }
            if($_SESSION["Insuccesso"]=='5'){
              echo "<h3>ATTENZIONE! RIMOZIONE NON AVVENUTA</h3>
              <p> &emsp; &emsp;&emsp; &emsp;&emsp; &emsp;Sono prenotati <strong>altri tiratori </strong>per questa fascia oraria. Per rimuovere la tua prenotazione contatta i tiratori prenotati per modificare le loro prenotazioni</p>
              <hr align='left' size='1' width='30%' noshade>
              <p>TORNA AL CALENDARIO
              <a href='CalendarioPrenotazioni.php'> PRENOTAZIONI</a></p> ";
                  if($_SESSION["IsDirettore"]=='t'){
                echo "<p>TORNA ALL' 
                <a href='Direttore.php'> AREA RISERVATA</a></p> ";
              }else{
                echo "<p>TORNA ALL' 
                <a href='Tiratore.php'> AREA RISERVATA</a></p> ";
              }
            }
        ?>
       
    </body>
</html>
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
    <h3>  <a href="Home.php"><img src="casa.png" alt="Mia Immagine" width="2%" ></a> </h3>
    <hr align="left" size="1" width="2%" noshade>

      <?php
        session_start();

        if($_SESSION["Successo"]=="Rimuovi"){
          echo "<h3>RIMOZIONE AVVENUTA CON SUCCESSO!</h3>
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
        if($_SESSION["Successo"]=="Aggiungi"){
          echo "<h3>PRENOTAZIONE AVVENUTA CON SUCCESSO!</h3>
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
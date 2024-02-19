<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Calendario Prenotazioni</title>
  </head> 

  <body>
    <h3>  <a href="Home.php"><img src="casa.png" alt="Mia Immagine" width="2%" ></a> 
    <hr align="left" size="1" width="2%" noshade>
    <h3>PRENOTAZIONI CAMPO DI TIRO </h3>
  <?php
      setlocale(LC_TIME, 'ita', 'it_IT.utf8');
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
      echo "Connection to DB failed";
      }else{
        session_start();
        
        setlocale(LC_TIME, 'ita', 'it_IT.utf8');
        
          $cf=$_SESSION["Tiratore"];

          $query="SELECT nome,cognome,IsDirettore
          FROM tiratori 
          WHERE cf='$cf'";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore1.<br/>";
          }
          while($row = pg_fetch_array($query_res)) {
            echo "<strong>Tiratore: ".$row[0]." ".$row[1]."<br></br></strong>";
          }

          echo "<hr align='left' size='1' width='30%' noshade> ";
            function isWin()
            {
                $sys = strtoupper(PHP_OS);
            
                if(substr($sys,0,3) == "WIN")
                {
                    return TRUE;
                }
                return FALSE;
            }
            
            $localString = "it_IT";
            
            if(isWin())
            {
                $localString = "ita_ITA";
            }
            
        function createPerpetualCalendar($conn,$cf) {  
          $currentDate = new DateTime();
          for ($i = 0; $i < 14; $i++) {
            echo "<h3><strong> ". $currentDate->format("l, d F Y:") . "<br></strong></h3>"; 
            $data=$currentDate->format("Y/m/d");
            echo " &emsp;  <strong>09:00-12:00:"."<br>"."</strong> ";
            echo " &emsp; &emsp; <strong>Direttore/i di tiro:"."</strong> ";
            $query="SELECT nome,cognome,IsDirettore, IsAutorizzato, oraInizio,OraFine 
            FROM (prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf) as persone join fasceorarie on persone.fascia_oraria=fasceorarie.numero 
            WHERE data='$data' AND oraInizio='09:00' AND IsDirettore='t'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              echo $row[0]." ".$row[1];
            } 
            echo "<br>";
            $query="SELECT nome,cognome,IsDirettore, IsAutorizzato, oraInizio,OraFine 
            FROM (prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf) as persone join fasceorarie on persone.fascia_oraria=fasceorarie.numero 
            WHERE data='$data' AND oraInizio='09:00' AND IsDirettore='f'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              echo "&emsp; &emsp;&emsp; &emsp;&emsp; &emsp; Tiratore: ".$row[0]." ".$row[1]." - Autorizzato a sparare da solo: "; 
              if($row[3]=='f'){
                echo "No <br>";
              }else{
                echo "Sì <br>";
              }
            } 
            echo "<br>";

            echo " &emsp; <strong> 12:00-15:00: <br></strong>";
            echo " &emsp; &emsp;  <strong>Direttore/i di tiro:"."</strong> ";
            $query="SELECT nome,cognome,IsDirettore, IsAutorizzato, oraInizio,OraFine 
            FROM (prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf) as persone join fasceorarie on persone.fascia_oraria=fasceorarie.numero 
            WHERE data='$data' AND oraInizio='12:00' AND IsDirettore='t'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              echo $row[0]." ".$row[1];
            } 
            echo "<br>";
            $query="SELECT nome,cognome,IsDirettore, IsAutorizzato, oraInizio,OraFine 
            FROM (prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf) as persone join fasceorarie on persone.fascia_oraria=fasceorarie.numero 
            WHERE data='$data' AND oraInizio='12:00' AND IsDirettore='f'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              echo "&emsp; &emsp;&emsp; &emsp;&emsp; &emsp; Tiratore: ".$row[0]." ".$row[1]." - Autorizzato a sparare da solo: "; 
              if($row[3]=='f'){
                echo "No <br>";
              }else{
                echo "Sì <br>";
              }
            } 
            echo "<br>";

            echo " &emsp; <strong> 15:00-18:00: <br></strong>";
            echo " &emsp; &emsp; <strong>Direttore/i di tiro:"."</strong> ";
            $query="SELECT nome,cognome,IsDirettore, IsAutorizzato, oraInizio,OraFine 
            FROM (prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf) as persone join fasceorarie on persone.fascia_oraria=fasceorarie.numero 
            WHERE data='$data' AND oraInizio='15:00' AND IsDirettore='t'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              echo $row[0]." ".$row[1];
            } 
            echo "<br>";
            $query="SELECT nome,cognome,IsDirettore, IsAutorizzato, oraInizio,OraFine 
            FROM (prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf) as persone join fasceorarie on persone.fascia_oraria=fasceorarie.numero 
            WHERE data='$data' AND oraInizio='15:00' AND IsDirettore='f'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              echo "&emsp; &emsp;&emsp; &emsp;&emsp; &emsp; Tiratore: ".$row[0]." ".$row[1]." - Autorizzato a sparare da solo: "; 
              if($row[3]=='f'){
                echo "No <br>";
              }else{
                echo "Sì <br>";
              }
            } 

            echo "<br>";
            echo "<p><strong> Aggiungi </strong>prenotazione: </p>
            <a href='Home.php'><img src='piu.png' alt='Mia Immagine' width='20' ></a> 
            <form action='Aggiungi.php' method='POST'>
            &emsp;&emsp;&emsp;&emsp; <input type='text' name='data' value='$data' hidden/> 
                Fascia Oraria:
                <select name='fasciaoraria' >
                <option value='1' selected=‘selected’>09:00-12:00</option>
                <option value='2'>12:00-15:00</option>
                <option value='3'>15:00-18:00</option>
                </select>
                &emsp;&emsp;&emsp;&emsp;<input type='submit' name='InviaPrenotazione' value='Aggiungi'/>
            </form>";

            echo "<p> <strong>Rimuovi </strong>prenotazione: </p>
            <a href='Home.php'><img src='meno.png' alt='Mia Immagine' width='20' ></a> 
            <form action='Rimuovi.php' method='POST'>
            &emsp;&emsp;&emsp;&emsp;<input type='text' name='data' value='$data' hidden/> 
                Fascia Oraria:
                <select name='fasciaoraria' >
                <option value='1' selected=‘selected’>09:00-12:00</option>
                <option value='2'>12:00-15:00</option>
                <option value='3'>15:00-18:00</option>
                </select>
                &emsp;&emsp;&emsp;&emsp;<input type='submit' name='RimuoviPrenotazione' value='Rimuovi'/><br></br>
            </form>";
            $currentDate->modify("+1 day");
            echo "<hr align='left' size='1' width='30%' noshade> ";

          }
        }
        createPerpetualCalendar($conn,$cf);

    }

      
    ?>

    <h3> <a href="Home.php">Torna alla home</a> </h3>

  </body>
</html>

 
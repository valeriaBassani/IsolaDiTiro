<html>
  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Rimuovi</title>
  </head> 

  <body>
    <h3>RIMUOVI PRENOTAZIONI CAMPO DI TIRO : </h3>
  <?php
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
      echo "Connection to DB failed";
      }else{
        session_start();
        
          $cf=$_SESSION["Tiratore"];
          echo $cf;
        
        if(isset($_POST["RimuoviPrenotazione"])){
          $data=$_POST["data"];
          echo "data:".$data;
          $fasciaoraria=$_POST["fasciaoraria"];
          echo "fascia:".$fasciaoraria;

          $isDirettore;
          $query="SELECT IsDirettore
            FROM prenotazioni JOIN tiratori ON prenotazioni.tiratore=tiratori.cf
            WHERE tiratore='$cf'" ;
              $query_res = pg_query($conn, $query);
              if (!$query_res) {
                echo "Si è verificato un errore4.<br/>";
              }else{
                  while($row = pg_fetch_array($query_res)) {
                    $isDirettore=$row[0];
                  }
              }

          function NumNonAutorizzati($data,$fasciaoraria,$conn){
            echo "funzione";
            $query="SELECT count(tiratori)
            FROM prenotazioni JOIN tiratori ON prenotazioni.tiratore=tiratori.cf
            WHERE data='$data' AND fascia_oraria='$fasciaoraria' AND tiratori.IsAutorizzato='f'" ;
              $query_res = pg_query($conn, $query);
              if (!$query_res) {
                echo "Si è verificato un errore4.<br/>";
              }else{
                echo "else funzione";
                  while($row = pg_fetch_array($query_res)) {
                    $numNonAutorizzati=$row[0];
                  }
              }
              return $numNonAutorizzati;
          }

          function NumDirettori($data,$fasciaoraria,$conn){
            $query="SELECT count(tiratore)
            FROM prenotazioni JOIN tiratori ON prenotazioni.tiratore=tiratori.cf
            WHERE data='$data' AND fascia_oraria='$fasciaoraria' AND tiratori.IsDirettore='t'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore1.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              $numDirettori=$row[0];
            }
            return $numDirettori;
          }

          if($isDirettore=='t'){
            if (NumDirettori($data,$fasciaoraria,$conn)==1 && NumNonAutorizzati($data,$fasciaoraria,$conn)>0){
              $_SESSION["Insuccesso"]="4";
              header('Location:insuccesso.php');
            }else if(NumDirettori($data,$fasciaoraria,$conn)>1 && NumNonAutorizzati($data,$fasciaoraria,$conn)>5){
              echo NumNonAutorizzati($data,$fasciaoraria,$conn)>0;
              $_SESSION["Insuccesso"]="5";
              header('Location:insuccesso.php');
            }else{
              $query="DELETE FROM prenotazioni
              WHERE tiratore='$cf' AND data='$data' AND fascia_oraria='$fasciaoraria'" ;
              $query_res = pg_query($conn, $query);
              if (!$query_res) {
                echo "Si è verificato un errore4.<br/>";
              }else{
                $_SESSION["Successo"]="Rimuovi";
                header('Location:successo.php');
              }
            }
          }else{
            $query="DELETE FROM prenotazioni
              WHERE tiratore='$cf' AND data='$data' AND fascia_oraria='$fasciaoraria'" ;
              $query_res = pg_query($conn, $query);
              if (!$query_res) {
                echo "Si è verificato un errore4.<br/>";
              }else{
                $_SESSION["Successo"]="Rimuovi";
                header('Location:successo.php');
              }
          }
      }
    }
    
    ?>
  
  <h3> <a href="Home.php">Torna alla home</a> </h3>

  </body>
</html>

 
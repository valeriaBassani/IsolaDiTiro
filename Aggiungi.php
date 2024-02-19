<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Aggiungi</title>
  </head> 

  <body>
    <h3>AGGIUNGI PRENOTAZIONI CAMPO DI TIRO : </h3>
  <?php
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
      echo "Connection to DB failed";
      }else{
        session_start();
        
          $cf=$_SESSION["Tiratore"];

          $query="SELECT nome,cognome,IsDirettore
          FROM tiratori 
          WHERE cf='$cf'";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore1.<br/>";
          }
          while($row = pg_fetch_array($query_res)) {
            $isDirettore=$row[2];
            echo "Tiratore: ".$row[0]." ".$row[1]."<br></br>";
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
          function NumPrenotazioni($data,$fasciaoraria,$conn){
            $query="SELECT count(prenotazioni)
            FROM prenotazioni join tiratori on prenotazioni.tiratore=tiratori.cf
            WHERE data='$data' AND fascia_oraria='$fasciaoraria' AND tiratori.isDirettore='f'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore2.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              $numPrenotazioni=$row[0];
            }
            return $numPrenotazioni;
          }

          function IsAutorizzato($cf,$conn){
            $query="SELECT IsAutorizzato
            FROM tiratori
            WHERE cf='$cf'";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore3.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              $autorizzato=$row[0];
            }
            return $autorizzato;
          }

        if(isset($_POST["InviaPrenotazione"])){
          $data=$_POST["data"];
          echo "data:".$data;
          $fasciaoraria=$_POST["fasciaoraria"];
          echo "fascia:".$fasciaoraria;
          
          $numDirettori=NumDirettori($data,$fasciaoraria,$conn);
          $numPrenotazioni=NumPrenotazioni($data,$fasciaoraria,$conn);
          $autorizzato=IsAutorizzato($cf,$conn);

          if($numDirettori==1 AND $numPrenotazioni>=5){
            $_SESSION["Insuccesso"]="1";
            header('Location:insuccesso.php');
          }else if($numDirettori==2 AND $numPrenotazioni>=10){
            $_SESSION["Insuccesso"]="1";
            header('Location:insuccesso.php');
          }else if($numDirettori==3 AND $numPrenotazioni>=15){
            $_SESSION["Insuccesso"]="1";
            header('Location:insuccesso.php');
          }else if($numDirettori==0 AND $autorizzato=='f'){
            $_SESSION["Insuccesso"]="2";
            header('Location:insuccesso.php');
          }else if($numDirettori==0 AND $numPrenotazioni>=10){
            $_SESSION["Insuccesso"]="1";
            header('Location:insuccesso.php');
          }else{
            $query="SELECT *
            FROM prenotazioni
            WHERE tiratore='$cf' AND data='$data' AND fascia_oraria='$fasciaoraria'" ;
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore4.<br/>";
            }
            while($row = pg_fetch_array($query_res)) {
              $_SESSION["Insuccesso"]="3";
              header('Location:insuccesso.php');
            }

            $query="INSERT INTO prenotazioni Values('$data','$cf','$fasciaoraria')";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore2.<br/>";
            }else{
              $_SESSION["Successo"]="Aggiungi";
              $_SESSION["IsDirettore"]=$isDirettore;
              header('Location:successo.php');
            } 
          }
        }
     }
    ?>
  
  <h3> <a href="Home.php">Torna alla home</a> </h3>

  </body>
</html>

 
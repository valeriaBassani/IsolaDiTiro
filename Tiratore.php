<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Tiratore</title>
  </head> 

  <body>
    <h3>  <a href="Home.php"><img src="casa.png" alt="Mia Immagine" width="2%" ></a> 
    <hr align="left" size="1" width="2%" noshade>
    <h3>Tiratore Semplice </h3>
  <?php
  
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
      echo "Connection to DB failed";
      }else{
        session_start();

          $cf=$_SESSION["Tiratore"];

          $query="SELECT *
          FROM Tiratori
          WHERE cf='$cf' ";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore.<br/>";
            exit();
          }
          while($row = pg_fetch_array($query_res)) {
            echo "<strong>".$row[1]." ".$row[2]." <br></strong>"; 
            echo "Codice Fiscale: ".$row[0] ."<br>"; 
          }
      }
  ?>
<hr align="left" size="1" width="30%" noshade>
<h3> PROSSIME PRENOTAZIONI: </h3>

  <?php
          $query="SELECT DISTINCT data,tiratore,orainizio,orafine
          FROM prenotazioni join fasceorarie on prenotazioni.fascia_oraria=fasceorarie.numero
          WHERE tiratore='$cf' ";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore.<br/>";
            exit();
          }
          while($row = pg_fetch_array($query_res)) {
            if($ultimaData==$row[0]){
              echo "&emsp; ".$row[2]."-".$row[3]; 
              echo "<br>"; 
              $ultimaData=$row[0];
            }else{
              $data=$row[0];
              $data_estesa = date("d F Y", strtotime($data));
              echo "<strong> ".$data_estesa." </strong><br>";
              echo "&emsp; ".$row[2]."-".$row[3]; 
              echo "<br>"; 
              $ultimaData=$row[0];
            }
            
          }
  ?>
<br>
<hr align="left" size="1" width="30%" noshade>
 <h3> aggiungi o rimuovi prenotazioni: </h3>
  <form action="CalendarioPrenotazioni.php" method="POST">
       <?php echo "<input type='text' name='tiratore' value='$cf' hidden/> " ?>
       &emsp;&emsp;&emsp;&emsp; <input type="submit" name="visualizzaPrenotazioni" value="Calendario"/><br></br>
  </form>
  </body>
</html>
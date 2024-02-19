<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Tiratori</title>
  </head> 

  <body>
    <h3><br><br>Tiratori iscritti: </h3>
  <?php
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
      echo "Connection to DB failed";
      }else{
          $query="SELECT * FROM Tiratori";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore.<br/>";
            exit();
          }
          while($row = pg_fetch_array($query_res)) {
            if($row[4]==='f'){
              echo "ID: ".$row[0] ." - ";
              echo $row[1]." "; 
              echo $row[2]."<br><br>"; 
            }
          }
          echo "  <h3>Direttori di tiro: </h3>";
          $query="SELECT * FROM Tiratori";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore.<br/>";
            exit();
          }
          while($row = pg_fetch_array($query_res)) {
            if($row[4]==='t'){
              echo "ID: ".$row[0] ." - ";
              echo $row[1]." "; 
              echo $row[2]."<br><br>"; 
            }
          }
      }
  ?>
  <h3> <a href="Home.html">Torna alla home</a> </h3>

  </body>
</html>
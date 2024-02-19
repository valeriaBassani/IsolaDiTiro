<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Amministrazione</title>
  </head> 

  <body>
    <h3>  <a href="Home.php"><img src="casa.png" alt="Mia Immagine" width="2%" ></a> 
    <hr align="left" size="1" width="2%" noshade>

    <h3>  AMMINISTRATORE: </h3>
  <?php
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
      echo "Connection to DB failed";
      }else{
        session_start();

          $amministratore=$_SESSION["id"];

          $query="SELECT * FROM amministratori WHERE ID='$amministratore'";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore.<br/>";
            exit();
          }
          while($row = pg_fetch_array($query_res)) {
            echo "Nome: ".$row[1] ."<br>";
            echo "Cognome: ".$row[2]."<br>"; 
            echo "Is Tiratore: ".$row[3] ."<br>";  
          } 
      }
  ?>
  <hr align="left" size="1" width="30%" noshade>
  <h3> CREA NUOVO TIRATORE: </h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php echo "<input type='text' name='paziente' value='$paziente' hidden/> " ?>
        <input type="text" name="cf" placeholder="Cod Fiscale"/>
        <input type="text" name="nome" placeholder="Nome"/>
        <input type="text" name="cognome" placeholder="Cognome"/><br></br>
            é autorizzato a sparare da solo?
            <select name="ISAutorizzato" >
            <option value'Sì' selected=‘selected’>Sì</option>
            <option value'No'>No</option>
            </select><br></br>
            é un direttore di tiro?
            <select name="ISDirettore" >
            <option value'Sì'>Sì</option>
            <option value'No' selected=‘selected’>No</option>
            </select><br><br>
        <input type='text' name='Password' value='1234' hidden/> 
        <input type="submit" name="inviaTir" value="Invia"/><br></br>
    </form>
  <?php
    if(isset($_POST["inviaTir"])){
      $cf=$_POST["cf"];
      $nome=$_POST["nome"];
      $cognome=$_POST["cognome"];
      $ISAutorizato=$_POST["ISAutorizzato"];
      if($ISAutorizato==='Sì'){
        $ISAutorizato='t';
      }else{
        $ISAutorizato='f';
      }
      $ISDirettore=$_POST["ISDirettore"];
      if($ISDirettore==='Sì'){
        $ISDirettore='t';
      }else{
        $ISDirettore='f';
      }
      $password=$_POST["Password"];
        $query="INSERT INTO Tiratori VALUES('$cf','$nome','$cognome','$ISAutorizato','$ISDirettore','$password')";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore in inserimento tiratore.<br/>";
            exit();
          }else{
            header('Location:successo.php');
          }
        }
  ?>
  <hr align="left" size="1" width="30%" noshade>

  <h3> CREA NUOVO AMMINISTRATORE: </h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php echo "<input type='text' name='paziente' value='$paziente' hidden/> " ?>
        <input type="text" name="cf" placeholder="Cod Fiscale"/>
        <input type="text" name="nome" placeholder="Nome"/>
        <input type="text" name="cognome" placeholder="Cognome"/><br></br>
            é un tiratore?
            <select name="ISTiratore" >
            <option value'Sì'>Sì</option>
            <option value'No' selected=‘selected’>No</option>
            </select><br><br>
            é un direttore di tiro?
            <select name="ISDirettore" >
            <option value'Sì'>Sì</option>
            <option value'No' selected=‘selected’>No</option>
            </select><br><br>
        <input type='text' name='Password' value='1234' hidden/> 
        <input type="submit" name="inviaAdmn" value="Invia"/><br></br>
    </form>
  <?php
    if(isset($_POST["inviaAdmn"])){
      $cf=$_POST["cf"];
      $ISTiratore=$_POST["ISTiratore"];
      $ISDirettore=$_POST["ISDirettore"];
      if($ISTiratore=='Sì'){
        $ISTiratore='t';
      }else{
        $ISTiratore='f';
      }
      if($ISDirettore=='Sì'){
        $ISDirettore='t';
      }else{
        $ISDirettore='f';
      }
      
         $query="INSERT INTO amministratori VALUES('$cf','$nome','$cognome','$ISTiratore','$password')";
         $query_res = pg_query($conn, $query);
         if (!$query_res) {
           echo "Si è verificato un errore nell'inserimento dell'admin.<br/>";
           exit();
         }else{
          if($ISTiratore=='t' || $ISDirettore=='t' ){
            $query="INSERT INTO Tiratori VALUES('$cf','$nome','$cognome','$ISTiratore','$ISDirettore','$password')";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore nell'inserimento del tiratore.<br/>";
              exit();
            }else{
              header('Location:successo.php');
            }
          }
        }
    }
  ?>
    <hr align="left" size="1" width="30%" noshade>

    <h3> Visualizza elenco completo tiratori e direttori di tiro: </h3>
  <form action="Tiratori.php" method="POST">
  &emsp;&emsp;&emsp;&emsp;<input type="submit" name="visualizzaTiratori" value="Visualizza"/><br></br>
  </form>

  <h3> Visualizza calendario completo delle prenotazioni: </h3>
  <form action="CalendarioPrenotazioni.php" method="POST">
  &emsp;&emsp;&emsp;&emsp; <input type="submit" name="visualizzaPrenotazioni" value="Visualizza"/><br></br>
  </form>
  </body>
</html>

 
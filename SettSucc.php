<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Amministrazione</title>
  </head> 

  <!--<body>
    <h3>AMMINISTRATORE: </h3>
  <?php
      /*$strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
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
      }*/
  ?>
  <h3> INSERISCI TIRATORE: </h3>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php echo "<input type='text' name='paziente' value='$paziente' hidden/> " ?>
        <input type="text" name="nome" placeholder="Nome"/>
        <input type="text" name="cognome" placeholder="Cognome"/><br></br>
            é autorizzato a sparare da solo?
            <select name="ISAutorizzato" >
            <option value'Sì' selected=‘selected’>Sì</option>
            <option value'No'>No</option>
            </select><br></br>
            é direttore di tiro?
            <select name="ISDirettore" >
            <option value'Sì'>Sì</option>
            <option value'No' selected=‘selected’>No</option>
            </select><br><br>
        <input type='text' name='Password' value='1234' hidden/> 
        <input type="submit" name="inviaTir" value="Invia"/><br></br>
    </form>
  <?php
    /*if(isset($_POST["inviaTir"])){
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
        $query="INSERT INTO Tiratori VALUES(default,'$nome','$cognome','$ISAutorizato','$ISDirettore','$password')";
          $query_res = pg_query($conn, $query);
          if (!$query_res) {
            echo "Si è verificato un errore in inserimento tiratore.<br/>";
            exit();
          }else{
            header('Location:successo.html');
          }
        }*/
  ?>
  <h3> INSERISCI AMMINISTRATORE: </h3>
    <form action="<?php /*echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php echo "<input type='text' name='paziente' value='$paziente' hidden/> " ?>
        <input type="text" name="ID" placeholder="ID"/>
        <input type="text" name="nome" placeholder="Nome"/>
        <input type="text" name="cognome" placeholder="Cognome"/><br></br>
            é tiratore?
            <select name="ISTiratore" >
            <option value'Sì'>Sì</option>
            <option value'No' selected=‘selected’>No</option>
            </select><br><br>
            é direttore di tiro?
            <select name="ISDirettore" >
            <option value'Sì'>Sì</option>
            <option value'No' selected=‘selected’>No</option>
            </select><br><br>
        <input type='text' name='Password' value='1234' hidden/> 
        <input type="submit" name="inviaAdmn" value="Invia"/><br></br>
    </form>
  <?php
   /* if(isset($_POST["inviaAdmn"])){
      $id=$_POST["ID"];
      echo $nome=$_POST["nome"];
      echo $cognome=$_POST["cognome"];
      $ISTiratore=$_POST["ISTiratore"];
      $ISDirettore=$_POST["ISDirettore"];
      if($ISTiratore==='Sì'){
        $ISTiratore='t';
      }else{
        $ISTiratore='f';
      }
      echo $ISTiratore;
      if($ISDirettore==='Sì'){
        $ISDirettore='t';
      }else{
        $ISDirettore='f';
      }
      echo $ISDirettore;

      echo$password=$_POST["Password"];
       $query="INSERT INTO amministratori VALUES('$id','$nome','$cognome','$ISTiratore','$password')";
         $query_res = pg_query($conn, $query);
         if (!$query_res) {
           echo "Si è verificato un errore nell'inserimento dell'admin.<br/>";
           exit();
         }else{
          if($ISTiratore==='t' || $ISDirettore==='t' ){
            $query="INSERT INTO Tiratori VALUES(default,'$nome','$cognome','$ISTiratore','$ISDirettore','$password')";
            $query_res = pg_query($conn, $query);
            if (!$query_res) {
              echo "Si è verificato un errore nell'inserimento del tiratore.<br/>";
              exit();
            }else{
              header('Location:successo.html');
            }
          }
        }
    }*/
  ?>
    <h3> Visualizza elenco tiratori e direttori di tiro: </h3>
  <form action="Tiratori.php" method="POST">
        <input type="submit" name="visualizzaTiratori" value="Visualizza"/><br></br>
  </form>-->

  <h3>VISUALIZZA PRENOTAZIONI: </h3>
    <?php 

      function getDayName($dayName) {

        switch ($dayName){
            case 0:
                return 'Domenica';  
            case 1:
                return 'Lunedì';
            case 2:
                return 'Martedì';
            case 3:
                return 'Mercoledì';
            case 4:
                return 'Giovedì';
            case 5:
                return 'Venerdì';
            case 6:
                return 'Sabato';
            
            default:
                return '';
        }

      }
      
      function calendario($mese,$anno){
        Global $_GET;
        
        if ($_GET['x'] == NULL){
        $mese_ = $mese;
        $anno_ = $anno;
        }
        else{
        $mese_ = (int)strftime( "%m" ,(int)$_GET['x']);
        $anno_ = (int)strftime( "%Y" ,(int)$_GET['x']);
        }
        
        
        $prev = mktime(0, 0, 0, $mese_ -1, 1,  $anno_);
        
        $next = mktime(0, 0, 0, $mese_ +1, 1,  $anno_);
        
        
        $human_month = array("error", "Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre", "Novembre", "Dicembre" ); 
        
        
        $settimana   = array("Lun", "Mar", "Mer", "Gio", "Ven", "Sab", "Dom"); 
        $colonne     = 7;
        $giorni      = date("t",mktime(0, 0, 0, $mese, 1, $anno));  //giorni del mese in questione
        $primo_lunedi= date("w",mktime(0, 0, 0, $mese, 1, $anno));  //Array_parte da 0
        
        if($primo_lunedi==0){
        $primo_lunedi = 7;  //siamo mica americani
        }
        
        //print("<table width=\"210\" colspacing=\"0\" border=\"0\">"); //table
        print("\n\t<tr height=\"20\" class=\"txtredB\">\n\t\t<td colspan=\"".$colonne."\" align=\"center\"><a href=\"?x=".$prev."\">&lt;&lt;</a> <span class=\"txtwhiteB\">".$human_month[(int)$mese]." ".$anno_."</span> <a href=\"?x=".$next."\">&gt;&gt;</a></td>\n\t</tr><br>"); //mese/anno
        global $i;
        global $cont;
        if(isset($_POST["settimanaSuccessiva"])){
          $i=$_POST["i"];
          $cont=$_POST["cont"];
          $i+=7;
          $cont+=7;
        }

        for($i; $i<$cont && $i<$giorni+$primo_lunedi ; $i++){
            if($i%$colonne+1==0){}
            if($i<$primo_lunedi){}
            else{
              $giorno_= $i-($primo_lunedi-1);
              
              $a = strtotime(date($anno_."-".$mese_."-".$giorno_));
              $oggi=strftime("%d-%m-%Y",$a);
              $dayName = getDayName(date('w', strtotime($oggi)));
  
              echo $dayName.": ";
              print(strftime("%d-%m-%Y",$a));
  
              echo("<br>");
              $b = strtotime(date("Y-m-d"));
              
              if($a != $b){}
              else{}
            }
            if($i%$colonne==0){}
        } 
        
      }
      calendario(date("m"),date("Y"));
      $i-=7;
        
    ?>
   <h3> settimana successiva: </h3>
     <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'>
        <?php echo "<input type='text' name='i' value='$i' hidden/> " ?>
        <?php echo "<input type='text' name='cont' value='$cont' hidden/> " ?>
        <input type='submit' name='settimanaSuccessiva' value='Visualizza'/><br></br>
    </form>
  <h3> <a href="Home.html">Torna alla home</a> </h3>

  </body>
</html>
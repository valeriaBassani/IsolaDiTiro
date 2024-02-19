<!DOCTYPE html>
<html>

  <head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Login</title>
  </head> 

  <?php
      $strconn = "host=localhost port=5432 dbname=IsolaTiro user=postgres password=1234"; 
      $conn = pg_connect($strconn);
      if (!$conn) {
        echo "Connection to DB failed";
        exit();
      }else{
        if(isset($_POST['Ricordami']))
        {
          setcookie('rememberUser',$_POST['cf'],time() +60*60*24*30);
          setcookie('rememberPsw',$_POST['password'],time() +60*60*24*30);
        }

        if (isset($_POST["invia"]))
        {
          session_start(); 
          $_SESSION["Tiratore"]=$_POST["cf"];
          $cf=$_POST["cf"];

          $query="SELECT * FROM amministratori WHERE ID='$cf'";
          $query_res = pg_query($conn, $query);
          while($row = pg_fetch_array($query_res)) {
            $_SESSION['id'] = $row[0];
            header('Location:Amministratore.php');
          }

          $query="SELECT * FROM Tiratori WHERE cf='$cf'";
          $query_res = pg_query($conn, $query);
          while($row = pg_fetch_array($query_res)) {
            $_SESSION["cf"] = $row[0];
            if($row[4]==='t'){
              header('Location:Direttore.php');
              exit();
            }
            header('Location:Tiratore.php');
          }
        }
      }
   ?>

</body>
</html>

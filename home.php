<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="style.css">
      <title>Home</title>
  </head>

<body>
  <header>
    <h2>ISOLA DI TIRO 2.0 </h2>
  </header>

  <section>
  <div class="split2">
    <div>
        <img src="logo.jpeg" alt="Logo" width="250" >
    </div>
    <div>
    <h3>Login: </h3>
    <form action="Login.php" method="post">
    <?php
          if(isset($_COOKIE['remember']))
          {
            echo "&emsp;&emsp;&emsp;&emsp; <input type='text' name='cf' value='$_COOKIE[rememberUser]' placeholder='Cod Fiscale'/><br></br>";
            echo "&emsp;&emsp;&emsp;&emsp; <input type='text' name='password' value='$_COOKIE[rememberPsw]' placeholder='Password'/><br></br>";
          }
          else
          {
            echo "&emsp;&emsp;&emsp;&emsp;<input type='text' name='cf' value='$_COOKIE[rememberUser]' placeholder='Cod Fiscale'/><br></br>";
            echo "&emsp;&emsp;&emsp;&emsp;<input type='text' name='password' value='$_COOKIE[rememberPsw]' placeholder='Password'/><br></br>";
          }
      ?>
      &emsp;&emsp;&emsp;&emsp;<input id="Ricordami" name="Ricordami" id="Ricordami" type="checkbox" checked="checked" value="1"/> ricordami
      &emsp;&emsp;<input type="submit" name="invia" value="Invia"/><br></br>

    </div>
 </section>
 

  </form>
  <hr align='left' size='1' width='40%' noshade>
  <p>Non hai un account? <a href="NoAccount.html">ottieni più informazioni</a>.</p>
  

</body>
</html>
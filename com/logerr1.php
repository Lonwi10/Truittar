<?php
session_start();
//Loguin
$_SESSION["pass"] = '';
$_SESSION["usuario"] = '';
//Registra
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Twittar Aws2</title>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script type="text/javascript">
    alert("Contraseña o usuario mal introducido");
</script>
<FORM action="" method='post' autocomplete='off'>
  <div class="inner-container">
    <div class="box">
      <h1>Login</h1>
      <input type="text" placeholder="Usuario" name="usuario"/>

      <input type="password" placeholder="Contraseña" name="pass"/>

      <button id="mysubmit" type="submit">Loguear</button>

      <p>No eres miembro? <a href="registrar.php"><span>Registrate</span></a></p>
    </div>
  </div>
  </FORM>
   <?php
 

    //Guardar si esta marcado usuario
if(isset($_POST["usuario"]) && isset($_POST["pass"])){
  $_SESSION["usuario"] = $_POST["usuario"];
  $_SESSION["pass"] = $_POST["pass"];

  //acceder bbdd
    try{
        $hostname = "localhost";
        $dbname = "twitter";
        $username = "root";
        $pw = "8wdfacejL";
        $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
    } catch (PDOException $e) {
      echo "Failed to get DB handle: " . $e->getMessage() . "\n";
      exit;
    }

   //consultar usuario
    $q = "SELECT * FROM usuarios  where nomUsuario ="."'".$_SESSION["usuario"]."'";
    $query = $pdo->prepare($q);
    $query->execute();

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
       die("Error accedint a dades: " . $e[2]);
    }
    $row = $query->fetch();

    if($_SESSION["usuario"] == $row["nomUsuario"]){
    $_SESSION["tipo1"] = 1;
  }


 //consultar pasword
  $queryx = $pdo->prepare("SELECT * FROM usuarios  where contrasena ="."'".$_SESSION["pass"]."'");
    $queryx->execute();

    $a= $queryx->errorInfo();
    if ($a[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
       die("Error accedint a dades: " . $a[2]);
    }
    $ros = $queryx->fetch();
  
  if($_SESSION["pass"] == $ros["contrasena"]){
    $_SESSION["tipo2"] = 1;
  }
      


     //redirigir
    if($_SESSION["tipo1"] == 1 && $_SESSION["tipo2"] == 1){
      header("Location: perfil.php");

    }else if($_SESSION["tipo1"] == 1 && $_SESSION["tipo1"] == 0){
      header("Location: logerr1.php");

    }else if($_SESSION["tipo1"] == 0 && $_SESSION["tipo2"] == 1){
      header("Location: logerr1.php");
    }else{
      header("Location: logerr1.php");
    }


  //eliminar archivos
        unset($pdo); 
      unset($query);
      unset($queryx);
}
    ?>
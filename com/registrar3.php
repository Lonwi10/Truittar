<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Twittar Aws2</title>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>
<script type="text/javascript">
    alert("Este usuario ya esta registrado!!!");
</script>
<div align="right"><img src="css/trucha.png"></div> 
<FORM action="" method='post'>
  <div class="inner-container2">
    <div class="box">
      <h1>Registrate</h1>
      <input type="text" placeholder="Usuario" name="regusuario"/>
      <input type="password" placeholder="Contraseña" name="regpass"/>
      <input type="password" placeholder="Repite contraseña" name="repass"/>
      <input type="text" placeholder="Nombre" name="nombre"/>
      <input type="text" placeholder="Apellidos" name="apellido"/>
    </div>
  </div>
  <div class="inner-container3">
    <div class="box">
      <input type="text" placeholder="Email" name="mail"/>
      <input type="text" placeholder="Nacimiento ''dd/mm/aa''" name="nacimiento"/>
      <input type="text" placeholder="Sexo Male/Female" name="sexo"/>
      <input type="text" placeholder="Tlf" name="tlf"/>
      <button>Registrar</button>
      <p>Ya eres miembro? <a href="index.php"><span>Logueate</span></a></p>
    </div>
  </div>
   <?php
    if(isset($_POST["regusuario"]) 
      && isset($_POST["regpass"])
      && isset($_POST["repass"]) 
      && isset($_POST["nombre"]) 
      && isset($_POST["apellido"]) 
      && isset($_POST["mail"]) 
      && isset($_POST["nacimiento"]) 
      && isset($_POST["sexo"]) 
      && isset($_POST["tlf"])){
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
        $query = $pdo->prepare("SELECT * FROM usuarios  where nomUsuario ="."'".$_POST["regusuario"]."'");
        $query->execute();

        $e= $query->errorInfo();
        if ($e[0]!='00000') {
          echo "\nPDO::errorInfo():\n";
           die("Error accedint a dades: " . $e[2]);
        }
        $row = $query->fetch();
        if($_POST["regusuario"] == $row["nomUsuario"]){
        header("Location: registrar3.php");

        }else if($_POST["regpass"] != $_POST["repass"]){
      header("Location: registrar2.php");
      
        }else{
        $quer = $pdo->prepare("INSERT INTO usuarios(nomUsuario,usuario,apellidos,email,tlf,contrasena,nacimiento,sexo) VALUES ("."'".$_POST["regusuario"]."','".$_POST["nombre"]."','".$_POST["apellido"]."','".$_POST["mail"]."','".$_POST["tlf"]."','".$_POST["regpass"]."','".$_POST["nacimiento"]."','".$_POST["sexo"]."'".")");
        $quer->execute();
        $x= $quer->errorInfo();
          if ($x[0]!='00000') {
            echo "\nPDO::errorInfo():\n";
              die("Error accedint a dades: " . $x[2]);
          }
        header("Location: registrar.php");
        }
    }
  ?>
</body>
</html>

<?php
session_start();
//Loguin
$_SESSION["pass"] = '';
$_SESSION["usuario"] = '';
$_SESSION["Id"] = "";

if(isset($_GET["reset"])){
session_destroy();
session_start();
$_SESSION["pass"] = '';
$_SESSION["usuario"] = '';
$_SESSION["Id"] = "";
}
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Twittar Aws2</title>
      <link rel="stylesheet" href="css/style.css">
</head>
<body>

<FORM action="" method='post' >
  <div class="inner-container">
    <div class="box">
      <h1>Login</h1>
      <input type="text" placeholder="Usuario" name="usuario" autocomplete='off'/>

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
    $q = 'SELECT * FROM usuarios  where nomUsuario = :nomUsuario and contrasena = :pass';
    $query = $pdo->prepare($q);
    $query->execute(array(":nomUsuario"=>$_POST["usuario"], ":pass"=>$_POST["pass"]));

    $e= $query->errorInfo();
    if ($e[0]!='00000') {
      echo "\nPDO::errorInfo():\n";
       die("Error accedint a dades: " . $e[2]);
    }
    $row = $query->fetch();

     //redirigir
    if(!empty($_POST["usuario"]) && !empty($_POST["pass"])){
 		if($_POST["usuario"] == $row["nomUsuario"] && $_POST["pass"] == $row["contrasena"]){
 			$_SESSION["usuario"] = $_POST["usuario"];
			$_SESSION["pass"] = $_POST["pass"];
      $_SESSION["Id"] = $row["ID"];
      $_SESSION["nomUsuario"] = $row["usuario"];
      $_SESSION["apellidos"] = $row["apellidos"];

 			header("Location: inicio.php");

 		}else{
 			?>
				<script type="text/javascript">
					alert('Usuario y/o contraseña incorrecta');
				</script>
 			<?php
 		}
 	}

 	//eliminar archivos
        unset($pdo); 
  		unset($query);
}
		?>
</body>
</html>

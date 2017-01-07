

<?php
session_start();

function modDatos($user, $nom, $apell, $pass){
	if(isset($_POST["user"],$_POST["nombre"] ,$_POST["apellidos"], $_POST["contrasena"])){
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
	        $query = $pdo->prepare("UPDATE usuarios SET nomUsuario='".$user."',usuario='".$nom."', apellidos='".$apell."', contrasena='".$pass."' WHERE id=".$_SESSION["Id"]);
	        $query->execute();

	        $e= $query->errorInfo();
	        if ($e[0]!='00000') {
	          echo "\nPDO::errorInfo():\n";
	           die("Error accedint a dades: " . $e[2]);
	        }

	        $_SESSION["usuario"] = $user;
	        $_SESSION["nomUsuario"] = $nom;
	        $_SESSION["apellidos"] = $apell;
	        $_SESSION["pass"] = $pass;

	        $row = $query->fetch();

    }

    else{
    	?>
				<script type="text/javascript">
					alert('Te faltan introducir datos (todos los campos tienen que ser rellenados');
				</script>
 			<?php
    }
}

if(isset($_POST["modificar"])){
	modDatos($_POST["user"],$_POST["nombre"] ,$_POST["apellidos"], $_POST["contrasena"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Truittar </title>
	<link rel="stylesheet" href="css/bootstrap2.css">
  	<link rel="stylesheet" href="css/style3.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>

<nav class="navbar navbar-default" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>    
  </div>
    
  <div class="navbar-collapse collapse">
    
    <ul class="nav navbar-nav navbar-left">
         <li><a href="inicio.php"><span class="glyphicon glyphicon-home"></span>  Inicio</a></li>
         <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Mensajes <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="MRecibidos.php">Recibidos</a></li>
                    <li><a href="MEnviados.php">Enviados</a></li>
                    <li class="divider"></li>
                    <li><a href="MCrear.php">Enviar Mensajes</a></li>
                </ul>
        </li>
    </ul>

    <a class="navbar-brand"><img src="icono.png" width="250" height="45"></a>

    <ul class="nav navbar-nav navbar-right">
		<li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Mi cuenta <b class="caret"></b></a>
                <ul class="dropdown-menu">
               		<li><a href="perfil.php">Perfil</a></li>
                    <li><a href="configuracion.php">Configuración</a></li>
                    <li class="divider"></li>
                    <li><a href="index.php?reset=1">Cerrar sesión</a></li>
                </ul>
		<li>
	        <form class="navbar-form" role="search">
	        	<div class="input-group">
	           	 <input type="text" class="form-control" placeholder="Buscar en truittar" name="srch-term" id="srch-term">
	            <div class="input-group-btn">
	                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            	</div>
       			</div>
       		</form>
	    </li>
	    </li>	
    </ul>

  </div>

</nav>

<form action="almacenar.php" method="POST" enctype="multipart/form-data">

<div class = "imgPerfil">
    <label for="imagen"> 
    <?php
        $compr = "./imagenes/".$_SESSION["Id"];
        if(file_exists($compr))
            echo "<img src='./imagenes/".$_SESSION["Id"]."' border='0' width='200' height='200'>";
        else  
            echo "<img src=unnamed.png border='0' class ='twPc-avatarImg' width='150' height='150'>";
    ?>
    </label>
    <input type="file" name="imagen" id="imagen" />
    <input type="submit" name="subir" value="Subir Imagen"/>
</form>

</div>
<form method="post">
	<div class="cuerpoPerfil">
		<div class="perfilTexto">
			<h3><strong> Usuario </strong></h3>
				<input type="text" name="user" value=<?php echo"'".$_SESSION["usuario"]."'"?> >
			<h3><strong> Nombre </strong></h3>
				<input type="text" name="nombre" value=<?php echo"'".$_SESSION["nomUsuario"]."'"?> >
			<h3><strong> Apellidos </strong></h3>
				<input type="text" name="apellidos" value=<?php echo"'".$_SESSION["apellidos"]."'"?> >
			<h3><strong> Contraseña </strong></h3>
				<input type="password" name="contrasena" value=<?php echo"'".$_SESSION["pass"]."'"?> > 
			<br>
			<div class="modificarDatos">
				<button type="submit" class="postear" name="modificar"> Modificar Datos </button>
			</div>
		</div>
	</div>

</form>
</body>
</html>
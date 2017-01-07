<?php
session_start();
$_SESSION["tipo1"] = 0;
$_SESSION["tipo2"] = 0;

function enviarPubli($id, $publi){
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
        $query = $pdo->prepare("INSERT INTO publicacion(creadorID, descripcion) VALUES (".$id.",'".$publi."')");
        $query->execute();

        $e= $query->errorInfo();
        if ($e[0]!='00000') {
          echo "\nPDO::errorInfo():\n";
           die("Error accedint a dades: " . $e[2]);
        }
        $row = $query->fetch();

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
<div class = "foto">
    

    <div class="container" style="display: table; margin: auto">
    <div class="row">
      <div class="twPc-div">
        <a class="twPc-bg twPc-block"></a>

      <div>
           <a href="#ENLACE A PERFIL USUARIO" class="twPc-avatarLink">
            <?php
              $compr = "./imagenes/".$_SESSION["Id"];

              if(file_exists($compr))
                echo "<img src='./imagenes/".$_SESSION["Id"]."' class ='twPc-avatarImg' border='0' width='100' height='100'>";
              else  
                echo "<img src=unnamed.png border='0' class ='twPc-avatarImg' width='150' height='150'>";
           ?>
           </a>

        <div class="twPc-divUser">
          <div class="twPc-divName">
            <a href="#ENLACE A PERFIL USUARIO"> 
            <?php


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
                  $query = $pdo->prepare("SELECT * FROM usuarios  where nomUsuario ="."'".$_SESSION["usuario"]."'");
                  $query->execute();

                  $e= $query->errorInfo();
                  if ($e[0]!='00000') {
                    echo "\nPDO::errorInfo():\n";
                     die("Error accedint a dades: " . $e[2]);
                  }
                  $row = $query->fetch();

                  $usuario = $row["nomUsuario"];
                  $nombre = $row["usuario"];
                  $apellido = $row["apellidos"];

                  echo "<h4>".$nombre." ".$apellido."</h4>"; ?>
                  </a>
          </div>
          <span>
            <a href="#ENLACE A PERFIL USUARIO"><span><?php echo "<p>@".$usuario."</p>"; ?> </span></a>
          </span>
        </div>

        <div class="twPc-divStats">
          <ul class="twPc-Arrange">
            <li class="twPc-ArrangeSizeFit">
              <a href="#ENLACE A PERFIL USUARIO" title="9.840 Tweet">
                <span class="twPc-StatLabel twPc-block">Truits</span>
                <span class="twPc-StatValue">20</span>
              </a>
            </li>
            <li class="twPc-ArrangeSizeFit">
              <a href="#ENÑACE A LISTADO DE GENTE QUE SIGUES" title="885 Following">
                <span class="twPc-StatLabel twPc-block">Seguidos</span>
                <span class="twPc-StatValue">10</span>
              </a>
            </li>
            <li class="twPc-ArrangeSizeFit">
              <a href="#ENLACE A LISTADO DE GENTE QUE TE SIGUE" title="1.810 Followers">
                <span class="twPc-StatLabel twPc-block">Seguidores</span>
                <span class="twPc-StatValue">25</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
</div>
</div>
</div>

</div>
     <div class="sms"> 
                
      <p> MENSAJES ENVIADOS </p>
        
    </div>
    <?php
          $q = "SELECT * FROM mensajes where emisorId ="."'".$_SESSION["Id"]."'";
          $query = $pdo->prepare($q);
          $query->execute();

          $e= $query->errorInfo();
          if ($e[0]!='00000') {
           echo "\nPDO::errorInfo():\n";
          die("Error accedint a dades: " . $e[2]);
          }
          foreach($query as $row){
          ?>
          <div class = "mens"> 
            <div class="enviados">

                <p><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Enviado a: <?php echo $row["usRem"] ?></p>

                <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Mensaje:  <?php echo $row["mensaje"] ?></p>

                <p><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Fecha:  <?php echo $row["fecha"] ?> </p>
           
           </div>
          </div>
           <?php
          }
            unset($pdo);
            unset($query);
          ?>
   
  </div>	
</body>
</html>
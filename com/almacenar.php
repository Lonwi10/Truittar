<?php
session_start();
// Conexion a la base de datos
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

//comprobamos si ha ocurrido un error
if ($_FILES["imagen"]["error"] > 0){
    echo "Ha ocurrido un error.";
} else {
    //ahora vamos a verificar si el tipo de archivo es un tipo de imagen permitido.
    //y que el tamano del archivo no exceda los 100kb
    $permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
    $limite_kb = 16384;
    if (in_array($_FILES['imagen']['type'], $permitidos) && $_FILES['imagen']['size'] <= $limite_kb * 1024){
        //esta es la ruta donde copiaremos la imagen
        //recuerden que deben crear un directorio con este mismo nombre
        //en el mismo lugar donde se encuentra el archivo subir.php
        $_FILES['imagen']['name'] = $_SESSION["Id"];
        $ruta = "./imagenes/" . $_FILES['imagen']['name'];
        //comprovamos si este archivo existe para no volverlo a copiar.
        //pero si quieren pueden obviar esto si no es necesario.
        //o pueden darle otro nombre para que no sobreescriba el actual.
        $resultado = move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);
	header("Location: inicio.php");
    } else {
        echo "Archivo no permitido, es un tipo de archivo prohibido o excede el tamaño de $limite_kb Kilobytes";
    }
}
?>

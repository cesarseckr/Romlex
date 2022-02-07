<?php 
	require("../../includes/conexioncon.php");

	$id_cliente = $_POST["id_cliente"];
    $apaterno = $_POST["apaterno_mod"];
    $amaterno= $_POST["amaterno_mod"];
    $nombre = $_POST["nombre_mod"];
    $domicilio = $_POST["domicilio_mod"];
    $telefono = $_POST["telefono_mod"];
    $email = $_POST["email_mod"];

    $consulta = mysqli_query($con,"UPDATE clientes SET nombre='$nombre', apaterno='$apaterno', amaterno='$amaterno', telefono='$telefono', domicilio='$domicilio', email='$email' WHERE id_cliente='$id_cliente'");

    if (!$consulta){
  		echo "error al registrar en la base de datos" . mysql_error();
  	}else{
		echo"1";
  	}
 ?>
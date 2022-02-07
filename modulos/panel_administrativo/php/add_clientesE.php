<?php 
	require("../../includes/conexioncon.php");

	  $apaterno = $_POST["apaterno"];
    $amaterno= $_POST["amaterno"];
    $nombre = $_POST["nombre"];
    $domicilio = $_POST["domicilio"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];

    $consulta = mysqli_query($con,"INSERT INTO clientes(nombre, apaterno, amaterno, telefono, domicilio, email) VALUES ('$nombre','$apaterno','$amaterno','$telefono', '$domicilio','$email')");

    if (!$consulta){
  		echo "error al registrar en la base de datos" . mysql_error();
  	}else{
		  echo"1";
  	}

 ?>
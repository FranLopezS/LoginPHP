<?php
function generarCodigo($longitud, $tipo=0){ 
    $codigo = "";
    $caracteres="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $max=strlen($caracteres)-1;
    for($i=0;$i < $longitud;$i++){
        $codigo.=$caracteres[rand(0,$max)];
    }
    return $codigo;
}
$p=generarCodigo(10);
$bandera=false;
$email=strtolower($_REQUEST['email']);
$asunto="Recuperación de contraseña";
$cabeceras="Hola";
$fp=fopen("reg.txt","r");
if(!$fp){
	echo "Problema al consultar los usuarios.";
}
else
{
	while(false!==($cadena=fgets($fp))){
		$lista=explode("#",$cadena);
		for($i=0;$i<sizeof($cadena);$i++){
			if($email==$lista[$i]){
				$bandera=true;
				$i++;
				$password=$lista[$i];
				mail($email,$asunto,$p);
			}
		}
	}
	if(!$bandera==true){
		echo "El email introducido no está registrado.";
	}
	else
	{
		echo "¡El email ha sido enviado al correo $email!<br><br>Introduce el código que se ha enviado al correo para recuperar tu contraseña.";
		echo '<form name="registro" action="recuperacion.php" method ="POST">';
		echo '<center><p>Código de recuperación: <input type="text" name="codrec"/></p>';
		echo "<input type='hidden' name='rec' value='$p'/>";
		echo "<input type='hidden' name='email' value='$email'/>";
		echo '<input type="submit" value="Recuperar contraseña"/></center>';
		echo '</form>';
	}
}
?>
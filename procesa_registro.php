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
$email=strtolower($_REQUEST['email']);
$password=$_REQUEST['password'];
$c=$_REQUEST['c'];
$bandera=false;
$asunto="Activacion de cuenta";
$fp=fopen("reg.txt","r");
if(!$fp){
	echo "Problema al consultar los usuarios.";
}
else
{
	if($c){
		while(false!==($cadena=fgets($fp))){
			$lista=explode("#",$cadena);
			for($i=0;$i<sizeof($cadena);$i++){
				if($email==$lista[$i] && !$bandera){
					$i+=2;
					$codigo=$lista[$i];
					$bandera=true;
				}
				$i++;
			}
		}
		goto a;
	}
	while(false!==($cadena=fgets($fp))){
		$lista=explode("#",$cadena);
		for($i=0;$i<sizeof($cadena);$i++){
			if($email==$lista[$i]){
				//echo "$lista[$i]";
				$bandera=true;
			}
			$i++;
		}
	}
	if($bandera==true){
		echo "El email usado ya está registrado. <a href='registro.php'>Volver atrás</a>";
	}
	else
	{
		$codigo=generarcodigo(6);
		$nusuario=$email."#".$password."#".$codigo."#\r\n";
		$fp=fopen("reg.txt","a");
	    fputs($fp,$nusuario);
        fclose($fp);
		a:
		$codigo1="http://localhost/2Eva/Proyecto1/link.php?c=$codigo O puedes introducir el código de activación en la casilla correspondiente: $codigo";
		mail($email,$asunto,$codigo1);
		echo "Debes abrir en link que se ha enviado a tu correo para activar tu cuenta.<br>";
		/*echo '<form name="registro" action="procesa_activacion.php" method ="POST">';
		echo '<center><p>Código de activación: <input type="text" name="activacion"/></p>';
		echo "<input type='hidden' name='email' value='$email'/>";
		echo "<input type='hidden' name='codigo' value='$codigo'/>";
		echo "<input type='hidden' name='pass' value='$password'/>";
		echo '<input type="submit" value="Activar cuenta"/></center>';
		echo '</form>';*/
		echo "<a href='index.php'>Volver al inicio</a>";
	}
}
?>
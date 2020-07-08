<?php
$bandera=1;
$email=strtolower($_REQUEST['email']);
$password=$_REQUEST['password'];
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
				$i++;
				if($password==$lista[$i]){
					$i++;
					if($lista[$i]=="activado"){
						$bandera=3;
					}
					else
					{
						$bandera=2;
					}
				}
			}
		}
	}
	if($bandera==1){
		echo "Email o contraseña incorrectos. <a href='iniciosesion.php'>Volver atrás</a>";
	}
	if($bandera==2){
		$c=true;
		echo "¡La cuenta no está activada! <a href='iniciosesion.php'>Volver atrás</a><br><br>";
		echo '<form name="registro" action="procesa_registro.php" method ="POST">';
		echo "<input type='hidden' name='email' value='$email'/>";
		echo "<input type='hidden' name='password' value='$password'/>";
		echo "<input type='hidden' name='c' value='$c'/>";
		echo '<input type="submit" value="Activar cuenta"/></center>';
		echo '</form>';
	}
	if($bandera==3){
		echo "¡Has iniciado sesión! <a href='iniciosesion.php'>Volver atrás</a>";
	}
}
?>
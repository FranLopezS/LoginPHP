<?php
$codigo=$_REQUEST['codigo'];
$activacion=$_REQUEST['activacion'];
$email=$_REQUEST['email'];
$pass=$_REQUEST['pass'];
$fp=fopen("reg.txt","r");
$fnew=fopen("regnew.txt","w");
if(!$fp && !$fnew){
	echo "Problema al consultar los usuarios.";
}
else
{
	if($activacion==$codigo){
		while((false !== ($cadena=fgets($fp)))){
			$lista=explode("#",$cadena);
			for($i=0;$i<sizeof($cadena);$i++){
				$i+=2;
				if($codigo!==$lista[$i]){
					fputs($fnew,$cadena);
					$fin=false;
					//echo "$cadena<br>";
				}
				else
				{
					$poner=$email."#".$pass."#activado#\r\n";
					//echo "$poner<br>";
					fputs($fnew,$poner);
					$fin=true;
				}
			}
		}
		fclose($fp);
		fclose($fnew);
		rename("reg.txt","regbak.txt");
		rename("regnew.txt","reg.txt");
		echo "¡Cuenta activada! <a href='index.php'>Volver al inicio</a>";
	}
	else
	{
		echo "El código de activación es maaalo. <a href='procesa_registro.php'>Volver atrás</a>";
	}
}
?>
<?php
$email=$_REQUEST['email'];
$newpass=$_REQUEST['newpass'];
$fp=fopen("reg.txt","r");
$fnew=fopen("regnew.txt","w");
if(!$fp && !$fnew){
	echo "Problema al consultar los usuarios.";
}
else
{
	//$fin=false;
	while((false !== ($cadena=fgets($fp)))){
		$lista=explode("#",$cadena);
		for($i=0;$i<sizeof($cadena);$i++){
			if($email!==$lista[$i]){
				fputs($fnew,$cadena);
				//$fin=false;
			}
			else
			{
				$poner=$lista[$i]."#".$newpass."#activado#\r\n";
				fputs($fnew,$poner);
				//$fin=true;
			}
		}
	}
	fclose($fp);
	fclose($fnew);
	rename("reg.txt","regbak.txt");
	rename("regnew.txt","reg.txt");
	echo "¡Contraseña cambiada! <a href='index.php'>Volver al inicio</a>";
}
?>
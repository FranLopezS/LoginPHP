<?php
$cod=$_REQUEST['c'];
$fp=fopen("reg.txt","r");
$fnew=fopen("regnew.txt","w");
if(!$fp && !$fnew){
	echo "Problema al consultar los usuarios.";
}
else
{
		while((false !== ($cadena=fgets($fp)))){
			$lista=explode("#",$cadena);
			for($i=0;$i<sizeof($cadena);$i++){
				$i+=2;
				if($cod!==$lista[$i]){
					fputs($fnew,$cadena);
					//echo "$cadena<br>";
				}
				else
				{
					$i-=2;
					$email=$lista[$i];
					$i++;
					$pass=$lista[$i];
					$i++;
					$poner=$email."#".$pass."#activado#\r\n";
					//echo "$poner<br>";
					fputs($fnew,$poner);
				}
			}
		}
		fclose($fp);
		fclose($fnew);
		rename("reg.txt","regbak.txt");
		rename("regnew.txt","reg.txt");
		echo "¡Cuenta activada! <a href='index.php'>Volver al inicio</a>";
}
?>
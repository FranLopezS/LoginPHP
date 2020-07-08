<?php
$cr=$_REQUEST['codrec'];
$bueno=$_REQUEST['rec'];
$email=$_REQUEST['email'];
if($bueno==$cr){
	echo '<form name="registro" action="procesa_recuperacion.php" method ="POST">';
	echo '<center><p>Nueva contraseña: <input type="text" name="newpass"/></p>';
	echo "<input type='hidden' name='email' value='$email'/>";
	echo '<input type="submit" value="Recuperar contraseña"/></center>';
	echo '</form>';
}
else
{
	echo "El código de activación es maaalo.";
}
?>
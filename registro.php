<html>
	<body>
		<h2><center>Registro</center></h2>
		<?php
			$c=false;
			echo '<form name="registro" action="procesa_registro.php" method ="POST">';
				echo '<center><p>Email: <input type="text" name="email"/></p>';
				echo '<p>Contraseña: <input type="text" name="password"/></p>';
				echo "<input type='hidden' name='c' value='$c'/>";
				echo '<input type="submit" value="Registrar"/></center>';
			echo '</form>';
			echo "<center><a href='index.php'>Volver atrás</a></center>";
		?>
	</body>
</html>
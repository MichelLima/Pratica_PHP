<?php
	include_once("_Layout1.php");
	
	if (isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
?>
	<form action="usuario_validar_login.php" method="post">
		<table border="1">
			<tr>
				<td>Login:</td>
				<td><input type="text" name="login"></td>
			</tr>
			<tr>
				<td>Senha:</td>
				<td><input type="password" name="senha"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" value="Ok" name="ok">
					<input type="submit" value="Cancelar" name="Cancel">
				</td>
			</tr>
		</table>
		
	</form>	
	
<?php include_once("_Layout2.php"); ?>
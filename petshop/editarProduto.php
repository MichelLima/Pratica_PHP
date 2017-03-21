
<?php 
	require_once("autenticacao.php");
	require_once("bancodados.php");
	if (isset($_GET["id"])) 
		$id = $_GET["id"];
	else

		$id = -1;
		$id = mysql_real_escape_string($id);
		$sql = "select * from produto where id = $id";
		$consulta = mysql_query($sql);
	if ($linha = mysql_fetch_array($consulta)){

		$codigo = $linha["codigo"];
		$desc = $linha["descricao"];
		$valor = $linha["valor"];
		$disp = $linha["disponibilidade"];
	}else{
		
		header("Location: Index.php");
		die("");

	}
	
		mysql_free_result($consulta);

		if(!isset($_SESSION["acesso"]) || trim($_SESSION["acesso"]) != "ADM" ){

		header("Location: index.php");
		die();
		}

		require_once("_Layout1.php");
 ?>

 	<form action="EditarProd.php" method="post">
 		
 	<input type="hidden" name="id" value="<?php echo $id; ?>">
 		<table border="1">
			<tr>
				<td>Codigo:</td>
				<td><input type="text" name="codigo" value="<?php echo $codigo; ?>"></td>
			</tr>
			<tr>
				<td>Descrição:</td>
				<td><input type="text" name="desc" value="<?php echo $desc; ?>"></td>
			</tr>
			<tr>
				<td>Valor:</td>
				<td><input type="text" name="valor" value="<?php echo $valor; ?>"></td>
			</tr>
			<tr>
				<td>Disponibilidade:</td>
				<td><input type="text" name="disp" value="<?php echo $disp; ?>"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="salvar" value="Salvar">
					<input type="submit" name="cancelar" value="Cancelar">
				</td>
			</tr>
		</table>
 	</form>

 	<?php 
 	require_once("_Layout2.php");
 	 ?>

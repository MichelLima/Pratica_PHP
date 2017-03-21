<?PHP
	require_once("autenticacao.php");
	require_once("RepositorioCliente.php");
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
		die();
	}
	
	$consulta = BuscarClienteIdUsuario($_SESSION["id"]);
	
	if($linha = mysql_fetch_array($consulta)){
		$id = $linha["id"];
		header("Location: cliente_show.php?id=$id");
		die();
	}
	
	include_once("_Layout1.php");

	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
?>	
	<form action="cliente_novo_salvar.php" method="post">
		<input type="hidden" name="id_usuario" value="<?php echo $_SESSION["id"]; ?>">
		<table border="1">
			<tr>
				<td>Nome:</td>
				<td><input type="text" name="nome"></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td><input type="text" name="cpf"></td>
			</tr>
			<tr>
				<td>Endereço:</td>
				<td><input type="text" name="endereco"></td>
			</tr>
			<tr>
				<td>E-Mail:</td>
				<td><input type="text" name="email"></td>
			</tr>
			<tr>
				<td>Fone:</td>
				<td><input type="text" name="fone"></td>
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

<?php include_once("_Layout2.php"); ?>
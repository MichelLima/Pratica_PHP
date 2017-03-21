<?php
	require_once("autenticacao.php");
	require_once("RepositorioCliente.php");
	
	if(!isset($_SESSION["user"]) || $_SESSION["acesso"] != "ADM"){
		header("Location: index.php");
		die("");
	}
	
	$id = $_GET["id"];
	
	$consulta = BuscarClienteId($id);
	
	if ($linha = mysql_fetch_array($consulta)) {
		$nome = $linha["nome"];
		$cpf = $linha["cpf"];
		$endereco = $linha["endereco"];
		$email = $linha["email"];
		$fone = $linha["fone"];
		$id_usuario = $linha["id_usuario"];
		$n_reserva = $linha["n_reserva"];
		$n_animal = $linha["n_animal"];
	} 
	else {
		$erro = "Erro ao consltar os dados do cliente.";
		header("Location: index.php?erro=$erro");
		die("");
	}
	
	if($n_reserva > 0 || $n_animal > 0){
		$atencao = "Atenção, existe animais e/ou reservas viculados a esta cliente.<br>";
	}
	
	include_once("_Layout1.php");
	
	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
?>
	<form action="cliente_excluir_confirmar.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<h5><?php if(isset($atencao)) echo $atencao; ?>Deseja realmente excluir este cliente ?</h5><br>
		<table border="1">
			<tr>
				<td>Nome:</td>
				<td><?php echo $nome; ?></td>
			</tr>
			<tr>
				<td>CPF:</td>
				<td>
					<?php echo $cpf; ?>
				</td>
			</tr>
			<tr>
				<td>Nº Animais:</td>
				<td>
					<?php echo $n_animal; ?>
				</td>
			</tr>
			<tr>
				<td>Nº Reservas:</td>
				<td>
					<?php echo $n_reserva; ?>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="submit" name="sim" value="Sim">
					<input type="submit" name="nao" value="Nao">
				</td>
			</tr>
		</table>
	</form>	
<?php include_once("_Layout2.php"); ?>
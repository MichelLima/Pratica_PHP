<?php
	require_once("autenticacao.php");
	require_once("RepositorioCliente.php");
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
		die("");
	}
	
	$id = $_GET["id"];
	
	$consulta = BuscarClienteId($id);
	
	if ($linha = mysql_fetch_array($consulta)) {
		$nome = trim($linha["nome"]);
		$cpf = trim($linha["cpf"]);
		$endereco = trim($linha["endereco"]);
		$email = trim($linha["email"]);
		$fone = trim($linha["fone"]);
		$id_usuario = $linha["id_usuario"];
		$n_reserva = $linha["n_reserva"];
		$n_animal = $linha["n_animal"];
	} 
	else {
		$erro = "Erro ao consultar os dados do cliente.";
		header("Location: index.php?erro=$erro");
		die("");
	}
	
	if($id_usuario != $_SESSION["id"] && $_SESSION["acesso"] == "CLI"){
		$erro = "Usuario Não autorizado.";
		header("Location: index.php?erro=$erro");
		die("");
	}
	
	include_once("_Layout1.php");
	
	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
?>
	<h5>Dados do cliente <?php echo $nome; ?></h5><br>
	<table border="1">
		<tr>
			<td>Nome:</td>
			<td><?php echo $nome; ?></td>
			<td>Nº Reservas:</td>
			<td><?php echo $n_reserva; ?></td>
		</tr>
		<tr>
			<td>CPF:</td>
			<td><?php echo $cpf; ?></td>
			<td>Nº Animal:</td>
			<td><?php echo $n_animal; ?></td>
		</tr>
		<tr>
			<td>Endereço:</td>
			<td><?php echo $endereco; ?></td>
		</tr>
		<tr>
			<td>E-Mail:</td>
			<td><?php echo $email; ?></td>
		</tr>
		<tr>
			<td>Fone:</td>
			<td><?php echo $fone; ?></td>
		</tr>
		
	</table>
<?php include_once("_Layout2.php"); ?>
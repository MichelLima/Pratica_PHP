<?php
	require_once("autenticacao.php");
	require_once("RepositorioProduto.php");
	
	if(!isset($_SESSION["user"]) || $_SESSION["acesso"] != "ADM"){
		header("Location: index.php");
		die("");
	}
	
	$id = $_GET["id"];
	
	$consulta = BuscarProdutoId($id);
	
	if ($linha = mysql_fetch_array($consulta)) {
		$desc = $linha["descricao"];
		$valor = $linha["valor"];
		$disp = $linha["disponibilidade"];
		$codigo = $linha["codigo"];
	} 
	else {
		$erro = "Erro ao consltar os dados do Produto.";
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
	<form action="excluirProd.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<h5>Deseja realmente excluir este Produto ?</h5><br>
		<table border="1">
			<tr>
				<td>Codigo:</td>
				<td><?php echo $codigo; ?></td>
			</tr>
			<tr>
				<td>Descrição:</td>
				<td>
					<?php echo $desc; ?>
				</td>
			</tr>
			<tr>
				<td>Valor:</td>
				<td>
					<?php echo $valor; ?>
				</td>
			</tr>
			<tr>
				<td>Disponibilidade</td>
				<td>
					<?php echo $disp; ?>
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
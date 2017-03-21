<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioUsuario.php");
	
	if(!isset($_SESSION["user"]) || $_SESSION["acesso"] != "ADM"){
		header("Location: index.php");
		die("");
	}
	
	$id = $_GET["id"];
	
	$consulta = BuscarUsuarioId($id);
	
	if ($linha = mysql_fetch_array($consulta)) {
		$login = $linha["login"];
		$senha = $linha["senha"];
		$acesso = $linha["nivel"];
	} 
	else {
		$erro = "Erro ao consltar o usuario.";
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
	<form action="usuario_excluir_confirmar.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<h5>Deseja realmente excluir este usuário ?</h5><br>
		<table border="1">
			<tr>
				<td>Login:</td>
				<td><?php echo $login; ?></td>
			</tr>
			<tr>
				<td>Nível de Acesso:</td>
				<td>
					<?php 
						if($acesso == "ADM") echo "Administrador";
						else if($acesso == "FUNC") echo "Funcionario"; 
						else if($acesso == "CLI") echo "Cliente"; 
					?>
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
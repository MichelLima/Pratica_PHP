<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioUsuario.php");
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
		die("");
	}
	
	if (isset($_GET["id"]) && $_SESSION["acesso"] == "ADM")
		$id = $_GET["id"];
	else
		$id = $_SESSION["id"];
		
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
	<form action="usuario_editar_salvar.php" method="post">
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<table border="1">
			<tr>
				<td>Login:</td>
				<td><input type="text" name="login" value="<?php echo $login; ?>"></td>
				<?php if($_SESSION["acesso"] == "ADM"){ ?>
				<td>Nível de Acesso</td>
				<td>
					<select name="acesso" size="1" >
						<option <?php if($acesso == "ADM") echo "selected"; ?> value="ADM" >Administrador</option>
						<option <?php if($acesso == "FUNC") echo "selected"; ?> value="FUNC" >Funcionario</option>
						<option <?php if($acesso == "CLI") echo "selected"; ?> value="CLI" >Cliente</option>
					</select>
				</td>
				<?php } ?>
			</tr>
			<?php if($_SESSION["id"] == $id){ ?>
			<tr>
				<td>Senha:</td>
				<td><input type="password" name="senha" value=""></td>
			</tr>
			<?php } ?>
			<tr>
				<td>Nova Senha:</td>
				<td><input type="password" name="nova_senha" value=""></td>
			</tr>
			<tr>
				<td>Confirmar Nova Senha:</td>
				<td><input type="password" name="conf_nova_senha" value=""></td>
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
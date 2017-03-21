<?PHP
	require_once("autenticacao.php");
		
	if(isset($_SESSION["user"])){
		if(trim($_SESSION["acesso"]) != "ADM"){
			header("Location: index.php");
		}
	}
	include_once("_Layout1.php");

	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
?>	
	<form action="usuario_novo_salvar.php" method="post">
		<table border="1">
			<tr>
				<td>Login:</td>
				<td><input type="text" name="login"></td>
				<?php if(isset($_SESSION["acesso"]) && $_SESSION["acesso"] == "ADM"){ ?>
				<td>Nível de Acesso</td>
				<td>
					<select name="acesso" size="1" >
						<option value="ADM" >Administrador</option>
						<option value="FUNC" >Funcionario</option>
						<option selected value="CLI" >Cliente</option>
					</select>
				</td>
				<?php } ?>
			</tr>
			<tr>
				<td>Senha:</td>
				<td><input type="password" name="senha"></td>
			</tr>
			<tr>
				<td>Confirmar Senha:</td>
				<td><input type="password" name="confirmar_senha"></td>
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
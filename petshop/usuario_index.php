<?PHP
	require_once("RepositorioUsuario.php");
	require_once("autenticacao.php");
		
	//ADM, FUNC, CLI
	if(trim($_SESSION["acesso"]) != "ADM"){
		
		$idAux = $_SESSION["id"];
		header("Location: usuario_editar.php?id=$idAux");
		die();
		
	}
	
	include_once("_Layout1.php");
	
	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
	
	$consulta = TodosUsuario("id");

?>
<table border="1">
	<tr>
		<td>Login</td><td>Acesso</td><td>&nbsp;</td>
	</tr>
	<tr>
		<td>
			<?php 
			$id = $_SESSION["id"];
			$login = $_SESSION["user"];
			echo "<a href=usuario_editar.php?id=$id>$login</a>"; 
			?>
		</td>
		<td>
			<?php echo $_SESSION["acesso"] ?>
		</td>
		<td>&nbsp;</td>
	</tr>
<?php
	while ($linha = mysql_fetch_array($consulta)){
		$id = $linha["id"];
		$login = $linha["login"];
		$acesso = trim($linha["nivel"]);
		
		if($id != $_SESSION["id"]){
			$texto = "
			<tr>
			<td>
			<a href=usuario_editar.php?id=$id>$login</a>
			</td>
			<td>
			$acesso
			</td>";
			if($acesso != "ADM"){
				$texto = $texto."<td>
				<a href=usuario_excluir.php?id=$id><img src=\"Images/delete.png\"></a>
				</td>";
			}
			$texto = $texto."</tr>";
			echo $texto;
		}
	}
?>
</table><br>
<a href=usuario_novo.php>Clique aqui para cadastrar um novo usuário</a>

<?php include_once("_Layout2.php") ?>
<?PHP
	require_once("RepositorioCliente.php");
	require_once("autenticacao.php");
	
	//ADM, FUNC, CLI
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
		die();
	}else if(trim($_SESSION["acesso"]) == "CLI"){
		$idAux = $_SESSION["id"];
		header("Location: cliente_novo.php?id=$idAux");
		die();
	}
	
	include_once("_Layout1.php");
	
	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
	
	$consulta = TodosCliente("nome");

?>
<table border="1">
	<tr>
		<td>Nome</td><td>CPF</td><td>&nbsp;</td>
	</tr>
<?php
	while ($linha = mysql_fetch_array($consulta)){
		$id = $linha["id"];
		$nome = $linha["nome"];
		$cpf = trim($linha["cpf"]);
		
		$texto = "
		<tr>
		<td>
		<a href=cliente_show.php?id=$id>$nome</a>
		</td>
		<td>
		$cpf
		</td>";
		if(trim($_SESSION["acesso"]) == "ADM"){
			$texto = $texto."<td>
			<a href=cliente_excluir.php?id=$id><img src=\"Images/delete.png\"></a>
			</td>";
		}
		$texto = $texto."</tr>";
		echo $texto;
		
	}
?>
</table><br>

<?php include_once("_Layout2.php") ?>
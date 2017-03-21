<?php include_once("_Layout1.php"); 
	

	if(isset($_GET["erro"])) {
		echo $_GET["erro"];
	}
	else if(isset($_GET["sucesso"])){
		echo $_GET["sucesso"];
	}
	require_once("bancodados.php");
	require_once("autenticacao.php");


 ?>
 <head>
		<meta charset="utf-8" />
		<title>consultar Produto</title>
	</head>
<?php 

	$sql ="select * from produto";
	$consulta = mysql_query($sql);
 ?>

 <table border="1" cellspacing="5" cellpadding="5" class="table">
 	<h2> Lista de Produtos</h2>
 <tr>
 	<td>Codigo</td>
  
 	<td>Descrição</td>
 
 	<td>Valor</td>
 
 	<td>Disponibilidade</td>
 </tr>
 <?php 

 	while ($linha = mysql_fetch_array($consulta)) {
 		
 		$id = $linha["id"];
 		$codigo = $linha["codigo"];
 		$desc = $linha["descricao"];
 		$valor = $linha["valor"];
 		$disp= $linha["disponibilidade"];
 		$texto = "
 			<tr>
 				<td>
 					$codigo
 				</td>
 				<td>
 					$desc
 				</td>
 				<td>
 					$valor
 				</td>
 				<td>
 					$disp
 				</td>";
		if(isset($_SESSION["acesso"]) && trim($_SESSION["acesso"]) == "ADM" ){
 			$texto = $texto."<td>
 					<a href=editarProduto.php?id=$id>Editar</a>
 				</td>
 				<td>
 					<a href=excluirProduto.php?id=$id>Excluir</a>
 				</td>";
 		}
 			$texto = $texto."</tr>";
 		echo $texto;	

 	}
 	mysql_free_result($consulta);

  ?>
 </table>
 <?php 
if(isset($_SESSION["acesso"]) && trim($_SESSION["acesso"]) == "ADM" ){

  ?>

<a href="CadastroProduto.php">Cadastrar Novo Produto</a>

<?php 
}
include_once("_Layout2.php"); ?>
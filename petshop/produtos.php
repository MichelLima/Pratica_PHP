<?php 
	include_once "bancodados.php"
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
 				</td>
 				<td>
 					<a href=EditarProduto.php?id=$id>Editar</a>
 				</td>
 				<td>
 					<a href=ExcluirProduto.php?id=$id>Excluir</a>
 				</td>
 			</tr>";
 		echo $texto;	

 	}
 	mysql_free_result($consulta);

  ?>





 </table>



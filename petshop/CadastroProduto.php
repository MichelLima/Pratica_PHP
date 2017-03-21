
<?php 
require_once ("autenticacao.php");

if(!isset($_SESSION["acesso"]) || trim($_SESSION["acesso"]) != "ADM" ){

header("Location: index.php");
die();

}
require_once("_Layout1.php");
 ?>

<form action="InserirProduto.php" method="POST" class="forms">
	
	<h2>Cadastro de Produtos</h2>
	Codigo Produto<input type="text" name="codigo"><br>
	Descrição<input type="textarea" name="desc"><br>
	valor<input type="text" name="valor"><br>
	Disponibilidade<input type="text" name="disp" ><br>
	
	<input type="submit" value="Cadastrar">
	<input type="submit" value="Cancelar">

</form>
<?php 

require_once("_Layout1.php");
 ?>
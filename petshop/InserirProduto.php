<?php 

	$codigo        = $_POST["codigo"];
	$descricao     = $_POST["desc"];
	$valor         = $_POST["valor"];
	$disponibilidade = $_POST["disp"];
	
	$sql = "insert into petshop.produto(descricao, codigo, valor, disponibilidade) values	
	('$descricao', '$codigo', '$valor', '$disponibilidade')";

	$bd = mysql_connect("localhost", "root", "adm");
	$Resultado = mysql_query($sql);
	mysql_close();

	if ($Resultado) {

		$sucesso="Produto cadastrado com sucesso!";
		header("Location: index.php?sucesso=$sucesso");
	}else{

		$erro="Produto não cadastrado";
		header("Location: index.php?erro=$erro");
		
	}

	
	

 ?>
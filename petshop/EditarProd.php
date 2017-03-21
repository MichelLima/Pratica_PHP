<?php 


if (isset($_POST["id"]) && isset($_POST["codigo"]) && isset($_POST["desc"]) 
&& isset($_POST["valor"]) && isset($_POST["disp"]) && isset($_POST["salvar"])
|| isset($_POST["cancelar"])) {
	
	if(isset($_POST["cancelar"])){

		header("Location: Index.php");
	}else{

		require("bancodados.php");
		$id = $_POST["id"];
		$codigo = $_POST["codigo"];
		$desc = $_POST["desc"];
		$valor = $_POST["valor"];
		$disp = $_POST["disp"];
		
		$id = mysql_real_escape_string($id);
		$codigo = mysql_real_escape_string($codigo);
		$desc = mysql_real_escape_string($desc);
		$valor = mysql_real_escape_string($valor);
		$disp = mysql_real_escape_string($disp);

		$sql = "update produto set codigo = '$codigo', descricao = '$desc', valor = '$valor',
				disponibilidade = '$disp' where id = $id ";

		$resposta = @mysql_query($sql);
		
		if($resposta){

			$sucesso="Produto editado com sucesso";
			header("Location: index.php?sucesso=$sucesso");
			

		}else{
			$erro="O produto não foi editado";
			header("Location: index.php?erro=$erro");
		}		
	}
}
	else{
	$erro="fudeu negão!!";
	header("Location: index.php?erro=$erro");
		
	}

 ?>
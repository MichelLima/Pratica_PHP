<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioCliente.php");
	
	if(!isset($_SESSION["user"]) || (trim($_SESSION["acesso"]) != "ADM" && trim($_SESSION["acesso"]) != "FUNC") ){
		header("Location: index.php");
		die();
	}
	
	if (isset($_POST["id"]) &&
		 (isset($_POST["sim"]) || isset($_POST["nao"])) 
		)
	{
		if (isset($_POST["nao"])) {
			header("Location: cliente_index.php");
			die();
		}
		else {
			$id = trim($_POST["id"]);
			
			$resposta = DeletarCliente($id);
			
			if ($resposta) {
				$sucesso = "cliente excluido com sucesso !!";
				header("Location: cliente_index.php?sucesso=$sucesso");
				die();
			} else {
				$erro = "Erro ao excluir o cliente.";
				header("Location: cliente_index.php?erro=$erro");
			}
		}
	}
	else {
		header("Location: index.php");
	}
?>
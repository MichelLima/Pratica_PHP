<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioProduto.php");
	
	if(!isset($_SESSION["user"]) || trim($_SESSION["acesso"]) != "ADM"){
		header("Location: index.php");
		die();
	}
	
	if (isset($_POST["id"]) &&
		 (isset($_POST["sim"]) || isset($_POST["nao"])) 
		)
	{
		if (isset($_POST["nao"])) {
			header("Location: index.php");
			die();
		}
		else {
			$id = trim($_POST["id"]);
			
			$resposta = DeletarProduto($id);
			
			if ($resposta) {
				$sucesso = "Produto excluido com sucesso !!";
				header("Location: index.php?sucesso=$sucesso");
				die();
			} else {
				$erro = "Erro ao excluir o Produto.";
				header("Location: index.php?erro=$erro");
			}
		}
	}
	else {
		header("Location: index.php");
	}
?>
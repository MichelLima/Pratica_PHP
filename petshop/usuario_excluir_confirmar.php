<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioUsuario.php");

	if (isset($_POST["id"]) &&
		 (isset($_POST["sim"]) || isset($_POST["nao"])) 
		)
	{
		if (isset($_POST["nao"])) {
			header("Location: usuario_index.php");
			die();
		}
		else {
			$id = trim($_POST["id"]);
			
			$resposta = DeletarUsuario($id);
			
			if ($resposta) {
				$sucesso = "usuario excluido com sucesso !!";
				header("Location: usuario_index.php?sucesso=$sucesso");
				die();
			} else {
				$erro = "Erro aoexcluir o usuario.";
				header("Location: usuario_index.php?erro=$erro");
			}
		}
	}
	else {
		header("Location: index.php");
	}
?>
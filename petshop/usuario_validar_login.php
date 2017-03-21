<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioUsuario.php");

	if (isset($_POST["login"]) && isset($_POST["senha"]) &&
		 (isset($_POST["ok"]) || isset($_POST["cancel"])) 
		)
	{
		if (isset($_POST["cancel"])) {
			//echo "cancel";
			//die();
			header("Location: index.php");
		}
		else {
			$login = trim($_POST["login"]);
			$senha = trim($_POST["senha"]);
			
			//echo $login." ".$senha;
			//die();
			
			$resposta = BuscarUsuarioLoginSenha($login, $senha);
			
			if ($linha = mysql_fetch_array($resposta)) {
				$id = $linha["id"];
				$login = $linha["login"];
				$acesso = $linha["nivel"];
				GravarSession(trim($id), trim($login), trim($acesso));
				
				header("Location: index.php");
			} else {
				DestroirSession();
				$erro = "usuario e/ou senha incorreto.";
				header("Location: usuario_login.php?erro=$erro");
			}
		}
	}
	else {
		//echo "else principal";
		//die();
		header("Location: index.php");
	}
?>
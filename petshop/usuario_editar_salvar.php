<?php
	require_once("bancodados.php");
	require_once("autenticacao.php");
	require_once("RepositorioUsuario.php");
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
		die();
	}
	
	if($_SESSION["acesso"] == "ADM"){
		if (isset($_POST["id"]) && isset($_POST["login"]) && isset($_POST["acesso"]) &&
			isset($_POST["nova_senha"]) && isset($_POST["conf_nova_senha"]) &&
			(isset($_POST["salvar"]) || isset($_POST["cancel"])) 
			)
		{
		
			if (isset($_POST["cancel"])) {
				header("Location: index.php");
				die();
			}
			else {
				$id = trim($_POST["id"]);
				$login = trim($_POST["login"]);
				//$senha = trim($_POST["senha"]);
				$nova_senha = trim($_POST["nova_senha"]);
				$conf_nova_senha = trim($_POST["conf_nova_senha"]);
				$acesso = trim($_POST["acesso"]);
				
				if(strlen($login) < 6){
					$erro = "login tem que ter no mínimo 6 caracteres.";
					header("Location: usuario_editar.php?id=$id&erro=$erro");
				}else if (strlen($nova_senha) < 6){
					$erro = "nova senha tem que ter no mínimo 6 caracteres.";
					header("Location: usuario_editar.php?id=$id&erro=$erro");
				}else if($nova_senha != $conf_nova_senha){
					$erro = "a senha não confere com a confirmação.";
					header("Location: usuario_editar.php?id=$id&erro=$erro");
				}else{
					//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
					$consulta = BuscarUsuarioLogin($login);
					
					if($linha = mysql_fetch_array($consulta)){
						$erro = "O login $login já existe.";
						header("Location: usuario_editar.php?id=$id&erro=$erro");
						die();
					}else{
						
						if($id == $_SESSION["id"]) {
							$consulta = BuscarUsuarioId($id);
					
							if ($linha = mysql_fetch_array($consulta)) {
								
								$senha = trim($_POST["senha"]);
								$antiga_senha = $linha["senha"];
								
								if($antiga_senha != $senha){
									$erro = "Senha Incorreta.";
									header("Location: usuario_editar.php?id=$id&erro=$erro");
									die();
								}
								
								$resposta = AlterarUsuario($id, $login, $nova_senha, $acesso);
							
								if ($resposta) {
										
									GravarSession($id, $login, $acesso);
										
									$sucesso = "Dados alterados com sucesso !!";
									header("Location: index.php?sucesso=$sucesso");
									
								} else {
									$erro = "Erro ao alterar o usuario $login.";
									header("Location: usuario_editar.php?id=$id&erro=$erro");
								}
							}
						}else{
						
							$resposta = AlterarUsuario($id, $login, $nova_senha, $acesso);
							
							if ($resposta) {
									
								$sucesso = "Dados alterados com sucesso !!";
								header("Location: usuario_index.php?sucesso=$sucesso");
								
							} else {
								$erro = "Erro ao alterar o usuario $login.";
								header("Location: usuario_editar.php?id=$id&erro=$erro");
							}
						}
					}
				}
			}
		}
		else {
			header("Location: index.php");
		}
		
	}else{
		
		if (isset($_POST["id"]) && isset($_POST["login"]) && isset($_POST["senha"]) &&
			isset($_POST["nova_senha"]) && isset($_POST["conf_nova_senha"]) &&
			(isset($_POST["salvar"]) || isset($_POST["cancel"])) 
			)
		{
		
			if (isset($_POST["cancel"])) {
				header("Location: index.php");
				die();
			}
			else {
				$id = trim($_POST["id"]);
				$login = trim($_POST["login"]);
				$senha = trim($_POST["senha"]);
				$nova_senha = trim($_POST["nova_senha"]);
				$conf_nova_senha = trim($_POST["conf_nova_senha"]);
				$acesso = trim($_SESSION["acesso"]);
				
				if(strlen($login) < 6){
					$erro = "login tem que ter no mínimo 6 caracteres.";
					header("Location: usuario_editar.php?erro=$erro");
				}else if (strlen($nova_senha) < 6){
					$erro = "nova senha tem que ter no mínimo 6 caracteres.";
					header("Location: usuario_editar.php?erro=$erro");
				}else if($nova_senha != $conf_nova_senha){
					$erro = "a senha não confere com a confirmação.";
					header("Location: usuario_editar.php?erro=$erro");
				}else{
					//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
					$consulta = BuscarUsuarioLogin($login);
					
					if($linha = mysql_fetch_array($consulta)){
						$erro = "O login $login já existe.";
						header("Location: usuario_editar.php?erro=$erro");
						die();
					}else{
					
						$consulta = BuscarUsuarioId($id);
				
						if ($linha = mysql_fetch_array($consulta)) {
							
							$antiga_senha = $linha["senha"];
							
							if($antiga_senha != $senha){
								$erro = "Senha Incorreta.";
								header("Location: usuario_editar.php?erro=$erro");
								die();
							}
							
							$resposta = AlterarUsuario($id, $login, $nova_senha, $acesso);
						
							if ($resposta) {
									
								GravarSession($id, $login, $acesso);
									
								$sucesso = "Dados alterados com sucesso !!";
								header("Location: index.php?sucesso=$sucesso");
								
							} else {
								$erro = "Erro ao alterar o usuario $login.";
								header("Location: usuario_editar.php?erro=$erro");
							}
						}else {
							$erro = "Falha ao tentar confirmar a senha.";
							header("Location: usuario_editar.php?erro=$erro");
						}						
					}
				}
			}
		}
		else {
			header("Location: index.php");
		}
	}
?>
<?php
	require_once("bancodados.php");
	require_once("RepositorioUsuario.php");
	require_once("autenticacao.php");
		
	if(isset($_SESSION["user"])){
		if(trim($_SESSION["acesso"]) != "ADM"){
			header("Location: index.php");
		}
	}
	
	if (isset($_POST["login"]) && isset($_POST["senha"]) && isset($_POST["confirmar_senha"]) &&
		 (isset($_POST["salvar"]) || isset($_POST["cancelar"])) 
		)
	{
		if (isset($_POST["Cancelar"])) {
			header("Location: index.php");
		}
		else {
			
			$login = trim($_POST["login"]);
			$senha = trim($_POST["senha"]);
			$con_senha = trim($_POST["confirmar_senha"]);
			
			if(strlen($login) < 6){
				$erro = "login tem que no mínimo 6 caracteres.";
				header("Location: usuario_novo.php?erro=$erro");
			}else if (strlen($senha) < 6){
				$erro = "senha tem que no mínimo 6 caracteres.";
				header("Location: usuario_novo.php?erro=$erro");
			}else if($senha != $con_senha){
				$erro = "a senha não confere com a confirmação.";
				header("Location: usuario_novo.php?erro=$erro");
			}else{
				//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
				$consulta = BuscarUsuarioLogin($login);
				
				if($linha = mysql_fetch_array($consulta)){
					$erro = "O login $login já existe.";
					header("Location: usuario_novo.php?erro=$erro");
				}else{
					
					if(isset($_SESSION["user"])){
						$acesso = $_POST["acesso"];
					}else{
						$acesso = "CLI";
					}
					
					$resposta = CadastrarUsuario($login, $senha, $acesso);
					
					if ($resposta) {
						
						if(isset($_SESSION["acesso"]))
						{
							$sucesso = "Usuario cadastrado com sucesso !!";
							header("Location: usuario_index.php?sucesso=$sucesso");
						}else{
							$consulta = BuscarUsuarioLoginSenha($login, $senha);
							if($linha = mysql_fetch_array($consulta)){
								
								GravarSession($linha["id"], $login, $acesso);
								
								$sucesso = "Bem Vindo ao Mundo Pet !!";
								header("Location: index.php?sucesso=$sucesso");
							}else{
								$erro = "Falha ao logar automaticamente.";
								header("Location: usuario_novo.php?erro=$erro");
							}
						}
					} else {
						$erro = "Erro ao cadastrar o usuario $login.";
						header("Location: usuario_novo.php?erro=$erro");
					}
				}
			}
		}
	}
	else {
		header("Location: index.php");
	}
?>
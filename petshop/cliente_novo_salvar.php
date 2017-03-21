<?php
	require_once("autenticacao.php");
	require_once("RepositorioCliente.php");
	
	if(!isset($_SESSION["user"])){
		header("Location: index.php");
		die();
	}
	
	$consulta = BuscarClienteIdUsuario($_SESSION["id"]);
	
	if($linha = mysql_fetch_array($consulta)){
		$id = $linha["id"];
		header("Location: cliente_show.php?id=$id");
		die();
	}
	
	if (isset($_POST["nome"]) && isset($_POST["cpf"]) && isset($_POST["endereco"]) &&
		isset($_POST["email"]) && isset($_POST["fone"]) && isset($_POST["id_usuario"]) &&
		 (isset($_POST["salvar"]) || isset($_POST["cancelar"])) 
		)
	{
	
		if (isset($_POST["cancelar"])) {
			header("Location: index.php");
			die();
		}
		else {
			
			$nome = trim($_POST["nome"]);
			$cpf = trim($_POST["cpf"]);
			$endereco = trim($_POST["endereco"]);
			$email = trim($_POST["email"]);
			$fone = trim($_POST["fone"]);
			$id_usuario = $_POST["id_usuario"];
			
			if(strlen(trim($nome)) < 6){
				$erro = "nome tem que ter no mínimo 6 caracteres.";
				header("Location: cliente_novo.php?erro=$erro");
			}else if (strlen(trim($cpf)) != 11){
				$erro = "CPF inválido.";
				header("Location: cliente_novo.php?erro=$erro");
			}else{
				//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
				$consulta = BuscarClienteCpf(trim($cpf));
				
				if($linha = mysql_fetch_array($consulta)){
					$erro = "O cpf $cpf já existe.";
					header("Location: cliente_novo.php?erro=$erro");
				}else{
					
					$resposta = CadastrarCliente(trim($nome), trim($cpf), $endereco, $email, $fone, $id_usuario);
					
					if ($resposta) {
						
						$consulta = BuscarClienteIdUsuario($_SESSION["id"]);
	
						if($linha = mysql_fetch_array($consulta)){
							$id = $linha["id"];
							$sucesso = "cliente $nome cadastrado com sucesso !!";
							header("Location: cliente_show.php?id=$id&sucesso=$sucesso");
							die();
						}else{
							$erro = "Erro ao cadastrar o cliente $nome.";
							header("Location: cliente_novo.php?erro=$erro");
						}
					} else {
						$erro = "Erro ao cadastrar o cliente $nome.";
						header("Location: cliente_novo.php?erro=$erro");
					}
				}
			}
		}
	}
	else {
		header("Location: index.php");
	}
?>
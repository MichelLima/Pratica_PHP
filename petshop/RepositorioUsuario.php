<?PHP
	require_once("bancodados.php");

	function BuscarUsuarioId($p_id){
		
		$id = mysql_real_escape_string($p_id);
		
		$sql = "select id, login, senha, nivel from usuario where id = $id";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function BuscarUsuarioLogin($p_login){
		
		$p_login = mysql_real_escape_string($p_login);
		
		$sql = "select id, login, senha, nivel from usuario where login = '$p_login'";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function BuscarUsuarioLoginSenha($p_login, $p_senha){
		
		$p_login = mysql_real_escape_string($p_login);
		$p_senha = mysql_real_escape_string($p_senha);
		
		$sql = "select id, login, senha, nivel from usuario where login = '$p_login' and senha = '$p_senha'";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function TodosUsuario($p_order){
		
		$sql = "select id, login, senha, nivel from usuario order by $p_order";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}

	function CadastrarUsuario($p_login, $p_senha, $p_nivel){
		
		$login = mysql_real_escape_string($p_login);
		$senha = mysql_real_escape_string($p_senha);
		$nivel = mysql_real_escape_string($p_nivel);
		
		$sql = "insert into usuario (login, senha, nivel) values ('$login', '$senha', '$nivel')";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		
		return $resposta;
	}

	function AlterarUsuario($p_id, $p_login, $p_senha, $p_nivel){
		
		$p_id = mysql_real_escape_string($p_id);
		$p_login = mysql_real_escape_string($p_login);
		$p_senha = mysql_real_escape_string($p_senha);
		$p_nivel = mysql_real_escape_string($p_nivel);
		
		$sql = "update usuario set login = '$p_login', senha = '$p_senha', nivel = '$p_nivel' where id = $p_id";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		
		return $resposta;
	}

	function DeletarUsuario($p_id){
		
		$p_id = mysql_real_escape_string($p_id);
		
		$sql = "delete from usuario where id = $p_id";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		
		return $resposta;
	}
?>
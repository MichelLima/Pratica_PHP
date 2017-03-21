<?PHP
	require_once("bancodados.php");

	function BuscarClienteId($p_id){
		
		$id = mysql_real_escape_string($p_id);
		
		$sql = "select t1.id, t1.nome, t1.cpf, t1.endereco, t1.email, t1.fone, t1.id_usuario,
				(select count(*) from reserva t2 inner join cliente t4 
					on t2.id_cliente = t4.id where t4.id = t1.id) as 'n_reserva',
				(select count(*) from animal t3 inner join cliente t4 
					on t3.id_cliente = t4.id where t4.id = t1.id) as 'n_animal'
				from cliente t1 where t1.id = $id";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function BuscarClienteNome($p_nome){
		
		$p_nome = mysql_real_escape_string($p_nome);
		
		$sql = "select t1.id, t1.nome, t1.cpf, t1.endereco, t1.email, t1.fone, t1.id_usuario,
				(select count(*) from reserva t2 inner join cliente t4 
					on t2.id_cliente = t4.id where t4.id = t1.id) as 'n_reserva',
				(select count(*) from animal t3 inner join cliente t4 
					on t3.id_cliente = t4.id where t4.id = t1.id) as 'n_animal'
				from cliente t1 where t1.nome = '$p_nome'";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function BuscarClienteCpf($p_cpf){
		
		$p_cpf = mysql_real_escape_string($p_cpf);
		
		$sql = "select t1.id, t1.nome, t1.cpf, t1.endereco, t1.email, t1.fone, t1.id_usuario,
				(select count(*) from reserva t2 inner join cliente t4 
					on t2.id_cliente = t4.id where t4.id = t1.id) as 'n_reserva',
				(select count(*) from animal t3 inner join cliente t4 
					on t3.id_cliente = t4.id where t4.id = t1.id) as 'n_animal'
				from cliente t1 where t1.cpf = $p_cpf";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function BuscarClienteIdUsuario($p_id_usuario){
		
		$p_id_usuario = mysql_real_escape_string($p_id_usuario);
		
		$sql = "select t1.id, t1.nome, t1.cpf, t1.endereco, t1.email, t1.fone, t1.id_usuario,
				(select count(*) from reserva t2 inner join cliente t4 
					on t2.id_cliente = t4.id where t4.id = t1.id) as 'n_reserva',
				(select count(*) from animal t3 inner join cliente t4 
					on t3.id_cliente = t4.id where t4.id = t1.id) as 'n_animal'
				from cliente t1 where t1.id_usuario = $p_id_usuario";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	
	function TodosCliente($p_order){
		
		$sql = "select t1.id, t1.nome, t1.cpf, t1.endereco, t1.email, t1.fone, t1.id_usuario,
				(select count(*) from reserva t2 inner join cliente t4 
					on t2.id_cliente = t4.id where t4.id = t1.id) as 'n_reserva',
				(select count(*) from animal t3 inner join cliente t4 
					on t3.id_cliente = t4.id where t4.id = t1.id) as 'n_animal'
				from cliente t1 order by t1.$p_order";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}

	function CadastrarCliente($p_nome, $p_cpf, $p_endereco, $p_email, $p_fone, $p_id_usuario){
		
		$p_nome = mysql_real_escape_string($p_nome);
		$p_cpf = mysql_real_escape_string($p_cpf);
		$p_endereco = mysql_real_escape_string($p_endereco);
		$p_email = mysql_real_escape_string($p_email);
		$p_fone = mysql_real_escape_string($p_fone);
		$p_id_usuario = mysql_real_escape_string($p_id_usuario);
		
		$sql = "insert into cliente (nome, cpf, endereco, email, fone, id_usuario) 
				values ('$p_nome', '$p_cpf', '$p_endereco', '$p_email', '$p_fone', $p_id_usuario)";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		
		return $resposta;
	}

	function AlterarCliente($p_id, $p_nome, $p_cpf, $p_endereco, $p_email, $p_fone, $p_id_usuario){
		
		$p_id = mysql_real_escape_string($p_id);
		$p_nome = mysql_real_escape_string($p_nome);
		$p_cpf = mysql_real_escape_string($p_cpf);
		$p_endereco = mysql_real_escape_string($p_endereco);
		$p_email = mysql_real_escape_string($p_email);
		$p_fone = mysql_real_escape_string($p_fone);
		$p_id_usuario = mysql_real_escape_string($p_id_usuario);
		
		$sql = "update cliente set nome = '$p_nome', cpf = '$p_cpf', endereco = '$p_endereco,' 
				email = 'p_email', fone = 'p_fone', id_usuario = p_id_usuario where id = $p_id";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		
		return $resposta;
	}

	function DeletarCliente($p_id){
		
		$p_id = mysql_real_escape_string($p_id);
		
		$sql = "begin";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		if($resposta){
			$sql = "delete from animal where id_cliente = $p_id";
			$resposta = @mysql_query($sql);
			if(!$resposta){
				$sql = "rollback";
				$resposta_2 = @mysql_query($sql);
				return $resposta;
			}
			
			$sql = "delete from reserva where id_cliente = $p_id";
			$resposta = @mysql_query($sql);
			if(!$resposta){
				$sql = "rollback";
				$resposta_2 = @mysql_query($sql);
				return $resposta;
			}
			
			$sql = "delete from cliente where id = $p_id";
			$resposta = @mysql_query($sql);
			if(!$resposta){
				$sql = "rollback";
				$resposta_2 = @mysql_query($sql);
				return $resposta;
			}
			
			
		}
		$sql = "commit";
		$resposta = @mysql_query($sql);
		
		return $resposta;
	}
?>
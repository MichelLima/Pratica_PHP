<?php 
require_once("bancodados.php");

	function BuscarProdutoId($p_id){
		
		$id = mysql_real_escape_string($p_id);
		
		$sql = "select * from produto where id=$id";
		$consulta = mysql_query($sql);
		
		return $consulta;
	}
	



	function DeletarProduto($p_id){
		
		$p_id = mysql_real_escape_string($p_id);
		
		$sql = "begin";
		//O "@" evita que apareça alguma mensagem de erro no meio do HTML.
		$resposta = @mysql_query($sql);
		if($resposta){
			
			$sql = "delete from produto where id = $p_id";
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
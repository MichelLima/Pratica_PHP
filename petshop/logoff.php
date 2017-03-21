<?php
	require_once("autenticacao.php");
	
	DestroirSession();
	
	header("Location: index.php");
?>
<?php 
	require_once("autenticacao.php");
	if (isset($_SESSION["id"])) {
?>
		<text>
			Olá, <a href="usuario_index.php"><?php echo $_SESSION["user"]; ?>!</a>
			<a href="logoff.php">LogOff</a>
		</text>
<?php
	} else {
?>
		<ul>
			<li><a href="usuario_novo.php">Registrar</a></li>
			<li><a href="usuario_login.php">LogIn</a></li>
		</ul>
<?php
	}
?>
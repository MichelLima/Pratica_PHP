<?PHP
	session_start();

	function GravarSession($id_session, $user_session, $acesso_session){
		
		$_SESSION["id"] = $id_session;
		$_SESSION["user"] = $user_session;
		$_SESSION["acesso"] = $acesso_session;
	}
	
	function DestroirSession(){
		
		session_destroy();
	}
?>
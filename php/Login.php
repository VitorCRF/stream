<?php
	session_start();
	
	require "config.php";

	$email = $_POST["email"];
	$senha = $_POST["senhaHash"];

	

	$resultado = mysqli_query($link, "SELECT * FROM user where email = '$email' AND senha = '$senha'");
	$retorno["status"] = "n";
	$retorno["mensagem"] = "Usuario ou senha invalido!";

	if(mysqli_num_rows($resultado) > 0){
		$registro = mysqli_fetch_assoc($resultado);
		$_SESSION["email"] = $registro["email"];
		$_SESSION["nome"] = $registro["nome"];
		$_SESSION["idUser"] = $registro["id"];

		$_SESSION["idSessao"] = session_id();
		$_SESSION["inicio"] = time();
		$_SESSION["tempoLimite"] = 30;

		$retorno["status"] = "s";
		$retorno["mensagem"] = "Usuario autenticado com sucesso!";
	}
	print_r ($_SESSION);
	

	echo json_encode($retorno);

	

?>
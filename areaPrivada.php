//verificar que só quem é cadastrado tenha acesso

<?php
	session_start();
	if (!isset($_SESSION['id_usuario'])) {
		header("location: index.php");
		exit;
	}


?>

//conteúdo do site

<a href="sair.php"> Sair </a>
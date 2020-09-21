<?php

class Usuario
{
	
	private $pdo;
	public $msgErro = "";

	public function conectar($nome, $host, $usuario, $senha)
	{
		global $pdo;
		try {
			$pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
		} catch (PDOException $e) {
			$msgErro = $e->getMessage();
		}
		
	}

	public function cadastrar($nome, $celular, $email, $senha)
	{
		global $pdo;
		//verificar se já existe o email cadastrado
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e");
		$sql->bindValue(":e",$email);
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			return false; //já está cadastrado
		}
		else{
			//caso não, Cadastrar	
			$sql = $pdo->prepare("INSERT INTO usuarios (nome, celular, email, senha) VALUES (:n, :c, :e, :s)");
			$sql->bindValue(":n",$nome);
			$sql->bindValue(":c",$celular);
			$sql->bindValue(":e",$email);
			$sql->bindValue(":s",md5($senha));
			$sql->execute();
			return true; //tudo ok
		}
	}

	public function logar($email, $senha)
	{
		global $pdo;
		//verificar se email e senha estão cadastrados, se sim:
		$sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :e AND senha = :s");
		$sql->bindValue(":e",$email);
		$sql->bindValue(":s",md5($senha));
		$sql->execute();
		if($sql->rowCount() > 0)
		{
			//entrar no sistema (sessão)
			$dado = $sql->fetch();
			session_start();
			$_SESSION['id_usuario'] = $dado['id_usuario'];
			return true; //logado com sucesso
		} 
		else
		{
			return false; //não possível logar
		}
	}

}

?>

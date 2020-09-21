<?php
	require_once 'CLASSES/usuarios.php';
	$u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Projeto Login</title>
		<link rel="stylesheet" href="CSS/estilo.css">
	</head>

	<body>

		<div id="corpo-form-Cad">
			<h1>Cadastrar</h1>
			<form method="POST">
				<input type="text" name="nome" placeholder="Nome completo" maxlength="30">
				<input type="text" name="celular" placeholder="Celular" maxlength="30">
				<input type="email" name="email" placeholder="Usuário" maxlength="40">
				<input type="password" name="senha" placeholder="Senha" maxlength="15">
				<input type="password" name="confSenha" placeholder="Confirmar senha" maxlength="15">
				<input type="submit" value="Cadastrar">
			</form>
		</div>

		<?php
			//verificar se a pessoa clicou no botão(através do método post no isset)
			if(isset($_POST['nome']))
			{
				$nome = addslashes($_POST['nome']);
				$celular = addslashes($_POST['celular']);
				$email = addslashes($_POST['email']);
				$senha = addslashes($_POST['senha']);
				$confirmarSenha = addslashes($_POST['confSenha']);
				//verificar se todos os campos foram preenchidos
				if (!empty($nome) && !empty($celular) && !empty($email) && !empty($senha) && !empty($confirmarSenha)) 
				{
					$u->conectar("projeto_login","localhost","root","");
					if($u->msgErro == "") //se está tudo ok
					{
						if($senha == $confirmarSenha)
						{
							if($u->cadastrar($nome,$celular,$email,$senha))
							{
								?>
								<div id="msg-sucesso">
									Cadastrado com sucesso! Acesse para entrar
								</div>
								<?php
							}
							else
							{
								?>
								<div class="msg-erro">
									Email já cadastrado
								</div>
								<?php
							}
						}
						else
						{
							?>
								<div class="msg-erro">
									Senha e confirmar senha não correspondem
								</div>
								<?php
						}
					}else{
						?>
								<div class="msg-erro">
									<?php echo "Erro".$u->msgErro;?>
								</div>
								<?php
					}
				} else{
					?>
								<div class="msg-erro">
									Preencha todos os campos!
								</div>
								<?php
				}
			}
		?>

	</body>
</html>
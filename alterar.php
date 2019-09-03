<?php

	error_reporting(0);

	session_start();
	$id = $_SESSION['id'];

	include_once("Usuario.php");
	include_once("UsuarioDAO.php");
	
	$usuario = new Usuario();
	$usuarioDAO = new UsuarioDAO();
	
	if (isset($_POST['nome'])) {
		
		$usuario->setNome($_POST['nome']);
		$usuario->setEmail($_POST['email']);
		$usuario->setSenha($_POST['senha']);
		
		$usuarioDAO->AtualizaUsuarios($usuario, $id);
		header("Location:http://localhost/agenda_pdo/home.php");
		
	}
	
	if (isset($_FILES['arquivo'])) {
		
		unlink("imagens/".$image);

		$ext = strtolower(substr($_FILES['arquivo']['name'], -4));
		$novoNome = microtime().$ext;
		$diretorio = "imagens/";

		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novoNome);

		$usuarioDAO->AtualizaFoto($novoNome, $id);

	}

?>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	
	<!-- Css - Bootstrap -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<!-- JS, Popper.js, and jQuery - Bootstrap -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
		
</head>
<body>

<section>
<br><div class="container">
		<div class="row">
			
			<div class="col-md-8">
				
				<h4 class="text-dark">ALTERAR</h4><br><br>
				
				<?php
				
					$teste = $usuarioDAO->ListarUpdate($id);
				
					for ($i=0; $i < count($teste); $i++) {

						$_SESSION['image'] = $teste[$i]['image'];
						$image = $_SESSION['image'];

						echo '
					
							<form method="post">
								<div class="form-group row">
									<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Name</label>
									<div class="col-sm-10">
										<input type="text" name="nome" value="'.$teste[$i]['nome'].'" required class="form-control form-control-sm" id="colFormLabelSm" placeholder="Name">
									</div>
								</div>
								<div class="form-group row">
									<label for="colFormLabel" class="col-sm-2 col-form-label">Email</label>
									<div class="col-sm-10">
										<input type="email" name="email" value="'.$teste[$i]['email'].'" required class="form-control" id="colFormLabel" placeholder="Email">
									</div>
								</div>
								<div class="form-group row">
									<label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg">Senha</label>
									<div class="col-sm-10">
										<input type="password" name="senha" value="'.$teste[$i]['senha'].'" required class="form-control form-control-lg" id="colFormLabelLg" placeholder="Senha">
									</div>
								</div><br>
								<div class="form-group row">
									<div class="col-sm-12">
										<input type="submit" class="form-control form-control-lg btn btn-dark" id="colFormLabelLg" value="Enviar">
									</div>
								</div><br><br>
							</form>
						
						';
						
					}
				
				?>
				
			</div>
			<div class="col-md-4" style="margin-top: 10px">
			
				<img src="imagens/<?php echo $image ?>" class="img-responsive" style="height:200px">
			
				<form method="post" enctype="multipart/form-data">
				
					<br><input type="file" name="arquivo" class="form-control">
					<input type="submit" class="form-control form-control-lg btn btn-dark" id="colFormLabelLg" value="Enviar">
				
				</form>

			</div>
		
			<a href="home.php">VOLTAR</a>

		</div>
	</div>	
</section>

</body>
</html>
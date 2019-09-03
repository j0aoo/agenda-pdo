<?php

	error_reporting(0);
	session_start();

	include_once("Usuario.php");
	include_once("UsuarioDAO.php");
	
	$usuario = new Usuario();
	$usuarioDAO = new UsuarioDAO();
	
	if (isset($_POST['nome']) && isset($_FILES['arquivo'])) {
		
		$ext = strtolower(substr($_FILES['arquivo']['name'], -4));
		$novoNome = microtime().$ext;
		$diretorio = "imagens/";

		$usuario->setNome($_POST['nome']);
		$usuario->setEmail($_POST['email']);
		$usuario->setSenha($_POST['senha']);
		$usuario->setFoto($novoNome);
		
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $diretorio.$novoNome);

		$usuarioDAO->InsereUsuario($usuario);
	
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

	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/themify/themify-icons.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/elegant-font/html-css/style.css">
	
</head>
<body>

<br><div class="container">
		<div class="row">
			
			<div class="col-md-6">
				
				<h4 class="text-dark">CADASTRO</h4><br><br>
				
				
				<form method="post" enctype="multipart/form-data">
					<div class="form-group row">
				    	<label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm" class="text-dark">Name</label>
				    	<div class="col-sm-10">
				      		<input type="text" name="nome" required class="form-control form-control-sm" id="colFormLabelSm" placeholder="Name">
				    	</div>
				  	</div>
				  	<div class="form-group row">
				    	<label for="colFormLabel" class="col-sm-2 col-form-label" class="text-dark">Email</label>
				    	<div class="col-sm-10">
				      		<input type="email" name="email" required class="form-control" id="colFormLabel" placeholder="Email">
				    	</div>
				  	</div>
				  	<div class="form-group row">
				   		<label for="colFormLabelLg" class="col-sm-2 col-form-label col-form-label-lg" class="text-dark">Senha</label>
				    	<div class="col-sm-10">
				      		<input type="password" name="senha" required class="form-control form-control-lg" id="colFormLabelLg" placeholder="Senha">
				    	</div>
				  	</div>
				  	<div class="form-group row">
				    	<label for="colFormLabel" class="col-sm-2 col-form-label" style="font-size: 25px" class="text-dark">Foto</label>
				    	<div class="col-sm-10">
				      		<input type="file" name="arquivo" required class="form-control" id="colFormLabel" style="height: 50px">
				    	</div>
				  	</div><br>
				  	<div class="form-group row">
				    	<div class="col-sm-12">
				      		<input type="submit" class="form-control form-control-lg btn btn-dark" id="colFormLabelLg" value="Enviar">
				    	</div>
				  	</div><br><br>
				</form>
			</div>
			
			<div class="col-md-6">
				
				<h4 class="text-dark">CONSULTAR</h4><br><br>
				
				<table class="table table-striped table-hover table-bordered">
					<thead>

						<tr>
							<th>#</th>
							<th>Nome</th>
							<th>Email</th>
						</tr>

					</thead>
					<tbody>
					
						<?php
						
							$URL = $_SERVER['REQUEST_URI'];
							$url = explode("/", $URL);
							
							if ($url[3] == "del") {
								
								$id = $url[4];
							
								$usuarioDAO->DeletarUsuarios($id, $_SESSION['image']);
								
							} else if ($url[3] == "update") {
								
								$id = $url[4];
								
								$_SESSION['id'] = $id;
								
								header("Location:http://localhost/agenda_pdo/alterar.php");
								
							} else if ($url[3] == "ver") {
								
								$id = $url[4];
								
								$_SESSION['id'] = $id;
								
								header("Location:http://localhost/agenda_pdo/ver.php");
								
							}
						
							$teste = $usuarioDAO->ListarUsuarios();
						
							for ($i=0; $i < count($teste); $i++) {
							
								$_SESSION['image'] = $teste[$i]['image'];

								echo "
								
									<tr>
										<td>".$teste[$i]['id']."</td>
										<td>".$teste[$i]['nome']."</td>
										<td>".$teste[$i]['email']."</td>
										<td align='center'>
											<a href='http://localhost/agenda_pdo/home.php/ver/".$teste[$i]['id']."' title='VER'>
												<i class='fa fa-address-book-o' aria-hidden='true'></i>
											</a>
										</td>
										<td align='center'>
											<a href='http://localhost/agenda_pdo/home.php/update/".$teste[$i]['id']."' title='ALTERAR'>
												<i class='fa fa-refresh' aria-hidden='true'></i>
											</a>
										</td>
										<td align='center'>
											<a href='http://localhost/agenda_pdo/home.php/del/".$teste[$i]['id']."' style='color:red;' title='DELETAR'>
												<i class='fa fa-times' aria-hidden='true'></i>
											</a>
										</td>
									</tr>
								
								";
							
							}
						
						?>
					
					</tbody>
				</table>
				
			</div>
		
		</div>
	</div>	
</section>

</body>
</html>
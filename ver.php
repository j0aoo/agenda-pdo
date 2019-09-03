<?php

	session_start();
	$id = $_SESSION['id'];

	include_once("Usuario.php");
	include_once("UsuarioDAO.php");

	$usuarioDAO = new UsuarioDAO();
	$usuario = new Usuario();

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
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
						
			<div class="col-md-3"><br>

				<h4 class="text-dark">CONSULTAR</h4><br>
				
				<?php

					$image = $_SESSION['image'];

					echo "

						<br><img src='imagens/".$image."' style='height:180px'>

					";

				?>

			</div>

			<div class="col-md-9"><br><br><br><br><br>
				
				<?php
				
					$teste = $usuarioDAO->ListarUpdate($id);
				
					for ($i=0; $i < count($teste); $i++) {
						
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
										<input type="text" name="senha" value="'.$teste[$i]['senha'].'" required class="form-control form-control-lg" id="colFormLabelLg" placeholder="Senha">
									</div>
								</div><br>
								<br><br>
							</form>
						
						';
						
					}
				
				?>

			</div>

			<a href="home.php">VOLTAR</a>
		
		</div>
	</div>	
</section>

</body>
</html>
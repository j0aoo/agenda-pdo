<?php
	
	include_once("Usuario.php");
	include_once("Conexao.php");

	class UsuarioDAO {
		
		public function InsereUsuario (Usuario $usuario) {
		
			$con = new Conexao();
			$stmt = $con->Conexao();
			
			$sql = $stmt->prepare("INSERT INTO usuarios(nome,email,senha,image) VALUES (?,?,?,?);");
			
			$nome = $usuario->getNome();
			$email = $usuario->getEmail();
			$senha = $usuario->getSenha();
			$foto = $usuario->getFoto();
		
			$sql->bindParam(1, $nome);
			$sql->bindParam(2, $email);
			$sql->bindParam(3, $senha);
			$sql->bindParam(4, $foto);
			
			if ($sql->execute()) {
				
				echo "<script> alert('Cadastrado com sucesso!') </script>";
			
			} else {
				
				echo "<script> alert('Erro ao cadastrar!') </script>";
				
			}
	
		}// fim insere
		
		public function ListarUsuarios() {
		
			$con = new Conexao();
			$stmt = $con->Conexao();
			
			$sql = $stmt->prepare("SELECT * FROM `usuarios`");
			$sql->execute();
		
			return $sql->fetchAll();
		
		}// fim Listar
		
		public function DeletarUsuarios($id, $nomeImage) {
			
			$con = new Conexao();
			$stmt = $con->Conexao();
			
			$sql = $stmt->prepare("DELETE FROM `usuarios` WHERE `id` = ?;");
			$sql->bindParam(1, $id);

			unlink("imagens/".$nomeImage);

			if ($sql->execute()) {
				
				echo "<script> alert('Deletado com sucesso!') </script>";
				header("Location:http://localhost/agenda_pdo/home.php");
			
			} else {
				
				echo "<script> alert('Erro ao Deletar!') </script>";
				
			}
			
		}// fim Deletar
		
		public function ListarUpdate($id) {
			
			$con = new Conexao();
			$stmt = $con->Conexao();
			
			$sql = $stmt->prepare("SELECT * FROM `usuarios` WHERE `id` = ?;");
			$sql->bindParam(1, $id);
			
			$sql->execute();
		
			return $sql->fetchAll();
			
		}// fim Lista update

		public function AtualizaUsuarios(Usuario $usuario, $id) {
			
			$con = new Conexao();
			$stmt = $con->Conexao();
			
			$sql = $stmt->prepare("UPDATE `usuarios` SET `nome` = ?, `email` = ?, `senha` = ? WHERE `id` = ?");
			
			$nome = $usuario->getNome();
			$email = $usuario->getEmail();
			$senha = $usuario->getSenha();
		
			$sql->bindParam(1, $nome);
			$sql->bindParam(2, $email);
			$sql->bindParam(3, $senha);
			$sql->bindParam(4, $id);
			
			if ($sql->execute()) {
				
				echo "<script> alert('Cadastrado com sucesso!') </script>";
			
			} else {
				
				echo "<script> alert('Erro ao cadastrar!') </script>";
				
			}
			
		}

		public function AtualizaFoto($foto, $id) {
			
			$con = new Conexao();
			$stmt = $con->Conexao();
			
			$sql = $stmt->prepare("UPDATE `usuarios` SET `image` = ? WHERE `id` = ?");
			
			$sql->bindParam(1, $foto);
			$sql->bindParam(2, $id);
			
			if ($sql->execute()) {
				
				echo "<script> alert('Cadastrado com sucesso!') </script>";
			
			} else {
				
				echo "<script> alert('Erro ao cadastrar!') </script>";
				
			}
			
		}
		
	}// fim atualiza
	

?>
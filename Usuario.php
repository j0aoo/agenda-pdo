<?php

	class Usuario {
	
		private $nome;
		private $email;
		private $senha;
		private $foto;
		
		public function getNome() {
		
			return $this->nome;
			
		}
		
		public function setNome($nome) {
		
			$this->nome = $nome;
			
			return $this;
	
		}
		
		public function getEmail() {
		
			return $this->email;
		
		}
		
		public function setEmail($email) {
		
			$this->email = $email;
			
			return $this;
		
		}
		
		public function getSenha() {
			
			return $this->senha;
			
		}
		
		public function setSenha($senha) {
		
			$this->senha = $senha;
			
			return $this;
		
		}

		public function getFoto() {
		
			return $this->foto;
			
		}
		
		public function setFoto($foto) {
		
			$this->foto = $foto;
			
			return $this;
	
		}
		
	}

?>
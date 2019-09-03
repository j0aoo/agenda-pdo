<?php

	class Conexao {
		
		public function Conexao() {
		
			try {
			
				$pdo = new PDO('mysql:host=localhost; dbname=agendapdo','root','');
			
			} catch (Exception $e) {
			
				echo $e.getMessage();
			
			}
			
			return $pdo;
		
		}
	
	}
	
?>
<?php
	//esta classe, decide qual objecto de banco de dados instânciar
	class Tconection
	{
		//diz-se privado, para que nãi haja instâncias desta classe
		private function __construct(){}
		//name, refere-se ao banco de dados com que se quer trabalhar
		public static function open($name)
		{
			//verifica a existência do arquivo, caso negativo, gera uma excessão
			if(file_exists("../phpstuff/ADO/dataBase/$name.ini")):
				//lê o aquivo no formato ini
				$db=parse_ini_file("../phpstuff/ADO/dataBase/$name.ini");
			elseif(file_exists("phpstuff/ADO/dataBase/$name.ini")):
				$db=parse_ini_file("phpstuff/ADO/dataBase/$name.ini");
			else:
				throw new Exception("Arquivo $name não encontrado");
			endif;
			//atribui os dados do arquivo ao sistema
			$type=$db['type'];
			$password=$db['password'];
			$name=$db['name'];
			$user=$db['user'];
			$host=$db['host'];
			//faz-se a escolha dentre as drivers de dados, qual fazer conexão
			//como nesta máquina somente tem o mysql, daí só ter uma única opção
			//quando houver mais, somente haverá acréscimo
			switch($type)
			{
				case 'mysql':
					$conn= new PDO("mysql:host=$host;port=3306;dbname=$name",$user,$password);
					break;
			}
			//instrui o PDO a lançar excessões na ocorrência de erros.
			//$conn->setAttribute(PDO::ATTR_MODE,PDO::ERRMODE_EXCEPTION);
			return $conn;
		}
	}
 ?>
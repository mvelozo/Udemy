<?php 


class Sql extends PDO {

	private $conn;

	//contruir a conexao
	public function __construct(){

		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7","root","");

	}

	//seta os parametros com chaves e valores para a conexao
	private function setParams($statment, $parameters = array()){

		foreach ($parameters as $key => $value) {
			
			$statment->setParams($key,$value);
		}
	}

	//seta um unico parametro (quando necessario) para consulta
	private function setParam($statment, $key, $value){

		$statment->bindParam($key,$value);
	}

	//seta os parametros que prepara a conexao com retorno das informacoes em array
	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);	
		$this->setParams($stmt,$params);	
	
		$stmt->execute();

		return $stmt;
	}

	//realiza o fetch com as informaçoes obtidas no retorno da classe query
	public function select($rawQuery, $params = array()):array{

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);	
	}

}



















 ?>
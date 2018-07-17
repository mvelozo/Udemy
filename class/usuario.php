<?php 

class Usuario{

	private $idUsuario;
	private $deslogin;
	private $dessenha;
	private $dtCadastro;

	//idUsuario
	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($valores){
		$this->idUsuario = $valores;
	}

	//desLogin
	public function getDesLogin(){
		return $this->deslogin;
	}

	public function setDesLogin($valores){
		$this->deslogin = $valores;
	}

	//desSenha
	public function getDesSenha(){
		return $this->dessenha;
	}

	public function setDesSenha($valores){
		$this->dessenha = $valores;
	}

	//dtCadastro
	public function getDtCadastro(){
		return $this->dtCadastro;
	}

	public function setDtCadastro($valores){
		$this->dtCadastro = $valores;
	}

	public function carregaID($id){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE idusuarios = :ID", array(
				//fornece os parametros a serem pesquisados no banco (chave = valor)
				":ID"=>$id

		));

		//if(isset($result[0]));
		if(count($result) > 0){


			$this->setDados($result[0]);
			/*
			$row = $result[0];
			$this->setIdUsuario($row['idusuarios']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));
			*/
		}
	}

	//gera lista de usuarios ordenados pelo deslogin
	public static function geraLista(){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios ORDER BY desLogin;");
	}

	//gera lista de usuarios ordenados pelo deslogin, de acordo com as iniciais ou parciais de nomes digitados
	public static function buscarUsuario($login){

		$sql = new Sql();

		return $sql->select("SELECT * FROM tb_usuarios WHERE desLogin LIKE :SEARCH ORDER BY deslogin", array(':SEARCH'=>"%".$login."%"));
	}

	//realiza a pesquisa do deslogin especifico
	public function login($login,$senha){

		$sql = new Sql();

		$result = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGIN AND dessenha = :SENHA", array(
				//fornece os parametros a serem pesquisados no banco (chave = valor)
				":LOGIN"=>$login,
				":SENHA"=>$senha
			));

		if(count($result) > 0){

			//$row = $result[0];
			$this->setDados($result[0]);
			/*$this->setIdUsuario($row['idusuarios']);
			$this->setDesLogin($row['deslogin']);
			$this->setDesSenha($row['dessenha']);
			$this->setDtCadastro(new DateTime($row['dtcadastro']));*/
		} else {

			throw new Exception("Login ou senha inválidos", 1);
			
		}
	}

	public function setDados($dados){

		$this->setIdUsuario($dados['idusuarios']);
		$this->setDesLogin($dados['deslogin']);
		$this->setDesSenha($dados['dessenha']);
		$this->setDtCadastro(new DateTime($dados['dtcadastro']));

	}

	public function insert(){

		$sql = new Sql();

		$result = $sql->select("CALL sp_usuarios_insert(:LOGIN, :SENHA)", array(

			':LOGIN'=>$this->getDesLogin(),
			':SENHA'=>$this->getDesSenha()
		));

		if(count($result) > 0){
			$this->setDados($result[0]);
		}
	}


	public function update($login, $senha){

		$this->setDesLogin($login);
		$this->setDesSenha($senha);

		$sql = new Sql();

		$sql->query("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :SENHA WHERE idusuarios = :ID", array(

			':LOGIN'=>$this->getDesLogin(),
			':SENHA'=>$this->getDesSenha(),
			':ID'=>$this->getIdUsuario()
		));			
		//var_dump("entrou no update = <br>".$login."<br>".$senha."<br>");
	}

	public function __construct($login = "", $senha = ""){

		$this->setDesLogin($login);
		$this->setDesSenha($senha);
	}

	//exibe na tela em forma de json o resultado da consulta do bd
	public function __toString(){

	return json_encode(array(
		"idusuarios"=>$this->getIdUsuario(),
		"deslogin"=>$this->getDesLogin(),
		"dessenha"=>$this->getDesSenha(),
		"dtcadastro"=>$this->getDtCadastro()->format("d/m/Y H:i:s")
	));

}

}


 ?>
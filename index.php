<?php 

//chama a pagina config.php 
require_once("config.php");

/*
//instancia a classe php
$sql = new Sql();

//instancia a classe select com consulta a base tb_usuarios
$usuarios = $sql->select("SELECT * FROM tb_usuarios");

//formata o resultado em json
echo json_encode($usuarios);
*/

/*
$user = new Usuario();

//carrega um unico usuario
$user->carregaID(4);

echo $user;
*/

/*
//carrega todos os usuarios
$lista = Usuario::geraLista();

echo json_encode($lista);
*/

/*
//carrega lista de usuarios ordenados pelo login
$lista = Usuario::buscarUsuario("ro");

echo json_encode($lista);
*/

//carrega usuario atraves do login e senha 
$user = new Usuario();

$user->login("Uso","12345");

echo $user;
 ?>
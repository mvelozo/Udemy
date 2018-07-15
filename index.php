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

$user = new Usuario();

$user->carregaID(4);

echo $user;
 ?>
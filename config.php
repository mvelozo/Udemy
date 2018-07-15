<?php 

//carrega as classes que devem ser acessadas em outros arquivos php
spl_autoload_register(function($class_name){

	$filename = "class".DIRECTORY_SEPARATOR.$class_name.".php";

	if(file_exists(($filename))){
		require_once($filename);
	}

});

 ?>
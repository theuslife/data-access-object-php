<?php

require_once("config.php");

/* Isto aqui é como um route. 
Neste código aqui percebemos que cada trecho de código
tem sua rota, um por ID, outro para carregar lista de 
usuário e assim por diante...*/

//========Select============
/*
$sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo "<pre>";
print_r($usuarios); */

//=======Select por ID===========

/*
//Carrega 1 usuário
$usuario = new Usuarios();
$usuario->loadById(1);
echo $usuario; */

/* Carrega uma lista de usuários pelo método static da classe usuário.
$lista = Usuarios::getLista(); */

/*
//Faz uma pesquisa por login
$resultadoPesquisa = Usuarios::pesquisar("th");
echo json_encode($resultadoPesquisa); */


//Carrega um usuário usando login e senha
$usuario = new Usuarios();
$usuario->login("Matheus", "senhaDoTheus"); 
echo $usuario; 



?>
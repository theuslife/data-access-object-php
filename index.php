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
$usuario->loadById(2);
echo $usuario; */

//===========Select geral ===========
/*
//Carrega uma lista de usuários pelo método static da classe usuário.
$lista = Usuarios::getLista(); 
echo json_encode($lista); */

//=========Select por pesquisa ==========
/*
//Faz uma pesquisa por login
$resultadoPesquisa = Usuarios::pesquisar("th");
echo json_encode($resultadoPesquisa); */

//========= Select caso o Login e Senha sejam válidas ========
/*
//Carrega um usuário usando login e senha
$usuario = new Usuarios();
$usuario->login("Matheus", "senhaDoTheus"); 
echo $usuario; */

// ========== Inserindo novos registros ============
/* Inserindo dados no banco e dando um select utilizando
procedures */ 

/*
$aluno = new Usuarios("Antonio", "478");
$aluno->inserir();
echo $aluno; */

// =========== Update os registros ===========
/*
$usuario = new Usuarios();
$usuario->loadById(2);
$usuario->update("Dyana", "Pipoca");
echo $usuario; */

/*
// ============= Deletando os registros ==========
$usuario = new Usuarios();
$usuario->loadById(3);
$usuario->delete(); */




?>
<?php

require_once("config.php");

//========Select============
/* $sql = new Sql();
$usuarios = $sql->select("SELECT * FROM tb_usuarios");
echo "<pre>";
print_r($usuarios); */

//=======Select por ID===========
$usuario = new Usuarios();
$usuario->loadById(4);
echo $usuario;

?>
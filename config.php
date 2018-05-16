<?php

spl_autoload_register(function($nomeDaClasse)
{
    $filename = "classes" . DIRECTORY_SEPARATOR . $nomeDaClasse . ".php";
    if(file_exists($filename))
    {
        require_once($filename);
    }
})

?>
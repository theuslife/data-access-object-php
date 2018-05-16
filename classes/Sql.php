<?php

//Podemos herdar de classes já padrões do PHP, como o próprio PDO, assim nossa classe terá todos os métodos públicos fornecidos por ela. Como execute(), bindParam() e assim por diante...
class Sql extends PDO 
{
    private $conexao;

    //Poderiamos passar parâmetros no construtor e assim ter um login e senha que serão informados na criação de um objeto apartir desta classe Sql. Neste exemplo não será necessário já que iremos usar apenas um servidor de conexão
    public function __construct()
    {
        $this->conexao = new PDO("mysql:host=localhost; dbname=dbphp7", "root", "");
    }

    //Métodos para os parâmetros de uma Query SQL
    private function setParametros($statment, $parametros = array())
    {
        foreach ($parametros as $indice => $elemento)
        {
            $this->setParametro($statment, $indice, $elemento);
        }
    }

    private function setParametro($statment, $indice, $elemento)
    {
        $statment->bindParam($indice, $elemento);
    }

    //Podemos informar que um parâmetro já recebe de natureza dados de um array
    public function query($querySQL, $parametros = array())
    {
        $stmt = $this->conexao->prepare($querySQL);
        $this->setParametros($stmt, $parametros);  
        $stmt->execute();    
        return $stmt;
    }   
    
    public function select($querySQL, $parametros = array()):array
    {
        $stmt = $this->query($querySQL, $parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
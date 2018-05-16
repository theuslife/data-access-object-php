<?php

class Usuarios 
{
    //Colunas do nosso banco dbphp7
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $datacadastro;

    //Carregando por ID
    public function loadById($id)
    {
        $sql = new Sql();
        /*Este resultado será um array, pela lógica será retornado apenas 1 dado já que estamos
        selecionando por ID */
        $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$id
        ));
        /* Mas se digitarmos um ID incorreto? Logo, iremos verificar se temos ao menos um resultado 
        em nosso array. */
        if(isset($resultado[0]))
        {
            //Como o resultado é um array de arrays, logo setamos nossos atributos
            $registro = $resultado[0];
            $this->setIdusuario($registro['idusuario']);
            $this->setDeslogin($registro['deslogin']);
            $this->setDessenha($registro['dessenha']);
            $this->setDatacadastro(new DateTime($registro['datacadastro']));
        }
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario"=>$this->getIdusuario(),
            "deslogin"=>$this->getDeslogin(),
            "dessenha"=>$this->getDessenha(),
            "datacadastro"=>$this->getDatacadastro()->format("d/m/Y H:i:s")
        ));
    }

    //Getters and Setters
    public function getIdusuario()
    {
        return $this->idusuario;
    }
    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;
    }
    public function getDeslogin()
    {
        return $this->deslogin;
    }
    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;
    }
    public function getDessenha()
    {
        return $this->dessenha;
    }
    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;
    }
    public function getDatacadastro()
    {
        return $this->datacadastro;
    }
    public function setDatacadastro($datacadastro)
    {
        $this->datacadastro = $datacadastro;
    }
}

?>
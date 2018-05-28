<?php

class Usuarios 
{
    //Colunas do nosso banco dbphp7
    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $datacadastro;

    //Construtor
    public function __construct($login = "", $senha = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($senha);
    }


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
            $this->setRegistro($registro);
        }
    }

    /*
        Carregar por lista. Não usamos o $this neste método, portanto ele pode ser um método estático. 
        O que torna um método estático poderoso, podendo ser chamado dentro e fora da classe sem instanciar.
    */
    public static function getLista()
    {
        $sql = new Sql();
        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    //Pesquisar por nome
    public static function pesquisar($login)
    {
        $sql = new  Sql();
        return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :SEARCH ORDER BY deslogin", array(
            ":SEARCH"=>"%".$login."%"
        ));
    }

    //Fazer Login do usuário
    public function login($login, $senha)
    {
        $sql = new Sql();

        $resultado = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :LOGINN AND dessenha = :SENHA", array(
            ":LOGINN"=>$login,
            ":SENHA"=>$senha
        ));

        if((count($resultado) > 0))
        {
            $registro = $resultado[0];
            $this->setRegistro($resultado[0]);
        } else 
        {
            throw new Exception("Erro de Autenticação. Login e/ou senha inválidos");
        }      
    }

    //Inserindo dados
    public function inserir()
    {

        $sql = new Sql();
        $resultado = $sql->select("CALL sp_usuarios_insert(:LOGINN, :SENHA)", array(
            ":LOGINN"=>$this->getDeslogin(),
            ":SENHA"=>$this->getDessenha()
        ));

        if(isset($resultado[0]))
        {
            $registro = $resultado[0];
            $this->setRegistro($registro);
        }
    }

    //Método para atualizar os atributos de nossa classe usuário
    public function setRegistro($registro)
    {
        $this->setIdusuario($registro['idusuario']);
        $this->setDeslogin($registro['deslogin']);
        $this->setDessenha($registro['dessenha']);
        $this->setDatacadastro(new DateTime($registro['datacadastro']));  
    }

    //Update
    public function update($login, $senha)
    {

        $this->setDeslogin($login);
        $this->setDessenha($senha);

        $sql = new Sql();

        $sql->query("UPDATE tb_usuarios SET deslogin = :LOGINN , dessenha = :SENHA WHERE idusuario = :ID", array(
            ':ID'=>$this->getIdusuario(),
            ':LOGINN'=>$this->getDeslogin(),
            ':SENHA'=>$this->getDessenha()
        ));
    }

    //Delete
    public function delete()
    {
        $sql = new Sql();
        $sql->query("DELETE FROM tb_usuarios WHERE idusuario = :ID", array(
            ":ID"=>$this->getIdusuario()
        ));
        $this->setIdusuario(0);
        $this->setDeslogin("");
        $this->setDessenha("");
        $this->setDatacadastro(new DateTime());

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
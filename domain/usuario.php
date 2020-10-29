<?php

class Usuario{
    public $idusuario;
    public $nomeusuario;
    public $senha;
    public $foto;

    public function __construct($db){
        $this->conexao = $db;
    }

    
    public function listar(){
        $query = "select * from usuario";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into usuario set nomeusuario=:n, senha=:s, foto=:f";

        $stmt = $this->conexao->prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":n",$this->nomeusuario);
        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":f",$this->foto);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function alterarSenha(){
        $query = "update usuario set senha=:s where idusuario=:id";

        $stmt = $this->conexao->prepare($query);

        $this->senha = md5($this->senha);

        $stmt->bindParam(":s",$this->senha);
        $stmt->bindParam(":id",$this->idusuario);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function alterarFoto(){
        $query = "update usuario set foto=:f where idusuario=:id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":f",$this->foto);
        $stmt->bindParam(":id",$this->idusuario);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagarUsuario(){
        $query = "delete from usuario where idusuario=:id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":id",$this->idusuario);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


    

}


?>
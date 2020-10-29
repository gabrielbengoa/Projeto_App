<?php

class Contato{
    public $idcontato;
    public $telefone;
    public $email;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from contato";
        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into contato set telefone=:t, email=:e";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function atualizarcontato(){
        $query = "update contato set telefone=:t, email=:e where idcontato=:id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":t",$this->telefone);
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":id",$this->idcontato);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function apagarcontato(){
        $query = "delete from contato where idcontato=:id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":id",$this->idcontato);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

}


?>
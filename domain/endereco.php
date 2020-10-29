<?php

class Endereco{
    public $idendereco;
    public $tipo;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cep;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from endereco";
    
        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into endereco set tipo=:t,logradouro=:l,numero=:n,complemento=:c,bairro=:b,cep=:cep";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":t",$this->tipo);
        $stmt->bindParam(":l",$this->logradouro);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":c",$this->complemento);
        $stmt->bindParam(":b",$this->bairro);
        $stmt->bindParam(":cep",$this->cep);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

public function alterarendereco(){
            $query = "update endereco set tipo=:t,logradouro=:l,numero=:n,complemento=:c,bairro=:b,cep=:cep where idendereco=:id";
    
            $stmt = $this->conexao->prepare($query);
            
            $stmt->bindParam(":t",$this->tipo);
            $stmt->bindParam(":l",$this->logradouro);
            $stmt->bindParam(":n",$this->numero);
            $stmt->bindParam(":c",$this->complemento);
            $stmt->bindParam(":b",$this->bairro);
            $stmt->bindParam(":cep",$this->cep);
            $stmt->bindParam(":id",$this->id);
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
    
        }
    
    public function apagarendereco(){
        $query = "delete from endereco where idendereco=:id";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":id",$this->idendereco);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


    

}


?>
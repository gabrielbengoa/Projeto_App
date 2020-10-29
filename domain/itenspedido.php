<?php

class ItensPedido{
    public $iditenspedido;
    public $idpedido;
    public $idproduto;
    public $quantidade;

    public function __construct($db){
        $this->conexao = $db;
    }

    public function listar(){
        $query = "select * from itenspedido";

        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into itenspedido set idpedido=:ip, idproduto=:ipro, quantidade=:q";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":ip",$this->idpedido);
        $stmt->bindParam(":ipro",$this->idproduto);
        $stmt->bindParam(":q",$this->quantidade);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

    public function atualizaritenspedidos(){
        $query = "update itenspedido set idpedido=:ip, idproduto=:ipro, quantidade=:q where iditenspedido=:itens";

        $stmt = $this->conexao->prepare($query);

     
        $stmt->bindParam(":ip",$this->idpedido);
        $stmt->bindParam(":ipro",$this->idproduto);
        $stmt->bindParam(":q",$this->quantidade);
        $stmt->bindParam(":itens",$this->iditenspedido);
        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }

}


?>
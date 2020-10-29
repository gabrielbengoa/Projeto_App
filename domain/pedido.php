<?php

class Pedido{
    public $idpedido;
    public $idcliente;
    public $datapedido;

    public function __construct($db){
        $this->conexao = $db;
    }


    public function listar(){
        $query = "select * from pedido";
       
        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){
        $query = "insert into pedido set idcliente=:idcli";

        $stmt = $this->conexao->prepare($query);

        $stmt->bindParam(":idcli",$this->idcliente);

        $stmt->execute();

        $this->idpedido = $this->conexao->lastInsertId();

        return $this->idpedido;
    }
}


?>
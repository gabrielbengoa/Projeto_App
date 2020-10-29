<?php

class Pagamento{

public $idpagamento;
public $idpedido;
public $tipo;
public $descricao;
public $valor;
public $parcelas;
public $valorparcela;
public $idcliente;

    public function __construct($db){
        $this->conexao = $db;
    }


    public function listar(){
        $query = "select * from pagamento";
      
        $stmt = $this->conexao->prepare($query);

        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){



        $queryPedido = "insert into pedido set idcliente=:idcli";

        $stmtPedido = $this->conexao->prepare($queryPedido);

        $stmtPedido->bindParam(":idcli",$this->idcliente);

        $stmtPedido->execute();

        $this->idpedido = $this->conexao->lastInsertId();




        $query = "insert into pagamento set idpedido=:ip, tipo=:t,descricao=:d,valor=:v,parcelas=:p,valorparcela=:vp";

        $stmt = $this->conexao->prepare($query);
        


$stmt->bindParam(":ip",$this->idpedido);
$stmt->bindParam(":t",$this->tipo);
$stmt->bindParam(":d",$this->descricao);
$stmt->bindParam(":v",$this->valor);
$stmt->bindParam(":p",$this->parcelas);
$stmt->bindParam(":vp",$this->valorparcela);



        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


}


?>
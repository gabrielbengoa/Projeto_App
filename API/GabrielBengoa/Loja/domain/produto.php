<?php

class Produto{

public $idproduto;
public $nomeproduto;
public $descricao;
public $preco;
public $idfoto;
public $foto1;
public $foto2;
public $foto3;
public $foto4;


public function __construct($db){
    $this->conexao = $db;
}

public function listar(){
    $query = "select * from produto";

    $stmt = $this->conexao->prepare($query);

    $stmt->execute();

    return $stmt;
}

public function detalheProduto($id){
    $query = "select p.idproduto, p.nomeproduto, p.descricao, p.preco, f.foto1,f.foto2,f.foto3,foto4
    from produto p inner join foto f on p.idfoto=f.idfoto where idproduto=:id";
    $stmt=$this->conexao->prepare($query);

    $stmt->bindParam(":id",$id);

    $stmt->execute();

    return $stmt;
}


public function listarTelaInicial(){
    $query = "select p.idproduto,p.nomeproduto, p.preco, f.foto1 from produto p inner join foto f on p.idfoto=f.idfoto";
    $stmt = $this->conexao->prepare($query);

    $stmt->execute();

    return $stmt;
}


public function carrinho($id){
    $query = "select p.idproduto,p.nomeproduto, p.preco, f.foto1 from produto p inner join foto f on p.idfoto=f.idfoto where idproduto in(".$id.")";
    $stmt = $this->conexao->prepare($query);

    $stmt->execute();

    return $stmt;
}



public function cadastro(){
    $queryFoto = "insert into foto set foto1=:f1,foto2=:f2,foto3=:f3,foto4=:f4";

    $stmtFoto = $this->conexao->prepare($queryFoto);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
    $stmtFoto->bindParam(":f1",$this->foto1);
    $stmtFoto->bindParam(":f2",$this->foto2);
    $stmtFoto->bindParam(":f3",$this->foto3);
    $stmtFoto->bindParam(":f4",$this->foto4);


    $stmtFoto->execute();

    $this->idfoto = $this->conexao->lastInsertId();


    $query = "insert into produto set nomeproduto=:np, descricao=:d, preco=:p, idfoto=:if";

    $stmt = $this->conexao->prepare($query);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
    $stmt->bindParam(":np",$this->nomeproduto);
    $stmt->bindParam(":d",$this->descricao);
    $stmt->bindParam(":p",$this->preco);
    $stmt->bindParam(":if",$this->idfoto);

    if($stmt->execute()){
        return true;
    }
    else{
        return false;
    }

}

public function atualizarproduto(){
    
    $consultaproduto="update produto set nomeproduto=:n,descricao=:d,preco=:p where idfoto=:idp";
    $stmtproduto = $this->conexao->prepare($consultaproduto);
    
    $stmtproduto->bindParam(":n",$this->nomeproduto);
    $stmtproduto->bindParam(":d",$this->descricao);
    $stmtproduto->bindParam(":p",$this->preco);
    $stmtproduto->bindParam(":idp",$this->idfoto);

    $stmtproduto->execute();

    $consultafoto="update foto set foto1=:f1,foto2=:f2,foto3=:f3,foto4=:f4 where idfoto=:idf";
    $stmtfoto = $this->conexao->prepare($consultafoto);

   $stmtfoto->bindParam(":f1",$this->foto1);
   $stmtfoto->bindParam(":f2",$this->foto2);
   $stmtfoto->bindParam(":f3",$this->foto3);
   $stmtfoto->bindParam(":f4",$this->foto4);
   $stmtfoto->bindParam(":idf",$this->idfoto);

    $stmtfoto->execute();

    return true;
}
}
?>
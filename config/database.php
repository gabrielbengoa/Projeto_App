<?php

class Database{
    public $conexao;

    public function getConnection(){
        try{
            $conexao = new PDO("mysql:host=PowerTech;port=3310;dbname=dbpwrtch","root","");
            $conexao->exec("set name utf8");
        }
        catch(PDOException $e){
            echo "Erro ao estabelecer a conexão com o banco de dados. ".$e->getmessage();
        }
        return $conexao;
    }
}






?>
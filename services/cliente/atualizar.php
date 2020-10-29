<?php

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:PUT");

include_once "../../config/database.php";
include_once "../../domain/usuarios.php";

$database = new Database();
$db-$database->getConnection();

$cliente = new Cliente($db);

$data = json_decode(file_get_contents("php://input"));
$cliente->idcliente=$data->idcliente;
$cliente->nomecliente=$data->nomecliente;
$cliente->email=$data->email;
$cliente->sexo=$data->sexo;
$cliente->telefone=$data->telefone;
$cliente->cpf=$data->cpf;
$cliente->usuario=$data->usuario;
$cliente->nomecliente=$senha->senha;

if($paciente->atualizar()){
    header("HTTP/1.0 201");
    echo json_encode(array("mensagem"=>"Cliente atualizado com sucesso"));
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não foi possível atualizar"));
}


?>
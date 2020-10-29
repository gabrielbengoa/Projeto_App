<?php


header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");
header("Access-Control-Allow-Methods:POST");

include_once "../../config/database.php";

include_once "../../domain/cadastro.php";

$database = new Database();
$db = $database->getConnection();

$cadastro = new Cadastro($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->nomeusuario) && !empty($data->senha) && !empty($data->foto)){

      $cadastro->nomecliente=$data->nomecliente;
      $cadastro->cpf=$data->cpf;
      $cadastro->sexo=$data->sexo;
      $cadastro->telefone=$data->telefone;
      $cadastro->email=$data->email;
      $cadastro->tipo=$data->tipo;
      $cadastro->logradouro=$data->logradouro;
      $cadastro->numero=$data->numero;
      $cadastro->complemento=$data->complemento;
      $cadastro->bairro=$data->bairro;
      $cadastro->cep=$data->cep;
      $cadastro->nomeusuario=$data->nomeusuario;
      $cadastro->senha=$data->senha;
      $cadastro->foto=$data->foto;

    if($cadastro->cadastro()){
        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Cliente cadastrado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível cadastrar"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>
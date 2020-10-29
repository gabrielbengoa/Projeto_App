create database dbpwrtch;
use dbpwrtch;

create table usuario(
idusuario int auto_increment primary key,
nomeusuario varchar(20) not null unique,
senha varchar(200) not null,
foto varchar(200) not null
)engine Innodb;

create table endereco(
idendereco int auto_increment primary key,
tipo varchar(10) not null,
logradouro varchar(100) not null,
numero varchar(10) not null,
complemento varchar(20) not null,
bairro varchar(50) not null,
cep varchar(10) not null
)engine Innodb;

create table contato(
idcontato int auto_increment primary key,
email varchar(100) not null,
telefone varchar(20) not null
)engine InnoDB;

create table cliente(
idcliente int auto_increment primary key,
nomecliente varchar(50) not null,
cpf varchar(13) not null unique,
sexo char(5) not null,
idcontato int not null,
idendereco int not null,
idusuario int not null
)engine InnoDB;

create table produto(
idproduto int auto_increment primary key,
nomeproduto varchar(50) not null,
descricao text not null,
preco decimal(10,2) not null,
idfoto int not null
)engine InnoDB;

create table foto(
idfoto int auto_increment primary key,
foto1 varchar(200) not null,
foto2 varchar(200) not null,
foto3 varchar(200) not null,
foto4 varchar(200) not null
)engine InnoDB;

create table pedido(
idpedido int auto_increment primary key,
idcliente int not null,
datapedido timestamp default current_timestamp()
)engine InnoDB;

create table itenspedido(
iditens int auto_increment primary key,
idpedido int not null,
idproduto int not null,
quantidade int default 1 not null 
)engine InnoDB;

create table pagamento(
idpagamento int auto_increment primary key,
idpedido int not null,
tipo varchar(20) not null,
descricao varchar(200) not null,
valor decimal(10,2) not null,
parcelas int default 1 not null,
valorparcela decimal(10,2) not null
)engine InnoDB;

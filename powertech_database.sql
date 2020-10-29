create database dbpwrtch;
use dbpwrtch;
create table cadastrocli(
idcliente int primary key auto_increment,
nomecliente varchar(50) not null,
email varchar(100) not null unique,
sexo varchar(2) not null,
telefone varchar(9) not null,
cpf varchar(11) not null,
usuario varchar(20) not null unique,
senha varchar(200)  not null
)engine InnoDB;

insert into cadastrocli (nomecliente, email, sexo, telefone, cpf, usuario, senha)
values('Gabriel','gabrielbengoa@ig.com.br','M','9555-5555','06315273806','biel',md5('gabriel.bbengoa'));
select * from cadastrocli;


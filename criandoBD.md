Criar um banco de dados no phpmyadmin:

create database aulaprogweb;
use aulaprogweb;

create table tab_pessoa (
    cod_pessoa int Primary Key auto_increment,
    nome varchar(100),
    cpf varchar(14),
    email varchar(100)
);
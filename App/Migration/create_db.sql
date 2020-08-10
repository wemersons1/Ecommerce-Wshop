create table fornecedores(
    id_fornecedor int not null primary key AUTO_INCREMENT,
    nome_fornecedor varchar(30) not null,
    logo varchar(200)not null,
    descricao_fornecedor varchar(200) not null,
    site varchar(30) not null
);


create table produtos(                   
    id int not null primary key AUTO_INCREMENT,
    nome varchar(30),
    preco float not null,
    imagem varchar(200) not null,
    descricao varchar(200) not null,
    id_fornecedor int,
    FOREIGN key(id_fornecedor) references fornecedores(id_fornecedor)
    
 );

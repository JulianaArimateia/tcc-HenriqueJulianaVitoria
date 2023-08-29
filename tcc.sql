use tcc;

select * from reservasprodutos;
select * from usuarios;
select * from produtos;

create table favoritos (
 id int not null auto_increment primary key,
 id_produtos int not null,
 id_usuarios int not null,
 date_cadastro datetime default current_timestamp,
foreign key (id_produtos) references produtos (id),
foreign key (id_usuarios) references usuarios (id)

);
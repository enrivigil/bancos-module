create table catalogo(
    id int primary key auto_increment,
    codigo varchar(12),
    cuenta varchar(255),
    jerarquia int,
    nivel int,
    tipo_cargo varchar(50),
    tipo_cuenta varchar(50)
);
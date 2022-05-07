 -- drop database if EXISTS podekex;
-- drop database pokedex

create database pokedex;
/* 
 use pokedex;
*/
create table login (
	id integer unique auto_increment primary key,  
	nombre varchar(25) not null,
	email varchar(60) not null, 
	password varchar(61) not null
);

create table usuario (
	id integer not null unique auto_increment,  
	login integer not null,
	nombre varchar(25),
	primary key (id),
	foreign key (login) references login(id)
);

create table tipo(
	id integer not null unique auto_increment,  
	nombre varchar(25) not null,
	imagen varchar(50) not null,
	primary key (id)
);

create table pokemon(
	id integer not null unique auto_increment,  
	numero integer not null, 
	nombre varchar(40) not null,
	descripcion varchar(255) not null, 
	imagen varchar(50) not null,
	tipo1 integer not null,
	tipo2 integer,
	primary key (id),
	foreign key (tipo1) references tipo(id),
	foreign key (tipo2) references tipo(id)
);

/*
 * usuario solo la tabla pokemon y select en tipo
 u:p
 pokedex:pokedex123
 */
create user "pokedex"@"localhost" identified by "pokedex123";
grant select, insert, update, delete on pokedex.pokemon to "pokedex"@"localhost";
grant select on pokedex.tipo to "pokedex"@"localhost";
grant select on pokedex.login  to "pokedex"@"localhost";
grant select on pokedex.usuario  to "pokedex"@"localhost";
show grants for "pokedex"@"localhost";

insert into tipo (nombre, imagen) values
--1
("Acero", "./tipos/Tipo_acero.webp"),
("Agua", "./tipos/Tipo_agua.webp"),
("Bicho", "./tipos/Tipo_bicho.webp"),
("Drag�n", "./tipos/Tipo_dragon.webp"),
-- 5
("El�ctrico", "./tipos/Tipo_electrico.webp"),
("Fantasma","./tipos/Tipo_fantasma.webp"),
("Fuego", "./tipos/Tipo_fuego.webp"),
("Hada", "./tipos/Tipo_hada.webp"),
("Hielo", "./tipos/Tipo_hielo.webp"),
-- 10
("Lucha", "./tipos/Tipo_lucha.webp"),
("Normal", "./tipos/Tipo_normal.webp"),
("Planta", "./tipos/Tipo_planta.webp"),
("Ps�quico", "./tipos/Tipo_psiquico.webp"),
("Roca", "./tipos/Tipo_roca.webp"),
-- 15
("Siniestro", "./tipos/Tipo_siniestro.webp"),
("Tierra", "./tipos/Tipo_tierra.webp"),
("Veneno", "./tipos/Tipo_veneno.webp"),
("Volador", "./tipos/Tipo_volador.webp"),
("???", "./tipos/Tipo_ .webp");

insert into pokemon (numero, nombre, descripcion, imagen, tipo1, tipo2) values
(1, "Bulbasaur", "Una rara semilla fue plantada en su espalda al nacer. La planta brota y crece con este Pok�mon.", "Bulbasaur.webp", 12, 17 ),
(2, "Ivysaur", "Cuando el bulbo de su espalda crece, parece no poder ponerse de pie sobre sus patas traseras.", "Ivysaur.webp", 12, 17 ),
(3, "Venusaur", "La planta florece cuando absorbe energ�a solar. �sta le obliga a ponerse en busca de la luz solar.", "Venusaur.webp", 12, 17 ),
(4, "Charmander", "Prefiere los sitios calientes. Dicen que cuando llueve sale vapor de la punta de su cola.", "Charmander.webp", 7, null);
-- 5 

/*
 "admin"
password hash = $2y$10$q7SPSf5CBUR30fYFAOLKB..SZ.VDK3M8dFfiAfDcmxI/RyVdruNV2  60
md5: 21232f297a57a5a743894a0e4a801fc3  32
sha1 d033e22ae348aeb5660fc2140aec35850c4da997 40
 */
insert into login (nombre, email, password) values 
("Admin", "admin@pokedex.com", "21232f297a57a5a743894a0e4a801fc3")

insert into usuario (login, nombre) values
(1, "Admin");

	
	
/*
 * login
 */
select * from pokedex.login;

select * from pokedex.login
where pokedex.login.nombre like "a%";

select * from pokedex.login
where pokedex.login.nombre like "s%";

select * from pokedex.login
where pokedex.login.nombre  like "admin"
and pokedex.login.email  like  "admin@pokedex.com"
and pokedex.login.password like "21232f297a57a5a743894a0e4a801fc3";

/*
 * usuario
 */
select * from pokedex.usuario;
select * from pokedex.usuario
where pokedex.usuario.login = 1;

select * from pokedex.usuario
where pokedex.usuario.nombre like "Admin";

select * from pokedex.usuario
where pokedex.usuario.nombre like "d%";

/*
 * tipo
 */
select * from pokedex.tipo;

select * from pokedex.tipo
where pokedex.tipo.nombre like "fire";
select * from pokedex.tipo
where pokedex.tipo.nombre like "fuego";

/*
 * pokemon 
 */

select * from pokedex.pokemon;

select * from pokedex.pokemon
where pokedex.pokemon.nombre like "C%";

select * from pokedex.pokemon
where pokedex.pokemon.numero = 3;

select * from pokedex.pokemon
where pokedex.pokemon.descripcion like "L%"

select pokedex.pokemon.numero,
pokedex.pokemon.nombre
from pokedex.pokemon

select pokedex.pokemon.numero,
pokedex.pokemon.nombre,
tipo1.nombre, 
tipo1.imagen 
from pokedex.pokemon
inner join pokedex.tipo as tipo1
on pokedex.pokemon.tipo1 = pokedex.tipo.id ;

select pokedex.pokemon.numero, 
pokedex.pokemon.nombre,
pokedex.pokemon.descripcion,
pokedex.pokemon.imagen,
primertipo.nombre,
primertipo.imagen,
segundotipo.nombre,
segundotipo.imagen
from pokedex.pokemon
inner join pokedex.tipo as primertipo
on primertipo.id  = pokedex.pokemon.tipo1
left join pokedex.tipo as segundotipo
on segundotipo.id  = pokedex.pokemon.tipo2;


select pokedex.pokemon.numero as "numero", 
pokedex.pokemon.nombre as "nombre",
pokedex.pokemon.descripcion as "descripcion",
pokedex.pokemon.imagen as "imagen",
primertipo.nombre as "tipo 1",
primertipo.imagen as "Tipo 1 imagen",
segundotipo.nombre as "tipo 2",
segundotipo.imagen as "tipo 2 imagen"
from pokedex.pokemon
inner join pokedex.tipo as primertipo
on primertipo.id  = pokedex.pokemon.tipo1
left join pokedex.tipo as segundotipo
on segundotipo.id  = pokedex.pokemon.tipo2
where pokedex.pokemon.nombre  like "c%";

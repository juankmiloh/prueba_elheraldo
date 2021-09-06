-- Obtener datos de fotos con su respectiva cantidad de votos
select f.*, (case when votos.cantidad is not null then votos.cantidad else 0 end) as cantidad from
(select u.oauth_uid as id, u.picture, concat(u.first_name, ' ',last_name) as nombre, f.idfoto, f.ruta from foto f, users u where f.oauth_uid = u.oauth_uid) f
left join
(select v.idfoto, count(*) as cantidad from voto v, foto f where v.idfoto = f.idfoto group by v.idfoto) votos
on f.idfoto=votos.idfoto
order by votos.cantidad desc;
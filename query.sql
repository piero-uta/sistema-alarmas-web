select u2.token_celular from
(select distinct uc2.usuario_id from 
usuarios_comunidad uc1, 
redes_avisos, 
usuarios_comunidad uc2
where 
uc1.comunidad_id =1 and 
uc1.usuario_id = 174 and 
uc1.direccion_id = redes_avisos.direccion_id and 
uc2.direccion_id = redes_avisos.direccion_vecino_id) r,
users u2
where u2.id = r.usuario_id;
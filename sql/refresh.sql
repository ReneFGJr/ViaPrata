select 1+1;
update clientes set cliente_id_conta_corrente = 0 where cliente_id_conta_corrente isnull ;
update clientes set cliente_dt_cadastro = 20010101 where cliente_dt_cadastro isnull ;
update clientes set cliente_id_logon_cadastro = 0 where cliente_id_logon_cadastro isnull ;
update clientes set cliente_lastupdate = 20010101 where cliente_lastupdate isnull ;
update clientes set cliente_lastupdate_log = 0 where cliente_lastupdate_log isnull ;

update clientes set cliente_limite_credito = 0 where cliente_limite_credito isnull ;
update clientes set cliente_potencial_cliente = 0 where cliente_potencial_cliente isnull ;
update clientes set cliente_lastupdate_log = 0 where cliente_lastupdate_log isnull ;


$sql = "CREATE TABLE contas_tipo (  id_ct serial NOT NULL,  ct_codigo char(5),  ct_descricao char(40),  ct_lastupdate int8,  ct_tipo char(1),  ct_ativo int2) ";
$rlt = db_query($sql);

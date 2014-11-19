<?
$include = '../';
require("../cab.php");
require($include.'sisdoc_debug.php');
$sql = "
CREATE TABLE access_perfil
(
  id_ap serial NOT NULL,
  ap_cod character(1),
  ap_descricao character(30),
  CONSTRAINT key_access_perfil PRIMARY KEY (id_ap)
);

CREATE TABLE access_ref
(
  id_ar serial NOT NULL,
  ar_ref character(5) NOT NULL,
  ar_descricao character(50),
  ar_sistema character(5),
  ar_perf0 character(1),
  ar_perf1 character(1),
  ar_perf2 character(1),
  ar_perf3 character(1),
  ar_perf4 character(1),
  ar_perf5 character(1),
  ar_perf6 character(1),
  ar_perf7 character(1),
  ar_perf8 character(1),
  ar_perf9 character(1),
  ar_page character(100),
  CONSTRAINT key_access_ref PRIMARY KEY (ar_ref)
);

insert into access_perfil(ap_cod,ap_descricao) values ('1','Operador 1'); 
insert into access_perfil(ap_cod,ap_descricao) values ('0','Visitante'); 
insert into access_perfil(ap_cod,ap_descricao) values ('9','Coordenador'); 
insert into access_perfil(ap_cod,ap_descricao) values ('8','Supervisor'); 
insert into access_perfil(ap_cod,ap_descricao) values ('7','Gestor'); 
insert into access_perfil(ap_cod,ap_descricao) values ('2','Operador 2'); 
insert into access_perfil(ap_cod,ap_descricao) values ('3','Operador 3'); 
insert into access_perfil(ap_cod,ap_descricao) values ('4','Financeiro'); 
insert into access_perfil(ap_cod,ap_descricao) values ('5','Auditor'); 
insert into access_perfil(ap_cod,ap_descricao) values ('6','RH');

";
echo '<PRE>'.$sql.'</PRE>';
$rlt = db_query($sql);
?>
--DROP TABLE orcamento;
--DROP TABLE orcamento_item;

CREATE TABLE orcamento
(
  o_orcamento char(7),
  o_nome char(60),
  o_itens int8,
  o_valor float8,
  o_desconto float8,
  o_data int8,
  o_hora char(5),
  o_vendedor char(5),
  o_status char(1) DEFAULT 'A'::bpchar,
  o_lastupdate int8,
  o_cliente char(7),
  o_id int2,
  id_o serial
);

CREATE TABLE orcamento_item
(
  oi_id serial NOT NULL,
  oi_codigo char(10),
  oi_quan int2,
  oi_vlr_unit float8,
  oi_vlr_total float8,
  oi_desconto float8,
  oi_data int8,
  oi_hora char(5),
  oi_log char(10),
  oi_status char(1),
  oi_orcamento char(7)
) 
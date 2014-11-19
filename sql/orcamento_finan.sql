--DROP TABLE orcamento_fp;
--DROP TABLE orcamento_item;


CREATE TABLE orcamento_fp
(
  of_id serial NOT NULL,
  of_orcamento char(7),
  of_valor float8,
  of_data int8,
  of_hora char(5),
  of_venc int8,
  of_vendedor char(5),
  of_status char(1) DEFAULT 'A'::bpchar,
  of_cliente char(7),
  of_tipo char(1),
  of_descricao char(70),
  of_doc char(30)
);


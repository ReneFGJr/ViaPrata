CREATE TABLE orcamento_fp_feira
(
  of_id serial NOT NULL,
  of_orcamento character(7),
  of_valor double precision,
  of_data bigint,
  of_hora character(5),
  of_venc bigint,
  of_vendedor character(5),
  of_status character(1) DEFAULT 'A'::bpchar,
  of_cliente character(7),
  of_tipo character(1),
  of_descricao character(70),
  of_doc character(30)
)
CREATE TABLE pedido
(
  p_pedido char(7),
  p_nome char(60),
  p_itens int8,
  p_valor float8,
  p_desconto float8,
  p_data int8,
  p_hora char(5),
  p_vendedor char(5),
  p_status char(1) DEFAULT 'A'::bpchar,
  p_lastupdate int8,
  p_cliente char(7),
  id_p serial
);

CREATE TABLE pedido_item
(
  pi_id serial NOT NULL,
  pi_codigo char(10),
  pi_quan int2,
  pi_vlr_unit float8,
  pi_vlr_total float8,
  pi_desconto float8,
  pi_data int8,
  pi_hora char(5),
  pi_log char(10),
  pi_status char(1),
  pi_pedido char(7)
) 
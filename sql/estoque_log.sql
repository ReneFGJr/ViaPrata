CREATE TABLE estoque_log
(
  el_data int8,
  el_hora char(5),
  el_ip char(15),
  el_user int2,
  el_codigo char(15),
  el_quan float8,
  el_pedido char(8),
  el_status char(1),
  id_el serial
);

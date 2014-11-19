<?php
class representante
	{
	var $tabela = 'vendedores';
	
	var $nome = '';
	var $codigo = '';
	
	function le($id)
		{
			$sql = "select * from ".$this->tabela." where vd_codigo = '".$id."' ";
			$rlt = db_query($sql);
			if ($line = db_read($rlt))
				{
					$this->line = $line;
					$this->nome = trim($line['vd_nome']);
					$this->codigo = trim($line['vd_codigo']);
					return(1);
				}
		}	
	function mostra_simples()
		{
			$sx .= '<h2>'.$this->nome.'</h2>';
			return($sx);
		}
	}
?>
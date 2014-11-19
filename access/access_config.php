<?
$breadcrumbs=array();
array_push($breadcrumbs, array('/fonzaghi/sensual/index.php','Sensual'));

$include = '../';
require("../cab.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
access();

$ref = $dd[0];

	//////////////////////////////// Referência igual a branco
	if (strlen($ref) == 0)
		{
			echo '<center><h1>Referência não existe</h1></center>';
			exit;
		}
		
	//////////////////////////////// Referência não existe
	$sql = "select * from access_ref where ar_ref = '".$ref."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
			$npag = $line['ar_ref'];
			$ndesc = $line['ar_page'];
			
		} else {
			echo '<center><h1>Página não existe</h1>'.$ref.'</center>';
			exit;
		}
	
	$ops = array('-' => 0,'R' => 1, 'W' => 2 ,'A' => 3, '*' =>4 );
	$ta  = '-:Restrito';
	$ta .= '&R:Somente leitura';
	$ta .= '&W:Gravação de Informações';
	$ta .= '&A:Inserção e alteração de informação';
	$ta .= '&*:Inserção, alteração e exclusão (não recomendado)';
	
	$sql = "select * from access_perfil order by ap_cod ";
	$rlt = db_query($sql);
	
	$rc = array();
	while ($line = db_read($rlt))
		{
		array_push($rc,$line['ap_descricao']);
		}
	?>
	<table width="<?=$tab_max;?>" class="lt1">
	<TR><TH>Página</TH><TH>Descrição</TH></TR>
	<TR><TD><?=$npag;?></TD><TD><?=$ndesc;?></TD></TR>
	<TR><TH>Perfil</TH><TH>Acesso</TH></TR>
	</table>
	<?
	$tabela = "access_ref";
	$cp = array();
	array_push($cp,array('$H4','id_ar','id_ar',False,True,''));

	for ($rcc=0;$rcc < count($rc);$rcc++)
		{
		array_push($cp,array('$O '.$ta,'ar_perf'.$rcc,$rc[$rcc],False,True,''));
		}

	?><TABLE width="<?=$tab_max;?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
if ($saved > 0)
	{
	redirecina('ed_access_ref.php');
	}
?>

<? require($vinclude."foot.php");	?>
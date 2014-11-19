<?
$breadcrumbs=array();
array_push($breadcrumbs, array('/fonzaghi/gerencial.php','Gerencial'));
array_push($breadcrumbs, array('/fonzaghi/ed_pc_contas.php','Plano de Contas'));

require("cab.php");
require($include."sisdoc_colunas.php");
$tabela = "access_ref";
$idcp = "ar";
$label = "Controle de Acesso";
$http_edit = 'ed_edit.php'; 
$http_edit_para = '&dd99='.$tabela; 
$editar = false;

$http_ver = "access_config.php";

$http_redirect = 'ed_'.$tabela.'.php';
$cdf = array($idcp.'_ref',$idcp.'_page',$idcp.'_descricao','ar_perf0','ar_perf1','ar_perf2','ar_perf3','ar_perf4','ar_perf5','ar_perf6','ar_perf7','ar_perf8','ar_perf9',	$idcp.'_ref');
$cdm = array('Código','page','Descrição','0','1','2','3','4','5','6','7','8','9','ref');
$masc = array('','','','','','','','','');
$busca = true;
$offset = 20;
//	$pre_where = " (ch_ativo = 1) ";
$order  = $idcp."_page ";
//exit;
echo '<TABLE width="'.$tab_max.'" align="center"><TR><TD>';
require($include.'sisdoc_row.php');	
echo '</table>';
?>
<? require($vinclude."foot.php");?>
<?
require("cab.php");
require($include.'sisdoc_colunas.php');
$label = "Cadastro de rotinas do sistema";
//$sql = "delete from pibic_professor where pp_cracha = '' ";
//$rlt = db_query($sql);

if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php';
	$http_edit_para = '&dd99=pibic_professor'; 
	$editar = true;
	}
	$idc = "pp";
	$http_redirect = 'ed_pibic_professor.php';
//	$http_ver = 'sistema.php';
	$tabela = "pibic_professor";
	$cdf = array('id_pp','pp_nome','pp_cracha','pp_centro','pp_carga_semanal','pp_ss','pp_prod','pp_curso','pp_update','pp_ativo');
	$cdm = array('Código','Nome','cracha','centro','carga','ss','prod','curso','Atualizado','Ativo');
	$masc = array('','','','','','','SN');
	$busca = true;
	$offset = 20;
	if (strlen($dd[1]) == 0)
		{
		$pre_where = " (".$idc."_ativo = 1) ";
		}
	$order  = "pp_nome ";
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>
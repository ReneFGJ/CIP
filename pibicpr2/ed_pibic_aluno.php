<?
require("cab.php");
$label = "Cadastro de rotinas do sistema";
if ($user_nivel == 9)
	{	
	$http_edit = 'ed_edit.php';
	$http_edit_para = '&dd99=pibic_aluno'; 
	$editar = true;
	}
	$idc = "pa";
	$http_redirect = 'ed_pibic_aluno.php';
	$http_ver = 'pibic_aluno.php';
	$tabela = "pibic_aluno";
	$cdf = array('id_pa','pa_nome','pa_cracha','pa_carga_semanal','pa_ss','pa_curso','pa_update','pa_ativo');
	$cdm = array('Código','Nome','cracha','carga','ss','curso','Ativo');
	$masc = array('','','','','','','D','SN');
	$busca = true;
	$offset = 20;
	if (strlen($dd[1]) == 0)
		{
		$pre_where = " (".$idc."_ativo = 1) ";
		}
	$order  = "pa_nome ";
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>
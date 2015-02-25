<?
$debug = true;
require("cab.php");
//$sql = "update pareceristas set us_aceito = 10 where us_aceito = 1 and us_email like '%pucpr%'";
//$rlt = db_query($sql);

$label = "Cadastro de pareceristas";
$tabela = "(pareceristas left join instituicao on inst_codigo = us_instituicao) as parecerista ";
if ($user_nivel > 5)
		{
		$http_edit = 'ed_edit.php';
		$http_edit_para = '&dd99=pareceristas'; 	
		}
	$http_redirect = 'ed_pareceristas.php';
	$http_ver = 'parecerista_areas.php';

	$cdf = array('id_us','us_nome','inst_abreviatura','us_bolsista','us_email','us_aceito','us_ativo','us_codigo');
	$cdm = array('Cσdigo','Nome','instituiηγo','Produtividade','e-mail','aceito','ativo','codigo');
	$masc = array('','','','','','','SN');
	$busca = true;
	$offset = 20;
	$pre_where = " (us_ativo  = 1) and (us_journal_id = ".intval($journal_id).") ";
	$pre_where = " (us_journal_id = ".intval($journal_id).") ";
	echo $pre_where;
	$order  = "us_nome ";
if ($user_nivel >= 9)
	{	
	$editar = true;
	}
	require($include.'sisdoc_row.php');	
	
require("foot.php");	
?>
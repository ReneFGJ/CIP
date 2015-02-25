<?
require("db.php");
$dr = 'ed_'.$dd[0].'.php';

///////////////	SUBMISSAO
if ($dd[0] == 'pareceristas') 
	{$dx1 = "us_codigo";	$dx2 = "us"; 	$dx3 = "7"; }
if ($dd[0] == 'reol_submit') 
	{$dx1 = "doc_protocolo";	$dx2 = "doc"; 	$dx3 = "7"; }

	
if ($dd[0] == 'editora_grupos') 
	{$dx1 = "grp_codigo";	$dx2 = "grp"; 	$dx3 = "7"; }


if ($dd[0] == 'pibic_submit_documento') 
	{$dx1 = "doc_protocolo";	$dx2 = "doc"; 	$dx3 = "7"; }
	
///////////////	
if ($dd[0] == 'article') { $dx2 = ''; $dx1 = $dx2.""; $dx3 = ""; $dr = 'http://www2.pucpr.br/reol/pibicpr/edicoes_ver.php?dd0=151'; }


if ($dd[0] == 'ajax_areadoconhecimento') 
	{$dx1 = "a_codigo";	$dx2 = "aa"; 	$dx3 = "7"; }
if ($dd[0] == 'apoio_titulacao')
	{$dx1 = "ap_tit_codigo";	$dx2 = "ap_tit"; 	$dx3 = "3";	$dr = "ed_".$dd[0].".php"; }
if ($dd[0] == 'instituicoes')
	{$dx1 = "inst_codigo";	$dx2 = "inst"; 	$dx3 = "7";	$dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'ic_noticia') 
	{$dx1 = "";	$dx2 = ""; 	$dx3 = ""; $dr = 'mensagens_ver.php'; }


///////////////	
if ($dd[0] == 'usuario') { $dx2 = 'us'; $dx1 = $dx2."_codigo"; $dx3 = "7"; }
if ($dd[0] == 'usuario_grupo_nome') { $dx2 = 'gun'; $dx1 = $dx2."_codigo"; $dx3 = "7"; $dr = 'ed_grupos.php'; }

if ($dd[0] == 'editora')
	{$dx1 = "ed_codigo";	$dx2 = "ed"; 	$dx3 = "7";	$dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'editora_termo')
	{$dx1 = "edt_codigo";	$dx2 = "edt"; 	$dx3 = "7";	$dr = "ed_".$dd[0].".php"; }

if ($dd[0] == 'submit_manuscrito_tipo')
	{$dx1 = "sp_codigo";	$dx2 = "sp"; 	$dx3 = "5"; }
	
if ($dd[0] == 'submit_local')
	{$dx1 = "lc_codigo";	$dx2 = "lc"; 	$dx3 = "5"; }
	
if ($dd[0] == 'submit_manuscrito_field')
	{$dx1 = "sub_codigo";	$dx2 = "sub"; 	$dx3 = "5"; }

if ($dd[0] == 'submit_crono_orca')
	{$dx1 = "ocr_codigo";	$dx2 = "ocr"; 	$dx3 = "5"; }

if ($dd[0] == 'submit_documentos_obrigatorio')
	{$dx1 = "sdo_codigo";	$dx2 = "sdo"; 	$dx3 = "5"; }			

/////////// AJAX
if ($dd[0] == 'ajax_pais') { $dx2 = 'pais'; $dx1 = $dx2."_codigo"; $dx3 = "7"; }
if ($dd[0] == 'ajax_estado') { $dx2 = 'estado'; $dx1 = $dx2."_codigo"; $dx3 = "7"; }
if ($dd[0] == 'ajax_cidade') { $dx2 = 'cidade'; $dx1 = $dx2."_codigo"; $dx3 = "7"; }

if ($dd[0] == 'ca_instituicao') { $dx2 = 'ci'; $dx1 = $dx2."_codigo"; $dx3 = "7"; }
if ($dd[0] == 'ca_autor') { $dx2 = 'aa'; $dx1 = $dx2."_codigo"; $dx3 = "7"; }

if ($dd[0] == 'nucleo')
	{$dx1 = "nucleo_codigo";	$dx2 = "nucleo"; 	$dx3 = "5"; }

	
if ($dd[0] == 'ge_edicoes')
	{$dx1 = "ge_codigo";	$dx2 = "ge"; 	$dx3 = "7"; $dr = "edicoes.php"; }	
	
if (strlen($dx1) > 0)
	{
	$sql = "update ".$dd[0]." set ".$dx1."=trim(to_char(id_".$dx2.",'".strzero(0,$dx3)."')) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";
	
	//echo $sql;
	$rlt = db_query($sql);
	}
	
header("Location: ".$dr);
echo 'Stoped'; exit;
?>
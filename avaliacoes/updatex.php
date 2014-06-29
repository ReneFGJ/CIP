<?
require("db.php");
$dr = 'ed_'.$dd[0].'.php';

if ($dd[0] == 'nucleo')
	{$dx1 = "nucleo_codigo";	$dx2 = "nucleo"; 	$dx3 = "5"; }

//////////////////////
if ($dd[0] == 'submit_cep_answer')
	{$dx1 = "aw_codigo";	$dx2 = "aw"; 	$dx3 = "7"; }	
if ($dd[0] == 'submit_ceua_answer')
	{$dx1 = "aw_codigo";	$dx2 = "aw"; 	$dx3 = "7"; }	

//////////////////////
if ($dd[0] == 'submit_manuscrito_tipo')
	{$dx1 = "sp_codigo";	$dx2 = "sp"; 	$dx3 = "5"; }

if ($dd[0] == 'submit_manuscrito_ceua_tipo')
	{$dx1 = "sp_codigo";	$dx2 = "sp"; 	$dx3 = "5"; }
//////////////////////
if ($dd[0] == 'submit_local')
	{$dx1 = "lc_codigo";	$dx2 = "lc"; 	$dx3 = "5"; }
	
if ($dd[0] == 'submit_ceua_local')
	{$dx1 = "lc_codigo";	$dx2 = "lc"; 	$dx3 = "5"; }
///////////////////////
if ($dd[0] == 'submit_manuscrito_field')
	{$dx1 = "sub_codigo";	$dx2 = "sub"; 	$dx3 = "5"; }

if ($dd[0] == 'submit_manuscrito_ceua_field')
	{$dx1 = "sub_codigo";	$dx2 = "sub"; 	$dx3 = "5"; }
/////////////////////////
if ($dd[0] == 'submit_crono_orca')
	{$dx1 = "ocr_codigo";	$dx2 = "ocr"; 	$dx3 = "5"; }

if ($dd[0] == 'submit_ceua_crono_orca')
	{$dx1 = "ocr_codigo";	$dx2 = "ocr"; 	$dx3 = "5"; }

///////////////////////////
if ($dd[0] == 'submit_documentos_obrigatorio')
	{$dx1 = "sdo_codigo";	$dx2 = "sdo"; 	$dx3 = "5"; }
	
if ($dd[0] == 'submit_ceua_documentos_obrigatorio')
	{$dx1 = "sdo_codigo";	$dx2 = "sdo"; 	$dx3 = "5"; $dr = 'ed_submit_documentos_ceua_obrigatorio.php'; }	
	
if ($dd[0] == 'submit_documentos_ceua_obrigatorio')
	{$dx1 = "sdo_codigo";	$dx2 = "sdo"; 	$dx3 = "5"; $dr = 'ed_submit_documentos_ceua_obrigatorio.php'; }	

if ($dd[0] == 'perfis')
	{$dx1 = "pf_codigo";	$dx2 = "pf"; 	$dx3 = "3"; $dr = 'ed_perfis.php'; }		

if (strlen($dx1) > 0)
	{
	$sql = "update ".$dd[0]." set ".$dx1."=lpad(id_".$dx2.",".$dx3.",0) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";
	$sql = "update ".$dd[0]." set ".$dx1."=trim(to_char(id_".$dx2.",'".strzero(0,$dx3)."')) where (length(trim(".$dx1.")) < ".$dx3.") or (".$dx1." isnull);";
	
	//echo $sql;
	$rlt = db_query($sql);
	}
echo $sql;	
header("Location: ".$dr);
echo 'Stoped'; exit;
?>
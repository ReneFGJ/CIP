<?
require("cab.php");
require($include.'sisdoc_form2.php');
require($include."sisdoc_search.php");
require($include."sisdoc_autor.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");
?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left" class="lt2">
Bem vindo prof.(a) <B><?=$nome;?></B>.<BR>Cod. funcional: <B><?=$id_pesq;?></B><BR>
<BR>
<??>
<CENTER><h3>Solicitação de substituição de estudante de Inciação Científica</h3><B>Etapa 2/3 - Documentos obrigatórios</B></CENTER><HR>
<?
$sql = "select * from ic_noticia where nw_ref = 'PIBIC_SUBST2' and nw_idioma = '".$idioma_id."' ";
//and nw_journal = ".$jid;
$rrr = db_query($sql);
if ($eline = db_read($rrr)) { echo '<font class="lt1"><BR>'.$eline['nw_descricao']; }

////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////
$dx=1;
$pos = 0;

require("pucpr_aluno_2_mst.php"); 
?>
<table width="100%" class="lt1"><?=$sp;?></table>
<?
$cp = array();
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$H8','','',False,True,''));
$tabela = '';
////////////////
$pos = 3;
if ($pos == 3)
	{
	$qsql = "select * from pibic_bolsa_contempladas ";
	$qsql .= " inner join pibic_aluno on pa_cracha = pb_aluno ";
	$qsql .= " where pb_professor = '".$id_pesq."'";	
	$qsql .= " and pb_status = 'A' ";
	$qsql .= " order by pa_nome ";
	
	$xsql = "select * from pibic_motivos order by mt_descricao ";
	
	array_push($cp,array('$Q pa_nome:pa_cracha:'.$qsql,'','<font class=lt1><NOBR>Retirar o aluno',True,True,''));
	array_push($cp,array('$Q mt_descricao:mt_codigo:'.$xsql,'','<font class=lt1><NOBR>Motivo',True,True,''));
	array_push($cp,array('$O : &SIM:SIM','','Confirma alteração',True,True,''));
	array_push($cp,array('$B8','','Solicitar Substituição >>',false,True,''));
	} else {
	$texto = '<font color=red>Alguns arquivos não foram submetidos, eles são obrigatórios para prosseguir</font>';
	array_push($cp,array('$M8','',$texto,True,True,''));
	}
	?><TABLE width="500" align="center" class="lt1"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?
	////////////////////////////////////// SALVAGE
	if ($saved > 0) 
		{ 
		redirecina("protocolo_substituir_aluno_3.php?dd1=".$dd[1].'&dd3='.trim($dd[3]).'&dd4='.trim($dd[4]).'&dd2='.md5($secu.$dd[1].trim($dd[4])));
		}
?>
<TD width="210">
<? require("resume_menu_left_projetos.php");?>
<BR>
<? // require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_3.php");?>
<BR>
<? require("resume_menu_left_2.php");?>
<BR>
<? require("resume_menu_left_mail.php");?>

</table>
<?
require("foot_body.php");
require("foot.php");
?>
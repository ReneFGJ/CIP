<?
require("cab.php");
require("cab_main.php");
require($include."sisdoc_tips.php");
setcookie("prj_proto",'');

$cap = array();
for ($k=0;$k<100;$k++)
	{ array_push($cap,''); }
$cap[1] = 'Submeter';
$cap[2] = 'Submeter manuscrito de pesquisa';
$cap[3] = 'Selecione o tipo do seu manuscrito de acordo com os tipos abaixo';
if ($idioma == "2")
	{
	$cap[1] = "Submit";
	$cap[2] = "Submit a research manuscrit";
	$cap[3] = 'Select the type of your manuscript below in agreement with the types';
	}
/////////////////////// INSTITUCIONAL
if ($tplogin == "I") 
	{
	$cap[1] = 'Submeter';
	$cap[2] = 'Submeter projeto de pesquisa';
	$cap[3] = 'Selecione o tipo do projeto manuscrito de acordo com os tipos abaixo';	
	}
?>
<TABLE align="center" width="<?=$tab_max;?>" border=0 >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left">
<center><img src="img/logo_pibic.jpg" width="423" height="52" alt="" border="0"></center>

<?
$sql = "select * from ".$submit_manuscrito_tipo." ";
$sql .= " where sp_ativo = 1 ";
$sql .= " and journal_id = ".$jid;
$sql .= " and sp_idioma = '".$idioma_id."'";
$sql .= " order by sp_ordem limit 1 ";
echo $sql;

$rlt = db_query($sql);
$bto = array();
$s = '<TABLE border="0" width="100%" align="center" class="lt1">';
while ($line = db_read($rlt))
	{
	$dica = trim($line['sp_content']);
	$tipo = trim($line['sp_descricao']);
	$s .= '<TR><TD colspan="5"><font class="lt1"><h1>';
	$s .= $tipo;
	$s .= '</h1></TD></TR>';
	$s .= '<TR valign="top"><TD width="30">&nbsp;</TD>';
	$s .= '<TD class="lt1">';
	$s .= trim($line['sp_caption']);
	$s .= '<BR>';
	if (strlen($dica) > 5)
		{
		$cpm = '<img src="img/icone_information.png" width="40" height="40" alt="" border="0">';
		$s .= tips($cpm,$dica);
		}
	$s .= '<TD>';
	$s .= '<form method="post" action="submit_phase_1_pibic_sel.php">';
	$s .= '<TD align="right">';
	$s .= '<input type="submit" name="acao" value="'.$cap[1].' '.chr(13).chr(10).$tipo.'" style="height : 50px; width:250px;">';
	$s .= '<TD>';
	$s .= '<input type="hidden" name="dd0" value="'.trim($line['sp_codigo']).'">';
	$s .= '</form>';
	$s .= '</A>';	
	}
$s .= '</TABLE>';
$sql = "select * from ".$ic_noticia." where nw_ref = 'SUB_MSG_2' and nw_journal = ".$jid;
$sql .= " and nw_idioma = '".$idioma_id."'";
$rrr = db_query($sql);
if ($eline = db_read($rrr))
	{
	$cap[2] = $eline['nw_titulo'];
	$cap[3] = $eline['nw_descricao'];
	} else { echo '<font class="lt0">SUB_MSG_2</font>'; }?>
<font class="lt1">
<BR>
<H1><?=$cap[2];// Submeter manuscrito de pesquisa ?></h1>
<P><?=$cap[3];?></P>
<?

?>
<BR>
<?=$s;?>
<!--------- editar -------->
<TD width="210">
<? require("resume_menu_left.php");?>
<BR>
<? require("resume_menu_left_2.php");?>
</table>

<? require("foot.php"); ?>
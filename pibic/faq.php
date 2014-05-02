<?
require("cab.php");
?>
<style>
	.divfaq
		{
		background : #FFFFFF;
		border : none;		
		}
	.divanswer
		{
		font-family: Verdana; 
		font-size: 12px; 
		color: #606060; 
		text-decoration: none; 		
		background : #FFFFFF;
		border : none;	
		}
</style>
<TABLE align="center" width="<?=$tab_max;?>" border="0" >
<TR valign="top" width="<?=$tab_max;?>" align="center">
<TD align="left">
<?
if (strlen($dd[0]) ==0)
	{
	$dd[0] = '001';
	$titulo_setor = 'Dúvidas frequentes';
	}
echo '<BR><h1>'.$titulo_setor.'</h1>';
$sql = "select * from faq where faq_seccao='".$dd[0]."' ";
$sql .= " and faq_journal_id = ".$jid;
$sql .= " and faq_idioma = '".$idioma_id."' ";
$sql .= " and faq_ativo = 1 ";
$sql .= " order by faq_ordem ";


$rlt = db_query($sql);
$sc1 = array();
$sc2 = array();

while ($line = db_read($rlt))
	{
	array_push($sc1,trim($line['faq_pergunta']));
	array_push($sc2,trim($line['faq_resposta']));
	}
//echo '<P class="lt2">';
//for ($k=0;$k < count($sc1);$k++)
//	{
//	$link = '<A HREF="#'.$k.'">';
//	echo '<B>'.($k+1).' ';
//	echo $link.$sc1[$k].'</A></B>';
//	echo '<BR>';
//	}
//echo '<BR><BR>';
for ($k=0;$k < count($sc1);$k++)
	{
	$link = '<A HREF="javascript:invi('.$k.');" >';
	echo '<div class=divfaq >'.$link.'<B>'.($k+1).'&nbsp;'.$sc1[$k].'</A></B></DIV>';
	echo '<div class=divanswer  id="dsp'.$k.'" style="display: none">';
	echo $sc2[$k].'';
	echo '</div><BR>';
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
<? require("foot.php"); ?>

<script>
function invi(obj)
{
<? for ($k=0;$k < count($sc1);$k++) { ?>
	if (obj==<?=$k;?>) 
		{ 
		lsize = dsp<?=$k;?>.style.display;
		lsize = lsize.length;
		if (lsize <= 4)
			{
			dsp<?=$k;?>.style.display = 'block'; 
			} else {
			dsp<?=$k;?>.style.display = 'none';; 
			}				
		}
<? } ?>
}
</script>

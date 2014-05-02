<?
if (1==2)
{
$bmenu = array();
array_push($bmenu,array('Alteração de aluno','protocolo_substituir_aluno.php','Frequentes perguntas e respostas'));
array_push($bmenu,array('Cancelamento de bolsa','requizicao_cancelamento.php','Entre em contato, dúvidas e sugestões'));
array_push($bmenu,array('Suspensão de bolsa','requizicao_suspensao.php','Entre em contato, dúvidas e sugestões'));
$tab_titulo = "Solicitações";

?>
<table width="210" cellpadding="0" cellspacing="0" bgcolor="#EFEFEF">
<TR align="center"><TD colspan="3" height="24" background="img/menu_top.jpg"><font class="lt2"><font color="white"><B><?=$tab_titulo;?></TD></TR>
<TR><TD width="5">
	<TD width="200">
	<table width="200" cellpadding="2" cellspacing="0">
	<?
	for ($kq=0; $kq < count($bmenu); $kq++)
		{ ?>
		<TR><TD valign="middle"><A class="lt1" HREF="<?=$bmenu[$kq][1];?>" title="<?=$bmenu[$kq][2];?>" ><?=$bmenu[$kq][0];?></A>
		<? } ?>
	</table>
	</TD>
</TABLE>
<?
}
?>

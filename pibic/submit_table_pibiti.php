<?
$http_pg = 'submit_phase_2_pibiti.php';
$folder = array();
$bgc[intval('0'.$prj_pg)]='bgcolor="#e5e5e5"';
$opcs = array();
array_push($opcs,'T�tulo e Autor(es)');
array_push($opcs,'Identifica��o dos <BR>Autor(es)');
array_push($opcs,'Anexos e documentos');
array_push($opcs,'Declara��o de envio');

if ((trim($prj_tp) == '00014') or (trim($prj_tp) == '00041'))
	{
	$opcs = array();
	array_push($opcs,'Identifica��o do projeto');
	array_push($opcs,'Arquivo do projeto');
	array_push($opcs,'Planos de trabalho<BR>e PIBIC Jr');
	array_push($opcs,'Finaliza��o');
	}
if (trim($prj_tp) == '00015')
	{
	$opcs = array();
	array_push($opcs,'Identifica��o do aluno e do projeto');
	array_push($opcs,'Dados complementares do aluno');
	array_push($opcs,'Arquivos do plano de trabalho');
	array_push($opcs,'Resumo do plano de trabalho');
	}
	
if (trim($prj_tp) == '00043')
	{
	$opcs = array();
	array_push($opcs,'Arquivo do plano de trabalho');
	array_push($opcs,'Arquivo do plano de trabalho');	
	array_push($opcs,'Finaliza��o');
	}	
	
?>
<table cellpadding="6" cellspacing="0" width="<?=$tab_max?>" border=0 align="center">
<TR class="lt1" valign="top">
<?
for ($kk=1;$kk <= count($opcs); $kk++)
	{
	?>
	<TD <?=$bgc[$kk];?> width="15%"><font style="font-size: 23px; color:#993300"><?=($kk);?></font>
	<? if ($kk < (count($opcs))) { ?><a class="lt1" href="<?=$http_pg; ?>?dd98=<?=($kk);?>"><? } ?>
	
	<BR><?=$opcs[$kk-1];?></a></TD>
	<?
	}
	?>
    </tr>
</table>

<?
//echo '['.$prj_tp.']';
//echo '['.$prj_nr.']';
$cp = array();
$sql = "select * from ".$submit_manuscrito_field." where sub_projeto_tipo ='".$prj_tp."'";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
	array_push($cp,array("''"));
	}
?>
<table width="<?=$tab_max?>" border=1 align="center">
<TR><TD>
</table>

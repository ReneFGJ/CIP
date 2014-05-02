<?
$http_pg = 'submit_phase_2_pibic.php';
$folder = array();
$bgc[intval('0'.$prj_pg)]='bgcolor="#e5e5e5"';
$opcs = array();
array_push($opcs,'Título e Autor(es)');
array_push($opcs,'Identificação dos <BR>Autor(es)');
array_push($opcs,'Anexos e documentos');
array_push($opcs,'Declaração de envio');

if ($idioma == 'en')
	{
	$opcs = array();
	array_push($opcs,'Title e Author(s)');
	array_push($opcs,'Author(s) (Idetification)');
	array_push($opcs,'Introduction<BR>Metodology');
	array_push($opcs,'Results and Discussion');
//	array_push($opcs,'Acknowledgements');
//	array_push($opcs,'References');
//	array_push($opcs,'Attachment and Submit');
	}
if (trim($prj_tp) == '00014')
	{
	$opcs = array();
	array_push($opcs,'Identificação do projeto');
	array_push($opcs,'Arquivo do projeto');
	array_push($opcs,'Planos de trabalho<BR>e PIBIC Jr');
	array_push($opcs,'Finalização');
	}
if (trim($prj_tp) == '00015')
	{
	$opcs = array();
	array_push($opcs,'Identificação do aluno e do projeto');
	array_push($opcs,'Dados complementares do aluno');
	array_push($opcs,'Arquivos do plano de trabalho');
	array_push($opcs,'Resumo do plano de trabalho');
	}
	
if (trim($prj_tp) == '00016')
	{
	$opcs = array();
	array_push($opcs,'Arquivo do plano de trabalho');
	array_push($opcs,'Arquivo do plano de trabalho');	
	array_push($opcs,'Finalização');
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

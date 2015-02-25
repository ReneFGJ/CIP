<BR>
<table width="<?=$tab_max;?>" align="center" class="lt1" border=1 cellpadding=3 cellspacing=0>
<TR><TD colspan="5" bgcolor="#c0c0c0"><B>Arquivos e Relatórios enviados</B></TD></TR>
<?
if ($dd[1] == 'DEL')
	{
	$sql = "delete from pibic_ged_files where id_pl = ".$dd[22];
//	$rlt = db_query($sql);
	}

$sql = "select * from pibic_ged_files ";
$sql .= " where (";
$sql .= " pl_codigo = '".$protocolo."' ";
$sql .= " or ";
$sql .= " pl_codigo = '".$protocolom."' ";
$sql .= " ) ";
$sql .= " order by pl_data desc, pl_codigo, id_pl desc ";
$rlt = db_query($sql);

echo '<TR class="lt0">';
while ($line = db_read($rlt))
	{
	$arq = $line['pl_texto'];
	$data = $line['pl_data'];
	$file = $line['pl_filename'];
	$tipo = trim($line['pl_tp_doc']);
	$ctipo = $tipo;
	$acao = '<A HREF="pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd1=DEL&dd22='.$line['id_pl'].'">';
	if ($tipo == 'RPARC') { $ctipo = 'Relatório Parcial'; $dirz = 'http://www2.pucpr.br/reol/pibicpr/docs/submit/'; }
	if ($tipo == '00030') { $ctipo = 'Relatório Final'; $dirz = 'http://www2.pucpr.br/reol/pibicpr/docs/submit/'; }
	if ($tipo == '00031') { $ctipo = 'Resumo'; $dirz = 'docs/submit/'; }

	if ($tipo == '00033') { $ctipo = 'Resumo'; $dirz = 'http://www2.pucpr.br/reol/pibic/public/submit/'; }
	if ($tipo == '00034') { $ctipo = 'Resumo'; $dirz = 'http://www2.pucpr.br/reol/pibic/public/submit/'; }
	if ($tipo == '00035') { $ctipo = 'Resumo'; $dirz = 'http://www2.pucpr.br/reol/pibic/public/submit/'; }

	if ($tipo == '00045') { $ctipo = 'Projeto Professor'; $dirz = 'http://www2.pucpr.br/reol/pibic/public/submit/'; }
	if ($tipo == '00046') { $ctipo = 'Outros Documentos'; $dirz = 'http://www2.pucpr.br/reol/pibic/public/submit/'; }
	if ($tipo == '00047') { $ctipo = 'Plano do aluno'; $dirz = 'http://www2.pucpr.br/reol/pibic/public/submit/'; }

	if ($tipo == '00004') { $ctipo = 'Projeto do Professor';  $dirz = 'docs/';}
	if ($tipo == '00006') { $ctipo = 'Plano de trabalho';  $dirz = 'docs/';}
	
	if ($tipo == '00025') { $ctipo = 'Avaliação do Relatório Parcial';  $dirz = 'http://www2.pucpr.br/reol/pibicpr/docs/submit/';}
	$arqf = $dir_doc.'docs/submit/'.substr($data,0,4).'/'.substr($data,4,2).'/'.$arq.'.pdf';


	if (($tipo == '00006') and ($data > 20100101)) 
		{ $ctipo = 'Plano de trabalho';  $dirz = '../pibic/public/submit/';}
	if (($tipo == '00004') and ($data > 20100101)) 
		{ $ctipo = 'Projeto do Professor';  $dirz = '../pibic/public/submit/';}

	$link = '<A HREF="'.$dirz.substr($data,0,4).'/'.substr($data,4,2).'/'.$file.'" class="lt0" target="new_'.date("Ymdihs").'">';
	
	echo '<TR '.coluna().'><TD width="25%">'.$ctipo.'</TD>';
	echo '<TD width="65%">'.$link.$arq.'</TD>';
	echo '<TD width="5%" align="center">'.stodbr($data).'</TD>';
	echo '<TD align="center" width="5%">'.$acao.$line['id_pl'].'</TD>';
	echo '<TD align="center" width="5%">'.$tipo.'</TD>';
	echo '</TR>';
	}
	?>
</table><BR>
<?
if (strlen($CPID) > 0)
	{
	if ($CPID == 'AREA') { $area = trim($dd[$dx]); }
	if (($CPID == 'TIT') or ($CPID == 'TITLE')) { $tit = (trim($dd[$dx])); }
	if ($CPID == 'SUBTI') { $subtit = trim($dd[$dx]); }
	if ($CPID == 'FR') { $fr = trim($dd[$dx]); }
	if ($CPID == 'LOCAL') { $local = trim($dd[$dx]); }
	if ($CPID == 'VER') { $versao = trim($dd[$dx]); }
	if ($CPID == 'AUTOR') { $autores = trim($dd[$dx]); }
	if ($CPID == 'AUTORES') { $autores = trim($dd[$dx]);}
	if ($CPID == 'RESU1') { $resumo_1 = trim($dd[$dx]); }
	if ($CPID == 'RESU2') { $resumo_2 = trim($dd[$dx]); }
	if ($CPID == 'KEYW1') { $keyword_2 = trim($dd[$dx]); }
	if ($CPID == 'KEYW2') { $keyword_1 = trim($dd[$dx]); }
	if ($CPID == 'DOCR') { $nrproj = trim($dd[$dx]); }	
	if ($CPID == 'ALUNO') { $aluno = trim($dd[$dx]); }	
	if ($CPID == 'AREA1') { $area1 = trim($dd[$dx]); }	
	if ($CPID == 'AREA2') { $area2 = trim($dd[$dx]); }	
	
	if (strlen($aluno) > 0)
		{
		if (strlen($aluno) == 12) { $aluno = substr($aluno,3,8); }
		if (strlen($aluno) == 11) { $aluno = substr($aluno,3,8); }
		while (strlen($aluno) < 8) { $aluno = '0'.$aluno; }
		}
	if (2 == 3)
		{
		?>
		<BR>Área:<B><?=$area;?></B>
		<BR>Titulo: <B><?=$tit;?></B>
		<BR>Sub-Titulo: <B><?=$subtit;?></B>
		<BR>FR:<B><?=$fr;?></B>
		<BR>Local:<B><?=$local;?></B>
		<BR>Versao:<B><?=$versao;?></B>
		<BR>Autor:<B><?=$autores;?></B>
		<? } 
	}?>
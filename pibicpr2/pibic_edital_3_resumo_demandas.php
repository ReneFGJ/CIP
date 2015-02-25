<?
/* Demanda Bruta */
$area = array(''=>0, 'A'=>1, 'E'=> 2, 'H'=>3, 'S'=>4, 'V'=>5);
$edital = array(''=>0, 'PIBIC'=>1, 'PIBITI'=>2, 'PIBICE'=>3);
$pibic = 0;
$pibit = 0;
$pibic_em = 0;
$area_total = array(0,0,0,0,0,0);
$edital_total = array(0,0,0,0);
$sql = "select count(*) as total, doc_edital, doc_area
		from pibic_submit_documento
		where doc_ano = '".date("Y")."' 
		and (doc_status <> 'X' and doc_status <> '@')
		and doc_area <> ''
		group by doc_edital, doc_area
		";
$rlt = db_query($sql); 
while ($line = db_read($rlt))
	{
		$narea = trim($line['doc_area']);
		$nedital = trim($line['doc_edital']);
		
		$xarea = $area[$narea];
		$xedital = $edital[$nedital];
		$area_total[$xarea] = $area_total[$xarea] + $line['total'];
		$edital_total[$xedital] = $edital_total[$xedital] + $line['total'];
	}


/* Demanda Qualificada */
$area = array(''=>0, 'A'=>1, 'E'=> 2, 'H'=>3, 'S'=>4, 'V'=>5);
$edital = array(''=>0, 'PIBIC'=>1, 'PIBITI'=>2, 'PIBICE'=>3);
$pibic = 0;
$pibit = 0;
$pibic_em = 0;
$qarea_total = array(0,0,0,0,0,0);
$qedital_total = array(0,0,0,0);

$darea_total = array(0,0,0,0,0,0);
$dedital_total = array(0,0,0,0);

$aarea_total = array(0,0,0,0,0,0);
$aedital_total = array(0,0,0,0);

$cnpq = array(0,0,0,0);
$fa = array(0,0,0,0);
$pucpr = array(0,0,0,0);
$age = array(0,0,0,0);

$sql = "select count(*) as total, doc_edital, doc_area, pb_tipo, doc_nota
		from pibic_submit_documento
		left join pibic_bolsa on pb_protocolo = doc_protocolo
		where doc_ano = '".date("Y")."' 
		and (doc_status <> 'X' and doc_status <> '@')
		and doc_area <> ''
		group by doc_edital, doc_area, pb_tipo, doc_nota
		";
$rlt = db_query($sql); 
while ($line = db_read($rlt))
	{
		$bolsa = $line['pb_tipo'];
		
		$narea = trim($line['doc_area']);
		$nedital = trim($line['doc_edital']);
		$nota = $line['doc_nota'];
		if ($nota < 60) { $bolsa = 'D'; }
		
		if (($bolsa == 'D') or ($bolsa == 'R'))
		{
			$xarea = $area[$narea];
			$xedital = $edital[$nedital];
			$darea_total[$xarea] = $darea_total[$xarea] + $line['total'];
			$dedital_total[$xedital] = $dedital_total[$xedital] + $line['total'];
		} else {
			if (($bolsa == 'C') or ($bolsa == 'P') or ($bolsa == 'M')
			or ($bolsa == 'H') or ($bolsa == 'L') or ($bolsa == 'J')
			or ($bolsa == 'E') or ($bolsa == 'F') or ($bolsa == 'O')
			or ($bolsa == 'G') or ($bolsa == 'B') or ($bolsa == 'U') ) 
			{
				$xarea = $area[$narea];
				$xedital = $edital[$nedital];
				$aarea_total[$xarea] = $aarea_total[$xarea] + $line['total'];
				$aedital_total[$xedital] = $aedital_total[$xedital] + $line['total'];	
				$qarea_total[$xarea] = $qarea_total[$xarea] + $line['total'];
				$qedital_total[$xedital] = $qedital_total[$xedital] + $line['total'];
				
				if ($bolsa == 'C') { $cnpq[$xedital] = $cnpq[$xedital] + $line['total']; }
				if ($bolsa == 'H') { $cnpq[$xedital] = $cnpq[$xedital] + $line['total']; }
				if ($bolsa == 'E') { $cnpq[$xedital] = $cnpq[$xedital] + $line['total']; }
				if ($bolsa == 'B') { $cnpq[$xedital] = $cnpq[$xedital] + $line['total']; }
				
				if ($bolsa == 'F') { $fa[$xedital] = $fa[$xedital] + $line['total']; }
				if ($bolsa == 'L') { $fa[$xedital] = $fa[$xedital] + $line['total']; }
				
				if ($bolsa == 'P') { $pucpr[$xedital] = $pucpr[$xedital] + $line['total']; }
				if ($bolsa == 'U') { $pucpr[$xedital] = $pucpr[$xedital] + $line['total']; }
				if ($bolsa == 'M') { $pucpr[$xedital] = $pucpr[$xedital] + $line['total']; }
				if ($bolsa == 'J') { $pucpr[$xedital] = $pucpr[$xedital] + $line['total']; }
				if ($bolsa == 'O') { $pucpr[$xedital] = $pucpr[$xedital] + $line['total']; }
				
				if ($bolsa == 'G') { $age[$xedital] = $age[$xedital] + $line['total']; }				
											
			} else {
				//echo $bolsa.' ';
				$xarea = $area[$narea];
				$xedital = $edital[$nedital];
				$qarea_total[$xarea] = $qarea_total[$xarea] + $line['total'];
				$qedital_total[$xedital] = $qedital_total[$xedital] + $line['total'];
			}	
		}
	}
	

/* Total */
$total_projetos =$edital_total[1]+$edital_total[2]+$edital_total[3];
$total_projetos_areas = $area_total[1]+$area_total[2]+$area_total[3]+$area_total[4]+$area_total[5];

$total_projetos_pibic = $edital_total[1];
$total_projetos_pibiti = $edital_total[2];
$total_projetos_pibice = $edital_total[3];
if ($total_projetos > 0)
{ 
	$sx .= '<table width="100%" class="lt1">';
	$sx .= '<TR>';
	$sx .= '<TH>Programa';
	$sx .= '<TH width="15%">Demanda Bruta';
	$sx .= '<TH width="15%">Demanda Qualificada';
	$sx .= '<TH width="15%">Demanda Atendida';
	$sx .= '<TH width="15%">Demanda Reprovados';
		
	$sx .= '<TR>';
	$sx .= '<TD>PIBIC';
	$sx .= '<TD width="15%" align="center">'.$edital_total[1];
	$sx .= ' ('.number_format($edital_total[1] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qedital_total[1];
	$sx .= ' ('.number_format($qedital_total[1] / $total_projetos_pibic * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aedital_total[1];
	$sx .= ' ('.number_format($aedital_total[1] / $total_projetos_pibic * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$dedital_total[1];
	$sx .= ' ('.number_format($dedital_total[1] / $total_projetos_pibic * 100,1,',','.').'%)';

	$sx .= '<TR>';
	$sx .= '<TD>PIBITI';
	$sx .= '<TD width="15%" align="center">'.$edital_total[2];
	$sx .= ' ('.number_format($edital_total[2] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qedital_total[2];
	$sx .= ' ('.number_format($qedital_total[2] / $total_projetos_pibiti * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aedital_total[2];
	$sx .= ' ('.number_format($aedital_total[2] / $total_projetos_pibiti * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$dedital_total[2];
	$sx .= ' ('.number_format($dedital_total[2] / $total_projetos_pibiti * 100,1,',','.').'%)';
		
	$sx .= '<TR>';
	$sx .= '<TD>PIBIC_EM';
	$sx .= '<TD width="15%" align="center">'.$edital_total[3];
	$sx .= ' ('.number_format($edital_total[3] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qedital_total[3];
	$sx .= ' ('.number_format($qedital_total[3] / $total_projetos_pibice * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aedital_total[3];
	$sx .= ' ('.number_format($aedital_total[3] / $total_projetos_pibice * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$dedital_total[3];
	$sx .= ' ('.number_format($dedital_total[3] / $total_projetos_pibice * 100,1,',','.').'%)';
		
	$sx .= '<TR>';
	$sx .= '<TD><I>Total';
	$sx .= '<TD width="15%" align="center"><B>'.($edital_total[1]+$edital_total[2]+$edital_total[3]);
	$sx .= ' ('.number_format($total_projetos / $total_projetos * 100,1,',','.').'%)';

	$sx .= '<TD width="15%" align="center"><B>'.($qedital_total[1]+$qedital_total[2]+$qedital_total[3]);
	$sx .= ' ('.number_format(($qedital_total[1]+$qedital_total[2]+$qedital_total[3]) / $total_projetos * 100,1,',','.').'%)';

	$sx .= '<TD width="15%" align="center"><B>'.($aedital_total[1]+$aedital_total[2]+$aedital_total[3]);
	$sx .= ' ('.number_format(($aedital_total[1] + $aedital_total[2] + $aedital_total[3]) / $total_projetos * 100,1,',','.').'%)';
		
}

	$sx .= '<TR>';
	$sx .= '<TH>Áreas';
	$sx .= '<TH width="15%">Demanda Bruta';
	$sx .= '<TH width="15%">Demanda Qualificada';
	$sx .= '<TH width="15%">Demanda Atendida';
	$sx .= '<TH width="15%">Demanda Reprovados';
	

	$sx .= '<TR>';
	$sx .= '<TD>Ciências Agrárias';
	$sx .= '<TD width="15%" align="center">'.$area_total[1];
	$sx .= ' ('.number_format($area_total[1] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qarea_total[1];
	$sx .= ' ('.number_format($qarea_total[1] / $area_total[1] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aarea_total[1];
	$sx .= ' ('.number_format($aarea_total[1] / $area_total[1] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$darea_total[1];
	$sx .= ' ('.number_format($darea_total[1] / $area_total[1] * 100,1,',','.').'%)';

	$sx .= '<TR>';
	$sx .= '<TD>Ciências Exatas';
	$sx .= '<TD width="15%" align="center">'.$area_total[2];
	$sx .= ' ('.number_format($area_total[2] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qarea_total[2];
	$sx .= ' ('.number_format($qarea_total[2] / $area_total[2] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aarea_total[2];
	$sx .= ' ('.number_format($aarea_total[2] / $area_total[2] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$darea_total[2];
	$sx .= ' ('.number_format($darea_total[2] / $area_total[2] * 100,1,',','.').'%)';	

	$sx .= '<TR>';
	$sx .= '<TD>Ciências Humanas';
	$sx .= '<TD width="15%" align="center">'.$area_total[3];
	$sx .= ' ('.number_format($area_total[3] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qarea_total[3];
	$sx .= ' ('.number_format($qarea_total[3] / $area_total[3] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aarea_total[3];
	$sx .= ' ('.number_format($aarea_total[3] / $area_total[3] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$darea_total[3];
	$sx .= ' ('.number_format($darea_total[3] / $area_total[3] * 100,1,',','.').'%)';	

	$sx .= '<TR>';
	$sx .= '<TD>Ciências Sociais Aplicada';
	$sx .= '<TD width="15%" align="center">'.$area_total[4];
	$sx .= ' ('.number_format($area_total[4] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qarea_total[4];
	$sx .= ' ('.number_format($qarea_total[4] / $area_total[4] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aarea_total[4];
	$sx .= ' ('.number_format($aarea_total[4] / $area_total[4] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$darea_total[4];
	$sx .= ' ('.number_format($darea_total[4] / $area_total[4] * 100,1,',','.').'%)';	

	$sx .= '<TR>';
	$sx .= '<TD>Ciências da Vida';
	$sx .= '<TD width="15%" align="center">'.$area_total[5];
	$sx .= ' ('.number_format($area_total[5] / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$qarea_total[5];
	$sx .= ' ('.number_format($qarea_total[5] / $area_total[5] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$aarea_total[5];
	$sx .= ' ('.number_format($aarea_total[5] / $area_total[5] * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center">'.$darea_total[5];
	$sx .= ' ('.number_format($darea_total[5] / $area_total[5] * 100,1,',','.').'%)';
	
	$sx .= '<TR>';
	$sx .= '<TD><I>Total';
	$sx .= '<TD width="15%" align="center"><B>'.($edital_total[1]+$edital_total[2]+$edital_total[3]);
	$sx .= ' ('.number_format($total_projetos_areas / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center"><B>'.($qarea_total[5]+$qarea_total[4]+$qarea_total[3]+$qarea_total[2]+$qarea_total[1]);
	$sx .= ' ('.number_format(($qarea_total[5]+$qarea_total[4]+$qarea_total[3]+$qarea_total[2]+$qarea_total[1]) / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center"><B>'.($aarea_total[5]+$aarea_total[4]+$aarea_total[3]+$aarea_total[2]+$aarea_total[1]);
	$sx .= ' ('.number_format(($aarea_total[5]+$aarea_total[4]+$aarea_total[3]+$aarea_total[2]+$aarea_total[1]) / $total_projetos * 100,1,',','.').'%)';
	$sx .= '<TD width="15%" align="center"><B>'.($darea_total[5]+$darea_total[4]+$darea_total[3]+$darea_total[2]+$darea_total[1]);
	$sx .= ' ('.number_format(($darea_total[5]+$darea_total[4]+$darea_total[3]+$darea_total[2]+$darea_total[1]) / $total_projetos * 100,1,',','.').'%)';	

$sx .= '</table>';
$sx .= '<BR><BR>';
$sx .= '<table width="100%"  class="lt1">';
	$sx .= '<TR>';
	$sx .= '<TH width="35%">Agêncida de fomento';
	//$sx .= '<TH width="15%">Demanda Qualificada';
	$sx .= '<TH width="15%">Bolsas oferecidas';
	$sx .= '<TH width="15%">Participação nas bolsas qualificadas';
	$sx .= '<TH width="15%">Participação nas bolsas atendidas';
	$sx .= '<TH width="15%">Desembolso (anual)';
	$tot1 = $qedital_total[1];
	$tot2 = $qedital_total[2];  
	$tot3 = $aedital_total[1];  
	$tot4 = $aedital_total[2];  
	
	$sx .= '<TR><TD colspan=5 align="center" class="lt3">PIBIC';
	$sx .= '<TR><TD>CNPq - PIBIC';
	$sx .= '<TD align="center">'.$cnpq[1];
	$sx .= '<TD align="center">'.number_format($cnpq[1]/($tot1)*100,1).'%';
	$sx .= '<TD align="center">'.number_format($cnpq[1]/($tot3)*100,1).'%';
	$sx .= '<TD align="right">'.number_format($cnpq[1] * 400 * 12,2,',','.');

	$sx .= '<TR><TD>Fundação Araucária - PIBIC';
	$sx .= '<TD align="center">'.$fa[1];
	$sx .= '<TD align="center">'.number_format($fa[1]/($tot1)*100,1).'%';
	$sx .= '<TD align="center">'.number_format($fa[1]/($tot3)*100,1).'%';
	$sx .= '<TD align="right">'.number_format($fa[1] * 400 * 12,2,',','.');
	
	$sx .= '<TR><TD>PUCPR - PIBIC';
	$sx .= '<TD align="center">'.$pucpr[1];
	if ($tot1 > 0)
		{ $sx .= '<TD align="center">'.number_format($pucpr[1]/($tot1)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	if ($tot3 > 0)
		{ $sx .= '<TD align="center">'.number_format($pucpr[1]/($tot3)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	$sx .= '<TD align="right">'.number_format($pucpr[1] * 400 * 12,2,',','.');

	$sx .= '<TR><TD><I>Total';
	$sx .= '<TD align="center"><B>'.($cnpq[1]+$pucpr[1]+$fa[1]);
	$sx .= '<TD colspan=2>';
	$sx .= '<TD align="right"><B>'.number_format(($fa[1]+$pucpr[1]+$cnpq[1]) * 400 * 12,2,',','.');	
	
/* PIBITI */

	$sx .= '<TR><TD colspan=5 align="center" class="lt3">PIBITI';

	$sx .= '<TR><TD>CNPq - PIBITI';
	$sx .= '<TD align="center">'.$cnpq[2];
	if ($tot2 > 0)
		{ $sx .= '<TD align="center">'.number_format($cnpq[2]/($tot2)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	if ($tot4 > 0)
		{ $sx .= '<TD align="center">'.number_format($cnpq[2]/($tot4)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	$sx .= '<TD align="right">'.number_format($cnpq[2] * 400 * 12,2,',','.');
	
	$sx .= '<TR><TD>PUCPR - PIBITI';
	$sx .= '<TD align="center">'.$pucpr[2];
	if ($tot2 > 0)
		{ $sx .= '<TD align="center">'.number_format($pucpr[2]/($tot2)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	if ($tot4 > 0)
		{ $sx .= '<TD align="center">'.number_format($pucpr[2]/($tot4)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	$sx .= '<TD align="right">'.number_format($pucpr[2] * 400 * 12,2,',','.');
	
	$sx .= '<TR><TD>Agência PUCPR (Inovação) - PIBITI';
	$sx .= '<TD align="center">'.$pucpr[2];
	if ($tot2 > 0)
		{ $sx .= '<TD align="center">'.number_format($age[2]/($tot2)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	if ($tot4 > 0)
		{ $sx .= '<TD align="center">'.number_format($age[2]/($tot4)*100,1).'%'; }
	else { $sx .= '<TD>&nbsp;'; }
	$sx .= '<TD align="right">'.number_format($age[2] * 400 * 12,2,',','.');


	$sx .= '<TR><TD><I>Total';
	$sx .= '<TD align="center"><B>'.($cnpq[2]+$pucpr[2]);
	$sx .= '<TD colspan=2>';	
	$sx .= '<TD align="right"><B>'.number_format(($age[2]+$fa[2]+$pucpr[2]+$cnpq[2]) * 400 * 12,2,',','.');	
	

	$sx .= '<TR><TH><I>Total Geral';
	$sx .= '<TH align="center"><B>'.($age[2]+$cnpq[2]+$pucpr[2]);
	$sx .= '<TH colspan=2>&nbsp;';	
	$sx .= '<TH align="right"><B>'.number_format(($age[2]+$fa[1]+$pucpr[1]+$cnpq[1]+$fa[2]+$pucpr[2]+$cnpq[2]) * 400 * 12,2,',','.');	

$sx .= '</table>';



echo $sx;
exit;
?>


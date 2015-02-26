<?php
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');
	
	require("../_class/_class_pareceristas.php");
	$par = new parecerista;
	
	$op = ' :--Selecione a instituição(ões)';
	$op .= '&0000:Vinculados à PUCPR';
	$op .= '&0001:Desvinculados à PUCPR';
	$op .= '&9999:Todas instituições';
	
	/** Status dos avaliadores **/
	$opa = ' :--todos--';
	$ops = $par->status();
	//foreach($ops as $key=>$value)
	foreach(array_keys($ops) as $key)	
		{
			$opa .= '&'.$key.':'.$ops[$key];
		}
	
	$opb = ' :--Tipo de bolsa';
	$opb .= '&ALL:PQ e DT (todos)';
	$opb .= '&PQ:PQ (todos)';
	$opb .= '&PQ2:PQ-2 (todos)';
	$opb .= '&PQ1A:PQ-1A (todos)';
	$opb .= '&PQ1B:PQ-1B (todos)';
	$opb .= '&PQ1C:PQ-1C (todos)';
	$opb .= '&PQ1D:PQ-1D (todos)';
	$opb .= '&DT:DT (todos)';
	$opb .= '&DT2:DT-2 (todos)';
	$opb .= '&DT1A:DT-1A (todos)';
	$opb .= '&DT1B:DT-1B (todos)';
	$opb .= '&DT1C:DT-1C (todos)';
	$opb .= '&DT1D:DT-1D (todos)';
	//http://plsql1.cnpq.br/divulg/RESULTADO_PQ_102003.buscapelonome2a2?f_inst_uf=PR&f_inst=020700000008&v_sele_modal=BOL_CURSO
	
	$cp = array();
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$O '.$op,'','Tipo de Bosa',True,True,''));
	array_push($cp,array('$C4','','Com dados detalhados',False,True,''));
	array_push($cp,array('$O '.$opa,'','Status',True,True,''));
	array_push($cp,array('$O '.$opb,'','Modalidade',True,True,''));
	//////////////////
	echo '<CENTER><font class=lt5>Parecerista / Instituição</font></CENTER>';
?><TABLE width="500" align="center" border=0 ><TR><TD><form method="post" action="<?php echo page();?>">
<?php
	for ($r=0;$r < count($cp);$r++)
		{
			echo '<TD>';
			echo sget('dd'.$r,$cp[$r][0],'','11','22');
		}
?><td>Detalhado</td><TD><input type="submit" value="calcular" name="acao"></TR></TABLE>
	
<?php
if (strlen($dd[1]) > 0)
	{
		$sql = "select * from pareceristas_area ";
		$sql .= "inner join pareceristas on us_codigo = pa_parecerista ";
		$sql .= "inner join ajax_areadoconhecimento on a_codigo = pa_area ";
		$sql .= "inner join instituicoes on us_instituicao = inst_codigo ";
		$sql .= " where us_journal_id = ".$jid." and us_ativo=1 ";
		if (strlen(trim($dd[3])) > 0) { $sql .= " and us_aceito=".$dd[3]." "; }
		if ($dd[1] == '00001') { $sql .= " and not (inst_abreviatura like '%PUCPR%') "; }
		if ($dd[1] == '00000') { $sql .= " and (inst_abreviatura like '%PUCPR%') "; }
//		if ($dd[1] == '99999') { $sql .= " and not (inst_abreviatura like '%PUCPR%') "; }
		
		//us_bolsista
		if (strlen($dd[4]))
			{
				if ($dd[4]=='ALL') { $sql .= " and us_bolsista <> 'NÃO' "; }
				else 
				{
					if ($dd[4]=='PQ') { $sql .= " and us_bolsista like 'Nível%' "; }
					if ($dd[4]=='PQ2') { $sql .= " and us_bolsista = 'Nível 2' "; }
					if ($dd[4]=='PQ1A') { $sql .= " and us_bolsista = 'Nível 1A' "; }
					if ($dd[4]=='PQ1B') { $sql .= " and us_bolsista = 'Nível 1B' "; }
					if ($dd[4]=='PQ1C') { $sql .= " and us_bolsista = 'Nível 1C' "; }
					if ($dd[4]=='PQ1D') { $sql .= " and us_bolsista = 'Nível 1D' "; }

					if ($dd[4]=='DT2') { $sql .= " and us_bolsista = 'Nível DT2' "; }
					if ($dd[4]=='DT1A') { $sql .= " and us_bolsista = 'Nível DT1A' "; }
					if ($dd[4]=='DT1B') { $sql .= " and us_bolsista = 'Nível DT1B' "; }
					if ($dd[4]=='DT1C') { $sql .= " and us_bolsista = 'Nível DT1C' "; }
					if ($dd[4]=='DT1D') { $sql .= " and us_bolsista = 'Nível DT1D' "; }
				}
			}
			
		$sql .= " order by us_nome ";
		$rlt = db_query($sql);
		$are = "X";
		$total = 0;
		while ($line = db_read($rlt))
			{
			$area = $line['us_nome'];
			if ($area != $are)
				{
				$total = $total + 1;
				$s .= '<TR '.coluna().'><TD class="lt3" colspan="3"><B>';
				if ($dd[2]=='1') { $s .= '<HR>'; }
				$s .= $total.'. '.trim($line['us_nome']);
				$s .= ' ';
				$s .= '('.trim($line['inst_abreviatura']).')';
				
				$s .= '<TD class="lt1">';
				$status = $line['us_aceito'];
				$s .= $ops[$status];
				$are = $area;
				$s .= '<td align="center">';
				$s .= $line['us_bolsista'];
				}
			if ($dd[2]=='1')
				{
					$s .= '<TR class="lt1" '.coluna().'><TD width="15%">';
					$s .= '<font class="lt0"> ('.trim($line['a_cnpq']).')';
					$s .= '<TD>';
					$s .= trim($line['a_descricao']);
					$s .= '<TD>';
					$s .= trim($line['us_journal_id']);
				}
	}
echo '<BR><BR>';
echo '<font class="lt4">Parecerista / Instituicao</font>';
echo '<TABLE width="'.$tab_max.'" class="lt1">';
echo '<TR><TH colspan=3>Parecerista<TH>Instituição<TH>Produtividade';
echo $s;
echo '</TABLE>';

echo 'total de '.$total.' pareceristas cadastrados';
}
?>

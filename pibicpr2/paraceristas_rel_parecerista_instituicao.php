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
	
	
	$cp = array();
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$O '.$op,'','Tipo de Bosa',True,True,''));
	array_push($cp,array('$C4','','Com dados detalhados',False,True,''));
	array_push($cp,array('$O '.$opa,'','Status',True,True,''));
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
				
		$sql .= " order by us_nome ";
		$rlt = db_query($sql);
		$are = "X";
		$total = 0;
		while ($line = db_read($rlt))
			{
			$area = $line['us_nome'];
			if ($area != $are)
				{
					$nome = uppercasesql(trim($line['us_nome']));
				$total = $total + 1;
				$s .= '<TR '.coluna().'><TD class="lt3" colspan="3"><B>';
				if ($dd[2]=='1') { $s .= '<HR>'; }
				$s .= $total.'. '.trim($line['us_nome']);
				$s .= ' ';
				$s .= '('.trim($line['inst_abreviatura']).')';
				
				$s .= '<TD class="lt1">';
				$status = $line['us_aceito'];
				$s .= $ops[$status];

				$cor = '';				

				if (strlen(trim($line['us_codigo'])) == 7) 
				
				{
						 $cor = 'style="color: blue; "';
						 $sql = "select * from docentes where pp_nome_asc = '".$nome."' ";
						 $qrlt = db_query($sql);
						 if ($xline = db_read($qrlt))
						 	{
						 		$cracha = $xline['pp_cracha'];
						 		$cod = $line['us_codigo'];
								$sql = "update pareceristas_area set pa_parecerista = '".$cracha."' where pa_parecerista = '".$cod."' ; ";
								$sql .= "update pareceristas set us_codigo = '".$cracha."' where us_codigo = '".$cod."' ";
								echo $sql;
								echo '<HR>';
								$rtt = db_query($sql);
								
						 		print_r($xline);
								exit;
						 	} else {
						 		echo '<BR>OPS-'.$nome;
						 		
						 	}
				}
				$s .= '<TD class="lt1" '.$cor.'>';
				$s .= $line['us_codigo'];

				$are = $area;
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
echo '<TABLE width="'.$tab_max.'">';
echo $s;
echo '</TABLE>';

echo 'total de '.$total.' pareceristas cadastrados';
}
?>

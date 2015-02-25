<?
if ($nota_parcial == 0)
{
$tipp = date("Y").'P';
?>
<TABLE border="1" width="<?=$tab_max;?>">
<TR><TD>
<form method="post" action="pibic_bolsas_contempladas.php?dd0=<?=$dd[0];?>&dd1=<?=$dd[1];?>">
<H2>Indicação do relatório Parcial</H2>
<?
////////////////////// AVALIAÇÂO DO RELATORIO PARCIAL
$sql = "select * from pibic_parecer_enviado ";
$sql .= " inner join pareceristas on pp_avaliador = us_codigo ";
$sql .= "where pp_protocolo_mae = '".$protocolom."' ";
$sql .= " and us_instituicao = '0000232' ";
//$sql .= " and pp_status = 'I' ";
//$sql .= "where pp_avaliador = '0000130' ";
$sql .= " order by pp_data desc ";

$sql = "select * from pibic_parecer ";
$sql .= " inner join pareceristas on pp_avaliador = us_codigo "; 
$sql .= " inner join instituicoes on us_instituicao = inst_codigo ";
$sql .= " left join (select count(*) as pareceres, pp_avaliador as avaliador from pibic_parecer_2011 where pp_tipo = '".$tipp."' group by pp_avaliador ) as ttt on pp_avaliador = avaliador ";
$sql .= " where (pp_protocolo = '".$protocolo."') or (pp_protocolo_mae = '".$protocolo."')";
$sql .= " and (pp_status = 'B') ";
$sql .= " and us_instituicao = '0000232' ";
$sql .= " order by pp_data,pp_avaliador, pp_protocolo ";
$rlt = db_query($sql);
$xrlt = db_query($sql);


echo '<UL>';
while ($xline = db_read($xrlt))
	{
//	if ($line['us_instituicao'] == '0000232')
	{
		$chk = '';
		if ($dd[10] == $xline['pp_avaliador'])
			{
			$chk = ' selected ';
			$pp_email_1 = trim($xline['us_email']);
			$pp_email_2 = trim($xline['us_email_alternativo']);
			$pp_nome = trim($xline['us_nome']);
			}
		echo '<LI>';
		if ($xline['us_ativo'] == '1')
			{
			echo '<input type="radio" name="dd10" value="'.$xline['pp_avaliador'].'">';
			} else {
				echo ' ';
			}
		echo '('.$xline['pareceres'].') ';
		echo $xline['us_nome'];
		echo  '('.$xline['inst_abreviatura'].')';
		if (trim($xline['us_bolsista']) != 'NÃO') { echo '<font color="blue"> <B>['.trim($xline['us_bolsista']).']</B></font>'; }		
		echo ' <font class="lt1">('.stodbr($xline['pp_data']).') '.$xline['pp_status'].'</font> ';
		
		echo '<BR><a href="mailto:'.$xline['us_email'].'"><font class="lt0">'.$xline['us_email'].'</font></a>';
		echo '&nbsp;&nbsp;<a href="mailto:'.$xline['us_email_alternativo'].'"><font class="lt0">'.$xline['us_email_alternativo'].'</font></a>';		
		echo '</LI>';
		}
	}

		if (strlen($dd[20]) > 0)
			{
				$sql = "select * from pareceristas ";
				$sql .= " left join (select count(*) as pareceres, pp_avaliador as avaliador from pibic_parecer_".date("Y")." where pp_tipo = '".$tipp."' group by pp_avaliador ) as ttt on us_codigo = avaliador ";
				$sql .= " inner join instituicoes on us_instituicao = inst_codigo ";
				$sql .= " where us_ativo = 1 ";
				$sql .= " and (us_instituicao = '0000232' OR us_instituicao = '0000455') ";
				$sql .= " and (us_ativo  = 1) and (us_journal_id = ".intval($journal_id).") ";
				$sql .= " order by us_nome ";
//				$sql .= " limit 10 ";
				echo '<HR>';
				echo '<UL>';
				$dd[10] = '';	
				$rlt = db_query($sql);
				while ($xline = db_read($rlt))
					{
					echo '<LI>';
					if ($xline['us_ativo'] == '1')
						{
							echo '<input type="radio" name="dd10" value="'.$xline['us_codigo'].'">';
						} else {
							echo ' ';
						}
					echo '('.$xline['pareceres'].') ';
					echo $xline['us_nome'];
					echo  '('.$xline['inst_abreviatura'].')';
					if (trim($xline['us_bolsista']) != 'NÃO') { echo '<font color="blue"> <B>['.trim($xline['us_bolsista']).']</B></font>'; }
					echo '<BR><a href="mailto:'.$xline['us_email'].'"><font class="lt0">'.$xline['us_email'].'</font></a>';
					echo '&nbsp;&nbsp;<a href="mailto:'.$xline['us_email_alternativo'].'"><font class="lt0">'.$xline['us_email_alternativo'].'</font></a>';		
					echo '</LI>';
					}
			echo '</UL>';
			} else {
				?>
				<HR>
				<input type="submit" name="dd20" value="mostrar outros pareceristas locais " onclick="dd10='';">
				<HR>
				<?
			}

echo '&nbsp;&nbsp;<input type="submit" name="dd11" value="Enviar trabalho para avaliar >>>>">';
echo '<BR>';

if ((strlen($dd[10]) > 0) and (strlen($dd[11]) > 0))
	{
		$dsql = "select * from pareceristas where us_codigo = '".$dd[10]."' ";
		$drlt = db_query($dsql);
		if ($dline = db_read($drlt))
			{
			$pp_email_1 = trim($dline['us_email']);
			$pp_email_2 = trim($dline['us_email_alternativo']);
			$pp_nome = trim($dline['us_nome']);
			}

	$sql = "select * from pibic_parecer_".date("Y")." ";
	$sql .= " where pp_protocolo = '".$protocolo."' ";
	$sql .= " and pp_avaliador = '".$dd[10]."' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
			$sql = "update pibic_parecer_".date("Y")." set pp_status = '@' ";
			$sql .= " where id_pp = ".$line['id_pp'];
			$rlt = db_query($sql);
			echo '[A]';
		} else {	
			$sql = "insert into pibic_parecer_".date("Y")." ";
			$sql .= "(pp_nrparecer,pp_tipo,pp_protocolo,";
			$sql .= "pp_protocolo_mae,pp_avaliador,pp_status,";
			$sql .= "pp_pontos,pp_data,pp_hora,";
			$sql .= "pp_parecer_data,pp_parecer_hora";
			$sql .= ") values (";
			$sql .= "'','".$tipp."','".$protocolo."',";
			$sql .= "'".$protocolom."','".$dd[10]."','@',";
			$sql .= "0,".date("Ymd").",'".date("H:i")."',";
			$sql .= "19000101,'00:00'";
			$sql .= ")";
			$rlt = db_query($sql);
			echo '[I]';

			$histo = 'Indicado Parecerista '.$pp_nome.' (Relatório parcial) '.$dd[10];
			$sql = "insert into pibic_bolsa_historico ";
			$sql .= "(bh_protocolo,bh_data,bh_hora,";
			$sql .= "bh_log,bh_historico,bh_acao) values (";
			$sql .= "'".$protocolo."','".date("Ymd")."','".date("H:i")."',";
			$sql .= "0".$user_id.",'".$histo."','100'); ";
			$rlt = db_query($sql);
		}
		//$rlt = db_query($sql);
		//////////////////////////////////////////////// RECUPERA ID DA TABELA AVALIACAO
		$sql = "select * from pibic_parecer_".date("Y")." ";
		$sql .= " where pp_protocolo = '".$protocolo."' ";
		$sql .= " and pp_avaliador = '".$dd[10]."' ";
		$sql .= " order by id_pp desc ";
		$wrlt = db_query($sql);
		if ($wline = db_read($wrlt))
			{ $idp = $wline['id_pp']; }
		
		/////////////////////// RECUEPRA TEXTO
		$tipo = "rel_par_ava";	
		$sql = "select * from ic_noticia where nw_ref = '".$tipo."' and nw_journal = ".$jid;
		$rrr = db_query($sql);
		if ($line = db_read($rrr))
			{
			$texto = $line['nw_descricao'];
			}
			
		$key = substr(md5($secu.$dd[10].$protocolo.$idp),5,10);
		$link = $http.'../pibic/pibic_avaliacao_parcial.php?dd0='.$idp.'&dd1='.$key.'&dd2='.$dd[10].'&dd3='.$protocolo.'&dd4=002';
		
		$texto = troca($texto,'$titulo',$ttp);
		$texto = troca($texto,'$aluno',$aluno);
		$texto = troca($texto,'$professor',$prof);
		$texto = troca($texto,'$protocolo',$protocolo);
		$texto = troca($texto,'$nome',$pp_nome);
		$texto = troca($texto,'$xlink',$xlink);
		$texto = troca($texto,'$link',$link);
		
		
		/////////////////////////////////////
		$e3 = '[PIBIC] - Relatorio parcial - '.$aluno;
		$e4 = mst($texto);
		echo '<BR><BR>enviado para:';
		//enviaremail('monitoramento@sisdoc.com.br',$e2,$e3,$e4);
		enviaremail('pibicpr@pucpr.br',$e2,$e3,$e4);
		/////////////////////// Enviar e-mail
		if (strlen($pp_email_1) > 0) 
			{ enviaremail($pp_email_1,$e2,$e3,$e4); echo $pp_email_1.' ';}
		if (strlen($pp_email_2) > 0) 
			{ enviaremail($pp_email_2,$e2,$e3,$e4); echo $pp_email_2.' '; }

	echo '<HR>'.$e4.'<HR>';
	echo 'SALVA';
	}

?></form></TD></TR>
</TABLE>
<?
}
?>
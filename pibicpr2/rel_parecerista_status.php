<?
require("cab.php");
require($include.'sisdoc_data.php');
$bb1 = 'reenviar convite para todos';
if ($acao == $bb1)
	{
		echo 'Atualizar';
		$sql = "update pareceristas set us_aceito = 9 ";
		$sql .= " where us_aceito = 19 ";
		$sql .= " and us_ativo = 1";
		$rlt = db_query($sql);
	}

if (strlen($dd[0]) == 0) { $dd[0] = 1; }
// -1:Não informado&1:SIM&0:NÃO&9:Enviar convite&2:Aguardando aceite do convite
//			$sql = "update pareceristas set us_aceito = 9, us_aceito_resp = 20090511  where us_aceito = 2 ";
//			$rlt = db_query($sql);
			
			$sql = "select * from pareceristas  ";
			$sql .= "inner join instituicao on us_instituicao = inst_codigo ";
			$sql .= " where us_aceito = ".$dd[0];
			$sql .= " and us_journal_id = '".$jid."' ";
			$sql .= " and us_ativo = 1 ";
			$sql .= " order by us_nome ";
			$rlt = db_query($sql);
			$sx = '';
			$tot = 0;
			while ($line = db_read($rlt))
				{
				$link = '<A href="avaliador_detalhe.php?dd0='.$line['id_us'].'&dd90='.checkpost($line['id_us']).'" target="new"><font class="lt1">';
				$sx .= '<TR><TD class="lt2" colspan="2">'.$line['us_titulacao'].'<B>'.$link.$line['us_nome'];
				$sx .= '<TD align="center">'.$line['us_codigo'].'</TD>';
				$sx .= '</TD></TR>';
				$sx .= '<TR><TD>'.trim($line['inst_nome']).' ('.trim($line['inst_abreviatura']).')</TD>';
				$sx .= '<TD align="center">'.stodbr($line['us_aceito_resp']).'</TD>';
				$sx .= '<TD align="center">'.$line['us_bolsista'].'</TD>';
				$tot++;
//				print_r($line);	
				}
			?>
			<BR><BR>
			<CENTER><font class="lt5">Resumo dos pareceristas</font></CENTER>
			<TABLE width="700" border="0" class="lt1">
			<TR bgcolor="#c0c0c0"><TH>Descrição</TH><TH>atualizado</TH>
			<TH>Bolista CNPq</TH>
			</TR>
			<?=$sx;?>
			<TR><TD align="center"><B><font class="lt4"><?=$tot;?></B></TD><TD><font class="lt4"><B>TOTAL</TD></TR>
			</TABLE>
			<? 

if ($dd[0] == 19)
	{
		echo '<form>';
		echo '<input type="hidden" name="dd0" value="'.$dd[0].'">';
		echo '<input type="submit" name="acao" value="'.$bb1.'">';
		echo '</form>';
	}


require("foot.php");
?>
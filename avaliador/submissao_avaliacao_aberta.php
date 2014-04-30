<?
require("cab.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");

$ativo = True;

$texto = 'PROJ_REENVIAR';
$sql = "select * from ic_noticia where nw_ref = '".$texto."'";
$sql .= "  and nw_journal = '".$jid."' ";
$rrr = db_query($sql);
if ($eline = db_read($rrr))
{
	$sC = $eline['nw_titulo'];
	$texto = $eline['nw_descricao'];			
}	

$sql = "select * from ( ";
$sql .= " select pp_avaliador, count(*) as total from pibic_parecer_2012  ";
$sql .= " where (pp_status = '@') group by pp_avaliador ";
$sql .= ") as tabela ";
$sql .= " left join pareceristas on pp_avaliador = us_codigo ";
$sql .= " left join instituicao on us_instituicao = inst_codigo ";
$sql .= " order by us_nome ";

$rlt = db_query($sql);
$sx = '';
$total = 0;
$tot = 0;
$clie = "X";
$ok = true;
$pare = '';
$tot = 0;
while ($line = db_read($rlt))
	{
	$tot = $tot + $line['total'];
	$statuse = trim($line['s2']);
	$total++;
	$avaliador = trim($line['us_codigo']);
	$nome = $line['us_nome'];
	$chk = substr(md5('pibic'.date("Y").trim($line['us_codigo']),0,10));
	$link = 'http://www2.pucpr.br/reol/';
	$link .= 'avaliador/acesso.php?dd0='.$line['us_codigo'].'&dd90=';
	//////////////////////////////////////////////////////////////////////////////////// Identificação do avaliador
	if ($avaliador != $clie)
		{
		if ($ok == false)
			{
			$sx .= '<TD>==>enviar';
			$ttt = troca($texto,'$avaliador',$nome);
			$ttt = troca($ttt,'$protocolos',$pare);
			//$sx .= '<TR><TD colspan="7">'.$pare.'</TD></TR>';
			if (strlen($dd[10]) > 0)
			{
				if ($ativo == True)
				{
				//if (strlen($us_email)) { enviaremail($us_email,$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',mst($ttt)); $sx .= '[1]'; }
				//if (strlen($us_email_alt)) { enviaremail($us_email_alt,$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',mst($ttt)); $sx .= '[2]'; }
				}
				enviaremail('monitoramento@sisdoc.com.br',$emailadmin,'(copia) AVALIAÇÃO - PIBIC PUCPR',mst($ttt).'<BR><BR>email para:'.$us_email.' '.$us_email_alt);
				$sx .= '<TR><TD colspan="5">email para:#'.$us_email.'# '.$us_email_alt;
			}
//			echo mst($ttt);
//			exit;
			}
		$nome = '';
		$sx .= '<TR class="lt2"><TD colspan="3"><B><I>';
		$nome .= trim($line['us_titulacao']).' ';
		$nome .= trim($line['us_nome']);
		$nome .= ' ('.$line['inst_abreviatura'].') ';
		$sx .= $nome;
//		$sx .= ' ('.$avaliador.')';
		$sx .= '</TD>';
		$sx .= '<TD>'.$line['total'];
		$sx .= '<TD>'.$link;
		$clie = $avaliador;
		$us_email = trim($line['us_email']);
		$us_email_alt = trim($line['us_email_alternativo']);
		$ok = true;
		$pare = '';
		$totp=0;
		}
		
	if ($ok == false)
		{
		$sx .= '<TD>=>enviar';
		$ttt = troca($texto,'$avaliador',$nome);
		$ttt = troca($ttt,'$protocolos',$pare);
//		$sx .= '<TR><TD colspan="7">'.$pare.'</TD></TR>';
		if (strlen($dd[10]) > 0)
			{
				if ($ativo == True)
				{
				if (strlen($us_email)) { enviaremail($us_email,$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',mst($ttt)); echo $us_email; }
				if (strlen($us_email_alt)) { enviaremail($us_email_alt,$emailadmin,'AVALIAÇÃO - PIBIC PUCPR',mst($ttt)); echo $us_email_alt;  }
				}
				enviaremail('monitoramento@sisdoc.com.br',$emailadmin,'(copia) AVALIAÇÃO - PIBIC PUCPR',mst($ttt));
				$sx .= '<TR><TD colspan="5">email para:#'.$us_email.'# '.$us_email_alt;
			}	
		}
	}
	
echo '>>>>Total de '.$tot.' avaliações';
if (strlen($sx) > 0)
	{
	?>
	<TABLE width="<?=$tab_max;?>" class="lt1" border="0">
	<TR>
		<TD colspan="3" align="center" class="lt5">Relatório de pendências de pareceres não relatados</TD>
	</TR>
	<TR>
		<TD><form action="submissao_avaliacao_aberta.php"></TD>
		<TD><input type="submit" name="dd10" value="confirmar enviar e-mail para os pareceristas da lista abaixo" style="width:<?=$tab_max;?>px; "></TD>
		<TD></form></TD>
	</TR>
	<TR><TD colspan="3" bgcolor="#EFFAF4">REF: <?='PROJ_REENVIAR';?></TD></TR>
	<TR><TD colspan="3" bgcolor="#EFFAF4"><?=mst($texto);?></TD></TR>
	<TABLE width="<?=$tab_max;?>" class="lt1" border="0">
	<TR><TD colspan="10" align="right"><B>total de <?=$total;?> avaliações enviadas e <?=$tot;?> sem resposta</B></TD></TR>
	<TR>
	<TH>protocolo</TH>
	<TH>Dt. Envio</TH>
	<TH>Dt. Avaliação</TH>
	<TH>Link</TH>
	
	<TH>status</TH><TH>e-mail</TH></TR>
	<?=$sx;?>
	</TABLE>
	<?
	}
require("foot.php");	?>

<?php
require("cab.php");
require($include."sisdoc_colunas.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_debug.php");

$ativo = True;
$jid = 20;
$texto = 'PARIC_AVA_ABERT';
$sql = "select * from ic_noticia where nw_ref = '".$texto."'";
//$sql .= "  and nw_journal = '".$jid."' ";
$rrr = db_query($sql);
if ($eline = db_read($rrr))
{
	$sC = $eline['nw_titulo'];
	$tttt = $eline['nw_descricao'];			
}	

/* Dados */
$sql = "select * from ( ";
$sql .= " select pp_avaliador, count(*) as total from pibic_parecer_2014  ";
$sql .= " where (pp_status = '@' and pp_protocolo like '1%' ) group by pp_avaliador ";
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

$aa=0;

while ($line = db_read($rlt))
	{
	$tot = $tot + $line['total'];
	$statuse = trim($line['s2']);
	$total++;
	$avaliador = trim($line['us_codigo']);
	$chk = substr(md5('pibic'.date("Y").trim($line['us_codigo'])),0,10);
	$link = 'http://www2.pucpr.br/reol/';
	$link .= 'avaliador/acesso.php?dd0='.trim($line['us_codigo']).'&dd90='.$chk;
	$link = '<A HREF="'.$link.'" target="new">'.$link.'</A>';

	$linka = '<A HREF="parecerista_areas.php?dd0='.$line['id_us'].'&dd90='.checkpost($line['id_us']).'" target="_new">';
	
		$nome = trim($line['us_titulacao']).' ';
		$nome .= trim($line['us_nome']);
		$nome .= ' ('.$line['inst_abreviatura'].') ';
		$us_email = trim($line['us_email']);
		$us_email_alt = trim($line['us_email_alternativo']);
			
		$sx .= '<TR class="lt2"><TD colspan="3"><B><I>';
		$sx .= $linka;
		$sx .= $nome;
		$sx .= '</TD>';
		$sx .= '<TD>'.$line['total'];
		$sx .= '<TD>'.$link;

	//////////////////////////////////////////////////////////////////////////////////// Identificação do avaliador
	if (strlen($dd[10]) > 0)
		{			
			$sx .= '<TD>==>enviar';
			$ttt = troca($tttt,'$parecerista',$nome);
			$ttt = troca($ttt,'$link',$link);
			$ttt = troca($ttt,'$nome',$nome);
			
			$titulo = '[IC] - Avaliação IC/IT PUCPR - '.$nome;
			
			$texto = '<IMG SRC="'.$http.'/img/email_ic_header.png"><BR>'.mst($ttt).'<BR><IMG SRC="'.$http.'/img/email_ic_foot.png">';
			
			
			
				if (strlen($us_email)) { enviaremail($us_email,'',$titulo,$texto);  }
				if (strlen($us_email_alt)) { enviaremail($us_email_alt,'',$titulo,$texto);  }
		
				enviaremail('pibicjr@pucpr.br','','(copia) '.$titulo,$texto);
				enviaremail('pibicpr@pucpr.br','','(copia) '.$titulo,$texto);
			
			//echo $texto;
			$aa++;
					
			
			$sx .= '<TD colspan="1">email para:#'.$us_email.'# '.$us_email_alt;
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
	<TR><TD colspan="3" bgcolor="#EFFAF4">REF: <?='PARIC_AVA_ABERT';?></TD></TR>
	<TR><TD colspan="3" bgcolor="#EFFAF4"><?=mst($tttt);?></TD></TR>
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
require("../foot.php");	
?>
<?php
require ("cab.php");
require ($include . "sisdoc_colunas.php");
require ($include . "sisdoc_data.php");
require ($include . "sisdoc_email.php");
require ($include . "sisdoc_windows.php");
require ($include . "sisdoc_debug.php");

$ativo = True;
$jid = 20;
$texto_ic = 'PARIC_AVA_ABERT_EX';
$sql = "select * from ic_noticia where nw_ref = '" . $texto_ic . "'";
//$sql .= "  and nw_journal = '".$jid."' ";
$rrr = db_query($sql);
if ($eline = db_read($rrr)) {
	$sC = $eline['nw_titulo'];
	$tttt = $eline['nw_descricao'];
}

/* Dados */
$sql = "select * from ( ";
$sql .= " select pp_avaliador, count(*) as total from pibic_parecer_" . date("Y") . " as pareceres ";
$sql .= " where (pp_status = '@' and pp_protocolo like '1%' ) 
			group by pp_avaliador ";
$sql .= ") as tabela ";
$sql .= " left join pareceristas on pareceres.pp_avaliador = us_codigo ";
$sql .= " left join pibic_professor on pareceres.pp_avaliador = pp_cracha ";
$sql .= " left join instituicao on us_instituicao = inst_codigo ";
$sql .= " order by us_nome ";

$cp = "pp_a, pp_cracha, pp_nome, us_codigo, us_nome, pp_email, pp_email_1, inst_abreviatura,
		us_email, us_email_alternativo ";
$sql = "select distinct total, $cp from (
		select count(*) as total, $cp from (
		select pp_avaliador as pp_a from pibic_parecer_" . date("Y") . " as pareceres 
			where pp_tipo = 'SUBMI' and pp_status = '@'
		) as tabela 
		left join pibic_professor on pp_a = pp_cracha
		left join pareceristas on pp_a = us_codigo
		left join instituicao on us_instituicao = inst_codigo
		
		group by " . $cp . "
		) as tabela
		order by pp_a, us_nome, pp_nome
		";
$rlt = db_query($sql);

$sx = '';
$total = 0;
$tot = 0;
$clie = "X";
$ok = true;
$pare = '';
$tot = 0;

$aa = 0;

$sx = '<table>';
$xcracha = '';
while ($line = db_read($rlt)) {
	$cracha = trim($line['pp_a']);
	if (strlen($cracha) == 7) {
		if ($cracha != $xcracha) {
			$xcracha = $cracha;
			$sx .= '<tr>';
			/* Avaliador Local */
			if (strlen($cracha) == 8) {
				$sx .= '<td>';
				$sx .= $line['pp_nome'];
				$sx .= '<td>';
				$sx .= 'PUCPR';
				$nome = trim($line['pp_nome']);
				$us_email = trim($line['pp_email']);
				$us_email_alt = trim($line['pp_email_1']);
			} else {
				$sx .= '<td>';
				$sx .= $line['us_nome'];
				$sx .= '<td>';
				$sx .= trim($line['inst_abreviatura']);
				$nome = trim($line['us_nome']);
				$us_email = trim($line['us_email']);
				$us_email_alt = trim($line['us_email_alternativo']);
			}
			$sx .= '<td align="center">' . $cracha . '</td>';
			$sx .= '<td align="center">' . $line['us_codigo'] . '</td>';
			$sx .= '<td align="center">' . $line['pp_cracha'] . '</td>';

			$tot = $tot + $line['total'];

			$statuse = trim($line['s2']);
			$total++;

			$avaliador = trim($cracha);

			$chk = substr(md5('pibic' . date("Y") . trim($cracha)), 0, 10);
			$link = 'http://www2.pucpr.br/reol/';
			$link .= 'avaliador/acesso.php?dd0=' . $cracha . '&dd90=' . $chk;
			$linkb = $link;
			$linka = '<A HREF="' . $link . '" target="new">';
			$link = '<A HREF="' . $link . '" target="new">' . $link . '</A>';

			$sx .= '<TD>' . $line['total'];
			$sx .= '<TD>' . $link;
		}
		//////////////////////////////////////////////////////////////////////////////////// Identificação do avaliador
		if (strlen($dd[10]) > 0) {
			$sx .= '<TD>==>enviar';
			$ttt = troca($tttt, '$NOME', $nome);
			$ttt = troca($ttt, '$LINK', $link);
			$ttt = troca($ttt, '$linka', $linka);
			$ttt = troca($ttt, '$linkb', $linkb);
			$ttt = troca($ttt, '$nome', $nome);

			$titulo = '[IC] - Avaliação IC/IT PUCPR - ' . $nome;

			$texto = '<IMG SRC="' . $http . '/img/email_ic_header.png"><BR>' . ($ttt) . '<BR><IMG SRC="' . $http . '/img/email_ic_foot.png">';

			$em = array($us_email, $us_email_alt, 'pibicpr@pucpr.br');
			echo '<BR>';
			for ($r = 0; $r < count($em); $r++) {
				if (strlen(trim($em[$r]))) {
					enviaremail(trim($em[$r]), '', $titulo, $texto);
					echo $em[$r] . '; ';
					echo '<HR>';
				}
			}
			$aa++;
		}
	}
}

echo '>>>>Total de ' . $tot . ' avaliações';
?>
<TABLE width="98%" class="lt1" border="0">
<TR>
<TD colspan="3" align="center" class="lt5">Relatório de pendências de pareceres não relatados - Externos</TD>
</TR>
<TR>
<TD><form action="<?php echo page();?>"></TD>
<TD><input type="submit" name="dd10" value="confirmar enviar e-mail para os pareceristas da lista abaixo" style="width:<?=$tab_max;?>px; "></TD>
<TD></form></TD>
</TR>
<TR><TD colspan="3" bgcolor="#EFFAF4">REF: <?php echo $texto_ic;?></TD></TR>
<TR><TD colspan="3" bgcolor="#EFFAF4"><?=($tttt);?><
/TD></TR>
<TABLE width="<?=$tab_max;?>" class="lt1" border="0">
<TR><TD colspan="20" align="right" class="lt4 tabela01">
<BR>
<B>total de <?=$total;?>
 avaliadores, <?=$tot;?>
 em aberto</B>
<BR><BR>
</TD></TR>
<TR>
<TH>protocolo</TH>
<TH>Dt. Envio</TH>
<TH>Dt. Avaliação</TH>
<TH>Link</TH>

<TH>status</TH><TH>e-mail</TH></TR>
<?=$sx;?>
</TABLE>

<?
require ("../foot.php");
?>
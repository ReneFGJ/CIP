<?php
require("cab_semic.php");
require($include.'sisdoc_dv.php');
require($include.'sisdoc_autor.php');
$jid = 85;
$sql = "
	select * from pareceristas 
	left join instituicao on us_instituicao = inst_codigo
	where us_journal_id = $jid
	and us_aceito = 10 and us_ativo = 1
	order by us_nome
";
$rlt = db_query($sql);
echo '<H1>Avaliadores ativos</h1>';
$sx = '<table width="100%">';
$sx .= '<TR><TH>Nome<TH>Instituição<TH>e-amil<TH>Acesso</TR>';
$id = 0;
$et = '';
while ($line = db_read($rlt))
	{
		
		$ac = trim($line['us_codigo']);
		$ac = md5($ac);
		$ac = UpperCase(substr($ac,4,2));

		$link = '<A HREF="http://www2.pucpr.br/reol/semic_avaliacao/index.php?dd1='.trim($line['us_codigo']).$ac.'&dd3=1&acao=IN" target="_new">';
		
		$id++;
		$sx .= '<TR>';
		$sx .= '<TD>'.nbr_autor($line['us_nome'],7);
		$sx .= '<TD>'.$line['inst_abreviatura'];
		$sx .= '<TD>'.$line['us_email'];
		$sx .= '<TD>'.$link.trim($line['us_codigo']).$ac.'</A>';
		
		$et .= '<TR><TD>';
		$et .= nbr_autor($line['us_nome'],7).'<BR>';
		$et .= '['.trim($line['us_codigo']).$ac.']';
		$et .= '<BR>';
	}
$sx .='<TR><TD>Total de '.$id.' avaliadores ';
$sx .= '</table>';

//echo 'ETIQUETAS';
//echo '<table>'.$et.'</table>';
echo $sx;
?>

<?php
require("cab_semic.php");
require($include.'sisdoc_dv.php');
require($include.'sisdoc_autor.php');
require($include.'sisdoc_email.php');
$jid = 85;
$sql = "
	select * from pareceristas 
	left join instituicao on us_instituicao = inst_codigo
	where us_journal_id = $jid
	and us_aceito = 10 and us_ativo = 1
	order by us_nome desc
";
$rlt = db_query($sql);
echo '<H1>Avaliadores ativos</h1>';
$sx = '<table width="100%">';
$sx .= '<TR><TH>Nome<TH>Institui��o<TH>e-amil<TH>Acesso</TR>';
$id = 0;

$txt = '
<img src="http://www2.pucpr.br/reol/semic_avaliacao/img/title_semic.png" align="right" height="150">
Prezado $NOME,<BR>
<BR>
Seja bem vindo ao 3. Congresso Sul Brasileiro de Inicia��o Cient�fica e ao XXIi Semin�rio de Inicia��o Ci�ntifica da PUCPR.
<BR><BR>
De forma a orient�-lo estamos encaminhando sua agenda de avalia��o com a data, hora e modalidade de avalia��o.
<BR><BR>
Para accessar click no link abaixo:
$LINK
<BR><BR>
ou acesse <A HREF="http://www2.pucpr.br/reol/cicpg.php">http://www2.pucpr.br/reol/cicpg.php</A> e informe o c�digo de acesso <B>$CODIGO</B>
<BR><BR>
Agradecemos sua participa��o como avaliador, lembrando que ao final do evento ser� encaminhado o certificado de avaliador.
<BR><BR>
Sds,
<BR>
Comiss�o Organizadora
';


while ($line = db_read($rlt))
	{
		$ac = trim($line['us_codigo']);
		$ac = md5($ac);
		$ac = UpperCase(substr($ac,4,2));
		$nome = nbr_autor($line['us_nome'],7);
		
		$link = '<A HREF="http://www2.pucpr.br/reol/semic_avaliacao/index.php?dd1='.trim($line['us_codigo']).$ac.'&dd3=1&acao=IN" target="_new">';
		$linka = 'http://www2.pucpr.br/reol/semic_avaliacao/index.php?dd1='.trim($line['us_codigo']).$ac.'&dd3=1&acao=IN'; 
		$id++;
		$sx .= '<TR>';
		$sx .= '<TD>'.nbr_autor($line['us_nome'],7);
		$sx .= '<TD>'.$line['inst_abreviatura'];
		$sx .= '<TD>'.$line['us_email'];
		$sx .= '<TD>'.$link.trim($line['us_codigo']).$ac.'</A>';
		
		$sql = "select (sum(total)) as total from (";
		$sql .= "select 1 as total from semic_trabalhos
					inner join semic_blocos on st_bloco = blk_codigo 
							where st_avaliador_1 = '".trim($line['us_codigo'])."' and blk_data >= ".date("Ymd");
		$sql .= " union ";
		$sql .= "select 1 from semic_blocos where blk_avaliador_1 = '".trim($line['us_codigo'])."' and blk_data >= ".date("Ymd");
		$sql .= " union ";
		$sql .= "select 1 as total from semic_trabalhos
					inner join semic_blocos on st_bloco = blk_codigo 
							where st_avaliador_2 = '".trim($line['us_codigo'])."' and blk_data >= ".date("Ymd");
		$sql .= " union ";
		$sql .= "select 1 from semic_blocos where blk_avaliador_2 = '".trim($line['us_codigo'])."' and blk_data >= ".date("Ymd");
		$sql .= ") as tabela ";
		$rrr = db_query($sql);
		$xline = db_read($rrr);
		$sx .= '<TD>->'.$xline['total'];
		
		if ($xline['total'] > 0)
			{
				$txto = $txt;
				$txto = troca($txto,'$NOME',$nome);
				$txto = troca($txto,'$CODIGO',trim($line['us_codigo']).$ac);
				$txto = troca($txto,'$LINK',$link.$linka.'</A>');
				$email = 'renefgj@gmail.com';
				$assunto = '[CICPG] - Agenda do avaliador ';
				$assunto .= '  '.substr(md5($line['us_codigo']),0,5);
				$email = trim($line['us_email']);
				enviaremail($email,'',$assunto,$txto);
				enviaremail('pibicpr@pucpr.br','',$assunto,$txto);
				
				//enviaremail('renefgj@gmail.com','',$assunto,$txto);
				$sx .= '<TD>'.$email.' enviado';
			}
	}
$sx .='<TR><TD>Total de '.$id.' avaliadores ';
$sx .= '</table>';

echo $sx;
?>

<?php
require("cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');

require("../_class/_class_ic.php");
$ic = new ic;

require("../_class/_class_semic.php");
$semic = new semic;
$jid = $semic->recupera_jid_do_semic();

$cp = 'pp_email, pp_email_1, pp_nome, id_article, article_title, article_autores ';
//$cp = '*';
$sql = "select $cp from articles 
		left join pibic_professor on article_author_pricipal = pp_cracha
		where (article_publicado <> 'X') and journal_id = ".$jid."
		and ((article_dt_revisao isnull) or (article_dt_revisao < 20000101)) 
		order by pp_nome ";
$rlt = db_query($sql);
$texto = '	';
$journal_id = $jid;
$tx = $ic->ic('SEMIC_VALID');

$titulo = $tx['nw_titulo'];
$texto = mst($tx['nw_descricao']);

while ($line = db_read($rlt))
	{
		$id = $line['id_article'];
		$txt = '<B>'.trim($line['article_title']).'</B>';
		$txt .= '<BR><I>'.$line['article_autores'].'</I>';
		
		$link = 'http://www2.pucpr.br/reol/semic/validacao.php?dd0='.$id.'&dd90='.checkpost($id).'&dd99=1&dd10=view.html';
		$link_valided = '<A HREF="'.$link.'">Se os dados estiverem corretos, clique aqui!</A>';

		$link = 'http://www2.pucpr.br/reol/semic/trabalho.php?dd0='.$id.'&dd90='.checkpost($id).'&dd10=view.html';
		$link = '<A HREF="'.$link.'">Acesso direto</A>';

		
		$email1 = trim($line['pp_email']);
		$email2 = trim($line['pp_email_1']);
		$nome = trim($line['pp_nome']);
		$ttt = troca($texto,chr(13),'<BR>');
		$ttt = troca($ttt,'$trabalho',$txt);
		$ttt = troca($ttt,'$link',$link);
		$ttt = troca($ttt,'$nome',$nome);
		
		$ttt = troca($ttt,'$validação_ok',$link_valided);
		
		$style = '<font style=font-family: Tahoma, Arial; font-size: 12px; line-height: 150%; >';
		$ttt = '<TABLE width=600 ><TR><TD><img src='.http.'img/email_ic_header.png >
				<TR><TD>
				<BR>'.$style.$ttt.'</font><BR>
				<img src='.http.'img/email_ic_foot.png ></TABLE>';		
		
		if (strlen($dd[1]) > 0)
		{
			$dest = 'monitoramento@sisdoc.com.br';
			$titulo = '[SEMIC] - Validação do resumo SEMIC';
			//enviaremail($dest,'',$titulo,$ttt);
			if (strlen($email1) > 0) { enviaremail($email1,'',$titulo,$ttt); echo '<BR>enviado para '.$email1; }
			if (strlen($email2) > 0) { enviaremail($email2,'',$titulo,$ttt); echo ' e '.$email2; }
		}
	}
echo '<h3>Fim do envio</h3>';
echo $hd->foot();
?>

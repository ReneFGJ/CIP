<?php
$trab = $dd[9];
if (strlen($trab) > 0) {
	$trab = troca($trab, '*', '');
	$sql = "select * from articles where 
			(
			article_ref = '" . $trab . "'
			or 
			article_ref = '" . $trab . "*'
			or
			article_ref = '=" . $trab . "'
			or 
			article_ref = '=" . $trab . "*'
			)
			and journal_id = 85";
	$rlt = db_query($sql);
	
	if ($line = db_read($rlt)) {
		$id = $line['id_article'];
		$titulo = trim($line['article_title']);
		$autor = trim($line['article_autores']);
		//echo $titulo.'<BR><I>'.$autor.'</I>';
		
		$sql = "select * from semic_parecer_2014 where 
			(
			pp_protocolo = '" . $trab . "'
			or 
			pp_protocolo = '" . $trab . "*'
			or
			pp_protocolo = '=" . $trab . "'
			or 
			pp_protocolo = '=" . $trab . "*'
			)
			order by pp_abe_01
			";
		$rlt = db_query($sql);
		$line = db_read($rlt);
		
		$na = trim($line['pp_abe_01']);
		$p3 = round($line['pp_p03']);
		
		
		if ((strlen($na) > 0) or ($p3 == 0))
			{
				$tela = '<h2><font color="red">O avaliador não localizou o estudante para análise do trabalho</font></h2>' . $tela;
				
			} else {
				$link = '<A HREF="http://www2.pucpr.br/reol/eventos/cicpg/declaracao_apresentacao.php?dd0=' . $id . '&dd90=' . checkpost($id) . '" target="_new" class="botao_certificado">';
				$link .= 'Imprimir o Certificado de Apresentação Oral / Pôster';
				$link .= '</A>';
				$tela = $link . $tela;
			}
	} else {
		$tela = '<h1><font color="red">Trabalho não localizado!</font></h1>' . $tela;
	}
}
?>
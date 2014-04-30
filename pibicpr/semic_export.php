<?php
require("cab.php");
require($include.'sisdoc_autor.php');
$jid = 67;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../editora2/_class/_class_artigos.php");
$ar = new artigos;

require("../_class/_class_semic.php");
$sm = new semic;

require("../editora2/_class/_class_secoes.php");
$sec = new secoes;

//$sql = "delete from articles where journal_id = 67 and article_issue = 528";
//$rlt = db_query($sql);
//echo $sql;
//exit;

$sql = "select * from ".$sm->tabela." 
		left join programa_pos on sm_programa = pos_codigo
		left join centro on pos_centro = centro_codigo
		where (sm_status <> '@')
		order by centro_nome, pos_nome
		limit 2000
";
$rlt = db_query($sql);
$ar->issue = 528;
$xpos = ''; $vpos = 0;
while ($line = db_read($rlt))
	{
		/* variaveis */
		/* Programa de Pós */
		$npos = trim($line['pos_nome']);
		if ($npos != $xpos)
			{
				$vpos = 1;
				$xpos = $npos;
			}
		
		/* Formação */
		$for = trim($line['sm_formacao']);
		if ($for=='D') { $for = 'Doutorado'; }
		if ($for=='M') { $for = 'Mestrado'; }

		/* Instituicao */
		$instituicao = ($line['sma_instituicao']);
		if (strlen($instituicao) == 0) { $instituicao = 'PUCPR'; }

		/* RESUMO */
		$resumo_1 = trim($line['sm_resumo_01']);
		$resumo_1 = troca($resumo_2,'Introdução:','<B>Introduction</B>:');
		$resumo_1 = troca($resumo_2,'Objetivos:','<B>Objectives</B>:');
		$resumo_1 = troca($resumo_2,'Metodologia:','<B>Methods</B>:');
		$resumo_1 = troca($resumo_2,'Resultados:','<B>Results</B>:');
		$resumo_1 = troca($resumo_2,'Conclusões:','<B>Conclusion</B>:');		
		
		$resumo_2 = trim($line['sm_resumo_02']);
		$resumo_2 = troca($resumo_2,'Introduction:','<B>Introduction</B>:');
		$resumo_2 = troca($resumo_2,'Objectives:','<B>Objectives</B>:');
		$resumo_2 = troca($resumo_2,'Methods:','<B>Methods</B>:');
		$resumo_2 = troca($resumo_2,'Results:','<B>Results</B>:');
		$resumo_2 = troca($resumo_2,'Conclusion:','<B>Conclusion</B>:');
		

		/* Sessão */
		$sigla = trim($line['pos_sigla']);
		$session = trim($sec->busca_secao($sigla,$jid));		
				
		/* Referencia do trabalho */
		$ref = trim($sec->abbrev).strzero($vpos,2);
		
		
		/* Resumo 01A */
		$rs1 = '<B>Introdução</B>: '.trim($line['sm_rem_01']);
		$rs1 .= ' <B>Objetivo</B>: '.trim($line['sm_rem_02']);
		$rs1 .= ' <B>Metodologia</B>: '.trim($line['sm_rem_03']);
		if (strlen(trim($line['sm_rem_04'])) > 0) { $rs1 .= ' <B>Resultados</B>: '.trim($line['sm_rem_04']); }
		if (strlen(trim($line['sm_rem_05'])) > 0) { $rs1 .= ' <B>Conclusões</B>: '.trim($line['sm_rem_05']); }

				
		/* Resumo 01A */
		$rs2 = '<B>Introduction</B>: '.trim($line['sm_rem_01']);
		$rs2 .= ' <B>Objectives</B>: '.trim($line['sm_rem_02']);
		$rs2 .= ' <B>Methods</B>: '.trim($line['sm_rem_03']);
		if (strlen(trim($line['sm_rem_14'])) > 0) { $rs2 .= ' <B>Results</B>: '.trim($line['sm_rem_14']); }
		if (strlen(trim($line['sm_rem_15'])) > 0) { $rs2 .= ' <B>Conclusion</B>: '.trim($line['sm_rem_15']); }

		/* Resumo */
		if (strlen($line['sm_resumo_01']) > 0) { $rs1 = $resumo_1; }
		if (strlen($line['sm_resumo_02']) > 0) { $rs2 = $resumo_2; }
		//exit;
		
		$sa = '<I>Programa de Pós-Graduação em '.trim($line['pos_nome']);
		$sa .= ' - '.trim($line['centro_nome']).'</I>'.chr(13);
		$tipop = trim($line['sm_modalidade']);
		switch($tipop)
			{
			case 'Em andamento': $tipop = 'Projeto em andamento'; break;
			}
			
		$sb = $tipop.' - '.$for.chr(13);
		$sa = $sb . $sa;
		$modalidade = $line['sm_modalidade'];
		$form = $line['sm_formacao'];
		$programa = $line['sm_programa'];
		$proto = "MS".strzero($line['id_sm'],7);
		$origem = strzero($line['id_sm'],7);
 
		if (strlen($session)==0)
			{
				print_r($line);
				echo '<HR>'.$sigla.'<HR>';
				exit;
			}

		/* Autores */
		$sql = "select * from ".$sm->tabela."_autor 
				where sma_protocolo = '".strzero($line['id_sm'],7)."'
				and sma_ativo = 1
				order by sma_funcao
				";
		$xrlt = db_query($sql);
		$sx = '';
		$sb = '';
		while ($xline = db_read($xrlt))
			{
				$func = trim($xline['sma_funcao']);
				$instituicao = trim($xline['sma_instituicao']);
				$autor = trim($xline['sma_nome']);
				if (utf8_detect($autor)) { $autor = utf8_decode($autor); }
				
				$autor = nbr_autor(Lowercase($autor),7);
				$sc = nbr_autor($autor,1);
				if (strlen($sb) > 0) { $sb .= '; '; }
				$sb .= $sc;
				$sx .= $sc;
				$sx .= ';';
				$sx .= $sm->autor_tipo($func);
				$sx .= ' - '.$instituicao;
				$sx .= chr(13);
				//echo '<HR>';
			}
			$sb .= '.';
		$ar->autores = $sx.$sa;
		$ar->autor = $sb;
		$ar->session = $session;
		$ar->protocolo = $proto;
		$ar->titulo = trim($line['sm_titulo']);
		$ar->titulo_en = trim($line['sm_titulo_en']);
		$ar->resumo = $rs1;
		$ar->resumo_alt = $rs2;
		$ar->keyword = trim($line['sm_rem_06']);
		$ar->keyword_alt = trim($line['sm_rem_16']);
		$ar->mod = 'POS-G';
		$ar->ingles = 'N';
		$ar->ref = $ref;
		$ar->jid = $jid;
		$ar->article_author_pricipal = trim($line['sm_docente']);
		$ar->visible = 'S';
		$ar->article_seq = $vpos;
		$ar->internacional = 'N';
		if (trim($line['sm_status'])=='X')
			{
				$ar->ref = 'CANCELADO';
				$ar->publicado = 'X';
				echo '<BR>'.$ar->protocolo.'->CANCELADO ';
				echo '<BR>'.$ar->titulo;
			} else {
				$ar->publicado = 'S';
				$vpos++;		
			}
		
		
		if ($ar->insert_article() == 1)
			{ echo '<BR>'.$ar->protocolo.'->NOVO '; }
	}

echo '<h3>FIM</H3>';


require("../foot.php");	
	?>
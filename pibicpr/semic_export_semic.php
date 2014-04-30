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
$sm->tabela = "semic_ic_trabalho";
$sm->tabela_autor = "semic_ic_trabalho_autor";

require("../editora2/_class/_class_secoes.php");
$sec = new secoes;

//$sql = "delete from articles where journal_id = 67 and article_issue = 528";
//$rlt = db_query($sql);
//echo $sql;
//exit;
//$deli = " and (pb_semic_area like '6.01%') ";
$deli = '';

$sql = "select substring(pb_semic_area from 1 for 4) as area2,
		substring(pb_semic_area from 1 for 10) as area, 
		* from ".$sm->tabela." 
		inner join pibic_bolsa_contempladas on pb_protocolo = sm_codigo
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		inner join pibic_professor on pb_professor = pp_cracha
		where (sm_status <> '@' and sm_status <> 'X')
		and pb_ano = '".(date("Y")-1)."'
		and (pbt_edital = 'PIBIC' or pbt_edital = 'IS' or pbt_edital = 'PIBITI')
		$deli
		and pb_resumo_nota <> '-1'
		order by pb_semic_idioma, area2, pb_semic_area, pbt_edital, pp_nome, pbt_descricao 
";
$rlt = db_query($sql);
$ar->issue = 528;
$xpos = ''; $vpos = 1;
$id = 0;
while ($line = db_read($rlt))
	{
		$id++;
		/* Origem */
		$origem = trim($line['pb_protocolo']);
		
		/* Publicado */
		$publicado = 'S';
		if ($line['pb_resumo_nota']==(-1))
			{ $publicado = '@'; }
		if (trim($line['pb_status']) == 'C')
			{ $publicado = 'X'; }
		if (trim($line['pb_status']) == 'S')
			{ $publicado = 'X'; }
		if ($publicado == 'X')
			{
				echo '-->'.trim($line['sm_titulo']);
			}	
		
		/*Internacional */
		$internacional = 'N';
		if (trim($line['pb_semic_idioma'])=='en_US')
			{ $internacional = 'S'; }
					
		/* Sessão */
		$sigla = substr(trim($line['area']),0,4);
		
		
		if ($sigla == '2.02')
			{
				$xarea = trim($line['pb_semic_area']);
				echo '->'.$area;
				if ($xarea == '2.02.00.00-X') { $sigla = '2.02.XX'; }
			}
		if ($sigla == '6.01')
			{
				$sigla = substr(trim($line['area']),0,7);	
			}
			
		echo '==>'.$sigla;
		$session = trim($sec->busca_secao($sigla,$jid));
		
		/* variaveis */
		/* Sessão */
		if ($sigla != $xpos)
			{
				$vpos = 1;
				$xpos = $sigla;
			}
		
		/* Formação */
		$for = trim($line['pbt_descricao']);

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
				
				
		/* Referencia do trabalho */
		$ref = trim($sec->abbrev).strzero($vpos,2);
		if (trim($line['pb_semic_idioma'])=='en_US')
			{ $ref = 'i'.$ref; }
		if (trim($line['pbt_edital'])=='PIBITI')
			{ $ref .= 'T'; }
		//$ref .= '('.$line['pb_resumo_nota'].')';
		//echo '<BR>'.$ref;
		$vpos++;

		/* Resumo 01A */
		$rs1 = '<B>Introdução</B>: '.trim($line['sm_rem_01']);
		$rs1 .= ' <B>Objetivo</B>: '.trim($line['sm_rem_02']);
		$rs1 .= ' <B>Metodologia</B>: '.trim($line['sm_rem_03']);
		if (strlen(trim($line['sm_rem_04'])) > 0) { $rs1 .= ' <B>Resultados</B>: '.trim($line['sm_rem_04']); }
		if (strlen(trim($line['sm_rem_05'])) > 0) { $rs1 .= ' <B>Conclusões</B>: '.trim($line['sm_rem_05']); }

				
		/* Resumo 01A */
		$rs2 = '<B>Introduction</B>: '.trim($line['sm_rem_11']);
		$rs2 .= ' <B>Objectives</B>: '.trim($line['sm_rem_12']);
		$rs2 .= ' <B>Methods</B>: '.trim($line['sm_rem_13']);
		if (strlen(trim($line['sm_rem_14'])) > 0) { $rs2 .= ' <B>Results</B>: '.trim($line['sm_rem_14']); }
		if (strlen(trim($line['sm_rem_15'])) > 0) { $rs2 .= ' <B>Conclusion</B>: '.trim($line['sm_rem_15']); }

		/* Resumo */
		if (strlen($line['sm_resumo_01']) > 0) { $rs1 = $resumo_1; }
		if (strlen($line['sm_resumo_02']) > 0) { $rs2 = $resumo_2; }
		//exit;
		
		$sa = '';
		$sa .= ' - '.trim($line['centro_nome']).'</I>'.chr(13);
		$tipop = trim($line['pbt_edital']);
		switch($tipop)
			{
			case 'IS': $tipop = 'Fundação Araucária'; break;
			}
			
		$sb = $tipop.' - '.$for.chr(13);
		$sa = $sb . $sa;
		$modalidade = $line['sm_modalidade'];
		$form = $line['sm_formacao'];
		$programa = $line['sm_programa'];
		$proto = "IC".$line['pb_protocolo'];
 
		if (strlen($session)==0)
			{
				print_r($line);
				echo '<HR>'.$sigla.'<HR>';
				exit;
			}

		/* Autores */
		$sql = "select * from ".$sm->tabela."_autor 
				where sma_protocolo = '".$line['pb_protocolo']."'
				and sma_ativo = 1
				order by sma_funcao
				";
		$xrlt = db_query($sql);
		$sx = '';
		$sb = '';
		while ($xline = db_read($xrlt))
			{
				//print_r($line);
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
			}
			$sb .= '.';

		$ar->autores = $sx.$sa;
		$ar->autor = $sb;
		$ar->session = $session;
		$ar->protocolo = $proto;
		echo '==>'.$internacional;

		$ar->titulo = trim($line['sm_titulo']);
		$ar->titulo_en = trim($line['sm_titulo_en']);
		$ar->resumo = $rs1;
		$ar->resumo_alt = $rs2;				
		$ar->keyword = trim($line['sm_rem_06']);
		$ar->keyword_alt = trim($line['sm_rem_16']);

		$ar->mod = trim($line['pbt_edital']);
		$ar->ingles = 'N';
		$ar->ref = $ref;
		$ar->jid = $jid;
		$ar->visible = 'S';
		$ar->article_seq = $vpos*1	;
		$ar->internacional = $internacional;
		$ar->publicado = $publicado;
		$ar->article_author_pricipal = trim($line['pp_cracha']);
		
		echo $ref.'-'.$line['pb_status'].'['.$publicado.']';
		echo '-->'.$line['sm_titulo'];
		
		if ($ar->insert_article() == 1)
			{ echo '<BR>'.$ar->protocolo.'->NOVO '; }
		
	}

echo '<h3>FIM</H3>';
echo 'Total: '.$id;

require("../foot.php");	
?>
<?php
require ("cab_semic.php");
require ($include . 'sisdoc_autor.php');
$jid = 85;
$xjid = strzero($jid, 7);
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs, array(http . 'admin/index.php', msg('principal')));
array_push($breadcrumbs, array(http . 'admin/index.php', msg('menu')));
echo '<div id="breadcrumbs">' . breadcrumbs() . '</div>';

require ("../editora/_class/_class_artigos.php");
$ar = new artigos;

require ("../_class/_class_semic.php");
$sm = new semic;
$sm -> tabela = "semic_ic_trabalho";
$sm -> tabela_autor = "semic_ic_trabalho_autor";

require ("../editora/_class/_class_secoes.php");
$sec = new secoes;

//$sql = "delete from articles where journal_id = 67 and article_issue = 528";
//$rlt = db_query($sql);
//echo $sql;
//exit;
//$deli = " and (pb_semic_area like '6.01%') ";
$deli = '';

$sql = "select substring(pb_semic_area from 1 for 4) as area2,
		substring(pb_semic_area from 1 for 10) as area, 
		* from " . $sm -> tabela . " 
		inner join pibic_bolsa_contempladas on pb_protocolo = sm_codigo
		inner join pibic_bolsa_tipo on pbt_codigo = pb_tipo
		inner join pibic_professor on pb_professor = pp_cracha
		left join centro on centro_codigo = pp_escola 
		where (sm_status <> '@' and sm_status <> 'X')
		and pb_ano = '" . (date("Y") - 1) . "'
		and (pbt_edital = 'PIBIC' or pbt_edital = 'IS' or pbt_edital = 'PIBITI')
		$deli
		and pb_resumo > 20000101
		order by pb_semic_idioma, area2, pb_semic_area, pbt_edital, pp_nome, pbt_descricao 
";
$sql = "select * from submit_documento
			left join sections on doc_sessao = section_id 
			where doc_journal_id = '$xjid' and 
				(doc_status <> 'D' and doc_status <> '@' and doc_status <> 'P' and doc_status <> 'X')
				
			order by doc_field_1, doc_autor_principal
";
$rlt = db_query($sql);
$xpos = '';
$vpos = 1;
$id = 0;
while ($line = db_read($rlt)) {
	$id++;
	/* Origem */
	$origem = trim($line['doc_protocolo']);
	$area = trim($line['doc_field_1']);
	$apresentacao = trim($line['section_id']);

	/* Publicado */
	$publicado = 'S';
	if ($publicado == 'X') {
		echo '<BR>******** CANCELADO **********<BR>';
		echo '-->' . trim($line['sm_titulo']);
	}

	/*Internacional */
	$internacional = 'N';

	/* Sessão */
	$sigla = substr(trim($line['doc_field_1']), 0, 4);

	if ($sigla == '2.02') {
		$xarea = trim($line['doc_field_1']);
		//echo '-área->'.$area;
		if ($xarea == '2.02.00.00-X') { $sigla = '2.02.XX';
		}
	}
	if ($sigla == '6.01') {
		$sigla = substr(trim($line['doc_field_1']), 0, 7);
	}

	echo '<font color="red">Protocolo:' . $origem . '</font>=Sigla=>' . $sigla;
	echo '==SIGLA===>' . $sigla;
	$session = trim($sec -> busca_secao($sigla, $jid));
	echo '<BR>==========<BR>';
	/* variaveis */
	/* Sessão */
	if ($sigla != $xpos) {
		$vpos = 2;
		$xpos = $sigla;
	}
	/* Formação */
	$for = trim($line['pbt_descricao']);

	/* Instituicao */
	$instituicao = ($line['sma_instituicao']);
	if (strlen($instituicao) == 0) { $instituicao = 'PUCPR';
	}

	/* Referencia do trabalho */
	$ref = trim($sec -> abbrev) . strzero($vpos, 2);
	if (trim($line['pb_semic_idioma']) == 'en_US') { $ref = 'i' . $ref;
	}
	if (trim($line['pbt_edital']) == 'PIBITI') { $ref .= 'T';
	}

	//$ref .= '('.$line['pb_resumo_nota'].')';
	//echo '<BR>'.$ref;
	$vpos++;
	$vpos++;

	$sb = '';
	//$tipop . ' -x- ' . $for . chr(13);
	$sa = ''; //$sb . $sa;
	$modalidade = $line['sm_modalidade'];
	$form = $line['sm_formacao'];
	$programa = $line['sm_programa'];
	$proto = "CI" . $line['doc_protocolo'];

	if (strlen($session) == 0) {
		echo '<HR>SIGLA-->' . $sigla . '<HR>';
		exit ;
	}

	/* Autores */
	$sql = "select * from submit_documento_autor 
				where sma_protocolo = '" . $line['doc_protocolo'] . "'
				and sma_ativo = 1
				order by sma_funcao
				";

	$xrlt = db_query($sql);
	$sx = '';
	$sb = '';
	while ($xline = db_read($xrlt)) {
		$func = trim($xline['sma_funcao']);
		$instituicao = trim($xline['sma_instituicao']);
		$autor = trim($xline['sma_nome']);
		if (utf8_detect($autor)) { $autor = utf8_decode($autor);
		}
		if (strlen($autor) > 5) {
			$autor = nbr_autor(Lowercase($autor), 7);
			$sc = nbr_autor($autor, 1);
			if (strlen($sb) > 0) { $sb .= '; ';
			}
			$sb .= $sc;
			$sx .= $sc;
			$sx .= ';';
			$sx .= $sm -> autor_tipo($func);
			$sx .= ' - ' . $instituicao;
			$sx .= chr(13);
		}
	}

	/* tipo de apresentação */
	$en = 0;
	$oral = 0;
	$issue = $line['doc_sessao'];

	switch ($issue) {
		/* Oral Inglês */
		case '912' :
			$ar -> issue = 641;
			$oral = 1;
			break;

		case '913' :
			$ar -> issue = 641;
			$oral = 1;
			break;

		/* Tecnologica - Poster */

		case '905' :
			$ar -> issue = 644;
			break;
		/* Tecnologica - Oral */
		case '903' :
			$ar -> issue = 643;
			$oral = 1;
			break;
		case '902' :
			/* ORAL */
			$ar -> issue = 637;
			$oral = 1;
			break;
		case '907' :
			/* ORAL - Mestrado */
			$ar -> issue = 637;
			$oral = 1;
			break;
		case '906' :
			/* ORAL PÓS-graduação*/
			$ar -> issue = 632;
			$oral = 1;
			break;
		case '910' :
			/* POSTER PÓS-graduação (Mestrado)*/
			$ar -> issue = 640;
			break;
		case '911' :
			/* POSTER PÓS-graduação*/
			$ar -> issue = 640;
			break;
		case '904' :
			/* Poster */
			$ar -> issue = 638;
			break;

		default :
			echo '==ERRO==Issue:' . $issue;
			exit ;
	}

	$sb .= '.';
	echo 'FIM';
	$ar -> autores = $sx . $sa;
	$ar -> autor = $sb;
	$ar -> session = $session;
	$ar -> protocolo = $proto;
	//echo '=Internacional=>'.$internacional;

	$ar -> titulo = trim($line['doc_1_titulo']);
	$ar -> titulo_en = trim($line['doc_2_titulo']);
	$ar -> resumo = $line['doc_resumo'];
	$ar -> resumo_alt = '';
	$ar -> keyword = trim($line['doc_palavra_chave']);
	$ar -> keyword_alt = '';

	/* Oral */
	if ($oral == 1) {
		$ref .= '*';
	}

	/* Envia Dados */
	$ar -> mod = 'CICPG';
	$ar -> ingles = 'N';
	$ar -> ref = $ref;
	$ar -> jid = $jid;
	$ar -> visible = 'S';
	$ar -> article_seq = $vpos * 2;
	$ar -> internacional = $internacional;
	$ar -> publicado = $publicado;
	$ar -> article_author_pricipal = trim($line['doc_autor_principal']);
	//echo $ref.'-'.$line['pb_status'].'['.$publicado.']';
	//echo '-titulo->'.$line['sm_titulo'];
	echo '<HR>';
	echo '<font color="blue">';
	echo '<h2>' . $id . '</h2>';
	echo $ref;
	echo '</font>';

	if ($ar -> insert_article() == 1) { echo '<BR>' . $ar -> protocolo . '->NOVO ';
	}
}

echo '<h3>FIM</H3>';
echo 'Total: ' . $id;

require ("../foot.php");
?>
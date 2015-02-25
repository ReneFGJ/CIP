<?
global $dd;
require("include/sisdoc_windows.php");
require("include/sisdoc_data.php");
require("include/issues.php");
require('./include/sisdoc_autor.php');
require_once($include.'sisdoc_data.php');
?>
<head>
<?
//	<title>Semantic theories of  information | Braga | Ciência da Informação</title>
//	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
//	<meta name="description" content="Semantic theories of  information" />
//		<meta name="keywords" content="Teoria da Informação. Semântica. Teoria da Comunicação. Significado. Relevância. Teoria Semântica da Informação. Informação." />
//	
//	<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />
//
//	<meta name="DC.Creator.PersonalName" content="Gilda Maria Braga"/>
//
//	<meta name="DC.Date.available" scheme="ISO8601" content="2009-03-11"/>
//	<meta name="DC.Date.created" scheme="ISO8601" content="2009-03-19"/>
//	<meta name="DC.Date.dateSubmitted" scheme="ISO8601" content="2009-03-19"/>
//	<meta name="DC.Date.issued" scheme="ISO8601" content="1977-12-30"/>
//	<meta name="DC.Date.modified" scheme="ISO8601" content="2009-03-27"/>
//	<meta name="DC.Description" content=" Ao final dos anos 40, todas as teorias matemáticas da informação sugerem conceitos antagônicos de //formação, além de parecerem deixar de lado a noção de significado. A análise de Shannon sobre a quantidade de informação contida em um sinal //declina explicitamente de qualquer interesse pelo significado,sendo qualificada pelos semanticistas de inadequada.Bar-Hillel &amp; Carnap, //1952, sugerem duas possíveis medidas de conteúdo de informação nos signos em um sistema em linguagem artificial. Schreider, 1965, declara //que, em diferentes situações, a habilidade do receptor em entender a comunicação é a característica mais importante do processo. Goffman, na //sua Teoria Geral da Comunicação, expande a teoria de Shannon,onde existem três grandes fenômenos a serem considerados- geração, transmissão //e uso da informação. Se considerarmos o efeito da medida Relevância sobre o receptor e analisarmos suas implicações estaremos talvez mais //próximos de uma Teoria Unificada da Informação, do que estamos com a introdução do significado — ponto de discussão entre os semanticistas. //(HB)   Descritores   Teoria da Informação. Semântica. Teoria da Comunicação. Significado. Relevância. Teoria Semântica da Informação. //Informação.   Abstract   All mathematical theories of Information in the late fourties suggested rival concepts of information;furthermore //the notion of &quot;meaning&quot; seemed to have been left out Shannon&#039;s analysis of the amount of Information in a signal disclaimed //explicity any concern with its meaning and had been qualified asinadequate by the Semanticists. Bar—Hillel and Carnap, 1952, suggested two //possible measures of the Information content of statements in an artificial language system. Schreider, 1965. states that in several //situations the receiver&#039;s ability to understand the communication is the most Important characteristic of the process. Goffman expanded //Shannon&#039;s theory inhis General Theory of Communication, where there are 3 large phenomena to be considered — Information generation, //transmission and use. If we consider the effect of Relevance on the receiver and explore further its implications me might be closer to a //better and unified theory of information than weare with the introduction of meaning — a point still indiscussion among Semanticists. (HB)    //"/>
//	<meta name="DC.Format" scheme="IMT" content="application/pdf"/>		
//	<meta name="DC.Identifier" content="1577"/>
//	<meta name="DC.Identifier.URI" content="http://revista.ibict.br/ciinf/index.php/ciinf/article/view/1577"/>
//
//	<meta name="DC.Language" scheme="ISO639-1" content="pt"/>
//	<meta name="DC.Rights" content="A revista se reserva o direito de efetuar, nos originais, alterações de ordem normativa, ortográfica e gramatical, com vistas a manter o padrão culto da língua, respeitando, porém, o estilo dos autores. As provas finais não serão enviadas aos autores. Os trabalhos publicados passam a ser propriedade da revista Ciência da Informação, ficando sua reimpressão total ou parcial, sujeita à autorização expressa da direção do IBICT. Deve ser consignada a fonte de publicação original. Os originais não serão devolvidos aos autores. As opiniões emitidas pelos autores dos artigos são de sua exclusiva responsabilidade. Cada autor receberá dois exemplares da revista. "/>
//	<meta name="DC.Source" content="Ciência da Informação"/>
//	<meta name="DC.Source.ISSN" content="1518-8353"/>
//	<meta name="DC.Source.Issue" content="2"/>
//	<meta name="DC.Source.URI" content="http://revista.ibict.br/ciinf/index.php/ciinf"/>
//	<meta name="DC.Source.Volume" content="6"/>
//	<meta name="DC.Subject" content="Teoria da Informação. Semântica. Teoria da Comunicação. Significado. Relevância. Teoria Semântica da Informação. Informação."/>
//	<meta name="DC.Title" content="Semantic theories of  information"/>
//
//		<meta name="DC.Type" content="Text.Serial.Journal"/>
//	<meta name="DC.Type.articleType" content="Artigos"/>			<meta name="gs_meta_revision" content="1.1" />
//	<meta name="citation_journal_title" content="Ciência da Informação"/>
//	<meta name="citation_issn" content="1518-8353"/>
//	<meta name="citation_authors" content="Braga, Gilda Maria"/>
//	<meta name="citation_title" content="Semantic theories of  information"/>
//	<meta name="citation_date" content="19/03/2009"/>
//	<meta name="citation_volume" content="6"/>
//
//	<meta name="citation_issue" content="2"/>
//	<meta name="citation_abstract_html_url" content="http://revista.ibict.br/ciinf/index.php/ciinf/article/view/1577"/>
//	<meta name="citation_pdf_url" content="http://revista.ibict.br/ciinf/index.php/ciinf/article/view/1577/1191"/>
//</head>


$S =  issue($dd[1],1);
if ($mostra_issue == True)
	{
	echo $S;
	}

$sql = "select articles.journal_id as j_id,* from articles ";
$sql .= " left join articles_files on articles_files.article_id = articles.id_article and fl_type = 'PDF' ";
$sql .= " where articles.id_article = '".sonumero('0'.$dd[1])."' ";
$sql .= " order by id_fl desc ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	if ($line['j_id'] == $jid)
		{
		$formato = 1;
		$AutorFormato = 1;
		
		define(bgborder,"#CCCCCC");
		$id_article = $dd[1];
		{
			$xlink = '<A HREF="?dd1='.$line['id_article'].'&dd99=view" class="lt2">';
			$tit1=trim($line['article_title']);
			$tit2=trim($line['article_2_title']);
			$tit3=TRIM($line['article_3_title']);
			if (strlen($is_max) == 0) { $is_max = '640'; }
			
			$doi=TRIM($line['article_doi']);
			
			?>
			<P>
			<TABLE width="<?=$is_max?>" border=0 align="center">
			<?
			if (strlen($doi) > 0)
				{
				$sr = '<TR><TD class="lt1" colspan=3 align="right">DOI: <B>'.$doi.'</B>';
				$sr .= '<TR><TD class="lt1" colspan=3 align="right">&nbsp;';
				echo $sr;
				$sr = '';				
				}			
			?>
			<TR><TD rowspan="20">&nbsp;&nbsp;</TD><TD class="lt3" colspan="2"><?=$tit1;?>
		<?
			if (isset($tit2)) { echo '<P><FONT CLASS="lt2"><I>'.$tit2; } 
			if (isset($tit3)) { echo '<P><FONT CLASS="lt2"><I>'.$tit3; } 
			?></TD></TR>
			<?
			/**** autores ****/
		?>
			<TR><td width="3%">&nbsp;</td><TD class="lt1" width="97%"><I><?
			$nme=$line['article_author'];
			$autor = mst_autor($nme,2);
			echo $autor;
			?>
			</TD></TR>
			<?
			$art_id = $line['id_article'];
			$dt1=$line['article_dt_envio'];
			$dt2=$line['article_dt_aceite'];
			$ab1=$line['article_abstract'];
			$ab2=$line['article_2_abstract'];
			$ab3=$line['article_3_abstract'];
			
			$su1=$line['article_keywords'];
			$su2=$line['article_2_keywords'];
			$su3=$line['article_3_keywords'];
			
			$id1=$line['article_idioma'];
			$id2=$line['article_2_idioma'];
			$id3=$line['article_3_idioma'];
			
			$t2 = strtolower($path.'.'.$jnid);
			
			if (strlen($ab1) > 0) { $rlt = view000($ab1,$id1,$su1); }
			if (strlen($ab2) > 0) { $rlt = view000($ab2,$id2,$su2); }
			if (strlen($ab3) > 0) { $rlt = view000($ab3,$id3,$su3); }
			}
			?>		
			<TR><TD colspan="3" class="lt0"><P>&nbsp;<P>
			<?
			$autor = mst_autor($nme,3);
			echo $autor;
			?>
			</TD></TR>
			<TR><TD colspan="3"><BR>
			<?=view_envio($dt1,$dt2,$id1,$tit1);?>
			<?=view_envio($dt1,$dt2,$id2,$tit2);?>
			<?=view_envio($dt1,$dt2,$id3,$tit3);?>
			</TD></TR>
			<TR><TD>
			<?
			$filename = $line['fl_filename'];
			if ((strlen($no_pdf) == 0) or (strlen($filename) > 0))
			{
			echo '<A HREF="javascript:newxy('.chr(39).http.'index.php/'.$path.'?dd1='.$dd[1].'&dd99=pdf'.chr(39).',180,20);" title="Format PDF'.chr(13).'click aqui e veja o artigo'.chr(13).'na integra">[pdf]<font class="lt1"><BR>download do trabalho</font></A>';
			}
			$link_oai = '<A HREF="#" onclick="newxy('.chr(39).http."index.php/".$path."/oai/?verb=GetRecord&metadataPrefix=oai_dc&identifier=".$t2.':article/'.$art_id."',600,400);".'">';
			?>
			</TD></TR>
			<TR><TD><P>&nbsp;</P></TD></TR>
			<TR><TD colspan="3" class="lt1" align="left"><I>OAI-ID:</I> oai:<?=$t2.':article/'.$art_id?></TD></TR>		
			<TR><TD colspan="10" class="lt1" align="left"><I>link:</I> <?=http.'index.php/'.$path.'?dd1='.$art_id.'&dd99=view'?></TD></TR>		
			<TR><TD><?=$link_oai?><img src="<?=$img_dir?>oai_metadata.jpg" width="74" height="14" alt="" border="0"></A></TD></TR>
			</TABLE>		
			<?
		}
}	
function view_envio($de,$da,$id,$tit)
	{
	if (strlen($tit) > 0)
		{
		$tt1="";
		$rlt="";
		if (substr($id,0,2)=='pt') 
			{
			$rlt = '<DIV width="100%" class="lt0"  align="right">';
			if ($de != '19000101')
				{ $rlt = $rlt . 'Recebido em '.stodbr($de).'; '; }
			if ($da != '19000101')
				{ $rlt = $rlt . 'Aceito em '.stodbr($da).'.'; }
			$rlt = $rlt . '</DIV>';
			}
		if (substr($id,0,2)=='en') 
			{
			$rlt = '<DIV width="100%" class="lt0"  align="right">';
			if ($de != '19000101')
				{ $rlt = $rlt . 'Received in '.stodus($de).'; '; }
			if ($da != '19000101')
				{ $rlt = $rlt . 'Accepted in '.stodus($da).'.</DIV>'; }
			$rlt = $rlt . '</DIV>';
			}
		}
	return($rlt);
	}

function view000($ab,$id,$su)
	{
	if (strlen($ab) > 0)
		{
		$ab = str_replace(chr(13),'&nbsp;<BR>',$ab);
		echo '<TR><TD colspan="2">&nbsp;</TD></TR>';
		echo '<TR class="lt2"><TD colspan="2"><DIV align="justify" class="lta">';
		if (substr($id,0,2)=='pt') {$tt1='Resumo'; $tt2='Palavras-chave'; };
		if (substr($id,0,2)=='en') {$tt1='Abstract'; $tt2='Keywords'; };
		if (substr($id,0,2)=='fr') {$tt1='Résumé'; $tt2='Most-clés'; };
		echo '<B>'.$tt1.'</font></B><BR><img src="'.$img_dir.'nada.gif" width="1" height="8" alt="" border="0"><BR>';
		echo $ab;
		echo '</DIV></TD></TR>';
		if (isset($su) and (strlen(trim($su)) > 0))
			{
			echo '<TR><TD class="lta" colspan="2"><BR><B>'.$tt2.' :&nbsp;</B>';
			echo $su;
			echo '</TD></TR>';
			}
		}	
	}
?>
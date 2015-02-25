<?
global $dd;
require("include/sisdoc_windows.php");
require_once("include/sisdoc_data.php");
require("include/issues.php");
require('./include/sisdoc_autor.php');

$head = '';
$meta = '';
$sr = '';
$nl = chr(13).chr(10);
$head .= '<head>'.$nl;
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?
$sr .= issue($dd[1],1);

$sql = "select * from articles where id_article = '".round('0'.$dd[1])."' ";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	if ($line['journal_id'] == $jid)
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
			
			$doi=TRIM($line['article_doi']);

			if (strlen($is_max) == 0) { $is_max = '640'; }
			$sr .= '<P>';
			$sr .= '<TABLE width="'.$is_max.'" border=0 align="center">';
			if (strlen($doi) > 0)
				{
				$sr .= '<TR><TD class="lt1" colspan=3 align="right">DOI: <B>'.$doi.'</B>';
				$sr .= '<TR><TD class="lt1" colspan=3 align="right">&nbsp;';				
				}

			$sr .= '<TR><TD rowspan="20">&nbsp;&nbsp;</TD><TD class="lt3" colspan="2">'.$tit1;
			if (isset($tit2)) { $sr .= '<P><FONT CLASS="lt2"><I>'.$tit2; } 
			if (isset($tit3)) { $sr .= '<P><FONT CLASS="lt2"><I>'.$tit3; } 
			$sr .= '</TD></TR>';
			/**** autores ****/
			$sr .= '<TR><td width="3%">&nbsp;</td><TD class="lt1" width="97%"><I>';
			$nme=$line['article_author'];
			$autor = mst_autor($nme,2);
			$sr .= $autor;
			$sr .= '</TD></TR>';

			$art_id = $line['id_article'];
			$dt1=$line['article_dt_envio'];
			$dt2=$line['article_dt_aceite'];
			$ab1=$line['article_abstract'];
			$ab2=$line['article_2_abstract'];
			$ab3=$line['article_3_abstract'];
			
			$su1=troca($line['article_keywords'],';','.');
			$su2=troca($line['article_2_keywords'],';','.');
			$su3=$line['article_3_keywords'];
			
			$id1=$line['article_idioma'];
			$id2=$line['article_2_idioma'];
			$id3=$line['article_3_idioma'];
			
			$t2 = strtolower($path.'.'.$jnid);
			
			/////////////qq meta
			$nome_journal = $titulo;
			$titulo = $tit1 . ' | '.$titulo;
			$head .= '<title>'.$tit1.' | '.$titulo.'</title>'.$nl;
			$meta .= '<meta name="description" content="'.$tit1.'" />'.$nl;
			$meta .= '<meta name="keywords" content="'.$su1.'. '.$su2.'" />'.$nl;
			$meta .= '<link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />'.$nl;
			$aut = $autor;

			while (strpos($aut,'<sup>'))
				{
				$aut1 = substr($aut,0,strpos($aut,'<'));
				$meta .= '<meta name="DC.Creator.PersonalName" content="'.$aut1.'"/>'.$nl;
				$aut = substr($aut,strpos($aut,'</sup>')+10,strlen($aut));
				}
$meta .= '<meta name="DC.Date.available" scheme="ISO8601" content="2009-03-11"/>'.$nl;
$meta .= '<meta name="DC.Date.created" scheme="ISO8601" content="2009-03-19"/>'.$nl;
$meta .= '<meta name="DC.Date.dateSubmitted" scheme="ISO8601" content="2009-03-19"/>'.$nl;
$meta .= '<meta name="DC.Date.issued" scheme="ISO8601" content="1977-12-30"/>'.$nl;
$meta .= '<meta name="DC.Date.modified" scheme="ISO8601" content="2009-03-27"/>'.$nl;
$meta .= '<meta name="DC.Description" content=" Ao final dos anos 40, todas as teorias matem�ticas da informa��o sugerem conceitos "/>'.$nl;
$meta .= '<meta name="DC.Format" scheme="IMT" content="application/pdf"/>		'.$nl;
$meta .= '<meta name="DC.Identifier" content="1577"/>'.$nl;
$meta .= '<meta name="DC.Identifier.URI" content="http://revista.ibict.br/ciinf/index.php/ciinf/article/view/1577"/>'.$nl;
$meta .= '<meta name="DC.Language" scheme="ISO639-1" content="pt"/>'.$nl;
$meta .= '<meta name="DC.Rights" content="A revista se reserva o direito de efetuar, nos originais, altera��es de ordem normativa, ortogr�fica e gramatical, com vistas a manter o padr�o culto da l�ngua, respeitando, por�m, o estilo dos autores. As provas finais n�o ser�o enviadas aos autores. Os trabalhos publicados passam a ser propriedade da revista Ci�ncia da Informa��o, ficando sua reimpress�o total ou parcial, sujeita � autoriza��o expressa da dire��o do IBICT. Deve ser consignada a fonte de publica��o original. Os originais n�o ser�o devolvidos aos autores. As opini�es emitidas pelos autores dos artigos s�o de sua exclusiva responsabilidade. Cada autor receber� dois exemplares da revista. "/>'.$nl;
$meta .= '<meta name="DC.Source" content="Ci�ncia da Informa��o"/>'.$nl;
$meta .= '<meta name="DC.Source.ISSN" content="1518-8353"/>'.$nl;
$meta .= '<meta name="DC.Source.Issue" content="2"/>'.$nl;
$meta .= '<meta name="DC.Source.URI" content="http://revista.ibict.br/ciinf/index.php/ciinf"/>'.$nl;
$meta .= '<meta name="DC.Source.Volume" content="6"/>'.$nl;
$meta .= '<meta name="DC.Subject" content="Teoria da Informa��o. Sem�ntica. Teoria da Comunica��o. Significado. Relev�ncia. Teoria Sem�ntica da Informa��o. Informa��o."/>'.$nl;
$meta .= '<meta name="DC.Title" content="Semantic theories of  information"/>'.$nl;
$meta .= '<meta name="DC.Type" content="Text.Serial.Journal"/>'.$nl;
$meta .= '<meta name="DC.Type.articleType" content="Artigos"/>'.$nl;
$meta .= '<meta name="gs_meta_revision" content="1.1" />'.$nl;
$meta .= '<meta name="citation_journal_title" content="'.$titulo.'"/>'.$nl;
$meta .= '<meta name="citation_issn" content="1518-8353"/>'.$nl;
$meta .= '<meta name="citation_authors" content="Braga, Gilda Maria"/>'.$nl;
$meta .= '<meta name="citation_title" content="Semantic theories of  information"/>'.$nl;
$meta .= '<meta name="citation_date" content="19/03/2009"/>'.$nl;
$meta .= '<meta name="citation_volume" content="6"/>'.$nl;
$meta .= '<meta name="citation_issue" content="2"/>'.$nl;

$meta .= '<meta name="citation_abstract_html_url" content="http://revista.ibict.br/ciinf/index.php/ciinf/article/view/1577"/>'.$nl;
$meta .= '<meta name="citation_pdf_url" content="http://revista.ibict.br/ciinf/index.php/ciinf/article/view/1577/1191"/>'.$nl;
//	echo '<BR>=2========='.date("Y-m-d-H:i:s");

			if (strlen($ab1) > 0) { $sr .= view000($ab1,$id1,$su1); }
			if (strlen($ab2) > 0) { $sr .= view000($ab2,$id2,$su2); }
			if (strlen($ab3) > 0) { $sr .= view000($ab3,$id3,$su3); }
			}
			$sr .= '<TR><TD colspan="3" class="lt0"><P>&nbsp;<P>';
			$autor = mst_autor($nme,3);
			$sr .= $autor;
			$sr .= '</TD></TR><TR><TD colspan="3"><BR>';
			$sr .= view_envio($dt1,$dt2,$id1,$tit1);
			$sr .= view_envio($dt1,$dt2,$id2,$tit2);
			$sr .= view_envio($dt1,$dt2,$id3,$tit3);
			$sr .= '</TD></TR>';
			$sr .= '<TR><TD>';
//	echo '<BR>=3========='.date("Y-m-d-H:i:s");

			if (strlen($no_pdf) == 0)
			{
			$sr .= '<A HREF="javascript:newxy('.chr(39).http.'index.php/'.$path.'?dd1='.$dd[1].'&dd99=pdf'.chr(39).',180,20);" title="Format PDF'.chr(13).'click aqui e veja o artigo'.chr(13).'na integra">[pdf]</A>';
			}
			$link_oai = '<A HREF="#" onclick="newxy('.chr(39).http."index.php/".$path."/oai/?verb=GetRecord&metadataPrefix=oai_dc&identifier=".$t2.':article/'.$art_id."',600,400);".'">';

			$sr .= '</TD></TR>';
			$sr .= '<TR><TD><P>&nbsp;</P></TD></TR>';
			$sr .= '<TR><TD colspan="3" class="lt1" align="left"><I>OAI-ID:</I> oai:'.$t2.':article/'.$art_id.'</TD></TR>';
			$sr .= '<TR><TD colspan="10" class="lt1" align="left"><I>link:</I> '.http.'index.php/'.$path.'?dd1='.$art_id.'&dd99=view'.'</TD></TR>';
			$sr .= '<TR><TD>'.$link_oai.'<img src="'.$img_dir.'oai_metadata.jpg" width="74" height="14" alt="" border="0"></A></TD></TR>';
			$sr .= '</TABLE>';
		}
}	
function view_envio($de,$da,$id,$tit)
	{
	global $LANG;
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
	$rr = '';
	if (strlen($ab) > 0)
		{
		$ab = str_replace(chr(13),'&nbsp;<BR>',$ab);
		$rr .= '<TR><TD colspan="2">&nbsp;</TD></TR>';
		$rr .= '<TR class="lt2"><TD colspan="2"><DIV align="justify" class="lta">';
		if (substr($id,0,2)=='pt') {$tt1='Resumo'; $tt2='Palavras-chave'; };
		if (substr($id,0,2)=='en') {$tt1='Abstract'; $tt2='Keywords'; };
		if (substr($id,0,2)=='fr') {$tt1='R�sum�'; $tt2='Most-cl�s'; };
		$rr .= '<B>'.$tt1.'</font></B><BR><img src="'.$img_dir.'nada.gif" width="1" height="8" alt="" border="0"><BR>';
		$rr .= $ab;
		$rr .= '</DIV></TD></TR>';
		if (isset($su) and (strlen(trim($su)) > 0))
			{
			$rr .= '<TR><TD class="lta" colspan="2"><BR><B>'.$tt2.' :&nbsp;</B>';
			$rr .= $su;
			$rr .= '</TD></TR>';
			}
		}	
		return($rr);
	}
?>
<?
$ordem = $dd[90];
if (strlen($ordem) == 0)
	{ $ordem = 1; }
	
if ($ordem == 1)
//	{ $cp_order = "article_dt_envio desc "; $bold1 = '<B>';}
	{ $cp_order = " ano desc, title "; $bold1 = '<B>';}
if ($ordem == 2)
	{ $cp_order = "title desc, article_dt_envio desc "; $bold2 = '<B>';}
if ($ordem == 3)
	{ $cp_order = "article_2_title desc, article_dt_envio desc "; $bold3 = '<B>';}
			
$stabela = '<TABLE width="'.$is_max.'" border="0" align="center" '.$table_font.' >';
$stabela .='<TR><TD width="40"><TD colspan="5">';
$stabela .='<CENTER>'.$tit.'</font></CENTER>';
$stabela .='</TD></TR>';
$stabela .='<TR><TD align="right" colspan="8"><font style=" font-family: Verdana, Arial, Helvetica, sans-serif;  font-size: 10px; 	color: #660000;">Ordenado por: ';
$stabela .='<A href="?dd99=resumo&dd90=1"><font style=" font-family: Verdana, Arial, Helvetica, sans-serif;  font-size: 10px; 	color: #660000;">|&nbsp;'.$bold1.'ano</B></A>&nbsp;';
$stabela .='<A href="?dd99=resumo&dd90=2"><font style=" font-family: Verdana, Arial, Helvetica, sans-serif;  font-size: 10px; 	color: #660000;">|&nbsp;'.$bold2.'tipo</A>&nbsp;';
$stabela .='<A href="?dd99=resumo&dd90=3"><font style=" font-family: Verdana, Arial, Helvetica, sans-serif;  font-size: 10px; 	color: #660000;">|&nbsp;'.$bold3.'local de publicação&nbsp;|</A>&nbsp;';

//$stabela .='<TR bgcolor="#660000" align="center">';
//$stabela .='<TD><font color="white">Título</TD>';
//$stabela .='<TD><font color="white">Local de Publicação</TD>';
//$stabela .='<TD><font color="white">Data</TD>';


 
$s1='';
$ftabela =$ftabela . "</TABLE>";

$sql = "select round(article_dt_envio/10000) as ano,* from articles ";
$sql .= " inner join sections on article_section = section_id ";
$sql .= " where articles.journal_id = ".$jid;
$sql .= " and article_publicado <> 'D' ";
$sql = $sql . " order by $cp_order  ";

$rlt = db_query($sql);
$ref = "X";
while ($line = db_read($rlt))
	{
	$data = $line['article_dt_envio'];
	$data = nomemes_short(intval(substr($data,4,2))).'/'.substr($data,0,4);
	$link = '<a href="'.$path.'?dd1='.$line['id_article'].'&dd99=view" '.$table_line.'>'.$link_font;
	$title = $line['article_title'];
	$local = $line['article_2_title'];
	$tipo = $line['title'];
	if ($data == 'jan./1900') { $data = 'sem data'; }
	
	if ($ordem == 1)
		{
		//////////////////////// ordem por data
		$data = substr($line['article_dt_envio'],0,4);
		$data .= ' - '.$line['title'];
		if ($ref != $data)
			{ 
			$s1 .= '<TR><TD><BR></TD></TR><TR><TD width="40">';
			$s1 .= '<TD align="center" colspan="10" >';
			$s1 .= '<TABLE cellpadding="0" cellspacing="0" border="0" width="100%">';
			$s1 .= '<TR>';
//			$s1 .= '<TD width="2%"><HR width="100%" size="1" color="#660000"></TD>';
			$s1 .= '<TD class="link_menu" '.$table_head.' width="10%"><NOBR>'.$data.'&nbsp;&nbsp;</TD>';
			$s1 .= '<TD width="90%"><HR width="100%" size="1" color="#660000"></TD>';
			$s1 .= '</TR>';
			$s1 .= '</TABLE>';
			$s1 .= '</TD></TR>'; $ref = $data; 
			}
			$s1 = $s1 .'<TR valign="top" '.$table_line.'>';
			$s1 .= '<TD width="40"><img src="img/nada" width="10" height="5" alt="" border="0"></TD>';
			$s1 = $s1 .'<TD>&nbsp;&nbsp;'.$link.$title;
			$s1 .= '<TD width="10"><img src="img/nada" width="10" height="5" alt="" border="0"></TD>';
			$s1 = $s1 .'<TD>'.$link.$local;
			$s1 = $s1 .'<TD>';
			} 

	if ($ordem == 2)
		{
		//////////////////////// tipo de publicação
		if ($ref != $tipo)
			{ 
			$s1 .= '<TR><TD><BR></TD></TR><TR><TD width="40">';
			$s1 .= '<TD align="center" colspan="10" >';
			$s1 .= '<TABLE cellpadding="0" cellspacing="0" border="0" width="100%">';
			$s1 .= '<TR>';
//			$s1 .= '<TD width="2%"><HR width="100%" size="1" color="#660000"></TD>';
			$s1 .= '<TD class="link_menu" '.$table_head.' width="10%"><NOBR>'.$tipo.'&nbsp;&nbsp;</TD>';
			$s1 .= '<TD width="90%"><HR width="100%" size="1" color="#660000"></TD>';
			$s1 .= '</TR>';
			$s1 .= '</TABLE>';
			$s1 .= '</TD></TR>'; $ref = $tipo; 			
			}
			$s1 = $s1 .'<TR valign="top" '.$table_line.'>';
			$s1 .= '<TD width="10"><img src="img/nada" width="10" height="5" alt="" border="0"></TD>';
			$s1 = $s1 .'<TD>'.$link.''.$title;
			$s1 .= '<TD width="10"><img src="img/nada" width="10" height="5" alt="" border="0"></TD>';
			$s1 = $s1 .'<TD>'.$link.$local;
			$s1 = $s1 .'<TD align="right">'.$link.$data;
			$s1 = $s1 .'<TD>';
		}
		
	if ($ordem == 3)
		{
		//////////////////////// ordem por data
		if ($ref != $local)
			{ 
			$s1 .= '<TR><TD><BR></TD></TR><TR><TD width="40">';
			$s1 .= '<TD align="center" colspan="10" >';
			$s1 .= '<TABLE cellpadding="0" cellspacing="0" border="0" width="100%">';
			$s1 .= '<TR>';
//			$s1 .= '<TD width="2%"><HR width="100%" size="1" color="#660000"></TD>';
			$s1 .= '<TD class="link_menu" '.$table_head.' width="10%"><NOBR>'.$local.'&nbsp;&nbsp;</TD>';
			$s1 .= '<TD width="90%"><HR width="100%" size="1" color="#660000"></TD>';
			$s1 .= '</TR>';
			$s1 .= '</TABLE>';
			$s1 .= '</TD></TR>'; $ref = $local; 			
			}
				
			$s1 = $s1 .'<TR valign="top" '.$table_line.'>';
			$s1 .= '<TD width="10"><img src="img/nada" width="10" height="5" alt="" border="0"></TD>';
			$s1 = $s1 .'<TD>'.$link.$title;
			$s1 = $s1 .'<TD align="right">'.$link.$data;
			} 
		$s1 .= '<TR><TD height="1"><img src="../img/nada.gif" width="2" height="1" alt="" border="0"></TD></TR>';
	}

echo $stabela;
echo $s1;
echo $ftabela;

?>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
<P>&nbsp;</P>
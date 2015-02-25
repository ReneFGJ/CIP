<?
require('include/sisdoc_windows.php');
require('include/sisdoc_colunas.php');
global $issue, $mostra_issue,$is_max,$no_pdf;
/////////
if ($mostra_issue != True)
	{
	if (strlen($issue) > 0)
		{
		$sql = 'select * from articles ';
		$sql = $sql . 'inner join issue on article_issue = id_issue ';
		$sql = $sql . 'inner join sections on article_section = section_id ';
		$sql = $sql . 'where article_issue = '.round(sonumero($issue));
		if (strlen($seccao) > 0) { $sql = $sql . " and article_section = ".$seccao." "; }		
		$sql = $sql . 'and articles.journal_id = '.$jid.' ';
		
		$sql .= " and article_publicado <> 'X' ";
		$sql = $sql . ' order by seq,issue_title,sections.seq, article_seq';
		$result = db_query($sql);
		$ttt="#FFFFFF";
		//$ttt="#20c0ff";
		if (strlen($is_max) == 0) { $is_max = '668'; }		
			?>
			<TABLE width="<?=$is_max?>" cellpadding="0" cellspacing="2" border="0" class=lta >
			<TR>
			<TD width="5%">&nbsp;</TD>
			<TD width="95%">&nbsp;</TD>
			</TR>
			<?
	}
$s1=0;
$s2=0;
$s3=0;
$nr=0;
$xat=0;
$art=0;

$tat=0;
if (strlen($pgini) == 0) { $pgini = 0; }
while ($line = db_read($result))
	{
//	print_r($line);
//	exit;
	$tat++;
	$ida=$line['id_article'];
	$sec=$line['section_id'];
	$page=trim($line['article_pages']);
	if ($sec != $s1)
		{
		echo '<TR><TD>&nbsp;</TD></TR>';
		echo '<TR valign="top">';
			{
			echo '<TD colspan="2">&nbsp;';
			}
			echo '<table cellspacing="0" cellpadding="0" width="100%" border="0">';
			echo '<tr><td nowrap><a name="#"></a>';
			echo '<span class="lt3"><B><FONT COLOR="'.$bgcor.'">';
			echo $line['title'];
			echo '&nbsp;&nbsp;</td><td width="99%"><hr /></td></tr></table>';
			echo '</TD></TR>';
			$s1 = $sec;
			$nr = 1;
		}
	$art++;
		
		echo '<TR valign="top" '.coluna().'><TD width="5%">';
		$www = $line['abbrev'];
		$www .= strzero($line['article_seq'],2);

		if (strpos($www,';') > 0)
			{
				echo "xxxx";
			}
			else { echo $www; }

		$pag = $line['article_pages'] + $pgini;
		$pag = '';
		$xlink = '<A HREF="?dd1='.$line['id_article'].'&dd99=view"><font class=lt1>';
		echo '<TD width="95%">'.$xlink.'<font class="lt2">'.$line['article_title'].'</a></font>';
		$s2 = $ida;
		$nr++;
		$xat=0;
		
		///// autor
		$autor = trim($line['article_author']).chr(13);
		$autor = mst_autor($autor,1);
		if (strlen(trim($autor)) > 1)
			{
			echo '<BR><I>'.$autor;
			echo '<BR>&nbsp;';
			}
		///////////// Numero do Periódico
		echo '</TR>';
		
		///// lastlinha - pagina - tipo documento
		if (strlen($no_pdf) == 0)
		{
		echo '<TR valign="top">';
		echo '<TD>&nbsp;</TD>';
		echo '<TD class="lt0" colspan="1">';
		echo '<A HREF="javascript:newxy('.chr(39).http.'index.php/'.$path.'?dd1='.$ida.'&dd99=pdf'.chr(39).',180,20);" title="Format PDF'.chr(13).'click aqui e veja o artigo'.chr(13).'na integra">[pdf]</A>';
		echo '</TD>';
		/////// pagina
		if (strlen(trim($page)) > 0)
			{
			echo '<TD class="lt2" align="right" colspan="1"><I>';
			echo '<NOBR><FONT class="lt0">p.'.$page.'</TD>';
			}
			
		}
		

		}
	echo "</TABLE>";
	}
?>



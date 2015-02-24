<?
require('include/sisdoc_windows.php');
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
		$sql = $sql . 'and articles.journal_id = '.$jid.' ';
		$sql = $sql . ' order by article_issue,sections.seq, article_seq';
		$result = db_query($sql);
		$ttt="#FFFFFF";
		//$ttt="#20c0ff";
		if (strlen($is_max) == 0) { $is_max = '100%'; }		
			?>
			<TABLE width="<?=$is_max?>" cellpadding="0" cellspacing="2" border="0" class=lt0 >
			<TR>
			<TD width="60">&nbsp;</TD>
			<TD width="<?=$is_max-80?>">&nbsp;</TD>
			<TD width="20">&nbsp;</TD>
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
	$tat++;
	$ida=$line['id_article'];
	$sec=$line['section_id'];
	$page=trim($line['article_pages']);
	if ($sec != $s1)
		{
		echo '<TR><TD>&nbsp;</TD></TR>';
		echo '<TR valign="top">';
			{
			echo '<TD colspan="6">';
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
		
		echo '<TR valign="top"><TD>';
		$www = $line['article_keywords'];
		if (strpos($www,';') > 0)
			{
				echo "xxxx";
			}
			else { echo $www; }
		$pag = $line['article_pages'] + $pgini;
		$pag = '';
		$xlink = '<A HREF="?dd1='.$line['id_article'].'&dd99=view"><font class=lt1>';
		echo '<TD>'.$xlink.$line['article_title'].'</a></font>';
		echo '<TD valign="bottom" align="right">'.$pag.'';
//		if (strlen($tit_alt) > 0)
//			{
//			echo '<BR><img src="'.$img_dir.'nada.gif" width="12" height="12" alt="" border="0">';
//			echo $xlink.'<BR><I><font class="lt2">'.$tit_alt.'</B></a></I>';
//			echo '<BR><img src="'.$img_dir.'nada.gif" width="12" height="12" alt="" border="0">';
//			}
//		echo '</TD>';
		echo '</TR>';
		$s2 = $ida;
		$nr++;
		$xat=0;
		
		///// autor
		$autor = trim($line['article_author']).chr(13);
		$autor = mst_autor($autor,1);
		if (strlen(trim($autor)) > 1)
			{
//			echo '<TR valign="top">';
//			echo '<TD width=10 colspan="1">&nbsp;</TD>';
			if ($art > 1)
				{
//				echo '<TD width=10 >&nbsp;</TD>';
//				echo '<TD class="lt1" colspan="4"><I>';
				}
				else
				{
//				echo '<TD class="lt1" colspan="3"><I>';
				}
//			echo $autor,'</TD>';
			}
		///////////// Numero do Periódico
		
		/////////////////////////////////
		if ($mostra_issue == True)
			{
			$llk='<A HREF="'.$path.'?dd1='.$line['id_issue'].'">';
			?>
			<TR class="lt0"><TD>&nbsp;</TD><TD colspan="5"><?=$llk.$line['issue_title'].' '.$line['issue_year'];?>
			<? if (strlen(trim($line['issue_volume'])) > 0) { echo "&nbsp;v.".$line['issue_volume']; }?>
			<? if (strlen(trim($line['issue_number'])) > 0) { echo "&nbsp;n.".$line['issue_number']; }?>
			<?
			}

		///// lastlinha - pagina - tipo documento
		if (strlen($no_pdf) == 0)
		{
		echo '<TR valign="top">';
		echo '<TD width=10>&nbsp;</TD>';
		echo '<TD class="lt0" colspan="2">';
		echo '<A HREF="javascript:newxy('.chr(39).http.'index.php/'.$path.'?dd1='.$ida.'&dd99=pdf'.chr(39).',180,20);" title="Format PDF'.chr(13).'click aqui e veja o artigo'.chr(13).'na integra">[pdf]</A>';
		echo '</TD>';
		/////// pagina
		if (strlen(trim($page)) > 0)
			{
			echo '<TD class="lt2" align="right" colspan="2"><I>';
			echo '<NOBR><FONT class="lt0">p.'.$page.'</TD>';
			}
			
		}
		

		}
	echo "</TABLE>";
	}
?>



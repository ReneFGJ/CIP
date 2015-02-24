<?
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
			echo '<TD colspan="3">';
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
		
		echo '<TR valign="top">';
		echo '<TD><B>';
		echo $line['abbrev'];
		echo $line['article_seq'];
		echo '</B>';
		$pag = '';
		$xlink = '<A HREF="?dd1='.$line['id_article'].'&dd99=view"><font class=lt1>';
		echo '<TD colspan="2" class="lt4">'.$xlink.'<font class="lt3">'.$line['article_title'].'</a></font>';
		echo '</TR>';

		echo '<TR><TD></TD><TD colspan="2">';
		$www = $line['article_keywords'];
		$autor = $line['article_author'];
//		if (strpos($www,';') > 0)
//			{
//				echo "xxxx";
//			}
//			else { echo $www; }

		$autor = trim($line['article_author']).chr(13);
		$autor = mst_autor($autor,1);
		if (strlen(trim($autor)) > 1)
			{
			echo '<TR valign="top">';
			echo '<TD width=10 colspan="1">&nbsp;</TD>';
			echo '<TD class="lt2">'.$autor,'</TD>';
			}
		///////////// Numero do Periódico
		
		/////////////////////////////////
		if ($mostra_issue == True)
			{
			$llk='<A HREF="'.$path.'?dd1='.$line['id_issue'].'">';
			?>
			<TR class="lt0"><TD>&nbsp;</TD><TD colspan="2"><?=$llk.$line['issue_title'].' '.$line['issue_year'];?>
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
?>



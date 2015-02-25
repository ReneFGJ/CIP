<?

function issue($id,$tp)
	{
		global $issue,$jid,$capa,$is_max;
		// 1 = Pelo artigo
		// 2 - Ultima da publicação
		// 3 - Pela Edição
		if ($tp==1)
			{
				$sql = 'select * from articles ';
				$sql = $sql . 'inner join issue on article_issue = id_issue ';
				$sql = $sql . 'inner join sections on article_section = section_id ';
				$sql = $sql . 'where id_article  = '.$id. ' and articles.journal_id = '.$jid;	
			}
		if ($tp==2)
			{
				$sql = 'SELECT * FROM issue ';
				$sql = $sql . ' where issue_published=1 and journal_id = '.$jid.' order by issue_year desc, issue_volume desc, issue_number desc limit 1';
			}
				
		if ($tp==3)
				{
					$sql = 'SELECT * FROM issue ';
					$sql = $sql . ' where issue_published=1 and id_issue='.$id.' and journal_id = '.$jid.' order by issue_year desc, issue_volume desc, issue_number desc limit 1';
				}
	$result = db_query($sql);
	if ($line = db_read($result))
		{
		$m1_ = $line['issue_month_1'];
		$m2_ = $line['issue_month_2'];
		$vm1_ = "";
		$vm2_ = "";
		$vm1_ = substr(nomemes($m1_),0,3).'.';
		if ($m1_ != $m2_)
			{
			$vm2_ = '/'.substr(nomemes($m2_),0,3).'.';
			}
		$ss = "";
		if (strlen($is_max) == 0) { $is_max = '700'; }
		$ss = $ss . '<TABLE bordercolor="'.$bgcor.'" border=1 width="'.$is_max.'" class="lt3" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">';
		$ss = $ss . '<TR><TD>'.$line['issue_title'].' '.$nn.' v.'.$line['issue_volume'].'&nbsp;n.'.$line['issue_number'].'&nbsp;'.$vm1_.$vm2_.' '.$line['issue_year'].'&nbsp;';
		$ss = $ss . '</TD></TR>';
		$ss = $ss . '</TABLE>';
		$issue = $line['id_issue'];
		$capa = trim($line['issue_capa']);
		}
	else
		{
			$ss = '<table width="'.$is_max.'" bgcolor="'.$bgcor.'" border="0" cellpadding="0" cellspacing="4" align="center">';
			$ss = $ss .'<TR><TD align="center" class="lt2">NAO PUBLICADO - NOT PUBLISHED - NO PUBLICADO</TD></TR>';
			$ss = $ss .'</table>';
		}	
	return($ss);
	}
?>

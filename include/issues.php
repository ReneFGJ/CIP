<?
function issue($id,$tp)
	{
		global $issue,$jid,$capa,$is_max,$vm1_,$vm2_;
		global $issu_volume,$issu_number,$issu_titel,$issu_year;
		// 1 = Pelo artigo
		// 2 - Ultima da publicação
		// 3 - Pela Edição
		if ($tp==1)
			{
				$sql = 'select * from articles ';
				$sql = $sql . 'inner join issue on article_issue = id_issue ';
				$sql = $sql . 'inner join sections on article_section = section_id ';
				$sql = $sql . 'where id_article  = '.sonumero('0'.$id). ' and articles.journal_id = '.sonumero('0'.$jid);	
			}
		if ($tp==2)
			{
				$sql = 'SELECT * FROM issue ';
				$sql = $sql . ' where issue_published=1 and journal_id = '.sonumero('0'.$jid).' order by issue_year desc, issue_volume desc, issue_number desc limit 1';
			}
				
		if ($tp==3)
				{
					$sql = 'SELECT * FROM issue ';
					$sql = $sql . ' where issue_published=1 and id_issue='.sonumero('0'.$id).' and journal_id = '.sonumero('0'.$jid).' order by issue_year desc, issue_volume desc, issue_number desc limit 1';
				}
	$result = db_query($sql);
	if ($line = db_read($result))
		{
		$m1_ = $line['issue_month_1'];
		$m2_ = $line['issue_month_2'];
		$vv  = $line['issue_volume'];
		$issu_number = trim($line['issue_number']);
		$issu_volume = trim($line['issue_volume']);
		$issu_year   = trim($line['issue_year']);
		$issu_title = trim($line['issue_title']);
		$vm1_ = "";
		$vm2_ = "";
		$vm1_ = nomemes_short($m1_);
//		if ($vm1_ == 'mai.') { $vm1_ = "maio"; }
		if ($m1_ != $m2_)
			{
			$vm2_ = '/'.nomemes_short($m2_);
			}
		$ss = "";
		if (strlen($is_max) == 0) { $is_max = '700'; }
		$ss = $ss . '<TABLE bordercolor="'.$bgcor.'" border=1 width="'.$is_max.'" class="lt3" cellpadding="3" cellspacing="0" align="center">';
		$ss = $ss . '<TR><TD>'.$issu_title.' ';
		if (strlen($issu_volume) > 0) { $ss = $ss .$nn.' v. '.$issu_volume.'&nbsp;'; }
		if (strlen($issu_number) > 0) { $ss = $ss .'n. '.$issu_number.'&nbsp;'; }
		$ss = $ss .$vm1_.$vm2_;
		if (strlen($issu_year) > 0) { $ss = $ss . ' '.$issu_year.'&nbsp;'; }
		$ss = $ss . '</TD></TR>';
		$ss = $ss . '</TABLE>';
		$issue = $line['id_issue'];
		$capa = trim($line['issue_capa']);
		}
	else
		{
			$ss = '<table width="'.$is_max.'" bgcolor="'.$bgcor.'" border="0" cellpadding="0" cellspacing="4">';
			$ss = $ss .'<TR><TD align="center" class="lt2"><CENTER>NÃO PUBLICADO - NOT PUBLISHED - NO PUBLICADO</TD></TR>';
			$ss = $ss .'</table>';
		}	
	return($ss);
	}
?>

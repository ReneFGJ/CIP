<?
Function mst_sumario($xx1,$xx2)
	{
	Global $jid;
	$sql = "select * from news where journal_id = ".$jid;
	$sql = $sql . ' and news_secao = '.$xx1;
	$sql = $sql . ' order by news_inserir desc ';
	$rlt = db_query($sql);
	$ss = '';
	$ini = 1;
	while ($line = db_read($rlt))
		{
		if ($ini == 1) { $ss = $ss . '<CENTER><B><FONT class=lt3>'.$xx2.'</FONT></B></CENTER><P>'; }
		$ss = $ss . '<A HREF="#'.$line['news_id'].'"><FONT class="lt2">'.$ini.'&nbsp;'.trim($line['news_titulo']).'</A><BR>';
		$ini = $ini + 1;
		}	
	if ($ini > 1) { $ss = $ss . '<P><HR><P>'; }
	return $ss;	
	}
Function mst_news($xx1,$xx2)
	{
	Global $jid;
	$sql = "select * from news where journal_id = ".$jid;
	$sql = $sql . ' and news_secao = '.$xx1;
	
	
	$sql = $sql . ' order by news_inserir desc ';

	$rlt = db_query($sql);
	$ss = '';
	while ($line = db_read($rlt))
		{
		$vimg = trim($line['news_image']);
		$vurl = trim($line['news_link']);
////////////////////////// LINK
		if (strlen($vurl) > 0)
		{
		$ss = $ss . '<A href="'.$vurl.'" target="new">';
		}
////////////////////////// IMAGEM
		if (strlen($vimg) > 0)
			{ 
			if ($xx2 == '2') {$ss = $ss . '<img src="'.$vimg.'" width="100" alt="" border="0"><BR>'; }
			}
		$ss = $ss . '<H id="'.$line['news_id'].'"><FONT class=lt2><b>'.$line['news_titulo']. '</b></FONT></A>';
		$ss = $ss . '<div align="justify">';
		$ss = $ss . troca($line['news_descricao'],chr(13),'<BR>');
		$ss = $ss . '</div>';
		$ss = $ss . '<BR><HR width="50%"><BR>';
		}
	return $ss;
	}
?>
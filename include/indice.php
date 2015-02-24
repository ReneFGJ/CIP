<?
$max = 38;
$idi = "pt_BR";
if (strlen($tit)==0) { $tit = "Índice"; }
if (($idioma == '2') and (strlen($tit)==0))	{ $idi = 'en'; $tit = "Index";}
if (($idioma == '3') and (strlen($tit)==0))	{ $idi = 'es'; $tit = "Índice"; $idi = 'en';}
if (($idioma == '4') and (strlen($tit)==0))	{ $idi = 'fr'; $tit = "Index"; $idi = 'en';}

$mostra_issue = True;
if (strlen($is_max) ==0) {$is_max = "704"; }
	
$stabela = '<TABLE width="'.$is_max.'" class="lt0" border="0" align="center">';
$stabela =$stabela . '<TR><TD colspan="8">';
$stabela =$stabela . '<CENTER><font class="lt5">'.$tit.'</font></CENTER>';
$stabela =$stabela . '</TD></TR>';
$stabela =$stabela . '<TR>';
$stabela .= '<TD rowspan="10" width="3"></TD>';
$stabela .= '<TD width="30%"></TD>';
$stabela .= '<TD rowspan="10" width="20"></TD>';
$stabela .= '<TD width="30%"></TD>';
$stabela .= '<TD rowspan="10" width="10"></TD>';
$stabela .= '<TD width="30%"></TD></TR>';
$stabela =$stabela . '<TR valign="top">';

$ftabela =$ftabela . "</TABLE>";
echo $stabela;

		$sql =  "select ix_word,index.ix_asc from (";
		$sql = $sql . "select ix_asc from index inner join articles on ix_article = id_article ";
		$sql = $sql . " where ix_idioma = '".$idi."' ";
		$sql = $sql . " and articles.journal_id = ".$jid;
		$sql = $sql . " group by ix_asc ";
		$sql = $sql . ") as tabela ";
		$sql = $sql . "inner join index on tabela.ix_asc = index.ix_asc order by index.ix_asc ";

		$rrr = db_query($sql);
		$s1="";
		$s2="";
		$s3="";
		$ti=0;
		$termo = "x";
		$fl = "X";
		$ln = 0;
		$ii=1;
		while ($line = db_read($rrr))
			{
			$xtermo = trim($line['ix_asc']);
			if ($termo != $xtermo)
				{
				if ($lin > $col) { $ii++; $lin = 0; }
				$termo = $xtermo;
				$link = '<A HREF="'.$path.'?dd98=3&dd99=index&dd1='.trim($line['ix_asc']).'"><font class="lt1">';
				$link = '<A HREF="'.$path.'?dd98=3&dd99=search&acao=autobusca&dd1='.trim($line['ix_asc']).'"><font class="lt1">';
		
				if ($fl != substr($termo,0,1))
					{
					$fl = substr($termo,0,1);
					$fl2 = '';
					if ($fl != 'A')
						{ $fl2 = '<BR>'; $ln++; }
					if ($ii == 1) { $s1 = $s1 . "<TR><TD><B><FONT CLASS=lt2 >".$fl2.$fl."</TD></TR>".chr(13).chr(10); $ln++; }
					if ($ii == 2) { $s2 = $s2 . "<TR><TD><B><FONT CLASS=lt2 >".$fl2.$fl."</TD></TR>".chr(13).chr(10); $ln++; }
					if ($ii == 3) { $s3 = $s3 . "<TR><TD><B><FONT CLASS=lt2 >".$fl2.$fl."</TD></TR>".chr(13).chr(10); $ln++; }
					}
					$xt = trim($line['ix_word']);
					$xt = strtoupper(substr($xt,0,1)).substr($xt,1,100);
					$xt = '<img src="'.$img_dir.'ul_sq.gif" alt="" border="0" align="absmiddle">'.$xt.'';
//					$xt = '<li class="ul.indice">'.$xt.'</li>';
					if ($ii == 1) {	$s1 = $s1 . "<TR><TD>".$link.$xt."</TD></TR>".chr(13).chr(10); $ln++; }
					if ($ii == 2) {	$s2 = $s2 . "<TR><TD>".$link.$xt."</TD></TR>".chr(13).chr(10); $ln++; }
					if ($ii == 3) {	$s3 = $s3 . "<TR><TD>".$link.$xt."</TD></TR>".chr(13).chr(10); $ln++; }
				}
				if ($ln > $max)
					{
					if ($ii==3)
						{
						echo '<TD><TABLE width="100%" class="lt2">'.$s1.'</TD></TABLE>';
						echo '<TD><TABLE width="100%" class="lt2">'.$s2.'</TD></TABLE>';
						echo '<TD><TABLE width="100%" class="lt2">'.$s3.'</TD></TABLE>';
						echo $ftabela;
						echo $stabela;
						$ii=0;
						$ln=0;
						$s1="";
						$s2="";
						$s3="";
						$ii=1;
						}
						else
						{
						$ii++;
						$ln=0;
						}
					}
			}
		echo '<TD><TABLE width="100%" class="lt2">'.$s1.'</TABLE>';
		echo '<TD><TABLE width="100%" class="lt2">'.$s2.'</TABLE>';
		echo '<TD><TABLE width="100%" class="lt2">'.$s3.'</TABLE>';
		echo $ftabela;		
		echo "<P>".chr(13).chr(10);
if (strlen($indice_autor) == 0)
	{	
	require("indice_autores.php");
	}
?>
<?
$max = 40;
$idi = "pt_BR";
$tit = "Índice onomástico";
if ($idioma == '2')	{ $idi = 'en'; $tit = "Author Index";}
if ($idioma == '3')	{ $idi = 'es'; $tit = "Índice de autores"; $idi = 'en';}
if ($idioma == '4')	{ $idi = 'fr'; $tit = "Index"; $idi = 'en';}

$mostra_issue = True;
if (strlen($is_max) ==0){$is_max = "704"; }

$stabela = '<TABLE width="'.$is_max.'" class="lt0" border="0" align="center">';
$stabela =$stabela . '<TR><TD colspan="5">';
$stabela =$stabela . '<CENTER><font class="lt5">'.$tit.'</font></CENTER>';
$stabela =$stabela . '</TD></TR>';
$stabela =$stabela . '<TR><TD width="50%"></TD><TD width="50%"></TD></TR>';
$stabela =$stabela . '<TR valign="top">';

$ftabela = "</TABLE>";
echo $stabela;

	$sql =  "select ia_word,ia_asc,ia_mst from autores ";
	$sql = $sql . " where journal_id = ".$jid;
	$sql = $sql . " order by ia_asc ";

//		echo $sql;
//		exit;
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
		$xtermo = trim($line['ia_asc']);
		if ($termo != $xtermo)
			{
			$termo = $xtermo;
			$link = '<A HREF="'.$path.'?dd99=search&acao=autobusca&dd1='.trim($line['ia_word']).'"><font class="lt1">';
			if ($fl != substr($termo,0,1))
				{
				$fl = substr($termo,0,1);
				if ($ii == 1) { $s1 = $s1 . "<TR><TD><B><FONT CLASS=lt2 >".$fl."</TD></TR>".chr(13).chr(10); $ln++; }
				if ($ii == 2) { $s2 = $s2 . "<TR><TD><B><FONT CLASS=lt2 >".$fl."</TD></TR>".chr(13).chr(10); $ln++; }
				}
				if ($ii == 1) {	$s1 = $s1 . "<TR><TD>".$link.trim($line['ia_mst'])."</TD></TR>".chr(13).chr(10); $ln++;}
				if ($ii == 2) {	$s2 = $s2 . "<TR><TD>".$link.trim($line['ia_mst'])."</TD></TR>".chr(13).chr(10); $ln++;}
			}
			if ($ln > $max)
				{
				if ($ii == 1) 
					{$ii = 2; }
				else
					{
					echo '<TD><TABLE width="100%" class="lt2">'.$s1.'</TABLE></TD>';
					echo '<TD><TABLE width="100%" class="lt2">'.$s2.'</TABLE></TD>';
					echo $ftabela;
					$s1 = "";
					$s2 = "";
					$ii = 1;
					echo $stabela;
					}
					$ln = 0;
				}
		}
echo '<TD><TABLE width="100%" class="lt2">'.$s1.'</TABLE>';
echo '<TD><TABLE width="100%" class="lt2">'.$s2.'</TABLE>';
echo $ftabela;
?>
<table width="95%" align="center" border="0">
<tbody><tr>
<TD>
<BR><BR>
<?
$jid = 20;
$idv = "pt_BR";
if ($idioma =='2') {$idv='en';}
if ($idioma =='3') {$idv='es';}
if ($idioma =='4') {$idv='fr';}
$cod = $dd[99];
if (strlen($cod) == 0) { $cod = 'about'; }

$sql = "select * from frases where fr_word='".$cod."' and journal_id=".$jid." and fr_idioma='".$idv."'";
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	echo '<div id="texto" class="lt2" style="text-align:justify; line-height: 160%;">'; 
	echo ($line['fr_texto']);
	echo '</div>';
	}
	
if ($cod == 'faq')
	{
	require("index_faq.php");
	}
?>
</TD>
</TABLE>
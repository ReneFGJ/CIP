<? $index = 1; ?>
<? 
require('db.php');
require('cab_instituicao.php');
?>
<link rel="stylesheet" href="letras.css" type="text/css" />
<TITLE>Catalogo de Periodicos .: PUC-PR :.</TITLE>
<CENTER>
<font class="lt2"><P><HR size="1" width="704">
<?=CharE('Selecione uma das publica��es');?>
<HR size="1" width="704">
<P>
<?
    /* Performing SQL query */
    $query = "SELECT * FROM journals order by title";
    $result = db_query($query);
   /* Printing results in HTML */
  
 	echo '<table class=lt2 width="710" border=0>';	
    while ($line = db_read($result)) {
        print "\t<tr>\n<TD>";
		echo "<A HREF=\"index.php/".$line["path"]."\">";
		echo '<font class="lt1">';
		if ($jid == $line["journal_id"]) { echo "<FONT COLOR=\"BLUE\">"; }
		echo '['.$line["journal_id"].'] ';
		echo $line["title"];
		echo "</A>";
    }
?>


<? $index = 1; ?>
<? 
require('db.php');
require('cab_institucional.php');

?>
<link rel="stylesheet" href="letras.css" type="text/css" />
<TITLE>Catalogo de Periodicos .: PUC-PR :.</TITLE>
<CENTER>
<font class="lt2"><P><HR size="1" width="704">
<B><?=CharE('Publicações Científicas');?></B>
<BR>
<?=CharE('Selecione uma das publicações de nossa editora');?>
<HR size="1" width="704">
<TABLE width="704" align="center">
<TR>
<TD>&nbsp;</TD>
<TD width="250"><img src="img/logo_editora.jpg" width="250" height="76" alt="" border="0"></TD>
</TR>
</TABLE>
<P>
<?
    /* Performing SQL query */
    $query = "SELECT * FROM journals order by title";
	
	$sql = "select title,path,description,issue.journal_id,issue_volume, issue_number, issue_title, issue_year, issue_month_1, issue_month_2 , issue_capa from issue ";
	$sql = $sql . " left join journals on journals.journal_id = issue.journal_id ";
	$sql = $sql . " where issue_published='1' and enabled=1 ";
	$sql = $sql . " order by title, issue_year desc, issue_volume desc ,issue_number desc ";
	
    $result = db_query($sql);
	
   /* Printing results in HTML */
  	$row=0;
	$col=0;
 	print "<table class=lt2 width=\"710\" border=0>\n";	
	$xid = 0;
    while ($line = db_read($result)) 
		{
		if ($xid == $line['journal_id'])
			{
			}
			else
			{
			$xid = $line['journal_id'];
			if (($col==0) or ($col > 3))
				{
				echo '<TR valign="top">';
				$col = 0;
				}
			$capa = $line['issue_capa'];
			echo '<TD align="center" width="25%">';
			echo '<A HREF="index.php/'.$line["path"].'">';
			echo '<img src="public/'.$line["journal_id"].'/capas/'.$capa.'" height="135"  border="0">';
			echo '<font class="lt1"><BR>';
			echo '<B>'.$line["title"].'</B>';
			echo '</A><BR><font class="lt0">';
			echo $line['description'];
	        print "</TD>";
			$col = $col + 1;
		}
    }
	print("</TABLE>");
?>
<CENTER>
<HR width="250" size="1">
<font face="Verdana,Geneva,Arial,Helvetica,sans-serif" size="-1">
&copy <?=date("Y")?>
</font>


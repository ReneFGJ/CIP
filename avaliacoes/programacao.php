<?
require("cab.php");

$ref = "PROGRAMACAO";

$sql = "select * from ic_noticia ";
$sql .= " where nw_journal = ".$jid;
$sql .= " and nw_ref = '".$ref."' ";

$rlt = db_query($sql);

$nref = "";
while ($line = db_read($rlt))
	{
	$nref .= $line['nw_descricao'];
	$nref .= '<BR>';
	}
if (strlen($nref) == 0) { $nref = $ref; }

?>
<table width="<?=$tab_max;?>">
<TR><TD>
<?
echo $nref;
?>
</TD></TR></table>
<?

require("foot.php");	?>
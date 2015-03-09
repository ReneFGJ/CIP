<?
require("cab.php");

$tabela = "pibic_ged_documento";

$sx = '<table width="100%" class="tabela00">';

$sql = "select * from pibic_ged_documento" . $this -> tabela."limit 50";

$rlt = db_query($sql);

$sx = '<table width="100%">';
	while ($line = db_read($rlt)) {	
		$sx .= '<TR>';
		$sx .= '<TD class="tabela01" width="10%">' . $line;
	
	   	}
	$sx .= '</table>';

	return ($sx);

require("foot.php");	?>

<?php
$nosec = 1;
require("cab.php");
require($include.'sisdoc_data.php');
require('../_class/_class_fomento.php');
$fom = new fomento;


echo '<div id="content">';
	echo '<H1>'.mst(msg('pg_calls_csf')).'</H1>';
	echo mst(msg('pg_calls_csf_inf'));
	echo '<BR><BR>';
	echo $fom->edital_open();
	
echo '</div>';

require("foot.php");
?>
<script>
	$("#content").corner();
</script>

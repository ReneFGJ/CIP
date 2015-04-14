<?php
$nosec = 1;
require("cab.php");
echo '<div id="content">';
	echo '<H1>'.mst(msg('pg_apresentacao_csf')).'</H1>';
	echo mst(msg('pg_apresentacao_csf_inf'));
echo '</div>';

require("foot.php");
?>
<script>
	$("#content").corner();
</script>

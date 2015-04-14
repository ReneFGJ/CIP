<?php
require("cab.php");
$mess = new message;
$edit_mode = 0;

echo '<META HTTP-EQUIV=Refresh CONTENT="4; URL=admin.php">';
echo '<div id="content">';

		$rs = $mess->edit_mode(0);
		echo 'Desabilitado';

echo '</div>';
echo '</div>';

require("foot.php");
?>
<script>
	$("#content").corner();
</script>

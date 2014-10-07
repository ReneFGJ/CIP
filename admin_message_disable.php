<?php
require("db.php");


require("_class/_class_message.php");
$file = 'messages/msg_pt_BR.php';
require($file);
$mess = new message;

$edit_mode = 0;

echo '<div id="content">';

		$rs = $mess->edit_mode(0);
		echo 'Desabilitado';

echo '</div>';

echo '<A HREF="admin_message_enable.php">Habilitar</A>';

require("foot.php");
?>
<script>
	$("#content").corner();
</script>

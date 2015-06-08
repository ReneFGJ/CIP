<?php
require("cab.php");
require("../_class/_class_body.php");

echo $clx->resume();
echo '<BR><BR>';
echo '<center>';
echo '<form method="get" action="submit_new.php">';
echo '<input type="submit" value="'.msg('subm_new_project').'" style="width: 500px; height: 50px;">';
echo '</form>';

require("foot.php");
?>

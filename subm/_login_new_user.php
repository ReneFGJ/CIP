<?php
require("cab.php");
require($include.'sisdoc_windows.php');
echo '<h2>'.msg('sign_up').'</h2>';

echo '<form>';
echo $clx->new_autor();
echo '</form>';

require("foot.php");
?>

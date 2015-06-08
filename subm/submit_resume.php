<?php
require("cab.php");
require($include.'sisdoc_data.php');
require("../_class/_class_body.php");

echo $clx->resume_list($dd[1]);

require("foot.php");
?>

<?php
require("cab.php");

$sql = "
UPDATE articles set article_publicado = 'S' where article_publicado = '1'
";
$rlt = db_query($sql);
?>
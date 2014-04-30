<?php
require("cab.php");
require("../_class/_class_semic.php");
require("../_class/_class_article.php");
require($include.'sisdoc_data.php');
$semic = new semic;
$at = new article;
$jid = $semic->recupera_jid_do_semic();

$sx = '<div class="multicoluna" style="width: 780px;">';
$sx .= $at->save_index($jid);
$sx .= '</div>

<style>
.multicoluna{
   -moz-column-count: 3;
   -moz-column-gap: 2em;
   -moz-column-rule: 1px solid #ccf;
   -webkit-column-count: 5;
   -webkit-column-gap: 2em;
   -webkit-column-rule: 1px solid #ccf;
} 
</style>
';

echo $sx;
?>


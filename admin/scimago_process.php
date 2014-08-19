<?php
require("cab.php");
require("../_class/_class_scimago.php");
$sci = new scimago;

print_r($sci);

$file = 'scimago/2012/Accounting.xls';
$file = 'scimago/2012/Water Science and Technology.xls';
echo $file;
echo '<HR>';

require("../_class/_class_qualis.php");

require("../_class/_class_cited.php");
$jl = new cited;
$jl->updatex_journal();

$sci->process($file);
?>

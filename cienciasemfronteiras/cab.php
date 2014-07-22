<?
$include = '../';
require("../db.php");
require("_class/_class_header_csf.php");

$hd = new header;
echo $hd->cab();
$hd->security();
require($include.'_class_form.php');
$form = new form;

?>

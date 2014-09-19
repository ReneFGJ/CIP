<?php
require("cab_semic.php");
require($include.'_class_form.php');
$form = new form;
/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'admin/index.php',msg('principal')));
array_push($breadcrumbs,array(http.'admin/index.php',msg('menu')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

$blck = ' : ';
$blck .= '&001:10h30 as 12h30';
$blck .= '&002:13h30 as 15h15';
$blck .= '&003:15h30 as 18h00';
$blck .= '&004:18h30 as 20h30';
$blck .= '&000:09h00 as 10h30';
$blck .= '&005:09h30 as 12h00';
$blck .= '&006:08h00 as 09h15';

		require("../_class/_class_semic_programacao.php");
		$progm = new semic_programacao;

echo $progm->schedule_show('000',20131022);
echo $progm->schedule_show('001',20131022);
echo $progm->schedule_show('002',20131022);
echo $progm->schedule_show('003',20131022);
echo $progm->schedule_show('004',20131022);

echo '<HR>';

echo $progm->schedule_show('006',20131023);
echo $progm->schedule_show('005',20131023);
echo $progm->schedule_show('002',20131023);
echo $progm->schedule_show('003',20131023);
echo $progm->schedule_show('004',20131023);

echo '<HR>';

echo $progm->schedule_show('006',20131024);
echo $progm->schedule_show('005',20131024);

?>
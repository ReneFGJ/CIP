<?php
require("cab_semic.php");

require("../_class/_class_semic.php");
$sm = new semic;

echo '<A HREF="'.page().'?dd1=PIBIC">PIBIC</A> ';
echo '&nbsp;';
echo '<A HREF="'.page().'?dd1=PIBITI">PIBITI</A> ';
echo '&nbsp;';
echo '<A HREF="'.page().'?dd1=PIBICE">PIBIC_EM</A> ';
echo '&nbsp;';
echo $sm->mostra_projetos_area(date("Y"));

echo $hd->foot();
?>

<?php
require('cab.php');
require($include.'sisdoc_data.php');
require('../_class/_class_csf.php');
$csf = new csf;

echo '<div id="content">';
if ($LANG=="en_US")
{
	echo '<table width="100%"><TR><TD>';
	echo '<UL>';
	echo '<LI><A HREF="#Depoimentos">Student´s testimonials</A></LI>';
	echo '<LI><A HREF="#Dicas">Trip tips to other students</A></LI>';
	echo '</UL>';
	echo '</table>';
} else {
	echo '<table width="100%"><TR><TD>';
	echo '<UL>';
	echo '<LI><A HREF="#Depoimentos">Depoimentos dos estudantes</A></LI>';
	echo '<LI><A HREF="#Dicas">Dicas de viagem para outros estudantes</A></LI>';
	echo '</UL>';
	echo '</table>';
}

echo '<A name="Depoimentos"></A>';
require('depoimentos.php');
echo '<A name="Dicas"></A>';
require('dicas.php');
echo '</div>';
require("foot.php"); ?>

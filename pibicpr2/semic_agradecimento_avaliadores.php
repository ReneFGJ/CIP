<?php
require("cab.php");
require("../_class/_class_semic.php");
require($include.'sisdoc_autor.php');

$sm = new semic;
			$evento = 'SEMIC20';
			$mostra = 'MP14';

echo $sm->email_avaliadores(1);
?>
<?php
$include = '../';
require("../db.php");
require($include.'sisdoc_pdf.php');
require($include.'sisdoc_data.php');

require("../_class/_class_docentes.php");
require("../_class/_class_discentes.php");
require("../_class/_class_programa_pos.php");

require("../_class/_class_bonificacao.php");
$bon = new bonificacao;
$bon->le($dd[0]);
$bon->termo_isencao_pdf();



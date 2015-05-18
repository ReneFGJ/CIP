<?php

ob_start();
session_start();

require("cab_survey.php");
require($include."sisdoc_debug.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require("_class/_class_survey_part_001.php");
$sv = new survey;
require("../_class/_class_ic.php");
//$sv->busca_alunos_questionario_csf('S004','88958022');
//$sv->resumo();
//exit;

echo '<A HREF="'.page().'?dd0=1">Listas problemas</A>';
echo $sv->lista($dd[0]);

require("foot_survey.php");
?>


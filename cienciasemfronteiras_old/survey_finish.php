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

$_SESSION['dd0'] = $dd[0];
$_SESSION['pag'] = '';

?>
<h1>Obrigado!</h1>
<?
require("foot_survey.php");
?>


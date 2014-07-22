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


$sv->le($dd[0]);
echo '<h1>'.$sv->nome.'</h1>';
echo 'CURSO: <B>'.$sv->line['pa_curso'].'</B>';
echo '<BR>e-mail: <B>'.$sv->line['pa_email'].'</B>';
echo '<BR>e-mail: <B>'.$sv->line['pa_email_1'].'</B>';
echo '<HR>';
echo $sv->mostra();

require("foot_survey.php");
?>


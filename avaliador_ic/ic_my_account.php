<?php
require("cab_aic.php");

echo '<BR><BR><BR>';
require("../_class/_class_docentes.php");
$doc = new docentes;

$cracha = $_SESSION['userp_cod'];

$doc->le($cracha);

ini_set('display_errors', 1	);
ini_set('error_reporting', 7);

echo $doc->mostra_dados_pessoais();

require("ic_my_account_area.php");
?>

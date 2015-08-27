<?php
$include = '../../';
require("../../db.php");
$staff = $_SESSION['staff'];
require($include.'sisdoc_debug.php');
?>
<head>
<title>Avaliação de Trabalhos - SEMIC</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta name="description" content=""><meta name="viewport" content="width=device-width" />
<link rel="stylesheet" href="css/style_admin.css">
<script language="JavaScript" type="text/javascript" src="../avaliacao/js/jquery-1.7.1.js"></script>
<script language="JavaScript" type="text/javascript" src="../avaliacao/js/jquery.corner.js"></script>
</head>
<body>

<div id="screen">
<?	

	for ($r=0;$r < 15;$r++)
	{
		echo '<A HREF="premiacao.php?dd0='.$r.'">'.($r+1)."</A> ";
	}
	$pag = round($dd[0]);
	switch($pag)
		{
		case 0: require("premiacao_00.php"); break;
		
		/* PIBIC Jr */
		case 1: $evento = 'XXI SEMIC'; $evento_nome = 'PIBIC_EM (Jr)'; require("premiacao_01.php"); break;
		case 2: $idr=0; $modalidade = 'PIBIC_EM'; require("premiacao_10.php"); break;
		case 3: $idr=1; $modalidade = 'PIBIC_EM'; require("premiacao_10.php"); break;
		
		
		case 4: $evento = 'XXI SEMIC'; $evento_nome = 'PIBIC'; require("premiacao_01.php"); break;
		case 5: $idr=0; $modalidade = 'PIBIC'; require("premiacao_10.php"); break;
		case 7: require("premiacao_10.php"); break;
		case 8: require("premiacao_10.php"); break;
		case 9: require("premiacao_10.php"); break;
		case 0: require("premiacao_10.php"); break;
		case 11: require("premiacao_10.php"); break;
		}

?>
</div>
<?php
require("cab_pibic.php");

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }
	
require($include."sisdoc_tips.php");
require("../_class/_class_position.php");
$pos = new posicao;

$pos->position = 0;

/* Mostra projeto */
echo $pos->show(4,5,array());

require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");
require($include."sisdoc_windows.php");
echo '<fieldset>';
require("../_class/_class_ged.php");
$ged = new ged;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;

/* recupera protocolo */
if (strlen($dd[89]) > 0)
	{ $proto = $dd[89];	$_SESSION['protocolo'] = $proto; } 
	else 
	{ $proto = $_SESSION['protocolo']; }
	$prj->protocolo = $proto;

/* recupera plano do aluno */
if (strlen($dd[90]) > 0)
	{
		$proto_aluno = $dd[90];	
		$_SESSION["proto_aluno"] = $dd[90]; 
	} else {
		$proto_aluno = $_SESSION["proto_aluno"]; 
	}
	$prj->protocolo = $proto;
	$prj->protocolo_aluno = $proto_aluno;

/* redireciona se em branco */
if (strlen($proto)==0)
	{ redirecina('main.php'); }
	
echo $prj->mostra_dados_projeto($proto);

if ($dd[0]=='NEW')
	{
		$prj->submit_plano_new();
		exit;
	}


echo $prj->submit_plano();

echo '</fieldset>';
require("foot.php");
?>
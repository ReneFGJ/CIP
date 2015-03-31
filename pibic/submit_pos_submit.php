<?php
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

require("../_class/_class_pibic_projetos_v2.php");
$prj = new projetos;

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
	{
		echo 'Protocolo não localizado';
		exit;
		redirecina('main.php'); 
	}
	
$prj->le($proto);
$line = $prj->line;
echo '<table><TR><TD>';
echo $prj->mostra($line);

echo '</table>';
echo '<h1>Plano do aluno</h1>';
if ($dd[0]=='NEW')
	{
		if ($ttt=='JR')
			{
				$prj->submit_plano_jr_new($ttt);
			} else {
				$prj->submit_plano_new($ttt);
			}
		exit;
	}

switch ($ttt)
	{
	case 'JR':
		echo $prj->submit_plano_jr();
		break;
	default:
		echo $prj->submit_plano($ttt);
		break;		
	}

echo '</table>';
require("foot.php");
?>
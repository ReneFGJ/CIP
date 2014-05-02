<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require("../_class/_class_bonificacao.php");
$bon = new bonificacao;

require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");
$doc = new docentes;

require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');

require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');

$cap = new captacao;

$ano = (date("Y")-1);
$cap->le($dd[0]);

$docente = $cap->professor;
$doc->le($docente);
echo $doc->mostra_dados();

echo $cap->mostra();

echo '<form action="bonificacao_fomento_gerar.php"><center>';
echo '<input type="submit" value="voltar">';
echo '</form><BR><BR>';

echo $bon->acao($cap->status);

//if ($perfil->valid('#ADM'))
	{
		echo $bon->editar($cap);		
	}

	

//echo $bon->bonificar_formento_gerar($dd[1]);
	
require("../foot.php");	?>
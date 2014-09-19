<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('index.php','principal'));
array_push($breadcrumbs, array('submissao.php','Submissão'));

require("cab_semic.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_windows.php');
require($include.'sisdoc_email.php');
require("../_class/_class_ic.php");
require("../_class/_class_docentes.php");
require("../_class/_class_semic.php");

echo '<h1>Trabalho</h1>';
$semic = new semic;
$semic->tabela = "semic_ic_trabalho";
$semic->tabela_autor = "semic_ic_trabalho_autor";
$edit = 1;
echo $semic->semic_mostrar($dd[0],'semic_');

if (($perfil->valid('#ADM#PIB')))
	{
	echo $semic->semic_adm_acao();
	}

echo $semic->mostra_ingles();

if (($perfil->valid('#PIT')) and ($semic->status <> 'D'))
	{
	if (strlen($dd[10]) > 100)
		{
			$semic->gravar_resumo_ingles($dd[10],$ss->user_login);
			redirecina(page().'?dd0='.$dd[0]);			
		}
	echo $semic->postar_resumo_ingles();
	}

//if ($perfil->valid('#PIT'))
	{
	echo '<HR><A HREF="semic_autoridades_ic_autores.php?dd0='.$dd[0].'">Editar Autores</A><HR>';
	}

require("../foot.php");
?>



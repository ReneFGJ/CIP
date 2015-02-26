<form method="post">
<input type="hidden" name="dd0" value="<?=$dd[0];?>">
<TABLE width="710" align="center" border="0">
<TR>
<?
$estilo_admin = 'style="width: 230; height: 40; background-color: #EEE8AA; font: 13 Verdana, Geneva, Arial, Helvetica, sans-serif;"';

$menu = array();
array_push($menu,array('Bolsas','Alterar Aluno','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=001')); 
array_push($menu,array('Bolsas','Cancelar Projeto','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=002')); 
//array_push($menu,array('Bolsas','Reativar Projeto','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=002')); 
//array_push($menu,array('Bolsas','Suspender Projeto','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=002')); 

//if ($pb_bolsa == 'A')
	{ array_push($menu,array('Bolsas','Alterar tipo de Bolsa','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=005')); }

if ((strlen($resumo) > 0))
// and (	$semic < 20100101))
	{ array_push($menu,array('Bolsas','Enviar Resumo p/ Publicação','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=010')); }

if ($status == '@')
	{
		$menu = array();
		array_push($menu,array('Bolsas','Implantar Bolsa','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=015')); 
		array_push($menu,array('Bolsas','Trocar projetos','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=004')); 
		array_push($menu,array('Bolsas','Cancelar Projeto','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=002')); 
	}
if ($status == 'A')
	{
	array_push($menu,array('Bolsas','Substituir Professor','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=006')); 
	array_push($menu,array('Bolsas','Alterar tipo de Bolsa','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=007')); 
	}	
array_push($menu,array('Plano de aluno','Alterar titulo do plano do aluno','pibic_bolsas_contempladas.php?dd0='.$dd[0].'&dd2=050')); 

///////////////////////////////////////////////////// redirecionamento
if ((isset($dd[1])) and (strlen($dd[1]) > 0))
	{
	$col=0;
	for ($k=0;$k <= count($menu);$k++)
		{
		 if ($dd[1]==CharE($menu[$k][1])) {	header("Location: ".$menu[$k][2]); } 
		}
	}


if (strlen($dd[2]) > 0) { require("pibic_acao_".$dd[2].".php"); }

for ($x=0;$x < count($menu); $x++)
	{
		if (($x/3) == round($x/3)) { echo '<TR>'; }
		echo '<TD align="center">';
		echo '<input type="submit" name="dd1" value="'.CharE($menu[$x][1]).'" '.$estilo_admin.'>';
		echo '</TD>';
	}
?>
</table>
</form>
	
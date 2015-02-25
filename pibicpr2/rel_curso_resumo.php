<?
require("cab.php");

$tabela = "pibic_bolsa_contempladas";

$sql = "select pa_curso from pibic_aluno group by pa_curso ";
$sql .= " order by pa_curso "; 
$rlt = db_query($sql);
$tot0=0;
$tot0=1;
while ($line = db_read($rlt))
	{
	$sx .= '<TR><TD>'.$line['pa_curso'].'</TD></TR>';
	$tot0++;
	}

if ($tot0 > 0)
	{ $sx .= '<TR><TD colspan="2" align="right">Total de '.$tot0.' Cursos</TD></TR>'; }

echo '<H2>Relatório de Bolsas</H2>';

$sql = "select pa_centro from pibic_aluno group by pa_centro ";
$sql .= " order by pa_centro "; 
$rlt = db_query($sql);
$tot0=0;
while ($line = db_read($rlt))
	{
	$sc .= '<TR><TD>'.$line['pa_centro'].'</TD></TR>';
	$tot1++;
	}

if ($tot1 > 0)
	{ $sc .= '<TR><TD colspan="2" align="right">Total de '.$tot1.' Centros</TD></TR>'; }

echo '<table border="0" width="'.$tab_max.'" align="center" class="lt0">';
echo '<tr valign="top"><TD>';
echo '<table border="0" width="'.$tab_max.'" align="center" class="lt0">';
echo $sx;
echo '</table>';

echo '<TD>';
echo '<table border="0" width="'.$tab_max.'" align="center" class="lt0">';
echo $sc;
echo '</table>';

require("foot.php");	
?>
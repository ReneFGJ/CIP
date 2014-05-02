<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_cip.php");
require("../_class/_class_captacao.php");
require("../_class/_class_docentes.php");

$doc = new docentes;
require($include.'sisdoc_debug.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
$cap = new captacao;
$cp = array();

/* Anos */
$opm = ' : ';
for ($r=2003; $r <= (date("Y")+4);$r++)
	{ $opm .= '&'.$r.'01'.':'.$r; }
if (strlen($acao) == 0) { $dd[1] = '200901'; }
if (strlen($acao) == 0) { $dd[2] = date("Y").'01'; }

$opp = '001:Escolas';
$opp .= '&002:Programas de Pós';

$sql = "select * from agencia_de_fomento where agf_ativo = 2 order by agf_ordem";
$rlt = db_query($sql);
$opt = ' :todos';
while ($line = db_read($rlt))
	{
		$opt .= '&';
		$opt .= trim($line['agf_codigo']);
		$opt .= ':';
		$opt .= trim($line['agf_nome']);
	}
$opt .= '&9999:sem categorização';

array_push($cp,array('${','','Captação Vigêntes',False,False));
array_push($cp,array('$O '.$opm,'','Vigêntes em',True,True));
array_push($cp,array('$O '.$opm,'','até',True,True));
array_push($cp,array('$O '.$opp,'','Agrupados por',True,True));
array_push($cp,array('$O '.$opt,'','Tipos',False,True));
array_push($cp,array('$}','','',False,False));

echo '<H2>'.msg("bonificacoes_isencoes").'</h2>';
echo '<center>';
echo '<table width="400" cellpadding=5 cellspacing=5><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
	$cap->categoriazacao_tipos_fomente();		
		
	$ano = substr($dd[1],0,4);
	$ano2 = substr($dd[2],0,4);
	echo $cap->captacao_vigencia_bonificacao($ano,$ano2,$dd[4]);
	}
require("../foot.php");	?>
<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

require("../_class/_class_captacao.php");
$cap = new captacao;

$cp = array();

$frm = array('1'=>'Metodologia 1 - Ativos'
			,'2'=>'Metodologia 2 - Iniciados no ano'
			,'3'=>'Metodologia 3 - Rateados pela vigência');

if (strlen($dd[1]) == 0) { $dd[1] = date("Y").'01'; }
if (strlen($dd[2]) == 0) { $dd[2] = date("Y").'01'; }
$mod = '001:'.$frm[1];
$mod .= '&002:'.$frm[2];
$mod .= '&003:'.$frm[3];
  
$dd3 = round($dd[3]);
echo '<H1>Captação de Recursos Vigêntes<BR>';
echo $frm[$dd3].'<H1>';
echo '<font class="lt1">'.substr($dd[1],0,4).' - '.substr($dd[2],0,4);

$sta = '0:Validados e Bonificados';
$sta .= '&1:Todos';
$opm = ' : ';
for ($r=2003; $r <= (date("Y")+4);$r++)
	{ $opm .= '&'.$r.'01'.':'.$r; }

/* Agencias */
$sql = "select * from agencia_de_fomento where agf_ativo = 1 order by agf_nome ";
$rlt = db_query($sql);
$rt = ' :Todas as Agências e Empresas';
while ($line = db_read($rlt))
	{
		$rt .= '&'.trim($line['agf_codigo']).':'.trim($line['agf_nome']);
		if ($dd[6] == trim($line['agf_codigo'])) 
			{
				echo ' - '.$line['agf_nome'];
			}
	}

array_push($cp,array('${','','Projetos Vigêntes',False,False));
array_push($cp,array('$O '.$opm,'','Iniciaram entre',True,True));
array_push($cp,array('$O '.$opm,'','e',True,True));
array_push($cp,array('$O '.$mod,'','Modelo do relatório',True,True));
array_push($cp,array('$O '.$sta,'','Status',True,True));
array_push($cp,array('$O 0:NÃO&1:SIM','','Detalhamento dos dados',True,True));
array_push($cp,array('$O '.$rt,'','Agência ou Empresa de Fomento',False,True));
array_push($cp,array('$}','','',False,False));

echo '<center>';
echo '<table width="700" cellpadding=5 cellspacing=5><TR><TD>';
editar();
echo '</table>';

if ($saved > 0)
	{
		$dd1 = $dd[1].'01';
		$dd2 = $dd[2].'99';
		if ($dd[3] == '001') { echo $cap->projetos_vigentes_inicio($dd1,$dd2,1,round($dd[5]),trim($dd[6]),$dd[4]); }
		if ($dd[3] == '002') { echo $cap->projetos_vigentes_inicio($dd1,$dd2,2,round($dd[5]),trim($dd[6]),$dd[4]); }
		if ($dd[3] == '003') { echo $cap->projetos_vigentes_inicio($dd1,$dd2,3,round($dd[5]),trim($dd[6]),$dd[4]); }
	}
	
?>
<BR><BR>
<table width="<?php echo $tab_max;?>" class="lt1">
	<TR><TD>Metodologia 1: Identifica as captações no período especificado, incorporando o valor total do projeto em cada ano de sua vigência. Não estão computados as prorrogações</TD></TR>
	<TR><TD>Metodologia 2: Identifica as captações no período especificado, incorporando o valor total do projeto no primeiro ano de vigência do projeto.</TD></TR>
	<TR><TD>* As captações mostradas referem-se aos <I>status</I>: 
		<UL>
			<LI>validado pelo coordenador com bonificação;</LI>
			<LI>Validado, sem bonificação</LI>
			<LI>Bonificado</LI>
			<LI>Em processo de bonificação</LI>				
		</UL>
</table>
<?
require("../foot.php");
?>

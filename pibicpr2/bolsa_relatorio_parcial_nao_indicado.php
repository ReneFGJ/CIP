<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

$sql = "select * from pibic_bolsa_tipo ";
$rlt = db_query($sql);
$opb .= ' :---Todas as bolsas--';
while ($line = db_read($rlt))
	{
	$opb .= '&'.trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}
	
$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Ano',True,True,''));
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$O '.$opb,'','Tipo de Bolsa',False,True,''));
array_push($cp,array('$H8','','',False,True,''));
array_push($cp,array('$O 1:Não Indicados&2:Indicados, não avaliados&3:Avaliados& :Todos','','Estatus da avaliação',False,True,''));
$fld = "pb_relatorio_parcial";
//////////////////
if (strlen($dd[1]) == 0) { $dd[1] = (date("Y")-1); }
if (strlen($acao) == 0) { $dd[4] = '1'; }
echo '<CENTER><font class=lt5>Acompanhamento da avaliação do relatório parcial</font></CENTER>';
?><TABLE width="700" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	

/////////////////////////////////////////////////////////////////// Relatório Parcial
if ($saved > 0)
		{
		$id = 0;
		$sql = "select * from (";
		$sql .= "select max(A) as aa, max(B) as bb, pp_protocolo from (";
		$sql .= "select 1 as A,0 as B,pp_protocolo from  pibic_parecer_".$dd[1]." where pp_status = '@' ";
		$sql .= " union ";
		$sql .= "select 0,1,pp_protocolo from  pibic_parecer_".$dd[1]." where pp_status <> '@' ";
		$sql .= ") as tabela group by pp_protocolo ";
		$sql .= ") as tabela2 ";
		$sql .= "inner join pibic_bolsa_contempladas on pb_protocolo = pp_protocolo ";
		$rlt = db_query($sql);
		$sx = '';
		while ($line = db_read($rlt))
			{
			$sx .= '<TR>';
			$sx .= '<TD>';
			$sx .= $line['pp_protocolo'];
			$sx .= '<TD>';
			$sx .= $line['pb_titulo_projeto'];
			$sx .= '<TD>';
			$sx .= $line['aa'];
			$sx .= '<TD>';
			$sx .= $line['bb'];
			$sx .= '<TD>';
			$sx .= $line['pb_relatorio_parcial_nota'];
			
			
			$sx .= '</TR>';
			$xx = $line;
			}

		print_r($xx);

		echo '<table width="96%" border="1" class="lt0">';
		echo '<TR><TD>Protocolo</TD><TD>título</TD><TD>Indicado</TD><TD>Avaliado</TD><TD>Nota</TD></TR>';
		echo $sx;
		echo '</table>';
		}
	
require("foot.php");	
?>
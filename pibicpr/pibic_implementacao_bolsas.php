<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');
	
$tabela = "";
$cp = array();
$ano = date("Y");

array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$A8','','Bolsas não implementadas',False,True,''));
array_push($cp,array('$O PIBIC:PIBIC&PIBITI:PIBITI','','Edital',False,True,''));
if (strlen($dd[3]) == 0)
	{
	array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo where pbt_edital = \''.$dd[1].'\' ','','Tipo de Bosa',True,True,''));
	} else {
	array_push($cp,array('$HV','','',False,True,''));
	}
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$HV','',$ano,True,True,''));
//////////////////
if (strlen($dd[4]) == 0) { $dd[4] = (date("Y")-1); }
	echo '<font class=lt5>Relação de bolsas</font>';
	?><TABLE width="<?=$tab_max?>" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	if ($saved == 0)
		{ exit; }
			

$sql = "select * from pibic_bolsa ";
$sql .= " left join pibic_professor on pp_cracha = pb_professor ";
$sql .= " left join pibic_bolsa_contempladas on pibic_bolsa_contempladas.pb_protocolo = pibic_bolsa.pb_protocolo ";
$sql .= " left join pibic_aluno on pa_cracha = pibic_bolsa_contempladas.pb_aluno ";
$sql .= " left join pibic_submit_documento on doc_protocolo = pibic_bolsa.pb_protocolo ";
$sql .= " where pp_ano = '".$ano."' ";
//$sql .= " and pb_ativacao < ".$ano.'0101';
$sql .= " and doc_edital = '".$dd[1]."' ";
$sql .= " and pibic_bolsa.pb_ativo = 1 ";
if (strlen($dd[3]) > 0)
	{ $sql .= " and pibic_bolsa.pb_tipo = '".$dd[3]."' "; }
$sql .= " order by pp_nome, pibic_bolsa.pb_protocolo  ";
$rlt = db_query($sql);

$tot = 0;
$nid = 0;
while ($line = db_read($rlt))
	{
	$tot++;
	$tipo   = $line['pb_tipo'];
	$ativ   = $iine['pb_ativacao'];
	$prof   = $line['pb_professor'];
	$estu   = $line['pb_aluno'];
	$prot   = $line['pb_protocolo'];
	$at     = $line['pb_ativo'];
	$edital = trim($line['doc_edital']);
	$ano    = trim($line['doc_ano']);
	
	$prof_nome = $line['pp_nome'];
	$estu_nome = $line['pa_nome'];

	$sx .= '<TR '.coluna().'>';
	$sx .= '<TD align="center">'.$edital.'/'.$ano.'</TD>';

	$sx .= '<TD>'.$prof_nome.' ('.$prof.')</TD>';

	$sx .= '<TD><img src="img/logo_bolsa_'.$tipo.'.png" width="34" height="15" alt="" border="0"></TD>';
	
	$sx .= '<TD>'.$estu_nome.' ('.$estu.')</TD>';

	$sx .= '<TD align="center">'.$prot.'</TD>';
	$sx .= '<TD>'.stodbr($line['pb_ativacao']);

	$sx .= '</TR>';
	if ($line['pb_ativacao'] < 20020101) { $nid++; }
	}
if ($tot > 0)
	{
		$nidp = ' ('.number_format(100*$nid/$tot,1,',','.').'%)';
	}
echo '<H2><center>Bolsas não implementadas '.$dd[1].'</center></H2>';
echo '<table width="98%" class="lt1">';
echo '<TR><TD colspan="10" align="right"><font class="lt3">Total de '.$tot.' bolsas. '.$nid.$nidp.' não implementadas.</font></TD></TR>';
echo '<TR><TH>Edital</TH>';
echo '<TH>Professor</TH>';
echo '<TH>Bolsa</TH>';
echo '<TH>Estudante</TH>';
echo '<TH>Protocolo</TH>';
echo '<TH>Ativação</TH>';
echo '</TR>';
echo $sx;
echo '</table>';
echo '<BR><BR><BR><BR>';
echo $hd->foot();
?>
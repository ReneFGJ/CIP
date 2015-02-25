<?
require("cab.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_form2.php");
require($include."sisdoc_autor.php");
require($include."cp2_gravar.php");


$sql = "ALTER TABLE pibic_bolsa_tipo ADD COLUMN pbt_auxilio double precision;";
//$rlt = db_query($sql);
//if (strlen($dd[4]) == 0)
//	{ $ano = date("Y"); } else {$ano = $dd[4]; }

$relatorio_titulo = "Edital ".$dd[4]." - Bolsas de Iniciação Científica";
if (strlen($dd[4]) > 0)
	{
	$relatorio_titulo = "Edital ".$dd[4]."/".($dd[4]+1)." - Bolsas de Iniciação Científica";
	}

$hd = "<TR><TH>bolsa</TH><TH>tit</TH><TH>professor</TH><TH>aluno</TH><TH>título do plano de trabalho</TH></TR>";		

$tit1 = "<BR>Fundação Araucária";
?>
<head>
<title>Edital <?=$site_titulo;?><?=$tit1;?></title>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>
<center>
<?
$opa = ' :Todos';
for ($ra = date("Y");$ra >= 2009;$ra--) { $opa .= '&'.$ra.':'.$ra; }
$opc = ' :Todas as bolsas ';
$sql = 'select * from pibic_bolsa_tipo order by pbt_descricao';
$rlt = db_query($sql);

while ($line = db_read($rlt))
	{
	$opc .= '&'.trim($line['pbt_codigo']).':'.trim($line['pbt_descricao']);
	}

		$tabela = '';
		$cp = array();
		array_push($cp,array('$H8','','',False,True,''));
		array_push($cp,array('$O '.$opc,'','Bolsa',False,True,''));
		array_push($cp,array('$H8','','De',False,True,''));
		array_push($cp,array('$H8','','até',False,True,''));
		array_push($cp,array('$O '.$opa,'','Edital',False,True,''));

		echo '<TABLE width="'.$tab_max.'">';
		echo '<TR><TD>';
		editar();
		echo '</TABLE>';	

if ($saved > 0)
{
$sc = '<TABLE width="'.$tab_max.'">';
$sc .= '<TR>';
$sc .= '<TD class="lt1" align="center">'.$relatorio_titulo.' '.$tit1.'<font class="lt0"><BR>'.date("d/m/Y H:i").'</font></TD>';
$sc .= '</TR>';
$sc .= '</TABLE>';
$sc .= '<table width="'.$tab_max.'" cellpadding="0" cellspacing="0">';

	
require($include."sisdoc_data.php");
require($include.'sisdoc_security_post.php');

$sql = "select max(pee_edital) as edital from pibic_edital";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$edital = strzero($line['edital'],4);
	}
	
////////////////////////////// NOVO QUERY
///////////////////////////////////////////////////////////////////////////////

$sql = "select * from pibic_bolsa_contempladas ";
$sql .= "left join pibic_aluno on pb_aluno = pa_cracha ";
$sql .= "left join pibic_professor on pb_professor = pp_cracha ";
$sql .= "left join pibic_submit_documento on doc_protocolo = pb_protocolo_mae ";
//$sql .= "left join pibic_edital on pb_protocolo = pee_protocolo ";
$sql .= " where pb_status <> 'C' ";
if (strlen(trim($dd[1])) > 0) { $sql .= " and (pb_tipo = '".$dd[1]."') "; }
if (strlen(trim($dd[4])) > 0) { $sql .= " and (pb_ano = '".trim($dd[4])."') "; }
$sql .= "order by pa_nome";
$rlt = db_query($sql);

$ord = 0;
$icv = '';
$area = '';
$bolsax = "Z";
$tot=0;
$tota=0;
$rn = 0;
$sx = $sc;
$tot = 0;
$tots= 0;
while ($line = db_read($rlt))
	{
//	print_r($line);
//	exit;
	$tot++;
	if ($rn >=3)
		{
		$sx .= '</TABLE><p style="page-break-before: always;"></p>';
		$sx .= $sc;
		$rn = 0;
		}
		
	$rn++;
	$ttt = LowerCase($line['doc_1_titulo']);
	$ttt = UpperCase(substr($ttt,0,1)).substr($ttt,1,strlen($ttt));
	
	$ttp = LowerCase($line['pb_titulo_projeto']);
	$ttp = UpperCase(substr($ttp,0,1)).substr($ttp,1,strlen($ttp));
	$bolsa_codigo = $line['pb_codigo'];
	$aluno     = $line['pa_nome'];
	$aluno_rg  = $line['pa_rg'];
	$aluno_cpf = $line['pa_cpf'];
	$aluno_pai = $line['pa_pai'];
	$aluno_mae = $line['pa_mae'];
	$aluno_end = mst($line['pa_endereco']);
	$prof      = $line['pp_nome'];
	$protocolo = $line['pb_protocolo'];
	$protocolom= $line['pb_protocolo_mae'];	
	$pb_fomento = trim($line['pb_fomento']);
	$bolsa_ant  = trim($line['pa_bolsa_anterior']);
	
	$aluno_email    = trim($line['pa_email']);
	$aluno_email    .= ' '.trim($line['pa_email_1']);
	$aluno_fone     = trim($line['pa_telefone']);
	
	$aluno_tel3     = trim($line['pa_tel1']);
	$aluno_tel4     = trim($line['pa_tel2']);
	$aluno_tel1     = trim($line['pa_telefone']);
	$aluno_tel2     = trim($line['pa_celular']);
	
	$pa_cc_banco = $line['pa_cc_banco'];
	$pa_cc_agencia = $line['pa_cc_agencia'];
	$pa_cc_conta = $line['pa_cc_conta'];

	$doc_aprovado_externamente = trim($line['doc_aprovado_externamente']);
	
	if (strlen($aluno_pai) == 0) { $tots++; }
	if ($doc_aprovado_externamente == '1')
		{
		$doc_aprovado_externamente = 'SIM, '.$pb_fomento;
		} else {
		$doc_aprovado_externamente = 'NÃO';
		}
		
	if ($bolsa_ant == 'F') { $bolsa_ant = 'Fundação Araucária'; }
	if ($bolsa_ant == 'P') { $bolsa_ant = 'Bolsa PUCPR'; }
	if ($bolsa_ant == 'C') { $bolsa_ant = 'Bolsa CNPq'; }
	if ($bolsa_ant == 'I') { $bolsa_ant = 'ICV'; }
	if ($bolsa_ant == 'A') { $bolsa_ant = 'Qualificado'; }
	if (strlen($bolsa_ant) == 0) { $bolsa_ant = 'NÃO'; }
	
	//////////// Nome do aluno
	$sx .= '<TR><TD colspan="4"><img src="img/nada_black.gif" width="100%" height="1" alt="">';

	//////////// Nome do aluno
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="3">Nome completo do aluno';
	$sx .= '<TD align="right">protocolo - cód. bolsa</TD>';
	$sx .= '<TR class="lt1">';
	$sx .= '<TD colspan="3"><B>';
	$sx .= $aluno;
	$sx .= '<TD colspan="1" align="right"><B>';
	$sx .= '<A HREF="#" onclick="newxy2('.chr(39).'gerar_contrato.php?dd99='.$protocolo.chr(39).',800,500);" title="gerar minuta do contrato">';
	$sx .= trim($protocolo).'/'.trim($protocolom).'</A> '.$bolsa_codigo;
	$sx .= '</TR>';

	//////////// CPF e RG
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="1">CPF';
	$sx .= '<TD colspan="1" align="left">RG';
	$sx .= '<TD colspan="2" align="right">e-mail</TD>';
	$sx .= '<TR class="lt1">';
	$sx .= '<TD colspan="1"><B>&nbsp;'.$aluno_cpf;
	$sx .= '<TD colspan="1" align="left"><B>&nbsp;'.$aluno_rg;
	$sx .= '<TD colspan="2" align="right"><B>&nbsp;'.$aluno_email;
	
	//////////// Dados Bancários
	if (strlen($pa_cc_banco) > 0)
	{
		$sx .= '<TR class="lt0">';
		$sx .= '<TD colspan="4"><BR>Dados Bancários';
		$sx .= '<TR class="lt1">';
		$sx .= '<TD colspan="4">Banco:<B>'.$pa_cc_banco.'</B> Agência:<B>'.$pa_cc_agencia.'</B> Conta Corrente <B>'.$pa_cc_conta.'</B>&nbsp;';
		$sx .= '<TR><TD>&nbsp;</TD></TR>';
		} else {
		$sx .= '<TR class="lt0">';
		$sx .= '<TD colspan="4"><BR>Dados Bancários';
		$sx .= '<TR class="lt1"><TD><font color="red">Sem dados bancários</font>';
		$sx .= '<TR><TD>&nbsp;</TD></TR>';
		}
		
	//////////// Filiação
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="2">nome do pai';
	$sx .= '<TD colspan="2">nome da mãe';
	$sx .= '<TR class="lt1">';
	$sx .= '<TD colspan="2"><B>&nbsp;'.$aluno_pai;
	$sx .= '<TD colspan="2"><B>&nbsp;'.$aluno_mae;

	//////////// Endereço
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="2">endereço';
	$sx .= '<TD colspan="2">telefone';
	$sx .= '<TR class="lt1" valign="top">';
	$sx .= '<TD colspan="2"><B>'.$aluno_end.'&nbsp;';
	$sx .= '<TD colspan="2"><B>'.$aluno_tel1.' '.$aluno_tel2.' '.$aluno_tel3.' '.$aluno_tel4;
	
	//////////// Nome do aluno
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="3">Professor orientador';
	$sx .= '<TD align="right">Bolsa anterior';
	$sx .= '<TR class="lt1">';
	$sx .= '<TD colspan="3"><B>';
	$sx .= NBR_autor($prof,7);
	$sx .= '<TD align="right"><B>'.$bolsa_ant;
	$sx .= '</TR>';	
	
	//////////// Título do projeto do aluno
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="4"><BR>título do projeto do professor orientador';
	$sx .= '<TR class="lt1">';
	$sx .= '<TD colspan="4"><B>'.$ttt.'&nbsp;';

//	//////////// Título do projeto do aluno
//	$sx .= '<TR class="lt0">';
//	$sx .= '<TD colspan="4"><BR>projeto aprovado externamente';
//	$sx .= '<TR class="lt1">';
//	$sx .= '<TD colspan="4"><B>'.$doc_aprovado_externamente.'&nbsp;';
//

	//////////// Título do projeto do aluno
	$sx .= '<TR class="lt0">';
	$sx .= '<TD colspan="4"><BR>título do projeto do aluno';
	$sx .= '<TR class="lt1">';
	$sx .= '<TD colspan="4"><B>'.$ttp.'&nbsp;';
	
//	print_r($line);
	}
	?>
	<?=$sx;?>	
	</table>
	<center>total de <?=$tot;?>/<?=$tots;?> bolsas</center>
<?
}
?>
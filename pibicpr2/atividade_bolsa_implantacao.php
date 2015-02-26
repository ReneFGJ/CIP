<?
//require("atividade_bolsa_professor_dados.php");
//if ($id_pesq == '88958022') { $id_pesq = '70005756';}

$to = 1;
$ss = '<TABLE width="500" class="lt1" border="0" cellpadding="0" cellspacing="0">';
$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Implementação de Bolsa</font></B>&nbsp;</legend>';
$ss .= '<TABLE width="100%" class="lt1" border="0">';
$ss .= '<TR><TD>';
//$ss .= '<font color="red">Bolsa Fundação Araucária até <B>08/ago./2011</B> as 23h59</font><BR>';
$ss .= '<font color="red">Bolsa CNPq até <B>08/ago/2011</B> as 23h59</font><BR>';
$ss .= '<font color="red">Bolsa PUCPR até <B>10/ago/2011</B> as 23h59</font><BR>';
$ss .= '<font color="red">Modalidade ICV até <B>20/ago/2011</B> as 23h59</font><BR>';
$ss .= '<BR><BR>';
$ss .= 'Clique na bolsa para ativá-la.<BR>';
$ss .= '<UL>';

$sql = "select * from pibic_bolsa ";
$sql .= " inner join pibic_aluno on pa_cracha = pb_aluno ";
$sql .= " inner join pibic_submit_documento on doc_protocolo = pb_protocolo ";
$sql .= " where pp_ano = '".date("Y")."' ";
$sql .= " and pb_ativo = 1 ";
$sql .= " and pb_professor = '".$id_pesq."' ";
$sql .= " and (pb_tipo <> 'R' and pb_tipo <> 'D' and pb_tipo <> 'F') ";
$sql .= " and doc_edital = 'PIBIC' ";
$sql .= " and pb_ativacao = 19000101 ";
$sql .= " order by id_pb ";
$rlt = db_query($sql);
$to = 0;
while ($line = db_read($rlt))
	{
	$to++;
	$link = '<A HREF="atividade_bolsa_implantacao_ativacao.php?dd0='.$line['id_pb'].'&dd1='.$line['pb_tipo'].'&dd2='.md5($line['id_pb'].$secu).'" title="Ativação de bolsa" alt="Ativação de Bolsa">';
	$bolsa = $line['pb_tipo'];
	if ($bolsa == 'C') { $bolsa_nome = 'Bolsa CNPq'; 									$bolsa_img = '<img src="/reol/pibicpr/img/logo_cnpq_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'F') { $bolsa_nome = 'Bolsa Fundação Araucária'; 						$bolsa_img = '<img src="/reol/pibicpr/img/logo_fa_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'P') { $bolsa_nome = 'Bolsa PUCPR'; 									$bolsa_img = '<img src="/reol/pibicpr/img/logo_pucpr_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'I') { $bolsa_nome = 'Iniciação Científica Voluntária'; 				$bolsa_img = '<img src="/reol/pibicpr/img/logo_icv_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'A') { $bolsa_nome = 'Opção para Iniciação Científica Voluntária';	$bolsa_img = '<img src="/reol/pibicpr/img/logo_aprov_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'G') { $bolsa_nome = 'Grupo Dois';									$bolsa_img = '<img src="/reol/pibicpr/img/logo_gr2_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'E') { $bolsa_nome = 'Bolsa Estratégica CNPq';						$bolsa_img = '<img src="/reol/pibicpr/img/logo_estra_mini.jpg" width="34" height="15" alt="" border="0">'; }
	if ($bolsa == 'U') { $bolsa_nome = 'Bolsa Estratégica PUCPR';						$bolsa_img = '<img src="/reol/pibicpr/img/logo_estra_pucpr_mini.jpg" width="34" height="15" alt="" border="0">'; }

	$ss .= '<LI>';
	if ($errp == 0)
		{
		$ss .= $link;
		}
	$ss .= $bolsa_img.' '.$bolsa_nome;
	$ss .= '<BR>'.$line['pb_aluno'].' <B>'.$line['pa_nome'].'</B>';
	$ss .= '</A>';
	$ss .= '<BR>&nbsp;';
	$ss .= '</LI>';
//	print_r($line);
	}

$ss .= '</UL>';
if ($errp != 0)
	{
	$ss .= '<BR><Font color="red">Existem dados incompletos do professor. É necessário completar os dados para continuar.</FONT>';
	}
$ss .= '</TD></TR>';
$ss .= '</table></fieldset>';
$ss .= '</table>';

if ($to > 0)
	{
		echo $ss;
	}
?>
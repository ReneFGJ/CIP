<?
//require("atividade_bolsa_professor_dados.php");
//if ($id_pesq == '88958022') { $id_pesq = '70005756';}

$to = 1;
$ss = '<TABLE width="100%" class="tabela00" border="0" cellpadding="0" cellspacing="0">';
$ss .= '<TR><TD><fieldset><legend>&nbsp;<B><font color="blue">Implementação de Bolsa</font></B>&nbsp;</legend>';
$ss .= '<TABLE width="100%" class="tabela00" border="0">';
$ss .= '<TR><TD>';
//$ss .= '<font color="red">Implementação de bolsas PIBITI até <B>02/set./2012</B> as 23h59</font><BR>';
//$ss .= '<font color="red">Bolsa CNPq até <B>08/ago/2011</B> as 23h59</font><BR>';
//$ss .= '<font color="red">Bolsa PUCPR até <B>10/ago/2011</B> as 23h59</font><BR>';
//$ss .= '<font color="red">Modalidade ICV até <B>20/ago/2011</B> as 23h59</font><BR>';
$ss .= '<BR><BR>';
$ss .= 'Clique na bolsa para ativá-la.<BR>';
$ss .= '<UL>';

$sql = "select * from pibic_bolsa ";
$sql .= " inner join pibic_aluno on pa_cracha = pb_aluno ";
$sql .= " inner join pibic_submit_documento on doc_protocolo = pb_protocolo ";
$sql .= " left join pibic_bolsa_tipo on pb_tipo = pbt_codigo ";
$sql .= " where pp_ano = '".date("Y")."' ";
$sql .= " and pb_ativo = 1 ";
$sql .= " and pb_professor = '".$id_pesq."' ";
$sql .= " and (pb_tipo <> 'R' and pb_tipo <> 'D' and pb_tipo <> 'X' and pb_tipo <> '#') ";
//$sql .= " and (pb_tipo = 'F') ";
if (date("Ymd") > 20130801)
	{
		$sql .= " and (doc_edital = 'PIBIC' or doc_edital = 'PIBITI') ";
	} else {
		$sql .= " and (doc_edital = 'PIBIC') ";
	}
$sql .= " and pb_ativacao = 19000101 ";
$sql .= " order by id_pb ";

$rlt = db_query($sql);
$to = 0;
while ($line = db_read($rlt))
	{
	$to++;
	$link = '<A HREF="atividade_bolsa_implantacao_ativacao.php?dd0='.$line['id_pb'].'&dd1='.$line['pb_tipo'].'&dd2='.md5($line['id_pb'].$secu).'" title="Ativação de bolsa" alt="Ativação de Bolsa">';
	$bolsa = $line['pb_tipo'];
	$bolsa_nome = $line['pbt_descricao'];
	$bolsa_img = '<img src="../pibicpr/img/logo_bolsa_'.$bolsa.'.png" border=0>';

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
<?
global $bgc;
$it++;
$status = trim($line['pb_status']);

if ($status == '@') { $status = '<font color="#ff8000">Não implementado</font>'; $bgc = '#f5f5f5';}
if ($status == 'A') { $status = '<font color="green">Ativo</font>';  $bgc = '#d2fad1';}
if ($status == 'B') { $status = '<font color="#0000ff">Encerrado</font>';  $bgc = '#faebef';}
if ($status == 'C') { $status = '<font color="#ff0000">**Cancelado**</font>';  $bgc = '#ffe1e1';}
$aluno_cod = trim($line['pb_aluno']);
$aluno_nome = trim($line['pa_nome']);

$docente_cod = trim($line['pb_professor']);
$docente_nome = trim($line['pp_nome']);

$link = '';

$bolsa = trim($line['pbt_descricao']);
$bolsa_img = '<img src="img/'.trim($line['pbt_img']).'" border="0">';
$sr .= '<TR><TD height="1" colspan="5" bgcolor="#FFFFFF"><HR></TD>';

$linka = '<A HREF="pibic_bolsas_contempladas.php?dd0='.trim($line['id_pb']).'">';
$sr .= '<TR valign="top" bgcolor="'.$bgc.'">';
$sr .= '<TD width="10">'.$it.'</TD>';
$sr .= '<TD colspan="3"><B>'.$linka.trim($line['pb_titulo_projeto']);
$sr .= '<TD colspan="1" align="right"><B>'.$linka.$line['pb_protocolo'];
$sr .= '</TR>';

$sr .= '<TR bgcolor="'.$bgc.'">';
$sr .= '<TD colspan="2" align="right"><I>Estudante</TD><TD colspan="3">'.$aluno_nome.' ('.$aluno_cod.')';
$sr .= '</TR>';

$sr .= '<TR bgcolor="'.$bgc.'">';
$sr .= '<TD colspan="2" align="right"><I>Docente</TD><TD colspan="3">'.$docente_nome.' ('.$docente_cod.')';
$sr .= '</TR>';

$sr .= '<TR bgcolor="'.$bgc.'">';
$sr .= '<TD colspan="2" align="right"><I>Bolsa </TD><TD colspan="2">'.$bolsa_img. ' '.$bolsa.' / <B>'.$line['pb_ano'].'</B>';
$sr .= '<TD align="right"><B>'.$status.'</TD>';
$sr .= '</TR>';

$sr .= '<TR bgcolor="'.$bgc.'"><TD align="right"><I>Relatórios</I></TD>';
$sr .= '<TD colspan="6">';


$fld = "pb_relatorio_parcial";
if ($line['pb_relatorio'] > 20000000)
	{
	if ($line['pb_relatorio_nota'] == 0) { $sr .= ' parcial <font color="#ff00ff">não avaliado'; }
	if ($line['pb_relatorio_nota'] == 1) { $sr .= 'parcial <font color=green><B>aprovado</B>'; }
	if ($line['pb_relatorio_nota'] == 2) { $sr .= 'parcial <font color=red><B>pendências</B>'; }
	if ($line['pb_relatorio_nota'] == -1) { $sr .= 'parcial <font color="orange"><B>enviado para correções</B>'; }
	} else {
		 $sr .= 'parcial <font color="orange"><B>não enviado</B>'; 
	}
//$fld = "pb_relatorio_parcial";
//if ($line[$fld] > 20000000)
//	{
//	if ($line[$fld.'_nota'] == 0) { $sr .= ' parcial <font color="#ff00ff">não avaliado'; }
///	if ($line[$fld.'_nota'] == 1) { $sr .= 'parcial <font color=green><B>aprovado</B>'; }
//	if ($line[$fld.'_nota'] == 2) { $sr .= 'parcial <font color=red><B>pendências</B>'; }
//	if ($line[$fld.'_nota'] == -1) { $sr .= 'parcial <font color="orange"><B>enviado para correções</B>'; }
//	}
$sr .= '</TR>';



//print_r($line);
//exit;
?>
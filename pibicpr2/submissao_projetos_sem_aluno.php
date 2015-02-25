<?
require("cab.php");
	require($include.'sisdoc_form2.php');
	require($include.'sisdoc_debug.php');	
	require($include.'cp2_gravar.php');

/* Recupera texto padrão */
if (strlen($dd[2]) == 0)
	{
		$texto = 'SUB_SEMALUNO';
		$sql = "select * from ic_noticia where nw_ref = '".$texto."'";
		$sql .= "  and nw_journal = '".$jid."' ";
		$rrr = db_query($sql);
		if ($eline = db_read($rrr))
		{
			$sC = $eline['nw_titulo'];
			$texto = $eline['nw_descricao'];			
		}
		$dd[2] = $texto;
	}
	
$tabela = "";
$cp = array();
array_push($cp,array('$H4','','',False,True,''));
array_push($cp,array('$[2009-'.date("Y").']','','Edital',True,True,''));
array_push($cp,array('$T60:9','','Texto',False,True,''));
array_push($cp,array('$O N:Não enviar&T:Tela&E:e-mail de teste abaixo&K:Enviar para todos','','Tipo',False,True,''));
array_push($cp,array('$S100','','e-mail para teste',False,True,''));

if (strlen($dd[1]) == 0) { $dd[1] = date("Y"); }

echo '<CENTER><font class=lt5>Submissões sem a indicação do aluno</font></CENTER>';
?><TABLE width="700" align="center"><TR><TD><?
editar();
?></TD></TR></TABLE><?	
require($include."sisdoc_email.php");
require($include."sisdoc_windows.php");
require($include.'sisdoc_security_post.php');

$ativo = True;


$sql = "select *";
$sql .= " from pibic_submit_documento ";
$sql .= " inner join pibic_professor on doc_autor_principal = pp_cracha ";
$sql .= " where doc_ano = '".$dd[1]."' ";
$sql .= " and (doc_status <> 'X' and doc_status <> '@') ";
$sql .= " and doc_aluno = '00000000' ";
$sql .= " order by pp_nome, doc_protocolo, doc_protocolo_mae ";

$rlt = db_query($sql);
$sx = '';
$total = 0;
$tot = 0;
$clie = "X";
$ok = true;
$pare = '';
$tot = 0;
while ($line = db_read($rlt))
	{
	$email = trim($line['pp_email']);
	$email_alt = trim($line['pp_email_1']);	
	
	$nome = trim($line['pp_nome']);
	$tot++;
	if ($pare != $nome)
		{
		$sx .= '<TR><TD colspan="5" class="lt3"><B>'.$nome.'</B></TD></TR>';
		$pare = $nome;
		} 
	/* carrega visualização padrão */
	require("submissao_mst.php");
	
	/* Enviar e-mail */
	$http = troca($http,'pibicpr2','pibic');
	$link_url = $http.'/submissao_indicacao_aluno.php?dd0='.$line['doc_protocolo'].'&dd1='.$line['doc_protocolo_mae'].'&dd99='.checkpost($line['doc_protocolo']);
	$link_url = '<A HREF="'.$link_url.'">'.$link_url.'</A>';
	$ttt = $dd[2];
	$ttt .= '<BR><BR>Enviado para '.$email.' '.$email_alt;
	
	$ttt = troca($ttt,'$professor',$nome);
	$ttt = troca($ttt,'$protocolo_mae',trim($line['doc_protocolo_mae']));
	$ttt = troca($ttt,'$protocolo',trim($line['doc_protocolo']));
	$ttt = troca($ttt,'$plano_titulo',trim($line['doc_1_titulo']));
	$ttt = troca($ttt,'$link',$link_url);
	$xline = $line;
	
	/* Tipos de envio */
	$titulo_email = '[PIBIC '.$dd[1].'] - Indicação de aluno - Protocolo '.$line['doc_protocolo'];
	if (($dd[3] == 'E') and (strlen($dd[4]) > 0))
		{
		$tela = enviaremail($dd[4],'',$titulo_email,$ttt);
		}
	if ($dd[3] == 'K')
		{
		$tela = enviaremail('pibicpr@pucpr.br','',$titulo_email,$ttt);
		if (strlen($email) > 0) { $tela = enviaremail($email,'',$titulo_email,$ttt); }
		if (strlen($email) > 0) { $tela = enviaremail($email_alt,'',$titulo_email,$ttt); }
		}


	}
	echo '<HR>'.$ttt.'<HR>';
echo '<table border="1" class="lt1" width="98%">';
echo '<TR><TD colspan="10">Total de '.$tot.' protocolos sem alunos</TD></TR>';
echo '<TR><TH>Protocolo</TH><TH>Título do plano do aluno</TH><TH>Aluno</TH><TH>ICV</TH><TH>s</TH></TR>';
echo $sx;
echo '</table>';
require("foot.php");	?>

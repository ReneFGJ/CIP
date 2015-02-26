<?
ob_start();
if (strlen($_POST['dd0']) == 0)
	{
	require("cab.php");
		require($include.'sisdoc_form2.php');
		require($include.'sisdoc_debug.php');	
		require($include.'cp2_gravar.php');
	$tabela = "";
	$cp = array();
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo','','Tipo de Bosa',True,True,''));
	array_push($cp,array('$O 0:Não&1:SIM','','Mostrar e-mail',False,True,''));
	array_push($cp,array('$C1','','Todos as áreas',False,True,''));
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$H4','','',False,True,''));
	array_push($cp,array('$H4','','',False,True,''));
	//////////////////
	
	echo '<CENTER><font class=lt5>Edital</font></CENTER>';
	?><TABLE width="500" align="center"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	require("foot.php");
	exit;
	} else {
		$em = '';
		require("db.php");
		require($include."sisdoc_autor.php");

		$relatorio_titulo = "Edital PIBIC ".date("Y")."/".(date("Y")+1)." - Resultado do Processo de Seleção de Bolsas de Iniciação Científica";

		$hd = "<TR><TH>bolsa</TH><TH>tit</TH><TH>professor</TH><TH>aluno</TH><TH>título do plano de trabalho</TH></TR>";		

		$tit1 = " "; 
		$hb = '<table class="lt0"><TR>';
		$hb .= '<TD>Bolsas:</TD>';
		$hb .= '<TD><img src="img/logo_cnpq_mini.jpg" width="34" height="15" alt="" border="0"> CNPQ';
		$hb .= '<TD><img src="img/logo_fa_mini.jpg" width="34" height="15" alt="" border="0"> Fundação Araucária';
		$hb .= '<TD><img src="img/logo_pucpr_mini.jpg" width="34" height="15" alt="" border="0"> PUCPR';
		$hb .= '<TD width="50%">&nbsp;</TD>';
	
		$hb .= '<TR>';
		$hb .= '<TD colspan="5"><img src="img/logo_icv_mini.jpg" width="34" height="15" alt="" border="0">';
		$hb .= ' Projeto aprovado unicamente para Iniciação Científica Voluntária</TD>';
	
		$hb .= '<TR>';
		$hb .= '<TD colspan="5"><img src="img/logo_aprov_mini.jpg" width="34" height="15" alt="" border="0">';
		$hb .= ' Projeto qualificado para Iniciação Científica (obrigatoriedade de adesão a ICV para concorrer a bolsas desistentes)</TD>';
	
		$hb .= '<TR>';
		$hb .= '<TD colspan="5"><img src="img/logo_gr2_mini.jpg" width="34" height="15" alt="" border="0">';
		$hb .= ' Bolsa de Iniciação Científica concedida diretamente ao pesquisador em editais de orgãos de fomento ou por empresas</TD>';
	
		$hb .= '<TR>';
		$hb .= '<TD colspan="5"><img src="img/logo_estra_mini.jpg" width="34" height="15" alt="" border="0">';
		$hb .= ' Bolsa de Iniciação Científica concedida a projetos em áreas estratégicas</TD>';

		$hb .= '<TR>';
		$hb .= '<TD colspan="5"><img src="img/logo_bolsa_U.png" width="34" height="15" alt="" border="0">';
		$hb .= ' Bolsa de Iniciação Científica concedida a projetos em áreas estratégicas - PUCPR</TD>';
	
		$hb .= '</table>';
	}
?>
<head>
<title>Edital <?=$site_titulo;?><?=$tit1;?></title>
<link rel="STYLESHEET" type="text/css" href="letras.css">
</head>
<center>
<TABLE width="100%">
	<TR>
		<TD width="30%" valign="top">
		<img src="img/logo_instituicao.jpg" height="80" alt="" border="0">
		</TD>
		<TD class="lt5" align="center"><?=$relatorio_titulo;?><?=$tit1;?></TD>
		<TD width="30%" align="right" valign="top"><NOBR>
		<img src="img/logo_pucpr.jpg" height="90" alt="" border="0">&nbsp;
		<img src="img/logo_re2ol.jpg" height="30" alt="" border="0">&nbsp;
		<img src="img/logo_fundacao_araucaria.jpg" height="50" alt="" border="0">
		</TD>
	</TR>
</TABLE>
<?
$tab_max = "100%";
require($include."sisdoc_colunas.php");
require($include."sisdoc_windows.php");
require($include."sisdoc_data.php");
require($include."sisdoc_email.php");
require($include.'sisdoc_security_post.php');

$sql = "select max(pee_edital) as edital from pibic_edital";
$rlt = db_query($sql);

if ($line = db_read($rlt))
	{
	$edital = strzero($line['edital'],4);
	}
	
////////////////////////////// NOVO QUERY
///////////////////////////////////////////////////////////////////////////////
$sql = "select * from (";	
$sql .= "select avg(pee_total) as pee_total, pp_cracha,pee_aluno,pp_email, pp_email_1,";
$sql .= " pee_protocolo_mae,pee_icv, doc_area, pa_nome, pa_bolsa, pa_bolsa_anterior, ";
$sql .= " pee_protocolo, ap_tit_titulo, pp_nome, pp_ss, pp_prod, doc_1_titulo ";
$sql .= " from pibic_edital ";
$sql .= " inner join pibic_aluno on pa_cracha = pee_aluno ";
$sql .= " inner join pibic_submit_documento on doc_protocolo = pee_protocolo ";
$sql .= " inner join pibic_professor on pp_cracha = doc_autor_principal ";
$sql .= " inner join apoio_titulacao on pp_titulacao = ap_tit_codigo ";
$sql .= " where pee_edital = ".$edital."";
$sql .= " and pee_aluno <> '' ";
$sql .= " group by ";
$sql .= " pee_protocolo_mae, pee_icv,pa_nome, pa_bolsa, pa_bolsa_anterior, pp_cracha,pee_aluno,";
$sql .= " pee_protocolo, ap_tit_titulo, pp_nome, pp_ss, pp_prod, doc_area, doc_1_titulo,pp_email , pp_email_1 ";
$sql .= ") as tabela ";
$sql .= " left join pibic_bolsa on pee_aluno = pb_aluno and pb_ativo = 1 and pp_ano = '".date("Y")."' ";
if (strlen($dd[1]) > 0)
	{
		$sql .= " where (pb_tipo = '".$dd[1]."') "; 
		$sql .= " and pee_aluno <> '00000000' ";
	} else {
		$sql .= " where pee_aluno <> '00000000' ";	
	}
	
if (strlen($dd[0]) == 0)
	{ $sql .= " order by pb_tipo,pee_icv, doc_area, pee_total desc, pp_nome,   pp_nome  "; } else 
	{ $sql .= " order by doc_area, pp_nome,pa_nome  "; } 

$rlt = db_query($sql);

$ord = 0;
$icv = '';
$area = '';
$bolsax = "Z";
$tot=0;
$tota=0;
while ($line = db_read($rlt))
	{
	$bolsa = trim($line['pb_tipo']);
	$bolsa_img = '';
	$bolsa_img = '<img src="img/logo_bolsa_'.$bolsa.'.png" width="34" height="15" alt="" border="0">'; 
	

	if ($icv != $line['pee_icv'])
		{
		$ord = 0;
		$icv = $line['pee_icv'];
		}
		
	if (($bolsa != $bolsax) and (strlen($dd[0])==0))
		{
		$bolsax = $bolsa;
		$sx .= '<TR><TD colspan="6" class="lt5">';
		if ($bolsa == 'A') { $sx .= 'RELAÇÃO DOS PROJETOS PIBITI - Vigência: agosto '.date("Y").' a julho '.(1+date("Y")).'<BR>QUALIFICADOS PARA ADESÃO A ICV'; }
		if ($bolsa == 'C') { $sx .= 'RELAÇÃO DOS PROJETOS PIBITI - Vigência: agosto '.date("Y").' a julho '.(1+date("Y")).'<BR>CONTEMPLADOS COM BOLSAS CNPq'; }
		if ($bolsa == 'P') { $sx .= 'RELAÇÃO DOS PROJETOS PIBITI - Vigência: agosto '.date("Y").' a julho '.(1+date("Y")).'<BR>CONTEMPLADOS COM BOLSAS PUCPR'; }
		if ($bolsa == 'E') { $sx .= 'RELAÇÃO DOS PROJETOS PIBITI - Vigência: agosto '.date("Y").' a julho '.(1+date("Y")).'<BR>CONTEMPLADOS COM BOLSAS ESTRATÈGICAS'; }

		$sx .= '</TD></TR>';
		}
	
	if ($area != $line['doc_area'])
		{
		if ($tota > 0)
			{ $sx .= '<TR><TD colspan="12" align="right"><B>total de </B>'.$tota.' planos</TD></TR>'; }
		$tota = 0;

		$ord = 0;
		$area = $line['doc_area'];
//		$sx .= '<TR><TD colspan="12"><HR></TD></TR>';
		if ($area == 'E') { $sx .= '<TR><TD colspan="12" class="lt4"><font color="#006b9f"><font style="font-size: 30px;"><B>Ciências Exatas '.$tit1.'</TD></TR>'; }
		if ($area == 'V') { $sx .= '<TR><TD colspan="12" class="lt4"><font color="#00A000"><font style="font-size: 30px;"><B>Ciências da Vida '.$tit1.'</TD></TR>'; }
		if ($area == 'H') { $sx .= '<TR><TD colspan="12" class="lt4"><font color="#ff0000"><font style="font-size: 30px;"><B>Ciências Humanas '.$tit1.'</TD></TR>'; }
		if ($area == 'S') { $sx .= '<TR><TD colspan="12" class="lt4"><font color="#ff0000"><font style="font-size: 30px;"><B>Ciências Sociais Aplicadas '.$tit1.'</TD></TR>'; }
		$sx .= '<TR><TD colspan="12">'.$hb.'</TD></TR>';
		$sx .= $hd;
		}

	$ord++;
	$sx .= '<TR '.coluna().'  >';
	$sx .= '<TD align="center">';
	$sx .= $bolsa_img;
	$sx .= '<TD>';
	$sx .= $line['ap_tit_titulo'].'</A>';
	$sx .= '<TD>';
	$sx .= NBR_autor($line['pp_nome'],7);
	$sx .= '<TD>';
	$sx .= NBR_autor($line['pa_nome'],7);
	$sx .= '<TD>';
	$sx .= $alink.'<font class="lt0"></B>';
	$ttt = LowerCase($line['doc_1_titulo']);
	$ttt = UpperCase(substr($ttt,0,1)).substr($ttt,1,strlen($ttt));
	$sx .= $ttt;
	$sx .= '<TR><TD colspan="6"><img src="img/nada_black.gif" width="100%" height="1" alt="" border="0"></TD></TR>';
	$tot++;
	$tota++;
	
	$email = trim($line['pp_email']);
	if (strlen($email) > 0) { $em .= $email.'; '; }
	$email = trim($line['pp_email_1']);
	if (strlen($email) > 0) { $em .= $email.'; '; }
	}
	
if ($tota > 0)
	{ $sx .= '<TR><TD colspan="12" align="right"><B>total de </B>'.$tota.' planos</TD></TR>'; }	
?>
<font class="lt0">versão <?=$edital;?> / <?=$tot;?> de bolsas<BR>
<table width="<?=$tab_max;?>" align="center" class="lt0">
<?=$sx;?>
</TABLE>
<?
if ($dd[2] == '1')
	{ echo '<BR><BR><table border="1"><TR><TD>'.$em.'</TD></TR></table>'; }
?>
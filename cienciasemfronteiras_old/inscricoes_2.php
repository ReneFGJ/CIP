<?php
$include = '../';
function msg($t) { return($t); }
require("../db.php");
header('Content-Type: text/html; charset=utf-8');
$name="Ciência sem Fronteiras PUCPR";
$content = "ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr";

/**
* Submissao de projeto parametrizado
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 1.0m
* @copyright Copyright - 2012, Rene F. Gabriel Junior.
* @access public
* @package CEP
* @subpackage submit
*/
$login = 1;
require('../_class/_class_discentes.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');

$dis = new discentes;
if ($dis->valida())
	{
		echo '';
	} else {
		echo 'não validado';
		redirecina('inscricoes.php');
	}
?>
<!DOCTYPE html>
<html>
    <head>
    	<title>Inscrição - Ciência sem Fronteiras | PUCPR</title>
        <meta charset="utf-8">
        <meta name="Ciência sem Fronteiras PUCPR" content="ciência sem fronteias, ciência, fronteiras, intercâmbio, estudos, pesquisa, pucpr">
		<link rel="stylesheet" href="css/estilo.css">
		<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
	</head>
	
	<body>
		
		<div id="total" class="total">
			
			<?php require("header.php");?>
			
			<div id="corpo">
				  <h1>Inscr<span class="lt6light">ição</span></h1>
			
<?
require('../_class/_class_fomento_old.php');
$fom = new fomento;

require('../_class/_class_csf.php');
$csf = new csf;


/*** Valida ***/
$sp = '';
if (strlen($dd[1]) > 0) { $ok++; $sp .= '1'; }
if (strlen($dd[3]) > 0) { $ok++; $sp .= '3';}
if (strlen($dd[4]) > 0) { $ok++; $sp .= '4';}
if (strlen($dd[5]) > 0) { $ok++; $sp .= '5';}
if (strlen($dd[6]) > 0) { $ok++; $sp .= '6';}
if (strlen($dd[7]) > 0) { $ok++; $sp .= '7';}
if (strlen($dd[8]) > 0) { $ok++; $sp .= '8';}
/* **/

$idi = array('Não tenho certificação(gostaria de ser informado).'
		,'Toefl (Inglês)'
		,'Ondaf (Alemanha)'
		,'CAEL (Inglês)'
		,'DALF (Francês)'
		,'DELF (Francês)'
		,'TOEIC (Inglês)'
		,'DELE (Espanhol)'
		,'DALF (Francês)'
		,'CLIS (Italiano)'
		,'CELI (Italiano)'
		,'IELTS (Inglês)'
		,'PLIDA (Italiano)'
		,'ROMATRE (Italiano)'
		,'ProfLS (Italiano)'
		);
		
$tp = array('sem','PUCPR','FIES','ProUNI');
$chk1 = array('','','');
$chk2 = array('','','');
if (strlen($dd[5]) > 0) { $chk1[$dd[5]] = 'checked'; }
		
if (strlen($dd[6]) > 0) 
	{

		for ($r=0;$r < count($tp);$r++)
			{
				if ($dd[6] == $tp[$r]) { $chk2[$r] = 'checked'; }
			}
	} 

/* Sessao e pagina da Submissao */
echo '<div>';
echo '<Table width="'.$tab_max.'" class="lt1" align="center" >';
echo '<TR><TD>';
echo msg("inscricoes_instrucoes");

echo utf8_encode($dis->mostra_dados_pessoais());
echo '<BR><BR>';

//echo '----------->'.$ok.'--'.$sp;
if ($ok==7)
	{
		$estudante = trim($dis->pa_cracha);
		echo $estudante;
		if ($csf->inscricao_csf($estudante,$dd[1],$dd[3],$dd[4],$idi[$dd[5]],$dd[6],$dd[7],$dd[8]))
			{
			redirecina('inscricoes_3.php');
			exit;
			}
	}

$edit_mode = $_SESSION['editmode'];
echo '<a name="post"></A>';
	echo '<TR><TD><form method="post" action="'.page().'#post">';
	echo '<font style="font-size: 14px;">';
	echo '<B>Selecione o edital que está se candidatando:</B><BR>';
	echo utf8_encode($fom->form_edital_open());
	
	ECHO '<tr><td><TABLE class="lt1">';
	echo '<font style="font-size: 14px;">';	
	echo '<TR><TD width="10%">';
	echo '<font style="font-size: 14px;">';
	echo '<nobr><B>'.msg('tem passaport').'</B>';
	echo sget('dd3','$O : &1:SIM&0:NÃO&2:'.msg('estou tirando'),0,0,0);

	echo '<TR><TD>';
	echo '<font style="font-size: 14px;">';
	echo '<B><nobr>'.msg('qual periodo está cursando').'</B>';
	echo sget('dd4','$[1-12]',0,0,0);
	
	echo '<TR><TD>';
	echo '<font style="font-size: 14px;">';
	echo '<nobr>'.msg('tempo permanência no exterior');
//	echo sget('dd7','$O 6:'.msg('csf_seis_meses').'&12:'.msg('csf_um_ano'),0,0,0);
	echo sget('dd7','$O 12:12 Meses',0,0,0);
	
	echo '<TR><TD colspan=2>';
	echo '<font style="font-size: 14px;">';
	echo '<B>Você já tem teste de idioma?</B>';
	echo '<BR>';
	for ($r=0;$r < count($idi);$r++)
		{
		$chk = '';
		if ($dd[5] == $r) { $chk = 'checked'; }
		echo '<input type="radio" name="dd5" value="'.$r.'" '.$chk.'>';
		echo $idi[$r];
		echo '<BR>';
		}
//	echo '<input type="radio" name="dd5" value="1" '.$chk1[1].'>';
//	echo $idi[1];	
//	echo '<BR>';
//	echo '<input type="radio" name="dd5" value="2" '.$chk1[2].'>';
//	echo $idi[2];	
	
	ECHO '<tr><td colspan=2 ><BR><BR>';
	echo '<font style="font-size: 14px;">';
	echo 'Nota do TOEF (ou equivalente, informe 0 se não realizado)';
	echo '<TR>';
	echo sget('dd8','$N8',0,0,0);
	
	ECHO '<tr><td colspan=2 >';
	echo '<font style="font-size: 14px;">';
	echo '<B>Você possui algum tipo de auxílio para cursar a graduação na Instituição, seja bolsa PUCPR, FIES ou ProUNI?</B>';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="sem" '.$chk2[0].'> Sem bolsa';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="PUCPR" '.$chk2[1].'> PUCPR';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="FIES" '.$chk2[2].'> FIES';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="ProUNI" '.$chk2[3].'> ProUNI';
	
	echo '<TR><TD colspan=2 class="lt0">';
	echo '<font style="font-size: 14px;">';
	echo msg('permanencia_info');
	echo '<TR><TD colspan=2>';
	echo '<input type="submit" value="Próxima etapa >>">';
	echo '</form>';
	echo '</table>';
	echo '</table>';
echo '</div>';
echo '</div>';
require("foot.php");

function form_edital_open()
	{
		$sql = "select * from fomento 
				where fm_prof_data <= ".date("Ymd")."
				order by fm_prof_data
		";
		$rlt = db_query($sql);
		
		while ($line = db_read($rlt))
			{
				$link = trim($line['fm_site']);
				$chamada = trim($line['fm_chamada']);
				if (strlen($link) > 0)
					{
						$link = '<A href="'.$link.'" target="new">';
					}
				$sx .= '<BR><input type="radio" name="dd1" value="'.$line['id_fm'].'" >&nbsp;';
				$sx .= $link;
				$sx .= '<font style="font-size: 14px;">';
				$sx .= trim($line['fm_nome']);
				if (strlen($chamada) > 0)
					{
						$sx .= ' - (Chamada '.$chamada.')';
					}
				$sx .= '</A>';
				$sx .= '</font>';
				$ln = $line;
			}
		return($sx);
	}

?>
<script>
	$("#content").corner();
	
</script>
	</body>
</html>
<?
/**
* Submissï¿½o de projeto parametrizado
* @author Rene F. Gabriel Junior <rene@sisdoc.com.br>
* @version 1.0m
* @copyright Copyright ï¿½ 2012, Rene F. Gabriel Junior.
* @access public
* @package CEP
* @subpackage submit
*/
$login = 1;
require("cab.php");
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

require('../_class/_class_fomento.php');
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
		,'Toefl (o aluno deverá realizar inscrição separadamente pelo site ETS)'
		,'Ondaf (Alemanha, a prova será aplicada dia 21/08, e a inscrição poderá ser feita diretamente com a Valesca, do Núcleo de Intercâmbio, Ramal 1411)'
		,'CAEL (Inglês)'
		,'DALF (Francês)'
		,'DELF (Francês)'
		,'TOEIC (Inglês)'
		,'DELE (Espanhol)'
		,'DALF (Francês)'
		,'CLIS (Italiano)'
		,'CELI (Italiano)'
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

/* Sessï¿½o e pï¿½gina da Submissao */
echo '<div id="content">';
echo '<H1>'.msg('inscrições').'</h1>';
echo '<Table width="'.$tab_max.'" class="lt1" align="center" >';
echo '<TR><TD>';
echo msg("inscricoes_instrucoes");

echo $dis->mostra_dados_pessoais();
echo '<BR><BR>';

//echo '----------->'.$ok.'--'.$sp;
if ($ok==7)
	{
		$estudante = trim($dis->pa_cracha);
		echo $estudante;
		if ($csf->inscricao_csf($estudante,$dd[1],$dd[3],$dd[4],$idi[$dd[5]],$dd[6],$dd[7],$dd[8]))
			{
			echo '<CENTER><BR><Font color="green">SALVO COM SUCESSO!</font><BR><BR>';
			exit;
			}
	}

$edit_mode = $_SESSION['editmode'];
echo '<a name="post"></A>';
	echo '<TR><TD><form method="post" action="'.page().'#post">';
	
	echo '<B>Selecione o edital que está se candidatando:</B><BR>';
	echo $fom->form_edital_open();
	ECHO '<tr><td><TABLE class="lt1">';
		
	echo '<TR><TD width="10%"><nobr><B>'.msg('tem passaport').'</B>';
	echo sget('dd3','$O : &1:SIM&0:NÃO&2:'.msg('estou tirando'),0,0,0);

	echo '<TR><TD><B><nobr>'.msg('qual periodo está cursando').'</B>';
	echo sget('dd4','$[1-12]',0,0,0);
	
	echo '<TR><TD><nobr>'.msg('tempo permanência no exterior');
//	echo sget('dd7','$O 6:'.msg('csf_seis_meses').'&12:'.msg('csf_um_ano'),0,0,0);
	echo sget('dd7','$O 12:12 Meses',0,0,0);
	
	echo '<TR><TD colspan=2>';
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
	echo 'Nota do TOEF (ou equivalente, informe 0 se não realizado)';
	echo '<TR>';
	echo sget('dd8','$N8',0,0,0);
	
	ECHO '<tr><td colspan=2 >';
	echo '<B>Você possui algum tipo de auxílio para cursar a graduação na Instituição, seja bolsa PUCPR, FIES ou ProUNI?</B>';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="sem" '.$chk2[0].'> Sem bolsa';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="PUCPR" '.$chk2[1].'> PUCPR';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="FIES" '.$chk2[2].'> FIES';
	echo '<BR>';
	echo '<input type="radio" name="dd6" value="ProUNI" '.$chk2[3].'> ProUNI';
	
	echo '<TR><TD colspan=2 class="lt0">'.msg('permanencia_info');
	echo '<TR><TD colspan=2>';
	echo '<input type="submit" value="Finalizar inscrição">';
	echo '</form>';
	echo '</table>';
	echo '</table>';
echo '</div>';

require("foot.php");
?>
<script>
	$("#content").corner();
	
</script>

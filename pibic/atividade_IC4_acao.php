<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('submissao.php','Submissão'));

require("cab_pibic.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');

require("../_class/_class_pibic_historico.php");
require("../_class/_class_pibic_bolsa_contempladas.php");
require("../_class/_class_position.php");
$pos = new posicao;
require("../_class/_class_semic.php");
$cap = new semic;

$proto = $dd[0];
if (strlen($proto) > 0)
	{
		$_SESSION['proto_rel'] = $proto;
	} else {
		$proto = $_SESSION['proto_rel'];
	}

require($include."_class_form.php");
$form = new form;
$form->class='class="form_01" ';

/* Recupera dados da Página
 */
 
$pag = $_GET["pag"];
if (strlen($pag) ==0 ) { $pag = $_SESSION['pag_cap']; }
if (strlen($pag)==0)
	{ $pag = 1; }
$_SESSION['pag_cap'] = $pag;

/* Cabecalho da submissao */
echo '<link rel="stylesheet" href="'.http.'css/style_form_001.css">';
echo '<center>';
echo '<img src="img/semic_'.date("Y").'.png" width="100%" height="50">';
echo '</center>';

$pg = page().'?dd0='.$proto.'&dd90='.checkpost($proto);
$pages = array($pg,$pg,$pg,$pg,$pg);
echo $pos->show($pag,5,'',$pages);

if (strlen($dd[0]) > 0)
	{ $cap->semic_le($dd[0]); }
;
$status = $cap->status;

/* Verifica se já foi concluida a submissao */

if (($cap->status <> '@') and (strlen($$cap->status) > 0))
	{
		echo '<fieldset><legend>Submissão de Resumo</legend>';
		echo '<H3><font color="red">Resumo não está mais em edição</font></h3>';
		echo '</fieldset>';
		exit;		
	}

/* Informacoes sobre a tabela */
$tabela = 'semic_ic_trabalho';
$cap->tabela = $tabela;
$cap->tabela_autor = $tabela.'_autor';

echo '<h3>Submissão dos Resumo PIBIC/PIBITI - '.(date("Y")-1).'/'.date("Y").'</h3>';
if ($pag == 1) 
		{
			$cap->semic_bolsa_localiza($dd[0]);			
			$cp = $cap->cp_01A(); 
		}
if ($pag == 2) { $cp = $cap->cp_02A(); }
if ($pag == 3) { echo '<h3>Resumo em Português</h3>'; $cp = $cap->cp_03A(); }
if ($pag == 4) { echo '<h3>Abstract in English</h3>';$cp = $cap->cp_04A(); }
if ($pag == 5) { $cp = $cap->cp_05A(); }

if ($pag == 6) 
	{
		echo '<center><font class="lt5"><font color="green">Submissão Concluída com sucesso!</font></font></center>';
		
		$pb = new pibic_bolsa_contempladas;
		$pb->postar_resumo($proto);
		
		require("../_class/_class_docentes.php");
		$doc = new docentes;
		$doc->le($nw->user_cracha);
		
		$email1 = $doc->line['pp_email'];
		$email2 = $doc->line['pp_email_1'];
		
		$resumo = $cap->semic_mostrar($proto);
		$prof = $doc->mostra();
		$prot = strzero($dd[0],7);
		
		if (strlen($email1) > 0)
			{ enviaremail($email1,'','[RESUMO-IC] Entrega '.$prot,$prof.$resumo); }
		if (strlen($email2) > 0)
			{ enviaremail($email2,'','[RESUMO-IC] Entrega '.$prot,$prof.$resumo); }
		//enviaremail('renefgj@gmail.com','','[RESUMO-IC] Submissão '.$prot,$prof.$resumo);
		//enviaremail('edena.grein@pucpr.br','','[RESUMO-IC] Submissão '.$proto,$prof.$resumo);		
		exit; 
	}
	

if (($pag==1) or ($pag==2) or ($pag==3) or ($pag==4) or ($pag==5))
	{
	$sql = "select * from semic_ic_trabalho where sm_codigo = '".$dd[0]."'";
	$rlt = db_query($sql);
	$line = db_read($rlt);
	$obs = trim($line['sm_obs']);
	
	if (strlen($obs) > 0)
		{
			echo '<div>';
			echo '***** Informações para adequação ******<BR>';
			echo '<img src="/reol/img/icone_alert.png" align="left"> ';
			echo '<font class="lt4"><font color="red">'.$obs.'</font></font>';
			echo '</div>';
		}
	
	echo '<Table width="100%" class="tabela00">';
	echo '<TR><TD>';
	echo $form->editar($cp,$tabela);
	echo '</table>';
	}

if ($form->saved > 0)
	{
		$user = $ss->user_cracha;
		if (strlen($proto)==0)
			{
				$sql = "select max(id_sm) as id_sm 
							from semic_trabalho 
							where sm_docente = '".$ss->user_cracha."'
							";
				$rlt = db_query($sql);
				$line = db_read($rlt);
				$dd[0] = $line['sm_codigo'];
			}
		//$cap->updatex();
		$pag++;
		$_SESSION['pag_cap'] = $pag;
		redirecina(page().'?dd0='.$dd[0].'&dd90='.checkpost($dd[0]));
	}
require("../foot.php");	


/* Funcoes */
function function_001()
	{
		global $dd,$acao,$proto;
		
		$sx .= '<tr><td colspan=2>';
		$sx .= '<fieldset>';
		$sx .= '<legend>Autores</legend>';
		$sx .= '<div id="autores" style="width: 100%">';
		$sx .= '</div>';
		$sx .= '</fieldset>';
		$sx .= '</td></tr>
		
		<script>
		var $tela = $.ajax({ url: "atividade_IC4_ajax.php", type: "POST", 
			data: { dd0: "'.$proto.'", dd1: "autor"  }
			})
			.fail(function() { alert("error"); })
 			.success(function(data) { $("#autores").html(data); });
			;		
		</script>
		';
		
		
		return($sx);
	}
function function_002()
	{
		global $dd,$cap;
		$rst = $cap->semic_valida_autores($dd[0]);
		$rm04 = trim($cap->line['sm_rem_04']);
		$rm05 = trim($cap->line['sm_rem_05']);
		$rm14 = trim($cap->line['sm_rem_14']);
		$rm15 = trim($cap->line['sm_rem_15']);
		
		$moda = $cap->line['sm_modalidade'];
		if ($moda == 'Projeto de Pesquisa')
			{
				
			} else {
				if ((strlen($rm04)==0) or (strlen($rm05)==0) or 
					(strlen($rm14)==0) or (strlen($rm15)==0))
					{
						
					} 	
			}
		if ( $rst == 1) { return(1); } else { return(''); }
	}
function function_003()
	{
		global $dd,$cap;
		$rst = $cap->semic_mostrar($dd[0]);
		return($rst);
	}	
?>
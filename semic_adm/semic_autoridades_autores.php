<?
$xcab = 1;
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('submissao.php','Submissão'));

require("cab_semic.php");
require($include.'sisdoc_debug.php');
require($include.'sisdoc_email.php');

require("../_class/_class_semic.php");
$cap = new semic;

require($include."_class_form.php");
$form = new form;
$form->class='class="form_01" ';

echo $cap->semic_mostrar($dd[0]);

/* Cabecalho da submissao */
echo '<link rel="stylesheet" href="'.http.'css/style_form_001.css">';
echo '<center>';
echo '<img src="img/mostra_'.date("Y").'.png" width="100%">';
echo '</center>';


if (strlen($dd[0]) > 0)
	{ $cap->semic_le($dd[0]); }

$cp = $cap->cp_02();

	echo '<Table width="100%" class="tabela00">';
	echo '<TR><TD>';
	echo $form->editar($cp,$tabela);
	echo '</table>';

if ($form->saved > 0)
	{
		redirecina(page().'?dd0='.$dd[0].'&dd90='.checkpost($dd[0]));
	}
require("../foot.php");	


/* Funcoes */
function function_001()
	{
		global $dd,$acao;
		$sx .= '<tr><td colspan=2>';
		$sx .= '<fieldset>';
		$sx .= '<legend>Autores</legend>';
		$sx .= '<div id="autores" style="width: 100%">';
		$sx .= '</div>';
		$sx .= '</fieldset>';
		$sx .= '</td></tr>
		
		<script>
		var $tela = $.ajax({ url: "submit_ajax.php", type: "POST", 
			data: { dd0: "'.strzero($dd[0],7).'", dd1: "autor"  }
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
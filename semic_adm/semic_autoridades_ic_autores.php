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
/* Informacoes sobre a tabela */
$tabela = 'semic_ic_trabalho';
$cap->tabela = $tabela;
$cap->tabela_autor = $tabela.'_autor';
echo $tabela;

require($include."_class_form.php");
$form = new form;
$form->class='class="form_01" ';

echo $cap->semic_mostrar($dd[0]);

/* Cabecalho da submissao */
echo '<link rel="stylesheet" href="'.http.'css/style_form_001.css">';
echo '<center>';
echo '<img src="img/mostra_'.date("Y").'.png" width="100%">';
echo '</center>';


$cap->semic_le($dd[0]);
$proto = trim($cap->line['sm_codigo']);
echo '<HR>'.$proto.'<HR>';
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
	}
function function_003()
	{
	}	
?>
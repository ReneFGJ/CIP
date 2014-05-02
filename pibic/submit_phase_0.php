<?php
require("cab_pibic.php");

if (strlen($ss->user_cracha)==0)
	{ redirecina('index.php'); }

require($include."sisdoc_tips.php");
require("../_class/_class_position.php");
$pos = new posicao;
$pos->items = array(array('título do projeto<BR>do professor','01',''),
			  array('dados do projeto','00',''),
			  array('plano do aluno','00',''),
			  array('pibic jr','00',''),
			  array('finalização','00',''));
$pos->position = 0;
require($include."sisdoc_form2.php");
require($include."sisdoc_data.php");
require($include."sisdoc_colunas.php");
require($include."cp2_gravar.php");

$professor = $ss->user_cracha;

require("../_class/_class_pibic_projetos.php");
$prj = new pibic_projetos;
/* Mostra projeto */
echo $pos->show(1,5,array());
echo '<fieldset>';
$_SESSION['protocolo']='';
$dd[0] = round(substr($protocolo,1,6));
if ($dd[0]==0) { $dd[0] = ''; }
if (strlen($dd[89]) > 0)
	{
		$_SESSION['protocolo'] = $dd[89];
		redirecina('submit_phase_1.php');
		exit;
	}
$tabela = $prj->tabela;

echo msg('submit_pibic_info');

echo $prj->submit_projeto_00();

if ($saved > 0)
	{
		$prj->updatex();
		$dd1 = $dd[2];
		$ano = date("Y");
		$sql = "select * from ".$prj->tabela."  
			where pj_professor = '$professor' and
			pj_titulo = '$dd1' and pj_ano = '$ano'
		";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				$protocolo = $line['pj_codigo'];
				$_SESSION['protocolo'] = $protocolo;
			}
		redirecina("submit_phase_1.php");
	}
echo '</fieldset>';
require("foot.php");
?>
<td valign="middle"

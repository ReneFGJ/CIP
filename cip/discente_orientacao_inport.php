<?php
require('cab.php');
$ln = new message;

global $acao,$dd,$cp,$tabela;
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_debug.php');

require("../_class/_class_docentes.php");

	$cl = new docentes;
	$cp = array();
	array_push($cp,array('$H8','','',False,True));
	array_push($cp,array('$T80:10','','',False,True));
	array_push($cp,array('$Q pos_nome:pos_codigo:select * from programa_pos where pos_ativo=1 order by pos_nome','','Programa',True,True));
	array_push($cp,array('$O : &M:Mestrado&D:Doutorado&P:Pós-Doutorado','','Modalidade',True,True));
	array_push($cp,array('$B8','','Importar >>>',False,True));
	array_push($cp,array('$O : &S:SIM','','Zerar dados anteirores',False,True));
	$tabela = '';
	
	/** Comandos de Edição */
	echo '<CENTER><font class=lt5>'.msg('titulo').'</font></CENTER>';
	?><TABLE width="<?=$tab_max;?>" align="center" bgcolor="<?=$tab_color;?>"><TR><TD><?
	editar();
	?></TD></TR></TABLE><?	
	
	/** Caso o registro seja validado */
	if ($saved > 0)
		{
			$rlt = $cl->orientacoes_inport($dd[1],$dd[2],$dd[3]);
		}
	echo '[0]- Aluno (cracha),Professor (cracha), Coorientador,Data Inicial,Data Fim';
require("../foot.php");	
?>


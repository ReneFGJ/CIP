<?php
require("cab.php");

require($include.'_class_form.php');
$form = new form;

/* Produção */
require("../_class/_class_lattes.php");

$po = ' : ';
$sql = "select * from programa_pos 
			where pos_corrente = '1'
			order by pos_nome
		";
$rlt = db_query($sql);
while ($line = db_read($rlt))
	{
		$po .= '&';
		$po .= trim($line['pos_codigo']);
		$po .= ':'.trim($line['pos_nome']);
	}

$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$O '.$po,'','Programa de Pós-Graduação',True,True));
array_push($cp,array('$B8','','Pesquisar >>>',False,True));
$tela = $form->editar($cp,'');

if ($form->saved > 0)
	{
		echo $tela;
		echo producao_pesquisadores_programa($dd[1]);
	} else {
		echo $tela;
	}
	
	
/* Pesquisadores do programa */
function producao_pesquisadores_programa($programa)
	{
		$sql = "select pp_nome, pp_cracha from programa_pos_docentes 
					inner join pibic_professor on pp_cracha = pdce_docente
					where pdce_programa = '$programa' 
					and pdce_ativo = 1
					group by pp_nome, pp_cracha
					order by pp_nome";
		$rlt = db_query($sql);
		
		$prof = array();
		$prod = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
		$prod_A1 = array();
		$prod_A2 = array();
		$prod_B1 = array();
		$prod_O  = array();
		$xano = date("Y");
		$xnome = '';
		$id = 0;
		$sx = '';
		
		while ($line = db_read($rlt))
			{
				$id++;
				$nome  = trim($line['pp_nome']);
				$codigo = trim($line['pp_cracha']);
				if ($xnome != $nome)
					{
						array_push($prof,array($nome,$codigo));
						array_push($prod_A1,$prod);
						array_push($prod_A1,$prod);
						array_push($prod_B1,$prod);
						array_push($prod_O ,$prod);												
					}
				/* Mostra Produção */
				$sx .= '<h1>'.$nome.'</h1>';
				
				$lattes = new lattes;
				$sx .= $lattes->resumo_qualis($codigo);
				$sx .= $lattes->mostra_lattes_producao($codigo);
			}
		$sx .= '<BR>Total de '.$id.' docentes.';
		return($sx);
	}

?>

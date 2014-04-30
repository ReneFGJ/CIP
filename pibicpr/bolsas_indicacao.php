<?php
require("cab.php");
require($include.'sisdoc_menus.php');

/*
 * $breadcrumbs
 */
$breadcrumbs = array();
array_push($breadcrumbs,array(http.'pibicpr/index.php',msg('principal')));
echo '<div id="breadcrumbs">'.breadcrumbs().'</div>';

require("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

/* Validação */
if (strlen($dd[1]) == 7)
	{
		$sql = "select * from pibic_submit_documento
				where doc_protocolo = '".$dd[1]."'
				limit 1 ";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				$professor = $line['doc_autor_principal'];
				$aluno = trim($line['doc_aluno']);
				$edital = $line['doc_edital'];
				$doc_ano = $line['doc_ano'];
				$proto_mar = $line['doc_protocolo_mae'];
				$proto = $line['doc_protocolo'];
			}
		$sql = "select * from pibic_edital_indicacao where pei_protocolo = '".$proto."'";
		$rlt = db_query($sql);
		if ($line = db_read($rlt))
			{
				echo 'Já está salvo';
				echo '<h1>Salvo</h1>';
				exit;
			} else {
				$valor = round($dd[3]);
				$transporte = round($dd[4]);
				$modalidade = $dd[2];
				$obs = $dd[5];
				$data = date("Ymd");
				$data_limit = 0;
				$sql = "alter table pibic_edital_indicacao add column pei_modalidade char(1) ";
				//$rlt = db_query($sql);
				$sql = "insert into pibic_edital_indicacao 
						( 
							pei_protocolo, pei_professor, pei_aluno,
							pei_status, pei_data, pei_limit, 
							pei_valor, pei_edital, pei_ano, 
							pei_aluno_autorizado, pei_professor_autorizado,
							pei_transporte, pei_obs, pei_modalidade
						) values (
							'$proto','$professor','$aluno',
							'@',$data, $data_limit,
							$valor, '$edital','$doc_ano',
							0,0,
							$transporte, '$obs', '$modalidade'
						)";
				$rlt = db_query($sql);
				echo '<h1>Salvo</h1>';
				exit;
			}
	}

require($include.'_class_form.php');
$form = new form;
$cp = array();
array_push($cp,array('$H8','','',False,True));
array_push($cp,array('$S8','','Protocolo de submissão',True,True));
array_push($cp,array('$Q pbt_descricao:pbt_codigo:select * from pibic_bolsa_tipo order by pbt_descricao','','Modalidade da bolsa',True,True));
array_push($cp,array('$S8','','Valor total da Bolsa',True,True));
array_push($cp,array('$S8','','Valor transporte',True,True));
array_push($cp,array('$T80:4','','Observação',False,True));
echo '<h3>Indicação para ativação de bolsa</h3>';
echo $form->editar($cp,'','');

if ($form->saved > 0)
	{
		echo 'SAVED';
	}

require("../foot.php");	
?>
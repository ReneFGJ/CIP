<?php
require("cab.php");

require ("../_class/_class_docentes.php");
$doc = new docentes;

    /* Recupera nome dos alunos não inseridos */
    $crachas = $doc -> docente_orientacao_sem_nome_aluno();

        $r = 0;
            $cracha = $crachas[$r];
			echo '<h1>Aguarde... atualizando discentes</h1>';
			echo 'Total não identificado:'.count($crachas);
            echo '<BR>Consultando ' . $cracha;
            $debug = 0;

		$reativar = 1;
		if (strlen($cracha) != 8)
			{
				echo 'Código inválido '.$cracha;
				redireciona('index.php');
			} else {
				require('../pibicpr/pucpr_soap_pesquisaAluno.php');
			}
			
		$sql = "select * from pibic_aluno where pa_cracha = '$cracha' ";
		$rlt = db_query($sql);
		if (!($line = db_read($rlt)))
			{
				$sql = "insert into pibic_aluno 
						(pa_cracha, pa_nome)
						values
						('$cracha','(Código inválido)')
				";
				$rlt = db_query($sql);				
			}
			
if (count($cracha) > 0)
	{
		echo '<meta http-equiv="refresh" content="1">';		
	} else {
		redireciona('index.php');
	}
?>
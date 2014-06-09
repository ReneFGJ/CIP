<?php
require("secretaria_cab.php");
require($include.'sisdoc_data.php');
require($include.'sisdoc_email.php');
require("_class/_class_proceeding.php");
$ev = new proceeding;

$id = sonumero($dd[0]);
if ($id > 0)
	{
		$ev->le($id);
		$status = trim($ev->line['ev_status']);
		$line = $ev->line;
		
		$nome = $line['ev_nome'];
		$inst = $line['ev_instituicao'];
		$carg = $line['ev_cargo'];
		
		echo $ev->etiqueta_cracha_imprimir($id);
		echo ' ';
		echo $ev->inscricao_editar();
		
		echo $ev->mostra();
		
		
		if ($status == 'A')
			{
			echo $ev->acoes();
			}	
	}



echo $sc->foot();
?>

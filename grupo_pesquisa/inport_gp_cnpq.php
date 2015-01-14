<?php
require ("cab.php");
require ($include . 'sisdoc_debug.php');

require ($include . '_class_io.php');
$io = new io;

$link = 'http://dgp.cnpq.br/dgp/espelhogrupo/6967707566824740';
$rlt = fopen($link,'r');
while (!(feof($rlt)))
	{
		$rs .= fread($rlt,1024);
	}
fclose($rlt);
echo $rs;
$tx = $rs;

//echo strip_tags($tx);

$update = busca($tx, 'LASTUPDATE');
$status = busca($tx,'STATUS');
$formacao = busca($tx,'CREATE');
$lider1 = busca($tx,'LIDER1');
$lider2 = busca($tx,'LIDER2');


echo '<BR>Atualizado em: '.$update;
echo '<BR>Situa��o: '.$status;
echo '<BR>Forma��o: '.$formacao;

echo '<BR>Lider 1:'.$lider1;
echo '<BR>Lider 2:'.$lider2;

function busca($tx, $tag) {
	switch ($tag) {
		case 'LASTUPDATE' :
			$st = 'Data do �ltimo envio';
			break;
		case 'STATUS':
			$st = 'Situa��o do grupo';
			break;
		case 'CREATE':
			$st = 'Ano de forma��o';
			break;	
		case 'LIDER1':
			$st = 'L�der(es) do grupo:';
			break;					
	}

	$pos = strpos($tx, $st);
	$tx = strip_tags(substr($tx, $pos, strlen($tx)));
	$sb = '<div class="controls">';
	$pos = strpos($tx, $sb);

	switch ($tag) {
		case  'LASTUPDATE' :
			$tx = substr($tx, ($pos + strlen($sb)), 300);
			$tx = sonumero($tx);
			$tx = substr($tx,4,4).substr($tx,2,2).substr($tx,0,2);
			return($tx);
			break;
		case  'STATUS' :
			$tx = substr($tx, ($pos + strlen($sb)), 300);
			$tx = trim(substr($tx,0,strpos($tx,'Ano')));
			return($tx);
			break;
		case  'LIDER1' :
			$tx = substr($tx, ($pos + strlen($sb)), strlen($tx));
			$tx = substr($tx,0,strpos($tx,'�rea predominante'));
			$tx = troca($tx,'ui-button',';');
			$ld = splitx(chr(15),$tx);
			print_r($ld);
			echo '<PRE>'.$tx.'</pre>';
			return($tx);
			break;			
		case 'CREATE':
			$tx = substr($tx, ($pos + strlen($sb)), 300);
			$tx = sonumero($tx);
			$tx = substr($tx,0,4);
			return($tx);
			break;
						
	}
}
?>

<?php
exit;
require("cab.php");

require($include.'_class_io.php');

require("../_class/_class_grupo_de_pesquisa.php");
$gp = new grupo_de_pesquisa;

echo $gp->inport($dd[0]);


?>
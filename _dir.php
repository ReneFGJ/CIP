<?php
// pega o endereço do diretório
$diretorio = getcwd();
$dr = array();

$ponteiro = opendir($diretorio);
while ($nome_itens = readdir($ponteiro)) {
	$itens[] = $nome_itens;
}
sort($itens);
foreach ($itens as $listar) {
	if ($listar != "." && $listar != "..") {
		if (is_dir($listar)) {
			$pastas[] = $listar;
		} else {
			$arquivos[] = $listar;
		}
	}
}
if ($pastas != "") {
	foreach ($pastas as $listar) {
		array_push($dr, $listar);
	}
}
if ($arquivos != "") {
	foreach ($arquivos as $listar) {
		print " >> - $listar <br>";
	}
}
?>

<script type="text/javascript" src="js/menu_windows.js"></script>

<h1>Editais abertos</h1>

<div class="pagina" style="z-index: -1">
	<div class="linha">
		
<?php

require("../_class/_class_fomento.php");
$fm = new fomento;

$sql = "select * from fomento_editais
		left join agencia_de_fomento on agf_codigo = ed_agencia
		where ed_data_1 >= ".date("Ymd")." 
		order by ed_data_1
		";
$rlt = db_query($sql);
while ($line = db_read($rlt)) {
	$sx = $fm->mostra_chamada($line);
	echo $sx;
}
?>

	</div>
</div>
</div>
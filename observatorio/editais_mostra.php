<?php
require("cab.php");

require("../_class/_class_fomento.php");
$fm = new fomento;
$descricao = $fm->tipo_edital();
$tipo = round($dd[0]);

echo '<h1>Editais abertos - '.$descricao[$tipo].'</h1>';
?>
<script type="text/javascript" src="js/menu_windows.js"></script>
<div class="pagina" style="z-index: -1">
	<div class="linha">
		
<?php
$tipo = round($dd[0]);


$sql = "select * from fomento_editais
		left join agencia_de_fomento on agf_codigo = ed_agencia
		where ed_data_1 >= ".date("Ymd")."
		and ed_edital_tipo = '$tipo' 
		order by ed_data_1
		";

$rlt = db_query($sql);
while ($line = db_read($rlt)) {
	echo $fm->mostra_chamada($line,1);
}
?>

	</div>
</div>
</div>
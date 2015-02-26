<?php
require ("cab.php");
?>
<script type="text/javascript" src="js/menu_windows.js"></script>



<div class="pagina" style="z-index: -1">

	<?php
	$tipo = round($dd[0]);
	require ("../_class/_class_fomento.php");
	$fm = new fomento;
	$descricao = $fm->tipo_edital();
	for ($r = 1; $r <= 5; $r++) {
		$tipo = $r;
		$sql = "select * from fomento_editais
		left join agencia_de_fomento on agf_codigo = ed_agencia
		where 
				((ed_status = 'A' and ed_data_1 > " . date("Ymd") . ")
					or 
				  (ed_fluxo_continuo = 1))		
		and ed_edital_tipo = '$tipo' 
		order by ed_data_1
		";
		echo '<h1>Editais abertos - '.$descricao[$tipo].'</h1>';
		echo '<div class="linha">';
		$rlt = db_query($sql);
		while ($line = db_read($rlt)) {
			echo $fm -> mostra_chamada($line, 1);
		}
		echo '</div>';
	}
echo '<BR><BR><BR>
</div></div>
';
echo $hd->foot();
?>
</div>
</div>
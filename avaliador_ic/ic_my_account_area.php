<?php
require("../_class/_class_pareceristas.php");
$par = new parecerista;

$par->security();
if ($dd[1]=='ADD')
{
	if (strlen($dd[2]) == 7)
	{
		$par->area_adiciona($dd[2]);
	}
}

$curso = $doc->line['pp_curso_cod'];

$edit = 1;
/* Areas cadastradas */
echo '<h1>�reas de conhecimento indicadas para avalia��o</h1>';
echo $par->mostra_areas($curso);
echo '<BR><BR>';

		$sx .= '<h1>Novas �reas para associar</h1>';
		$sx .= $par->areas_novas_ic($curso);
		echo $sx;
?>
<script>
$.ajax({
  url: "my_account_area.php",
  cache: false
}).done(function( html ) {
  $("#areascadastradas").append(html);
});
</script>

<BR><BR><BR><BR><BR><BR>
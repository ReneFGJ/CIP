<?
$breadcrumbs=array();
array_push($breadcrumbs, array('main.php','principal'));
array_push($breadcrumbs, array('captacao.php','Captação'));

require("cab_bi.php");
require($include.'sisdoc_windows.php');
require($include.'sisdoc_data.php');
require($include.'sisdoc_form2.php');
require($include.'cp2_gravar.php');
require($include.'sisdoc_colunas.php');

require("../_class/_class_captacao.php");
$cap = new captacao;

$cp = array();

$frm = array('1'=>'Captações vigentes no ano'
			,'2'=>'Captações inicados ao ano' );

if (strlen($dd[1]) == 0) { $dd[1] = 20080101; }
$dd3 = round($dd[3]);

echo '<div class="noprint"><A HREF="'.page().'?dd0=ALTERAR">alterar periodo</A></div>';

echo '<H1>Captação de Recursos Vigentes</h1>';
echo '<h3>'.$frm[$dd3].'</h3>';
if ($dd[3]=='001') {
	echo 'Identifica as captações no período especificado, apresentando o valor total do projeto em cada ano de sua vigência.'; }
if ($dd[3]=='002') {
	echo 'Identifica as captações inicadas no ano.'; }


echo ' <font class="lt1">'.substr($dd[1],0,4).' - '.substr($dd[2],0,4);

		$dd1 = $dd[1].'01';
		$dd2 = $dd[2].'99';
		if ($dd[3] == '001') { echo $cap->projetos_vigentes_inicio($dd1,$dd2,1,$detalhe,$agencia,$status,$programa_pos,$dd[7]); }
		if ($dd[3] == '002') { echo $cap->projetos_vigentes_inicio($dd1,$dd2,2,$detalhe,$agencia,$status,$programa_pos,$dd[7]); }
		
		
		echo '<table border=1 width="100%">';
		echo '<tr>';
		echo '<TD width="33%">';
		echo $cap->sg2; 
		echo '<TD width="33%">';
		echo $cap->sg3; 
		echo '<TD width="33%">';
		echo $cap->sg4; 
		
		echo '<tr>';
		echo '<TD width="33%">';
		echo $cap->sg5; 
		echo '<TD width="33%">';
		echo $cap->sg6;
		echo $cap->tabela_04;  
		echo '<TD width="33%">';
		echo $cap->tabela_03; 
				
		echo '</table>';

		require("../foot.php");
?>

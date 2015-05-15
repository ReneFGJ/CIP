<?php
$include = '../';
require ("../db.php");
require ($include . 'sisdoc_debug.php');
require ("../_class/_class_ic.php");
$ic = new ic;

require ("../_class/_class_pibic_bolsa_contempladas.php");
$pb = new pibic_bolsa_contempladas;

$id = $dd[0];
$parecerista = $id;
$chk = checkpost($id . $secu);

if (strlen($dd[0]) == 8) {

} else {
	if (date("m") < 5) {
		echo '<H1>ERRO DE ACESSO</h1>';
		exit ;
	}
}

if ($dd[90] != checkpost($dd[0]))
	{
		echo 'ERRO DE ID';
		exit;
	}
$pb -> le('',$id);

$nw = $ic -> ic('termo_CONVITE');
$nome = trim($pb -> line['pp_nome']);
$aluno = trim($pb -> line['pa_nome']);
$proj = UpperCase(trim($pb -> line['pb_titulo_projeto']));

$data = date("Ymd");

$titulo = $nw['nw_titulo'];
$texto = $nw['nw_descricao'];

$texto = troca($texto, '$nome', $nome);
$texto = troca($texto, '$NOME', $nome);
$dia = substr($data, 6, 2);
$mes = round(substr($data, 4, 2));
$mes_nome = array('', 'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');
$mes = $mes_nome[$mes];
$ano = substr($data, 0, 4);
$texto = troca($texto, '$REVISTA', $admin_nome);
$texto = troca($texto, '$DIA', $dia);
$texto = troca($texto, '$MES', $mes);
$texto = troca($texto, '$ANO', $ano);
$texto = troca($texto, '$EDITOR', $editor);
$texto = troca($texto, '$ALUNO', $aluno);
$texto = troca($texto, '$TITULO', '"'.$proj.'"');
$texto = troca($texto, '$EDITAL', $edital);

//echo '<BR><B>'.$titulo.'</B><BR>';
//echo mst($texto);

/*
 * PDF
 */
require ($include . 'fphp-153/fpdf.php');

$pdf = new FPDF();
$pdf -> AddPage();

$img = '../img/email_ic_header.png';
if (file_exists($img)) {
	$pdf -> Image($img, 0, 0, 210);
}

$pdf -> SetFont('Arial', 'B', 16);
$pdf -> Cell(0, 100, ' ', 0, 0, 'C');
$pdf -> ln(30);
$pdf -> SetFont('Arial', 'B', 22);
$pdf -> Cell(0, 12, 'CARTA CONVITE - HORAS EVENTUAIS PIBIC', 0, 0, 'C');
$pdf -> ln(20);
$pdf -> SetFont('Arial', 'I', 11);
$pdf -> MultiCell(0, 5, $texto);
$pdf -> SetX(0);
$pdf -> SetY(240);

$pdf -> SetFont('Arial', 'B', 7);
$pdf -> MultiCell(0, 5, 'Validador N. ' . $dd[0] . '/' . $ano);
$pdf -> MultiCell(0, 5, 'Emitida digitalmente em '.date("d/m/Y H:i"));

$img = '../img/email_ic_foot.png';
$pdf -> Image($img, 0, 260, 210);
$pdf -> Output();
?>

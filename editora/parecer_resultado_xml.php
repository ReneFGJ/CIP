<?
$include = '../';
require ("../db.php");
require ($include . 'sisdoc_data.php');
require ($include . 'sisdoc_security.php');

require ($include . 'sisdoc_debug.php');

require ("_class/_class_parecer.php");
$pp = new parecer;

$pp -> tabela = "submit_parecer_2013";
$pp -> le($dd[0]);

security();
?>
<head>
	<link rel="stylesheet" href="../css/style_fonts.css" type="text/css" />
	<link rel="stylesheet" href="letras.css" type="text/css" />
	<link rel="stylesheet" href="letras_form.css" type="text/css" />
	<link rel="stylesheet" href="../css/style_editora.css" type="text/css" />
	<link rel="stylesheet" href="../css/style_table.css" type="text/css" />
	<title>Parecer</title>
</head>
<?
//if (md5($dd[0].$dd[1]) == $dd[2])
$jid = $line['us_journal_id'];

$jid = round($pp -> line['us_journal_id']);
$par = round($dd[0]);

$arq = 'parecer/' . strzero($jid, 7) . '/avaliacao_' . strzero($jid, 7) . '_' . strzero($par, 8) . '.xml';
if (!file_exists($arq)) {
	for ($r = 1; $r < 200; $r++) {
		$xarq = 'parecer/' . strzero($r, 7) . '/avaliacao_' . strzero($r, 7) . '_' . strzero($par, 8) . '.xml';
		if (file_exists($xarq)) { $arq = $xarq;
			$jid = $r;
		}
	}
}
echo '<IMG SRC="http://www2.pucpr.br/reol/public/' . trim($jid) . '/images/homeHeaderLogoImage.jpg">';
echo '<HR><font class="lt2">';
echo '<CENTER><font class="lt5">PARECER CONSUBSTANCIADO Nº ' . $pp -> line['id_pp'] . '</font></CENTER>';
echo '<BR>';
echo '<table width="100%" class="lt1" border="0">';
echo '<TR><TD>';
echo 'Protocolo: <B>' . $pp -> protocolo;
echo '<TD align="right">';
echo 'Data: <B>' . stodbr($pp -> line['pp_parecer_data']) . ' ' . $pp -> line['pp_parecer_hora'];
echo '</table>';

if (!(file_exists($arq))) {
	echo '<center><h1>Parecer não localizado</h1>';
} else {
	require ('parecer_resultado_xml_read.php');

	$qst = $tree[0][TREE_NODE_CHILDREN][0][children];
	$xq0 = '';
	$id = 0;
	for ($r = 0; $r < count($qst); $r++) {

		//print_r($qst[$r][children]);
		//echo '<HR>';
		$q6 = utf8_decode($qst[$r][children][6][children][0]);
		$q5 = utf8_decode($qst[$r][children][5][children][0]);
		$tp = utf8_decode($qst[$r][children][1][children][0]);

		$q0 = utf8_decode($qst[$r][children][2][children][0]);
		$q1 = utf8_decode($qst[$r][children][3][children][0]);
		$q2 = utf8_decode($qst[$r][children][4][children][0]);
		$q5 = troca($q5,'?L%','');
		$q2 = troca($q2,'?L%','');
		if (strlen($tp) > 0)
			{
			if ($q1 != $xq1)
				{
					echo '<BR><BR><font style="font-size: 20px;">'.$q1.'</font>';
					$xq1 = $q1;
				}
			if ($tp != 'I')
				{
					echo '<BR><BR>'.$q2.' ';
					//echo '<BR>q3='.$q3;
					//echo '<BR>q4='.$q4;
					echo '<B>'.mst($q5).'</B>';
					//echo '<BR>q6='.$q6;
					//echo '<HR>';
				}
			}
	}
}
?>	
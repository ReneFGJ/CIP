<?
/*** Modelo ****/
require("cab.php");
global $acao,$dd,$cp,$tabela;
require($include.'sisdoc_colunas.php');
require($include.'sisdoc_form2.php');
require($include.'sisdoc_debug.php');
echo '<a href="curso.php">voltar</A>';

$b1 = 'associar >>>';
$b2 = '<< remover';

$curso = strzero($dd[0],5);
$area = $dd[2];

if ($acao == $b1)
{
	$sql = "select * from curso_area where cuar_curso = '$curso' and cuar_area = '$area' ";
	$rlt = db_query($sql);
	if ($line = db_read($rlt))
		{
			$sql = "update curso_area set cuar_curso = '$curso', cuar_area = '$area' where id_cuar = ".$line['id_cuar'];
			$rlt = db_query($sql);
		} else {
			$sql = "insert into curso_area
					(cuar_curso, cuar_area)
					values
					('$curso','$area')
			";
			$rlt = db_query($sql);
		}
}

if ($acao == $b2)
{
	$sql = "delete from curso_area where id_cuar = ".round('0'.$dd[3]);
	$rlt = db_query($sql);
}

	/* Dados da Classe */
	require('../_class/_class_curso.php');
	//$sql = "update pibic_mirror set mr_status = 'A' ";
	//$rlt = db_query($sql);

	$clx = new curso;
	$clx->le($dd[0]);
	
	$clx->structure();
	
	echo '<h1>'.$clx->curso_nome.'</h1>';
	echo '<form method="get" action="'.page().'">';
	echo '<input type="hidden" name="dd0" value="'.$curso.'">';
	/* Mostra áreas */
	$sql = "select * from ajax_areadoconhecimento 
				left join curso_area on a_cnpq = cuar_area
			where a_semic = 1 
			order by a_cnpq
	";
	$rlt = db_query($sql);
	
	$sx .= '<h3>Área não associadas</h3>';
	$sx .= '<select name="dd2" id="dd2" style="width: 500px;" size="20">';
	while ($line = db_read($rlt))
		{
			$sx .= '<option value="'.trim($line['a_cnpq']).'">';
			$sx .= $line['a_cnpq'];
			$sx .= ' ';
			$sx .= $line['a_descricao'];
			$sx .= '</option>';
		}
	$sx .= '</select>';
	
	/* Áreas associadas ao curso */
	$sql = "select * from ajax_areadoconhecimento 
				left join curso_area on a_cnpq = cuar_area
			where a_semic = 1 and cuar_curso = '$curso'
			order by a_cnpq
	";
	$rlt = db_query($sql);
		
	$sa .= '<h3>Área associadas ao curso</h3>';
	$sa .= '<select name="dd3" id="dd3" style="width: 500px;" size="20">';
	while ($line = db_read($rlt))
		{
			$sa .= '<option value="'.trim($line['id_cuar']).'">';
			$sa .= $line['a_cnpq'];
			$sa .= ' ';
			$sa .= $line['a_descricao'];
			$sa .= '</option>';
		}
	$sa .= '</select>';
		
	echo '<table width="100%">';
	echo '<TR valign="top"><TD>';
	echo $sx;
	echo '<TD align="center">';
	echo '<BR><BR><BR><BR>';
	echo '<input type="submit" value="'.$b1.'" name="acao">';
	echo '<BR><BR>';
	echo '<input type="submit" value="'.$b2.'" name="acao">';
	echo '<TD>';
	echo $sa;
	echo '</table>';
	
require("../foot.php");		
?> 